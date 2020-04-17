<?php
	require_once './_common_files/header.php';
	if(isset($_REQUEST['btn_register']) && $_SERVER["REQUEST_METHOD"] == "POST") {
		$username	 = clean_input($_REQUEST['txt_username']);
		$email		 = clean_input($_REQUEST['txt_email']);
		$password	 = clean_input($_REQUEST['txt_password']);
		$name 		 = clean_input($_REQUEST['txt_name']);
		$phone 		 = clean_input($_REQUEST['txt_phone']);
		$designation = clean_input($_REQUEST['txt_designation']);

		if(empty($username)) {
			$errorMsg[]="অনুগ্রহ করে একটি ইউজারনেম প্রদান করুন।";
		}
		else if(strlen($username) < 4) {
			$errorMsg[] = "সর্বনিম্ন ৪ অক্ষরের একটি ইউজারনেম নির্বাচন করুন।";
		}
		else if(empty($email)) {
			$errorMsg[]="অনুগ্রহ করে একটি ইমেইল এড্রেস প্রদান করুন।";
		}
		else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errorMsg[]="ইমেইল এড্রেসটি সঠিক নয়।";
		}
		else if(empty($password)) {
			$errorMsg[]="অনুগ্রহ করে একটি পাসওয়ার্ড প্রদান করুন।";
		}
		else if(strlen($password) < 6) {
			$errorMsg[] = "পাসওয়ার্ড নুন্যতম ৬ অক্ষরের হতে হবে।";
		}
		else if(empty($phone)) {
			$errorMsg[]="";
		}
		else if(strlen($phone) < 11) {
			$errorMsg[] = "সর্বোচ্চ ১১ ডিজিটের ফোন/মোবাইল নং প্রদান করুন।";
		}
		else {
			try {
				$select_stmt=$pdo->prepare("SELECT username, email, phone FROM users WHERE username=:uname OR email=:uemail OR phone=:uphone");
				$select_stmt->execute(array(':uname'=>$username, ':uemail'=>$email, ':uphone'=>$phone)); //execute query
				$row = $select_stmt->fetch(PDO::FETCH_ASSOC);
				if($row) {
					if($row["username"] == $username)
						$errorMsg[]="দুঃখিত, ইউজারনেম ইতোমধ্যে গৃহিত হয়েছে!";	//check condition username already exists
					else if($row["email"] == $email)
						$errorMsg[]="দুঃখিত, ইমেইল ইতোমধ্যে গৃহিত হয়েছে!";	//check condition email already exists
					else if($row["phone"] == $phone)
						$errorMsg[]="দুঃখিত, ফোন/মোবাইল ইতোমধ্যে গৃহিত হয়েছে!";	//check condition phone already exists
				}
				else if(!isset($errorMsg)) {
					$new_password = password_hash(md5($password), PASSWORD_DEFAULT);
					$otp = mt_rand(10000,99999);
					$insert_stmt = $pdo->prepare("INSERT INTO users (name, designation, username, email, phone, password, otp) VALUES (:name, :designation, :uname, :uemail, :phone, :upassword, :otp)");
					if($insert_stmt->execute(
							array(
								':name' 		=> $name,
								':designation' 	=> $designation,
								':uname'		=> $username,
								':uemail'		=> $email,
								':phone'		=> $phone,
								':upassword'	=> $new_password,
								':otp'			=> $otp,
							)
						)
					) {
						$registerMsg="রেজিস্ট্রেশন সফল হয়েছে! অনুগ্রহ করে লগইন করুন।";
						ob_start();
						header("refresh:2; login.php");
					}
				}
				else {
					$errorMsg[]="দুঃখিত, অনিবার্য কারনে রেজিস্ট্রেশন সফল হয়নি! অনুগ্রহ করে আবার চেষ্টা করুন।";	//check condition email already exists
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
	<small>অনুগ্রহ করে নিম্নোক্ত ফর্মটি ব্যবহার করে রেজিস্ট্রেশন করুন।</small>
</center>
<br>
<form method="post" class="form-horizontal">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label class="col-sm-12">ইউজারনেম</label>
			<div class="col-sm-12">
				<input type="text" name="txt_username" class="form-control" placeholder="একটি ইউজারনেম নির্বাচন করুন" />
				<small>নুন্যতম ৪ অক্ষরের, স্পেসবিহীন একটি ইউজারনেম নির্বাচন করুন। উদাহরণঃ name1990 অথবা ap_doict ইত্যাদি।</small>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-12">নাম</label>
			<div class="col-sm-12">
				<input type="text" name="txt_name" class="form-control" placeholder="আপনার পূর্ণনাম লিখুন" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-12">পদবী</label>
			<div class="col-sm-12">
				<input type="text" name="txt_designation" class="form-control" placeholder="আপনার পদবী লিখুন" />
			</div>
		</div>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label class="col-sm-12">ইমেইল</label>
			<div class="col-sm-12">
				<input type="text" name="txt_email" class="form-control" placeholder="আপনার ইমেইল এড্রেস প্রদান করুন*" />
				<small>সঠিক ইমেইল এড্রেস প্রদান করুন। ইউজারনেম বা পাসওয়ার্ড রিসেট করতে আপনার ইমেইল প্রয়োজন হবে।</small>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-12">ফোন/মোবাইল</label>
			<div class="col-sm-12">
				<input type="text" name="txt_phone" class="form-control" placeholder="আপনার ফোন/মোবাইল নং প্রদান করুন*" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-12">পাসওয়ার্ড</label>
			<div class="col-sm-12">
				<input type="password" name="txt_password" class="form-control" placeholder="নুন্যতম ৬ অক্ষরের একটি পাসওয়ার্ড প্রদান করুন" />
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-6">
				<input type="submit"  name="btn_register" class="btn btn-primary " value="রেজিস্টার">
			</div>
			<div class="col-sm-6 control-label">
				আগে রেজিস্ট্রেশন করেছেন? <a href="login.php" class="btn btn-success btn-xs">লগইন করুন</a>
			</div>
		</div>
	</div>

</form>

<?php require_once './_common_files/footer.php';?>