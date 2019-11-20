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
    
     <!-- Quick Stats -->
  <div class="block_list full">
      
                        <div class="row text-center">
                            <div class="col-sm-6 col-lg-3">
                                <a href="<?php echo base_url() ?>business/index/No" class="widget widget-hover-effect2">
                                    <div class="widget-extra themed-background">
                                        <h4 class="widget-content-light"><strong> Unverified </strong> Vendors Business Profile</h4>
                                    </div>
                                    <div class="widget-extra-full"><span class="h2 animation-expandOpen"><?php echo $inactive;?></span></div>
                                </a>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <a href="<?php echo base_url() ?>business/index/Yes" class="widget widget-hover-effect2">
                                    <div class="widget-extra themed-background-dark">
                                        <h4 class="widget-content-light"><strong> Verified </strong> Vendors Business Profile</h4>
                                    </div>
                                    <div class="widget-extra-full"><span class="h2 themed-color-dark animation-expandOpen"><?php echo $active;?></span></div>
                                </a>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                
                            </div>
                            <div class="col-sm-6 col-lg-3">
                               
                            </div>
                        </div>
                        
                        </div>
                        <!-- END Quick Stats -->

    <!-- Datatables Content -->
    <div class="block full">
        <div class="block-title">
            <h2><strong>Vendor</strong> Panel</h2>
            <!-- <?php if ($this->ion_auth->is_admin()) { ?>
                <h2>
                    <a href="<?php echo base_url() ?>business/open_model" class="btn btn-sm btn-primary">
                        <i class="gi gi-circle_plus"></i> Vendor
                    </a></h2>
            <?php } ?> -->
        </div>

        <!-- <div class="content-header">
            <ul class="nav-horizontal text-center">
                <li class="<?php echo ($this->uri->segment(3) == "No") ? 'active' : '';?>">
                    <a href="<?php echo base_url() ?>business/index/No"><i class="fa fa-times"></i> Unverified Vendors Profile</a>
                </li>
                <li class="<?php echo ($this->uri->segment(3) == "Yes") ? 'active' : '';?>">
                    <a href="<?php echo base_url() ?>business/index/Yes"><i class="gi gi-check"></i> Verified Vendors Profile</a>
                </li>
            </ul>
        </div> -->
        <div class="table-responsive">
            <table id="common_datatable_users" class="table table-vcenter table-condensed table-bordered">
                <thead>
                    <tr>
                        <th class="text-center"><?php echo lang('serial_no'); ?></th>
                        <!--                                <th><?php echo "Referral Code"; ?></th>-->
                        <th class="text-center"><?php echo "Company Name"; ?></th>
                        <th class="text-center"><?php echo lang('user_email'); ?></th>
<!--                        <th class="text-center"><?php echo "Phone"; ?></th>-->
                        <!--  <th><?php echo "DOB"; ?></th> -->
                        <!--                                <th><?php echo "Current Password"; ?></th>-->
                        <!--                                <th><?php echo lang('profile_image'); ?></th>-->
                        <th class="text-center">Created Date</th>
                        <!--                                <th><?php //echo lang('user_createdate'); ?></th>-->
                        <th class="text-center"><?php echo lang('action'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($list) && !empty($list)):
                        $rowCount = 0;
                        foreach ($list as $rows):
                            $rowCount++;
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $rowCount; ?></td>        
                                <!--                            <td><?php echo $rows->team_code; ?></td>-->
                                <td class="text-center"><a class="text-primary" href="<?php echo site_url("business/view"); ?>"><?php echo $rows->company_name; ?></a></td>
                                <td class="text-center"><?php echo $rows->email ?></td>
<!--                                <td class="text-center"><?php echo $rows->phone ?></td>-->
                                <!-- <td><?php echo ($rows->date_of_birth != null) ? date('d-m-Y', strtotime($rows->date_of_birth)) : ""; ?></td> -->
                                <!-- <td><?php echo $rows->is_pass_token; ?></td>-->
                                <!-- <td><img width="100" src="<?php if (!empty($rows->profile_pic)) {
                        echo base_Url() ?><?php echo $rows->profile_pic;
                    } else {
                        echo base_url() . DEFAULT_NO_IMG_PATH;
                    } ?>" /></td>-->
                    <td class="text-center"><?php echo date('d F Y',$rows->created_on); ?></td>
<!--                                <td class="text-center"><?php if ($rows->vendor_profile_activate == "Yes") echo '<p class="text-success">Verified</p>';
                    else echo '<p  class="text-danger">Unverified</p>'; ?></td>-->
                                <!--<td><?php //echo date('d F Y',$rows->created_on); ?></td>-->
                                <td class="actions text-center" >
                                    <div class="btn-group btn-group-xs">
                                    <!-- <a href="javascript:void(0)" data-toggle="tooltip" class="btn btn-default" onclick="editFn('vendors','vendor_edit','<?php echo encoding($rows->id); ?>');"><i class="fa fa-pencil"></i></a> -->
                                        <a href="<?php echo base_url() . 'business/vendor_edit?id=' . encoding($rows->id); ?>" data-toggle="tooltip" class="btn btn-default" target="_blank"><i class="fa fa-pencil"></i></a>

                                        <?php if ($this->ion_auth->is_admin()) { ?>
                                            <?php 
                                                if ($rows->vendor_profile_activate == "Yes") { ?>
<!--                                                    <a href="javascript:void(0)" data-toggle="tooltip" class="btn btn-xs btn-success" onclick="statusFn('<?php echo USERS; ?>', 'id', '<?php echo encoding($rows->id); ?>', '<?php echo $rows->active; ?>')" title="Inactive Now"><i class="fa fa-check"></i></a>-->
                                                <?php } else { ?>
<!--                                                    <a href="javascript:void(0)" data-toggle="tooltip" class="btn btn-xs btn-danger" onclick="statusFn('<?php echo USERS; ?>', 'id', '<?php echo encoding($rows->id); ?>', '<?php echo $rows->active; ?>')" title="Active Now"><i class="fa fa-times"></i></a>-->
                                                <?php }
                                                if ($rows->vendor_profile_activate == 'Yes') {
                                                    ?>
                                                    <a href="javascript:void(0)" data-toggle="tooltip" class="btn btn-xs btn-success" onclick="changeVendorStatus('<?php echo encoding($rows->id); ?>', 'No')" title="Unverified Now"><i class="fa fa-check"></i> Verified</a>
                <?php } else { ?>
                                                    <a href="javascript:void(0)" data-toggle="tooltip" class="btn btn-xs btn-danger" onclick="changeVendorStatus('<?php echo encoding($rows->id); ?>', 'Yes')" title="Verified Now"><i class="fa fa-times"></i> Unverified</a>
                                    <?php } ?>
                                                <!-- <a href="javascript:void(0)" data-toggle="tooltip"   onclick="deleteFn('<?php echo USERS; ?>', 'id', '<?php echo encoding($rows->id); ?>', 'vendors', 'business/delVendors')" class="btn btn-danger"><i class="fa fa-trash"></i></a> -->
            <?php 
            ?>
                                        <!-- <a href="<?php echo base_url() . 'business/paymentList/' . $rows->id; ?>" class="btn btn-sm btn-primary">Client List</a> -->
                                        </div>
                                    </td>
                                </tr>
        <?php }endforeach;
endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Datatables Content -->
</div>
<!-- END Page Content -->
<div id="form-modal-box"></div>