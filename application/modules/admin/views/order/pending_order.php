<div class="container-fluid">
  <div class="page-title-box box-spacing">
    <div class="row align-items-center">
      <div class="col-sm-6">
        <h4 class="page-title">Pending Orders</h4>
        <ol class="breadcrumb">
          <!-- <li class="breadcrumb-item active">Welcome to Hobort</li> -->
        </ol>
      </div>
    </div>
  </div>
  <div class="col-lg-12 col-12">

  <div class="row">
      <div class="float-right  mb-3 mt-3 mr-4 ml-3" id="select">
        <select id="status_id" class="js-example-placeholder-multiple" multiple="multiple" name="status[]" oninput="filter_fun_status()" style="">
          <optgroup label="">
            <?php
                  $statusArray = get_status();
                  foreach ($statusArray as $key => $value) { 
                  ?>
              <option value="<?php echo $value['id']; ?>">
                <?php echo $value['value']; ?>
              </option>
              <?php }?>
          </optgroup>
        </select>
        
    </div>
<div class="float-right  mb-3 mt-3 mr-4 ml-3" id="select">
  
  <select id="service_type" class="js-example-placeholder-multiple" multiple="multiple" name="slct1[]" oninput="filter_fun_status()" style="">
    <option value="1">Air Freight</option>
    <option value="2">Sea Freight</option>
    <!-- <option value="3">Courier & Express Services</option> -->
    <!-- <option value="4">Concierge Shipping </option> -->
    <option value="5">My Shipment</option>
  </select>
</div>
</div>
</div>
<div class="fltr">
    <button class="btn btn-primary" id="myBtn" style="margin-left:842px; margin-bottom: 15px;" onclick="filter_status_click()">Clear Filter</button>
</div>
</div>
<table id="pending_order_list" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; width: 100%;">
  <thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Tracking ID</th>
      <th scope="col">Service Type</th>
      <th scope="col">Date & Time </th>
      <th scope="col">Status</th>
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
<div id="form-modal-box"></div>
</div>
<!-- content -->
</div>
<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->
<!-- jQuery  -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src = "https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js" > </script> 
<script type = "text/javascript">
    $('#status_id').select2({
        placeholder: "Status",
        allowClear: true,
        minimumResultsForSearch: -1
    });
$('#service_type').select2({
    placeholder: "Service Type",
    allowClear: true,
    minimumResultsForSearch: -1
});
</script> 
<script type = "text/javascript" >
    function filter_fun_status() {
        var status = jQuery(".js-example-basic-si").val();
        $('#pending_order_list').DataTable().ajax.reload();
    } 
</script> 
<script type = "text/javascript" >
    function filter_status_click() {
        $("#status_id").val('').trigger("change");
        $("#service_type").val('').trigger("change");
        $(".form-control.form-control-sm").val('');
        $('#pending_order_list').DataTable().ajax.reload();
    } 
</script>