<?php include "partials/header.php"; ?>

<?php $header = "/masterlist"; ?>
<?php $view="masterlist"; ?>
<?php $h4="Masterlist"; ?>

<?php include "partials/nav.php"; ?>

<main class="container-fluid w-90 border mt-4 p-4 bg-white <?= $view ?>">
<h4 class=""><?= $h4 ?></h4>
  <div class="border mt-3">
      <div>
        <div>
            <h5 class="border-bottom p-3 mb-0">Enrolled</h5>
        </div>
        <div class="p-2 d-flex align-items-center justify-content-between">
          <div class=" ms-2 promotion-retention" role="group" aria-label="Basic mixed styles example">
            <button type="button" class="btn btn-primary">Promote</button>
            <button type="button" class="btn btn-danger">Retain</button>
          </div>
          <?php require $_SERVER['DOCUMENT_ROOT'].'/sabanges/partials/search_student.php'; ?>
          <!-- <select class="form-select btn btn-primary" aria-label="Default select example">
            <option selected>Open this select menu</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select> -->
        </div>
      </div>
      <div class="table-responsive <?= $view ?>-table">
      </div>
  </div>
</main>

<script src="js/masterlist.js"></script>