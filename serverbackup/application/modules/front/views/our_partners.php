<style>

.our_partners_logo {
    display: inline-block;
    padding-bottom: 40px;
    width: 24%;
}
/*.our_partners_logo img:hover {*/
/*    -webkit-filter: grayscale(0%);*/
/*    filter: grayscale(0%);*/
/*}*/
/*.our_partners_logo img {*/
/*    -webkit-filter: grayscale(100%);*/
/*    filter: grayscale(100%);*/
/*}*/

.our_partners_logo img {
    display: block;
    margin: 0 auto;
    /* width: 108px; */
    height: 80px;
    margin-bottom: 5px;
}
.our_partners_logo h5 {
    text-align: center;
}


@media only screen and (max-width: 480px) and (min-width: 300px)  {

.our_partners_logo {
    display: block!important;
    padding-bottom: 20px!important;
    width: auto!important;
}
    
}

@media only screen and (max-width: 767px) and (min-width: 481px)  {

.our_partners_logo {
    display: inline-block;
    padding-bottom: 25px!important;
    width: 49%;
}
    
}
@media only screen and (max-width: 992px) and (min-width: 768px)  {

.our_partners_logo {
    display: inline-block;
    padding-bottom: 25px!important;
    width: 32%;
}
    
}






</style>

    
    	<!--  *** content *** -->

		<section id="our_patner" class="pb-80 pt-150">
            <div class="container">
                <div class="row">
                    <div class=" pb-30">
                        <h2 class="heading_title">Our Partners</h2>
                    </div>

            
    <div class="customer-logos_1 our_partners_logo_all">
    <?php if(!empty($vendors)){?>  
        <?php foreach($vendors as $values){?>  
            <div class="our_partners_logo">
          <img src="<?php echo base_url().$values->logo;?>">
          <h5 class=""><?php echo $values->company_name;?></h5>
      </div>
        <?php }?>
    <?php }?>     
    

    
   
                        
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

        


        

        



		<!--  *** content *** -->