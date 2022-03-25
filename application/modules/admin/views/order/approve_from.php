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
           <!--  <div class="form-group">
              
                  <label for="exampleInputEmail1">Tracking ID</label>
                  <input type="text" class="form-control" id="tracking_id" name="tracking_id" aria-describedby="emailHelp" placeholder="Enter Tracking Id">
               </div> -->
                <input type="hidden" name="id" id="id" value="<?php echo $order->orderID; ?>">
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