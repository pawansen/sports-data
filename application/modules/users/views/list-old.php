      <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2><?php echo (isset($headline)) ? ucwords($headline) : ""?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('pwfpanel');?>"><?php echo lang('home');?></a>
            </li>
            <li>
                <a href="<?php echo site_url('users');?>"><?php echo lang('user');?></a>
            </li>
        </ol>
    </div>
    <div class="col-lg-4 text-right">
     <div class="ibox-title">
                    <div class="btn-group " href="#">

     <!-- <a href="javascript:void(0)"  onclick="open_modal('users')" class="<?php echo THEME_BUTTON;?>">
                          <img width="18" src="<?php echo base_url().CRICKET_ICON;?>" />  <?php echo lang('add_user');?>
                        </a> -->
                         <?php if($this->ion_auth->is_admin()){ ?>
                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 

<!--                          <a href="javascript:void(0)" class="<?php echo THEME_BUTTON;?>" onclick="open_add_chip_all('users');"><i class="fa fa-inr"></i>Add Chip</a>-->
                            <?php } ?>
                        </div>

    </div>
</div>
<div class="wrapper wrapper-content animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
             
                 <!--   <form class="well" id="date_sortinng" action="<?php echo base_url('users/get_users_list'); ?>" method="post"> -->
         
             <div class="row">
                   <div class="form-group clearfix ">
                     
                    <label class="control-label col-lg-2" for="email">Select Date
                   
                    </label>
                  <div class="col-lg-4">
                      <input class="form-control" type="text" name="from_date" id="from_date" placeholder= "From Date"  readonly="readonly" onchange="getUsersByDates()"></input>
                  </div>
                    <div class="col-lg-4">
                        <input class="form-control" type="text" name="to_date" id="to_date"  placeholder= "To Date" readonly="readonly" onchange="getUsersByDates()"></input>
                  </div>
                   <div class="col-lg-2">
                     <!--  <input type="submit"  class="btn btn-primary" type="submit" value="<?php echo lang('submit_btn');?>" name="submit" id="submit"> -->
                      
                      
                  </div>
                  </div>
                  </div>
                  <div class="form-group clearfix ">
                       
                 </div>
                     <!--  </form> -->
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
                    <table class="table table-bordered table-responsive" id="users">
                        <thead>
                            <tr>
                                <th><?php echo lang('serial_no');?></th>
                                <th><?php echo "Team Code";?></th>
                                <th><?php echo "Name";?></th>
                                <th><?php echo lang('user_email');?></th>
                                <th><?php echo "Phone";?></th>
                                <th><?php echo "Total purchase amount";?></th>
                                <th><?php echo "Total deposit amount";?></th>
                                 <th><?php echo "Total amount due";?></th>
<!--                                <th><?php echo lang('profile_image');?></th>-->
                                 <th><?php echo lang('status');?></th>
                                <th><?php echo lang('user_createdate');?></th>
                                <th style="width:50%"><?php echo lang('action');?></th>
                            </tr>
                        </thead>
                    </table>
                  </div>
                </div>
            </div>
                <div id="form-modal-box"></div>
        </div>
    </div>
</div>