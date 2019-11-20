<section class="business_section">
               <div class="container">
               <form action="<?php echo site_url('front/client_request_submit');?>" id="editFormAjaxinquiry"  name="editFormAjaxinquiry" method="POST" enctype='multipart/form-data'>
                  <div class="row">
                    
                     <div class="col-md-12">
                     
                       <div class="content_enquiries_form">
                        <div class="row enquiries_form_heading">
                          <div class="col-md-12">
                          <div class="text-success"><?php echo $this->session->flashdata("message");?></div>
                          <h4 class="heading_form">Fill the enquiry form</h4></div>
                          
                        </div>

                        <div class="row enquiries_form">
                                    <div class="col-md-6 left_col6">
                                       <div class="input-container readonly_bg_feild">
                                          <i class="fa fa-user-o  icon"></i>
                                          <input class="input-field" type="text" placeholder="Frist Name" name="vendor_name" value="<?php echo $this->session->userdata('first_name')." ".$this->session->userdata('last_name');?>" readonly>
                                       </div>
                                    </div>

                                    <div class="col-md-6 right_col6">
                                       <div class="input-container">
                                          <i class="fa fa-envelope-o  icon"></i>
                                          <input class="input-field" type="email" placeholder="Email Address" name="rq_email" value="<?php echo $this->session->userdata('email');?>">
                                       </div>
                                    </div>
                                  </div>

                                  
                                  <div class="row enquiries_form">
                                    <div class="col-md-6 left_col6">
                                       <div class="input-container ">
                                          <i class="fa fa-building icon"></i>
                                          <input class="input-field" type="text" placeholder=" No. of licenses" name="rq_licenses">
                                       </div>
                                    </div>

                                    <div class="col-md-6 right_col6">
                                          <div class="input-container ">
                                    <select class="select2-list" name="rq_software_categories[]" multiple>
<!--                                      <option value="">Select categories </option>-->
                         <?php foreach($category as $rows){?>
                             <option value="<?php echo $rows->id;?>"><?php echo ucwords($rows->category_name);?></option>
                         <?php }?>
                        </select>
                                    </div>
                                        </div>
                                  </div>



                                    <div class="row enquiries_form">
                                    <div class="col-md-6 left_col6">
                                    <select class="input-container" name="rq_expected_live">
                                       <option value="" disabled selected>Expected go live </option>
                                       <option value="Within a week"  >Within a week</option>
                                       <option value="Within 15 days" >Within 15 days</option>
                                       <option value="Within 1 month" >Within 1 month</option>
                                       <option value="After  1 month" >After  1 month </option>
                                     </select>
                                    </div>
                                    
                             <div class="col-md-6 right_col6">
                             <select class="input-container" name="rq_solution_offering">
                                  <option value="" disabled selected> Expected contract term </option>
                                  <option value="1 year" >1 year</option>
                                  <option value="2 years" >2 years</option>
                                  <option value="3 years" >3 years</option>
                                  <option value="4 years"  >4 years</option>
                                  <option value="5 years"  >5 years</option>
                                  <option value="more than 5 years" >more than 5 years</option>
                               </select>
                                    </div>

                                 </div>

                                  <div class="row enquiries_form">
                                    <div class="col-md-12">
                                       <div class="input-container_description">
                                          <i class="fa fa-pencil-square-o icon"></i>
                                          <textarea class="input-field_de" rows="4" cols="50" placeholder="Description" name="description"></textarea>
                                       </div>
                                    </div>
                                 </div>


                                 <div class="row enquiries_form">
                                    <div class="col-md-6 left_col6">
                                       <div class="register_btn">
                                       <button type="submit" class="btn save_btn_enquiries_form" name="submit">Submit</button>
                                    </div>
                                    </div>

                                    <div class="col-md-6 right_col6">
                                       
                                    </div>
                                 </div>


                        
                         </div>
                       </div>
                     </div>
                     </form>
               </div>
              
            </section>