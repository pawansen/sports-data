<section class="business_section">
               <div class="container">
                 <div class="row">
                  <div class="col-md-3"></div>
                  <div class="col-md-9 alert_box">
                        <?php $a=$this->session->flashdata("message"); if(!empty($a)){?>
                          <div class="alert ">
                           <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                           <strong>Success!</strong>  <?php echo $a;?>
                           </div>
                        <?php }?>             

                        <?php $a=$this->session->flashdata("error"); if(!empty($a)){?>
                          <div class="alert-dangers">
                           <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                           <strong>Error!</strong> <?php echo $a;?>
                           </div>
                        <?php }?> 
                        </div>
                      </div>



                  <div class="row">
                  <div class="col-md-3">
                       <div class="sidebar_desboard">
                        <div class="edit_profile">
                           <div class="frofile_images">
                           <img src="<?php echo $this->session->userdata('image');?>">
                              <h5><?php echo $this->session->userdata('first_name')." ".$this->session->userdata('last_name');?></h5>
                              <h6>Joined <?php echo $this->session->userdata('created_on');?></h6>
                              <button type="button" class="btn edit_profile_btn"><a href="<?php echo base_url().'front/vendor_dashbaord';?>">Edit Profile<a></button>
                           </div>
                        </div>

                        <div class="munu_sidbar_main">
                          <div class="menu_sidbar">
                              <ul>
                                  
                                 <li><a  href="<?php echo base_url().'front/vendor_dashbaord';?>"><i class="fa fa-user-o icon_menu"></i>Business Profile</a></li>
                                  <li><a href="<?php echo base_url().'front/vendor_profile';?>"><i class="fa fa-user-o icon_menu"></i>Personal details</a></li>
                                  <li><a class="active" href="<?php echo base_url().'front/account_setting';?>"><i class="fa fa-cog icon_menu"></i> Account settings</a></li>
                                  <li><a href="<?php echo base_url().'front/vendor_enquires';?>"><i class="fa fa-users icon_menu"></i>Enquiries</a></li>
                                  <li><a href="<?php echo base_url().'front/partnership_document';?>"><i class="fa fa-file-text-o icon_menu"></i>Partnership Documents</a></li>
                                  <li><a href="<?php echo base_url().'front/logout';?>"><i class="fa fa-sign-out icon_menu"></i> Logout</a></li>
                              </ul>
                               
                          </div>
                        </div>
                         
                       </div>
                     </div>
                     <div class="col-md-9">
                     

                       <div class="content_desboard">
                         <div class="row">
                         <form action="<?php echo site_url('front/vendor_password_change');?>" id="editFormAjaxPasswprd"  name="editFormAjaxPasswprd" method="POST" enctype='multipart/form-data'>
                           <div class="col-md-12 business_profile">
                               <div class="row">
                             <div class="col-md-12">
                             <h4 class="heading_form">Account Settings    </h4>
                             </div>
                             </div>
                             
                              <div class="row register_feild">
                                    <div class="col-md-12">
                                       <div class="input-container">
                                          <i class="fa fa-envelope-o icon"></i>
                                          <input class="input-field" type="password" placeholder="Old Password" name="old_password">
                                       </div>
                                       <div id="old_password_validate" class="error_validation_text"></div>
                                    </div>

                                 </div>


                                   <div class="row business_profile Profile_col_6_space">
                                    <div class="col-md-6">
                                       <div class="input-container">
                                          <i class="fa fa-lock icon"></i>
                                          <input class="input-field" type="password" placeholder="New Password" id="new_password" name="new_password">
                                       </div>
                                       <div id="new_password_validate" class="error_validation_text"></div>
                                       <?php echo form_error('new_password'); ?>
                                    </div>

                                    <div class="col-md-6">
                                       <div class="input-container">
                                          <i class="fa fa-lock icon"></i>
                                          <input class="input-field" type="password" placeholder="Confirm New Password" name="c_password">
                                       </div>
                                       <div id="c_password_validate" class="error_validation_text"></div>
                                       <?php echo form_error('c_password'); ?>
                                    </div>
                                    
                                  </div>

                                  <div class="row business_profile ">
                                  <div class="col-md-12 ">
                                    <hr>

                                    <div class="switch_business"><span>Subscribe for newsletter (Off / On)</span>
                                    <label class="switch">
                                          <input type="checkbox" id="check_id"  onclick="subscribe(this)" <?php echo ($profile->newsletter_sub == "Yes") ? "checked": ""?>  name="newsletter_sub">
                                          <span class="slider round"></span>
                                            </label>
                                            </div>
                                    
                                      
                                     </div>
                                    
                                 </div>

                                  <div class="row business_profile ">
                                  <div class="col-md-6 ">
                                    <div class="register_btn">
                                       <button type="submit" id="change_password" class="btn save_btn_profile">Save</button>
                                    </div>
                                      
                                     </div>
                                     <div class="col-md-6"></div>
                                 </div>


                                 </div>

                                

                                  

                           </div>
                        </form>
                         </div>
                       </div>
                     </div>
               </div>
               </div>
            </section>
            
           
            <!--  *** content *** -->
            