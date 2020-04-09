<?php
	require_once 'config.php';
	session_start();
	if(isset($_SESSION["user_login"])) {
		header("location: index.php");
	}

	if(isset($_REQUEST['btn_reset'])) {
		$username	=strip_tags($_REQUEST["txt_username_email"]);	//textbox name "txt_username_email"
		$email		=strip_tags($_REQUEST["txt_username_email"]);	//textbox name "txt_username_email"

		if(empty($username)) {
			$errorMsg[]="একটি ইউজারনেম লিখুন।";	//check "username/email" textbox not empty 
		}
		else if(empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errorMsg[]="সঠিক ইমেইল এড্রেস লিখুন।";	//check "username/email" textbox not empty 
		}
		else {
			try {
				$select_stmt=$pdo->prepare("SELECT * FROM users WHERE username=:uname OR email=:uemail"); //sql select query
				$select_stmt->execute(array(':uname'=>$username, ':uemail'=>$email));	//execute query with bind parameter
				$row=$select_stmt->fetch(PDO::FETCH_ASSOC);

				if($select_stmt->rowCount() > 0) {
					if($username==$row["username"] OR $email==$row["email"]) {
                        $_SESSION["user_id"] = $row["id"];
                        $loginMsg = "নতুন পাসওয়ার্ড দিন!";
                        header("refresh:2; reset_password.php");
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
		<title>পাসওয়ার্ড রিকভারি পেজ</title>
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
					<center><h2>পাসওয়ার্ড রিকভারি পেজ</h2></center>
					<form method="post" class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-3 control-label">ইউজারনেম অথবা ইমেইল</label>
							<div class="col-sm-6">
								<input type="text" name="txt_username_email" class="form-control" placeholder="ইউজারনেম অথবা ইমেইল প্রদান করুন" />
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-9 m-t-15">
								<input type="submit" name="btn_reset" class="btn btn-success" value="সাবমিট">
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-9 m-t-15">
								<a href="login.php"><p class="text-info">লগইন করুন</p></a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>