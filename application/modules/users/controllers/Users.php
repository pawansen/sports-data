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
    public function index($status="No") {

        $this->data['parent'] = "User";
        $this->data['title'] = "Users";
        $this->data['status'] = ($status == "Yes") ? 1 : 0;
        $role_name = $this->input->post('role_name');
        $this->data['roles'] = array(
            'role_name' => $role_name
        );
        $option = array('table' => USERS . ' as user',
        'select' => 'user.*,group.name as group_name',
        'join' => array(
            array(USER_GROUPS . ' as ugroup', 'ugroup.user_id=user.id', 'left'),
            array(GROUPS . ' as group', 'group.id=ugroup.group_id', 'left')),
        'order' => array('user.id' => 'DESC'),
        'where' => array('user.active'=>1),
        'where_not_in' => array('group.id' => array(1, 3, 4)
        )
    );

        $this->data['active'] = count($this->common_model->customGet($option));

        $option = array('table' => USERS . ' as user',
        'select' => 'user.*,group.name as group_name',
        'join' => array(
            array(USER_GROUPS . ' as ugroup', 'ugroup.user_id=user.id', 'left'),
            array(GROUPS . ' as group', 'group.id=ugroup.group_id', 'left')),
        'order' => array('user.id' => 'DESC'),
        'where' => array('user.active'=>0),
        'where_not_in' => array('group.id' => array(1, 3, 4)
        )
    );

        $this->data['inactive'] = count($this->common_model->customGet($option));

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
        $UserStatus = $this->input->post('UserStatus');

        $this->data['user'] = array(
            'from_date' => $from_date,
            'to_date' => $to_date
        );

        $where = ' user.active='.$UserStatus.' AND user.id IS NOT NULL';
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
        // if ($this->ion_auth->is_vendor()) {
        //     $vendor_user_id = $this->session->userdata('user_id');

        //     $where .= ' and referral.user_id="' . $vendor_user_id . '"';
        //     $option = array(
        //         'table' => 'user_referrals as referral',
        //         'select' => 'user.*,referral.user_id,referral.invite_user_id',
        //         'join' => array(array('users as user' => 'user.id=referral.invite_user_id'),
        //             array(USER_GROUPS . ' as ugroup', 'ugroup.user_id=referral.user_id', 'left'),
        //             array(GROUPS . ' as group', 'group.id=ugroup.group_id', 'left')),
        //         'order' => array('user.id' => 'DESC'),
        //         'where' => $where,
        //         'where_not_in' => array('group.id' => array(1, 2, 4)));
        // } else {
            $option = array('table' => USERS . ' as user',
                'select' => 'user.*,group.name as group_name',
                'join' => array(
                    array(USER_GROUPS . ' as ugroup', 'ugroup.user_id=user.id', 'left'),
                    array(GROUPS . ' as group', 'group.id=ugroup.group_id', 'left')),
                'order' => array('user.id' => 'DESC'),
                'where' => $where,
                'where_not_in' => array('group.id' => array(1, 3, 4)));
       // }


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

                    //$userData['created_on'] = isset($datetime) ? $datetime : '';
                    $userData['created_on'] = isset($users->created_on) ? date('d-m-Y H:i', $users->created_on) : '';

                    if ($users->id != 1) {
                        if ($users->active == 1) {
                            $userActiveUrl = "'" . USERS . "','id','" . encoding($users->id) . "','" . $users->active . "'";
                            $active_buttn = '<a href="javascript:void(0)" class="on-default edit-row" onclick="statusFn(' . $userActiveUrl . ')" title="Inactive Now"><img width="20" src="' . base_url() . ACTIVE_ICON . '" /></a>';
                            $active_buttn = ' <a href="javascript:void(0)" onclick="statusFn(' . $userActiveUrl . ')"  data-toggle="tooltip" title="Inactive Now" class="btn btn-xs btn-success"><i class="fa fa-check"></i></a>';
                        } else {
                            $userActiveUrl = "'" . USERS . "','id','" . encoding($users->id) . "','" . $users->active . "'";
                            $active_buttn = '<a href="javascript:void(0)" class="on-default edit-row text-danger" onclick="statusFn(' . $userActiveUrl . ')" title="Active Now"><img width="20" src="' . base_url() . INACTIVE_ICON . '" /></a>';
                            $active_buttn = ' <a href="javascript:void(0)" onclick="statusFn(' . $userActiveUrl . ')"  data-toggle="tooltip" title="Active Now" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>';
                        }
                        $userEditUrl = "'" . USERS . "','user_edit','" . encoding($users->id) . "'";
                        $chip_url = "'" . USERS . "','open_chip_model','" . encoding($users->id) . "'";
                        $cash_url = "'" . USERS . "','open_cash_model','" . encoding($users->id) . "'";
                        $remove_cash_url = "'" . USERS . "','remove_cash_model','" . encoding($users->id) . "'";
                        $user_edit = '<a href="javascript:void(0)" class="on-default edit-row" onclick="editFn(' . $userEditUrl . ');"><img width="20" src="' . base_url() . EDIT_ICON . '" /></a>';
                        $user_edit = ' <a href="' . base_url() . 'users/user_edit?id=' . encoding($users->id) . '" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>';

                        $delUserUrl = "'" . USERS . "','id','" . encoding($users->id) . "','users','users/delUsers'";
                        $delete_btn = '<a href="javascript:void(0)" onclick="deleteFn(' . $delUserUrl . ')" class="on-default edit-row text-danger"><img width="20" src="' . base_url() . DELETE_ICON . '" /></a><hr>';
                        $delete_btn = ' <a href="javascript:void(0)" onclick="deleteFn(' . $delUserUrl . ')" data-toggle="tooltip" title="Delete" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>';

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


    /**
     * @method open_model
     * @description load model box
     * @return array
     */
    function open_model() {
        $this->data['title'] = lang("add_user");
        $option = array('table' => 'countries',
            'select' => '*'
        );
        $this->data['countries'] = $this->common_model->customGet($option);
        $this->load->admin_render('add', $this->data, 'inner_script');
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

                $additional_data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'team_code' => $code,
                    'username' => $username[0],
                    'date_of_birth' => (!empty($this->input->post('date_of_birth'))) ? date('Y-m-d', strtotime($this->input->post('date_of_birth'))) : date('Y-m-d'),
                    'profile_pic' => $image,
                    'phone' => $this->input->post('phone_no'),
                    'email_verify' => 1,
                    'is_pass_token' => $password,
                    'created_on' => strtotime(datetime())
                );
                if ($this->ion_auth->is_vendor()) {

                    $insert_id = $this->ion_auth->register($identity, $password, $email, $additional_data, array(3));

                    $user_id = $this->session->userdata('user_id');

                    // $option = array(
                    //     'table' => 'user_referrals',
                    //     'where' => array('user_id' => $user_id,
                    //         'invite_user_id' => $insert_id)
                    // );
                    // $alreadyUsed = $this->common_model->customGet($option);
                    // if (empty($alreadyUsed)) {

                    //     $options_data = array(
                    //         'user_id' => $user_id,
                    //         'invite_user_id' => $insert_id,
                    //         'create_date' => datetime(),
                    //     );

                    //     $option = array('table' => 'user_referrals', 'data' => $options_data);
                    //     $this->common_model->customInsert($option);
                    // }
                } else {

                    $insert_id = $this->ion_auth->register($identity, $password, $email, $additional_data, array(2));
                }

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
                $this->load->admin_render('edit', $this->data, 'inner_script');
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
