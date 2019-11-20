<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Business extends Common_Controller {

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
    public function index($vendor_profile_activate = "No") {
        $this->data['parent'] = "Sales Representative";
        $role_name = $this->input->post('role_name');
        $this->data['roles'] = array(
            'role_name' => $role_name
        );

        $option = array('table' => USERS . ' as user',
            'select' => 'user.*,group.name as group_name,UP.doc_file,UP.company_name',
            'join' => array(array(USER_GROUPS . ' as ugroup', 'ugroup.user_id=user.id', 'left'),
                array(GROUPS . ' as group', 'group.id=ugroup.group_id', 'left'),
                array('user_profile UP', 'UP.user_id=user.id', 'left')),
            'order' => array('user.id' => 'ASC'),
            'where' => array('user.delete_status' => 0, "user.vendor_profile_activate" => $vendor_profile_activate, 'group.id' => 3),
            //'where_not_in' => array('group.id' => array(1, 2, 4)),
            'order' => array('user.id' => 'desc')
        );
        $this->data['list'] = $this->common_model->customGet($option);

        $option = array('table' => USERS . ' as user',
            'select' => 'user.*,group.name as group_name,UP.doc_file',
            'join' => array(array(USER_GROUPS . ' as ugroup', 'ugroup.user_id=user.id', 'left'),
                array(GROUPS . ' as group', 'group.id=ugroup.group_id', 'left'),
                array('user_profile UP', 'UP.user_id=user.id', 'left')),
            'order' => array('user.id' => 'ASC'),
            'where' => array('user.delete_status' => 0, "user.vendor_profile_activate" => "Yes", 'group.id' => 3),
            //'where_not_in' => array('group.id' => array(1, 2, 4)),
            'order' => array('user.id' => 'desc')
        );
        $this->data['active'] = count($this->common_model->customGet($option));

        $option = array('table' => USERS . ' as user',
            'select' => 'user.*,group.name as group_name,UP.doc_file',
            'join' => array(array(USER_GROUPS . ' as ugroup', 'ugroup.user_id=user.id', 'left'),
                array(GROUPS . ' as group', 'group.id=ugroup.group_id', 'left'),
                array('user_profile UP', 'UP.user_id=user.id', 'left')),
            'order' => array('user.id' => 'ASC'),
            'where' => array('user.delete_status' => 0, "user.vendor_profile_activate" => "No", 'group.id' => 3),
            //'where_not_in' => array('group.id' => array(1, 2, 4)),
            'order' => array('user.id' => 'desc')
        );
        $this->data['inactive'] = count($this->common_model->customGet($option));

        $this->data['title'] = "Vendors";
        $this->load->admin_render('list', $this->data, 'inner_script');
    }

    public function vendor_profile() {
        $this->data['parent'] = "Vendors";
        $role_name = $this->input->post('role_name');
        $this->data['roles'] = array(
            'role_name' => $role_name
        );
        $user_id = $this->session->userdata('user_id');

        $option = array('table' => USERS . ' as user',
            'select' => 'user.*,group.name as group_name',
            'join' => array(array(USER_GROUPS . ' as ugroup', 'ugroup.user_id=user.id', 'left'),
                array(GROUPS . ' as group', 'group.id=ugroup.group_id', 'left')),
            'order' => array('user.id' => 'ASC'),
            'where' => array('user.delete_status' => 0, 'user.id' => $user_id),
            'where_not_in' => array('group.id' => array(1, 2, 4)),
            'order' => array('user.id' => 'desc')
        );
        $this->data['list'] = $this->common_model->customGet($option);
        $this->data['title'] = "Vendors";
        $this->load->admin_render('list', $this->data, 'inner_script');
    }

    /**
     * @method open_model
     * @description load model box
     * @return array
     */
    function open_model() {
        $this->data['parent'] = "Sales Representative";
        $this->data['title'] = "Add Vendor";
        $option = array('table' => 'countries',
            'select' => '*'
        );
        $this->data['countries'] = $this->common_model->customGet($option);
        $option = array('table' => 'states',
                    'select' => '*');
                $this->data['states'] = $this->common_model->customGet($option);
                $option = array('table' => 'item_category',
                    'select' => '*');
                $this->data['categorys'] = $this->common_model->customGet($option);
        $this->load->admin_render('add', $this->data, 'inner_script');
    }

    function paymentList($sales_id = "") {
        if (empty($sales_id)) {
            $this->session->set_flashdata('error', "Records not found");
            redirect('business');
        }
        $this->data['parent'] = "Payment List";
        $this->data['title'] = "Payment List";
        $option = array(
            'table' => 'payment',
            'select' => '*',
            'where' => array('sales_user_id' => $sales_id),
            'order' => array('id' => 'DESC')
        );
        $this->data['list'] = $this->common_model->customGet($option);
        $this->load->admin_render('payment_list', $this->data, 'inner_script');
    }
    
    /**
     * @method users_add
     * @description add dynamic rows
     * @return array
     */
    public function vendors_add() {
        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;
        $option = array('table' => 'states',
                    'select' => '*');
                $this->data['states'] = $this->common_model->customGet($option);
                $option = array('table' => 'item_category',
                    'select' => '*');
                $this->data['categorys'] = $this->common_model->customGet($option);
        // validate form input
        $this->form_validation->set_rules('first_name', lang('first_name'), 'required|trim|xss_clean');
        //$this->form_validation->set_rules('last_name', lang('last_name'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('user_email', lang('user_email'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('password', lang('password'), 'trim|required|xss_clean|min_length[6]|max_length[14]');
        if (!preg_match('/(?=.*[a-z])(?=.*[0-9]).{6,}/i', $this->input->post('password'))) {
            $response = array('status' => 0, 'message' => "The Password Should be required alphabetic and numeric");
            echo json_encode($response);
            exit;
        }
        $email = strtolower($this->input->post('user_email'));
        $zipcode = $this->input->post('zipcode');
        $options = array(
            'table' => USERS . ' as user',
            'select' => 'user.email,user.id',
            'where' => array('user.email' => $email, 'user.delete_status' => 0),
            'single' => true
        );
        $exist_email = $this->common_model->customGet($options);
        if (!empty($exist_email)) {

            $this->form_validation->set_rules('user_email', lang('user_email'), 'trim|xss_clean|is_unique[users.email]');
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
                $option = array(
                    'table' => USERS . ' as user',
                    'select' => 'email,id',
                    'where' => array('email' => $email, 'delete_status' => 1),
                    'single' => true
                );
                $email_exist = $this->common_model->customGet($option);

                if (empty($email_exist)) {

                    $additional_data = array(
                        'first_name' => $this->input->post('first_name'),
                        'last_name' => $this->input->post('last_name'),
                        'team_code' => $code,
                        'username' => $username[0],
                        'date_of_birth' => (!empty($this->input->post('date_of_birth'))) ? date('Y-m-d', strtotime($this->input->post('date_of_birth'))) : date('Y-m-d'),
                        //'gender' => $this->input->post('user_gender'),
                        'profile_pic' => $image,
                        'phone' => $this->input->post('phone_no'),
                        'phone_code' => $this->input->post('phone_code'),
                        'zipcode_access' => json_encode($this->input->post('zipcode')),
                        'email_verify' => 1,
                        'is_pass_token' => $password,
                        'created_on' => strtotime(datetime())
                    );
                    $insert_id = $this->ion_auth->register($identity, $password, $email, $additional_data, array(3));

                    $additional_data_profile = array(
                        'user_id' => $insert_id,
                        'description' => $this->input->post('description'),
                        'designation' => $this->input->post('designation'),
                        'website' => $this->input->post('website'),
                        'country' => $this->input->post('country'),
                        'state' => $this->input->post('state'),
                        'city' => $this->input->post('city'),
                        'address1' => $this->input->post('address1'),
                        'category_id' => $this->input->post('category_id'),
                        'company_name' => $this->input->post('company_name'),
                        'update_date' => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('vendor_sale_user_profile', $additional_data_profile);
                } else {
                    $where_id = $email_exist->id;
                    $options_data = array(
                        'first_name' => $this->input->post('first_name'),
                        'last_name' => $this->input->post('last_name'),
                        'team_code' => $code,
                        'username' => $username[0],
                        'date_of_birth' => (!empty($this->input->post('date_of_birth'))) ? date('Y-m-d', strtotime($this->input->post('date_of_birth'))) : date('Y-m-d'),
                        'gender' => $this->input->post('user_gender'),
                        'profile_pic' => $image,
                        'phone' => $this->input->post('phone_no'),
                        'email_verify' => 1,
                        'is_pass_token' => $password,
                        'zipcode_access' => json_encode($this->input->post('zipcode')),
                        'created_on' => strtotime(datetime()),
                        'delete_status' => 0
                    );
                    $insert_id = $this->ion_auth->update($where_id, $options_data);
                    $additional_data_profile = array(
                        'description' => $this->input->post('description'),
                        'designation' => $this->input->post('designation'),
                        'website' => $this->input->post('website'),
                        'country' => $this->input->post('country'),
                        'state' => $this->input->post('state'),
                        'city' => $this->input->post('city'),
                        'address1' => $this->input->post('address1'),
                        'category_id' => $this->input->post('category_id'),
                        'company_name' => $this->input->post('company_name'),
                        'update_date' => date('Y-m-d H:i:s')
                    );
                    $this->db->where("user_id", $where_id);
                    $this->db->update('vendor_sale_user_profile', $additional_data_profile);
                }
                if ($insert_id) {
                    $html = array();
                    $response = array('status' => 1, 'message' => 'Sales Added Successfully', 'url' => base_url('business'));
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
    public function vendor_edit() {
        $this->data['parent'] = "Sales Representative";
        $this->data['title'] = "Edit Vendor";
        $id = decoding($_GET['id']);
        if (!empty($id)) {
            $option = array(
                'table' => USERS . ' as user',
                'select' => 'user.*, UP.address1,UP.city,UP.country,UP.state,UP.description,'
                . 'UP.designation,UP.website,group.name as group_name,group.id as g_id,'
                . 'UP.doc_file,UP.company_name,UP.category_id,UP.profile_pic as img',
                'join' => array(
                    array(USER_GROUPS . ' as u_group', 'u_group.user_id=user.id', ''),
                    array(GROUPS . ' as group', 'group.id=u_group.group_id', ''),
                    array('user_profile as UP', 'UP.user_id=user.id', 'left')),
                'where' => array('user.id' => $id),
                'single' => true
            );
            $results_row = $this->common_model->customGet($option);
            if (!empty($results_row)) {
                $option = array('table' => 'countries',
                    'select' => '*');
                $this->data['countries'] = $this->common_model->customGet($option);
                $option = array('table' => 'states',
                    'select' => '*');
                $this->data['states'] = $this->common_model->customGet($option);
                $option = array('table' => 'item_category',
                    'select' => '*');
                $this->data['categorys'] = $this->common_model->customGet($option);
                $this->data['results'] = $results_row;
                //$this->load->view('edit', $this->data);
                $this->load->admin_render('edit', $this->data, 'inner_script');
            } else {
                $this->session->set_flashdata('error', lang('not_found'));
                redirect('business');
            }
        } else {
            $this->session->set_flashdata('error', lang('not_found'));
            redirect('business');
        }
    }

    /**
     * @method user_update
     * @description update dynamic rows
     * @return array
     */
    public function vendor_update() {

        $this->form_validation->set_rules('company_name', "company_name", 'required|trim|xss_clean');
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

                    // $options_data = array(
                    //     'first_name' => $this->input->post('first_name'),
                    //     'last_name' => $this->input->post('last_name'),
                    //     'date_of_birth' => "0000-00-00",
                    //     'gender' => "OTHER",
                    //     'phone' => $this->input->post('phone_no'),
                    //     'profile_pic' => $image,
                    //     'email' => $user_email,
                    //     'zipcode_access' => json_encode($this->input->post('zipcode')),
                    //     'is_pass_token' => $currentPass,
                    // );
                    // $this->ion_auth->update($where_id, $options_data);
                    $additional_data_profile = array(
                        'description' => $this->input->post('description'),
                        'website' => $this->input->post('website'),
                        'country' => $this->input->post('country'),
                        'state' => $this->input->post('state'),
                        'city' => $this->input->post('city'),
                        'address1' => $this->input->post('address1'),
                        'category_id' => implode(",",$this->input->post('category_id')),
                        'company_name' => $this->input->post('company_name'),
                        'profile_pic' => $image,
                        'update_date' => date('Y-m-d H:i:s')
                    );
                    $this->db->where("user_id", $where_id);
                    $this->db->update('vendor_sale_user_profile', $additional_data_profile);
                    // if ($newpass != "") {
                    //     $pass_new = $this->common_model->encryptPassword($this->input->post('new_password'));
                    //     $this->common_model->customUpdate(array('table' => 'users', 'data' => array('password' => $pass_new), 'where' => array('id' => $where_id)));
                    // }

                    $response = array('status' => 1, 'message' => 'Vendor updated Successfully', 'url' => base_url('business/vendor_edit'), 'id' => encoding($this->input->post('id')));
                }
            } else {
                $response = array('status' => 0, 'message' => "The email address already exists");
            }

        endif;

        echo json_encode($response);
    }

    public function updateAccountStatus() {
        $id = decoding($this->input->post('userId'));
        $status = $this->input->post('status');

        $update = $this->common_model->customUpdate(array('table' => 'users', 'data' => array('vendor_profile_activate' => $status), 'where' => array('id' => $id)));
        if ($update) {
            $response = array('status' => 1, 'message' => "Vendor Verified Successfully");
        } else {
            $response = array('status' => 0, 'message' => "Error");
        }
        echo json_encode($response);
    }

    /**
     * @method user_edit
     * @description edit dynamic rows
     * @return array
     */
    public function add_pan_card() {
        $this->data['title'] = "Add Pan Card";
        $id = decoding($this->input->post('id'));

        if (!empty($id)) {
            $option = array(
                'table' => 'user_pan_card as pan_card',
                'select' => 'pan_card.*',
                'where' => array('pan_card.user_id' => $id),
                'single' => true
            );
            $results_row = $this->common_model->customGet($option);

            $option1 = array(
                'table' => 'states',
                'select' => 'states.*',
                'where' => array('country_id' => 101),
            );
            $this->data['state_data'] = $this->common_model->customGet($option1);

            if (!empty($results_row)) {
                $this->data['results'] = $results_row;
                $this->load->view('add_pan_card', $this->data);
            } else {
                $this->data['id'] = $id;
                $this->data['results'] = $results_row;
                $this->load->view('add_pan_card', $this->data);
            }
        } else {
            $this->session->set_flashdata('error', lang('not_found'));
            redirect('business');
        }
    }

    /**
     * @method user_update
     * @description update dynamic rows
     * @return array
     */
    public function pan_card_add() {
        //print_r($_POST);
        // print_r($_FILES);die;
        $this->form_validation->set_rules('first_name', lang('first_name'), 'required|trim|xss_clean');

        $this->form_validation->set_rules('pan_number', lang('pan_number'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('state', 'state', 'required|trim|xss_clean');


        $where_id = $this->input->post('id');
        $vender_id = $this->input->post('vender_id');

        if ($this->form_validation->run() == FALSE):
            $messages = (validation_errors()) ? validation_errors() : '';
            $response = array('status' => 0, 'message' => $messages);
        else:


            $this->filedata['status'] = 1;
            $image = $this->input->post('exists_image');
            if (!empty($_FILES['pan_card_file']['name'])) {
                $this->filedata = $this->commonUploadImage($_POST, 'users', 'pan_card_file');
                if ($this->filedata['status'] == 1) {
                    $image = 'uploads/users/' . $this->filedata['upload_data']['file_name'];
                }
            }

            $this->filedata['status'] = 1;
            $id_proof = $this->input->post('exists_id_proof');
            if (!empty($_FILES['id_proof']['name'])) {
                $this->filedata = $this->commonUploadImage($_POST, 'users', 'id_proof');
                if ($this->filedata['status'] == 1) {
                    $id_proof = 'uploads/users/' . $this->filedata['upload_data']['file_name'];
                }
            }

            if ($this->filedata['status'] == 0) {
                $response = array('status' => 0, 'message' => $this->filedata['error']);
            } else {

                if ($where_id == "") {

                    $options_data = array(
                        'user_id' => $vender_id,
                        'full_name' => $this->input->post('first_name'),
                        'date_of_birth' => (!empty($this->input->post('date_of_birth'))) ? date('Y-m-d', strtotime($this->input->post('date_of_birth'))) : "0000-00-00",
                        'pan_number' => $this->input->post('pan_number'),
                        'country' => $this->input->post('country'),
                        'state' => $this->input->post('state'),
                        'pan_card_file' => $image,
                        'id_proof' => $id_proof,
                        'verification_status' => 1,
                        'create_date' => datetime()
                    );
                    $option = array('table' => 'user_pan_card', 'data' => $options_data);
                    $savePancardDetail = $this->common_model->customInsert($option);
                } else {

                    $options_data = array(
                        'full_name' => $this->input->post('first_name'),
                        'date_of_birth' => (!empty($this->input->post('date_of_birth'))) ? date('Y-m-d', strtotime($this->input->post('date_of_birth'))) : "0000-00-00",
                        'pan_number' => $this->input->post('pan_number'),
                        'country' => $this->input->post('country'),
                        'state' => $this->input->post('state'),
                        'pan_card_file' => $image,
                        'id_proof' => $id_proof
                    );

                    $option = array(
                        'table' => 'user_pan_card',
                        'data' => $options_data,
                        'where' => array('id' => $where_id)
                    );
                    $savePancardDetail = $this->common_model->customUpdate($option);
                }

                $response = array('status' => 1, 'message' => 'Pan Card Details added successfully', 'url' => base_url('index'));
            }


        endif;

        echo json_encode($response);
    }

    public function add_aadhar_card() {
        $this->data['title'] = "Add Aadhar Card";
        $id = decoding($this->input->post('id'));

        if (!empty($id)) {
            $results_row = array();
            $option = array(
                'table' => 'user_aadhar_card as aadhar_card',
                'select' => 'aadhar_card.*',
                'where' => array('aadhar_card.user_id' => $id),
                'single' => true
            );
            $results_row = $this->common_model->customGet($option);

            $option1 = array(
                'table' => 'states',
                'select' => 'states.*',
                'where' => array('country_id' => 101),
            );
            $this->data['state_data'] = $this->common_model->customGet($option1);

            if (!empty($results_row)) {
                $this->data['results'] = $results_row;
                $this->load->view('add_aadhar_card', $this->data);
            } else {
                $this->data['id'] = $id;
                $this->data['results'] = $results_row;
                $this->load->view('add_aadhar_card', $this->data);
            }
        } else {
            $this->session->set_flashdata('error', lang('not_found'));
            redirect('business');
        }
    }

    public function aadhar_card_add() {
        //print_r($_POST);
        // print_r($_FILES);die;
        $this->form_validation->set_rules('first_name', lang('first_name'), 'required|trim|xss_clean');

        $this->form_validation->set_rules('aadhar_number', 'aadhar_number', 'required|trim|xss_clean');
        $this->form_validation->set_rules('state', 'state', 'required|trim|xss_clean');


        $where_id = $this->input->post('id');
        $vender_id = $this->input->post('vender_id');

        if ($this->form_validation->run() == FALSE):
            $messages = (validation_errors()) ? validation_errors() : '';
            $response = array('status' => 0, 'message' => $messages);
        else:


            $this->filedata['status'] = 1;
            $image = $this->input->post('exists_image');
            if (!empty($_FILES['aadhar_file']['name'])) {
                $this->filedata = $this->commonUploadImage($_POST, 'users', 'aadhar_file');
                if ($this->filedata['status'] == 1) {
                    $image = 'uploads/users/' . $this->filedata['upload_data']['file_name'];
                }
            }

            $this->filedata['status'] = 1;
            $id_proof = $this->input->post('exists_id_proof');
            if (!empty($_FILES['aadhar_file_back_image']['name'])) {
                $this->filedata = $this->commonUploadImage($_POST, 'users', 'aadhar_file_back_image');
                if ($this->filedata['status'] == 1) {
                    $id_proof = 'uploads/users/' . $this->filedata['upload_data']['file_name'];
                }
            }

            if ($this->filedata['status'] == 0) {
                $response = array('status' => 0, 'message' => $this->filedata['error']);
            } else {

                if ($where_id == "") {

                    $options_data = array(
                        'user_id' => $vender_id,
                        'full_name' => $this->input->post('first_name'),
                        'date_of_birth' => (!empty($this->input->post('date_of_birth'))) ? date('Y-m-d', strtotime($this->input->post('date_of_birth'))) : "0000-00-00",
                        'aadhar_number' => $this->input->post('aadhar_number'),
                        // 'country' => $this->input->post('country'),
                        'state' => $this->input->post('state'),
                        'aadhar_file' => $image,
                        'aadhar_file_back_image' => $id_proof,
                        'verification_status' => 1,
                        'create_date' => datetime()
                    );
                    $option = array('table' => 'user_aadhar_card', 'data' => $options_data);
                    $savePancardDetail = $this->common_model->customInsert($option);
                } else {

                    $options_data = array(
                        'full_name' => $this->input->post('first_name'),
                        'date_of_birth' => (!empty($this->input->post('date_of_birth'))) ? date('Y-m-d', strtotime($this->input->post('date_of_birth'))) : "0000-00-00",
                        'aadhar_number' => $this->input->post('aadhar_number'),
                        //  'country' => $this->input->post('country'),
                        'state' => $this->input->post('state'),
                        'aadhar_file' => $image,
                        'aadhar_file_back_image' => $id_proof
                    );

                    $option = array(
                        'table' => 'user_aadhar_card',
                        'data' => $options_data,
                        'where' => array('id' => $where_id)
                    );
                    $savePancardDetail = $this->common_model->customUpdate($option);
                }

                $response = array('status' => 1, 'message' => 'Aadhar Card Details added successfully', 'url' => base_url('index'));
            }


        endif;

        echo json_encode($response);
    }

    /**
     * @method user_edit
     * @description edit dynamic rows
     * @return array
     */
    public function add_bank_account() {
        $this->data['title'] = "Add Bank Account";
        $id = decoding($this->input->post('id'));
        if (!empty($id)) {
            $option = array(
                'table' => 'user_bank_account_detail as bank_account',
                'select' => 'bank_account.*',
                'where' => array('bank_account.user_id' => $id),
                'single' => true
            );
            $results_row = $this->common_model->customGet($option);
            if (!empty($results_row)) {
                $this->data['results'] = $results_row;
                $this->load->view('add_bank_account', $this->data);
            } else {
                $this->data['id'] = $id;
                $this->data['results'] = $results_row;
                $this->load->view('add_bank_account', $this->data);
            }
        } else {
            $this->session->set_flashdata('error', lang('not_found'));
            redirect('business');
        }
    }

    /**
     * @method user_update
     * @description update dynamic rows
     * @return array
     */
    public function bank_account_add() {
        // print_r($_POST);
        // print_r($_FILES);die;
        $this->form_validation->set_rules('first_name', lang('first_name'), 'required|trim|xss_clean');

        $this->form_validation->set_rules('account_number', lang('account_number'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('bank_name', 'bank_name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('branch_name', 'branch_name', 'required|trim|xss_clean');

        $where_id = $this->input->post('id');
        $vender_id = $this->input->post('vender_id');
        if ($this->form_validation->run() == FALSE):
            $messages = (validation_errors()) ? validation_errors() : '';
            $response = array('status' => 0, 'message' => $messages);
        else:


            $this->filedata['status'] = 1;
            $image = $this->input->post('exists_image');
            if (!empty($_FILES['account_file']['name'])) {
                $this->filedata = $this->commonUploadImage($_POST, 'users', 'account_file');
                if ($this->filedata['status'] == 1) {
                    $image = 'uploads/users/' . $this->filedata['upload_data']['file_name'];
                }
            }
            if ($this->filedata['status'] == 0) {
                $response = array('status' => 0, 'message' => $this->filedata['error']);
            } else {

                if ($where_id == "") {

                    $options_data = array(
                        'user_id' => $vender_id,
                        'full_name' => $this->input->post('first_name'),
                        'account_number' => $this->input->post('account_number'),
                        'ifsc_code' => $this->input->post('ifsc_code'),
                        'bank_name' => $this->input->post('bank_name'),
                        'branch_name' => $this->input->post('branch_name'),
                        'account_file' => $image,
                        'verification_status' => 1,
                        'create_date' => datetime()
                    );

                    $option = array('table' => 'user_bank_account_detail', 'data' => $options_data);
                    $saveBankDetail = $this->common_model->customInsert($option);
                } else {

                    $options_data = array(
                        'full_name' => $this->input->post('first_name'),
                        'account_number' => $this->input->post('account_number'),
                        'ifsc_code' => $this->input->post('ifsc_code'),
                        'account_file' => $image,
                        'bank_name' => $this->input->post('bank_name'),
                        'branch_name' => $this->input->post('branch_name'),
                    );

                    $option = array(
                        'table' => 'user_bank_account_detail',
                        'data' => $options_data,
                        'where' => array('id' => $where_id)
                    );
                    $saveBankDetail = $this->common_model->customUpdate($option);
                }


                $response = array('status' => 1, 'message' => 'Bank Account Details added successfully', 'url' => base_url('business'));
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
     * @method delVendors
     * @description delete vendors
     * @return array
     */
    public function delVendors() {
        $response = "";
        $id = decoding($this->input->post('id')); // delete id
        $table = $this->input->post('table'); //table name
        $id_name = $this->input->post('id_name'); // table field name
        if (!empty($table) && !empty($id) && !empty($id_name)) {

            // $option = array(
            //     'table' => $table,
            //     'where' => array($id_name => $id)
            // );
            // $delete = $this->common_model->customDelete($option);
            $option = array(
                'table' => $table,
                'data' => array('delete_status' => 1),
                'where' => array($id_name => $id)
            );
            $delete = $this->common_model->customUpdate($option);
            if ($delete) {
                $response = 200;
            } else
                $response = 400;
        }else {
            $response = 400;
        }
        echo $response;
    }

    function transactions($user_id = '') {
        $this->data['title'] = "Users";
        $this->data['parent'] = "Users";
        $userId = decoding($user_id);
        $cash_wallet_history = $this->common_model->GetJoinRecord('wallet', 'user_id', USERS, 'id', '*,wallet.create_date AS createdDate', array('wallet.user_id' => $userId));
        $chip_wallet_history = $this->common_model->GetJoinRecord('user_chip', 'user_id', USERS, 'id', '*,user_chip.update_date AS createdDate', array('user_chip.user_id' => $userId));
        $deposit_history = $this->common_model->GetJoinRecord('payment', 'user_id', USERS, 'id', '', array('payment.user_id' => $userId, 'payment.status' => 'SUCCESS'));

        $options = array('table' => 'transactions_history as trans',
            'select' => 'users.first_name,users.team_code,trans.opening_balance,trans.message,trans.datetime as tranasction_date,trans.orderId as tranasaction_id,trans.dr,trans.cr,trans.available_balance,'
            . '(case when matches.match_date is not null then matches.match_date else "" end) as match_date,'
            . '(case when matches.localteam is not null then matches.localteam else "" end) as localteam,'
            . '(case when matches.visitorteam is not null then matches.visitorteam else "" end) as visitorteam,'
            . '(case when matches.match_type is not null then matches.match_type else "" end) as match_type',
            'join' => array(array('matches', 'matches.match_id=trans.match_id', 'left'),
                array('users', 'users.id=trans.user_id', 'inner')),
            'where' => array('trans.user_id' => $userId, 'trans.transaction_type' => 'CASH')
        );
        $options1 = array('table' => 'transactions_history as trans',
            'select' => 'users.first_name,users.team_code,trans.opening_balance,trans.message,trans.datetime as tranasction_date,trans.orderId as tranasaction_id,trans.dr,trans.cr,trans.available_balance,'
            . '(case when matches.match_date is not null then matches.match_date else "" end) as match_date,'
            . '(case when matches.localteam is not null then matches.localteam else "" end) as localteam,'
            . '(case when matches.visitorteam is not null then matches.visitorteam else "" end) as visitorteam,'
            . '(case when matches.match_type is not null then matches.match_type else "" end) as match_type',
            'join' => array(array('matches', 'matches.match_id=trans.match_id', 'left'),
                array('users', 'users.id=trans.user_id', 'inner')),
            'where' => array('trans.user_id' => $userId, 'trans.transaction_type' => 'CHIP')
        );
        $this->data['cash_transactions_history'] = $this->common_model->customGet($options);
        $this->data['chip_transactions_history'] = $this->common_model->customGet($options1);
        $this->data['cash_wallet_history'] = $cash_wallet_history['result'];
        $this->data['chip_wallet_history'] = $chip_wallet_history['result'];
        $this->data['deposit_history'] = $deposit_history['result'];
        // pr($this->data['deposit_history']);

        $this->load->admin_render('transaction_history', $this->data, 'inner_script');
    }

    public function affiliate_sales() {

        $this->data['parent'] = "Affiliate Sales";
        $this->data['title'] = "Affiliate Sales";

        $user_id = $this->session->userdata('user_id');

        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        $this->data['dates'] = array(
            'from_date' => $from_date,
            'to_date' => $to_date
        );
        if (!empty($from_date) && !empty($to_date)) {


            $option = array(
                'table' => 'matches as match',
                'select' => 'jc.user_id,jc.match_id,jc.contest_id,jc.joining_date,'
                . 'jc.joining_amount,user.id,user.team_code,user.first_name,'
                . 'user.street,user.email,match.match_id,match.localteam,match.visitorteam,'
                . 'match.match_date,cont.id,cont.contest_size,cont.team_entry_fee,'
                . 'cont.admin_percentage,cont.create_date,cont.contest_name,cont.total_winning_amount,tds.deduct_amount,cont.admin_prcnt_rs,'
                . 'count(cont.id) as total_cont,sum(cont.team_entry_fee) as tef,sum(jc.joining_amount) as total_joining_amount,'
                . 'sum(jc.chip) as total_chip,sum(cont.admin_prcnt_rs) as admin_prcnt',
                'join' => array(
                    array('join_contest as jc', 'match.match_id=jc.match_id', 'left'),
                    array('contest as cont', 'jc.contest_id=cont.id', 'left'),
                    array('users as user', 'user.id=jc.user_id', 'inner'),
                    array('user_referrals as user_ref', 'user_ref.invite_user_id=jc.user_id', 'inner'),
                    array(USER_GROUPS . ' as ugroup', 'ugroup.user_id=user_ref.user_id', 'inner'),
                    array('tds_history as tds', 'tds.user_id=user.id', 'left')),
                'order' => array('match.match_date' => 'ASC'),
                'where' => array('cont.status' => 2, 'cont.match_type' => 1, 'user.delete_status' => 0, 'user_ref.user_id' => $user_id),
                //'where_not_in' => array('ugroup.group_id' => array(1, 2, 4)),
                'group_by' => 'user.id,match.match_id',
            );


            $from_date = date('Y-m-d', strtotime($from_date));
            $to_date = date('Y-m-d', strtotime($to_date));

            if ($to_date == '1970-01-01') {
                $option['where']['DATE(created_date) >='] = $from_date;
            } else {
                $option['where']['DATE(created_date) >='] = $from_date;
                $option['where']['DATE(created_date) <='] = $to_date;
            }
            $this->data['list'] = $this->common_model->customGet($option);
        }
        //echo $this->db->last_query();
        //echo '<pre>'; print_r($this->data);die;
        $this->load->admin_render('business/affiliate_sales_list', $this->data, 'inner_script');
    }

    public function new_registration() {
        $this->data['parent'] = "New Registraion";
        $this->data['title'] = "New Registraion";
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        $user_id = $this->session->userdata('user_id');

        $UtcDateTime1 = trim(ISTToConvertUTC(date('Y-m-d H:i'), 'UTC', 'UTC'));

        $before_date = trim(ISTToConvertUTC(date('Y-m-d H:i', strtotime('-15 day')), 'UTC', 'UTC'));
        $player_type = $this->input->post('player_type');
        $this->data['dates'] = array(
            'from_date' => $from_date,
            'to_date' => $to_date
        );
        if ($player_type == 'All' && $from_date == "" && $to_date == "") {
            $this->data['error_show'] = "Please Select Date";
        } else if (!empty($player_type) || $from_date != "" || $to_date != "") {
            $option = array('table' => USERS . ' as user',
                'select' => 'user.id,user.team_code,user.email,user.created_date,user.phone,user.verify_mobile,user.email_verify,pan.pan_number,aadhar.aadhar_number,bank.account_number,pan.verification_status as pan_status,aadhar.verification_status as aadhar_status,bank.verification_status as bank_status',
                'join' => array(
                    array('user_referrals as urf', 'urf.invite_user_id=user.id', 'inner'),
                    array(USER_GROUPS . ' as ugroup', 'ugroup.user_id=user.id', 'inner'),
                    // array(GROUPS . ' as group', 'group.id=ugroup.group_id', 'inner'),
                    array('user_pan_card as pan', 'pan.user_id=user.id', 'left'),
                    array('user_aadhar_card as aadhar', 'aadhar.user_id=user.id', 'left'),
                    array('user_bank_account_detail as bank', 'bank.user_id=user.id', 'left')),
                'order' => array('user.id' => 'ASC'),
                // 'where' => array('user.delete_status' => 0, 'user.created_date >' => $before_date, 'user.created_date <=' => $UtcDateTime1),
                'where' => array('user.delete_status' => 0, 'urf.user_id' => $user_id),
                // 'where_not_in' => array('group.id' => array(1,3,4))
                'group_by' => 'user.id'
            );

            if ($player_type == 'Affiliate') {
                $option['where_in']['group.id'] = array(3);
            }
            if ($player_type == 'Reference') {
                $option['where_not_in']['group.id'] = array(3);
            }

            if (!empty($from_date) && !empty($to_date)) {
                $from_date = date('Y-m-d', strtotime($from_date));
                $to_date = date('Y-m-d', strtotime($to_date));

                if ($to_date == '1970-01-01') {
                    $option['where']['DATE(created_date) >='] = $from_date;
                } else {
                    $option['where']['DATE(created_date) >='] = $from_date;
                    $option['where']['DATE(created_date) <='] = $to_date;
                }
            }

            $this->data['list'] = $this->common_model->customGet($option);
        }
        $this->data['player_type'] = $player_type;

        //echo $this->db->last_query();
        //echo '<pre>'; print_r($this->data);die;
        $this->load->admin_render('new_registration_list', $this->data, 'inner_script');
    }

    public function welcome_bonus_list_bonus() {

        $this->data['parent'] = "Welcome Bonus";
        $this->data['title'] = "Welcome Bonus";
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        $this->data['dates'] = array(
            'from_date' => $from_date,
            'to_date' => $to_date
        );
        $user_id = $this->session->userdata('user_id');
        if (!empty($from_date) && !empty($to_date)) {

            $option = array('table' => USERS . ' as user',
                'select' => 'user.update_status,user.created_on,user.id,user.team_code,user.email,user.created_date,user.email_verify,user.verify_mobile,upc.verification_status,trh.cr,trh.datetime',
                'join' => array(
                    array('user_referrals as urf', 'urf.invite_user_id=user.id', 'inner'),
                    array(USER_GROUPS . ' as ugroup', 'ugroup.user_id=user.id', 'inner'),
                    array('user_pan_card as upc', 'upc.user_id=user.id', 'left'),
                    array('transactions_history as trh' => 'trh.user_id=user.id')),
                'order' => array('trh.datetime' => 'DESC'),
                'where' => array('trh.bonus_type' => 'WELCOME', 'urf.user_id' => $user_id),
                'group_by' => 'user.id'
            );

            if (!empty($from_date)) {
                $from_date = date('Y-m-d', strtotime($from_date));
                $to_date_filter = date('Y-m-d', strtotime($to_date));
                $option['where']['DATE(trh.datetime) >='] = $from_date;
                if (!empty($to_date)) {
                    $option['where']['DATE(trh.datetime) <='] = $to_date_filter;
                }
            }
            $this->data['list'] = $this->common_model->customGet($option);
        }
        //echo $this->db->last_query();
        //echo '<pre>'; print_r($this->data);die;
        $this->load->admin_render('welcome_bonus_list', $this->data, 'inner_script');
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
            // welcomeBonusVerified($userId);
            // referralSchemeCashBonus($userId);
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
            // welcomeBonusVerified($userId);
            // referralSchemeCashBonus($userId);
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

}
