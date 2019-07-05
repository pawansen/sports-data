<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title><?php echo getConfig('site_name'); ?> | <?php
            if (!empty($title) && isset($title)): echo ucwords($title);
            endif;
            ?></title>

        <meta name="description" content="ProUI is a Responsive Bootstrap Admin Template created by pixelcave and published on Themeforest.">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="<?php echo base_url(); ?>backend_asset/admin/img/favicon.png">
        <link rel="apple-touch-icon" href="<?php echo base_url(); ?>backend_asset/admin/img/icon57.png" sizes="57x57">
        <link rel="apple-touch-icon" href="<?php echo base_url(); ?>backend_asset/admin/img/icon72.png" sizes="72x72">
        <link rel="apple-touch-icon" href="<?php echo base_url(); ?>backend_asset/admin/img/icon76.png" sizes="76x76">
        <link rel="apple-touch-icon" href="<?php echo base_url(); ?>backend_asset/admin/img/icon114.png" sizes="114x114">
        <link rel="apple-touch-icon" href="<?php echo base_url(); ?>backend_asset/admin/img/icon120.png" sizes="120x120">
        <link rel="apple-touch-icon" href="<?php echo base_url(); ?>backend_asset/admin/img/icon144.png" sizes="144x144">
        <link rel="apple-touch-icon" href="<?php echo base_url(); ?>backend_asset/admin/img/icon152.png" sizes="152x152">
        <link rel="apple-touch-icon" href="<?php echo base_url(); ?>backend_asset/admin/img/icon180.png" sizes="180x180">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Bootstrap is included in its original form, unaltered -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend_asset/admin/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.css">


        <!-- Related styles of various icon packs and plugins -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend_asset/admin/css/plugins.css">

        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend_asset/admin/css/main.css">

        <!-- Include a specific file here from css/themes/ folder to alter the default theme of the template -->

        <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend_asset/admin/css/themes.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend_asset/admin/css/themes/fancy.css">
        <link href="<?php echo base_url(); ?>backend_asset/css/plugins/toastr/toastr.min.css" rel="stylesheet">
        <!-- END Stylesheets -->

        <!-- Modernizr (browser feature detection library) -->
        <script src="<?php echo base_url(); ?>backend_asset/admin/js/vendor/modernizr.min.js"></script>
        <script src="<?php echo base_url(); ?>backend_asset/admin/js/vendor/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.js"></script>
    </head>
    <body>
        <div id="page-wrapper">

            <div class="preloader themed-background">
                <h1 class="push-top-bottom text-light text-center"><strong>Pro</strong>UI</h1>
                <div class="inner">
                    <h3 class="text-light visible-lt-ie10"><strong>Loading..</strong></h3>
                    <div class="preloader-spinner hidden-lt-ie10"></div>
                </div>
            </div>

            <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations style-alt">
                <!-- Alternative Sidebar -->
                <!-- END Alternative Sidebar -->

                <!-- Main Sidebar -->
                <div id="sidebar">
                    <!-- Wrapper for scrolling functionality -->
                    <div id="sidebar-scroll">
                        <!-- Sidebar Content -->
                        <div class="sidebar-content">
                            <!-- Brand -->
                            <a href="index.html" class="sidebar-brand">
                                <i class="gi gi-flash"></i><span class="sidebar-nav-mini-hide"><strong>Admin </strong><?php echo getConfig('site_name');?></span>
                            </a>
                            <!-- END Brand -->

                            <!-- User Info -->
                            <div class="sidebar-section sidebar-user clearfix sidebar-nav-mini-hide">
                                <div class="sidebar-user-avatar">
                                    <a href="page_ready_user_profile.html">
                                        <img src="<?php echo base_url() . getConfig('site_logo'); ?>" alt="avatar">
                                    </a>
                                </div>
                                <div class="sidebar-user-name"> <?php
                                                $user = getUser($this->session->userdata('user_id'));
                                                if (!empty($user)) {
                                                    echo ucwords($user->first_name . " " . $user->last_name);
                                                }
                                                ?></div>
                                <div class="sidebar-user-links">
                                    <!-- <a href="page_ready_user_profile.html" data-toggle="tooltip" data-placement="bottom" title="Profile"><i class="gi gi-user"></i></a>
                                    <a href="page_ready_inbox.html" data-toggle="tooltip" data-placement="bottom" title="Messages"><i class="gi gi-envelope"></i></a> -->
                                    <!-- Opens the user settings modal that can be found at the bottom of each page (page_footer.html in PHP version) -->
                                    <!-- <a href="javascript:void(0)" class="enable-tooltip" data-placement="bottom" title="Settings" onclick="$('#modal-user-settings').modal('show');"><i class="gi gi-cogwheel"></i></a> -->
                                    <a href="javascript:void(0)" onclick="logout()" data-toggle="tooltip" data-placement="bottom" title="Logout"><i class="gi gi-exit"></i></a>
                                </div>
                            </div>
                            <!-- END User Info -->

                            <!-- Sidebar Navigation -->
                            <ul class="sidebar-nav">
                                <li>
                                    <a href="<?php echo site_url('pwfpanel') ?>" class=" <?php echo (strtolower($this->router->fetch_class()) == "pwfpanel") ? "active" : "" ?>"><i class="gi gi-stopwatch sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Dashboard</span></a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('users'); ?>" class="<?php echo (strtolower($this->router->fetch_class()) == "users" || strpos($parent, "UA") !== false || strpos($parent, "UH") !== false) ? "active" : "" ?>"><i class="gi gi-user sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Users</span></a>
                                </li>              

                                <li>
                                    <a href="<?php echo site_url('vendors')."/index/No"; ?>" class=" <?php echo (strtolower($this->router->fetch_class()) == "vendors") ? "active" : "" ?>"><i class="gi gi-user sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Vendor</span></a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('business')."/index/No"; ?>" class=" <?php echo (strtolower($this->router->fetch_class()) == "business") ? "active" : "" ?>"><i class="gi gi-user sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Vendor Business Profile</span></a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('enquiries'); ?>" class=" <?php echo (strtolower($this->router->fetch_class()) == "enquiries") ? "active" : "" ?>"><i class="gi gi-user sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Enquiries</span></a>
                                </li>
                                <li class="sidebar-header">
                                    <span class="sidebar-header-options clearfix"><a href="javascript:void(0)" data-toggle="tooltip" title="Quick Settings"><i class="gi gi-settings"></i></a><a href="javascript:void(0)" data-toggle="tooltip" title="Create the most amazing pages with the widget kit!"><i class="gi gi-lightbulb"></i></a></span>
                                    <span class="sidebar-header-title">Widget Kit</span>
                                </li>
                                <li title="Banner">
                                    <a href="<?php echo site_url('banner'); ?>" class=" <?php echo (strtolower($this->router->fetch_class()) == "banner") ? "active" : "" ?>"><i class="gi gi-show_big_thumbnails sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Banner</span></a>
                                </li>
                                 <li title="CMS">
                                    <a href="<?php echo site_url('cms'); ?>" class=" <?php echo (strtolower($this->router->fetch_class()) == "cms") ? "active" : "" ?>"><i class="gi gi-charts sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">CMS</span></a>
                                </li>
                              
                                <li title="Email Template">
                                    <a href="<?php echo site_url('emailTemplate'); ?>" class=" <?php echo (strtolower($this->router->fetch_class()) == "emailTemplate") ? "active" : "" ?>"><i class="gi gi-envelope sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Email Template</span></a>
                                </li>
                                <li title="Newsletter">
                                    <a href="<?php echo site_url('newsLetter'); ?>" class=" <?php echo (strtolower($this->router->fetch_class()) == "newsLetter") ? "active" : "" ?>"><i class="gi gi-envelope sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Newsletter</span></a>
                                </li>
                                <li title="Category">
                                    <a href="<?php echo site_url('menuCategory'); ?>" class=" <?php echo (strtolower($this->router->fetch_class()) == "menuCategory") ? "active" : "" ?>"><i class="gi gi-charts sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Software Category</span></a>
                                </li>
                                <li title="Partners">
                                    <a href="<?php echo site_url('partners'); ?>" class=" <?php echo (strtolower($this->router->fetch_class()) == "partners") ? "active" : "" ?>"><i class="gi gi-user sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Manage Partners</span></a>
                                </li>
                                <li title="Services">
                                    <a href="<?php echo site_url('services'); ?>" class=" <?php echo (strtolower($this->router->fetch_class()) == "services") ? "active" : "" ?>"><i class="gi gi-charts sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Services</span></a>
                                </li>
                                <li title="How It Works">
                                    <a href="<?php echo site_url('howItWorks'); ?>" class=" <?php echo (strtolower($this->router->fetch_class()) == "howItWorks") ? "active" : "" ?>"><i class="gi gi-charts sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">How It Works</span></a>
                                </li>
                                <li title="Testimonials">
                                    <a href="<?php echo site_url('testimonial'); ?>" class=" <?php echo (strtolower($this->router->fetch_class()) == "testimonial") ? "active" : "" ?>"><i class="gi gi-charts sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Testimonials</span></a>
                                </li>
                                <li title="Contact Us">
                                    <a href="<?php echo site_url('contestUs'); ?>" class=" <?php echo (strtolower($this->router->fetch_class()) == "contestUs") ? "active" : "" ?>"><i class="gi gi-charts sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Contact Us</span></a>
                                </li>
                                <li title="Client Request">
                                    <a href="<?php echo site_url('clientRequest'); ?>" class=" <?php echo (strtolower($this->router->fetch_class()) == "clientRequest") ? "active" : "" ?>"><i class="gi gi-charts sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Client Request</span></a>
                                </li>
                                 <li title="setting">
                                    <a href="<?php echo site_url('setting'); ?>" class=" <?php echo (strtolower($this->router->fetch_class()) == "setting") ? "active" : "" ?>"><i class="gi gi-charts sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Setting</span></a>
                                </li>
                            </ul>
                            <!-- END Sidebar Navigation -->
                        </div>
                        <!-- END Sidebar Content -->
                    </div>
                    <!-- END Wrapper for scrolling functionality -->
                </div>
                <!-- END Main Sidebar -->

                <!-- Main Container -->
                <div id="main-container">

                    <header class="navbar navbar-default">
                        <!-- Left Header Navigation -->
                        <ul class="nav navbar-nav-custom">
                            <!-- Main Sidebar Toggle Button -->
                            <li>
                                <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');this.blur();">
                                    <i class="fa fa-bars fa-fw"></i>
                                </a>
                            </li>
                            <!-- END Main Sidebar Toggle Button -->

                            <!-- Template Options -->
                            <!-- Change Options functionality can be found in js/app.js - templateOptions() -->
                            <!-- <li class="dropdown">
                                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="gi gi-settings"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-custom dropdown-options">
                                    <li class="dropdown-header text-center">Header Style</li>
                                    <li>
                                        <div class="btn-group btn-group-justified btn-group-sm">
                                            <a href="javascript:void(0)" class="btn btn-primary" id="options-header-default">Light</a>
                                            <a href="javascript:void(0)" class="btn btn-primary" id="options-header-inverse">Dark</a>
                                        </div>
                                    </li>
                                    <li class="dropdown-header text-center">Page Style</li>
                                    <li>
                                        <div class="btn-group btn-group-justified btn-group-sm">
                                            <a href="javascript:void(0)" class="btn btn-primary" id="options-main-style">Default</a>
                                            <a href="javascript:void(0)" class="btn btn-primary" id="options-main-style-alt">Alternative</a>
                                        </div>
                                    </li>
                                </ul>
                            </li> -->
                            <!-- END Template Options -->
                        </ul>
                        <!-- END Left Header Navigation -->

                        <!-- Search Form -->
                        <!-- <form action="page_ready_search_results.html" method="post" class="navbar-form-custom">
                            <div class="form-group">
                                <input type="text" id="top-search" name="top-search" class="form-control" placeholder="Search..">
                            </div>
                        </form> -->
                        <!-- END Search Form -->

                        <!-- Right Header Navigation -->
                        <ul class="nav navbar-nav-custom pull-right">
                            <!-- Alternative Sidebar Toggle Button -->
<!--                            <li>
                                 If you do not want the main sidebar to open when the alternative sidebar is closed, just remove the second parameter: App.sidebar('toggle-sidebar-alt'); 
                                <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar-alt', 'toggle-other');this.blur();">
                                    <i class="gi gi-share_alt"></i>
                                    <span class="label label-primary label-indicator animation-floating">4</span>
                                </a>
                            </li>-->
                            <!-- END Alternative Sidebar Toggle Button -->

                            <!-- User Dropdown -->
                            <li class="dropdown">
                                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo base_url() . getConfig('site_logo'); ?>" alt="avatar"> <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                                    <li class="dropdown-header text-center">Account</li>
                                    <!-- <li>
                                        <a href="page_ready_timeline.html">
                                            <i class="fa fa-clock-o fa-fw pull-right"></i>
                                            <span class="badge pull-right">10</span>
                                            Updates
                                        </a>
                                        <a href="page_ready_inbox.html">
                                            <i class="fa fa-envelope-o fa-fw pull-right"></i>
                                            <span class="badge pull-right">5</span>
                                            Messages
                                        </a>
                                        <a href="page_ready_pricing_tables.html"><i class="fa fa-magnet fa-fw pull-right"></i>
                                            <span class="badge pull-right">3</span>
                                            Subscriptions
                                        </a>
                                        <a href="page_ready_faq.html"><i class="fa fa-question fa-fw pull-right"></i>
                                            <span class="badge pull-right">11</span>
                                            FAQ
                                        </a>
                                    </li> -->
                                    <!-- <li class="divider"></li> -->
                                    <li>
                                        <!-- <a href="page_ready_user_profile.html">
                                            <i class="fa fa-user fa-fw pull-right"></i>
                                            Profile
                                        </a> -->
                                        <!-- Opens the user settings modal that can be found at the bottom of each page (page_footer.html in PHP version) -->
                                        <a href="#modal-user-settings" data-toggle="modal">
                                            <i class="fa fa-cog fa-fw pull-right"></i>
                                            Change Password
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <!-- <a href="page_ready_lock_screen.html"><i class="fa fa-lock fa-fw pull-right"></i> Lock Account</a> -->
                                        <a href="javascript:void(0)" onclick="logout()"><i class="fa fa-ban fa-fw pull-right"></i> Logout</a>
                                    </li>
<!--                                    <li class="dropdown-header text-center">Activity</li>
                                    <li>
                                        <div class="alert alert-success alert-alt">
                                            <small>5 min ago</small><br>
                                            <i class="fa fa-thumbs-up fa-fw"></i> You had a new sale ($10)
                                        </div>
                                        <div class="alert alert-info alert-alt">
                                            <small>10 min ago</small><br>
                                            <i class="fa fa-arrow-up fa-fw"></i> Upgraded to Pro plan
                                        </div>
                                        <div class="alert alert-warning alert-alt">
                                            <small>3 hours ago</small><br>
                                            <i class="fa fa-exclamation fa-fw"></i> Running low on space<br><strong>18GB in use</strong> 2GB left
                                        </div>
                                        <div class="alert alert-danger alert-alt">
                                            <small>Yesterday</small><br>
                                            <i class="fa fa-bug fa-fw"></i> <a href="javascript:void(0)" class="alert-link">New bug submitted</a>
                                        </div>
                                    </li>-->
                                </ul>
                            </li>
                            <!-- END User Dropdown -->
                        </ul>
                        <!-- END Right Header Navigation -->
                    </header>
                    <!-- END Header -->