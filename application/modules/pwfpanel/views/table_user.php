<table id="dtVerticalScrollExample3" class="table table-striped table-bordered table-sm12 table-borderless table-vcenter table_fonts_size" cellspacing="0"
                                                                    width="100%">
                                                                    <thead>
                                                                        <tr>
                                                                        <th class="hidden-xs th-sm">No
                                                                        </th>
                                                                        <th class="th-sm">Client Name
                                                                        </th>
                                                                        <th class="th-sm">Client status
                                                                        </th>
                                                                        
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php $i=1; foreach($users as $rows){?>
                                                                        <tr>
                                                                        <td class="hidden-xs text-center" style="width: 100px;">
                                                                        <a href="javascript:void(0)"><strong><?php echo $i;?></strong></a></td>
                                                                        <td class=""><a href="<?php echo base_url().'users/user_edit?id='. encoding($rows->id);?>"><?php echo $rows->first_name.' '.$rows->last_name;?></a></td>
                                                                        <td class="text-center"><span class="label label-success"><?php echo ($rows->active == 1) ? "Verified":"Processing";?></span></ td>
                                                                        
                                                                        </tr>
                                                                    <?php $i++;}?>
                                                                      
                                                                    </tbody>
                                                                    
                                                                    </table>