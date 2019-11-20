<section class="business_section">
               <div class="container">
                 <div class="row">
                  <div class="col-md-3"></div>
                        <div class="col-md-9 alert_box">
                        <?php $a=$this->session->flashdata("message"); if(!empty($a)){?>
                          <div class="alert ">
                           <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                           <strong>Success!</strong> Profile successfully updated
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
                                  <li><a class="active" href="<?php echo base_url().'front/vendor_profile';?>"><i class="fa fa-user-o icon_menu"></i>Personal details</a></li>
                                  <li><a  href="<?php echo base_url().'front/account_setting';?>"><i class="fa fa-cog icon_menu"></i> Account settings</a></li>
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
                         <form action="<?php echo site_url('front/vendor_profile_update');?>" id="editFormAjaxProfile"  name="editFormAjaxProfile" method="POST" enctype='multipart/form-data'>
                           <div class="col-md-12 business_profile Profile_col_6_space">
                               
                               <div class="row">
                             <div class="col-md-12">
                             <h4 class="heading_form">Update Personal Details  </h4>
                             </div>
                             </div>
                             
                              <div class="row register_feild">
                                    <div class="col-md-6 left_col6">
                                       <div class="input-container">
                                          <i class="fa fa-user-o  icon"></i>
                                          <input class="input-field" type="text" placeholder="Frist Name" name="first_name" value="<?php echo $profile->first_name;?>">
                                       </div>
                                       <div id="first_name_validate" class="error_validation_text"></div>
                                    </div>

                                    <div class="col-md-6 right_col6">
                                       <div class="input-container">
                                          <i class="fa fa-user-o  icon"></i>
                                          <input class="input-field" type="text" placeholder="Last Name" name="last_name" value="<?php echo $profile->last_name;?>">
                                       </div>
                                       <div id="last_name_validate" class="error_validation_text"></div>
                                    </div>
                                    
                                 </div>
                                  

                                   <div class="row business_profile Profile_col_6_space">
                                   <div class="col-md-6 left_col6">
                                       
                                       <div class="code_phone_country">
                                       <div class="input-container_select">
                                        <select class="input-container code_phone" name='phone_code' value="<?php echo set_value('phone_code'); ?>">
                                             <option value="">Select Code</option>
                                             <?php foreach($countries as $row){?>
                                             <option value="<?php echo $row->phonecode;?>" <?php echo ($profile->phone_code == $row->phonecode) ? "selected":"";?> <?php echo set_select('phone_code', $row->phonecode); ?>><?php echo $row->name." (+".$row->phonecode.")";?></option>
                                             <?php } ?>
                                        </select>
                                   
                                       </div>
                                       <div id="phone_code_validate" class="error_validation_text"></div>
                                       <?php echo form_error('phone_code'); ?>
                                       </div>
                                       
                                       <div class="code_phone_mobile">
                                           <div class="input-container">
                                          <!-- <i class="fa fa-phone icon"></i> -->
                                          <input id="phone" class="input-field height_mob" type="tel" placeholder="Mobile Number" name="phone" value="<?php echo $profile->phone;?>">
                                          </div>
                                          <div id="phone_validate" class="error_validation_text"></div>
                                       </div>
                                       
                                       
                                    </div>
                                   
                                    <div class="col-md-6 right_col6">
                                       <div class="input-container">
                                          <i class="fa fa-envelope-o icon"></i>
                                          <input class="input-field" type="email" disabled placeholder="Email" name="email" value="<?php echo $profile->email;?>">
                                       </div>
                                    </div>
                                    
                                  </div>

                                 

                                  <div class="row business_profile ">
                                  <div class="col-md-6 ">
                                    <div class="register_btn">
                                       <button type="submit" id="profile_submit" class="btn save_btn_profile">Save</button>
                                    </div>
                                    
                                      
                                     </div>
                                     <div class="col-md-6"><?php if( $this->session->userdata('email_verify') != 1){?>  
                                       <!-- <div class="register_btn">
                                          <button type="button" id="verificationemail" onclick="resendEmailVerification()" class="btn btn-danger save_btn_profile">Resend Email Verification</button>
                                       </div> -->
                                    <?php }?></div>
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