<div class="container-fluid">

    <div class="page-title-box box-spacing">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h4 class="page-title">Dashboard</h4>
                <ol class="breadcrumb">
                    <!-- <li class="breadcrumb-item active">Welcome to Hobort</li> -->
                </ol>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card mini-stat bg-primary text-white">
                <div class="card-body box-body">
                    <div class="mb-4 dashboard-option">
                        <div class="float-left mini-stat-img mr-4 user-icon">
                            <img src="<?php echo getenv('APP_BACK_ASSETS_IMAGES'); ?>services-icon/cutomer.png" alt="" >
                        </div>
                        <h5 class="font-16 text-uppercase mt-0 text-white-50">Customers</h5>
                        <h4 class="font-500"><?php echo $customer; ?></h4>
                    </div>

                    <div class="">
                        <div class="float-right">
                            <a href="<?php echo admin_url('customer'); ?>" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                        </div>
                        <p class="text-white-50 mb-0">View Details</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- stat box-1 start -->
        <div class="col-xl-3 col-md-6">
            <div class="card mini-stat bg-primary text-white dashboard-box">
                <div class="card-body box-body">
                    <div class="mb-4 dashboard-option">
                        <div class="float-left mini-stat-img mr-4 user-icon">
                            <img src="<?php echo getenv('APP_BACK_ASSETS_IMAGES'); ?>services-icon/item_type.png" alt="" >
                        </div>
                        <h5 class="font-16 text-uppercase mt-0 text-white-50">      Air Freight</h5>
                        <h4 class="font-500"><?php echo $air_freight; ?></h4>
                    </div>

                    <div class="">
                        <div class="float-right">
                            <a href="<?php echo admin_url('service/air_freight'); ?>" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                        </div>
                        <p class="text-white-50 mb-0">View Details</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- stat box-1 end -->

        <!-- stat box-2 start -->
        <div class="col-xl-3 col-md-6">
            <div class="card mini-stat bg-primary text-white">
                <div class="card-body box-body">
                    <div class="mb-4 dashboard-option">
                        <div class="float-left mini-stat-img mr-4 user-icon">
                            <img src="<?php echo getenv('APP_BACK_ASSETS_IMAGES'); ?>services-icon/sea_freight.png" alt="" >
                        </div>
                        <h5 class="font-16 text-uppercase mt-0 text-white-50">      Sea Freight </h5>
                        <h4 class="font-500"><?php echo $sea_freight; ?></h4>
                    </div>

                    <div class="">
                        <div class="float-right">
                            <a href="<?php echo admin_url('service/sea_freight'); ?>" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                        </div>
                        <p class="text-white-50 mb-0">View Details</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- stat box-2 end -->

        <!-- stat box-3 start -->
        <div class="col-xl-3 col-md-6">
            <div class="card mini-stat bg-primary text-white">
                <div class="card-body box-body">
                    <div class="mb-4 dashboard-option">
                        <div class="float-left mini-stat-img mr-4 user-icon">
                            <img src="<?php echo getenv('APP_BACK_ASSETS_IMAGES'); ?>services-icon/new_order.png" alt="" >
                        </div>
                        <h5 class="font-16 text-uppercase mt-0 text-white-50">New Orders</h5>
                        <h4 class="font-500"><?php echo $new_order; ?></h4>
                    </div>

                    <div class="">
                        <div class="float-right">
                            <a href="<?php echo admin_url('order/new_orders'); ?>" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                        </div>
                        <p class="text-white-50 mb-0">View Details</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- stat box-3 end -->

        <!-- stat box-4 start -->
        <!-- <div class="col-xl-3 col-md-6">
            <br>
            <div class="card mini-stat bg-primary text-white">
                <div class="card-body box-body">
                    <div class="mb-4 dashboard-option">
                        <div class="float-left mini-stat-img mr-4 user-icon">
                            <img src="<?php echo getenv('APP_BACK_ASSETS_IMAGES'); ?>services-icon/item_type.png" alt="" >
                        </div>
                        <h5 class="font-16 text-uppercase mt-0 text-white-50"       >Item Type (Air Freight)</h5>
                        <h4 class="font-500"><?php echo $air_freight_item; ?></h4>
                    </div>

                    <div class="">
                        <div class="float-right">
                            <a href="<?php echo admin_url('item/item_type'); ?>" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                        </div>
                        <p class="text-white-50 mb-0">View Details</p>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- <div class="col-xl-3 col-md-6">
            <div class="card mini-stat bg-primary text-white">
                <div class="card-body box-body">
                    <div class="mb-4 dashboard-option">
                        <div class="float-left mini-stat-img mr-4 user-icon">
                            <img src="<?php echo getenv('APP_BACK_ASSETS_IMAGES'); ?>services-icon/concierge_quotes.png" alt="" >
                        </div>
                        <h5 class="font-16 text-uppercase mt-0 text-white-50">New Concierge Quote </h5>
                        <h4 class="font-500"><?php echo $new_quote; ?></h4>
                    </div>

                    <div class="">
                        <div class="float-right">
                            <a href="<?php echo admin_url('new_quote_concierge_shipping'); ?>" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                        </div>
                        <p class="text-white-50 mb-0">View Details</p>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- stat box-5 end -->
        <!-- <div class="col-xl-3 col-md-6">
            <br>
            <div class="card mini-stat bg-primary text-white">
                <div class="card-body box-body">
                    <div class="mb-4 dashboard-option">
                        <div class="float-left mini-stat-img mr-4 user-icon">
                            <img src="<?php echo getenv('APP_BACK_ASSETS_IMAGES'); ?>services-icon/courier_service.png" alt="" >
                        </div>
                        <h5 class="font-16 text-uppercase mt-0 text-white-50">      Courier Service </h5>
                        <h4 class="font-500"><?php echo $courier_service; ?></h4>
                    </div>

                    <div class="">
                        <div class="float-right">
                            <a href="<?php echo admin_url('service/courier_express_services'); ?>" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                        </div>
                        <p class="text-white-50 mb-0">View Details</p>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="col-xl-3 col-md-6">
            <br>
            <div class="card mini-stat bg-primary text-white dashboard-box">
                <div class="card-body box-body">
                    <div class="mb-4 dashboard-option">
                        <div class="float-left mini-stat-img mr-4 user-icon">
                            <img src="<?php echo getenv('APP_BACK_ASSETS_IMAGES'); ?>services-icon/courier_service.png" alt="" >
                        </div>
                        <h5 class="font-16 text-uppercase mt-0 text-white-50">     My Shipment Request</h5>
                        <h4 class="font-500"><?php echo $my_shipment; ?></h4>
                    </div>

                    <div class="">
                        <div class="float-right">
                            <a href="<?php echo admin_url('shipment'); ?>" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                        </div>
                        <p class="text-white-50 mb-0">View Details</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <br>
            <div class="card mini-stat bg-primary text-white">
                <div class="card-body box-body">
                    <div class="mb-4 dashboard-option">
                        <div class="float-left mini-stat-img mr-4 user-icon">
                            <img src="<?php echo getenv('APP_BACK_ASSETS_IMAGES'); ?>services-icon/new_order.png" alt="" >
                        </div>
                        <h5 class="font-16 text-uppercase mt-0 text-white-50">Pending Orders</h5>
                        <h4 class="font-500"><?php echo $pending_orders; ?></h4>
                    </div>

                    <div class="">
                        <div class="float-right">
                            <a href="<?php echo admin_url('order/pending_orders'); ?>" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                        </div>
                        <p class="text-white-50 mb-0">View Details</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <br>
            <div class="card mini-stat bg-primary text-white">
                <div class="card-body box-body">
                    <div class="mb-4 dashboard-option">
                        <div class="float-left mini-stat-img mr-4 user-icon">
                            <img src="<?php echo getenv('APP_BACK_ASSETS_IMAGES'); ?>services-icon/completed_order.png" alt="" >
                        </div>
                        <h5 class="font-16 text-uppercase mt-0 text-white-50">Completed Orders </h5>
                        <h4 class="font-500"><?php echo $completed_orders; ?></h4>
                    </div>

                    <div class="">
                        <div class="float-right">
                            <a href="<?php echo admin_url('order/completed_orders'); ?>" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                        </div>
                        <p class="text-white-50 mb-0">View Details</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

</div>
<!-- container-fluid end -->