<?php
	require_once './_common_files/header.php';
	if(isset($_REQUEST['btn_apply']) && $_SERVER["REQUEST_METHOD"] == "POST") {
		$name			= clean_input($_REQUEST["fullName"]);
		$nid			= clean_input($_REQUEST["nid"]);
		$mobile			= clean_input($_REQUEST["mobile"]);
		$union			= isset($_REQUEST["sel_union"]) ? clean_input($_REQUEST["sel_union"]) : '';
		$ward			= isset($_REQUEST["sel_ward"]) ? clean_input($_REQUEST["sel_ward"]) : '';
		$address		= clean_input($_REQUEST["txt_address"]);
		$relief_type	= isset($_REQUEST["relief_type"]) ? clean_input($_REQUEST["relief_type"]) : 6; // emergency relief id 6; can be pulled from db; harcoded for now
		$age			= clean_input($_REQUEST["age"]);
		$gender			= clean_input($_REQUEST["sel_gender"]);

		if(empty($name)) {
			$errorMsg[]="ত্রাণগ্রহীতার নাম লিখুন।";	//check "username/email" textbox not empty
		}
		else if(empty($mobile)) {
			$errorMsg[]="ত্রাণগ্রহীতার মোবাইল নম্বর দিন, জানা না থাকলে আপনার মোবাইল নম্বর প্রদান করুন।";
		}

		else if(empty($address)) {
			$errorMsg[]="ত্রাণগ্রহীতার ঠিকানা প্রদান করুন, সম্ভব না হলে আপনার ঠিকানা প্রদান করুন।";
		}

		else if(empty($gender)) {
			$errorMsg[]="ত্রাণগ্রহীতার জেন্ডার নির্বাচন করুন।";
		}

		else {
			try {
				if(!isset($errorMsg)) {
					$sql = "INSERT INTO emg_reliefs(name, nid, mobile, unionp, ward, address, relief_type, age, gender) VALUES (:uname, :nid, :mobile, :unionp, :ward, :address, :relief_type, :age, :gender)";
					$stmt = $pdo->prepare($sql);
					$stmt->bindParam(':uname', $name, PDO::PARAM_STR);
					$stmt->bindParam(':nid', $nid, PDO::PARAM_STR);
					$stmt->bindParam(':mobile', $mobile, PDO::PARAM_STR);
					$stmt->bindParam(':unionp', $union, PDO::PARAM_INT);
					$stmt->bindParam(':ward', $ward, PDO::PARAM_INT);
					$stmt->bindParam(':address', $address, PDO::PARAM_STR);
					$stmt->bindParam(':relief_type', $relief_type, PDO::PARAM_INT);
					$stmt->bindParam(':age', $age, PDO::PARAM_INT);
					$stmt->bindParam(':gender', $gender, PDO::PARAM_INT);

					if ($stmt->execute()) {
						$regMsg="আবেদন গৃহীত হয়েছে! উপজেলা প্রশাসন হতে অতিসত্বর আপনার সাথে যোগাযোগ করা হবে। ধন্যবাদ!";
						ob_start();
					 	header("refresh:2; login.php");
					}
					else {
						$errorMsg[]="অনিবার্য কারনবশত আবেদনটি গ্রহণ করা সম্ভব হচ্ছে না। অনুগ্রহ করে পুনরায় চেষ্টা করুন।";
					}
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

	if(isset($regMsg)) {
	?>
		<div class="alert alert-success">
			<strong><?php echo $regMsg; ?></strong>
		</div>
	<?php
		}
	?>

<center>
	<h2>ত্রাণ বিতরণ সিস্টেমে (আরডিএস) স্বাগতম।</h2>
	<small>আপনার অথবা আপনার পরিচিত কারও জরুরী ত্রাণ সাহায্যের প্রয়োজন হলে নিম্নোক্ত ফর্মটি ব্যবহার করুন।</small>
</center>
<br>

<form method="POST" action="<?=htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<div class="row" style="margin-bottom: 15px;">
		<div class="col-md-6">
			<input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">

			<div class="form-group">
				<label for="fullName">ত্রাণ গ্রহীতার নাম লিখুন</label>
				<input type="text" name="fullName" class="form-control" id="fullName" placeholder="পূর্ণনাম লিখুন।" onkeyup="saveValue(this);" onClick="this.select();" required>
			</div>

			<div class="form-group">
				<label for="NID">এনআইডি/ভিজিডি/ভিজিএফ/পরিচয়পত্র</label>
				<input type="text" name="nid" class="form-control" id="nid" aria-describedby="nideHelp" placeholder="ন্যাশনাল আইডি/ভিজিডি/ভিজিএফ/অন্য যে কোন পরিচয়পত্র নং দিন।" onkeyup="saveValue(this);" onClick="this.select();">
				<small id="nidHelp" class="form-text text-muted">জানা না থাকলে, খালি রাখুন</small>
			</div>

			<div class="form-group">
				<label for="mobile">মোবাইল</label>
				<input type="text" name="mobile" class="form-control" id="mobile" aria-describedby="mobileHelp" placeholder="মোবাইল নম্বর লিখুন।" onkeyup="saveValue(this);" onClick="this.select();" required>
				<small id="mobileHelp" class="form-text text-muted">১১ ডিজিটের মোবাইল নং লিখুন। (ত্রাণ গ্রহীতার মোবাইল না থাকলে; আপনার মোবাইল নং দিন)</small>
			</div>

			<div class="form-group">
				<label for="typeInputEmail1">ইউনিয়ন</label>
				<select name="unionp" class="form-control" id="sel_depart" aria-describedby="unionHelp" onchange="saveValue(this);">
					<option value="">--ইউনিয়ন পরিষদ--</option>
					<?php
						require_once('config.php');
						$sql = "SELECT id, name FROM unions";
						$q = $pdo->query($sql);
						$q->setFetchMode(PDO::FETCH_ASSOC);
						while($row = $q->fetch() ) {
							echo "<option value='".$row['id']."' >".$row['name']."</option>";
						}
					?>
				</select>
				<small id="unionHelp" class="form-text text-muted">জানা না থাকলে, খালি রাখুন।</small>
			</div>

			<div class="form-group">
				<div class="peasthere"></div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label for="address">ঠিকানা</label>
				<textarea class="form-control" name="txt_address" rows="5" placeholder="ত্রাণগ্রহীতার বিস্তারিত ঠিকানা লিখুন" required ></textarea>
			</div>

			<div class="form-group">
				<label for="typeRelief">ত্রাণের ধরন</label>
				<select name="serviceType" class="form-control" id="sel_relief"  aria-describedby="reliefHelp" onchange="saveValue(this);">
					<option value="">--ত্রাণের ধরণ--</option>
					<?php
						$sql = "SELECT id, name FROM relief_types ORDER BY id ASC";
						$q = $pdo->query($sql);
						$q->setFetchMode(PDO::FETCH_ASSOC);
						while($row = $q->fetch() ) {
							echo "<option value='".$row['id']."' >".$row['name']."</option>";
						}
					?>
				</select>
				<small id="reliefHelp" class="form-text text-muted">জানা না থাকলে, খালি রাখুন</small>
			</div>

			<div class="form-group">
				<label for="age">বয়স</label>
				<input type="number" name="age" class="form-control" id="age" aria-describedby="ageHelp" placeholder="ত্রাণগ্রহীতার বয়স" onkeyup="saveValue(this);" onClick="this.select();">
				<small id="ageHelp" class="form-text text-muted">ত্রাণ গ্রহীতার বয়স (উর্ধ্বসীমা অনুযায়ী) লিখুন। উদাহরনঃ বয়স ৩৩ বছর ৪ মাস হলে; ৩৪ লিখুন।</small>
			</div>

			<div class="form-group">
				<label for="genderInput">ত্রাণগ্রহীতার ধরণ:</label>
				<select name="sel_gender" class="form-control" id="sel_gender" onchange="saveValue(this);" required>
					<option value="">--ত্রাণগ্রহীতার ধরণ নির্বাচন করুন--</option>
					<option value="1">পুরুষ</option>
					<option value="0">মহিলা</option>
				</select>
			</div>

			<div class="form-group text-right">
				<input type="submit" name="btn_apply" class="btn btn-primary" value="আবেদন করুন">
			</div>
		</div>
	</div>
</form>
<?php require_once './_common_files/footer.php';?>