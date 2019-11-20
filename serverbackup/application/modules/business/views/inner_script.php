<link href="<?php echo base_url(); ?>backend_asset/plugins/select2/select2.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>backend_asset/plugins/select2/select2.js"></script>
<script src="<?php echo base_url() . 'backend_asset/plugins/dataTables/datatablepdf/' ?>dataTables.buttons.min.js"></script>   
<script src="<?php echo base_url() . 'backend_asset/plugins/dataTables/datatablepdf/' ?>buttons.flash.min.js"></script>   
<script src="<?php echo base_url() . 'backend_asset/plugins/dataTables/datatablepdf/' ?>buttons.flash.min.js"></script>   
<script src="<?php echo base_url() . 'backend_asset/plugins/dataTables/datatablepdf/' ?>jszip.min.js"></script>   
<script src="<?php echo base_url() . 'backend_asset/plugins/dataTables/datatablepdf/' ?>pdfmake.min.js"></script>   
<script src="<?php echo base_url() . 'backend_asset/plugins/dataTables/datatablepdf/' ?>vfs_fonts.js"></script>  
<script src="<?php echo base_url() . 'backend_asset/plugins/dataTables/datatablepdf/' ?>buttons.html5.min.js"></script>  
<script src="<?php echo base_url() . 'backend_asset/plugins/dataTables/datatablepdf/' ?>buttons.print.min.js"></script>  
<link href="<?php echo base_url() . 'backend_asset/plugins/dataTables/datatablepdf/' ?>buttons.dataTables.min.css" rel="stylesheet">

<script src="<?php echo base_url() . 'backend_asset/admin/js/' ?>app.js"></script> 
<script>
 App.datatables();
    jQuery('body').on('click', '#submit', function () {

        var form_name = this.form.id;
        if (form_name == '[object HTMLInputElement]')
            form_name = 'editFormAjax';
        $("#" + form_name).validate({
            rules: {
                user_name: "required",
                user_email: {
                    required: true,
                    email: true
                },
                phone_no: {
                    required: true,
//                    minlength: 10,
//                    maxlength: 20,
//                    number: true
                },
                password: {
                    required: true,
                    minlength: 6
                },
                first_name: "required",
                last_name: "required",
                company_name: "required",
                role_id: "required",
                pan_number:"required",
                state: "required",
                date_of_birth:"required",
                pan_card_file:"required",
                id_proof:"required",
                account_number:"required",
                ifsc_code:"required",
                account_file:"required"
            },
            messages: {
                user_name: '<?php echo lang('user_name_validation'); ?>',
                first_name: '<?php echo lang('first_name_validation'); ?>',
                last_name: '<?php echo lang('last_name_validation'); ?>',
                company_name: '<?php echo lang('company_name_validation'); ?>',
                role_id: '<?php echo lang('role_id_validation'); ?>',
                user_email: {
                    required: 'Vendor Email Field is Required',
                    email: '<?php echo lang('user_email_field_validation'); ?>'
                },
                phone_no: {
                    required: '<?php echo lang('phone_number_validation'); ?>',
                },
                password: {
                    required: '<?php echo lang('password_required_validation'); ?>',
                    minlength: '<?php echo lang('password_minlength_validation'); ?>',
                },
                confirm_password: {
                    required: '<?php echo lang('confirm_password_required_validation'); ?>',
                    equalTo: '<?php echo lang('confirm_password_equalto_validation'); ?>',
                    minlength: '<?php echo lang('confirm_password_minlength_validation'); ?>',
                },
                new_password: {
                    minlength: '<?php echo lang('password_minlength_validation'); ?>',
                },
                confirm_password1: {
                    equalTo: '<?php echo lang('confirm_password_equalto_validation'); ?>',
                    minlength: '<?php echo lang('confirm_password_minlength_validation'); ?>',
                },
                
                pan_number: 'PAN Number field is required',
                state:'State field is required',
                date_of_birth: '<?php echo lang('date_of_birth_validation'); ?>',
                pan_card_file:'PAN Card field is required',
                id_proof:"ID Proof field is required",
                account_number:"Account Number field is required",
                ifsc_code:"IFSC Code field is required",
                account_file:"Account File field is required"

            },
            submitHandler: function (form) {
                jQuery(form).ajaxSubmit({
                });
            }
        });
    });
   
  var base_url = '<?php echo base_url() ?>';
    var user_id = $('#uid').val();
    /*matches list*/
    function getReferrals(user_id){
        $("#matches").dataTable().fnDestroy();
        $('#matches').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": base_url + "business/get_referrals_list",
                "dataType": "json",
                "type": "POST",
                "data": {user_id: user_id}
            },
            "columns": [
                {"data": "id"},
                {"data": "userByInvited"},
                {"data": "userInvited"},
                {"data": "invitedDate"},
                {"data": "registerdStatus"},
                {"data": "addCashStatus"},
                {"data": "verifiedStatus"},
                {"data": "appDownload"}
            ],
            "order": [[0, "asc"]],
            "aoColumnDefs": [{
                    "bSortable": false,
                    "aTargets": [0,1,2,3,4,5,6]
                }]

        });
    }
    
    getReferrals(user_id);


    jQuery('body').on('change', '.input_img2', function () {

        var file_name = jQuery(this).val();
        var fileObj = this.files[0];
        var calculatedSize = fileObj.size / (1024 * 1024);
        var split_extension = file_name.split(".");
        var ext = ["jpg", "gif", "png", "jpeg"];
        if (jQuery.inArray(split_extension[1].toLowerCase(), ext) == -1)
        {
            $(this).val(fileObj.value = null);
            //showToaster('error',"You Can Upload Only .jpg, gif, png, jpeg  files !");
            $('.ceo_file_error').html('<?php echo lang('image_upload_error'); ?>');
            return false;
        }
        if (calculatedSize > 1)
        {
            $(this).val(fileObj.value = null);
            //showToaster('error',"File size should be less than 1 MB !");
            $('.ceo_file_error').html(' 1MB');
            return false;
        }
        if (jQuery.inArray(split_extension[1].toLowerCase(), ext) != -1 && calculatedSize < 10)
        {
            $('.ceo_file_error').html('');
            readURL(this);
        }
    });

    jQuery('body').on('change', '.input_img3', function () {

        var file_name = jQuery(this).val();
        var fileObj = this.files[0];
        var calculatedSize = fileObj.size / (1024 * 1024);
        var split_extension = file_name.split(".");
        var ext = ["jpg", "gif", "png", "jpeg"];
        if (jQuery.inArray(split_extension[1].toLowerCase(), ext) == -1)
        {
            $(this).val(fileObj.value = null);
            //showToaster('error',"You Can Upload Only .jpg, gif, png, jpeg  files !");
            $('.ceo_file_error').html('<?php echo lang('image_upload_error'); ?>');
            return false;
        }
        if (calculatedSize > 1)
        {
            $(this).val(fileObj.value = null);
            //showToaster('error',"File size should be less than 1 MB !");
            $('.ceo_file_error').html(' 1MB');
            return false;
        }
        if (jQuery.inArray(split_extension[1].toLowerCase(), ext) != -1 && calculatedSize < 10)
        {
            $('.ceo_file_error').html('');
            readURL(this);
        }
    });


    function changeVendorStatus(id,status) {
    
        var message = "";
        if (status == "Yes") {
            message = "Verified";
        } else if (status == "No") {
            message = "UnVerified";
        }

        bootbox.confirm({
            message: "Do you want to " + message + " it?",
            buttons: {
                confirm: {
                    label: 'Ok',
                    className: '<?php echo THEME_BUTTON; ?>'
                },
                cancel: {
                    label: 'Cancel',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if (result) {
                        $.ajax({
                        url: '<?php echo base_url(); ?>' + "business/updateAccountStatus",
                        type: "post",
                        data: {userId: id, status: status},
                        success: function (data, textStatus, jqXHR) {
                            setTimeout(function() {
                                window.location.reload();
                            }, 1000);
                        }
                    });
                    
                    
                    
                    
                    
//                    $.ajax({
//                        method: "POST",
//                        url: url,
//                        data: {userId: userId, status: status},
//                        dataType: "json",
//                        success: function (response) {
//                            if (response.status == 200) {
//                                setTimeout(function () {
//                                    $("#msg").html("<div class='alert alert-success'>" + response.msg + "</div>");
//                                });
//                                $('.modal-backdrop').remove();
//                                setTimeout(function () {
//                                    $("#panModal").modal('hide');
//                                }, 1000);
//                            } else {
//                                $("#msg").html("<div class='alert alert-danger'>" + response.msg + "</div>");
//                                $('.modal-backdrop').remove();
//                            }
//                        },
//                        error: function (error, ror, r) {
//                            bootbox.alert(error);
//                        },
//                    });
                } else {
                    $('.modal-backdrop').remove();
                }
            }
        });
   
    }


    function readURL(input) {
        var cur = input;
        if (cur.files && cur.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(cur).hide();
                $(cur).next('span:first').hide();
                $(cur).next().next('img').attr('src', e.target.result);
                $(cur).next().next('img').css("display", "block");
                $(cur).next().next().next('span').attr('style', "");
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

      jQuery('body').on('click', '.remove_img', function () {
        var img = jQuery(this).prev()[0];
        var span = jQuery(this).prev().prev()[0];
        var input = jQuery(this).prev().prev().prev()[0];
        jQuery(img).attr('src', '').css("display", "none");
        jQuery(span).css("display", "block");
        jQuery(input).css("display", "inline-block");
        jQuery(this).css("display", "none");
        jQuery(".image_hide").css("display", "block");
        jQuery("#user_image").val("");
    });

    jQuery('body').on('change', '#user_id', function () {
        $("#upper-lavel-box").html("");
    });

    $('#common_datatable_users').dataTable({
        order: [],
//        dom: 'Bfrtip',
//        buttons: [
//            {
//                extend: 'excel',
//                exportOptions: {
//                    columns: [0, 1, 2, 3, 4]
//                }
//            },
//            {
//                extend: 'pdf',
//                exportOptions: {
//                    columns: [0, 1, 2, 3, 4]
//                }
//            }
//        ],
        columnDefs: [{orderable: false, targets: [5]}]
    });

    $('#common_datatable_users_contest').dataTable({
        order: [],
        columnDefs: [{orderable: false, targets: [8]}]
    });

    $('#common_datatable_users_contest_team').dataTable({
        order: [],
        columnDefs: [{orderable: false, targets: [2]}]
    });

    $('#common_datatable_users_contest_joined').dataTable({
        order: [],
        columnDefs: [{orderable: false, targets: [9]}]
    });

    $('#common_datatable_users_team').dataTable({
        order: [],
        columnDefs: [{orderable: false, targets: [4]}]
    });

    function MyTeams(teamId, seriesId) {
        // alert(seriesId);
        $.ajax({
            url: '<?php echo base_url(); ?>' + "users/getTeamPlayers",
            type: "post",
            data: {teamId: teamId, seriesId: seriesId},
            success: function (data, textStatus, jqXHR) {
                $('#players_model_box').html(data);
                $("#commonModal1").modal('show');
            }
        });
    }
    function getPanDetails(userId) {
        $.ajax({
            url: '<?php echo base_url(); ?>' + "users/getPanCard",
            type: "post",
            data: {userId: userId},
            success: function (data, textStatus, jqXHR) {
                $('#form-modal-box').html(data);
                $("#panModal").modal('show');
            }
        });
    }
    function getBankDetails(userId) {
        $.ajax({
            url: '<?php echo base_url(); ?>' + "users/getBankAccount",
            type: "post",
            data: {userId: userId},
            success: function (data, textStatus, jqXHR) {
                $('#form-modal-box').html(data);
                $("#bankModal").modal('show');
            }
        });
    }
    function panCardStatus(userId, status) {
        var message = "";
        if (status == 1) {
            message = "Verified";
        } else if (status == 2) {
            message = "InActive";
        }

        bootbox.confirm({
            message: "Do you want to " + message + " it?",
            buttons: {
                confirm: {
                    label: 'Ok',
                    className: '<?php echo THEME_BUTTON; ?>'
                },
                cancel: {
                    label: 'Cancel',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if (result) {
                    var url = "<?php echo base_url() ?>users/panCardStatus";
                    $.ajax({
                        method: "POST",
                        url: url,
                        data: {userId: userId, status: status},
                        dataType: "json",
                        success: function (response) {
                            if (response.status == 200) {
                                setTimeout(function () {
                                    $("#msg").html("<div class='alert alert-success'>" + response.msg + "</div>");
                                });
                                $('.modal-backdrop').remove();
                                setTimeout(function () {
                                    $("#panModal").modal('hide');
                                }, 1000);
                            } else {
                                $("#msg").html("<div class='alert alert-danger'>" + response.msg + "</div>");
                                $('.modal-backdrop').remove();
                            }
                        },
                        error: function (error, ror, r) {
                            bootbox.alert(error);
                        },
                    });
                } else {
                    $('.modal-backdrop').remove();
                }
            }
        });
    }
    function bankStatus(userId, status) {
        var message = "";
        if (status == 1) {
            message = "Verified";
        } else if (status == 2) {
            message = "InActive";
        }

        bootbox.confirm({
            message: "Do you want to " + message + " it?",
            buttons: {
                confirm: {
                    label: 'Ok',
                    className: '<?php echo THEME_BUTTON; ?>'
                },
                cancel: {
                    label: 'Cancel',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if (result) {
                    var url = "<?php echo base_url() ?>users/bankAccountStatus";
                    $.ajax({
                        method: "POST",
                        url: url,
                        data: {userId: userId, status: status},
                        dataType: "json",
                        success: function (response) {
                            if (response.status == 200) {
                                setTimeout(function () {
                                    $("#msg").html("<div class='alert alert-success'>" + response.msg + "</div>");
                                });
                                $('.modal-backdrop').remove();
                                setTimeout(function () {
                                    $("#bankModal").modal('hide');
                                }, 1000);
                            } else {
                                $("#msg").html("<div class='alert alert-danger'>" + response.msg + "</div>");
                                $('.modal-backdrop').remove();
                            }
                        },
                        error: function (error, ror, r) {
                            bootbox.alert(error);
                        },
                    });
                } else {
                    $('.modal-backdrop').remove();
                }
            }
        });
    }
      function aadharCardStatus(userId, status) {
        var message = "";
        if (status == 1) {
            message = "Verified";
        } else if (status == 2) {
            message = "InActive";
        }else if(status == 3){
            message = "Cancel";
        }


        bootbox.confirm({
            message: "Do you want to " + message + " it?",
            buttons: {
                confirm: {
                    label: 'Ok',
                    className: '<?php echo THEME_BUTTON; ?>'
                },
                cancel: {
                    label: 'Cancel',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if (result) {
                    var url = "<?php echo base_url() ?>users/aadharCardStatus";
                    $.ajax({
                        method: "POST",
                        url: url,
                        data: {userId: userId, status: status},
                        dataType: "json",
                        success: function (response) {
                            if (response.status == 200) {
                                setTimeout(function () {
                                    $("#msg").html("<div class='alert alert-success'>" + response.msg + "</div>");
                                });
                                $('.modal-backdrop').remove();
                                setTimeout(function () {
                                    $("#aadharModal").modal('hide');
                                }, 1000);
                            } else {
                                $("#msg").html("<div class='alert alert-danger'>" + response.msg + "</div>");
                                $('.modal-backdrop').remove();
                            }
                        },
                        error: function (error, ror, r) {
                            bootbox.alert(error);
                        },
                    });
                } else {
                    $('.modal-backdrop').remove();
                }
            }
        });
    }
 function getAadharCardDetails(userId) {
        $.ajax({
            url: '<?php echo base_url(); ?>' + "users/getAadharCard",
            type: "post",
            data: {userId: userId},
            success: function (data, textStatus, jqXHR) {
                $('#form-modal-box').html(data);
                $("#aadharModal").modal('show');
            }
        });
    }
    function getRankWinners(contestId) {
        var url = "<?php echo base_url() ?>users/getRankWinners";
        $.ajax({
            method: "POST",
            url: url,
            data: {contestId: contestId},
            success: function (response) {
                $("#form-modal-box").html(response);
                $("#rankWinners").modal('show');
            },
            error: function (error, ror, r) {
                bootbox.alert(error);
            },
        });
    }

     var open_modal_referral = function (controller) {
        $.ajax({
            url: '<?php echo base_url(); ?>' + controller + "/send_referrals_model",
            type: 'POST',
            data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'},
            success: function (data, textStatus, jqXHR) {

                $('#form-modal-box').html(data);
                $("#commonModal").modal('show');


            }
        });
    }
 $('#common_datatable_affiliate_list').dataTable({
        order: [],
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0,1, 2, 3, 4,5,6,7,8,9]
                }
            },
            {
                // extend: 'pdf',
                // exportOptions: {
                //     columns: [0,1, 2, 3, 4,5,6,7,8,9,10]
                // }
                  extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'A4'
            },

            {
                extend: 'print',
                exportOptions: {
                    columns: [0,1, 2, 3, 4,5,6,7,8,9]
                }
            }

        ],
        //columnDefs: [{orderable: false, targets: [5, 6]}]
    }); 
  $('#common_datatable_new_reg').dataTable({
        order: [],
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0,1, 2, 3, 4,5,6,7,8,9]
                }
            },
            {
                // extend: 'pdf',
                // exportOptions: {
                //     columns: [0,1, 2, 3, 4,5,6,7,8,9]
                // }
                  extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'A4'
            },

            {
                extend: 'print',
                exportOptions: {
                    columns: [0,1, 2, 3, 4,5,6,7,8,9]
                }
            }

        ],
        //columnDefs: [{orderable: false, targets: [5, 6]}]
    });
     $('#common_datatable_referral_bonus').dataTable({
        order: [],
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0,1, 2, 3, 4,5,6,7,8,9,10]
                }
            },
            {
                // extend: 'pdf',
                // exportOptions: {
                //     columns: [0,1, 2, 3, 4,5,6,7,8]
                // }
                  extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'A4'
            },

            {
                extend: 'print',
                exportOptions: {
                    columns: [0,1, 2, 3, 4,5,6,7,8,9,10]
                }
            }

        ],
        //columnDefs: [{orderable: false, targets: [5, 6]}]
    });

     $('#from_date').datepicker({
                startView: 3,
                todayBtn: "linked",
                format: "mm/dd/yyyy",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                //startDate: '-0d',
                // endDate: '+2m',
            });

            $('#to_date').datepicker({
                startView: 3,
                format: "mm/dd/yyyy",
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                //startDate: '-0d',
                //endDate: '+2m',
            });


             function getPanDetails(userId) {
        $.ajax({
            url: '<?php echo base_url(); ?>' + "business/getPanCard",
            type: "post",
            data: {userId: userId},
            success: function (data, textStatus, jqXHR) {
                $('#form-modal-box').html(data);
                $("#panModal").modal('show');
            }
        });
    }
</script>


