<?php
date_default_timezone_set('Asia/Dhaka');
// $pdo = new PDO('mysql:host=localhost;dbname=regpio; charset=utf-8', "root", "ag39tcPO60@", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")); // Here PDO is super object something like obj.obj.method()

$servername = "127.0.0.1";  //localhost
$dbname = "regpio";
$username = "root";
$password = "ag39tcPO60@";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die("Connection Failed!");
}