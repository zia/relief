<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title> ঃঃআরডিএস সিস্টেমঃঃ</title>
    <!-- add icon link -->
    <link rel = "icon" href = "./images/logo.png" type = "image/x-icon" />

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/fonts.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="css/datatables.min.css"/>
    <link href="css/main.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-light bg-light">

      <a class="navbar-brand" onclick="openNav()">
        <img style="max-width:35px; max-height:35px; margin-top: -7px;" src="./images/logo.png"> উপজেলা প্রশাসন, দশমিনা, পটুয়াখালী
        <!-- <img style="max-width:35px; max-height:35px; margin-top: -7px;" src="./images/logo.png"> আরডিএস, পটুয়াখালী-১১৩ -->
      </a>

      <div class="navbar-collapse justify-content-end">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="index.php">নীড় পাতা</a>
          </li>
          <li class="nav-item">
            <a href="serviceadd.php">সেবা গ্রহীতা সংযোজন</a>
          </li>
          <li class="nav-item">
            <a href="#">তালিকা দেখুন</a>
            <ul class="dropdown-menu">
            <?php
              require_once 'config.php';
              $results = $pdo->prepare("SELECT * FROM unions");
              $results->execute();
              $unions = $results->fetchAll(PDO::FETCH_ASSOC);
              foreach($unions as $union) {
                echo '<li class="dropdown-item"><a href="showData.php?union='.$union['id'].'">'.$union['name'].'</a></li>';
              }
            ?>
            </ul>
          </li>
          <li class="nav-item">
            <a href="logout.php">লগআউট</a>
          </li>
        </ul>
      </div>
    </nav>
    <?php
      session_start();
      // Only super user
      if($_SESSION["role"] == 1) {
    ?>
      <div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="#">Users</a>
        <a href="#">Emg Relief Req's</a>
        <a href="#">Volunteers</a>
        <a href="#">Inventory</a>
        <a href="#">Officials</a>
      </div>
    <?php } ?>