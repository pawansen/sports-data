<section class="business_section">
    <div class="container">

        <div class="row">
            <div class="col-md-9">
                <div class="content_vendore_details">
                    <div class="row details_left_right">

                        <div class="col-md-2 border_right  vendor_details_img">
                            <img src="<?php echo (!empty($vendor->logo)) ? base_url() . $vendor->logo : base_url() . "front_assets/images/our-service-icon-2.png"; ?>">
                        </div>
                        <div class="col-md-10 title_details">
                            <h5><?php echo $vendor->company_name; ?></h5>
                            <h6><?php echo $vendor->category_name; ?></h6>

                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="description_details">
                                <h5>Description -</h5>
                                <p><?php echo $vendor->description; ?></p>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-3">
                <div class="right_sidbar">

                    <div class="row">
                        <div class="locattion_details_right_bar">

                            <div class="col-md-3"><img src="<?php echo (!empty($vendor->logo)) ? base_url() . $vendor->logo : base_url() . "front_assets/images/our-service-icon-2.png"; ?>"></div>
                            <div class="col-md-9">
                                <div class="text_right_sidbar">
                                    <h5><?php echo $vendor->company_name; ?> </h5>
                                    <h5><?php echo $vendor->category_name; ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="hr_line">
                    <div class="location_right_bar">
                        <p><?php echo ucfirst($vendor->city); ?> <br><?php echo ucfirst($vendor->state_name); ?><br><?php echo ucfirst($vendor->country_name); ?></p>
                        <p><?php echo $vendor->website; ?> </p>
                        <?php if (empty($view)) { ?>
                            <a href="<?php echo site_url("front/request_admin/" . $vendor->id . "/" . str_replace(" ", "-", $vendor->company_name)); ?>"><button class="Interested_right_sidbar">Interested</button></a>
                        <?php } ?>
                    </div>

                </div>
            </div>


        </div>
    </div>
</div>
</section>


<!--  *** content *** -->