<table id="dtVerticalScrollExample2" class="table table-striped table-bordered table-sm table-borderless table-vcenter table_fonts_size" cellspacing="0"
                                        width="100%">
                                        <thead>
                                            <tr>
                                            <th class="hidden-xs th-sm">No
                                            </th>
                                            <th class="th-sm">Vandore Name
                                            </th>
                                            <th class="th-sm">vendors status
                                            </th>
                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i=1; foreach($vendors as $rows){?>
                                            <tr>
                                            <td class="hidden-xs text-center" style="width: 100px;">
                                            <a href="javascript:void(0)"><strong><?php echo $i;?></strong></a></td>
                                            <td class=""><a href="<?php echo base_url().'vendors/vendor_edit?id='. encoding($rows->id);?>"><?php echo $rows->first_name.' '.$rows->last_name;?></a></td>
                                            <td class="text-center"><span class="label label-success"><?php echo ($rows->vendor_profile_activate == "Yes") ? "Verified":"Processing";?></span></ td>
                                            
                                            </tr>
                                        <?php $i++;}?>
        
                                        </tbody>
                                        
                                        </table>