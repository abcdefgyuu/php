<?php
session_start();
include "./partials/header.php";
include "./partials/navbar.php";
include "./db/db.php";

$errors = [];

if (isset($_POST['login'])) {
  $email = trim($_POST['email']);
  $password = $_POST['password'];

  empty($email) ? $errors[] = 'Email require' : '';
  empty($password) ? $errors[] = 'Password require' : '';

  if (count($errors) === 0) {
    $emailCheckQuery = 'select * from users where email=:email';
    $s = $pdo->prepare($emailCheckQuery);
    $s->bindParam(':email', $email, PDO::PARAM_STR);
    $s->execute();
    $res = $s->fetch();
    // print_r($res);
    // die();

    if ($email === 'admin@admin.com' && password_verify($password, $res['password']) && $res['role']===1) {
      $_SESSION['admin']='admin';
      $_SESSION['adminName']='admin';
      header('location:admin-dashboard.php');
    }
    else{
      if ($res) {
        if (password_verify($password, $res['password']) && $email == $res['email']) {
          $_SESSION['name'] = $res['name'];
          $_SESSION['photo'] = $res['photo'];
          header('location:index.php');
        } else {
          $errors[] = 'email and password do not match';
        }
      } else {
        $errors[] = "Email not exit";
      }
    }
   
  }
}
// include"./partials/carousel.php";
?>

<div class="w-50 m-auto p-5">
  <?php include './error.php' ?>
  <form action="login.php" method="post">
    <h2 class="text-center">Login Here</h2>
    <label for="email">Email</label>
    <input type="email" name="email" id="email" class="form-control mb-3">
    <label for="pwd">Password</label>
    <input type="password" name="password" id="pwd" class="form-control mb-3">
    <button class="btn btn-primary" name="login">Login</button>
  </form>
</div>
<?php include "./partials/footer.php" ?>