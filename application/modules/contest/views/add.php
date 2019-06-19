<style>
    #message_div{
        background-color: #ffffff;
        border: 1px solid;
        box-shadow: 10px 10px 5px #888888;
        display: none;
        height: auto;
        left: 36%;
        position: fixed;
        top: 20%;
        width: 40%;
        z-index: 1;
    }
    #close_button{
        right:-15px;
        top:-15px;
        cursor: pointer;
        position: absolute;
    }
    #close_button img{
        width:30px;
        height:30px;
    }    
    #message_container{
        height: 450px;
        overflow-y: scroll;
        padding: 20px;
        text-align: justify;
        width: 99%;
    }
    .select2-wrapper {
    display: inline-block;
    position: relative;
}
</style>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo (isset($headline)) ? ucwords($headline) : ""?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('pwfpanel');?>"><?php echo lang('home');?></a>
            </li>
            <li>
                <a href="<?php echo site_url('contest/add_contest');?>"><?php echo lang('add_contest');?></a>
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
                        <form class="form-horizontal" role="form" id="addContest" method="post"  enctype="multipart/form-data" action="<?php echo base_url()?>contest/add_contest">
                            <div> 
                                <div class="loaders">
                                    <img src="<?php echo base_url().'backend_asset/images/Preloader_2.gif';?>" class="loaders-img" class="img-responsive">
                                </div>
                                <div class="alert alert-danger" id="error-box" style="display: none"></div>
                                <?php if(isset($error)){if(!empty($error)){echo '<div class="alert alert-danger">'.$error.'</div>';}}?>
                                <div class="form-body">
                                    <div class="row">
                                        
                                    <!--    <input type="hidden" name="admin_fee_percent" id="admin_fee_percent" value="<?php //echo getConfig('admin_percentage');?>"> --> 
                                        
                                        <div class="col-md-12" >
                                            <div class="form-group">
                                                <label class="col-md-3 control-label"><?php echo lang('select_series');?></label>
                                                <div class="col-md-9">
                                                <select id="series" name="series" style="width:100%">
                                                <option value="">Select Series</option>
                                                        <?php if(!empty($series_details)){
                                                            foreach($series_details as $row){?>
                                                            <option value="<?php echo $row->sid;?>"><?php echo $row->name;?></option>
                                                            <?php }
                                                        }?>
                                                    </select>
                                                <span class="error"><?php echo form_error('series'); ?></span>
                                                </div>
                                            </div>
                                        </div>

                                   <div class="col-lg-2" style="padding-left:30%">

                                        <div class="form-group ">
                                        
                                          <a href="javascript:void(0)" class="btn btn-sm btn-primary" id ="all_matches">Select All</a>
                                           
                                            
                                       </div>
                                    </div>

                                     <div class="col-lg-2" style="padding-left:10%">

                                        <div class="form-group ">
                                        
                                          <a href="javascript:void(0)" class="btn btn-sm btn-primary" id ="clear_all">Clear All</a>
                                           
                                            
                                       </div>
                                    </div>

                                        <div class="col-md-12" >
                                            <div class="form-group">
                                                <label class="col-md-3 control-label"><?php echo lang('select_matches');?></label>
                                                <div class="col-md-9">
                                                <select id="matches" name="matches[]" multiple>
                                                          <?php if(!empty($match_details)){ 
                                                            
                                                            foreach($match_details as $row){?>
                                                            <option value="<?php echo $row->match_id;?>" <?php echo (!empty($match_id) && $match_id == $row->match_id) ? "selected" : ""; ?>><?php echo $row->localteam." Vs ".$row->visitorteam."  - ".$row->match_num."- (".date('d-m-Y',strtotime($row->match_date)).")";?></option>
                                                            <?php }
                                                        }?>
                                                    </select>
                                                <span class="error"><?php echo form_error('matches[]'); ?></span>
                                                </div>
                                            </div>
                                        </div>

                                       


                                        <!-- <div class="col-md-12" >
                                            <div class="form-group">
                                                <label class="col-md-3 control-label"><?php //echo lang('select_matches');?></label>
                                                <div class="col-md-9">
                                                <select id="matches" name="matches[]" class="validate[required]" multiple>
                                                        <?php if(!empty($match_details)){
                                                            foreach($match_details as $row){?>
                                                            <option value="<?php echo $row->match_id;?>"><?php echo $row->localteam." Vs ".$row->visitorteam."  -  (".date('d-m-Y',strtotime($row->match_date)).")";?></option>
                                                            <?php }
                                                        }?>
                                                    </select>
                                                <span class="error"><?php //echo form_error('matches[]'); ?></span>
                                                </div>
                                            </div>
                                        </div> -->
                                        
                                        <div class="col-md-12" >
                                            <div class="form-group">
                                                <label class="col-md-3 control-label"><?php echo lang('match_type');?></label>
                                                <div class="col-md-9">
                                                    <select id="match_type" name="match_type" class="form-control validate[required]">
                                                        <option value="">Select Match Type</option>
                                                        <option value="1">Live</option>
                                                        <option value="0">Free</option>
                                                    </select>
                                                    <span class="error"><?php echo form_error('match_type'); ?></span>
                                                </div>
                                            </div>

                                        </div>
                                        
                                        <div class="col-md-12" >
                                            <div class="form-group">
                                                <label class="col-md-3 control-label"><?php echo lang('contest_name');?></label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="contest_name" id="contest_name" placeholder="Your contest name" value="<?php if(set_value('contest_name')){ echo set_value('contest_name');}?>"/>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-12" >
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Total Winning Amount</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="total_winning_amount" id="total_winning_amount" placeholder="min Rs.0" onkeyup="setTeamFees();resetWinners();" value="<?php if(set_value('total_winning_amount')){ echo set_value('total_winning_amount');}?>"/>
                                                    <span class="error"><?php echo form_error('total_winning_amount'); ?></span>
                                                </div>

                                            </div>
                                        </div>
                                            
                                        <div class="col-md-12" >
                                            <div class="form-group">
                                                <label class="col-md-3 control-label"><?php echo lang('contest_size');?></label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control validate[required,custom[positive_number]]" name="contest_sizes" id="contest_sizes" placeholder="min 2" value="<?php if(set_value('contest_sizes')){ echo set_value('contest_sizes');}else{echo 2;}?>" onkeyup="setTeamFees();resetWinners();">
                                                    <span class="error"><?php echo form_error('contest_sizes'); ?></span>
                                                </div>

                                            </div>
                                        </div>

                                          <div class="col-md-12" >
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Publish</label>
                                                <div class="col-md-9">
                                                    <select id="publish" name="publish" class="form-control validate[required]">
                                                        <option value="">Select Option</option>
                                                        <option value="1">Publish</option>
                                                        <option value="0">Unpublish</option>
                                                    </select>
                                                    <span class="error"><?php echo form_error('publish'); ?></span>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="col-md-12 hide contest" >
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Admin Percentage</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control validate[required]" name="admin_percentage" id="admin_percentage" placeholder="%" value="<?php if(set_value('admin_percentage')){ echo set_value('admin_percentage');}?>"  onkeyup="setTeamFees();">
                                                    <span class="error"><?php echo form_error('admin_percentage'); ?></span>
                                                </div>

                                            </div>
                                        </div>


                                        <div class="col-md-12 hide contest" >
                                            <div class="form-group">
                                                <label class="col-md-3 control-label"><input type="checkbox" id="multi_entry" name="multi_entry"></label>
                                                <div class="col-md-9">
                                                    Join this contest with multiple teams
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12 hide contest" >
                                            <div class="form-group">
                                                <label class="col-md-3 control-label"><input type="checkbox" id="confirmed_contest" name="confirmed_contest" checked=""></label>
                                                <div class="col-md-9">
                                                    Confirmed Contest
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 hide contest" >
                                            <div class="form-group">
                                                <label class="col-md-3 control-label"><input type="checkbox" id="mega_contest" name="mega_contest"></label>
                                                <div class="col-md-9">
                                                    Is Mega Contest
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label"><input type="checkbox" id="customize_winnings" name="customize_winnings"></label>
                                                <div class="col-md-9">
                                                    Customize Winnings
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 hide contest" >
                                            <div class="form-group">
                                                <label class="col-md-3 control-label"><?php echo lang('join_contest');?></label>
                                                <div class="col-md-3">
                                                
                                                    <input type="text" class="form-control validate[custom[onlyDecimalandzero]]" name="real_money" id="real_money" placeholder="Rs.100" value="100" onkeyup="setTeamFees();resetWinners();"/>
                                                     <label class="control-label"><?php echo lang('real_money');?></label>
                                                </div>
                                                <div class="col-md-2">
                                                 AND
                                                </div>
                                                <div class="col-md-3">
                                                
                                                    <input type="text" class="form-control validate[custom[onlyDecimalandzero]]" name="chip" id="chip" placeholder="0" value="0" onkeyup="setTeamFees();resetWinners();" readonly/>
                                                     <label class="control-label"><?php echo lang('chip');?></label>
                                                </div>
                                                <span class="help-block m-b-none col-md-offset-3">

                                                </div>
                                            </div>



                                        <div class="col-md-12 hide contest" >
                                            <div class="form-group">
                                                <label class="col-md-3 control-label"><?php echo lang('entry_fee');?></label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control validate[custom[onlyDecimalandzero]]" name="entry_fee" id="entry_fee" placeholder="Rs.0" value="<?php if(set_value('entry_fee')){ echo set_value('entry_fee');}?>" readonly=""/>
                                                </div>
                                                <span class="help-block m-b-none col-md-offset-3">

                                                </div>
                                            </div>

                                         <div class="col-md-12 hide contest" >
                                            <div class="form-group">
                                                <label class="col-md-3 control-label"><?php echo lang('chip');?></label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="chip_value" id="chip_value" placeholder="0" value="<?php if(set_value('chip_value')){ echo set_value('chip_value');}?>" readonly=""/>
                                                </div>
                                                <span class="help-block m-b-none col-md-offset-3">

                                                </div>
                                            </div>


                                            <div class="col-md-12" >
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"><?php echo lang('no_of_winners');?></label>
                                                    <div class="col-md-7">
                                                        <input type="text" class="form-control form-control validate[custom[winners]]" name="no_of_winners" id="no_of_winners" placeholder="min 2" readonly="readonly" onkeyup="resetWinners()" value="<?php if(set_value('no_of_winners')){ echo set_value('no_of_winners');}?>"/> <span class="error"><?php echo form_error('no_of_winners'); ?></span>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <input type="button" id="set_btn" class="<?php echo THEME_BUTTON;?> set_btn" value="<?php echo lang('set');?>" disabled >
                                                    </div>
                                                </div>

                                            </div>
                                            <h4 style="text-align:center;color:red;"><span id="max_value_exceed"></span></h4>
                                            <div class="field_wrapper col-md-offet-2">
                                            </div>
                                            <div class="space-22"></div>
                                        </div>
                                    </div>
                                </div>
                                <div >
                                    <div class="col-md-12" >
                                        <button type="submit" id="submit" class="<?php echo THEME_BUTTON;?>" ><?php echo lang('submit_btn');?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="message_div">
            <span id="close_button"><img src="<?php echo base_url();?>backend_asset/images/close.png" onclick="close_message();"></span>
            <div id="message_container"></div>
        </div>
