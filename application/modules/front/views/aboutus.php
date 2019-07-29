<section id="trusted_customer" class=" pb-50 pt-150">
            <div class="container">
                <div class="row">
                  <div class="col-md-12">
                  <?php $cmsContenttrusted = commonGetHelper(array('table' => "cms",
        'where' => array('delete_status'=> 0,"is_active"=>1,'page_id' => "home_trust_by_customer"),'single'=>true));
        ?>
                    <div class="heading_title pb-30">
                        <h2><?php if(!empty($cmsContenttrusted)){echo $cmsContenttrusted->title;}?></h2>
                        <h5 class="sub_description"><?php if(!empty($cmsContenttrusted)){echo $cmsContenttrusted->description;}?> </h5>
                    </div>

                    <div class="customer-logos slider pt-20 pb-50">

      
       <div class="slide">
          <img src="<?php echo base_url();?>front_assets/images/partner-logo-1.png">
          
      </div>
      <div class="slide">
        <img src="<?php echo base_url();?>front_assets/images/partner-logo-2.png">
       
      </div>
      <div class="slide">
          <img src="<?php echo base_url();?>front_assets/images/partner-logo-3.png">
          
      </div>
      <div class="slide">
        <img src="<?php echo base_url();?>front_assets/images/partner-logo-4.png">
         
       </div>
      <div class="slide">
        <img src="<?php echo base_url();?>front_assets/images/partner-logo-5.png">
        
       </div>
                    </div>
                </div>
              </div>
            </div>
        </section>
        
        
        <?php $cmsContenttrusted = commonGetHelper(array('table' => "cms",
        'where' => array('delete_status'=> 0,"is_active"=>1,'page_id' => "our_story"),'single'=>true));
        ?> 
        
        
        <section class="our-sotory pb-80 pt-20">
            
            <div class="container">
                <div class="row">
                  <div class="col-md-6">
                       <div class="heading_title_story pb-10">
                        <h2>Our Story</h2>
                    </div>
                    <div class="our_story_description">
                    <?php if(!empty($cmsContenttrusted)){echo $cmsContenttrusted->description;}?>
                        <!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the.</p><br>
                         <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, </p>
                         
                         <div class="today_description pt-30">
                             <p><b>Today</b></p>
                             
                             <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden <a class="customer_succes"><b>Customer's success stories</b></a> </a></p>
                             
                             </div> -->
                    </div>
                 </div>
                 
                 
                 <div class="col-md-6">
                     <div class="our_story_img_right">
                         <img src="<?php echo base_url().$cmsContenttrusted->image;?>">
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