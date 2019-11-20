<style>
    #message_div{
        background-color: #ffffff;
        border: 1px solid;
        box-shadow: 10px 10px 5px #888888;
        display: none;
        height: auto;
        left: 36%;
        position: fixed;
        top: 20%;
        width: 40%;
        z-index: 1;
    }
    #close_button{
        right:-15px;
        top:-15px;
        cursor: pointer;
        position: absolute;
    }
    #close_button img{
        width:30px;
        height:30px;
    }    
    #message_container{
        height: 450px;
        overflow-y: scroll;
        padding: 20px;
        text-align: justify;
        width: 99%;
    }
</style>   
                   
    <!-- Page content -->
    <div id="page-content">
        <!-- Datatables Header -->
        <ul class="breadcrumb breadcrumb-top">
        <li>
            <a href="<?php echo site_url('pwfpanel');?>">Home</a>
        </li>
        <li>
            <a href="<?php echo site_url('emailTemplate');?>">Email Templates</a>
        </li>
        </ul>
        <!-- END Datatables Header -->

        <!-- Datatables Content -->
        <div class="block full">
            <div class="block-title">
            
            <h2><strong>Email Template</strong> Panel</h2>
           
              
        <?php if ($this->ion_auth->is_admin()) {?>

            <h2><a href="javascript:void(0)" onclick="open_modal('emailTemplate')" class="btn btn-sm btn-primary">
            <i class="gi gi-circle_plus"></i> Email Template
            </a></h2>
            
       
        <?php }?>

            </div>
            <div class="table-responsive">
                <table id="common_datatable_cms" class="table table-vcenter table-condensed table-bordered">
                    <thead>
                        <tr>                                            
                            <th><?php echo lang('serial_no'); ?></th>
                            <th>Email Type</th>
                            <th>Title</th>
<!--                            <th><?php echo lang('description'); ?></th>
                            <th><?php echo lang('image'); ?></th>-->
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
                                <td><?php echo $rows->email_type; ?></td>
                                <td><?php echo $rows->title; ?></td>
<!--                                <td style="width:25%;"><?php
                                    if (strlen($rows->description) > 400) {
                                        $content = $rows->description;
                                        echo mb_substr($rows->description, 0, 400, 'UTF-8') . '...<br>';
                                        ?>
                                        <a style="cursor:pointer" onclick="show_message('<?php echo base64_encode($content); ?>')"><?php echo lang('view'); ?></a>
                                        <?php
                                    } else if (strlen($rows->description) > 0) {
                                        echo $rows->description;
                                    }
                                    ?></td>
                                <td><img width="100" src="<?php if (!empty($rows->image)) {
                                echo base_Url() ?>uploads/emailTemplate/<?php echo $rows->image;
                            } else {
                                echo base_url() . DEFAULT_NO_IMG_PATH;
                            } ?>" /></td>-->

                                <td class="actions">
                                    <a href="javascript:void(0)" class="btn btn-xs btn-default" onclick="editFn('emailTemplate','template_edit','<?php echo encoding($rows->id) ?>');"><i class="fa fa-pencil"></i></a>
                                    <?php if($rows->is_active == 1) {?>
                                    <a href="javascript:void(0)" class="btn btn-xs btn-success" onclick="editStatusFn('vendor_sale_email_template','id','<?php echo encoding($rows->id);?>','<?php echo $rows->is_active;?>')" title="Inactive Now"><i class="fa fa-check"></i></a>
                                    <?php } else { ?>
                                    <a href="javascript:void(0)" class="btn btn-xs btn-danger" onclick="editStatusFn('vendor_sale_email_template','id','<?php echo encoding($rows->id); ?>','<?php echo $rows->is_active;?>')" title="Active Now"><i class="fa fa-times"></i></a>
                                    <?php } ?>
                                    <a href="javascript:void(0)" onclick="deleteFn('vendor_sale_email_template','id','<?php echo encoding($rows->id); ?>','emailTemplate')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
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
<div id="message_div">
    <span id="close_button"><img src="<?php echo base_url(); ?>backend_asset/images/close.png" onclick="close_message();"></span>
    <div id="message_container"></div>
</div>
                    