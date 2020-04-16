<?php
  // Start Main Service Add
  $nid            = $_POST["nid"];
  $unionp         = $_POST["unionp"];
  $mobile         = $_POST["mobile"];
  $fullName       = $_POST["fullName"];
  $serviceType    = $_POST["serviceType"];
  $serviceFCYear  = $_POST["serviceFCYear"];
  $ward           = $_POST["ward"];
  $age            = $_POST["age"];
  $gender         = $_POST["sel_gender"];;

  if ($nid == "" && $mobile == "") {
    $error_message = "এনাইডি অথবা মোবাইল নম্বর; যে কোন একটি অত্যাবশ্যকীয়।";
    echo '<p class="p-3 mb-2 bg-danger text-white">' .$error_message . '</p>';
    exit ();
  }

  if(strlen($nid) !== 10 && strlen($nid) !== 17) {
    $error_message = "এনাইডি ১০ অথবা ১৭ সংখ্যার হতে হবে; আপনার এনাইডি ১৩ সংখ্যার হলে তার পূর্বে জন্মসাল উল্লেখ করুন।";
    echo '<p class="p-3 mb-2 bg-danger text-white">' .$error_message . '</p>';
    exit ();
  }

  if(strlen($mobile) != 11) {
    $error_message = "মোবাইল নম্বর ১১ সংখ্যার হতে হবে।";
    echo '<p class="p-3 mb-2 bg-danger text-white">' .$error_message . '</p>';
    exit ();
  }

  require_once('config.php');

  function get_union_name($union_id) {
      global $pdo;
      $result = $pdo->prepare("SELECT name FROM unions WHERE id = ?");
      $result->bindParam(1, $union_id, PDO::PARAM_INT);
      $result->execute();
      return $name = $result->fetchColumn();
  }

  function get_relief_name($relief_id) {
      global $pdo;
      $result = $pdo->prepare("SELECT name FROM relief_types WHERE id = ?");
      $result->bindParam(1, $relief_id, PDO::PARAM_INT);
      $result->execute();
      return $name = $result->fetchColumn();
  }

  function get_ward_name($ward_id) {
      global $pdo;
      $result = $pdo->prepare("SELECT name FROM wards WHERE id = ?");
      $result->bindParam(1, $ward_id, PDO::PARAM_INT);
      $result->execute();
      return $name = $result->fetchColumn();
  }

  // Check if exit
  $results = $pdo->prepare("SELECT * FROM records WHERE nid = ? or mobile = ?");
  $results->bindParam(1,$nid,PDO::PARAM_STR);
  $results->bindParam(2,$mobile,PDO::PARAM_STR);
  $results->execute();
  $repDetails = $results->fetchAll(PDO::FETCH_ASSOC);

  $rows = $results->rowCount();
  if ($rows >= 1) {
    $returnText = '<div class="alert alert-dismissible alert-danger" style="margin-top:10px; "><b>তথ্য পূর্বেই সংরক্ষিত হয়েছে! </b><!--<button type="button" class="btn btn-success">Edit</button>--> <br><br>এনআইডি = ' . $repDetails[0]['nid'] . '<br>মোবাইল = '. $repDetails[0]['mobile'] .',<br>নাম = ' . $repDetails[0]['name'] . ",<br>ইউনিয়ন = " . get_union_name($repDetails[0]['unionp']) . ",<br>ওয়ার্ড নং = " . get_ward_name($repDetails[0]['ward']) . ",<br>ত্রাণের ধরণ = " . get_relief_name($repDetails[0]['relief_type']) . ',<br>অর্থবছর = ' . $repDetails[0]['fiscal_year'] . '</div>';
    echo $returnText;
    exit ();
  }
  // End Check if exit

  $sql = "INSERT INTO records(name, age, gender, nid, mobile, unionp, ward, relief_type, fiscal_year) VALUES (:name, :age, :gender, :nid, :mobile, :unionp, :ward, :relief_type, :fiscal_year)";

  $stmt = $pdo->prepare($sql);

  $stmt->bindParam(':name', $fullName, PDO::PARAM_STR);
  $stmt->bindParam(':age', $age, PDO::PARAM_INT);
  $stmt->bindParam(':gender', $gender, PDO::PARAM_INT);
  $stmt->bindParam(':nid', $nid, PDO::PARAM_INT);
  $stmt->bindParam(':mobile', $mobile, PDO::PARAM_STR);
  $stmt->bindParam(':unionp', $unionp, PDO::PARAM_INT);
  $stmt->bindParam(':ward', $ward, PDO::PARAM_INT);
  $stmt->bindParam(':relief_type', $serviceType, PDO::PARAM_STR);
  $stmt->bindParam(':fiscal_year', $serviceFCYear, PDO::PARAM_STR);

  // var_dump($stmt);
  if ($stmt->execute()) {
    $newId = $pdo->lastInsertId();
    $returnText = '<div class="alert alert-dismissible alert-success" style="margin-top:10px; "><b>তথ্য সরক্ষিত হয়েছে! </b><!--<button type="button" class="btn btn-success">Edit</button>--><br>এনআইডি = ' . $nid . '<br>মোবাইল = '. $mobile .',<br>নাম = ' . $fullName . ",<br>ইউনিয়ন = " . get_union_name($unionp) . ",<br>ওয়ার্ড নং = " . get_ward_name($ward) . ",<br>ত্রাণের ধরণ = " . get_relief_name($serviceType) . ',<br>অর্থবছর = ' . $serviceFCYear . '</div>';
    echo $returnText;
  }
  else {
    echo "তথ্য সংরক্ষণ সম্ভব হয় নি, আপনার প্রদত্ত তথ্য পুনরায় মূল্যায়ন করুন।";
  }
  // End Main Service Add

  //Encode the array into a JSON string.
  $encodedString = json_encode($_POST);

  //Save the JSON string to a text file.
  // file_put_contents('myfile.txt', $encodedString);