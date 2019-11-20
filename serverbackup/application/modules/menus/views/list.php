<div class="wrapper wrapper-content animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <div class="btn-group">
                        <a href="javascript:void(0)"  onclick="open_modal('menus')" class="btn btn-primary">
                            Add Item
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <?php $message = $this->session->flashdata('success');
                        if (!empty($message)):
                            ?><div class="alert alert-success">
                            <?php echo $message; ?></div><?php endif; ?>
                            <?php $error = $this->session->flashdata('error');
                            if (!empty($error)):
                                ?><div class="alert alert-danger">
    <?php echo $error; ?></div><?php endif; ?>
                        <div id="message"></div>
                        <div class="col-lg-12" style="overflow-x: auto">
                            <table class="table table-bordered table-responsive" id="common_datatable_menu">
                                <thead>
                                    <tr>
                                        <th>Sr. No</th>
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>Item Name</th>
                                        <th>Item Code</th>
                                        <th>Original Price</th>
                                        <th>Discount Available</th>
                                        <th>Discount Price</th>
                                        <th>Featured</th>
                                        <th><?php echo lang('image'); ?></th>
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
                                                <td class="text-success"><?php echo ucwords($rows->category_name); ?></td>
                                                <td class="text-danger"><?php echo ucwords($rows->subcategory_name); ?></td>
                                                <td><?php echo $rows->item_name; ?></td>
                                                <td><?php echo $rows->item_code; ?></td>
                                                <td><?php echo $rows->price ?></td>
                                                <td> <?php if ($rows->discount_available == 1) {
                                                echo "YES";
                                            } else {
                                                echo"NO";
                                            } ?></td>
                                                <td><?php echo $rows->discount ?></td>
                                                <td> <?php echo $rows->is_featured; ?></td>
                                                <td><img width="100" src="<?php if (!empty($rows->image)) {
                                                echo base_Url() ?><?php echo $rows->image;
                                            } else {
                                                echo base_url() . DEFAULT_NO_IMG_PATH;
                                            } ?>" /></td>
                                                <td class="actions">
                                                    <a href="javascript:void(0)" class="btn btn-xs btn-default" onclick="editFn('menus', 'menu_edit', '<?php echo encoding($rows->id) ?>');"><i class="fa fa-pencil"></i></a>
                                                    <a href="javascript:void(0)" onclick="deleteFn('item', 'id', '<?php echo encoding($rows->id); ?>', 'menus')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
    <?php endforeach;
endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="form-modal-box"></div>
            </div>
        </div>
    </div>
