<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends Common_Controller {

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
        $this->data['parent'] = "Notification";
        $this->data['title'] = "Notification";
        $this->load->admin_render('list', $this->data, 'inner_script');
    }

    /**
     * @method get_notification
     * @description listing display of notification
     * @return array
     */
    public function get_notification_list() {
        $columns = array('id',
            'user',
            'message',
            'sent_time',
            'action',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $where = ' notifications.id IS NOT NULL AND user_type="ADMIN" AND notifications.delete_status = 0 ';
        if (!empty($this->input->post('search')['value'])) {
            $search = $this->input->post('search')['value'];
            $where.= ' and (date(sent_time) like "%' . $search . '%" or message like "%' . $search . '%") ';
        }
        $data = array();
        $totalData = 0;
        $totalFiltered = 0;
        $option = array(
            'table' => 'notifications',
            'where' => $where,
        );
        $totalList = $this->common_model->customCount($option);
        if (!empty($totalList) && $totalList != 0) {
            $totalData = $totalList;
            $totalFiltered = $totalData;
            $option = array(
                'table' => 'notifications',
                'select' => 'notifications.*,users.first_name,users.email',
                'join' => array('users' => 'users.id=notifications.sender_id'),
                'where' => $where,
                'order' => array($order => $dir),
                'limit' => array($limit => $start)
            );
            $list = $this->common_model->customGet($option);
            if (!empty($list)) {
                foreach ($list as $rows) {
                    $start++;
                    $nestedData['id'] =  ($rows->read_status == 'NO') ? $start. " <span class='text-danger badge'> New </span>" : $start;
                    $nestedData['user'] = isset($rows->first_name) ? "<span class='btn text-success label-lg'>".$rows->first_name.' ('.$rows->email.')</span>' : '';
                    $nestedData['message'] = isset($rows->message) ? $rows->message : '';
                    $nestedData['sent_time'] = isset($rows->sent_time) ? date("d-m-Y", strtotime($rows->sent_time)) : '';
                    //$nestedData['status'] = isset($match->status) ? ($match->status == "open") ? "<p class='text-success'>" . strtoupper($match->status) . "</p>" : "<p class='text-danger'>" . strtoupper($match->status) . "</p>" : '';
                    $action = "";
                    if($rows->noti_type == "JOIN_CONTEST"){
                        $action = '<a href="' . base_url() . 'users/joinContest/' . encoding($rows->sender_id).'" title="Go" class="btn btn-info"> <img width="18" src="' . base_url() . CRICKET_ICON . '" /> Go </a>';
                    }
                    if($rows->noti_type == "CREATE_CONTEST"){
                        $action = '<a href="' . base_url() . 'users/contest/' . encoding($rows->sender_id).'" title="Go" class="btn btn-info"> <img width="18" src="' . base_url() . CRICKET_ICON . '" /> Go </a>';
                    }
                    $nestedData['action'] = $action;
                    $data[] = $nestedData;
                }
            }
        }
        $json_data = array(
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        echo json_encode($json_data);
    }

    function NotificationAdmin() {
        $dates = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") - 7, date("Y")));
        $options = array(
            'table' => 'notifications as notify',
            'select' => 'notify.*,user.first_name,user.profile_pic',
            'join' => array('users as user' => 'user.id=notify.sender_id'),
            'where' => array(
                'notify.read_status' => 'NO',
                'DATE(notify.sent_time) >=' => $dates,
                'notify.user_type' => 'ADMIN',
                'notify.delete_status' => 0
            ),
            'order' => array('notify.id' => 'DESC'),
        );
        $data['notification'] = $this->common_model->customGet($options);
        $this->load->view('notification_list', $data);
    }

    function read_notification_admin() {
        $delId = decoding($_GET['q']);
        if (!empty($delId)) {
            foreach ($delId as $rows) {
                $options = array(
                    'table' => 'notifications',
                    'data' => array('read_status' => 'YES'),
                    'where' => array(
                        'read_status' => 'NO',
                        'id' => $rows
                    )
                );
                $this->common_model->customUpdate($options);
            }
        }

        redirect('notification');
    }

}
