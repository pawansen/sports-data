<section id="become_bg" class=" pb-80 pt-150">
            <div class="container">
                  <div class="row">
                      <div class="col-md-12">
                      <div class="privacy_section">
                          <div class="heading_title_privacy">
                           <h2>Terms & Conditions</h2>
                          </div>
                          <?php $cmsContenttrusted = commonGetHelper(array('table' => "cms",
        'where' => array('delete_status'=> 0,"is_active"=>1,'page_id' => "terms_condition"),'single'=>true));
        ?> 
                          <?php if(!empty($cmsContenttrusted)){echo $cmsContenttrusted->description;}?>
                    <br>
                     
                      </div>
                      </div>
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
                        <button class="btn get_sterted">Get Started Now</button>
                    </div>
                    </div>
                </div>
            </div>
        </section>