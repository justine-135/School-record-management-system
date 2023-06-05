<?php include "partials/header.php"; ?>

<?php $header = "/teacher-informations"; ?>
<?php $view="teacher-informations"; ?>

<?php include "partials/nav.php"; ?>
<?php include 'partials/alert.php'; ?>

<?php
$_SESSION['page_permission'] = 'admin';
include './includes/session.inc.php';
include './includes/permission.inc.php';
?>

<main class="container-fluid w-90 mt-4 mb-5 p-0 bg-white <?= $view ?>">
<?php include 'includes/teachers.inc.php'; ?>
</main>
<?php require $_SERVER['DOCUMENT_ROOT'].'/sabanges/partials/footer.php'; ?>
<script src="js/account_informations.js"></script>
