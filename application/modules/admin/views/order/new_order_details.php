<?php 
   $header_images = getenv('APP_FRONT_ASSETS_IMAGES') . 'header';
   $content_images = getenv('APP_FRONT_ASSETS_IMAGES') . 'content';
   ?>
<div class="content">
   <div class="container-fluid">
      <div class="page-title-box box-spacing">
         <div class="row align-items-center">
            <div class="col-sm-6">
               <h4 class="page-title">New Order Detail</h4>
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
                  <div class="col-md-7">
                     <div class="orderInfo-1">
                        <!-- <input type="hidden" name="id" id="id" value="<?php echo $orderexist->orderID?>"> -->
                        <?php 
                           if ($orderexist->service_type ==1) {
                           ?>                                        
                        <h2>Air Freight</h2>
                        <div class="float-right freight-category">
                           <h3 class="priceValue"><?php echo $air_title->title; ?></h3>
                        </div>
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
                           if ($orderexist->service_type ==2) {
                           ?>
                        <h2>Sea Freight</h2>
                        <div class="float-right freight-category">
                           <h3 class="priceValue"></h3>
                        </div>
                        <p><!-- <span class="mr-2">Price: <b>$25.00 ,</b></span> -->Quantity: <b><?php echo $orderexist->quantity?></b></p>
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
                           if ($orderexist->service_type ==3) {
                           ?>                                        
                        <h2>Courier & Express Services</h2>
                        <div class="float-right freight-category">
                           <h3 class="priceValue"></h3>
                        </div>
                        <p><!-- <span class="mr-2">Price: <b>$25.00 ,</b></span> -->Quantity: <b><?php echo $orderexist->quantity?></b></p>
                        <h6 class="priceValue">Item: <b><?php echo $courier->title .'- '.'$'.$courier->price ; ?></b></h6>
                        <h6 class="priceValue">Price: <b><?php echo '$'.$orderexist->price?></b></h6>
                        <?php }?>
                        <?php 
                           if ($orderexist->service_type ==4) {
                            ?>  
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
                           <br>
                           <a href="<?php echo base_url('order/receipt_download/download_reciept?image_name=').$orderexist->receipt_file;?>" download="">
                           <button type="button" class="btn btn-outline-success waves-effect waves-light ml-3 mb-3">Download Receipt <i class="fa fa-download ml-2"></i></button>
                           </a>
                           <button type="button" class="btn btn-primary float-right mr-3" data-toggle="modal" data-target="#common_model" data-whatever="@mdo">Approve</button>
                        </div>
                     </div>
                     <?php }?>
                     <?php if(empty($orderexist->receipt_file)){?>
                     <div><br><br><button type="button" id="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#common_model" data-whatever="@mdo">Approve</button></div>
                  </div>
                  <?php }?>
               </div>
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
<div class="modal fade" id="common_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog area-width" role="document">
   <div class="modal-content">
      <div class="modal-header change-status-heading">
         <h5 class="modal-title" id="exampleModalLabel">Fill out the information</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
      </div>
      <form action="<?php echo admin_url('order/approved_form'); ?>" class="form-horizontal" method="POST" id="approve">
         <div class="modal-body">
         <!--    <div class="form-group">
               
               <label for="exampleInputEmail1">Tracking ID</label>
               <input type="text" class="form-control" id="tracking_id" name="tracking_id" aria-describedby="emailHelp" placeholder="Enter Tracking Id">
            </div> -->
            <input type="hidden" name="id" id="id" value="<?php echo $orderexist->orderID?>">
            <div class="form-group">
               <label for="exampleInputEmail1">Item Drop Location</label>
               <input type="text" class="form-control" id="item_drop_location" name="item_drop_location" aria-describedby="emailHelp" placeholder="Enter Location">
            </div>
         </div>
         <div class="modal-footer status-btn">
            <button type="button" id="submit" class="btn btn-primary">Approve</button>
         </div>
      </form>
   </div>
</div>
<script type = "text/javascript" >
    $("#approve").validate({
    ignore: [],
    rules: {
        item_drop_location: {
            required: true,
            maxlength: 100
        }
    },
});

var approve = $("#approve");
$('body').on('click', '#submit', function (e) {

    toastr.remove();
    event.preventDefault();
    if (approve.valid() === false) {
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