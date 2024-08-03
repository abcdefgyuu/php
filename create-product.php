<?php include './db/db.php';
include "./partials/header.php";
// include "./partials/navbar.php"; 
?>
<?php
$errors = [];

$queryCate = "select * from category";
$st = $pdo->prepare($queryCate);
$st->execute();
$categories = $st->fetchAll();


if (isset($_POST['add'])) {
  $name = ($_POST['name']);
  $desc = ($_POST['desc']);
  $price = $_POST['price'];
  $mkFeature = $_POST['mk-feature'];
  $inputPhoto = $_FILES['photo']['name'];
  $tmpName = $_FILES['photo']['tmp_name'];
  move_uploaded_file($tmpName, "gallery/$inputPhoto");

  empty($name) ? $errors[] = 'Name require' : '';
  empty($desc) ? $errors[] = 'Description require' : '';
  empty($price) ? $errors[] = 'Price require' : '';
  empty($inputPhoto) ? $errors[] = 'Photo require' : '';
  empty($mkFeature) ? $mkFeature = "0"  : $mkFeature;

  if (count($errors) === 0) {
    $query = "insert into products(name,description,price,photo,featured) values(:name,:desc,:price,:photo,:featured)";
    $statement = $pdo->prepare($query);

    $statement->bindParam(":name", $name, PDO::PARAM_STR);
    $statement->bindParam(":desc", $desc, PDO::PARAM_STR);
    $statement->bindParam(":price", $price, PDO::PARAM_STR);
    $statement->bindParam(":photo", $inputPhoto, PDO::PARAM_STR);
    $statement->bindParam(":featured", $mkFeature, PDO::PARAM_STR);

    if ($statement->execute()) {
      header('location:admin-dashboard.php');
    } else {
      echo 'Something Wrong!!';
    }
  }
}
// include"./partials/carousel.php";
?>

<div class="w-50 m-auto my-5">
  <form action="#" method="post" enctype="multipart/form-data" class="shadow-lg p-5">
    <?php include './error.php' ?>
    <h2 class="text-center">Create Product</h2>
    <select class="form-select mb-3" aria-label="Default select example">
      <option selected>Select Category Name</option>

      <?php foreach ($categories as $key => $category) : ?>
        <option value="<?= $category['category_id'] ?>"><?= $category['name'] ?></option>
      <?php endforeach ?>
    </select>
    <input type="text" name="name" placeholder="Name..." class="form-control mb-3">
    <input type="text" name="desc" placeholder="Description..." class="form-control mb-3">
    <input type="text" name="price" placeholder="Price..." class="form-control mb-3">

    <div class="d-flex gap-3 mb-3">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="mk-feature" id="make" value="1">
        <label class="form-check-label" for="make">
          Make Feature
        </label>
      </div>
    </div>
    <div class="mb-3">
      <label for="formFile" class="form-label" accept="image/*">Photo</label>
      <input class="form-control" type="file" id="formFile" name="photo">
    </div>

    <input type="submit" class="btn btn-primary" name="add" value="Add">
  </form>
</div>
<?php include "./partials/footer.php" ?>