<?php
	function clean_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = strip_tags($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	require_once 'config.php';
	session_start();
	if(isset($_SESSION["user_login"])) {
		header("location: index.php");
	}

	if(isset($_REQUEST['btn_login']) && $_SERVER["REQUEST_METHOD"] == "POST") {
		$email		= clean_input($_REQUEST["txt_username_email"]);	//textbox name "txt_username_email"
		$username	= clean_input($_REQUEST["txt_username_email"]);	//textbox name "txt_username_email"
		$password	= clean_input($_REQUEST["txt_password"]);		//textbox name "txt_password"

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
				$result = $pdo->prepare("SELECT * FROM users WHERE username=? OR email=?");;
				$result->bindParam(1, $username, PDO::PARAM_STR);
				$result->bindParam(2, $email, PDO::PARAM_STR);
				$result->execute();
				$row = $result->fetch(PDO::FETCH_ASSOC);

				if($result->rowCount() > 0) {
					if($username === $row["username"] OR $email === $row["email"]) {
						// more hashes could be added
						if(password_verify(md5($password), $row["password"])) {
							$_SESSION["user_login"] = $row["id"];
							$loginMsg = "লগইন সফল হয়েছে!";
							header("refresh:2; index.php");
						}
						else {
							$errorMsg[]="ইউজারনেম অথবা পাসওয়ার্ড ভুল!";
						}
					}
					else {
						$errorMsg[]="ভুল ইউজারনেম অথবা পাসওয়ার্ড!";
					}
				}
				else {
					$errorMsg[]="ভুল ইউজারনেম অথবা পাসওয়ার্ড!";
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
					<form method="post" class="form-horizontal" action="<?=htmlspecialchars($_SERVER["PHP_SELF"]);?>">
						<div class="form-group">
							<label class="col-sm-3 control-label">ইউজারনেম অথবা ইমেইল</label>
							<div class="col-sm-6">
								<input type="text" name="txt_username_email" class="form-control" placeholder="ইউজারনেম অথবা ইমেইল প্রদান করুন" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">পাসওয়ার্ড</label>
							<div class="col-sm-6">
								<input type="password" name="txt_password" class="form-control" placeholder="পাসওয়ার্ড প্রদান করুন" />
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-9 m-t-15">
								<input type="submit" name="btn_login" class="btn btn-success" value="লগইন">
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-9 m-t-15">
								<a href="forgot_password.php"><p class="text-info">পাসওয়ার্ড ভুলে গেছেন?</p></a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>