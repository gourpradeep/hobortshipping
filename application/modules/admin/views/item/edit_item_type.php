<div class="modal fade" id="common_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modalWidth" role="document">
   <div class="modal-content">
      <div class="modal-header change-status-heading">
            <h5 class="modal-title" id="exampleModalLabel">Update Item Type</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
      </div>
      <form action="<?php echo admin_url('item/edit_air_freight_item');?>" class="form-horizontal" method="POST" id="edit_item_type">
         <div class="modal-body">
         	<input type="hidden" name="id" id="id" value="<?php echo $result->airFreightItemID; ?>">
            <div class="form-group">
               <label>Item Type</label>
               <input type="text" name="title" value="<?php echo $result->title; ?>" class="form-control">
            </div>
        </div>
        <div class="modal-footer status-btn">
            <button type="button" id="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
   </div>
</div>
<script type="text/javascript">
   $("#edit_item_type").validate({
   ignore: [],
   rules:{
   
        title:{
           required: true,
           maxlength:100
        }
   },
   });
   
   var edit_item_type = $("#edit_item_type");
   $('body').on('click','#submit', function(e){
   
   toastr.remove();
   event.preventDefault();
   if(edit_item_type.valid()===false){
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