<div id="commonModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" role="form" id="addFormAjax" method="post" action="<?php echo base_url('pwfpanel/order_update') ?>" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Edit Order</h4>
                </div>
                <div class="modal-body">
                    <div class="loaders">
                        <img src="<?php echo base_url() . 'backend_asset/images/Preloader_2.gif'; ?>" class="loaders-img" class="img-responsive">
                    </div>
                    <div class="alert alert-danger" id="error-box" style="display: none"></div>
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Shipping Date</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="shipping_date" id="shipping_date" value="<?php
                                        if ($results->shipping_date != '') {
                                            echo date('Y-m-d', strtotime($results->shipping_date));
                                        }
                                        ?>"/>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Order Status</label>
                                    <div class="col-md-9">
                                        <select class="" name="transact_status" id="transact_status" style="width:100%;" placeholder="Select Status" onchange="getStatus(this)">
                                            <option value="">Select Status</option>
                                            <option value="0" <?php echo ($results->transact_status == 0) ? "selected" : ""; ?>>Pending</option>
                                            <option value="1" <?php echo ($results->transact_status == 1) ? "selected" : ""; ?>>Produced</option>
                                            <option value="2" <?php echo ($results->transact_status == 2) ? "selected" : ""; ?>>Packed</option>
                                            <option value="3" <?php echo ($results->transact_status == 3) ? "selected" : ""; ?>>Dispatched</option>
                                            <option value="4" <?php echo ($results->transact_status == 4) ? "selected" : ""; ?>>Delivered</option>
                                            <option value="5" <?php echo ($results->transact_status == 5) ? "selected" : ""; ?>>Cancelled</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <?php $dates = "";
                                    if($results->transact_status == 1){
                                        $dates = date('Y-m-d', strtotime($results->produced_date));
                                    }else if($results->transact_status == 2){
                                         $dates = date('Y-m-d', strtotime($results->packed_date));
                                    }else if($results->transact_status == 3){
                                         $dates = date('Y-m-d', strtotime($results->dispatched_date));
                                    }else if($results->transact_status == 4){
                                         $dates = date('Y-m-d', strtotime($results->delivered_date));
                                    }
?>
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><span id='status_name'></span> Date</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="status_date" id="status_date" value="<?php echo (!empty($dates)) ? $dates : ""; ?>"/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Payment Status</label>
                                    <div class="col-md-9">
                                        <select class="" name="payment_status" id="payment_status" style="width:100%;" placeholder="Select Status">
                                            <option value="">Select Status</option>
                                            <option value="0" <?php echo ($results->payment_status == 0) ? "selected" : ""; ?>>Pending</option>
                                            <option value="1" <?php echo ($results->payment_status == 1) ? "selected" : ""; ?>>Complete</option>
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <input type="hidden" name="id" value="<?php echo $results->id; ?>" />
                            <div class="space-22"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo lang('close_btn'); ?></button>
                    <button type="submit"  class="<?php echo THEME_BUTTON; ?>" id="submit"><?php echo lang('update_btn'); ?></button>
                </div>
            </form>
        </div> <!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<script type="text/javascript">
    $('#shipping_date').datepicker({
        startView: 3,
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        //endDate: 'today',
        format: 'yyyy-mm-dd',
    });
    $('#status_date').datepicker({
        startView: 3,
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        //endDate: 'today',
        format: 'yyyy-mm-dd',
    });
</script>