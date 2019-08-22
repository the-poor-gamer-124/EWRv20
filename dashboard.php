<?php
    session_start();
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("Location: login");
        exit;
    }
?>
<!DOCTYPE HTML>
<html lang="en-US" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<title>Dashboard &mdash; Ergastolator Website Redesign v20</title>
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="author" content="ErgastolatorOfficial 1" />
		<meta property="og:title" content="Dashboard" />
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
						<a href="./">Return back to home</a>
					</li>
					<li>
					    <a href="logout">Logout</a>
					</li>
					<li>
					    <a href="#">Other functionalities coming soon!</a>
					</li>
				</ul>
				<ul id="nav-mobile" class="sidenav">
					<li>
						<a href="./">Return back to home</a>
					</li>
					<li>
					    <a href="logout">Logout</a>
					</li>
					<li>
					    <a href="#">Other functionalities coming soon!</a>
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
					<h1 class="header center white-text text-lighten-1">Dashboard</h1>
					<div class="row center">
						<h5 class="header col s12 light">It's still in construction, so some functionalities may come after some days!</h5>
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
					<h4>Welcome</h4>
					<p>Howdy, <?php echo htmlspecialchars($_SESSION["username"]); ?>! Here are some useful links that may help you while the dashboard is still in construction:</p>
				</div>
				<div class="col l4 s6 ergdesign">
					<p><a href="./">Return to the home screen</a> | <a href="logout">Logout</a></p>
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
						        <a href="./" class="white-text">Return back to home</a>
					        </li>
					        <li>
					            <a href="logout" class="white-text">Logout</a>
					        </li>
				        	<li>
					            <a href="#" class="white-text">Other functionalities coming soon!</a>
					        </li>
					   	</ul>
					</div>
				</div>
			</div>
			<div class="footer-copyright">
				<div class="container">
					<p>&copy; 2019-<?php echo date("Y"); ?> ErgastolatorOfficial1. All rights reserved. Powered by <a href="https://materializecss.com" target="_blank">Materialize</a>. Dashboard version: 0.1 Rev.1</p>
				</div>
			</div>
		</footer>
		<script src="js/jquery.min.js"></script>
		<script src="js/materialize.min.js"></script>
		<script src="js/custom.js"></script>
	</body>
</html>