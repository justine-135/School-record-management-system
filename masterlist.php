<?php 
// if (empty($_SESSION['username'])) {
//   header("Location: ./login.php");
// }
?>

<?php include "partials/header.php"; ?>

<?php $header = "/masterlist"; ?>
<?php $view="masterlist"; ?>
<?php $h4="Masterlist"; ?>

<?php include "partials/nav.php"; ?>

<?php
if (empty($_SESSION['username']) && empty($_SESSION['account_id'])) {
  header("Location: ./login.php");
}
?>

<main class="container-fluid w-90 border mt-4 p-0 bg-white <?= $view ?>">
  <div>
    <div>
      <h5 class="border-bottom p-3 mb-0">Enrolled</h5>
    </div>
  </div>
    <div class="p-2 d-flex align-items-center">
      <?php require $_SERVER['DOCUMENT_ROOT'].'/sabanges/partials/nav_filter_student.php'; ?>
    </div>
    <div class="table-responsive <?= $view ?>-table min-vh-100">
      <?php
      require $_SERVER['DOCUMENT_ROOT'].'/sabanges/includes/student.inc.php';
      ?>
    </div>
</main>

<?php require $_SERVER['DOCUMENT_ROOT'].'/sabanges/partials/footer.php'; ?>

<script src="js/masterlist.js"></script>
