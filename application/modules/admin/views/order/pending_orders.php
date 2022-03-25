<?php 
   $header_images = getenv('APP_FRONT_ASSETS_IMAGES') . 'header';
   $content_images = getenv('APP_FRONT_ASSETS_IMAGES') . 'content';
   ?>
<!-- Start content -->

<div class="content">
    <div class="container-fluid">

        <div class="page-title-box box-spacing">

            <div class="row align-items-center">

                

                <div class="col-sm-6">

                    <h4 class="page-title">Pending Orders</h4>

                    <ol class="breadcrumb">

                        <!-- <li class="breadcrumb-item active">Welcome to Hobort</li> -->

                    </ol>



                </div>

            </div>

        </div>

        <!-- end row -->



        <div class="">

            <div class="customer-info">

                <div class="customer-detail">

                    <!-- <div class="customer-header">

                        <div class="2">

                            <h5>Customer Info</h5>

                            <div class="wrapper-customer">

                                <div class="media customer-data">

                                <img class="mr-3 image-size-1" src="assets/images/users/user-1.jpg" alt="Generic placeholder image">

                                <div class="media-body customer-body">

                                    <h5 class="mt-0 mr-3">Yoseph Mullins <span class="active-text ml-2"><i class="active-icon typcn typcn-media-record"></i> Active</span></h5>

                                    

                                    <h6>yoshep24@gmail.com</h6>

                                    <h6>408-588-9764</h6>

                                </div>

                                </div>

                                <div class="Commission-data">

                                    <h6>Total Commission :<span class="ml-2"> $110.00</span></h6>

                                </div>

                                <div class="bank-info">

                                    <h5>Admin commission (in %)</h5>

                                    <input type="text" name="" value="50">

                                    <span class="edit-icon"><a href="#"><i class=" fas fa-edit "></i></a></span>

                                </div>

                            </div>

                        </div>

                        

                    </div> -->

                    <div class="row">



                        <!-- <div class="col-lg-12 col-12">

                            <div class="vehicle-info-data wallet-info cstmr-info">

                                <div class="media customer-img">

                                <img class="" src="assets/images/users/user-1.jpg">

                                <div class="media-body mt-4 ml-3 cstmr-text">

                                    <h6 class="mt-0">Joseph Mullins</h6>

                                    <p>josephmullins@gmailcom</p>

                                </div>

                                </div>

                            </div>

                        </div> -->



                        <div class="col-lg-12 col-12">



                            

                            <div class="">

                                <div class="customer-info">

                                    <!-- <div class="row">

                                        <div class="col-lg-6 col-6">

                                            <ul class="nav nav-pills mb-3 nav-tabbar mt-3" id="pills-tab" role="tablist">

                                            <li class="nav-item nav-btns nav-li">

                                                <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Orders</a>

                                            </li>

                                            </ul>

                                        </div>

                                        <div class="col-lg-6 col-6">

                                            <div class="select float-right  mb-0 mt-3 mr-4 ml-3">

                                            <select name="slct" id="slct">

                                                <option selected disabled>Status</option>

                                                <option value="1">Completed</option>

                                                <option value="2">Pending</option>

                                                <option value="3">Cancel</option>

                                            </select>

                                            </div>



                                            <div class="float-right">

                                                <div class="search-box mt-3 mr-5">

                                                <input class="search-txt" type="text" name="" placeholder="Type to search">

                                                <a class="search-btn" href="#"><i class="fas fa-search"></i></a>

                                                </div>

                                            </div>

                                        </div>

                                    </div> -->

                                        <div class="tab-content" id="pills-tabContent">



                                            <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

                                                <div class="row">

                                                    <div class="col-lg-12 col-12">

                                                        <div class="row">

                                                            <div class="col-lg-6 col-6">

                                                                <div class="search-bar">
                                                                    <form class="search-container">
                                                                        <input type="text" id="search-bar" placeholder="Search by ticket id">
                                                                        <a href="#"><img class="search-icon" src="http://www.endlessicons.com/wp-content/uploads/2012/12/search-icon.png"></a>
                                                                    </form>
                                                                </div>

                                                            </div>

                                                            <div class="col-lg-6 col-6">

                                                                <div class="select float-right  mb-3 mt-3 mr-4 ml-3">

                                                                <select name="slct" id="slct">

                                                                    <option selected disabled>Status</option>

                                                                    <option value="1">Shipped by customer</option>

                                                                    <option value="2"> Received from customer </option>

                                                                    <option value="3">Packed</option>

                                                                    <option value="3">On the way</option>

                                                                    <option value="3">Deliverd</option>

                                                                </select>

                                                                </div>


                                                            </div>

                                                        </div>

                                                        <div class="table-responsive">

                                                            <table class="table csTable table-spacing">

                                                                <thead class="thead-spacing">

                                                                    <tr>

                                                                    <th>S.No.</th>

                                                                    <th>Tracking ID</th>

                                                                    <th>Service Type</th>

                                                                    <th class="">Amount</th>

                                                                    <th>Date & Time</th>

                                                                    <!-- <th>Distance</th> -->

                                                                    <th>Status</th>

                                                                    <th class="text-right">Action</th>

                                                                    </tr>

                                                                </thead>

                                                                <tbody>

                                                                    <tr>

                                                                        <td>1</td>

                                                                        <td scope="row">#2095868734</td>

                                                                        <td>Add My Shipment</td>

                                                                        <td class="">$25.00</td>

                                                                        <td class="">28 April 2020, 10:45 AM</td>

                                                                        <!-- <td class="">6 km</td> -->

                                                                        <td class="inactive pending">Package Received at our warehouse</td>

                                                                        <td class="text-right">

                                                                            <div class="dropdown show dropdown-btn">

                                                                            <a class="btn btn-secondary dropdown-toggle drop-btn" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                                                                Select

                                                                            </a>



                                                                            <div class="dropdown-menu btn-bg" aria-labelledby="dropdownMenuLink">

                                                                                <a class="dropdown-item" href="pending-order-detail.html">View</a>

                                                                                <a class="dropdown-item" href="" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Change Status</a>

                                                                                <!-- <a class="dropdown-item" href="">Approve</a> -->

                                                                            </div>

                                                                            </div>

                                                                        </td>

                                                                    </tr>

                                                                    <tr>

                                                                        <td>2</td>

                                                                        <td scope="row">#2095868734</td>

                                                                        <td>Air Freight</td>

                                                                        <td class="">$25.00</td>

                                                                        <td class="">28 April 2020, 10:45 AM</td>

                                                                        <!-- <td class="">5 km</td> -->

                                                                        <td class="active-icon-approve">Shipped By Customer</td>

                                                                        <td class="text-right">

                                                                            <div class="dropdown show dropdown-btn">

                                                                            <a class="btn btn-secondary dropdown-toggle drop-btn" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                                                                Select

                                                                            </a>



                                                                            <div class="dropdown-menu btn-bg" aria-labelledby="dropdownMenuLink">

                                                                                <a class="dropdown-item" href="pending-order-detail.html">View</a>

                                                                                <a class="dropdown-item" href="" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Change Status</a>

                                                                                

                                                                                <!-- <a class="dropdown-item" href="">Approve</a> -->

                                                                            </div>

                                                                            </div>

                                                                        </td>

                                                                    </tr>



                                                                    <tr>

                                                                        <td>3</td>

                                                                        <td scope="row">#2095868734</td>

                                                                        <td>Sea Freight</td>

                                                                        <td class="">$25.00</td>

                                                                        <td class="">28 April 2020, 10:45 AM</td>

                                                                        <!-- <td class="">1 km</td></td> -->

                                                                        <td class="inactive">Shipment dropped off at Atlanta Airport</td>

                                                                        <td class="text-right">

                                                                            <div class="dropdown show dropdown-btn">

                                                                            <a class="btn btn-secondary dropdown-toggle drop-btn" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                                                                Select

                                                                            </a>



                                                                            <div class="dropdown-menu btn-bg" aria-labelledby="dropdownMenuLink">

                                                                                <a class="dropdown-item" href="pending-order-detail.html">View</a>

                                                                                <a class="dropdown-item" href="" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Change Status</a>

                                                                                <!-- <a class="dropdown-item" href="">Approve</a> -->

                                                                            </div>

                                                                            </div>

                                                                        </td>

                                                                    </tr>



                                                                    <tr>

                                                                        <td>4</td>

                                                                        <td scope="row">#2095868734</td>

                                                                        <td>Concierge Shopping</td>

                                                                        <td class="">$25.00</td>

                                                                        <td class="">28 April 2020, 10:45 AM</td>

                                                                        <!-- <td class="">2 km</td></td> -->

                                                                        <td class="active-icon-approve">Shipped By Customer</td>

                                                                        <td class="text-right">

                                                                            <div class="dropdown show dropdown-btn">

                                                                            <a class="btn btn-secondary dropdown-toggle drop-btn" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                                                                Select

                                                                            </a>



                                                                            <div class="dropdown-menu btn-bg" aria-labelledby="dropdownMenuLink">

                                                                                <a class="dropdown-item" href="pending-order-detail.html">View</a>

                                                                                <a class="dropdown-item" href="" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Change Status</a>

                                                                                <!-- <a class="dropdown-item" href="">Approve</a> -->

                                                                            </div>

                                                                            </div>

                                                                        </td>

                                                                    </tr>



                                                                    <tr>

                                                                        <td>5</td>

                                                                        <td scope="row">#2095868734</td>

                                                                        <td>courier & Express Services</td>

                                                                        <td class="">$25.00</td>

                                                                        <td class="">28 April 2020, 10:45 AM</td>

                                                                        <!-- <td class="">4 km</td> -->

                                                                        <td class="inactive">Shipment dropped off at Atlanta Airport</td>

                                                                        <td class="text-right">

                                                                            <div class="dropdown show dropdown-btn">

                                                                            <a class="btn btn-secondary dropdown-toggle drop-btn" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                                                                Select

                                                                            </a>



                                                                            <div class="dropdown-menu btn-bg" aria-labelledby="dropdownMenuLink">

                                                                                <a class="dropdown-item" href="pending-order-detail.html">View</a>

                                                                                <a class="dropdown-item" href="" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Change Status</a>

                                                                                <!-- <a class="dropdown-item" href="">Approve</a> -->

                                                                            </div>

                                                                            </div>

                                                                        </td>

                                                                    </tr>



                                                                    <tr>

                                                                        <td>6</td>

                                                                        <td scope="row">#2095868734</td>

                                                                        <td>Sea Freight</td>

                                                                        <td class="">$25.00</td>

                                                                        <td class="">28 April 2020, 10:45 AM</td>

                                                                        <!-- <td class="">10 km</td> -->

                                                                        <td class="active-icon-approve">Shipped By Customer</td>

                                                                        <td class="text-right">

                                                                            <div class="dropdown show dropdown-btn">

                                                                            <a class="btn btn-secondary dropdown-toggle drop-btn" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                                                                Select

                                                                            </a>



                                                                            <div class="dropdown-menu btn-bg" aria-labelledby="dropdownMenuLink">

                                                                                <a class="dropdown-item" href="pending-order-detail.html">View</a>

                                                                                <a class="dropdown-item" href="" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Change Status</a>

                                                                                <!-- <a class="dropdown-item" href="">Approve</a> -->

                                                                            </div>

                                                                            </div>

                                                                        </td>

                                                                    </tr>



                                                                    <tr>

                                                                        <td>7</td>

                                                                        <td scope="row">#2095868734</td>

                                                                        <td>Air Freight</td>

                                                                        <td class="">$25.00</td>

                                                                        <td class="">28 April 2020, 10:45 AM</td>

                                                                        <!-- <td class="">8 km</td></td> -->

                                                                        <td class="inactive">Shipment dropped off at Atlanta Airport</td>

                                                                        <td class="text-right">

                                                                            <div class="dropdown show dropdown-btn">

                                                                            <a class="btn btn-secondary dropdown-toggle drop-btn" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                                                                Select

                                                                            </a>



                                                                            <div class="dropdown-menu btn-bg" aria-labelledby="dropdownMenuLink">

                                                                                <a class="dropdown-item" href="pending-order-detail.html">View</a>

                                                                                <a class="dropdown-item" href="" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Change Status</a>

                                                                                <!-- <a class="dropdown-item" href="">Approve</a> -->

                                                                            </div>

                                                                            </div>

                                                                        </td>

                                                                    </tr>



                                                                    <tr>

                                                                        <td>8</td>

                                                                        <td scope="row">#2095868734</td>

                                                                        <td>courier & Express Services</td>

                                                                        <td class="">$25.00</td>

                                                                        <td class="">28 April 2020, 10:45 AM</td>

                                                                        <!-- <td class="">3 km</td> -->

                                                                        <td class="active-icon-approve">Shipped By Customer</td>

                                                                        <td class="text-right">

                                                                            <div class="dropdown show dropdown-btn">

                                                                            <a class="btn btn-secondary dropdown-toggle drop-btn" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                                                                Select

                                                                            </a>



                                                                            <div class="dropdown-menu btn-bg" aria-labelledby="dropdownMenuLink">

                                                                                <a class="dropdown-item" href="pending-order-detail.html">View</a>

                                                                                <a class="dropdown-item" href="" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Change Status</a>

                                                                                <!-- <a class="dropdown-item" href="">Approve</a> -->

                                                                            </div>

                                                                            </div>

                                                                        </td>

                                                                    </tr>

                                                                    <tr>

                                                                        <td>9</td>

                                                                        <td scope="row">#2095868734</td>

                                                                        <td>Concierge Shopping</td>

                                                                        <td class="">$25.00</td>

                                                                        <td class="">28 April 2020, 10:45 AM</td>

                                                                        <!-- <td class="">6 km</td> -->

                                                                        <td class="inactive">Shipment dropped off at Atlanta Airport</td>

                                                                        <td class="text-right">

                                                                            <div class="dropdown show dropdown-btn">

                                                                            <a class="btn btn-secondary dropdown-toggle drop-btn" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                                                                Select

                                                                            </a>



                                                                            <div class="dropdown-menu btn-bg" aria-labelledby="dropdownMenuLink">

                                                                                <a class="dropdown-item" href="pending-order-detail.html">View</a>

                                                                                <a class="dropdown-item" href="" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Change Status</a>

                                                                                <!-- <a class="dropdown-item" href="">Approve</a> -->

                                                                            </div>

                                                                            </div>

                                                                        </td>

                                                                    </tr>

                                                                </tbody>

                                                            </table>

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

            </div>

        </div>

    </div>
    <!-- container-fluid -->
</div>
<!-- content -->
