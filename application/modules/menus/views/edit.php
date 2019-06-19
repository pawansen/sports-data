<style>
    .modal-footer .btn + .btn {
        margin-bottom: 5px !important;
        margin-left: 5px;
    }
</style>
<div id="commonModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" role="form" id="addFormAjax" method="post" action="<?php echo base_url('menus/menu_update') ?>" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Item Edit</h4>
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
                                    <label class="col-md-3 control-label">Category</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="category" id="menu_category">
                                            <option value="">Select Menu Category</option>
                                            <?php if (!empty($menu_category)) {
                                                foreach ($menu_category as $result) { ?>
                                                    <option <?php if ($results->category_id == $result->id) echo "selected"; ?> value="<?php echo $result->id; ?>"><?php echo $result->category_name; ?></option>
    <?php }
} ?>
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
                                           <?php if(!empty($menu_sub_category)){foreach($menu_sub_category as $rows){?>
                                              <option <?php if ($results->subcategory_id == $rows->id) echo "selected"; ?> value="<?php echo $rows->id;?>"><?php echo $rows->subcategory_name;?></option>
                                            <?php }}?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                             <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Item Code</label>
                                    <div class="col-md-9">
                                   <input type="text" class="form-control" name="item_code" id="item_code" placeholder="Item Code" value="<?php echo $results->item_code;?>"/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Item Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="item_name" id="menu_name_en" placeholder="Item Name" value="<?php echo $results->item_name;?>"/>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Description</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="description" id="description_en" placeholder="Description"><?php echo $results->description;?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Price</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="price" id="price" placeholder="Price" value="<?php echo $results->price;?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Minimum Quantity</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="quantity_per_unit" id="quantity_per_unit" placeholder="Minimum Quantity" value="<?php echo $results->quantity_per_unit;?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Weight Per Unit</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="unit_weight" id="unit_weight" placeholder="Weight should be kg,grams,liters" value="<?php echo $results->unit_weight;?>"/>
                                    </div>
                                </div>
                            </div>
 <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Unit Stock</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="unit_in_stock" id="unit_in_stock" placeholder="Unit In Stock" value="<?php echo $results->unit_in_stock;?>"/>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Discount Available</label>
                                    <div class="col-md-9">
                                        <input type="checkbox" name="discount_available" id="discount_available" onclick="isDiscount()" value="1" <?php if($results->discount_available == 1){echo "checked";}?>/>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12 discountPrice" style="<?php if($results->discount_available != 1){echo "display:none";}?>">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Discount Price</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="discount" id="discount" placeholder="0" value="<?php echo $results->discount;?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Featured</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="is_featured" id="is_featured">
                                            <option value="NO" <?php if ($results->is_featured == 'NO') echo 'selected'; ?>> NO </option>
                                            <option value="YES" <?php if ($results->is_featured == 'YES') echo 'selected'; ?>> YES </option>
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
                                                <input type="radio" name="stock" id="stock" <?php if ($results->stock == 'INSTOCK') echo 'checked="checked"'; ?> value="INSTOCK"><label class="checkbox-inline">IN STOCK</label>
                                            </div>
                                            <div class="checkbox">
                                                <input type="radio" name="stock" id="stock" <?php if ($results->stock == 'OUT OF STOCK') echo 'checked="checked"'; ?> value="OUT OF STOCK"><label class="checkbox-inline">OUT OF STOCK</label>
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
                                                        <?php if (!empty($results->image)) { ?>
                                                            <img src="<?php echo base_url() . $results->image; ?>">
                                                        <?php } else { ?>
                                                            <img src="<?php echo base_url() . 'backend_assets/images/default.jpg'; ?>">
<?php } ?>

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

                            <input type="hidden" name="id" value="<?php echo $results->id; ?>" />
                            <input type="hidden" name="exists_image" value="<?php echo $results->image; ?>" />
                            <div class="space-22"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit"  class="btn btn-primary" id="submit">Update</button>
                </div>
            </form>
        </div> <!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script type="text/javascript">

    $(document).on('change', '#menu_category', function () {
        var _this = $(this).val();


        $.ajax({
            type: "POST",
            url: '<?php echo base_url('menus/getSubcat') ?>/' + _this,
            dataType: 'html'
        }).done(function (category) {
            $('#category').html(category);
        });

    });

</script>