<?php
if (!empty($vendors)) {
    foreach ($vendors as $vendor) {
        ?>
        <div class="col-md-3 client_box">
            <div class="client_box1">
                <div class="row">
                    <div class="col-md-3"><img style="width: 75px;height: 50px;" src="<?php echo (!empty($vendor->logo)) ? base_url() . $vendor->logo : base_url() . "front_assets/images/our-service-icon-2.png"; ?>"></div>
                    <div class="col-md-9">
                        <div class="text_serach_img">
                            <h5><?php echo $vendor->company_name; ?> </h5>
                        </div>
                    </div>
                </div>
                <hr class="hr_line">
                <div class="text_serach">
                    <p><?php echo substr(trim($vendor->description), 0, 150) . '...'; ?></p>
                </div>
                <div class="View-Details">
                    <a class="view_details_btn" href="<?php echo site_url("front/vendor_details/" . $vendor->id); ?>">View Details</a>
                </div>
            </div>
        </div>
    <?php
    }
} else {
    ?>
    <div class="alert alert-danger">No result found</div>
    <?php
}?>