<div class="container my-5">
  <div class="row">
    <div class="col-4">
      <form action="create-category.php" method="post">
        <div class="row mb-3">
          <h2 class="text-center mb-3">Create Category</h2>
          <div>
            <input type="text" name="name" class="form-control" id="inputEmail3" placeholder="Category Name...">
          </div>
        </div>
        <button type="submit" class="btn btn-primary" name="create">Create</button>
      </form>
    </div>
    <div class="col-6">
      <div id="user my-5">
        <h2 class="text-center">Category List</h2>
        <table class="table my-5">
          <thead>
            <tr>
              <th>No</th>
              <th>Name</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $record_per_page = 3; // Number of items to display per page
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
            $start_page = ($page - 1) * $record_per_page;
            $user_qry = "SELECT * FROM categories LIMIT :start_page,:record_per_page";
            $s = $pdo->prepare($user_qry);
            $s->bindParam(":start_page", $start_page, PDO::PARAM_INT);
            $s->bindParam(":record_per_page", $record_per_page, PDO::PARAM_INT);
            $s->execute();
            $res = $s->fetchAll(PDO::FETCH_ASSOC);

            foreach ($res as $key => $value) :
            ?>
              <!-- <!?php foreach ($res as $value) : ?> -->
              <tr>
                <td><?= $value['category_id']; ?></td>
                <td><?= $value['name']; ?></td>
                <td>
                  <a href="category-edit.php?id=<?php echo $value['category_id'] ?>" class="btn btn-primary">Edit</a>
                  <a href="delete.php?id=<?php echo $value['category_id'] ?>&tbname=category&tbid=category_id" class="btn btn-danger" onclick="alert('Are you sure')">Delete</a>
                </td>
              </tr>
            <?php endforeach ?>


          </tbody>
        </table>

        <div class="pagination m-auto " style="width: fit-content;">
          <?php
          $page_qry = "SELECT * FROM categories ORDER BY category_id DESC";
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
    </div>
  </div>
</div>