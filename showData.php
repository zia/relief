<?php include('header.php'); ?>

    <section class="inputform">
      <div class="container">
      <div class="row">
      <div class="col-md-12">
      
      <?php
        require_once('config.php');

        if (!isset($_GET['union'])) {
          $place = 'pou';
        } else {
          $place = $_GET['union'];
        }

        // file_put_contents('myfile33.txt', $place); getch(); - Word, - Under Union
        $tBody = "";
try {
    // $sql = 'SELECT * FROM record where unionp="'. $place .'" order by id DESC';
    $sql= 'SELECT r.name as personName, r.nid, mobile, union_name, v.name, word, type, date FROM  unionPori p, record r, village v WHERE r.unionp=p.id and r.village=v.id and r.unionp="'. $place .'" order by r.id DESC';
    // var_dump($sql); exit();
    $q = $pdo->query($sql);
    $q1 = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $q1->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>

<h4>
  <?php
    $row = $q1->fetchAll();
    if($row)
      echo $row[0]['union_name'];
    else {
      $result = $pdo->prepare("SELECT union_name FROM unionpori WHERE id = ?");
      $result->bindParam(1, $place, PDO::PARAM_INT);
      $result->execute();
      echo $result->fetchColumn();
    }
    // var_dump($row); exit();
  ?>
  এর ত্রাণ গ্রহীতা: <?php $rows = $q->rowCount(); echo $rows; $i=1; ?>
</h4>

<table class="table table-bordered">
    <thead>
      <tr>
        <th>ক্রমিক</th>
        <th>এনআইডি</th>
        <th>মোবাইল</th>
        <th>পুরো নাম</th>
        <th>গ্রাম (ওয়ার্ড)</th>
        <th>ত্রাণের ধরণ</th>
        <th>অর্থবছর</th>
        <th>স্বাক্ষর</th>
      </tr>
    </thead>
    <tbody>
    
<?php while ($row = $q->fetch()): ?>
    <?php  $tBody .= '<tr> <td>' . $i++ . '.</td><td>'. $row['nid'] .'</td><td>'. $row['mobile'] .'</td><td>' . $row['personName'] . '</td><td>' . $row['name'] . ' ('. $row['word'] .')</td><td>' . $row['type'] . '</td><td>'. $row['date'] . '</td><td> </td></tr>';
     
     ?>
<?php endwhile; ?>
<?php echo $tBody; ?>
</tbody>
  </table>
      </div>
      </div>
      
      </div>
    </section>

    <?php include('footer.php'); ?>
