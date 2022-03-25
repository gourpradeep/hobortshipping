<?php 
$header_images = getenv('APP_FRONT_ASSETS_IMAGES') . 'header';
$content_images = getenv('APP_FRONT_ASSETS_IMAGES') . 'content';
// pr($_GET['jsonData']);
?>

<section class="sec-pad-50" style="padding-top: 130px;
    padding-bottom: 30px;">
    <div class="container">
        <div class="verifyBlock emailContent boxViewBorder">
            <img src="<?php echo $content_images;?>/email_verify.png">
            <h2>Please Verify your email</h2>
            <h3>You're almost there! We sent an email to<br>
                <span ><?php echo $email;?></span>
                <input type="hidden" name="email" id="email" value="<?php echo $email;?>">
            </h3>
            <p>Just click on the link in that email to complete your signup.If you<br> don't see it, you may need to <b>check your spam</b> folder.</p>
            <p>Still can't find the email? <a href="javascript:void(0)" style="color: #fca900" onclick="resend_email();">Resend Email</a></p>
            <!-- <a class="btn btnTheme" href="javascript:void(0);" onclick="resend_email();">Resend Email</a> -->
        <?php if(!empty($_GET['qoute']) && $_GET['qoute']=='true'){ ?>
            <a class="btn btnTheme" href='<?php echo base_url('order/current_order?').key_pair($_GET); ?>'>Already Verified</a>
        <?php }else{?>
            <a class="btn btnTheme" href='<?php echo base_url('order/current_order'); ?>'>Already Verified</a>
        <?php }?>
            <!-- <div class="skipOption"><a href="services-providers.html">I will verify later</a></div> -->
        </div>
        
    </div>
</section>


<script type="text/javascript">
    function resend_email(){
        // var email = $('#email').val();
        var email = '<?php echo $email;?>';
        var link = '<?php echo $link;?>';
        var name = '<?php echo $name;?>';
        var url = '<?php echo base_url();?>auth/resend_email';
        // alert(user_id);
        $.ajax({
        type: "POST",
        url: url,
        data: {email:email,link:link,name:name}, //only input
        dataType: "JSON",
        beforeSend: function () {
            show_loader();
        },
        complete: function () {
            hide_loader();
        },
        success: function (data, textStatus, jqXHR) {
            if (data.status == 1) {
                toastr.success(data.msg);
                // window.setTimeout(function () {
                //     window.location.href = data.url;
                // }, 1000);
            } else {
                toastr.error(data.msg);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            toastr.error(err_unknown);
        }
    });
    }
</script>
