  <div class="container-fluid">
   <div class="page-title-box box-spacing">
      <div class="row align-items-center">
         <div class="col-sm-6">
            <h4 class="page-title">Admin Profile</h4>
            <ol class="breadcrumb">
               <!-- <li class="breadcrumb-item active">Welcome to Hobort</li> -->
            </ol>
         </div>
      </div>
   </div>
   <!-- end row -->
   <div class="">
      <div class="row">
         <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="customer-detail admin-profile-section">
               <div class="text-center admin-profile">
                 <?php if(!empty($_SESSION[ADMIN_USER_SESS_KEY]['avatar'])){
                  $url = getenv('ADMIN_PROFILE_DIR').$_SESSION[ADMIN_USER_SESS_KEY]['avatar'];
                 }
                 else{
                 $url = getenv('S3_USER_PLACEHOLDER_AVATAR');
               }
                 ?>

                  <img src="<?php  echo $url;?>">
                  <h5><?php echo $_SESSION[ADMIN_USER_SESS_KEY]['name'];?></h5>

                  <p class="mb-0"><?php echo $_SESSION[ADMIN_USER_SESS_KEY]['emailId'];?></p>
               </div>
            </div>
         </div>
         <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12">
            <div class="customer-detail admin-profile-section">
               <nav>
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                     <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Profile</a>
                     <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Change Password</a>
                  </div>
               </nav>
               <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                     <div class="profile-form-detail">
                        <form action="<?php echo admin_url('admin_update'); ?>" method="POST" class="form-horizontal"  id ="admin_update" enctype="multipart/form-data">
                           <input type="hidden" value="<?php echo $_SESSION[ADMIN_USER_SESS_KEY]['adminUserID'];?>"   name ="adminUserID" id="adminUserID" placeholder=""> 
                            <input type="hidden" value="<?php echo $_SESSION[ADMIN_USER_SESS_KEY]['avatar'];?>"   name ="exit_image" id="exit_image" placeholder="">  
                           <div class="row">
                              <div class="col-md-6 col-6">
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Name</label>
                                    <input type="text" class="form-control" name="name" id="exampleInputPassword1" placeholder="Enter Name" value="<?php echo $_SESSION[ADMIN_USER_SESS_KEY]['name'];?>">
                                 </div>
                              </div>
                              <div class="col-md-6 col-6">
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" value="<?php echo $_SESSION[ADMIN_USER_SESS_KEY]['emailId'];?>" aria-describedby="emailHelp" placeholder="Enter Email" readonly>
                                 </div>
                              </div>
                              <div class="col-md-12 col-12">
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Image</label>
                                    <div class="input-group mb-3">
                                       <!-- <div class="input-group-prepend">
                                          <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                          
                                          </div> -->
                                       <div class="custom-file">
                                          <input type="file" class="custom-file-input" name="avatar" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                          <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="text-right submit-btn">
                                    <button id="submit" name="submit" type="submit" class="btn btn-primary">Submit</button>
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                     <div class="profile-form-detail">
                        <form action="<?php echo site_url(); ?>/admin/changePassword" method="POST" class="form-horizontal"  id ="change_pass" enctype="multipart/form-data">
                           <div class="row">
                              <div class="col-md-6 col-6">
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Old Password</label>
                                    <input type="password" name="password" class="form-control" id="exampleInputPassword2" placeholder="Enter Old Password" autocomplete="on">
                                 </div>
                              </div>
                              <div class="col-md-6 col-6">
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">New Password</label>
                                    <input type="password" name="npassword" class="form-control" id="npassword" aria-describedby="emailHelp" placeholder="Enter New Password" autocomplete="on">
                                 </div>
                              </div>
                              <div class="col-md-12 col-12">
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Confirm Password</label>
                                    <input type="password" class="form-control" id="rnpassword" name="rnpassword" aria-describedby="emailHelp" placeholder="Enter Confirm Password" autocomplete="on">
                                 </div>
                                 <div class="text-right submit-btn">
                                    <button type="submit" id="sub" class="btn btn-primary">Submit</button>
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- end row -->
</div>
         
         
<script type="text/javascript">
    $("#admin_update").validate({
    ignore: [],
    rules:{
       
        email:{
            required: true,
            email: true,
            maxlength: 100
        },
        name:{
            required: true,
            maxlength: 100
        }
    },
    });
   
   var admin_update = $("#admin_update");
   $('body').on('click','#submit', function(){
   
   toastr.remove();
   event.preventDefault();
    if(admin_update.valid()===false){
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
        success: function (data, textStatus, jqXHR){ 
            if (data.status == 1){ 
                hide_loader();
                toastr.success(data.msg);
                window.setTimeout(function (){
                window.location.href = data.url;
                }, 1000);
            }
            else {
                hide_loader();
                toastr.error(data.msg);
            }  
        },
    });
});
</script>
<script type="text/javascript">
   $("#change_pass").validate({
   ignore: [],
   rules:{
       
        password:{
           required: true,
           maxlength: 100
        },
        npassword:{
           required: true,
           maxlength: 100
        },
        rnpassword:{
           required: true,
           maxlength: 100
       }
    },
    });
   
   var change_pass = $("#change_pass");
   $('body').on('click','#sub', function(){
   
   toastr.remove();
   event.preventDefault();
    if(change_pass.valid()===false){
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
        success: function (data, textStatus, jqXHR){ 
            if (data.status == 1){ 
                hide_loader();
                toastr.success(data.msg);
                window.setTimeout(function (){
                window.location.href = data.url;
                }, 1000);
            }
            else {
                    hide_loader();
                    toastr.error(data.msg);
            }  
        },
    });
             
});
</script>