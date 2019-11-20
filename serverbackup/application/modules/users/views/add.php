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
            <h2><strong>User</strong> Add</h2>
        </div>
        <form class="form-horizontal" role="form" id="addFormAjax" method="post" action="<?php echo base_url('users/users_add') ?>" enctype="multipart/form-data">
            <!-- <div class="loaders">
                <img src="<?php echo base_url().'backend_asset/images/Preloader_2.gif';?>" class="loaders-img" class="img-responsive">
            </div> -->
            <div class="alert alert-danger" id="error-box" style="display: none"></div>
            <div class="row">
                <div class="col-md-12" >
                    <div class="form-group">
                        <label class="col-md-3 control-label">First Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" />
                        </div>
                        <!-- <span class="help-block m-b-none col-md-offset-3"><i class="fa fa-arrow-circle-o-up"></i> <?php echo lang('english_note');?></span> -->
                    </div>
                </div>
                
                 <div class="col-md-12" >
                    <div class="form-group">
                        <label class="col-md-3 control-label">Last Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" />
                        </div>
                         <!-- <span class="help-block m-b-none col-md-offset-3"><i class="fa fa-arrow-circle-o-up"></i> <?php //echo lang('english_note');?></span>  -->
                    </div>
                </div>
                
                 <div class="col-md-12" >
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo lang('user_email');?></label>
                        <div class="col-md-9">
                            <input type="email" class="form-control" name="user_email" id="user_email" placeholder="<?php echo lang('user_email');?>"/>
                        </div>
                    </div>
                </div>
                           <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Country</label>
                                    <div class="col-md-9">
                                        <!-- <input type="text" class="form-control" name="country" id="country" placeholder="Country"/> -->
                                        
                                            <select id="country" name="country" class="form-control select2" size="1">
                                                <option value="" disabled selected>Please select</option>
                                                <?php foreach($countries as $country){?>
                                                            
                                                <option value="<?php echo $country->id;?>"><?php echo $country->name;?></option>
                                                        
                                                <?php }?>
                                            </select>
                                       
                                    </div>
                                </div>
                            </div>
                 <div class="col-md-12" >
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo lang('phone_no');?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="phone_no" id="phone_no" placeholder="<?php echo lang('phone_no');?>" />
                        </div>
                        <!-- <span class="help-block m-b-none col-md-offset-3"><i class="fa fa-arrow-circle-o-up"></i> <?php echo lang('english_note');?></span> -->
                    </div>
                </div>
                  <div class="col-md-12" >
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo lang('password');?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="password" id="password" placeholder="<?php echo lang('password');?>" value="<?php echo randomPassword();?>"/>
                        </div>
                    </div>
                </div>
                
               <div class="col-md-12" >
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo lang('profile_image'); ?></label>
                        <div class="col-md-9"> 
                        
                        <div class="group_filed">
                                            <div class="img_back_prieview_Academic">
                                                <div class="images_box_upload_ven_adduser_vendore">
                                                    <div id="image-preview-adduser-vendore">
                                                         <input type="file" name="user_image" id="image-upload-adduser-vendore" />
                                                    </div>
                                                </div>
                                                    <div id="image-preview-adduser">
                                                         <label for="image-upload-adduser-vendore" id="image-label-adduser-vendore">Upload Logo</label>
                                                    </div>
                                            </div>
                           </div>
                                    
                                    
                                   
                        
                                <!--<div class="profile_content edit_img">
                                <div class="file_btn file_btn_logo">
                                  <input type="file"  class="input_img2" id="user_image" name="user_image" style="display: inline-block;"><br><br>s
                                  <span class="glyphicon input_img2 logo_btn" style="display: block;">
                                      <div id="show_company_img"></div>
                                    <span class="ceo_logo">
                                        <img src="<?php echo base_url().'backend_asset/images/default.jpg';?>">
                                    </span>
                                  </span>
                                  <img class="show_company_img2" style="display:none" alt="img" src="<?php echo base_url() ?>/backend_asset/images/logo.png">
                                  <span style="display:none" class="fa fa-close remove_img"></span>
                                </div>
                              </div>-->
                              
                              
                              
                              <div class="ceo_file_error file_error text-danger"></div>
                        </div>
                    </div>
                </div>
                <div class="space-22"></div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="submit" class="btn btn-sm btn-primary" ><?php echo lang('submit_btn');?></button>
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