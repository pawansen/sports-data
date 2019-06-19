<!-- Page content -->
<div id="page-content">
    <!-- Datatables Header -->
    <!-- <div class="content-header">
        <div class="header-section">
            <h1>
                <i class="fa fa-user"></i>Users<br><small>Users listing</small>
            </h1>
        </div>
    </div> -->
    <ul class="breadcrumb breadcrumb-top">
    <li>
        <a href="<?php echo site_url('pwfpanel');?>">Home</a>
    </li>
    <li>
        <a href="<?php echo site_url('users');?>">Users</a>
    </li>
    </ul>
    <!-- END Datatables Header -->

    <!-- Datatables Content -->
    <div class="block full">
        <div class="block-title">
            <h2><strong>Users</strong> Panel</h2>
            <?php if ($this->ion_auth->is_admin()) {?>
                <h2>
                    <a href="<?php echo base_url() ?>users/open_model" class="btn btn-sm btn-primary" target="_blank">
                <i class="gi gi-circle_plus"></i> User
                </a></h2>
            <?php }?>
        </div>
       

        <div class="table-responsive">
            <table id="users" class="table table-vcenter table-condensed table-bordered">
                <thead>
                    <tr>

                        
            <th><?php echo lang('serial_no');?></th>
            <!-- <th class="text-center"><?php echo "Team Code";?></th> -->
            <th class="text-center"><?php echo "Name";?></th>
            <th><?php echo lang('user_email');?></th>
            <th class="text-center"><?php echo "Phone";?></th>
            <!-- <th><?php echo "Total purchase amount";?></th>
            <th><?php echo "Total deposit amount";?></th>
             <th><?php echo "Total amount due";?></th> -->
<!--                                <th><?php echo lang('profile_image');?></th>-->
             <th><?php echo lang('status');?></th>
            <th><?php echo lang('user_createdate');?></th>
            <th><?php echo lang('action');?></th>
        
                    </tr>
                </thead>
              
            </table>
        </div>
    </div>
    <!-- END Datatables Content -->
</div>
<!-- END Page Content -->
<div id="form-modal-box"></div>