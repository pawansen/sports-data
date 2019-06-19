<style>
.select2-container, .select2-drop, .select2-search, .select2-search input {
    width: 290px !important;
}
</style>

<style type="text/css">
    .select2-close-mask{
    z-index: 2099;
}
.select2-dropdown{
    z-index: 3051;
}

    #message_div{
        background-color: #ffffff;
        border: 1px solid;
        box-shadow: 10px 10px 5px #888888;
        display: none;
        height: auto;
        left: 36%;
        position: fixed;
        top: 20%;
        width: 40%;
        z-index: 1;
    }
    #close_button{
        right:-15px;
        top:-15px;
        cursor: pointer;
        position: absolute;
    }
    #close_button img{
        width:30px;
        height:30px;
    }    
    #message_container{
        height: 450px;
        overflow-y: scroll;
        padding: 20px;
        text-align: justify;
        width: 99%;
    }
</style>   
                   
                    <!-- Page content -->
                    <div id="page-content">
                        <!-- Datatables Header -->
                        <ul class="breadcrumb breadcrumb-top">
                        <li>
                            <a href="<?php echo site_url('admin/dashboard'); ?>"><?php echo lang('home'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('email'); ?>"><?php echo "Sent Emails"; ?></a>
                        </li>
                        </ul>
                        <!-- END Datatables Header -->

                        <!-- Datatables Content -->
                        <div class="block full">
                            <div class="block-title">
                                <h2><strong>Email Broadcast</strong> Panel</h2>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">    
                                    <form class="form-horizontal" role="form" id="addFormAjax" method="post" action="<?php echo base_url('email/email_add') ?>" enctype="multipart/form-data">
                                        <div class="modal-header">
                                            <h4 class="modal-title"><?php echo "Send Email" ?></h4>
                                        </div>
                                        <div class="modal-body" style="max-height: 800px">
                                            <div class="loaders">
                                                <img src="<?php echo base_url().'backend_asset/images/Preloader_2.gif';?>" class="loaders-img" class="img-responsive">
                                            </div>
                                            <div class="alert alert-danger" id="error-box" style="display: none"></div>
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-12" >
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">To</label>
                                                            <div class="col-md-4">
                                                                <input type="radio" checked onclick="usersList('0')" value="0" name="userType"/>
                                                                <label class="control-label">All Users</label>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="radio" onclick="usersList('1')" value="1" name="userType"/>
                                                                <label class="control-label">Select Users</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12" >
                                                        <div class="form-group">
                                                        <label class="col-md-2 control-label"></label>
                                                        <div class="col-md-9" style="float: center">
                                                            <select style="display:none;width: 100%" id="user_ids" disabled name="user_email_ids[]" multiple>
                                                                <?php if(!empty($usersList)){       
                                                                    foreach($usersList as $row){ ?>
                                                                        <option value="<?php echo $row->email;?>"><?php echo $row->email; ?></option>
                                                                <?php }
                                                                }?>
                                                            </select>
                                                        </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12" >
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Subject</label>
                                                            <div class="col-md-9">
                                                                <select name="email_type" class="form-control">
                                                                    <option value="">Select</option>
                                                                    <option value="COUPON_REQUEST">Coupon Request</option>
                                                                    <option value="APOLOGIES">Apologies message</option>
                                                                    <option value="QUERY">Query Message</option>
                                                                    <option value="LOGIN_QUERY">Login query mail</option>
                                                                    <option value="DEBIT_PAYMENT_QUERY">Debit Payment query mail</option>
                                                                    <option value="USER_TEAM_NOT_WORKING">User’s Team not working query</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                                    <div class="space-22"></div>
                                                </div>
                                            </div>
                                        </div><hr>
                                        <div style="float: right;">
                                            <button type="submit" id="submit" class="<?php echo THEME_BUTTON;?>" ><?php echo lang('submit_btn');?></button>
                                        </div>
                                    </form>        
                                </div>
                            </div>
                        </div>
                        <!-- END Datatables Content -->
                    </div>
                    <!-- END Page Content -->
                    <div id="form-modal-box"></div>
                    <div id="message_div">
        <span id="close_button"><img src="<?php echo base_url(); ?>backend_asset/images/close.png" onclick="close_message();"></span>
        <div id="message_container"></div>
    </div>
<script type="text/javascript">
    window.onload = function () {
        // body...
         $("#user_ids").select2({
            allowClear: true
        });   
    }
</script>

