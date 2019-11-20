               
<!-- Page content -->
<div id="page-content">
    <!-- Datatables Header -->
    <ul class="breadcrumb breadcrumb-top">
        <li>
            <a href="<?php echo site_url('pwfpanel');?>">Home</a>
        </li>
        <li>
            <a href="<?php echo site_url('Banner');?>">Banner</a>
        </li>
    </ul>
    <!-- END Datatables Header -->

    <!-- Datatables Content -->
    <div class="block full">
        <div class="block-title">
            <h2><strong>Banner</strong></h2>
            <?php if ($this->ion_auth->is_admin()) {?>
                <h2>
                    <a href="javascript:void(0)" onclick="open_modal('banner')" class="btn btn-sm btn-primary"><i class="gi gi-circle_plus"></i> Banner</a>
                </h2>
            <?php }?>
        </div>
        <div class="table-responsive">
            <table id="common_datatable_cms" class="table table-vcenter table-condensed table-bordered">
                <thead>
                    <tr>
                        <th><?php echo lang('serial_no'); ?></th>
                        <th><?php echo lang('image'); ?></th>
                        <th><?php echo lang('status'); ?></th>
                        <th><?php echo lang('action'); ?></th>
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
                        <td><?php echo $rowCount; ?></td>            
                        <td><img width="100" src="<?php if (!empty($rows->image)) {
                        echo base_Url() ?>uploads/banner/<?php echo $rows->image;
                        } else {
                        echo base_url() . DEFAULT_NO_IMG_PATH;
                        } ?>" /></td>

                        <td><?php if($rows->status == 1) echo '<p class="text-success">'.lang('active').'</p>'; else echo '<p  class="text-danger">'.lang('deactive').'</p>';?></td>
                        <td class="actions">
                            <a href="javascript:void(0)" class="btn btn-xs btn-default" onclick="editFn('<?php echo 'banner'; ?>', 'banner_edit', '<?php echo encoding($rows->id) ?>');"><i class="fa fa-pencil"></i></a>
                            <?php if($rows->status == 1) {?>
                            <a href="javascript:void(0)" class="btn btn-xs btn-success" onclick="commonStatusFn('<?php echo 'banner';?>','id','<?php echo encoding($rows->id);?>','<?php echo $rows->status;?>')" title="Inactive Now"><i class="fa fa-check"></i></a>
                            <?php } else { ?>
                            <a href="javascript:void(0)" class="btn btn-xs btn-danger" onclick="commonStatusFn('<?php echo 'banner';?>','id','<?php echo encoding($rows->id); ?>','<?php echo $rows->status;?>')" title="Active Now"><i class="fa fa-times"></i></a>
                            <?php } ?>
                            <a href="javascript:void(0)" onclick="deleteFn('<?php echo 'banner'; ?>', 'id', '<?php echo encoding($rows->id); ?>', 'banner')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>

                        </td>
                    </tr>
                        <?php endforeach;
                        endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Datatables Content -->
</div>
<!-- END Page Content -->
<div id="form-modal-box"></div>
