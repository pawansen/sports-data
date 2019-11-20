<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ClientRequest extends Common_Controller {

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
        $this->data['parent'] = "contactUs";
        $this->data['title'] = "ContactUs";
        $role_name = $this->input->post('role_name');
        $this->data['roles'] = array(
            'role_name' => $role_name
        );
        $option = array('table' => "client_request as C",
                         'select' => "C.*,U.first_name,U.last_name",
                        'join' => array('users U' =>"U.id=C.user_id"));
        $this->data['list'] = $this->common_model->customGet($option);
        $this->load->admin_render('list', $this->data, 'inner_script');
    }
    
        /**
     * @method view
     * @description edit dynamic rows
     * @return array
     */
    public function view() {
        $this->data['title'] = "Client Request View";
        $id = $this->input->post('id');
        $option = array(
            'table' => "client_request",
            'where' => array('id' => $id),
            'single' => true
        );
        $results_row = $this->common_model->customGet($option);
        $this->data['results'] = $results_row;
        $this->load->view('view', $this->data);
    }

}
