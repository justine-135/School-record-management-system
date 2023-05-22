<?php include "partials/header.php"; ?>

<?php $header = "/grading"; ?>
<?php $view = "grading"; ?>

<?php include "partials/nav.php"; ?>

<?php include './partials/alert.php'; ?>

<?php
if (empty($_SESSION['username']) && empty($_SESSION['account_id'])) {
  header("Location: ./login.php");
}
?>

<main class="container-fluid w-90 mt-4 ">
  <?php include './partials/nav_records_tabs.php'; ?>
  <div class="p-2 border border-top-0">
    <div class="d-flex align-items-center justify-content-between">
      <h5>Grading</h5>              
    </div>
    <div>
      <?php include './partials/nav_filter_student.php'; ?>
    </div>
    <?php
      require $_SERVER['DOCUMENT_ROOT'].'/sabanges/includes/student_grading.inc.php';
      ?>
  </div>
</main>

<script src="js/grading.js"></script>