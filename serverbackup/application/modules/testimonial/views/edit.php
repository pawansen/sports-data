<style> 
    .modal-footer .btn + .btn {
    margin-bottom: 5px !important;
    margin-left: 5px;
}
</style> 
<div id="commonModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" role="form" id="editFormAjax" method="post" action="<?php echo base_url('testimonial/testimonial_update') ?>" enctype="multipart/form-data">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h2 class="modal-title"><i class="fa fa-pencil"></i> <?php echo (isset($title)) ? ucwords($title) : "" ?></h2>
                    </div>
                <div class="modal-body"> 
                    <!-- <div class="loaders">
                        <img src="<?php echo base_url().'backend_asset/images/Preloader_2.gif';?>" class="loaders-img" class="img-responsive">
                    </div> -->
                    <div class="alert alert-danger" id="error-box" style="display: none"></div>
                    <div class="form-body">
                        <div class="row">
                          
                           <div class="col-md-12" >
                                <div class="form-group">
                                 <label class="col-md-3 control-label">User Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="user_name" value="<?php echo $results->user_name ;?>">
                                    </div>
                                     <span class="help-block m-b-none col-md-offset-3">
                                    
                                </div>
                            </div>

                             <div class="col-md-12" >
                                <div class="form-group">
                                 <label class="col-md-3 control-label">Description</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="description" id="description"><?php echo $results->description ;?></textarea>
                                    </div>
                                     <span class="help-block m-b-none col-md-offset-3">
                                    
                                </div>
                            </div>

                            <div class="col-md-12" >
                                <div class="form-group">
                                 <label class="col-md-3 control-label">Member Since</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control date-picker" name="member_since" value="<?php echo $results->member_since ;?>" />
                                    </div>
                                     <span class="help-block m-b-none col-md-offset-3">
                                    
                                </div>
                            </div>

                            
                           <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo lang('image'); ?></label>
                                    <div class="col-md-9">
                                            <div class="profile_content edit_img">
                                            <div class="file_btn file_btn_logo">
                                              <input type="file"  class="input_img2" id="image" name="image" style="display: inline-block;">
                                              <span class="glyphicon input_img2 logo_btn" style="display: block;">
                                                <div id="show_company_img"></div>
                                                <span class="ceo_logo">
                                                  <?php if(!empty($results->image)){ ?>
                                                        <div class="col-sm-6 col-md-4">
                                                            <a href="<?php echo base_url().'uploads/users/'.$results->image;?>" data-toggle="lightbox-image">
                                                                <img src="<?php echo base_url().'uploads/users/'.$results->image;?>" alt="image">
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
                                                <i class="fa fa-camera"></i>
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
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><?php echo lang('close_btn');?></button>
                    <button type="submit" id="submit" class="btn btn-sm btn-primary" ><?php echo lang('submit_btn');?></button>
                </div>
            </form>
        </div> <!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<script>