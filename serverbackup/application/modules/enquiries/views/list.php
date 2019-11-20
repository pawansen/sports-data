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
                                <a href="<?php echo base_url() ?>enquiries/index/No" class="widget widget-hover-effect2">
                                    <div class="widget-extra themed-background">
                                        <h4 class="widget-content-light"><strong> Pending </strong> Enquiries</h4>
                                    </div>
                                    <div class="widget-extra-full"><span class="h2 animation-expandOpen"><?php echo $inactive;?></span></div>
                                </a>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <a href="<?php echo base_url() ?>enquiries/index/Yes" class="widget widget-hover-effect2">
                                    <div class="widget-extra themed-background-dark">
                                        <h4 class="widget-content-light"><strong> Verified </strong> Enquiries</h4>
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
            <h2><strong>Enquiries</strong> Panel</h2>
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
                    <a href="<?php echo base_url() ?>enquiries/index/No"><i class="fa fa-times"></i> Pending Enquiries</a>
                </li>
                <li class="<?php echo ($this->uri->segment(3) == "Yes") ? 'active' : '';?>">
                    <a href="<?php echo base_url() ?>enquiries/index/Yes"><i class="gi gi-check"></i> Verified Enquiries</a>
                </li>
            </ul>
        </div> -->
        <div class="table-responsive">
            <table id="common_datatable_users" class="table table-vcenter table-condensed table-bordered">
                <thead>
                    <tr>
                        <th class="text-center"><?php echo lang('serial_no'); ?></th>
                        <th>Company Name</th>
                        <th class="text-center">Vendor name</th>
                        <th class="text-center">Client Name</th>
<!--                        <th class="text-center">Category</th>-->
<!--                         <th>Expected go live</th>
                         <th>Expected contract term </th>
                        <th>Description</th>
                        <th class="text-center">No. of licenses</th>-->
                        <th>Request Date</th>
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
                                <td class="text-center"><?php echo $rows->company_name; ?></td>
                                <td class="text-center"><?php echo $rows->first_name." ".$rows->last_name; ?></td>
                                <td class="text-center"><?php echo $rows->c_first_name." ".$rows->c_last_name; ?></td>
<!--                                <td class="text-center"><?php
                                                                            //$category = commonGetHelper(array('select'=>"GROUP_CONCAT(category_name SEPARATOR ',') as category_name",'table'=>"item_category","where_in" => array('id'=>explode(",",$rows->rq_software_categories))));
                                                                            //echo $category[0]->category_name;?></td>-->
<!--                                <td class="text-center"><?php echo $rows->rq_expected_live; ?></td>
                                <td class="text-center"><?php echo $rows->rq_solution_offering; ?></td>
                                <td class="text-center"><?php echo $rows->description; ?></td>
                                <td class="text-center"><?php echo $rows->rq_licenses; ?></td>-->
                                <td class="text-center"><?php echo $rows->enquiry_date; ?></td>

             
<!--                                <td class="text-center"><?php if ($rows->vendor_profile_activate == "Yes") echo '<p class="text-success">Verified</p>';
                    else echo '<p  class="text-danger">Unverified</p>'; ?></td>-->
                                <!--<td><?php //echo date('d F Y',$rows->created_on); ?></td>-->
                                <td class="actions text-center" >            
                                    <a href="javascript:void(0)" class="btn btn-xs btn-default" onclick="editFn('enquiries', 'view', '<?php echo $rows->inq_id; ?>', 'menuCategory');"><i class="fa fa-eye"></i></a>
                                    <div class="btn-group btn-group-xs">
                                    <!-- <a href="javascript:void(0)" data-toggle="tooltip" class="btn btn-default" onclick="editFn('vendors','vendor_edit','<?php echo encoding($rows->id); ?>');"><i class="fa fa-pencil"></i></a> -->
                                        <!-- <a href="<?php echo base_url() . 'enquiries/vendor_edit?id=' . encoding($rows->id); ?>" data-toggle="tooltip" class="btn btn-default" target="_blank"><i class="fa fa-pencil"></i></a> -->

                                        <?php if ($this->ion_auth->is_admin()) { ?>
                                            <?php 
                                                if ($rows->inq_active == "Yes") { ?>
<!--                                                    <a href="javascript:void(0)" data-toggle="tooltip" class="btn btn-xs btn-success" onclick="statusFn('<?php echo USERS; ?>', 'id', '<?php echo encoding($rows->id); ?>', '<?php echo $rows->active; ?>')" title="Inactive Now"><i class="fa fa-check"></i></a>-->
                                                <?php } else { ?>
<!--                                                    <a href="javascript:void(0)" data-toggle="tooltip" class="btn btn-xs btn-danger" onclick="statusFn('<?php echo USERS; ?>', 'id', '<?php echo encoding($rows->id); ?>', '<?php echo $rows->active; ?>')" title="Active Now"><i class="fa fa-times"></i></a>-->
                                                <?php }
                                                if ($rows->inq_active == 'Yes') {
                                                    ?>
                                                    <a href="javascript:void(0)" data-toggle="tooltip" class="btn btn-xs btn-success" onclick="changeVendorStatus('<?php echo encoding($rows->inq_id); ?>', 'No')" title="Unverified Now"><i class="fa fa-check"></i> Verified</a>
                <?php } else { ?>
                                                    <a href="javascript:void(0)" data-toggle="tooltip" class="btn btn-xs btn-danger" onclick="changeVendorStatus('<?php echo encoding($rows->inq_id); ?>', 'Yes')" title="Verified Now"><i class="fa fa-times"></i> Unverified</a>
                                    <?php } ?>
                                                <!-- <a href="javascript:void(0)" data-toggle="tooltip"   onclick="deleteFn('<?php echo USERS; ?>', 'id', '<?php echo encoding($rows->id); ?>', 'vendors', 'business/delVendors')" class="btn btn-danger"><i class="fa fa-trash"></i></a> -->
            <?php 
            ?>
                                        <!-- <a href="<?php echo base_url() . 'enquiries/paymentList/' . $rows->inq_id; ?>" class="btn btn-sm btn-primary">Client List</a> -->
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