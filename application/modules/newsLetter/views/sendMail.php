<script src="<?php echo base_url() . 'backend_asset/js/' ?>select2.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>backend_asset/css/select2.min.css">
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
</style>   
                   
    <!-- Page content -->
    <div id="page-content">
        <!-- Datatables Header -->
        <ul class="breadcrumb breadcrumb-top">
        <li>
            <a href="<?php echo site_url('pwfpanel');?>">Home</a>
        </li>
        <li>
            <a href="<?php echo site_url('newsLetter');?>">Newsletters</a>
        </li>
        </ul>
        <!-- END Datatables Header -->

        <!-- Datatables Content -->
        <div class="block full">
            <div class="block-title">
                <h2><strong>Newsletter</strong> Panel</h2>
            </div>
      <div class="modal-header">    
        <h4 class="modal-title">Send Newsletter</h4>
      </div>

      <form role="form" action="<?php echo base_url('newsLetter/send_news') ?>" method="post" id="createBrandForm">

        <div class="row">
            <div class="form-group">
                <div class="col-md-4 text-center">
                    <label>To</label>
                </div>
                <div class="col-md-4">
                    <input type="radio" id="All" name="userType" value="All" onclick="changeType('All')" checked>All Users
                </div>
                <div class="cols-md-4">
                    <input type="radio" id="Selected" name="userType" value="Selected" onclick="changeType('Selected')">Select Users
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <div class="col-md-4">   </div>
                <div class="col-md-6">   
                    <select name="email[]" id="emailIDs" class="form-control" disabled multiple>
                       <?php foreach ($UsersList as $value) { ?>
                            <option value="<?php $value->user_id ?>"><?php $value->user_id ?></option>
                       <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
          <div class="form-group">
            <div class="col-md-4 text-center">
                <label>Select Newsletter</label>
            </div>
            <div class="col-md-6">
                <select class="form-control" id="NewsletterType" name="NewsletterType">
                  <option value="">Please Select</option>
                  <?php foreach ($NewsList as $list) { ?>
                            <option value="<?php echo $list->id; ?>"><?php echo $list->title; ?></option>
                       <?php } ?>
                </select>
                <!-- <textarea name="description" class="form-control"><?php ?></textarea> -->
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Send</button>
        </div>

      </form>
        </div>
        <!-- END Datatables Content -->
    </div>
    <!-- END Page Content -->
<div id="form-modal-box"></div>
<div id="message_div">
    <span id="close_button"><img src="<?php echo base_url(); ?>backend_asset/images/close.png" onclick="close_message();"></span>
    <div id="message_container"></div>
</div>

<script type="text/javascript">
    function changeType(type) {
        if (type == 'All') {
            $('#All').prop('checked', true);
            $('#emailIDs').prop('disabled', true);
        }else if(type == 'Selected'){
            $('#Selected').prop('checked', true);
            $('#emailIDs').prop('disabled', false);
        }
    }
    $('#emailIDs').select2();
</script>