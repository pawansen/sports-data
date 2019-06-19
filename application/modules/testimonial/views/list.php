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
                            <a href="<?php echo site_url('testimonial');?>">Testimonial</a>
                        </li>
                        </ul>
                        <!-- END Datatables Header -->

                        <!-- Datatables Content -->
                        <div class="block full">
                            <div class="block-title">
                            
                            <h2><strong>Testimonial</strong> Panel</h2>
                           
                              
                        <?php if ($this->ion_auth->is_admin()) {?>

                            <h2><a href="javascript:void(0)"  onclick="open_modal('testimonial')" class="btn btn-sm btn-primary">
                            <i class="gi gi-circle_plus"></i> Testimonial
                            </a></h2>
                            
                       
                        <?php }?>
            
                            </div>
                           

                            <div class="table-responsive">
                                <table id="common_datatable_menucat" class="table table-vcenter table-condensed table-bordered">
                                    <thead>
                                    <tr>
                                        <th><?php echo lang('serial_no'); ?></th>
                                        <th>User Name</th>
                                        <th>Designation</th>
                                        <th>Description</th>
                                        <th>User Image</th>
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
                                                <td><?php echo $rows->user_name; ?></td>
                                                 <td><?php echo $rows->member_since; ?></td>

                                                  <td style="width:25%;"><?php
                                                    if (strlen($rows->description) > 1000) {
                                                        $content = $rows->description;
                                                        echo mb_substr($rows->description, 0, 1000, 'UTF-8') . '...<br>';
                                                        ?>
                                                        <a style="cursor:pointer" onclick="show_message('<?php echo base64_encode($content); ?>')"><?php echo lang('view'); ?></a>
                                                        <?php
                                                    } else if (strlen($rows->description) > 0) {
                                                        echo $rows->description;
                                                    }
                                                    ?></td>
                                               
                                                <td><img width="100" src="<?php if (!empty($rows->image)) {
                                                echo base_Url()."uploads/users/" ?><?php echo $rows->image;
                                            } else {
                                                echo base_url() . DEFAULT_NO_IMG_PATH;
                                            } ?>" /></td>

                                             <td><?php if($rows->status == 1) echo '<p class="text-success">'.lang('active').'</p>'; else echo '<p  class="text-danger">'.lang('deactive').'</p>';?></td>

                                                <td class="actions">
                                                    <a href="javascript:void(0)" class="btn btn-xs btn-default" onclick="editFn('<?php echo 'testimonial'; ?>', 'testimonial_edit', '<?php echo encoding($rows->id) ?>');"><i class="fa fa-pencil"></i></a>
                                                <?php if($rows->status == 1) {?>
                                                    <a href="javascript:void(0)" class="btn btn-xs btn-success" onclick="commonStatusFn('<?php echo 'testimonial';?>','id','<?php echo encoding($rows->id);?>','<?php echo $rows->status;?>')" title="Inactive Now"><i class="fa fa-check"></i></a>
                                                <?php } else { ?>
                                                    <a href="javascript:void(0)" class="btn btn-xs btn-danger" onclick="commonStatusFn('<?php echo 'testimonial';?>','id','<?php echo encoding($rows->id); ?>','<?php echo $rows->status;?>')" title="Active Now"><i class="fa fa-times"></i></a>
                                                <?php } ?>
                                                    <a href="javascript:void(0)" onclick="deleteFn('<?php echo 'testimonial'; ?>', 'id', '<?php echo encoding($rows->id); ?>', 'testimonial')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>

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
                   
    </div>
                    