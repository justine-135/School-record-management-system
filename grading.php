<?php include "partials/header.php"; ?>

<?php $header = "/grading"; ?>
<?php $view = "grading"; ?>

<?php include "partials/nav.php"; ?>

<?php include './partials/alert.php'; ?>

<?php
$_SESSION['page_permission'] = 'teacher';
include './includes/session.inc.php';
include './includes/permission.inc.php';
?>

<main class="container-fluid w-90 mt-4 mb-5 ">
  
<!-- <div class="toast-container position-absolute toast-grading">
  <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <strong class="me-auto">Notification</strong>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      <strong>GRADING PERIOD IS CLOSED!</strong>
    </div>
  </div>
</div> -->

  <?php include './partials/nav_records_tabs.php'; ?>
  <div class="p-2 border border-top-0">
    <div>
      <?php include './partials/nav_filter_student.php'; ?>
    </div>
    <?php
      require $_SERVER['DOCUMENT_ROOT'].'/sabanges/includes/student_grading.inc.php';
      ?>
  </div>
</main>

<script src="js/grading.js"></script>