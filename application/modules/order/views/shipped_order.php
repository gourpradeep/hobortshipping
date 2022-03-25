<?php 
   $header_images = getenv('APP_FRONT_ASSETS_IMAGES') . 'header';
   $content_images = getenv('APP_FRONT_ASSETS_IMAGES') . 'content';
   ?>
<?php if(!empty($this->session->userdata()['verified_success'])){ ?>
<div class="alert alert-success " role="alert" style="text-align:center;left:50%;">
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
   <span aria-hidden="true">&times;</span>
   </button>
   Your email address is successfully verified!
</div>
<?php }$this->session->unset_userdata('verified_success');
   ?>
<?php if(!empty($orderData->receipt_file)){
   if(in_array($orderData->receipt_file_extension, imageExtension())){
       $receipt_file = getenv('S3_USER_RECEIPT_THUMB').$orderData->receipt_file;
   }elseif(in_array($orderData->receipt_file_extension, fileExtension())) {
       $receipt_file = $content_images.'/doc.png';
   }else{  
       $receipt_file = $content_images.'/pdf.png';
       // pr($receipt_file);
   }
   } ?>
<input type="hidden" name="downloadImageName" id="downloadImageName" value="<?php echo $orderData->receipt_file;?>">
<div class="mainWrapper innerPageWrapper">
<section class="orderDetails sec-pad-30">
   <div class="container">
      <div class="orderDetailsBlk">
         <div class="row">
            <?php if($orderData->service_type ==1) { ?>
            <div class="col-lg-5 col-md-6">
               <div class="boxViewShadow">
                  <div class="boxBody">
                     <div class="orderInfoBlk">
                        <h2 class="orderDelType">Air Freight</h2>
                        <div class="orderMoreInfo">
                           <ul>
                              <li>Item : <span><?php echo $orderServiceData->title ; ?></span></li>
                              <li>Price : <span>$<?php echo $orderData->price; ?></span></li>
                              <li>Item Value : <span><?php echo $orderServiceDataAir->item_value; ?></span></li>
                              <li>Quantity: <span><?php echo $orderData->quantity; ?></span></li>
                           </ul>
                        </div>
                        <div class="item-info-section">
                           <h4>Item Info</h4>
                           <div class="height-section">
                              <span><img src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>height.png">Height</span>
                              <div class="hwlw-section text-right">
                                 <h5><?php echo $orderServiceDataAir->height; ?> (Inches)</h5>
                              </div>
                           </div>
                           <div class="height-section">
                              <span><img src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>width.png">Width</span>
                              <div class="hwlw-section text-right">
                                 <h5><?php echo $orderServiceDataAir->width; ?> (Inches)</h5>
                              </div>
                           </div>
                           <div class="height-section">
                              <span><img src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>tape-measure.png">Length</span>
                              <div class="hwlw-section text-right">
                                 <h5><?php echo $orderServiceDataAir->length; ?> (Inches)</h5>
                              </div>
                           </div>
                           <div class="height-section">
                              <span><img src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>weight.png">weight</span>
                              <div class="hwlw-section text-right">
                                 <h5><?php echo $orderServiceDataAir->weight; ?> (Pound)</h5>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="boxViewShadow mt-30">
                  <div class="boxHeader">
                     <h2>Receipt</h2>
                  </div>
                  <div class="boxBody">
                     <?php if(!empty($orderData->receipt_file)){ ?>
                     <div class="recipetImg" id="onrefresh">
                        <a href="<?php echo base_url('order/receipt_download/download_reciept?image_name=').$orderData->receipt_file;?>">
                        <img src="<?php echo $receipt_file;?>" class="preview">
                        </a>
                        <a class="ripple button-class btn text-left dwnlod-btn" href="<?php echo base_url('order/receipt_download/download_reciept?image_name=').$orderData->receipt_file;?>">Download Receipt<span class="fa fa-download"></span></a>
                     </div>
                     <?php }?>
                     <div class="receiptBlk">
                        <label class="uploadBtn ripple" for="invoice">Upload Receipt <span class="fa fa-upload"></span><input id="invoice" type="file" onchange="upload_reciept(this,'<?php echo $orderData->orderID; ?>')" name="invoice"></label>
                     </div>
                  </div>
               </div>
            </div>
            <?php }?>
            <?php if($orderData->service_type ==2) { 
               if($orderServiceData->type==1){
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
                              <li>Item : <span><?php echo $orderServiceData->title." - $".$orderServiceData->price; ?></span></li>
                              <li>Quantity: <span><?php echo $orderData->quantity; ?></span></li>
                              <p class="priceValue">$<?php echo number_format($orderServiceData->price*$orderData->quantity,2).' '.$type; ?></p>
                           </ul>
                        </div>
                       
                     </div>
                  </div>
               </div>
               <div class="boxViewShadow mt-30">
                  <div class="boxHeader">
                     <h2>Receipt</h2>
                  </div>
                  <div class="boxBody">
                     <?php if(!empty($orderData->receipt_file)){ ?>
                     <div class="recipetImg" id="onrefresh">
                        <a href="<?php echo base_url('order/receipt_download/download_reciept?image_name=').$orderData->receipt_file;?>">
                        <img src="<?php echo $receipt_file;?>" class="preview">
                        </a>
                        <a class="ripple button-class btn text-left dwnlod-btn" href="<?php echo base_url('order/receipt_download/download_reciept?image_name=').$orderData->receipt_file;?>">Download Receipt<span class="fa fa-download"></span></a>
                     </div>
                     <?php }?>
                     <div class="receiptBlk">
                        <label class="uploadBtn ripple" for="invoice">Upload Receipt <span class="fa fa-upload"></span><input id="invoice" type="file" onchange="upload_reciept(this,'<?php echo $orderData->orderID; ?>')" name="invoice"></label>
                     </div>
                  </div>
               </div>
            </div>
            <?php }?>
            <?php if($orderData->service_type ==3) { ?>
            <div class="col-lg-5 col-md-6">
               <div class="boxViewShadow">
                  <div class="boxBody">
                     <div class="orderInfoBlk">
                        <h2 class="orderDelType">Courier & Express Services</h2>
                        <div class="orderMoreInfo">
                           <ul>
                              <li>Item : <span><?php echo $orderServiceData->title." - $".$orderServiceData->price; ?></span></li>
                              <li>Price : <span>$<?php echo number_format($orderServiceData->price*$orderData->quantity,2); ?></span></li>
                              <li>Quantity: <span><?php echo $orderData->quantity; ?></span></li>
                           </ul>
                        </div>
                       
                     </div>
                  </div>
               </div>
               <div class="boxViewShadow mt-30">
                  <div class="boxHeader">
                     <h2>Receipt</h2>
                  </div>
                  <div class="boxBody">
                     <?php if(!empty($orderData->receipt_file)){ ?>
                     <div class="recipetImg" id="onrefresh">
                        <a href="<?php echo base_url('order/receipt_download/download_reciept?image_name=').$orderData->receipt_file;?>">
                        <img src="<?php echo $receipt_file;?>" class="preview">
                        </a>
                        <a class="ripple button-class btn text-left dwnlod-btn" href="<?php echo base_url('order/receipt_download/download_reciept?image_name=').$orderData->receipt_file;?>">Download Receipt<span class="fa fa-download"></span></a>
                     </div>
                     <?php }?>
                     <div class="receiptBlk">
                        <label class="uploadBtn ripple" for="invoice">Upload Receipt <span class="fa fa-upload"></span><input id="invoice" type="file" onchange="upload_reciept(this,'<?php echo $orderData->orderID; ?>')" name="invoice"></label>
                     </div>
                  </div>
               </div>
            </div>
            <?php }?>
            <?php if($orderData->service_type ==4) { ?>
            <div class="col-lg-5 col-md-6">
               <div class="boxViewShadow">
                  <div class="boxBody">
                    <!--  <div class="orderInfoBlk">
                        <h2 class="orderDelType">Concierge Shipping</h2>
                        <div class="orderMoreInfo">
                           <ul>
                              <li>Cost of order : <span><?php echo '$'.$concierge_detail->order_cost; ?></span></li>
                              <li>Concierge Fee : <span><?php echo '$'.$concierge_detail->concierge_fee; ?></span></li>
                           </ul>
                        </div>
                        <div class="csDesc">
                           <p class="priceValue overflowp" style="white-space: pre-wrap;"><?php echo !empty($concierge_detail->description)?$concierge_detail->description:'NA'; ?></p>
                        </div>
                     </div> -->
                      <div class="orderInfoBlk">
                       <h2 class="orderDelType">Concierge Shipping</h2>
                       <div class="orderMoreInfo">
                           <ul>
                               <li>Price : <span><?php echo '$'.$concierge_detail->offer_price; ?></span></li>
                           </ul>
                       </div>
                       <div class="csDesc">
                           <p class="priceValue overflowp" style="white-space: pre-wrap;"><?php echo !empty($concierge_detail->description)?$concierge_detail->description:'NA'; ?></p>
                       </div>
                   </div>
                  </div>
               </div>
               <div class="boxViewShadow mt-30">
                  <div class="boxHeader">
                     <h2>Receipt</h2>
                  </div>
                  <div class="boxBody">
                     <?php if(!empty($orderData->receipt_file)){ ?>
                     <div class="recipetImg" id="onrefresh">
                        <a href="<?php echo base_url('order/receipt_download/download_reciept?image_name=').$orderData->receipt_file;?>">
                        <img src="<?php echo $receipt_file;?>" class="preview">
                        </a>
                        <a class="ripple button-class btn text-left dwnlod-btn" href="<?php echo base_url('order/receipt_download/download_reciept?image_name=').$orderData->receipt_file;?>">Download Receipt<span class="fa fa-download"></span></a>
                     </div>
                     <?php }?>
                     <div class="receiptBlk">
                        <label class="uploadBtn ripple" for="invoice">Upload Receipt <span class="fa fa-upload"></span><input id="invoice" type="file" onchange="upload_reciept(this,'<?php echo $orderData->orderID; ?>')" name="invoice"></label>
                     </div>
                  </div>
               </div>
            </div>
            <?php }?>
            <?php if($orderData->service_type ==5) { ?>
            <div class="col-lg-5 col-md-6">
               <div class="boxViewShadow">
                  <div class="boxBody">
                     <div class="orderInfoBlk">
                        <h2 class="orderDelType">My Shipment</h2>
                        <div class="orderMoreInfo">
                           <ul>
                              <li>Weight : <span><?php echo !empty($orderData->shipment_weight)?$orderData->shipment_weight.'Kg':'NA'; ?></span></li>
                              <?php if($orderData->price=='0.00'){
                                 $price = 'NA';
                                 }else{
                                 $price = '$'.$orderData->price;
                                 }?>
                              <li>Price : <span><?php echo $price ;?></span></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="boxViewShadow mt-30">
                  <div class="boxHeader">
                     <h2>Receipt</h2>
                  </div>
                  <div class="boxBody">
                     <?php if(!empty($orderData->receipt_file)){ ?>
                     <div class="recipetImg" id="onrefresh">
                        <a href="<?php echo base_url('order/receipt_download/download_reciept?image_name=').$orderData->receipt_file;?>">
                        <img src="<?php echo $receipt_file;?>" class="preview">
                        </a>
                        <a class="ripple button-class btn text-left dwnlod-btn" href="<?php echo base_url('order/receipt_download/download_reciept?image_name=').$orderData->receipt_file;?>">Download Receipt<span class="fa fa-download"></span></a>
                     </div>
                     <?php }?>
                     <div class="receiptBlk">
                        <label class="uploadBtn ripple" for="invoice">Upload Receipt <span class="fa fa-upload"></span><input id="invoice" type="file" onchange="upload_reciept(this,'<?php echo $orderData->orderID; ?>')" name="invoice"></label>
                     </div>
                  </div>
               </div>
            </div>
            <?php }?>
            <div class="col-lg-7 col-md-6">
               <div class="boxViewBorder">
                  <div class="boxHeader">
                     <h2>Shipper Info</h2>
                  </div>
                  <?php if($orderData->service_type ==5){?>
                  <div class="boxBody">
                     <div class="shipperInfo noBorderInfo">
                        <div class="shipInfoItem">
                           <p>Shipper Name :</p>
                           <b><?php echo !empty($orderData->shipper_name)?$orderData->shipper_name:'NA'; ?></b>
                        </div>
                        <div class="shipInfoItem">
                           <p>Receiver Name :</p>
                           <b><?php echo !empty($orderData->shipment_receiver_name)?$orderData->shipment_receiver_name:'NA'; ?></b>
                        </div>
                        <div class="shipInfoItem">
                           <p>Tracking ID :</p>
                           <b><?php echo !empty($orderData->shipment_tracking_ids)? '#'.$orderData->shipment_tracking_ids:'NA'; ?></b>
                        </div>
                        <div class="shipInfoItem">
                           <p>Origin :</p>
                           <b><?php echo !empty($orderData->shipment_origin)?$orderData->shipment_origin:'NA'; ?></b>
                        </div>
                        <div class="shipInfoItem">
                           <p>Total Value :</p>
                           <b><?php echo !empty($orderData->shipment_value)?$orderData->shipment_value:'NA'; ?></b>
                        </div>
                        <!-- <div class="shipInfoItem">
                           <p>Content :</p>
                           <b style="white-space: pre-wrap;"><?php echo !empty($orderData->shipper_description)?$orderData->shipper_description:'NA'; ?></b>
                        </div> -->
                         <div class=" shipInfoItem csDesc">
                           <label>Content</label>
                           <p class="priceValue overflowp" style="white-space: pre-wrap;"><?php echo !empty($orderData->shipper_description)?$orderData->shipper_description:'NA'; ?></p>
                        </div>
                     </div>
                  </div>
                  <?php } else{?>
                  <div class="boxBody">
                     <div class="shipperInfo">
                        <div class="shipInfoItem">
                           <p>Shipper Name :</p>
                           <b><?php echo !empty($orderData->shipper_name)?$orderData->shipper_name:'NA'; ?></b>
                        </div>
                        <div class="shipInfoItem">
                           <p>Tracking ID :</p>
                           <b><?php echo !empty($orderData->shipper_tracking_id)? '#'.$orderData->shipper_tracking_id:'NA'; ?></b>                        
                        </div>
                        <div class="shipInfoItem">
                           <p>Company Name :</p>
                           <b><?php echo !empty($orderData->shipper_company_name)?$orderData->shipper_company_name:'NA'; ?>
                        </div>
                       <!--  <div class="shipInfoItem">
                           <p>Content :</p>
                           <b style="white-space: pre-wrap;"><?php echo !empty($orderData->shipper_description)?$orderData->shipper_description:'NA'; ?></b>
                        </div> -->
                         <div class=" shipInfoItem csDesc">
                           <label>Content</label>
                           <p class="priceValue overflowp" style="white-space: pre-wrap;"><?php echo !empty($orderData->shipper_description)?$orderData->shipper_description:'NA'; ?></p>
                        </div>
                     </div>
                     <div class="deliverAdd">
                        <div class="lcImg">
                           <span class="material-icons-outline md-location_on"></span>
                        </div>
                        <div class="locationInfo">
                           <label>Drop your item here</label>
                           <h4><?php echo !empty($orderData->drop_location)?$orderData->drop_location:'NA'; ?></h4>
                        </div>
                     </div>
                  </div>
                  <?php } ?>
               </div>
               <?php $orderStatus = json_decode($orderData->status_updated_at);?>
               <div class="boxViewBorder mt-30">
                  <div class="boxHeader">
                     <h2>Tracking Info</h2>
                  </div>
                  <div class="boxBody">
                     <div class="trackId">
                        <p>Tracking ID:<b>#<?php echo !empty($orderData->tracking_id)?$orderData->tracking_id:'NA'; ?></b></p>
                     </div>
                     <div class="stepBlock">
                        <ul class="StepProgress">
                           <li class="StepProgress-item is-done">
                              <div class="stepItem">
                                 <div class="stepInfo">
                                    <h4>Shipped by me</h4>
                                    <p> <?php echo date('d M Y', strtotime($orderStatus->shipped_by_customer_at)); ?></p>
                                    </p>
                                 </div>
                              </div>
                           </li>
                           <li class="StepProgress-item <?php if($orderData->status >=4 ){ echo 'is-done';}elseif($orderData->status==3){ echo 'current'; }else{echo '';}?>">
                              <div class="stepItem">
                                 <div class="stepInfo">
                                    <h4>Received by Hobort</h4>
                                    <?php if($orderData->status >=4){?>
                                    <p> <?php echo date('d M Y', strtotime($orderStatus->received_from_customer_at)); ?></p>
                                    <?php }?>
                                 </div>
                              </div>
                           </li>
                           <li class="StepProgress-item <?php if($orderData->status >=5){ echo 'is-done';}elseif($orderData->status==4){ echo 'current'; }else{echo '';}?>">
                              <div class="stepItem">
                                 <div class="stepInfo">
                                    <h4>Packed</h4>
                                    <?php if($orderData->status >=5){?>
                                    <p> <?php echo date('d M Y', strtotime($orderStatus->packed_at)); ?></p>
                                    <?php }?>
                                 </div>
                              </div>
                              <!-- <button type="button" class="btn btn-secondary approve-btn float-right">Change</button> -->
                           </li>
                           <li class="StepProgress-item <?php if($orderData->status >=6){ echo 'is-done';}elseif($orderData->status==5){ echo 'current'; }else{echo '';}?>">
                              <div class="stepItem">
                                 <div class="stepInfo">
                                    <h4>On the way</h4>
                                    <?php if($orderData->status >=6){?>
                                    <p><?php echo date('d M Y', strtotime($orderStatus->on_the_way_at)); ?></p>
                                    <?php }?>
                                 </div>
                              </div>
                              <!-- <button type="button" class="btn btn-secondary approve-btn float-right">Change</button> -->
                           </li>
                           <li class="StepProgress-item <?php if($orderData->status>=7){ echo 'is-done';}elseif($orderData->status==6){ echo 'current'; }else{echo '';}?>">
                              <div class="stepItem">
                                 <div class="stepInfo">
                                    <h4>Delivered</h4>
                                    <?php if($orderData->status >=7){?>
                                    <p><?php echo date('d M Y', strtotime($orderStatus->delivered_at)); ?></p>
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