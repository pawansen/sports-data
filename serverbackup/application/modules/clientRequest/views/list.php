<!-- Page content -->
<div id="page-content">
    <!-- Datatables Header -->
    <ul class="breadcrumb breadcrumb-top">
        <li>
            <a href="<?php echo site_url('pwfpanel'); ?>">Home</a>
        </li>
        <li>
            <a href="<?php echo site_url('clientRequest'); ?>">Client Request</a>
        </li>
    </ul>
    <!-- END Datatables Header -->

    <!-- Datatables Content -->
    <div class="block full">
        <div class="block-title">
            <h2><strong>Client</strong> Request</h2>
        </div>
        <div class="table-responsive">
            <table id="common_datatable_users" class="table table-vcenter table-condensed table-bordered">
                <thead>
                    <tr>
                        <th class="text-center"><?php echo lang('serial_no'); ?></th>
                        <th>Client Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Software Category</th>
<!--                        <th>Expected go live</th>
                        <th>Expected contract term </th>-->
<!--                        <th>Description</th>-->
                        <th class="text-center">No. of licenses</th>
                        <th>Request Date</th>
                        <th>Action</th>
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
                                <td class="text-center"><?php echo $rows->first_name." ".$rows->last_name; ?></td>
                                <td class="text-center"><?php echo $rows->email; ?></td>
                                <td class="text-center"><?php
                                 $category = commonGetHelper(array('select'=>"GROUP_CONCAT(category_name SEPARATOR ',') as category_name",'table'=>"item_category","where_in" => array('id'=>explode(",",$rows->rq_software_categories))));
                                  echo $category[0]->category_name;?></td>
<!--                                <td class="text-center"><?php echo $rows->rq_expected_live; ?></td>
                                <td class="text-center"><?php echo $rows->rq_solution_offering; ?></td>
                                <td class="text-center"><?php echo $rows->description; ?></td>-->
                                <td class="text-center"><?php echo $rows->rq_licenses; ?></td>
                                <td class="text-center"><?php echo $rows->datetime; ?></td>
                                <td class="actions">
                                    <a href="javascript:void(0)" class="btn btn-xs btn-default" onclick="editFn('clientRequest', 'view', '<?php echo $rows->id ?>', 'menuCategory');"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                        <?php endforeach;
                    endif;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Datatables Content -->
</div>
<!-- END Page Content -->
<div id="form-modal-box"></div>