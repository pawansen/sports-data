<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>


<section class="business_section">
               <div class="container">
                <div class="row">
                  <div class="col-md-12">
                      <div class="email_verification_box">
                         <!-- <div class="stacks_title">-->
                         <!--     <h4>Stacks</h4>-->
                         <!--</div>-->
                         <div class="email_verification_box2">
                             <div class="email_verification_sub"><p>Account Successfully Activated</p></div>
                             <div class="email_verification_description"><p>  Thank you for registering and activating your account.<?php //echo $this->session->flashdata('user_verify'); ?></p></div>
                            
                             <div class="verification_please_continue">
                                <p>Please login to continue </p>


                             </div>
                             <div class="email_verification_btn">
                                 <a href="<?php echo base_url().'front/login';?>" id="verificationemail" class="btn btn-success email_verification_btn_btn jugaL">Login</a>
                             </div>
                             <div class="email_verification_please">
                                  <!--<p>Please note that this link will expire in 1 days.</p> -->
<br>

                             </div>
                             
                         </div>
                         
                         
                         <!--<div class="email_verification_footer">-->
                         <!--     <h5>The team at Vendor</h5>-->
                         <!--     <p>Pixel Perfect Networking</p>-->
                         <!--</div>-->
                         
                      </div>
                      <div class="email_verifacation_bottom_footer">
                          <p>If you have any question feel free to contact us at <a href="#">Vendor</a></p>
                      </div>
                  </div>
                </div>
               </div>
            </section>
            
           
            <!--  *** content *** -->
<style type="text/css">
body {
    font-family: 'Roboto';
        background-color: #f1f1f1;
}
.business_section {
    padding-top: 85px;
    overflow: hidden;
    width: 100%;
    padding-bottom: 70px;
    /*background-color: #f1f1f1;*/
}


 
@media (min-width: 768px){
.container {
    width: 750px!important;
}
}
@media (min-width: 992px){
.container {
    width: 970px!important;
}
}
@media (min-width: 1200px) {
.container {
    width: 1170px!important;
}
}
.container {
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
}
.email_verification_box {
    background-color: white;
    
}
.email_verification_box2 {
    padding: 9px 23px;
}
.stacks_title h4 {
    margin-bottom: 0em;
}
.stacks_title {
    background-color: #3759D1;
    color: #fff;
    padding: 18px 23px;
}
.email_verification_sub {
    padding-bottom: 18px;
    padding-top: 18px;
}
.email_verification_sub p {
    font-size: 20px;
    font-weight: bold;
}
.email_verification_description {
    padding-bottom: 2px;
    color:#009900;
}
.verification_please_continue {
    padding-bottom: 16px;
}

a.email_verification_btn_btn {
    padding: 11px 31px;
    background-color: #3759D1;
    color: #fff;
    border: 0;
    border-radius: 5px;
    outline: 0;
    font-family: 'Roboto';
    font-size: 18px;
    letter-spacing: 1px;
    text-decoration: none;
}

.email_verification_please {
    padding-top: 40px;
    padding-bottom: 30px;
}

.email_verification_footer {
    background-color: #4a4a4a;
    color: #fff;
    padding: 15px 23px;
}
.email_verifacation_bottom_footer {
    /* padding-bottom: 20px; */
    padding-top: 30px;
    text-align: center;
    color: #4a4a4a;
}
.email_verification_footer p {
    color: #9e9e9e;
    margin: 0 0 0px;
}
      </style>