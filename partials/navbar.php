<?php
$auth = isset($_SESSION['name']);
$isAdmin=isset($_SESSION['admin']);
?>

<nav class="navbar navbar-expand-lg navbar-light bg-primary py-4 px-3">
  <div class="container-fluid">
    <a class="navbar-brand text-white mb-2" href="#">MyStore</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="about.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="products.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="service.php">Service</a>
        </li>
        <li class="nav-item dropdown  d-flex align-items-center">
          <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            
            <?php if ($auth) : ?>
              <?= $_SESSION['name'] ?>
              <img src="gallery/<?php echo $_SESSION['photo']?>" class="rounded-circle" width="30px" height="30px">
            <?php else : ?>
              Guest
              <img src="gallery/dummy.png" class="rounded-circle" width="30px" height="30px">
            <?php endif; ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php if ($auth) : ?>
              <li><a class="dropdown-item" href="logout.php">Logout</a></li>

            <?php else : ?>
              <li><a class="dropdown-item" href="login.php">Login</a></li>
              <li><a class="dropdown-item" href="register.php">Register</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>

            <?php endif; ?>
          </ul>
        </li>

      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-white text-white" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>