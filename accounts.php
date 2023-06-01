<?php include "partials/header.php"; ?>

<?php $header = "/accounts"; ?>
<?php $view="accounts"; ?>
<?php $h4="Accounts"; ?>

<?php include "partials/nav.php"; ?>

<?php include './partials/alert.php'; ?>


<?php
$_SESSION['page_permission'] = 'admin';
include './includes/session.inc.php';
include './includes/permission.inc.php';
?>

<main class="container-fluid w-90 border mt-4 mb-5 p-0 bg-white <?= $view ?>">
    <div>
        <div>
            <h5 class="border-bottom p-3 mb-0">Accounts</h5>
        </div>
    </div>
    <div class="p-2 d-flex align-items-center justify-content-between">

        <?php require $_SERVER['DOCUMENT_ROOT'].'/sabanges/partials/nav_filter_accounts.php'; ?>
        <a class="d-flex align-items-center btn btn-primary ms-2" href="register.php">
            <?php include $_SERVER['DOCUMENT_ROOT'].'/sabanges/partials/add_icon.php'; ?>
            Add
        </a>

    </div>
    <div class="px-2 table-responsive <?= $view ?>-table min-vh-100">
    <?php
        $accounts = true;
        require $_SERVER['DOCUMENT_ROOT'].'/sabanges/includes/teachers.inc.php';
    ?>
    </div>
</main>
<?php require $_SERVER['DOCUMENT_ROOT'].'/sabanges/partials/footer.php'; ?>

<script src="js/accounts.js"></script>