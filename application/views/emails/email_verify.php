<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php echo getenv('APP_NAME'); ?> | Email Verification</title>
</head>
<?php 
$header_images = getenv('APP_FRONT_ASSETS_IMAGES') . 'header';
$content_images = getenv('APP_FRONT_ASSETS_IMAGES') . 'content';
?>
<body style="font-family: 'Source Sans Pro', sans-serif; padding: 0; margin: 0;">
  <table
    style="max-width: 750px; margin: 0px auto; width: 100% !important; background: #f3f3f3; padding: 30px 30px 30px 30px;"
    width="100% !important" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td style="text-align: center; background: #fff;">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td>
              <img style="max-width: 125px; width: 100%; padding: 10px;" src="<?php echo $header_images?>/logo.png" />
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
              <h3 style="color: #333; font-size: 28px; font-weight: normal; margin: 0;text-transform: capitalize;">
                Verify Your Email Address
              </h3>
              <p style="text-align: left; color: #333; font-size: 16px; line-height: 28px;">
                Hello <?php echo $name; ?>,
              </p>
              <p style="text-align: left; color: #333; font-size: 16px; line-height: 28px;">
                You have successfully created a <?php echo getenv('APP_NAME'); ?> account. Please click on button below to verify your email
                address.
              </p>
              <a href='<?php echo $link;?>'
                style=" background-color:#fca900;border: none;color: white; padding: 10px 30px; text-align: center; text-decoration: none;display: inline-block;margin: 4px 2px; border-radius: 2px;">Verify
                Email</a>

              <p
                style="text-align: left; color: #333; font-size: 13px; line-height: 28px; margin-bottom: 0; margin-top: 30px;">
                Button not working? Please copy-paste the link given below in your browser address bar:
              </p>

              <p style="margin: 0; background-color: #f3f3f3; font-size: 13px; display: inline-block; text-align: left;
                  text-decoration: none; word-break: break-all; color: blue;">
                <?php echo $link;?>
              </p>

              <p style="text-align: left; color: #333; font-size: 16px; line-height: 28px; margin-top: 20px;">
                If you have already verified, please ignore this email.
              </p>

              <p style="text-align: left;color: #333; font-size: 16px; line-height: 28px;">
                Thanks,<br /><?php echo getenv('APP_NAME'); ?> team
              </p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td style="text-align: center;">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#fff">
          <tr>
            <td style="padding: 10px; color: #828282;">
              <?php echo getenv('APP_NAME'); ?> © 2020-2021
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>

</html>