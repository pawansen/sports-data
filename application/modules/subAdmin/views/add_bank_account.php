<div id="commonModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" role="form" id="editFormAjaxUser" method="post" action="<?php echo base_url('vendors/bank_account_add') ?>" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"><?php echo (isset($title)) ? ucwords($title) : "" ?></h4>
                </div>
                <div class="modal-body">
                    <div class="loaders">
                        <img src="<?php echo base_url().'backend_asset/images/Preloader_2.gif';?>" class="loaders-img" class="img-responsive">
                    </div>
                    <div class="alert alert-danger" id="error-box" style="display: none"></div>
                    <div class="form-body">
                        <div class="row">
                                 <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo lang('first_name');?></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="<?php echo lang('first_name');?>" value="<?php if(isset($results->full_name)){echo $results->full_name;}else {echo "";}?>"/>
                                    </div>
                                </div>
                            </div>
                            

                            
                             <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo lang('account_number');?></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="account_number" id="account_number" placeholder="<?php echo lang('account_number');?>" value="<?php if(isset($results->account_number)){echo $results->account_number;}else {echo "";}?>"/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo lang('ifsc_code');?></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="ifsc_code" id="ifsc_code" placeholder="<?php echo lang('ifsc_code');?>" value="<?php if(isset($results->ifsc_code)){echo $results->ifsc_code;}else {echo "";}?>" />
                                    </div>
                                  
                                </div>
                            </div>

                           
                             
                             <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo lang('account_file'); ?></label>
                                    <div class="col-md-9">
                                            <div class="profile_content edit_img">
                                            <div class="file_btn file_btn_logo">
                                              <input type="file"  class="input_img2" id="account_file" name="account_file" style="display: inline-block;">
                                              <span class="glyphicon input_img2 logo_btn" style="display: block;">
                                                  <div id="show_company_img"></div>
                                                <span class="ceo_logo">
                                     
                                                   <?php if(!empty($results->account_file)){ ?>
                                                        <img src="<?php echo base_url().$results->account_file;?>">
                                                    <?php }else{ ?>
                                                        <img src="<?php echo base_url().'backend_asset/images/default.jpg';?>">
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
                             
                                
                            <?php if(isset($results->id))
                            {
                                ?> 
                                <input type="hidden" name="id" value="<?php echo $results->id;?>" />
                                <input type="hidden" name="exists_image" value="<?php echo $results->account_file;?>" />
                              <?php   
                            }
                            else{ ?>
                              <input type="hidden" name="vender_id" value="<?php echo $id;?>" />
                                
                         <?php   }
                            ?> 
                            
                            
                            <div class="space-22"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo lang('close_btn');?></button>
                    <button type="submit"  class="<?php echo THEME_BUTTON;?>" id="submit"><?php echo lang('submit_btn');?></button>
                </div>
            </form>
        </div> <!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
