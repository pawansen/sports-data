<style>
    .modal-footer .btn + .btn {
        margin-bottom: 5px !important;
        margin-left: 5px;
    }
</style>
<div id="commonModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Order Details</h4>
            </div>
            <div class="modal-body">
                <div class="loaders">
                    <img src="<?php echo base_url() . 'backend_asset/images/Preloader_2.gif'; ?>" class="loaders-img" class="img-responsive">
                </div>
                <div class="alert alert-danger" id="error-box" style="display: none"></div>

                <div class="row">
                    <div class="col-md-12" >
                        <div class="form-group">
                            <label class="col-md-5 control-label">Order Id:</label>
                            <div class="col-md-7">
                                <span class="text-success"> <?php echo $order->order_id; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" >
                        <div class="form-group">
                            <label class="col-md-5 control-label">Customer:</label>
                            <div class="col-md-7">
                               <div class="text-info"> <?php echo $order->first_name . ' ' . $order->last_name . ' (' . $order->phone . ')'; ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" >
                        <div class="form-group">
                            <label class="col-md-5 control-label">Order Date:</label>
                            <div class="col-md-7">
                                <?php echo date('d-m-Y H:i:s', strtotime($order->order_date)); ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12" >
                        <div class="form-group">
                            <label class="col-md-5 control-label">Shipping Address:</label>
                            <div class="col-md-7">
                               <b> <?php echo $order->address1.' '.$order->address2.' '.$order->city.' '.$order->pin_code.' '.$order->state_name.' '.$order->country; ?></b>
                            </div>
                        </div>
                    </div>
                   
                   <div class='col-md-12'>   <table class="table table-bordered table-responsive" id="common_datatable_subAdmin">
                        <thead>
                            <tr>
                                <th><?php echo lang('serial_no'); ?></th>
                                <th>Item Code</th>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Sum Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($products) &&!empty($products)):
                            $rowCount = 0;
                            $sum = 0;
                            foreach ($products as $rows):
                            $rowCount++;
                            ?>
                            <tr>
                                <td><?php echo $rowCount; ?></td>
                                 <td><?php echo $rows->item_code; ?></td>
                                <td><?php echo $rows->item_name; ?></td>
                                <td><?php echo '<i class="fa fa-inr"></i> '.$rows->product_price; ?></td>
                                <td><?php echo $rows->product_qty; ?></td>
                                <td><?php echo '<i class="fa fa-inr"></i> '.$rows->total_product_price;  $sum = $sum +  $rows->total_product_price;?></td>
                            </tr>
                            <?php endforeach;endif;?>
                        </tbody>
                    </table></div>
                 
              
                    <div class="col-md-offset-5">
               <div class="col-md-12" >
                        <div class="form-group">
                            <label class="col-md-7 control-label">Total Product Sum:</label>
                            <div class="col-md-5">
                                <?php echo '<i class="fa fa-inr"></i> '.$sum; ?>
                            </div>
                        </div>
                </div>
               <div class="col-md-12" >
                        <div class="form-group">
                            <label class="col-md-7 control-label">Delivery Fee:</label>
                            <div class="col-md-5">
                                <?php echo '<i class="fa fa-inr"></i> '.$order->delivery_fee; ?>
                            </div>
                        </div>
                </div>
               <div class="col-md-12" >
                        <div class="form-group">
                            <label class="col-md-7 control-label">Discount Amount:</label>
                            <div class="col-md-5">
                               <i class="fa fa-inr"></i>  <span class="text-danger">- <?php echo $order->discounted_price; ?></span>
                            </div>
                        </div>
                </div>
               <div class="col-md-12" >
                        <div class="form-group">
                            <label class="col-md-7 control-label">Final Amount:</label>
                            <div class="col-md-5">
                                <span class="text-success">  <?php echo '<i class="fa fa-inr"></i> '.$order->total_amount; ?></span>
                            </div>
                        </div>
                </div>
                  </div>  
            </div>
                  </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo lang('close_btn'); ?></button>
            </div>
        </div> <!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>