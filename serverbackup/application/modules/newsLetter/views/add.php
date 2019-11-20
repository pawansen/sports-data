
<!--  <div id="commonModal" class="modal fade" role="dialog"> -->
 <div id="commonModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal" role="form" id="addFormAjax" method="post" action="<?php echo base_url('newsLetter/news_add') ?>" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close button_close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"><?php echo (isset($title)) ? ucwords($title) : "" ?></h4>
                </div>
                <div class="modal-body"> 
                    <!-- <div class="loaders">
                        <img src="<?php //echo base_url().'backend_asset/images/Preloader_2.gif';?>" class="loaders-img" class="img-responsive">
                    </div> -->
                    <div class="alert alert-danger" id="error-box" style="display: none"></div>
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12" >
                             <div class="form-group">
                               <label class="col-md-3 control-label">Title hjhj</label>
                                  <div class="col-md-9">
                                       <input type="text" name="title" class="form-control">
                                  </div>
                                 
                              </div>
                            </div>
                            
                            
                             <div class="col-md-12" >
                                <div class="form-group">
                                 <label class="col-md-3 control-label">Message</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control ckeditor" name="description"></textarea>
                                    </div>
                                     <span class="help-block m-b-none col-md-offset-3">
                                </div>
                            </div>
                            <div class="space-22"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="submit" class="btn btn-sm btn-primary" >Save</button>
                </div>
            </form>
        </div> <!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<script>