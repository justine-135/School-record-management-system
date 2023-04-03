<?php include "partials/header.php"; ?>

<?php $header = "/masterlist"; ?>
<?php $view="masterlist"; ?>

<?php include "partials/nav.php"; ?>

<main class="container-fluid w-90 border mt-4 p-4 bg-white masterlist">
<h4 class="">Masterlist</h4>
  <div class="border mt-3">
      <div>
        <div class="d-flex justify-content-between align-items-center pt-3 px-3 border-bottom">
            <h5>Enrolled</h5>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/sabanges/partials/search_student.php'; ?>
        </div>
      </div>
      <div class="table-responsive masterlist-table">
      </div>
  </div>
</main>

<script src="js/masterlist.js"></script>