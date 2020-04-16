<?php
	require_once './_common_files/header.php';
?>

<center>
	<h2>ত্রাণ বিতরণ সিস্টেমে (আরডিএস) স্বাগতম।</h2>
	<small>প্রমুখ জনপ্রতিনিধি, ডাক্তার, ফায়ার সার্ভিস, বিভিন্ন দপ্তর ও অফিসারদের নাম ও টেলিফোন/মোবাইল নাম্বার।</small>
</center>
<br>

<input class="form-control" id="myInput" type="text" placeholder="অনুসন্ধান">
  <br>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>ক্রম</th>
        <th>নাম</th>
        <th>পদবী</th>
		    <th>ফোন / মোবাইল নং</th>
		    <th>ইমেইল</th>
      </tr>
    </thead>
    <tbody id="myTable">
      <?php
        require_once('config.php');
        try {
          $stmt = $pdo->prepare('SELECT * FROM officials order by grade ASC');
          $stmt->execute();
          $officers = $stmt->fetchAll(PDO::FETCH_ASSOC);
          $i = 0;
          foreach($officers as $officer) {
            echo '<tr><td style="text-align: center;">'.++$i.'</td><td>'.$officer['name'].'</td><td>'.$officer['designation'].'</td><td>'.$officer['phone'].'</td><td>'.$officer['email'].'</td></tr>';
          }
        }
        catch (PDOException $e) {
          die("Could not connect to the database:" . $e->getMessage());
        }
      ?>
    </tbody>
  </table>

<?php require_once './_common_files/footer.php';?>