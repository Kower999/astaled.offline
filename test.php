<?php
/*
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
$headers .= 'From: PKNZ <info@astaled.sk>' . "\r\n";

mail('kower99@gmail.com', 'Import výdajky s chybami', 'test', $headers);
*/
require(dirname(__FILE__)."/modules/data/classes/phpmailer/class.phpmailer.php");
require(dirname(__FILE__)."/modules/data/classes/phpmailer/class.smtp.php");
$mail = new PHPMailer();
//$mail->SMTPDebug = 2; 
$mail->isSMTP(); // send via SMTP
//IsSMTP(); // send via SMTP
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->Username = "astaledonline@gmail.com"; // SMTP username
$mail->Password = "L83OwYky"; // SMTP password
$webmaster_email = "astaledonline@gmail.com"; //Reply to this email ID

$email="kower99@gmail.com"; // Recipients email ID
$name="kower"; // Recipient's name
$mail->From = $webmaster_email;
$mail->FromName = "AstaledOffline";
$mail->AddAddress($email,$name);
$mail->AddReplyTo($webmaster_email,"Webmaster");
$mail->WordWrap = 50; // set word wrap
//$mail->AddAttachment("/var/tmp/file.tar.gz"); // attachment
//$mail->AddAttachment("/tmp/image.jpg", "new.jpg"); // attachment
$mail->isHTML(true); // send as HTML
$mail->Subject = "This is the subject";
$mail->Body = "Hi,
This is the HTML BODY "; //HTML Body
$mail->AltBody = "This is the body when user views in plain text format"; //Text Body
//$mail->Send();
if(!$mail->Send())
{
echo "Mailer Error: " . $mail->ErrorInfo;
}
else
{
echo "Message has been sent";
}

?>