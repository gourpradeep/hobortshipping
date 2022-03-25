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
                  <h4 class="page-title">Completed Orders Detail</h4>
                  <ol class="breadcrumb">
                     <!-- <li class="breadcrumb-item active">Welcome to Hobort</li> -->
                  </ol>
               </div>
            </div>
         </div>
         <!-- end row -->
         <div class="">
            <div class="customer-info pt-5">
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
                                 <!-- <div class="drop-address">
                                    <div class="text-right">
                                       
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
                                                   <input type="checkbox" class="checkboxes" <?php  if($orderexist->status >=3 || $orderexist->status <= 2){echo "disabled";} ?>  <?php  if($orderexist->status >=3){echo "checked";} ?>  statusValue="3">
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
                                 </div> -->

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
                                       <li class="StepProgress-item newe <?php if($orderexist->status >=9 ){ echo 'is-done';}elseif($orderexist->status==8){ echo 'current'; }else{echo '';}?>">
                                          <div class="stepItem">
                                             <div class="stepInfo">
                                                <h4>Shipment Cleared</h4>
                                                <?php if($orderexist->status >=9){ ?>
                                                   <p><?php echo date('d M Y', strtotime($orderStatus->shipment_cleared)); ?></p>
                                                <?php } ?>
                                             </div>
                                          </div>
                                       </li>
                                       
                                    </ul>
                                 </div>

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
                           <!-- <?php if($orderexist->service_type == 1){ ?>
                              <div class="shipment-add-btn" data-toggle="modal" data-target="#addAirModal">
                                 <img src="<?php echo getenv('APP_BACK_ASSETS_IMAGES'); ?>users/plus_ico.png">
                              </div>
                           <?php }else { ?>
                              <div class="shipment-add-btn" data-toggle="modal" data-target="#addSeaModal">
                                 <img src="<?php echo getenv('APP_BACK_ASSETS_IMAGES'); ?>users/plus_ico.png">
                              </div>
                           <?php } ?> -->
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
                                             <!-- <ul class="dropdown-menu dropdown-menu-form  dropdown-menu-right drpdwn-section drpdwn-wh new-status-section new-status-section-second" role="menu">
                                                <li>
                                                   <label class="checkbox">
                                                      <?php if( $ordersipments[$f]->status != 9 ) { ?>
                                                         <input type="checkbox" id="<?php echo $ordersipments[$f]->og_id; ?>">
                                                      <?php } ?>
                                                      <?php if( $ordersipments[$f]->status == 3 ) { ?>
                                                         Package preparing to ship
                                                      <?php }else if( $ordersipments[$f]->status == 4 ) { ?>
                                                         Shipment dropped off at Atlanta Airport
                                                      <?php }else if( $ordersipments[$f]->status == 5 ) { ?>
                                                         Shipment in Transit
                                                      <?php }else if( $ordersipments[$f]->status == 6 ) { ?>
                                                         Shipment Arrived in Accra
                                                      <?php }else if( $ordersipments[$f]->status == 7 ) { ?>
                                                         Customs Clearance Started
                                                      <?php }else { ?>
                                                         Shipment Cleared
                                                      <?php } ?>
                                                   </label>
                                                </li>
                                                <?php if( $ordersipments[$f]->status != 9 ) { ?>
                                                   <button type="button" onClick="changeStatus(<?php echo $ordersipments[$f]->og_id; ?>, <?php echo $ordersipments[$f]->status; ?>);" class="btn btn-secondary dn-btn text-center">Done</button>
                                                <?php } ?>
                                             </ul> -->
                                             <?php if( $ordersipments[$f]->status == 3 ) { ?>
                                                <p>Package Received at our warehouse</p>
                                             <?php }else if( $ordersipments[$f]->status == 4 ) { ?>
                                                <p>Package preparing to ship</p>
                                             <?php }else if( $ordersipments[$f]->status == 5 ) { ?>
                                                <p>Shipment dropped off at Atlanta Airport</p>
                                             <?php }else if( $ordersipments[$f]->status == 6 ) { ?>
                                                <p>Shipment in Transit</p>
                                             <?php }else if( $ordersipments[$f]->status == 7 ) { ?>
                                                <p>Shipment Arrived in Accra</p>
                                             <?php }else if( $ordersipments[$f]->status == 8 ) { ?>
                                                <p>Customs Clearance Started</p>
                                             <?php }else { ?>
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
                                             <!-- <ul class="dropdown-menu dropdown-menu-form  dropdown-menu-right drpdwn-section drpdwn-wh new-status-section new-status-section-second" role="menu">
                                                <li>
                                                   <label class="checkbox">
                                                   <?php if( $ordersipments[$f]->status != 9 ) { ?>
                                                         <input type="checkbox" id="<?php echo $ordersipments[$f]->og_id; ?>">
                                                      <?php } ?>
                                                      <?php if( $ordersipments[$f]->status == 3 ) { ?>
                                                         Package preparing to ship
                                                      <?php }else if( $ordersipments[$f]->status == 4 ) { ?>
                                                         Shipment dropped off at Atlanta Airport
                                                      <?php }else if( $ordersipments[$f]->status == 5 ) { ?>
                                                         Shipment in Transit
                                                      <?php }else if( $ordersipments[$f]->status == 6 ) { ?>
                                                         Shipment Arrived in Accra
                                                      <?php }else if( $ordersipments[$f]->status == 7 ) { ?>
                                                         Customs Clearance Started
                                                      <?php }else { ?>
                                                         Shipment Cleared
                                                      <?php } ?>
                                                   </label>
                                                </li>
                                                <?php if( $ordersipments[$f]->status != 9 ) { ?>
                                                   <button type="button" onClick="changeStatus(<?php echo $ordersipments[$f]->og_id; ?>, <?php echo $ordersipments[$f]->status; ?>);" class="btn btn-secondary dn-btn text-center">Done</button>
                                                <?php } ?>
                                             </ul> -->

                                             <?php if( $ordersipments[$f]->status == 3 ) { ?>
                                                   <p>Package Received at our warehouse</p>
                                                <?php }else if( $ordersipments[$f]->status == 4 ) { ?>
                                                   <p>Package preparing to ship</p>
                                                <?php }else if( $ordersipments[$f]->status == 5 ) { ?>
                                                   <p>Shipment dropped off at Atlanta Airport</p>
                                                <?php }else if( $ordersipments[$f]->status == 6 ) { ?>
                                                   <p>Shipment in Transit</p>
                                                <?php }else if( $ordersipments[$f]->status == 7 ) { ?>
                                                   <p>Shipment Arrived in Accra</p>
                                                <?php }else if( $ordersipments[$f]->status == 8 ) { ?>
                                                   <p>Customs Clearance Started</p>
                                                <?php }else { ?>
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

