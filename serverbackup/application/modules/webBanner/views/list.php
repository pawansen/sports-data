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


<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2><?php echo (isset($headline)) ? ucwords($headline) : "" ?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('pwfpanel'); ?>"><?php echo lang('home'); ?></a>
            </li>
            <li>
                <a href="<?php echo site_url('webBanner'); ?>">Web Banner</a>
            </li>
        </ol>
    </div>
    <div class="col-lg-4 text-right">

      <div class="ibox-title">
                    <div class="btn-group " href="#">
                        <a href="javascript:void(0)"  onclick="open_modal('webBanner')" class="<?php echo THEME_BUTTON; ?>">
                            Web Banner
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>

    </div>
</div>
<div class="wrapper wrapper-content animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
              
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
                            <table class="table table-bordered table-responsive" id="common_datatable_banner">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('serial_no'); ?></th>
                                        <th>Banner Name</th>
                                        <th>Banner Type</th>
                                        <th>Url</th>
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
                                                <td><?php echo $rows->banner_name; ?></td>
                                                <td><?php echo $rows->banner_type; ?></td>
                                                 <td><?php echo $rows->url; ?></td>
                                               
                                                <td><img width="100" src="<?php if (!empty($rows->image)) {
                                                echo base_Url() ?>uploads/banner/<?php echo $rows->image;
                                            } else {
                                                echo base_url() . DEFAULT_NO_IMG_PATH;
                                            } ?>" /></td>

                                             <td><?php if($rows->status == 1) echo '<p class="text-success">'.lang('active').'</p>'; else echo '<p  class="text-danger">'.lang('deactive').'</p>';?></td>

                                                <td class="actions">
                                                    <a href="javascript:void(0)" class="btn btn-xs btn-default" onclick="editFn('<?php echo 'webBanner'; ?>', 'banner_edit', '<?php echo encoding($rows->id) ?>');"><i class="fa fa-pencil"></i></a>
                                                     <?php if($rows->status == 1) {?>
                                                <a href="javascript:void(0)" class="btn btn-xs btn-default" onclick="commonStatusFn('<?php echo 'banner';?>','id','<?php echo encoding($rows->id);?>','<?php echo $rows->status;?>')" title="Inactive Now"><i class="fa fa-check"></i></a>
                                                <?php } else { ?>
                                                <a href="javascript:void(0)" class="on-default edit-row text-danger" onclick="commonStatusFn('<?php echo 'banner';?>','id','<?php echo encoding($rows->id); ?>','<?php echo $rows->status;?>')" title="Active Now"><i class="fa fa-times"></i></a>
                                                <?php } ?>
                                                    <a href="javascript:void(0)" onclick="deleteFn('<?php echo 'banner'; ?>', 'id', '<?php echo encoding($rows->id); ?>', 'webBanner')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>

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
    <div id="message_div">
        <span id="close_button"><img src="<?php echo base_url(); ?>backend_asset/images/close.png" onclick="close_message();"></span>
        <div id="message_container"></div>
    </div>