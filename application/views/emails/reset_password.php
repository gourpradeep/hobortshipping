<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo SITE_TITLE ?> | Password Reset</title>
    <?php 
    $header_images = getenv('APP_FRONT_ASSETS_IMAGES') . 'header';
    $content_images = getenv('APP_FRONT_ASSETS_IMAGES') . 'content';
    ?>
</head>
<body style="font-family: 'Source Sans Pro', sans-serif; padding:0; margin:0;">
    <table style="max-width: 750px; margin: 0px auto; width: 100% ! important; background: #F3F3F3; padding:30px 30px 30px 30px;" width="100% !important" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td style="text-align: center; background: #ffffff;">
                <table width="100%" border="0" cellpadding="30" cellspacing="0">    
                    <tr>
                        <td>
                            <img style="max-width: 125px; width: 100%;padding: 10px;" src="<?php echo $header_images;?>/logo.png">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        
        <tr>
            <td style="text-align: center;">
                <table width="100%" border="0" cellpadding="30" cellspacing="0" bgcolor="#fff">
                    <tr>
                        <td>

                            <h3 style="color: #333; font-size: 28px; font-weight: normal; margin: 0; text-transform: capitalize;">Reset Password</h3>
                            <p style="text-align: left; color: #333; font-size: 16px; line-height: 28px;">Hello <?php echo ucfirst($name);?>,</p>
                            <p style="text-align: left;color: #333; font-size: 16px; line-height: 28px;">You Recently requested to reset your password for your Hobort Shipping account. Please use password given below to login: </p>
                            <h3 style="margin: 0; background-color: #F3F3F3; font-size: 25px; display: inline-block; font-weight: bold;"><?php echo $password ?></h3>
                            <p style="text-align: left;color: #333; font-size: 16px; line-height: 28px;">If you did not request password reset, please login with above password and change your password immediately.</p>  

                            <p style="text-align: left;color: #333; font-size: 16px; line-height: 28px;">Thanks,<br><?php echo getenv('APP_NAME'); ?> team</p>  
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="text-align: center;">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#fff">
                     <tr>
                        <td style="padding: 10px;background: rgba(0,0,0,0.95);color: #fff;"><?php echo COPYRIGHT; ?></td>
                    </tr>
                    <!-- <tr>
                        <td style="padding: 0 0 3px;background: #cf1f2a;color: #fff;"> You're receiving this email because you have subscribed to KinkLink's notification services.If you don't want to receive notifications like this <a href="<?php echo $unsubscibe_link;?>" style="display: inline-block;margin: 4px 2px;color: #202120">unsubscribe here</a></td>
                    </tr> -->
                </table>
            </td>
        </tr>
    </table>
</body>
</html>