
<!-- Footer -->
<footer class="clearfix">
    <!-- <div class="pull-right">
        Crafted with <i class="fa fa-heart text-danger"></i> by <a href="https://1.envato.market/ydb" target="_blank">pixelcave</a>
    </div> -->
    <!-- <div class="pull-left">
        <span id="year-copy"></span> &copy; <a href="https://1.envato.market/x4R" target="_blank">ProUI 3.8</a>
    </div> -->
</footer>
<!-- END Footer -->
</div>
</div>
<!-- END Page Container -->
</div>
<!-- END Page Wrapper -->

<!-- Scroll to top link, initialized in js/app.js - scrollToTop() -->
<a href="#" id="to-top" class="text-right"><i class="fa fa-angle-double-up"></i></a>

<!-- User Settings, modal which opens from Settings link (found in top right user menu) and the Cog link (found in sidebar user info) -->
<div id="modal-user-settings" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title"><i class="fa fa-pencil"></i> Change Password</h2>
            </div>
            <!-- END Modal Header -->

            <!-- Modal Body -->
            <div class="modal-body">
                <form action="index.html" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" onsubmit="return false;">
                    <!-- <fieldset>
                        <legend>Vital Info</legend>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Username</label>
                            <div class="col-md-8">
                                <p class="form-control-static">Admin</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user-settings-email">Email</label>
                            <div class="col-md-8">
                                <input type="email" id="user-settings-email" name="user-settings-email" class="form-control" value="admin@example.com">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user-settings-notifications">Email Notifications</label>
                            <div class="col-md-8">
                                <label class="switch switch-primary">
                                    <input type="checkbox" id="user-settings-notifications" name="user-settings-notifications" value="1" checked>
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </fieldset> -->
                    <fieldset>
                        <!-- <legend>Password Update</legend> -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user-settings-password">Old Password</label>
                            <div class="col-md-8">
                                <input type="password" id="user-settings-password" name="user-settings-password" class="form-control" placeholder="Please choose a complex one..">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user-settings-password">New Password</label>
                            <div class="col-md-8">
                                <input type="password" id="user-settings-password" name="user-settings-password" class="form-control" placeholder="Please choose a complex one..">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user-settings-repassword">Confirm New Password</label>
                            <div class="col-md-8">
                                <input type="password" id="user-settings-repassword" name="user-settings-repassword" class="form-control" placeholder="..and confirm it!">
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group form-actions">
                        <div class="col-xs-12 text-right">
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-primary">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- END Modal Body -->
        </div>
    </div>
</div>
<!-- END User Settings -->

<!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->
<script src="<?php echo base_url(); ?>backend_asset/admin/js/vendor/jquery.min.js"></script>
 <script src="<?php echo base_url(); ?>backend_asset/admin/js/vendor/jquery.uploadPreview.min.js"></script>  
<script src="<?php echo base_url(); ?>backend_asset/admin/js/vendor/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>backend_asset/admin/js/plugins.js"></script>
<script src="<?php echo base_url(); ?>backend_asset/admin/js/app.js"></script>
 

<!-- Google Maps API Key (you will have to obtain a Google Maps API key to use Google Maps) -->
<!-- For more info please have a look at https://developers.google.com/maps/documentation/javascript/get-api-key#key -->
<script src="https://maps.googleapis.com/maps/api/js?key="></script>
<script src="<?php echo base_url(); ?>backend_asset/admin/js/helpers/gmaps.min.js"></script>
<script src="<?php echo base_url(); ?>backend_asset/plugins/bootbox/bootbox.min.js"></script>
<!-- Load and execute javascript code used only in this page -->
<script src="<?php echo base_url(); ?>backend_asset/admin/js/pages/index.js"></script>
<script src="<?php echo base_url(); ?>backend_asset/plugins/toastr/toastr.min.js"></script>
<script src="<?php echo base_url(); ?>backend_asset/js/admin.js"></script>

                         
 <script type="text/javascript">
$(document).ready(function() {
  $.uploadPreview3({
    input_field: "#image-upload-admin-vendore",   // Default: .image-upload
    preview_box: "#image-preview-admin-vendore",  // Default: .image-preview
    label_field: "#image-label-admin-vendore",    // Default: .image-label
    label_default: "Upload Logo",   // Default: Choose File
    label_selected: "Change logo",  // Default: Change File
    no_label: false                 // Default: false
  });
});
 
$(document).ready(function() {
  $.uploadPreview4({
    input_field: "#image-upload-business-vendore",   // Default: .image-upload
    preview_box: "#image-preview-business-vendore",  // Default: .image-preview
    label_field: "#image-label-business-vendore",    // Default: .image-label
    label_default: "Upload Logo",   // Default: Choose File
    label_selected: "Change logo",  // Default: Change File
    no_label: false                 // Default: false
  });
});

$(document).ready(function() {
  $.uploadPreview5({
    input_field: "#image-upload-user-vendore",   // Default: .image-upload
    preview_box: "#image-preview-user-vendore",  // Default: .image-preview
    label_field: "#image-label-user-vendore",    // Default: .image-label
    label_default: "Upload Logo",   // Default: Choose File
    label_selected: "Change logo",  // Default: Change File
    no_label: false                 // Default: false
  });
});


$(document).ready(function() {
  $.uploadPreview6({
    input_field: "#image-upload-adduser-vendore",   // Default: .image-upload
    preview_box: "#image-preview-adduser-vendore",  // Default: .image-preview
    label_field: "#image-label-adduser-vendore",    // Default: .image-label
    label_default: "Upload Logo",   // Default: Choose File
    label_selected: "Change logo",  // Default: Change File
    no_label: false                 // Default: false
  });
}); 


$(document).ready(function() {
  $.uploadPreview7({
    input_field: "#image-upload-addvendore-vendore",   // Default: .image-upload
    preview_box: "#image-preview-addvendore-vendore",  // Default: .image-preview
    label_field: "#image-label-addvendore-vendore",    // Default: .image-label
    label_default: "Upload Logo",   // Default: Choose File
    label_selected: "Change logo",  // Default: Change File
    no_label: false                 // Default: false
  });
}); 


$(document).ready(function() {
  $.uploadPreview8({
    input_field: "#image-upload-sitelogo-vendore",   // Default: .image-upload
    preview_box: "#image-preview-sitelogo-vendore",  // Default: .image-preview
    label_field: "#image-label-sitelogo-vendore",    // Default: .image-label
    label_default: "Upload Logo",   // Default: Choose File
    label_selected: "Change logo",  // Default: Change File
    no_label: false                 // Default: false
  });
});











 
  </script>     
  <script>$(function () {
                                Index.init();
                            });</script>
                            
</body>
</html>
