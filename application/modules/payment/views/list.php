<style>
.select2-container, .select2-drop, .select2-search, .select2-search input {
    width: 290px !important;
}
</style>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo (isset($headline)) ? ucwords($headline) : "" ?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('pwfpanel'); ?>"><?php echo lang('home'); ?></a>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-content">
                    <div class="row">
                        <?php
                        $message = $this->session->flashdata('success');
                        if (!empty($message)):
                            ?><div class="alert alert-success">
                        <?php echo $message; ?></div><?php endif; ?>
                        <?php
                        $error = $this->session->flashdata('error');
                        if (!empty($error)):
                            ?><div class="alert alert-danger">
                        <?php echo $error; ?></div><?php endif; ?>
                        <div id="message"></div>
                        <div class="col-sm-12">     
                                <div class="table-responsive">
                                    <table id="payment" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th style="width:10%">S. No.</th>
                                                <th>User</th>
                                                <th>User Email</th>
                                                <th>Invoice Id</th>
                                                <th>Amount</th>
                                                <th>Payment By</th>
                                                <th>Invoice Date</th>
                                                <th><?php echo "Status";?></th>
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
                                                <td><?php echo strtoupper($rows->first_name.' '.$rows->last_name); ?></td>
                                                <td><?php echo $rows->email; ?></td>
                                                <td><?php echo $rows->txnid; ?></td>
                                                <td><?php echo $rows->amount; ?></td>
                                                <td><?php echo $rows->payment_type; ?></td>
                                                <td><?php echo $rows->invoice_date; ?></td>
                                                 <td><?php echo $rows->status;?></td>
                                                <td class="actions">
                                <?php if($rows->status == "PENDING" && $rows->payment_type == "CASH"){?>
                            <a href="<?php echo base_url().'payment/paymentVerify/'. $rows->id.'/'.$rows->user_id.'/'.$rows->amount.'/'.$rows->sales_user_id; ?>" class="btn btn-success">Click here to payment verify</a>
                                <?php }?>
                            </td>
                                               
                                            </tr>
    <?php endforeach;
endif; ?>
                                </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>