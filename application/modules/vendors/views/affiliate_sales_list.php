  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2><?php echo (isset($headline)) ? ucwords($headline) : ""?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('pwfpanel');?>"><?php echo lang('home');?></a>
            </li>
            <li>
                <a href="<?php echo site_url('report');?>">Players Profile</a>
            </li>
        </ol>
    </div>
    <div class="col-lg-4 text-right">
    <!--  <div class="ibox-title">
                    <?php if ($this->ion_auth->is_admin()) {?>
                    <div class="btn-group " href="#">
                        <a href="javascript:void(0)"  onclick="open_modal('vendors')" class="<?php echo THEME_BUTTON;?>">
                          <img width="18" src="<?php echo base_url().CRICKET_ICON;?>" />  Add Vendors
                        </a>
                    </div>
                    <?php }?>
                </div> -->

                   

    </div>
</div>
<div class="wrapper wrapper-content animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

             <form class="well" id="date_sortinng" action="<?php echo base_url('vendors/affiliate_sales'); ?>" method="post">
         
             <div class="row">
                   <div class="form-group clearfix ">
                     
                    <label class="control-label col-lg-2" for="email">Select Date
                   
                    </label>
                  <div class="col-lg-4">
                      <input class="form-control" type="text" name="from_date" id="from_date" placeholder= "From Date"  value="<?php echo $dates['from_date']; ?>" readonly="readonly"></input>
                  </div>
                    <div class="col-lg-4">
                        <input class="form-control" type="text" name="to_date" id="to_date"  placeholder= "To Date" value="<?php echo $dates['to_date']; ?>" readonly="readonly"></input>
                  </div>
                   <div class="col-lg-2">
                       <input type="submit"  class="btn btn-primary" type="submit" value="<?php echo lang('submit_btn');?>" name="submit" id="submit"> 
                      
                      
                  </div>
                  </div>
                  </div>
                  <div class="form-group clearfix ">
                       
                 </div>
                      </form>
               
                <div class="ibox-content">
                 <div class="row">
                      <?php $message = $this->session->flashdata('success');
                            if(!empty($message)):?><div class="alert alert-success">
                                <?php echo $message;?></div><?php endif; ?>
                       <?php $error = $this->session->flashdata('error');
                            if(!empty($error)):?><div class="alert alert-danger">
                                <?php echo $error;?></div><?php endif; ?>
                     <div id="message"></div>
                    <div class="col-lg-12" style="overflow-x: auto">
                       
                           <table class="table table-bordered table-responsive" id="common_datatable_affiliate_list"> 
                        
                        <thead>
                            <tr>
                                <th><?php echo lang('serial_no');?></th>
                                <th>Players ID</th>
                                 <th>Players Name</th> 
                                <th>Match Name</th>
                                <th>Purchase amt</th>
                                  <th>Winning </th> 
                                <!-- <th>Loss</th>  -->
                                <th>Admin Charge</th>
                                <th>Affiliates commission</th>
                                <th>TDS</th>
                               <th>Playwin Revenue</th>
                             
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                            if (isset($list) && !empty($list)):
                                $rowCount = 0;
                                foreach ($list as $rows):
                                    $rowCount++;
                                    ?>
                            <tr>
                            <td><?php echo $rowCount; ?></td>        
                            <td><?php echo $rows->team_code;?></td>
                            <td><span class="text-success"><?php echo $rows->first_name;?></span></td>
                            <td><span class="text-danger"><?php echo ABRConvert($rows->localteam).' v/s '.ABRConvert($rows->visitorteam).'-  '.date('d-m-Y', strtotime($rows->match_date)).' ';?></span></td> 
                             <td><?php echo $rows->joining_amount?></td> 
                              <?php 
                              $option = array(
                                    'table' => 'user_team_rank as user_team_rank',
                                    'select' => 'sum(user_team_rank.winning_amount) as winningAmt',
                                    'join' => array('contest as const' => 'const.id=user_team_rank.contest_id'),
                                     'where' => array('user_team_rank.match_id' =>$rows->match_id,
                                         'user_team_rank.user_id'=>$rows->user_id,'const.match_type' => 1, 'const.status' => 2),
                                     );
                             $win_amt = $this->common_model->customGet($option);
                            ?>
                            <td><?php echo $win_amt[0]->winningAmt;?></td>   
                             <td><?php echo $rows->admin_prcnt_rs;?></td>
                             <?php $adm_prcnt = $rows->admin_prcnt_rs;
                                   $aff_commi =  (($rows->admin_prcnt_rs * 5)/100);
                                   $play_revenue = $adm_prcnt - $aff_commi;
                              ?>
                              <td><?php echo $aff_commi; ?></td>
                             <td><?php echo $rows->deduct_amount;?></td>
                            <td><?php echo round($play_revenue,2)   ; ?></td>
                            </tr>
                            <?php endforeach; endif;?>
                        </tbody>
                    </table>
                  </div>
                </div>
            </div>
                <div id="form-modal-box"></div>
        </div>
    </div>
</div>