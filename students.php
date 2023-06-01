<?php include "partials/header.php"; ?>

<?php $header = "/all_students"; ?>
<?php $view = "all_students"; ?>

<?php include "partials/nav.php"; ?>

<?php include './partials/alert.php'; ?>

<?php
$_SESSION['page_permission'] = 'teacher';
include './includes/session.inc.php';
include './includes/permission.inc.php';
?>

<main class="container-fluid w-90 mt-4 mb-5 ">
  <?php include './partials/nav_records_tabs.php'; ?>
  <div class="p-2 border border-top-0">
    <div>
      <?php include './partials/nav_filter_student.php'; ?>
    </div>
    <?php
      require $_SERVER['DOCUMENT_ROOT'].'/sabanges/includes/student.inc.php';
      ?>
  </div>
</main>