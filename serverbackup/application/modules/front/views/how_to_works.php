<section id="works" class=" pb-80 pt-150">
            <div class="container">
                <div class="row pt-20">
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
        
		<!--  *** content *** -->


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