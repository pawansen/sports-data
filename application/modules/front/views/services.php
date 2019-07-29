


        

       
        <section id="our_service" class=" pb-80 pt-150">
            <div class="container">
                <div class="row pt-20">
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