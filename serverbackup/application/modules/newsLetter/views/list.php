
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
            <a href="<?php echo site_url('newsLetter');?>">Newsletters</a>
        </li>
        </ul>
        <!-- END Datatables Header -->

        <!-- Datatables Content -->
        <div class="block full">
            <div class="block-title">
                <h2><strong>Newsletter</strong> Panel</h2>
            <?php if ($this->ion_auth->is_admin()) {?>
                <h2><a href="<?php echo site_url('newsLetter/open_model');?>" class="btn btn-sm btn-primary">
                <i class="gi gi-circle_plus"></i> Add Newsletter
                </a>
            <?php }?>
                <!-- <form  id="date_sortinng" action="<?php echo base_url('newsLetter/export_newsletter'); ?>" method="post">
                    <input type="submit"  class="btn btn-primary" type="submit" value="Export" name="export" id="export">
                </form> -->
            </h2>
            </div>
            <div class="table-responsive">
                <table id="common_datatable_cms" class="table table-vcenter table-condensed table-bordered">
                    <thead>
                        <tr>
                            <th><?php echo lang('serial_no'); ?></th>
                            <th>Title</th>
                            <!-- <th style="width:500px;">Message</th> -->
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
                                    <td><?php echo $rows->title; ?></td>
                                    <!-- <td><?php //echo $rows->description; ?></td> -->
                                    <td class="actions" align="center">
                                        <!-- <a href="javascript:void(0)" class="btn btn-xs btn-default" onclick="editFn('Newsletter', 'news_edit', '<?php echo encoding($rows->id) ?>');"><i class="fa fa-pencil"></i></a> -->
                                        <?php if($rows->is_active == 1) {?>
                                            <a href="javascript:void(0)" class="btn btn-xs btn-success" onclick="editStatusFn('vendor_sale_newsletter','id','<?php echo encoding($rows->id);?>','<?php echo $rows->is_active;?>')" title="Inactive Now"><i class="fa fa-check"></i></a>
                                        <?php } else { ?>
                                            <a href="javascript:void(0)" class="btn btn-xs btn-danger" onclick="editStatusFn('vendor_sale_newsletter','id','<?php echo encoding($rows->id); ?>','<?php echo $rows->is_active;?>')" title="Active Now"><i class="fa fa-times"></i></a>
                                        <?php } ?>
                                        <a href="javascript:void(0)" onclick="deleteFn('vendor_sale_newsletter', 'id', '<?php echo encoding($rows->id); ?>', 'newsLetter')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a> 

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

<!-- create brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="sendNewsletter">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Send Newsletter</h4>
      </div>

      <form role="form" action="<?php echo base_url('newsLetter/send_news') ?>" method="post" id="createBrandForm">

        <div class="modal-body">
        <div class="row">
          <div class="form-group">
            <div class="col-md-4 text-center">
                <label>To</label>
            </div>
            <div class="col-md-4">
                <input type="radio" id="All" name="userType" value="All" onclick="changeType('All')" checked>All Users
            </div>
            <div class="cols-md-4">
                <input type="radio" id="Selected" name="userType" value="Selected" onclick="changeType('Selected')">Select Users
            </div>
            <div class="cols-md-8">   
                <select name="email[]" id="emailIDs" class="form-control" disabled multiple>
                    <option value="">Select Email-ID</option>
                    <option value="a">Select Email-ID</option>
                    <option value="b">Select Email-ID</option>
                    <option value="c">Select Email-ID</option>
                </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group">
            <div class="col-md-4 text-center">
                <label>Select Newsletter</label>
            </div>
            <div class="col-md-8">
                <select class="form-control" id="NewsletterType" name="NewsletterType">
                  <option value="">Please Select</option>
                </select>
                <!-- <textarea name="description" class="form-control"><?php ?></textarea> -->
            </div>
          </div>
        </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Send</button>
        </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    function changeType(type) {
        if (type == 'All') {
            $('#All').prop('checked', true);
            $('#emailIDs').prop('disabled', true);
        }else if(type == 'Selected'){
            $('#Selected').prop('checked', true);
            $('#emailIDs').prop('disabled', false);
        }
    }
</script>