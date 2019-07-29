<!DOCTYPE html>
<html lang="en"> 
<head>
	<title><?php echo $title;?></title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="keywords" content="key, words">	
	<meta name="description" content="Website description">
	<meta name="robots" content="noindex, nofollow"><!-- change into index, follow -->
	<!-- Mobile Specific Metas ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- CSS ================================================== -->
    <link href="<?php echo base_url(); ?>front_assets/css/font-awesome.css" rel="stylesheet" type="text/css" media="all" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>front_assets/css/master.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>front_assets/css/responsive.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>front_assets/css/intlTelInput.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>front_assets/css/owl.carousel.min.css">
	
    
</head>

<body>

<!--  / wrapper \ -->
<section id="wrapper">
	
	<!--  *** main container *** -->
	<section id="mainCntr">
		
		<!--  *** header container *** -->
		<header id="headerCntr">


            <!--  *** menu box *** -->
            <nav class="menuBox navbar navbar-fixed-top">
                <div class="container">

                    <div class="navbar-header">

                        <!-- <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                         -->
                        <a href="#<?php //echo base_url()."front/client_search" ?>" class="navbar-brand logo_text"><h3> Vendors</h3></a>

                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                    
                        <?php if($this->ion_auth->is_user()){
                            if($this->session->userdata('email_verify')){?>


                            <div class="navbar-right deshbord">
                            
                        <div class="dropdown deshbord_menu_width_icon">

                            <a class="btn btn-default" style="margin-top: 19px;" href="<?php echo base_url()."front/client_search" ?>" >Search Vendors</a>

							  <button class="btn  dropdown-toggle dashboard_btn" type="button" data-toggle="dropdown"><i class="fa fa-tachometer" aria-hidden="true"></i>Dashboard 
							  <span class="caret"></span></button>
							  <ul class="dropdown-menu">
							     <li><a href="<?php echo base_url().'front/user_dashbaord';?>">Personal details</a></li>
							    <!--<li><a href="client-enquiries.html">Enquiries</a></li>-->
							    <li class="dropdown_1">
							    <a href="javascript:void(0)" class="dropbtn1">Enquiries <i class="fa fa-sort-desc"></i></a>
							    <div class="dropdown-content">
							      <a href="<?php echo base_url().'front/client_enquiries_draft';?>"> Draft</a>
							      <a href="<?php echo base_url().'front/client_enquiries';?>"> Submitted</a>
							     
							    </div>
							  </li>
                            <li><a href="<?php echo base_url().'front/clientAdminRequest';?>">Request Admin</a></li>
                            <li><a href="<?php echo base_url().'front/client_partnership_documents';?>">Partnership Documents</a></li>
                            <li><a href="<?php echo base_url()."front/logout";?>">Logout </a></li>
                        </ul>
                        </div>
                                                
                            </div>
                            <?php }else{?>
                                <div class="navbar-right deshbord">
                        <div class="dropdown deshbord_menu_width_icon">
							  <button class="btn  dropdown-toggle dashboard_btn" type="button" data-toggle="dropdown"><i class="fa fa-tachometer" aria-hidden="true"></i>Dashboard 
							  <span class="caret"></span></button>
							  <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url()."front/logout";?>">Logout </a></li>
                        </ul>
                        </div>
                                                
                            </div>
                            <?php }?>
                        <?php }else if($this->ion_auth->is_vendor()){
                            if($this->session->userdata('email_verify')){?>
                            <div class="navbar-right deshbord">
                        <div class="dropdown deshbord_menu_width_icon">
                          <button class="btn  dropdown-toggle dashboard_btn" type="button" data-toggle="dropdown"><i class="fa fa-tachometer" aria-hidden="true"></i>Dashboard 
                          <span class="caret"></span></button>
                          <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url().'front/vendor_dashbaord';?>">Business Profile</a></li>
                            <li><a href="<?php echo base_url().'front/vendor_profile';?>">Personal details</a></li>
                            <li><a href="<?php echo base_url().'front/account_setting';?>">Account settings</a></li>
                            <li><a href="<?php echo base_url().'front/vendor_enquires';?>">Enquiries</a></li>
                            <li><a href="<?php echo base_url().'front/partnership_document';?>">Partnership Documents</a></li>
                            <li><a href="<?php echo base_url()."front/logout";?>">Logout </a></li>
                            
                          </ul>
                          
                        </div>
                          <!-- <button type="submit" class="btn ">dashboard</button> -->
                       </div>

                       <?php }else{?>
                        <div class="navbar-right deshbord">
                        <div class="dropdown deshbord_menu_width_icon">
                          <button class="btn  dropdown-toggle dashboard_btn" type="button" data-toggle="dropdown"><i class="fa fa-tachometer" aria-hidden="true"></i>Dashboard 
                          <span class="caret"></span></button>
                          <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url()."front/logout";?>">Logout </a></li>
                            
                          </ul>
                          
                        </div>
                          <!-- <button type="submit" class="btn ">dashboard</button> -->
                       </div>
                        <?php }?>
                       <?php }else{?>
                            <ul class="nav navbar-nav navbar-right">
                            <li><a href="<?php echo base_url();?>">Home</a></li>
                            <li><a href="<?php echo base_url().'front/about_us';?>">About us</a></li>
                            <li><a href="<?php echo base_url().'front/how_to_works';?>">How It Works</a></li>
                            <li><a href="<?php echo base_url().'front/services';?>">Service</a></li>
                            <li><a href="<?php echo base_url().'front/our_partners';?>">Our Partners</a></li>
                            <li><a href="<?php echo base_url().'front/contact_us';?>">Contact us</a></li>
                            <li><a href="<?php echo base_url().'front/login'?>">Register/Login</a></li>
                        </ul>
                        <?php }?>
                       

                    </div>

                </div>
            </nav>
            <!--  *** menu box ** -->

		</header>

		<!--  *** header container *** -->