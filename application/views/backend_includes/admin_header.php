
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title><?php echo $page_title; ?> | <?php echo getenv('APP_NAME'); ?>- Admin</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="<?php echo getenv('APP_NAME'); ?>" name="author" />
        
        <!-- Styles  -->
        <link href="<?php echo getenv('APP_BACK_ASSETS_CSS'); ?>bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo getenv('APP_BACK_ASSETS_CSS'); ?>metismenu.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo getenv('APP_BACK_ASSETS_CSS'); ?>icons.css" rel="stylesheet" type="text/css">

        <!-- DataTables -->
        <link href="<?php echo getenv('APP_BACK_ASSETS_PLUGINS'); ?>datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo getenv('APP_BACK_ASSETS_PLUGINS'); ?>datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="<?php echo getenv('APP_BACK_ASSETS_PLUGINS'); ?>datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />


        <link href="<?php echo getenv('APP_BACK_ASSETS_CSS'); ?>style.css" rel="stylesheet" type="text/css">
        <link href="<?php echo getenv('APP_BACK_ASSETS_PLUGINS'); ?>toastr/toastr.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo getenv('APP_BACK_ASSETS_CUSTOM_CSS'); ?>admin_common.css">

        <!-- fancybox gallery -->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

        <!-- favicon -->
        <link rel="shortcut icon" type="image/icon" href="<?php echo getenv('APP_BACK_ASSETS_IMAGES'); ?>favicon.png" />
        <?php 
        if(!empty($admin_css)) { load_css($admin_css); } //load required page styles
        ?>

        <!-- Scripts  -->
        <script src="<?php echo getenv('APP_BACK_ASSETS_JS'); ?>jquery.min.js"></script>
        <script src="<?php echo getenv('APP_BACK_ASSETS_JS'); ?>bootstrap.bundle.min.js"></script>
        <script src="<?php echo getenv('APP_BACK_ASSETS_JS'); ?>metisMenu.min.js"></script>
        <script src="<?php echo getenv('APP_BACK_ASSETS_JS'); ?>jquery.slimscroll.js"></script>
        <script src="<?php echo getenv('APP_BACK_ASSETS_JS'); ?>waves.min.js"></script>

        <!-- Required datatable js -->
        <script src="<?php echo getenv('APP_BACK_ASSETS_PLUGINS'); ?>datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo getenv('APP_BACK_ASSETS_PLUGINS'); ?>datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="<?php echo getenv('APP_BACK_ASSETS_PLUGINS'); ?>datatables/dataTables.buttons.min.js"></script>
        <script src="<?php echo getenv('APP_BACK_ASSETS_PLUGINS'); ?>datatables/buttons.bootstrap4.min.js"></script>

        <!-- Responsive examples -->
        <script src="<?php echo getenv('APP_BACK_ASSETS_PLUGINS'); ?>datatables/dataTables.responsive.min.js"></script>
        <script src="<?php echo getenv('APP_BACK_ASSETS_PLUGINS'); ?>datatables/responsive.bootstrap4.min.js"></script>

        <!-- <script src="<?php echo getenv('APP_BACK_ASSETS_PLUGINS'); ?>dashboard.js"></script> -->
        <script src="<?php echo getenv('APP_BACK_ASSETS_PLUGINS'); ?>jquery-validation/jquery.validate.min.js"></script>
        <script src="<?php echo getenv('APP_BACK_ASSETS_PLUGINS'); ?>toastr/toastr.min.js" type="text/javascript"></script>
        <script src="<?php echo getenv('APP_BACK_ASSETS_PLUGINS'); ?>bootbox/bootbox.min.js" type="text/javascript"></script>

        <?php 
        if(!empty($admin_scripts)) { load_js($admin_scripts); } //load required page scripts
        ?>
        <script>
            var base_url = "<?php echo admin_url(); ?>";
        </script>
    </head>

    <body id="admin_main_body" data-base-url="<?php echo admin_url(); ?>">

        <!-- Begin page -->
        <!-- Warpper Start -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="<?php echo admin_url(); ?>" class="logo">
                        <span>
                            <img src="<?php echo getenv('APP_BACK_ASSETS');?>images/hobortshipping_medium_logo.png" alt="" height="40">
                        </span>
                        <i>
                            <img src="<?php echo getenv('APP_BACK_ASSETS');?>images/favicon-2.png" alt="" height="30">
                        </i>
                    </a>
                </div>

                <nav class="navbar-custom">
                    <ul class="navbar-right list-inline float-right mb-0">
                        <li class="dropdown notification-list list-inline-item">

                            <div class="dropdown notification-list nav-pro-img">

                                <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <?php 
                                    if(!empty($_SESSION[ADMIN_USER_SESS_KEY]['avatar'])){
                                        $url = getenv('ADMIN_PROFILE_DIR').$_SESSION[ADMIN_USER_SESS_KEY]['avatar'];
                                    }
                                    else{
                                        $url = getenv('S3_USER_PLACEHOLDER_AVATAR');
                                    }
                                ?>
                                
                                
                                <img src="<?php echo $url?>" alt="user" class="rounded-circle">

                                </a>

                                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">

                                    <!-- item-->

                                    <a class="dropdown-item" href="<?php echo admin_url('admin_profile')?>"><i class="mdi mdi-account-circle m-r-5"></i> Profile</a>

                                    <!-- <a class="dropdown-item" href="#"><i class="mdi mdi-wallet m-r-5"></i> My Wallet</a>

                                    <a class="dropdown-item d-block" href="#"><span class="badge badge-success float-right">11</span><i class="mdi mdi-settings m-r-5"></i> Settings</a>

                                    <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline m-r-5"></i> Lock screen</a> -->

                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item text-danger" href="<?php echo admin_url('logout')?>"><i class="mdi mdi-power text-danger"></i> Logout</a>

                                </div>

                            </div>

                        </li>
                    </ul>

                    <ul class="list-inline menu-left mb-0">

                        <li class="float-left">
                            <button class="button-menu-mobile open-left waves-effect">
                                <i class="mdi mdi-menu"></i>
                            </button>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- Top Bar End -->

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="slimscroll-menu" id="remove-scroll">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <!-- Left Menu Start -->
                        <ul class="metismenu" id="side-menu">
                            <li>
                                <a href="<?php echo admin_url('dashboard'); ?>" class="waves-effect">
                                    <i class="ti-home"></i><span> Dashboard </span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo admin_url('customer'); ?>" class="waves-effect"><i class="fa fa-user"></i><span> Customers </span></a>
                            </li>
                            <!-- <li>
                                <a href="<?php echo admin_url('shipment'); ?>" class="waves-effect"><i class="typcn typcn-th-list-outline"></i><span>My Shipment Request </span></a>
                            </li> -->
                            <!-- <li>
                                <a href="<?php echo admin_url('new_quote_concierge_shipping'); ?>" class="waves-effect"><i class="typcn typcn-th-list-outline"></i><span> New  Concierge Quote</span></a>
                            </li> -->
                            <li>
                                <a href="<?php echo admin_url('ticket')?>" class="waves-effect"><i class="typcn typcn-th-list-outline"></i><span> Ticket </span></a>
                            </li>
                            
                            <li>
                                <a href="<?php echo admin_url('order/new_orders'); ?>" class="waves-effect"><i class="typcn typcn-th-list-outline"></i><span> New Orders </span></a>
                            </li>
                            
                            <li>
                                <a href="<?php echo admin_url('order/pending_orders'); ?>" class="waves-effect"><i class="fas fa-history"></i><span> Pending Orders </span></a>
                            </li>
                            <li>
                                <a href="<?php echo admin_url('order/completed_orders'); ?>" class="waves-effect"><i class="far fa-list-alt"></i><span> Completed Orders </span></a>
                            </li>
                            <!-- <li>
                                <a href="<?php echo admin_url('item/item_type')?>" class="waves-effect"><i class="far fa-list-alt"></i><span> Item Type (Air Freight) </span></a>
                            </li> -->
                            <li class="">
                            <a href="<?php echo admin_url('service/sea_freight')?>" class="waves-effect"><i class="far fa-list-alt"></i><span> Sea Freight </span></a>
                                <!-- <a href="#" class="waves-effect" aria-expanded="false"><i class="ti-layers-alt"></i><span> Services <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>

                                <ul class="submenu mm-collapse" style="height: 0px;">
                                    <li><a href="<?php echo admin_url('service/air_freight')?>">Air Freight</a></li>
                                    <li><a href="<?php echo admin_url('service/sea_freight')?>">Sea Freight</a></li>
                                    <li><a href="<?php echo admin_url('service/courier_express_services')?>">Courier & Express Services</a></li>
                                </ul> -->
                            </li>
                             <li class="">
                                <a href="#" class="waves-effect" aria-expanded="false"><i class="fa fa-book"></i><span> Content <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>

                                <ul class="submenu mm-collapse" style="height: 0px;">
                                    <li><a href="<?php echo admin_url('termsctrl')?>">Terms & Conditions</a></li>

                                    <li><a href="<?php echo admin_url('privacyctrl')?>">Privacy Policy</a></li>
                                </ul>
                            </li>
 
                        </ul>
                    </div>
                    <!-- Sidebar -->

                    <div class="clearfix"></div>
                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">

                <!-- Start content -->
                <div class="content">