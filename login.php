<?php
	require_once './_common_files/header.php';
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
							if($row["status"]) {
								$_SESSION["user_login"] = $row["id"];
								$_SESSION["role"] = $row["role"];
								$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(24));
								$loginMsg = "লগইন সফল হয়েছে!";
								header("refresh:2; index.php");
							}
							else {
								// $otp = mt_rand(10000,99999);
								// $result = $pdo->prepare("UPDATE users SET otp=? WHERE id=?");
								// $result->bindParam(1, $otp, PDO::PARAM_INT);
								// $result->bindParam(2, $row['id'], PDO::PARAM_INT);
								// if($result->execute()) {
									$_SESSION["user_id"] = $row["id"];
									$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(24));
									$errorMsg[]="আপনার একাউন্ট একটিভেট করা হয় নি! অনুগ্রহ করে আপনার ইমেইলে প্রেরিত ওটিপি প্রদান করুন।";
									header("refresh:2; verify_otp.php");
								// }
								// else {
									// $errorMsg[]="ওটিপি প্রেরণ সম্ভব হচ্ছে না! উপজেলা সহকারী প্রোগ্রামারের সাথে যোগাযোগ করুন।";
								// }
							}
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

<center>
	<h2>ত্রাণ বিতরণ সিস্টেম(আরডিএস) এ স্বাগতম।</h2>
	<small>অনুগ্রহ করে নিম্নোক্ত ফর্মটি ব্যবহার করে লগইন করুন।</small>
</center>
<br>

<form method="post" class="form-horizontal" action="<?=htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<div class="form-group">
		<label class="col-sm-3 control-label">ইউজারনেম অথবা ইমেইল</label>
		<div class="col-sm-6">
			<input type="text" name="txt_username_email" class="form-control" placeholder="ইউজারনেম অথবা ইমেইল প্রদান করুন" required />
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label">পাসওয়ার্ড</label>
		<div class="col-sm-6">
			<input type="password" name="txt_password" class="form-control" placeholder="পাসওয়ার্ড প্রদান করুন" required />
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
<?php require_once './_common_files/footer.php';?>