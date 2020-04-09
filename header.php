<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/b-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/sp-1.0.1/datatables.min.css"/>
    <link href="css/main.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
  </head>

  <body>
    <header class="container d-print-none">
        <ul class="menu">
          <li><a href="index.php">নীড় পাতা</a></li>
          <li><a href="serviceadd.php">সেবা গ্রহীতা সংযোজন</a></li>
          <li><a href="#">তালিকা দেখুন</a>
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
          <li><a href="logout.php">লগআউট</a></li>
        </ul>
      </header>