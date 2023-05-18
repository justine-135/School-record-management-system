<?php
$row = isset($_GET['row']) ? $_GET['row'] : '10';
$page_no = isset($_GET['page_no']) ? $_GET['page_no'] : '1';
$level = isset($_GET['level']) ? $_GET['level'] : "" ;

?>
<div class="d-flex w-100 justify-content-between align-items-center">
    <div class="container row align-items-center w-75">
        <div class="col-md-3 p-0">
            <div class="dropdown border">
                <button class="btn btn-white dropdown-toggle btn-sm" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Number of rows
                    <span class="fw-semibold">
                        <?= $row ?>
                    </span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="?row=10&page_no=<?= $page_no ?>&level=<?= $level ?>">10</a></li>
                    <li><a class="dropdown-item" href="?row=20&page_no=<?= $page_no ?>&level=<?= $level ?>">20</a></li>
                    <li><a class="dropdown-item" href="?row=50&page_no=<?= $page_no ?>&level=<?= $level ?>">50</a></li>
                    <li><a class="dropdown-item" href="?row=100&page_no=<?= $page_no ?>&level=<?= $level ?>">100</a></li>
                </ul>
            </div>
        </div>

        <?php
        
        if ($view !== 'operations_grading') { ?>
        <div class="col-md-3 p-0">
            <div class="dropdown border">
                <button class="btn btn-white dropdown-toggle btn-sm" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Grade level
                    <span class="fw-semibold">
                        <?= isset($_GET['level']) ? (empty($level) ? "All" : ucfirst($_GET['level'])) : 'All' ?>
                    </span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="?row=<?= $row ?>&page_no=<?= 1 ?>&level=">All</a></li>
                    <li><a class="dropdown-item" href="?row=<?= $row ?>&page_no=<?= 1 ?>&level=1">1</a></li>
                    <li><a class="dropdown-item" href="?row=<?= $row ?>&page_no=<?= 1 ?>&level=2">2</a></li>
                    <li><a class="dropdown-item" href="?row=<?= $row ?>&page_no=<?= 1 ?>&level=3">3</a></li>
                    <li><a class="dropdown-item" href="?row=<?= $row ?>&page_no=<?= 1 ?>&level=4">4</a></li>
                    <li><a class="dropdown-item" href="?row=<?= $row ?>&page_no=<?= 1 ?>&level=5">5</a></li>
                    <li><a class="dropdown-item" href="?row=<?= $row ?>&page_no=<?= 1 ?>&level=6">6</a></li>
                </ul>
            </div>
        </div>
        <?php } ?>
        
    </div>
</div>
