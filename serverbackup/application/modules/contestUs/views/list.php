<!-- Page content -->
<div id="page-content">
    <!-- Datatables Header -->
    <ul class="breadcrumb breadcrumb-top">
        <li>
            <a href="<?php echo site_url('pwfpanel'); ?>">Home</a>
        </li>
        <li>
            <a href="<?php echo site_url('contestUs'); ?>">Contact List</a>
        </li>
    </ul>
    <!-- END Datatables Header -->

    <!-- Datatables Content -->
    <div class="block full">
        <div class="block-title">
            <h2><strong>Contact</strong> List</h2>
        </div>
        <div class="table-responsive">
            <table id="common_datatable_users" class="table table-vcenter table-condensed table-bordered">
                <thead>
                    <tr>
                        <th class="text-center"><?php echo lang('serial_no'); ?></th>
                        <th>Full Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Phone</th>
<!--                        <th class="text-center">Subject</th>
                        <th>Message</th>-->
                        <th>Contact Date</th>
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
                                <td class="text-center"><?php echo $rows->full_name; ?></td>
                                <td class="text-center"><?php echo $rows->email; ?></td>
                                <td class="text-center"><?php echo $rows->phone; ?></td>
        <!--                                <td class="text-center"><?php echo $rows->subject; ?></td>
                                <td class="text-center"><?php echo $rows->message; ?></td>-->
                                <td class="text-center"><?php echo $rows->created_date; ?></td>
                                <td class="actions">
                                    <a href="javascript:void(0)" class="btn btn-xs btn-default" onclick="editFn('contestUs', 'view', '<?php echo $rows->id ?>', 'menuCategory');"><i class="fa fa-eye"></i></a>
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