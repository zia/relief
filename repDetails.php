<?php
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

    // get the q parameter from URL
    $id = trim($_GET["id"]);
    $repDetailsText = "";
    // Connection with Mysql
    try {
        $results = $pdo->prepare("SELECT * FROM records WHERE nid = ? or mobile=?");
        $results->bindParam(1, $id, PDO::PARAM_STR);
        $results->bindParam(2, $id, PDO::PARAM_STR);
        $results->execute();
        $repDetails = $results->fetchAll(PDO::FETCH_ASSOC);
        $rows = $results->rowCount();

    // if empty($user) = TRUE, set $status = "anonymous"
        $service = ($rows==1) ? "টি ত্রাণ" : "টি ত্রাণ";
        //var_dump($repDetails); // Data Ok
        if(empty($repDetails)) {
            $repDetailsText .= "কোন ত্রাণ গ্রহণ করেননি।";
        } else {
            $repDetailsText .= $rows. ' ' . $service . ' গ্রহণ করেছেন';
            $repDetailsText .= '<table style="width:90%"><tr><th>এনাইডি</th><th>নাম</th><th>ইউনিয়ন</th><th>ত্রাণের ধরণ</th><th>অর্থবছর</th></tr>';
            foreach($repDetails as $repDetail) {
                //var_dump($repDetailsText);exit("Ok");
                $repDetailsText .= '<tr><td>' . $repDetail['nid'] . '</td>'
                                . '<td>' . $repDetail['name'] . '</td>'
                                . '<td>' . get_union_name($repDetail['unionp']) . '</td>'
                                . '<td>' . get_relief_name($repDetail['relief_type']) . '</td>'
                                . '<td>' . $repDetail['fiscal_year'] . '</td>'
                                . '</tr>';
            }
            $repDetailsText .= '</table>';
        }

        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    // Output "no suggestion" if no hint was found or output correct values
    echo "$repDetailsText";
?>