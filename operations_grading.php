<?php include "partials/header.php"; ?>

<?php $header = "/operations_grading"; ?>
<?php $view = "operations_grading"; ?>

<?php include "partials/nav.php"; ?>

<?php include './partials/alert.php'; ?>

<?php
$_SESSION['page_permission'] = 'admin';
include './includes/session.inc.php';
include './includes/permission.inc.php';
?>

<?php include './partials/schedule_modal.php'; ?>

<main class="container-fluid w-90 mt-4 mb-5 ">
  <?php include './partials/nav_operation_tabs.php'; ?>
  <div class="p-2 border border-top-0">
    <div class="d-flex align-items-center justify-content-between">
             
    </div>
    <div>
      <?php include './partials/nav_filter_operations.php'; ?>
    </div>
    <?php include './includes/operations.inc.php'; ?>
  </div>
</main>