<?php include "partials/header.php"; ?>

<?php $header = "/"; ?>

<?php include "partials/nav.php"; ?>

<?php
if (empty($_SESSION['username']) && empty($_SESSION['account_id'])) {
  header("Location: ./login.php");
}
?>

<main class="container-fluid w-90 border mt-4 p-4 bg-white">
  <h4>Home</h4>
  <p class="">Welcome to homepage</p>
</main>
<?php require $_SERVER['DOCUMENT_ROOT'].'/sabanges/partials/footer.php'; ?>
