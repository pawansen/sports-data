<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contest extends Common_Controller {

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
    public function index($matchId = "") {
        $this->data['parent'] = "Contest";
        $this->data['title'] = "Contest";
        $todayDate = date('Y-m-d');
        $options = array(
            'table' => 'matches',
            'where' => array('date(match_date)>=' => $todayDate),
            'order' => array('match_date' => 'asc')
        );
        $matchDetails = $this->common_model->customGet($options);
        $this->data['match_details'] = $matchDetails;
        $options = array(
            'table' => 'matches',
            'order' => array('match_date' => 'asc')
        );
        $matchList = $this->common_model->customGet($options);
        $this->data['allMatchList'] = $matchList;
        if (!empty($matchId)) {
            $this->data['matchId'] = $matchId;
        }

        $this->load->admin_render('list', $this->data, 'inner_script');
    }

    /**
     * @method open_model
     * @description load model box
     * @return array
     */
    function add_contest($match_id = "") {
        $this->data['parent'] = "Contest";
        $this->data['title'] = "Contest";
        $this->data['match_id'] = $match_id;
        if ($this->input->post()) {
            $match_type = $this->input->post('match_type');
            $this->form_validation->set_rules('contest_sizes', lang('contest_size'), 'required|trim');
            $this->form_validation->set_rules('match_type', lang('match_type'), 'required|trim');
            $this->form_validation->set_rules('matches[]', lang('select_matches'), 'required|trim');
            $customize_winning = $this->input->post('customize_winnings');
            // print_r($customize_winning);die;
            if ($customize_winning == 'on') {
                $this->form_validation->set_rules('no_of_winners', lang('no_of_winners'), 'required|trim');
                // $this->session->set_flashdata('error', "Error in adding contest ! Please try again later.");
                // exit;
            }
            if ($match_type == 1) {
                $this->form_validation->set_rules('total_winning_amount', lang('total_winning_amount'), 'required|trim');
                $this->form_validation->set_rules('entry_fee', "Entry Fee", 'required|trim');
            }
            if ($this->form_validation->run() == true) {
                $entry_fee = $this->input->post('entry_fee');
                $matches = $this->input->post('matches');

                $contest_name = (!empty($this->input->post('contest_name'))) ? $this->input->post('contest_name') : "Win " . $this->input->post('total_winning_amount').' /Team '.$this->input->post('contest_sizes').' /Pay '.$this->input->post('entry_fee');


                $total_winning_amount = $this->input->post('total_winning_amount');
                $contest_size = $this->input->post('contest_sizes');
                $match_type = $this->input->post('match_type');
                $publish = $this->input->post('publish');
                $no_of_winners = $this->input->post('no_of_winners');
                if ($match_type == 1) {
                    if ($entry_fee > 0) {
                        if (!empty($matches)) {
                            for ($i = 0; $i < count($matches); $i++) {
                                $insertData['contest_name'] =  (!empty($this->input->post('contest_name'))) ? $this->input->post('contest_name') : "Win " . $this->input->post('total_winning_amount').' /Team '.$this->input->post('contest_sizes').' /Pay '.$this->input->post('entry_fee');
                                $insertData['total_winning_amount'] = $this->input->post('total_winning_amount');
                                $insertData['contest_size'] = $this->input->post('contest_sizes');
                                $insertData['match_type'] = $this->input->post('match_type');
                                $admin_percentage =  $this->input->post('admin_percentage');
                                $insertData['admin_percentage'] = $admin_percentage;
                                $insertData['publish'] = $this->input->post('publish');
                                $insertData['user_invite_code'] = commonUniqueCode();
                                if ($this->input->post('multi_entry'))
                                    $insertData['is_multientry'] = 1;
                                else
                                    $insertData['is_multientry'] = 0;
                                if ($this->input->post('customize_winnings'))
                                    $insertData['customize_winning'] = 1;
                                else
                                    $insertData['customize_winning'] = 0;
                                if ($this->input->post('mega_contest'))
                                    $insertData['mega_contest'] = 1;
                                else
                                    $insertData['mega_contest'] = 0;

                                if ($this->input->post('confirmed_contest'))
                                    $insertData['confirm_contest'] = 1;
                                else
                                    $insertData['confirm_contest'] = 0;

                                $insertData['team_entry_fee'] = $this->input->post('entry_fee');
                                $insertData['chip'] = $this->input->post('chip_value');
                                $insertData['real_case'] = $this->input->post('real_money');
                                $insertData['chip_case'] = $this->input->post('chip');
                                if ($this->input->post('no_of_winners')) {
                                    $insertData['number_of_winners'] = $this->input->post('no_of_winners');
                                }

                                $insertData['create_date'] = date('Y-m-d H:i:s');
                                $customWinning = $this->input->post('customize_winnings');
                                if ($customWinning != 'on') {
                                    $insertData['number_of_winners'] = $this->input->post('contest_sizes');
                                }

                                if($insertData['contest_size']!=0 && $insertData['total_winning_amount']!=0){
                                    $per = $insertData['total_winning_amount'] / $insertData['contest_size'];
                                    $admin_per_rs = ($per * $insertData['admin_percentage'])/100;
                                }
                                $insertData['admin_prcnt_rs']=$admin_per_rs;
                               // print_r($insertData);die;
                                $option = array('table' => CONTEST, 'data' => $insertData);
                                $contestID = $this->common_model->customInsert($option);

                                $insert = array('contest_id' => $contestID,
                                    'match_id' => $matches[$i]);

                                $option1 = array('table' => CONTEST_MATCHES, 'data' => $insert);
                                $this->common_model->customInsert($option1);
                                if ($customWinning != 'on') {
                                    $contestSizes = $this->input->post('contest_sizes');
                                    $eachTeamWinngingAmuount = abs($total_winning_amount) / abs($contestSizes);
                                    $winnersInsert = array('contest_id' => $contestID,
                                        'from_winner' => 1,
                                        'to_winner' => $contestSizes,
                                        'percentage' => 100,
                                        'amount' => round($eachTeamWinngingAmuount, 2),
                                        'created_date' => date('Y-m-d H:i:s')
                                    );
                                    $option2 = array('table' => CONTEST_DETAILS, 'data' => $winnersInsert);
                                    $this->common_model->customInsert($option2);
                                } else {
                                    if ($this->input->post('select')) {
                                        $contestWinners = $this->input->post('select');
                                        foreach ($contestWinners as $row) {
                                            $winnersInsert = array('contest_id' => $contestID,
                                                'from_winner' => $row[0],
                                                'to_winner' => $row[1],
                                                'percentage' => $row[2],
                                                'amount' => $row[3],
                                                'created_date' => date('Y-m-d H:i:s')
                                            );
                                            $option2 = array('table' => CONTEST_DETAILS, 'data' => $winnersInsert);
                                            $this->common_model->customInsert($option2);
                                        }
                                    }
                                }
                            }
                        }
                        if ($contestID)
                            $this->session->set_flashdata('success', "Contest added successfully");
                        else
                            $this->session->set_flashdata('error', "Error in adding contest ! Please try again later.");
                        redirect('contest');
                    }else {
                        $UtcDateTime = trim(ISTToConvertUTC(date('Y-m-d H:i'), 'UTC', 'UTC'));
                        $options1 = array(
                            'table' => 'series',
                            'select' => 'series.*',
                            'join' => array('matches' => 'matches.series_id = series.sid'),
                            'where' => array('series.delete_status' => 0),
                            'group_by' => 'series.sid'
                        );
                        $seriesDetails = $this->common_model->customGet($options1);
                        if (!empty($seriesDetails)) {
                            $this->data['series_details'] = $seriesDetails;
                        }
                        $this->data['error'] = "Entry Fee can not be less than 1";
                        $todayDate = date('Y-m-d');
                        $options = array(
                            'table' => 'matches',
                            'where' => array('match_date_time >=' => $UtcDateTime,
                                'delete_status' => 0, 'status' => 'open'),
                            'order' => array('match_date' => 'asc')
                        );
                        $matchDetails = $this->common_model->customGet($options);
                        if (!empty($matchDetails)) {
                            $this->data['match_details'] = $matchDetails;
                        }
                    }
                } else {

                    $matches = $this->input->post('matches');
                    for ($i = 0; $i < count($matches); $i++) {
                        if ($this->input->post('customize_winnings'))
                            $customize_winning = 1;
                        else
                            $customize_winning = 0;
                        if ($this->input->post('no_of_winners')) {
                            $number_of_winners = $this->input->post('no_of_winners');
                        }
                        $customWinning = $this->input->post('customize_winnings');
                        if ($customWinning != 'on') {
                            $number_of_winners = $this->input->post('contest_sizes');
                        }
                        if ($total_winning_amount <= 0) {
                            $contest_name = "Win Skill"; 
                        }else{
                             $contest_name = "Free"; 
                        }
                        
                        $insertData = array('contest_name' => $contest_name,
                            'contest_size' => $contest_size,
                            'match_type' => $match_type,
                            'publish' => $publish,
                            'total_winning_amount' => (!empty($total_winning_amount)) ? $total_winning_amount : 0,
                            'customize_winning' => $customize_winning,
                            'number_of_winners' => $number_of_winners,
                            'confirm_contest' => 1,
                            'team_entry_fee' => 0,
                            'chip' => 0,
                            'real_case' => 0,
                            'chip_case' => 0,
                            'create_date' => date('Y-m-d H:i:s'),
                            'user_invite_code' => commonUniqueCode(),
                          
                        );

                        $option = array('table' => CONTEST, 'data' => $insertData);
                        $contestID = $this->common_model->customInsert($option);
                        $insert = array('contest_id' => $contestID,
                            'match_id' => $matches[$i]);
                        $option1 = array('table' => CONTEST_MATCHES, 'data' => $insert);
                        $this->common_model->customInsert($option1);

                        if ($total_winning_amount > 0) {
                            if ($customWinning != 'on') {
                                $contestSizes = $this->input->post('contest_sizes');
                                $eachTeamWinngingAmuount = abs($total_winning_amount) / abs($contestSizes);
                                $winnersInsert = array('contest_id' => $contestID,
                                    'from_winner' => 1,
                                    'to_winner' => $contestSizes,
                                    'percentage' => 100,
                                    'amount' => round($eachTeamWinngingAmuount, 2),
                                    'created_date' => date('Y-m-d H:i:s')
                                );
                                $option2 = array('table' => CONTEST_DETAILS, 'data' => $winnersInsert);
                                $this->common_model->customInsert($option2);
                            } else {
                                if ($this->input->post('select')) {
                                    $contestWinners = $this->input->post('select');
                                    foreach ($contestWinners as $row) {
                                        $winnersInsert = array('contest_id' => $contestID,
                                            'from_winner' => $row[0],
                                            'to_winner' => $row[1],
                                            'percentage' => $row[2],
                                            'amount' => $row[3],
                                            'created_date' => date('Y-m-d H:i:s')
                                        );
                                        $option2 = array('table' => CONTEST_DETAILS, 'data' => $winnersInsert);
                                        $this->common_model->customInsert($option2);
                                    }
                                }
                            }
                        }
                    }
                    if ($contestID)
                        $this->session->set_flashdata('success', "Contest added successfully");
                    else
                        $this->session->set_flashdata('error', "Error in adding contest ! Please try again later.");
                    redirect('contest');
                }
            }
        } else {
            $UtcDateTime = trim(ISTToConvertUTC(date('Y-m-d H:i'), 'UTC', 'UTC'));
            $options = array(
                'table' => 'matches',
                'where' => array('match_date_time >=' => $UtcDateTime,
                    'delete_status' => 0, 'status' => 'open'),
                'order' => array('match_date' => 'asc')
            );
            $matchDetails = $this->common_model->customGet($options);
            if (!empty($matchDetails)) {
                $this->data['match_details'] = $matchDetails;
            }
            $options1 = array(
                'table' => 'series',
                'select' => 'series.*',
                'join' => array('matches' => 'matches.series_id = series.sid'),
                'where' => array('series.delete_status' => 0),
                'group_by' => 'series.sid'
            );
            $seriesDetails = $this->common_model->customGet($options1);
            if (!empty($seriesDetails)) {
                $this->data['series_details'] = $seriesDetails;
            }
        }
        $this->load->admin_render('add', $this->data, 'inner_script');
    }

    /**
     * @method get_contest_list
     * @description listing display of match
     * @return array
     */
    public function get_contest_list() {
        $columns = array('s_no',
            //'match',
            'contest_name',
//            'match_type',
            'total_winning_amount',
            'contest_size',
            'number_of_winners',
            'team_entry_fee',
            'chip',
            'Win/Lose',
            'contest_status',
            'create_date',
            'status',
            'action',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $where = ' contest.user_id = 0 AND contest.delete_status = 0 AND contest.id IS NOT NULL';
        if (!empty($this->input->post('search')['value'])) {
            $search = $this->input->post('search')['value'];
            $where.= ' and (date(create_date) like "%' . $search . '%" or contest_name like "%' . $search . '%" or total_winning_amount like "%' . $search . '%" or contest_size like "%' . $search . '%" or number_of_winners like "%' . $search . '%" or team_entry_fee like "%' . $search . '%")';
        }

        if ($this->input->post('match') != '') {
            $where.= ' and contest_matches.match_id=' . $this->input->post('match');
        }

        if ($this->input->post('contest_type') != '') {
            if ($this->input->post('contest_type') == 'mega') {
                $where.= ' and contest.mega_contest=1';
            } else if ($this->input->post('contest_type') == 'cancel') {
                $where.= ' and contest.status=1';
            } else if ($this->input->post('contest_type') == 'complete') {
                $where.= ' and contest.status=2';
            } else if ($this->input->post('contest_type') == 'abandon') {
                $where.= ' and contest.status=3';
            }else if ($this->input->post('contest_type') == 'current') {
                $where.= ' and date(create_date)="' . date('Y-m-d') . '"';
            } else if ($this->input->post('contest_type') == 'running') {
                $where.= ' and contest.status=0';
            }
        }

        $data = array();
        $totalData = 0;
        $totalFiltered = 0;
        $contestDetails = $this->common_model->GetJoinRecord(CONTEST, 'id', CONTEST_MATCHES, 'contest_id', 'contest.*', $where, null, null, null, $limit, $start);
        //echo $this->db->last_query();
        //$matchDetails = $this->common_model->getAllwhere(CONTEST, $where);
        // dump($contestDetails);
        if (!empty($contestDetails) && $contestDetails['total_count'] != 0) {
            $contestIDs = array();
            $totalData = $contestDetails['total_count'];
            $totalFiltered = $totalData;

            $options = array('table' => CONTEST . ' as contest',
                'select' => 'contest.*,match.localteam,match.visitorteam,contest_matches.match_id,match.match_date,match.match_date_time,match.status as match_status,match.match_time',
                'join' => array(
                    array(CONTEST_MATCHES . ' as contest_matches', 'contest_matches.contest_id=contest.id', 'left'),
                    array(MATCHES . ' as match', 'match.match_id=contest_matches.match_id', 'left')),
                'order' => array('contest.id' => 'DESC'),
                'limit' => array($limit => $start),
                'where' => $where,
                'group_by' => 'contest.id'
                    //'where_not_in' => array('group.id' => array(1, 3))
            );

            $contestDetails = $this->common_model->customGet($options);
            if (!empty($contestDetails)) {
                foreach ($contestDetails as $contest) {
                    //foreach ($contestDetails['result'] as $contest) {
                    if (!in_array($contest->id, $contestIDs)) {
                        $contestIDs[] = $contest->id;
                        $start++;
                        $nestedData['s_no'] = $start;
                        //$nestedData['match'] = isset($contest->localteam) ? $contest->localteam . ' vs ' . $contest->visitorteam.' ('.date('d-m-Y',  strtotime($contest->match_date)).')' : '';
                        $matchName = isset($contest->localteam) ? '<div class="text-success font-weight-bold">' . $contest->localteam . ' vs ' . $contest->visitorteam . ' (' . date('d-m-Y', strtotime($contest->match_date)) . ')</div>' : '';
                        $nestedData['contest_name'] = isset($contest->contest_name) ? $contest->contest_name . '<br>' . $matchName : '';
                        $nestedData['total_winning_amount'] = isset($contest->total_winning_amount) ? '<i class="fa fa-inr" aria-hidden="true"></i> ' . $contest->total_winning_amount : '';
                        $nestedData['contest_size'] = isset($contest->contest_size) ? $contest->contest_size : '';
                        $nestedData['number_of_winners'] = isset($contest->number_of_winners) ? $contest->number_of_winners : '';
                        $nestedData['team_entry_fee'] = isset($contest->team_entry_fee) ? '<i class="fa fa-inr" aria-hidden="true"></i> ' . $contest->team_entry_fee : '';
                        $nestedData['chip'] = isset($contest->chip) ? $contest->chip : '';
                        $nestedData['Win/Lose'] = toCheckWinLose($contest->id);
                        ;
                        if ($contest->status == 0) {
                            $nestedData['contest_status'] = "<p class='text-warning'>" . 'RUNNING' . "</p>";
                        } else if ($contest->status == 1) {
                            $nestedData['contest_status'] = "<p class='text-danger'>" . 'CANCELLED' . "</p>";
                        } else if ($contest->status == 2) {
                            $nestedData['contest_status'] = "<p class='text-success'>" . 'COMPLETED' . "</p>";
                        }else if ($contest->status == 3){
                            $nestedData['contest_status'] = "<p class='text-danger'>" . 'ABANDON' . "</p>";
                        }

                        $nestedData['create_date'] = isset($contest->create_date) ? date("d-m-Y", strtotime($contest->create_date)) : '';

                        $multipleJoin = "No";
                        if (isset($contest->is_multientry) && $contest->is_multientry == 1)
                            $multipleJoin = "Yes";

                        $confirmContest = "No";
                        if (isset($contest->confirm_contest) && $contest->confirm_contest == 1)
                            $confirmContest = "Yes";

                        $megaContest = "No";
                        if (isset($contest->mega_contest) && $contest->mega_contest == 1)
                            $megaContest = "Yes";

                        $matchType = 'Practice';
                        if (isset($contest->match_type) && $contest->match_type == 1)
                            $matchType = 'Live';


                        $nestedData['status'] = "<div class='text-success'>Join Multiple Teams: <span class='text-danger'>$multipleJoin</span></div>"
                                . "<div class='text-success'>Mega Contest: <span class='text-danger'>$megaContest</span></div>"
                                . "<div class='text-success'>Confirm Contest: <span class='text-danger'>$confirmContest</span></div>"
                                . "<div class='text-success'>Match Type: <span class='text-danger'>$matchType</span></div>";


                        $statusArray = array();
                        $deleteArguments = "'contest','id','" . encoding($contest->id) . "','contest',''";
                        $action = '<select class="form-control" onchange="changeContestStatus(' . $contest->id . ',this)">
                                <option value="0"';

                        if ($contest->publish == 1) {

                            $url = ' <a href="javascript:void(0)" onclick="changePublishstatus(' . $contest->id . ',' . $contest->publish . ')" title="Unpublish" class="btn btn-danger"> <img width="18" src="' . base_url() . CRICKET_ICON . '" />Unpublish</a>';
                        } else if ($contest->publish == 0) {
                            $url = '<a href="javascript:void(0)" onclick="changePublishstatus(' . $contest->id . ',' . $contest->publish . ')" title="Publish" class="btn btn-primary"> <img width="18" src="' . base_url() . CRICKET_ICON . '" />Publish</a>';
                        }

                        if ($contest->status == 0) {
                            $action.='selected';
                        }
                        $action.='>Running</option>
                                <option value="1"';
                        if ($contest->status == 1) {
                            $action.='selected';
                        }
                        $action.='>Cancelled</option>
                                <option value="2"';
                        if ($contest->status == 2) {
                            $action.='selected';
                        }
        
                        $contestEditBtn = ' <a href="' . base_url() . 'contest/edit_contest/' . encoding($contest->id) . '" class="on-default edit-row text-danger"><img width="20" src="' . base_url() . EDIT_ICON . '" /></a>';
                        if ($contest->match_status == 'open') {
                            $UtcDateTime = trim(ISTToConvertUTC(date('Y-m-d H:i'), 'UTC', 'UTC'));
                            if (strtotime($contest->match_date . ' ' . $contest->match_time) <= strtotime($UtcDateTime)) {
                                $contestEditBtn = '';
                            }
                        } else {
                            $contestEditBtn = '';
                        }
                        $action.='>Completed</option> 
                        <option value="3"';
                        if ($contest->status == 3) {
                            $action.='selected';
                        }
                        $action.='>Abandon</option>                               
                            </select>
                            <br><a href="javascript:void(0)" onclick="deleteFn(' . $deleteArguments . ')" class="on-default edit-row text-danger"><img width="20" src="' . base_url() . DELETE_ICON . '" /></a>

                           
                            ' . $contestEditBtn . '

                            <a href="' . base_url() . 'contest/edit_contest/' . encoding($contest->id) . '/view" class="on-default edit-row text-danger"><img width="20" src="' . base_url() . VIEW_ICON . '" /></a>

                            <a href="' . base_url() . 'contestTeam/contestMatch/' . encoding($contest->id) . '" class="btn btn-info btn-sm"><img width="20" src="' . base_url() . CRICKET_ICON . '" />Participated Teams</a>' . $url;


                        //  if($contest->publish == 1){
                        // ' <a href="javascript:void(0)" onclick="changeMatchstatus(' . $contest->id . ',' . $contest->publish . ')" title="Publish" class="btn btn-primary"> <img width="18" src="'.base_url().CRICKET_ICON.'" /> Play On</a>'
                        //  }else if($contest->publish == 0){
                        //  $nestedData['play_status'] = '<a href="javascript:void(0)" onclick="changeMatchstatus(' . $contest->publish . ',' . $contest->publish . ')" title="Publish" class="btn btn-danger"> <img width="18" src="'.base_url().CRICKET_ICON.'" /> Play Off</a>';





                        $nestedData['action'] = $action;
                        $data[] = $nestedData;
                    }
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

    /**
     * @method getTeamPlayers
     * @description get players list user crated team
     * @return array
     */
    function getTeamPlayers() {
        $teamId = $this->input->post('teamId');
        $seriesId = $this->input->post('seriesId');
        $option = array('table' => 'user_team_player as utp',
            'select' => 'utp.id,utp.player_position,mp.team,mp.player_name',
            'join' => array('match_player as mp' => 'mp.player_id = utp.player_id'),
            'where' => array('utp.user_team_id' => $teamId, 'mp.series_id' => $seriesId)
        );
        $playerList = $this->common_model->customGet($option);
        $data['list'] = $playerList;
        $this->load->view('team_player_model', $data);
    }

    /**
     * @method change_contest_status
     * @description changing contest status
     * @return array
     */
    // public function change_contest_status() {
    //     $option = $this->input->post('option');
    //     $contestID = $this->input->post('contest_id');
    //     $where = ' id=' . $contestID;
    //     $this->common_model->updateFields(CONTEST, array('status' => $option), $where);
    //     echo json_encode(array('status' => 1));
    // }

     function change_contest_status() {
        $option = $this->input->post('option');
        $contestID = $this->input->post('contest_id');
       // $where = ' id=' . $contestID;
        $response = array();
        if ($option == 0) {

            $msg = "Status chnaged successfully";
        } else if($option == 1) {
          
            $msg = "Contest successfully cancelled";
        }else{
            $msg = "Status chnaged successfully";
        }
        $option = array('table' => CONTEST,
            'data' => array('status' => $option),
            'where' => array('id' => $contestID)
        );
        $contestStatus = $this->common_model->customUpdate($option);
        $response['msg'] = $msg;
        if ($contestStatus) {
            $response['status'] = 200;
        } else {
            $response['status'] = 400;
        }
        echo json_encode($response);
    }

    /**
     * @method edit_contest
     * @description editing contest details
     * @return array
     */
    public function edit_contest($contestID) {
        $this->data['encoded_id'] = $contestID;
        $contestID = decoding($contestID);
        $this->data['parent'] = "Contest";
        $this->data['title'] = "Contest";
        $this->data['contestDetails'] = $contestDetails = $this->common_model->GetJoinRecord(CONTEST, 'id', CONTEST_MATCHES, 'contest_id', 'contest.*,group_concat(contest_matches.match_id) as matches_id', array('contest.id' => $contestID));
        $this->data['contestWinners'] = $this->common_model->getAllwhere(CONTEST_DETAILS, array('contest_id' => $contestID));
        $todayDate = date('Y-m-d');
        $matchId = (!empty($contestDetails) && !empty($contestDetails['result'])) ? $contestDetails['result'][0]->matches_id : 0;
        $options = array(
            'table' => 'matches',
            'where' => array('matches.match_id' => $matchId),
            'order' => array('match_date' => 'asc')
        );
        $matchDetails = $this->common_model->customGet($options);
        if (!empty($matchDetails)) {
            $this->data['match_details'] = $matchDetails;
        }

        $options = array(
            'table' => 'matches',
            'select' => 'matches.series_id,se.name,matches.match_id',
            'join' => array('series as se' => 'se.sid=matches.series_id'),
            'where' => array('matches.match_id' => $matchId),
            'order' => array('match_date' => 'asc'),
            'group_by' => 'matches.series_id'
        );
        $seriesDetails = $this->common_model->customGet($options);

        if (!empty($seriesDetails)) {
            $this->data['series_details'] = $seriesDetails;
        }
        if ($this->uri->segment(4)) {
            $this->load->admin_render('view', $this->data, 'inner_script');
        } else {
            $this->load->admin_render('edit', $this->data, 'inner_script');
        }
    }

    /**
     * @method participated_team
     * @description To get joined teams
     * @return array
     */
    public function participated_team($contest_id = "") {

        $this->data['parent'] = "Users";
        $this->data['title'] = "Users";
        $cont_id = decoding($contest_id);

        $sql = 'SELECT `jc`.`id`, `jc`.`user_id`, `jc`.`team_id`,`u`.`team_code`,`u`.`first_name`,`ut`.`name`,`match`.`series_id`,CONCAT(`localteam`, " Vs ", `visitorteam`) as `teams`,`ct`.`contest_name` FROM `join_contest` as `jc` Left JOIN `users` as `u` ON `u`.`id`=`jc`.`user_id` Left JOIN `user_team` as `ut` ON `ut`.`id`=`jc`.`team_id` Left JOIN `matches` as `match` ON `match`.`match_id`=`ut`.`match_id` Left JOIN `contest` as `ct` ON `ct`.`id`=`jc`.`contest_id` WHERE `jc`.`contest_id` =' . $cont_id . '';
        $teamList = $this->common_model->customQuery($sql);

        if (!empty($teamList)) {

            $this->data['contest_name'] = $teamList[0]->contest_name;
            $this->data['teams'] = $teamList[0]->teams;
            $this->data['list'] = $teamList;
            $this->load->admin_render('participated_teams', $this->data, 'inner_script');
        } else {

            $this->session->set_flashdata('error', "Team not found for this contest");
            redirect('contest');
        }
    }

    /**
     * @method update_contest
     * @description for updating cotest_details
     * @return array
     */
    function update_contest() {
        $this->data['parent'] = "Contest";
        $this->data['title'] = "Contest";
        if ($this->input->post()) {

            $match_type = $this->input->post('match_type');
            $this->form_validation->set_rules('contest_sizes', lang('contest_size'), 'required|trim');
            $this->form_validation->set_rules('match_type', lang('match_type'), 'required|trim');
            $this->form_validation->set_rules('matches', lang('select_matches'), 'required|trim');
            if ($match_type == 1) {
                $this->form_validation->set_rules('total_winning_amount', lang('total_winning_amount'), 'required|trim');
                $this->form_validation->set_rules('entry_fee', "Entry Fee", 'required|trim');
            }
            if ($this->form_validation->run() == true) {
                $entry_fee = $this->input->post('entry_fee');
                $no_of_winners = $this->input->post('no_of_winners');
                $publish = $this->input->post('publish');
                if ($match_type == 1) {
                        $updateData['contest_name'] = $this->input->post('contest_name');
                        $contest_name = (!empty($this->input->post('contest_name'))) ? $this->input->post('contest_name') : "Win " . $this->input->post('total_winning_amount').' /Team '.$this->input->post('contest_sizes').' /Pay '.$this->input->post('entry_fee');
                        $updateData['contest_name'] = $contest_name;
                        $updateData['admin_percentage'] = $this->input->post('admin_percentage');
                        $updateData['total_winning_amount'] = $total_winning_amount = $this->input->post('total_winning_amount');
                        $updateData['contest_size'] = $this->input->post('contest_sizes');
                        $updateData['match_type'] = $this->input->post('match_type');
                        $updateData['publish'] = $this->input->post('publish');
                        if ($this->input->post('multi_entry'))
                            $updateData['is_multientry'] = 1;
                        else
                            $updateData['is_multientry'] = 0;
                        if ($this->input->post('customize_winnings'))
                            $updateData['customize_winning'] = 1;
                        else
                            $updateData['customize_winning'] = 0;
                        if ($this->input->post('mega_contest'))
                            $updateData['mega_contest'] = 1;
                        else
                            $updateData['mega_contest'] = 0;

                        if ($this->input->post('confirmed_contest'))
                            $updateData['confirm_contest'] = 1;
                        else
                            $updateData['confirm_contest'] = 0;

                        $updateData['team_entry_fee'] = $this->input->post('entry_fee');
                        $updateData['chip'] = $this->input->post('chip_value');
                        $updateData['real_case'] = $this->input->post('real_money');
                        $updateData['chip_case'] = $this->input->post('chip');
                        if ($this->input->post('no_of_winners'))
                            $updateData['number_of_winners'] = $this->input->post('no_of_winners');

                        $customWinning = $this->input->post('customize_winnings');
                        if ($customWinning != 'on') {
                            $updateData['number_of_winners'] = $this->input->post('contest_sizes');
                        }

                        $updateData['update_date'] = date('Y-m-d H:i:s');
                        $contestID = decoding($this->input->post('contest_id'));
                        
                          if($updateData['contest_size']!=0 && $updateData['total_winning_amount']!=0){
                                    $per = $updateData['total_winning_amount'] / $updateData['contest_size'];
                                    $admin_per_rs = ($per * $updateData['admin_percentage'])/100;
                                }
                               $updateData['admin_prcnt_rs']=$admin_per_rs;
                        $this->common_model->updateFields(CONTEST, $updateData, array('id' => $contestID));


                        $matches = $this->input->post('matches');
                        $matchData['match_id'] = $this->input->post('matches');
                        $this->common_model->updateFields('contest_matches', $matchData, array('contest_id' => $contestID));
                        $this->common_model->deleteData(CONTEST_DETAILS, array('contest_id' => $contestID));
                        if ($customWinning != 'on') {
                            $contestSizes = $this->input->post('contest_sizes');
                            $eachTeamWinngingAmuount = abs($total_winning_amount) / abs($contestSizes);
                            $winnersInsert = array('contest_id' => $contestID,
                                'from_winner' => 1,
                                'to_winner' => $contestSizes,
                                'percentage' => 100,
                                'amount' => round($eachTeamWinngingAmuount, 2),
                                'created_date' => date('Y-m-d H:i:s')
                            );
                            $option2 = array('table' => CONTEST_DETAILS, 'data' => $winnersInsert);
                            $this->common_model->customInsert($option2);
                        } else {
                            if ($this->input->post('select')) {
                                $this->common_model->deleteData(CONTEST_DETAILS, array('contest_id' => $contestID));
                                $contestWinners = $this->input->post('select');
                                foreach ($contestWinners as $row) {
                                    $winnersInsert[] = array('contest_id' => $contestID,
                                        'from_winner' => $row[0],
                                        'to_winner' => $row[1],
                                        'percentage' => $row[2],
                                        'amount' => $row[3],
                                        'created_date' => date('Y-m-d H:i:s')
                                    );
                                }
                                $this->db->insert_batch(CONTEST_DETAILS, $winnersInsert);
                            }
                        }
                        if ($contestID)
                            $this->session->set_flashdata('success', "Contest updated successfully");
                        else
                            $this->session->set_flashdata('error', "Error in updating contest ! Please try again later.");
                        redirect('contest');
                } else {
                    if ($this->input->post('customize_winnings'))
                        $updateData['customize_winning'] = 1;
                    else
                        $updateData['customize_winning'] = 0;
                    $customWinning = $this->input->post('customize_winnings');
                    if ($customWinning != 'on') {
                        $updateData['number_of_winners'] = $this->input->post('contest_sizes');
                    }
                    $updateData['contest_name'] = (!empty($this->input->post('contest_name'))) ? $this->input->post('contest_name') : "Practice Contest";
                    $updateData['total_winning_amount'] = 0;
                    $updateData['contest_size'] = $this->input->post('contest_sizes');
                    $updateData['total_winning_amount'] = $total_winning_amount = $this->input->post('total_winning_amount');
                    $updateData['match_type'] = $this->input->post('match_type');
                    $updateData['publish'] = $this->input->post('publish');
                    $updateData['confirm_contest'] = 1;
                    $updateData['team_entry_fee'] = 0;
                    $updateData['chip'] = 0;
                    $updateData['real_case'] = 0;
                    $updateData['chip_case'] = 0;
                    $updateData['update_date'] = date('Y-m-d H:i:s');
                    $updateData['number_of_winners'] = $no_of_winners;
                    $matches = $this->input->post('matches');
                    $contestID = decoding($this->input->post('contest_id'));
                    $this->common_model->updateFields(CONTEST, $updateData, array('id' => $contestID));
                    $matchData['match_id'] = $this->input->post('matches');
                        $this->common_model->updateFields('contest_matches', $matchData, array('contest_id' => $contestID));
                    if ($customWinning != 'on') {
                        $contestSizes = $this->input->post('contest_sizes');
                        $eachTeamWinngingAmuount = abs($total_winning_amount) / abs($contestSizes);
                        $winnersInsert = array('contest_id' => $contestID,
                            'from_winner' => 1,
                            'to_winner' => $contestSizes,
                            'percentage' => 100,
                            'amount' => round($eachTeamWinngingAmuount, 2),
                            'created_date' => date('Y-m-d H:i:s')
                        );
                        $option2 = array('table' => CONTEST_DETAILS, 'data' => $winnersInsert);
                        $this->common_model->deleteData(CONTEST_DETAILS, array('contest_id' => $contestID));
                        $this->common_model->customInsert($option2);
                    } else {
                        if ($this->input->post('select')) {
                            $this->common_model->deleteData(CONTEST_DETAILS, array('contest_id' => $contestID));
                            $contestWinners = $this->input->post('select');
                            foreach ($contestWinners as $row) {
                                $winnersInsert[] = array('contest_id' => $contestID,
                                    'from_winner' => $row[0],
                                    'to_winner' => $row[1],
                                    'percentage' => $row[2],
                                    'amount' => $row[3],
                                    'created_date' => date('Y-m-d H:i:s')
                                );
                            }
                            $this->db->insert_batch(CONTEST_DETAILS, $winnersInsert);
                        }
                    }
                    if ($contestID)
                        $this->session->set_flashdata('success', "Contest Update successfully");
                    else
                        $this->session->set_flashdata('error', "Error in Updating contest ! Please try again later.");
                    redirect('contest');
                }
            }else {
                echo $this->form_validation->rest_first_error_string();
            }
        }
    }

    function getMatchDetails($series_id) {
        $UtcDateTime = trim(ISTToConvertUTC(date('Y-m-d H:i'), 'UTC', 'UTC'));
        $options = array(
            'table' => 'matches',
            'where' => array('match_date_time >=' => $UtcDateTime,
                'delete_status' => 0, 'status' => 'open', 'series_id' => $series_id),
            'order' => array('match_date' => 'asc')
        );
        $matchDetails = $this->common_model->customGet($options);
        //echo $this->db->last_query();die;
        $opt = '';
        foreach ($matchDetails as $match) {

            $opt .= "<option value='" . $match->match_id . "'>" . $match->localteam . " " . "Vs" . " " . $match->visitorteam . "- " . $match->match_num . "-(" . date('d-m-Y', strtotime($match->match_date)) . ")" . "</option>";
        }
        echo $opt;
        exit;
    }

    public function update_publish_status() {
        $contest_id = $this->input->post('id');
        $publish_status = $this->input->post('publish_status');
        if (!empty($contest_id)) {

            $update_data['publish'] = ($publish_status == 1) ? 0 : 1;
            $update_status = $this->common_model->updateFields(CONTEST, $update_data, array('id' => $contest_id));
            if ($update_status) {
                echo "success";
            } else {

                echo "error";
            }
        }
    }

    function checkStr()
   {
    $str = "Win 2100 /Team 500 /Pay 4.62";
       $ci = get_instance();

       if(!empty($str) && isset($str))
       {
          $contest = explode(" ",$str);
          echo $contest[0].' '.$contest[1];

          return $contest[0];
       }
       else
       {
          return $str; 
       }
       

   }

}
