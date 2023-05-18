<?php include "partials/header.php"; ?>

<?php $header = "/operations_grading"; ?>
<?php $view = "operations_grading"; ?>

<?php include "partials/nav.php"; ?>

<?php include './partials/alert.php'; ?>

<?php
if (empty($_SESSION['username']) && empty($_SESSION['account_id'])) {
  header("Location: ./login.php");
}
?>

<?php include './partials/schedule_modal.php'; ?>

<main class="container-fluid w-90 mt-4 ">
  <?php include './partials/nav_operation_tabs.php'; ?>
  <div class="p-2 border border-top-0">
    <div class="d-flex align-items-center justify-content-between">
      <h5>Schedule grading period</h5>
      <button type="button" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#scheduleModal">
      Schedule
      <?php require './partials/add_icon.php' ?>
      </button>                
    </div>
    <div>
      <?php include './partials/nav_filter_operations.php'; ?>
    </div>
    <?php include './includes/operations.inc.php'; ?>
  </div>
</main>