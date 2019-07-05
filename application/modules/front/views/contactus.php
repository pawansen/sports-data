            <!--  *** banner container *** -->
            <section class="login_section contact_us_bg">
               <div class="container">
               <?php $cmsContenttrusted = commonGetHelper(array('table' => "cms",
        'where' => array('delete_status'=> 0,"is_active"=>1,'page_id' => "contact"),'single'=>true));
        ?> 
        
        
         <div class="row pt-20">
                    <div class="col-md-12 heading_title pb-60">
                        <h2>Get in Touch </h2>
                        
                    </div>
                  </div>
                   
                   
                   <div class="row">
                  
                      <div class="col-md-4">
                           <div class="contact_box pb-5">
                            <div class="contact_box1">
                            
                            <!-- <h5>Address:</h5> -->
                            <?php if(!empty($cmsContenttrusted)){echo $cmsContenttrusted->description;}?>
                      </div>
                   </div>
              
              
              
                           <!-- <div class="contact_box pb-5">
                            <div class="contact_box1">

                            <h5>Email:</h5>
                            <p>exampal123@gmail.com</p>
                      </div>
                   </div>
               -->
              
              
                           <!-- <div class="contact_box pb-5">
                            <div class="contact_box1">
                            <h5>Contact Us :</h5>
                            <p> 408-961-5850</p>
                      </div>

                   </div>    -->



                   </div>
                   
                   
                
                   
                   <div class="col-md-8">
                   
                  <div class="row mobile_row">
                     <div class="main_register_form">
                       
                        <div class="tab-content2 contact_us_page">
                           <div  class="tab-pane21">
                           <?php if(isset($message)){if(!empty($message)){?>
                        

                           <div class="alert alert-success">
                           <span class="closebtn" onclick="this.parentElement.style.display='none';"></span> 
                            <?php echo $message;?>
                           </div>
                           <?php }}?>
                              <form action="<?php echo site_url('front/contact_us_submit');?>" class="form_width" method="post">
                                 <div class="row register_feild">
                                    <div class="col-md-6">
                                       <div class="input-container">
                                          <i class="fa fa-user-o icon"></i>
                                          <input class="input-field" type="text" placeholder="Frist Name" name="c_frist_name" value="<?php echo set_value('c_frist_name'); ?>">
                                       </div>
                                       <?php echo form_error('c_frist_name'); ?>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="input-container">
                                          <i class="fa fa-user-o icon"></i>
                                          <input class="input-field" type="text" placeholder="Last Name" name="c_last_name" value="<?php echo set_value('c_last_name'); ?>">
                                       </div>
                                       <?php echo form_error('c_last_name'); ?>
                                    </div>
                                 </div>
                                 
                                 <div class="row register_feild">
                                    <div class="col-md-6">
                                       <div class="input-container">
                                          <i class="fa fa-envelope-o icon"></i>
                                          <input class="input-field" type="email" placeholder="Email address" name="c_email" value="<?php echo set_value('c_email'); ?>">
                                       </div>
                                       <?php echo form_error('c_email'); ?>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="input-container">
                                          <i class="fa fa-comment-o icon"></i>
                                          <input class="input-field" type="text" placeholder="Subject" name="c_subject" value="<?php echo set_value('c_subject'); ?>">
                                          
                                       </div>
                                       <?php echo form_error('c_subject'); ?>
                                    </div>
                                 </div>
                                 
                                 
                                 <div class="row register_feild">
                                   
                                   <div class="col-md-12">
                                       <div class="input-container_description">
                                          <i class="fa fa-pencil-square-o icon"></i>
                                          <textarea class="input-field_de" rows="4" cols="50" placeholder="Description" name="c_description"><?php echo set_value('c_description'); ?></textarea>
                                       </div>
                                       <?php echo form_error('c_description'); ?>
                                    </div>
                                    
                                    </div>
                                  
                                 <div class="row register_feild">
                                  <div class="col-md-12">
                                    <div class="register_btn">
                                       <button type="submit" class="btn login_btn" name="contact">Send </button>
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
                  
                  
                  
                  
                  
               </div>
               
            </section>
            
            <!--   ***banner container***  -->