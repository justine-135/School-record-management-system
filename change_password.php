<?php include "partials/header.php"; ?>

<?php 
if (!empty($_SESSION['username']) && !empty($_SESSION['account_id'])) {
  header("Location: ./index.php");
}
?>

<div class="d-flex align-items-center justify-content-center">
    <div class="bg-white border mt-4 w-25">
        <h4 class="border-bottom p-3">Change password</h4>
        <form class="" action="./includes/teachers.inc.php" method="post" enctype="multipart/form-data">
            <div class="mb-3 px-3">
                <label for="username-email" class="form-label fw-semibold">Email</label>
                <input type="email" class="form-control" name="username" id="username-email" placeholder="Enter email ...">
            </div>
            <div class="mb-3 px-3">
                <label for="password" class="form-label fw-semibold">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter new password ...">
            </div>
            <div class="mb-3 px-3">
                <label for="password" class="form-label fw-semibold">Re-type password</label>
                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Re-type new password ...">
                <div id="emailHelp" class="form-text">*Minimum character is eight (8).</div>
            </div>
            <hr>
            <div class="mb-3 px-3">
                <input type="submit" class="form-control btn btn-primary" name="change-password" id="submit" value="Submit">
            </div>
            <div class="mb-3 px-3">
                <a href="login.php" class="form-control btn btn-outline-primary" name="login" id="login" value="Login">Login</a>
            </div>
        </form>
    </div>
</div>
