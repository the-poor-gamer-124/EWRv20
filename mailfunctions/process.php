<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require __DIR__ . "/PHPMailer/src/autoloader.php";
	$mail = new PHPMailer(true);
	$username = $_POST["username"];
	$email = $_POST["email"];
	$message = $_POST["message"];
	try {
		$mail->isSMTP();
		$mail->Host = "ssl://smtp.gmail.com:465";
		$mail->SMTPAuth = true;
		$mail->Username = "robertobongiorno24@gmail.com";
		$mail->Password = "Ergastolator1#";
		$mail->setFrom("robertobongiorno24@gmail.com", "ErgastolatorOfficial 1");
		$mail->addAddress("ergastolator7@gmail.com");
		$mail->addReplyTo($email);
		$mail->addCC("admin@ergastolator.website");
		$mail->isHTML(true);
		$mail->Subject = "New Message";
		$mail->Body = "Username: ".$username."<br />Email: ".$email."<br /><br />Message: ".$message."<br /><br /><div align='right'>Sent from Ergastolator Website";
		$mail->AltBody = "Username: ".$username."\nEmail: ".$email."\n\nMessage: ".$message."\n\nSent from Ergastolator Website";
		$mail->send();
		header("Location: ../success.php");
	} catch (Exception $e) {
		header("Location: ../error.php");
	}
?>
