<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class WebBanner extends Common_Controller {

    public $data = array();
    public $file_data = "";
    public $_table = 'banner';

    public function __construct() {
        parent::__construct();
    }

    /**
     * @method index
     * @description listing display
     * @return array
     */
    public function index() {
        $this->data['parent'] = "WebBanner";
        $this->data['title'] = "Web Banner";
        $option = array('table' => $this->_table, 'select' => 'id,url,image,banner_name,status,delete_status,create_date,banner_type',
            'where' => array('delete_status' => 0, 'banner_type!=' => 'APP')
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
        $this->data['title'] = 'Add Web Banner';
        $this->load->view('add', $this->data);
    }

    /**
     * @method cms_add
     * @description add dynamic rows
     * @return array
     */
    public function banner_add() {

        $banner_type = $this->input->post('banner_type');
        if ($banner_type == 2) {
            $this->form_validation->set_rules('url', 'Url', 'required|trim');
        }
        $this->form_validation->set_rules('banner_type', 'Banner Type', 'required|trim');

        if (empty($_FILES['image']['name'])) {
            $this->form_validation->set_rules('image', 'Image', 'required');
        }
        if ($this->form_validation->run() == true) {

            $bannerType = $this->input->post('banner_type');
            $this->filedata['status'] = 1;
            $image = "";
            if (!empty($_FILES['image']['name'])) {
                if($bannerType == 2){
                   $this->filedata = $this->commonUploadImageDynamic($_POST, 'banner', 'image', 90, 1280, 2024, 2024, 1024); 
                }else{
                   $this->filedata = $this->commonUploadImageDynamic($_POST, 'banner', 'image', 850, 1920, 2024, 2024, 1024); 
                }
                
                if ($this->filedata['status'] == 1) {
                    $image = $this->filedata['upload_data']['file_name'];
                }
            }

            if ($this->filedata['status'] == 0) {

                $response = array('status' => 0, 'message' => $this->filedata['error']);
            } else {


                if ($banner_type == 1) {
                    $banner_type = 'WEB_SLIDER';
                } else if ($banner_type == 2) {
                    $banner_type = 'WEB_ADVERTISEMENT';
                }
                $banner_name = $this->input->post('banner_name');

                $options_data = array(
                    'banner_type' => $banner_type,
                    'banner_name' => $this->input->post('banner_name'),
                    'url' => $this->input->post('url'),
                    'image' => $image,
                    'create_date' => datetime(),
                    'status' => 1,
                );
                //  print_r($options_data);die;

                $option = array('table' => $this->_table, 'data' => $options_data);
                if ($this->common_model->customInsert($option)) {


                    $response = array('status' => 1, 'message' => 'Banner successfully added', 'url' => base_url('webBanner'));
                } else {
                    $response = array('status' => 0, 'message' => 'Banner failed to added');
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
    public function banner_edit() {
        $this->data['title'] = 'Edit Web Banner';
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
                redirect('banner');
            }
        } else {
            $this->session->set_flashdata('error', lang('not_found'));
            redirect('banner');
        }
    }

    /**
     * @method cms_update
     * @description update dynamic rows
     * @return array
     */
    public function banner_update() {

        $banner_type = $this->input->post('banner_type');
        if ($banner_type == 2) {
            $this->form_validation->set_rules('url', 'Url', 'required|trim');
        }
        // if (empty($_FILES['image']['name'])) {
        //       $this->form_validation->set_rules('image', 'Image', 'required');
        //   }
        $this->form_validation->set_rules('banner_type', 'Banner Type', 'required|trim');
        $where_id = $this->input->post('id');
        if ($this->form_validation->run() == FALSE):
            $messages = (validation_errors()) ? validation_errors() : '';
            $response = array('status' => 0, 'message' => $messages);
        else:
            $this->filedata['status'] = 1;
            $image = $this->input->post('exists_image');
            $bannerType = $this->input->post('banner_type');
            if (!empty($_FILES['image']['name'])) {
                if($bannerType == 2){
                   $this->filedata = $this->commonUploadImageDynamic($_POST, 'banner', 'image', 90, 1280, 2024, 2024, 1024); 
                }else{
                   $this->filedata = $this->commonUploadImageDynamic($_POST, 'banner', 'image', 850, 1920, 2024, 2024, 1024); 
                }

                if ($this->filedata['status'] == 1) {
                    $image = $this->filedata['upload_data']['file_name'];
                    // $full_path = $this->filedata['upload_data']['full_path'];
                    //$folder = "cms/thumb";
                    //$this->resizeNewImage($full_path,$folder,480,828);
                    delete_file($this->input->post('exists_image'), FCPATH . "uploads/banner/");
                }
            }

            if ($this->filedata['status'] == 0) {
                $response = array('status' => 0, 'message' => $this->filedata['error']);
            } else {
                if ($banner_type == 1) {
                    $banner_type = 'WEB_SLIDER';
                } else if ($banner_type == 2) {
                    $banner_type = 'WEB_ADVERTISEMENT';
                }

                $options_data = array(
                    'banner_type' => $banner_type,
                    'banner_name' => $this->input->post('banner_name'),
                    'url' => $this->input->post('url'),
                    'image' => $image
                );
                $option = array(
                    'table' => $this->_table,
                    'data' => $options_data,
                    'where' => array('id' => $where_id)
                );
                $update = $this->common_model->customUpdate($option);
                $response = array('status' => 1, 'message' => 'Banner updated successfully', 'url' => base_url('webBanner'));
            }

        endif;

        echo json_encode($response);
    }

}
