
 <?php $cmsContent = commonGetHelper(array('table' => "cms",
        'where' => array('delete_status'=> 0,"is_active"=>1,'page_id' => "home_slider_video"),'single'=>true));
        ?>
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