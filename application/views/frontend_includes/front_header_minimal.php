<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title><?php echo  $page_title  .' | ' . getenv('APP_NAME'); ?></title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
	<meta name="description"  content="Shipments"/>
	<meta name="keywords" content="Shipment, Logistics, Courier, Air Freight, Sea Freight"/>
	<meta name="author"  content="<?php echo getenv('APP_NAME'); ?>"/>
    <meta name="MobileOptimized" content="320"/>
    
	<!-- start theme style -->
	<link rel="stylesheet" type="text/css" href="<?php echo getenv('APP_FRONT_ASSETS_CSS') ?>animate.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo getenv('APP_FRONT_ASSETS_CSS') ?>bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo getenv('APP_FRONT_ASSETS_CSS') ?>font-awesome.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo getenv('APP_FRONT_ASSETS_CSS') ?>fonts.css"/>
    
    <?php
    //Load Styles for Home Page only
    $page_slug = $this->router->fetch_method();
    $current_control = $this->router->fetch_class();
    if($current_control == 'home' && $page_slug == 'index') {
    ?>
	<link rel="stylesheet" type="text/css" href="<?php echo getenv('APP_FRONT_ASSETS_PLUGINS') ?>owl/owl.carousel4.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo getenv('APP_FRONT_ASSETS_PLUGINS') ?>owl/owl.carousel5.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo getenv('APP_FRONT_ASSETS_PLUGINS') ?>owl/owl.carousel6.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo getenv('APP_FRONT_ASSETS_PLUGINS') ?>owl/owl.theme.default.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo getenv('APP_FRONT_ASSETS_PLUGINS') ?>megnific/magnific-popup.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo getenv('APP_FRONT_ASSETS_PLUGINS') ?>rs_slider/layers.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo getenv('APP_FRONT_ASSETS_PLUGINS') ?>rs_slider/navigation.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo getenv('APP_FRONT_ASSETS_PLUGINS') ?>rs_slider/settings.css"/>
    <?php } ?>

    <link rel="stylesheet" href="<?php echo getenv('APP_FRONT_ASSETS_PLUGINS'); ?>toastr/toastr.min.css" >
	<link rel="stylesheet" type="text/css" href="<?php echo getenv('APP_FRONT_ASSETS_CSS') ?>style.css"/>
    <!-- end theme style -->

    <!-- custom css-->
    <link rel="stylesheet" type="text/css" href="<?php echo getenv('APP_FRONT_ASSETS_CSS') ?>custom.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo getenv('APP_FRONT_ASSETS_CSS') ?>loader.css"/>
    
	<!-- favicon links -->
    <link rel="shortcut icon" type="image/icon" href="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>header/favicon.png" />
    
    <!-- Scripts start --> 
    <script type="text/javascript" src="<?php echo getenv('APP_FRONT_ASSETS_JS') ?>jquery.min.js"></script> 
    <script type="text/javascript" src="<?php echo getenv('APP_FRONT_ASSETS_JS') ?>bootstrap.js"></script>
    <script src="<?php echo getenv('APP_FRONT_ASSETS_PLUGINS'); ?>jquery-validation/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?php echo getenv('APP_FRONT_ASSETS_PLUGINS'); ?>toastr/toastr.min.js" ></script>
    <script type="text/javascript" src="<?php echo getenv('APP_FRONT_ASSETS_PLUGINS'); ?>bootbox/bootbox.min.js" ></script>
</head>
<body>
    <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url();?>">
    <!-- preloader Start -->
    <div id="preloader">
        <div id="status">
            <img src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>header/preloader.gif" id="preloader_image" alt="loader">
        </div>
    </div>

    <!-- Header Wrapper Start -->
    <div class="truck_top_header_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="social_icon_wrapper">
                        <div class="social_icon_cont">
                            <p>Follow Us :</p>
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="side_login_wrapper">
                        <div class="side_login_cont">
                            <ul>
                                <li><a href="<?php echo base_url('auth/signup'); ?>">Register</a></li>
                                <li><a href="<?php echo base_url('auth/login'); ?>">Login</a></li>
                            </ul>
                        </div>
                    </div>
                </div>	
            </div>
        </div>
    </div>

    <div class="lv_header_wrapper">
        <div class="lv_img_overlay"></div>
        <div class="lv_top_header_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-12 col-xs-12">
                        <div class="lv_logo">
                            <a href="<?php echo base_url('home'); ?>" class="visible-lg visible-md visible-sm"><img src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>header/logo.png" alt="Logo"></a>
                            <a href="<?php echo base_url('home'); ?>" class="visible-xs tc_mob_logo"><img src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>header/logo.png" alt="Logo"></a>
                            <button class="lv_menu_btn"><i class="fa fa-bars" aria-hidden="true"></i></button>

                                <ul class="visible-xs tc_login_btn_wrapper">
                                    <li class="dropdown tc_login_btn">
                                    <a class="dropdown-toggle hvr-float-shadow active" data-toggle="dropdown" href="#"><i class="fa fa-ellipsis-v"></i></a>
                                    <ul class="dropdown-menu tc_menu_fixed_border">
                                        <li><a href="sign_up.html">Register</a></li>
                                        <li><a href="login.html">Login</a></li>
                                    </ul>
                                    </li>
                                </ul>
                        </div>
                    </div>

                    <div class="col-lg-10 col-md-9 col-sm-12 col-xs-12">
                        <div class="lv_share_info_wrapper">

                            <ul>
                                <li>
                                    <div class="lv_header_icon"><img src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>header/map_icon.png" alt="Map Icon" title="Map Icon"></div>
                                    <p><span>+233 50 403 0404</span><br> Call Us</p>
                                </li>

                                <li>
                                    <div class="lv_header_icon"><img src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>header/whatsapp_icon.png" alt="Map Icon" title="Map Icon"></div>
                                    <p><span> +1  404 543 4422</span><br> Whatsapp Us</p>
                                </li>

                                <li>
                                    <div class="lv_header_icon"><img src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>header/call_icon.png" alt="Call Icon" title="Call Icon"></div>
                                    <p> <span>8th Floor, One Airport Square</span><br> Airport City, Accra, Ghana</p>
                                </li>

                                <li>
                                    <div class="lv_header_icon"><img src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>header/mail_icon.png" alt="Mail Icon" title="Mail Icon"></div>
                                    <p><span>9:00 am - 5:30 pm<br> </span>Monday - Friday</p>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="lv_bottom_header_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="truck_main_menu_wrapper">
                            <div class="row">
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                    <div class="lv_mainmenu_wrapper">
                                        <div class="lv_main_menu_wrapper">
                                            <div class="lv_main_menu lv_single_index_menu">

                                            <ul class="mainMenu">
                                                <li>
                                                <a class="hvr-float-shadow active" href="<?php echo base_url('home'); ?>">Home</a>
                                                </li>
                                                <li><a href="#about-section" class="hvr-float-shadow">About</a></li>
                                                <li><a href="#services-section" class="hvr-float-shadow">Services</a></li>
                                            </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>	
                        </div>	
                    </div>	
                </div>
            </div>
        </div>
    </div>
    <!-- Header Wrapper End -->
    <div class="headerSpace"></div>