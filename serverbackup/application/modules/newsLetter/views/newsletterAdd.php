         
<!-- Page content -->
<div id="page-content">
    <!-- Datatables Header -->
    <ul class="breadcrumb breadcrumb-top">
        <li>
            <a href="<?php echo site_url('pwfpanel'); ?>">Home</a>
        </li>
        <li>
            <a href="<?php echo site_url('newsLetter'); ?>">Newsletters</a>
        </li>
    </ul>
    <!-- END Datatables Header -->
    <!-- Datatables Content -->
    <div class="block full">
        <div class="table-responsive">
            <form class="form-horizontal" role="form" id="addFormAjax" method="post" action="<?php echo base_url('newsLetter/news_add') ?>" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close button_close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"><?php echo (isset($title)) ? ucwords($title) : "" ?></h4>
                </div>
                <div class="modal-body"> 
                    <!-- <div class="loaders">
                        <img src="<?php //echo base_url().'backend_asset/images/Preloader_2.gif'; ?>" class="loaders-img" class="img-responsive">
                    </div> -->
                    <div class="alert alert-danger" id="error-box" style="display: none"></div>
                    <div class="form-body">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">NewsLetter Subject</label>
                                <div class="col-md-9">
                                    <input type="text" name="subject" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Title</label>
                                <div class="col-md-9">
                                    <input type="text" name="title[]" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Message</label>
                                <div class="col-md-9">
                                    <textarea class="form-control ckeditor" name="description[]"></textarea>
                                </div>
                                <span class="help-block m-b-none col-md-offset-3">
                            </div>    
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Image</label>
                                <div class="col-md-9 ">
                                    <div class="border_banner_box_news">
                                        <input type="file" name="files" class="form-control ">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group"><div class="col-md-12 col-md-offset-10">
<!--                                    <button type="button" id="newsletterbutton" onclick="getMoreNewsletter()" class="btn btn-info"><i class="fa fa-plus"></i> ADD MORE</button>-->
                                </div></div>

                            <!-- <div id="newsletter"></div> -->


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Title</label>
                                    <div class="col-md-9">
                                        <input type="text" name="title[]" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Message</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control ckeditor" id="ckeditor" name="description[]"></textarea>
                                    </div>
                                    <span class="help-block m-b-none col-md-offset-3">
                                </div>    
                                <div class="clearfix"></div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Image</label>
                                    <div class="col-md-9">
                                        <div class="border_banner_box_news">
                                            <input type="file" name="files1" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="form-group"><div class="col-md-12 col-md-offset-10">
                                 <button type="button" id="newsletterbutton" onclick="removeMoreNewsletter(<?php echo $key; ?>)" class="btn btn-primary">
                                 <i class="fa fa-minus"></i> REMOVE</button></div> -->
                            </div>
                        </div>


                        <div class="col-md-12" >
                            <div class="form-group">
                                <label class="col-md-3 control-label">Title</label>
                                <div class="col-md-9">
                                    <input type="text" name="title[]" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Message</label>
                                <div class="col-md-9">
                                    <textarea class="form-control ckeditor" id="ckeditor" name="description[]"></textarea>
                                </div>
                                <span class="help-block m-b-none col-md-offset-3">
                            </div>    
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Image</label>
                                <div class="col-md-9">
                                    <div class="border_banner_box_news">
                                        <input type="file" name="files2" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="form-group"><div class="col-md-12 col-md-offset-10">
                             <button type="button" id="newsletterbutton" onclick="removeMoreNewsletter(<?php echo $key; ?>)" class="btn btn-primary">
                             <i class="fa fa-minus"></i> REMOVE</button></div> -->
                        </div>
                    </div>

                    <hr>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Select Sender</label>
                        <div class="col-md-9">
                            <label class="checkbox-inline" for="example-inline-checkbox1">
                                <input type="radio" id="example-inline-checkbox1" onclick="changeType('All')" name="userType" value="All"> All Vendors & Clients
                            </label>
                            <label class="checkbox-inline" for="example-inline-checkbox2">
                                <input type="radio" id="example-inline-checkbox2" onclick="changeType('Selected')" name="userType" value="Selected"> Select Vendors & Clients
                            </label>

                        </div>           
                    </div>

                    <div class="form-group userselectID" style="display:none">
                        <label class="col-md-3 control-label" for="example-multiple-select">User select</label>
                        <div class="col-md-9">
                            <select id="user-multiple-select" name="email[]" class="select-chosen" data-placeholder="Choose a user.." multiple>
                                <?php foreach ($users as $value) { ?>
                                    <option value="<?php echo $value->id ?>"><?php echo $value->first_name . " " . $value->last_name . "(" . $value->email . ")"; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group userselectID"  style="display:none">
                        <label class="col-md-3 control-label" for="example-multiple-select">Vendor select</label>
                        <div class="col-md-9">
                            <select id="vendor-multiple-select" name="email[]" class="select-chosen" data-placeholder="Choose a vendor.." multiple>
                                <?php foreach ($vendors as $value) { ?>
                                    <option value="<?php echo $value->id ?>"><?php echo $value->first_name . " " . $value->last_name . "(" . $value->email . ")"; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="submit" class="btn btn-sm btn-primary" >Save</button>
    </div>
</form>
</div>
</div>
<!-- END Datatables Content -->
</div>
<!-- END Page Content -->

<script type="text/javascript">
    function changeType(type) {
        if (type == 'All') {
            $('#All').prop('checked', true);
            $('#emailIDs').prop('disabled', true);
        } else if (type == 'Selected') {
            $('#Selected').prop('checked', true);
            $('#emailIDs').prop('disabled', false);
        }
    }
</script>