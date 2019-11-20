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
                                <p style="font-weight: 600;" id="scbscribe-message"></p>
<!--                            <form action="<?php //echo site_url('front/subscribe');?>" class="form_width" method="post">-->
                                <div class="input-container">
                                   
                                          <input class="input-field" type="text" placeholder="Email Address" id="email_address" name="email">
                                          <button type="button" onclick="submitFormSubscribe()" class="send_subs"><i class="fa fa-paper-plane-o icon"></i></button>
                                          
                                         
                                </div>
<!--                              </form>-->
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
            <p>Copyright 2019 | All rights reserved. <b><a href="<?php echo site_url('front/terms_condition');?>">Terms & Conditions</a></b> | <b><a href="<?php echo site_url('front/privacy_policy');?>">Privacy Policy</a></b></p>
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
 
<script type="text/javascript" src="<?php echo base_url(); ?>front_assets/js/html5lightbox.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>front_assets/js/jquery.uploadPreview.min.js"></script>

</body>
<script>
    function submitFormSubscribe() {
       
        var email = $("#email_address").val();
        $.ajax({
            url: '<?php echo base_url(); ?>' + "front/subscribe",
            type: "post",
            data: {email: email},
            success: function (data, textStatus, jqXHR) {
                $("#scbscribe-message").html(data);
            }
        });
    }
  </script>
  
   <script>
//    var input = document.querySelector("#phone1");
//    window.intlTelInput(input, {
//      utilsScript: "/front_assets/js/utils.js",
//    });
  </script>
  <script>
       $(document).ready(function() {
  $.uploadPreview({
    input_field: "#image-upload",   // Default: .image-upload
    preview_box: "#image-preview",  // Default: .image-preview
    label_field: "#image-label",    // Default: .image-label
    label_default: "Upload Photo",   // Default: Choose File
    label_selected: "Change Photo",  // Default: Change File
    no_label: false                 // Default: false
  });
});




$(document).ready(function() {
  $.uploadPreview2({
    input_field: "#image-upload-academic",   // Default: .image-upload
    preview_box: "#image-preview-academic",  // Default: .image-preview
    label_field: "#image-label-academic",    // Default: .image-label
    label_default: "Upload Logo",   // Default: Choose File
    label_selected: "Change logo",  // Default: Change File
    no_label: false                 // Default: false
  });
});

  </script>
</html>