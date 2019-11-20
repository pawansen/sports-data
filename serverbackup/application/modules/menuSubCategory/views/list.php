<div class="wrapper wrapper-content animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <div class="btn-group " href="#">
                        <a href="javascript:void(0)"  onclick="open_modal('menuSubCategory')" class="btn btn-primary">
                            Add Item Sub Category
                        <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                 <div class="row">
                      <?php $message = $this->session->flashdata('success');
                            if(!empty($message)):?><div class="alert alert-success">
                                <?php echo $message;?></div><?php endif; ?>
                       <?php $error = $this->session->flashdata('error');
                            if(!empty($error)):?><div class="alert alert-danger">
                                <?php echo $error;?></div><?php endif; ?>
                     <div id="message"></div>
                    <div class="col-lg-12" style="overflow-x: auto">
                    <table class="table table-bordered table-responsive" id="common_datatable_menucat">
                        <thead>
                            <tr>
                                <th>Sr. No</th>
                                <th>Category Name</th>
                                <th>Sub Category Name</th>
                                <th>Description</th>
                                <th><?php echo lang('image');?></th>
                                <th><?php echo lang('action');?></th>
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
                            <td><?php echo $rows->category_name?></td>
                            <td><?php echo $rows->subcategory_name?></td>
                            <td><?php echo $rows->description?></td>
                           <td><img width="100" src="<?php if(!empty($rows->image)){echo base_Url()?><?php echo $rows->image;}else{echo base_url().'backend_asset/images/default.jpg';}?>" /></td>
                            <td class="actions">
                             <a href="javascript:void(0)" class="on-default edit-row" onclick="editFn('menuSubCategory','menu_category_edit','<?php echo encoding($rows->id)?>','menuSubCategory');"><img width="20" src="<?php echo base_url().EDIT_ICON;?>" /></a>
                            <a href="javascript:void(0)" onclick="deleteFn('item_subcategory','id','<?php echo encoding($rows->id); ?>','menuSubCategory','menuSubCategory/deleteSubCategory')" class="on-default edit-row text-danger"><img width="20" src="<?php echo base_url().DELETE_ICON;?>" /></a>
                            </td>
                            </tr>
                            <?php endforeach; endif;?>
                        </tbody>
                    </table>
                  </div>
                </div>
            </div>
                <div id="form-modal-box"></div>
        </div>
    </div>
</div>
