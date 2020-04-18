<?php
	require_once './_common_files/header.php';
	function validate_dob($dob) {
		$date1 = date_create($dob);
		$date2 = date_create(date("Y-m-d"));

		$diff = date_diff($date1,$date2);
		$diff = (int) $diff->format("%r%y");

		if($diff < 18 || $diff > 35)
			return TRUE;
		return FALSE;
	}
	if(isset($_REQUEST['btn_register']) && $_SERVER["REQUEST_METHOD"] == "POST") {
		$name			= clean_input($_REQUEST["txt_name"]);
		$gender			= clean_input($_REQUEST["sel_gender"]);
		$occupation		= clean_input($_REQUEST["sel_occupation"]);
		$dob			= clean_input($_REQUEST["dt_dob"]);
		$experience		= clean_input($_REQUEST["sel_experience"]);
		$fit			= clean_input($_REQUEST["sel_fit"]);
		$phone			= clean_input($_REQUEST["txt_phone"]);
		$alternate_phone= clean_input($_REQUEST["txt_alternate_phone"]);
		$self_union		= clean_input($_REQUEST["sel_union"]);
		$self_ward		= clean_input($_REQUEST["sel_ward"]);
		$blood_group	= clean_input($_REQUEST["sel_bg"]);
		$last_14		= clean_input($_REQUEST["txt_last_14"]);
		$nid			= clean_input($_REQUEST["txt_nid"]);
		$father			= clean_input($_REQUEST["txt_father"]);
		$mother			= clean_input($_REQUEST["txt_mother"]);
		$preferred_union= clean_input($_REQUEST["sel_pref_union"]);
		$preferred_ward	= clean_input($_REQUEST["sel_pref_ward"]);
		$address		= clean_input($_REQUEST["txt_address"]);


		if(empty($name)) {
			$errorMsg[] = "আপনার পূর্ণনাম লিখুন।";
		}
		if(empty($nid)) {
			$errorMsg[] = "আপনার জাতীয় পরিচয়পত্র/পাসপোর্ট/ড্রাইভিং লাইসেন্স/অন্য পরিচিতি নম্বর প্রদান করুন";
		}
		else if(empty($dob)) {
			$errorMsg[] = "আপনার জন্মসাল নির্বাচন করুন";
		}

		else if(validate_dob($dob)) {
			$errorMsg[] = "প্রার্থীর বয়স অন্যূন ১৮ এবং অনূর্ধ্ব ৩৫ হতে হবে";
		}

		else if(empty($phone)) {
			$errorMsg[] = "১১ ডিজিটের(সর্বোচ্চ) ফোন/মোবাইল নং লিখুন";
		}

		else if(empty($self_union)) {
			$errorMsg[] = "আপনার ইউনিয়ন নির্বাচন করুন";
		}

		else if(empty($self_ward)) {
			$errorMsg[] = "আপনার ওয়ার্ড নির্বাচন করুন";
		}

		else if(empty($preferred_union)) {
			$errorMsg[] = "যে ইউনিয়নে কাজ করতে চান তা নির্বাচন করুন";
		}

		else if(empty($preferred_ward)) {
			$errorMsg[] = "যে ওয়ার্ডে কাজ করতে চান তা নির্বাচন করুন";
		}

		else {
			try {
				$result = $pdo->prepare("SELECT * FROM volunteers WHERE nid=?");;
				$result->bindParam(1, $nid, PDO::PARAM_STR);
				$result->execute();
				$row = $result->fetch(PDO::FETCH_ASSOC);

				if($result->rowCount() > 0) {
					$errorMsg[] = "আপনি পূর্বেই সেসসছসেবক হিসেবে নিবন্ধিত হয়েছেন!";
				}
				elseif(!isset($errorMsg)) {
					$sql = "INSERT INTO volunteers(name, gender, occupation, dob, experience, fit, mobile, alternate_mobile, self_unionp, self_ward, blood_group, last_14_days, nid, fathers_name, mothers_name, preferred_ward, preferred_unionp, address) VALUES (:uname, :gender, :occupation, :dob, :experience, :fit, :mobile, :alternate_mobile, :self_unionp, :self_ward, :blood_group, :last_14_days, :nid, :fathers_name, :mothers_name, :preferred_ward, :preferred_unionp, :uaddress)";
					$stmt = $pdo->prepare($sql);
					$stmt->bindParam(':uname', $name, PDO::PARAM_STR); //1 name
					$stmt->bindParam(':gender', $gender, PDO::PARAM_INT); //2 gender
					$stmt->bindParam(':occupation', $occupation, PDO::PARAM_INT); //3 occupation
					$stmt->bindParam(':dob', $dob, PDO::PARAM_INT); //4 dob
					$stmt->bindParam(':experience', $experience, PDO::PARAM_INT); //5 experience
					$stmt->bindParam(':fit', $fit, PDO::PARAM_INT); //6 fit
					$stmt->bindParam(':mobile', $phone, PDO::PARAM_STR); //7 mobile
					$stmt->bindParam(':alternate_mobile', $alternate_phone, PDO::PARAM_STR); //8 alternate_mobile
					$stmt->bindParam(':self_unionp', $self_union, PDO::PARAM_INT); //9 self_unionp
					$stmt->bindParam(':self_ward', $self_ward, PDO::PARAM_INT); //10 self_ward
					$stmt->bindParam(':blood_group', $blood_group, PDO::PARAM_INT); //11 blood_group
					$stmt->bindParam(':last_14_days', $last_14, PDO::PARAM_STR); //12 last_14_days
					$stmt->bindParam(':nid', $nid, PDO::PARAM_STR); //13 nid
					$stmt->bindParam(':fathers_name', $father, PDO::PARAM_STR); //14 fathers_name
					$stmt->bindParam(':mothers_name', $mother, PDO::PARAM_STR); //15 mothers_name
					$stmt->bindParam(':preferred_ward', $preferred_ward, PDO::PARAM_INT); //16 preffered_ward
					$stmt->bindParam(':preferred_unionp', $preferred_union, PDO::PARAM_INT); //17 preffered_unionp
					$stmt->bindParam(':uaddress', $address, PDO::PARAM_STR); //18 address
					$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					if ($stmt->execute()) {
						$regMsg="রেজিস্ট্রেশন সফল হয়েছে! উপজেলা প্রশাসন হতে অতিসত্বর আপনার সাথে যোগাযোগ করা হবে। ধন্যবাদ!";
						// ob_start();
					 	header("Refresh:2; login.php");
					}
					else {
						$errorMsg[]="স্বেচ্ছাসেবক নিবন্ধন সফল হয়নি। অনুগ্রহ করে আবার চেষ্টা করুন।";
					}
				}
				else {
					$errorMsg[]="দুঃখিত, অনিবার্য কারনবশত স্বেচ্ছাসেবক নিবন্ধন সফল হয়নি। অনুগ্রহ করে আবার চেষ্টা করুন।";
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
	<small>স্বেচ্ছাসেবক নিবন্ধনের জন্য নিম্নোক্ত ফর্মটি ব্যবহার করুন।</small>
</center>
<br>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 25px;">
		<form method="post" class="form-horizontal" action="<?=htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label class="col-sm-12">১. নাম</label>
					<div class="col-sm-12">
						<input type="text" name="txt_name" class="form-control" placeholder="আপনার নাম লিখুন" required />
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-12">২. পিতার নাম</label>
					<div class="col-sm-12">
						<input type="text" name="txt_father" class="form-control" placeholder="পিতার নাম লিখুন" />
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-12">৩. মাতার নাম</label>
					<div class="col-sm-12">
						<input type="text" name="txt_mother" class="form-control" placeholder="মাতার নাম লিখুন" />
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-12">৪. এনআইডি/পাসপোর্ট/ড্রাইভিং লাইসেন্স/অন্য পরিচিতি নম্বর</label>
					<div class="col-sm-12">
						<input type="text" name="txt_nid" class="form-control" placeholder="এনআইডি/পাসপোর্ট/ড্রাইভিং লাইসেন্স/অন্য পরিচিতি নম্বর লিখুন" required />
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-12">৫. জন্ম সাল</label>
					<div class="col-sm-12">
						<input type="date" name="dt_dob" class="form-control" min="<?=date('Y-m-d',strtotime('35 years ago'))?>" max="<?=date('Y-m-d',strtotime('18 years ago'))?>" required />
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-12">৬. লিঙ্গ</label>
					<div class="col-sm-12">
						<label class="radio-inline"><input type="radio" name="sel_gender" value="1" required>পুরুষ</label>
						<label class="radio-inline"><input type="radio" name="sel_gender" value="0">মহিলা</label>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-12">৭. পেশা</label>
					<div class="col-sm-12">
						<select class="form-control"  name="sel_occupation" required>
							<option value="">--পেশা নির্বাচন করুন--</option>
							<option value="1">ছাত্র</option>
							<option value="2">চাকরিজীবী</option>
							<option value="3">ব্যবসায়ী</option>
							<option value="4">বেকার</option>
							<option value="5">অন্যান্য</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-12">৮. ফোন/মোবাইল নম্বর</label>
					<div class="col-sm-12">
						<input type="text" name="txt_phone" class="form-control" placeholder="আপনার মোবাইল নং লিখুন" required />
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-12">৯. বিকল্প ফোন/মোবাইল নম্বর</label>
					<div class="col-sm-12">
						<input type="text" name="txt_alternate_phone" class="form-control" placeholder="আপনার বিকল্প মোবাইল নং লিখুন" />
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-12">১০. আপনার ইউনিয়ন নির্বাচন করুন</label>
					<div class="col-sm-12">
						<select class="form-control"  name="sel_union" required>
							<option value="">--ইউনিয়ন নির্বাচন করুন--</option>
							<?php
								require_once('config.php');
								$sql = "SELECT * FROM unions";
								$q = $pdo->query($sql);
								$q->setFetchMode(PDO::FETCH_ASSOC);
								while($row = $q->fetch() ){
									echo "<option value='".$row['id']."' >".$row['name']."</option>";
								}
							?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-12">১১. আপনার ওয়ার্ড নির্বাচন করুন</label>
					<div class="col-sm-12">
						<select class="form-control"  name="sel_ward" required>
						<option value="">--ওয়ার্ড নির্বাচন করুন--</option>
							<option value="1">১</option>
							<option value="2">২</option>
							<option value="3">৩</option>
							<option value="4">৪</option>
							<option value="5">৫</option>
							<option value="6">৬</option>
							<option value="7">৭</option>
						</select>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label class="col-sm-12">১২. ঠিকানা</label>
					<div class="col-sm-12">
						<textarea class="form-control" name="txt_address" rows="5" placeholder="আপনার ঠিকানা লিখুন" required ></textarea>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-12">১৩. যে ইউনিয়নে কাজ করতে চান তা নির্বাচন করুন</label>
					<div class="col-sm-12">
						<select class="form-control"  name="sel_pref_union" required>
							<option value="">--ইউনিয়ন নির্বাচন করুন--</option>
							<?php
								$q = $pdo->query($sql);
								$q->setFetchMode(PDO::FETCH_ASSOC);
								while($row = $q->fetch() ){
									echo "<option value='".$row['id']."' >".$row['name']."</option>";
								}
							?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-12">১৪. যে ওয়ার্ডে কাজ করতে চান তা নির্বাচন করুন</label>
					<div class="col-sm-12">
						<select class="form-control"  name="sel_pref_ward" required>
							<option value="">--ওয়ার্ড নির্বাচন করুন--</option>
							<option value="1">১</option>
							<option value="2">২</option>
							<option value="3">৩</option>
							<option value="4">৪</option>
							<option value="5">৫</option>
							<option value="6">৬</option>
							<option value="7">৭</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-12">১৫. বিগত ১৪ দিন আপনি কোথায় ছিলেন?</label>
					<div class="col-sm-12">
						<textarea class="form-control" name="txt_last_14" rows="5" placeholder="বিস্তারিত লিখুন(সর্বোচ্চ ২৫৫ অক্ষর)" required ></textarea>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-12">১৬. আপনার কোন ছোঁয়াচে (জ্বর/সর্দি/কাশি/শ্বাসকষ্ট) রোগ আছে কিনা?</label>
					<div class="col-sm-12">
						<label class="radio-inline"><input type="radio" name="sel_fit" value="1" required>হ্যাঁ</label>
						<label class="radio-inline"><input type="radio" name="sel_fit" value="0">না</label>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-12">১৭. পূর্বে কোন সেচ্ছাসেবী কাজ করার অভিজ্ঞতা আছে কিনা?</label>
					<div class="col-sm-12">
						<label class="radio-inline"><input type="radio" name="sel_experience" value="1" required>হ্যাঁ</label>
						<label class="radio-inline"><input type="radio" name="sel_experience" value="0">না</label>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-12">১৮. রক্তের গ্রুপ</label>
					<div class="col-sm-12">
						<select class="form-control"  name="sel_bg">
							<option value="">--রক্তের গ্রুপ নির্বাচন করুন--</option>
							<option value="1">A+</option>
							<option value="2">B+</option>
							<option value="3">AB+</option>
							<option value="4">O+</option>
							<option value="5">A-</option>
							<option value="6">B-</option>
							<option value="7">AB-</option>
							<option value="8">O-</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12 control-label">
						<input type="submit" name="btn_register" class="btn btn-success" value="সাইন আপ">
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<?php require_once './_common_files/footer.php';?>