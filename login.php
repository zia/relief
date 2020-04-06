<?php
	require_once 'config.php';
	session_start();
	if(isset($_SESSION["user_login"])) {
		header("location: index.php");
	}

	if(isset($_REQUEST['btn_login'])) {
		$username	=strip_tags($_REQUEST["txt_username_email"]);	//textbox name "txt_username_email"
		$email		=strip_tags($_REQUEST["txt_username_email"]);	//textbox name "txt_username_email"
		$password	=strip_tags($_REQUEST["txt_password"]);			//textbox name "txt_password"

		if(empty($username)) {
			$errorMsg[]="একটি ইউজারনেম লিখুন।";	//check "username/email" textbox not empty 
		}
		else if(empty($email)) {
			$errorMsg[]="ইমেইল এড্রেস লিখুন।";	//check "username/email" textbox not empty 
		}
		else if(empty($password)) {
			$errorMsg[]="নুন্যতম ৬ অক্ষরের পাসওয়ার্ড লিখুন।";	//check "passowrd" textbox not empty 
		}
		else {
			try {
				$select_stmt=$pdo->prepare("SELECT * FROM user WHERE username=:uname OR email=:uemail"); //sql select query
				$select_stmt->execute(array(':uname'=>$username, ':uemail'=>$email));	//execute query with bind parameter
				$row=$select_stmt->fetch(PDO::FETCH_ASSOC);

				if($select_stmt->rowCount() > 0) {
					if($username==$row["username"] OR $email==$row["email"]) {
						if(password_verify($password, $row["password"])) {
							$_SESSION["user_login"] = $row["id"];
							$loginMsg = "লগইন সফল হয়েছে!";
							header("refresh:2; index.php");
						}
						else {
							$errorMsg[]="পাসওয়ার্ড ভুল!";
						}
					}
					else {
						$errorMsg[]="ভুল ইউজারনেম অথবা ইমেইল!";
					}
				}
				else {
					$errorMsg[]="ভুল ইউজারনেম অথবা ইমেইল!";
				}
			}
			catch(PDOException $e) {
				$e->getMessage();
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
		<title>লগইন পেজ</title>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="js/jquery-1.12.4-jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
	</head>

	<body>
		<div class="wrapper">
			<div class="container">
				<div class="col-lg-12">
					<?php
						if(isset($errorMsg)) {
							foreach($errorMsg as $error) {
							?>
								<div class="alert alert-danger">
									<strong><?php echo $error; ?></strong>
								</div>
							<?php
							}
						}

						if(isset($loginMsg)) {
						?>
						<div class="alert alert-success">
							<strong><?php echo $loginMsg; ?></strong>
						</div>
						<?php
						}
						?>
					<center><h2>লগইন পেজ</h2></center>
					<form method="post" class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-3 control-label">ইউজারনেম অথবা ইমেইল</label>
							<div class="col-sm-6">
								<input type="text" name="txt_username_email" class="form-control" placeholder="enter username or email" />
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
								<input type="submit" name="btn_login" class="btn btn-success" value="লগইন">
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-9 m-t-15">
								<a href="register.php"><p class="text-info">রেজিস্ট্রেশন করুন</p></a>		
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>