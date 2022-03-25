<!DOCTYPE html>
<html lang="en">
   <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title><?php echo $page_title; ?></title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="<?php echo getenv('APP_NAME'); ?>" name="author" />
        <link rel="shortcut icon" type="image/icon" href="<?php echo getenv('APP_BACK_ASSETS_IMAGES'); ?>favicon.png" />
        <link href="<?php echo getenv('APP_BACK_ASSETS_CSS'); ?>bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo getenv('APP_BACK_ASSETS_CSS'); ?>metismenu.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo getenv('APP_BACK_ASSETS_CSS'); ?>icons.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="<?php echo getenv('APP_BACK_ASSETS_CUSTOM_CSS'); ?>admin_common.css">
        <link href="<?php echo getenv('APP_BACK_ASSETS_CSS'); ?>style.css" rel="stylesheet" type="text/css">
        <link href="<?php echo getenv('APP_BACK_ASSETS_PLUGINS'); ?>toastr/toastr.min.css" rel="stylesheet">
    </head>
   <body>
        <div class="wrapper-page">
            <div class="card overflow-hidden account-card mx-3">
                <div class="bg-primary p-4 text-white text-center position-relative">
                   <!-- <h4 class="font-20 m-b-5">Welcome Back !</h4> -->
                   <p class="text-white-50 mb-4">Sign in to continue to Hobort admin panel</p>
                   <a href="index.html" class="logo logo-admin"><img src="<?php echo getenv('APP_BACK_ASSETS_IMAGES');?>fvcn.png" height="70" alt="logo"></a>
                </div>
                <div class="account-card-content">
                   <form class="form-horizontal m-t-30" action="<?php echo site_url('admin/login') ?>" method="post" id="login_admin">
                      <div class="form-group">
                         <label for="username">Email</label>
                         <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address">
                      </div>
                      <div class="form-group">
                         <label for="userpassword">Password</label>
                         <input type="password" class="form-control" id="userpassword" name="password" placeholder="Enter password" autocomplete="on">
                      </div>
                      <div class="form-group row m-t-20">
                         <div class="col-sm-12 text-right">
                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit" id="submit" name="submit">Log In</button>
                         </div>
                      </div>
                   </form>
                </div>
            </div>
       </div>
      <!-- end wrapper-page -->
      <center>
         <div id="tl_admin_loader" class="tl_loader" style="display: none;" ><img style="float: left;" src="<?php echo getenv('APP_BACK_ASSETS_IMAGES'); ?>Preloader_3.gif"></div>
      </center>

      <!-- Scripts  -->
  
      <script src="<?php echo getenv('APP_BACK_ASSETS_JS'); ?>jquery.min.js"></script>
      <script src="<?php echo getenv('APP_BACK_ASSETS_JS'); ?>bootstrap.bundle.min.js"></script>
      <script src="<?php echo getenv('APP_BACK_ASSETS_JS'); ?>metisMenu.min.js"></script>
      <script src="<?php echo getenv('APP_BACK_ASSETS_JS'); ?>jquery.slimscroll.js"></script>
      <script src="<?php echo getenv('APP_BACK_ASSETS_JS'); ?>waves.min.js"></script>
      <!-- App js -->
      <script src="<?php echo getenv('APP_BACK_ASSETS_JS'); ?>app.js"></script>
      <script src="<?php echo getenv('APP_BACK_ASSETS_CUSTOM_JS'); ?>admin_common.js"></script>
      <script src="<?php echo getenv('APP_BACK_ASSETS_PLUGINS'); ?>jquery-validation/jquery.validate.min.js"></script>
      <script src="<?php echo getenv('APP_BACK_ASSETS_PLUGINS'); ?>toastr/toastr.min.js" type="text/javascript"></script>


      <script type="text/javascript">

        $("#login_admin").validate({
            ignore: [],
            rules:{
               
                email:{
                    required: true,
                    email: true,
                    maxlength: 100
                },
                password:{
                    required: true,
                    maxlength: 100
               }
            },

        });
   
        var login_admin = $("#login_admin");
        $('body').on('click','#submit', function(){

            toastr.remove();
            event.preventDefault();
            if(login_admin.valid()===false){
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
   </body>
</html>

