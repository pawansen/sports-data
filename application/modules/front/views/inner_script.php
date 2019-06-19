
<script src="<?php echo base_url(); ?>backend_asset/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>front_assets/js/jquery.dataTables.min.js"></script>
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
                company_name:"required"
            },
            messages: {
                company_name: "Company Name field is required",
                description: "description field is required",
                website: "Company website field is required",
                category: "Software category field is required",
                address: "Company address field is required",
                city: "city field is required",
                country: "country field is required",
                state: "state field is required"
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
        email: "required"
    },
    messages: {
        first_name: "First Name field is required",
        last_name: "Last name field is required",
        phone: "phone field is required",
        email: "Email field is required",
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
    },
    messages: {
        old_password: "Old password field is required",
        new_password: "New password field is required",
        c_password: {
                    required: '<?php echo lang('confirm_password_required_validation'); ?>',
                    equalTo: '<?php echo lang('confirm_password_equalto_validation'); ?>'
                },
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
        rq_email:{
                    required: true,
                    email: true
                },
        rq_licenses: "required",
        rq_software_categories: "required",
        rq_expected_live: "required",
        rq_solution_offering: "required",
        description: "required"
    },
    messages: {
        rq_email: "Email field is required",
        rq_licenses: "No. of licenses field is required",
        rq_software_categories: "Software category field is required",
        rq_expected_live: "Expected go live field is required",
        rq_solution_offering: "Expected contract term field is required",
        description: "Description field is required",
        rq_email: "Email field is required"
    },
    submitHandler: function (form) {
        jQuery(form).ajaxSubmit({
        });
    }
});
});

function setValueName(name){
    $("#is_request_draft").val(name);
}


$(document).ready(function () {
$('#dtVerticalScrollExample').DataTable({
"scrollY": "320px",
"scrollCollapse": true,
});
$('.dataTables_length').addClass('bs-select');
});

function getDetails(id){
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

function getVendorListKeyword(keyword){
    $.ajax({
            url: '<?php echo base_url(); ?>' + "front/vendors_list",
            type: "post",
            data: {keyword: keyword},
            success: function (data, textStatus, jqXHR) {
                $('#client_box_all').html(data);
            }
        });
}

function getVendorListCountry(keyword){
    $.ajax({
            url: '<?php echo base_url(); ?>' + "front/vendors_list",
            type: "post",
            data: {country: keyword},
            success: function (data, textStatus, jqXHR) {
                $('#client_box_all').html(data);
            }
        });
}

function getVendorListSoftware(keyword){
    $.ajax({
            url: '<?php echo base_url(); ?>' + "front/vendors_list",
            type: "post",
            data: {software: keyword},
            success: function (data, textStatus, jqXHR) {
                $('#client_box_all').html(data);
            }
        });  
}

</script>