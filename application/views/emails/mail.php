<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title><?php echo getenv('APP_NAME'); ?></title>
</head>
   <?php 
      $header_images = getenv('APP_FRONT_ASSETS_IMAGES') . 'header';
      $content_images = getenv('APP_FRONT_ASSETS_IMAGES') . 'content';
   ?>
<body>
   <div style="max-width: 700px; margin: 0 auto; border: 1px solid #e8e8e8; border-radius: 5px; font-family: sans-serif;padding: 20px; background: #f2f2f2; box-sizing: border-box;">
      <table style="width: 100%;background: #fff; border-radius: 5px;">
         <tr>
            <td style="border-bottom: 1px solid #e8e8e8; padding: 10px 0;"> 
               <div style="text-align: center;">
                  <img style="max-width: 200px;" src="<?php echo $header_images?>/logo.png" />
               </div>
            </td>
         </tr>
         <tr>
            <td style="padding: 5px 20px; box-sizing: border-box;">
               <h5 style="font-size: 17px; font-family: sans-serif; margin-bottom: 0;">Hey, <?php echo $name; ?></h5>
               <p style="color: #666; font-size: 16px; line-height: 24px;">   You've got an offer for Concierge Shipping order
               </td>
         </tr>
         <tr>
            <td style="padding: 5px 20px; box-sizing: border-box;">
               <div style="background: #f8f8f8; padding: 10px 15px; box-sizing: border-box; border-radius: 5px;">
                  <h2 style="margin-top: 5px;font-size: 18px; color: #333; ">Quote Details</h2>
                  <table style="width: 100%;">
                     <tr>
                        <td style="padding: 5px 10px; box-sizing: border-box;">Delivery Type</td>
                        <td style="padding: 5px 10px; box-sizing: border-box;"><b>Concierge Shipping</b></td>
                     </tr>
                     <tr>
                        <td style="padding: 5px 10px; box-sizing: border-box;">Offer Price</td>
                        <td style="padding: 5px 10px; box-sizing: border-box;"><b><?php echo '$'.$price; ?></b></td>
                     </tr>
                  </table>
               </div>
            </td>
         </tr>
         <tr>
            <td>
               <div style="display: block; padding: 20px 20px 20px; box-sizing: border-box; text-align: center;">
                  <!-- <h2 style="color: #666; font-size: 20px;">Your Quote Status is <span style="color: orange;">Pending</span></h2> -->
                  <a href="<?php echo getenv('CURRENT_ORDER_DYNAMIC_LINK');?>" style="    background: #004866; color: #fff; text-decoration: none; padding: 12px 20px; display: inline-block; border-radius: 8px; box-sizing: border-box;">Track Order</a>
               </div>
            </td>
         </tr>
      </table>
      <p style="margin-bottom: 0; text-align: center; color: #666;">Hobort Shipping &copy; 2020.
   </div>
</body>
</html>