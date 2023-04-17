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
        <main>
            <div class="row bg-light">
                <div class="col-md-8 p-0 bg-login">
                    <h1 class="m-2">Sabang Elementary School</h1>
                </div>
                <div class="col-md-4 p-5 bg-light login-form">
                    <div class="bg-white border">
                        <h3 class="border-bottom p-3">Teacher/Admin Login</h3>
                        <form class="p-3" action="./includes/teachers.inc.php" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="username-email" class="form-label fw-semibold">Username</label>
                                <input type="text" class="form-control" name="username" id="username-email" placeholder="Enter username or email ...">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password ...">
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="form-control btn btn-primary" name="login" id="password" value="Login">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>  
    </body>
</html>