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
            </div>
            <div class="mb-3 px-3">
                <label for="old-password" class="form-label fw-semibold">Old password</label>
                <input type="password" class="form-control" name="old-password" id="old-password" placeholder="Enter password ...">
            </div>
            <div class="mb-3 px-3">
                <label for="new-password" class="form-label fw-semibold">New password</label>
                <input type="password" class="form-control" name="new-password" id="new-password" placeholder="Enter password ...">
            </div>
            <div class="mb-3 px-3">
                <label for="retype-password" class="form-label fw-semibold">Re-type password</label>
                <input type="password" class="form-control" name="retype-password" id="retype-password" placeholder="Enter password ...">
            </div>
            <hr>
            <div class="mb-3 px-3">
                <input type="submit" class="form-control btn btn-primary" name="change" id="password" value="Change">
            </div>
            <div class="mb-3 px-3 text-center">
                <a href="login.php">Back</a>
            </div>
        </form>
    </div>
</div>
