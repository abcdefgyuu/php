<?php include "./db/db.php";
$category_id=$_GET['id'];
// echo $user_id;

$query = 'select * from category where category_id=:category_id';
$statement=$pdo->prepare($query);
$statement->bindParam(':category_id',$category_id,PDO::PARAM_STR);
$statement->execute();
$res=$statement->fetch();
// echo "<pre>";
// print_r($res);

require "./partials/header.php";
// require "./partials/navbar.php";
 ?>

<div class="w-50 m-auto my-5">
  <form action="category-update.php" method="post" enctype="multipart/form-data" class="shadow-lg p-5">

    <h2 class="text-center">Edit Category</h2>
    <input type="hidden" name="categoryId" value="<?=$res['category_id']?>">
    <input type="text" name="name" value="<?=$res['name']?>" placeholder="Name..." class="form-control mb-3">
      
      <input type="submit" class="btn btn-primary" name="edit-category" value="Edit">
  </form>
</div>
