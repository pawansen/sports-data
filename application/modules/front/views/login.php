        <!--  *** banner container *** -->
        <section class="login_section">
                <div class="container">
                    <div class="row mobile_row">

                      <div class="main_login_form">
                        <?php if(!empty($error)){?>
                            <div class='alert alert-danger'><?php echo $error;?></div>
                        <?php }?>
                        <form action="<?php echo site_url("front/auth");?>" class="form_width" method="post">

                            <div class="text-success"><?php echo $this->session->flashdata('message');?></div>
  
                            <div class="input-container">
                                <i class="fa fa-envelope-o icon"></i>
                                <input class="input-field" type="text" placeholder="Email address" name="email" value="<?php echo set_value('email'); ?>">
                                
                            </div>
                            <?php echo form_error('email'); ?>
                            
                            <div class="input-container">
                                <i class="fa fa-key icon"></i>
                                <input class="input-field" type="password" placeholder="Password" name="password">
                                
                            </div>
                            <?php echo form_error('password'); ?>
                            <input class="input-field" type="hidden" placeholder="WEB" name="signup_type" value='WEB'>
                            <div class="input-container_text">
                                <div class="forget_pass"><p><a href="<?php echo base_url().'front/forgot_password';?>">Forgot password?</a></p></div>
                                <div class="register_here"><p>New user?<a href="<?php echo base_url().'front/register';?>">Register here</a></p></div>
                            </div>

                            <button type="submit" class="btn login_btn">Login</a>
                            </form>
           </div>             
                    </div>
                </div>
        </section>
        <!--   ***banner container***  -->