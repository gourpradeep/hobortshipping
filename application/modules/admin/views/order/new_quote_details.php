<!-- Start content -->
<div class="content">
   <div class="container-fluid">
      <div class="page-title-box box-spacing">
         <div class="row align-items-center">
            <div class="col-sm-6">
               <h4 class="page-title">New Concierge Quote Details</h4>
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
                  <div class="col-lg-12 col-12">
                     <div class="vehicle-info-data wallet-info cstmr-info p-0 pb-4">
                        <h5 class="pb-4 m-0">Customer Info</h5>
                        <div class="media customer-img">
                           <input type="hidden" name="userID" id="userID" value="<?php echo $promo_applicable_check->userID?>">
                           <?php 
                              // echo $dataexist->userID;
                              if ($promo_applicable_check->avatar) {
                                $url = getenv('S3_USER_AVATAR_THUMB') . $promo_applicable_check->avatar;                
                              } else {
                                $url = getenv('S3_USER_PLACEHOLDER_AVATAR');
                             }
                            ?>
                           <a href="<?php echo admin_url(). '/customer/user_details?id='.encoding($promo_applicable_check->userID)?>">
                           <img class="" src="<?php echo $url; ?>"></a>
                           <div class="media-body ml-3 cstmr-text">
                              <h6 class="mt-0"><a href="<?php echo admin_url(). '/customer/user_details?id='.encoding($promo_applicable_check->userID)?>"><?php echo ucfirst($promo_applicable_check->full_name); ?></a></h6>
                              <p><a href="<?php echo admin_url(). '/customer/user_details?id='.encoding($promo_applicable_check->userID)?>"><?php echo $promo_applicable_check->email; ?></a></p>
                              <?php 
                                if ($promo_applicable_check->status==1) { ?>
                              <span class="active-icon"><i class="typcn typcn-media-record"></i> Active</span>        <?php }?>
                              <?php
                                if ($promo_applicable_check->status==0) { ?>
                              <span class="inactive"><i class="typcn typcn-media-record"></i>Inactive</span>        <?php }?>
                           </div>
                        </div>
                        <div class="media customer-img">
                           <input type="hidden" name="userID" id="userID" value="<?php echo $promo_applicable_check->userID?>">
                        </div>
                     </div>
                  </div>
                  <!-- <div class="col-md-1"></div> -->
                  <div class="col-md-7">
                     <div class="orderInfo-1 mt-4">
                        <h2>Concierge Shipping</h2>
                        <div class="float-right freight-category datentime">
                           <?php
                              $old_date = date($new_quote_user->created_at);
                              $date = date('d F yy', strtotime($old_date));
                              $time = date('H:i A', strtotime($old_date));
                              ?>
                           <h3 class="priceValue"><?php echo $date .''. ','.' '. $time?></h3>
                        </div>
                        <h6 class="priceValue paraheading">Description</h6>
                        <p class="priceValue overflowp" style="white-space: pre-wrap;"><?php echo $new_quote_user->description; ?>.</p>
                        <form action="<?php echo admin_url('New_quote_concierge_shipping/add_offer_price'); ?>" class="form-horizontal" method="POST" id="new_quote">
                           <div class="input-group mb-3 send-payment">
                              <?php if ($new_quote_user->status==2) { ?>
                              <table style="width: 50%;">
                                 <tr>
                                    <td>Cost of order</td>
                                    <td><b>$<?php echo $new_quote_user->order_cost;?></b></td>
                                 </tr>
                                 <tr>
                                    <td>Concierge Fee</td>
                                    <td><b>$<?php echo $new_quote_user->concierge_fee ;?></b></td>
                                 </tr>
                                 <tr>
                                    <td>Total</td>
                                    <td><b>$<?php echo $new_quote_user->offer_price ;?></b></td>
                                 </tr>
                              </table>
                              <p class= "badge bg-info" id="badge">Offer has been sent, awaiting customer's response.</p>
                              <?php }?>
                              <?php if ($new_quote_user->status==1) { ?>
                              <input type="hidden" name="id" id="id" value="<?php echo $new_quote_user->conciergeQuoteID?>">
                              <input type="hidden" name="promo" id="promo" value="<?php echo $promo_applicable_check->promo_applicable?>">
                              <input type="text" class="form-control" placeholder="Cost of order" aria-label="Recipient's username" aria-describedby="basic-addon2" id="cost_of_order" name="cost_of_order" onkeyup="add()">
                              <br>
                              <input type="text" class="form-control" placeholder="Concierge Fee" aria-label="Recipient's username" aria-describedby="basic-addon2" id="concierge_fee" name="concierge_fee" onkeyup="add()">
                              <br>
                              <input type="text" class="form-control" placeholder="Total" aria-label="Recipient's username" aria-describedby="basic-addon2" id="total" name="total" value="<?php echo $total;?>" readonly>
                              <p class= "badge bg-info" id="discount_applied">10% discount applied.</p>
                              <div class="form-group send-btn">
                                 <button class="btn btn-primary" id="submit">Send</button>
                              </div>
                              <?php }?>
                           </div>
                        </form>
                     </div>
                  </div>
                  <div class="col-md-5">
                     <div class="idproof-img orderInfo-1 mt-4 vehicle-info-data">
                        <div class="id-info">
                           <h6>Shipper Info</h6>
                        </div>
                        <p>Shipper Name : <b><?php echo !empty($new_quote_user->shipper_name)?$new_quote_user->shipper_name:'NA'; ?></b></p>
                        <p>Tracking ID : <b><?php echo !empty($new_quote_user->shipper_tracking_id)?'#'.$new_quote_user->shipper_tracking_id:'NA'; ?></b></p>
                        <p>Company Name : <b><?php echo !empty($new_quote_user->shipper_company_name)?$new_quote_user->shipper_company_name:'NA'; ?></b></p>
                        <h6 class="">Content</h6>
                        <p class="priceValue overflowp" style="white-space: pre-wrap;"><?php echo !empty($new_quote_user->shipper_description)?$new_quote_user->shipper_description:'NA'; ?></p>
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
<script type="text/javascript">$("#new_quote").validate({
  ignore: [],
  rules: {


    cost_of_order: {
      required: true,
      maxlength: 9,
      number: true
    },
    concierge_fee: {
      required: true,
      maxlength: 9,
      number: true
    },
  },
  messages: {
    cost_of_order: {
      maxlength: 'Please enter no more than 8 numbers',
      number: 'Please enter number only'
    },
    concierge_fee: {
      maxlength: 'Please enter no more than 8 numbers',
      number: 'Please enter number only'
    },
  }
});

var new_quote = $("#new_quote");
$('body').on('click', '#submit', function (e) {

  toastr.remove();
  event.preventDefault();
  if (new_quote.valid() === false) {
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
<script type="text/javascript">
   $('#discount_applied').hide();
   
</script>