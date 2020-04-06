<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
    <link href="css/main.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
  </head>
  <body>

  <header class="container d-print-none">
      <ul class="menu">
        <li><a href="index.php">নীড় পাতা</a></li>
        <li><a href="serviceadd.php">সেবা গ্রহীতা সংযজোন</a></li>
        <li><a href="#">তালিকা দেখুন</a>
        <ul class="dropdown-menu">
          <?php
            require_once 'config.php';
            $results = $pdo->prepare(  // $results PDO object statement hoye jay so later you can use $results as object
              "SELECT * FROM unionpori"
              );
              $results->execute();
              $unions = $results->fetchAll(PDO::FETCH_ASSOC);
              foreach($unions as $union) {
                echo '<li class="dropdown-item"><a href="showData.php?union='.$union['id'].'">'.$union['union_name'].'</a></li>';
              }
          ?>
          </ul>
        </li>
        <li><a href="logout.php">লগআউট</a></li>
      </ul>
    </header>