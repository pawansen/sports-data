<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Common_Controller {

    public $data = array();
    public $file_data = "";

    public function __construct() {
        parent::__construct();
        $this->is_auth_admin();
    }

    /**
     * @method index
     * @description listing display
     * @return array
     */
    public function index() {

        $this->data['parent'] = "User";
        $this->data['title'] = "Users";

        $role_name = $this->input->post('role_name');
        $this->data['roles'] = array(
            'role_name' => $role_name
        );
        $this->load->admin_render('list', $this->data, 'inner_script');
    }

    public function user_list() {
        $user_id = decoding($this->uri->segment(3));

        $this->data['parent'] = "User";
        $this->data['title'] = "Users";

        $option = array('table' => USERS . ' as user',
            'select' => 'user.*,group.name as group_name',
            'join' => array(
                array(USER_GROUPS . ' as ugroup', 'ugroup.user_id=user.id', 'left'),
                array(GROUPS . ' as group', 'group.id=ugroup.group_id', 'left')),
            'order' => array('user.id' => 'DESC'),
            'where' => array('user.id' => $user_id),
            'where_not_in' => array('group.id' => array(1, 3, 4)));

        $this->data['list'] = $this->common_model->customGet($option);


        $this->load->admin_render('user_list', $this->data, 'inner_script');
    }

    public function get_users_list() {

        $columns = array('id',
            'team_code',
            'first_name',
            'email',
            'phone',
            // 'purchase_amount',
            // 'deposit_amount',
            // 'due_amount',
            'active',
            'created_on',
            'action',
        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');

        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');

        $this->data['user'] = array(
            'from_date' => $from_date,
            'to_date' => $to_date
        );

        $where = ' user.id IS NOT NULL';
        if (!empty($from_date) || !empty($to_date)) {
            $from_date = date('Y-m-d', strtotime($from_date));

            $to_date = date('Y-m-d', strtotime($to_date));

            if ($to_date == '1970-01-01') {
                $where = " DATE(created_date) >= '" . $from_date . "'";
            } else {

                $where = " DATE(created_date) >= '" . $from_date . "' and DATE(created_date) <='" . $to_date . "'";
            }
        }

        if (!empty($this->input->post('search')['value'])) {
            $search = $this->input->post('search')['value'];
            $where .= ' and (user.first_name like "%' . $search . '%" or user.email like "%' . $search . '%" or user.phone like "%' . $search . '%")';
        }

        $data = array();
        $totalData = 0;
        $totalFiltered = 0;
        if ($this->ion_auth->is_vendor()) {
            $vendor_user_id = $this->session->userdata('user_id');

            $where .= ' and referral.user_id="' . $vendor_user_id . '"';
            $option = array(
                'table' => 'user_referrals as referral',
                'select' => 'user.*,referral.user_id,referral.invite_user_id',
                'join' => array(array('users as user' => 'user.id=referral.invite_user_id'),
                    array(USER_GROUPS . ' as ugroup', 'ugroup.user_id=referral.user_id', 'left'),
                    array(GROUPS . ' as group', 'group.id=ugroup.group_id', 'left')),
                'order' => array('user.id' => 'DESC'),
                'where' => $where,
                'where_not_in' => array('group.id' => array(1, 2, 4)));
        } else {
            $option = array('table' => USERS . ' as user',
                'select' => 'user.*,group.name as group_name',
                'join' => array(
                    array(USER_GROUPS . ' as ugroup', 'ugroup.user_id=user.id', 'left'),
                    array(GROUPS . ' as group', 'group.id=ugroup.group_id', 'left')),
                'order' => array('user.id' => 'DESC'),
                'where' => $where,
                'where_not_in' => array('group.id' => array(1, 3, 4)));
        }


        $user_list = $this->common_model->customGet($option);


        if (!empty($user_list) && count($user_list) != 0) {
            $totalData = count($user_list);
            $totalFiltered = $totalData;
            if ($this->ion_auth->is_vendor()) {

                $vendor_user_id = $this->session->userdata('user_id');

                $where .= ' and referral.user_id="' . $vendor_user_id . '"';
                $options = array(
                    'table' => 'user_referrals as referral',
                    'select' => 'user.*,referral.user_id,referral.invite_user_id',
                    'join' => array(array('users as user' => 'user.id=referral.invite_user_id'),
                        array(USER_GROUPS . ' as ugroup', 'ugroup.user_id=referral.user_id', 'left'),
                        array(GROUPS . ' as group', 'group.id=ugroup.group_id', 'left')),
                    'order' => array('referral.id' => 'DESC'),
                    'limit' => array($limit => $start),
                    'where' => $where,
                    'where_not_in' => array('group.id' => array(1, 2, 4)));
            } else {
                $options = array('table' => USERS . ' as user',
                    'select' => 'user.*,group.name as group_name',
                    'join' => array(
                        array(USER_GROUPS . ' as ugroup', 'ugroup.user_id=user.id', 'left'),
                        array(GROUPS . ' as group', 'group.id=ugroup.group_id', 'left')),
                    'order' => array('user.id' => 'DESC'),
                    'limit' => array($limit => $start),
                    'where' => $where,
                    'where_not_in' => array('group.id' => array(1, 3, 4)));
            }

            $users_list = $this->common_model->customGet($options);

            if (!empty($users_list)) {
                foreach ($users_list as $users) {

                    $option = array('table' => 'users as USR',
                        'select' => 'USR.id as user_id,USR.email_verify,USR.verify_mobile,UPC.verification_status as pan_status',
                        'join' => array('user_pan_card as UPC' => 'UPC.user_id=USR.id'
                        ),
                        'where' => array('USR.id' => $users->id, 'USR.email_verify' => 1,
                            'USR.verify_mobile' => 1, 'UPC.verification_status' => 2));
                    $userData = $this->common_model->customGet($option);
                    if (!empty($userData)) {
                        $stat = '<p class="btn btn-success btn-sm">Verified</p>';
                    } else {
                        $stat = '<p class="btn btn-danger btn-sm">Pending</p>';
                    }

                    $start++;
                    $userData['id'] = $start;
                    //$userData['team_code'] = isset($users->team_code) ? $users->team_code : '';
                    $userData['first_name'] = isset($users->first_name) ? $users->first_name . ' ' . $users->last_name : '';
                    $userData['email'] = isset($users->email) ? $users->email : '';
                    $userData['phone'] = isset($users->phone) ? $users->phone : '';
                    $userData['active'] = (isset($users->active) && $users->active == 1) ? '<p class="text-success">' . lang('active') . '</p>' : '<p  class="text-danger">' . lang('deactive') . '</p>';

                    if (!empty($users->created_date)) {
                        $datetime = UTCToConvertIST($users->created_date, 'Asia/Kolkata');
                    }

                    $userData['created_on'] = isset($datetime) ? $datetime : '';
                    /* $userData['created_on'] = isset($users->created_date) ? date('d-m-Y H:i', strtotime($users->created_date)) : ''; */

                    if ($users->id != 1) {
                        if ($users->active == 1) {
                            $userActiveUrl = "'" . USERS . "','id','" . encoding($users->id) . "','" . $users->active . "'";
                            $active_buttn = '<a href="javascript:void(0)" class="on-default edit-row" onclick="statusFn(' . $userActiveUrl . ')" title="Inactive Now"><img width="20" src="' . base_url() . ACTIVE_ICON . '" /></a>';
                            $active_buttn=' <a href="javascript:void(0)" onclick="statusFn(' . $userActiveUrl . ')"  data-toggle="tooltip" title="Inactive Now" class="btn btn-xs btn-success"><i class="fa fa-check"></i></a>';
                        } else {
                            $userActiveUrl = "'" . USERS . "','id','" . encoding($users->id) . "','" . $users->active . "'";
                            $active_buttn = '<a href="javascript:void(0)" class="on-default edit-row text-danger" onclick="statusFn(' . $userActiveUrl . ')" title="Active Now"><img width="20" src="' . base_url() . INACTIVE_ICON . '" /></a>';
                            $active_buttn=' <a href="javascript:void(0)" onclick="statusFn(' . $userActiveUrl . ')"  data-toggle="tooltip" title="Active Now" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>';
                        }
                        $userEditUrl = "'" . USERS . "','user_edit','" . encoding($users->id) . "'";
                        $chip_url = "'" . USERS . "','open_chip_model','" . encoding($users->id) . "'";
                        $cash_url = "'" . USERS . "','open_cash_model','" . encoding($users->id) . "'";
                        $remove_cash_url = "'" . USERS . "','remove_cash_model','" . encoding($users->id) . "'";
                        $user_edit = '<a href="javascript:void(0)" class="on-default edit-row" onclick="editFn(' . $userEditUrl . ');"><img width="20" src="' . base_url() . EDIT_ICON . '" /></a>';
                        $user_edit=' <a href="'. base_url() .'users/user_edit?id='.encoding($users->id) .'" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>';

                        $delUserUrl = "'" . USERS . "','id','" . encoding($users->id) . "','users','users/delUsers'";
                        $delete_btn = '<a href="javascript:void(0)" onclick="deleteFn(' . $delUserUrl . ')" class="on-default edit-row text-danger"><img width="20" src="' . base_url() . DELETE_ICON . '" /></a><hr>';
                        $delete_btn=' <a href="javascript:void(0)" onclick="deleteFn(' . $delUserUrl . ')" data-toggle="tooltip" title="Delete" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>';

                        $myRefferls = '<a href="' . base_url() . 'users/myReferrals/' . $users->id . '" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> My Referrals</a>';

                        //$my_prediction = '<a href="' . base_url() . 'ipl/prediction/' . encoding($users->id) . '" class="btn btn-warning btn-sm"><img width="18" src="' . base_url() . CRICKET_ICON . '" />Prediction (' . $totalPrediction . '/100)</a>';
                        //$stat ='ver';
                        if ($this->ion_auth->is_admin()) {
                            $userData['action'] = $user_edit . $active_buttn . $delete_btn;
                        } else if ($this->ion_auth->is_subAdmin()) {
                            $user = getUser($this->session->userdata('user_id'));

                            $option = array('table' => 'subadmin_access',
                                'select' => 'modules',
                                'where' => array('user_id' => $user->id),
                                'single' => true
                            );
                            $subadminDetails = commonGetHelper($option);
                            $access_modules = explode(',', $subadminDetails->modules);
                            $act_status = '';
                            foreach ($access_modules as $module) {
                                if ($module == "user_edit") {
                                    $act_status = $user_edit;
                                } else if ($module == "user_status") {
                                    $act_status .= $active_buttn;
                                } else if ($module == "user_delete") {
                                    $act_status .= $delete_btn;
                                } else if ($module == "user_pan_card") {
                                    //$act_status .= $getPanDetails;
                                } else if ($module == "user_bank_account") {
                                   // $act_status .= $getBankDetails;
                                } else if ($module == "user_aadhar_card") {
                                    //$act_status .= $getAadharCardDetails;
                                } else if ($module == "user_private_contest") {
                                   // $act_status .= $user_contest;
                                } else if ($module == "user_joined_contest") {
                                   // $act_status .= $join_contest;
                                } else if ($module == "user_match_team") {
                                   // $act_status .= $match_teams;
                                } else if ($module == "user_transaction_wallet") {
                                    //$act_status .= $transactions;
                                } else if ($module == "user_add_cash") {
                                   // $act_status .= $add_cash;
                                } else if ($module == "user_add_chip") {
                                   // $act_status .= $add_chip;
                                } else if ($module == "user_remove_cash") {
                                    //$act_status .= $remove_cash;
                                } else if ($module == "user_prediction") {
                                   // $act_status .= $my_prediction;
                                } else if ($module == "user_my_referrals") {
                                   // $act_status .= $myRefferls;
                                }
                            }

                            $userData['action'] = $stat . $act_status;

                            //$userData['action'] = $user_contest . $join_contest . $match_teams;
                        }

                        $data[] = $userData;
                    }
                }
            }
        }
        // pr($data);
        $json_data = array(
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        echo json_encode($json_data);
    }

    public function myReferrals($uid = "") {
        $this->data['parent'] = "Referrals";
        $this->data['title'] = "Referrals";
        if (empty($uid)) {
            redirect('users');
        }
        $querySql = "SELECT UR.user_id,UR.invite_user_id,UR.id,UR.create_date,u1.email,u1.phone as mobile,"
                . " CONCAT(user.first_name,'</br>(',user.email,' / ',user.phone,')') as userByInvited,"
                . " CONCAT(u1.first_name,'</br>(',u1.email,' / ',u1.phone,')') as userInvited"
                . " FROM user_referrals as UR INNER JOIN users as user ON user.id=UR.user_id "
                . " INNER JOIN users as u1 ON u1.id = UR.invite_user_id WHERE UR.user_id = $uid ";
        $userReferralsList = $this->common_model->customQuery($querySql);
        $start = 1;
        $data = array();
        if (!empty($userReferralsList)) {
            foreach ($userReferralsList as $users) {
                $start++;
                $nestedData['id'] = $start;
                $nestedData['userByInvited'] = isset($users->userByInvited) ? $users->userByInvited : '';
                $email = $temp['user_email'] = (!empty($users->email)) ? $users->email : "";
                $mobile = $temp['user_mobile'] = (!empty($users->mobile)) ? $users->mobile : "";
                $nestedData['userInvited'] = (!empty($users->email)) ? $users->email : $users->mobile;
                $nestedData['registerdStatus'] = "<p class='text-danger'><i class='fa fa-times'><i></p>";
                $nestedData['verifiedStatus'] = "<p class='text-danger'><i class='fa fa-times'><i></p>";
                $nestedData['addCashStatus'] = "<p class='text-danger'><i class='fa fa-times'><i></p>";
                $nestedData['appDownload'] = "<p class='text-danger'><i class='fa fa-times'><i></p>";
                $nestedData['invitedDate'] = isset($users->create_date) ? date('d-m-Y H:i', strtotime($users->create_date)) : '';
                $nestedData['PANVerified'] = "<p class='text-danger'><i class='fa fa-times'><i></p>";
                $nestedData['AadharVerified'] = "<p class='text-danger'><i class='fa fa-times'><i></p>";

                $invite_user_id = $users->invite_user_id;
                $option = array(
                    'table' => 'user_pan_card',
                    'select' => 'verification_status',
                    'where' => array('user_id' => $invite_user_id),
                    'single' => true
                );
                $get_pan_verified = $this->common_model->customGet($option);
                if (!empty($get_pan_verified)) {
                    if ($get_pan_verified->verification_status == 2) {
                        $nestedData['PANVerified'] = "<p class='text-success'><i class='fa fa-check'><i></p>";
                    }
                }
                $option = array(
                    'table' => 'user_aadhar_card',
                    'select' => 'verification_status',
                    'where' => array('user_id' => $invite_user_id),
                    'single' => true
                );
                $get_aadhar_verified = $this->common_model->customGet($option);
                if (!empty($get_aadhar_verified)) {
                    if ($get_aadhar_verified->verification_status == 2) {
                        $nestedData['AadharVerified'] = "<p class='text-success'><i class='fa fa-check'><i></p>";
                    }
                }
                if (!empty($email)) {
                    $query = "SELECT users.id,users.email_verify,users.verify_mobile,user_pan_card.verification_status FROM users "
                            . " LEFT JOIN user_pan_card ON user_pan_card.user_id= users.id WHERE email= '" . $users->email . "'";
                    $isRegisterd = $this->common_model->customQuery($query, true);
                    if (!empty($isRegisterd)) {

                        $option = array(
                            'table' => 'user_referrals',
                            'select' => 'is_app_download',
                            'where' => array('user_id' => $users->user_id, 'invite_user_id' => $isRegisterd->id),
                            'single' => true
                        );
                        $user_referrals = $this->common_model->customGet($option);

                        if (!empty($user_referrals)) {
                            $nestedData['appDownload'] = "<p class='text-success'><i class='fa fa-check'><i></p>";
                        }


                        $nestedData['registerdStatus'] = "<p class='text-success'><i class='fa fa-check'><i></p>";
                        if ($isRegisterd->email_verify == 1 && $isRegisterd->verify_mobile == 1 && $isRegisterd->verification_status == 2) {
                            $nestedData['verifiedStatus'] = "<p class='text-success'><i class='fa fa-check'><i></p>";
                        }
                        $querySql = "SELECT id"
                                . " FROM transactions_history"
                                . " WHERE user_id=$isRegisterd->id AND transaction_type = 'CASH' "
                                . " AND pay_type = 'DEPOSIT' ";
                        $addCash = $this->common_model->customQuery($querySql, true);
                        if (!empty($addCash)) {
                            $nestedData['addCashStatus'] = "<p class='text-success'><i class='fa fa-check'><i></p>";
                        }
                    }
                }
                if (!empty($mobile)) {
                    $query = "SELECT users.id,users.email_verify,users.verify_mobile,user_pan_card.verification_status FROM users "
                            . " LEFT JOIN user_pan_card ON user_pan_card.user_id= users.id WHERE phone= '" . $users->mobile . "'";
                    $isRegisterd = $this->common_model->customQuery($query, true);
                    if (!empty($isRegisterd)) {

                        $option = array(
                            'table' => 'user_referrals',
                            'select' => 'is_app_download',
                            'where' => array('user_id' => $users->user_id, 'invite_user_id' => $isRegisterd->id),
                            'single' => true
                        );
                        $user_referrals = $this->common_model->customGet($option);

                        if (!empty($user_referrals)) {
                            $nestedData['appDownload'] = "<p class='text-success'><i class='fa fa-check'><i></p>";
                        }
                        $nestedData['registerdStatus'] = "<p class='text-success'><i class='fa fa-check'><i></p>";
                        if ($isRegisterd->email_verify == 1 && $isRegisterd->verify_mobile == 1 && $isRegisterd->verification_status == 2) {
                            $nestedData['verifiedStatus'] = "<p class='text-success'><i class='fa fa-check'><i></p>";
                        }
                        $querySql = "SELECT id"
                                . " FROM transactions_history"
                                . " WHERE user_id=$isRegisterd->id AND transaction_type = 'CASH' "
                                . " AND pay_type = 'DEPOSIT' ";
                        $addCash = $this->common_model->customQuery($querySql, true);
                        if (!empty($addCash)) {
                            $nestedData['addCashStatus'] = "<p class='text-success'><i class='fa fa-check'><i></p>";
                        }
                    }
                }
                $data[] = $nestedData;
            }
        }
        $this->data['list'] = $data;
        $this->load->admin_render('referral_history', $this->data, 'inner_script');
    }

    /**
     * @method open_model
     * @description load model box
     * @return array
     */
    function open_model() {
        $this->data['title'] = lang("add_user");
        $this->load->admin_render('add', $this->data,'inner_script');
    }

    /**
     * @method open_cash_model
     * @description load model box
     * @return array
     */
    function open_cash_model($user_id = '') {
        $this->data['title'] = "Add Cash";
        $this->data['user_id'] = $user_id;
        $this->load->view('add_cash', $this->data);
    }

    function open_chip_model($user_id = '') {
        $this->data['title'] = "Add Chip";
        $this->data['user_id'] = $user_id;
        $this->load->view('add_chip', $this->data);
    }

    function open_chip_model_all() {
        $this->data['title'] = "Add Chip";
        //$this->data['user_id'] = $user_id;
        $this->load->view('add_chip_all', $this->data);
    }

    function remove_cash_model($user_id = '') {
        $this->data['title'] = "Remove Cash";
        $this->data['user_id'] = $user_id;
        $this->load->view('remove_cash', $this->data);
    }

    /**
     * @method: remove_cash
     * @description:Remove cash
     * @return array
     */
    public function remove_cash() {
        $data = $this->input->post();

        $this->form_validation->set_rules('remove_cash', 'Remove Cash', 'required|trim');
        $this->form_validation->set_rules('message', 'Message', 'required|trim');
        if ($this->form_validation->run() == false) {
            $messages = (validation_errors()) ? validation_errors() : '';
            $response = array('status' => 0, 'message' => $messages);
        } else {

            $userId = decoding($data['user_id']);
            $user_id = $userId;
            $orderId = generateToken(6);

            $remove_cash = $this->input->post('remove_cash');
            $message = $this->input->post('message');

            $option = array(
                'table' => 'wallet',
                'where' => array('user_id' => $user_id),
                'single' => true
            );
            $results_row = $this->common_model->customGet($option);
            if (!empty($results_row)) {

                $total_balance = $results_row->total_balance;
                $winning_amount = $results_row->winning_amount;
                $deposited_amount = $results_row->deposited_amount;

                if (abs($remove_cash) <= abs($total_balance)) {
                    $total_balance = abs($total_balance) - abs($remove_cash);

                    if ($winning_amount != 0.00) {

                        if (abs($remove_cash) <= abs($winning_amount)) {

                            $winning_amount = abs($winning_amount) - abs($remove_cash);
                        } else {
                            $amount_to_be_less = abs($remove_cash) - abs($winning_amount);
                            $winning_amount = 0;

                            $deposited_amount = abs($deposited_amount) - abs($amount_to_be_less);
                        }
                    } else {
                        $deposited_amount = abs($deposited_amount) - abs($remove_cash);
                    }

                    $options_data = array(
                        'deposited_amount' => $deposited_amount,
                        'winning_amount' => $winning_amount,
                        'total_balance' => $total_balance,
                        'update_date' => datetime()
                    );

                    $updateCash = array(
                        'table' => 'wallet',
                        'data' => $options_data,
                        'where' => array('user_id' => $user_id)
                    );

                    $removeCash = $this->common_model->customUpdate($updateCash);


                    if ($removeCash) {

                        /* To Transaction History Insert */
                        $options = array(
                            'table' => 'transactions_history',
                            'data' => array(
                                'user_id' => $user_id,
                                'match_id' => 0,
                                'orderId' => $orderId,
                                'dr' => $remove_cash,
                                'available_balance' => $total_balance,
                                'message' => $message,
                                'datetime' => date('Y-m-d H:i:s'),
                                'pay_type' => 'REMOVE CASH',
                                'transaction_type' => 'CASH'
                            )
                        );
                        $this->common_model->customInsert($options);


                        $options = array(
                            'table' => 'notifications',
                            'data' => array(
                                'user_id' => $user_id,
                                'type_id' => 0,
                                'sender_id' => $this->session->userdata('user_id'),
                                'noti_type' => 'REMOVE_CASH',
                                'message' => $message,
                                'read_status' => 'NO',
                                'sent_time' => date('Y-m-d H:i:s')
                            )
                        );
                        $this->common_model->customInsert($options);

                        $response = array('status' => 1, 'message' => "cash removed Successfully", 'url' => site_url('users'));
                    }
                } else {
                    $response = array('status' => 0, 'message' => "You have not sufficient amount in your wallet", 'url' => site_url('users'));
                }
            } else {
                $response = array('status' => 0, 'message' => "Wallet balance is not available", 'url' => site_url('users'));
            }
        }
        echo json_encode($response);
    }

    /**
     * @method: add_cash
     * @description:Add cash
     * @return array
     */
    public function add_cash() {
        $data = $this->input->post();

        $this->form_validation->set_rules('add_cash', 'Add Cash', 'required|trim');
        $this->form_validation->set_rules('message', 'Message', 'required|trim');
        if ($this->form_validation->run() == false) {
            $messages = (validation_errors()) ? validation_errors() : '';
            $response = array('status' => 0, 'message' => $messages);
        } else {
            $user_id = decoding($data['user_id']);
            $message = $this->input->post('message');
            $orderId = generateToken(6);

            $option = array(
                'table' => 'wallet',
                'where' => array('user_id' => $user_id),
                'single' => true
            );
            $results_row = $this->common_model->customGet($option);
            if (empty($results_row)) {
                $options_data = array(
                    'cash_bonus_amount' => $data['add_cash'],
                    'total_balance' => $data['add_cash'],
                    'user_id' => $user_id,
                    'create_date' => datetime(),
                );
                $option = array('table' => 'wallet', 'data' => $options_data);
                $add_cash = $this->common_model->customInsert($option);
            } else {
                $options_data = array(
                    'cash_bonus_amount' => $results_row->cash_bonus_amount + $data['add_cash'],
                    'total_balance' => $results_row->total_balance + $data['add_cash'],
                    'update_date' => datetime()
                );

                $addCash = array(
                    'table' => 'wallet',
                    'data' => $options_data,
                    'where' => array('user_id' => $user_id)
                );

                $add_cash = $this->common_model->customUpdate($addCash);
            }
            if ($add_cash) {

                $option = array(
                    'table' => 'wallet',
                    'where' => array('user_id' => $user_id),
                    'single' => true
                );
                $walletAmount = $this->common_model->customGet($option);
                if (!empty($walletAmount)) {
                    $totalBalance = $walletAmount->total_balance;
                } else {
                    $totalBalance = 0;
                }

                /* To Transaction History Insert */
                $options = array(
                    'table' => 'transactions_history',
                    'data' => array(
                        'user_id' => $user_id,
                        'match_id' => 0,
                        'cr' => $data['add_cash'],
                        'orderId' => $orderId,
                        'available_balance' => $totalBalance,
                        'message' => $message,
                        'datetime' => date('Y-m-d H:i:s'),
                        'pay_type' => 'ADD CASH',
                        'transaction_type' => 'CASH'
                    )
                );
                $this->common_model->customInsert($options);


                $options = array(
                    'table' => 'notifications',
                    'data' => array(
                        'user_id' => $user_id,
                        'type_id' => 0,
                        'sender_id' => $this->session->userdata('user_id'),
                        'noti_type' => 'ADD_CASH',
                        'message' => $message,
                        'read_status' => 'NO',
                        'sent_time' => date('Y-m-d H:i:s')
                    )
                );
                $this->common_model->customInsert($options);

                $response = array('status' => 1, 'message' => "cash added Successfully", 'url' => site_url('users'));
            }
        }
        echo json_encode($response);
    }

    public function add_chip() {
        $data = $this->input->post();

        $this->form_validation->set_rules('add_chip', 'Add Chip', 'required|trim');
        if ($this->form_validation->run() == false) {
            $messages = (validation_errors()) ? validation_errors() : '';
            $response = array('status' => 0, 'message' => $messages);
        } else {

            $user_id = decoding($data['user_id']);
            $orderId = generateToken(6);

            $opening_balance = 0;
            $cr = 0;
            $available_balance = 0;

            $option = array(
                'table' => 'user_chip',
                'where' => array('user_id' => $user_id),
                'single' => true
            );
            $results_row = $this->common_model->customGet($option);
            if (empty($results_row)) {

                $cr = $data['add_chip'];
                $available_balance = $data['add_chip'];

                $options_data = array(
                    'bonus_chip' => $data['add_chip'],
                    'chip' => $data['add_chip'],
                    'user_id' => $user_id,
                    'update_date' => datetime(),
                );
                $option = array('table' => 'user_chip', 'data' => $options_data);
                $add_chip = $this->common_model->customInsert($option);
            } else {
                $bonus_chip = abs($results_row->bonus_chip) + abs($data['add_chip']);
                $totalChip = abs($results_row->chip) + abs($data['add_chip']);
                $opening_balance = $results_row->chip;
                $cr = $data['add_chip'];
                $available_balance = $totalChip;

                $options_data = array(
                    'bonus_chip' => $bonus_chip,
                    'chip' => $totalChip,
                    'update_date' => datetime()
                );

                $addChip = array(
                    'table' => 'user_chip',
                    'data' => $options_data,
                    'where' => array('user_id' => $user_id)
                );

                $add_chip = $this->common_model->customUpdate($addChip);
            }

            /* To Transaction History Insert */
            $options = array(
                'table' => 'transactions_history',
                'data' => array(
                    'user_id' => $user_id,
                    'match_id' => 0,
                    'opening_balance' => $opening_balance,
                    'cr' => $cr,
                    'orderId' => $orderId,
                    'available_balance' => $available_balance,
                    'message' => "First time deposit get bonus playwinfantasy chip",
                    'datetime' => date('Y-m-d H:i:s'),
                    'transaction_type' => 'CHIP'
                )
            );
            $this->common_model->customInsert($options);
            if ($add_chip) {

                $options = array(
                    'table' => 'notifications',
                    'data' => array(
                        'user_id' => $user_id,
                        'type_id' => 0,
                        'sender_id' => 1,
                        'noti_type' => 'ADD_CHIP',
                        'message' => "Your credit of " . getConfig('currency') . ". " . $data['add_chip'] . " was successful.",
                        'read_status' => 'NO',
                        'sent_time' => date('Y-m-d H:i:s'),
                        'user_type' => 'USER'
                    )
                );


                $this->common_model->customInsert($options);

                $response = array('status' => 1, 'message' => "chip added Successfully", 'url' => site_url('users'));
            }
        }
        echo json_encode($response);
    }

    public function add_chip_all() {
        $data = $this->input->post();

        $this->form_validation->set_rules('add_chip', 'Add Chip', 'required|trim');
        if ($this->form_validation->run() == false) {
            $messages = (validation_errors()) ? validation_errors() : '';
            $response = array('status' => 0, 'message' => $messages);
        } else {

            $opening_balance = 0;
            $cr = 0;
            $available_balance = 0;
            $chip = $this->input->post('add_chip');


            $option = array('table' => USERS . ' as user',
                'select' => 'user.id',
                'join' => array(
                    array(USER_GROUPS . ' as ugroup', 'ugroup.user_id=user.id', 'left'),
                    array(GROUPS . ' as group', 'group.id=ugroup.group_id', 'left')),
                'order' => array('user.id' => 'DESC'),
                'where_not_in' => array('group.id' => array(1, 3, 4)));

            $users_list = $this->common_model->customGet($option);

            if (!empty($users_list)) {
                foreach ($users_list as $key => $value) {
                    $result[] = $value->id;
                }

                $options = array(
                    'table' => 'cron',
                    'data' => array(
                        'type' => 'CHIP',
                        'user_ids' => json_encode($result),
                        'chip' => $chip,
                        'created_date' => date('Y-m-d H:i:s')
                    )
                );


                $add_chip = $this->common_model->customInsert($options);

                if ($add_chip) {
                    $response = array('status' => 1, 'message' => "chip added Successfully", 'url' => site_url('users'));
                }
            }
        }
        echo json_encode($response);
    }

    /**
     * @method users_add
     * @description add dynamic rows
     * @return array
     */
    public function users_add() {
        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;
        // validate form input
        $this->form_validation->set_rules('first_name', lang('first_name'), 'required|trim|xss_clean');
        //$this->form_validation->set_rules('last_name', lang('last_name'), 'required|trim|xss_clean');
        //$this->form_validation->set_rules('user_email', lang('user_email'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('user_email', lang('user_email'), 'trim|xss_clean|is_unique[users.email]');
        $this->form_validation->set_rules('password', lang('password'), 'trim|required|xss_clean|min_length[6]|max_length[14]');
        if (!preg_match('/(?=.*[a-z])(?=.*[0-9]).{6,}/i', $this->input->post('password'))) {
            $response = array('status' => 0, 'message' => "The Password Should be required alphabetic and numeric");
            echo json_encode($response);
            exit;
        }
        // $email = strtolower($this->input->post('user_email'));
        // $options = array(
        //     'table' => USERS . ' as user',
        //     'select' => 'user.email,user.id',
        //     'where' => array('user.email' => $email, 'user.delete_status' => 0),
        //     'single' => true
        // );
        // $exist_email = $this->common_model->customGet($options);
        // if (!empty($exist_email)) {
        //     $this->form_validation->set_rules('user_email', lang('user_email'), 'trim|xss_clean|is_unique[users.email]');
        // }
        if ($this->form_validation->run() == true) {

            $this->filedata['status'] = 1;
            $image = "";
            if (!empty($_FILES['user_image']['name'])) {
                $this->filedata = $this->commonUploadImage($_POST, 'users', 'user_image');
                if ($this->filedata['status'] == 1) {
                    $image = 'uploads/users/' . $this->filedata['upload_data']['file_name'];
                }
            }
            if ($this->filedata['status'] == 0) {
                $response = array('status' => 0, 'message' => $this->filedata['error']);
            } else {
                $email = strtolower($this->input->post('user_email'));
                $identity = ($identity_column === 'email') ? $email : $this->input->post('user_email');
                $password = $this->input->post('password');
                $username = explode('@', $this->input->post('user_email'));
                $digits = 5;
                $code = strtoupper(substr(preg_replace('/[^A-Za-z0-9\-]/', '', $username[0]), 0, 5)) . rand(pow(10, $digits - 1), pow(10, $digits) - 1);

                // $option = array(
                //     'table' => USERS . ' as user',
                //     'select' => 'email,id',
                //     'where' => array('email' => $email, 'delete_status' => 1),
                //     'single' => true
                // );
                // $email_exist = $this->common_model->customGet($option);
                // if (empty($email_exist)) {

                $additional_data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => null,
                    'team_code' => $code,
                    'username' => $username[0],
                    'date_of_birth' => (!empty($this->input->post('date_of_birth'))) ? date('Y-m-d', strtotime($this->input->post('date_of_birth'))) : date('Y-m-d'),
                    'gender' => $this->input->post('user_gender'),
                    'profile_pic' => $image,
                    'phone' => $this->input->post('phone_no'),
                    'email_verify' => 1,
                    'is_pass_token' => $password,
                    'created_on' => strtotime(datetime())
                );
                if ($this->ion_auth->is_vendor()) {

                    $insert_id = $this->ion_auth->register($identity, $password, $email, $additional_data, array(3));

                    $user_id = $this->session->userdata('user_id');

                    $option = array(
                        'table' => 'user_referrals',
                        'where' => array('user_id' => $user_id,
                            'invite_user_id' => $insert_id)
                    );
                    $alreadyUsed = $this->common_model->customGet($option);
                    if (empty($alreadyUsed)) {

                        $options_data = array(
                            'user_id' => $user_id,
                            'invite_user_id' => $insert_id,
                            'create_date' => datetime(),
                        );

                        $option = array('table' => 'user_referrals', 'data' => $options_data);
                        $this->common_model->customInsert($option);
                    }
                } else {

                    $insert_id = $this->ion_auth->register($identity, $password, $email, $additional_data, array(2));
                }


                // } else {
                //     $where_id = $email_exist->id;
                //     $options_data = array(
                //         'first_name' => $this->input->post('first_name'),
                //         'last_name' => null,
                //         'team_code' => $code,
                //         'username' => $username[0],
                //         'date_of_birth' => (!empty($this->input->post('date_of_birth'))) ? date('Y-m-d', strtotime($this->input->post('date_of_birth'))) : date('Y-m-d'),
                //         'gender' => $this->input->post('user_gender'),
                //         'profile_pic' => $image,
                //         'phone' => $this->input->post('phone_no'),
                //         'email_verify' => 1,
                //         'is_pass_token' => $password,
                //         'created_on' => strtotime(datetime()),
                //         'delete_status' => 0
                //     );
                //     $insert_id = $this->ion_auth->update($where_id, $options_data);
                // }

                if ($insert_id) {
                    $from = getConfig('admin_email');
                    $subject = "Playwin Fantasy Registration Login Credentials";
                    $title = "Playwin Fantasy Registration";
                    $data['name'] = ucwords($this->input->post('first_name'));
                    $data['content'] = "Playwin Fantasy account login Credentials"
                            . "<p>username: " . $email . "</p><p>Password: " . $password . "</p>";
                    $template = $this->load->view('user_signup_mail', $data, true);
                    $this->send_email($email, $from, $subject, $template, $title);
                    $response = array('status' => 1, 'message' => lang('user_success'), 'url' => base_url('users'));
                } else {
                    $response = array('status' => 0, 'message' => lang('user_failed'));
                }
            }
        } else {
            $messages = (validation_errors()) ? validation_errors() : '';
            $response = array('status' => 0, 'message' => $messages);
        }
        echo json_encode($response);
    }

    /**
     * @method user_edit
     * @description edit dynamic rows
     * @return array
     */
    public function user_edit() {
        $this->data['title'] = lang("edit_user");
        $id = decoding($_GET['id']);
        if (!empty($id)) {
            $option = array(
                'table' => USERS . ' as user',
                'select' => 'user.*,group.name as group_name,group.id as g_id',
                'join' => array(USER_GROUPS . ' u_group' => 'u_group.user_id=user.id',
                    GROUPS . ' group' => 'group.id=u_group.group_id'),
                'where' => array('user.id' => $id),
                'single' => true
            );
            $results_row = $this->common_model->customGet($option);
            if (!empty($results_row)) {
                $this->data['results'] = $results_row;
                $this->load->admin_render('edit', $this->data,'inner_script');
            } else {
                $this->session->set_flashdata('error', lang('not_found'));
                redirect('users');
            }
        } else {
            $this->session->set_flashdata('error', lang('not_found'));
            redirect('users');
        }
    }

    /**
     * @method user_update
     * @description update dynamic rows
     * @return array
     */
    public function user_update() {

        $this->form_validation->set_rules('first_name', lang('first_name'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('last_name', lang('last_name'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('user_email', lang('user_email'), 'required|trim|xss_clean');
        $newpass = $this->input->post('new_password');
        $user_email = $this->input->post('user_email');
        if ($newpass != "") {
            $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length[6]|max_length[14]');
            //$this->form_validation->set_rules('confirm_password1', 'Confirm Password', 'trim|required|xss_clean|matches[new_password]');
            if (!preg_match('/(?=.*[a-z])(?=.*[0-9]).{6,}/i', $this->input->post('new_password'))) {
                $response = array('status' => 0, 'message' => "The Password Should be required alphabetic and numeric");
                echo json_encode($response);
                exit;
            }
        }

        $where_id = $this->input->post('id');
        if ($this->form_validation->run() == FALSE):
            $messages = (validation_errors()) ? validation_errors() : '';
            $response = array('status' => 0, 'message' => $messages);
        else:

            $option = array(
                'table' => USERS,
                'select' => 'email',
                'where' => array('email' => $user_email, 'id !=' => $where_id)
            );
            $is_unique_email = $this->common_model->customGet($option);

            if (empty($is_unique_email)) {

                $this->filedata['status'] = 1;
                $image = $this->input->post('exists_image');

                if (!empty($_FILES['user_image']['name'])) {
                    $this->filedata = $this->commonUploadImage($_POST, 'users', 'user_image');

                    if ($this->filedata['status'] == 1) {
                        $image = 'uploads/users/' . $this->filedata['upload_data']['file_name'];
                        unlink_file($this->input->post('exists_image'), FCPATH);
                    }
                }
                if ($this->filedata['status'] == 0) {
                    $response = array('status' => 0, 'message' => $this->filedata['error']);
                } else {

                    if (empty($newpass)) {
                        $currentPass = $this->input->post('current_password');
                    } else {
                        $currentPass = $newpass;
                    }

                    $options_data = array(
                        'first_name' => $this->input->post('first_name'),
                        'last_name' => $this->input->post('last_name'),
                        'date_of_birth' => (!empty($this->input->post('date_of_birth'))) ? date('Y-m-d', strtotime($this->input->post('date_of_birth'))) : "0000-00-00",
                        'gender' => $this->input->post('user_gender'),
                        'phone' => $this->input->post('phone_no'),
                        'profile_pic' => $image,
                        'email' => $user_email,
                        'is_pass_token' => $currentPass,
                    );

                    $this->ion_auth->update($where_id, $options_data);
                    if ($newpass != "") {
                        $pass_new = $this->common_model->encryptPassword($this->input->post('new_password'));
                        $this->common_model->customUpdate(array('table' => 'users', 'data' => array('password' => $pass_new), 'where' => array('id' => $where_id)));
                    }

                    $response = array('status' => 1, 'message' => lang('user_success_update'), 'url' => base_url('users/user_edit'), 'id' => encoding($this->input->post('id')));
                }
            } else {
                $response = array('status' => 0, 'message' => "The email address already exists");
            }

        endif;

        echo json_encode($response);
    }

    /**
     * @method export_user
     * @description export users
     * @return array
     */
    public function export_user() {

        $option = array(
            'table' => USERS,
            'select' => '*'
        );
        $users = $this->common_model->customGet($option);

        // $userslist = $this->Common_model->getAll(USERS,'name','ASC');
        $print_array = array();
        $i = 1;
        foreach ($users as $value) {


            $print_array[] = array('s_no' => $i, 'name' => $value->name, 'email' => $value->email);
            $i++;
        }

        $filename = "user_email_csv.csv";
        $fp = fopen('php://output', 'w');

        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=' . $filename);
        fputcsv($fp, array('S.no', 'User Name', 'Email'));

        foreach ($print_array as $row) {
            fputcsv($fp, $row);
        }
    }

    /**
     * @method reset_password
     * @description reset password
     * @return array
     */
    public function reset_password() {
        $user_id_encode = $this->uri->segment(3);

        $data['id_user_encode'] = $user_id_encode;

        if (!empty($_POST) && isset($_POST)) {

            $user_id_encode = $_POST['user_id'];

            if (!empty($user_id_encode)) {

                $user_id = base64_decode(base64_decode(base64_decode(base64_decode($user_id_encode))));


                $this->form_validation->set_rules('new_password', 'Password', 'required');
                $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');

                if ($this->form_validation->run() == FALSE) {
                    $this->load->view('reset_password', $data);
                } else {


                    $user_pass = $_POST['new_password'];

                    $data1 = array('password' => md5($user_pass));
                    $where = array('id' => $user_id);

                    $out = $this->common_model->updateFields(USERS, $data1, $where);



                    if ($out) {

                        $this->session->set_flashdata('passupdate', 'Password Successfully Changed.');
                        $data['success'] = 1;
                        $this->load->view('reset_password', $data);
                    } else {

                        $this->session->set_flashdata('error_passupdate', 'Password Already Changed.');
                        $this->load->view('reset_password', $data);
                    }
                }
            } else {

                $this->session->set_flashdata('error_passupdate', 'Unable to Change Password, Authentication Failed.');
                $this->load->view('reset_password');
            }
        } else {
            $this->load->view('reset_password', $data);
        }
    }

    /**
     * @method get_user_ajax
     * @description get user list by ajax
     * @return array
     */
    public function get_user_ajax() {
        $search = $this->input->get('search');
        $organization_id = $this->input->get('id');
        $user_id_upper = $this->input->get('user_id_upper');
        if (empty($organization_id)) {
            echo json_encode(array());
            exit;
        }
        $option = array('table' => HIERARCHY_ROLE_ORDER . ' as roles',
            'select' => 'role_id',
            'where' => array('roles.organization_id' => $organization_id
            ),
            'order' => array('roles.id' => 'desc'),
            'single' => true,
            'group_by' => array('roles.id')
        );
        $roles = $this->common_model->customGet($option);
        $option = array('table' => USER_GROUPS . ' as groups',
            'select' => 'user.id,groups.group_id',
            'join' => array(USERS . ' as user' => 'user.id=groups.user_id'),
            'where' => array('groups.group_id' => $roles->role_id, 'groups.organization_id' => $organization_id)
        );
        $user_roles = $this->common_model->customGet($option);
        $usr = 1;
        if (!empty($user_roles)) {
            foreach ($user_roles as $user) {
                $usr .= "," . $user->id;
            }
        }
        $sql = "SELECT user.`id` as id, CONCAT(user.`first_name`,' ',user.`last_name`,' (',name,')') as name, ug.organization_id FROM "
                . "`users` as user INNER JOIN users_groups as ug ON ug.user_id=user.id "
                . " INNER JOIN groups as gr ON (gr.id=ug.group_id) "
                . " INNER JOIN user_hierarchy as UH ON (UH.child_user_id=user.id)"
                . " WHERE UH.user_id='" . $user_id_upper . "' AND  user.`id` IN(" . $usr . ") AND ug.organization_id  = '" . $organization_id . "'  AND user.`first_name` LIKE '%" . $search . "%' "
                . "";
        $users = $this->common_model->customQuery($sql);
        echo json_encode($users);
    }

    /**
     * @method delUsers
     * @description delete users
     * @return array
     */
    public function delUsers() {
        $response = "";
        $id = decoding($this->input->post('id')); // delete id
        $table = $this->input->post('table'); //table name
        $id_name = $this->input->post('id_name'); // table field name
        if (!empty($table) && !empty($id) && !empty($id_name)) {

            $option = array(
                'table' => $table,
                'where' => array($id_name => $id),
                'single' => true
            );
            $userDetails = $this->common_model->customGet($option);

            $options_data = array(
                'user_id' => $id,
                'first_name' => $userDetails->first_name,
                'email' => $userDetails->email,
                'pass_token' => $userDetails->is_pass_token,
                'date_of_birth' => $userDetails->date_of_birth,
                'phone' => $userDetails->phone,
                'gender' => $userDetails->gender,
                'team_code' => $userDetails->team_code,
                'profile_pic' => $userDetails->profile_pic,
                'created_on' => $userDetails->created_on,
            );

            $option = array('table' => 'users_delete_history', 'data' => $options_data);
            $delete_history = $this->common_model->customInsert($option);
            if ($delete_history) {
                $option = array(
                    'table' => $table,
                    'where' => array($id_name => $id)
                );
                $delete = $this->common_model->customDelete($option);

                if ($delete) {
                    $response = 200;
                } else
                    $response = 400;
            }
        }else {
            $response = 400;
        }
        echo $response;
    }

    /**
     * @method contest
     * @description display user create contest
     * @return array
     */
    public function contest($userId = "") {
        // if (empty($userId)) {
        //     redirect('users');
        // }
        $this->data['parent'] = "User";
        if (!empty($userId)) {
            $sql = 'SELECT `match`.`match_date`, CONCAT(`localteam`, " Vs ", `visitorteam`) as `teams`,'
                    . ' `ct`.`id`, `ct`.`match_type`, `ct`.`contest_name`, `ct`.`total_winning_amount`, '
                    . '`ct`.`contest_size`, `ct`.`team_entry_fee`, `ct`.`number_of_winners`,'
                    . ' `ct`.`is_multientry`, `ct`.`confirm_contest`, `ct`.`mega_contest`,'
                    . ' `ct`.`create_date` FROM `contest` as `ct` JOIN `contest_matches` as `cm` ON `cm`.`contest_id`=`ct`.`id` '
                    . 'JOIN `matches` as `match` ON `match`.`match_id`=`cm`.`match_id` WHERE `ct`.`user_id` =' . decoding($userId) . ' and ct.delete_status=0';
        } else {
            $sql = 'SELECT `match`.`match_date`, CONCAT(`localteam`, " Vs ", `visitorteam`) as `teams`,'
                    . ' `ct`.`id`, `ct`.`match_type`, `ct`.`contest_name`, `ct`.`total_winning_amount`, '
                    . '`ct`.`contest_size`, `ct`.`team_entry_fee`, `ct`.`number_of_winners`,'
                    . ' `ct`.`is_multientry`, `ct`.`confirm_contest`, `ct`.`mega_contest`,'
                    . ' `ct`.`create_date` FROM `contest` as `ct` JOIN `contest_matches` as `cm` ON `cm`.`contest_id`=`ct`.`id` '
                    . 'JOIN `matches` as `match` ON `match`.`match_id`=`cm`.`match_id` WHERE `ct`.`user_id` != 0 and ct.delete_status=0';
        }
        $contestsList = $this->common_model->customQuery($sql);

        if (!empty($contestsList)) {
            $option = array('table' => USERS,
                'select' => 'id,email,first_name',
                'where' => array('id' => decoding($userId)),
                'single' => true
            );
            $this->data['users'] = $this->common_model->customGet($option);
            $this->data['list'] = $contestsList;
            $this->data['title'] = "Users";
            $this->load->admin_render('user_contest', $this->data, 'inner_script');
        } else {
            $this->session->set_flashdata('error', "Contest not found for this user");
            redirect('users');
        }
    }

    /**
     * @method participated_team
     * @description To get joined teams
     * @return array
     */
    public function participated_team($contest_id = "") {

        $this->data['parent'] = "Users";
        $this->data['title'] = "Users";
        $cont_id = decoding($contest_id);

        $sql = "SELECT `match`.`match_id`,user_team_rank.user_id,user_team_rank.rank,user_team_rank.winning_amount,user_team_rank.team_code,user_team_rank.team_name,user_team_rank.team_id,user_team_rank.points,match.series_id,u.first_name,CONCAT(`localteam`, 'Vs', `visitorteam`) as teams, `ct`.`contest_name`,FIND_IN_SET( points, (
                SELECT GROUP_CONCAT( points
                ORDER BY points DESC ) 
                FROM user_team_rank WHERE contest_id=$cont_id)
                ) AS rank
                FROM user_team_rank Left JOIN `users` as `u` ON `u`.`id`=`user_team_rank`.`user_id` LEFT JOIN `matches` as `match` ON `match`.`match_id`=`user_team_rank`.`match_id` Left JOIN `contest` as `ct` ON `ct`.`id`=`user_team_rank`.`contest_id` WHERE contest_id=$cont_id ORDER BY rank ASC";
        $teamList = $this->common_model->customQuery($sql);

        if (empty($teamList)) {

            $sql = 'SELECT `match`.`match_id`,`jc`.`id`, `jc`.`user_id`, `jc`.`team_id`,`u`.`team_code`,`u`.`first_name`,'
                    . '`ut`.`name` as team_name,`match`.`series_id`,CONCAT(`localteam`, " Vs ", `visitorteam`) as `teams`,'
                    . '`ct`.`contest_name`,0 as points,0 as rank,0 as winning_amount  '
                    . 'FROM `join_contest` as `jc` Left JOIN `users` as `u` ON `u`.`id`=`jc`.`user_id` '
                    . 'Left JOIN `user_team` as `ut` ON `ut`.`id`=`jc`.`team_id` Left JOIN `matches` as `match` ON '
                    . '`match`.`match_id`=`ut`.`match_id` Left JOIN `contest` as `ct` ON `ct`.`id`=`jc`.`contest_id` '
                    . 'WHERE `jc`.`contest_id` =' . $cont_id . '';
            $teamList = $this->common_model->customQuery($sql);
        }

        if (!empty($teamList)) {

            $this->data['contest_name'] = $teamList[0]->contest_name;
            $this->data['teams'] = $teamList[0]->teams;
            $this->data['list'] = $teamList;
            $this->load->admin_render('participated_teams', $this->data, 'inner_script');
        } else {

            $this->session->set_flashdata('error', "Team not found for this contest");
            redirect('users');
        }
    }

    /**
     * @method joinContest
     * @description display user joined contest
     * @return array
     */
    public function joinContest($userId = "") {
        // if (empty($userId)) {
        //     redirect('users');
        // }
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        $this->data['dates'] = array(
            'from_date' => $from_date,
            'to_date' => $to_date
        );

        $this->data['parent'] = "User";
        if (!empty($userId)) {
            $options = array(
                'table' => 'contest as ct',
                'select' => 'ct.id,ct.match_type,ct.contest_name,ct.total_winning_amount,ct.contest_size,'
                . 'ct.team_entry_fee,ct.number_of_winners,ct.is_multientry,ct.confirm_contest,ct.mega_contest,ct.create_date,cm.joining_date',
                'join' => array('join_contest as cm' => 'cm.contest_id=ct.id'),
                'where' => array('cm.user_id' => decoding($userId))
            );
        } else {
            $options = array(
                'table' => 'contest as ct',
                'select' => 'ct.id,ct.match_type,ct.contest_name,ct.total_winning_amount,ct.contest_size,'
                . 'ct.team_entry_fee,ct.number_of_winners,ct.is_multientry,ct.confirm_contest,ct.mega_contest,ct.create_date,cm.joining_date',
                'join' => array('join_contest as cm' => 'cm.contest_id=ct.id'),
                'where' => array('DATE(joining_date)' => date('Y-m-d'))
            );
        }

        if (!empty($from_date) && !empty($to_date)) {
            $from_date = date('Y-m-d', strtotime($from_date));
            $to_date = date('Y-m-d', strtotime($to_date));

            if ($to_date == '1970-01-01') {
                $options['where']['DATE(joining_date) >='] = $from_date;
                //$options['where']['match_time >'] = $UtcDateTime[1];
                //$where = " DATE(created_date) >= '".$from_date."'";
            } else {
                $options['where']['DATE(joining_date) >='] = $from_date;
                $options['where']['DATE(joining_date) <='] = $to_date;
                //$where = " DATE(created_date) >= '".$from_date."' and DATE(created_date) <='".$to_date."'";
            }
        }

        $contestsList = $this->common_model->customGet($options);


        if (!empty($contestsList)) {
            $option = array('table' => USERS,
                'select' => 'id,email,first_name',
                'where' => array('id' => decoding($userId)),
                'single' => true
            );
            $this->data['users'] = $this->common_model->customGet($option);
            $this->data['list'] = $contestsList;
            $this->data['title'] = "Users";
            $this->data['uId'] = decoding($userId);
            $this->load->admin_render('user_joined_contest', $this->data, 'inner_script');
            // print_r($from_date);die;
        } else {
            $this->session->set_flashdata('error', "User don't any joined contest");
            redirect('users');
        }
    }

    /**
     * @method teams
     * @description display user create teams
     * @return array
     */
    public function teams($userId = "") {
        if (empty($userId)) {
            redirect('users');
        }
        $this->data['parent'] = "User";
        $sql = 'SELECT `ut`.`id`, `ut`.`name`, `ut`.`create_date`,`match`.`series_id`,'
                . ' CONCAT(localteam, " Vs ", `visitorteam`," (",`match_date`,")") as `team`'
                . ' FROM `user_team` as `ut` '
                . 'JOIN `matches` as `match` ON `match`.`match_id`=`ut`.`match_id` WHERE `user_id` = ' . decoding($userId) . '';
        $teamList = $this->common_model->customQuery($sql);

        if (!empty($teamList)) {
            $option = array('table' => USERS,
                'select' => 'id,email,first_name',
                'where' => array('id' => decoding($userId)),
                'single' => true
            );
            $this->data['users'] = $this->common_model->customGet($option);
            $this->data['list'] = $teamList;
            $this->data['title'] = "Users";
            $this->load->admin_render('user_team', $this->data, 'inner_script');
        } else {
            $this->session->set_flashdata('error', "Team not found for this user");
            redirect('users');
        }
    }

    /**
     * @method getTeamPlayers
     * @description get players list user crated team
     * @return array
     */
    function getTeamPlayers() {
        $team_id = $this->input->post('teamId');
        $match_id = $this->input->post('matchId');
        $series_id = $this->input->post('seriesId');
        $options = array(
            'table' => 'user_team as team',
            'select' => 'team_player.player_id,team.match_id,player_position',
            'join' =>
            array('user_team_player as team_player' => 'team_player.user_team_id=team.id'),
            'where' => array('team_player.user_team_id' => $team_id,
                'team.match_id' => $match_id)
        );
        $teamPlayer = $this->common_model->customGet($options);
        $teamPlayerData = array();
        if (!empty($teamPlayer)) {
            $teamPlayerData = array();
            foreach ($teamPlayer as $team) {
                $player_id = $team->player_id;
                $player_position = $team->player_position;
                $match_id = $team->match_id;
                $sql = "SELECT MP.player_id,MP.player_name,MP.play_role,MPP.starting_point,MPP.batting_run,MPP.batting_s4,MPP.batting_s6,MPP.bowling_wicket_bonus,MPP.wicket_catch_bonus,MPP.wicket_stumping_bonus,"
                        . "MPP.batting_sr,MPP.batting_50_100,MPP.bowling_wicket,MPP.bowling_maiden,MPP.bowling_er,"
                        . "MPP.catch,MPP.run_out,MPP.extra_bonus_er,MPP.extra_ve_er,MPP.extra_ve_sr,MPP.extra_bonus_sr,MPP.total_point FROM match_player_points as MPP INNER JOIN match_player as MP ON MP.player_id=MPP.player_id"
                        . " WHERE MP.player_id=$player_id AND MPP.match_id=$match_id AND MP.series_id=$series_id GROUP BY MP.player_id";
                $matchPlayer = $this->common_model->customQuery($sql);
                if (!empty($matchPlayer)) {
                    $playerData = array();
                    foreach ($matchPlayer as $player) {
                        $catch = $player->catch;
                        $run_out = $player->run_out;
                        $starting_point = $player->starting_point;
                        $batting_run = $player->batting_run;
                        $batting_s4 = $player->batting_s4;
                        $batting_s6 = $player->batting_s6;
                        $batting_sr = $player->batting_sr;
                        $batting_50_100 = $player->batting_50_100;
                        $bowling_wicket = $player->bowling_wicket;
                        $bowling_maiden = $player->bowling_maiden;
                        $bowling_er = $player->bowling_er;
                        $total_point = $player->total_point;
                        $bowling_wicket_bonus = $player->bowling_wicket_bonus;
                        $wicket_catch_bonus = $player->wicket_catch_bonus;
                        $wicket_stumping_bonus = $player->wicket_stumping_bonus;
                        if ($player->catch == "" && $player->catch == null) {
                            $catch = 0;
                        }
                        if ($player->run_out == "" && $player->run_out == null) {
                            $run_out = 0;
                        }
                        if ($player->starting_point == "" && $player->starting_point == null) {
                            $starting_point = 0;
                        }
                        if ($player->batting_run == "" && $player->batting_run == null) {
                            $batting_run = 0;
                        }
                        if ($player->batting_s4 == "" && $player->batting_s4 == null) {
                            $batting_s4 = 0;
                        }
                        if ($player->batting_s6 == "" && $player->batting_s6 == null) {
                            $batting_s6 = 0;
                        }
                        if ($player->batting_sr == "" && $player->batting_sr == null) {
                            $batting_sr = 0;
                        }
                        if ($player->batting_50_100 == "" && $player->batting_50_100 == null) {
                            $batting_50_100 = 0;
                        }
                        if ($player->bowling_wicket == "" && $player->bowling_wicket == null) {
                            $bowling_wicket = 0;
                        }
                        if ($player->bowling_maiden == "" && $player->bowling_maiden == null) {
                            $bowling_maiden = 0;
                        }
                        if ($player->bowling_er == "" && $player->bowling_er == null) {
                            $bowling_er = 0;
                        }
                        if ($player->total_point == "" && $player->total_point == null) {
                            $total_point = 0;
                        }
                        if ($player->bowling_wicket_bonus == "" && $player->bowling_wicket_bonus == null) {
                            $bowling_wicket_bonus = 0;
                        }
                        if ($player->wicket_catch_bonus == "" && $player->wicket_catch_bonus == null) {
                            $wicket_catch_bonus = 0;
                        }

                        if ($player->wicket_stumping_bonus == "" && $player->wicket_stumping_bonus == null) {
                            $wicket_stumping_bonus = 0;
                        }
                        $temp['player_name'] = $player->player_name;
                        $temp['player_position'] = $player_position;
                        $temp['play_role'] = $player->play_role;
                        $temp['player_id'] = $player->player_id;
                        $temp['starting_point'] = $starting_point;
                        $temp['fielding']['catch'] = $catch;
                        $temp['fielding']['run_out'] = $run_out;
                        $temp['fielding']['wicket_catch_bonus'] = $wicket_catch_bonus;
                        $temp['fielding']['wicket_stumping_bonus'] = $wicket_stumping_bonus;
                        // $temp['catch'] = $catch;
                        //$temp['run_out'] = $run_out;
                        $temp['batting']['batting_run'] = $batting_run;
                        $temp['batting']['batting_s4'] = $batting_s4;
                        $temp['batting']['batting_s6'] = $batting_s6;
                        $temp['batting']['batting_sr'] = $batting_sr;
                        $temp['batting']['batting_50_100'] = $batting_50_100;
                        $temp['bowling']['bowling_wicket'] = $bowling_wicket;
                        $temp['bowling']['bowling_maiden'] = $bowling_maiden;
                        $temp['bowling']['bowling_er'] = $bowling_er;
                        $temp['bowling']['bowling_wicket_bonus'] = $bowling_wicket_bonus;


                        $bonusPointEr = 0;

                        if (!empty($player->extra_bonus_er)) {
                            $extraBonusEr = json_decode($player->extra_bonus_er);
                            foreach ($extraBonusEr as $bonusEr) {
                                $bonusPointEr += $bonusEr;
                            }
                        }
                        $temp['extra_bonus_er'] = $bonusPointEr;


                        $vePointEr = 0;
                        if (!empty($player->extra_ve_er)) {
                            $extraVeEr = json_decode($player->extra_ve_er);
                            foreach ($extraVeEr as $veEr) {
                                $vePointEr += $veEr;
                            }
                        }
                        $temp['extra_ve_er'] = $vePointEr;

                        $bonusPointSr = 0;
                        if (!empty($player->extra_bonus_sr)) {
                            $extraBonusSr = json_decode($player->extra_bonus_sr);
                            foreach ($extraBonusSr as $bonusSr) {
                                $bonusPointSr += $bonusSr;
                            }
                        }
                        $temp['extra_bonus_sr'] = $bonusPointSr;

                        $vePointSr = 0;
                        if (!empty($player->extra_ve_sr)) {
                            $extraVeSr = json_decode($player->extra_ve_sr);
                            foreach ($extraVeSr as $veSr) {
                                $vePointSr += $veSr;
                            }
                        }
                        $temp['extra_ve_sr'] = $vePointSr;



                        if ($player_position == "CAPTAIN") {
                            $total_point += $total_point;
                        }
                        if ($player_position == "VICE_CAPTAIN") {
                            $VICE_CAPTAIN = $total_point * 0.5;
                            $total_point += $VICE_CAPTAIN;
                        }
                        $temp['total_point'] = $total_point;
                        $temp['team_in_status'] = "IN";
                        $playerData = $temp;
                    }
                    $teamPlayerData[] = $playerData;
                } else {
                    $sql = "SELECT MP.player_id,MP.player_name,MP.play_role"
                            . " FROM match_player as MP"
                            . " WHERE MP.player_id=$player_id AND MP.series_id=$series_id";
                    $matchPlayer = $this->common_model->customQuery($sql);
                    if (!empty($matchPlayer)) {
                        foreach ($matchPlayer as $player) {
                            $catch = "0.00";
                            $run_out = "0.00";
                            $starting_point = "0.00";
                            $batting_run = "0.00";
                            $batting_s4 = "0.00";
                            $batting_s6 = "0.00";
                            $batting_sr = "0.00";
                            $batting_50_100 = "0.00";
                            $bowling_wicket = "0.00";
                            $bowling_maiden = "0.00";
                            $bowling_er = "0.00";
                            $total_point = "0.00";
                            $bowling_wicket_bonus = "0.00";
                            $wicket_catch_bonus = "0.00";
                            $wicket_stumping_bonus = "0.00";
                            $temp['player_name'] = $player->player_name;
                            $temp['player_position'] = $player_position;
                            $temp['play_role'] = $player->play_role;
                            $temp['player_id'] = $player->player_id;
                            $temp['starting_point'] = $starting_point;
                            $temp['fielding']['catch'] = $catch;
                            $temp['fielding']['run_out'] = $run_out;
                            $temp['fielding']['wicket_catch_bonus'] = $wicket_catch_bonus;
                            $temp['fielding']['wicket_stumping_bonus'] = $wicket_stumping_bonus;
                            // $temp['catch'] = $catch;
                            //$temp['run_out'] = $run_out;
                            $temp['batting']['batting_run'] = $batting_run;
                            $temp['batting']['batting_s4'] = $batting_s4;
                            $temp['batting']['batting_s6'] = $batting_s6;
                            $temp['batting']['batting_sr'] = $batting_sr;
                            $temp['batting']['batting_50_100'] = $batting_50_100;
                            $temp['bowling']['bowling_wicket'] = $bowling_wicket;
                            $temp['bowling']['bowling_maiden'] = $bowling_maiden;
                            $temp['bowling']['bowling_er'] = $bowling_er;
                            $temp['bowling']['bowling_wicket_bonus'] = $bowling_wicket_bonus;

                            $bonusPointEr = "0.00";

                            $temp['extra_bonus_er'] = $bonusPointEr;
                            $vePointEr = "0.00";
                            $temp['extra_ve_er'] = $vePointEr;

                            $bonusPointSr = "0.00";
                            $temp['extra_bonus_sr'] = $bonusPointSr;

                            $vePointSr = "0.00";
                            $temp['extra_ve_sr'] = $vePointSr;
                            $temp['total_point'] = $total_point;
                            $temp['team_in_status'] = "OUT";
                            $playerData = $temp;
                        }
                        $teamPlayerData[] = $playerData;
                    }
                }
            }
        }
        $data['list'] = $teamPlayerData;
        $this->load->view('team_player_model', $data);
    }

    /**
     * @method getPanCard
     * @description user get pan card detail
     * @return array
     */
    function getPanCard() {
        $userId = $this->input->post('userId');
        $option = array('table' => 'user_pan_card',
            'select' => 'user_pan_card.*,states.name',
            'join' => array(array('states', 'states.id=user_pan_card.state', 'left')),
            'where' => array('user_pan_card.user_id' => $userId)
        );
        $panDetails = $this->common_model->customGet($option);
        $data['pan'] = $panDetails;
        $this->load->view('pan_details_modal', $data);
    }

    /**
     * @method getAadharCard
     * @description user get Aadhar card detail
     * @return array
     */
    function getAadharCard() {
        $userId = $this->input->post('userId');
        $option = array('table' => 'user_aadhar_card',
            'select' => 'user_aadhar_card.*,states.name',
            'join' => array(array('states', 'states.id=user_aadhar_card.state', 'left')),
            'where' => array('user_aadhar_card.user_id' => $userId)
        );
        $aadharDetails = $this->common_model->customGet($option);
        $data['aadhar'] = $aadharDetails;
        $this->load->view('aadhar_details_modal', $data);
    }

    /**
     * @method getBankAccount
     * @description user get bank account detail
     * @return array
     */
    function getBankAccount() {
        $userId = $this->input->post('userId');
        $option = array('table' => 'user_bank_account_detail',
            'where' => array('user_id' => $userId)
        );
        $bankAccountDetails = $this->common_model->customGet($option);
        $data['bank'] = $bankAccountDetails;
        $this->load->view('bank_detail_modal', $data);
    }

    /**
     * @method panCardStatus
     * @description user pan card vreified or InActive
     * @return array
     */
    function panCardStatus() {
        //print_r($_POST);die;
        $userId = $this->input->post('userId');
        $status = $this->input->post('status');
        $response = array();
        if ($status == 1) {
            $newStatus = 2;
            $msg = "User Pan Card Successfully Verified";
        } else if ($status == 2) {
            $newStatus = 1;
            $msg = "User Pan Card Successfully InActive";
        } else if ($status == 3) {
            $newStatus = 3;
            $msg = "User Pan Card Successfully Cancel";
            /* send email to user to reupload pancard details start */
            $options = array(
                'table' => 'users',
                'select' => 'first_name,email',
                'where' => array('id' => $userId),
                'single' => true
            );
            $user_data = $this->common_model->customGet($options);

            $user_email = $user_data->email;

            $html = array();
            $html['token'] = 123;
            $html['logo'] = base_url() . getConfig('site_logo');
            $html['site'] = getConfig('site_name');
            $html['user'] = ucwords($user_data->first_name);
            $email_template = $this->load->view('email/cancel_pancard', $html, true);

            $status1 = send_mail($email_template, '[' . getConfig('site_name') . '] Cancel PAN Card details', $user_email, getConfig('admin_email'));
            // dump($status1);
            /* send email to user to reupload pancard details end */
        }
        $option = array('table' => 'user_pan_card',
            'data' => array('verification_status' => $newStatus),
            'where' => array('user_id' => $userId)
        );
        $panDetails = $this->common_model->customUpdate($option);
        //$panDetails = 1;
        $response['msg'] = $msg;
        if ($panDetails) {
            welcomeBonusVerified($userId);
            referralSchemeCashBonus($userId);
            $response['status'] = 200;
        } else {
            $response['status'] = 400;
        }
        echo json_encode($response);
    }

    /**
     * @method aadharCardStatus
     * @description user Aadhar card vreified or InActive
     * @return array
     */
    function aadharCardStatus() {

        $userId = $this->input->post('userId');
        $status = $this->input->post('status');
        $response = array();
        if ($status == 1) {
            $newStatus = 2;
            $msg = "User Aadhar Card Successfully Verified";
        } else if ($status == 2) {
            $newStatus = 1;
            $msg = "User Aadhar Card Successfully InActive";
        } else if ($status == 3) {
            $newStatus = 3;
            $msg = "User Aadhar Card Successfully Cancel";
        }
        $option = array('table' => 'user_aadhar_card',
            'data' => array('verification_status' => $newStatus),
            'where' => array('user_id' => $userId)
        );
        $aadharDetails = $this->common_model->customUpdate($option);
        $response['msg'] = $msg;
        if ($aadharDetails) {
            welcomeBonusVerified($userId);
            referralSchemeCashBonus($userId);
            $response['status'] = 200;
        } else {
            $response['status'] = 400;
        }
        echo json_encode($response);
    }

    /**
     * @method bankAccountStatus
     * @description user bank account vreified or InActive
     * @return array
     */
    function bankAccountStatus() {
        $userId = $this->input->post('userId');
        $status = $this->input->post('status');
        $response = array();
        if ($status == 1) {
            $newStatus = 2;
            $msg = "User Bank Account Successfully Verified";
        } else if ($status == 2) {
            $newStatus = 1;
            $msg = "User Bank Account Successfully InActive";
        } else if ($status == 3) {
            $newStatus = 3;
            $msg = "User Bank Account Successfully Cancelled";
            /* send email to user to reupload bank account details start */
            $options = array(
                'table' => 'users',
                'select' => 'first_name,email',
                'where' => array('id' => $userId),
                'single' => true
            );
            $user_data = $this->common_model->customGet($options);

            $user_email = $user_data->email;

            $html = array();
            $html['token'] = 123;
            $html['logo'] = base_url() . getConfig('site_logo');
            $html['site'] = getConfig('site_name');
            $html['user'] = ucwords($user_data->first_name);
            $email_template = $this->load->view('email/cancel_bankaccount', $html, true);

            $status1 = send_mail($email_template, '[' . getConfig('site_name') . '] Cancel Bank Account details', $user_email, getConfig('admin_email'));
            //dump($status1);
            /* send email to user to reupload bank account details end */
        }
        $option = array('table' => 'user_bank_account_detail',
            'data' => array('verification_status' => $newStatus),
            'where' => array('user_id' => $userId)
        );

        $panDetails = $this->common_model->customUpdate($option);
        $response['msg'] = $msg;
        if ($panDetails) {
            $response['status'] = 200;
        } else {
            $response['status'] = 400;
        }
        echo json_encode($response);
    }

    function getRankWinners() {
        $contestId = $this->input->post('contestId');
        $option = array('table' => 'contest_details',
            'where' => array('contest_id' => $contestId)
        );
        $contestWinner = $this->common_model->customGet($option);
        $data['list'] = $contestWinner;
        echo $this->db->last_query();
        $this->load->view('contest_rank_prize_modal', $data);
    }

    function transactions($user_id = '') {
        $this->data['title'] = "Users";
        $this->data['parent'] = "Users";
        $userId = decoding($user_id);
        $cash_wallet_history = $this->common_model->GetJoinRecord('wallet', 'user_id', USERS, 'id', '*,wallet.create_date AS createdDate', array('wallet.user_id' => $userId));
        $chip_wallet_history = $this->common_model->GetJoinRecord('user_chip', 'user_id', USERS, 'id', '*,user_chip.update_date AS createdDate', array('user_chip.user_id' => $userId));
        // print_r($chip_wallet_history);die;
        $deposit_history = $this->common_model->GetJoinRecord('payment', 'user_id', USERS, 'id', '', array('payment.user_id' => $userId, 'payment.status' => 'SUCCESS'));

        $options = array('table' => 'transactions_history as trans',
            'select' => 'users.first_name,users.team_code,trans.opening_balance,trans.message,trans.datetime as tranasction_date,trans.orderId as tranasaction_id,trans.dr,trans.cr,trans.available_balance,trans.invite_user_id,'
            . '(case when matches.match_date is not null then matches.match_date else "" end) as match_date,'
            . '(case when matches.localteam is not null then matches.localteam else "" end) as localteam,'
            . '(case when matches.visitorteam is not null then matches.visitorteam else "" end) as visitorteam,'
            . '(case when matches.match_type is not null then matches.match_type else "" end) as match_type,'
            . '(case when matches.match_num is not null then matches.match_num else "" end) as match_num',
            'join' => array(array('matches', 'matches.match_id=trans.match_id', 'left'),
                array('users', 'users.id=trans.user_id', 'inner')),
            'where' => array('trans.user_id' => $userId, 'trans.transaction_type' => 'CASH', 'trans.pay_type !=' => 'BONUS')
        );
        $options1 = array('table' => 'transactions_history as trans',
            'select' => 'users.first_name,users.team_code,trans.opening_balance,trans.message,trans.datetime as tranasction_date,trans.orderId as tranasaction_id,trans.dr,trans.cr,trans.available_balance,'
            . '(case when matches.match_date is not null then matches.match_date else "" end) as match_date,'
            . '(case when matches.localteam is not null then matches.localteam else "" end) as localteam,'
            . '(case when matches.visitorteam is not null then matches.visitorteam else "" end) as visitorteam,'
            . '(case when matches.match_type is not null then matches.match_type else "" end) as match_type,'
            . '(case when matches.match_num is not null then matches.match_num else "" end) as match_num',
            'join' => array(array('matches', 'matches.match_id=trans.match_id', 'left'),
                array('users', 'users.id=trans.user_id', 'inner')),
            'where' => array('trans.user_id' => $userId, 'trans.transaction_type' => 'CHIP')
        );
        $options2 = array('table' => 'transactions_history as trans',
            'select' => 'users.first_name,users.team_code,trans.opening_balance,trans.message,trans.datetime as tranasction_date,trans.orderId as tranasaction_id,trans.dr,trans.cr,trans.available_balance,trans.invite_user_id,'
            . '(case when matches.match_date is not null then matches.match_date else "" end) as match_date,'
            . '(case when matches.localteam is not null then matches.localteam else "" end) as localteam,'
            . '(case when matches.visitorteam is not null then matches.visitorteam else "" end) as visitorteam,'
            . '(case when matches.match_type is not null then matches.match_type else "" end) as match_type,'
            . '(case when matches.match_num is not null then matches.match_num else "" end) as match_num',
            'join' => array(array('matches', 'matches.match_id=trans.match_id', 'left'),
                array('users', 'users.id=trans.user_id', 'inner')),
            'where' => array('trans.user_id' => $userId, 'trans.transaction_type' => 'CASH', 'trans.pay_type' => 'BONUS')
        );
        $this->data['cash_transactions_history'] = $this->common_model->customGet($options);
        $this->data['cash_bonus_transactions_history'] = $this->common_model->customGet($options2);
        $this->data['chip_transactions_history'] = $this->common_model->customGet($options1);
        $this->data['cash_wallet_history'] = $cash_wallet_history['result'];
        $this->data['chip_wallet_history'] = $chip_wallet_history['result'];
        $this->data['deposit_history'] = $deposit_history['result'];
        // pr($this->data['deposit_history']);
        $options = array('table' => 'user_cash_reports',
            'where' => array('user_id' => $userId),
            'single' => true
        );
        $this->data['totalAmountReports'] = $this->common_model->customGet($options);
        $this->load->admin_render('transaction_history', $this->data, 'inner_script');
    }

    public function uploadCsvUsers() {
        $csvMimes = array('text/x-comma-separated-values',
            'text/comma-separated-values',
            'application/octet-stream',
            'application/vnd.ms-excel',
            'application/x-csv',
            'text/x-csv',
            'text/csv',
            'application/csv',
            'application/excel',
            'application/vnd.msexcel',
            'text/plain');
        if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)) {
            if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
                fgetcsv($csvFile);
                while (($line = fgetcsv($csvFile)) !== FALSE) {
                    //print_r($line);die;
                    $name = trim($line[0]);
                    $email = trim($line[1]);
                    $phone = trim($line[2]);
                    $password = randomPassword();
                    $pass_new = $this->common_model->encryptPassword($password);
                    $username = explode('@', $email);
                    $digits = 5;
                    $code = strtoupper(substr(preg_replace('/[^A-Za-z0-9\-]/', '', $username[0]), 0, 5)) . rand(pow(10, $digits - 1), pow(10, $digits) - 1);
                    $identity = ($identity_column === 'email') ? $email : $email;

                    $option = array('table' => 'users',
                        'where' => array('email' => strtolower($email)
                        )
                    );
                    $existsEmail = $this->common_model->customGet($option);
                    if (empty($existsEmail)) {

                        $additional_data = array(
                            'first_name' => $name,
                            'last_name' => null,
                            'team_code' => $code,
                            'username' => $username[0],
                            'phone' => (!empty($phone)) ? $phone : 0,
                            'email_verify' => 1,
                            'is_pass_token' => $password,
                            'created_on' => strtotime(datetime())
                        );
                        $insert_id = $this->ion_auth->register($identity, $password, $email, $additional_data, array(2));
                    } else {


                        $options_data = array(
                            'first_name' => $name,
                            //'team_code' => $code,
                            'username' => $username[0],
                            'phone' => (!empty($phone)) ? $phone : 0,
                                // 'is_pass_token' => $password,
                        );
                        $option = array('table' => 'users',
                            'data' => $options_data,
                            'where' => array('id' => $existsEmail[0]->id));
                        $this->common_model->customUpdate($option);
                    }
                    if ($insert_id) {
                        $from = getConfig('admin_email');
                        $subject = "PlayWin Fantasy Registration Login Credentials";
                        $title = "PlayWin Fantasy Registration";
                        $data['name'] = ucwords($name);
                        $data['content'] = "PlayWin Fantasy account login Credentials"
                                . "<p>username: " . $email . "</p><p>Password: " . $password . "</p>";
                        $template = $this->load->view('user_signup_mail', $data, true);
                        $this->send_email($email, $from, $subject, $template, $title);
                    }
                }
                $this->session->set_flashdata('success', "successfully imports");
                redirect('users');
            }
        } else {
            $this->session->set_flashdata('error', "Error in imports");
            redirect('users');
        }
    }

    function checkStr() {
        $str = "";

        $ci = get_instance();

        if (!empty($str) && isset($str)) {
            $contest = explode(" ", $str);

            if (count($contest) > 1) {
                echo $contest[0] . ' ' . $contest[1];
            } else {
                echo $contest[0];
            }
        } else {
            echo $str;
        }
    }

}
