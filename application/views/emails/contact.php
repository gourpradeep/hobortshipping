<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title><?php echo getenv('APP_NAME'); ?></title>
</head>
	<?php 
      	$header_images = getenv('APP_FRONT_ASSETS_IMAGES') . 'header';
   ?>
<body>
	<div
		style="max-width: 700px; margin: 0 auto; border: 1px solid #e8e8e8; border-radius: 5px; font-family: sans-serif;padding: 20px; background: #f2f2f2; box-sizing: border-box;">
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
					<h5 style="font-size: 17px; font-family: sans-serif; margin-bottom: 0;">Hi, ADMIN
					</h5>
				</td>
			</tr>
			<tr>
				<td style="padding: 5px 20px; box-sizing: border-box;">
					<div style="background: #f8f8f8; padding: 10px 15px; box-sizing: border-box; border-radius: 5px;">
						<h2 style="margin-top: 5px;font-size: 18px; color: #333; ">Contact Details</h2>
						<div style="padding: 0px 10px 15px 10px; font-size: 16px;">
							<p>Full Name: <b><?php echo ucfirst($name); ?></b></p>
							<p>Email: <b><?php echo $email; ?></b></p>
							<p>Message: <b><?php echo $message; ?>.</b>
							</p>
						</div>
					</div>
				</td>
			</tr>
		</table>
		<p style="margin-bottom: 0; text-align: center; color: #666;">Hobort Shipping &copy; 2020.</p>
	</div>
</body>

</html>