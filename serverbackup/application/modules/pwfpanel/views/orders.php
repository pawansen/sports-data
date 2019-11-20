               
<div class="wrapper wrapper-content">
    <h3><?php echo getConfig('site_name'); ?> Orders</h3>
    <?php if ($this->ion_auth->is_admin() || $this->ion_auth->is_subAdmin()) { ?>               
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content">

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
                            <div class="col-lg-12" style="overflow-x: auto">

                                <table class="table table-bordered table-responsive" id="common_datatable_orders">
                                    <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th><?php echo lang('serial_no'); ?></th>
                                            <th>Order Id</th>
                                            <th>User</th>
                                            <th>Zip Code</th>
                                            <th>Total Amount</th>
                                            <th>Order date</th>
                                            <th>Shipping date</th>
                                            <th>Produced date / Status</th>
                                            <th>Packed date / Status</th>
                                            <th>Dispatched date / Status</th>
                                            <th>Delivered date / Status</th>
                                            <th>Payment Type</th>
                                            <th>Payment Status</th>
                                            <th>Order Status</th>

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
                                                    <td class="actions">
                                                        <a href="javascript:void(0)" class="on-default edit-row" onclick="viewFn('pwfpanel', 'viewOrder', '<?php echo encoding($rows->id); ?>');"><img width="20" src="<?php echo base_url() . VIEW_ICON; ?>" /></a>
                                                        <a href="javascript:void(0)" class="btn btn-xs btn-default" onclick="editFn('pwfpanel', 'editOrder', '<?php echo encoding($rows->id); ?>');"><i class="fa fa-pencil"></i></a>
                                                    </td>
                                                    <td><?php echo $rowCount; ?></td>        
                                                    <td><?php echo $rows->order_id; ?></td>
                                                    <td><?php echo $rows->first_name . ' ' . $rows->last_name . ' (' . $rows->email . ')' . ' (' . $rows->phone . ')'; ?></td>
                                                    <td><?php echo $rows->pin_code; ?></td>
                                                    <td><div class="text-success"><?php echo '<i class="fa fa-inr"></i> ' . $rows->total_amount ?></div></td>
                                                    <td><?php echo date('d-m-Y h:i:s A', strtotime($rows->order_date)) ?></td>
                                                    <td><?php echo (!empty($rows->shipping_date)) ? date('d-m-Y', strtotime($rows->shipping_date)) : ""; ?></td>
                                                    <td><?php echo (!empty($rows->produced_date)) ? date('d-m-Y', strtotime($rows->produced_date)) : ""; ?></td>
                                                    <td><?php echo (!empty($rows->packed_date)) ? date('d-m-Y', strtotime($rows->packed_date)) : ""; ?></td>
                                                    <td><?php echo (!empty($rows->dispatched_date)) ? date('d-m-Y', strtotime($rows->dispatched_date)) : ""; ?></td>
                                                    <td><?php echo (!empty($rows->delivered_date)) ? date('d-m-Y', strtotime($rows->delivered_date)) : ""; ?></td>
                                                    <td><?php
                                                        if ($rows->payment_type == 'COD') {
                                                            echo '<p class="text-info">Cash On Delivery</div>';
                                                        } else {
                                                            echo '<p class="text-success">Cash</div>';
                                                        }
                                                        ?></td>
                                                    <td><?php
                                                        if ($rows->payment_status == 1) {
                                                            echo '<p class="text-success">Completed</p>';
                                                        } else {
                                                            echo '<p  class="text-danger">Pending</p>';
                                                        }
                                                        ?></td>
                                                    <td><?php
                                                        if ($rows->transact_status == 0) {
                                                            echo '<p class="text-warning">Pending</p>';
                                                        } else if ($rows->transact_status == 1) {
                                                            echo '<p  class="text-info">Produced</p>';
                                                        } else if ($rows->transact_status == 2) {
                                                            echo '<p  class="text-info">Packed</p>';
                                                        } else if ($rows->transact_status == 3) {
                                                            echo '<p  class="text-info">Dispatched</p>';
                                                        } else if ($rows->transact_status == 4) {
                                                            echo '<p  class="text-success">Delivered</p>';
                                                        } else if ($rows->transact_status == 5) {
                                                            echo '<p  class="text-danger">Cancelled</p>';
                                                        } else {
                                                            echo '<p  class="text-danger">Pending</p>';
                                                        }
                                                        ?></td>

                                                </tr>
                                                <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div id="form-modal-box"></div>
    <?php } ?>
</div>


