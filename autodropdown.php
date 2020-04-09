<?php
    require_once('config.php');
    $returnText = '<label for="typeInputEmail1">ওয়ার্ড</label><select name="ward" class="custom-select mr-sm-2" id="sel_ward" onchange="saveValue(this);" required><option value="">--ওয়ার্ড--</option>';

    $departid = $_GET['number'];   // department id

    $sql = $pdo->prepare("SELECT id, name FROM wards WHERE unionp=". $departid);
    $sql->execute();
    $wards = $sql->fetchAll(PDO::FETCH_ASSOC);
    foreach($wards as $ward) {
        $returnText .= "<option value='".$ward['id']."' >".$ward['name']."</option>";
    }
    $returnText .= '</select>';

    echo $returnText;
    // encoding array to json format
    // echo json_encode($users_arr);
?>