<?php include "partials/header.php"; ?>

<?php $header = "/enrollment"; ?>
<?php $view="batch_enrollment"; ?>

<?php include "partials/nav.php"; ?>

<?php include './partials/alert.php'; ?>

<?php
$_SESSION['page_permission'] = 'guidance';
include './includes/session.inc.php';
include './includes/permission.inc.php';
?>

<main class="container-fluid w-90 mt-4 mb-5 ">
    <?php include './partials/nav_enrollment_tabs.php'; ?>
    <form class="border border-top-0 p-3 bg-white mb-3" action="./includes/enrollment.inc.php" method="post" enctype="multipart/form-data">
    <?php
        require $_SERVER['DOCUMENT_ROOT'].'/sabanges/includes/enrollment.inc.php';
    ?>      
    </form>
</main>

<script src="js/batch_enrollment.js"></script>
