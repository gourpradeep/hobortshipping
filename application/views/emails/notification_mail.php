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
                  <h5 style="font-size: 17px; font-family: sans-serif; margin-bottom: 0;">Hello, <?php echo $name; ?></h5>
                  <p style="color: #666; font-size: 16px; line-height: 24px;"> <?php echo $subject;?>. You will find the details about your quote below.
               </td>
            </tr>
            <tr>
               <td style="padding: 5px 20px; box-sizing: border-box;">
                  <div style="background: #f8f8f8; padding: 10px 15px; box-sizing: border-box; border-radius: 5px;">
                     <h2 style="margin-top: 5px;font-size: 18px; color: #333; ">Quote Details</h2>
                     <table style="width: 100%;">
                        <tr>
                           <?php if($orderexist->service_type == 1){?>
                           <td style="padding: 5px 10px; box-sizing: border-box; font-size: 17px;">Delivery Type</td>
                           <td style="padding: 5px 10px; box-sizing: border-box; font-size: 17px;"><b>Air Freight</b></td>
                        </tr>
                        <tr>
                           <td style="padding: 5px 10px; box-sizing: border-box; font-size: 17px;">Item Value</td>
                           <td style="padding: 5px 10px; box-sizing: border-box; font-size: 17px;"><b><?php echo $air->item_value?></b></td>
                        </tr>
                        <?php } ?>
                        <?php if($orderexist->service_type == 2){?>
                        <td style="padding: 5px 10px; box-sizing: border-box; font-size: 17px;">Delivery Type</td>
                        <td style="padding: 5px 10px; box-sizing: border-box; font-size: 17px;"><b>Sea Freight</b></td>
                        </tr>
                        <tr>
                           <td style="padding: 5px 10px; box-sizing: border-box; font-size: 17px;">Item</td>
                           <td style="padding: 5px 10px; box-sizing: border-box; font-size: 17px;"><b><?php echo $sea->title?></b></td>
                        </tr>
                        <?php } ?>
                        <!-- <?php if($orderexist->service_type == 3){?>
                        <td style="padding: 5px 10px; box-sizing: border-box; font-size: 17px;">Delivery Type</td>
                        <td style="padding: 5px 10px; box-sizing: border-box; font-size: 17px;"><b>Courier & Express Services</b></td>
                        </tr>
                        <tr>
                           <td style="padding: 5px 10px; box-sizing: border-box; font-size: 17px;">Item</td>
                           <td style="padding: 5px 10px; box-sizing: border-box; font-size: 17px;"><b><?php echo $courier->title?></b></td>
                        </tr>
                        <?php } ?> -->
                        <!-- <?php if($orderexist->service_type == 5){?>
                        <tr>
                           <td style="padding: 5px 10px; box-sizing: border-box; font-size: 17px;">Delivery Type</td>
                           <td style="padding: 5px 10px; box-sizing: border-box; font-size: 17px;"><b>My Shipment</b></td>
                        </tr>
                       <tr>
                           <td style="padding: 5px 10px; box-sizing: border-box; font-size: 17px;">Weight</td>
                           <td style="padding: 5px 10px; box-sizing: border-box; font-size: 17px;"><b><?php echo $orderexist->shipment_weight .'Kg';?></b></td>
                        </tr>
                        <?php } ?> -->
                        <!-- <?php if($orderexist->service_type == 4){?>
                        <td style="padding: 5px 10px; box-sizing: border-box; font-size: 17px;">Delivery Type</td>
                        <td style="padding: 5px 10px; box-sizing: border-box; font-size: 17px;"><b>Concierge Shipping</b></td>
                        </tr>
                        <tr>
                           <td style="padding: 5px 10px; box-sizing: border-box; font-size: 17px;">Cost of order</td>
                           <td style="padding: 5px 10px; box-sizing: border-box; font-size: 17px;"><b>$<?php echo $orderexist->order_cost; ?></b></td>
                        </tr>
                        <tr>
                           <td style="padding: 5px 10px; box-sizing: border-box; font-size: 17px;">Concierge Fee</td>
                           <td style="padding: 5px 10px; box-sizing: border-box; font-size: 17px;"><b>$<?php echo $orderexist->concierge_fee; ?></b></td>
                        </tr>
                        <tr>
                           <td style="padding: 5px 10px; box-sizing: border-box; font-size: 17px;">Total</td>
                           <td style="padding: 5px 10px; box-sizing: border-box; font-size: 17px;"><b>$<?php echo $orderexist->price?></b></td>
                        </tr>
                        <?php } ?> -->
                        <?php if(!empty($orderexist->quantity)){ ?>
                        <tr>
                           <td style="padding: 5px 10px; box-sizing: border-box; font-size: 17px;">Qty.</td>
                           <td style="padding: 5px 10px; box-sizing: border-box; font-size: 17px;"><b><?php echo $orderexist->quantity; ?></b></td>
                        </tr>
                        
                        <?php }?>
                        <?php if($orderexist->service_type == 1 ||$orderexist->service_type == 2 ||$orderexist->service_type == 3 ||$orderexist->service_type == 5){?>

                        <tr>
                           <td style="padding: 5px 10px; box-sizing: border-box; font-size: 17px;">Price</td>
                           <td style="padding: 5px 10px; box-sizing: border-box; font-size: 17px;"><b>$<?php echo $orderexist->price?></b></td>
                        </tr>
                        <?php } ?>

                        <tr>
                           <td style="padding: 5px 10px; box-sizing: border-box; font-size: 17px;">Status</td>
                           <td style="padding: 5px 10px; box-sizing: border-box; font-size: 17px;"><span style="background: #f47e20; color: #fff; padding: 4px 10px; border-radius: 3px; box-sizing: border-box;">
                              <?php if($status==2) {
                                 $status_type = "Approved";
                                 echo $status_type ?></span>
                           </td>
                           <?php }?> 
                           <?php if($status==3) {
                                 $status_type = "Package received at our warehouse";
                                 echo $status_type ?></span>
                           </td>
                           <?php }?> 
                           <?php if($status==4) {
                              $status_type = "Package preparing to ship";
                              echo $status_type ?></span></td>
                           <?php }?>
                           <?php if($status==5) {
                              $status_type = "Shipment dropped off at Atlanta Airport";
                              echo $status_type ?></span></td>
                           <?php }?>
                           <?php if($status==6) {
                              $status_type = "Shipment in transit";
                              echo $status_type ?></span></td>
                           <?php }?> 
                           <?php if($status==7) {
                              $status_type = "Shipment arrived in accra";
                              echo $status_type ?></span></td>
                           <?php }?>      
                           <?php if($status==8) {
                              $status_type = "Customs clearance started";
                              echo $status_type ?></span></td>
                           <?php }?>  
                           <?php if($status==9) {
                              $status_type = "Shipment cleared";
                              echo $status_type ?></span></td>
                           <?php }?>                
                        </tr>
                     </table>
                  </div>
               </td>
            </tr>
            <tr>
               <td>
                  <div style="display: block; padding: 20px 20px 20px; box-sizing: border-box; text-align: center;">
                     <!-- <h2 style="color: #666; font-size: 20px;">Your Quote Status is <span style="color: orange;">Pending</span></h2> -->
                     <a href="<?php echo $orderexist->dynamic_link; ?>" style="background: #004866; color: #fff; text-decoration: none; padding: 12px 20px; display: inline-block; border-radius: 8px; box-sizing: border-box;">Track order</a>
                  </div>
               </td>
            </tr>
         </table>
         <p style="margin-bottom: 0; text-align: center; color: #666;">Hobort Shipping &copy; 2020.
      </div>
   </body>
</html>