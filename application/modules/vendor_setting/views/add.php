<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo (isset($headline)) ? ucwords($headline) : "" ?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('pwfpanel'); ?>"><?php echo lang('home'); ?></a>
            </li>
            <li>
                <a href="<?php echo site_url('vendor_settings'); ?>">Module settings</a>
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
                                            <h5><?php Icon(); ?> Vendor Access System</h5>
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
                                            <form class="form-horizontal" role="form" id="addFormAjax" method="post" action="<?php echo base_url('vendor_setting/add_modules'); ?>" enctype="multipart/form-data">
                                                <table class="table table-bordered table-responsive" id="common_datatable_users">
                                                    <thead>
                                                        <tr>
                                                            <th style="width:50%;" class="text-danger">Modules</th>
                                                            <th>Access</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $inputArr = fantasy_modules();
                                                          if(!empty($inputArr)){ 

                                                              if(isset($inputArr) && !empty($inputArr)){

                                                              foreach($inputArr as $key=>$value){

                                                                ?>
                                                        <tr>
                                                            <td><?php echo $value;?></td> 
                                                            <td><input type="checkbox" name="<?php echo $key?>" class="form-control" <?php echo (getConfig($key) == 'on') ? 'checked': ''; ?>></td>
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
