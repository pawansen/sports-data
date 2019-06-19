<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends Common_Controller {

    public $data = array();
    public $file_data = "";

    public function __construct() {
        parent::__construct();
        $this->is_auth_admin();
    }

    /**
     * @method index
     * @description loading view of notification list
     * @return array
     */
    public function index() {
        $this->data['parent'] = "Email";
        $this->data['title'] = "Sent E-Mails";
        $option = array(
            'table'     => 'users as u',
            'select'    => 'u.id, u.email, u.first_name, ug.group_id',
            'join'      => array('users_groups as ug'   =>  'ug.user_id = u.id'),
            'where'     => array('ug.group_id' => 2),
        );

        $this->data['usersList'] = $this->common_model->customGet($option);
        $this->load->admin_render('list', $this->data, 'inner_script');
    }


    /**
     * @method bulk email add
     * @description add dynamic rows
     * @return array
     */
    public function email_add() {

        $userType = $this->input->post('userType');
        $userEmailIds = $this->input->post('user_email_ids');

        $this->form_validation->set_rules('title', "Title", 'trim');
        // $this->form_validation->set_rules('message', "Message", 'required|trim');
       if ($userType != 0) {
        if (empty($userEmailIds)) {
            $this->form_validation->set_rules('user_email_ids', "Select Users", 'required');
        }
       }
        
        if ($this->form_validation->run() == true) {
                $result = array();
                $title  = $this->input->post('title');
                $email_type = $this->input->post('email_type');

            if ($userType == 0) {
                   $options = array('table' => USERS . ' as user',
                    'select' => 'user.email',
                    'join' => array(
                        array(USER_GROUPS . ' as ugroup', 'ugroup.user_id=user.id', 'left'),
                        array(GROUPS . ' as group', 'group.id=ugroup.group_id', 'left'),
                        array('states as state','state.id=user.state','left')), 
                    'where_not_in' => array('group.id' => array(1, 3, 4,5)));
                   $getUsers = $this->common_model->customGet($options);

                   foreach ($getUsers as $key => $value) {
                      $result[] = $value->email;
                   }
            }else{
                foreach ($userEmailIds as $key => $value) {
                      $result[] = $value;
                   }
            }
                   $email_arr = array(
                            // 'message' => $message,
                            'title' => $title,
                            'type_id' => 0,
                            'user_email_ids' => serialize($result),
                            'email_type' => $email_type,
                            'status'    => 'PENDING',
                            'sent_time' => datetime()
                        );
                     $lid = $this->common_model->insertData('admin_email',$email_arr);

                    if ($lid) {                     
                        $response = array('status' => 1, 'message' => "Email Send Successfully", 'url' => base_url('email'));
                    }else {
                        $response = array('status' => 0, 'message' => "Email failed to send");
                    } 
            
        } else {
            $messages = (validation_errors()) ? validation_errors() : '';
            $response = array('status' => 0, 'message' => $messages);
        }
        echo json_encode($response);
    }

}
