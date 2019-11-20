<section class="business_section">
               <div class="container">
                
                  <div class="row">
                    
                  <form action="<?php echo site_url('front/client_inquiry_submit');?>" id="editFormAjaxinquiry"  name="editFormAjaxinquiry" method="POST" enctype='multipart/form-data'>
                     <div class="col-md-12">
                       <div class="content_enquiries_form">
                        <div class="row enquiries_form_heading">
                          <div class="col-md-12">
                          <h4 class="heading_form">Fill the enquiry form</h4></div>
                          
                        </div>

                        <div class="row enquiries_form">
                                    <div class="col-md-6 left_col6">
                                       <div class="input-container readonly_bg_feild">
                                          <i class="fa fa-user-o  icon"></i>
                                          <input class="input-field" type="text" placeholder="Frist Name" name="vendor_name" value="<?php echo str_replace("-"," ",$enquiries->company_name)?>" readonly>
                                       </div>
                                    </div>
                                    <input type="hidden" name="inq_id" value="<?php echo $enquiries->inq_id;?>" />
                                    <input type="hidden" name="vendor_id" value="<?php echo $enquiries->vendor_id;?>" />
                                    <div class="col-md-6 right_col6">
                                       <div class="input-container">
                                          <i class="fa fa-envelope-o  icon"></i>
                                          <input class="input-field" type="email" placeholder="Email Address" name="rq_email" value="<?php echo $enquiries->client_email;?>">
                                       </div>
                                       <div id="rq_email_validate"></div>
                                    </div>
                                  </div>

                                  
                                  <div class="row enquiries_form">
                                    <div class="col-md-6 left_col6">
                                       <div class="input-container ">
                                          <i class="fa fa-building icon"></i>
                                          <input class="input-field" type="text" placeholder=" No. of licenses" name="rq_licenses" value="<?php echo $enquiries->rq_licenses;?>">
                                       </div>
                                       <div id="rq_licenses_validate"></div>
                                    </div>

                                    <div class="col-md-6 right_col6">
                                        <div class="input-container ">
                                      <select class="select2-list" name="rq_software_categories[]" multiple>
<!--                                      <option value="">Select categories </option>-->
                         <?php foreach($category as $rows){?>
                             <option value="<?php echo $rows->id;?>" <?php echo (in_array($rows->id,explode(",",$enquiries->rq_software_categories))) ? "selected":"";?>><?php echo ucwords($rows->category_name);?></option>
                         <?php }?>
                        </select>
                                    </div>
                                        </div>
                                    <div id="rq_software_categories_validate"></div>
                                  </div>



                                    <div class="row enquiries_form">
                                    <div class="col-md-6 left_col6">
                                      <select class="input-container" name="rq_expected_live">
                                       <option value="" disabled selected>Expected go live </option>
                                       <option value="Within a week"  <?php echo ($enquiries->rq_expected_live=="Within a week") ? "selected":"";?>>Within a week</option>
                                       <option value="Within 15 days"  <?php echo ($enquiries->rq_expected_live=="Within 15 days") ? "selected":"";?>>Within 15 days</option>
                                       <option value="Within 1 month"  <?php echo ($enquiries->rq_expected_live=="Within 1 month") ? "selected":"";?>>Within 1 month</option>
                                       <option value="After  1 month"  <?php echo ($enquiries->rq_expected_live=="After  1 month") ? "selected":"";?>>After  1 month </option>
                                     </select>
                                     <div id="rq_expected_live_validate"></div>
                                    </div>
                                    
                             <div class="col-md-6 right_col6">
                              <select class="input-container" name="rq_solution_offering">
                                  <option value="" disabled selected> Expected contract term </option>
                                  <option value="1 year" <?php echo ($enquiries->rq_solution_offering=="1 year") ? "selected":"";?>>1 year</option>
                                  <option value="2 years"  <?php echo ($enquiries->rq_solution_offering=="2 years") ? "selected":"";?>>2 years</option>
                                  <option value="3 years"  <?php echo ($enquiries->rq_solution_offering=="3 years") ? "selected":"";?>>3 years</option>
                                  <option value="4 years"  <?php echo ($enquiries->rq_solution_offering=="4 years") ? "selected":"";?>>4 years</option>
                                  <option value="5 years"  <?php echo ($enquiries->rq_solution_offering=="5 years") ? "selected":"";?>>5 years</option>
                                  <option value="more than 5 years" <?php echo ($enquiries->rq_solution_offering=="more than 5 years") ? "selected":"";?>>more than 5 years</option>
                               </select>
                                    </div>
                                    <div id="rq_solution_offering_validate"></div>
                                 </div>

                                  <div class="row enquiries_form">
                                    <div class="col-md-12">
                                       <div class="input-container_description">
                                          <i class="fa fa-pencil-square-o icon"></i>
                                          <textarea class="input-field_de" rows="4" cols="50" placeholder="Description" name="description"><?php echo $enquiries->description;?></textarea>
                                       </div>
                                       <div id="description_validate"></div>
                                    </div>
                                 </div>
                                 <input type="hidden" name="is_request_draft" id="is_request_draft" value="no"/>
                                 <div class="row enquiries_form">
                                    <div class="col-md-6 left_col6">
                                       <div class="register_btn">
                                       <button type="submit" class="btn save_btn_enquiries_form" name="submit">Submit</button>
                                    </div>
                                    </div>

                                    </div>
                                 </div>


                        
                         </div>
                       </div>
                     </div>

                  </form>
               </div>
              
            </section>
            
           
            <!--  *** content *** -->