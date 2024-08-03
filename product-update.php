<?php
require "./db/db.php";
$errors = [];
// print_r($_POST);
// die();
if (isset($_POST['edit-product'])) {
    $id = $_POST['productId'];
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];
    $oldphoto = $_POST['oldphoto'];
    $pname = $_FILES['photo']['name'];
    $tmpname = $_FILES['photo']['tmp_name'];
    if ($pname) {
        move_uploaded_file($tmpname, "gallery/$pname");
    } else {
        $pname = $oldphoto;
    }
    empty($name) ? $errors[] = "name required..." : "";
    empty($desc) ? $errors[] = "email required..." : "";
    if (count($errors) === 0) {
        $updateqry = "UPDATE products SET name=:name ,description=:desc,photo=:photo, price=:price WHERE product_id=:product_id";
        $statement = $pdo->prepare($updateqry);
        $statement->bindParam(":name", $name, PDO::PARAM_STR);
        $statement->bindParam(":desc", $desc, PDO::PARAM_STR);
        $statement->bindParam(":photo", $pname, PDO::PARAM_STR);
        $statement->bindParam(":price", $price, PDO::PARAM_STR);
        $statement->bindParam(":product_id", $id, PDO::PARAM_STR);
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