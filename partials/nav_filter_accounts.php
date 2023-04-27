<?php
$row = isset($_GET['row']) ? $_GET['row'] : '10';
$page_no = isset($_GET['page_no']) ? $_GET['page_no'] : '1';
$status = isset($_GET['status']) ? $_GET['status'] : 'active';
$query = isset($_GET['query']) ? $_GET['query'] : '';
?>
<div class="d-flex w-100 justify-content-between">
    <div class="ms-1 row gap-2 align-items-center">
        <div class="col-md p-0">
            <div class="dropdown border">
                <button class="btn btn-white dropdown-toggle btn-sm" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Number of rows
                    <span class="fw-semibold">
                        <?= $row ?>
                    </span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="?row=10&page_no=<?= $page_no ?>&status=<?= $status ?>">10</a></li>
                    <li><a class="dropdown-item" href="?row=20&page_no=<?= $page_no ?>&status=<?= $status ?>">20</a></li>
                    <li><a class="dropdown-item" href="?row=50&page_no=<?= $page_no ?>&status=<?= $status ?>">50</a></li>
                    <li><a class="dropdown-item" href="?row=100&page_no=<?= $page_no ?>&status=<?= $status ?>">100</a></li>
                </ul>
            </div>
        </div>

        <div class="col-md p-0">
            <div class="dropdown border">
                <button class="btn btn-white dropdown-toggle btn-sm" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Filter account status
                    <span class="fw-semibold">
                        <?= isset($_GET['status']) ? ucfirst($_GET['status']) : "Active" ?>
                    </span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="?row=<?= $row ?>&page_no=<?= $page_no ?>&status=active">Active</a></li>
                    <li><a class="dropdown-item" href="?row=<?= $row ?>&page_no=<?= $page_no ?>&status=inactive">Inactive</a></li>
                </ul>
            </div>
        </div>

    </div>
    <form class="input-group w-25 search-form ms-auto" action="../sabanges/includes/teachers.inc.php" method="post" enctype="multipart/form-data">
        <input type="text" class="form-control search-input" placeholder="Search" name="query" value="<?= $query ?>"/>
        <input type="hidden" class="form-control search-input" placeholder="Search" name="row" value="<?= $row ?>"/>
        <input type="hidden" class="form-control search-input" placeholder="Search" name="page_no" value="<?= $page_no ?>"/>
        <input type="hidden" class="form-control search-input" placeholder="Search" name="status"value="<?= $status ?>"/>
        <input type="hidden" class="form-control search-input" placeholder="Search" name="view"value="<?= $view ?>"/>
        <button
        class="btn btn-primary search-btn"
        id="button-addon2"
        type="submit"
        name="search"
        >
        Filter
        </button>
    </form> 
</div>

