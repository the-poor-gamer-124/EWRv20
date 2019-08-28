<?php
require_once __DIR__ . "/inc/dbconfig.php";
if (isset($_GET['email'], $_GET['code'])) {
	if ($stmt = mysqli_prepare($conn, 'SELECT * FROM users WHERE email = ? AND activation_code = ?')) {
		mysqli_stmt_bind_param($stmt, 'ss', $_GET['email'], $_GET['code']);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);
		if (mysqli_stmt_num_rows($stmt) > 0) {
			if ($stmt = mysqli_prepare($conn, 'UPDATE users SET activation_code = ? WHERE email = ? AND activation_code = ?')) {
				$newcode = 'activated';
				mysqli_stmt_bind_param($stmt, 'sss', $newcode, $_GET['email'], $_GET['code']);
		        mysqli_stmt_execute($stmt);
				echo '
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
					    <a href="login">Login</a>
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
					    <a href="login">Login</a>
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
					<h1 class="header center white-text text-lighten-1">Activate</h1>
					<div class="row center">
						<h5 class="header col s12 light">Here you can check whether the account is activated.</h5>
					</div>
				</div>
			</div>
			<div class="parallax">
				<img src="img/parallax.png" alt="parallax" style="transform: translate3d(-50%, 500.908px, 0px); opacity: 1;" />
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col l4 s14">
					<h4>Activate Status</h4>
				</div>
				<div class="col l8 s14">
					<p>Your account is now activated; you can now login!</p>
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
							    <a href="register" class="white-text">Register</a>
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
	</body>
</html>
				';
			}
		} else {
			echo '
<!DOCTYPE HTML>
<html lang="en-US" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<title>Activate &mdash; Ergastolator Website Redesign v20</title>
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="author" content="ErgastolatorOfficial 1" />
		<meta property="og:title" content="Activate" />
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
					    <a href="login">Login</a>
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
					<h1 class="header center white-text text-lighten-1">Activate</h1>
					<div class="row center">
						<h5 class="header col s12 light">Here you can check whether the account is activated.</h5>
					</div>
				</div>
			</div>
			<div class="parallax">
				<img src="img/parallax.png" alt="parallax" style="transform: translate3d(-50%, 500.908px, 0px); opacity: 1;" />
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col l4 s14">
					<h4>Activate Status</h4>
				</div>
				<div class="col l8 s14">
					<p>You don&#39;have an account with us, or the account was already activated!</p>
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
							    <a href="register" class="white-text">Register</a>
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
	</body>
</html>
			';
		}
	}
}
?>
