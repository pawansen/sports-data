<!--  <div id="commonModal" class="modal fade" role="dialog"> -->
<script src="<?php echo base_url() . 'backend_asset/admin/js/' ?>helpers/ckeditor/ckeditor.js"></script> 
 <div id="commonModal" class="modal fade" role="dialog">
    <div class="modal-dialog ">
        <div class="modal-content modal-lg">
            <form class="form-horizontal" role="form" id="addFormAjax" method="post" action="<?php echo base_url('emailTemplate/template_add') ?>" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close button_close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Add Email Template</h4>
                </div>
                <div class="modal-body"> 
                    <div class="loaders">
                        <img src="<?php echo base_url().'backend_asset/images/Preloader_2.gif';?>" class="loaders-img" id="loader" class="img-responsive" style="display: none;">
                    </div>
                    <div class="alert alert-danger" id="error-box" style="display: none"></div>
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12" >
                             <div class="form-group">
                               <label class="col-md-3 control-label">Email Type</label>
                                  <div class="col-md-9">
                                       <select class="form-control" name="email_type" id="email_type">
                                          <option value="">Select</option>
                                          <option value="verification">Email Verification</option>
                                          <option value="forgot_password">Forgot Password</option>
                                          <option value="vendor_verify">Admin Vendor Verify</option>
                                          <option value="vendor_inquiry">Client Send Inquiry</option>
                                          <option value="registration">Registration</option>
                                          <option value="business">Business Profile Submit</option>
                                          <option value="admin_request">Admin Request</option>
                                          <option value="contactUS">Contact Us</option>
                                          <option value="subscribe">Subscriber</option>
                                      </select>
                                  </div>
                                 
                              </div>
                            </div>
                            <div class="col-md-12" >
                             <div class="form-group">
                               <label class="col-md-3 control-label">Title</label>
                                  <div class="col-md-9">
                                       <input type="text" name="title" class="form-control">
                                  </div>
                                 
                              </div>
                            </div>
                            
                            
                             <div class="col-md-12" >
                                <div class="form-group">
                                 <label class="col-md-3 control-label"><?php echo lang('description');?></label>
                                    <div class="col-md-9">
                                        <textarea class="form-control ckeditor" name="description"></textarea>
                                    </div>
                                     <span class="help-block m-b-none col-md-offset-3">
                                </div>
                            </div>                             
                           
                           <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo lang('image'); ?></label>
                                    <div class="col-md-9">
                                            <div class="profile_content edit_img">
                                            <div class="file_btn file_btn_logo border_banner_box">
                                              <input type="file" class="input_img2" id="image" name="image" style="display: inline-block;">
                                              <span class="glyphicon input_img2 logo_btn" style="display: block;">
                                                <div id="show_company_img"></div>
                                                <span class="ceo_logo">
                                                  <img src="<?php echo base_url().'backend_asset/images/default.jpg';?>">
                                                </span>
                                                <!--<i class="fa fa-camera"></i>-->
                                              </span>
                                              <img class="show_company_img2" style="display:none" alt="img" src="<?php echo base_url() ?>/backend_asset/images/logo.png">
                                              <span style="display:none" class="fa fa-close remove_img"></span>
                                            </div>
                                          </div>
                                          <div class="ceo_file_error file_error text-danger"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="space-22"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="submit" class="btn btn-sm btn-primary" >Save</button>
                </div>
            </form>
        </div> <!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
