<?php
    session_start();
	if(isset($_SESSION["user_login"])) {
		// ob_start();
		header("Location: ../index.php");
	}

	$uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
	$segment = str_replace(".php", "", $uriSegments[2]);

    require_once './config.php';

    function clean_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = strip_tags($data);
		$data = htmlspecialchars($data);
		return $data;
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
		<title>আরডিএস :: <?= ucfirst($segment)?></title>
		<link rel = "icon" href = "./images/logo.png" type = "image/x-icon" />
		<link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
		<style>
		    footer {
                position: fixed;
                height: 25px;
                left: 0;
                bottom: 0;
                width: 100%;
                background-color:#DFE6E9;
                font-weight: bold;
				padding-top: 5px;
            }
		</style>
	</head>

	<body>
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" rel="home" href="" title="উপজেলা প্রশাসন দশমিনা, পটুয়াখালী">
						<img style="max-width:35px; max-height:35px; margin-top: -7px;" src="./images/logo.png">
					</a>
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
					<a class="navbar-brand" href="">উপজেলা প্রশাসন, দশমিনা, পটুয়াখালী</a>
					<!-- <a class="navbar-brand" href="">আরডিএস, পটুয়াখালী-১১৩</a> -->
					<ul class="nav navbar-nav">
						<!-- <li class="<?=$segment === 'login' ? 'active': ''?>"><a href="./login.php"><span class="glyphicon glyphicon-log-in"></span> লগইন</a></li> -->
						<li class="<?=$segment === 'volunteer' ? 'active': ''?>"><a href="./volunteer.php"><span class="glyphicon glyphicon-send"></span> স্বেচ্ছাসেবক নিবন্ধন</a></li>
						<li class="<?=$segment === 'emg_relief' ? 'active': ''?>"><a href="./emg_relief.php"><span class="glyphicon glyphicon-grain"></span> জরুরী ত্রাণ সাহায্য</a></li>
						<li class="<?=$segment === 'helpline' ? 'active': ''?>"><a href="./helpline.php"><span class="glyphicon glyphicon-earphone"></span> হেল্পলাইন</a></li>
						<li><a href="http://dashmina.patuakhali.gov.bd/" target="_blank"><span class="glyphicon glyphicon-time"></span> উপজেলা ওয়েব পোর্টাল</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class="<?=$segment === 'register' ? 'active': ''?>"><a href="./register.php"><span class="glyphicon glyphicon-user"></span> রেজিস্টার</a></li>
						<li class="<?=$segment === 'login' ? 'active': ''?>"><a href="./login.php"><span class="glyphicon glyphicon-log-in"></span> লগইন</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="wrapper">
			<div class="container-fluid">
				<div class="col-lg-12">