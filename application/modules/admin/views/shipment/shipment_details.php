<!-- Start right Content here -->
<!-- ============================================================== -->
<!-- Start content -->
<div class="content">
   <div class="container-fluid">
      <div class="page-title-box box-spacing">
         <div class="row align-items-center">
            <div class="col-sm-6">
               <h4 class="page-title">Shipment Detail</h4>
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
                  <div class="col-lg-12 col-12">
                     <div class="vehicle-info-data wallet-info cstmr-info p-0 pb-4">
                        <h5 class="pb-4 m-0">Customer Info</h5>
                        <div class="media customer-img">
                           <?php 
                              if ($shipment_user_info->avatar) {
                                  $url = getenv('S3_USER_AVATAR_THUMB') . $shipment_user_info->avatar;                
                              } else {
                                  $url = getenv('S3_USER_PLACEHOLDER_AVATAR');
                              }
                              ?>
                           <a href="<?php echo admin_url(). '/customer/user_details?id='.encoding($shipment_user_info->userID)?>"><img class="" src="<?php echo $url; ?>"></a>
                           <!-- <div class="media-body mt-4 ml-3 cstmr-text">
                              <h6 class="mt-2 pt-1"><?php echo $shipment_user_info->full_name?></h6>
                           </div> -->
                           <div class="media-body ml-3 cstmr-text">
                              <h6 class="mt-0"><a href="<?php echo admin_url(). '/customer/user_details?id='.encoding($shipment_user_info->userID)?>"><?php echo ucfirst($shipment_user_info->full_name); ?></a></h6>
                              <p><a href="<?php echo admin_url(). '/customer/user_details?id='.encoding($shipment_user_info->userID)?>"><?php echo $shipment_user_info->email; ?></a></p>
                              <?php 
                                if ($shipment_user_info->status==1) { ?>
                              <span class="active-icon"><i class="typcn typcn-media-record"></i> Active</span>        <?php }?>
                              <?php
                                if ($shipment_user_info->status==0) { ?>
                              <span class="inactive"><i class="typcn typcn-media-record"></i>Inactive</span>        <?php }?>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- <div class="col-md-1"></div> -->
                  <div class="col-md-5">
                     <div class="orderInfo-1 mt-4">
                        <h2>My Shipment Request</h2>
                        <div class="freight-category datentime">
                           <?php 
                              $old_date = date($shipment_request->created_at);
                              $date = date('d F yy', strtotime($old_date));
                              $time = date('H:i A', strtotime($old_date));?>
                           <h3 class="priceValue dateTime">
                              <?php echo $date.', '.$time?>
                           </h3>
                        </div>
                        <form action="<?php echo admin_url('shipment/add_shipper_info'); ?>" class="" method="POST" id="shipment">
                           <?php if ($shipment_request->status == 1){?>
                           <div class="input-group mb-3 send-payment">
                              <input type="hidden" name="id" id="id" value="<?php echo $shipment_request->orderID?>">
                              <input type="text" class="form-control" placeholder="Total Weight" aria-label="Recipient's username" aria-describedby="basic-addon2" name="shipment_weight">
                           </div>
                           <div class="input-group mb-3 send-payment">
                              <input type="text" class="form-control" placeholder="Total Price" aria-label="Recipient's username" aria-describedby="basic-addon2" name="total_price">
                              <div class="form-group send-btn">
                                 <button class="btn btn-primary" id="submit">Send</button>
                              </div>
                           </div>
                           <?php }else{?>
                           <table style="width: 50%;">
                              <tr>
                                 <td>Total Weight</td>
                                 <td><b><?php echo $shipment_request->shipment_weight .'Kg';?></b></td>
                              </tr>
                              <tr>
                                 <td> Total Price</td>
                                 <td><b>$<?php echo $shipment_request->price ;?></b></td>
                              </tr>
                           </table>
                           <?php  }?>
                           <!-- <?php if(!empty($orderexist->receipt_file)){?>
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
                           <?php }?> -->
                     </div>
                     </form>
                  </div>
                  <div class="col-md-7">
                     <div class="idproof-img orderInfo-1 mt-4 vehicle-info-data">
                        <div class="id-info">
                           <h6>Shipper Info</h6>
                        </div>
                        <p>Shipper Name : <b><?php echo $shipment_request->shipper_name?></b></p>
                        <p>Receiver Name : <b><?php echo $shipment_request->shipment_receiver_name?></b></p>
                        <p>Origin : <b><?php echo $shipment_request->shipment_origin?></b></p>
                        <p>Value : <b><?php echo $shipment_request->shipment_value?></b></p>
                        <p class="trackingId">Tracking ID : <b data-container="body" data-toggle="popover">#<?php echo $shipment_request->shipment_tracking_ids ;?></b></p>
                        <h6 class="">Content</h6>
                        <p class="priceValue overflowp" style="white-space: pre-wrap;"><?php echo !empty($shipment_request->shipper_description)?$shipment_request->shipper_description:'NA'; ?></p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- container-fluid -->
</div>
</div>
<!-- END wrapper -->     
</body>
</html>
<script type = "text/javascript" >
   $("#shipment").validate({
   ignore: [],
   rules: {
   
   
      total_price: {
         required: true,
         number: true,
         maxlength: 9,
      },
      shipment_weight :{
         required: true,
      }
   },
   messages: {
      total_price:{
         number: 'Please enter number only',
         maxlength: 'Please enter no more than 8 numbers'
      },
   }
   });
   
   var shipment = $("#shipment");
   $('body').on('click', '#submit', function (e) {
   
   toastr.remove();
   event.preventDefault();
   if (shipment.valid() === false) {
      toastr.error(proceed_err);
      return false;
   }
   var _that = $(this),
      form = _that.closest('form'),
      formData = new FormData(form[0]),
      f_action = form.attr('action');
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
      complete: function () {
         hide_loader();
      },
      success: function (data, textStatus, jqXHR) {
         if (data.status == 1) {
            hide_loader();
            toastr.success(data.msg);
            window.setTimeout(function () {
               window.location.href = data.url;
            }, 1000);
         } else if (data.status == -1) {
            //authetication failed
            toastr.error(data.msg);
            window.setTimeout(function () {
               window.location.href = data.url;
            }, 2000);
         } else {
            hide_loader();
            toastr.error(data.msg);
         }
      },
   });
   e.stopImmediatePropagation();
   return false;
   });
</script>