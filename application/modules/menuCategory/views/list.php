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
                            <a href="<?php echo site_url('menuCategory');?>">Software Category</a>
                        </li>
                        </ul>
                        <!-- END Datatables Header -->

                        <!-- Datatables Content -->
                        <div class="block full">
                            <div class="block-title">
                            
                            <h2><strong>Software Category</strong> Panel</h2>
                           
                              
                        <?php if ($this->ion_auth->is_admin()) {?>

                            <h2><a href="javascript:void(0)"  onclick="open_modal('menuCategory')" class="btn btn-sm btn-primary">
                            <i class="gi gi-circle_plus"></i> Software Category
                            </a></h2>
                            
                       
                        <?php }?>
            
                            </div>
                           

                            <div class="table-responsive">
                                <table id="common_datatable_menucat" class="table table-vcenter table-condensed table-bordered">
                                    <thead>
                                        <tr>
                                        <th>Sr. No</th>
                                        <th>Software Category Name</th>
                                        <!-- <th>Description</th>
                                        <th><?php //echo lang('image');?></th> -->
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
                                            
                                            <td class="actions">
                                            <a href="javascript:void(0)" class="btn btn-xs btn-default" onclick="editFn('menuCategory','menu_category_edit','<?php echo encoding($rows->id)?>','menuCategory');"><i class="fa fa-pencil"></i></a>
                                            <?php if($rows->is_active == 1) {?>
                                            <a href="javascript:void(0)" class="btn btn-xs btn-success" onclick="editStatusFn('vendor_sale_item_category','id','<?php echo encoding($rows->id);?>','<?php echo $rows->is_active;?>')" title="Inactive Now"><i class="fa fa-check"></i></a>
                                            <?php } else { ?>
                                            <a href="javascript:void(0)" class="btn btn-xs btn-danger" onclick="editStatusFn('vendor_sale_item_category','id','<?php echo encoding($rows->id); ?>','<?php echo $rows->is_active;?>')" title="Active Now"><i class="fa fa-times"></i></a>
                                            <?php } ?>
                                            <a href="javascript:void(0)" onclick="deleteFn('item_category','id','<?php echo encoding($rows->id); ?>','menuCategory')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                            </tr>
                                            <?php endforeach; endif;?>
                                </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END Datatables Content -->
                    </div>
                    <!-- END Page Content -->
                    <div id="form-modal-box"></div>
                   
    </div>
                    