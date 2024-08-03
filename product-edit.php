<?php include "./db/db.php";
$product_id=$_GET['id'];
// echo $user_id;

$query = 'select * from products where product_id=:product_id';
$statement=$pdo->prepare($query);
$statement->bindParam(':product_id',$product_id,PDO::PARAM_STR);
$statement->execute();
$res=$statement->fetch();


$queryCate = "select * from category";
$st = $pdo->prepare($queryCate);
$st->execute();
$categories = $st->fetchAll();
// echo "<pre>";
// print_r($res);

require "./partials/header.php";
// require "./partials/navbar.php";
 ?>

<div class="w-50 m-auto my-5">
  <form action="product-update.php" method="post" enctype="multipart/form-data" class="shadow-lg p-5">

    <h2 class="text-center">Edit Product</h2>
    <input type="hidden" name="productId" value="<?=$res['product_id']?>">

    <select class="form-select mb-3" aria-label="Default select example">
      <?php foreach ($categories as $key => $category) : ?>
        <option selected value="<?= $category['category_id'] ?>"><?= $category['name'] ?></option>
      <?php endforeach ?>
    <input type="text" name="name" value="<?=$res['name']?>" placeholder="Name..." class="form-control mb-3">
    <input type="text" name="desc" placeholder="Email..." class="form-control mb-3" value="<?=$res['description']?>">
    <input type="text" name="price" placeholder="Email..." class="form-control mb-3" value="<?=$res['price']?>">
    <!-- <input type="password" name="password" placeholder="Password..." class="form-control mb-3"> -->
    <div class="d-flex gap-3 mb-3">
      <input type="hidden" name="oldphoto" value="<?= $res['photo'] ?>">
    <div  class="my-3">
      <img src="gallery/<?= $res['photo'] ?>" alt="" class="w-25">
    </div>

    </div>
    <div class="mb-3">
        <label for="formFile" class="form-label" accept="image/*">Photo</label>
        <input class="form-control" type="file" id="formFile" name="photo">
      </div>
      
      <input type="submit" class="btn btn-primary" name="edit-product" value="Edit">
  </form>
</div>
