<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonial extends Common_Controller { 
    public $data = array();
    public $file_data = "";
    public $_table = 'testimonial';
    public function __construct() {
        parent::__construct();
    }
    
     /**
     * @method index
     * @description listing display
     * @return array
     */
    public function index() {
        $this->data['parent'] = "Testimonial";
        $this->data['title'] = "Testimonial";
         $option = array('table' => 'testimonial as test',
            'select' => 'test.member_since,test.id,test.user_id,test.user_name,test.image,test.rating,test.status,test.created_date,test.description',
        
            'where' => array('test.delete_status'=> 0)
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
        $this->data['title'] = 'Add Testimonial';
        $this->load->view('add', $this->data);
     }

      function open_header_modal() {
            $this->data['title'] = 'Add Header Image';

            $options = array(
                     'table' => 'front_header_image',
                     'select' => '*',
                     'where' => array('page_type'=> 'testimonial'),
                     'single' => true
 
                );
            $this->data['results'] = $this->common_model->customGet($options);
         $this->load->view('add_header_image', $this->data);
    }
   

    /**
     * @method cms_add
     * @description add dynamic rows
     * @return array
     */
    public function testimonial_add() {
        
        $this->form_validation->set_rules('user_name', 'User Name', 'required|trim');
        $this->form_validation->set_rules('description', 'Description', 'required|trim');
       
         
        if ($this->form_validation->run() == true) {
                $this->filedata['status'] = 1;
                $image = "";
                if (!empty($_FILES['image']['name'])) {
                    $this->filedata = $this->commonUploadImage($_POST, 'users', 'image');
                    if ($this->filedata['status'] == 1) {
                     $image = $this->filedata['upload_data']['file_name'];
                    }
                   
                }
                      
                if ($this->filedata['status'] == 0) {
                   $response = array('status' => 0, 'message' => $this->filedata['error']);  
                }else{
                    $user_name  = $this->input->post('user_name');
                    $description  = $this->input->post('description');
                   
                     $options_data = array(
                       
                        'user_name'        => $this->input->post('user_name'),
                        'description'    => $this->input->post('description'),
                        'member_since'    => $this->input->post('member_since'),
                        'image'          => $image,
                        'created_date'    => datetime(),
                        'status'      => 1,
                    );
               
                    $option = array('table' => 'testimonial', 'data' => $options_data);
                    if ($this->common_model->customInsert($option)) {
                     

                        $response = array('status' => 1, 'message' => 'Successfully Added', 'url' => base_url('testimonial'));
                    
                }else {
                        $response = array('status' => 0, 'message' => 'Failed to added');
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


     public function testimonial_edit() {
        $this->data['title'] = 'Edit Testimonial';
        $id = decoding($this->input->post('id'));
        if (!empty($id)) {

            $option = array(
                'table' => 'testimonial',
                'where' => array('id' => $id),
                'single' => true
            );
            $results_row = $this->common_model->customGet($option);
            if (!empty($results_row)) {
                $this->data['results'] = $results_row;
                $this->load->view('edit', $this->data);
            } else {
                $this->session->set_flashdata('error', lang('not_found'));
                redirect('testimonial');
            }
        } else {
            $this->session->set_flashdata('error', lang('not_found'));
            redirect('testimonial');
        }
    }
  

    /**
     * @method cms_update
     * @description update dynamic rows
     * @return array
     */

     public function testimonial_update() {

        $this->form_validation->set_rules('user_name', 'User Name', 'required|trim');
        $this->form_validation->set_rules('description', 'Description', 'required|trim');
        

        $where_id = $this->input->post('id');
        if ($this->form_validation->run() == FALSE):
            $messages = (validation_errors()) ? validation_errors() : '';
            $response = array('status' => 0, 'message' => $messages);
        else:
                $this->filedata['status'] = 1;
                $image = $this->input->post('exists_image');

                if (!empty($_FILES['image']['name'])) {
                    $this->filedata = $this->commonUploadImage($_POST, 'users', 'image');
                    
                    if ($this->filedata['status'] == 1) {
                     $image = $this->filedata['upload_data']['file_name'];
                    // $full_path = $this->filedata['upload_data']['full_path'];
                     //$folder = "cms/thumb";
                    //$this->resizeNewImage($full_path,$folder,480,828);
                    delete_file($this->input->post('exists_image'), FCPATH."uploads/users/");
                    
                    
                    }
                    
                }
                        
                if ($this->filedata['status'] == 0) {
                    $response = array('status' => 0, 'message' => $this->filedata['error']);  
                }else{
               
                    $options_data = array(
                        
                        'description' => $this->input->post('description'),
                        'member_since'    => $this->input->post('member_since'),
                        'user_name' => $this->input->post('user_name'),
                        'image'             => $image
                        
                    );
                    $option = array(
                        'table' => 'testimonial',
                        'data' => $options_data,
                        'where' => array('id' => $where_id)
                    );
                    $update = $this->common_model->customUpdate($option);
                    $response = array('status' => 1, 'message' => 'Testimonial updated successfully', 'url' => base_url('testimonial'));
              }  

        endif;

        echo json_encode($response);
    }

    public function header_image_add() {
      
        $this->filedata['status'] = 1;
        $header_image = $this->input->post('exists_header_image');
        if (!empty($_FILES['header_image']['name'])) {
            $this->filedata = $this->commonUploadImage($_POST, 'frontImage', 'header_image');

            if ($this->filedata['status'] == 1) {
                $header_image = 'uploads/frontImage/' . $this->filedata['upload_data']['file_name'];
                unlink_file($this->input->post('exists_header_image'), FCPATH);
            }
        }
        if ($this->filedata['status'] == 0) {
            $response = array('status' => 0, 'message' => $this->filedata['error']);
        }     
        else{

              $options = array(
                        'table' => 'front_header_image',
                        'select' => '*',
                        'where' => array('page_type'=> 'testimonial')
                );
              $headerImage = $this->common_model->customGet($options); 

             if(!empty($headerImage))
             {
                    $options_data = array(
                        'header_image' => $header_image,
                        'header_image_text' => $this->input->post('header_image_text'),
                    );

                    $option = array(
                        'table' => 'front_header_image',
                        'data' => $options_data,
                        'where' => array('page_type' => 'testimonial')
                    );
                    $update = $this->common_model->customUpdate($option);

             }else{
                    $options_data = array(
                        'header_image' => $header_image,
                        'page_type' => 'testimonial',
                        'header_image_text' => $this->input->post('header_image_text'),
                        'created_date'=> datetime()
                    );

                    $option = array(
                        'table' => 'front_header_image',
                        'data' => $options_data,
                    );

                    $update = $this->common_model->customInsert($option);
             } 

            $response = array('status' => 1, 'message' => 'Data updated successfully', 'url' => base_url('testimonial'));
        }

        echo json_encode($response);
    }
    
}
