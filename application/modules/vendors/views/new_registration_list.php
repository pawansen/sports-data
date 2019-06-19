  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2><?php echo (isset($headline)) ? ucwords($headline) : ""?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('pwfpanel');?>"><?php echo lang('home');?></a>
            </li>
            <li>
                <a href="<?php echo site_url('report');?>">New Registration</a>
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

             <form class="well" id="date_sortinng" action="<?php echo base_url('vendors/new_registration'); ?>" method="post">
         
             <div class="row">
             <div class="form-group clearfix error" style="padding-left:20%">
                        <label class="control-label col-lg-10" for="email">
                       
                       <?php if(!empty($error_show)){ 
                     
                        echo 'Please Select Date';
                      }
                         ?>
                    </label>
                 </div>
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
                 
                  <div class="form-group clearfix ">
                        <label class="control-label col-lg-2" for="email">Player Type
                   
                    </label>
                  <div class="col-lg-4">

                       <select id="player_type" name="player_type" class="form-control"   >
                                <option value="All" <?php if(!empty($player_type) && $player_type=='All'){echo 'selected';}else{ echo '';} ?>>Fresher</option>
                                <option value="Affiliate" <?php if(!empty($player_type) && $player_type=='Affiliate'){echo 'selected';}else{ echo '';} ?>>Affiliate</option>
                                 <option value="Reference" <?php if(!empty($player_type) && $player_type=='Reference'){echo 'selected';}else{ echo '';} ?>>Reference</option>
                               
                                </select>
                  </div>
                 </div>
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
                       
                           <table class="table table-bordered table-responsive" id="common_datatable_new_reg"> 
                        
                        <thead>
                            <tr>
                                <th><?php echo lang('serial_no');?></th>
                                <th>Player Id</th>
                                <th>Player Email Id</th>
                                <th>Registration Date</th>
                                <th>Mobile No.</th>
                                <th>Mail ID varification status</th> 
                                <th>Contact no. varification status</th>
                                <th>PAN Card varification status </th>
                                <th>Aadhar Card varification status  </th>
                                <th>Accounts varification status </th>
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
                            <td><?php echo $rows->email?></td>
                             <td><?php echo date('d-m-Y H:i', strtotime($rows->created_date));?></td>
                             <td><?php echo $rows->phone?></td>
                             <td><?php if($rows->email_verify==1)
                              {
                                echo "<span class='text-success font-bold'>Verified</span>";
                              }else{
                                  echo "<span class='text-danger font-bold'>Not Verified</span>";
                                }
                               ?></td>


                            <td><?php if($rows->verify_mobile==1)
                              {
                                echo "<span class='text-success font-bold'>Verified</span>";
                              }else{
                                  echo "<span class='text-danger font-bold'>Not Verified</span>";
                                }
                             ?></td>

                              <td><?php if($rows->pan_status==1)
                              {
                                echo "<span class='text-warning font-bold'>Pending</span>";
                              }else if($rows->pan_status==2){
                                  echo "<span class='text-success font-bold'>Verified</span>";
                              }elseif($rows->pan_status==3){
                                echo "<span class='text-danger font-bold'>Cancelled</span>";
                              }else{
                                  echo "<span class='text-info font-bold'>Not Upload</span>";
                                }
                             ?></td>

                              <td><?php if($rows->aadhar_status==1)
                              {
                                echo "<span class='text-warning font-bold'>Pending</span>";
                              }else if($rows->aadhar_status==2){
                                  echo "<span class='text-success font-bold'>Verified</span>";
                              }elseif($rows->aadhar_status==3){
                                echo "<span class='text-danger font-bold'>Cancelled</span>";
                              }else{
                                  echo "<span class='text-info font-bold'>Not Upload</span>";
                                }
                             ?></td>

                              <td><?php if($rows->bank_status==1)
                              {
                                echo "<span class='text-warning font-bold'>Pending</span>";
                              }else if($rows->bank_status==2){
                                echo "<span class='text-success font-bold'>Verified</span>";
                              }elseif($rows->bank_status==3){
                                echo "<span class='text-danger font-bold'>Cancelled</span>";
                              }else{
                                  echo "<span class='text-info font-bold'>Not Upload</span>";
                                }
                             ?></td>
                           
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