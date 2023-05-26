<?php include "partials/header.php"; ?>

<?php $header = "/"; ?>
<?php $view = "index"; ?>

<?php include "partials/nav.php"; ?>
<?php include './partials/alert.php'; ?>

<?php
include './includes/session.inc.php';
?>

<main class="container-fluid w-90 border mt-4 p-0 bg-white">
  <div class="d-flex justify-content-between align-items-center p-2 border-bottom">
    <h5>Welcome user # <?= $_SESSION['account_id']; ?></h5>
    <h6>Role: <?= $_SESSION['is_superadmin'] == 1 ? 'Superadmin' : ($_SESSION['is_admin'] == 1 ? 'Admin' : ($_SESSION['is_teacher'] == 1 ? 'Teacher' : ($_SESSION['is_guidance'] == 1 ? 'Guidance' : ($_SESSION['author'] == 1 ? 'Author' : 'None')))) ?></h6>
  </div>
  <div>
  <?php require $_SERVER['DOCUMENT_ROOT'].'/sabanges/includes/teachers.inc.php'; ?>
  </div>
</main>

<script src="js/index.js"></script>
<?php require $_SERVER['DOCUMENT_ROOT'].'/sabanges/partials/footer.php'; ?>
