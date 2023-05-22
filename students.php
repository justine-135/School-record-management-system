<?php include "partials/header.php"; ?>

<?php $header = "/all_students"; ?>
<?php $view = "all_students"; ?>

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
      <h5>All students</h5>              
    </div>
    <div>
      <?php include './partials/nav_filter_student.php'; ?>
    </div>
    <?php
      require $_SERVER['DOCUMENT_ROOT'].'/sabanges/includes/student.inc.php';
      ?>
  </div>
</main>