<style>
.select2-container, .select2-drop, .select2-search, .select2-search input {
    width: 290px !important;
}
</style>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo (isset($headline)) ? ucwords($headline) : "" ?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('pwfpanel'); ?>"><?php echo lang('home'); ?></a>
            </li>
            <li>
                <a href="<?php echo site_url('notification'); ?>"><?php echo "Notification"; ?></a>
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
                        <div class="col-sm-12">     
                                <div class="table-responsive">
                                    <table id="notification" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th style="width:10%">S. No.</th>
                                                <th>User</th>
                                                <th>Message</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>