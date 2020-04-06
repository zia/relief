<?php include('header.php'); ?>

    <section class="inputform">
      <div class="container">
      <div class="row">
      <div class="col-md-6">
      <form class="serviceEntry inputForm">
        <div class="form-group">
          <label for="NID">এনআইডি</label>
          <input type="number" name="nid" class="form-control" id="nid" aria-describedby="emailHelp" placeholder="ন্যাশনাল আইডি নং দিন।">
          <small id="emailHelp" class="form-text text-muted">১০ অথবা ১৭ সংখ্যার এনাইডি লিখুন</small>
        </div>
        <div class="form-group">
          <label for="mobile">মোবাইল</label>
          <input type="number" name="mobile" class="form-control" id="mobile" aria-describedby="emailHelp" placeholder="মোবাইল নম্বর লিখুন।">
          <small id="emailHelp" class="form-text text-muted">১১ ডিজিটের মোবাইল নম্বর লিখুন</small>
        </div>
        <div class="form-group">
          <label for="fullName">পুরো নাম</label>
          <input type="text" name="fullName" class="form-control" id="fullName" aria-describedby="emailHelp" placeholder="পুরো নাম লিখুন।" autocomplete="off">
        </div>



        <div class="form-group">
          <label for="typeInputEmail1">ইউনিয়ন</label>
          <select name="unionp" class="custom-select mr-sm-2" id="sel_depart" >
            <option value="">--ইউনিয়ন পরিষদ--</option>
            <?php 
              require_once('config.php');
              // Check if exit
              $sql = "SELECT * FROM unionpori";
              $q = $pdo->query($sql);
              $q->setFetchMode(PDO::FETCH_ASSOC);
              var_dump($row);
              while($row = $q->fetch() ){
                  
                    $union_id = $row['id'];
                    $union_name = $row['union_name'];
                    
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
          <label for="typeInputEmail1">রিলিফের ধরন</label>
          <select name="serviceType" class="custom-select mr-sm-2" id="inlineFormCustomSelect" required>
            <option value="Corona Relief">করোনা রিলিফ</option>
            <option value="Tin">টিন</option>
            <option value="Solar">সোলার</option>
            <option value="VGF">ভিজিএফ</option>
            <option value="Blanket">কম্বল</option>
          </select>
        </div>
        <div class="form-group">
          <label for="yearInputEmail1">অর্থ বছর:</label>
          <select name="serviceFCYear" class="custom-select mr-sm-2" id="inlineFormCustomSelect" required>
            <option value="2019-2020">২০১৯-২০২০</option>
            <option value="2018-2019">২০১৮-২০১৯</option>
            <option value="2017-2018">২০১৭-২০১৮</option>
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
