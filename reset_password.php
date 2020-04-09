<?php
	require_once "config.php";
    session_start();
	if(isset($_SESSION["user_login"])) {
		header("location: index.php");
	}

	if(isset($_REQUEST['btn_reset'])) {
		$new_password	    = strip_tags($_REQUEST['txt_password']);	//textbox name "txt_email"
        $confirm_password	= strip_tags($_REQUEST['confirm_txt_password']);	//textbox name "txt_email"

		if(strlen($new_password) < 6) {
			$errorMsg[] = "নুন্যতম ৬ অক্ষরের পাসওয়ার্ড প্রদান করুন";	//check passowrd must be 6 characters
        }
        else if($new_password !== $confirm_password) {
            $errorMsg[] = "নতুন পাসওয়ার্ড ও পুনরায় প্রদানকৃত পাসওয়ার্ড এক নয়!";
        }
		else {
			try {
				if(!isset($errorMsg)) {
                    $new_password = password_hash($new_password, PASSWORD_DEFAULT);
					$update_stmt = $pdo->prepare("UPDATE users SET password=:upassword WHERE id=:uid"); 	//sql insert query
					if($update_stmt->execute(array(':upassword' => $new_password, ':uid' => $_SESSION['user_id']))) {
                        $registerMsg="পাসওয়ার্ড রিসেট সফল হয়েছে, অনুগ্রহ করে লগইন করুন।";
                        header("refresh:2; login.php");
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
		<title>পাসওয়ার্ড রিসেট পেজ</title>
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
							<strong>সঠিক নয়! <?php echo $error; ?></strong>
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

			<center><h2>পাসওয়ার্ড রিসেট পেজ</h2></center>
			<form method="post" class="form-horizontal">
				<div class="form-group">
					<label class="col-sm-3 control-label">নতুন পাসওয়ার্ড</label>
					<div class="col-sm-6">
						<input type="password" name="txt_password" class="form-control" placeholder="৬ অক্ষরের একটি নতুন পাসওয়ার্ড দিন" />
					</div>
				</div>

                <div class="form-group">
					<label class="col-sm-3 control-label">কনফার্ম পাসওয়ার্ড</label>
					<div class="col-sm-6">
						<input type="password" name="confirm_txt_password" class="form-control" placeholder="প্রদানকৃত পাসওয়ার্ডটি পুনরায় লিখুন" />
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-9 m-t-15">
						<input type="submit"  name="btn_reset" class="btn btn-primary " value="সাবমিট">
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