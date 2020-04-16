<?php include('header.php'); ?>
<br>
<section class="inputform">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <form class="serviceEntry inputForm">
          <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
          <div class="form-group">
            <label for="NID">এনআইডি* (১০ অথবা ১৭ সংখ্যার এনাইডি লিখুন)</label>
            <input type="text" name="nid" class="form-control" id="nid" placeholder="ন্যাশনাল আইডি নং দিন।" onkeyup="saveValue(this);" onClick="this.select();" required>
          </div>

          <div class="form-group">
            <label for="mobile">মোবাইল</label>
            <input type="text" name="mobile" class="form-control" id="mobile" aria-describedby="mobileHelp" placeholder="মোবাইল নম্বর লিখুন।" onkeyup="saveValue(this);" onClick="this.select();" required>
            <small id="mobileHelp" class="form-text text-muted">১১ ডিজিটের মোবাইল নং লিখুন। (ত্রাণ গ্রহীতার মোবাইল না থাকলে; পরিচিত কারও মোবাইল নং দিন)</small>
          </div>

          <div class="form-group">
            <label for="fullName">পুরো নাম (এনাইডির সাথে মিলিয়ে লিখুন)</label>
            <input type="text" name="fullName" class="form-control" id="fullName" placeholder="পুরো নাম লিখুন।" onkeyup="saveValue(this);" onClick="this.select();" required>
          </div>

          <div class="form-group">
            <label for="typeInputEmail1">ইউনিয়ন</label>
            <select name="unionp" class="custom-select mr-sm-2" id="sel_depart" onchange="saveValue(this);" required>
              <option value="">--ইউনিয়ন পরিষদ--</option>
              <?php
                require_once('config.php');
                // Check if exit
                $sql = "SELECT * FROM unions";
                $q = $pdo->query($sql);
                $q->setFetchMode(PDO::FETCH_ASSOC);
                // var_dump($row);
                while($row = $q->fetch() ){
                  $union_id = $row['id'];
                  $union_name = $row['name'];
                  // Option
                  echo "<option value='".$union_id."' >".$union_name."</option>";
                }
              ?>
            </select>
          </div>

          <div class="form-group">
            <div class="peasthere"></div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="typeInputEmail1">ত্রাণের ধরন</label>
            <select name="serviceType" class="custom-select mr-sm-2" id="sel_relief" onchange="saveValue(this);" required>
            <option value="">--ত্রাণের ধরণ--</option>
              <?php
                $sql = "SELECT * FROM relief_types";
                $q = $pdo->query($sql);
                $q->setFetchMode(PDO::FETCH_ASSOC);
                while($row = $q->fetch() ){
                  $relief_id = $row['id'];
                  $relief_name = $row['name'];
                  // Option
                  echo "<option value='".$relief_id."' >".$relief_name."</option>";
                }
              ?>
            </select>
          </div>

          <div class="form-group">
            <label for="yearInputEmail1">অর্থ বছর:</label>
            <select name="serviceFCYear" class="custom-select mr-sm-2" id="sel_fiscal" onchange="saveValue(this);" required>
              <option value="২০১৯-২০২০">২০১৯-২০২০</option>
              <option value="২০১৮-২০১৯">২০১৮-২০১৯</option>
              <option value="২০১৭-২০১৮">২০১৭-২০১৮</option>
            </select>
          </div>

          <div class="form-group">
            <label for="age">বয়স</label>
            <input type="number" name="age" class="form-control" id="age" aria-describedby="ageHelp" placeholder="ত্রাণগ্রহীতার বয়স" onkeyup="saveValue(this);" onClick="this.select();" required>
            <small id="ageHelp" class="form-text text-muted">ত্রাণ গ্রহীতার বয়স (উর্ধ্বসীমা অনুযায়ী) লিখুন। উদাহরনঃ বয়স ৩৩ বছর ৪ মাস হলে; ৩৪ লিখুন।</small>
          </div>

          <div class="form-group">
            <label for="genderInput">ত্রাণগ্রহীতার ধরণ:</label>
            <select name="sel_gender" class="custom-select mr-sm-2" id="sel_gender" onchange="saveValue(this);" required>
            <option value="">--ত্রাণগ্রহীতার ধরণ নির্বাচন করুন--</option>
              <option value="1">পুরুষ</option>
              <option value="0">মহিলা</option>
            </select>
          </div>

          <div class="form-group text-right">
            <button type="submit" class="btn btn-primary">সংরক্ষণ</button>
          </div>
        </form>

        <div class="serviceDetails"></div>
      </div>
    </div>
  </div>
</section>
<?php include('footer.php'); ?>
