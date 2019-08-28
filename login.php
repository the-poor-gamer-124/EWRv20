<?php
    session_start();
    
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
        header("Location: ./");
        exit;
    }
    
    require_once __DIR__ . "/inc/dbconfig.php";
    
    $username = $password = "";
    $usernameErr = $passwordErr = "";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty(trim($_POST["username"]))){
            $usernameErr = "Please insert the username.";
        }else{
            $username = trim($_POST["username"]);
        }
        if(empty(trim($_POST["password"]))){
            $passwordErr = "Please insert the password.";
        }else{
            $password = trim($_POST["password"]);
        }
        if(empty($usernameErr) && empty($passwordErr)){
            $sql = "SELECT id, username, password FROM users WHERE username = ?";
            if($stmt = mysqli_prepare($conn, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $paramUsername);
                $paramUsername = $username;
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt) == 1){
                            mysqli_stmt_bind_result($stmt, $id, $username, $hashedPassword);
                            if(mysqli_stmt_fetch($stmt)){
                                if(password_verify($password, $hashedPassword)){
                                session_start();
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;
                                header("Location: ./");
                            }else{
                                $passwordErr = "The password you inserted is not valid.";
                            }
                        }
                    }
                    } else {
                    $usernameErr = "No account found with that username.";
                }
            }else{
                echo "Oops, something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
        mysqli_close($conn);
    }
?>
<!DOCTYPE HTML>
<html lang="en-US" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<title>Activate &mdash; SuperFox</title>
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="author" content="SuperFox" />
		<meta property="og:title" content="Activate" />
		<meta property="og:description" content="" />
		<meta property="og:type" content="website" />
		<meta property="og:image" content="http://cdn.discordapp.com/avatars/534387780076306432/6060f186dc07f1a16097653c45a88cb5.png?size=256" />
		<meta property="og:image:secure_url" content="https://cdn.discordapp.com/avatars/534387780076306432/6060f186dc07f1a16097653c45a88cb5.png?size=256" />
		<meta property="og:image:type" content="image/jpeg" />
		<meta property="og:image:width" content="512" />
		<meta property="og:image:height" content="512" />
		<meta property="og:site_name" content="SuperFox" />
		<meta property="og:url" content="https://superfox.cf" />
		<meta name="viewport" content="width=device-width, minimum-scale=1, initial-scale=1, maximum-scale=1" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
		<link rel="stylesheet" href="css/materialize.min.css" />
		<link rel="stylesheet" href="css/style.css" />
	</head>
	<body class="black lighten-2 white-text">
		<nav style="background:#1a1a1a" role="navigation">
			<div class="nav-wrapper container">
				<a id="logo-container" href="./" class="brand-logo">
					<img src="https://cdn.discordapp.com/avatars/534387780076306432/6060f186dc07f1a16097653c45a88cb5.png?size=256" alt="eo1_logo" />
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
					    <a href="#">Login</a>
					</li>
					<li>
					    <a href="register">Register</a>
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
					    <a href="#">Login</a>
					</li>
					<li>
					    <a href="register">Register</a>
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
					<h1 class="header center white-text text-lighten-1">Login</h1>
					<div class="row center">
						<h5 class="header col s12 light">If you already have an account login here.</h5>
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
					<h4>Login</h4>
					<p>Please compile the following form to login.</p>
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
					    <button type="submit" class="btn waves-effect waves-light red white-text lighten-1">Login</button>
					</form>
					<p><a href="resetpassword">Reset the password</a></p>
					<p>Don't have an account? <a href="login">Register</a>.</p>
				</div>
			</div>
		</div>
		<footer class="page-footer" style="background:#1a1a1a">
			<div class="container">
				<div class="row">
					<div class="col l6 s12">
						<h5 class="white-text">Thanks for visiting my website.</h5>
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
							    <a href="#" class="white-text">Login</a>
							</li>
							<li>
							    <a href="register" class="white-text">Register</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="footer-copyright">
				<div class="container">
					<p>&copy; 2019-<?php echo date("Y"); ?> SuperFox. Some rights reserved. Powered by <a href="https://materializecss.com" target="_blank">Materialize</a>.</p>
				</div>
			</div>
		</footer>
		<script src="js/jquery.min.js"></script>
		<script src="js/materialize.min.js"></script>
		<script src="js/custom.js"></script>
	</body>
</html>
