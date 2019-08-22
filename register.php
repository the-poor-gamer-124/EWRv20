<?php
	ini_set("display_errors", 1);
	error_reporting(E_ALL);
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require __DIR__ . "/mailfunctions/PHPMailer/src/autoloader.php";
    require_once __DIR__ . "/inc/dbconfig.php";
    $username = $password = $confirmPassword = $email = "";
    $usernameErr = $passwordErr = $confirmPasswordErr = $emailErr = $gRecaptchaErr = "";
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty(trim($_POST["username"]))) {
            $usernameErr = "Please insert an username.";
        } else {
            $sql = "SELECT id FROM users WHERE username = ?";
            if($stmt = mysqli_prepare($conn, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $paramUsername);
                $paramUsername = trim($_POST["username"]);
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $usernameErr = "The username was already picken up.";
                    }else{
                        $username = trim($_POST["username"]);
                    }
                }else{
                    echo "Oops, there was an error. Please try again later.";
                }
            }
            mysqli_stmt_close($stmt);
        }
        if (empty(trim($_POST["password"]))){
            $passwordErr = "Please insert a password.";
        } elseif(strlen(trim($_POST["password"])) < 8){
            $passwordErr = "The password must have at least 8 characters.";
        } else{
            $password = trim($_POST["password"]);
        }
        if(empty(trim($_POST["confirmPassword"]))){
            $confirmPasswordErr = "Please confirm the passwords.";
        }else{
            $confirmPassword = trim($_POST['confirmPassword']);
            if(empty($passwordErr) && ($password != $confirmPassword)){
                $confirmPasswordErr = "The passwords don't match.";
            }
        }
        if(empty(trim($_POST["email"]))){
            $emailErr = "Please insert an email.";
        } else {
            $email = trim($_POST['email']);
        }
        if(empty($usernameErr) && empty($passwordErr) && empty($confirmPasswordErr) && empty($emailErr)){
            $gRecaptchaResponse = $_POST["g-recaptcha-response"];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => '6LdPlrMUAAAAAJUTfGY2FmU-DDuLOX_ZU5uZcycM', 'response' => $gRecaptchaResponse)));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $jsonValue = curl_exec($ch);
            $gRecaptchaResp = json_decode($jsonValue);
            if($gRecaptchaResp->success == true){
                $sql = "INSERT INTO users (username, password, email, activation_code) VALUES (?, ?, ?, ?)";
                if($stmt = mysqli_prepare($conn, $sql)){
                    mysqli_stmt_bind_param($stmt, "ssss", $paramUsername, $paramPassword, $paramEmail, $uniqueId);
                    $paramUsername = $username;
                    $paramPassword = password_hash($password, PASSWORD_DEFAULT);
                    $paramEmail = $email;
                    $uniqueId = uniqid();
                   if(mysqli_stmt_execute($stmt)){
                       $mail = new PHPMailer(true);
					   $activate_link = 'https://ergastolator.website/en/activate?email=' . $email . '&code=' . $uniqueId;
                       $message = '<p>Welcome to Ergastolator Website!</p><br /><p>Please click this link to activate the account: <a href="' . $activate_link . '">' . $activate_link . '</a>.</p><br /><p>We hope you have a great day.</p><br /><br /><div style="text-align:right">The Ergastolator Website&#39;s Creator</div>';
					   try {
						$mail->isSMTP();
						$mail->Host = "ssl://smtp.gmail.com:465";
						$mail->SMTPAuth = true;
						$mail->Username = "robertobongiorno24@gmail.com";
						$mail->Password = "Ergastolator1#";
						$mail->setFrom("robertobongiorno24@gmail.com", "ErgastolatorOfficial 1");
						$mail->addAddress($email);
						$mail->isHTML(true);
						$mail->Subject = "Activate your account";
						$mail->Body = $message;
						$mail->send();
                       header("Location: registerSuccess");
					   } catch (Exception $e){
						 echo "Error in the Mailer: ".$e->getError();  
					   }
                   }else{
                        echo "Oops, there was an error. Please try again later.";
                    }
                }
                mysqli_stmt_close($stmt);
            } else {
                $gRecaptchaErr = "You didn't complete the reCAPTCHA challenge (didn't check the checkbox), or you passed it as a bot.";
            }
            curl_close($ch);
        }
        mysqli_close($conn);
    }
?>
<!DOCTYPE HTML>
<html lang="en-US" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<title>Register &mdash; Ergastolator Website Redesign v20</title>
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="author" content="ErgastolatorOfficial 1" />
		<meta property="og:title" content="Register" />
		<meta property="og:description" content="" />
		<meta property="og:type" content="website" />
		<meta property="og:image" content="http://yt3.ggpht.com/a-/AAuE7mCCGGlEWQgWXgodYbEQ0Gxn_ara5wV1JU0qzw=s512-c-k-c0x00ffffff-no-rj-mo" />
		<meta property="og:image:secure_url" content="https://yt3.ggpht.com/a-/AAuE7mCCGGlEWQgWXgodYbEQ0Gxn_ara5wV1JU0qzw=s512-c-k-c0x00ffffff-no-rj-mo" />
		<meta property="og:image:type" content="image/jpeg" />
		<meta property="og:image:width" content="512" />
		<meta property="og:image:height" content="512" />
		<meta property="og:site_name" content="Ergastolator Website Redesign v20" />
		<meta property="og:url" content="https://ergastolator.website" />
		<meta name="viewport" content="width=device-width, minimum-scale=1, initial-scale=1, maximum-scale=1" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
		<link rel="stylesheet" href="css/materialize.min.css" />
		<link rel="stylesheet" href="css/style.css" />
	</head>
	<body class="black lighten-2 white-text">
		<nav style="background:#1a1a1a" role="navigation">
			<div class="nav-wrapper container">
				<a id="logo-container" href="./" class="brand-logo">
					<img src="https://yt3.ggpht.com/a-/AAuE7mCCGGlEWQgWXgodYbEQ0Gxn_ara5wV1JU0qzw=s64-c-k-c0x00ffffff-no-rj-mo" alt="eo1_logo" />
				</a>
				<ul class="right hide-on-med-and-down">
					<li>
						<a href="./">Home</a>
					</li>
					<li>
						<a href="about">About</a>
					</li>
					<li>
						<a href="contacts">Contacts</a>
					</li>
					<li>
					    <a href="login">Login</a>
					</li>
					<li>
					    <a href="#">Register</a>
					</li>
				</ul>
				<ul id="nav-mobile" class="sidenav">
					<li>
						<a href="./">Home</a>
					</li>
					<li>
						<a href="about">About</a>
					</li>
					<li>
						<a href="contacts">Contacts</a>
					</li>
					<li>
					    <a href="login">Login</a>
					</li>
					<li>
					    <a href="#">Register</a>
					</li>
				</ul>
				<a href="#" class="sidenav-trigger" data-target="nav-mobile">
					<i class="material-icons">menu</i>
				</a>
			</div>
		</nav>
		<div id="index-banner" class="parallax-container">
			<div class="section no-pad-bot">
				<div class="container">
					<br />
					<br />
					<h1 class="header center white-text text-lighten-1">Register</h1>
					<div class="row center">
						<h5 class="header col s12 light">Please register to have more features!</h5>
					</div>
				</div>
			</div>
			<div class="parallax">
				<img src="img/parallax.png" alt="parallax" style="transform: translate3d(-50%, 500.908px, 0px); opacity: 1;" />
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col l7 s14">
					<h4>Register</h4>
					<p>Please compile the following form to register.</p>
				</div>
				<div class="col l4 s6 ergdesign">
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
					    <div class="input-field">
					        <input type="text" name="username" id="username" value="<?php echo $username; ?>" />
					        <label for="username">Username</label>
					        <p style="color:red"><?php echo $usernameErr; ?></p>
					    </div>
					    <div class="input-field">
					        <input type="password" name="password" id="password" />
					        <label for="password">Password</label>
					        <p style="color:red"><?php echo $passwordErr; ?></p>
					    </div>
					    <div class="input-field">
					        <input type="password" name="confirmPassword" id="confirmPassword" />
					        <label for="confirmPassword">Confirm password</label>
					        <p style="color:red"><?php echo $confirmPasswordErr; ?></p>
					    </div>
					    <div class="input-field">
					        <input type="email" name="email" id="email" />
					        <label for="email">Email</label>
					        <p style="color:red"><?php echo $emailErr; ?></p>
					    </div>
					    <br />
					    <p>Please confirm whether you are a bot or not:</p>
					    <div class="g-recaptcha" data-sitekey="6LdPlrMUAAAAAGNgRXDUMUdROp1Vb4ru8Cv1SV86" data-theme="dark"></div>
					    <p style="color:red"><?php echo $gRecaptchaErr; ?></p>
					    <br />
					    <button type="submit" class="btn waves-effect waves-light red white-text lighten-1">Register</button>
					</form>
					<p><a href="resetpassword">Reset the password</a></p>
					<p>Have already an account? <a href="login">Login</a>.</p>
				</div>
			</div>
		</div>
		<footer class="page-footer" style="background:#1a1a1a">
			<div class="container">
				<div class="row">
					<div class="col l6 s12">
						<h5 class="white-text">About Ergastolator</h5>
						<p class="grey-text text-lighten-4">Lorem ipsum dolor sit amet, consectetur adolipscing elit.</p>
					</div>
					<div class="col l3 s12">
						<h5 class="white-text">Menu</h5>
						<ul>
							<li>
								<a href="./" class="white-text">Home</a>
                            </li>
                            <li>
								<a href="about" class="white-text">About</a>
                            </li>
                            <li>
								<a href="contacts" class="white-text">Contacts</a>
							</li>
							<li>
							    <a href="login" class="white-text">Login</a>
							</li>
							<li>
							    <a href="#" class="white-text">Register</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="footer-copyright">
				<div class="container">
					<p>&copy; 2019-<?php echo date("Y"); ?> ErgastolatorOfficial1. All rights reserved. Powered by <a href="https://materializecss.com" target="_blank">Materialize</a>.</p>
				</div>
			</div>
		</footer>
		<script src="js/jquery.min.js"></script>
		<script src="js/materialize.min.js"></script>
		<script src="js/custom.js"></script>
		<script src="https://www.google.com/recaptcha/api.js?hl=en" async="async" defer="defer"></script>
	</body>
</html>