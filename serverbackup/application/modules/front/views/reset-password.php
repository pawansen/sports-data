<!--  *** banner container *** -->
<section class="login_section">
    <div class="container">
        <div class="row mobile_row">

            <div class="main_forgot_form">
                <p>If you have forgotten your password you can reset it here.</p><br>
                <form action="<?php echo site_url("front/reset_password/".$code); ?>" id="resetPassword" name="resetPassword" class="form_width" method="post">
                    <p>
                        <label for="new_password"><?php echo sprintf(lang('reset_password_new_password_label'), $min_password_length); ?></label> <br />
                        <?php echo form_input($new_password); ?>
                    </p>

                    <p>
                        <?php echo lang('reset_password_new_password_confirm_label', 'new_password_confirm'); ?> <br />
                        <?php echo form_input($new_password_confirm); ?>
                    </p>

                    <?php echo form_input($user_id); ?>


                    <div class="error"><?php echo form_error('email'); ?></div>
                    <div class="text-danger"><?php echo $this->session->flashdata('message'); ?></div>
                    <div class="text-success"><?php //echo $message; ?></div>
                    <button type="submit" id="rsetbtn" class="btn login_btn">Send My Password</button>
                </form>
            </div>             
        </div>
    </div>
</section>
<!--   ***banner container***  -->