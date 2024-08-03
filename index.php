<?php
session_start();
include "./db/db.php";
include "./partials/header.php";
include "./partials/navbar.php";
include "./partials/carousel.php";
?>

<main>
  <h1 class="text-center">Welcome <?= $_SESSION['name'] ?? 'Home' ?></h1>
  <div class="d-flex flex-wrap m-5">
  <?php

  $fquery = 'select * from products where is_featured=1 LIMIT 8';
  $s = $pdo->prepare($fquery);
  $s->execute();
  $fi = $s->fetchAll();
  foreach ($fi as $key => $fitem) { ?>
 
      <div class="card m-5" style="width: 18rem;">
        <img src="gallery/<?= $fitem['photo'];?>" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title"><?= $fitem['name']; ?></h5>
          <p class="card-text">$ <?= $fitem['price']; ?></p>
          <p class="card-text"><?= $fitem['description']; ?></p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
   

  <?php } ?>
  </div>
  <hr>
  <div class="d-flex flex-wrap m-5">
  <?php

  $query = 'select * from products';
  $statement = $pdo->prepare($query);
  $statement->execute();
  $items = $statement->fetchAll();
  foreach ($items as $key => $item) { ?>
 
      <div class="card m-5" style="width: 18rem;">
        <img src="gallery/<?= $item['photo'];?>" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title"><?= $item['name']; ?></h5>
          <p class="card-text">$ <?= $item['price']; ?></p>
          <p class="card-text"><?= $item['description']; ?></p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
   

  <?php } ?>
  </div>
</main>
<?php include "./partials/footer.php" ?>