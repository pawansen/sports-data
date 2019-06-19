<!-- Page content -->
<div id="page-content">
    <!-- Datatables Header -->
    <ul class="breadcrumb breadcrumb-top">
        <li>
            <a href="<?php echo site_url('pwfpanel');?>">Home</a>
        </li>
        <li>
            <a href="<?php echo site_url('users');?>">Users</a>
        </li>
    </ul>
    <!-- END Datatables Header -->

    <!-- Datatables Content -->
    <div class="block full">
        <div class="block-title">
            <h2><strong>User</strong> Panel</h2>
        </div>
            <form class="form-horizontal" role="form" id="editFormAjaxUser" method="post" action="<?php echo base_url('users/user_update') ?>" enctype="multipart/form-data">

                <div class="modal-header text-center">
                    <h2 class="modal-title"><i class="fa fa-pencil"></i> <?php echo (isset($title)) ? ucwords($title) : "" ?></h2>
                </div>
                <div class="modal-body">
                    <!-- <div class="loaders">
                        <img src="<?php //echo base_url().'backend_asset/images/Preloader_2.gif';?>" class="loaders-img" class="img-responsive">
                    </div> -->
                    <div class="alert alert-danger" id="error-box" style="display: none"></div>
                    <div class="form-body">
                        <div class="row">
                                 <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo lang('first_name');?></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="<?php echo lang('first_name');?>" value="<?php echo $results->first_name;?>"/>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo lang('last_name');?></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="<?php echo lang('last_name');?>" value="<?php echo $results->last_name;?>"/>
                                    </div>
                                </div>
                            </div>
                            
                             <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo lang('user_email');?></label>
                                    <div class="col-md-9">
                                        <input type="email" class="form-control" name="user_email" id="user_email" value="<?php echo $results->email;?>" readonly/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo lang('phone_no');?></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="phone_no" id="phone_no" placeholder="<?php echo lang('phone_no');?>" value="<?php echo $results->phone;?>"/>
                                    </div>
                                    <!-- <span class="help-block m-b-none col-md-offset-3"><i class="fa fa-arrow-circle-o-up"></i> <?php echo lang('english_note');?></span> -->
                                </div>
                            </div>
                              <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo "Current Password";?></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="current_password" id="current_password" value="<?php echo $results->is_pass_token;?>" readonly=""/>
                                    </div>
                                </div>
                            </div>
                            
                              <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo lang('new_password');?></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="new_password" id="new_password"/>
                                    </div>
                                </div>
                            </div>
                           
                           <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo lang('user_gender');?></label>
                                    <div class="col-md-9">
                                        <label class="checkbox-inline"><input type="radio" name="user_gender" id="user_gender" <?php if($results->gender=='MALE') echo 'checked="checked"';?> value="MALE">MALE</label>
                                        <label class="checkbox-inline"><input type="radio" name="user_gender" id="user_gender" <?php if($results->gender=='FEMALE') echo 'checked="checked"';?> value="FEMALE">FEMALE</label>
                                    </div>
                                </div>
                            </div>

                             <div class="col-md-12" >
                               <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo lang('date_of_birth');?></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="date_of_birth" id="date_of_birth" value="<?php if($results->date_of_birth != '0000-00-00'){echo $results->date_of_birth;}?>" readonly=""/>
                                    </div>
                                </div>
                            </div>

                            <!--<div class="form-group"><label class="col-lg-3 control-label"><?php echo lang('user_image');?></label>

                               <div class="col-lg-9"><input type="file" name="user_image" id="file_name">
                                <span class="help-block m-b-none"><?php echo (isset($error)) ? $error : ""; ?></span>
                                <span class="help-block m-b-none"><?php echo form_error('user_image'); ?></span>
                               </div>
                           </div>
                                <?php if(!empty($results->category_image)){?>
                                <div class="form-group">
                                    <label class="col-lg-5 col-md-offset-2 control-label">
                                <div class="image">
                                  <img class="img-responsive" src="<?php echo base_url();?>uploads/users/<?php echo $results->user_image;?>" alt="image">
                                </div></label>
                                 </div>
                                <?php }?> -->
                                <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo lang('profile_image'); ?></label>
                                    <div class="col-md-9">
                                            <div class="profile_content edit_img">
                                            <div class="file_btn file_btn_logo">
                                              <input type="file"  class="input_img2" id="user_image" name="user_image" style="display: inline-block;">
                                              <span class="glyphicon input_img2 logo_btn" style="display: block;">
                                                <div id="show_company_img"></div>
                                                <span class="ceo_logo row push">
                                                    <?php if(!empty($results->profile_pic)){ ?>
                                                        <div class="col-sm-6 col-md-4">
                                                            <a href="<?php echo base_url().$results->profile_pic;?>" data-toggle="lightbox-image">
                                                                <img src="<?php echo base_url().$results->profile_pic;?>" alt="image">
                                                            </a>
                                                        </div>
                                                        
                                                    <?php }else{ ?>
                                                        <div class="col-sm-6 col-md-4">
                                                            <a href="<?php echo base_url().'backend_asset/images/default.jpg';?>" data-toggle="lightbox-image">
                                                                <img src="<?php echo base_url().'backend_asset/images/default.jpg';?>" alt="image">
                                                            </a>
                                                        </div>
                                        
                                                   <?php }?>
                                                    
                                                </span>
                                                <!-- <i class="fa fa-camera"></i> -->
                                              </span>
                                              <img class="show_company_img2" style="display:none" alt="img" src="<?php echo base_url() ?>/backend_asset/images/logo.png">
                                              <span style="display:none" class="fa fa-close remove_img"></span>
                                            </div>
                                          </div>
                                          <div class="ceo_file_error file_error text-danger"></div>
                                    </div>
                                </div>
                                </div>
                                
                            
                             <input type="hidden" name="id" value="<?php echo $results->id;?>" />
                             <input type="hidden" name="password" value="<?php echo $results->password;?>" />
                            <input type="hidden" name="exists_image" value="<?php echo $results->profile_pic;?>" />
                            <div class="space-22"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit"  class="btn btn-sm btn-primary" id="submit">Save Changes</button>
                </div>
            </form>
       </div>
</div>
<script type="text/javascript">
 $('#date_of_birth').datepicker({
                startView: 2,
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                endDate:'today'
       
       
       });
</script>