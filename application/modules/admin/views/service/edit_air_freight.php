<div class="modal fade" id="common_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modalWidth" role="document">
    <div class="modal-content">
       <div class="modal-header change-status-heading">
            <h5 class="modal-title" id="exampleModalLabel">Update Air Freight</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
       </div>
        <form action="<?php echo admin_url('service/edit_air_freight_service'); ?>" class="form-horizontal" method="POST" id="edit_air_freight_detail">
        <div class="modal-body">
            <div class="form-group">
                <input type="hidden" name="id" id="id" value="<?php echo $result->airFreightServiceID; ?>">
               <label>Weight Start Point</label>
               <input type="text" name="weight_from" placeholder="Enter weight in kg" class="form-control" value="<?php echo $result->weight_from?>">
            </div>
            <div class="form-group">
               <label>Weight End Point</label>
               <input type="text" name="weight_end_point" placeholder="Enter weight in kg" class="form-control" <?php echo ($result->weight_to == NULL)? 'disabled' : ''  ?> value="<?php echo $result->weight_to; ?>">
            </div>
            <div class="form-group mb-0">
               <div class="wrapper">
                  <label>No End Range</label>
                  <div class="switch_box box_1">
                     <input type="checkbox" <?php echo ($result->weight_to == NULL)? 'checked' : ''  ?> class="switch_1" name="no_end_range" value="1">
                  </div>
               </div>
            </div>
            <div class="form-group">
               <label>Rate</label>
               <input type="text" name="price" class="form-control" placeholder="Enter rate in $" value="<?php echo $result->price; ?>">
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
   $("div#common_model").on("click", "input[name=no_end_range]", function () {
       _that = $(this);
       var weight_to_input = _that.closest(".form-group").prev().children("input[name=weight_end_point]");
      if (_that.is(":checked")) {
         weight_to_input.prop("disabled", true);
      } else {
         weight_to_input.prop("disabled", false);
      }
   });

   $("#edit_air_freight_detail").validate({
   ignore: [],
    rules:{
       
        weight_from:{
            required: true,
        },
        price:{
            required: true,
            maxlength: 100
        }
      },
      messages: {
        price:{
            maxlength: 'Please enter no more than 8 numbers' 
          },
        } 
    });
   
   var edit_air_freight_detail = $("#edit_air_freight_detail");
   $('body').on('click','#submit', function(e){
   toastr.remove();
   event.preventDefault();
    if(edit_air_freight_detail.valid()===false){
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