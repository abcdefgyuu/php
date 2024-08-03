<?php
require "./db/db.php";
$errors = [];
// print_r($_POST);
// die();
if (isset($_POST['edit'])) {
    $id = $_POST['userId'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $oldphoto = $_POST['oldphoto'];
    $pname = $_FILES['photo']['name'];
    $tmpname = $_FILES['photo']['tmp_name'];
    if ($pname) {
        move_uploaded_file($tmpname, "gallery/$pname");
    } else {
        $pname = $oldphoto;
    }
    empty($name) ? $errors[] = "name required..." : "";
    empty($email) ? $errors[] = "email required..." : "";
    empty($phone) ? $errors[] = "phone required..." : "";
    empty($gender) ? $errors[] = "gender required..." : "";
    empty($address) ? $errors[] = "address required..." : "";
    empty($pname) ? $errors[] = "photo required..." : "";
    if (count($errors) === 0) {
        $updateqry = "UPDATE users SET name=:name ,phone=:phone,gender=:gender, email=:email, address=:address , photo=:photo WHERE user_id=:user_id";
        $statement = $pdo->prepare($updateqry);
        $statement->bindParam(":name", $name, PDO::PARAM_STR);
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->bindParam(":phone", $phone, PDO::PARAM_STR);
        $statement->bindParam(":gender", $gender, PDO::PARAM_STR);
        $statement->bindParam(":address", $address, PDO::PARAM_STR);
        $statement->bindParam(":photo", $pname, PDO::PARAM_STR);
        $statement->bindParam(":user_id", $id, PDO::PARAM_STR);
        $res = $statement->execute();
        if ($res) {
            header("location:admin-dashboard.php");
        } else {
            $errors[] = "Something wrog!";
        }
    } else {
        $errors = ['U must fill all input'];
    }
}
// require "./partials/error.php";
foreach ($errors as $key => $err) {
    echo $err . "<br>";
}