<!--  *** footer container *** -->
<footer id="footerCntr" class="pb-80 pt-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="footer_text">
                            <h4>Usefull links</h4>
                            <ul class="footer_menu">
                                <li> <a href="<?php echo base_url().'front/about_us';?>"> About us</a></li>
                                <li><a href="<?php echo base_url().'front/how_to_works';?>"> How it works</a></li>
                                <li><a href="<?php echo base_url().'front/services';?>"> Service</a></li>
                                <li><a href="<?php echo base_url().'front/contact_us';?>"> Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                         <div class="footer_text">
                         <?php $cmsContentgetIntouch = commonGetHelper(array('table' => "cms",
        'where' => array('delete_status'=> 0,"is_active"=>1,'page_id' => "home_footer_get_in_touch"),'single'=>true));
        ?>
                            <h4>Get in Touch </h4>
                            <?php if(!empty($cmsContentgetIntouch)){echo $cmsContentgetIntouch->description;}?>
                        </div>
                    </div>
                    <div class="col-md-4">
                         <div class="footer_text">
                            <h4>Subscribe </h4>
                            <div class="subscribe_form">
                              <form>
                                <div class="input-container">
                                          
                                          <input class="input-field" type="text" placeholder="Email Address " name="Email_subscribe">
                                          <button class="send_subs"><i class="fa fa-paper-plane-o icon"></i></button>
                                  </div>
                              </form>

                              <div class="footer-social-icons">
    
    <ul class="social-icons">
        <li><a href="" class="social-icon"> <i class="fa fa-facebook"></i></a></li>
        <li><a href="" class="social-icon"> <i class="fa fa-twitter"></i></a></li>
        <li><a href="" class="social-icon"> <i class="fa fa-pinterest"></i></a></li>
        <!-- <li><a href="" class="social-icon"> <i class="fa fa-rss"></i></a></li> -->
        <!-- <li><a href="" class="social-icon"> <i class="fa fa-youtube"></i></a></li>
        <li><a href="" class="social-icon"> <i class="fa fa-linkedin"></i></a></li>
        <li><a href="" class="social-icon"> <i class="fa fa-google-plus"></i></a></li> -->
    </ul>
</div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
		</footer>
    <footer class="bottom_footer pb-10 pt-20" >
      <div class="container">
        <div class="row">
          <div class="col-md-12 bootom_text_footer">
            <p>Copyright 2019 | All rights reserved. <b>Terms & Conditions</b> | <b>Privacy Policy</b></p>
          </div>
        </div>
      </div>
      
    </footer>



		<!--  *** footer container *** -->
	</section>

	<!-- ---- *** main container *** -->
	
</section>


<script type="text/javascript" src="<?php echo base_url(); ?>front_assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>front_assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>front_assets/js/slick.js"></script>
<!------------ CUSTOM JS ------->

<script type="text/javascript" src="<?php echo base_url(); ?>front_assets/js/custom.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>front_assets/js/owl.carousel.min.js"></script>




</body>
<script>
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
      utilsScript: "/front_assets/js/utils.js",
    });
  </script>
  
   <script>
    var input = document.querySelector("#phone1");
    window.intlTelInput(input, {
      utilsScript: "/front_assets/js/utils.js",
    });
  </script>
</html>