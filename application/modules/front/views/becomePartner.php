<style>
#become_bg {
    background-color: #f8f8f8;
}
    .become_client {
    width: 50%;
    text-align: center;
        float: left;
}
.become_vendore {
    width: 50%;
    text-align: center;
        float: left;
}
button.become_client_btn {
    background-color: #B7D30B;
    box-shadow: 0 18px 8px rgba(0,0,0,0.05);
    -webkit-box-shadow: 0 18px 8px rgba(0,0,0,0.05);
    color: #fff;
    display: block;
    margin: 0 auto;
    font-size: 20px;
    letter-spacing: 1px;
    padding: 13px 50px;
    color: #FFFFFF;
    font-family: 'muliregular';
    font-size: 20px;
    border: 0;
        outline: 0;
            border-radius: 4px;
}


button.become_vendore_btn {
    background-color: #B7D30B;
    box-shadow: 0 18px 8px rgba(0,0,0,0.05);
    -webkit-box-shadow: 0 18px 8px rgba(0,0,0,0.05);
    color: #fff;
    display: block;
    margin: 0 auto;
    font-size: 20px;
    letter-spacing: 1px;
    padding: 13px 50px;
    color: #FFFFFF;
    font-family: 'muliregular';
    font-size: 20px;
    border: 0;
       outline: 0;
        border-radius: 4px;
}
@media only screen and (max-width: 480px) and (min-width: 300px)  {
    
    button.become_vendore_btn, button.become_client_btn {
    letter-spacing: 1px;
    padding: 8px 25px;
    font-size: 16px!important;
}
    
}

</style>

         <section id="become_bg" class=" pb-80 pt-150">
            <div class="container">
                <div class="row">
                  <div class="col-md-12">
                    <div class="heading_title pb-30">
                        <h2>Become a partner</h2>
                        
                    </div>
                  </div>
                </div>

                  <div class="row">
                      <div class="col-md-12">
                      <div class="become_section">
                          <div class="become_img">
                              <img src="<?php echo base_url(); ?>front_assets/images/become-partner-img.jpg">
                          </div>
                          <div class="btn_become_partner  pt-40">
                              <div class="become_client"><button class="become_client_btn" ><a href="<?php echo base_url()."front/register?q=c";?>">CLIENTS</a></button></div>
                              <div class="become_vendore"><button class="become_vendore_btn" ><a href="<?php echo base_url()."front/register?q=v";?>">VENDORE</a></button></div>
                          </div>
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