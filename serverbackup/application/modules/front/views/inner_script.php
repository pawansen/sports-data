
<script src="<?php echo base_url(); ?>backend_asset/js/jquery.validate.min.js"></script>
<script>
    jQuery('body').on('click', '#submit', function () {

        var form_name = this.form.id;
        if (form_name == '[object HTMLInputElement]')
            form_name = 'editFormAjax';
        $("#editFormAjax").validate({
            rules: {
                description: "required",
                website: "required",
                category: "required",
                address: "required",
                city: "required",
                country: "required",
                state: "required",
                company_name: "required"
            }, errorPlacement: function (error, element) {
                var name = $(element).attr("name");
                error.appendTo($("#" + name + "_validate"));
            },
            messages: {
                company_name: "This field is required",
                description: "This field is required",
                website: "This field is required",
                category: "This field is required",
                address: "This field is required",
                city: "This field is required",
                country: "This field is required",
                state: "This field is required"
            },
            submitHandler: function (form) {
                jQuery(form).ajaxSubmit({
                });
            }
        });
    });

    jQuery('body').on('click', '#profile_submit', function () {

        var form_name = this.form.id;
        if (form_name == '[object HTMLInputElement]')
            form_name = 'editFormAjaxProfile';
        $("#editFormAjaxProfile").validate({
            rules: {
                first_name: "required",
                last_name: "required",
                phone: {
                    required: true,
                    minlength: 10,
                    maxlength: 20,
                    number: true
                },
                email: "required",
                phone_code: "required"
            }, errorPlacement: function (error, element) {
                var name = $(element).attr("name");
                error.appendTo($("#" + name + "_validate"));
            },
            messages: {
                first_name: "This field is required",
                last_name: "This field is required",
                phone: "This field is required",
                email: "This field is required",
                phone_code: "This field is required",
            },
            submitHandler: function (form) {
                jQuery(form).ajaxSubmit({
                });
            }
        });
    });



    jQuery('body').on('click', '.save_btn_enquiries_form', function () {

        var form_name = this.form.id;
        if (form_name == '[object HTMLInputElement]')
            form_name = 'editFormAjaxinquiry';
        $("#editFormAjaxinquiry").validate({
            rules: {
                rq_email: {
                    required: true,
                    email: true
                },
                rq_licenses: "required",
                rq_software_categories: "required",
                rq_expected_live: "required",
                rq_solution_offering: "required",
                description: "required"
            }, errorPlacement: function (error, element) {
                var name = $(element).attr("name");
                error.appendTo($("#" + name + "_validate"));
            },
            messages: {
                rq_email: "This field is required",
                rq_licenses: "This field is required",
                rq_software_categories: "This field is required",
                rq_expected_live: "This field is required",
                rq_solution_offering: "This field is required",
                description: "This field is required",
                rq_email: "This field is required"
            },
            submitHandler: function (form) {
                jQuery(form).ajaxSubmit({
                });
            }
        });
    });
    jQuery('body').on('click', '#change_password', function () {

        var form_name = this.form.id;
        if (form_name == '[object HTMLInputElement]')
            form_name = 'editFormAjaxPasswprd';
        $("#editFormAjaxPasswprd").validate({
            rules: {
                old_password: "required",
                new_password: "required",
                c_password: {
                    required: true,
                    equalTo: "#new_password"
                },
            }, errorPlacement: function (error, element) {
                var name = $(element).attr("name");
                error.appendTo($("#" + name + "_validate"));
            },
            messages: {
                old_password: "This field is required",
                new_password: "This field is required",
                c_password: {
                    required: 'This field is required'
                },
            },
            submitHandler: function (form) {
                jQuery(form).ajaxSubmit({
                });
            }
        });
    });

    jQuery('body').on('click', '#rsetbtn', function () {

        var form_name = this.form.id;
        if (form_name == '[object HTMLInputElement]')
            form_name = 'resetPassword';
        $("#resetPassword").validate({
            rules: {
                new : "required",
                new_confirm: {
                    required: true,
                    equalTo: "#new"
                },
            }, errorPlacement: function (error, element) {
                var name = $(element).attr("name");
                error.appendTo($("#" + name + "_validate"));
            },
            messages: {
                new : "This field is required",
                new_confirm: {
                    required: 'This field is required'
                },
            },
            submitHandler: function (form) {
                jQuery(form).ajaxSubmit({
                });
            }
        });
    });
</script>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<!-- <script src="<?php echo base_url(); ?>backend_asset/js/select2.js"></script> -->
<!-- <script src="<?php echo base_url(); ?>front_assets/js/intlTelInput.js"></script> -->
<!-- <link href="<?php echo base_url(); ?>backend_asset/css/select2.css" rel="stylesheet"/> -->
<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>front_assets/css/intlTelInput.css"> -->

<script src="<?php echo base_url(); ?>front_assets/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>front_assets/css/bootstrap-multiselect.css">
<script>
    $('.select2-list').multiselect({
        buttonWidth: '390px',
        buttonClass: 'input-field-select',
        nonSelectedText: 'Select Software Categories'
    });
    $('.select2-list-inner').multiselect({
        buttonWidth: '293px',
        buttonClass: 'input-field-select',
        nonSelectedText: 'Select Software Categories'
    });


    function setValueName(name) {
        $("#is_request_draft").val(name);
    }

    // $('#dtVerticalScrollExampless').dataTable();
//    // $(document).ready(function () {
    $('#dtVerticalScrollExampless').DataTable(
            {"searching": false, "info": false, "bLengthChange": false,
                "bFilter": true, }
    // "scrollY": "320px",
    // "scrollCollapse": true,
    );
    $('.dataTables_length').addClass('bs-select');
//    // });

    function getDetails(id) {
        $.ajax({
            url: '<?php echo base_url(); ?>' + "front/get_enquiries_detail",
            type: "post",
            data: {id: id},
            success: function (data, textStatus, jqXHR) {
                $('#model_profile').html(data);
                $("#myModal").modal('show');
            }
        });
    }

    function getStates(id) {
        $.ajax({
            url: '<?php echo base_url(); ?>' + "front/getStates",
            type: "post",
            data: {id: id},
            success: function (data, textStatus, jqXHR) {
                $('#stats').html(data);
            }
        });
    }

    function getVendorListKeyword() {
        var software = $("#software_categories_search").val();
        var keyword = $("#keyword_search").val();
        var limit = 20;
        var offset = limit * 1;
        $.ajax({
            url: '<?php //echo base_url();   ?>' + "front/vendors_list",
            type: "post",
            data: {keyword: keyword, software: software, limit: limit, offset: offset},
            success: function (data, textStatus, jqXHR) {
                $('#client_box_all').append(data);
            }
        });
    }



    function getVendorListCountry(keyword) {
        var keywordsearch = $("#keywordsearch").val();
        var software = $("#software_categories").val();
        $.ajax({
            url: '<?php echo base_url(); ?>' + "front/vendors_list",
            type: "post",
            data: {country: keyword, software: software, keyword: keywordsearch},
            success: function (data, textStatus, jqXHR) {
                $('#client_box_all').html(data);
            }
        });
    }

    function getVendorListSoftware(keyword) {
        var country = $("#country").val();
        var keywordsearch = $("#keywordsearch").val();
        $.ajax({
            url: '<?php echo base_url(); ?>' + "front/vendors_list",
            type: "post",
            data: {software: keyword, country: country, keyword: keywordsearch},
            success: function (data, textStatus, jqXHR) {
                $('#client_box_all').html(data);
            }
        });
    }

    function resendEmailVerification() {
        $("#verificationemail").text("Sending...");
        $.ajax({
            url: '<?php echo base_url(); ?>' + "front/resendEmailVerification",
            type: "post",
            success: function (data, textStatus, jqXHR) {
                if (data == 1) {
                    $("#verificationemail").text("Resend Email Verification");
                    alert("Successfully email verification sent");
                } else {
                    $("#verificationemail").text("Resend Email Verification");
                    alert("Email already verified");
                }
            }
        });
    }

    function subscribe() {
        var email = $("#check_id").val();
        var isChecked = document.getElementById("check_id").checked;
        var status = "No";
        if (isChecked) {
            status = "Yes";
        }
        $.ajax({
            url: '<?php echo base_url(); ?>' + "front/news_subscribe",
            type: "post",
            data: {status: status},
            success: function (data, textStatus, jqXHR) {
                if (status == "Yes") {
                    alert("Successfully Subscribed.");
                } else {
                    alert("Successfully UnSubscribed.");
                }

            }
        });
    }

</script>