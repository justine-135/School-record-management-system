<?php include "partials/header.php"; ?>

<?php $header = "/teachers"; ?>
<?php $view="teachers"; ?>
<?php $h4="Teachers"; ?>

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

            <?php require $_SERVER['DOCUMENT_ROOT'].'/sabanges/partials/search_teacher.php'; ?>
            <a type="submit" value="promote" name="promote" class="btn btn-primary" href="register.php">Add</a>

        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>2023/02/01</td>
                        <td>Justine Ray Upano</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</main>

<script src="js/teachers.js"></script>