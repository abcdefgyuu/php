<?php
require "./db/db.php";
$id=$_GET['id'];
$tbname=$_GET["tbname"];
$tbid=$_GET["tbid"];

function delete($tbname,$tbid,$id){
  global $pdo;
  $sql="DELETE FROM $tbname WHERE $tbid=:id";
  $s=$pdo->prepare($sql);
  $s->bindParam(":id",$id,PDO::PARAM_INT);
  $res=$s->execute();
  if($res){
    header("location:admin-dashboard.php");
  }
}

delete($tbname, $tbid, $id);