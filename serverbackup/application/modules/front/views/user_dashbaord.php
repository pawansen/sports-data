
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
                              <!-- <button type="button" class="btn edit_profile_btn">Edit Profile</button> -->
                              <button type="button" class="btn edit_profile_btn"><a href="<?php echo base_url().'front/user_dashbaord';?>">Edit Profile<a></button>
                           </div>
                        </div>

                        <div class="munu_sidbar_main">
                          <div class="menu_sidbar">
                           
                              
                              <ul id="accordion" class="accordion">
                                <li><a class="active" href="<?php echo base_url().'front/user_dashbaord';?>"><i class="fa fa-user-o icon_menu"></i>Personal details</a></li>
                                  <!--<li><a href="client-enquiries.html"><i class="fa fa-cog icon_menu"></i>Enquiries</a></li>-->
                                   <li>
                                       <div class="link"><i class="fa fa-users icon_menu"></i>Enquiries<i class="fa fa-sort-desc"></i></div>
                                       <ul class="submenu">
                                           <li><a href="<?php echo base_url().'front/client_enquiries_draft';?>"><i class="fa fa-pencil-square-o icon_menu"></i>Draft</a></li>
                                           <li><a href="<?php echo base_url().'front/client_enquiries';?>"> <i class="fa fa-paper-plane icon_menu"></i>Submitted</a></li>
                                           </ul>
                                          </li>
                                 <li><a  href="<?php echo base_url().'front/user_account_setting';?>"><i class="fa fa-cog icon_menu"></i> Account settings</a></li>
                                  <li><a href="<?php echo base_url().'front/clientAdminRequest';?>"><i class="fa fa-exchange icon_menu"></i>Request Admin</a></li>
                                  <li><a href="<?php echo base_url().'front/client_partnership_documents';?>"><i class="fa fa-file-text-o icon_menu"></i>Partnership Documents</a></li>
                                  <li><a href="<?php echo base_url().'front/logout';?>"><i class="fa fa-sign-out icon_menu"></i> Logout</a></li>
                                  </ul>
                              
                              
                          </div>
                        </div>
                         
                       </div>
                     </div>
                     <div class="col-md-9">
                     
                           <?php //dump($profile);?>
                     <div class="content_desboard">
                         <div class="row">
                         <form action="<?php echo site_url('front/user_profile_update');?>" id="editFormAjaxProfile"  name="editFormAjaxProfile" method="POST" enctype='multipart/form-data'>
                           <div class="col-md-12 business_profile Profile_col_6_space">
                               <div class="row">
                             <div class="col-md-12">
                             <h4 class="heading_form">Update Personal Details     </h4>
                             </div>
                             </div> 
                               <div class="row business_profile Profile_col_6_space">
                                    <div class="col-md-6 left_col6">
                                       <!--<div class="input-container_upload upolad_pro">-->
                                       <!--    <img id="blah" src="http://placehold.it/180" alt="your image" /><br>-->
                                       <!--  <input type='file' onchange="readURL(this);"  class="btn-file-upload" value="Uploadfile" /><br>-->
                                         
                                       <!--</div>-->
                                       
                                       
                                        <div class="group_filed">
        <div class="img_back_prieview">
            <div class="images_box_upload" >
          <div id="image-preview">
             <input type="file" name="image" id="image-upload" />
          </div>
          </div>

         <div id="image-preview1">
             <label for="image-upload" id="image-label"><i class="fa fa-plus-circle" aria-hidden="true">
             </i>&nbsp;Upload Photo</label>
          </div>
        </div>
    </div>
                                    </div>
                                    <div class="col-md-6 right_col6">
                                       
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
                                          <i class="fa fa-phone icon"></i>
                                          <input class="input-field height_mob" type="Number" placeholder="Mobile Number" name="phone" value="<?php echo $profile->phone;?>">
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
                                     <div class="col-md-6"></div>
                                 </div>


                                 </div>

                                

                                  

                           </div>
                        </form>
                         </div>
                       </div>
                     </div>
               </div>

            </section>
            
           
            <!--  *** content *** -->