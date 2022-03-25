<div class="container-fluid">
   <div class="page-title-box box-spacing">
      <div class="row align-items-center">
         <div class="col-sm-6">
            <h4 class="page-title">Completed Orders</h4>
            <ol class="breadcrumb">
               <!-- <li class="breadcrumb-item active">Welcome to Hobort</li> -->
            </ol>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-12">
         <!-- <div class="row">
            <div class="col-lg-6 col-6">
               <div class="select filterSelect mb-3 mt-3 mr-4 ml-3">
                  <select name="slct" id="ticket-status">
                     <option selected disabled>Status</option>
                     <option value="">All</option>
                     <option value="0">Pending</option>
                     <option value="1">In Review</option>
                     <option value="2">Completed </option>
                  </select>
               </div>
            </div>
         </div> -->
         <div class="filter-block">
         <select id="service_type" class="js-example-placeholder-multiple" multiple="multiple" name="status[]" oninput="filter_fun_service_type()" style="">
            <optgroup label="">
               <?php
                  $statusArray = getServicetype();
                  foreach ($statusArray as $key => $value) { 
                  ?>
               <option value="<?php echo $value['id']; ?>"><?php echo $value['value']; ?></option>
               <?php }?>
            </optgroup>
         </select>
         <div class="fltr" style="margin-bottom: 2%;">
            <button class="btn btn-primary" id="myBtn" style="margin-left: 910px;" onclick="filter_service_click()" >Clear Filter</button>
         </div>
        </div>
         <table id="completed_order_list" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead class="thead-spacing">
               <tr>
                  <th scope="col">S.No.</th>
                  <th scope="col">Tracking ID</th>
                  <th scope="col">Service Type</th>
                  <th scope="col">Amount</th>
                  <th scope="col">Date & Time</th>
                  <th scope="col" class="text-right">Action</th>
               </tr>
            </thead>
         </table>
      </div>
      <!-- end col -->
   </div>
   <!-- end row -->
</div>
<!-- container-fluid -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $('.js-example-placeholder-multiple').select2({
        placeholder: "Service Type",
        allowClear: true,
        minimumResultsForSearch: -1
   
    });
</script>
<script type="text/javascript">
    function filter_fun_service_type() {
        var status = jQuery(".js-example-basic-si").val();
        $('#completed_order_list').DataTable().ajax.reload();
         // }
   }
</script>
<script type="text/javascript">
    function filter_service_click(){
        $(".form-control .form-control-sm").val('');
        $("#service_type").val('').trigger("change");
        $('#completed_order_list').DataTable().ajax.reload();
   }
</script>