<div class="modal fade" id="common_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modalWidth" role="document">
      <div class="modal-content">
         <div class="modal-header change-status-heading">
            <h5 class="modal-title" id="exampleModalLabel"> Update Sea Freight</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="<?php echo admin_url('service/edit_sea_freight_service'); ?>" class="form-horizontal" method="POST" id="edit_sea_freight">
            <div class="modal-body">
               <div class="form-group">
                  <input type="hidden" name="id" id="id" value="<?php echo $edit_sea_freight->seaFreightServiceID; ?>">
                  <label>Title</label>
                  <input type="text" name="title" class="form-control" placeholder="Enter title" value="<?php echo $edit_sea_freight->title; ?>">
               </div>
               <div class="form-group">
                  <select name="type" class="form-control" id="type">
                     <option value="">Select</option>
                     <option value="1" <?php if($edit_sea_freight->type == '1') { echo 'selected'; }?>>Light</option>
                     <option value="2" <?php if($edit_sea_freight->type == '2') { echo 'selected'; }?>>Heavy</option>
                  </select>
               </div>
               <div class="form-group">
                  <label>Price</label>
                  <input type="text" name="price" class="form-control" placeholder="Enter rate in $" value="<?php echo $edit_sea_freight->price; ?>">
               </div>
            </div>
            <div class="modal-footer status-btn">
               <button  name="submit" id="submit" class="btn btn-primary">Update</button>
            </div>
         </form>
      </div>
   </div>
</div>
<script type="text/javascript">
   var edit_sea_freight = $("#edit_sea_freight");
   edit_sea_freight.validate({
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
   if(edit_sea_freight.valid()===false){
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
               //hide_loader();
               toastr.error(data.msg);
            }  
        },
   });
    e.stopImmediatePropagation();
    return false
   });
</script>