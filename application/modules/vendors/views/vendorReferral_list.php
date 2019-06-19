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
                <a href="<?php echo site_url('vendors/venderReferral'); ?>">Invite Referrals</a>
            </li>
        </ol>
    </div>
    <div class="col-lg-4 text-right">

     <div class="ibox-title">
                    <div class="btn-group " href="#">
                        <a href="javascript:void(0)"  onclick="open_modal_referral('vendors')" class="<?php echo THEME_BUTTON;?>">
                            Invite Referrals
                            <i class="fa fa-plus"></i>
                        </a>

                        
                    </div>
                </div>

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
<!--                        <div class="col-sm-12">
                            <div class="col-md-6 multi_select">
                                <select id="match" name="match" class="select-2" onchange="getMatchBySeries(this.value)">
                                    <option value="">Select Series</option>
                                    <?php
                                    if (!empty($series)) {
                                        foreach ($series as $row) {
                                            ?>
                                            <option value="<?php echo $row->sid; ?>" <?php echo ($series_id == $row->sid) ? "selected" : ""; ?>><?php echo $row->name; ?></option>
                                        <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>-->
                       <input type="hidden" value="<?php echo $uid;?>" id="uid"/>
                        <div class="col-sm-12">
                            <br>           
                            <div class="table-responsive">
                                <table id="matches" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>S. No.</th>
                                            <th>User By Invited</th>
                                            <th>User Invited</th>
                                            <th>Referral Date</th>
                                            <th>Registered</th>
                                            <th>Add Cash</th>
                                            <th>Account Verified</th>
                                            <th>App Download</th>
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

    <div id="commonModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
           
            <form class="form-horizontal" role="form" id="addFormAjax" method="post" action="<?php echo base_url('vendors/referrals_send_user') ?>" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"><?php echo (isset($title)) ? ucwords($title) : "" ?></h4>
                </div>
                <div class="modal-body clearfix">
                    <div class="loaders">
                        <img src="<?php echo base_url().'backend_asset/images/Preloader_2.gif';?>" class="loaders-img" class="img-responsive">
                    </div>
                    <div class="alert alert-danger" id="error-box" style="display: none"></div>
                    <div class="form-body">
                        <div class="row">
                           
                             <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo lang('user_email');?></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="email" id="user_email" placeholder="<?php echo lang('user_email');?>"/>
                                    </div>
                                </div>
                            </div>
                             <div class="col-md-12" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo lang('phone_no');?></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="phone" id="phone_no" placeholder="<?php echo lang('phone_no');?>" />
                                    </div>
                                    <!-- <span class="help-block m-b-none col-md-offset-3"><i class="fa fa-arrow-circle-o-up"></i> <?php echo lang('english_note');?></span> -->
                                </div>
                            </div>
                             
                             <?php //echo "<pre>"; print_r($this->session->all_userdata()); 
                                    $user_id = $this->session->userdata('user_id');
                                    $option = array(
                                              'table' => 'users',
                                               'select' => 'team_code',
                                               'where' => array('id'=> $user_id),
                                               'single' => true

                                        );
                                    $users = $this->common_model->customGet($option);
                                    if(!empty($users))
                                    {

                                        $userInviteCode = $users->team_code;
                                        $share_url = base_url() . '#/signup?referral=' . $userInviteCode;
                                        //$share_url ="https://playwinfantasy.com/#/signup?referral=KULDE33825";

                                    }
                             ?>
                              <div class="col-md-12" >
                                <div class="form-group">
                                <label class="col-md-3 control-label"></label>
                                    <div class="col-md-9">
                                    <ul class="list-inline">
                                    <?php

                                    $url=urlencode($share_url);

                                    //$img=urlencode("http://www.fbchandra.com/media/developers/share-page.jpg");

                                    $title=urlencode("Playwinfantasy");

                                    $summary="Play Fantasy Cricket on India's Largest Fantasy Cricket website.";

                                    ?>

<li>
<a title="Share it on Facebook" href="http://www.facebook.com/sharer.php?s=100&p[url]=<?php echo $url ?>&p[title]=<?php echo $title ?>&p[summary]=<?php echo $summary ?>" target="_blank">  <img width="30px" src="<?php echo base_url(); ?>backend_asset/images/fb.png" class="img-responsive" alt="logo"> </a>
</li>
<!-- <li>
                               <a href="https://api.whatsapp.com/send?text=Play Fantasy Cricket on India's Largest Fantasy Cricket website. Click <?php echo $share_url; ?>" target="_blank">
                <img width="30px" src="<?php echo base_url(); ?>backend_asset/images/whatsapp.jpg" class="img-responsive" alt="logo"></a>
                </li> -->
                <li>
                 <a href="https://twitter.com/intent/tweet?text=Play Fantasy Cricket on India's Largest Fantasy Cricket website. Click <?php echo $url; ?>" target="_blank">
                 <img width="30px" src="<?php echo base_url(); ?>backend_asset/images/twitter.png" class="img-responsive" alt="logo">
                  </a> </li></ul>
                                     </div>
                                     </div>
                            </div>
                           

                            <div class="space-22"></div>
                        </div>
                             <!-- <div style="padding-left:20%"> Click <div class="error"><?php echo $base_url; ?></div> to download the playwinfantasy app </div> -->
                         
                            <div class="space-22"></div>
                        </div>
                    </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo lang('close_btn');?></button>
                    <button type="submit" id="submit" class="<?php echo THEME_BUTTON;?>" ><?php echo lang('submit_btn');?></button>
                </div>
            </form>
        </div> <!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>