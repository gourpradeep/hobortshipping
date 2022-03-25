<div class="container-fluid">
   <div class="page-title-box box-spacing">
      <div class="row align-items-center">
         <div class="col-sm-6">
            <h4 class="page-title">New Concierge Quote</h4>
            <ol class="breadcrumb">
               <!-- <li class="breadcrumb-item active">Welcome to Hobort</li> -->
            </ol>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-12 col-12">
         <div class="row">
            <div class="col-lg-6 col-6">
               <div class=" filterSelect mb-3 mt-3 mr-4 ml-3">
                  <select id="new_quote_status" class="js-example-placeholder-single"  name="slct1" oninput="filter_fun_status()" style="">
                     <option value="">All</option>
                     <option value="1">Pending</option>
                     <option value="2">Offer Sent</option>
                     <!-- <option value="3">Accepted</option>
                     <option value="4">Declined</option> -->
                     
                  </select>
               </div>
            </div>
         </div>
      </div>
      <div class="fltr">
         <button class="btn btn-primary" id="myBtn" style="margin-left:890px; margin-bottom: 15px;" onclick="filter_status_click()">Clear Filter</button>
      </div>
   </div>
   <table id="new_quote_concierge" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
      <thead>
         <tr>
            <th>S.No</th>
            <th>Customer Info</th>
            <th>Description</th>
            <th>Status</th>
            <th>Date & Time </th>
            <th>Action</th>
         </tr>
      </thead>
      <tbody>
         <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
      </tbody>
   </table>
</div>
<!-- end col -->
</div>
<!-- end row -->
</div>
<!-- container-fluid -->
</div>
<!-- content -->
</div>
<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src = "https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js" > </script> 
<script type = "text/javascript">
    $('#new_quote_status').select2({
        placeholder: "Status",
        allowClear: true,
         minimumResultsForSearch: -1
    });
</script> 
<script type = "text/javascript" >
    function filter_fun_status() {
        var status = jQuery(".js-example-basic-si").val();
        $('#new_quote_concierge').DataTable().ajax.reload();
    } 
</script> 
<script type = "text/javascript" >
    function filter_status_click() {
        $("#new_quote_status").val('').trigger("change");
        $('#new_quote_concierge').DataTable().ajax.reload();
    } 
</script>