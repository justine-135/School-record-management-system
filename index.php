<?php include "partials/header.php"; ?>

<?php $header = "/"; ?>

<?php include "partials/nav.php"; ?>

<?php
include './includes/session.inc.php';
?>

<main class="container-fluid w-90 border mt-4 p-0 bg-white">
  <div class="p-2 border-bottom">
    <h5>Welcome <?= ucfirst($_SESSION['surname']) . ', ' . ucfirst($_SESSION['first_name']) . ' ' . ucfirst($_SESSION['middle_name']); ?></h5>
  </div>
  <p class="">Welcome to homepage</p>
</main>
<?php require $_SERVER['DOCUMENT_ROOT'].'/sabanges/partials/footer.php'; ?>
