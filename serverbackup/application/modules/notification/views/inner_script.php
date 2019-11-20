<script>

    function getNotification(){
        $("#notification").dataTable().fnDestroy();
        $('#notification').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": '<?php echo base_url();?>' + "notification/get_notification_list",
                "dataType": "json",
                "type": "POST",
            },
            "columns": [
                {"data": "id"},
                {"data": "user"},
                {"data": "message"},
                {"data": "sent_time"},
                {"data": "action"},
            ],
            "order": [[3, "desc"]],
            "aoColumnDefs": [{
                    "bSortable": false,
                    "aTargets": [0,1]
                }]

        });
    }
    getNotification();
</script>

