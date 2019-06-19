    <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2><?php echo (isset($headline)) ? ucwords($headline) : ""?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('pwfpanel');?>"><?php echo lang('home');?></a>
            </li>
            <li>
                <a href="<?php echo site_url('vendors');?>">Sales Representative</a>
            </li>
        </ol>
    </div>
    <div class="col-lg-4 text-right">
     <div class="ibox-title">
                    <?php if ($this->ion_auth->is_admin()) {?>
                    <div class="btn-group " href="#">
                        <a href="javascript:void(0)"  onclick="open_modal('vendors')" class="<?php echo THEME_BUTTON;?>">
                          <img width="18" src="<?php echo base_url().CRICKET_ICON;?>" />  Add Sales Representative
                        </a>
                    </div>
                    <?php }?>
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
                            if(!empty($message)):?><div class="alert alert-success">
                                <?php echo $message;?></div><?php endif; ?>
                       <?php $error = $this->session->flashdata('error');
                            if(!empty($error)):?><div class="alert alert-danger">
                                <?php echo $error;?></div><?php endif; ?>
                     <div id="message"></div>
                    <div class="col-lg-12" style="overflow-x: auto">
                        <?php if ($this->ion_auth->is_admin()) {?>
                          <table class="table table-bordered table-responsive" id="common_datatable_users">
                        <?php }else{?>
                           <table class="table table-bordered table-responsive" id="common_datatable_vendor"> 
                        <?php }?>
                        <thead>
                            <tr>
                                <th><?php echo lang('serial_no');?></th>
                                <th><?php echo "Invoice ID";?></th>
                                <th><?php echo "Amount";?></th>
                                <th><?php echo "Message";?></th>
                                <th><?php echo "Invoice Date";?></th>
                                 <th><?php echo "Status";?></th>
                                <th style="width: 28%"><?php echo lang('action');?></th>
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
                            <td><?php echo $rows->txnid;?></td>
                            <td><?php echo $rows->amount;?></td>
                            <td><?php echo $rows->pay_response;?></td>
                            <td><?php echo $rows->invoice_date;?></td>
                            <td><?php echo $rows->status;?></td>
                            <td class="actions">
                                <?php if($rows->status == "PENDING"){?>
                            <a href="<?php echo base_url().'vendors/paymentVerify/'. $rows->id.'/'.$rows->user_id.'/'.$rows->amount.'/'.$rows->sales_user_id; ?>" class="btn btn-success">Click here to payment verify</a>
                                <?php }?>
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