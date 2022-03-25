<?php if(!empty($orderexist->receipt_file)){
   if(in_array($orderexist->receipt_file_extension, imageExtension())){
       $receipt_file = getenv('S3_USER_RECEIPT_THUMB').$orderexist->receipt_file;
   }elseif(in_array($orderexist->receipt_file_extension, fileExtension())) {
       $receipt_file = $content_images.'/doc.png';
   }else{  
       $receipt_file = $content_images.'/pdf.png';
   }
} ?>
 
 <!-- Start content -->
 <div class="content">
      <div class="container-fluid">
         <div class="page-title-box box-spacing">
            <div class="row align-items-center">
               <div class="col-sm-6">
                  <h4 class="page-title">Pending Orders Detail</h4>
                  <ol class="breadcrumb">
                     <!-- <li class="breadcrumb-item active">Welcome to Hobort</li> -->
                  </ol>
               </div>
            </div>
         </div>
         <!-- end row -->
         <div class="">
            <div class="customer-info">
               <div class="customer-detail p-3">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="orderInfo-1">
                           <h2>Basic Info</h2>
                           <?php if($orderexist->service_type == 1){ ?>
                              <p><span class="mr-2">Price: <b><?php echo '$'.$orderexist->price ?> ,</b></span><span>Item Value: <b><?php echo $air->item_value; ?> ,</b></span> <span>Quantity: <b><?php echo $orderexist->quantity ?></b></span></p>
                           <?php }else{ ?>
                              <p><span class="mr-2">Price: <b><?php echo '$'.$orderexist->price ?> ,</b></span> <span>Quantity: <b><?php echo $orderexist->quantity ?></b></span></p>
                           <?php } ?>
                           <div class="track-d-sec mb-3">
                              <h1>Customer Name : <b><?php echo $userdetail->full_name ?></b></h1>
                           </div>
                           <div class="track-d-sec">
                              <h1>Track ID : <b><?php echo '#'.$orderexist->tracking_id ?></b></h1>
                           </div>

                           <?php if($orderexist->service_type == 1){ ?>
                              <div class="row">
                                 <!-- Air freight elements info block -->
                                 <div class="col-md-6">
                                    <div class="all-details-sec">
                                       <div class="order-pending-section">
                                          <div class="left-section">
                                             <div class="media pending-img-sec">
                                                <img src="<?php echo getenv('APP_BACK_ASSETS_IMAGES'); ?>users/img1.png">
                                             </div>
                                             <div class="media-body ml-3 pending-text">
                                                <h2>Length</h2>
                                             </div>
                                          </div>
                                          <div>
                                             <div class="media-body mr-3 right-pending-detail">
                                                <h2><?php echo $air->length; ?> (IN)</h2>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="order-pending-section mt-3">
                                          <div class="left-section">
                                             <div class="media pending-img-sec">
                                                <img src="<?php echo getenv('APP_BACK_ASSETS_IMAGES'); ?>users/img2.png">
                                             </div>
                                             <div class="media-body ml-3 pending-text">
                                                <h2>Height</h2>
                                             </div>
                                          </div>
                                          <div>
                                             <div class="media-body mr-3 right-pending-detail">
                                                <h2><?php echo $air->height; ?> (IN)</h2>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="order-pending-section mt-3">
                                          <div class="left-section">
                                             <div class="media pending-img-sec">
                                                <img src="<?php echo getenv('APP_BACK_ASSETS_IMAGES'); ?>users/img3.png">
                                             </div>
                                             <div class="media-body ml-3 pending-text">
                                                <h2>Width</h2>
                                             </div>
                                          </div>
                                          <div>
                                             <div class="media-body mr-3 right-pending-detail">
                                                <h2><?php echo $air->width; ?> (IN)</h2>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="order-pending-section mt-3">
                                          <div class="left-section">
                                             <div class="media pending-img-sec">
                                                <img src="<?php echo getenv('APP_BACK_ASSETS_IMAGES'); ?>users/img4.png">
                                             </div>
                                             <div class="media-body ml-3 pending-text">
                                                <h2>Weight</h2>
                                             </div>
                                          </div>
                                          <div>
                                             <div class="media-body mr-3 right-pending-detail">
                                                <h2><?php echo $air->weight; ?> (Pound)</h2>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>

                                 <!-- Download receipt block -->
                                 <div class="col-md-6">
                                    <?php if(!empty($orderexist->receipt_file)){ ?>
                                       <div class="invoiceSec">
                                          <div class="recipetImg-1">
                                             <img src="<?php echo $receipt_file; ?>">
                                          </div>
                                          <div class="download-receipt-btn">
                                             <a class="btn btn-outline-success waves-effect waves-light mb-3" href="<?php echo base_url('order/receipt_download/download_reciept?image_name=').$orderexist->receipt_file;?>">Download Receipt<i class="fa fa-download ml-2"></i></a>
                                             <span class="ml-4">
                                             <button type="button" class="btn btn-outline-secondary waves-effect waves-light mb-3" data-toggle="modal" data-target="#viewAirFilesection">View Receipt <i class="fa fa-eye" aria-hidden="true"></i></button>
                                             </span>
                                          </div>
                                       </div>
                                    <?php } ?>
                                    
                                    <!-- <?php if(!empty($orderexist->receipt_file)){ ?>
                                       <div class="recipetImg" id="onrefresh">
                                          <a href="<?php echo base_url('order/receipt_download/download_reciept?image_name=').$orderexist->receipt_file;?>">
                                          <img src="<?php echo $receipt_file;?>" class="preview">
                                          </a>
                                          <a class="ripple button-class btn text-left dwnlod-btn" href="<?php echo base_url('order/receipt_download/download_reciept?image_name=').$orderexist->receipt_file;?>">Download Receipt<span class="fa fa-download"></span></a>
                                       </div>
                                    <?php }?> -->
                                 </div>
                              </div>
                           <?php }else { ?>
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="all-details-sec">
                                       <div class="order-pending-section">
                                          <div class="left-section">
                                             <div class="media pending-img-sec">
                                                <img src="<?php echo getenv('APP_BACK_ASSETS_IMAGES'); ?>users/img6.png">
                                             </div>
                                             <div class="media-body ml-3 pending-text">
                                                <h2>Item</h2>
                                             </div>
                                          </div>
                                          <div>
                                             <div class="media-body mr-3 right-pending-detail">
                                             <?php $serviceType = $sea->type == 1?'Light':'Heavy'; ?>
                                                <h2><?php echo $sea->title ?>(<?php echo $serviceType ?>) - <?php echo '$'.$sea->price ?></h2>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-12">
                                    <!-- <div class="invoiceSec">
                                       <div class="recipetImg-1">
                                          <img src="<?php echo getenv('APP_BACK_ASSETS_IMAGES'); ?>users/reciept2.png">
                                       </div>
                                       <div class="download-receipt-btn">
                                          <button type="button" class="btn btn-outline-success waves-effect waves-light mb-3">Download Receipt <i class="fa fa-download ml-2"></i></button>
                                          <span class="ml-4">
                                          <button type="button" class="btn btn-outline-secondary waves-effect waves-light mb-3" data-toggle="modal" data-target="#viewpdfsection">View Receipt <i class="fa fa-eye" aria-hidden="true"></i></button>
                                          </span>
                                       </div>
                                    </div> -->
                                    <?php if(!empty($orderexist->receipt_file)){ ?>
                                       <div class="invoiceSec">
                                          <div class="recipetImg-1">
                                             <img src="<?php echo $receipt_file; ?>">
                                          </div>
                                          <div class="download-receipt-btn">
                                             <a class="btn btn-outline-success waves-effect waves-light mb-3" href="<?php echo base_url('order/receipt_download/download_reciept?image_name=').$orderexist->receipt_file;?>">Download Receipt<i class="fa fa-download ml-2"></i></a>
                                             <span class="ml-4">
                                             <button type="button" class="btn btn-outline-secondary waves-effect waves-light mb-3" data-toggle="modal" data-target="#viewAirFilesection">View Receipt <i class="fa fa-eye" aria-hidden="true"></i></button>
                                             </span>
                                          </div>
                                       </div>
                                    <?php } ?>
                                 </div>
                              </div>
                           <?php } ?>

                           <!-- Change status tracking block -->
                           <div class="trackingBox mt-3">
                              <div class="trackingInfo">
                                 <div class="drop-address">
                                    <!-- Status change block -->
                                    <div class="text-right">
                                       <!-- <div class="dropdown dropsection">
                                          <a class="dropdown-toggle btn" data-toggle="dropdown" href="#">
                                          Change Status
                                          <b class="caret"></b>
                                          </a>
                                          <ul class="dropdown-menu dropdown-menu-form  dropdown-menu-right drpdwn-section drpdwn-wh new-status-section" role="menu">
                                             <li>
                                                <label class="checkbox">
                                                <input type="checkbox">
                                                Package Received at our warehouse
                                                </label>
                                             </li>
                                             <li>
                                                <label class="checkbox">
                                                <input type="checkbox">
                                                Package preparing to ship
                                                </label>
                                             </li>
                                             <li>
                                                <label class="checkbox">
                                                <input type="checkbox">
                                                Shipment dropped off at Atlanta Airport
                                                </label>
                                             </li>
                                             <li>
                                                <label class="checkbox">
                                                <input type="checkbox">
                                                Shipment in Transit
                                                </label>
                                             </li>
                                             <li>
                                                <label class="checkbox">
                                                <input type="checkbox">
                                                Shipment Arrived in Accra 
                                                </label>
                                             </li> 
                                             <li>
                                                <label class="checkbox">
                                                <input type="checkbox">
                                                Customs Clearance Started 
                                                </label>
                                             </li>
                                             <li>
                                                <label class="checkbox">
                                                <input type="checkbox">
                                                Shipment Cleared 
                                                </label>
                                             </li>
                                                <li>
                                                <button type="button" class="btn btn-secondary dn-btn text-center">Done</button>
                                             </li>
                                          </ul>
                                       </div> -->

                                       <div class="dropdown dropsection">
                                          <a class="dropdown-toggle btn" data-toggle="dropdown" href="#">
                                          Change Status
                                          <b class="caret"></b>
                                          </a>
                                          <form action="<?php echo admin_url('order/status_change'); ?>" class="form-horizontal" method="POST" id="status_change">
                                             <ul class="dropdown-menu dropdown-menu-form drpdwn-section" role="menu">
                                                <input type="hidden" name="check_value" id="check_value" value="<?php echo $orderexist->status; ?>">
                                                <input type="hidden" name="order_id" id="order_id" value="<?php echo $orderexist->orderID; ?>">
                                                <li>
                                                   <label class="checkbox">
                                                   <input type="checkbox" class="checkboxes" <?php  if($orderexist->status >=3 || $orderexist->status <= 1){echo "disabled";} ?>  <?php  if($orderexist->status >=3){echo "checked";} ?>  statusValue="3">
                                                   Package Received at our warehouse
                                                   </label>
                                                </li>
                                                <li>
                                                   <label class="checkbox">
                                                   <input type="checkbox" class="checkboxes" <?php  if($orderexist->status >=4 || $orderexist->status <= 2){echo "disabled";} ?>  <?php  if($orderexist->status >=4){echo "checked";} ?> statusValue="4">
                                                   Package preparing to ship
                                                   </label>
                                                </li>
                                                <li>
                                                   <label class="checkbox" >
                                                   <input type="checkbox" class="checkboxes" <?php  if($orderexist->status >=5 || $orderexist->status <= 3){echo "disabled";} ?>  <?php  if($orderexist->status >=5){echo "checked";} ?> statusValue="5">
                                                   Shipment dropped off at Atlanta Airport
                                                   </label>
                                                </li>
                                                <li>
                                                   <label class="checkbox">
                                                   <input type="checkbox" class="checkboxes" <?php  if($orderexist->status >=6 || $orderexist->status <= 4){echo "disabled";} ?>  <?php  if($orderexist->status >=6){echo "checked";} ?> statusValue="6">
                                                   Shipment in Transit
                                                   </label>
                                                </li>
                                                <li>
                                                   <label class="checkbox">
                                                   <input type="checkbox" class="checkboxes" <?php  if($orderexist->status >=7 || $orderexist->status <= 5){echo "disabled";} ?>  <?php  if($orderexist->status >=7){echo "checked";} ?> statusValue="7">
                                                   Shipment Arrived in Accra
                                                   </label>
                                                </li>
                                                <li>
                                                   <label class="checkbox">
                                                   <input type="checkbox" class="checkboxes" <?php  if($orderexist->status >=8 || $orderexist->status <= 6){echo "disabled";} ?>  <?php  if($orderexist->status >=8){echo "checked";} ?> statusValue="8">
                                                   Customs Clearance Started
                                                   </label>
                                                </li>
                                                <li>
                                                   <label class="checkbox">
                                                   <input type="checkbox" class="checkboxes" <?php  if($orderexist->status >=9 || $orderexist->status <= 7){echo "disabled";} ?>  <?php  if($orderexist->status >=9){echo "checked";} ?> statusValue="9">
                                                   Shipment Cleared
                                                   </label>
                                                </li>
                                                <button type="button" id="submitStatus" class="btn btn-secondary dn-btn text-center">Done</button>
                                             </ul>
                                          </form>
                                       </div>
                                    </div>
                                 </div>

                                 <!-- Status tracking block -->
                                 <?php $orderStatus = json_decode($orderexist->status_updated_at); ?>
                                 <div class="stepBlock">
                                    <ul class="StepProgress">
                                       <li class="StepProgress-item <?php if($orderexist->status >=3 ){ echo 'is-done';}elseif($orderexist->status==2){ echo 'current'; }else{echo '';}?>">
                                          <div class="stepItem">
                                             <div class="stepInfo">
                                                <h4>Package Received at our warehouse</h4>
                                                
                                                <?php if($orderexist->status >=3){?>
                                                   <p><?php echo date('d M Y', strtotime($orderStatus->package_received_at_our_warehouse)); ?></p>
                                                <?php }?>
                                             </div>
                                          </div>
                                       </li>
                                       <li class="StepProgress-item <?php if($orderexist->status >=4 ){ echo 'is-done';}elseif($orderexist->status==3){ echo 'current'; }else{echo '';}?>">
                                          <div class="stepItem">
                                             <div class="stepInfo">
                                                <h4>Package preparing to ship</h4>
                                                <?php if($orderexist->status >=4){?>
                                                   <p><?php echo date('d M Y', strtotime($orderStatus->package_preparing_to_ship)); ?></p>
                                                <?php }?>
                                             </div>
                                          </div>
                                       </li>
                                       <li class="StepProgress-item <?php if($orderexist->status >=5 ){ echo 'is-done';}elseif($orderexist->status==4){ echo 'current'; }else{echo '';}?>">
                                          <div class="stepItem">
                                             <div class="stepInfo">
                                                <h4>Shipment dropped off at Atlanta Airport</h4>
                                                <?php if($orderexist->status >=5){?>
                                                   <p><?php echo date('d M Y', strtotime($orderStatus->shipment_dropped_off_at_atlanta_airport)); ?></p>
                                                <?php }?>
                                             </div>
                                          </div>
                                       </li>
                                       <li class="StepProgress-item <?php if($orderexist->status >=6 ){ echo 'is-done';}elseif($orderexist->status==5){ echo 'current'; }else{echo '';}?>">
                                          <div class="stepItem">
                                             <div class="stepInfo">
                                                <h4>Shipment in Transit</h4>
                                                <?php if($orderexist->status >=6){?>
                                                   <p><?php echo date('d M Y', strtotime($orderStatus->shipment_in_transit)); ?></p>
                                                <?php }?>
                                             </div>
                                          </div>
                                          
                                       </li>
                                       <li class="StepProgress-item <?php if($orderexist->status >=7 ){ echo 'is-done';}elseif($orderexist->status==6){ echo 'current'; }else{echo '';}?>">
                                          <div class="stepItem">
                                             <div class="stepInfo">
                                                <h4>Shipment Arrived in Accra</h4>
                                                <?php if($orderexist->status >=7){?>
                                                   <p><?php echo date('d M Y', strtotime($orderStatus->ahipment_arrived_in_accra)); ?></p>
                                                <?php }?>
                                             </div>
                                          </div>
                                       </li>
                                       <li class="StepProgress-item <?php if($orderexist->status >=8 ){ echo 'is-done';}elseif($orderexist->status==7){ echo 'current'; }else{echo '';}?>">
                                          <div class="stepItem">
                                             <div class="stepInfo">
                                                <h4>Customs Clearance Started</h4>
                                                <?php if($orderexist->status >=8){?>
                                                   <p><?php echo date('d M Y', strtotime($orderStatus->customs_clearance_started)); ?></p>
                                                <?php }?>
                                             </div>
                                          </div>
                                       </li>
                                       <li class="StepProgress-item <?php if($orderexist->status >=9 ){ echo 'is-done';}elseif($orderexist->status==8){ echo 'current'; }else{echo '';}?>">
                                          <div class="stepItem">
                                             <div class="stepInfo">
                                                <h4>Shipment Cleared</h4>
                                                <?php if($orderexist->status >=9){?>
                                                   <p><?php echo date('d M Y', strtotime($orderStatus->shipment_cleared)); ?></p>
                                                <?php }?>
                                             </div>
                                          </div>
                                       </li>
                                       
                                    </ul>
                                 </div>
                                 
                                 <!-- <div class="stepBlock">
                                    <ul class="StepProgress">
                                       <li class="StepProgress-item is-done">
                                          <div class="stepItem">
                                             <div class="stepInfo">
                                                <h4>Package Received at our warehouse</h4>
                                                <p>Order placed on 23rd Dec 2019</p>
                                             </div>
                                          </div>
                                       </li>
                                       <li class="StepProgress-item is-done">
                                          <div class="stepItem">
                                             <div class="stepInfo">
                                                <h4>Package preparing to ship</h4>
                                                <p>Order placed on 24rd Dec 2019</p>
                                             </div>
                                          </div>
                                       </li>
                                       <li class="StepProgress-item is-done">
                                          <div class="stepItem">
                                             <div class="stepInfo">
                                                <h4>Shipment dropped off at Atlanta Airport</h4>
                                                <p>Order approved on 23rd Dec 2019</p>
                                             </div>
                                          </div>
                                       </li>
                                       <li class="StepProgress-item is-done">
                                          <div class="stepItem">
                                             <div class="stepInfo">
                                                <h4>Shipment in Transit</h4>
                                                <p>Order packed on 25th Dec 2019</p>
                                             </div>
                                          </div>
                                          
                                       </li>
                                       <li class="StepProgress-item current">
                                          <div class="stepItem">
                                             <div class="stepInfo">
                                                <h4>Shipment Arrived in Accra</h4>
                                                <p>Order packed on 26th Dec 2019</p>
                                             </div>
                                          </div>
                                          
                                       </li>
                                       <li class="StepProgress-item">
                                          <div class="stepItem">
                                             <div class="stepInfo">
                                                <h4>Customs Clearance Started</h4>
                                                <p>Order on the way on 26th Dec 2019</p>
                                             </div>
                                          </div>
                                       </li>
                                       <li class="StepProgress-item">
                                          <div class="stepItem">
                                             <div class="stepInfo">
                                                <h4>Shipment Cleared</h4>
                                             </div>
                                          </div>
                                       </li>
                                    </ul>
                                 </div> -->

                              </div>
                           </div>

                        </div>
                     </div>
                  </div>

                  <!-- Shipment info block -->
                  <div class="row">
                     <div class="col-md-12">
                        <div class="shipment-info-section">
                           <div class="shipment-info-sec-new">
                              <h5>Shipment Info</h5>
                           </div>
                           <?php if($orderexist->status == 3){ ?>
                              <?php if($orderexist->service_type == 1){ ?>
                                 <div class="shipment-add-btn" data-toggle="modal" data-target="#addAirModal">
                                    <img src="<?php echo getenv('APP_BACK_ASSETS_IMAGES'); ?>users/plus_ico.png">
                                 </div>
                              <?php }else { ?>
                                 <div class="shipment-add-btn" data-toggle="modal" data-target="#addSeaModal">
                                    <img src="<?php echo getenv('APP_BACK_ASSETS_IMAGES'); ?>users/plus_ico.png">
                                 </div>
                              <?php } ?>
                           <?php } ?>
                        </div>
                     </div>
                  </div>

                  <!-- Shipments block -->
                  <?php if($orderexist->service_type == 1){ ?>
                     <?php for( $f = 0; $f< count( $ordersipments ); $f++ ) {?>
                        <div class="col-md-12">
                           <div class="trackingBox-1 mt-3 mb-3">
                              <div class="idproof-img mt-0 vehicle-info-data">
                                 <div class="d-flex">
                                    <div class="shipper-info-sec idsContnt w-25">
                                       <h3>Tracking Number : </h3>
                                       <p><?php echo '#'.str_replace(",",", ",$ordersipments[$f]->track_number); ?></p>
                                       <!-- <p><?php //echo '#'.$ordersipments[$f]->track_number ?></p> -->
                                    </div>
                                    <div class="shipper-info-sec w-25">
                                       <h3>Quantity : </h3>
                                       <p><?php echo $ordersipments[$f]->ship_quantity ?></p>
                                    </div>
                                    <div class="shipper-info-sec w-25">
                                       <h3>Total Amount :</h3>
                                       <p><?php echo '$'.$ordersipments[$f]->ship_price ?></p>
                                    </div>
                                    <div class="shipper-info-sec w-25">
                                       <h3>Weight : </h3>
                                       <p><?php echo $ordersipments[$f]->weight; ?> (Pound)</p>
                                    </div>
                                 </div>
                                 <div class="d-flex">
                                    <div class="shipper-info-sec w-25">
                                       <h3>Length : </h3>
                                       <p><?php echo $ordersipments[$f]->length; ?> (IN)</p>
                                    </div>
                                    <div class="shipper-info-sec w-25">
                                       <h3>Height : </h3>
                                       <p><?php echo $ordersipments[$f]->height; ?> (IN)</p>
                                    </div>
                                    <div class="shipper-info-sec w-25">
                                       <h3>Width : </h3>
                                       <p><?php echo $ordersipments[$f]->width; ?> (IN)</p>
                                    </div>
                                    <div class="shipper-info-sec w-25">
                                       <div class="d-flex"> 
                                          <div class="status-setion">
                                             <h3 class="dropdown-toggle btn" data-toggle="dropdown" href="#">Status<i class="fa fa-sort-desc" aria-hidden="true"></i></h3>

                                             <?php if( $ordersipments[$f]->status == 2 ) { ?>
                                                <ul class="dropdown-menu dropdown-menu-form  dropdown-menu-right drpdwn-section drpdwn-wh new-status-section new-status-section-second" role="menu">
                                                   <li>
                                                      <label class="checkbox">
                                                         <input type="checkbox" id="<?php echo $ordersipments[$f]->og_id; ?>">
                                                         <p>Package Received at our warehouse</p>
                                                      </label>
                                                   </li>
                                                   <button type="button" onClick="changeStatus(<?php echo $ordersipments[$f]->og_id; ?>, <?php echo $ordersipments[$f]->status; ?>);" class="btn btn-secondary dn-btn text-center">Done</button>
                                                </ul>
                                                <p>Pending</p>
                                             <?php }elseif ($ordersipments[$f]->status==3) { ?>
                                                <p>Package Received at our warehouse</p>
                                             <?php }elseif ($ordersipments[$f]->status==4) { ?>
                                                <p>Package preparing to ship</p>
                                             <?php }elseif ($ordersipments[$f]->status==5) { ?>
                                                <p>Shipment dropped off at Atlanta Airport</p>
                                             <?php }elseif ($ordersipments[$f]->status==6) { ?>
                                                <p>Shipment in Transit</p>
                                             <?php  }elseif ($ordersipments[$f]->status==7) { ?>
                                                <p>Shipment Arrived in Accra</p>
                                             <?php }elseif ($ordersipments[$f]->status==8) { ?>
                                                <p>Customs Clearance Started</p>
                                             <?php }else{ ?> 
                                                <p>Shipment Cleared</p>
                                             <?php } ?>
                                             
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="d-flex">
                                    <div class="shipper-info-sec w-25">
                                       <h3>Carrier Name : </h3>
                                       <p><?php echo $ordersipments[$f]->carrier_name; ?></p>
                                    </div>
                                    <div class="shipper-info-sec w-25">
                                       <h3>Item Value : </h3>
                                       <p><?php echo $ordersipments[$f]->item_value; ?></p>
                                    </div>
                                    <div class="shipper-info-sec w-50">
                                       <h3 class="m-0">Content : </h3>
                                       <p><?php echo $ordersipments[$f]->content; ?></p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     <?php } ?>
                  <?php }else { ?>
                     <?php for( $f = 0; $f< count( $ordersipments ); $f++ ) {?>
                        <div class="col-md-12">
                           <div class="trackingBox-1 mt-3 mb-3">
                              <div class="idproof-img mt-0 vehicle-info-data">
                                 <div class="d-flex">
                                    <div class="shipper-info-sec idsContnt w-25">
                                       <h3>Tracking Number : </h3>
                                       <p><?php echo '#'.str_replace(",",", ",$ordersipments[$f]->track_number); ?></p>
                                       <!-- <p><?php //echo '#'.$ordersipments[$f]->track_number ?></p> -->
                                    </div>
                                    <div class="shipper-info-sec w-25">
                                       <h3>Quantity : </h3>
                                       <p><?php echo $ordersipments[$f]->ship_quantity ?></p>
                                    </div>
                                    <div class="shipper-info-sec w-25">
                                       <h3>Total Amount :</h3>
                                       <p><?php echo '$'.$ordersipments[$f]->ship_price ?></p>
                                    </div>
                                    <div class="shipper-info-sec w-25">
                                       <div class="d-flex">
                                          <div class="status-setion">
                                             <h3 class="dropdown-toggle btn" data-toggle="dropdown" href="#">Status<i class="fa fa-sort-desc" aria-hidden="true"></i></h3>
                                             <?php if( $ordersipments[$f]->status == 2 ) { ?>
                                                <ul class="dropdown-menu dropdown-menu-form  dropdown-menu-right drpdwn-section drpdwn-wh new-status-section new-status-section-second" role="menu">
                                                   <li>
                                                      <label class="checkbox">
                                                         <input type="checkbox" id="<?php echo $ordersipments[$f]->og_id; ?>">
                                                         <p>Package Received at our warehouse</p>
                                                      </label>
                                                   </li>
                                                      <button type="button" onClick="changeStatus(<?php echo $ordersipments[$f]->og_id; ?>, <?php echo $ordersipments[$f]->status; ?>);" class="btn btn-secondary dn-btn text-center">Done</button>
                                                </ul>
                                                <p>Pending</p>
                                             <?php }elseif ($ordersipments[$f]->status==3) { ?>
                                                <p>Package Received at our warehouse</p>
                                             <?php }elseif ($ordersipments[$f]->status==4) { ?>
                                                <p>Package preparing to ship</p>
                                             <?php }elseif ($ordersipments[$f]->status==5) { ?>
                                                <p>Shipment dropped off at Atlanta Airport</p>
                                             <?php }elseif ($ordersipments[$f]->status==6) { ?>
                                                <p>Shipment in Transit</p>
                                             <?php  }elseif ($ordersipments[$f]->status==7) { ?>
                                                <p>Shipment Arrived in Accra</p>
                                             <?php }elseif ($ordersipments[$f]->status==8) { ?>
                                                <p>Customs Clearance Started</p>
                                             <?php }else{ ?> 
                                                <p>Shipment Cleared</p>
                                             <?php } ?>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="d-flex">
                                    <div class="shipper-info-sec w-25">
                                       <h3>Item : </h3>
                                       <p><?php echo $ordersipments[$f]->sea_title ?>(<?php echo $ordersipments[$f]->sea_type ?>) - <?php echo '$'.$ordersipments[$f]->sea_price ?></p>
                                    </div>
                                    <div class="shipper-info-sec w-25">
                                       <h3>Carrier Name : </h3>
                                       <p><?php echo $ordersipments[$f]->carrier_name; ?></p>
                                    </div>
                                    <div class="shipper-info-sec w-50">
                                       <h3 class="m-0">Content : </h3>
                                       <p><?php echo $ordersipments[$f]->content; ?></p>
                                    </div>
                                 </div>
                              </div>
                           </div>

                        </div>
                     <?php } ?>
                  <?php } ?>

               </div>
            </div>
         </div>
         </div>
      </div>
   <!-- container-fluid -->
</div>
<!-- content -->

<!--Full-View-Popup-modal -->
<div class="modal fade" id="viewAirFilesection" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog area-width" role="document">
      <div class="modal-content">
         <div class="modal-header change-status-heading">
            <h5 class="modal-title" id="exampleModalLabel">View Receipt</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="full-receipt-img">
               <img src="<?php echo $receipt_file; ?>">
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Add-air-modal -->
<div class="modal fade" id="addAirModal" tabindex="-1" role="dialog" aria-labelledby="addAirModalLabel" aria-hidden="true">
   <div class="modal-dialog area-width" role="document">
      <div class="modal-content">
         <div class="modal-header change-status-heading">
            <h5 class="modal-title" id="addAirModalLabel">Add Shipment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="csForm floatLabelForm">
               <form class="csForm" action="<?php echo base_url('admin/add_shipment');?>" method="POST" id="add_shipment_qoute" autocomplete="off">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <div class="floatLabel">
                              <label class="inLabel">Carrier Name<span class="reqStar">*</span></label>
                              <select class="form-control CsSelect select2-hidden-accessible" name="carrier" id="carrier" data-select2-id="select2-data-1-xjg5" tabindex="-1" aria-hidden="true">
                                 <option value="" data-select2-id="select2-data-3-csg0">Select Carrier Name</option>
                                 <option value="LaserShip" data-select2-id="select2-data-3-csg0">LaserShip</option>
                                 <option value="DHL" data-select2-id="select2-data-7-u82a">DHL</option>
                                 <option value="FEDEX" data-select2-id="select2-data-8-drpz">FEDEX</option>
                                 <option value="USPS" data-select2-id="select2-data-9-8gu0">USPS</option>
                                 <option value="UPS" data-select2-id="select2-data-9-8gu0">UPS</option>
                                 <option value="AMAZON" data-select2-id="select2-data-9-8gu0">AMAZON</option>
                                 <option value="OTHER" data-select2-id="select2-data-9-8gu0">OTHER</option>
                              </select>
                              <input type="hidden" name="oid" id="oid" value="<?php echo $orderexist->orderID ?>">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="floatLabel">
                        <label class="inLabel">Description<span class="reqStar reqStar-new">*</span></label>
                        <textarea rows="4" class="form-control" type="text" name="content" id="content" placeholder="Enter Description"></textarea>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="floatLabel">
                        <label class="inLabel">Tracking Number<span class="reqStar">*</span></label>
                        <!-- <div class="moreTrackId">
                              <input class="form-control" type="text" name="" placeholder="Enter Tracking Number">
                              <label class="add-more-btn"><i class="fa fa-plus ship-cancel" aria-hidden="true"></i></label>
                           </div>
                        <div class="trackIdBlk">
                           <div class="moreTrackId">
                              <input class="form-control" type="text" name="" placeholder="Enter Tracking Number">
                              <label><i class="fa fa-times ship-cancel" aria-hidden="true"></i></label>
                           </div>
                        </div> -->

                        <div class="moreTrackId" id="moreTrackId">
                           <input class="form-control" type="text" name="trackingNumber" id="trackingNumber" placeholder="Enter Tracking Number">
                           <label class="add-more-btn"><i class="fa fa-plus ship-cancel" id="addMoreTrackNum" aria-hidden="true"></i></label>
                        </div>
                        <div id="trakNumBlock">
                        </div>
                     </div>
                  </div>
                  <div class="item-details-shipment">
                     <h4>Item Details</h4>
                  </div>
                  <input type="hidden" name="area_total" id="area_total">
                  <input type="hidden" name="totalValue" id="totalValue">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <div class="floatLabel">
                              <label class="inLabel">Lenght<span class="reqStar">*</span></label>
                              <!-- <span class="input-group-text" id="basic-addon2">Inches</span> -->
                              <input type="number" onkeyup="calculateQuoteAmnt();" name="length" id="length" class="form-control" placeholder="Inches" autocomplete="off">
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <div class="floatLabel">
                              <label class="inLabel">Height<span class="reqStar">*</span></label>
                              <input type="number" onkeyup="calculateQuoteAmnt();" name="height" id="height" class="form-control" placeholder="Inches" autocomplete="off">
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <div class="floatLabel">
                              <label class="inLabel">Width<span class="reqStar">*</span></label>
                              <input type="number" onkeyup="calculateQuoteAmnt();" name="width" id="width" class="form-control" placeholder="Inches" autocomplete="off">
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <div class="floatLabel">
                              <label class="inLabel">Weight<span class="reqStar">*</span></label>
                              <input type="number" name="weight" id="weight" class="form-control" onkeyup="calculateQuoteAmnt();" placeholder="Pound" autocomplete="off">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <div class="floatLabel">
                              <label class="inLabel">Item Value<span class="reqStar">*</span></label>
                              <!-- <span class="input-group-text" id="basic-addon2">Inches</span> -->
                              <input type="number" placeholder="Item Value" name="item_value"  class="form-control" id="item_value" onkeyup="calculateQuoteAmnt()">
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                              <div class="floatLabel">
                                    <label class="inLabel">Quantity<span class="reqStar">*</span></label>

                                    <select class="form-control CsSelect" name="quantity" id="quantity" onchange="calculateQuoteAmnt()">
                                       <?php foreach (getAllPosition() as $key => $value) { ?>
                                       <option value="<?php echo $value['value'];?>"><?php echo $value['value'];?></option>
                                       <?php } ?>
                                    </select>
                              </div>
                           </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="totl-amiuntsection">
                     <div class="pricetotaltxt">
                        <h2>Total Amount</h2> 
                     </div>
                     <div class="pricetotal">
                     <h3 id="total">$00.00</h3> 
                     </div>
                     </div>
                  </div>
                  <div class="form-group mb-2">
                  <button type="button" id="addShipment" class="btn btnTheme">Add</button>
                  </div>
               </form>
            </div>
         </div>
         <!-- <div class="modal-footer status-btn border-0">
            <button type="button" class="btn btn-primary">Submit</button>
            
            </div> -->
      </div>
   </div>
</div>
<!-- End add sea form -->

<!-- Add-sea-modal -->
<div class="modal fade" id="addSeaModal" tabindex="-1" role="dialog" aria-labelledby="addSeaModalLabel" aria-hidden="true">
   <div class="modal-dialog area-width" role="document">
      <div class="modal-content">
         <div class="modal-header change-status-heading">
            <h5 class="modal-title" id="addSeaModalLabel">Add Shipment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="csForm floatLabelForm">
               <form class="csForm" action="<?php echo base_url('admin/add_shipment');?>" method="POST" id="add_sea_shipment_qoute" autocomplete="off">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <div class="floatLabel">
                              <label class="inLabel">Carrier Name<span class="reqStar">*</span></label>
                              <select class="form-control CsSelect select2-hidden-accessible" name="carrier" id="seacarrier" data-select2-id="select2-data-1-xjg5" tabindex="-1" aria-hidden="true">
                                 <option value="" data-select2-id="select2-data-3-csg0">Select Carrier Name</option>
                                 <option value="LaserShip" data-select2-id="select2-data-3-csg0">LaserShip</option>
                                 <option value="DHL" data-select2-id="select2-data-7-u82a">DHL</option>
                                 <option value="FEDEX" data-select2-id="select2-data-8-drpz">FEDEX</option>
                                 <option value="USPS" data-select2-id="select2-data-9-8gu0">USPS</option>
                                 <option value="UPS" data-select2-id="select2-data-9-8gu0">UPS</option>
                                 <option value="AMAZON" data-select2-id="select2-data-9-8gu0">AMAZON</option>
                                 <option value="OTHER" data-select2-id="select2-data-9-8gu0">OTHER</option>
                              </select>
                              <input type="hidden" name="oid" id="oid" value="<?php echo $orderexist->orderID ?>">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="floatLabel">
                        <label class="inLabel">Description<span class="reqStar reqStar-new">*</span></label>
                        <textarea rows="4" class="form-control" type="text" name="content" id="content" placeholder="Enter Description"></textarea>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="floatLabel">
                        <label class="inLabel">Tracking Number<span class="reqStar">*</span></label>
                        <div class="moreTrackId" id="seaMoreTrackId">
                           <input class="form-control" type="text" name="seaTrackingNumber" id="seaTrackingNumber" placeholder="Enter Tracking Number">
                           <label class="add-more-btn"><i class="fa fa-plus ship-cancel" id="addMoreSeaTrackNum" aria-hidden="true"></i></label>
                        </div>
                        <!-- <div class="trackIdBlk">
                           <div class="moreTrackId">
                              <input class="form-control" type="text" name="" placeholder="Enter Tracking Number">
                              <label><i class="fa fa-times ship-cancel" aria-hidden="true"></i></label>
                           </div>
                        </div> -->
                        <div id="seaTrakNumBlock">
                        </div>

                     </div>
                  </div>
                  <div class="item-details-shipment">
                     <h4>Item Details</h4>
                  </div>
                  <div class="row">
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <div class="floatLabel">
                              <label class="inLabel">Item<span class="reqStar">*</span></label>
                              <input type="hidden" name="service_id_sea" id="service_id_sea">
                              <input type="hidden" name="title_sea" id="title_sea">
                              <input type="hidden" name="type_sea" id="type_sea">
                              <select class="form-control CsSelect" name="item_sea" id="item_sea" onchange="admin_sea_calculation()">
                                 <?php foreach ($sea_freight_item as $key => $value) {
                                    if($value->type == 1){
                                       $type = 'Light';
                                    }else{
                                       $type = 'Heavy';
                                    
                                    }
                                 ?>
                                 <option value="<?php echo $value->price;?>" data-id="<?php echo $value->seaFreightServiceID;?>" data-title="<?php echo $value->title;?>" data-type="<?php echo $type;?>" ><?php echo $value->title.'('.$type.')'.' - '.'$'.$value->price?></option>
                                 <?php }?>
                              </select>

                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <div class="floatLabel">
                              <label class="inLabel">Quantity<span class="reqStar">*</span></label>
                              <select class="form-control CsSelect" name="quantity_sea" id="quantity_sea" onchange="admin_sea_calculation()">
                                 <?php foreach (getAllPosition() as $key => $value) { ?>
                                 <option value="<?php echo $value['value'];?>"><?php echo $value['value'];?></option>
                                 <?php } ?>
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="totl-amiuntsection">
                        <div class="pricetotaltxt">
                           <h2>Total Amount</h2>
                        </div>
                        <div class="pricetotal">
                           <h3 id="total_sea">$00.00</h3>
                        </div>
                     </div>
                  </div>
                  <div class="form-group mb-2">
                     <button type="button" id="addSeaShipment" class="btn btnTheme">Add</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- End add sea form -->

<script>
   var countAddMore = 0;
   $(document).ready(()=>{
      admin_sea_calculation();
      var status = $('#check_value').val();
      var order_id = $('#order_id').val();
      countAddMore = 0;
   });

   $.validator.addMethod( "option", function (value, element) {
        var flag = true;
        
        $("input[name^='trackNumData']").each(function (i, x) {
            $(this).closest('div.trackIdBlk').find(`#option${i}-error`).remove();
    
            const valDellInput = $.trim($(this).val());

            if ($.trim($(this).val()) == '' || $.trim($(this).val()) == null ) {
                flag = false;
   
                $(this).closest('div.trackIdBlk').append('<label  id="option' + i + '-error" class="error">Required option.</label>');
            }
            
        });
        return flag;
    }, "");

   // $('body').on('click', '#submitStatusChange', function () {
   //    var url = base_url + '/order/status_change';
      
   //    if ($("#shipStatus").is(":checked") == false ) {
   //       return false;
   //    }
      
   //    $.ajax({
   //       type: "POST",
   //       url: url,
   //       dataType: "JSON",
   //       data: {
   //          order_id: order_id,
   //          status: status
   //       },

   //       beforeSend: function () {
   //          show_loader();
   //       },

   //    }).done(function (data) {
   //       toastr.remove();
   //       if (data.status == 1) {
   //          hide_loader();
   //          toastr.success(data.message);
   //          window.setTimeout(function () {
   //             location.reload();
   //          }, 1000);
   //       } else if (data.status == -1) {
   //          //authetication failed
   //          toastr.error(data.msg);
   //          window.setTimeout(function () {
   //             window.location.href = data.url;
   //          }, 2000);
   //       } else {
   //          hide_loader();
   //          toastr.error(data.message);
   //       }
   //    });
   // });

   function changeStatus( shipmentId, shipmentStatus ) {
      var url = base_url + '/order/change_shipment_status';
      
      if ($(`#${shipmentId}`).is(":checked") == false ) {
         return false;
      }
      
      $.ajax({
         type: "POST",
         url: url,
         dataType: "JSON",
         data: {
            shipment_id: shipmentId,
            status: shipmentStatus+1
         },

         beforeSend: function () {
            show_loader();
         },

      }).done(function (data) {
         toastr.remove();
         if (data.status == 1) {
            hide_loader();
            toastr.success(data.message);
            window.setTimeout(function () {
               location.reload();
               // if( shipmentStatus == 8 ) {
               //    $(`#${shipmentId}`).hide();
               // }
            }, 1000);
         } else if (data.status == -1) {
            //authetication failed
            toastr.error(data.msg);
            window.setTimeout(function () {
               window.location.href = data.url;
            }, 2000);
         } else {
            hide_loader();
            toastr.error(data.message);
         }
      });
   };

    $("#length").on("keyup", function(){
        var valid = /^\d{1,3}(\.\d{0,2})?$/.test(this.value),
            val = this.value;
        
        if(!valid){
            console.log("Invalid input!");
            this.value = val.substring(0, val.length - 1);
        }
    });
    $("#height").on("keyup", function(){
        var valid = /^\d{1,3}(\.\d{0,2})?$/.test(this.value),
            val = this.value;
        
        if(!valid){
            console.log("Invalid input!");
            this.value = val.substring(0, val.length - 1);
        }
    });
    $("#width").on("keyup", function(){
        var valid = /^\d{1,3}(\.\d{0,2})?$/.test(this.value),
            val = this.value;
        
        if(!valid){
            console.log("Invalid input!");
            this.value = val.substring(0, val.length - 1);
        }
    });
    $("#weight").on("keyup", function(){
        var valid = /^\d{1,3}(\.\d{0,2})?$/.test(this.value),
            val = this.value;
        
        if(!valid){
            console.log("Invalid input!");
            this.value = val.substring(0, val.length - 1);
        }
    });
    $("#item_value").on("keyup", function(){
        var valid = /^\d{1,3}(\.\d{0,2})?$/.test(this.value),
            val = this.value;
        
        if(!valid){
            console.log("Invalid input!");
            this.value = val.substring(0, val.length - 1);
        }
    });

   function calculateQuoteAmnt() {
        const originalWeight = $('#weight').val(),
            length = $('#length').val(),
            height = $('#height').val(),
            width = $('#width').val(),
            itemVal = $('#item_value').val(),
            quantity = $('#quantity').val();

            let itemQuantity = itemVal * quantity;
            const getDimentionalWeight = (length*height*width)/139; 
            let countWeightAmnt = getDimentionalWeight * 6;
            const getItemValuePercent = (15/100)*itemQuantity;

        if( originalWeight > getDimentionalWeight ) {
            countWeightAmnt = originalWeight * 6;
        }

        const countTotalAmnt = getItemValuePercent + countWeightAmnt + 10;

        if( $('#item_value').val() > 0 && countWeightAmnt !== 0 ) {
            
            const areaCount = (length*height*width)/366,
                area_total_inch = areaCount/0.032808;

            $('#total').html(countTotalAmnt.toFixed(2));
            $('#totalValue').val(countTotalAmnt.toFixed(2));
            $('#area_total').val(area_total_inch.toFixed(2));

            $('#total').show();
            // $('#totalh').show();
        }else {
            $('#total').html("0.00");
            $('#totalValue').val(0);
        }

   }

   //function for adding new order by admin
   $("#add_shipment_qoute").validate({
      ignore: [],
      rules: {
         "content": {
               required: true
         },
         "trackingNumber": {
               required: true
         },
         "trackNumData[]": {
            option: true
         },
         "weight": {
               required: true,
               min: 1
         },
         "height": {
               required: true,
               min: 1
         },
         "length": {
               required: true,
               min: 1
         },
         "width": {
               required: true,
               min: 1
         },
         "item_value": {
               required: true,
               min: 1
         }
      },
      errorPlacement: function (error, element) {
         if (element.attr("name") == "trackingNumber") {
               error.insertAfter("#moreTrackId");
         }else {
               error.insertAfter(element);
         }
      }
      // ,
      // errorPlacement: function (error, element) {
      //    if (element.attr("name") == "weight") {
      //          error.insertBefore("#weightErr");
      //    }else if (element.attr("name") == "height") {
      //          error.insertBefore("#heightErr");
      //    }else if (element.attr("name") == "length") {
      //          error.insertBefore("#lenErr");
      //    }else if (element.attr("name") == "width") {
      //          error.insertBefore("#widthErr");
      //    }else {
      //          error.insertAfter(element);
      //    }
      // }

   });

   var add_shipment_qoute = $("#add_shipment_qoute");

   // $('body').on('click', '#addShipment', function (e) {
   $("#addShipment").click(function(e){
      // e.preventDefault();
      // const colorselector = $('#delveryType').val();
      // var uid = $('#usid').val();
      // toastr.remove();
      // event.preventDefault();
      
      if (add_shipment_qoute.valid() === false) {
         toastr.error("Please fill all the fields before proceeding.");
         return false;
      }

      if( $('#carrier').val() == "" ) {
         toastr.error("Please select carrier before proceed.");
         return false;
      }

      const tn = $('#trackingNumber').val(),
         optDataArray = [ tn ];

      $('input[name="trackNumData[]"]').map( function( ele ) {   
         optDataArray.push($(this).val()); 
      });

      const trackNumbers = optDataArray.join();

      var _that = $(this),
         form = _that.closest('form'),
         formData = new FormData(form[0]),
         f_action = form.attr('action');

         formData.append('tracking_numbers', trackNumbers);

      $.ajax({
         type: "POST",
         url: f_action,
         data: formData, //only input
         processData: false,
         contentType: false,
         dataType: "JSON",
         beforeSend: function () {
               show_loader();
         },
         success: function (data) {
               if (data.status == 1) {
                  setTimeout(function () {
                     window.location = data.url
                  },
                     2000)
                  // if (data.flag == '') {
                     toastr.success(data.message);
                  // }
               } else if (data.status == -1) {
                  //authetication failed
                  toastr.error(data.msg);
                  window.setTimeout(function () {
                     window.location.href = data.url;
                  }, 2000);
               } else {
                  toastr.error(data.message);
                  hide_loader();
               }
         },
      });
      e.stopImmediatePropagation();
      return false;
   });

   // ======================================================
   $( "#addMoreTrackNum" ).click( function() {
      countAddMore = countAddMore + 1;

      const addMoreHtml = `<div class="trackIdBlk">
         <div class="moreTrackId">
            <input class="form-control" type="text" name="trackNumData[]" placeholder="Enter Tracking Number">
            <label><button onclick="removeOptInput( this );"><i class="fa fa-times ship-cancel-remove" aria-hidden="true"></i></button></label>
         </div>
      </div>`;

      console.log("count", countAddMore );
      $( "#trakNumBlock" ).append( addMoreHtml );
   } );

   $( "#addMoreSeaTrackNum" ).click( function() {
      countAddMore = countAddMore + 1;

      const addMoreHtml = `<div class="trackIdBlk">
         <div class="moreTrackId">
            <input class="form-control" type="text" name="trackNumData[]" placeholder="Enter Tracking Number">
            <label><button onclick="removeOptInput( this );"><i class="fa fa-times ship-cancel-remove" aria-hidden="true"></i></button></label>
         </div>
      </div>`;

      console.log("count", countAddMore );
      $( "#seaTrakNumBlock" ).append( addMoreHtml );
   } );

   function removeOptInput( butt ){
      countAddMore = countAddMore - 1;
      $(butt).closest('div.trackIdBlk').remove();
   }

   //sea calculation 
   function admin_sea_calculation() {
      const sea = $('#item_sea').find(':selected').attr('data-id'),
         title = $('#item_sea').find(':selected').attr('data-title'),
         type = $('#item_sea').find(':selected').attr('data-type');

      $('#service_id_sea').val(sea);
      $('#title_sea').val(title);
      $('#type_sea').val(type);

      var item_sea = $('#item_sea').val();
      var quantity_sea = $('#quantity_sea').val();
      var amount = item_sea * quantity_sea;
      
      $('#total_sea').html(amount.toFixed(2));
   }

   //function for adding sea freight qoute
   $("#add_sea_shipment_qoute").validate({
      ignore: [],
      rules: {
         "content": {
               required: true
         },
         "seaTrackingNumber": {
               required: true
         },
         "trackNumData[]": {
            option: true
         },
         "item_sea": {
               required: true
         },
         "quantity_sea": {
               required: true
         }
      },
      errorPlacement: function (error, element) {
         if (element.attr("name") == "seaTrackingNumber") {
               error.insertAfter("#seaMoreTrackId");
         }else {
               error.insertAfter(element);
         }
      }
   });

   var add_sea_shipment_qoute = $("#add_sea_shipment_qoute");
   // $('body').on('click', '#newSeaOrder', function (e) {
   $("#addSeaShipment").click(function(){
      
      if (add_sea_shipment_qoute.valid() === false) {
         toastr.error(proceed_err);
         return false;
      }

      if( $('#seacarrier').val() == "" ) {
         toastr.error("Please select carrier before proceed.");
         return false;
      }

      const tn = $('#seaTrackingNumber').val(),
         optDataArray = [ tn ];

      $('input[name="trackNumData[]"]').map( function( ele ) {   
         optDataArray.push($(this).val()); 
      });

      const trackNumbers = optDataArray.join();
      console.log( "trackNumbers", trackNumbers );

      var _that = $(this),
         form = _that.closest('form'),
         formData = new FormData(form[0]),
         f_action = form.attr('action');

      formData.append('tracking_numbers', trackNumbers);

      $.ajax({
         type: "POST",
         url: f_action,
         data: formData,
         processData: false,
         contentType: false,
         dataType: "JSON",
         beforeSend: function () {
               show_loader();
         },
         success: function (data) {
               if (data.status == 1) {
                  setTimeout(function () {
                     window.location = data.url
                  },
                     2000)
                  // if (data.flag == '') {
                  toastr.success(data.message);
                  // }
               } else if (data.status == -1) {
                  //authetication failed
                  toastr.error(data.msg);
                  window.setTimeout(function () {
                     window.location.href = data.url;
                  }, 2000);
               } else {
                  toastr.error(data.message);
                  hide_loader();
               }
         },
      });
      e.stopImmediatePropagation();
      return false;
   });

</script>