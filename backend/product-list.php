<form action="create-product.php" method="post">
  <input type="submit" class="btn btn-primary" name="create-product" value="CREATE PRODUCT">
</form>
<div id="product" class="my-3">
  <h2 class="text-center">Product List</h2>
  <table class="table my-5">
    <thead>
      <tr>
        <th>Product ID</th>
        <th>Category</th>
        <th>Name</th>
        <th>Description</th>
        <th>Make Feature</th>
        <th>Price</th>
        <th>Photo</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $record_per_page = 3; // Number of items to display per page
      $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
      $start_page = ($page - 1) * $record_per_page;
      $user_qry = "SELECT * FROM products LIMIT :start_page,:record_per_page";
      $s = $pdo->prepare($user_qry);
      $s->bindParam(":start_page", $start_page, PDO::PARAM_INT);
      $s->bindParam(":record_per_page", $record_per_page, PDO::PARAM_INT);
      $s->execute();
      $res = $s->fetchAll(PDO::FETCH_ASSOC);

      foreach ($res as $key => $value) :
      ?>
        <!-- <!?php foreach ($res as $value) : ?> -->
        <tr>
          <td><?= $value['product_id']; ?></td>
          <?php
          $cid = $value['category_id'];
          $getCname = "SELECT * FROM categories where category_id=:category_id";
          $ss = $pdo->prepare($getCname);
          $ss->bindParam(":category_id", $cid, PDO::PARAM_STR);
          $ss->execute();
          $rs = $ss->fetch();
          ?>
          <td><?= $rs['name'] ?></td>
          <td><?= $value['name']; ?></td>
          <td><?= $value['description']; ?></td>
          <td>
            <?php echo $value['is_featured'] === 1 ? "Yes" : "No" ?>
          </td>
          <td><?= $value['price']; ?></td>
          <td><img src="gallery/<?= $value['photo'] ?? 'dummy.png' ?> " width="60px"></td>
          <td>
            <a href="product-edit.php?id=<?php echo $value['product_id'] ?>" class="btn btn-primary">Edit</a>
            <a href="delete.php?id=<?php echo $value['product_id'] ?>&tbname=products&tbid=product_id" class="btn btn-danger" onclick="alert('Are you sure')">Delete</a>
          </td>
        </tr>
      <?php endforeach ?>


    </tbody>
  </table>

  <div class="pagination m-auto " style="width: fit-content;">
    <?php
    $page_qry = "SELECT * FROM products ORDER BY product_id DESC";
    $page_res = $pdo->prepare($page_qry);
    $page_res->execute();
    $total_records = $page_res->rowCount();
    // print_r($total_records);
    // die();
    $total_pages = ceil($total_records / $record_per_page);
    echo '<div>';
    if ($page > 1) {
      echo '<a href="?page=' . ($page - 1) . '">Previous</a> ';
    }
    for ($i = 1; $i <= $total_pages; $i++) {
      if ($i === $page) {
        echo '<span>' . $i . '</span> ';
      } else {
        echo '<a href="?page=' . $i . '">' . $i . '</a> ';
      }
    }
    if ($page < $total_pages) {
      echo '<a href="?page=' . ($page + 1) . '">Next</a>';
    }
    echo '</div>';
    ?>
  </div>
</div>