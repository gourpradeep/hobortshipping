<?php
   $header_images = getenv('APP_FRONT_ASSETS_IMAGES') . 'header';
   $content_images = getenv('APP_FRONT_ASSETS_IMAGES') . 'content'
   ?>
<?php if(!empty($orderexist->tracking_id)){?>
<?php if(!empty($orderexist->receipt_file)){
   if(in_array($orderexist->receipt_file_extension, imageExtension())){
       $receipt_file = getenv('S3_USER_RECEIPT_THUMB').$orderexist->receipt_file;
   }elseif(in_array($orderexist->receipt_file_extension, fileExtension())) {
       $receipt_file = $content_images.'/doc.png';
   }else{  
       $receipt_file = $content_images.'/pdf.png';
   }
   } ?>
<input type="hidden" name="downloadImageName" id="downloadImageName" value="<?php echo $orderexist->receipt_file;?>">
<div class="mainWrapper innerPageWrapper">
<section class="orderDetails sec-pad-30">
   <div class="container">
      <div class="orderDetailsBlk">
         <div class="row">
            <?php if($orderexist->service_type ==1) { ?>
            <div class="col-lg-5 col-md-6">
               <div class="boxViewShadow">
                  <div class="boxBody">
                     <div class="orderInfoBlk">
                        <h2 class="orderDelType">Air Freight</h2>
                        <div class="orderMoreInfo">
                           <ul>
                              <li>Item : <span><?php echo $air_title->title ?></span></li>
                              <li>Price : <span>$<?php echo $orderexist->price; ?></span></li>
                              <li>Item Value : <span><?php echo $air->item_value; ?></span></li>
                              <li>Quantity: <span><?php echo $orderexist->quantity; ?></span></li>
                           </ul>
                        </div>
                        <div class="item-info-section">
                           <h4>Item Info</h4>
                           <div class="height-section">
                              <span><img src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>height.png">Height</span>
                              <div class="hwlw-section text-right">
                                 <h5><?php echo $air->height; ?> (Feet)</h5>
                              </div>
                           </div>
                           <div class="height-section">
                              <span><img src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>width.png">Width</span>
                              <div class="hwlw-section text-right">
                                 <h5><?php echo $air->width; ?> (Feet)</h5>
                              </div>
                           </div>
                           <div class="height-section">
                              <span><img src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>tape-measure.png">Length</span>
                              <div class="hwlw-section text-right">
                                 <h5><?php echo $air->length; ?> (Feet)</h5>
                              </div>
                           </div>
                           <div class="height-section">
                              <span><img src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>weight.png">weight</span>
                              <div class="hwlw-section text-right">
                                 <h5><?php echo $air->weight; ?> (Kg)</h5>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <?php if(is_user_logged_in()) { ?>
               <div class="boxViewShadow mt-30">
                  <div class="boxHeader">
                     <h2>Receipt</h2>
                  </div>
                  <div class="boxBody">
                     <?php if(!empty($orderexist->receipt_file)){ ?>
                     <div class="recipetImg" id="onrefresh">
                        <a href="<?php echo base_url('order/receipt_download/download_reciept?image_name=').$orderexist->receipt_file;?>">
                        <img src="<?php echo $receipt_file;?>" class="preview">
                        </a>
                        <a class="ripple button-class btn text-left dwnlod-btn" href="<?php echo base_url('order/receipt_download/download_reciept?image_name=').$orderexist->receipt_file;?>">Download Receipt<span class="fa fa-download"></span></a>
                     </div>
                     <?php }?>
                     <div class="receiptBlk">
                        <label class="uploadBtn ripple" for="invoice">Upload Receipt <span class="fa fa-upload"></span><input id="invoice" type="file" onchange="upload_reciept(this,'<?php echo $orderexist->orderID; ?>')" name="invoice"></label>
                     </div>
                  </div>
               </div>
               <?php } else {?>
               <div class="boxViewShadow mt-30">
                  <div class="boxHeader">
                     <h2>Receipt</h2>
                  </div>
                  <div class="boxBody">
                     <?php if(!empty($orderexist->receipt_file)){ ?>
                     <div class="recipetImg" id="onrefresh">
                        <a href="<?php echo base_url('order/receipt_download/download_reciept?image_name=').$orderexist->receipt_file;?>">
                        <img src="<?php echo $receipt_file;?>" class="preview">
                        </a>
                        <a class="ripple button-class btn text-left dwnlod-btn" href="<?php echo base_url('auth/login');?>">Login to download receipt<span class="fa fa-download"></span></a>
                     </div>
                     <?php }?>
                  </div>
               </div>
               <?php }?> 
            </div>
            <?php }?>
            <?php if($orderexist->service_type ==2) { 
               if($sea->type==1){
                   $type = 'Light';
               }else{
               
                   $type = 'Heavy';
               }
               ?>
            <div class="col-lg-5 col-md-6">
               <div class="boxViewShadow">
                  <div class="boxBody">
                     <div class="orderInfoBlk">
                        <h2 class="orderDelType">Sea Freight</h2>
                        <div class="orderMoreInfo">
                           <ul>
                              <li>Item : <span><?php echo $sea->title." - $".$sea->price; ?></span></li>
                              <li>Quantity: <span><?php echo $orderexist->quantity; ?></span></li>
                              <p class="priceValue">$<?php echo number_format($sea->price*$orderexist->quantity,2).' '.$type; ?></p>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
               <?php if(is_user_logged_in()) { ?>
               <div class="boxViewShadow mt-30">
                  <div class="boxHeader">
                     <h2>Receipt</h2>
                  </div>
                  <div class="boxBody">
                     <?php if(!empty($orderexist->receipt_file)){ ?>
                     <div class="recipetImg" id="onrefresh">
                        <a href="<?php echo base_url('order/receipt_download/download_reciept?image_name=').$orderexist->receipt_file;?>">
                        <img src="<?php echo $receipt_file;?>" class="preview">
                        </a>
                        <a class="ripple button-class btn text-left dwnlod-btn" href="<?php echo base_url('order/receipt_download/download_reciept?image_name=').$orderexist->receipt_file;?>">Download Receipt<span class="fa fa-download"></span></a>
                     </div>
                     <?php }?>
                     <div class="receiptBlk">
                        <label class="uploadBtn ripple" for="invoice">Upload Receipt <span class="fa fa-upload"></span><input id="invoice" type="file" onchange="upload_reciept(this,'<?php echo $orderexist->orderID; ?>')" name="invoice"></label>
                     </div>
                  </div>
               </div>
               <?php } else {?>
               <div class="boxViewShadow mt-30">
                  <div class="boxHeader">
                     <h2>Receipt</h2>
                  </div>
                  <div class="boxBody">
                     <?php if(!empty($orderexist->receipt_file)){ ?>
                     <div class="recipetImg" id="onrefresh">
                        <a href="<?php echo base_url('order/receipt_download/download_reciept?image_name=').$orderexist->receipt_file;?>">
                        <img src="<?php echo $receipt_file;?>" class="preview">
                        </a>
                        <a class="ripple button-class btn text-left dwnlod-btn" href="<?php echo base_url('auth/login');?>">Login to download receipt<span class="fa fa-download"></span></a>
                     </div>
                     <?php }?>
                  </div>
               </div>
               <?php }?>
            </div>
            <?php }?>
            <?php if($orderexist->service_type ==3) { ?>
            <div class="col-lg-5 col-md-6">
               <div class="boxViewShadow">
                  <div class="boxBody">
                     <div class="orderInfoBlk">
                        <h2 class="orderDelType">Courier & Express Services</h2>
                        <div class="orderMoreInfo">
                           <ul>
                              <li>Item : <span><?php echo $courier->title." - $".$courier->price; ?></span></li>
                              <li>Price : <span>$<?php echo number_format($courier->price*$orderexist->quantity,2); ?></span></li>
                              <li>Quantity: <span><?php echo $orderexist->quantity; ?></span></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
               <?php if(is_user_logged_in()) { ?>
               <div class="boxViewShadow mt-30">
                  <div class="boxHeader">
                     <h2>Receipt</h2>
                  </div>
                  <div class="boxBody">
                     <?php if(!empty($orderexist->receipt_file)){ ?>
                     <div class="recipetImg" id="onrefresh">
                        <a href="<?php echo base_url('order/receipt_download/download_reciept?image_name=').$orderexist->receipt_file;?>">
                        <img src="<?php echo $receipt_file;?>" class="preview">
                        </a>
                        <a class="ripple button-class btn text-left dwnlod-btn" href="<?php echo base_url('order/receipt_download/download_reciept?image_name=').$orderexist->receipt_file;?>">Download Receipt<span class="fa fa-download"></span></a>
                     </div>
                     <?php }?>
                     <div class="receiptBlk">
                        <label class="uploadBtn ripple" for="invoice">Upload Receipt <span class="fa fa-upload"></span><input id="invoice" type="file" onchange="upload_reciept(this,'<?php echo $orderexist->orderID; ?>')" name="invoice"></label>
                     </div>
                  </div>
               </div>
               <?php } else {?>
               <div class="boxViewShadow mt-30">
                  <div class="boxHeader">
                     <h2>Receipt</h2>
                  </div>
                  <div class="boxBody">
                     <?php if(!empty($orderexist->receipt_file)){ ?>
                     <div class="recipetImg" id="onrefresh">
                        <a href="<?php echo base_url('order/receipt_download/download_reciept?image_name=').$orderexist->receipt_file;?>">
                        <img src="<?php echo $receipt_file;?>" class="preview">
                        </a>
                        <a class="ripple button-class btn text-left dwnlod-btn" href="<?php echo base_url('auth/login');?>">Login to download receipt<span class="fa fa-download"></span></a>
                     </div>
                     <?php }?>
                  </div>
               </div>
               <?php }?>
            </div>
            <?php }?>
            <?php if($orderexist->service_type ==4) { ?>
            <div class="col-lg-5 col-md-6">
               <div class="boxViewShadow">
                  <div class="boxBody">
                     <!-- <div class="orderInfoBlk">
                        <h2 class="orderDelType">Concierge Shipping</h2>
                        <div class="orderMoreInfo">
                           <ul>
                              <li>Cost of order : <span><?php echo '$'.$concierge->order_cost; ?></span></li>
                              <li>Concierge Fee : <span><?php echo '$'.$concierge->concierge_fee; ?></span></li>
                           </ul>
                        </div>
                        <div class="csDesc">
                           <p class="priceValue overflowp" style="white-space: pre-wrap;"><?php echo !empty($concierge->description)?$concierge->description:'NA'; ?></p>
                        </div>
                        </div> -->
                     <div class="orderInfoBlk">
                        <h2 class="orderDelType">Concierge Shipping</h2>
                        <div class="orderMoreInfo">
                           <ul>
                              <li>Price : <span><?php echo '$'.$concierge->offer_price; ?></span></li>
                           </ul>
                        </div>
                        <div class="csDesc">
                           <p class="priceValue overflowp" style="white-space: pre-wrap;"><?php echo !empty($concierge->description)?$concierge->description:'NA'; ?></p>
                        </div>
                     </div>
                  </div>
               </div>
               <?php if(is_user_logged_in()) { ?>
               <div class="boxViewShadow mt-30">
                  <div class="boxHeader">
                     <h2>Receipt</h2>
                  </div>
                  <div class="boxBody">
                     <?php if(!empty($orderexist->receipt_file)){ ?>
                     <div class="recipetImg" id="onrefresh">
                        <a href="<?php echo base_url('order/receipt_download/download_reciept?image_name=').$orderexist->receipt_file;?>">
                        <img src="<?php echo $receipt_file;?>" class="preview">
                        </a>
                        <a class="ripple button-class btn text-left dwnlod-btn" href="<?php echo base_url('order/receipt_download/download_reciept?image_name=').$orderexist->receipt_file;?>">Download Receipt<span class="fa fa-download"></span></a>
                     </div>
                     <?php }?>
                     <div class="receiptBlk">
                        <label class="uploadBtn ripple" for="invoice">Upload Receipt <span class="fa fa-upload"></span><input id="invoice" type="file" onchange="upload_reciept(this,'<?php echo $orderexist->orderID; ?>')" name="invoice"></label>
                     </div>
                  </div>
               </div>
               <?php } else {?>
               <div class="boxViewShadow mt-30">
                  <div class="boxHeader">
                     <h2>Receipt</h2>
                  </div>
                  <div class="boxBody">
                     <?php if(!empty($orderexist->receipt_file)){ ?>
                     <div class="recipetImg" id="onrefresh">
                        <a href="<?php echo base_url('order/receipt_download/download_reciept?image_name=').$orderexist->receipt_file;?>">
                        <img src="<?php echo $receipt_file;?>" class="preview">
                        </a>
                        <a class="ripple button-class btn text-left dwnlod-btn" href="<?php echo base_url('auth/login');?>">Login to download receipt<span class="fa fa-download"></span></a>
                     </div>
                     <?php }?>
                  </div>
               </div>
               <?php }?>
            </div>
            <?php }?>
            <?php if($orderexist->service_type ==5) { ?>
            <div class="col-lg-5 col-md-6">
               <div class="boxViewShadow">
                  <div class="boxBody">
                     <div class="orderInfoBlk">
                        <h2 class="orderDelType">My Shipment</h2>
                        <div class="orderMoreInfo">
                           <ul>
                              <li>Weight : <span><?php echo !empty($orderexist->shipment_weight)?$orderexist->shipment_weight.'Kg':'NA'; ?></span></li>
                              <?php if($orderexist->price=='0.00'){
                                 $price = 'NA';
                                 }else{
                                 $price = '$'.$orderexist->price;
                                 }?>
                              <li>Price : <span><?php echo $price ;?></span></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
               <?php if(is_user_logged_in()) { ?>
               <div class="boxViewShadow mt-30">
                  <div class="boxHeader">
                     <h2>Receipt</h2>
                  </div>
                  <div class="boxBody">
                     <?php if(!empty($orderexist->receipt_file)){ ?>
                     <div class="recipetImg" id="onrefresh">
                        <a href="<?php echo base_url('order/receipt_download/download_reciept?image_name=').$orderexist->receipt_file;?>">
                        <img src="<?php echo $receipt_file;?>" class="preview">
                        </a>
                        <a class="ripple button-class btn text-left dwnlod-btn" href="<?php echo base_url('order/receipt_download/download_reciept?image_name=').$orderexist->receipt_file;?>">Download Receipt<span class="fa fa-download"></span></a>
                     </div>
                     <?php }?>
                     <div class="receiptBlk">
                        <label class="uploadBtn ripple" for="invoice">Upload Receipt <span class="fa fa-upload"></span><input id="invoice" type="file" onchange="upload_reciept(this,'<?php echo $orderexist->orderID; ?>')" name="invoice"></label>
                     </div>
                  </div>
               </div>
               <?php } else {?>
               <div class="boxViewShadow mt-30">
                  <div class="boxHeader">
                     <h2>Receipt</h2>
                  </div>
                  <div class="boxBody">
                     <?php if(!empty($orderexist->receipt_file)){ ?>
                     <div class="recipetImg" id="onrefresh">
                        <a href="<?php echo base_url('order/receipt_download/download_reciept?image_name=').$orderexist->receipt_file;?>">
                        <img src="<?php echo $receipt_file;?>" class="preview">
                        </a>
                        <a class="ripple button-class btn text-left dwnlod-btn" href="<?php echo base_url('auth/login');?>">Login to download receipt<span class="fa fa-download"></span></a>
                     </div>
                     <?php }?>
                  </div>
               </div>
               <?php }?>
            </div>
            <?php }?>
            <div class="col-lg-7 col-md-6">
               <div class="boxViewBorder">
                  <div class="boxHeader">
                     <h2>Shipper Info</h2>
                  </div>
                  <?php if($orderexist->service_type ==5){?>
                  <div class="boxBody">
                     <div class="shipperInfo noBorderInfo">
                        <div class="shipInfoItem">
                           <p>Shipper Name :</p>
                           <b><?php echo !empty($orderexist->shipper_name)?$orderexist->shipper_name:'NA'; ?></b>
                        </div>
                        <div class="shipInfoItem">
                           <p>Receiver Name :</p>
                           <b><?php echo !empty($orderexist->shipment_receiver_name)?$orderexist->shipment_receiver_name:'NA'; ?></b>
                        </div>
                        <div class="shipInfoItem">
                           <p>Tracking ID :</p>
                           <b><?php echo !empty($orderexist->shipment_tracking_ids)?$orderexist->shipment_tracking_ids:'NA'; ?></b>
                        </div>
                        <div class="shipInfoItem">
                           <p>Origin :</p>
                           <b><?php echo !empty($orderexist->shipment_origin)?$orderexist->shipment_origin:'NA'; ?></b>
                        </div>
                        <div class="shipInfoItem">
                           <p>Total Value :</p>
                           <b><?php echo !empty($orderexist->shipment_value)?$orderexist->shipment_value:'NA'; ?></b>
                        </div>
                       <!--  <div class="shipInfoItem">
                           <p>Content :</p>
                           <b style="white-space: pre-wrap;"><?php echo !empty($orderexist->shipper_description)?$orderexist->shipper_description:'NA'; ?></b>
                        </div> -->
                         <div class=" shipInfoItem csDesc">
                           <label>Content</label>
                           <p class="priceValue overflowp" style="white-space: pre-wrap;"><?php echo !empty($orderexist->shipper_description)?$orderexist->shipper_description:'NA'; ?></p>
                        </div>
                     </div>
                  </div>
                  <?php } else{?>
                  <div class="boxBody">
                     <div class="shipperInfo">
                        <div class="shipInfoItem">
                           <p>Shipper Name :</p>
                           <b><?php echo !empty($orderexist->shipper_name)?$orderexist->shipper_name:'NA'; ?></b>
                        </div>
                        <div class="shipInfoItem">
                           <p>Tracking ID :</p>
                           <b><?php echo !empty($orderexist->shipper_tracking_id)?'#'.$orderexist->shipper_tracking_id:'NA'; ?></b>                        
                        </div>
                        <div class="shipInfoItem">
                           <p>Company Name :</p>
                           <b><?php echo !empty($orderexist->shipper_company_name)?$orderexist->shipper_company_name:'NA'; ?>
                        </div>
                       <!--  <div class="shipInfoItem">
                           <p>Content :</p>
                           <b style="white-space: pre-wrap;"><?php echo !empty($orderexist->shipper_description)?$orderexist->shipper_description:'NA'; ?></b>
                        </div> -->
                         <div class=" shipInfoItem csDesc">
                           <label>Content</label>
                           <p class="priceValue overflowp" style="white-space: pre-wrap;"><?php echo !empty($orderexist->shipper_description)?$orderexist->shipper_description:'NA'; ?></p>
                        </div>
                     </div>
                     <div class="deliverAdd">
                        <div class="lcImg">
                           <span class="material-icons-outline md-location_on"></span>
                        </div>
                        <div class="locationInfo">
                           <label>Drop your item here</label>
                           <h4><?php echo !empty($orderexist->drop_location)?$orderexist->drop_location:'NA'; ?></h4>
                        </div>
                     </div>
                  </div>
                  <?php } ?>
                  <?php $orderStatus = json_decode($orderexist->status_updated_at);?>
               </div>
               <div class="boxViewBorder mt-30">
                  <div class="boxHeader">
                     <h2>Tracking Info</h2>
                  </div>
                  <div class="boxBody">
                     <div class="trackId">
                        <p>Tracking ID:<b>#<?php echo !empty($orderexist->tracking_id)?$orderexist->tracking_id:'NA'; ?></b></p>
                     </div>
                     <div class="stepBlock">
                        <ul class="StepProgress">
                            <!-- <li class="StepProgress-item <?php if($orderexist->status >=3 ){ echo 'is-done';}elseif($orderexist->status==2){ echo 'current'; }else{echo '';}?>">
                              <div class="stepItem">
                                 <div class="stepInfo">
                                    <h4>Shipped by me</h4>
                                    <p><?php echo date('d M Y', strtotime($orderStatus->shipped_by_customer_at)); ?></p>
                                    </p>
                                 </div>
                              </div>
                           </li> -->
                           <li class="StepProgress-item is-done">
                              <div class="stepItem">
                                 <div class="stepInfo">
                                    <h4>Shipped by me</h4>
                                    <p> <?php echo date('d M Y', strtotime($orderStatus->shipped_by_customer_at)); ?></p>
                                    </p>
                                 </div>
                              </div>
                           </li>
                           <li class="StepProgress-item <?php if($orderexist->status >=4 ){ echo 'is-done';}elseif($orderexist->status==3){ echo 'current'; }else{echo '';}?>">
                              <div class="stepItem">
                                 <div class="stepInfo">
                                    <h4>Received by Hobort</h4>
                                    <?php if($orderexist->status >=4){?>
                                    <p><?php echo date('d M Y', strtotime($orderStatus->received_from_customer_at)); ?></p>
                                    <?php }?>
                                 </div>
                              </div>
                           </li>
                           <li class="StepProgress-item <?php if($orderexist->status >=5){ echo 'is-done';}elseif($orderexist->status==4){ echo 'current'; }else{echo '';}?>">
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
                           <li class="StepProgress-item <?php if($orderexist->status >=6){ echo 'is-done';}elseif($orderexist->status==5){ echo 'current'; }else{echo '';}?>">
                              <div class="stepItem">
                                 <div class="stepInfo">
                                    <h4>On the way</h4>
                                    <?php if($orderexist->status >=6){?>
                                    <p> <?php echo date('d M Y', strtotime($orderStatus->on_the_way_at)); ?></p>
                                    <?php }?>
                                 </div>
                              </div>
                              <!-- <button type="button" class="btn btn-secondary approve-btn float-right">Change</button> -->
                           </li>
                           <li class="StepProgress-item <?php if($orderexist->status>=7){ echo 'is-done';}elseif($orderexist->status==6){ echo 'current'; }else{echo '';}?>">
                              <div class="stepItem">
                                 <div class="stepInfo">
                                    <h4>Delivered</h4>
                                    <?php if($orderexist->status >=7){?>
                                    <p> <?php echo date('d M Y', strtotime($orderStatus->delivered_at)); ?></p>
                                    <?php }?>
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
</section>
<?php } else{?>

<div class="mainWrapper innerPageWrapper">
<section class="orderDetails sec-pad-30">
   <div class="container">
      <div class="orderDetailsBlk">
         <div class="row">
           
       
           
            <div class="col-lg-12 col-md-6">
               <div class="boxViewBorder">
           
               <div class="boxHeader">
               <div class="trackingBox">
                  <div class="orderPlaced">
                     <img src="<?php echo $content_images;?>/no_order.png">
                     <h2>No Order Found</h2>
<!--                      <p>Your order has been placed successfully. We will provide tracking id and address for deliver product soon.</p>
 -->                  </div>
               </div>
            </div>
            </div>
         </div>
      </div>
   </div>
</section>
</div>
<?php }?>