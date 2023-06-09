<?php include "partials/header.php"; ?>

<?php $header = "/promotion"; ?>
<?php $view = "promotion"; ?>

<?php include "partials/nav.php"; ?>

<?php include './partials/alert.php'; ?>

<?php
$_SESSION['page_permission'] = 'guidance';
include './includes/session.inc.php';
include './includes/permission.inc.php';
?>

<?php if (isset($_GET['id']) && isset($_GET['lrn'])) { ?>
<div class="modal fade" id="promotionResult" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="promotionResultLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="promotionResultLabel">Summary</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Successfully promoted <?= count($_GET['id']) ?> students: </p>
        <table class="table">
          <thead>
            <tr>
              <th>
                #
              </th>
              <th>
                Lrn
              </th>
              <th>
                Remark
              </th>
            </tr>
          </thead>
          <tbody>
            <?php for ($i=0; $i < count($_GET['id']); $i++) { ?>
            <tr>
              <td><?= $i + 1 ?></td>
              <td><?= $_GET['lrn'][$i]; ?></td>
              <td><?= $_GET['remark'][$i]; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php } ?>

<main class="container-fluid w-90 mt-4 mb-5 ">
  <?php include './partials/nav_records_tabs.php'; ?>
  <div class="p-2 border border-top-0">
    <form class="promotion-form" action="../sabanges/includes/promotion_retention.inc.php" method="post" enctype="multipart/form-data">
        <div>
        <?php include './partials/nav_filter_student.php'; ?>
        </div>
        <?php
        require $_SERVER['DOCUMENT_ROOT'].'/sabanges/includes/promotion_retention.inc.php';
        ?>
    </form>
</main>

<script src="js/promotion.js"></script>