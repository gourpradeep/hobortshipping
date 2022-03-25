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
                                 <li>Item : <span><?php echo $orderServiceData->title; ?></span></li>
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
                        <!-- <div class="orderInfoBlk">
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
                     <div class="boxBody">
                        <div class="lsHead">
                           <span class="material-icons-outline md-account_circle"></span>
                           <h2>Add Shipper Info</h2>
                        </div>
                        <div class="deliverAdd mb-30">
                           <div class="lcImg">
                              <span class="material-icons-outline md-location_on"></span>
                           </div>
                           <div class="locationInfo">
                              <label>Drop your item here</label>
                              <h4><?php echo !empty($orderData->drop_location)?ucfirst($orderData->drop_location):'NA'; ?></h4>
                           </div>
                        </div>
                        <div class="csForm floatLabelForm">
                           <form action="<?php echo base_url('order/add_shipper_info');?>" method="POST" id="add_shipper_info">
                              <input type="hidden" name="order_id" id="order_id" value="<?php echo $orderData->orderID;?>">
                              <div class="form-group">
                                 <div class="floatLabel">
                                    <label class="inLabel">Shipper Name<span class="reqStar">*</span></label>
                                    <input class="form-control" type="text" name="shipper_name" placeholder="Enter Name">
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="floatLabel">
                                    <label class="inLabel">Tracking ID<span class="reqStar">*</span></label>
                                    <input class="form-control" type="text" name="tracking_id" id="tracking_id" placeholder="Enter Tracking ID">
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="floatLabel">
                                    <label class="inLabel">Company Name<span class="reqStar">*</span></label>
                                    <input class="form-control" type="text" name="company_name" id="company_name" placeholder="Enter Name">
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="floatLabel">
                                    <label class="inLabel">Content<span class="reqStar">*</span></label>
                                    <textarea rows="4" class="form-control" type="text" name="content" placeholder="Enter Description"></textarea>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <button id="shipper_submit" class="btn btnTheme" type="button">Submit</button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>