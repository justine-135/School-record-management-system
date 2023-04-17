<?php include "partials/header.php"; ?>

<?php $header = "/teacher-informations"; ?>
<?php $view="teacher-informations"; ?>

<?php include "partials/nav.php"; ?>
<?php include 'partials/alert.php'; ?>

<main class="container-fluid w-90 border mt-4 p-4 bg-white <?= $view ?>">
<?php include 'includes/teachers.inc.php'; ?>
</main>

<script src="js/teacher_informations.js"></script>
