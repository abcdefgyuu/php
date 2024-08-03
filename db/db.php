<?php
require "./db/config.php";
$dsn="mysql:host=$host;dbname=$dbname;charset=UTF8";
try{
  $pdo=new pdo($dsn,$user,$password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  // if($pdo){
  //   echo "db is connected";
  // }
}
catch (PDOException $e){
  echo $e->getMessage();
}