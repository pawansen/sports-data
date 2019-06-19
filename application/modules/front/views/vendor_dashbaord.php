<section class="business_section">
               <div class="container">
                <div class="row">
                  <div class="col-md-3"></div>
                        <div class="col-md-9 alert_box">
                        <?php $a=$this->session->flashdata("message"); if(!empty($a)){?>
                          <div class="alert ">
                           <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                           <strong>Success!</strong> Business profile successfully updated
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
                                  
                                 <li><a class="active" href="<?php echo base_url().'front/vendor_dashbaord';?>"><i class="fa fa-user-o icon_menu"></i>Business Profile</a></li>
                                  <li><a href="<?php echo base_url().'front/vendor_profile';?>"><i class="fa fa-user-o icon_menu"></i>Personal details</a></li>
                                  <li><a  href="<?php echo base_url().'front/account_setting';?>"><i class="fa fa-cog icon_menu"></i> Account settings</a></li>
                                  <li><a href="<?php echo base_url().'front/vendor_enquires';?>"><i class="fa fa-users icon_menu"></i>Enquiries</a></li>
                                  <li><a href="<?php echo base_url().'front/partnership_document';?>"><i class="fa fa-file-text-o icon_menu"></i>Partnership Documents</a></li>
                                  <li><a href="<?php echo base_url().'front/logout';?>"><i class="fa fa-sign-out icon_menu"></i> Logout</a></li>
                              </ul>
                               
                          </div>
                        </div>
                         
                       </div>
                     </div>
                     <form action="<?php echo site_url('front/vendor_business_profile');?>" id="editFormAjax"  name="editFormAjax" method="POST" enctype='multipart/form-data'>
                     <div class="col-md-9">
                       <div class="content_desboard">
                         <div class="row">
                           <div class="col-md-3">
                             <div class="image_upload">
                                <img src="<?php echo (!empty($profile->logo)) ? base_url().$profile->logo : base_url()."backend_asset/images/noimagefound.jpg";?>">
                             </div>
                             <input type="file" name="logo" />
                           </div>
                           <div class="col-md-9 business_profile">
                              <div class="row register_feild">
                                    <div class="col-md-12">
                                       <div class="input-container">
                                          <i class="fa fa-building  icon"></i>
                                          <input class="input-field" type="text" placeholder="Company name" name="company_name" value="<?php echo $profile->company_name;?>">
                                       </div>
                                    </div>
                                 </div>

                                 <div class="row register_feild">
                                    <div class="col-md-12">
                                       <div class="input-container_description">
                                          <i class="fa fa-pencil-square-o icon"></i>
                                          <textarea class="input-field_de" rows="4" cols="50" placeholder="Description" name="description"><?php echo $profile->description;?></textarea>
                                       </div>
                                    </div>
                                 </div>
                                 <input type="hidden" name="old_logo" value="<?php echo $profile->logo;?>"/>
                                  <div class="row register_feild Profile_col_6_space">
                                    

                                    <div class="col-md-6 left_col6">
                                       <div class="input-container">
                                          <i class="fa fa-globe icon"></i>
                                          <input class="input-field" type="text" placeholder="Company website" name="website" value="<?php echo $profile->website;?>">
                                       </div>
                                    </div>

                                    <div class="col-md-6 right_col6">
                                       <div class="input-container_select">
                                        <select class="input-container" name="category">
                                    <option value="">Software categories </option>
                                       <?php foreach($category as $rows){?>
                                          <option value="<?php echo $rows->id;?>" <?php echo ($profile->category_id == $rows->id) ? "selected" : ""; ?>><?php echo $rows->category_name;?></option>
                                       <?php }?>
                                    </select>
                                       </div>
                                    </div>


                                 </div>
                                  <div class="row register_feild Profile_col_6_space">
                                    <div class="col-md-6 left_col6">
                                       <div class="input-container">
                                          <i class="fa fa-map-marker icon"></i>
                                          <input class="input-field" type="text" placeholder="Address" name="address" value="<?php echo $profile->address1;?>">
                                       </div>
                                    </div>

                                    <div class="col-md-6 right_col6">
                                       <div class="input-container">
                                          <i class="fa fa-globe icon"></i>
                                          <input class="input-field" type="text" placeholder="City" name="city" value="<?php echo $profile->city;?>">
                                       </div>
                                    </div>
                                    
                                  </div>



                                   <div class="row register_feild Profile_col_6_space">



                                   <div class="col-md-6 right_col6">
                                       <div class="input-container">
                                          <i class="fa fa-flag-o icon"></i>
                                          <select class="input-container" name="country">
                                      <option value="">Select Country</option>
                                       <?php foreach($countries as $rows){?>
                                          <option value="<?php echo $rows->id;?>" <?php echo ($profile->country == $rows->id) ? "selected" : ""; ?>><?php echo $rows->name;?></option>
                                       <?php }?>
                                    </select>
                                       </div>
                                    </div>

                                    <div class="col-md-6 left_col6">
                                       <div class="input-container_select">
                                        <select class="input-container" name="state">
                                      <option value="">State / Province selection</option>
                                       <?php foreach($states as $rows){?>
                                          <option value="<?php echo $rows->id;?>" <?php echo ($profile->state == $rows->id) ? "selected" : ""; ?>><?php echo $rows->name;?></option>
                                       <?php }?>
                                    </select>
                                       </div>
                                    </div>

                                    
                                  </div>

                                  <div class="row register_feild Profile_col_6_space">
                                  <div class="col-md-6 left_col6">
                                    <div class="register_btn">
                                    <?php if($profile->vendor_profile_activate == "No"){?>
                                       <button type="submit" id="submit" class="btn save_btn_profile">Save</button>
                                    <?php }else{?>
                                       <div class="col-md-12 text-success">Your business profile verified</div>
                                    <?php }?>
                                    </div>
                                   
                                     </div>
                                     <div class="col-md-6"></div>
                                 </div>

                           </div>

                         </div>
                       </div>
                     </div>
                     </form>                     
               </div>
               </div>
            </section>
            
           
            <!--  *** content *** -->
