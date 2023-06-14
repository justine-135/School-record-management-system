<?php
namespace Views;

// include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/promotion_retention.class.php';

class EnrollmentView extends \Models\Enrollment{
    protected function validateRequest($rows, $offset, $page_no, $status, $query, $level, $section){
        if (!preg_match("/^[0-9]*$/", $rows)) {
            echo "<p class='ms-2'>Invalid parameters</p>";
            die();
        }
        elseif (!preg_match("/^[0-9]*$/", $offset)) {
            echo "<p class='ms-2'>Invalid parameters</p>";
            die();
        }
        elseif (!preg_match("/^[0-9]*$/", $page_no)) {
            echo "<p class='ms-2'>Invalid parameters</p>";
            die();
        }
        elseif (!preg_match("/^[a-zA-Z]*$/", $status)) {
            echo "<p class='ms-2'>Invalid parameters</p>";
            die();
        }
        elseif (!preg_match("/^[a-zA-Z0-9\s]*$/", $query)) {
            echo "<p class='ms-2'>Invalid parameters</p>";
            die();
        }
        elseif (!preg_match("/^[a-zA-Z0-9]*$/", $level)) {
            echo "<p class='ms-2'>Invalid parameters</p>";
            die();
        }
        elseif (!preg_match("/^[a-zA-Z0-9\s]*$/", $rows)) {
            echo "<p class='ms-2'>Invalid parameters</p>";
            die();
        }
        else {
            return;
        }
    }
    public function initIndex($view){
        $rows = isset($_GET['row']) ? $_GET['row'] : '10';
        $page_no = isset($_GET['page_no']) ? $_GET['page_no'] : '1';
        $status = isset($_GET['status']) ? $_GET['status'] : 'Unenrolled';
        $query = isset($_GET['query']) ? $_GET['query'] : '';
        $level = isset($_GET['level']) ? $_GET['level'] : "all";
        $section = isset($_GET['section']) ? $_GET['section'] : "";

        $page_no = intval($page_no);
        $total_records_per_page = $rows;
        $offset = ($page_no - 1) * intval($total_records_per_page);
        $previous_page = $page_no - 1;
        $next_page = $page_no + 1;

        if ($view == 'batch_enrollment') {
            $status = 'Unenrolled';
        }

        $result_count = $this->studentCount($status, $level, $section);
        $records = count($result_count);
        $total_no_page = ceil($records / intval($total_records_per_page));

        $this->validateRequest($rows, $offset, $page_no, $status, $query, $level, $section);

        $results = $this->index($status, $offset, $total_records_per_page, $query, $level, $section);
        ?>

        <div class="d-flex align-items-center mb-2">
        <?php
            require $_SERVER['DOCUMENT_ROOT'].'/sabanges/partials/nav_filter_student.php';
        ?>
        <select class="form-select section-select w-25 me-2" id="section" aria-label="Default select example" name="section">
            <option value="None" selected>Select section to enroll ---</option>
        </select>
        <input type="submit" class="btn btn-primary" name="batch" value='Enroll learners'>
        </div>

        <table class="table table-hover mb-0 border-top table-bordered student-table">
            <thead>
                <tr>
                    <th scope="col">     
                        <div class="d-flex">
                            <span class="me-2">#</span>      
                            <div class="form-check">
                                <input class="form-check-input masterlist-chkbox-all" type="checkbox" value="" id="flexCheckDefault">
                            </div>
                        </div>
                    </th>
                    <th scope="col">LRN</th>
                    <th scope="col">Image</th>
                    <th scope="col">Student</th>
                    <th scope="col">Recorded at</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Grade level</th>
                    <th scope="col">Status</th>
                    
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 0;
                    foreach ($results as $row) {
                        $i++;
                    if ($row['grade_level'] < 7) {
                ?>
                    <tr>
                        <td>
                            <div class="d-flex">
                                <span class="me-2">
                                <?= $i ?>
                                </span>
                                <div class="form-check">
                                    <input class="form-check-input masterlist-chkbox" type="checkbox" name="chkbox-student[]" value="<?= $row['enrollment_id'] ?>,<?= $row['student_lrn'] ?>,<?= $row['grade_level'] ?>,<?= $row['promotion_status'] ?>" id="flexCheckDefault">
                                </div>
                            </div>
                        </td>
                        <td><?= $row['student_lrn'] ?></td>
                        <td class="d-flex align-items-center justify-content-center border-0">
                            <?php if ($row['image'] === null) { ?>
                            <img class="rounded-circle" style="object-fit: cover;" width=50px height=50px src='./images/profile.jpg'>

                            <?php } else { ?>
                            <img class="rounded-circle" style="object-fit: cover;" width=50px height=50px src=data:image;base64,<?= $row['image'] ?>>

                            <?php } ?>
                        </td>
                        <td><?= strtoupper($row['surname']) . ', ' . strtoupper($row['first_name']) . ' ' . strtoupper($row['middle_name'])  ?> <?= strtoupper($row['ext']) == 'NONE' ? '' : strtoupper($row['ext']) ?></td>
                        <td><?= $row['enrolled_at'] ?></td>
                        <td><?= $row['gender'] ?></td>
                        <td><?= $row['grade_level'] ?></td>
                        <td><?= $row['status'] ?></td>
                    </tr>
                    <?php
                    }
            }

                ?>
            </tbody>
        </table>
        <nav class="mt-2">
            <ul class="pagination d-flex flex-wrap">
                <li class="page-item">
                    <a class="page-link previous-btn <?= $page_no <= 1 ? 'disabled' : '' ?>" href="?row=<?= $rows ?>&page_no=<?= $previous_page ?>&level=<?= $level ?>">Previous</a>
                </li>
                <?php for ($i=0; $i < $total_no_page; $i++) { ?>

                <li class="page-item">
                    <a class="page-link page-number <?= $page_no != $i + 1 ? '' : 'active'?>" href="?row=<?= $rows ?>&page_no=<?= $i + 1 ?>&level=<?= $level ?>"><?= $i + 1?></a>
                </li>
                
                <?php } ?>
                <li class="page-item">
                    <a class="page-link next-btn <?= $page_no >= $total_no_page ? 'disabled' : '' ?>" href="?row=<?= $rows ?>&page_no=<?= $next_page ?>&level=<?= $level ?>">Next</a>
                </li>
            </ul>
            <span class="fw-semibold">Page <?= $page_no ?> out of <?= $total_no_page ?></span>
        </nav>
        <?php
        
    }

    public function initSingleIndex($lrn){
        $lrn = isset($_GET['lrn']) ? $_GET['lrn'] : null;
        if (count($this->studentExist($lrn)) > 0) {
            $result = $this->studentExist($lrn);
        ?>
        <div>
            <div class="d-flex justify-content-between align-items-center border-bottom border-top p-3">
                <h5>Enrollment information</h5>
                <a class="btn btn-primary" target="_blank" href="student_informations.php?id=<?=$result[0]['student_id']?>">View</a>
            </div>
       
            <div class="row g-3 p-3">
                <div class="col-md-4">
                    <label for="lrn" class="form-label">LRN</label>
                    <input type="text" class="form-control" id="lrn" placeholder="Enter learner reference number" value="<?= isset($_GET['lrn']) ? $_GET['lrn'] : "" ?>" disabled>
                </div>
                <div class="col-md-4">
                    <label for="from-sy" class="form-label">Start of school year</label>
                    <input type="number" class="form-control from-sy-textbox" id="from-sy" placeholder="Enter year" name="from-sy" value="<?= isset($_GET['from_sy']) ? $_GET['from_sy'] : "" ?>" >
                </div>
                <div class="col-md-4">
                    <label for="to-sy" class="form-label">End of school Year</label>
                    <input type="number" class="form-control to-sy-textbox" id="to-sy" placeholder="Enter year" name="to-sy" value="<?= isset($_GET['to_sy']) ? $_GET['to_sy'] : "" ?>" >
                </div>        
            </div>
            <div class="row g-3 p-3">
                <div class="col-md-4">
                    <label for="grade-level" class="form-label">Grade Level</label>
                    <input type="hidden" name="grade-lvl-input" value="<?= isset($_GET['grade_lvl']) ? $_GET['grade_lvl'] : "" ?>"  id="">
                    <select class="form-select grade-select" id="grade-level" aria-label="Default select example" name="grade-lvl">
                        <option value="1" <?= isset($_GET['grade_lvl']) ? $_GET['grade_lvl'] == "1" ? 'selected' : "" : "" ?>>1</option>
                        <option value="2" <?= isset($_GET['grade_lvl']) ? $_GET['grade_lvl'] == "2" ? 'selected' : "" : "" ?>>2</option>
                        <option value="3" <?= isset($_GET['grade_lvl']) ? $_GET['grade_lvl'] == "3" ? 'selected' : "" : "" ?>>3</option>
                        <option value="4" <?= isset($_GET['grade_lvl']) ? $_GET['grade_lvl'] == "4" ? 'selected' : "" : "" ?>>4</option>
                        <option value="5" <?= isset($_GET['grade_lvl']) ? $_GET['grade_lvl'] == "5" ? 'selected' : "" : "" ?>>5</option>
                        <option value="6" <?= isset($_GET['grade_lvl']) ? $_GET['grade_lvl'] == "6" ? 'selected' : "" : "" ?>>6</option>
                    </select>
                    </div>
                    <div class="col-md-4">
                        <label for="grade-level" class="form-label">Section</label>
                        <input type="hidden" name="grade-section-input" value="<?= isset($_GET['section']) ? $_GET['section'] : "" ?>"  id="">
                        <select class="form-select section-select" id="section" aria-label="Default select example" name="section">
                            <option value="None" selected>Choose</option>
                        </select>
                    </div>
                </div>
            <div class="d-flex align-items-center border-top p-2">
                <input class="btn btn-primary ms-auto" type="submit" value="Enroll Learner" name="enroll-returnee">
            </div>
    <?php 
    }
}
}