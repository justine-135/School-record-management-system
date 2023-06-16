<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/style.css" />
    <link rel="shortcut icon" href="./images/logo.jpg" type="image/x-icon">
    <title>Sabang Elementary School</title>
  </head>
  <body>

  <nav class="navbar navbar-expand-lg navbar-white bg-white d-flex w-100">
    <div class="container-fluid d-flex">
      <a class="navbar-brand me-auto text-dark" href="index.php">
          <img src="images/logo.jpg" height="50px" width="50px" alt="" />
          Sabang Elementary School
      </a>
      <div class="dropdown">
          <a
          class="btn dropdown-toggle"
          href="#"
          role="button"
          id="dropdownMenuLink"
          data-bs-toggle="dropdown"
          aria-expanded="false"
          >
          <img
              class="img-round"

              style="object-fit: cover;"
              src=<?= !empty($_SESSION['image']) ? 'data:image;base64,' . $_SESSION['image'] : 'images/profile.png' ?>
              height="35px"
              width="35px"
              alt=""
          />
          <?= empty($_SESSION['username']) || empty($_SESSION['account_id']) ? 'Please login' : $_SESSION['username'] ?>
          </a>

          <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <form action="./includes/teachers.inc.php" method="post" enctype="multipart/form-data">
              <?php if (empty($_SESSION['username']) || empty($_SESSION['account_id'])) { ?>
              <li><a class="dropdown-item" href="index.php">Login</a></li>
              <?php } else { ?>
              <li><button type="submit" class="dropdown-item" name="logout">Logout</button></li>
              <?php } ?>
            </form>
          </ul>
      </div>
    </div>
  </nav>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    
    <script src="js/form_validation.js"></script>
  </body>
</html>

