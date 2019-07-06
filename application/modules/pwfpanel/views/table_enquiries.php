<table id="dtVerticalScrollExample" class="table table-striped table-bordered table-sm table-borderless table-vcenter table_fonts_size" cellspacing="0"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th class="hidden-xs th-sm">No
                                            </th>
                                            <th class="th-sm">Name
                                            </th>
                                            <th class="th-sm">Software Category
                                            </th>
                                            <th class="th-sm">Vandore Name
                                            </th>
                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i=1; foreach($enquiries as $rows){?>
                                            <tr>
                                            <td class="hidden-xs text-center" style="width: 100px;">
                                            <a href="javascript:void(0)"><strong><?php echo $i;?></strong></a></td>
                                            <td class=""><a href="javascript:void(0)"><?php echo $rows->c_first_name.' '.$rows->c_last_name;?></a></td>
                                            <td><?php
                                                                            $category = commonGetHelper(array('select'=>"GROUP_CONCAT(category_name SEPARATOR ',') as category_name",'table'=>"item_category","where_in" => array('id'=>explode(",",$rows->rq_software_categories))));
                                                                            echo $category[0]->category_name;;?></td>
                                            <td><?php echo $rows->company_name;?></td>
                                            </tr>
                                        <?php $i++;}?>
                                        </tbody>
                                        
                                    </table>