<?php 
// if (empty($_SESSION['username'])) {
//   header("Location: ./login.php");
// }
?>

<?php include "partials/header.php"; ?>

<?php $header = "/masterlist"; ?>
<?php $view="masterlist"; ?>
<?php $h4="Masterlist"; ?>

<?php include "partials/nav.php"; ?>

<?php
if (empty($_SESSION['username']) && empty($_SESSION['account_id'])) {
  header("Location: ./login.php");
}
?>

<main class="container-fluid w-90 border mt-4 p-4 bg-white <?= $view ?>">
  <h4 class=""><?= $h4 ?></h4>
  <div class="border mt-3">
    <div>
      <div>
        <h5 class="border-bottom p-3 mb-0">Enrolled</h5>
      </div>
      <div class="p-2 d-flex align-items-center justify-content-between">

        <?php require $_SERVER['DOCUMENT_ROOT'].'/sabanges/partials/search_student.php'; ?>

        <?php require $_SERVER['DOCUMENT_ROOT'].'/sabanges/partials/filter_active_students.php'; ?>

      </div>
    </div>
    <form class="" action="./includes/promotion_retention.inc.php" method="post" enctype="multipart/form-data">
      <div class=" ms-2 promotion-retention" role="group" aria-label="Basic mixed styles example">
        <button type="submit" value="promote" name="promote" class="btn btn-primary">Promote</button>
        <button type="submit" value="retian" name="retain" class="btn btn-danger">Retain</button>
      </div>
      <div class="table-responsive <?= $view ?>-table min-vh-100"></div>
    </form>
  </div>

</main>


<?php require $_SERVER['DOCUMENT_ROOT'].'/sabanges/partials/footer.php'; ?>

<script src="js/masterlist.js"></script>
