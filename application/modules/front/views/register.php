            <!--  *** banner container *** -->
            <section class="login_section">
               <div class="container">
                  <div class="row mobile_row">
                     <div class="main_register_form">
                        <ul class="nav nav-tabs">
                           <li class="<?php echo ($active == 3) ? 'active' : '';?>"><a data-toggle="tab" href="#Vendor"  <?php echo ($active == 2) ? 'aria-hidden="true"' : '';?> <?php echo ($active == 3) ? 'aria-expanded="true"' : '';?>><i class="fa fa-user-o icon-tab" ></i></i> Vendor</a></li>
                           <li class="<?php echo ($active == 2) ? 'active' : '';?>"><a data-toggle="tab" href="#Client" <?php echo ($active == 3) ? 'aria-hidden="true"' : '';?> <?php echo ($active == 2) ? 'aria-expanded="true"' : '';?>><i class="fa fa-user-o icon-tab"  ></i> Client</a></li>
                        </ul>
                        <div class="tab-content main_rigister_tab">
                           <div id="Vendor" class="tab-pane fade in <?php echo ($active == 3) ? 'active' : '';?>">
                              <form action="<?php echo site_url("front/signup_vendor");?>" class="form_width" method="post">
                              <?php //echo validation_errors(); ?>
                                 <div class="row register_feild">
                                    <div class="col-md-6">
                                       <div class="input-container">
                                          <i class="fa fa-user-o icon"></i>
                                          <input class="input-field" type="text" placeholder="Frist Name" name="first_name" value="<?php echo set_value('first_name'); ?>">
                                         
                                       </div>
                                       <?php echo form_error('first_name'); ?>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="input-container">
                                          <i class="fa fa-user-o icon"></i>
                                          <input class="input-field" type="text" placeholder="Last Name" name="last_name" value="<?php echo set_value('last_name'); ?>">
                                         
                                       </div>
                                       <?php echo form_error('last_name'); ?>
                                    </div>
                                 </div>
                                 <div class="row register_feild">
                                    <div class="col-md-6">
                                       <div class="input-container">
                                          <i class="fa fa-envelope-o icon"></i>
                                          <input class="input-field" type="text" placeholder="Email address" name="email" value="<?php echo set_value('email'); ?>">
                                         
                                       </div>
                                       <?php echo form_error('email'); ?>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="input-container_number">
                                           <input id="phone" name="mobile" type="tel" class="input_field_number" placeholder="Phone Number" value="<?php echo set_value('mobile'); ?>">
                                         
                                          <!--<i class="fa fa-phone icon"></i>-->
                                          <!--<input class="input-field" type="Number" placeholder="Number" name="number">-->
                                       </div>
                                       <?php echo form_error('mobile'); ?>
                                    </div>
                                 </div>
                                  <div class="row register_feild">
                                    <div class="col-md-6">
                                       <div class="input-container_select">
                                        <select class="input-container" name='country' value="<?php echo set_value('country'); ?>">
                                      <option value="" disabled selected>Select Country</option>
                                      <?php foreach($countries as $row){?>
                                      <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                                      <?php } ?>
                                    </select>
                                   
                                       </div>
                                       <?php echo form_error('country'); ?>
                                    </div>

                                    
                                    <div class="col-md-6">
                                       <div class="input-container">
                                         <!-- <i class="fas fa-layer-group"></i>
 -->                                          <i class="fa fa-plane icon"></i>
                                          <input class="input-field" type="text" placeholder="Designation" name="designation" value="<?php echo set_value('designation'); ?>">
                                         
                                       </div>
                                       <?php echo form_error('designation'); ?>
                                    </div>
                                 </div>
                                  <div class="row register_feild">
                                    <div class="col-md-6">
                                       <div class="input-container">
                                         <!--  <i class="fa fa-key icon"></i> -->
                                          
                                          <i class="fa fa-lock icon"></i>
                                          <input class="input-field" type="password" placeholder="Password" name="password">
                                         
                                       </div>
                                       <?php echo form_error('password'); ?>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="input-container">
                                          <i class="fa fa-lock icon"></i>
                                          <input class="input-field" type="password" placeholder="Confirm Password" name="confm_pswd">
                                       </div>
                                    </div>
                                 </div>

                                 <input class="input-field" type="hidden" placeholder="type" name="user_type" value="3">
                                 <div class="row register_feild">
                                  <div class="col-md-12">
                                       <div class="input-container_checkbox">
                                        <input type="checkbox" name="tnc" value="check" id="agree" /> I agree to the terms and conditions

                                       </div>
                                     </div>
                                     <?php echo form_error('tnc'); ?>
                                 </div>

                                 <div class="row register_feild">
                                  <div class="col-md-12">
                                    <div class="register_btn">
                                       <button type="submit" class="btn login_btn">Register</button>
                                    </div>
                                      
                                     </div>
                                 </div>

                                 <div class="row register_feild">
                                  <div class="col-md-12">
                                       <div class="input-container_text">
                                        <div class="text_login_hear">
                                          <p>Have already an account? <a href="<?php echo base_url().'front/login';?>">Login here</a></p>
                                        </div>
                                       </div>
                                     </div>
                                 </div>
                              </form>
                           </div>

                           <div id="Client" class="tab-pane fade <?php echo ($active == 2) ? 'active' : '';?>">
                               <form action="<?php echo site_url("front/signup_user");?>"class="form_width" method='post'>
                               <div class="row register_feild">
                                    <div class="col-md-6">
                                       <div class="input-container">
                                          <i class="fa fa-user-o icon"></i>
                                          <input class="input-field" type="text" placeholder="Frist Name" name="first_name" value="<?php echo set_value('first_name'); ?>">
                                         
                                       </div>
                                       <?php echo form_error('first_name'); ?>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="input-container">
                                          <i class="fa fa-user-o icon"></i>
                                          <input class="input-field" type="text" placeholder="Last Name" name="last_name" value="<?php echo set_value('last_name'); ?>">
                                         
                                       </div>
                                       <?php echo form_error('last_name'); ?>
                                    </div>
                                 </div>
                                 <div class="row register_feild">
                                    <div class="col-md-6">
                                       <div class="input-container">
                                          <i class="fa fa-envelope-o icon"></i>
                                          <input class="input-field" type="text" placeholder="Email address" name="email" value="<?php echo set_value('email'); ?>">
                                         
                                       </div>
                                       <?php echo form_error('email'); ?>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="input-container_number">
                                           <input id="phone1" name="mobile" type="tel" class="input_field_number" placeholder="Phone Number" value="<?php echo set_value('mobile'); ?>">
                                         
                                          <!--<i class="fa fa-phone icon"></i>-->
                                          <!--<input class="input-field" type="Number" placeholder="Number" name="number">-->
                                       </div>
                                       <?php echo form_error('mobile'); ?>
                                    </div>
                                 </div>
                                  <div class="row register_feild">
                                  <div class="col-md-12">
                                       <div class="input-container_select">
                                        <select class="input-container" name='country' value="<?php echo set_value('country'); ?>">
                                      <option value="" disabled selected>Select Country</option>
                                      <?php foreach($countries as $row){?>
                                      <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                                      <?php } ?>
                                    </select>
                                   
                                       </div>
                                       <?php echo form_error('country'); ?>
                                    </div>

                                    <input class="input-field" type="hidden" placeholder="type" name="user_type" value="2">
                                    <!-- <div class="col-md-6">
                                       <div class="input-container">
                                         
                                          <i class="fa fa-plane icon"></i>
                                          <input class="input-field" type="text" placeholder="Designation" name="designation">
                                       </div>
                                    </div> -->
                                 </div>
                                 <div class="row register_feild">
                                    <div class="col-md-6">
                                       <div class="input-container">
                                         <!--  <i class="fa fa-key icon"></i> -->
                                          
                                          <i class="fa fa-lock icon"></i>
                                          <input class="input-field" type="password" placeholder="Password" name="password">
                                         
                                       </div>
                                       <?php echo form_error('password'); ?>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="input-container">
                                          <i class="fa fa-lock icon"></i>
                                          <input class="input-field" type="password" placeholder="Confirm Password" name="confm_pswd">
                                       </div>
                                    </div>
                                 </div>


                                 <div class="row register_feild">
                                  <div class="col-md-12">
                                       <div class="input-container_checkbox">
                                        <input type="checkbox" name="tnc" value="check" id="agree" /> I agree to the terms and conditions

                                       </div>
                                     </div>
                                     <?php echo form_error('tnc'); ?>
                                 </div>

                                 <div class="row register_feild">
                                  <div class="col-md-12">
                                    <div class="register_btn">
                                       <button type="submit" class="btn login_btn">Register</button>
                                    </div>
                                      
                                     </div>
                                 </div>


                                
                                 <div class="row register_feild">
                                  <div class="col-md-12">
                                       <div class="input-container_text">
                                        <div class="text_login_hear">
                                          <p>Have already an account? <a href="<?php echo base_url().'front/login';?>">Login here</a></p>
                                        </div>
                                       </div>
                                     </div>
                                 </div>

                                 
                              </form>
                              
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               </div>
            </section>
            <!--   ***banner container***  -->