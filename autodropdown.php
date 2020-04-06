<?php
require_once('config.php');
$returnText = '<label for="typeInputEmail1">ওয়ার্ড/গ্রাম</label><select name="village" class="custom-select mr-sm-2" id="sel_user" ><option value="">--গ্রাম--</option>';

$departid = $_GET['number'];   // department id

$sql = "SELECT id, name FROM village WHERE unionp=". $departid;

$q = $pdo->query($sql);
$q->setFetchMode(PDO::FETCH_ASSOC);

while($row = $q->fetch() ){
    
    $vill_id = $row['id'];
    $vill_name = $row['name'];
    
    // Option
    $returnText .= "<option value='".$vill_id."' >".$vill_name."</option>";
}

$returnText .= '</select>';            
echo $returnText;
// encoding array to json format
// echo json_encode($users_arr);
?>