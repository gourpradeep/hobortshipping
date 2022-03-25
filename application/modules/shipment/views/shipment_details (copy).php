<?php 
$header_images = getenv('APP_FRONT_ASSETS_IMAGES') . 'header';
$content_images = getenv('APP_FRONT_ASSETS_IMAGES') . 'content';
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
<section class="currentOrder">
   <div class="container">
      <div class="row">
         <div class="col-md-4">
            <div class="orderInfo">
               <h2>My Shipment</h2>
               <p>Weight : <b><?php echo !empty($orderData->shipment_weight)?$orderData->shipment_weight.'Kg':'NA'; ?></b></p>
               <?php if($orderData->price=='0.00'){
                  $price = 'NA';
                }else{
                $price = '$'.$orderData->price;
              }?>
               <p>Price : <b><?php echo $price ;?></b></p>
               
                    <div class="invoiceSec">
                        <?php if(!empty($orderData->receipt_file)){ ?>
                        <div class="recipetImg" id="onrefresh">
                            <a  href="<?php echo base_url('order/receipt_download/download_reciept?image_name=').$orderData->receipt_file;?>">
                            <img src="<?php echo $receipt_file;?>" class="preview" >
                            <a class="button-class btn text-left dwnlod-btn" href="<?php echo base_url('order/receipt_download/download_reciept?image_name=').$orderData->receipt_file;?>" target="_blank">Download Receipt<span class="fa fa-download"></span><i aria-hidden="true"></i></a></a>
                        </div>
                    <?php }?>
                        <div class="recipetImg" id="norefresh" style="display: none;">
                            <img src="<?php echo $receipt_file;?>" class="preview" >
                        </div>
                        <label class="uploadBtn" for="invoice">Upload Receipt <span class="fa fa-upload"></span><input id="invoice" type="file" onchange="upload_reciept(this,'<?php echo $orderData->orderID; ?>')" name="invoice"></label>
                       
                    </div>
            </div>
         </div>
         <div class="col-md-8">
            <div class="idproof-img orderInfo-1 mt-0 orderInfo shipper-info">
               <div class="id-info">
                  <h6>Shipper Info</h6>
               </div>
               <p>Shipper Name : <b><?php echo $orderData->shipper_name; ?></b></p>
               <p>Receiver Name : <b><?php echo $orderData->shipment_receiver_name; ?></b></p>
               <p class="tracking-id">Tracking ID : <b data-container="body" data-toggle="popover" data-placement="top" data-content="
                  <h4>Pending , 30 Oct 2020</h4>">#<?php echo $orderData->shipment_tracking_ids ?></b></p>
               <p>Origin : <b><?php echo $orderData->shipment_origin; ?></b></p>
               <p>Total Value : <b><?php echo $orderData->shipment_value; ?></b></p>
               <p>Content : </p>
               <p class="priceValue overflowp" style="white-space: pre-wrap;"><?php echo $orderData->shipper_description; ?>.</p>
            </div>
            <div class="">
               <div class="trackingBox order-box">
                  <div class="trackingInfo">
                     <div class="drop-address">
                        <!--  <p>Dropped Address</p>
                           <h6 class=""><i class="fa fa-map-marker" aria-hidden="true"></i>758 Pineknoll Street Oklahoma City, OK 73112</h6>
                            <i class="fas fa-map-marker-alt"></i>  -->
                     </div>
                     <div class="trackId noBorder">
                        <p>Tracking ID: <b>#<?php echo $orderData->tracking_id?></b></p>
                     </div>
                     <?php $orderStatus = json_decode($orderData->status_updated_at);
                        ?>
                     <div class="stepBlock">
                        <ul class="StepProgress">
                           <li class="StepProgress-item is-done">
                              <div class="stepItem">
                                 <div class="stepInfo">
                                    <h4>Shipped by me</h4>
                                    <p><?php echo date('d M Y', strtotime($orderStatus->shipped_by_customer_at)); ?></p>
                                 </div>
                              </div>
                           </li>
                           <li class="StepProgress-item <?php if($orderData->status >=4 ){ echo 'is-done';}elseif($orderData->status==3){ echo 'current'; }else{echo '';}?>">
                              <div class="stepItem">
                                 <div class="stepInfo">
                                    <h4>Received by Hobort</h4>
                                    <?php if($orderData->status >=4){?>
                                    <p><?php echo date('d M Y', strtotime($orderStatus->received_from_customer_at)); ?></p>
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
                                    <p>On <?php echo date('d M Y', strtotime($orderStatus->on_the_way_at)); ?></p>
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
                                    <p>On <?php echo date('d M Y', strtotime($orderStatus->delivered_at)); ?></p>
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
