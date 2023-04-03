<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="./styles/style.css" />
    <link rel="shortcut icon" href="./images/logo.jpg" type="image/x-icon">
    <title>Sabang Elementary School</title>
  </head>
  <body>

  <nav class="navbar navbar-expand-lg navbar-white bg-white d-flex border-bottom">
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
              src="images/profile.png"
              height="35px"
              width="35px"
              alt=""
          />
          User account
          </a>

          <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <li><a class="dropdown-item" href="#">Logout</a></li>
          </ul>
      </div>
    </div>
  </nav>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
    
    <script src="js/form_validation.js"></script>
  </body>
</html>

