<style>
    .modal-footer .btn + .btn {
    margin-bottom: 5px !important;
    margin-left: 5px;
}
</style>
<div id="commonModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" role="form" id="addFormAjax" method="post" action="<?php echo base_url('menus/menu_add') ?>" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Item Add</h4>
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
                                        <select class="form-control" name="category" id="menu_category" onchange="getSubCategory(this.value)">
                                            <option value="">Select Category</option>
                                            <?php if(!empty($results)){foreach($results as $result){?>
                                              <option value="<?php echo $result->id;?>"><?php echo $result->category_name;?></option>
                                            <?php }}?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Category</label>
                                    <div class="col-md-9">
                                       <select class="form-control" name="sub_category" id="sub_category">
                                            <option value="">Select Sub Category</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                             <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Item Code</label>
                                    <div class="col-md-9">
                                   <input type="text" class="form-control" name="item_code" id="item_code" placeholder="Item Code"/>
                                    </div>
                                </div>
                            </div>
       
                             <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Item Name</label>
                                    <div class="col-md-9">
                                   <input type="text" class="form-control" name="item_name" id="menu_name_en" placeholder="Item Name"/>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Description</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="description" id="description_en" placeholder="Description"></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Price</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="price" id="price" placeholder="Price"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Minimum Quantity</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="quantity_per_unit" id="quantity_per_unit" placeholder="Minimum Quantity"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Weight Per Unit</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="unit_weight" id="unit_weight" placeholder="Weight should be kg,grams,liters"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Unit Stock</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="unit_in_stock" id="unit_in_stock" placeholder="Unit In Stock"/>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Discount Available</label>
                                    <div class="col-md-9">
                                        <input type="checkbox" name="discount_available" id="discount_available" onclick="isDiscount()" value="1"/>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12 discountPrice" style="display:none">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Discount Price</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="discount" id="discount" placeholder="0"/>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Featured</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="is_featured" id="is_featured">
                                            <option value="NO"> NO </option>
                                            <option value="YES"> YES </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            

                             <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Stock</label>
                                    <div class="col-md-9">
                                     <div class="minus_left custom_chk chk_box">
                                     <div class="checkbox">
                                        <input type="radio" name="stock" id="stock" checked value="INSTOCK"><label class="checkbox-inline">IN STOCK</label>
                                    </div>
                                     <div class="checkbox">
                                       <input type="radio" name="stock" id="stock" value="OUT OF STOCK"><label class="checkbox-inline">OUT OF STOCK</label>
                                     </div> 
                                    </div>  
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo lang('image'); ?></label>
                                    <div class="col-md-9">
                                            <div class="profile_content edit_img">
                                            <div class="file_btn file_btn_logo">
                                              <input type="file"  class="input_img2" id="image" name="image" style="display: inline-block;">
                                              <span class="glyphicon input_img2 logo_btn" style="display: block;">
                                                <div id="show_company_img"></div>
                                                <span class="ceo_logo">
                                                  <img src="<?php echo base_url().'backend_asset/images/default.jpg';?>">
                                                </span>
                                                <i class="fa fa-camera"></i>
                                              </span>
                                              <img class="show_company_img2" style="display:none" alt="img" src="<?php echo base_url() ?>/assets/img/logo.png">
                                              <span style="display:none" class="fa fa-close remove_img"></span>
                                            </div>
                                          </div>
                                          <div class="ceo_file_error file_error text-danger"></div>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="space-22"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger"><?php echo lang('reset_btn');?></button>
                    <button type="submit"  class="btn btn-primary" id="submit" ><?php echo lang('submit_btn');?></button>
                </div>
            </form>
        </div> <!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>