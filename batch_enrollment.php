<?php include "partials/header.php"; ?>

<?php $header = "/enrollment"; ?>
<?php $view="batch_enrollment"; ?>

<?php include "partials/nav.php"; ?>

<?php include './partials/alert.php'; ?>

<?php
if (empty($_SESSION['username']) && empty($_SESSION['account_id'])) {
  header("Location: ./login.php");
}
?>

<main class="container-fluid w-90 mt-4 ">
  <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="enrollment.php">New student</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="batch_enrollment.php">Batch enrollment</a>
        </li>
    </ul>
    <form class="border border-top-0 p-3 bg-white mb-3" action="./includes/enrollment.inc.php" method="post" enctype="multipart/form-data">
    <?php
        require $_SERVER['DOCUMENT_ROOT'].'/sabanges/includes/student.inc.php';
    ?>      
    </form>
</main>

<script src="js/batch_enrollment.js"></script>
