<div class="container-fluid">
   <div class="page-title-box box-spacing">
      <div class="row align-items-center">
         <div class="col-sm-6">
            <h4 class="page-title">Item Type (Air Freight)</h4>
            <ol class="breadcrumb">
               <!-- <li class="breadcrumb-item active">Welcome to Hobort</li> -->
            </ol>
         </div>
         <div class="col-sm-6 text-right">
            <button class="btn btn-primary waves-effect waves-light" type="button" data-toggle="modal" data-target="#airFreightModal">Add New</button>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-12">
         <table id="dtAirFreightItem" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
               <tr>
                  <th>S.No</th>
                  <th>Title</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <tr>
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
<div id="form-modal-box"></div>
<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->
</div>
<!-- END wrapper -->
<div class="modal fade" id="airFreightModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modalWidth" role="document">
   <div class="modal-content">
      <div class="modal-header change-status-heading">
        <h5 class="modal-title" id="exampleModalLabel">Add Item Type</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="<?php echo admin_url('item/add_air_freight_item');?>" class="form-horizontal" method="POST" id="add_item_type">
        <div class="modal-body">
            <div class="form-group">
               <label>Item Type</label>
               <input type="text" name="title" class="form-control">
            </div>
        </div>
        <div class="modal-footer status-btn">
            <button type="button" id="submit" class="btn btn-primary">Add</button>
        </div>
      </form>
   </div>
</div>

<script type="text/javascript">
   $("#add_item_type").validate({
   ignore: [],
   rules:{
   
        title:{
           required: true,
           maxlength:100
       }
   },
   });
   
   var add_item_type = $("#add_item_type");
   $('body').on('click','#submit', function(e){
   
   toastr.remove();
   event.preventDefault();
   if(add_item_type.valid()===false){
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