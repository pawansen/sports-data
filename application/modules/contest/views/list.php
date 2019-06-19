<style>
    .select2-container, .select2-drop, .select2-search, .select2-search input {
    width: 290px !important;
}
</style>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2><?php echo (isset($headline)) ? ucwords($headline) : ""?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('pwfpanel');?>"><?php echo lang('home');?></a>
            </li>
            <li>
                <a href="<?php echo site_url('contest');?>"><?php echo lang('contest');?></a>
            </li>
        </ol>
    </div>
    <div class="col-lg-4 text-right">

    <div class="ibox-title">
                    <div class="btn-group " href="#">
                        <a href="<?php echo site_url('contest/add_contest')?>"  class="<?php echo THEME_BUTTON;?>">
                            <?php echo lang('contest');?>
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
                        <?php $message = $this->session->flashdata('success');
                        if(!empty($message)):?><div class="alert alert-success">
                        <?php echo $message;?></div><?php endif; ?>
                        <?php $error = $this->session->flashdata('error');
                        if(!empty($error)):?><div class="alert alert-danger">
                        <?php echo $error;?></div><?php endif; ?>
                        <div id="message"></div>
                        <div class="col-sm-12" >
                            <div class="col-md-4 multi_select">
                                <select id="match" name="match" class="select2 select-2">
                                    <option value="">Select Match</option>
                                        <?php if(isset($allMatchList) && !empty($allMatchList)){
                                        foreach($allMatchList as $row){
                                        $select = "" ;   if(isset($matchId)){if($matchId == $row->match_id){$select="selected";}}?>
                                        <option value="<?php echo $row->match_id;?>" <?php echo $select;?>><?php echo $row->localteam." Vs ".$row->visitorteam."  -  (".date('d-m-Y',strtotime($row->match_date)).")";?></option>
                                        <?php }
                                    }?>
                                </select>
                            </div>
                            <input type="hidden" id="matchIdFilter" value="<?php if(isset($matchId)){if(!empty($matchId)){echo $matchId;}}?>"/>
                            <div class="col-md-4 multi_select">
                                <select id="contest_type" name="contest_type" class="select-2">
                                    <option value="">Select Contest Type</option>
                                    <option value="mega">Mega Contest</option>
                                    <option value="cancel">Cancel Contest</option>
                                    <option value="complete">Complete Contest</option>
                                    <option value="current">Current Contest</option>
                                    <option value="running">Running Contest</option>
                                    <option value="abandon">Abandon Contest</option>
                                </select>
                            </div>
                            <div class="col-md-4 text-right">
                            <input type="button" class="<?php echo THEME_BUTTON;?>" value="Search" onclick="searchContest()">
                                </div>
                        </div>
                        <div class="col-sm-12" >
                            <br>
                            <div class="table-responsive">
                                <table id="contest" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>S. No.</th>
<!--                                            <th>Match</th>-->
                                            <th style="width:25%">Contest Name</th>
<!--                                            <th>Match Type</th>-->
                                            <th>Total Winning Amount</th>
                                            <th>Contest Size</th>
                                            <th>No. Of Winners</th>
                                            <th>Entry Fee</th>
                                            <th>Chip</th>
                                            <th>Win/Lose</th>
                                            <th>Contest Status</th> 
                                            <th>Created Date</th>
                                            <th style="width:25%">Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="form-modal-box"></div>
            </div>
        </div>
    </div>
    <div id="typefilter"> <input type="hidden" id="type" value="<?php if(isset($_GET['type'])){echo $_GET['type'];}?>"/></div>