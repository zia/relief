<?php
//Example array.
//$array = array('Ireland', 'England', 'Wales', 'Northern Ireland', 'Scotland');
// Start Main Service Add
$nid = $_POST["nid"];
$mobile = $_POST["mobile"];
$fullName = $_POST["fullName"];
$unionp = $_POST["unionp"];
$serviceType = $_POST["serviceType"];
$serviceFCYear = $_POST["serviceFCYear"];
if ($nid == "" && $mobile == "") {
    $error_message = "এনাইডি অথবা মোবাইল নম্বর; যে কোন একটি অত্যাবশ্যকীয়।";
    echo '<p class="p-3 mb-2 bg-danger text-white">' .$error_message . '</p>';
    exit ();
}

require_once('config.php');
// Check if exit
$results = $pdo->prepare(  // $results PDO object statement hoye jay so later you can use $results as object
  "SELECT * FROM record WHERE nid = ? or mobile = ?"
);
$results->bindParam(1,$nid,PDO::PARAM_INT);
$results->bindParam(2,$mobile,PDO::PARAM_INT);
$results->execute();
$repDetails = $results->fetchAll(PDO::FETCH_ASSOC);
$rows = $results->rowCount();
if ($rows>=1) {
  $returnText = '<div class="alert alert-dismissible alert-Danger" style="margin-top:10px; "><b>Failed! Already Exists </b><button type="button" class="btn btn-success"> Edit</button> <br>NID = ' . $nid . '<br>Mobile = '. $mobile .',<br>Full Name = ' . $fullName . ",<br> Union P = " . $unionp . ",<br>Service Type = " . $serviceType . ',<br>Service FC Year = ' . $serviceFCYear . '</div>';
  echo $returnText;
  exit ();
}
// End Check if exit

$sql = "INSERT INTO record(
            name,
            nid,
            mobile,
            unionp,
            village,
            type,
            date) VALUES (
            :name,
            :nid,
            :mobile,
            :unionp,
            :village,
            :type,
            :date)";

$stmt = $pdo->prepare($sql);

$stmt->bindParam(':name', $fullName, PDO::PARAM_STR);
$stmt->bindParam(':nid', $nid, PDO::PARAM_INT);
$stmt->bindParam(':mobile', $mobile, PDO::PARAM_INT);
$stmt->bindParam(':unionp', $unionp, PDO::PARAM_INT);
$stmt->bindParam(':village', $unionp, PDO::PARAM_INT);
$stmt->bindParam(':type', $serviceType, PDO::PARAM_STR);
$stmt->bindParam(':date', $serviceFCYear, PDO::PARAM_STR);
// var_dump($stmt);
if ($stmt->execute()) {
  $newId = $pdo->lastInsertId();
  $returnText = '<div class="alert alert-dismissible alert-success" style="margin-top:10px; "><b>Successfully Inserted with </b><button type="button" class="btn btn-success">Edit</button> <br>NID = ' . $nid . '<br>Mobile = '. $mobile .',<br>Full Name = ' . $fullName . ",<br> Union P = " . $unionp . ",<br>Service Type = " . $serviceType . ',<br>Service FC Year = ' . $serviceFCYear . '</div>';
  echo $returnText;
} else {
  echo "Failed To Insert! Please Check your data again.";
}
// End Main Service Add

//Encode the array into a JSON string.
$encodedString = json_encode($_POST);

//Save the JSON string to a text file.
// file_put_contents('myfile.txt', $encodedString);