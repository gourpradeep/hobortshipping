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
               <div class="col-lg-5 col-md-6">
                  <div class="boxViewShadow">
                     <div class="boxBody">
                        <div class="orderInfoBlk">
                           <h2 class="orderDelType">Concierge Shipping</h2>
                           <div class="orderMoreInfo">
                             <!--  <ul>
                                 <li>Item : <span><?php echo $orderServiceData->title." - $".$orderServiceData->price; ?></span></li>
                                 <li>Price : <span>$<?php echo number_format($orderServiceData->price*$orderData->quantity,2); ?></span></li>
                                 <li>Quantity: <span><?php echo $orderData->quantity; ?></span></li>
                              </ul> -->
                               <ul>
                             <!--  <li>Price : <span>$<?php echo !empty($concierge_detail->offer_price)?$concierge_detail->offer_price:'NA'; ?></span></li> -->
                                                </ul>
                              <div class="csDesc">
                                 <label>Description</label>
					                <p class="priceValue overflowp" style="white-space: pre-wrap;"><?php echo !empty($concierge_detail->description)?$concierge_detail->description:'NA'; ?></p>
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
               <?php if (!empty($orderData->shipper_name)) {?>
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
                              <b><?php echo !empty($orderData->shipment_tracking_ids)?$orderData->shipment_tracking_ids:'NA'; ?></b>
                           </div>
                           <div class="shipInfoItem">
                              <p>Origin :</p>
                              <b><?php echo !empty($orderData->shipment_origin)?$orderData->shipment_origin:'NA'; ?></b>
                           </div>
                           <div class="shipInfoItem">
                              <p>Total Value :</p>
                              <b><?php echo !empty($orderData->shipment_value)?$orderData->shipment_value:'NA'; ?></b>
                           </div>
                           <div class="shipInfoItem">
                              <p>Content :</p>
                              <b style="white-space: pre-wrap;"><?php echo !empty($orderData->shipper_description)?$orderData->shipper_description:'NA'; ?></b>
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
                              <b><?php echo !empty($orderData->shipper_tracking_id)?'#'.$orderData->shipper_tracking_id:'NA'; ?></b>                        
                           </div>
                           <div class="shipInfoItem">
                              <p>Company Name :</p>
                              <b><?php echo !empty($orderData->shipper_company_name)?$orderData->shipper_company_name:'NA'; ?>
                           </div>
                           <div class="shipInfoItem">
                              <p>Content :</p>
                              <b style="white-space: pre-wrap;"><?php echo !empty($orderData->shipper_description)?$orderData->shipper_description:'NA'; ?></b>
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
               </div>
               <?php }?>
               <div class="col-lg-7 col-md-6">
                  <div class="boxViewBorder">
                     <div class="boxHeader">
                        <div class="trackingBox">
                           <div class="orderPlaced">
                              <img class="rounded mx-auto d-block" src="<?php echo $content_images;?>/queue.png">
                              <h2  class="text-center">Waiting For Price</h2>
                              <p  class="text-center">Admin will provide price then you can place your order.</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
</div>
</section>