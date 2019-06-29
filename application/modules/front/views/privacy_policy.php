
        <section id="our_service" class=" pb-80 pt-150">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 heading_title pb-60">
                        <h2>Privacy Policy</h2>
                         <?php if(isset($response->description)){ echo $response->description; }?>
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
                        <button class="btn get_sterted">Get Started Now</button>
                    </div>
                    </div>
                </div>
            </div>
        </section>