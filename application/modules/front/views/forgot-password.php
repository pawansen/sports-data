        <!--  *** banner container *** -->
        <section class="login_section">
                <div class="container">
                    <div class="row mobile_row">
                     
                      <div class="main_forgot_form">
                         <!-- <p>If you have forgotten your password you can reset it here.</p><br> -->
                           <form action="<?php echo site_url("front/forgot_password");?>" class="form_width" method="post">
                               <div class="input-container">
                                 <i class="fa fa-envelope-o icon"></i>
                                <input class="input-field" type="text" placeholder="Email address" name="identity" id="identity">
                              </div>
                              <div class="error"><?php echo form_error('email');?></div>
                              <div class="text-danger"><?php echo $this->session->flashdata('message');?></div>
                              <div class="text-success"><?php //echo $message;?></div>
                           <button type="submit" class="btn login_btn">Reset Password</button>
                         </form>
           </div>             
                    </div>
                </div>
        </section>
        <!--   ***banner container***  -->