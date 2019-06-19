<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo (isset($headline)) ? ucwords($headline) : "" ?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('pwfpanel'); ?>"><?php echo lang('home'); ?></a>
            </li>
            <li>
                <a href="<?php echo site_url('configuration'); ?>">Point System</a>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-content">
                    <div class="row">
                        <?php
                        $message = $this->session->flashdata('success');
                        if (!empty($message)):
                            ?><div class="alert alert-success">
                                <?php echo $message; ?></div><?php endif; ?>
                        <?php
                        $error = $this->session->flashdata('error');
                        if (!empty($error)):
                            ?><div class="alert alert-danger">
                                <?php echo $error; ?></div><?php endif; ?>
                        <div id="message"></div>
                        <div class="col-lg-12" style="overflow-x: auto">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5><?php Icon(); ?> Fantasy Points System</h5>
                                            <div class="ibox-tools">
                                                <a class="collapse-link">
                                                    <i class="fa fa-chevron-up"></i>
                                                </a>
                                                <a class="close-link">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="ibox-content">
                                            <form class="form-horizontal" role="form" id="addFormAjax" method="post" action="<?php echo base_url('configuration/configuration_add') ?>" enctype="multipart/form-data">
                                                <table class="table table-bordered table-responsive" id="common_datatable_users">
                                                    <thead>
                                                        <tr>
                                                            <th style="width:50%;" class="text-danger">Type of Points (Main)</th>
                                                            <th>T20</th>
                                                            <th>ODI</th>
                                                            <th>Test</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $inputArr = fantasyPointInput();
                                                          if(!empty($inputArr)){ 
                                                              if(isset($inputArr['main']) && !empty($inputArr['main'])){
                                                              foreach($inputArr['main'] as $key=>$main){?>
                                                        <tr>
                                                            <td><?php echo $main;?></td> 
                                                            <td><input type="text" name="<?php echo $key?>_t20" class="form-control" placeholder="0" value="<?php echo getConfig($key."_t20"); ?>" oninput="this.value = this.value.replace(/[^0-9.-]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"></td>
                                                            <td><input type="text" name="<?php echo $key?>_odi" class="form-control" placeholder="0" value="<?php echo getConfig($key."_odi"); ?>" oninput="this.value = this.value.replace(/[^0-9.-]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"></td>
                                                            <td><input type="text" name="<?php echo $key?>_test" class="form-control" placeholder="0" value="<?php echo getConfig($key."_test"); ?>" oninput="this.value = this.value.replace(/[^0-9.-]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"></td>
                                                        </tr>
                                                        <?php }}?> 
                                                        <?php  if(isset($inputArr['bonus']) && !empty($inputArr['bonus'])){ ?>
                                                        <tr>
                                                            <th style="width:50%;" class="text-danger">Type of Points (Bonus)</th>
                                                            <th>T20</th>
                                                            <th>ODI</th>
                                                            <th>Test</th>
                                                        </tr>
                                                        <?php foreach($inputArr['bonus'] as $key=>$main){?>
                                                        
                                                         <tr>
                                                            <td><?php echo $main;?></td> 
                                                            <td><input type="text" name="<?php echo $key?>_t20" class="form-control" placeholder="0" value="<?php echo getConfig($key."_t20"); ?>" oninput="this.value = this.value.replace(/[^0-9.-]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"></td>
                                                            <td><input type="text" name="<?php echo $key?>_odi" class="form-control" placeholder="0" value="<?php echo getConfig($key."_odi"); ?>" oninput="this.value = this.value.replace(/[^0-9.-]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"></td>
                                                            <td><input type="text" name="<?php echo $key?>_test" class="form-control" placeholder="0" value="<?php echo getConfig($key."_test"); ?>" oninput="this.value = this.value.replace(/[^0-9.-]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"></td>
                                                        </tr>
                                                        
                                                        <?php }}?>
                                                        
                                                            <?php  if(isset($inputArr['economy_rate']) && !empty($inputArr['economy_rate'])){ ?>
                                                        <tr>
                                                            <th style="width:50%;" class="text-danger">Type of Points (Economy Rate)</th>
                                                            <th>T20</th>
                                                            <th>ODI</th>
                                                            <th>Test</th>
                                                        </tr>
                                                        <?php foreach($inputArr['economy_rate'] as $key=>$main){?>
                                                        
                                                         <tr>
                                                            <td><?php echo $main;?></td> 
                                                            <td><input type="text" name="<?php echo $key?>_t20" class="form-control" placeholder="0" value="<?php echo getConfig($key."_t20"); ?>" oninput="this.value = this.value.replace(/[^0-9.-]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"></td>
                                                            <td><input type="text" name="<?php echo $key?>_odi" class="form-control" placeholder="0" value="<?php echo getConfig($key."_odi"); ?>" oninput="this.value = this.value.replace(/[^0-9.-]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"></td>
                                                            <td><input type="text" name="<?php echo $key?>_test" class="form-control" placeholder="0" value="<?php echo getConfig($key."_test"); ?>" oninput="this.value = this.value.replace(/[^0-9.-]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"></td>
                                                        </tr>
                                                        
                                                        <?php }}?>
                                                        
                                                               <?php  if(isset($inputArr['strike_rate']) && !empty($inputArr['strike_rate'])){ ?>
                                                        <tr>
                                                            <th style="width:50%;" class="text-danger">Type of Points (Strike Rate Except Bowlers)</th>
                                                            <th>T20</th>
                                                            <th>ODI</th>
                                                            <th>Test</th>
                                                        </tr>
                                                        <?php foreach($inputArr['strike_rate'] as $key=>$main){?>
                                                        
                                                         <tr>
                                                            <td><?php echo $main;?></td> 
                                                            <td><input type="text" name="<?php echo $key?>_t20" class="form-control" placeholder="0" value="<?php echo getConfig($key."_t20"); ?>" oninput="this.value = this.value.replace(/[^0-9.-]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"></td>
                                                            <td><input type="text" name="<?php echo $key?>_odi" class="form-control" placeholder="0" value="<?php echo getConfig($key."_odi"); ?>" oninput="this.value = this.value.replace(/[^0-9.-]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"></td>
                                                            <td><input type="text" name="<?php echo $key?>_test" class="form-control" placeholder="0" value="<?php echo getConfig($key."_test"); ?>" oninput="this.value = this.value.replace(/[^0-9.-]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"></td>
                                                        </tr>
                                                        
                                                        <?php }}?>
                                                        
                                                        
                                                        <?php }?>
                                                        
                                                    </tbody>
                                                </table>
                                                <div class="hr-line-dashed"></div>
                                                <div class="form-group">
                                                    <div class="col-sm-4 col-sm-offset-2">
                                                        <button class="btn btn-danger" type="submit"><?php echo lang('cancle_btn'); ?></button>
                                                        <button class="<?php echo THEME_BUTTON; ?>" type="submit" id="submit" ><?php echo lang('save_btn'); ?></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>  

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <?php $isConfigLoggedIn = $this->session->userdata('isConfigLoggedIn');
        if(!$isConfigLoggedIn){?> 
<style>
    .modal-footer .btn + .btn {
    margin-bottom: 5px !important;
    margin-left: 5px;
}
</style>
<div id="authLogin" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" role="form" id="authLogin" method="post" action="<?php echo base_url('pwfpanel/authSecurityLogin') ?>" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Login</h4>
                </div>
                        <?php
                         $error = $this->session->flashdata('errMessage');
                         if (!empty($error)):
                        ?><div class="alert alert-danger">
                        <?php echo $error; ?></div><?php endif; ?>
                <div class="modal-body">
                    <div class="loaders">
                        <img src="<?php echo base_url().'backend_asset/images/Preloader_2.gif';?>" class="loaders-img" class="img-responsive">
                    </div>
                    <div class="alert alert-danger" id="error-box" style="display: none"></div>
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Email</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="identity" id="identity" placeholder="Email" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" />
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <div class="space-22"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submit" class="<?php echo THEME_BUTTON;?>" ><i class="fa fa-lock"></i> LOGIN TO INTER</button>
                </div>
            </form>
        </div> <!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<?php }?>
