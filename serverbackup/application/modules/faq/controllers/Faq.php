<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends Common_Controller { 
    public $data = array();
    public $file_data = "";
   // public $_table = CMS;
    public function __construct() {
        parent::__construct();
    }
    
     /**
     * @method index
     * @description listing display
     * @return array
     */
    public function index() {
        $this->data['parent'] = "Faq";
        $this->data['title'] = "Faq";
         $option = array('table' => 'faq',
            'select' => 'faq.id,faq.question,faq.answer,faq.created_date,cat.category_name',
            'join' => array('faq_category as cat' => 'cat.id=faq.category_id'),
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
        $this->data['title'] = 'Add Faq';

         $option = array('table' => 'faq_category',
            'select' => '*',
            );
        
        $this->data['category'] = $this->common_model->customGet($option);


        $this->load->view('add', $this->data);
     }

      function open_category_model() {
        $this->data['title'] = 'Add Category';

        //  $option = array('table' => 'faq_category',
        //     'select' => '*',
        //     );
        
        // $this->data['category'] = $this->common_model->customGet($option);


        $this->load->view('add_category', $this->data);
     }
   
   

    /**
     * @method cms_add
     * @description add dynamic rows
     * @return array
     */
    public function faq_add() {
        
        $this->form_validation->set_rules('category_id', 'Category Id', 'required|trim');
        $this->form_validation->set_rules('question', 'Question', 'required|trim');
        $this->form_validation->set_rules('answer', 'Answer', 'required|trim');
       
         
        if ($this->form_validation->run() == true) {        
                
                    
                     $options_data = array(
                       
                        'category_id'    => $this->input->post('category_id'),
                        'question'       => $this->input->post('question'),
                        'answer'         => $this->input->post('answer'),
                        'created_date'   => datetime()
                    );
               
                    $option = array('table' => 'faq', 'data' => $options_data);
                    if ($this->common_model->customInsert($option)) {
                     

                        $response = array('status' => 1, 'message' => 'Faq successfully added', 'url' => base_url('faq'));
                    
                }else {
                        $response = array('status' => 0, 'message' => 'Faq failed to added');
                    }  
                
          
        } else {
            $messages = (validation_errors()) ? validation_errors() : '';
            $response = array('status' => 0, 'message' => $messages);
        }
        echo json_encode($response);
    }

    /**
     * @method category_add
     * @description add dynamic rows
     * @return array
     */
    public function category_add() {
        
        $this->form_validation->set_rules('category_name', 'Category Name', 'required|trim');
       
         
        if ($this->form_validation->run() == true) {        
                
                    
                     $options_data = array(
                       
                        'category_name'    => $this->input->post('category_name'),
                        'created_date'    => datetime()
                    );
               
                    $option = array('table' => 'faq_category', 'data' => $options_data);
                    if ($this->common_model->customInsert($option)) {
                     

                        $response = array('status' => 1, 'message' => 'Category successfully added', 'url' => base_url('faq'));
                    
                }else {
                        $response = array('status' => 0, 'message' => 'Category failed to added');
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
    public function faq_edit() {
        $this->data['title'] = 'Edit Faq';
        $id = decoding($this->input->post('id'));
        if (!empty($id)) {

            $option = array(
                'table' => 'faq',
                'where' => array('id' => $id),
                'single' => true
            );
            $results_row = $this->common_model->customGet($option);

            $option = array('table' => 'faq_category',
            'select' => '*',
            );
        
           $this->data['category'] = $this->common_model->customGet($option);

            if (!empty($results_row)) {
                $this->data['results'] = $results_row;
                $this->load->view('edit', $this->data);
            } else {
                $this->session->set_flashdata('error', lang('not_found'));
                redirect('faq');
            }
        } else {
            $this->session->set_flashdata('error', lang('not_found'));
            redirect('faq');
        }
    }

    /**
     * @method cms_update
     * @description update dynamic rows
     * @return array
     */
    public function faq_update() {

        $this->form_validation->set_rules('question', 'Question', 'required|trim');
        $this->form_validation->set_rules('answer', 'Answer', 'required|trim');
        

        $where_id = $this->input->post('id');
        if ($this->form_validation->run() == FALSE):
            $messages = (validation_errors()) ? validation_errors() : '';
            $response = array('status' => 0, 'message' => $messages);
        else:
    
                   $options_data = array(
                        'category_id' => $this->input->post('category_id'),
                        'question' => $this->input->post('question'),
                        'answer' => $this->input->post('answer'),
                        
                    );
                    $option = array(
                        'table' => 'faq',
                        'data' => $options_data,
                        'where' => array('id' => $where_id)
                    );
                    $update = $this->common_model->customUpdate($option);
                    $response = array('status' => 1, 'message' => 'Faq updated successfully', 'url' => base_url('faq'));
          

        endif;

        echo json_encode($response);
    }
}
