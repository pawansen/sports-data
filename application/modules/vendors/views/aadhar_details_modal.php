<style>
    .modal-footer .btn + .btn {
        margin-bottom: 5px !important;
        margin-left: 5px;
    }
</style>
<div id="aadharModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Aadhar Card Details</h4>
            </div>
            <div class="modal-body"> 
                <div class="loaders">
                    <img src="<?php echo base_url() . 'backend_asset/images/Preloader_2.gif'; ?>" class="loaders-img" class="img-responsive">
                </div>
                <div id="msg"></div>
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-12" >
                            <table class="table table-bordered table-responsive" id="common_datatable_users_team">
                                <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Aadhar Number</th>
                                        <th>Date Of Birth</th>
                                        <th>State</th>
                                        <th>Aadhar Card Front</th>
                                         <th>Aadhar Card Back</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($aadhar) && !empty($aadhar)):
                                        $rowCount = 0;
                                        foreach ($aadhar as $rows):
                                            $rowCount++;
                                            ?>
                                            <tr>       
                                               <td><?php echo $rows->full_name; ?></td>
                                                <td><?php echo $rows->aadhar_number; ?></td>
                                                <td><?php echo $rows->date_of_birth; ?></td>
                                                <td><?php echo $rows->name; ?></td>
                                                <td><?php echo (!empty($rows->aadhar_file)) ? "<img class='img-responsive' width='350px' src='".base_url().$rows->aadhar_file."' />" : ""; ?></td>
                                                 <td><?php echo (!empty($rows->aadhar_file_back_image)) ? "<img class='img-responsive' width='350px' src='".base_url().$rows->aadhar_file_back_image."' />" : ""; ?></td>
                                               <!--  <td><?php echo ($rows->verification_status == 1) ? "<a class='btn btn-danger btn-sm' title='Click here to verified now' onclick='aadharCardStatus(".$rows->user_id.",1)'>Pending</a>" : "<a class='btn btn-success btn-sm' title='Click here to inactive now' onclick='aadharCardStatus(".$rows->user_id.",2)'><i class='fa fa-check'></i> Verified</a>"; ?></td> -->
                                               
                                                 <td><?php 
                                                if($rows->verification_status == 3){
                                                 echo "<a class='btn btn-info btn-sm' >Aadhar Card Cancelled</a> 
                                                     ";
                                                }else{
                                                    echo ($rows->verification_status == 1) ? "<a class='btn btn-danger btn-sm' title='Click here to verified now' onclick='aadharCardStatus(".$rows->user_id.",1)'>Pending</a>
                                                     <a class='btn btn-danger btn-sm' title='Click here to Cancel' onclick='aadharCardStatus(".$rows->user_id.",3)' >
                                                     <i class='fa fa-close'></i> Cancel</a>" : 
                                                     "<a class='btn btn-success btn-sm' title='Click here to inactive now' onclick='aadharCardStatus(".$rows->user_id.",2)'><i class='fa fa-check'></i> Verified</a> 
                                                     ";
                                                 }
                                                 ?></td>
                                            </tr>
                                        <?php endforeach;
                                    endif;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="space-22"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo lang('close_btn'); ?></button>
            </div>
        </div> <!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


