<section class="business_section">
               <div class="container">
                 <div class="row client_search">
                   <div class="form-group col-lg-4 search_box_client">
                      <div class="form-group has-feedback">
                         <input type="text" class="form-control" id="keywordsearch" onchange="getVendorListKeyword(this.value)" placeholder="Keyword search"/>
                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                  </div>
                  <div class="form-group col-lg-4 search_box_client">
                      <div class="form-group ">
                         <select id="software_categories" class="input-container" name="software_categories" onchange="getVendorListSoftware(this.value)">
                         <option value="" disabled selected>Software categories </option>
                         <?php foreach($category as $rows){?>
                             <option value="<?php echo $rows->id;?>"><?php echo ucwords($rows->category_name);?></option>
                         <?php }?>
                        </select>
                        
                    </div>
                  </div>

                  <div class="form-group col-lg-4 search_box_client">
                      <div class="form-group ">

                        
                        <select id="country" class="input-container" onchange="getVendorListCountry(this.value)">
                                    <option value="" disabled selected>Select country</option>
                                    <?php foreach($countries as $rows){?>
                             <option value="<?php echo $rows->id;?>"><?php echo ucwords($rows->name);?></option>
                         <?php }?>
                        </select>
                         
                    </div>
                  </div>
                 </div>


                <div class="row client_box_all" id="client_box_all">
                <?php if(!empty($vendors)){foreach($vendors as $vendor){?>
                  <div class="col-md-3 client_box">
                      <div class="client_box1">
                        <div class="row">
                          <div class="col-md-3"><img style="width: 75px;height: 50px;" src="<?php echo (!empty($vendor->logo)) ? base_url().$vendor->logo : base_url()."front_assets/images/our-service-icon-2.png";?>"></div>
                             <div class="col-md-9">
                                <div class="text_serach_img">
                                  <h5><?php echo $vendor->company_name;?> </h5>
                                </div>
                             </div>
                        </div>
                         <hr class="hr_line">
                        <div class="text_serach">
                        <p><?php echo substr(trim($vendor->description),0,150).'...'; ?></p>
                        </div>
                        <div class="View-Details">
                            <a href="<?php echo site_url("front/vendor_details/".$vendor->id);?>"><button class="view_details_btn">View Details</button></a>
                        </div>
                      </div>
                  </div>
                    <?php }}?>

                 </div>
<!-- 
                 <div class="row client_box_all">
                  <div class="col-md-3 client_box">
                      <div class="client_box1">
                        <div class="row">
                          <div class="col-md-3"><img src="images/our-service-icon-2.png"></div>
                             <div class="col-md-9">
                                <div class="text_serach_img">
                                  <h5>Sonya Frost </h5>
                                </div>
                             </div>
                        </div>
                         <hr class="hr_line">
                        <div class="text_serach">
                           <p>Lorem ipsum, Dolller, Latin literature, Dollers, Dolers news, typesetting</p>
                        </div>
                        <div class="View-Details">
                            <a href="Vendors-details.html"><button class="view_details_btn">View Details</button></a>
                        </div>
                      </div>
                  </div>

                   <div class="col-md-3 client_box">
                      <div class="client_box1">
                        <div class="row">
                          <div class="col-md-3"><img src="images/our-service-icon-2.png"></div>
                             <div class="col-md-9">
                                <div class="text_serach_img">
                                  <h5>Herrod Chandler</h5>
                                </div>
                             </div>
                        </div>
                         <hr class="hr_line">
                        <div class="text_serach">
                           <p>Lorem ipsum, Dolller, Latin literature, Dollers, Dolers news, typesetting</p>
                        </div>
                        <div class="View-Details">
                            <a href="Vendors-details.html"><button class="view_details_btn">View Details</button></a>
                        </div>
                      </div>
                  </div>

                  <div class="col-md-3 client_box">
                      <div class="client_box1">
                        <div class="row">
                          <div class="col-md-3"><img src="images/our-service-icon-2.png"></div>
                             <div class="col-md-9">
                                <div class="text_serach_img">
                                  <h5>Brielle Williamson </h5>
                                </div>
                             </div>
                        </div>
                         <hr class="hr_line">
                        <div class="text_serach">
                           <p>Lorem ipsum, Dolller, Latin literature, Dollers, Dolers news, typesetting</p>
                        </div>
                        <div class="View-Details">
                            <a href="Vendors-details.html"><button class="view_details_btn">View Details</button></a>
                        </div>
                      </div>
                  </div>

                  <div class="col-md-3 client_box">
                      <div class="client_box1">
                        <div class="row">
                          <div class="col-md-3"><img src="images/our-service-icon-2.png"></div>
                             <div class="col-md-9">
                                <div class="text_serach_img">
                                  <h5>Colleen Hurst </h5>
                                </div>
                             </div>
                        </div>
                         <hr class="hr_line">
                        <div class="text_serach">
                           <p>Lorem ipsum, Dolller, Latin literature, Dollers, Dolers news, typesetting</p>
                        </div>
                        <div class="View-Details">
                            <a href="Vendors-details.html"><button class="view_details_btn">View Details</button></a>
                        </div>
                      </div>
                  </div>
                 </div> -->
                



                  
               </div>
              
            </section>
            
           
            <!--  *** content *** -->