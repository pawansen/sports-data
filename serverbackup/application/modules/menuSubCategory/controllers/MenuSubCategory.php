<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MenuSubCategory extends Common_Controller {

    public $data = array();
    public $file_data = "";
    public $_table = 'item_subcategory';

    public function __construct() {
        parent::__construct();
    }

    /**
     * @method index
     * @description listing display
     * @return array
     */
    public function index() {
        $this->data['url'] = base_url() . 'menuSubCategory';
        $this->data['pageTitle'] = "Add Item Sub Category";
        $this->data['title'] = "Sub Category";
        $this->data['parent'] = "itemsubcat";
        $option = array(
            'table' => $this->_table . ' as subcat',
            'select' => 'subcat.*,item_category.category_name',
            'join' => array('item_category' => 'item_category.id=subcat.category_id')
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
        $this->data['title'] = "Add Menu Sub Category";
        $option = array('table' => "item_category", 'where' => array('delete_status' => 0));
        $this->data['list'] = $this->common_model->customGet($option);
        $this->load->view('add', $this->data);
    }

    /**
     * @method menu_category_add
     * @description add dynamic rows
     * @return array
     */
    public function menu_category_add() {

        $this->form_validation->set_rules('category_name', "Category", 'required|trim');
        $this->form_validation->set_rules('sub_category_name', "Sub Category Name", 'required|trim');
        if ($this->form_validation->run() == true) {
            $this->filedata['status'] = 1;
            $image = "";
            if (!empty($_FILES['image']['name'])) {
                $this->filedata = $this->commonUploadImage($_POST, 'submenu', 'image');
                if ($this->filedata['status'] == 1) {
                    $image = 'uploads/submenu/' . $this->filedata['upload_data']['file_name'];
                }
            }
            if ($this->filedata['status'] == 0) {
                $response = array('status' => 0, 'message' => $this->filedata['error']);
            } else {
                $options_data = array(
                    'category_id' => $this->input->post('category_name'),
                    'subcategory_name' => $this->input->post('sub_category_name'),
                    'description' => $this->input->post('description'),
                    'image' => $image,
                    'is_active' => 1,
                    'create_date' => datetime()
                );
                $option = array('table' => $this->_table, 'data' => $options_data);
                if ($this->common_model->customInsert($option)) {
                    $response = array('status' => 1, 'message' => "Successfully added", 'url' => base_url('menuSubCategory'));
                } else {
                    $response = array('status' => 0, 'message' => "Failed to add");
                }
            }
        } else {
            $messages = (validation_errors()) ? validation_errors() : '';
            $response = array('status' => 0, 'message' => $messages);
        }
        echo json_encode($response);
    }

    /**
     * @method menu_category_edit
     * @description edit dynamic rows
     * @return array
     */
    public function menu_category_edit() {
        $this->data['title'] = "Edit Menu Sub Category";
        $id = decoding($this->input->post('id'));
        if (!empty($id)) {
            $option = array('table' => "item_category", 'where' => array('delete_status' => 0));
            $this->data['list'] = $this->common_model->customGet($option);
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
                redirect('menuCategory');
            }
        } else {
            $this->session->set_flashdata('error', lang('not_found'));
            redirect('menuCategory');
        }
    }

    /**
     * @method menu_category_update
     * @description update dynamic rows
     * @return array
     */
    public function menu_category_update() {

        $this->form_validation->set_rules('category_name', "Category", 'required|trim');
        $this->form_validation->set_rules('sub_category_name', "Sub Category Name", 'required|trim');
        $where_id = $this->input->post('id');
        if ($this->form_validation->run() == FALSE):
            $messages = (validation_errors()) ? validation_errors() : '';
            $response = array('status' => 0, 'message' => $messages);
        else:
            $this->filedata['status'] = 1;
            $image = $this->input->post('exists_image');

            if (!empty($_FILES['image']['name'])) {
                $this->filedata = $this->commonUploadImage($_POST, 'submenu', 'image');
                if ($this->filedata['status'] == 1) {
                    $image = 'uploads/submenu/' . $this->filedata['upload_data']['file_name'];
                    delete_file($this->input->post('exists_image'), FCPATH);
                }
            }
            if ($this->filedata['status'] == 0) {
                $response = array('status' => 0, 'message' => $this->filedata['error']);
            } else {

                $options_data = array(
                    'category_id' => $this->input->post('category_name'),
                    'subcategory_name' => $this->input->post('sub_category_name'),
                    'description' => $this->input->post('description'),
                    'image' => $image
                );
                $option = array(
                    'table' => $this->_table,
                    'data' => $options_data,
                    'where' => array('id' => $where_id)
                );
                $update = $this->common_model->customUpdate($option);
                $response = array('status' => 1, 'message' => "Successfully updated", 'url' => base_url('menuSubCategory'));
            }
        endif;

        echo json_encode($response);
    }

    function deleteSubCategory() {
        $id = decoding($this->input->post('id'));
        if (!empty($id)) {
            $option = array(
                'table' => $this->_table,
                'where' => array('id' => $id)
            );
            $results_row = $this->common_model->customDelete($option);
            if (!empty($results_row)) {
                echo 200;
            } else {
                echo 400;
            }
        } else {
            echo 400;
        }
    }

}
