<?php
	require_once './_common_files/header.php';
	if(isset($_REQUEST['btn_reset'])) {
		$email		= clean_input($_REQUEST["txt_username_email"]);	//textbox name "txt_username_email"

		if(empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errorMsg[]="সঠিক ইমেইল এড্রেস লিখুন।";	//check "email" textbox not empty
		}
		else {
			try {
				$result = $pdo->prepare("SELECT * FROM users WHERE email=?");;
				$result->bindParam(1, $email, PDO::PARAM_STR);
				$result->execute();
				$row = $result->fetch(PDO::FETCH_ASSOC);

				if($result->rowCount() > 0) {
					if($email==$row["email"]) {
						$_SESSION["user_id"] = $row["id"];
						$otp =  mt_rand(10000,99999);
						$result = $pdo->prepare("UPDATE users SET otp=? WHERE id=?");;
						$result->bindParam(1,$otp, PDO::PARAM_STR);
						$result->bindParam(2, $_SESSION['user_id'], PDO::PARAM_INT);
						if ($result->execute()) {
							$loginMsg = "নতুন পাসওয়ার্ড দিন!";
							// ob_start();
							header("Refresh:2; reset_password.php");
						}
						else {
							$errorMsg[]="ওটিপি সংরক্ষণ সম্ভব হচ্ছে না! অনুগ্রহ করে আবার চেষ্টা করুন।";
						}
					}
					else {
						$errorMsg[]="আপনার প্রদত্ত ইমেইল পাওয়া যায়নি!";
					}
				}
				else {
					$errorMsg[]="আপনার প্রদত্ত ইমেইল এড্রেসটি পাওয়া যায়নি!";
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
	<small>অনুগ্রহ করে আপনার ইমেইল এড্রেস প্রদান করুন।</small>
</center>
<br>
<form method="post" class="form-horizontal">
	<div class="form-group">
		<label class="col-sm-3 control-label">আপনার ইমেইল এড্রেস প্রদান করুন</label>
		<div class="col-sm-6">
			<input type="email" name="txt_username_email" class="form-control" placeholder="এখানে ইমেইল এড্রেস লিখুন..." required/>
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
<sub class='pull-right' style='text-align: bottom;'><strong><sup><span class="glyphicon glyphicon-asterisk"></span></sup>আপনার ইমেইল এড্রেস ভুলে গেলে উপজেলা <a href="http://dashmina.patuakhali.gov.bd/site/officer_list/2533d872-33d1-4f68-b38c-83ec201ace02/" target="_blank" class="btn btn-primary btn-xs" role="button">সহকারী প্রোগ্রামারের</a> সাথে যোগাযোগ করুন।</strong></sub>
<?php require_once './_common_files/footer.php';?>