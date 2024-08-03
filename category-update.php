<?php
require "./db/db.php";
$errors = [];
// print_r($_POST);
// die();
if (isset($_POST['edit-category'])) {
    $id = $_POST['categoryId'];
    $name = $_POST['name'];
 
    empty($name) ? $errors[] = "name required..." : "";

    if (count($errors) === 0) {
        $updateqry = "UPDATE category SET name=:name WHERE category_id=:category_id";
        $statement = $pdo->prepare($updateqry);
        $statement->bindParam(":name", $name, PDO::PARAM_STR);
        $statement->bindParam(":category_id", $id, PDO::PARAM_STR);
        $res = $statement->execute();
        if ($res) {
            header("location:admin-dashboard.php");
        } else {
            $errors[] = "Something wrong!";
        }
    } else {
        $errors = ['U must fill all input'];
    }
}
// require "./partials/error.php";
foreach ($errors as $key => $err) {
    echo $err . "<br>";
}