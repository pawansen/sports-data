
 <section class="business_section">
               <div class="container">
                 <div class="row">
                  <div class="col-md-3"></div>
                        <!-- <div class="col-md-9 alert_box">
                          <div class="alert ">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong>Danger!</strong> Indicates a dangerous or potentially negative action.
</div>
                        </div> -->
                      </div>



                  <div class="row">
                  <div class="col-md-3">
                       <div class="sidebar_desboard">
                        <div class="edit_profile">
                           <div class="frofile_images">
                           <img src="<?php echo $this->session->userdata('image');?>">
                              <h5><?php echo $this->session->userdata('first_name')." ".$this->session->userdata('last_name');?></h5>
                              <h6>Joined <?php echo $this->session->userdata('created_on');?></h6>
                              <button type="button" class="btn edit_profile_btn"><a href="<?php echo base_url().'front/vendor_dashbaord';?>">Edit Profile<a></button>
                           </div>
                        </div>

                        <div class="munu_sidbar_main">
                          <div class="menu_sidbar">
                              <ul>
                                  
                                 <li><a  href="<?php echo base_url().'front/vendor_dashbaord';?>"><i class="fa fa-user-o icon_menu"></i>Business Profile</a></li>
                                  <li><a href="<?php echo base_url().'front/vendor_profile';?>"><i class="fa fa-user-o icon_menu"></i>Personal details</a></li>
                                  <li><a  href="<?php echo base_url().'front/account_setting';?>"><i class="fa fa-cog icon_menu"></i> Account settings</a></li>
                                  <li><a class="active" href="<?php echo base_url().'front/vendor_enquires';?>"><i class="fa fa-users icon_menu"></i>Enquiries</a></li>
                                  <li><a href="<?php echo base_url().'front/partnership_document';?>"><i class="fa fa-file-text-o icon_menu"></i>Partnership Documents</a></li>
                                  <li><a href="<?php echo base_url().'front/logout';?>"><i class="fa fa-sign-out icon_menu"></i> Logout</a></li>
                              </ul>
                               
                          </div>
                        </div>
                         
                       </div>
                     </div>
                     <div class="col-md-9">
                     

                       <div class="content_desboard">
                         <div class="row">
                           <div class="col-md-12 business_profile">
                               
                              <div class="row">
                             <div class="col-md-12">
                             <h4 class="heading_form">Upcoming Enquires  </h4>
                             </div>
                             </div>

                            <!-- table -->
                            <table id="dtVerticalScrollExampless" class="table table-striped table-bordered table-sm" 
  width="100%">
  <thead>
    <tr>
      <th class="th-sm">Name
      </th>
      <th class="th-sm">Software Category
      </th>
      <th class="th-sm">Date
      </th>
     
    </tr>
  </thead>
  <tbody>
  <?php
                                                                if (!empty($enquiries)) {
                                                                    foreach ($enquiries as $rows) {
                                                                        ?>

                                                                        <tr onclick="getDetails('<?php echo $rows->inq_id;?>')">
                                                                            <td><?php echo ucwords($rows->company_name); ?></td>
                                                                            <td><?php
                                                                            $category = commonGetHelper(array('select'=>"GROUP_CONCAT(category_name SEPARATOR ',') as category_name",'table'=>"item_category","where_in" => array('id'=>explode(",",$rows->rq_software_categories))));
                                                                            echo $category[0]->category_name;;?></td>
                                                                            <td><?php echo date('d M Y - h:iA', strtotime($rows->enquiry_date)); ?></td>

                                                                        </tr>

                                                                    <?php
                                                                    }
                                                                }
                                                                ?>
  </tbody>
  
</table>

                            


                                  


                              

                            <!-- table -->

                            </div>
                           </div>

                         </div>
                       </div>
                     </div>
               </div>
               
            </section>
            
           
            <!--  *** content *** -->
            <div id="model_profile"></div>