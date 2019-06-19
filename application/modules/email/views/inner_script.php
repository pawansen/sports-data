<script>

    function usersList($check) {
        if($check == "0"){
            $('#user_ids').prop('disabled', true);
        }else{
            $('#user_ids').prop('disabled', false);
        }
    }

</script>

<script src="<?php echo base_url(); ?>backend_asset/js/select2.js"></script>
<link href="<?php echo base_url(); ?>backend_asset/css/select2.css" rel="stylesheet"/>