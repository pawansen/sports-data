<style>
    .modal-footer .btn + .btn {
    margin-bottom: 5px !important;
    margin-left: 5px;
}
</style>
<div id="commonModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" role="form" id="addFormAjax" method="post" action="<?php echo base_url('faq/faq_add') ?>" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"><?php echo (isset($title)) ? ucwords($title) : "" ?></h4>
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
                                 <label class="col-md-3 control-label">Category</label>
                                    <div class="col-md-9">
                                         <select class="form-control" name="category_id" id="category_id">
                                            <option value="">Select Category</option>
                                            <?php foreach($category as $cat){?>
                                                <option value="<?php echo $cat->id;?>"><?php echo $cat->category_name;?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                   
                                </div>
                            </div>
                            
                            
                             <div class="col-md-12" >
                                <div class="form-group">
                                 <label class="col-md-3 control-label">Question</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="question" id="question"/>
                                    </div>
                                    
                                </div>
                            </div>

                             <div class="col-md-12" >
                                <div class="form-group">
                                 <label class="col-md-3 control-label">Answer</label>
                                    <div class="col-md-9">
                                        <textarea  type="text" class="form-control summernote" name="answer" id="answer"></textarea>
                                    </div>
                                    
                                </div>
                            </div>

                             
                           
                          

                            <div class="space-22"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo lang('close_btn');?></button>
                    <button type="submit" id="submit" class="<?php echo THEME_BUTTON;?>" ><?php echo lang('submit_btn');?></button>
                </div>
            </form>
        </div> <!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<script>
$('.summernote').summernote({
                    height: 200,                 // set editor height

                    minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor

                    focus: true                 // set focus to editable area after initializing summernote
                });
</script>