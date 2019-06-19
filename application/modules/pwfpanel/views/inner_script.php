<!-- <link href="<?php echo base_url(); ?>backend_asset/plugins/select2/select2.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>backend_asset/plugins/select2/select2.js"></script>
<script src="<?php echo base_url() . 'backend_asset/plugins/dataTables/datatablepdf/' ?>dataTables.buttons.min.js"></script>   
<script src="<?php echo base_url() . 'backend_asset/plugins/dataTables/datatablepdf/' ?>buttons.flash.min.js"></script>   
<script src="<?php echo base_url() . 'backend_asset/plugins/dataTables/datatablepdf/' ?>buttons.flash.min.js"></script>   
<script src="<?php echo base_url() . 'backend_asset/plugins/dataTables/datatablepdf/' ?>jszip.min.js"></script>   
<script src="<?php echo base_url() . 'backend_asset/plugins/dataTables/datatablepdf/' ?>pdfmake.min.js"></script>   
<script src="<?php echo base_url() . 'backend_asset/plugins/dataTables/datatablepdf/' ?>vfs_fonts.js"></script>  
<script src="<?php echo base_url() . 'backend_asset/plugins/dataTables/datatablepdf/' ?>buttons.html5.min.js"></script>  
<script src="<?php echo base_url() . 'backend_asset/plugins/dataTables/datatablepdf/' ?>buttons.print.min.js"></script>  
<link href="<?php echo base_url() . 'backend_asset/plugins/dataTables/datatablepdf/' ?>buttons.dataTables.min.css" rel="stylesheet"> -->
<script src="<?php echo base_url() . 'backend_asset/admin/js/' ?>app.js"></script> 
<script>
    // $('#common_datatable_subAdmin').dataTable({});
        $('#common_datatable_orders').dataTable({
        order: [],
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                exportOptions: {
                    columns: [1,2,3,4,5,6,7,8,9,10,11,12,13,14]
                }
            }
        ],
        columnDefs: [{orderable: false, targets: [5, 6]}]
    });
    function getStatus(status){
        $("#status_name").html(status.options[status.selectedIndex].text);
    }

    
</script>