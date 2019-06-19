<div id="commonModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" role="form" id="editFormAjaxUser" method="post" action="<?php echo base_url('vendors/pan_card_add') ?>" enctype="multipart/form-data">
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
                                <label class="col-md-3 control-label"></label>
                                    <div class="col-md-9">
                                <span class="error">
                                <?php $read_only ="";
                               if(isset($results->verification_status)){ 
                                $veri_status = $results->verification_status;}else{
                                    $veri_status =0;
                                }
                                if($veri_status==1){
                                          echo "Your request is pending.";
                                       }else if($veri_status==2){
                                          echo "Your Aadahr number is successfully verified.";
                                          $read_only = "readonly";
                                       }else if($veri_status==3){
                                          echo "Your request us cancel! Upload documents again.";
                                       }      
                                  ;?></span>
                                </div>
                                </div>
                           </div>
                                 <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo lang('first_name');?></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="<?php echo lang('first_name');?>" value="<?php if(isset($results->full_name)){echo $results->full_name;}else {echo "";}?>" <?php echo $read_only?> />
                                    </div>
                                </div>
                            </div>
                            

                            
                             <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo lang('pan_number');?></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="pan_number" id="pan_number" placeholder="<?php echo lang('pan_number');?>" value="<?php if(isset($results->pan_number)){echo $results->pan_number;}else{echo "";}?>" <?php echo $read_only?>/>
                                    </div>
                                </div>
                            </div>
                              <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Country</label>
                                    <div class="col-md-9">
                                       <select id="country" name="country"  class="form-control">
                                       <option value="101">India</option>
                                       </select>
                                    </div>
                                  
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo lang('state');?></label>
                                    <div class="col-md-9">
                                        <select id="state" name="state"  class="form-control" <?php echo $read_only?>>
                                        <?php $state_id="";
                                        if(isset($results->state)){ $state_id =$results->state; }
                                        foreach($state_data as $value) { ?>
                                          
                                      
           <option value="<?php echo $value->id; ?>" <?php if($state_id==$value->id){ echo 'selected=true';}?> ><?php echo $value->name; ?></option>
                                       <?php   } ?>
                                       </select>
                                    </div>
                                  
                                </div>
                            </div>

                             <div class="col-md-12" >
                               <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo lang('date_of_birth');?></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="date_of_birth" id="date_of_birth" readonly="" value="<?php if(isset($results->date_of_birth)){echo $results->date_of_birth;}else{echo "";}?>" <?php echo $read_only?>/>
                                    </div>
                                </div>
                            </div>
                             
                             <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo lang('pan_card'); ?></label>
                                    <div class="col-md-9">
                                            <div class="profile_content edit_img">
                                            <div class="file_btn file_btn_logo">
                                              <?php if($read_only!="readonly"){?>
                                              <input type="file"  class="input_img2" id="pan_card_file" name="pan_card_file" style="display: inline-block;">
                                              <?php } ?>
                                              <span class="glyphicon input_img2 logo_btn" style="display: block;">
                                                  <div id="show_company_img"></div>
                                                <span class="ceo_logo">
                                     
                                                    <?php if(!empty($results->pan_card_file)){ ?>
                                                        <img src="<?php echo base_url().$results->pan_card_file;?>">
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


                             <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo lang('id_proof'); ?></label>
                                    <div class="col-md-9">
                                            <div class="profile_content edit_img">
                                            <div class="file_btn file_btn_logo">
                                              <?php if($read_only!="readonly"){?>
                                              <input type="file"  class="input_img2" id="id_proof" name="id_proof" style="display: inline-block;">
                                              <?php }?>
                                              <span class="glyphicon input_img2 logo_btn" style="display: block;">
                                                  <div id="show_company_img"></div>
                                                <span class="ceo_logo">
                                     
                                                    <?php if(!empty($results->id_proof)){ ?>
                                                        <img src="<?php echo base_url().$results->id_proof;?>">
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
                                <input type="hidden" name="exists_image" value="<?php echo $results->pan_card_file;?>" />
                                <input type="hidden" name="exists_id_proof" value="<?php echo $results->id_proof;?>" />
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
<script type="text/javascript">
$('#date_of_birth').datepicker({
                startView: 2,
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                endDate:'today',
                format: 'yyyy-mm-dd',
       
       
       });
</script>