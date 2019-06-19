<div id="myModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content_test">
               <div class="modal-header">
                  <span class="close_popup" data-dismiss="modal">&times;</span>
               </div>
              
               <div class="modal-body">
                  <div class="popup_slider">
                     <div class="popup_header_title">
                         <div class="mail_form">
                           <p>Form</p>
                           <h5>Arrett jugal Winters</h5>
                         </div>
                         <div class="mail_to">
                          <p>To</p>
                          <h5> <?php echo $enquiries->company_name;?></h5>
                        </div>
                     </div>

                     <div class="popup_time">
                      <hr class="hr_line_popup">
                       <p> <?php echo date('d M Y h:i:sA',strtotime($enquiries->enquiry_date));?></p>
                     </div>
                    
                     <div class="popup_contant">

                      <div class="popup_group">
                      <div class="popup_contant_left">
                        <p>Software Category</p>
                      </div>
                      <div class="popup_contant_center">
                        <p>-</p>
                      </div>
                       <div class="popup_contant_right">
                        <p><?php echo $enquiries->category_name;?></p>
                      </div>
                    </div>

                      <div class="popup_group">
                      <div class="popup_contant_left">
                        <p>No of licenses</p>
                      </div>
                      <div class="popup_contant_center">
                        <p>-</p>
                      </div>
                      <div class="popup_contant_right">
                        <p><?php echo $enquiries->rq_licenses;?></p>
                      </div>
                    </div>


                      <div class="popup_group">
                      <div class="popup_contant_left">
                        <p>Expected duration</p>
                      </div>
                      <div class="popup_contant_center">
                        <p>-</p>
                      </div>
                      <div class="popup_contant_right">
                        <p><?php echo $enquiries->rq_expected_live;?></p>
                      </div>
                    </div>

                    <div class="popup_group">
                      <div class="popup_contant_left">
                        <p>Expected contract term</p>
                      </div>
                      <div class="popup_contant_center">
                        <p>-</p>
                      </div>
                      <div class="popup_contant_right">
                        <p><?php echo $enquiries->rq_solution_offering;?></p>
                      </div>
                    </div>


                      <div class="popup_group">
                      <div class="popup_contant_left">
                        <p>Description </p>
                      </div>
                      <div class="popup_contant_center">
                        <p>-</p>
                      </div>
                      <div class="popup_contant_right">
                        <p> <?php echo $enquiries->description;?></p>
                      </div>
                    </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
