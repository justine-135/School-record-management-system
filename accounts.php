<?php include "partials/header.php"; ?>

<?php $header = "/accounts"; ?>
<?php $view="accounts"; ?>
<?php $h4="Accounts"; ?>

<?php include "partials/nav.php"; ?>

<main class="container-fluid w-90 border mt-4 p-4 bg-white <?= $view ?>">
    <h4 class=""><?= $h4 ?></h4>
    <div class="border mt-3">
        <div>
            <div>
                <h5 class="border-bottom p-3 mb-0">Manage</h5>
            </div>
        </div>
        <div class="p-2 d-flex align-items-center justify-content-between">

            <?php require $_SERVER['DOCUMENT_ROOT'].'/sabanges/partials/search_user.php'; ?>
            <a type="submit" value="promote" name="promote" class="btn btn-primary" href="register.php">Add</a>

        </div>
        <div class="table-responsive <?= $view ?>-table"></div>
    </div>
</main>
<?php require $_SERVER['DOCUMENT_ROOT'].'/sabanges/partials/footer.php'; ?>

<script src="js/accounts.js"></script>