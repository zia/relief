<?php
	require_once "config.php";
	session_start();
	if(isset($_SESSION["user_login"])) {
		header("location: index.php");
	}

	if(isset($_REQUEST['btn_register'])) {
		$username	= strip_tags($_REQUEST['txt_username']);	//textbox name "txt_email"
		$email		= strip_tags($_REQUEST['txt_email']);		//textbox name "txt_email"
		$password	= strip_tags($_REQUEST['txt_password']);	//textbox name "txt_password"

		if(empty($username)) {
			$errorMsg[]="Please enter username";	//check username textbox not empty 
		}
		else if(empty($email)) {
			$errorMsg[]="Please enter email";	//check email textbox not empty 
		}
		else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errorMsg[]="Please enter a valid email address";	//check proper email format 
		}
		else if(empty($password)) {
			$errorMsg[]="Please enter password";	//check passowrd textbox not empty
		}
		else if(strlen($password) < 6) {
			$errorMsg[] = "Password must be atleast 6 characters";	//check passowrd must be 6 characters
		}
		else {
			try {
				$select_stmt=$pdo->prepare("SELECT username, email FROM user 
											WHERE username=:uname OR email=:uemail"); // sql select query
				$select_stmt->execute(array(':uname'=>$username, ':uemail'=>$email)); //execute query
				$row=$select_stmt->fetch(PDO::FETCH_ASSOC);
				if($row["username"]==$username) {
					$errorMsg[]="Sorry username already exists!";	//check condition username already exists
				}
				else if($row["email"]==$email) {
					$errorMsg[]="Sorry email already exists!";	//check condition email already exists
				}
				else if(!isset($errorMsg)) {
					$new_password = password_hash($password, PASSWORD_DEFAULT);
					$insert_stmt=$pdo->prepare("INSERT INTO user (username,email,password) VALUES (:uname,:uemail,:upassword)"); 		//sql insert query
					if($insert_stmt->execute(array(':uname'	=>$username, ':uemail'	=>$email, ':upassword'=>$new_password))) {
						$registerMsg="Registration Successfull..... Please Login";
					}
				}
			}
			catch(PDOException $e) {
				echo $e->getMessage();
			}
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
		<title>রেজিস্ট্রেশন পেজ</title>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="js/jquery-1.12.4-jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
	</head>

	<body>
		<nav class="navbar navbar-default navbar-static-top">
			<div class="container">
				<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="">*</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">উপজেলা প্রশাসন, দশমিনা, পটুয়াখালী</a></li>
				</ul>
				</div><!--/.nav-collapse -->
			</div>
		</nav>
		<div class="wrapper">
		<div class="container">
			<div class="col-lg-12">
			<?php
				if(isset($errorMsg)) {
					foreach($errorMsg as $error) {
					?>
						<div class="alert alert-danger">
							<strong>WRONG ! <?php echo $error; ?></strong>
						</div>
					<?php
					}
				}
				if(isset($registerMsg)) {
				?>
					<div class="alert alert-success">
						<strong><?php echo $registerMsg; ?></strong>
					</div>
				<?php
				}
			?>

			<center><h2>রেজিস্ট্রেশন পেজ</h2></center>
			<form method="post" class="form-horizontal">
				<div class="form-group">
					<label class="col-sm-3 control-label">ইউজারনেম</label>
					<div class="col-sm-6">
						<input type="text" name="txt_username" class="form-control" placeholder="enter username" />
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">ইমেইল</label>
					<div class="col-sm-6">
						<input type="text" name="txt_email" class="form-control" placeholder="enter email" />
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">পাসওয়ার্ড</label>
					<div class="col-sm-6">
						<input type="password" name="txt_password" class="form-control" placeholder="enter passowrd" />
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-9 m-t-15">
						<input type="submit"  name="btn_register" class="btn btn-primary " value="রেজিস্টার">
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-9 m-t-15">
						আগে রেজিস্ট্রেশন করেছেন? <a href="login.php"><p class="text-info">লগইন করুন</p></a>
					</div>
				</div>

			</form>
		</div>
		</div>
		</div>
	</body>
</html>