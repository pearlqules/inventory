<?php
/*##########Script Information#########
  # Purpose: Send mail Using PHPMailer#
  #          & Gmail SMTP Server 	  #
  # Created: 24-11-2019 			  #
  #	Author : Hafiz Haider			  #
  # Version: 1.0					  #
  # Website: www.BroExperts.com 	  #
  #####################################*/

//Include required PHPMailer files
	require 'includes/PHPMailer.php';
	require 'includes/SMTP.php';
	require 'includes/Exception.php';
//Define name spaces
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
//Create instance of PHPMailer
	$mail = new PHPMailer();
//Set mailer to use smtp
	$mail->isSMTP();
//Define smtp host
	$mail->Host = "smtp.gmail.com";
//Enable smtp authentication
	$mail->SMTPAuth = true;
//Set smtp encryption type (ssl/tls)
	$mail->SMTPSecure = "tls";
//Port to connect smtp
	$mail->Port = "587";
//Set gmail username
	$mail->Username = "ttgds.vkm@gmail.com"; //Your Gmail Email Address Here
//Set gmail password
	$mail->Password = "kaimook."; //Your Gmail Password Here
//Email subject
	$mail->Subject = "[New]Inventory BSM&ESM"; //Test email using PHPMailer
//Set sender email
	$mail->setFrom('ttgds.vkm@gmail.com'); //Sender Email who will send email
//Enable HTML
	$mail->isHTML(true);
//Attachment
	// $mail->addAttachment('img/attachment.png');
//Email body
	$mail->Body = "<h1>Hello This is mail from PearlShine Resort </h1></br>
	<p>You have successfully booking now.This is your booking ID  $row[id_booking]
	You can get your ID to check information in our website or click link 
	<a href='http://localhost/ps/booking'>PearlShine Resort</a> Thankyou. </p>";
//Add recipient
	$mail->addAddress('april2443@outlook.com'); //Email of the person who will receive email
//Finally send email
	if ( $mail->send() ) {
		echo "ส่งสำเร็จ";
	}else{
		echo "ส่งไม่สำเร็จ: "{$mail->ErrorInfo};
	}
//Closing smtp connection
	$mail->smtpClose();

?>
