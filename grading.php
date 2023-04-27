<?php include "partials/header.php"; ?>

<?php $header = "/grading"; ?>
<?php $view="grading"; ?>
<?php $h4="Grading"; ?>

<?php include "partials/nav.php"; ?>
<?php include 'partials/alert.php'; ?>


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

<script src="js/grading.js"></script>