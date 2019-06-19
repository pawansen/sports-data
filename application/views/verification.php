<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="format-detection" content="telephone=no">
    <meta charset="UTF-8">
    <meta name="description" content="<?php echo getConfig('site_meta_description'); ?>">
    <meta name="keywords" content="<?php echo getConfig('site_meta_title'); ?>">
    <title><?php echo getConfig('site_name'); ?> User Verification</title>
    <link rel="shortcut icon" type="image/ico" href="<?php echo base_url(); ?>backend_asset/images/favicon.ico"/>
    <link rel="shortcut icon" type="image/ico" href="<?php echo base_url(); ?>backend_asset/images/favicon.ico"/>
</head>
<body class="login-content" style="background-color: #ccc; text-align: center">
    <!-- Login -->
    <div class="lc-block toggled" id="l-login">
        <form id="login_form">
            <div class="lcb-float"><img src="<?php echo base_url() . getConfig('site_logo'); ?>"></div>
            <strong style="font-size: 15px;"><?php echo $this->session->flashdata('user_verify'); ?></strong>
        </form>
    </div>
</body>
</html>