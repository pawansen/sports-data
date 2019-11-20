<style>
    .modal-footer .btn + .btn {
    margin-bottom: 5px !important;
    margin-left: 5px;
}
</style>
<div id="commonModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" role="form" id="addFormAjax" method="post" action="<?php echo base_url('menuCategory/menu_category_update') ?>" enctype="multipart/form-data">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h2 class="modal-title"><i class="fa fa-pencil"></i> <?php echo (isset($title)) ? ucwords($title) : "" ?></h2>
                    </div>
                <div class="modal-body">
                    <div class="loaders">
                        <img src="<?php echo base_url().'backend_asset/images/Preloader_2.gif';?>" class="loaders-img" class="img-responsive">
                    </div>
                    <div class="alert alert-danger" id="error-box" style="display: none"></div>
                    <div class="form-body">
                        <div class="row">

                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Category Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="category_name" id="category_name" value="<?php echo $results->category_name;?>" />
                                    </div>
                                     <span class="help-block m-b-none col-md-offset-3"><i class="fa fa-arrow-circle-o-up"></i> Category Name</span>
                                </div>
                            </div>

                             <input type="hidden" name="id" value="<?php echo $results->id;?>" />
                           
                            <div class="space-22"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="submit" class="btn btn-sm btn-primary">Save Changes</button>
                </div>
            </form>
        </div> <!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>