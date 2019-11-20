<style> 
    .modal-footer .btn + .btn {
    margin-bottom: 5px !important;
    margin-left: 5px;
}
#message_div{
    background-color: #ffffff;
    border: 1px solid;
    box-shadow: 10px 10px 5px #888888;
    display: none;
    height: auto;
    left: 36%;
    position: fixed;
    top: 20%;
    width: 40%;
    z-index: 1;
}
#close_button{
  right:-15px;
  top:-15px;
  cursor: pointer;
  position: absolute;
}
#close_button img{
  width:30px;
  height:30px;
}    
#message_container{
    height: 450px;
    overflow-y: scroll;
    padding: 20px;
    text-align: justify;
    width: 99%;
}
.modal.fade.in::after {
    content: "";
    position: fixed;
    top: 0;
    left: 0;
    background: rgba(0,0,0,0.5);
    width: 100%;
    height: 100%;
    z-index: 999;
}
.modal-backdrop.fade.in {
    display: none !important;
}
.wrapper-content {
  position: relative;
  z-index: 99999;
}
</style> 
<!-- <div id="commonModal" class="modal fade" role="dialog"> -->
<div id="commonModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" role="form" id="editFormAjax" method="post" action="<?php echo base_url('partners/partner_update') ?>" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close button_close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Edit Partners</h4>
                </div>
                <div class="modal-body">
                    <div class="loaders">
                        <img src="<?php echo base_url().'backend_asset/images/Preloader_2.gif';?>" class="loaders-img" class="img-responsive" style="display: none;">
                    </div>
                    <div class="alert alert-danger" id="error-box" style="display: none"></div>
                    <div class="form-body">
                        <div class="row">                            
                            <div class="col-md-12" >
                                <div class="form-group">
                                   <label class="col-md-3 control-label">Partner's Name</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="partner_name" id="partner_name"><?php echo $results->partner_name;?></textarea>
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
                                              <input type="file"  class="input_img2" id="image" name="image" style="display: inline-block;">
                                              <span class="glyphicon input_img2 logo_btn" style="display: block;">
                                                <div id="show_company_img"></div>
                                                <span class="ceo_logo">
                                                    <?php if(!empty($results->image)){ ?>
                                                        <img src="<?php echo base_url().'uploads/partners/'.$results->image;?>">
                                                    <?php }else{ ?>
                                                        <img src="<?php echo base_url().'backend_asset/images/default.jpg';?>">
                                                   <?php }?>
                                                    
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
                             
                            <input type="hidden" name="id" value="<?php echo $results->id;?>" />
                            <input type="hidden" name="exists_image" value="<?php echo $results->image;?>" />
                           
                            <div class="space-22"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                        <button type="submit"  class="btn btn-sm btn-primary" id="submit">Save Changes</button>
                    </div>
                </div>
            </form>
        </div> <!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- <script>