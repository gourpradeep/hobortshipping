<div class="container-fluid">
   <div class="page-title-box box-spacing">
      <div class="row align-items-center">
         <div class="col-sm-6">
            <h4 class="page-title">Sea Freight</h4>
            <ol class="breadcrumb">
               <!-- <li class="breadcrumb-item active">Welcome to Hobort</li> -->
            </ol>
         </div>
         <div class="col-sm-6 text-right">
            <button class="btn btn-primary waves-effect waves-light" type="button" id="" data-toggle="modal" data-target="#SeaFreightModal">Add New</button>
         </div>
      </div>
   </div>
   <!-- row -->
   <div class="row">
      <div class="col-12">
         <table id="dtSeaFreightService" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
               <tr>
                  <th>S.No</th>
                  <th>Title</th>
                  <th>Price</th>
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
<div class="modal fade" id="SeaFreightModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modalWidth" role="document">
      <div class="modal-content">
         <div class="modal-header change-status-heading">
            <h5 class="modal-title" id="exampleModalLabel">Add New Item</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="<?php echo admin_url('service/add_sea_freight'); ?>" class="form-horizontal" method="POST" id="add_sea_freight">
            <div class="modal-body">
               <div class="form-group">
                  <label>Title</label>
                  <input type="text" name="title" class="form-control" placeholder=" Enter title">
               </div>
               <div class="form-group">
                  <label>Item Type</label>
                  <select name="type" class="form-control">
                     <option  value="1">Light</option>
                     <option value="2">Heavy</option>
                  </select>
               </div>
               <div class="form-group">
                  <label>Price</label>
                  <input type="text" name="price" class="form-control" placeholder="Enter rate in $">
               </div>
            </div>
            <div class="modal-footer status-btn">
               <button  name="submit" id="submit" class="btn btn-primary">Add</button>
            </div>
         </form>
      </div>
   </div>
</div>
<script type="text/javascript">
   var add_sea_freight = $("#add_sea_freight");
   add_sea_freight.validate({
   ignore: [],
   rules:{
       type:{
           required: true,
        },
        title:{
           required: true,
            maxlength: 200
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
   
   $('body').on('click','#submit', function(e){
      toastr.remove();
      event.preventDefault();
      if(add_sea_freight.valid()===false){
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
                  show_loader();
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