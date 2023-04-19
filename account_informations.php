<?php include "partials/header.php"; ?>

<?php $header = "/teacher-informations"; ?>
<?php $view="teacher-informations"; ?>

<?php include "partials/nav.php"; ?>
<?php include 'partials/alert.php'; ?>

<?php
if (empty($_SESSION['username']) && empty($_SESSION['account_id'])) {
  header("Location: ./login.php");
}
?>

<main class="container-fluid w-90 border mt-4 p-4 bg-white w-50 <?= $view ?>">
<?php include 'includes/teachers.inc.php'; ?>
</main>
<?php require $_SERVER['DOCUMENT_ROOT'].'/sabanges/partials/footer.php'; ?>

<script src="js/teacher_informations.js"></script>
