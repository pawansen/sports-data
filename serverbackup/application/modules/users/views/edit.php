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
<div class="row">
    <div class="col-md-4">
        <div class="block">
                                    <!-- Customer Info Title -->
                                    <div class="block-title">
                                        <h2><i class="fa fa-file-o"></i> <strong>User's</strong> Info</h2>
                                    </div>
                                    <!-- END Customer Info Title -->

                                    <!-- Customer Info -->
                                    <div class="block-section text-center">
                                        <a href="javascript:void(0)">
                                           <img src="<?php echo ($results->img) ? base_url().$results->img : base_url().'backend_asset/images/default.jpg';?>" alt="avatar" class="img-circle" style=" width: 100px; height: 100px;">
                                        </a>
                                        <h3>
                                            <strong><?php echo $results->first_name." ".$results->last_name;?></strong><br><small></small>
                                        </h3>
                                    </div>
                                    <table class="table table-borderless table-striped table-vcenter">
                                        <tbody>
                                            <tr>
                                                <td class="text-right" style="width: 50%;"><strong> First Name</strong></td>
                                                <td><?php echo $results->first_name;?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-right"><strong>Last Name</strong></td>
                                                <td><?php echo $results->last_name;?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-right"><strong>Email</strong></td>
                                                <td><?php echo $results->email;?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-right"><strong>Phone No</strong></td>
                                                <td><?php echo $results->phone;?></td>
                                            </tr>
                                           
                                           
                                            
                                            <!--<tr>-->
                                            <!--    <td class="text-right"><strong>Status</strong></td>-->
                                            <!--    <td><span class="label label-success"><i class="fa fa-check"></i> Active</span></td>-->
                                            <!--</tr>-->
                                        </tbody>
                                    </table>
                                    <!-- END Customer Info -->
                                </div>
                                
                                
                                <div class="block">
                                    <!-- Customer Info Title -->
                                    <div class="block-title">
                                        <h2><i class="fa fa-file-o"></i> <strong>NDA and Referral </strong>Partner Agreement </h2>
                                    </div>
                                        <div class="block-section text-center">
                                            <!--<img src="<?php echo base_url().'backend_asset/images/Preloader_2.gif';?>" class="loaders-img" class="img-responsive">-->
                                            <img src="<?php echo base_url().'backend_asset/images/document-management-big.png';?>" alt="avatar" class="img-responsive_document" style=" width: 70px; opacity: 0.5;"><br>
                                            <p class="documents_p"><?php if(!empty($results->nda_doc)) {$a= explode("/",$results->nda_doc); echo $a[2];}?></p>
                                        </div>
                                        <div class="block-section text-center">
                                             <?php if(!empty($results->nda_doc)){?>    
                                        <a href="<?php echo base_url().$results->nda_doc;?>" Download  class="btn btn-sm btn-primary dowload_btn ">NDA Download Documents</a>
                                       <?php }else{ ?>
                                         <p class="text-danger">file not uploaded</<p>
                                        <?php }?>
                                        </div>
                                         <!-- END Customer Info -->
                                         <div class="block-section text-center">
                                            <!--<img src="<?php echo base_url().'backend_asset/images/Preloader_2.gif';?>" class="loaders-img" class="img-responsive">-->
                                            <img src="<?php echo base_url().'backend_asset/images/document-management-big.png';?>" alt="avatar" class="img-responsive_document" style=" width: 70px; opacity: 0.5;"><br>
                                            <p class="documents_p"><?php if(!empty($results->doc_file_referral)) {$a= explode("/",$results->doc_file_referral); echo $a[2];}?></p>
                                        </div>
                                        <div class="block-section text-center">
                                              <?php if(!empty($results->doc_file_referral)){?>    
                                        <a href="<?php echo base_url().$results->doc_file_referral;?>" Download class="btn btn-sm btn-primary dowload_btn ">Referral Download Documents</a>
                                        <?php }else{ ?>
                                         <p class="text-danger">file not uploaded</<p>
                                        <?php }?>
                                        </div>
                                    </div>
    </div>
    <div class="col-md-8">
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
                                    <label class="col-md-3 control-label">First Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="<?php echo $results->first_name;?>"/>
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
                                    <label class="col-md-3 control-label">Country</label>
                                    <div class="col-md-9">
                                        <!-- <input type="text" class="form-control" name="country" id="country" placeholder="Country"/> -->
                                        
                                            <select id="country" name="country" class="form-control select2" size="1">
                                                <option value="" disabled selected>Please select</option>
                                                <?php foreach($countries as $country){?>
                                                            
                                                <option value="<?php echo $country->id;?>" <?php echo ($results->country == $country->id) ? "selected": "";?>><?php echo $country->name;?></option>
                                                        
                                                <?php }?>
                                            </select>
                                       
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
                                    <label class="col-md-3 control-label"><?php echo lang('profile_image'); ?></label>
                                    <div class="col-md-9">
                                        
                                        
                                        <div class="group_filed">
                                            <div class="img_back_prieview_Academic">
                                                <div class="images_box_upload_ven_user_vendore">
                                                    <div id="image-preview-user-vendore">
                                                         <input type="file" name="user_image" id="image-upload-user-vendore" />
                                                    </div>
                                                </div>
                                                    <div id="image-preview-user">
                                                         <label for="image-upload-user-vendore" id="image-label-user-vendore">Upload Logo</label>
                                                    </div>
                                            </div>
                                    </div>
                                        
                                        
                                            <!--<div class="profile_content edit_img">
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
                                                
                                              </span>
                                              <img class="show_company_img2" style="display:none" alt="img" src="<?php echo base_url() ?>/backend_asset/images/logo.png">
                                              <span style="display:none" class="fa fa-close remove_img"></span>
                                            </div>
                                          </div>-->
                                          
                                          
                                          
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