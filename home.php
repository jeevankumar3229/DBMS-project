<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Organ donation</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		* {
			padding: 0;
			margin: 0;
		}

		.wrapper {
			background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url(images/donar2.jpg);
			background-size: cover;
			height: 100vh;
		}

		.navbar {
			position: fixed;
			height: 80px;
			width: 100%;
			top: 0;
			left: 0;
			background: rgba(158, 200, 228, 0.568);
		}

		.navbar .logo {
			width: 275px;
			height: auto;
			padding: 15px 30px;
			height: 160px;
			/* border-radius: 20%; */
		}
		.cr6 .logo6{
			width: 150px;
			height: auto;
			padding: 20px 75px;
			height: 160px;
			margin-top: 200px;
		}
		.cr1 .logo1{
			width: 150px;
			height: auto;
			padding: 20px 75px;
			height: 160px;
			margin-top: 35px;
		}
		.cr2 .logo2{
			width: 150px;
			height: auto;
			padding: 20px 75px;
			height: 160px;
			float: right;
			margin-top: -100px;
			/* margin-left: 1234px; */
		}
		.cr3 .logo3{
			width: 150px;
			height: auto;
			padding: 20px 75px;
			height: 160px;
			float: right;
			margin-top: -400px;
			margin-left: 1232px;
			/* position: absolute; */
			/* margin-bottom: 50%; */
		}
		.cr4 .logo4{
			width: 150px;
			height: auto;
			padding: 20px 75px;
			height: 160px;
			float: right;
			margin-top: -600px;
		}
		.cr5 .logo5{
			width: 150px;
			height: auto;
			padding: 20px 75px;
			height: 160px;
			/* float: right; */
			margin-top: -300px;
		}
		
		.navbar ul {
			float: right;
			margin-right: 20px;

		}

		.navbar ul li {
			list-style: none;
			margin: 0 8px;
			display: inline-block;
			line-height: 80px;
		}

		.navbar ul li a {
			font-size: 20px;
			font-family: 'Roboto', sans-serif;
			color: white;
			padding: 6px 13px;
			text-decoration: none;
			transition: .4s;
		}

		.navbar ul li a.active,
		.navbar ul li a:hover {
			background: rgb(100, 201, 248);
			border-radius: 2px;
		}

		.wrapper .center {
			position: absolute;
			left: 50%;
			top: 55%;
			transform: translate(-50%, -50%);
			font-family: sans-serif;
			user-select: none;
		}

		.center h1 {
			color: white;
			font-size: 70px;
			width: 900px;
			font-weight: bold;
			text-align: center;
		}

		.center h2 {
			color: white;
			font-size: 70px;
			font-weight: bold;
			margin-top: 10px;
			width: 885px;
			text-align: center;
		}

		.center h3 {
			color: white;
			font-size: 50px;
			font-weight: bold;
			margin-top: 10px;
			width: 885px;
			text-align: center;
		}

		.center .buttons {
			margin: 35px 280px;
		}

		.buttons .btn2 {
			margin-left: 25px;
		}

		.buttons button:hover {
			background: #cc0000;
		}

		body {
			background: url('images/bg1.jpg');
			background-size: cover;
		}

		.navbar .fa {
			margin-right: 7px;
		}

		.sub-menu {
			display: none;
		}

		.navbar ul li:hover .sub-menu {
			display: block;
			position: absolute;
			background: rgba(158, 200, 228, 0.568);
			margin-top: -1px;
			margin-left: 0px;
			margin-right: 11px;
		}

		.navbar ul li:hover .sub-menu ul {
			display: block;
			margin: 10px;
		}

		.navbar ul li:hover .sub-menu ul li {
			/* width: 150px; */
			/* padding: 10px; */
			border-bottom: 1px dotted #fff;
			background: transparent;
			border-radius: 0;

		}

		.navbar ul li:hover .sub-menu ul li:last-child {
			border-bottom: none;
		}
	</style>
</head>

<body>
	<div class="wrapper">
		<nav class="navbar">
			<img class="logo" src="images/LOGO22.png">

			<ul>
				<li><a class="active" href="#"><i class="fa fa-home" aria-hidden="true"></i><b>Home</b></a></li>
				<li><a href="about.php"><i class="fa fa-users" aria-hidden="true"></i><b>About</b></a></li>
				<li><a href="contact.php"><i class="fa fa-phone" aria-hidden="true"></i><b>Contact</b></a></li>
				<li><a href="#"><i class="fa fa-sign-in"></i><b>Login</b></a>
					<div class="sub-menu">
						<ul>
							<li><a href="login1.php"><b>Doctor</b></a></li>
							<li><a href="login.php"><b>Donor</b></a></li>
						</ul>
					</div>
				</li>
		</nav>
		<div class="center">


			<h1>Welcome to LIFE DONOR</h1>
			<h3>"Save Lives by Donating."</h3>
			<h3>"Come ahead and take part in saving lives."</h3>
		</div>
		<div class="cr6">
		<img class="logo6" src="images/eyes1.jpg">
		</div>
		<div class="cr1">
			<img class="logo1" src="images/heart2.jpg">
		</div>
		 <div class="cr2">
			<img class="logo2" src="images/lungs1.jpg">
		</div>
		<div class="cr3">
			<img class="logo3" src="images/kidney2.jpg">
		</div>
		 <div class="cr4">
			<img class="logo4" src="images/liver2.jpg">
		</div>
		 <!-- <div class="cr5">
			<img class="logo5" src="images/dbmslogo.jpg">
		</div> -->
	</div>
</body>

</html>