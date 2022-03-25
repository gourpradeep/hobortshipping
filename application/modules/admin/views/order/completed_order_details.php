<?php 
   $header_images = getenv('APP_FRONT_ASSETS_IMAGES') . 'header';
   $content_images = getenv('APP_FRONT_ASSETS_IMAGES') . 'content';
   ?>
<div class="content">
   <div class="container-fluid">
      <div class="page-title-box box-spacing">
         <div class="row align-items-center">
            <div class="col-sm-6">
               <h4 class="page-title">Completed Order Detail</h4>
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
                <?php if($orderexist->service_type!=5){?>
                  <div class="col-md-7">
                     <div class="orderInfo-1">
                        <input type="hidden" name="id" id="id" value="<?php echo $orderexist->orderID?>">
                        <?php 
                        if ($orderexist->service_type ==1) {?>                                        
                        <h2>Air Freight</h2>
                        <!-- <div class="float-right freight-category">
                           <h3 class="priceValue"><?php echo $air_title->title; ?></h3>
                        </div> -->
                        <p><span class="mr-2">Price: <b><?php echo '$'.$orderexist->price?>,</b></span><span>Item Value: <b><?php echo $air->item_value; ?>,</b></span> <span>Quantity: <b><?php echo $orderexist->quantity?></b></span></p>
                        <h6 class="priceValue">Item Info</h6>
                        <div class="row">
                           <div class="col-md-3">
                              <div class="mt-2 basic-info-freight">
                                 <span>
                                 <img src="<?php echo getenv('APP_BACK_ASSETS_IMAGES'); ?>users/ruler-1.png" class="mr-3">Length
                                 </span>
                                 <h5><?php echo $air->length; ?> (Inches)</h5>
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="mt-2 basic-info-freight">
                                 <span><img src="<?php echo getenv('APP_BACK_ASSETS_IMAGES'); ?>users/ruler.png" class="mr-3">Height</span>
                                 <h5><?php echo $air->height; ?> (Inches)</h5>
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="mt-2 basic-info-freight">
                                 <span><img src="<?php echo getenv('APP_BACK_ASSETS_IMAGES'); ?>users/width.png" class="mr-3">Width</span>
                                 <h5><?php echo $air->width; ?> (Inches)</h5>
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="mt-2 basic-info-freight">
                                 <span><img src="<?php echo getenv('APP_BACK_ASSETS_IMAGES'); ?>users/weight.png" class="mr-3">Weight</span>
                                 <h5><?php echo $air->weight; ?> (Pound)</h5>
                              </div>
                           </div>
                        </div>
                        <?php }?>
                        <?php 
                           if ($orderexist->service_type ==2) {?>
                        <h2>Sea Freight</h2>
                        <div class="float-right freight-category">
                           <h3 class="priceValue"></h3>
                        </div>
                        <p><!-- <span class="mr-2">Price: <b>$25.00 ,</b></span> --> Quantity: <b><?php echo $orderexist->quantity?></b></p>
                        <h6 class="priceValue">Item: <b><?php echo $sea->title; ?></b></h6>
                        <?php if ($sea->type==1) {
                           $sea_type = 'Light';
                           }
                           else{
                           $sea_type = 'Heavy';
                           }
                           ?>
                        <h3 class="priceValue"><?php echo  '$'.$orderexist->price .' '.$sea_type;?></h3>
                        <?php }?>
                        <?php 
                        if ($orderexist->service_type ==3) {?>                                        
                            <h2>Courier & Express Services</h2>
                            <div class="float-right freight-category">
                               <h3 class="priceValue"></h3>
                            </div>
                            <p><!-- <span class="mr-2">Price: <b>$25.00 ,</b></span> --> Quantity: <b><?php echo $orderexist->quantity?></b></p>
                            <h6 class="priceValue">Item: <b><?php echo $courier->title .'- '.'$'.$courier->price ; ?></b></h6>
                            <h6 class="priceValue">Price: <b><?php echo '$'.$orderexist->price?></b></h6>
                            <?php }?>
                        <?php 
                        if ($orderexist->service_type ==4) {?>  
                            <h2>Concierge Shipping</h2>
                            <div class="price-tag">
                               <p><span class="mr-2">Total: <b><?php echo '$'.$concierge->offer_price; ?></b></span></p>
                            </div>
                             <p><span class="mr-2">Cost of order: <b><?php echo '$'.$concierge->order_cost; ?></b></span></p>
                            <p><span class="mr-2">Concierge Fee: <b><?php echo '$'.$concierge->concierge_fee; ?></b></span></p>
                            <h6 class="priceValue paraheading">Description</h6>
                            <p class="priceValue overflowp" style="white-space: pre-wrap;"><?php echo $concierge->description; ?></p>
                            <?php } ?>
                        <?php if(!empty($orderexist->receipt_file)){?>
                        <div class="invoiceSec">
                           <div class="recipetImg-1">
                              <!-- <a href="<?php echo base_url()?>backend_assets/images/users/reciept.png" download >
                                 <img src="<?php echo base_url()?>backend_assets/images/users/reciept.png"> -->
                                <?php if(!empty($orderexist->receipt_file)){
                                    if(in_array($orderexist->receipt_file_extension, imageExtension())){
                                        $receipt_file = getenv('S3_USER_RECEIPT_THUMB').$orderexist->receipt_file;
                                    }elseif(in_array($orderexist->receipt_file_extension, fileExtension())) {
                                        $receipt_file = $content_images.'/doc.png';
                                    }else{  
                                     $receipt_file = $content_images.'/pdf.png';
                                    }
                                } ?>
                                <img class="" src="<?php echo $receipt_file; ?>">
                           </div>
                           <a href="<?php echo base_url('order/receipt_download/download_reciept?image_name=').$orderexist->receipt_file;?>" download="">
                           <button type="button" class="btn btn-outline-success waves-effect waves-light mb-3">Download Receipt <i class="fa fa-download ml-2"></i></button>
                           </a>
                        </div>
                     <?php }?>
                     </div>
                  </div>
                <?php }else{?>
                <div class="col-md-5">
                     <div class="orderInfo-1 mt-4">
                        <h2>My Shipment Request</h2>
                        <p><span class="mr-2">Weight: <b><?php echo $orderexist->shipment_weight.'Kg'; ?></b></span></p>
                            <p><span class="mr-2">price: <b><?php echo '$'.$orderexist->price; ?></b></span></p>
                            <?php if(!empty($orderexist->receipt_file)){?>
                           <div class="invoiceSec">
                              <div class="recipetImg-1">
                                 <?php if(!empty($orderexist->receipt_file)){
                                    if(in_array($orderexist->receipt_file_extension, imageExtension())){
                                        $receipt_file = getenv('S3_USER_RECEIPT_THUMB').$orderexist->receipt_file;
                                    }elseif(in_array($orderexist->receipt_file_extension, fileExtension())) {
                                        $receipt_file = $content_images.'/doc.png';
                                    }else{  
                                        $receipt_file = $content_images.'/pdf.png';
                                    }
                                    } ?>
                                 <img class="" src="<?php echo $receipt_file; ?>">
                              </div>
                              <a href="<?php echo base_url('order/receipt_download/download_reciept?image_name=').$orderexist->receipt_file;?>" download="">
                              <button type="button" class="btn btn-outline-success waves-effect waves-light mb-3">Download Receipt <i class="fa fa-download ml-2"></i></button>
                              </a>
                           </div>
                           <?php }?>

                     </div>
                  </div>
                <?php }?>
                    <?php  if($orderexist->service_type == 1 ||$orderexist->service_type == 2||$orderexist->service_type == 3||$orderexist->service_type == 4){?>
                  <div class="col-md-5">
                     <div class="idproof-img orderInfo-1 mt-0 vehicle-info-data">
                        <div class="id-info">
                           <h6>Shipper Info</h6>
                        </div>
                        <p>Shipper Name : <b><?php echo !empty($orderexist->shipper_name)?$orderexist->shipper_name:'NA'; ?></b></p>

                        <p>Tracking ID : <b><?php echo !empty($orderexist->shipper_tracking_id)?'#'.$orderexist->shipper_tracking_id:'NA'; ?></b></p>
                        <p>Company Name : <b><?php echo !empty($orderexist->shipper_company_name)?$orderexist->shipper_company_name:'NA'; ?></b></p>
                        
                        
                        <h6 class="">Content</h6>
                        <p class="priceValue overflowp" style="white-space: pre-wrap;"><?php echo !empty($orderexist->shipper_description)?$orderexist->shipper_description:'NA'; ?></p>
                     </div>
                  </div>
                  <?php } else{?>
                  <div class="col-md-7">
                     <div class="idproof-img orderInfo-1 mt-4 vehicle-info-data">
                        <div class="id-info">
                           <h6>Shipper Info</h6>
                        </div>
                        <p>Shipper Name : <b><?php echo $orderexist->shipper_name?></b></p>
                        <p>Receiver Name : <b><?php echo $orderexist->shipment_receiver_name?></b></p>
                        <p>Origin : <b><?php echo $orderexist->shipment_origin?></b></p>
                        <p>Value : <b><?php echo $orderexist->shipment_value?></b></p>
                        <p class="trackingId">Tracking ID : <b data-container="body" data-toggle="popover">#<?php echo $orderexist->shipment_tracking_ids ;?></b></p>
                        <h6 class="">Content</h6>
                        <p class="priceValue overflowp" style="white-space: pre-wrap;"><?php echo !empty($orderexist->shipper_description)?$orderexist->shipper_description:'NA'; ?></p>
                     </div>
                  </div>
                  <?php }?>                  
                  <div class="col-md-12">
                     <div class="trackingBox-1 mt-4">
                        <div class="trackingBox">
                           <div class="trackingInfo">
                            <?php if(!empty($orderexist->drop_location)){?>
                              <div class="drop-address">
                                 <p>Dropped Address</p>
                                 <h6><i class="fas fa-map-marker-alt mr-2"></i><?php echo  ucfirst($orderexist->drop_location); ?></h6>
                               
                              </div>
                            <?php }?>
                              <div class="trackId noBorder">
                                 <p>Tracking ID: <b>#<?php echo !empty($orderexist->tracking_id)?$orderexist->tracking_id:'NA'; ?></b></p>
                              </div>
                              <?php
                                 $orderStatus = json_decode($orderexist->status_updated_at);
                                 ?>
                              <div class="stepBlock">
                                 <ul class="StepProgress">
                                    <li class="StepProgress-item <?php if($orderexist->status >=3 ){ echo 'is-done';}elseif($orderexist->status==1){ echo 'current'; }else{echo '';}?>">
                                       <div class="stepItem">
                                            <div class="stepInfo">
                                                <h4>Shipped by customer</h4>
                                                <?php if($orderexist->status >=3){?>
                                                <p><?php echo date('d M Y', strtotime($orderStatus->shipped_by_customer_at)); ?></p>
                                                <?php }?>
                                            </div>
                                       </div>
                                    </li>
                                    <li class="StepProgress-item <?php if($orderexist->status >=4 ){ echo 'is-done';}elseif($orderexist->status==4){ echo 'current'; }else{echo '';}?>">
                                       <div class="stepItem">
                                          <div class="stepInfo">
                                             <h4>Received by Hobort</h4>
                                             <!-- <p>Order approved on 23rd Dec 2019</p>
                                                -->                             <?php if($orderexist->status >=4){?>
                                             <p><?php echo date('d M Y', strtotime($orderStatus->received_from_customer_at)); ?></p>
                                             <?php }?>
                                          </div>
                                       </div>
                                    </li>
                                    <li class="StepProgress-item <?php if($orderexist->status >=5){ echo 'is-done';}elseif($orderexist->status==5){ echo 'current'; }else{echo '';}?>">
                                       <div class="stepItem">
                                          <div class="stepInfo">
                                             <h4>Packed</h4>
                                             <?php if($orderexist->status >=5){?>
                                             <p><?php echo date('d M Y', strtotime($orderStatus->packed_at)); ?></p>
                                             <?php }?>
                                          </div>
                                       </div>
                                       <!-- <button type="button" class="btn btn-secondary approve-btn float-right">Change</button> -->
                                    </li>
                                    <li class="StepProgress-item <?php if($orderexist->status >=6){ echo 'is-done';}elseif($orderexist->status==6){ echo 'current'; }else{echo '';}?>">
                                       <div class="stepItem">
                                          <div class="stepInfo">
                                             <h4>On the way</h4>
                                             <?php if($orderexist->status >=6){?>
                                             <p><?php echo date('d M Y', strtotime($orderStatus->on_the_way_at)); ?></p>
                                             <?php }?>
                                          </div>
                                       </div>
                                       <!-- <button type="button" class="btn btn-secondary approve-btn float-right">Change</button> -->
                                    </li>
                                    <li class="StepProgress-item <?php if($orderexist->status>=7){ echo 'is-done';}elseif($orderexist->status==7){ echo 'current'; }else{echo '';}?>">
                                       <div class="stepItem">
                                          <div class="stepInfo">
                                             <h4>Delivered</h4>
                                             <?php if($orderexist->status >=7){?>
                                             <p> 
                                             <p><?php echo date('d M Y', strtotime($orderStatus->delivered_at)); ?></p>
                                             <?php }?></p>
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
            </div>
         </div>
      </div>
   </div>
   <!-- container-fluid -->
</div>
<!-- content -->
</div>
<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->
</div>
<!-- <script type="text/javascript">
   $('.checkboxes').click(function() {
   if ($(this).is(':checked')) {
      var stat = $(this).attr('statusValue');
       $('#check_value').val(stat);
   }else{
      $('#check_value').val('');
   }
   });
   
   function show_loader() {
   $("#tl_admin_loader").show();
   }
   
   function hide_loader() {
   $("#tl_admin_loader").hide();
   }
   $('#submitStatus').on('click',function(){
    var url = base_url + '/order/status_change';
    var status = $('#check_value').val();
    var order_id = $('#order_id').val();
    // alert(order_id);
    if(status==''){
      return false;
    }
    // console.log(file_name);
    $.ajax({
        type: "POST",
        url: url,
        dataType: "JSON",
        data: {
            order_id: order_id,
            status:status
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
                }, 1000);
        } else {
            hide_loader();
            toastr.error(data.message);
        }
   });
   
   });
   </script> -->