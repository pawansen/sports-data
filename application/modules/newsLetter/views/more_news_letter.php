
                           <div class="col-md-12" id="<?php echo $key;?>">
                            <div class="form-group">
                               <label class="col-md-3 control-label">Title</label>
                                  <div class="col-md-9">
                                       <input type="text" name="title[]" class="form-control">
                                  </div>
                              </div>
                            <div class="form-group">
                                 <label class="col-md-3 control-label">Message</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control ckeditor" id="ckeditor" name="description[]"></textarea>
                                    </div>
                                     <span class="help-block m-b-none col-md-offset-3">
                                </div>    
                            <div class="clearfix"></div>
                            <div class="form-group">
                               <label class="col-md-3 control-label">Image vhjhj</label>
                                  <div class="col-md-9 border_banner_box ">
                                       <input type="file" name="files[]" class="form-control">
                                  </div>
                              </div>
                              <div class="form-group"><div class="col-md-12 col-md-offset-10">
                               <button type="button" id="newsletterbutton" onclick="removeMoreNewsletter(<?php echo $key;?>)" class="btn btn-primary">
                               <i class="fa fa-minus"></i> REMOVE</button></div>
                               </div>
                               </div>
                               
                             