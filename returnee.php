<?php include "partials/header.php"; ?>

<?php $header = "/returnee"; ?>
<?php $view = "returnee"; ?>

<?php include "partials/nav.php"; ?>

<?php include './partials/alert.php'; ?>

<?php
$_SESSION['page_permission'] = 'guidance';
include './includes/session.inc.php';
include './includes/permission.inc.php';
?>

<main class="container-fluid w-90 mt-4 ">
  <?php include './partials/nav_enrollment_tabs.php'; ?>
  <form class="border border-top-0 p-0 bg-white mb-3" action="./includes/enrollment.inc.php" method="post" enctype="multipart/form-data">
    <h5 class="border-bottom p-3">Search learner's reference number</h5>
      <div class="row g-3 p-3">
        <div class="col-md"></div>
            <div class="col-md-4">
                <label for="lrn" class="form-label">LRN</label>
                <div class="d-flex">
                    <input type="text" class="form-control me-1" name='lrn' id="lrn" placeholder="Enter learner reference number" name="lrn" value="<?= isset($_GET['lrn']) ? $_GET['lrn'] : "" ?>" required>
                    <input class="btn btn-primary" type="submit" name='search-lrn' value="Search">
                </div>
            </div>
            <div class="col-md">
            </div>
      </div>
      <?php
        require $_SERVER['DOCUMENT_ROOT'].'/sabanges/includes/enrollment.inc.php';
      ?> 
  </form>
  <div></div>
</main>

<script src="js/returnee.js"></script>