<?php
namespace Views;

include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/student_grading.class.php';

class StudentGradingView extends \Models\StudentGrading{
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

    protected function initGradingPeriod(){
        $result = false;

        $schedules = $this->gradingPeriod();

        $presentDate = date('Y-m-d');
        $presentDate = date('Y-m-d', strtotime($presentDate));
        
        if (count($schedules) == 0) {
            $result = true;
        }

        foreach ($schedules as $schedule) {
            $start_period = $schedule['from'];
            $end_period = $schedule['to'];

            if (($presentDate >= $start_period) && ($presentDate <= $end_period)){
                $result = false;
                break;
            }else{
                $result = true;
            }
        }

        return $result;
    }

    public function initIndex($view){
        $grading_period_open = $this->initGradingPeriod();

        if ($grading_period_open) {
            echo "<div class='my-2 py-3 text-center bg-secondary text-white'><strong>GRADING PERIOD IS CLOSED</strong></div>";
        }
        else{
            $rows = isset($_GET['row']) ? $_GET['row'] : '10';
            $page_no = isset($_GET['page_no']) ? $_GET['page_no'] : '1';
            $status = isset($_GET['status']) ? $_GET['status'] : 'active';
            $query = isset($_GET['query']) ? $_GET['query'] : '';
            $level = isset($_GET['level']) ? $_GET['level'] : "";
            $section = isset($_GET['section']) ? $_GET['section'] : "";

            $page_no = intval($page_no);
            $total_records_per_page = $rows;
            $offset = ($page_no - 1) * intval($total_records_per_page);
            $previous_page = $page_no - 1;
            $next_page = $page_no + 1;

            $result_count = $this->studentCount($status, $level, $section);
            $records = count($result_count);
            $total_no_page = ceil($records / intval($total_records_per_page));



            $this->validateRequest($rows, $offset, $page_no, $status, $query, $level, $section);

            $results = $this->index($status, $offset, $total_records_per_page, $query, $level, $section);

            if (count($results) > 0) {
        ?>

                <form class="submit-grade-form" action="./includes/grades.inc.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="rows" value="<?= $rows ?>">
                    <input type="hidden" name="status" value="<?= $status ?>">
                    <input type="hidden" name="page-no" value="<?= $page_no ?>">
                    <div class="modal fade add-grade-form" id="add-grade-modal" aria-hidden="true" aria-labelledby="add-grade-modalLabel" tabindex="-1">
                        <div class="modal-dialog modal-fullscreen modal-dialog-centered">
                            <div class="modal-content grading-modal-body">
                                
                            </div>
                        </div>
                    </div>
                </form>
                <table class="table table-hover mb-0 mt-2 border-top table-bordered student-table">
                    <thead>
                        <tr>
                            <th scope="col">LRN</th>
                            <th scope="col">Image</th>
                            <th scope="col">Student</th>
                            <th scope="col">Enrolled at</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Class</th>
                            <th scope="col">Status</th>
                            <th>Grade</th>
                            <th scope='col'>Remarks</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            foreach ($results as $row) {
                                if ($view == 'grading') {
                                if ($row['grade_level'] !== 'Kindergarten') {
                        ?>
                            <tr>
                                <td><?= $row['lrn'] ?></td>
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
                                <td><?= ($row['grade_level'] !== 'Kindergarten' ? 'Grade ' : '') . $row['grade_level'] . " - " . $row['section'] ?></td>
                                <td>
                                    <p>
                                        <?= $row['status'] ?>
                                    </p>
                                </td>
                                <td>
                                    <?php
                                    $graded = $this->gradesSubmitted($row['grade_level'], $row['lrn']);
                                    if ($row['grade_level'] != 'Kindergarten') {
                                        if (count($graded) <= 0) {
                                            echo '<span class="">Ungraded</span>';
                                        }
                                        else{
                                            foreach ($graded as $grade) {
                                                if (strtoupper($grade['first_quarter']) == 'INC' || strtoupper($grade['second_quarter']) == 'INC' || strtoupper($grade['third_quarter']) == 'INC' || strtoupper($grade['fourth_quarter']) == 'INC') {
                                                    echo '<span class="">Incomplete</span>';
            
                                                }
                                                else{
                                                    echo '<span class="">Graded</span>';
                                                }
                                                break;
                                            }
                                        }
                                    }
                                    else{
                                        echo '<span class="">N/A</span>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?= $row['promotion_status'] == null ? 'None' : $row['promotion_status'] ?>
                                </td> 
                                <td>
                                    <a class="btn btn-primary open-grade-btn" data-bs-toggle="modal" href="#add-grade-modal" role="button">
                                    Grade
                                    </a>     
                                    <input type="hidden" name="lrn" value="<?= $row['lrn'] ?>" id="">
                                    <input type="hidden" name="grade-level" value="<?= $row['grade_level'] ?>" id="">
                                    <input type="hidden" name="section" value="<?= $row['section'] ?>" id="">
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    }

                        ?>
                    </tbody>
                </table>
                <nav class="mt-2">
                    <ul class="pagination d-flex flex-wrap">
                        <li class="page-item">
                            
                            <a class="page-link previous-btn <?= $page_no <= 1 ? 'disabled' : '' ?>" href="?row=<?= $rows ?>&page_no=<?= $previous_page ?>&status=<?= $status ?>&level=<?= $level ?>&section=<?= $section ?>&query=<?= $query ?>">Previous</a>
                        </li>
                        <?php for ($i=0; $i < $total_no_page; $i++) { ?>

                        <li class="page-item">
                            <a class="page-link page-number <?= $page_no !== $i + 1 ? '' : 'active'?>" href="?row=<?= $rows ?>&page_no=<?= $i + 1 ?>&status=<?= $status ?>&level=<?= $level ?>&section=<?= $section ?>&query=<?= $query ?>"><?= $i + 1?></a>
                        </li>
                        
                        <?php } ?>
                        <li class="page-item">
                            <a class="page-link next-btn <?= $page_no >= $total_no_page ? 'disabled' : '' ?>" href="?row=<?= $rows ?>&page_no=<?= $next_page ?>status=<?= $status ?>&level=<?= $level ?>&section=<?= $section ?>&query=<?= $query ?>">Next</a>
                        </li>
                    </ul>
                    <span class="fw-semibold">Page <?= $page_no ?> out of <?= $total_no_page ?></span>
                </nav>
        <?php } else {
            echo "<p class='p-2'>No students are eligible to be graded.</p>";
            }
        }
    }
        
}