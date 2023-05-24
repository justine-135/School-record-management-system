<?php include "partials/header.php"; ?>

<?php $header = "/operations_subjects"; ?>
<?php $view = "operations_subjects"; ?>

<?php include "partials/nav.php"; ?>

<?php include './partials/alert.php'; ?>

<?php
$_SESSION['page_permission'] = 'author';
include './includes/session.inc.php';
include './includes/permission.inc.php';
?>

<?php include './partials/subjects_modal.php'; ?>

<main class="container-fluid w-90 mt-4 ">
  <?php include './partials/nav_operation_tabs.php'; ?>
  <div class="p-2 border border-top-0">
    <div class="d-flex align-items-center justify-content-between">
      <h5>Manage subjects</h5>
      <button type="button" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#subjectsModal">
      Add
      <?php require './partials/add_icon.php' ?>
      </button>                
    </div>
    <div>
      <?php include './partials/nav_filter_operations.php'; ?>
    </div>
    <?php include './includes/operations.inc.php'; ?>
  </div>
</main>

<script src="js/operations_subjects.js"></script>