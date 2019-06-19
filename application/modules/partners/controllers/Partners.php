<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Partners extends Common_Controller { 
    public $data = array();
    public $file_data = "";
    public $_table = 'vendor_sale_partners';
    public function __construct() {
        parent::__construct();
    }
    
     /**
     * @method index
     * @description listing display
     * @return array
     */
    public function index() {
        $this->data['parent'] = "Partners";
        $this->data['title'] = "Manage Partners";
         $option = array('table' => $this->_table,'select' => '*',
            'where' => array('delete_status'=> 0)
            );
        
        $this->data['list'] = $this->common_model->customGet($option);
        $this->load->admin_render('list', $this->data, 'inner_script');
    }

    /**
     * @method open_model
     * @description load model box
     * @return array
     */

    function open_model() {
        $this->data['title'] = lang("add_cms");
        $this->load->view('add', $this->data);
    }
   

    /**
     * @method cms_add
     * @description add dynamic rows
     * @return array
     */
    public function partner_add() {
        
        $this->form_validation->set_rules('partner_name', 'Partner Name', 'required');       
         
        if ($this->form_validation->run() == true) {     

            $this->filedata['status'] = 1;
            $image = "";
            if (!empty($_FILES['image']['name'])) {
                $this->filedata = $this->commonUploadImage($_POST, 'partners', 'image');
                if ($this->filedata['status'] == 1) {
                 $image = $this->filedata['upload_data']['file_name'];
                 //$full_path = $this->filedata['upload_data']['full_path'];
                 //$folder = "cms/thumb";
                //$this->resizeNewImage($full_path,$folder,480,828);
                }               
            }
                  
            if ($this->filedata['status'] == 0) {
               $response = array('status' => 0, 'message' => $this->filedata['error']);  
            }else{
                 $options_data = array(
                    'partner_name'    => $this->input->post('partner_name'),
                    'image'         => $image,
                    'create_date'   => datetime(),
                    'is_active'        => 1,
                );
       
                $option = array('table' => $this->_table, 'data' => $options_data);
                if ($this->common_model->customInsert($option)) {
                    $response = array('status' => 1, 'message' => 'Successfuly Saved', 'url' => base_url('partners'));
                }else {
                    $response = array('status' => 0, 'message' => 'Failed');
                }                
            }
        } else {
            $messages = (validation_errors()) ? validation_errors() : '';
            $response = array('status' => 0, 'message' => $messages);
        }
        echo json_encode($response);
    }

    /**
     * @method cms_edit
     * @description edit dynamic rows
     * @return array
     */
    public function partner_edit() {
        $this->data['title'] = 'Edit Partner';
        $id = decoding($this->input->post('id'));
        if (!empty($id)) {
            $option = array(
                'table' => $this->_table,
                'where' => array('id' => $id),
                'single' => true
            );
            $results_row = $this->common_model->customGet($option);
            if (!empty($results_row)) {
                $this->data['results'] = $results_row;
                $this->load->view('edit', $this->data);
            } else {
                $this->session->set_flashdata('error', lang('not_found'));
                redirect('partners');
            }
        } else {
            $this->session->set_flashdata('error', lang('not_found'));
            redirect('partners');
        }
    }

    /**
     * @method cms_update
     * @description update dynamic rows
     * @return array
     */
    public function partner_update() {

        $this->form_validation->set_rules('partner_name', 'Partner Name', 'required|trim');       

        $where_id = $this->input->post('id');
        if ($this->form_validation->run() == FALSE):
            $messages = (validation_errors()) ? validation_errors() : '';
            $response = array('status' => 0, 'message' => $messages);
        else:
                $this->filedata['status'] = 1;
                $image = $this->input->post('exists_image');

                if (!empty($_FILES['image']['name'])) {
                    $this->filedata = $this->commonUploadImage($_POST, 'partners', 'image');
                    
                    if ($this->filedata['status'] == 1) {
                      $image = $this->filedata['upload_data']['file_name'];
                        // $full_path = $this->filedata['upload_data']['full_path'];
                         //$folder = "cms/thumb";
                        //$this->resizeNewImage($full_path,$folder,480,828);
                      delete_file($this->input->post('exists_image'), FCPATH."uploads/cms/");
                    }
                    
                }
                        
                if ($this->filedata['status'] == 0) {
                    $response = array('status' => 0, 'message' => $this->filedata['error']);  
                }else{
               
                    $options_data = array(
                        'partner_name' => $this->input->post('partner_name'),
                        'image'             => $image
                    );
                    $option = array(
                        'table' => $this->_table,
                        'data' => $options_data,
                        'where' => array('id' => $where_id)
                    );
                    $update = $this->common_model->customUpdate($option);
                    $response = array('status' => 1, 'message' => lang('cms_success_update'), 'url' => base_url('partners'));
              }  

        endif;

        echo json_encode($response);
    }
}
