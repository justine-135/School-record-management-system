<?php
$row = isset($_GET['row']) ? $_GET['row'] : '10';
$page_no = isset($_GET['page_no']) ? $_GET['page_no'] : '1';
// $status = isset($_GET['status']) ? $_GET['status'] : 'active';
$query = isset($_GET['query']) ? $_GET['query'] : '';
$level = isset($_GET['level']) ? $_GET['level'] : "";
$section = isset($_GET['section']) ? $_GET['section'] : "";
?>
<div class="d-flex w-100 justify-content-between align-items-center">
    <div class="d-flex gap-2 align-items-center w-75">
        <div class=" p-0">
            <div class="dropdown ">
                <button class="btn btn-white dropdown-toggle btn-sm border" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Number of rows
                    <span class="fw-semibold">
                        <?= $row ?>
                    </span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="?row=10&page_no=<?= $page_no ?>&level=<?= $level ?>&section=<?= $section ?>">10</a></li>
                    <li><a class="dropdown-item" href="?row=20&page_no=<?= $page_no ?>&level=<?= $level ?>&section=<?= $section ?>">20</a></li>
                    <li><a class="dropdown-item" href="?row=50&page_no=<?= $page_no ?>&level=<?= $level ?>&section=<?= $section ?>">50</a></li>
                    <li><a class="dropdown-item" href="?row=100&page_no=<?= $page_no ?>&level=<?= $level ?>&section=<?= $section ?>">100</a></li>
                </ul>
            </div>
        </div>

        <?php if ($view !== 'all_students') { ?>
        <div class="<?= $view == 'batch_enrollment' ? 'col-md-4' : '' ?> p-0">
            <?php if ($view == 'batch_enrollment') { ?>
                <div class="dropdown ">
                    <button class="btn btn-white dropdown-toggle btn-sm border" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Grade level
                        <span class="fw-semibold">
                            <?= isset($_GET['level']) ? (empty($level) ? "Select" : ucfirst($_GET['level'])) : 'Select' ?>
                        </span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <?php if ($view !== 'grading') { ?>
                        <li><a class="dropdown-item" href="?row=<?= $row ?>&page_no=<?= 1 ?>&level=Kindergarten&section=">Kindergarten</a></li>
                        <?php } ?>
                        <li><a class="dropdown-item" href="?row=<?= $row ?>&page_no=<?= 1 ?>&level=1&section=">1</a></li>
                        <li><a class="dropdown-item" href="?row=<?= $row ?>&page_no=<?= 1 ?>&level=2&section=">2</a></li>
                        <li><a class="dropdown-item" href="?row=<?= $row ?>&page_no=<?= 1 ?>&level=3&section=">3</a></li>
                        <li><a class="dropdown-item" href="?row=<?= $row ?>&page_no=<?= 1 ?>&level=4&section=">4</a></li>
                        <li><a class="dropdown-item" href="?row=<?= $row ?>&page_no=<?= 1 ?>&level=5&section=">5</a></li>
                        <li><a class="dropdown-item" href="?row=<?= $row ?>&page_no=<?= 1 ?>&level=6&section=">6</a></li>
                    </ul>
                </div>
            <?php } else { ?>
                <div class="dropdown ">
                    <button class="btn btn-white dropdown-toggle btn-sm border" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Grade level
                        <span class="fw-semibold">
                            <?= isset($_GET['level']) ? (empty($level) ? "All" : ucfirst($_GET['level'])) : 'All' ?>
                        </span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="?row=<?= $row ?>&page_no=<?= 1 ?>">All</a></li>
                        <?php if ($view !== 'grading') { ?>
                        <li><a class="dropdown-item" href="?row=<?= $row ?>&page_no=<?= 1 ?>&level=Kindergarten&section=">Kindergarten</a></li>
                        <?php } ?>
                        <li><a class="dropdown-item" href="?row=<?= $row ?>&page_no=<?= 1 ?>&level=1&section=">1</a></li>
                        <li><a class="dropdown-item" href="?row=<?= $row ?>&page_no=<?= 1 ?>&level=2&section=">2</a></li>
                        <li><a class="dropdown-item" href="?row=<?= $row ?>&page_no=<?= 1 ?>&level=3&section=">3</a></li>
                        <li><a class="dropdown-item" href="?row=<?= $row ?>&page_no=<?= 1 ?>&level=4&section=">4</a></li>
                        <li><a class="dropdown-item" href="?row=<?= $row ?>&page_no=<?= 1 ?>&level=5&section=">5</a></li>
                        <li><a class="dropdown-item" href="?row=<?= $row ?>&page_no=<?= 1 ?>&level=6&section=">6</a></li>
                    </ul>
                </div>
            <?php } ?>
        </div>
        <?php } ?>

        <?php if ($view !== 'batch_enrollment' && $view !== 'all_students') { ?>
        <div class=" p-0">
            <div class="dropdown ">
                <button class="btn btn-white dropdown-toggle btn-sm border" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Section
                    <span class="fw-semibold">
                        <?= isset($_GET['section']) ? (empty($section) ? "All" : ucfirst($_GET['section'])) : 'All' ?>
                    </span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <?php
                    $sections = true;
                    require $_SERVER['DOCUMENT_ROOT'].'/sabanges/includes/operations.inc.php';

                    ?>
                </ul>
            </div>
        </div>
        <?php } ?>
    </div>

    <?php if ($view == 'masterlist' || $view == 'all_students' || $view == 'grading') {  ?>
    <form class="input-group w-25 search-form ms-auto" action="../sabanges/includes/student.inc.php" method="post" enctype="multipart/form-data">
        <input type="text" class="form-control search-input" placeholder="Search" name="query" value="<?= $query ?>"/>
        <input type="hidden" class="form-control search-input" placeholder="Search" name="row" value="<?= $row ?>"/>
        <input type="hidden" class="form-control search-input" placeholder="Search" name="page_no" value="<?= $page_no ?>"/>
        <input type="hidden" class="form-control search-input" placeholder="Search" name="level"value="<?= $level ?>"/>
        <input type="hidden" class="form-control search-input" placeholder="Search" name="section"value="<?= $section ?>"/>
        <button
        class="btn btn-primary search-btn"
        id="button-addon2"
        type="submit"
        name="search"
        >
        Filter
        </button>
    </form> 
    <?php } ?>

    <?php if ($view == 'promotion') { ?>
    <div class="d-flex promotion-retention ms-auto" role="group" aria-label="Basic mixed styles example">
        <select class="form-select me-2" aria-label="Default select example" name='select-promotion'>
            <option selected value='1'>Promote</option>
            <option value="2">Promote and transfer</option>
            <option value="3">Retain</option>
        </select>
        <button type="submit" value="promote" name="promote" class="btn btn-primary">Submit</button>
    </div>
    <?php } ?>
</div>

