<?php

$datastring = $_POST['customer'];

if(isset($datastring)) {

		$data = json_decode( urldecode( $datastring));

	    $sender_email = "oryxshopy@gmail.com";
		$sender_name = "Oryx Shop";

		$recipient_email = $data->email;
		$recipient_name = "Oryx customer";

		require_once( "class.phpmailer.php" );

		$mail = new PHPMailer;

		$mail->From = $sender_email;
		$mail->FromName = $sender_name;

		$mail->addAddress($recipient_email,$recipient_name);

		$mail->addReplyTo($sender_email,"Reply");

		$mail->isHTML(true);

		$mail->Subject = $data->subject;
		$mail->Body = $data->message;				

		if( !$mail->send() ) {
			return true;
		}else {
			return false;
		}

} else {

	return false;

}
?>
			