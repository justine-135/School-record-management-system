<?php include "partials/header.php"; ?>

<?php 
if (!empty($_SESSION['username']) && !empty($_SESSION['account_id'])) {
  header("Location: ./index.php");
}
?>

<div class="d-flex align-items-center justify-content-center">
    <div class="bg-white border mt-4 w-25">
        <h4 class="border-bottom p-3">Login</h4>
        <form class="" action="./includes/teachers.inc.php" method="post" enctype="multipart/form-data">
            <div class="mb-3 px-3">
                <label for="username-email" class="form-label fw-semibold">Username</label>
                <input type="text" class="form-control" name="username" id="username-email" placeholder="Enter username or email ...">
                <div id="emailHelp" class="form-text">*Default username is: (lastname12345).</div>

            </div>
            <div class="mb-3 px-3">
                <label for="password" class="form-label fw-semibold">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password ...">
                <div id="emailHelp" class="form-text">*Default password is date of birth.</div>
            </div>
            <hr>
            <div class="mb-3 px-3">
                <input type="submit" class="form-control btn btn-primary" name="login" id="password" value="Login">
            </div>
            <div class="mb-3 px-3 text-center">
                <a href="change_password.php">Change password</a>
            </div>
        </form>
    </div>
</div>
