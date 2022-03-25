
<div class="container-fluid">
   <div class="page-title-box box-spacing">
      <div class="row align-items-center">
         <div class="col-sm-6">
            <h4 class="page-title">Air Freight</h4>
            <ol class="breadcrumb">
               <!-- <li class="breadcrumb-item active">Welcome to Hobort</li> -->
            </ol>
         </div>
         <div class="col-sm-6 text-right">
            <button class="btn btn-primary waves-effect waves-light" type="button" data-toggle="modal" data-target="#airFreightModal">Add New</button>
         </div>
      </div>
   </div>
   <!-- end row -->
   <div class="row">
      <div class="col-12">
         <table id="dtAirFreightService" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
               <tr>
                  <th>S.No</th>
                  <th>Weight Break</th>
                  <th>Rate </th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <tr>
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
</div>
<div id="form-modal-box"></div>
<!-- END wrapper -->
<div class="modal fade" id="airFreightModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modalWidth" role="document">
    <div class="modal-content">
       <div class="modal-header change-status-heading">
         <h5 class="modal-title" id="exampleModalLabel">Add Weight Break</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
       </div>
        <form action="<?php echo admin_url('service/add_air_freight'); ?>" class="form-horizontal" method="POST" id="add_air_freight_detail">
        <div class="modal-body">
            <div class="form-group">
               <label>Weight Start Point</label>
               <input type="text" name="weight_start_point" class="form-control" placeholder="Enter weight in kg">
            </div>
            <div class="form-group">
               <label>Weight End Point</label>
               <!-- <input type="text" name="weight_end_point" class="form-control" placeholder="Enter weight in kg" id="weight_to"> -->
               <input type="text" name="weight_end_point" class="fg form-control" placeholder="Enter weight in kg">
            </div>
            <div class="form-group mb-0">
               <div class="wrapper">
                  <label>No End Range</label>
                  <div class="switch_box box_1">
                     <input type="checkbox" class="switch_1" id="check" name="no_end_range" value="1">
                  </div>
               </div>
            </div>
            <div class="form-group">
               <label>Rate</label>
               <input type="text" name="price" class="form-control" placeholder="Enter rate in $">
            </div>
      </div>
      <div class="modal-footer status-btn">
      <button type="button" id="submit" class="btn btn-primary">Add</button>
      </div>
      </form>
   </div>
</div>
<script type="text/javascript">
   //Air Freight "No end Range" Toggle
   $("div#airFreightModal").on("click", "input[name=no_end_range]", function () {
      _that = $(this);
      var weight_to_input = _that.closest(".form-group").prev().children("input[name=weight_end_point]");
      if (_that.is(":checked")) {
         weight_to_input.prop("disabled", true);
      } else {
         //toastr.error('Weight End Point required');
         weight_to_input.prop("disabled", false);

      }
   });

   $("#add_air_freight_detail").validate({
   ignore: [],
    rules:{
       
        weight_start_point:{
            required: true,
        },
        price:{
            required: true,
            maxlength: 9
        }
         
    },
    messages: {
      price:{
        maxlength: 'Please enter no more than 8 numbers' 
      },
    }
    });
  
   var add_air_freight_detail = $("#add_air_freight_detail");
   $('body').on('click','#submit', function(e){
   toastr.remove();
   event.preventDefault();
    if(add_air_freight_detail.valid()===false){
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
        complete:function() {
         hide_loader();
         },
        success: function (data, textStatus, jqXHR){ 
            if (data.status == 1){ 
                hide_loader();
                toastr.success(data.msg);
                window.setTimeout(function (){
                window.location.href = data.url;
                }, 1000);
            } else if(data.status == -1) {
               //authetication failed
                toastr.error(data.msg);
                window.setTimeout(function () {
                  window.location.href = data.url ;
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
<script>
  

$(document).ready(function(){
  $('#check').change(function(){
    $("#weight_to").prop("disabled",false);
});
});
</script>
