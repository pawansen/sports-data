<?php if ($this->ion_auth->is_admin() || $this->ion_auth->is_subAdmin()) { ?>               

                    <!-- Page content -->
                    <div id="page-content">
                        <div id="msg"></div>
                        <!-- eShop Overview Block -->
                        <div class="block full">
                            <!-- eShop Overview Title -->
                            <div class="block-title">
                                <div class="block-options pull-right">
                                    <div class="btn-group btn-group-sm">
                                        <a href="javascript:void(0)" onclick="getCharts('currentYear')" class="btn btn-alt btn-sm btn-default dropdown-toggle" data-toggle="dropdown">Current Year <span class="caret"></span></a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0)" onclick="getCharts('currentYear')">Current Year</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" onclick="getCharts('lastYear')">Last Year</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" onclick="getCharts('lastMonth')">Last Month</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" onclick="getCharts('currentMonth')">Current Month</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Settings"><i class="fa fa-cog"></i></a>
                                </div>
                                <h2><strong>Dashboard</strong> Overview</h2>
                            </div>
                            <!-- END eShop Overview Title -->

                            <!-- eShop Overview Content -->
                            <div class="row">
                                <div class="col-md-6 col-lg-4">
                                    <div class="row push totle_eShop_heading">
                                        <div class="col-xs-12">
                                            <h3><strong class="animation-fadeInQuick" id="totalv"><?php echo $total_vendors;?></strong><br><small class="text-uppercase animation-fadeInQuickInv"><a href="javascript:void(0)">Total Vendors</a></small></h3>
                                        </div>
                                        <div class="col-xs-12">
                                            <h3><strong class="animation-fadeInQuick" id="totalu"><?php echo $total_users;?></strong><br><small class="text-uppercase animation-fadeInQuickInv"><a href="javascript:void(0)">Total Clients</a></small></h3>
                                        </div>
                                        <div class="col-xs-12">
                                            <h3><strong class="animation-fadeInQuick" id="totale"><?php echo $total_enquiries;?></strong><br><small class="text-uppercase animation-fadeInQuickInv"><a href="javascript:void(0)">Total Enquiries</a></small></h3>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-8">
                                    <!-- Flot Charts (initialized in js/pages/ecomDashboard.js), for more examples you can check out http://www.flotcharts.org/ -->
                                    <div id="chart-overview" style="height: 350px;"></div>
                                </div>
                            </div>
                            <!-- END eShop Overview Content -->
                        </div>
                        <!-- END eShop Overview Block -->

                        <!-- Orders and Products -->
                        
                        
                        <div class="row">
                            <div class="col-lg-6">
                                <!-- Latest Orders Block -->
                                <div class="block title_none_table_header">
                                    <!-- Latest Orders Title -->
                                    <div class="block-title">
                                        <div class="block-options pull-right">
                                            <!-- <a href="page_ecom_orders.html" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Show All"><i class="fa fa-eye"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Settings"><i class="fa fa-cog"></i></a> -->
                                        </div>
                                        <h2><strong>Enquiries</strong></h2>
                                    </div>
                                    <!-- END Latest Orders Title -->

                                    <!-- Latest Orders Content -->
                                    
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
                                            <td><?php echo $rows->company_name?></td>
                                            <td><?php echo $rows->company_name;?></td>
                                            </tr>
                                        <?php $i++;}?>
                                        </tbody>
                                        
                                    </table>
                                    
                                    
                                
                                    <!-- END Latest Orders Content -->
                                </div>
                                <!-- END Latest Orders Block -->
                            </div>
                            <div class="col-lg-6">
                                <!-- Top Products Block -->
                                <div class="block title_none_table_header">
                                    <!-- Top Products Title -->
                                    <div class="block-title">
                                        <div class="block-options pull-right">
                                            <!-- <a href="page_ecom_products.html" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Show All"><i class="fa fa-eye"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Settings"><i class="fa fa-cog"></i></a> -->
                                        </div>
                                        <h2><strong>Vendors</strong></h2>
                                    </div>
                                    <!-- END Top Products Title -->

                                    <!-- Top Products Content -->
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
                                            <td class=""><a href="javascript:void(0)"><?php echo $rows->first_name.' '.$rows->last_name;?></a></td>
                                            <td class="text-center"><span class="label label-success"><?php echo ($rows->vendor_profile_activate == "Yes") ? "Verified":"Processing";?></span></ td>
                                            
                                            </tr>
                                        <?php $i++;}?>
        
                                        </tbody>
                                        
                                        </table>
                                    <!-- END Top Products Content -->
                                </div>
                                <!-- END Top Products Block -->
                            </div>
                        </div>
                        <!-- END Orders and Products -->
                        
                        
                        
                        
                        <div class="row">
                            <div class="col-lg-6">
                                <!-- Latest Orders Block -->
                                <div class="block">
                                    <!-- Latest Orders Title -->
                                    <div class="block-title">
                                        <div class="block-options pull-right">
                                            <!-- <a href="page_ecom_orders.html" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Show All"><i class="fa fa-eye"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Settings"><i class="fa fa-cog"></i></a> -->
                                        </div>
                                        <h2><strong>Client</strong></h2>
                                    </div>
                                    <!-- END Latest Orders Title -->

                                    <!-- Latest Orders Content -->
                                    
                                    
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
                                                                        <td class=""><a href="javascript:void(0)"><?php echo $rows->first_name.' '.$rows->last_name;?></a></td>
                                                                        <td class="text-center"><span class="label label-success"><?php echo ($rows->active == 1) ? "Verified":"Processing";?></span></ td>
                                                                        
                                                                        </tr>
                                                                    <?php $i++;}?>
                                                                      
                                                                    </tbody>
                                                                    
                                                                    </table>
                                    
                                    <!-- END Latest Orders Content -->
                                </div>
                                <!-- END Latest Orders Block -->
                            </div>
                            
                            
                            
                            <div class="col-lg-6">
                                <!-- Top Products Block -->
                                <div class="block2">
                                    <!-- Top Products Title -->
                                    <!--<div class="block-title">
                                        <div class="block-options pull-right">
                                            <a href="page_ecom_products.html" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Show All"><i class="fa fa-eye"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Settings"><i class="fa fa-cog"></i></a>
                                        </div>
                                        <h2><strong>Vendors</strong></h2>
                                    </div>-->
                                    <!-- END Top Products Title -->

                                    <!-- Top Products Content -->
                                    <!--<table class="table table-borderless table-striped table-vcenter table-bordered table_fonts_size">
                                        <tbody>
                                            <tr>
                                                <td class="text-center" style="width: 100px;"><a href="page_ecom_product_edit.html"><strong>PID.8765</strong></a></td>
                                                <td><a href="page_ecom_product_edit.html">iPhone 6 Plus 32GB</a></td>
                                                <td class="text-center"><strong>435</strong> orders</td>
                                                <td class="hidden-xs text-center">
                                                    <div class="text-warning">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-half-o"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center" style="width: 100px;"><a href="page_ecom_product_edit.html"><strong>PID.8764</strong></a></td>
                                                <td><a href="page_ecom_product_edit.html">Wii U</a></td>
                                                <td class="text-center"><strong>502</strong> orders</td>
                                                <td class="hidden-xs text-center">
                                                    <div class="text-warning">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-half-o"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center" style="width: 100px;"><a href="page_ecom_product_edit.html"><strong>PID.8763</strong></a></td>
                                                <td><a href="page_ecom_product_edit.html">Samsung Galaxy Note 4 32GB</a></td>
                                                <td class="text-center"><strong>440</strong> orders</td>
                                                <td class="hidden-xs text-center">
                                                    <div class="text-warning">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-half-o"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center" style="width: 100px;"><a href="page_ecom_product_edit.html"><strong>PID.8762</strong></a></td>
                                                <td><a href="page_ecom_product_edit.html">Playstation 4</a></td>
                                                <td class="text-center"><strong>750</strong> orders</td>
                                                <td class="hidden-xs text-center">
                                                    <div class="text-warning">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-half-o"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center" style="width: 100px;"><a href="page_ecom_product_edit.html"><strong>PID.8761</strong></a></td>
                                                <td><a href="page_ecom_product_edit.html">HTC One 32GB</a></td>
                                                <td class="text-center"><strong>420</strong> orders</td>
                                                <td class="hidden-xs text-center">
                                                    <div class="text-warning">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-half-o"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center" style="width: 100px;"><a href="page_ecom_product_edit.html"><strong>PID.8760</strong></a></td>
                                                <td><a href="page_ecom_product_edit.html">Xbox One</a></td>
                                                <td class="text-center"><strong>650</strong> orders</td>
                                                <td class="hidden-xs text-center">
                                                    <div class="text-warning">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-half-o"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center" style="width: 100px;"><a href="page_ecom_product_edit.html"><strong>PID.8762</strong></a></td>
                                                <td><a href="page_ecom_product_edit.html">iPad Mini Retina 64GB</a></td>
                                                <td class="text-center"><strong>521</strong> orders</td>
                                                <td class="hidden-xs text-center">
                                                    <div class="text-warning">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-half-o"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center" style="width: 100px;"><a href="page_ecom_product_edit.html"><strong>PID.8761</strong></a></td>
                                                <td><a href="page_ecom_product_edit.html">LG Tab 10.1</a></td>
                                                <td class="text-center"><strong>427</strong> orders</td>
                                                <td class="hidden-xs text-center">
                                                    <div class="text-warning">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-half-o"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center" style="width: 100px;"><a href="page_ecom_product_edit.html"><strong>PID.8760</strong></a></td>
                                                <td><a href="page_ecom_product_edit.html">Macbook Pro 15' Retina</a></td>
                                                <td class="text-center"><strong>392</strong> orders</td>
                                                <td class="hidden-xs text-center">
                                                    <div class="text-warning">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-half-o"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center" style="width: 100px;"><a href="page_ecom_product_edit.html"><strong>PID.8760</strong></a></td>
                                                <td><a href="page_ecom_product_edit.html">PS Vita</a></td>
                                                <td class="text-center"><strong>380</strong> orders</td>
                                                <td class="hidden-xs text-center">
                                                    <div class="text-warning">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-half-o"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>-->
                                    <!-- END Top Products Content -->
                                </div>
                                <!-- END Top Products Block -->
                            </div>
                        </div>
                        <!-- END Orders and Products -->
                        
                        
                        
                        
                        
                    </div>
                    <!-- END Page Content -->



<?php } ?>