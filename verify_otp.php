<?php
    require_once './_common_files/header.php';
    if(!isset($_SESSION["user_id"]))
        header("location: ./login.php");

	if(isset($_REQUEST['btn_verify']) && $_SERVER["REQUEST_METHOD"] == "POST") {
		$otp = clean_input($_REQUEST["txt_otp"]);

		if(empty($otp)) {
			$errorMsg[]="ওটিপি প্রদান করুন।";	//check "username/email" textbox not empty 
		}

		else {
			try {
				$result = $pdo->prepare("SELECT * FROM users WHERE id=?");;
				$result->bindParam(1, $_SESSION["user_id"], PDO::PARAM_INT);
				$result->execute();
				$row = $result->fetch(PDO::FETCH_ASSOC);

				if($result->rowCount() > 0) {
					// echo $otp.'<br>'.$row['otp'];
                    if($otp === $row['otp']) {
                        $status = 1;
                        $otp = null;
                        $result = $pdo->prepare("UPDATE users SET status=?, otp=? WHERE id=?");;
                        $result->bindParam(1, $status, PDO::PARAM_STR);
                        $result->bindParam(2, $otp, PDO::PARAM_INT);
                        $result->bindParam(3, $_SESSION['user_id'], PDO::PARAM_INT);
                        if($result->execute()) {
                            $_SESSION["user_login"] = $_SESSION["user_id"];
							$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(24));
							$_SESSION["role"] = 0; // user role initially.
                            $loginMsg = "ওটিপি ভেরিফেকেশন সফল হয়েছে!";
                            header("refresh:2; index.php");
                        }
                    }
                    else {
                        $errorMsg[]="প্রদত্ত ওটিপি সঠিক নয়!";
                    }
				}
				else {
					$errorMsg[]="অনিবার্য কারনে ওটিপি ভেরিফিকেশন সফল হয়নি, পুনরায় চেষ্টা করুন!";
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
		<label class="col-sm-3 control-label">ওয়ান টাইম পাসওয়ার্ড(ওটিপি) প্রদান করুন</label>
		<div class="col-sm-6">
			<input type="text" name="txt_otp" class="form-control" placeholder="আপনার ইমেইলে প্রেরিত ওটিপি প্রদান করুন*" required />
            <small>আপনার ইমেইল এড্রেস ভুলে গেলে বা প্রবেশ করতে না পারলে ওটিপির জন্য সহকারী প্রোগ্রামারের সাথে যোগাযোগ করুন।</small>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-9 m-t-15">
			<input type="submit" name="btn_verify" class="btn btn-success" value="ভেরিফাই">
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-9 m-t-15">
			<a href="forgot_password.php"><p class="text-info">পাসওয়ার্ড ভুলে গেছেন?</p></a>
		</div>
	</div>
</form>
<?php require_once './_common_files/footer.php';?>