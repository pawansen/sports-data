        <!--  *** banner container *** -->
        <?php $cmsContent = commonGetHelper(array('table' => "cms",
        'where' => array('delete_status'=> 0,"is_active"=>1,'page_id' => "home_slider_video"),'single'=>true));
        ?>
        <section id="bannerCntr">
            <article class="bannerBox">
                <div class="container">
                    <div class="row pt-30">
                        <div class="col-md-6">
                            <div class="home_banner_section">
                                <h1><?php if(!empty($cmsContent)){echo $cmsContent->title;}?> </h1>
                                <h4><?php if(!empty($cmsContent)){echo $cmsContent->description;}?> </h4>
                                <a href="<?php echo base_url().'front/becomePartner';?>"><button type="button" class="btn  banner_btn">Become Partner</button></a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="banner_img">
                                <!-- <img src="<?php echo base_url(); ?>front_assets/images/banner-home.png"> -->
                                <!-- <iframe width="570" height="315"
                                src="<?php //if(!empty($cmsContent)){ echo preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"570\" height=\"315\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>",$cmsContent->video_url);}?>" allowfullscreen>
                                </iframe> -->
                                <a href="<?php echo $cmsContent->video_url;?>" class="html5lightbox" data-width="580" data-height="420" title=""><img src="<?php echo base_url(); ?>front_assets/images/banner-home.png"></a>
                                
                                <!--<?php //if(!empty($cmsContent)){ echo preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"570\" height=\"315\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>",$cmsContent->video_url);}?>-->
                            </div>
                        </div>
                    </div>
                </div>
            </article>
          
        </section>
        <!--   ***banner container***  -->

		<!--  *** content *** -->

		<section id="our_patner" class="pb-80 pt-70">
            <div class="container">
                <div class="row">
                    <div class=" pb-30">
                        <h2 class="heading_title">Our Partners</h2>
                    </div>
                    <div class="customer-logos slider">
                        <?php if(!empty($partners)){foreach($partners as $partner){ ?>
                        
                            <div class="slide">
                                <img src="<?php echo base_url(); ?>uploads/partners/<?php echo $partner->image;?>">
                                <h5 class=""><?php echo ucwords($partner->partner_name);?></h5>
                            </div>

                            
                        <?php }}?>
                        </div>


                    
                </div>
            </div>
		</section>

        <section id="our_service" class=" pb-80 pt-70">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 heading_title pb-60">
                        <h2>Our Service</h2>
                        <h5>It is a long established fact that a reader will be distracted by the</h5>
                    </div>
                  </div>
                  <div class="row">

                  <?php if(!empty($services)){foreach($services as $service){ ?>


     <div class="col-md-3 col-sm-6">
                      <div class="Service_box">
                          <img src="<?php echo base_url(); ?>uploads/emailTemplate/<?php echo $service->image;?>">
                          <h5><?php echo ucwords($service->title);?></h5>
                          <p><?php echo $service->description;?></p>
                      </div>
                    </div>
   
<?php }}?>


                 </div>
            </div>
        </section>


        <section id="bg_lounch" class=" pb-60 pt-70">
            <div class="container">
                <div class="row">
                  <div class="col-md-12">
                    <div class="heading_title_white pb-30">
                    <?php $cmsContentStarted = commonGetHelper(array('table' => "cms",
        'where' => array('delete_status'=> 0,"is_active"=>1,'page_id' => "home_get_started_now"),'single'=>true));
        ?>
                        <h2><?php if(!empty($cmsContentStarted)){echo $cmsContentStarted->title;}?></h2>
                        <h5  class="sub_description"><?php if(!empty($cmsContentStarted)){echo $cmsContentStarted->description;}?> </h5>

                    </div>
                    <div class=" center pt-20 pb-10 ">
                        <button class="btn get_sterted"><a class="btn-in" href="<?php echo base_url().'front/contact_us';?>">Get Started Now</a></button>
                       
                    </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="trusted_customer" class=" pb-50 pt-70">
            <div class="container">
                <div class="row">
                  <div class="col-md-12">
                  <?php $cmsContenttrusted = commonGetHelper(array('table' => "cms",
        'where' => array('delete_status'=> 0,"is_active"=>1,'page_id' => "home_trust_by_customer"),'single'=>true));
        ?>
                    <div class="heading_title pb-30">
                        <h2><?php if(!empty($cmsContenttrusted)){echo $cmsContenttrusted->description;}?></h2>
                    </div>

                    <div class="customer-logos slider">
      
                        <div class="slide">
                           <img src="<?php echo base_url(); ?>front_assets/images/partner-logo-1.png">

                       </div>
                       <div class="slide">
                         <img src="<?php echo base_url(); ?>front_assets/images/partner-logo-2.png">

                       </div>
                       <div class="slide">
                           <img src="<?php echo base_url(); ?>front_assets/images/partner-logo-3.png">

                       </div>
                       <div class="slide">
                         <img src="<?php echo base_url(); ?>front_assets/images/partner-logo-4.png">

                        </div>
                       <div class="slide">
                         <img src="<?php echo base_url(); ?>front_assets/images/partner-logo-5.png">

                        </div>
                    </div>
                </div>
              </div>
            </div>
        </section>


         <section id="works" class=" pb-80 pt-70">
            <div class="container">
                <div class="row">
                  <div class="col-md-12">
                    <div class="heading_title pb-60">
                        <h2>How it works</h2>
                        <h5>It is a long established fact that a reader will be distracted by the</h5>
                    </div>
                  </div>
                </div>

                  <div class="row">


                  <?php if(!empty($how_it_works)){foreach($how_it_works as $how_it_work){ ?>


               <div class="col-md-3 col-sm-6">
                      <div class="work_box">
                          <img src="<?php echo base_url(); ?>uploads/emailTemplate/<?php echo $how_it_work->image;?>">
                          <h5><?php echo ucwords($how_it_work->title);?></h5>
                          <p><?php echo $how_it_work->description;?></p>
                      </div>
                    </div>
<?php }}?>




            

                 </div>
            </div>
        </section>

        <section id="testimonials" class=" pb-80 pt-70">
            <div class="container">
                <div class="row">
                  <div class="col-md-12">
                    <div class="heading_title pb-60">
                        <h2 class="heading_title">Testimonials</h2>
                        <h5>It is a long established fact that a reader will be distracted by the</h5>
                    </div>
                  </div>
                  </div>




                    <div class="row">
                    <div class="col-md-12">
                <div id="testimonial-slider-page1" class="owl-carousel_frist">


                <?php if(!empty($testimonial)){foreach($testimonial as $value){ ?>




                    <div class="testimonial-frist">
                         <div class="testimonial-content">
                            <div class="pic">
                                <img src="<?php echo base_url(); ?>uploads/users/<?php echo $value->image;?>" alt="">
                            </div>
                            <div class="content">
                                <h4 class="name"><?php echo ucwords($value->user_name);?></h4>
                                <span class="post"><?php echo ucwords($value->member_since);?></span>
                               
                            </div>
                        </div>
                        <p class="description">
                        <?php echo $value->description;?>
                        </p>
                       
                    </div>



<?php }}?>

                       
                </div>
            </div>




              </div>
            </div>
        </section>
       



		<!--  *** content *** -->