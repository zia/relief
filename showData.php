<?php
  require_once('config.php');
  include('header.php');
  function get_relief_name($relief_id) {
    global $pdo;
    $result = $pdo->prepare("SELECT name FROM relief_types WHERE id = ?");
    $result->bindParam(1, $relief_id, PDO::PARAM_INT);
    $result->execute();
    return $name = $result->fetchColumn();
  }
  function get_gender($gender) {
    return $gender == 1 ? 'পুরুষ' : 'মহিলা';
  }
?>

<section class="inputform" style="margin-bottom: 25px;">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <?php
          $place = !isset($_GET['union']) ? 'pou' : $_GET['union'];
          $tBody = "";
          try {
            $sql= 'SELECT r.name as personName, u.name as unionName, w.name as wardName, age, gender, nid, mobile, ward, relief_type, fiscal_year FROM  unions u, records r, wards w WHERE r.unionp=u.id and r.ward=w.id and r.unionp="'. $place .'" order by r.id DESC';
            if(isset($_GET['relief']) && !empty($_GET['relief'])) {
              $sql= 'SELECT r.name as personName, u.name as unionName, w.name as wardName, age, gender, nid, mobile, ward, relief_type, fiscal_year FROM  unions u, records r, wards w WHERE r.unionp=u.id and r.ward=w.id and r.unionp="'. $place .'" and r.relief_type="'. $_GET['relief'] .'" order by r.id DESC';
            }
            if(isset($_GET['gender'])) {
              $sql= 'SELECT r.name as personName, u.name as unionName, w.name as wardName, age, gender, nid, mobile, ward, relief_type, fiscal_year FROM  unions u, records r, wards w WHERE r.unionp=u.id and r.ward=w.id and r.unionp="'. $place .'" and r.gender="'. $_GET['gender'] .'" order by r.id DESC';
            }

            // var_dump($sql); exit();
            $q = $pdo->query($sql);
            $q1 = $pdo->query($sql);
            $q->setFetchMode(PDO::FETCH_ASSOC);
            $q1->setFetchMode(PDO::FETCH_ASSOC);
          }
          catch (PDOException $e) {
            die("Could not connect to the database:" . $e->getMessage());
          }
        ?>

        <div class="row" style="margin: 15px 0px 15px 0px;">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-left: 0px;">
            <h4 id="union_heading">
              <?php
                $row = $q1->fetchAll();
                if($row)
                  echo $row[0]['unionName'];
                else {
                  $result = $pdo->prepare("SELECT name FROM unions WHERE id = ?");
                  $result->bindParam(1, $place, PDO::PARAM_INT);
                  $result->execute();
                  echo $result->fetchColumn();
                }
                // vfprintf(handle, format, args)ar_dump($row); exit();
              ?>
              ইউনিয়নের <?= isset($_GET['relief']) ? get_relief_name($_GET['relief']) : 'ত্রাণ'?> গ্রহীতা: <?php $rows = $q->rowCount(); echo $rows; $i=1; ?> জন
            </h4>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="row">
              <div class="col-sm-6 form-inline">
                <div class="form-group">
                    <label class="control-label" for="sel1">ত্রাণের ধরণ:</label>&nbsp;
                    <select class="form-control" id="sel_relief" onchange="location = this.value;">
                      <option value="?union=<?=$place?>">-- ত্রাণের ধরণ --</option>
                      <?php
                        $rel = "SELECT id, name FROM relief_types ORDER BY id ASC";
                        $res = $pdo->query($rel);
                        $res->setFetchMode(PDO::FETCH_ASSOC);
                        while($r = $res->fetch() ) {
                          $selected = isset($_GET['relief']) && $_GET['relief'] == $r['id'] ? 'selected' : '';
                          echo '<option value="?union='.$place.'&relief='.$r['id'].'"'.$selected.'>'.$r['name'].'</option>';
                        }
                      ?>
                    </select>
                </div>
              </div>
              <div class="col-sm-6 form-inline">
                <div class="form-group">
                    <label class="control-label" for="sel1">ত্রাণগ্রহীতার ধরণ:</label>&nbsp;
                    <select class="form-control" id="sel_gender" onchange="location = this.value;">
                      <option value="?union=<?=$place?>">-- ত্রাণগ্রহীতার ধরণ --</option>
                      <option value="?union=<?=$place?>&gender=1" <?=isset($_GET['gender']) && $_GET['gender'] == 1 ? 'selected' : '' ?>>পুরুষ</option>
                      <option value="?union=<?=$place?>&gender=0" <?=isset($_GET['gender']) && $_GET['gender'] == 0 ? 'selected' : '' ?>>মহিলা</option>
                    </select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <table class="table table-bordered" id="showtable">
          <thead>
            <tr>
              <th>ক্রমিক</th>
              <th>এনআইডি</th>
              <th>মোবাইল</th>
              <th>পুরো নাম</th>
              <th>জেন্ডার</th>
              <th>বয়স</th>
              <th>ওয়ার্ড নং</th>
              <th>ত্রাণের ধরণ</th>
              <th>অর্থবছর</th>
              <th>স্বাক্ষর</th>
            </tr>
          </thead>

          <tbody>
            <?php
              while ($row = $q->fetch()):
                $tBody .= '
                  <tr>
                    <td>'. $i++ . '.</td>
                    <td>'. $row['nid'] .'</td>
                    <td>'. $row['mobile'] .'</td>
                    <td>'. $row['personName'] .'</td>
                    <td>'. get_gender($row['gender']).'</td>
                    <td>'. $row['age'] .'</td>
                    <td>'. $row['wardName'] .'</td>
                    <td>'. get_relief_name($row['relief_type']) .'</td>
                    <td>'. $row['fiscal_year'] .'</td>
                    <td> </td>
                  </tr>';
              endwhile;
              echo $tBody;
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
<?php include('footer.php'); ?>