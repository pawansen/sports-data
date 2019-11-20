<section class="business_section">
    <div class="container">
        <form name="form-serach" action="<?php echo base_url('front/vendor_search'); ?>" method="get">
            <div class="row client_search">
                <div class="form-group col-lg-5 search_box_client">
                    <div class="form-group has-feedback">
                        <!-- onchange="getVendorListKeyword(this.value)" -->
                        <input type="text" class="form-control" name="keyword" id="keywordsearch"  placeholder="Keyword search"/>
                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                </div>
                <div class="form-group col-lg-5 search_box_client">
                    <div class="form-group ">
                        <!-- onchange="getVendorListSoftware(this.value)" -->
                        <select id="software_categories" class="input-container" name="software_categories" >
                            <option value="" disabled selected>Software categories </option>
                            <option value="All">All Software categories </option>
                            <?php foreach ($category as $rows) { ?>
                                <option value="<?php echo $rows->id; ?>" <?php echo (isset($category_select)) ? ($category_select == $rows->id) ? "selected" : "" : ""; ?>><?php echo ucwords($rows->category_name); ?></option>
                            <?php } ?>
                        </select>

                    </div>
                </div>
                <div class="form-group col-lg-2 search_box_client">
                    <div class="form-group ">


<!-- <select id="country" class="input-container" onchange="getVendorListCountry(this.value)">
            <option value="" disabled selected>Select country</option>
                        <?php //foreach ($countries as $rows) { ?>
         <option value="<?php //echo $rows->id;  ?>"><?php //echo ucwords($rows->name);  ?></option>
                        <?php //} ?>
</select> -->
                        <button type="submit" class="btn btn-default btn-lg">Search</button>

                    </div>
                </div>
            </div>
        </form>
        <input type="hidden" class="form-control" name="keyword_search" id="keyword_search" value="<?php echo (isset($_GET['keyword']))  ? $_GET['keyword'] : "";?>"/>
        <input type="hidden" class="form-control" name="software_categories_search" id="software_categories_search" value="<?php echo (isset($_GET['software_categories']))  ? $_GET['software_categories'] : "";?>"/>

        <div class="row client_box_all" id="client_box_all">
            <?php if (!empty($vendors)) {
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
                <?php }
            } else {
                ?>
                <div class="alert alert-danger">No result found</div>
<?php } ?>

        </div>
    </div>

</section>
<!--<button onclick="getVendorListKeyword();">Load More</button>-->

<!--  *** content *** -->