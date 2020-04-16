<?php
	require_once './_common_files/header.php';
	function get_otp($user_id, $otp) {
		global $pdo;
        $result = $pdo->prepare("SELECT otp FROM users WHERE id = ?");
        $result->bindParam(1, $user_id, PDO::PARAM_INT);
        $result->execute();
		if($result->fetchColumn() === $otp)
			return True;
		else return False;
	}
	if(isset($_REQUEST['btn_reset'])) {
		$otp 				= clean_input($_REQUEST['otp']);
		$new_password	    = clean_input($_REQUEST['txt_password']);
		$confirm_password	= clean_input($_REQUEST['confirm_txt_password']);

		if(strlen($new_password) < 6) {
			$errorMsg[] = "নুন্যতম ৬ অক্ষরের পাসওয়ার্ড প্রদান করুন";	//check passowrd must be 6 characters
        }
        else if($new_password !== $confirm_password) {
            $errorMsg[] = "নতুন পাসওয়ার্ড ও পুনরায় প্রদানকৃত পাসওয়ার্ড এক নয়!";
		}
		else if(!get_otp($_SESSION['user_id'], $otp)) {
			$errorMsg[] = "প্রদত্ত ওয়ান টাইম পাসওয়ার্ড সঠিক নয়!";
		}
		else {
			try {
				if(!isset($errorMsg)) {
					$new_password = password_hash(md5($new_password), PASSWORD_DEFAULT);
					$otp = null;
					$result = $pdo->prepare("UPDATE users SET password=?, otp=? WHERE id=?");;
					$result->bindParam(1, $new_password, PDO::PARAM_STR);
					$result->bindParam(2, $otp, PDO::PARAM_INT);
					$result->bindParam(3, $_SESSION['user_id'], PDO::PARAM_INT);
					if($result->execute()) {
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

	if(isset($errorMsg)) {
		foreach($errorMsg as $error) {
		?>
			<div class="alert alert-danger">
				<strong><?php echo $error; ?></strong>
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

<center>
	<h2>ত্রাণ বিতরণ সিস্টেম(আরডিএস) এ স্বাগতম।</h2>
	<small>অনুগ্রহ করে নতুন পাসওয়ার্ড প্রদান করুন।</small>
</center>
<br>
<form method="post" class="form-horizontal">
	<div class="form-group">
		<label class="col-sm-3 control-label">ইমেইলে প্রাপ্ত পাসওয়ার্ড</label>
		<div class="col-sm-6">
			<input type="password" name="otp" class="form-control" placeholder="আপনার ইমেইলে প্রেরিত ওয়ান টাইম পাসওয়ার্ডটি দিন।" required/>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label">নতুন পাসওয়ার্ড</label>
		<div class="col-sm-6">
			<input type="password" name="txt_password" class="form-control" placeholder="৬ অক্ষরের একটি নতুন পাসওয়ার্ড দিন।" required/>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label">কনফার্ম পাসওয়ার্ড</label>
		<div class="col-sm-6">
			<input type="password" name="confirm_txt_password" class="form-control" placeholder="প্রদানকৃত পাসওয়ার্ডটি পুনরায় লিখুন।" required/>
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
<?php require_once './_common_files/footer.php';?>