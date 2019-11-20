<style>
    .modal-footer .btn + .btn {
    margin-bottom: 5px !important;
    margin-left: 5px;
}
</style>
<div id="commonModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" role="form" id="addFormAjax" method="post" action="<?php echo base_url('banner/banner_add') ?>" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"><?php echo (isset($title)) ? ucwords($title) : "" ?></h4>
                </div>
                <div class="modal-body"> 
                    <!-- <div class="loaders">
                        <img src="<?php //echo base_url().'backend_asset/images/Preloader_2.gif';?>" class="loaders-img" class="img-responsive">
                    </div> -->
                    <div class="alert alert-danger" id="error-box" style="display: none"></div>
                    <div class="form-body">
                        <div class="row">
                          
<!--                           <div class="col-md-12" >
                                <div class="form-group">
                                 <label class="col-md-3 control-label">Banner Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="banner_name" id="banner_name"></textarea>
                                    </div>
                                     <span class="help-block m-b-none col-md-offset-3">
                                    
                                </div>
                            </div>

                             <div class="col-md-12" >
                                <div class="form-group">
                                 <label class="col-md-3 control-label">Url</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="url" id="url"></textarea>
                                    </div>
                                     <span class="help-block m-b-none col-md-offset-3">
                                    
                                </div>
                            </div>-->
                            
                          
                             
                           
                           <div class="col-md-12" >
                                <div class="form-group">
                                    <!--<label class="col-md-3 control-label"><?php // echo lang('image'); ?></label> -->
                                    <div class="col-md-12">
                                        
                                    
                                        
                                        
                                        
                                            <div class="profile_content edit_img">
                                            <div class="file_btn file_btn_logo border_banner_box">
                                              <input type="file"  class="input_img2" id="image" name="image" style="display: inline-block;">
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
                    <button type="submit" id="submit" class="btn btn-sm btn-primary" >Submit</button>
                </div>
            </form>
        </div> <!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
