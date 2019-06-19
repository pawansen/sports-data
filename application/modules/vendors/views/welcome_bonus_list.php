<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2><?php echo (isset($headline)) ? ucwords($headline) : ""?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('pwfpanel');?>"><?php echo lang('home');?></a>
            </li>
            <li>
                <a href="<?php echo site_url('report/welcome_bonus');?>">Welcome Bonus</a>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

             <form class="well" id="date_sortinng" action="<?php echo base_url('vendors/welcome_bonus_list_bonus'); ?>" method="post">
         
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
                       
                           <table class="table table-bordered table-responsive" id="common_datatable_referral_bonus"> 
                        
                        <thead>
                            <tr>
                                <th><?php echo lang('serial_no');?></th>
                                <th>Player Id</th>
                                 <th>Player Email Id</th> 
                                <th>Registration date</th>
                                <th>Profile submission status</th>
                                 <th>Mobile no. verification status</th> 
                                <th>Pan verification status</th>
                                <th>Amount of welcome deposit</th>
                                <th>Date of credit of welcome dep</th>
                                <th>Player Type</th>
                                <th>Referral Date</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                            if (isset($list) && !empty($list)):
                                $rowCount = 0;
                                foreach ($list as $rows):
                                  $referral_date='';$user_type ='';
                                    $rowCount++;
                                    ?>
                            <tr>
                            <td><?php echo $rowCount; ?></td>        
                            <td><?php echo $rows->team_code;?></td>
                            <td><?php echo $rows->email?></td> 
                           <td><?php echo date('d-m-Y', $rows->created_on);?></td>
                            <td><?php if($rows->update_status==1)
                              {
                                echo "<span class='text-warning font-bold'>Pending</span>";
                              }else if($rows->update_status==2){
                                 echo "<span class='text-success font-bold'>Verified</span>";
                              }
                             ?></td>
                            <td><?php if($rows->verify_mobile==0)
                              {
                                echo "<span class='text-danger font-bold'>Not Verified</span>";
                              }else if($rows->verify_mobile==1){
                                echo "<span class='text-success font-bold'>Verified</span>";
                              }
                             ?></td>


                               <td><?php 
                              if($rows->verification_status==1)
                              {
                                echo "<span class='text-warning font-bold'>Pending</span>";
                              }else if($rows->verification_status==2){
                                  echo "<span class='text-success font-bold'>Verified</span>";
                              }elseif($rows->verification_status==3){
                                echo "<span class='text-danger font-bold'>Cancelled</span>";
                              }else{
                                  echo "<span class='text-info font-bold'>Not Upload</span>";
                                }
                             ?>
                               </td>

                             <td><?php echo $rows->cr; ?></td>
                            <td><?php echo date('d-m-Y', strtotime($rows->datetime));?></td>
                            <?php $user_id = $rows->id; 
                                   $option = array('table' => 'user_referrals as urf',
                                            'select' => 'urf.user_id,urf.invite_user_id,urf.create_date',
                                            'where' => array('urf.invite_user_id' => $user_id),
                                            );
                                   $chk_user = $this->common_model->customGet($option);
                                   
                                   if(!empty($chk_user)){
                                    $referral_date = $chk_user[0]->create_date;
                                      $invite_chk_userid = $chk_user[0]->user_id;
                                        $option = array('table' => 'users_groups as ug',
                                            'select' => 'ug.user_id,ug.group_id',
                                            'where' => array('ug.user_id' => $invite_chk_userid,'ug.group_id'=>3),
                                            );
                                        $chk_user_ref = $this->common_model->customGet($option);
                                        if(!empty($chk_user_ref)){
                                          $user_type = "Affiliate";
                                        }else{
                                          $user_type = "Reference";
                                        }

                                   }else{
                                     $user_type ="Fresher";
                                   }

                            ?>
                            <td><?php echo $user_type;   ?></td>
                            <td><?php if(!empty($referral_date)){ echo  $referral_date;}else{ echo '';} ?></td>
                           
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