<?php include "partials/header.php"; ?>

<?php $header = "/student-informations"; ?>
<?php $view="student-informations"; ?>

<?php include "partials/nav.php"; ?>
<?php include 'partials/alert.php'; ?>

<?php
if (empty($_SESSION['username']) && empty($_SESSION['account_id'])) {
  header("Location: ./login.php");
}
?>

<main class="container-fluid w-90 border mt-4 p-4 bg-white <?= $view ?>">
<?php include 'includes/student.inc.php'; ?>
</main>
<?php require $_SERVER['DOCUMENT_ROOT'].'/sabanges/partials/footer.php'; ?>

<script src="js/student_informations.js"></script>
