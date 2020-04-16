<?php
    require_once('config.php');
    if(isset($_GET['number']) && $_GET['number'] != null) {
        $cls = isset($_GET['version']) && $_GET['version'] == 3 ? 'form-control' : 'custom-select mr-sm-2';
        $returnText = '<label for="typeInputEmail1">ওয়ার্ড</label><select name="ward" class="'.$cls.'" id="sel_ward" onchange="saveValue(this);" required><option value="">--ওয়ার্ড--</option>';

        $departid = $_GET['number'];   // department id

        $sql = $pdo->prepare("SELECT id, name FROM wards WHERE unionp=". $departid);
        $sql->execute();
        $wards = $sql->fetchAll(PDO::FETCH_ASSOC);
        foreach($wards as $ward) {
            $returnText .= "<option value='".$ward['id']."' >".$ward['name']."</option>";
        }
        $returnText .= '</select>';

        echo $returnText;
    }
    // encoding array to json format
    // echo json_encode($users_arr);
?>