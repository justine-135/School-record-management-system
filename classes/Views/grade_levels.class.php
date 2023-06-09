<?php
namespace Views;

// include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/grade_levels.class.php';

class GradeLevelsView extends \Models\GradeLevels{
    public function initIndexSelect($section_params){
        $results = $this->indexSelect($section_params);
        foreach ($results as $row) { ?>
        <option value="<?= $row['section'] ?>"><?= $row['section'] ?></option>
            <?php
        }
    }
    public function initIndexSelectEnrollmentEdit($section_params){
        $results = $this->indexSelect($section_params);
        foreach ($results as $row) { ?>
        <option value="<?= $row['section'] ?>" ><?= $row['section'] ?></option>
            <?php
        }
    }

    public function sectionLink($section_params){
        $rows = isset($_GET['row']) ? $_GET['row'] : '20';
        $page_no = isset($_GET['page_no']) ? $_GET['page_no'] : '1';
        $status = isset($_GET['status']) ? $_GET['status'] : 'active';
        $query = isset($_GET['query']) ? $_GET['query'] : '';
        $level = isset($_GET['level']) ? $_GET['level'] : "";
        $section = isset($_GET['section']) ? $_GET['section'] : "";
        $results = $this->indexSelect($section_params);
        
        ?>
        <li>
            <a class="dropdown-item" href="?row=<?= $rows ?>&page_no=<?= $page_no ?>&status=<?= $status ?>&level=<?= $level ?>&section=&query=<?= $query ?>" >All</a>
        </li>
        <?php
        foreach ($results as $row) { ?>
        <li>
            <a class="dropdown-item" href="?row=<?= $rows ?>&page_no=<?= $page_no ?>&status=<?= $status ?>&level=<?= $level ?>&section=<?= $row['section'] ?>&query=<?= $query ?>" ><?= $row['section'] ?></a>
        </li>
        <?php
        }
    }

    public function initIndex(){
        $rows = isset($_GET['row']) ? $_GET['row'] : '10';
        $page_no = isset($_GET['page_no']) ? $_GET['page_no'] : '1';
        $level = isset($_GET['level']) ? $_GET['level'] : "";

        $page_no = intval($page_no);
        $total_records_per_page = $rows;
        $offset = ($page_no - 1) * intval($total_records_per_page);
        $previous_page = $page_no - 1;
        $next_page = $page_no + 1;

        $result_count = $this->sectionsCount($level);
        $records = count($result_count);

        $total_no_page = ceil($records / intval($total_records_per_page));
        $results = $this->index($level, $offset, $total_records_per_page);


    ?>
            <table class="table table-hover border mb-0 mt-2 grade-levels-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Grade level</th>
                        <th scope="col">Section</th>
                        <th scope="col">Added at</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach ($results as $row) {
                ?>
                    <tr>
                        <th scope="row"><?= $row['id'] ?></th>
                        <td><?= $row['grade'] ?></td>
                        <td><?= $row['section'] ?></td>
                        <td><?= $row['added_at'] ?></td>
                        <td>
                            <form action="./includes/operations.inc.php" method="post" enctype="multipart/form-data">
                                <input type="text" name="id" value="<?= $row['id'] ?>" id="" hidden>
                                <button type="submit" name="delete-section" class="btn btn-danger">Delete </button>
                            </form>
                        </td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
            <nav class="m-2">
                <ul class="pagination d-flex flex-wrap">
                    <li class="page-item">
                        
                        <a class="page-link previous-btn <?= $page_no <= 1 ? 'disabled' : '' ?>" href="?row=<?= $rows ?>&page_no=<?= $previous_page ?>&level=<?= $level ?>">Previous</a>
                    </li>
                    <?php for ($i=0; $i < $total_no_page; $i++) { ?>

                    <li class="page-item">
                        <a class="page-link page-number <?= $page_no !== $i + 1 ? '' : 'active'?>" href="?row=<?= $rows ?>&page_no=<?= $i + 1 ?>&level=<?= $level ?>"><?= $i + 1?></a>
                    </li>
                
                    <?php } ?>
                    <li class="page-item">
                        <a class="page-link next-btn <?= $page_no >= $total_no_page ? 'disabled' : '' ?>" href="?row=<?= $rows ?>&page_no=<?= $next_page ?>status=<?= $status ?>&level=<?= $level ?>">Next</a>
                    </li>
                </ul>
                <span class="fw-semibold">Page <?= $page_no ?> out of <?= $total_no_page ?></span>
            </nav>
        <?php
    }
}