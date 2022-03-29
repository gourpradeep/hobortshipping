<!doctype html>
<html lang="en">
   <head>
      <!-- Global site tag (gtag.js) - Google Analytics --> 
      <script async src="https://www.googletagmanager.com/gtag/js?id=G-P6C46KYNYE"></script>
      <script>
         window.dataLayer = window.dataLayer || [];
         function gtag(){dataLayer.push(arguments);}
         gtag('js', new Date());
         
         gtag('config', 'G-P6C46KYNYE');
      </script>
      <meta charset="utf-8"/>
      <?php
         $meta_desc = "Hobort shipping is one of the best international shipping company in Ghana. Our customers are assure of safe and secure handling of all goods.";
         $page_title =   $page_title .' | ' . getenv('APP_NAME');
         switch ($this->router->fetch_method()) {
             case "index":
                 $page_title =  'International Shipping Company in Ghana | ' . getenv('APP_NAME');
                 $meta_title = $page_title;
                 break;
             case "services":
                 $page_title = 'Air Cargo Ghana | International Freight Service | ' . getenv('APP_NAME');
                 $meta_title = $page_title;
                 $meta_desc = "We provides a range of international freight services including sea, air, trucking & more. Learn about our services & contact us today.";
                 break;
             default:
                 $meta_title = $page_title;
         }
         ?>
      <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
      <title><?php echo  $page_title; ?></title>
      <meta name="title" content="<?php echo $meta_title; ?>" />
      <meta name="description" content="<?php echo $meta_desc; ?>" />
      <meta name="keywords" content=" Transportation, Logistics, Trucking, Trucking company, Freight broker, Freight brokerage, 3rd party logistics, Logistics company, Shipping providers, Truckload brokerage, Load Tracking, Door2Door, Door to Door, Door-to-door, Shipping,Expedited shipping, Expedited freight, Fastest Shipping, Quick shipping, Early delivery, Amazon delivery, Ship Amazon, Ghana, Africa shipping, Ship to Ghana, Ship to Africa, Expedited, Expedite, Freight carrier, Carrier, Courier service, Courier, Delivery Services, Air freight, Sea Freight, Hobort shipping, Hobortshipping, Deliveryservice, Dispatching services, Air cargo, Aircargo, Airfreight, Personalshopper, Shopping, Shop, Freightgraffiti, Shipping, Delivery Services, Cargo, Sea cargo, Sea shipping, Airfreight, Logistics, Freight, Orders"/>
      <meta name="author" content="<?php echo getenv('APP_NAME'); ?>"/>
      <!--<meta name="MobileOptimized" content="320"/>-->
      <meta property="og:url" content="<?php echo base_url(); ?>" />
      <meta property="og:image" content="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>header/logo.png" />
      <!-- <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
         <link rel="icon" href="<?php //echo getenv('APP_FRONT_ASSETS_IMAGES') ?>favicon.png" type="image/png">
         - FB OG Tags start -->
      <!--       <meta property="og:type" content="article" />
         -->      <!-- FB OG Tags end -->
      <!-- Bootstrap CSS -->
      <link rel="icon" href="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>favicon.png" type="image/png">
      <link rel="stylesheet" href="<?php echo getenv('APP_FRONT_ASSETS_CSS') ?>bootstrap.min.css">
      <link rel="stylesheet" href="<?php echo getenv('APP_FRONT_ASSETS_CSS') ?>fontawesome.all.min.css">
      <link rel="stylesheet" href="<?php echo getenv('APP_FRONT_ASSETS_CSS') ?>material-design-all.css">
      <link rel="stylesheet" href="<?php echo getenv('APP_FRONT_ASSETS_CSS') ?>animate.min.css">
      <link rel="stylesheet" href="<?php echo getenv('APP_FRONT_ASSETS_CSS') ?>owl.carousel.min.css">
      <link rel="stylesheet" href="<?php echo getenv('APP_FRONT_ASSETS_CSS') ?>owl.theme.default.min.css">
      <link rel="stylesheet" href="<?php echo getenv('APP_FRONT_ASSETS_CSS') ?>select2.min.css">
      <link rel="stylesheet" href="<?php echo getenv('APP_FRONT_ASSETS_CSS') ?>style.css">
      <link rel="stylesheet" href="<?php echo getenv('APP_BACK_ASSETS_CSS'); ?>style.css" type="text/css">
      <link rel="stylesheet" href="<?php echo getenv('APP_FRONT_ASSETS_CSS') ?>custom.css">
      <link rel="stylesheet" href="<?php echo getenv('APP_FRONT_ASSETS_CSS') ?>lightgallery.min.css">
      <link rel="stylesheet" href="<?php echo getenv('APP_FRONT_ASSETS_CSS') ?>responsive.css">
      <!-- data table  -->
      <!-- toster Link -->
      <link rel="stylesheet" href="<?php echo getenv('APP_FRONT_ASSETS_PLUGINS'); ?>toastr/toastr.min.css" >
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="<?php echo getenv('APP_FRONT_ASSETS_JS') ?>jquery-3.3.1.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
      <script src="<?php echo getenv('APP_FRONT_ASSETS_JS') ?>/custom.js"></script>
      <!-- <script type="text/javascript" src="<?php //echo getenv('APP_FRONT_ASSETS_JS') ?>jquery.min.js"></script>  -->
      <script type="text/javascript" src="<?php echo getenv('APP_FRONT_ASSETS_JS') ?>bootstrap.min.js"></script>
      <script type="text/javascript" src="<?php echo getenv('APP_FRONT_ASSETS_PLUGINS'); ?>jquery-validation/jquery.validate.min.js"></script>
      <script type="text/javascript" src="<?php echo getenv('APP_FRONT_ASSETS_PLUGINS'); ?>toastr/toastr.min.js" ></script>
      <script type="text/javascript" src="<?php echo getenv('APP_FRONT_ASSETS_PLUGINS'); ?>bootbox/bootbox.min.js" ></script>
      <!-- Data Tables -->
      <link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
      <link href="https://datatables.net/release-datatables/extensions/Responsive/css/responsive.dataTables.css" rel="stylesheet" type="text/css">
      <link href="https://cdn.datatables.net/fixedheader/3.1.8/css/fixedHeader.bootstrap4.min.css" rel="stylesheet" type="text/css">
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
      <script> 
         /* Common messages */
         var proceed_err = "Please fill required fields before proceeding.",
             err_unknown = "Something went wrong. Please try again.";
      </script>
      <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url();?>">
      <!-- Global site tag (gtag.js) - Google Analytics -->
      <?php if(ENVIRONMENT === 'production') { ?>
      <script async src="https://www.googletagmanager.com/gtag/js?id=UA-175592946-3"></script>
      <script>
         window.dataLayer = window.dataLayer || [];
         function gtag(){dataLayer.push(arguments);}
         gtag('js', new Date());
         
         gtag('config', 'UA-175592946-3');
      </script>
      <?php } ?>
   </head>
   <body>
      <header class="mainHeader">
            <div class="container custom-container">
            <div class="top-header">
               <div class="container custom-container">
                  <ul class="left-info">
                     <li><a href="mailto:support@gmail.com"><i class="far fa-envelope"></i>info@hobortshipping.com</a></li>
                     <li><a href="tel:+1 770 676 6044"><i class="fas fa-phone-volume"></i>+1 770 676 6044</a></li>
                     <li><a href="tel:+1 404 543 4422"><i class="fab fa-whatsapp"></i>+1 404 543 4422</a></li>
                  </ul>
               </div>
            </div>
         </div>
         <nav class="navbar navbar-expand-lg navbar-light bg-light navHeader">
            <div class="container custom-container">
               <a class="navbar-brand" href="<?php echo base_url();?>"><img src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>logo.png"></a>
               <?php if(is_user_logged_in()) { ?>
               <div class="headerIcon">
                  <!-- <div class="profileIc">
                     <a href="<?php echo base_url().'user/update_profile' ;?>">
                     <img src="<?php echo $_SESSION["app_user_sess"]["avatar"] ?>">
                     </a>
                  </div> -->
                  <div class="logoutOption">
                     <a class="logoutBtn" href="<?php echo base_url('auth/signout'); ?>" data-toggle="tooltip" title="" data-original-title="Logout"><i class="fas fa-sign-out-alt btn-icon"></i></a>
                  </div>
               </div>
               <?php } else{?>
               <div class="headerIcon">
                  <div>
                     <a class="btn theme-btn signupBtn ripple" href="<?php echo base_url().'auth/login'?>"><i class="fas fa-sign-in-alt btn-icon mr-1"></i> Log In</a>
                  </div>
               </div>
               <?php }?>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav ml-auto mainMenu">
                     <?php if(is_user_logged_in()) { ?>
                     <!-- <li class="nav-item dropdown"> -->
                     <li class="nav-item">
                     <a class="nav-link <?php  echo (strtolower($this->router->fetch_class()) == "order" && $this->router->fetch_method()=='current_order') ? "active" : "" ?>" href="<?php echo base_url()?>order/current_order">Current Order</a>
                        <!-- <a class="nav-link dropdown-toggle <?php  echo (strtolower($this->router->fetch_class()) == "order" && $this->router->fetch_method()=='current_order' || $this->router->fetch_method()=='concierge_order') ? "active" : "" ?>" data-toggle="dropdown" href="#"> Current Order</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                           <a class="dropdown-item" href="<?php echo base_url()?>order/concierge_order">Concierge Orders</a>
                           <a class="dropdown-item" href="<?php echo base_url()?>order/current_order">Other Orders</a>
                        </div> -->
                     </li>
                     <li class="nav-item">
                        <a class="nav-link <?php  echo (strtolower($this->router->fetch_class()) == "order" && $this->router->fetch_method()=='past_order') ? "active" : "" ?>" href="<?php echo base_url(); ?>order/past_order">Past Order</a>
                     </li>
                     <li class="nav-item">
                        <a href="<?php echo base_url()?>order/create_quote" class="nav-link <?php  echo (strtolower($this->router->fetch_class()) == "order" && $this->router->fetch_method()=='create_quote') ? "active" : "" ?>">Create Quote</a>
                     </li>
                     <li class="nav-item">
                        <a href="<?php echo base_url()?>ticket" class="nav-link <?php  echo (strtolower($this->router->fetch_class()) == "ticket" && $this->router->fetch_method()=='index') ? "active" : "" ?>">Ticket</a>
                     </li>
                     <!-- <li class="nav-item">
                        <a href="<?php echo base_url()?>shipment" class="nav-link <?php  echo (strtolower($this->router->fetch_class()) == "shipment" && $this->router->fetch_method()=='index') ? "active" : "" ?>">Add My Shipment</a>
                     </li> -->
                     <li class="nav-item">
                        <a href="<?php echo base_url().'user/update_profile' ;?>" class="nav-link">Profile</a>
                     </li>
                     <?php }else{?>
                     <li class="nav-item">
                        <a class="nav-link <?php  echo (strtolower($this->router->fetch_class()) == "home" && $this->router->fetch_method()=='index') ? "active" : "" ?>" href="<?php echo base_url()?>">Home</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link <?php  echo (strtolower($this->router->fetch_class()) == "home" && $this->router->fetch_method()=='about') ? "active" : "" ?>" href="<?php echo base_url().'about'?>">About Us</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link <?php  echo (strtolower($this->router->fetch_class()) == "home" && $this->router->fetch_method()=='services') ? "active" : "" ?>" href="<?php echo base_url().'services'?>">Services</a>
                     </li>
                     <!-- <li><a class="nav-link" href="<?php echo base_url().'contact-us'?>">Support</a></li>
                        <li><a  class="nav-link" href="<?php echo base_url();?>">Track Your Shipment</a></li>
                        <li><a  class="nav-link" target="_blank" href="https://ghanafeed.com/from-local-to-global-find-out-about-hobort-shipping-services-the-ghanaian-shipping-company-that-is-shipping-packages-affordably-to-any-part-of-the-world/">News &amp; Media</a></li> -->
                     <?php } ?>
                  </ul>
               </div>
            </div>
         </nav>
      </header>