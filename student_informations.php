<?php include "partials/header.php"; ?>

<?php $header = "/student-informations"; ?>
<?php $view="student-informations"; ?>

<?php include "partials/nav.php"; ?>
<?php include 'partials/alert.php'; ?>

<?php
$_SESSION['page_permission'] = 'teacher';
include './includes/session.inc.php';
include './includes/permission.inc.php';
?>

<main class="container-fluid w-90 mt-4 p-0 bg-white <?= $view ?>">
<?php include 'includes/student.inc.php'; ?>
</main>
<?php require $_SERVER['DOCUMENT_ROOT'].'/sabanges/partials/footer.php'; ?>

<script src="js/student_informations.js"></script>
