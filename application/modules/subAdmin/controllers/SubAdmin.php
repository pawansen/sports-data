<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SubAdmin extends Common_Controller {

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
        $this->data['parent'] = "SubAdmin";
        $role_name = $this->input->post('role_name');
        $this->data['roles'] = array(
            'role_name' => $role_name
        );

        $option = array('table' => USERS . ' as user',
            'select' => 'user.*,group.name as group_name',
            'join' => array(array(USER_GROUPS . ' as ugroup', 'ugroup.user_id=user.id', 'left'),
                array(GROUPS . ' as group', 'group.id=ugroup.group_id', 'left')),
            'order' => array('user.id' => 'ASC'),
            'where' => array('user.delete_status'=>0),
            'where_not_in' => array('group.id' => array(1,2,3)));


        $this->data['list'] = $this->common_model->customGet($option);
        $this->data['title'] = "SubAdmin";
        $this->load->admin_render('list', $this->data, 'inner_script');
    }

    /**
     * @method open_model
     * @description load model box
     * @return array
     */
    function open_model() {
        $this->data['title'] = "Add SubAdmin";
       
        $this->load->view('add', $this->data);
    }

    /**
     * @method users_add
     * @description add dynamic rows
     * @return array
     */
    public function subAdmin_add() {
        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;
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
         $options = array(
                'table' => USERS . ' as user',
                'select' => 'user.email,user.id',
                'where' => array('user.email' => $email,'user.delete_status'=>0),
                'single' => true
               );
         $exist_email = $this->common_model->customGet($options);
         if(!empty($exist_email))
         {
            
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
                $access_modules = $this->input->post('modules');
                $modules = implode(',',$access_modules);
            
                $email = strtolower($this->input->post('user_email'));
                $identity = ($identity_column === 'email') ? $email : $this->input->post('user_email');
                $password = $this->input->post('password');
                $username = explode('@', $this->input->post('user_email'));
                $digits = 5;
                $code = strtoupper(substr(preg_replace('/[^A-Za-z0-9\-]/', '', $username[0]), 0, 5)) . rand(pow(10, $digits - 1), pow(10, $digits) - 1);
                $option = array(
                    'table' => USERS . ' as user',
                    'select' => 'email,id',
                    'where' => array('email' => $email,'delete_status'=>1),
                    'single' => true
                );
               $email_exist = $this->common_model->customGet($option);

                if(empty($email_exist))
              {  

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
                $insert_id = $this->ion_auth->register($identity, $password, $email, $additional_data, array(4));
                $where_id = $insert_id;

            }else{
                $where_id = $email_exist->id;
                 $options_data = array(
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
                        'created_on' => strtotime(datetime()),
                        'delete_status' => 0
                    );

                $insert_id = $this->ion_auth->update($where_id, $options_data);

             }
                
                 if ($insert_id) {
                 $option = array(
                    'table' => 'subadmin_access',
                    'select' => 'user_id',
                    'where' => array('user_id' => $where_id),
                    'single' => true
                  );
                  $module_exist = $this->common_model->customGet($option);
                  if(empty($module_exist))
                  {
                    $options_data = array(
                       
                        'user_id'        => $where_id,
                        'modules'        => $modules
                    
                    );
               
                    $option = array('table' => 'subadmin_access', 'data' => $options_data);
                    $this->common_model->customInsert($option);
                  }else{
                      $options_data = array(
                        
                        'modules' => $modules
                        
                     );
                    $option = array(
                        'table' => 'subadmin_access',
                        'data' => $options_data,
                        'where' => array('user_id' => $where_id)
                    );
                    $update = $this->common_model->customUpdate($option);
                  }

                    $html = array();
                    $html['referral_code'] = $code;
                    $html['referral_link'] = base_url().'subAdmin/'.$code;
                    $html['logo'] = base_url() . getConfig('site_logo');
                    $html['site'] = getConfig('site_name');
                    $html['user'] = ucwords($this->input->post('first_name'));
                    $email_template = $this->load->view('email/referral_link_tpl', $html, true);
                    send_mail($email_template, '[' . getConfig('site_name') . '] Referral Link', $email, getConfig('admin_email'));


                    // $from = getConfig('admin_email');
                    // $subject = "Self Assessment Registration Login Credentials";
                    // $title = "Self Assessment Registration";
                    // $data['name'] = ucwords($this->input->post('first_name') . ' ' . $this->input->post('last_name'));
                    // $data['content'] = "Self Assessment account login Credentials"
                    //         . "<p>username: " . $email . "</p><p>Password: " . $password . "</p>";
                    // $template = $this->load->view('user_signup_mail', $data, true);
                    // $this->send_email($email, $from, $subject, $template, $title);

                    $response = array('status' => 1, 'message' => 'SubAdmin Added Successfully', 'url' => base_url('subAdmin'));
                } else {
                    $response = array('status' => 0, 'message' => 'SubAdmin falied to added');
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
    public function subAdmin_edit() {
        $this->data['title'] = "Edit SubAdmin";
        $id = decoding($this->input->post('id'));
        if (!empty($id)) {
             $options = array(
                'table' => 'subadmin_access',
                'select' => 'user_id,modules',
                'where' => array('user_id' => $id),
                'single' => true
            );
            $this->data['access_modules'] = $this->common_model->customGet($options);
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
                $this->load->view('edit', $this->data);
            } else {
                $this->session->set_flashdata('error', lang('not_found'));
                redirect('subAdmin');
            }
        } else {
            $this->session->set_flashdata('error', lang('not_found'));
            redirect('subAdmin');
        }
    }

    

    /**
     * @method user_update
     * @description update dynamic rows
     * @return array
     */
    public function subAdmin_update() {

        $this->form_validation->set_rules('first_name', lang('first_name'), 'required|trim|xss_clean');
        //$this->form_validation->set_rules('last_name', lang('last_name'), 'required|trim|xss_clean');
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

                    $access_modules = $this->input->post('modules');
                    $modules = implode(',',$access_modules);


                    $options_data = array(
                        'first_name' => $this->input->post('first_name'),
                        'last_name' => null,
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

                     $options_data = array(
                        
                        'modules' => $modules
                        
                     );
                    $option = array(
                        'table' => 'subadmin_access',
                        'data' => $options_data,
                        'where' => array('user_id' => $where_id)
                    );
                    $this->common_model->customUpdate($option);

                    $response = array('status' => 1, 'message' => 'SubAdmin updated Successfully', 'url' => base_url('subAdmin/subAdmin_edit'), 'id' => encoding($this->input->post('id')));
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
     * @method delVendors
     * @description delete vendors
     * @return array
     */
    public function delSubAdmin() {
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


}
