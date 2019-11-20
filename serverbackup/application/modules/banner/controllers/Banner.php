<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends Common_Controller {

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
        $this->data['parent'] = "Banner";
        $this->data['title'] = "Banner";
        $option = array('table' => $this->_table, 'select' => 'id,url,image,banner_name,status,delete_status,create_date',
            'where' => array('delete_status' => 0)
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
        $this->data['title'] = 'Add Banner';
        $this->load->view('add', $this->data);
    }

    /**
     * @method cms_add
     * @description add dynamic rows
     * @return array
     */
    public function banner_add() {

//        $this->form_validation->set_rules('url', 'Url', 'required|trim');
//        $this->form_validation->set_rules('banner_name', 'Banner Name', 'required|trim');
//
//
//        if ($this->form_validation->run() == true) {


            $this->filedata['status'] = 1;
            $image = "";
            if (!empty($_FILES['image']['name'])) {
                $this->filedata = $this->commonUploadImageDynamic($_POST, 'banner', 'image', 50, 50, 8024, 8024, 8024);
                if ($this->filedata['status'] == 1) {
                    $image = $this->filedata['upload_data']['file_name'];
                    //$full_path = $this->filedata['upload_data']['full_path'];
                    //$folder = "cms/thumb";
                    //$this->resizeNewImage($full_path,$folder,480,828);
                }
            }

            if ($this->filedata['status'] == 0) {
                $response = array('status' => 0, 'message' => $this->filedata['error']);
            } else {
                $banner_name = $this->input->post('banner_name');
                // $option = array(
                //     'table' => $this->_table,
                //     'where' => array('banner_name' => $banner_name)
                // );
                // $banner = $this->common_model->customGet($option);
                // if (empty($banner)) {
                    $options_data = array(
                        'banner_name' => null,
                        'url' => null,
                        'image' => $image,
                        'create_date' => datetime(),
                        'status' => 1,
                    );

                    $option = array('table' => $this->_table, 'data' => $options_data);
                    if ($this->common_model->customInsert($option)) {


                        $response = array('status' => 1, 'message' => 'Banner successfully added', 'url' => base_url('banner'));
                    } else {
                        $response = array('status' => 0, 'message' => 'Banner failed to added');
                    }
                // } else {
                //     $response = array('status' => 0, 'message' => 'Banner already exist');
                // }
            }
//        } else {
//            $messages = (validation_errors()) ? validation_errors() : '';
//            $response = array('status' => 0, 'message' => $messages);
//        }
        echo json_encode($response);
    }

    /**
     * @method cms_edit
     * @description edit dynamic rows
     * @return array
     */
    public function banner_edit() {
        $this->data['title'] = 'Edit Banner';
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

//        $this->form_validation->set_rules('url', 'Url', 'required|trim');
//        $this->form_validation->set_rules('banner_name', 'Banner Name', 'required|trim');
//
//        $where_id = $this->input->post('id');
//        if ($this->form_validation->run() == FALSE):
//            $messages = (validation_errors()) ? validation_errors() : '';
//            $response = array('status' => 0, 'message' => $messages);
//        else:
            $where_id = $this->input->post('id');
            $this->filedata['status'] = 1;
            $image = $this->input->post('exists_image');

            if (!empty($_FILES['image']['name'])) {
                $this->filedata = $this->commonUploadImageDynamic($_POST, 'banner', 'image', 50, 50, 8024, 8024, 8024);

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

                $options_data = array(
                    'banner_name' => null,
                    'url' => null,
                    'image' => $image
                );
                $option = array(
                    'table' => $this->_table,
                    'data' => $options_data,
                    'where' => array('id' => $where_id)
                );
                $update = $this->common_model->customUpdate($option);
                $response = array('status' => 1, 'message' => 'Banner updated successfully', 'url' => base_url('banner'));
            }

//        endif;

        echo json_encode($response);
    }

}
