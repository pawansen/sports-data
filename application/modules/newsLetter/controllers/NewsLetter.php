<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class NewsLetter extends Common_Controller { 
    public $data = array();
    public $file_data = "";
    public $_table = 'vendor_sale_newsletter';
    public function __construct() {
        parent::__construct();
    }
    
     /**
     * @method index
     * @description listing display
     * @return array
     */
    public function index() {
        $this->data['parent'] = "NewsLetter";
        $this->data['title'] = "NewsLetter";
         $option = array('table' => 'vendor_sale_newsletter',
            'select' => '*',
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
        $this->data['parent'] = "NewsLetter";
        $this->data['title'] = 'Add NewsLetter';
        $option = array('table' => USERS . ' as user',
        'select' => 'user.*,group.name as group_name,UP.doc_file',
        'join' => array(array(USER_GROUPS . ' as ugroup', 'ugroup.user_id=user.id', 'left'),
            array(GROUPS . ' as group', 'group.id=ugroup.group_id', 'left'),
            array('user_profile UP', 'UP.user_id=user.id', 'left')),
                'order' => array('user.id' => 'ASC'),
                'where' => array('user.delete_status' => 0,
                'group.id' => 3),
        'order' => array('user.id' => 'desc')
    );
    $this->data['vendors'] = $this->common_model->customGet($option);

    $option = array('table' => USERS . ' as user',
        'select' => 'user.*,group.name as group_name,UP.doc_file',
        'join' => array(array(USER_GROUPS . ' as ugroup', 'ugroup.user_id=user.id', 'left'),
            array(GROUPS . ' as group', 'group.id=ugroup.group_id', 'left'),
            array('user_profile UP', 'UP.user_id=user.id', 'left')),
                'order' => array('user.id' => 'ASC'),
                'where' => array('user.delete_status' => 0,
                'group.id' => 2),
        'order' => array('user.id' => 'desc')
    );
    $this->data['users'] = $this->common_model->customGet($option);
        $this->load->admin_render('newsletterAdd', $this->data, 'inner_script');
     }

    function news_add(){
      $this->form_validation->set_rules('description[]', 'Message', 'required|trim');
      $this->form_validation->set_rules('userType', 'Select Sender', 'required|trim');
      $this->form_validation->set_rules('subject', 'Subject', 'required|trim');
         
     if ($this->form_validation->run() == true) {
            $templatearray=array();
            $ct = count($_POST['description']);
            for($i=0;$i<$ct;$i++){
                    $temp['img'] = "";
                    if($i > 0){
                        if (!empty($_FILES['files'.$i]['name'])) {
                            $t1 = $this->commonUploadImage($_POST, 'cms', 'files'.$i);
                            if ($t1['status'] == 1) {
                                $temp['img'] = 'uploads/cms/' . $t1['upload_data']['file_name'];
                            }
                        }
                    }else{
                        if (!empty($_FILES['files']['name'])) {
                            $t2 = $this->commonUploadImage($_POST, 'cms', 'files');
                            if ($t2['status'] == 1) {
                                $temp['img'] = 'uploads/cms/' . $t2['upload_data']['file_name'];
                            }
                        }
                    }
                    $temp['title'] = $_POST['title'][$i];
                    $temp['description'] = $_POST['description'][$i];
                    $templatearray[] = $temp;

            }
            $options_data = array(
                    'title'    => $this->input->post('subject'),
                    'description'    => json_encode($templatearray),
                    'user_type'    => $this->input->post('userType'),
                    'users'    => json_encode($this->input->post('email')),
                    'create_date'    => datetime(),
                    'is_active'      => 1,
                );
                $option = array('table' => $this->_table, 'data' => $options_data);
                if ($this->common_model->customInsert($option)) {
                    $response = array('status' => 1, 'message' => 'Successfully Saved', 'url' => base_url('newsLetter'));
                
            }else {
                    $response = array('status' => 0, 'message' => "Failed");
                } 
             
        } else {
            $messages = (validation_errors()) ? validation_errors() : '';
            $response = array('status' => 0, 'message' => $messages);
        }
        echo json_encode($response);
    }
   
    public function getList()
    {
      $this->data['parent'] = "NewsLetter";
      $this->data['title'] = "Send NewsLetter";
      $option = array('table' => 'vendor_sale_newsletter',
            'select' => '*',
            'where' => array('id' => $_GET['id'], 'delete_status'=> 0)
            );
      $getUsers = array(
           'table' => 'vendor_sale_newsletter_subscription',
           'select' => 'user_id',
           'where' => array('delete_status' => 0)
        );
      $this->data['NewsList'] = $this->common_model->customGet($option);
      $this->data['UsersList'] = $this->common_model->customGet($getUsers);
      $this->load->admin_render('sendMail', $this->data,'inner_script');
    }


    /**
     * @method cms_add
     * @description add dynamic rows
     * @return array
     */
    public function send_news() {
        
        $this->form_validation->set_rules('description', 'Message', 'trim');
         
        if ($this->form_validation->run() == true) {

          $message = $this->input->post('description');
            if ($this->input->post('userType') == 'All') {
              $option = array(
                   'table' => 'vendor_sale_newsletter_subscription',
                   'select' => 'user_id',
                   'where' => array('delete_status' => 0)
                );
              $getMail = $this->common_model->customGet($option);
            }else{
              $getMail = $this->input->post('email');
            }
            if(!empty($getMail))
            {
                foreach($getMail as $mail)
                {
                    $email = $mail->email;

                    $html = array();
                    $html['email'] = $email;
                    $html['logo'] = base_url() . getConfig('site_logo');
                    $html['site'] = getConfig('site_name');
                    $html['message'] = $message;
                    $email_template = $this->load->view('email/newsLetter_tpl', $html, true);
                   
                    $status = send_mail($email_template, '[' . getConfig('site_name') . '] NewsLetter Subscription', $email, 'gaurav@gmail.com');
                }
            }
            $response = array('status' => 1, 'message' => 'Mail send successfully', 'url' => base_url('newsLetter'));
             
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
    public function news_edit() {
        $this->data['title'] = 'Edit NewsLetter';
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
                redirect('newsLetter');
            }
        } else {
            $this->session->set_flashdata('error', lang('not_found'));
            redirect('newsLetter');
        }
    }

    /**
     * @method cms_update
     * @description update dynamic rows
     * @return array
     */
    public function news_update() {

        $this->form_validation->set_rules('title', "Title", 'required|trim');
        $this->form_validation->set_rules('description', 'Message', 'required|trim');
        

        $where_id = $this->input->post('id');
        if ($this->form_validation->run() == FALSE):
            $messages = (validation_errors()) ? validation_errors() : '';
            $response = array('status' => 0, 'message' => $messages);
        else:
                $this->filedata['status'] = 1;
                $image = $this->input->post('exists_image');

                if (!empty($_FILES['image']['name'])) {
                    $this->filedata = $this->commonUploadImage($_POST, 'cms', 'image');
                    
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
                        'title' => $this->input->post('title'),
                        'description' => $this->input->post('description')
                    );
                    $option = array(
                        'table' => $this->_table,
                        'data' => $options_data,
                        'where' => array('id' => $where_id)
                    );
                    $update = $this->common_model->customUpdate($option);
                    $response = array('status' => 1, 'message' => lang('cms_success_update'), 'url' => base_url('newsLetter'));
              }  

        endif;

        echo json_encode($response);
    }

    public function export_newsletter() {
      
      $from_date = $this->input->post('from_date');
      $to_date = $this->input->post('to_date');

     
        $option = array(
            'table' => 'vendor_sale_newsletter as news',
            'select' => 'news.*', 
            'where' => array('delete_status' => 0)
        );
         if (!empty($from_date) && !empty($to_date)) {
            $from_date = date('Y-m-d', strtotime($from_date));   
            $to_date = date('Y-m-d', strtotime($to_date));
            
            if($to_date=='1970-01-01')
            {
                $option['where']['DATE(datetime) >='] = $from_date;
            }
           else{
               $option['where']['DATE(datetime) >='] = $from_date;
               $option['where']['DATE(datetime) <='] = $to_date;
            }
          
        } 


        $users = $this->common_model->customGet($option);

        
        // $userslist = $this->Common_model->getAll(USERS,'name','ASC');
        $print_array = array();
        $i = 1;
        foreach ($users as $value) {


            $print_array[] = array('s_no' => $i, 'email' => $value->email);
            $i++;
        }

        $filename = "NewsLetter.csv";
        $fp = fopen('php://output', 'w');

        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=' . $filename);
        fputcsv($fp, array('S.no', 'Email'));

        foreach ($print_array as $row) {
            fputcsv($fp, $row);
        }
        $this->session->set_flashdata('success', "Successfully Exported");
    }

    function getMoreNewsletter(){
        $data=array();
        $data['key'] = rand();
        $this->load->view("more_news_letter",$data);
    }
}
