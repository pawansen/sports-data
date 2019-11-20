<style>
    .modal-footer .btn + .btn {
    margin-bottom: 5px !important;
    margin-left: 5px;
}
</style>
<div id="commonModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
          
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h2 class="modal-title"><i class="fa fa-pencil"></i> <?php echo (isset($title)) ? ucwords($title) : "" ?></h2>
                </div>
            <?php //print_r($results);?>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Company Name</label>
                                    <div class="col-md-8">
                                        <p><?php echo $results->company_name;?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Vendor name</label>
                                    <div class="col-md-8">
                                        <p><?php echo $results->first_name." ".$results->last_name;?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Client Name</label>
                                    <div class="col-md-8">
                                        <p><?php echo $results->c_first_name." ".$results->c_last_name;?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Category</label>
                                    <div class="col-md-8">
                                        <p><?php $category = commonGetHelper(array('select'=>"GROUP_CONCAT(category_name SEPARATOR ',') as category_name",'table'=>"item_category","where_in" => array('id'=>explode(",",$results->rq_software_categories))));
                                                                            echo $category[0]->category_name?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Expected go live</label>
                                    <div class="col-md-8">
                                        <p><?php echo $results->rq_expected_live;?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Expected contract term</label>
                                    <div class="col-md-8">
                                        <p><?php echo $results->rq_solution_offering;?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Description</label>
                                    <div class="col-md-8">
                                        <p><?php echo $results->description;?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-4 control-label">No. of licenses</label>
                                    <div class="col-md-8">
                                        <p><?php echo $results->rq_licenses;?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                </div>
        </div> <!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
