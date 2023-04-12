<?php include "partials/header.php"; ?>

<?php $header = "/student-informations"; ?>
<?php $view="student-informations"; ?>

<?php include "partials/nav.php"; ?>
<?php include 'partials/alert.php'; ?>

<main class="container-fluid w-90 border mt-4 p-4 bg-white <?= $view ?>">
<?php include 'includes/student.inc.php'; ?>
</main>

<script src="js/student_informations.js"></script>
