<?php if(!empty($vendors)){foreach($vendors as $vendor){?>
                  <div class="col-md-3 client_box">
                      <div class="client_box1">
                        <div class="row">
                          <div class="col-md-3"><img src="<?php echo (!empty($vendor->logo)) ? base_url().$vendor->logo : base_url()."front_assets/images/our-service-icon-2.png";?>"></div>
                             <div class="col-md-9">
                                <div class="text_serach_img">
                                  <h5><?php echo $vendor->company_name;?> </h5>
                                </div>
                             </div>
                        </div>
                         <hr class="hr_line">
                        <div class="text_serach">
                           <p><?php echo $vendor->description;?></p>
                        </div>
                        <div class="View-Details">
                            <a href="<?php echo site_url("front/vendor_details/".$vendor->id);?>"><button class="view_details_btn">View Details</button></a>
                        </div>
                      </div>
                  </div>
                    <?php }}?>