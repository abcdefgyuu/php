<?php include "./db/db.php";
$user_id=$_GET['id'];
// echo $user_id;

$query = 'select * from users where user_id=:user_id';
$statement=$pdo->prepare($query);
$statement->bindParam(':user_id',$user_id,PDO::PARAM_STR);
$statement->execute();
$res=$statement->fetch();
// echo "<pre>";
// print_r($res);

require "./partials/header.php";
require "./partials/navbar.php";
 ?>

<div class="w-50 m-auto my-5">
  <form action="user-update.php" method="post" enctype="multipart/form-data" class="shadow-lg p-5">

    <h2 class="text-center">Edit User</h2>
    <input type="hidden" name="userId" value="<?=$res['user_id']?>">
    <input type="text" name="name" value="<?=$res['name']?>" placeholder="Name..." class="form-control mb-3">
    <input type="email" name="email" placeholder="Email..." class="form-control mb-3" value="<?=$res['email']?>">
    <!-- <input type="password" name="password" placeholder="Password..." class="form-control mb-3"> -->
    <div class="d-flex gap-3 mb-3">
  
      <div class="form-check">
        <input class="form-check-input" type="radio" name="gender" id="male" <?= $res['gender']==='male'?"checked":""?> value="male">
        <label class="form-check-label" for="male">
          Male
        </label>
      </div>

            <div class="form-check">
        <input class="form-check-input" type="radio" name="gender" id="female" <?= $res['gender']==='female'?"checked":""?> value="female">
        <label class="form-check-label" for="female">
          Female
        </label>
      </div>
         
      <input type="hidden" name="oldphoto" value="<?= $res['photo'] ?>">
    <div  class="my-3">
      <img src="gallery/<?= $res['photo'] ?>" alt="" class="w-25">
    </div>

    </div>
    <div class="mb-3">
        <label for="formFile" class="form-label" accept="image/*">Photo</label>
        <input class="form-control" type="file" id="formFile" name="photo">
      </div>
      <div class="mb-3">
        <label for="">Address</label>
        <textarea name="address" id="" rows="3" class="form-control mb-3"><?=$res['address']?></textarea>
      </div>
      <input type="text" name="phone" placeholder="Phone..." class="form-control mb-3" value="<?=$res['phone']?>">
      <input type="submit" class="btn btn-primary" name="edit" value="Edit">
  </form>
</div>
