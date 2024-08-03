<?php include './db/db.php';
include "./partials/header.php";
include "./partials/navbar.php"; ?>
<?php 
$errors=[];

if(isset($_POST['register'])){
 $name=trim($_POST['name']);
 $email=trim($_POST['email']);
 $password=password_hash($_POST['password'],PASSWORD_BCRYPT);
 $gender=$_POST['gender'];
 $address=$_POST['address'];
 $phone=$_POST['phone'];
 $inputPhoto=$_FILES['photo']['name'];
 $tmpName=$_FILES['photo']['tmp_name'];
 move_uploaded_file($tmpName,"gallery/$inputPhoto");

 empty($name)?$errors[]='Name require':'';
 empty($email)?$errors[]='Email require':'';
 empty($password)?$errors[]='Password require':'';
 empty($gender)?$errors[]='Gender require':'';
 empty($phone)?$errors[]='Phone require':'';
 empty($inputPhoto)?$errors[]='Photo require':'';
 empty($address)?$errors[]='Address require':'';

 if(count($errors)===0){
  $emailCheckQuery='select * from users where email=:email';
  $s=$pdo->prepare($emailCheckQuery);
  $s->bindParam(':email',$email,PDO::PARAM_STR);
  $s->execute();
  $res=$s->fetch();
  
  if($res){
    echo 'Email Already Exit';
  }
  else{
    $query="insert into users(name,email,password,phone,photo,gender,address) values(:name,:email,:password,:phone,:photo,:gender,:address)";
$statement=$pdo->prepare($query);

$statement->bindParam(":name",$name,PDO::PARAM_STR);
$statement->bindParam(":email",$email,PDO::PARAM_STR);
$statement->bindParam(":password",$password,PDO::PARAM_STR);
$statement->bindParam(":phone",$phone,PDO::PARAM_STR);
$statement->bindParam(":photo",$inputPhoto,PDO::PARAM_STR);
$statement->bindParam(":gender",$gender,PDO::PARAM_STR);
$statement->bindParam(":address",$address,PDO::PARAM_STR);

if($statement->execute()){
  header('location:login.php');
}
else{
  echo 'Something Wrong!!';
}
  }
 }
}

// include"./partials/carousel.php";
?>

<div class="w-50 m-auto my-5">
  <form action="register.php" method="post" enctype="multipart/form-data" class="shadow-lg p-5">
    <?php include './error.php'?>
    <h2 class="text-center">Register Here</h2>
    <input type="text" name="name" placeholder="Name..." class="form-control mb-3">
    <input type="email" name="email" placeholder="Email..." class="form-control mb-3">
    <input type="password" name="password" placeholder="Password..." class="form-control mb-3">
    <div class="d-flex gap-3 mb-3">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="gender" id="male">
        <label class="form-check-label" for="male">
          Male
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="gender" id="male" checked>
        <label class="form-check-label" for="male">
          Female
        </label>
      </div>
    </div>
    <div class="mb-3">
        <label for="formFile" class="form-label" accept="image/*">Photo</label>
        <input class="form-control" type="file" id="formFile" name="photo">
      </div>
      <div class="mb-3">
        <label for="">Address</label>
        <textarea name="address" id="" rows="3" class="form-control mb-3"></textarea>
      </div>
      <input type="text" name="phone" placeholder="Phone..." class="form-control mb-3">
      <input type="submit" class="btn btn-primary" name="register">
  </form>
</div>
<?php include "./partials/footer.php" ?>