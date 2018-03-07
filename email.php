<?php
define('MAIL_FROM_ADDRESS', 'riturajreso@gmail.com');
define('MAIL_FROM_NAME', 'Client services');
define('GUSER', 'burrelles.bang@gmail.com'); // Mail username
define('GPWD', 'burrelles@123'); 
require '../PHPMailer-master/PHPMailerAutoload.php';

$name = $_POST['name'];
$email = $_POST['email'];
$msg = $_POST['message'];

$mailContent = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
								<html xmlns="http://www.w3.org/1999/xhtml">
								<head>
								<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
								<title>'.PORTAL_NAME_2.' - Account Registration</title>
								</head>
								<body>
								<div style="width:100%;background:#F2F2F2;font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#404D5E;overflow:hidden;line-height:18px;">
								<div style="width:570px;margin:15px 15px;background:#fff;padding:15px;border:solid 1px #EDEDED;overflow:hidden;">
								<div style="overflow:hidden;border-bottom:solid 1px #E0E0E0;padding-bottom:15px;margin-bottom:15px;">
								<div style="width:50%;float:left;overflow:hidden;">
								<img src="'.PORTAL_URL.'/images/logo.png" /></div>
								<div style="width:50%;float:left;overflow:hidden;">
								</div>
								</div>

								<div style="overflow:hidden;">								
								<p style="font-size:14px;">Dear Reader,</p>
								<p style="font-size:14px;">
								 This email is to confirm that a new sub account has been created. If you have any queries please contact me, your account manager,
								<b style="color:#03A1FF;">'.$accManagersName.' ('. $accManagersMailId.')</b>
								</p>

								<p style="font-size:14px;"><strong>Name :</strong> '.$customer_name.'</p>
							    <p style="font-size:14px;"><strong>Email :</strong> '.$agrCode.'</p>
								<p style="font-size:14px;"><strong>Message :</strong> '.$agrName.'</p>							
								<p style="font-size:14px;margin:0;">Thank You for your business.</p>
								<br>
								<p style="font-size:14px;margin:0;">Thank You,</p>
								<div style="width:30%;float:left;overflow:hidden;">
									<img src="'.PORTAL_URL.'/images/logo.png" width="100px"/>
								</div>
								<br>
								<p style="color:#828282;margin:0;"><i><br>This notification was automatically generated. Please do not reply to this mail.</i></p>

								</div>
								</div>
								</div>
								</div>							
								</body>
								</html>';

	function sendEmail($to, $from, $fromName, $subject, $content){


		$toaddr = explode("," , $to);
		$error;
		$mail = new PHPMailer();  // create a new object
		$mail->IsSMTP(); // enable SMTP
		$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
		$mail->SMTPAuth = true;  // authentication enabled
		//$mail->Debugoutput ='html';
		$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 465;
		$mail->Username = GUSER;                 // SMTP username
		$mail->Password = GPWD; 
		$mail->IsHTML(true);         
		$mail->SetFrom($from, $fromName);//set fromname for email
		$mail->Subject = $subject;
		//$mail->AddEmbeddedImage("images/logo.png", "logo", "logo.png");
		//$mail->AddEmbeddedImage("images/customer-logo.jpg", "customer-logo", "images/customer-logo.jpg");
		$mail->Body = html_entity_decode($content);
		
		foreach($toaddr as $ad){
			$mail->AddAddress(trim($ad));
		}
		//$mail->AddAddress($to);
		if(!$mail->Send()) {
			 echo 'Message could not be sent.';
   			 echo 'Mailer Error: ' . $mail->ErrorInfo;
   			 return 0;
		} else {
			echo 'Message could  be sent.';
   			return 1;
		}
	}
	$mailIds = 'riturajreso@gmail.com';
	sendEmail($mailIds, MAIL_FROM_ADDRESS, MAIL_FROM_NAME, 'Sub account registration', $mailContent);
