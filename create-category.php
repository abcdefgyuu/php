<?php include './db/db.php';
include "./partials/header.php";
// include "./partials/navbar.php"; 
?>
<?php
$errors = [];

if (isset($_POST['create'])) {
  $name = ($_POST['name']);

  empty($name) ? $errors[] = 'Name require' : '';

  if (count($errors) === 0) {
    $query = "insert into categories(name) values(:name)";
    $statement = $pdo->prepare($query);

    $statement->bindParam(":name", $name, PDO::PARAM_STR);

    if ($statement->execute()) {
      header('location:admin-dashboard.php');
    } else {
      echo 'Something Wrong!!';
    }
  }
}
// include"./partials/carousel.php";
?>

