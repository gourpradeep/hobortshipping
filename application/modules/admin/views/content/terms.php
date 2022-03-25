<!-- Content Wrapper. Contains page content -->
  <section class="content" >
   <div class="row" >
      <div class="col-md-12" >
            <h5>Terms & Conditions</h5>
            <div class="box-body pad" >
               <form action="<?php echo base_url(); ?>admin/termsctrl/terms" id="terms" class="form-horizontal" enctype="multipart/form-data" method="POST" >
                  <textarea id="editor1" name="editor1" rows="10" cols="80" >
						<?php echo $result?> 
					</textarea>
                  <br>
                  <div class="" >
                     <button style="float: right;" type ="submit" id="terms" class="btn btn-warning btn-flat">Submit</button>
                  </div>
               </form>
            </div>
      </div>
   </div>
</section>
<script>
   $.material.init();
</script>
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script>
   	$(function () {
     	CKEDITOR.replace('editor1');
     	$(".textarea").wysihtml5();
   	});
</script>