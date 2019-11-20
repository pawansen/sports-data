<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.js"></script>
<!-- Page content -->
<div id="page-content">
    <!-- Datatables Header -->
    <ul class="breadcrumb breadcrumb-top">
        <li>
            <a href="<?php echo site_url('pwfpanel'); ?>">Home</a>
        </li>
        <li>
            <a href="<?php echo site_url('business'); ?>">Vendor</a>
        </li>
    </ul>
    <!-- END Datatables Header -->


    <div class="row">
        <div class="col-md-4" >

            <div class="block">
                <!-- Customer Info Title -->
                <div class="block-title">
                    <h2><i class="fa fa-file-o"></i> <strong>Vendor</strong> Profile</h2>
                </div>
                <!-- END Customer Info Title -->
                <?php $cat_id = ($results->category_id) ? explode(",", $results->category_id) : array(); ?>
                <!-- Customer Info -->
                <div class="block-section text-center">
                    <a href="javascript:void(0)">
                        <img src="<?php echo (!empty($results->img)) ? base_url() . $results->img : base_url() . 'backend_asset/images/default.jpg'; ?>" alt="avatar" class="img-circle" style=" width: 100px; height: 100px;">
                    </a>
                    <h3>
                        <strong><?php echo $results->first_name . " " . $results->last_name; ?></strong><br><small></small>
                    </h3>
                </div>
                <table class="table table-borderless table-striped table-vcenter">
                    <tbody>
                        <tr>
                            <td class="text-right"><strong>Company Name</strong></td>
                            <td><?php echo $results->company_name; ?></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>Company Website</strong></td>
                            <td><?php echo $results->website; ?></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>Description</strong></td>
                            <td><?php echo $results->description; ?></td>
                        </tr>

                        <tr>
                            <td class="text-right"><strong>Software Category</strong></td>
                            <td><?php foreach ($categorys as $category) { ?>

                                    <?php echo (in_array($category->id, $cat_id)) ? $category->category_name . "," : ""; ?>

                                <?php } ?></td>
                        </tr>

                        <tr>
                            <td class="text-right"><strong> Country</strong></td>
                            <td>    <?php foreach ($countries as $country) { ?>

                                    <?php echo ($results->country == $country->id) ? $country->name : ""; ?>

                                <?php } ?></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>State </strong></td>
                            <td>            <?php foreach ($states as $state) { ?>

                                    <?php echo ($results->state == $state->id) ? $state->name : ""; ?>

                                <?php } ?></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>City</strong></td>
                            <td><?php echo $results->city; ?></td>
                        </tr>

                        <tr>
                            <td class="text-right"><strong>Address </strong></td>
                            <td><?php echo $results->address1; ?></td>
                        </tr>

<!--<tr>-->
<!--    <td class="text-right"><strong>Status</strong></td>-->
<!--    <td><span class="label label-success"><i class="fa fa-check"></i> Active</span></td>-->
                        <!--</tr>-->
                    </tbody>
                </table>
                <!-- END Customer Info -->
            </div>


        </div>
        <div class="col-md-8" >    <div class="block full">
                <div class="block-title">
                    <h2><strong>Vendor's</strong> Panel</h2>
                </div>        
                <form class="form-horizontal" role="form" id="editFormAjaxUser" method="post" action="<?php echo base_url('business/vendor_update') ?>" enctype="multipart/form-data">
                    <div class="modal-header text-center">
                        <h2 class="modal-title"><i class="fa fa-pencil"></i> <?php echo (isset($title)) ? ucwords($title) : "" ?></h2>
                    </div>
                    <!-- <div class="loaders">
                        <img src="<?php //echo base_url().'backend_asset/images/Preloader_2.gif'; ?>" class="loaders-img" class="img-responsive">
                    </div> -->
                    <div class="alert alert-danger" id="error-box" style="display: none"></div>
                    <div class="form-body">
                        <div class="row">
                            <!-- <div class="col-md-12" >
                               <div class="form-group">
                                   <label class="col-md-3 control-label">First Name</label>
                                   <div class="col-md-9">
                                       <input type="text" class="form-control" name="first_name" id="first_name" placeholder="<?php echo lang('first_name'); ?>" value="<?php echo $results->first_name; ?>"/>
                                   </div>
                               </div>
                           </div> -->

                            <!-- <div class="col-md-12" >
                              <div class="form-group">
                                  <label class="col-md-3 control-label"><?php echo lang('last_name'); ?></label>
                                  <div class="col-md-9">
                                      <input type="text" class="form-control" name="last_name" id="last_name" placeholder="<?php echo lang('last_name'); ?>" value="<?php echo $results->last_name; ?>"/>
                                  </div>
                              </div>
                          </div>
                            -->
                            <!-- <div class="col-md-12" >
                               <div class="form-group">
                                   <label class="col-md-3 control-label"><?php echo lang('user_email'); ?></label>
                                   <div class="col-md-9">
                                       <input type="email" class="form-control" name="user_email" id="user_email" value="<?php echo $results->email; ?>" readonly/>
                                   </div>
                               </div>
                           </div> -->
                            <!-- <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Country Phone Code</label>
                                    <div class="col-md-9">                                
                                        <select id="phone_code" name="phone_code" class="form-control select2" size="1">
                                            <option value="0">Please select</option>
                            <?php foreach ($countries as $country) { ?>
                                                            
                                                <option value="<?php echo $country->phonecode; ?>" <?php echo ($results->phone_code == $country->phonecode) ? "selected" : ""; ?>><?php echo $country->sortname . "(" . $country->phonecode . ")"; ?></option>
                                                        
                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Company Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="company_name" value="<?php echo $results->company_name; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Company Website</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="website" value="<?php echo $results->website; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Description</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="description" id="description" value="<?php echo $results->description; ?>"/>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Designation</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="designation" id="designation" value="<?php echo $results->designation; ?>"/>
                                    </div>
                                </div>
                            </div> -->


                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Software Category</label>
                                    <div class="col-md-9">
                                        <select id="category_id" name="category_id[]" class="form-control select-chosen" multiple size="1">
                                            <option value="">Please select</option>
                                            <?php foreach ($categorys as $category) { ?>

                                                <option value="<?php echo $category->id; ?>" <?php echo (in_array($category->id, $cat_id)) ? "selected" : ""; ?>><?php echo $category->category_name; ?></option>

                                            <?php } ?>
                                        </select>
<!--                                        <input type="text" class="form-control" name="state" placeholder="State" value="<?php //echo $results->state;  ?>"/>-->
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Country</label>
                                    <div class="col-md-9">
                                        <!-- <input type="text" class="form-control" name="country" id="country" placeholder="Country"/> -->

                                        <select id="country" name="country" class="form-control select2" size="1">
                                            <option value="" disabled selected>Please select</option>
                                            <?php foreach ($countries as $country) { ?>

                                                <option value="<?php echo $country->id; ?>" <?php echo ($results->country == $country->id) ? "selected" : ""; ?>><?php echo $country->name; ?></option>

                                            <?php } ?>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">State</label>
                                    <div class="col-md-9">
                                        <select id="country" name="state" class="form-control select2" size="1">
                                            <option value="" disabled selected>Please select</option>
                                            <?php foreach ($states as $state) { ?>

                                                <option value="<?php echo $state->id; ?>"  <?php echo ($results->state == $state->id) ? "selected" : ""; ?>><?php echo $state->name; ?></option>

                                            <?php } ?>
                                        </select>
<!--                                        <input type="text" class="form-control" name="state" placeholder="State" value="<?php //echo $results->state;  ?>"/>-->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">City</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="city" placeholder="City Name" value="<?php echo $results->city; ?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Address</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="address1" value="<?php echo $results->address1; ?>"/>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo "Current Password"; ?></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="current_password" id="current_password" value="<?php echo $results->is_pass_token; ?>" readonly=""/>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="col-md-12" >
                              <div class="form-group">
                                  <label class="col-md-3 control-label"><?php echo lang('new_password'); ?></label>
                                  <div class="col-md-9">
                                      <input type="text" class="form-control" name="new_password" id="new_password"/>
                                  </div>
                              </div>
                          </div> -->
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Company Logo</label>
                                    <div class="col-md-9">

                                        <div class="group_filed">
                                            <div class="img_back_prieview_Academic">
                                                <div class="images_box_upload_ven_business_vendore">
                                                    <div id="image-preview-business-vendore">
                                                        <input type="file" name="user_image" id="image-upload-business-vendore" />
                                                    </div>
                                                </div>
                                                <div id="image-preview-business">
                                                    <label for="image-upload-business-vendore" id="image-label-business-vendore">Upload Logo</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!--<div class="profile_content edit_img">
                                        <div class="file_btn file_btn_logo">
                                          <input type="file"  class="input_img2" id="user_image" name="user_image" style="display: inline-block;">
                                          <span class="glyphicon input_img2 logo_btn" style="display: block;">
                                            <div id="show_company_img"></div>
                                            <span class="ceo_logo row push">
                                        <?php if (!empty($results->profile_pic)) { ?>
                                                        <div class="col-sm-6 col-md-4">
                                                            <a href="<?php echo base_url() . $results->profile_pic; ?>" data-toggle="lightbox-image">
                                                                <img src="<?php echo base_url() . $results->profile_pic; ?>" alt="image">
                                                            </a>
                                                        </div>
                                        <?php } else { ?>
                                                        <a href="<?php echo base_url() . 'backend_asset/images/default.jpg'; ?>" data-toggle="lightbox-image">
                                                                <img src="<?php echo base_url() . 'backend_asset/images/default.jpg'; ?>" alt="image">
                                                            </a>
                                        <?php } ?>
                                                
                                            </span>
                                            
                                          </span>
                                          <img class="show_company_img2" style="display:none" alt="img" src="<?php echo base_url() ?>/backend_asset/images/logo.png">
                                          <span style="display:none" class="fa fa-close remove_img"></span>
                                        </div>
                                      </div> -->



                                        <div class="ceo_file_error file_error text-danger"></div>
                                    </div>
                                </div>
                            </div>


                            <input type="hidden" name="id" value="<?php echo $results->id; ?>" />
                            <input type="hidden" name="password" value="<?php echo $results->password; ?>" />
                            <input type="hidden" name="exists_image" value="<?php echo $results->profile_pic; ?>" />
                            <div class="space-22"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit"  class="btn btn-sm btn-primary" id="submit">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div></div>

    </div>

    <!-- Datatables Content -->







    <!-- END Datatables Content -->
</div>
<!-- END Page Content -->
<script type="text/javascript">
    $('#date_of_birth').datepicker({
        startView: 2,
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        endDate: 'today'
    });
    /*    $("#zipcode").select2({
     allowClear: true
     });*/
</script>
