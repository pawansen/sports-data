                                      <option value="">State / Province selection</option>
                                      <?php foreach($states as $rows){?>
                                          <option value="<?php echo $rows->id;?>"><?php echo $rows->name;?></option>
                                       <?php }?>