<?php
namespace Views;

include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/student.class.php';

class StudentView extends \Models\Student{
    protected function validateRequest($rows, $offset, $page_no, $query, $level, $section){
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

    public function initMasterlist($view){
        $rows = isset($_GET['row']) ? $_GET['row'] : '10';
        $page_no = isset($_GET['page_no']) ? $_GET['page_no'] : '1';
        $query = isset($_GET['query']) ? $_GET['query'] : '';
        $level = isset($_GET['level']) ? $_GET['level'] : "";
        $section = isset($_GET['section']) ? $_GET['section'] : "";

        $page_no = intval($page_no);
        $total_records_per_page = $rows;
        $offset = ($page_no - 1) * intval($total_records_per_page);
        $previous_page = $page_no - 1;
        $next_page = $page_no + 1;

        $result_count = $this->enrollmentHistoryCount($level, $section);
        $records = count($result_count);
        $total_no_page = ceil($records / intval($total_records_per_page));

        $this->validateRequest($rows, $offset, $page_no, $query, $level, $section);

        $results = $this->indexEnrollmentHistory($offset, $total_records_per_page, $query, $level, $section);
        if (count($results) > 0) {
        ?>

        <table class="table table-hover mt-2 mb-0 border-top table-bordered student-table">
            <thead>
                <tr>
                    <th scope="col">LRN</th>
                    <th scope="col">Image</th>
                    <th scope="col">Student</th>
                    <?php if ($view !== 'grading') { ?>
                    <th scope="col">Enrolled at</th>
                    <?php } ?>
                    <th scope="col">Gender</th>
                    <th scope="col">Class</th>
                    <?php if ($view !== 'grading') { ?>
                    <th scope="col">Status</th>
                    <?php } ?>
                    <?php if ($view == 'grading') { ?>
                    <th>Grade</th>
                    <?php } ?>
                    <?php if ($view == 'grading' || $view == 'promotion') { ?>
                    <th scope='col'>Remarks</th>
                    <?php } ?>
                    <?php if ($view != 'promotion' && $view != 'batch_enrollment') { ?>
                    <th scope="col">Action</th>
                    <?php } ?>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($results as $row) {
                ?>
                    <tr>
                        <td><?= $row['lrn'] ?></td>
                        <td class="d-flex align-items-center justify-content-center border-0">
                            <?php if ($row['image'] === null) { ?>
                            <img class="rounded-circle" style="object-fit: cover;" width=50px height=50px src='./images/profile.jpg'>

                            <?php } else { ?>
                            <img class="rounded-circle" style="object-fit: cover;" width=50px height=50px src=data:image;base64,<?= $row['image'] ?>>

                            <?php } ?>                        </td>
                        <td><?= strtoupper($row['surname']) . ', ' . strtoupper($row['first_name']) . ' ' . strtoupper($row['middle_name'])  ?> <?= strtoupper($row['ext']) == 'NONE' ? '' : strtoupper($row['ext']) ?></td>
                        <?php if ($view !== 'grading') { ?>
                        <td><?= $row['enrolled_at'] ?></td>
                        <?php } ?>
                        <td><?= $row['gender'] ?></td>
                        <td><?= ($row['grade_level'] !== 'Kindergarten' ? 'Grade ' : '') . $row['grade_level'] . " - " . $row['section'] ?></td>
                        <?php if ($view !== 'grading') { ?>
                        <td>
                            <p>
                                <?= $row['status'] ?>
                            </p>
                        </td>
                        <?php } ?>
                        <?php if ($view == 'grading') { ?>
                        <td>
                            <?php
                            $graded = $this->gradesSubmitted($row['grade_level'], $row['lrn']);
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
                            ?>
                        </td>
                        <?php } ?>    
                       
                        <?php if ($view !== 'promotion') { ?>            
                        <td>
                            <?php if ($view == 'masterlist') { ?>
                            <div class="dropdown ml-auto">
                                <a
                                class="btn dropdown-toggle btn-primary"
                                href="#"
                                role="button"
                                id="dropdownMenuLink"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                                >
                                View
                                </a>
                                
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <input class="student-id" type="hidden" name="id" id="id" value="<?= $row['student_id'] ?>" >
                                    <li><a class="dropdown-item" href="../sabanges/student_informations.php?id=<?= $row['student_id']?>">Informations</a></li>
                                    <li><a class="dropdown-item" href="../sabanges/student_informations.php?id=<?= $row['student_id']?>#grades-section">Grades</a></li>
                                </ul>
                            </div>
                            <?php } elseif ($view == 'grading') { ?>
                            <a class="btn btn-primary open-grade-btn" data-bs-toggle="modal" href="#add-grade-modal" role="button">
                            Grade
                            </a>     
                            <input type="hidden" name="lrn" value="<?= $row['lrn'] ?>" id="">
                            <input type="hidden" name="grade-level" value="<?= $row['grade_level'] ?>" id="">
                            <input type="hidden" name="section" value="<?= $row['section'] ?>" id="">
                            <?php } ?>
                        </td>
                        <?php } ?>
                    </tr>
                    <?php
                
            }

                ?>
            </tbody>
        </table>
        <nav class="m-2 ms-0">
            <ul class="pagination">
                <li class="page-item">
                    
                    <a class="page-link previous-btn <?= $page_no <= 1 ? 'disabled' : '' ?>" href="?row=<?= $rows ?>&page_no=<?= $previous_page ?>&level=<?= $level ?>&section=<?= $section ?>&query=<?= $query ?>">Previous</a>
                </li>
                <?php for ($i=0; $i < $total_no_page; $i++) { ?>

                <li class="page-item">
                    <a class="page-link page-number <?= $page_no !== $i + 1 ? '' : 'active'?>" href="?row=<?= $rows ?>&page_no=<?= $i + 1 ?>&level=<?= $level ?>&section=<?= $section ?>&query=<?= $query ?>"><?= $i + 1?></a>
                </li>
               
                <?php } ?>
                <li class="page-item">
                    <a class="page-link next-btn <?= $page_no >= $total_no_page ? 'disabled' : '' ?>" href="?row=<?= $rows ?>&page_no=<?= $next_page ?>&level=<?= $level ?>&section=<?= $section ?>&query=<?= $query ?>">Next</a>
                </li>
            </ul>
            <span class="fw-semibold">Page <?= $page_no ?> out of <?= $total_no_page ?></span>
        </nav>        
        <?php
        } else {
            echo "<p class='p-2'>No students are enrolled.</p>";
        }
    }

    public function initStudentRecords($view){
        $rows = isset($_GET['row']) ? $_GET['row'] : '10';
        $page_no = isset($_GET['page_no']) ? $_GET['page_no'] : '1';
        $query = isset($_GET['query']) ? $_GET['query'] : '';

        $page_no = intval($page_no);
        $total_records_per_page = $rows;
        $offset = ($page_no - 1) * intval($total_records_per_page);
        $previous_page = $page_no - 1;
        $next_page = $page_no + 1;

        $result_count = $this->studentCount();
        $records = count($result_count);
        $total_no_page = ceil($records / intval($total_records_per_page));

        $results = $this->indexStudents($offset, $total_records_per_page, $query);

        ?>

        <table class="table table-hover mt-2 mb-0 border-top table-bordered student-table">
            <thead>
                <tr>
                    <th scope="col">     
                        <div class="d-flex">
                            <span class="me-2">#</span>      
                            
                        </div>
                    </th>
                    <th scope="col">LRN</th>
                    <th scole='col'>Image</th>
                    <th scope="col">Student</th>
                    <th scope="col">Date recorded</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($results as $row) {
                ?>
                    <tr>
                        <td>
                            <div class="d-flex">
                                <span class="me-2">
                                <?= $row['student_id'] ?>
                                </span>
                               
                            </div>
                        </td>
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
                        <td>
                            <div class="dropdown ml-auto">
                                <a
                                class="btn dropdown-toggle btn-primary"
                                href="#"
                                role="button"
                                id="dropdownMenuLink"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                                >
                                View
                                </a>
                                
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <input class="student-id" type="hidden" name="id" id="id" value="<?= $row['student_id'] ?>" >
                                    <li><a class="dropdown-item" href="../sabanges/student_informations.php?id=<?= $row['student_id']?>">Informations</a></li>
                                    <li><a class="dropdown-item" href="../sabanges/student_informations.php?id=<?= $row['student_id']?>#grades-section">Grades</a></li>
                                </ul>
                            </div>
                            
                        </td>
                    </tr>
                    <?php
                
            }

                ?>
            </tbody>
        </table>
        <nav class="m-2 ms-0">
            <ul class="pagination">
                <li class="page-item">
                    
                    <a class="page-link previous-btn <?= $page_no <= 1 ? 'disabled' : '' ?>" href="?row=<?= $rows ?>&page_no=<?= $previous_page ?>&level=<?= $level ?>&section=<?= $section ?>&query=<?= $query ?>">Previous</a>
                </li>
                <?php for ($i=0; $i < $total_no_page; $i++) { ?>

                <li class="page-item">
                    <a class="page-link page-number <?= $page_no !== $i + 1 ? '' : 'active'?>" href="?row=<?= $rows ?>&page_no=<?= $i + 1 ?>&level=<?= $level ?>&section=<?= $section ?>&query=<?= $query ?>"><?= $i + 1?></a>
                </li>
               
                <?php } ?>
                <li class="page-item">
                    <a class="page-link next-btn <?= $page_no >= $total_no_page ? 'disabled' : '' ?>" href="?row=<?= $rows ?>&page_no=<?= $next_page ?>&level=<?= $level ?>&section=<?= $section ?>&query=<?= $query ?>">Next</a>
                </li>
            </ul>
            <span class="fw-semibold">Page <?= $page_no ?> out of <?= $total_no_page ?></span>
        </nav>        
        <?php
    }

    public function initGradeModal($lrn, $grade_level, $section){
        ?>
        <div class="d-flex justify-content-between w-50">
            <div>
            <label class="form-check-label" for="lrn">Learner reference number</label>
            <input class="form-control lrn" type="text" name="lrn" value="<?= $lrn ?>" id="lrn" readonly>
            <input class="form-control" type="text" name="id" value="<?= $_GET['id'] ?>" id="lrn" hidden>
            </div>
            <div>
            <label class="form-check-label" for="current-grade-lvl">Grade level</label>
            <input class="form-control" type="text" name="current-grade-level" value="<?= $grade_level ?>" id="current-grade-level" readonly>
            </div>
            <div>
            <label class="form-check-label" for="section">Section</label>
            <input class="form-control" type="text" name="current-section" value="<?= $section ?>" id="section" readonly>
            </div>
        </div>
        <div class="border p-0 mt-2">
            <select class="form-select rounded-0 border-0 border-bottom add-grade-select" name="grade-level" id="grade-level">
            <option value="None" selected disabled>Select grade level ---</option>
            <option value="Kindergarten">Kindergarten</option>
            <option value="1">Grade 1</option>
            <option value="2">Grade 2</option>
            <option value="3">Grade 3</option>
            <option value="4">Grade 4</option>
            <option value="5">Grade 5</option>
            <option value="6">Grade 6</option>
            </select>
            <div class="add-grade-table"></div>
        </div>

        <?php
    }
}

class StudentInformationView extends \Models\Student{
    public function initSingleIndex($id){
        $result = $this->singleIndex($id);

        if (count($result) !== 0) {
            foreach ($result as $row) {
                $result2 = $this->enrollmentHistory($row['student_lrn']);
            }
            $grade_levels = array();
            foreach ($result2 as $row2) {
                array_push($grade_levels, $row2['grade_level']);
            }
            // count($result) === 0 ? header("Location: ./masterlist.php?id={$id}&err=not_found") : "";
            ?>
            <div class="row gap-3">
                <form class="border col-md" action="./includes/enrollment.inc.php" method="post" enctype="multipart/form-data">
                    <div class="row ">
                        <div class="d-flex align-items-center justify-content-between py-3 px-3 border-bottom">
                            <h5>Information</h5>
                            <a style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn btn-primary" href="../sabanges/student_informations.php?id=<?= $result[0]['student_id'] ?>&edit_enrollment">
                                Edit
                            </a>
                        </div>
                        <div class="d-flex align-items-center justify-content-between py-3 px-3">
                            <div>
                                <?php if ($result[0]['image'] === null) { ?>
                                <img class="rounded-circle" style="object-fit: cover;" width=200px height=200px src='./images/profile.jpg'>
                                <?php } else { ?>
                                <img class="rounded-circle" style="object-fit: cover;" width=200px height=200px src=data:image;base64,<?= $result[0]['image'] ?>>
                                <?php } ?>   
                            </div>
                            <div class="ms-3 py-1 w-75">
                                <h2 class="text-end"><?= strtoupper($result[0]['surname']) . ", " . strtoupper($result[0]['first_name']) . " " . strtoupper($result[0]['middle_name']) . " " ?> <?= strtoupper($result[0]['ext']) == 'NONE' ? '' : strtoupper($result[0]['ext']) ?></h2>
                                <span class="d-block text-end"> <?= strtoupper($result[0]['lrn']) ?></span>
                            </div>
                        </div>
                        <div class="px-0">
                            <?php foreach($result as $row){ ?>
                            <div class="border-top">
                                <div class="py-2 px-2 border-bottom">
                                    <h6 class="m-0">Student information</h6>
                                </div>
                                <div class="row py-2 px-2">
                                    <div class="col-md py-1">
                                        <span class="fw-semibold">LRN : </span>
                                        <span><?= strtoupper($row['lrn']) ?></span>
                                    </div>
                                </div>
                                <div class="py-2 px-2 border-top border-bottom">
                                    <h6 class="m-0">Basic information</h6>
                                </div>
                                <div class="row py-2 px-2">
                                    <div class="col-md-4 py-1">
                                        <span class="fw-semibold">Surname :</span>
                                        <?php if (isset($_GET['edit_enrollment'])) { ?>
                                        <input  class="form-control " type="text" name="sname" id="" value="<?= $row['surname'] ?>">
                                        <?php } else { ?>
                                        <span><?= strtoupper($row['surname']) ?></span>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-4 py-1">
                                        <span class="fw-semibold">First name :</span>
                                        <?php if (isset($_GET['edit_enrollment'])) { ?>
                                        <input  class="form-control " type="text" name="fname" id="" value="<?= $row['first_name'] ?>">
                                        <?php } else { ?>
                                        <span><?= strtoupper($row['first_name']) ?></span>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-4 py-1">
                                        <span class="fw-semibold">Middle name :</span>
                                        <?php if (isset($_GET['edit_enrollment'])) { ?>
                                        <input  class="form-control " type="text" name="mname" id="" value="<?= $row['middle_name'] ?>">
                                        <?php } else { ?>
                                        <span><?= strtoupper($row['middle_name']) ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php if (isset($_GET['edit_enrollment'])) { ?>
                                <div class="row py-2 px-2">
                                    <div class="col-md-4 py-1">
                                        <span class="fw-semibold">Extension :</span>
                                        <select class="form-select" id="ext" aria-label="Default select example" name="extname">
                                            <option value="None" <?= $row['ext'] !== "None" ? '' : 'selected' ?>>N/A</option>
                                            <option value="Jr" <?= $row['ext'] !== "Jr" ? '' : 'selected' ?>>Jr</option>
                                            <option value="I"  <?= $row['ext'] !== "I" ? '' : 'selected' ?>>I</option>
                                            <option value="II" <?= $row['ext'] !== "II" ? '' : 'selected' ?>>II</option>
                                            <option value="III" <?= $row['ext'] !== "III" ? '' : 'selected' ?>>III</option>
                                            <option value="IV" <?= $row['ext'] !== "IV" ? '' : 'selected' ?>>IV</option>
                                            <option value="V" <?= $row['ext'] !== "V" ? '' : 'selected' ?>>V</option>
                                            <option value="VI"<?= $row['ext'] !== "VI" ? '' : 'selected' ?>>VI</option>
                                            <option value="VII" <?= $row['ext'] !== "VII" ? '' : 'selected' ?>>VII</option>
                                            <option value="VIII" <?= $row['ext'] !== "VIII" ? '' : 'selected' ?>>VIII</option>
                                            <option value="IX" <?= $row['ext'] !== "IX" ? '' : 'selected' ?>>IX</option>
                                            <option value="X" <?= $row['ext'] !== "X" ? '' : 'selected' ?>>X</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 py-1">
                                        <span class="fw-semibold">Photo</span>
                                        <input type="file" class="form-control" id="file" name="file" accept="image/png, image/gif, image/jpeg" value="<?= $row['image'] ?>" required>
                                        <div id="emailHelp" class="form-text ps-3" >*Choose jpeg/jpg, and png only.</div>
                                    </div>
                                </div>
                                <?php } ?>
                                        
                                <div class="row py-2 px-2">
                                    <div class="col-md-4 py-1">
                                        <span class="fw-semibold">Gender :</span>
                                        <?php if (isset($_GET['edit_enrollment'])) { ?>
                                        <div class="d-flex">
                                            <div class="form-check me-3">
                                                <input type="radio" class="form-check-input" id="male-gender" name="gender" value="Male" <?= $row['gender'] == "Male" ? "checked" : "" ?> required>
                                                <label class="form-check-label" for="male-gender">Male</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="female-gender" name="gender" value="Female" <?= $row['gender'] == "Female" ? "checked" : ""?> required>
                                                <label class="form-check-label" for="female-gender">Female</label>
                                            </div>
                                        </div>
                                        <?php } else { ?>
                                        <span><?= strtoupper($row['gender']) ?></span>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-4 py-1">
                                        <span class="fw-semibold">Religion :</span>
                                        <?php if (isset($_GET['edit_enrollment'])) { ?>
                                        <input  class="form-control " type="text" name="religion" id="" value="<?= $row['religion'] ?>">
                                        <?php } else { ?>
                                        <span><?= strtoupper($row['religion']) ?></span>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-4 py-1">
                                        <span class="fw-semibold">Birth date :</span>
                                        <?php if (isset($_GET['edit_enrollment'])) { ?>
                                        <input type="date" class="form-control" id="bdate" name="birth-date" value="<?= $row['birth_date'] ?>" required>
                                        <?php } else { ?>
                                        <span class="bday"><?= strtoupper($row['birth_date']) ?></span>
                                        <span class="age-calc fw-light">(16)</span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php if (isset($_GET['edit_enrollment'])) { ?> 
                                <div class="py-2 px-2 border-top border-bottom">
                                    <h6 class="m-0">Address</h6>
                                </div>
                                <div class="row py-2 px-2">
                                    <div class="col-md-4 py-1">
                                        <span class="fw-semibold">House number & street :</span>
                                        <input type="text" class="form-control" id="house-number-street" placeholder="Enter house number & street" name="house-number-street" value="<?= $row['house_street'] ?>" required>
                                    </div>
                                    <div class="col-md-4 py-1">
                                        <span class="fw-semibold">Subdivision/Village/Zone :</span>
                                        <input type="text" class="form-control" id="subdv-village-zone" placeholder="Enter subdivision/village/zone" name="subdv-village-zone" value="<?= $row['subdivision'] ?>" required>
                                    </div>
                                    <div class="col-md-4 py-1">
                                        <span class="fw-semibold">Barangay :</span>
                                        <input type="text" class="form-control" id="barangay" placeholder="Enter barangay" name="barangay" value="<?= $row['barangay'] ?>" required>
                                    </div>
                                </div>

                                <div class="row py-2 px-2">
                                    <div class="col-md-4 py-1">
                                        <span class="fw-semibold">City/Municipality :</span>
                                        <input type="text" class="form-control" id="city-municipality" placeholder="Enter city/municipality" name="city-municipality" value="<?= $row['city'] ?>" required>
                                    </div>
                                    <div class="col-md-4 py-1">
                                        <span class="fw-semibold">Province :</span>
                                        <input type="text" class="form-control" id="province" placeholder="Enter province" name="province" value="<?= $row['province'] ?>" required>
                                    </div>
                                    <div class="col-md-4 py-1">
                                        <span class="fw-semibold">Region :</span>
                                        <input type="text" class="form-control" id="region" placeholder="Enter region" name="region" value="<?= $row['region'] ?>" required>
                                    </div>
                                </div>
                                <?php } else { ?>
                                <div class="row py-2 px-2">
                                    <div class="col-md py-1">
                                        <span class="fw-semibold">Current address :</span>
                                        <span class="w-50"><?= $row['house_street'] . ". " . $row['subdivision'] . " " . $row['barangay'] . " " . $row['city'] . ", " . $row['province'] ?></span>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="py-2 px-2 border-top border-bottom">
                                <h6 class="m-0">Mother</h6>
                            </div>
                            <div class="py-2 px-2">
                                <div class="row">
                                    <div class="col-md-4 py-1">
                                        <span class="fw-semibold">Surname :</span>
                                        <?php if (isset($_GET['edit_enrollment'])) { ?>
                                        <input  class="form-control " type="text" name="m-surname" id="" value="<?= $row['mother_surname'] ?>">
                                        <?php } else { ?>
                                        <span><?= strtoupper($row['mother_surname']) ?></span>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-4 py-1">
                                        <span class="fw-semibold">First name :</span>
                                        <?php if (isset($_GET['edit_enrollment'])) { ?>
                                        <input  class="form-control" type="text" name="m-fname" id="" value="<?= $row['mother_first_name'] ?>">
                                        <?php } else { ?>
                                        <span><?= strtoupper($row['mother_first_name']) ?></span>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-4 py-1">
                                        <span class="fw-semibold">Middle name :</span>
                                        <?php if (isset($_GET['edit_enrollment'])) { ?>
                                        <input  class="form-control" type="text" name="m-mname" id="" value="<?= $row['mother_middle_name'] ?>">
                                        <?php } else { ?>
                                        <span><?= strtoupper($row['mother_middle_name']) ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md py-1">
                                        <span class="fw-semibold">Educational attainment :</span>
                                        <?php if (isset($_GET['edit_enrollment'])) { ?>
                                        <input  class="form-control" type="text" name="m-highest-education" id="" value="<?= $row['mother_education'] ?>">
                                        <?php } else { ?>
                                        <span><?= $row['mother_education'] ?></span>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md py-1">
                                        <span class="fw-semibold">Employment :</span>
                                        <?php if (isset($_GET['edit_enrollment'])) { ?>
                                        <input  class="form-control" type="text" name="m-employment-status" id="" value="<?= $row['mother_employment'] ?>">
                                        <?php } else { ?>
                                        <span><?= $row['mother_employment'] ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 py-1">
                                        <span class="fw-semibold">Contact number :</span>
                                        <?php if (isset($_GET['edit_enrollment'])) { ?>
                                        <input  class="form-control" type="text" name="m-contact-number" id="" value="<?= $row['mother_contact_number'] ?>">
                                        <?php } else { ?>
                                        <span><?= $row['mother_contact_number'] ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="py-2 px-2 border-top border-bottom">
                                <h6 class="m-0">Father</h6>
                            </div>
                            <div class="py-2 px-2">
                                <div class="row">
                                    <div class="col-md-4 py-1">
                                        <span class="fw-semibold">Surname :</span>
                                        <?php if (isset($_GET['edit_enrollment'])) { ?>
                                        <input  class="form-control " type="text" name="f-surname" id="" value="<?= $row['father_surname'] ?>">
                                        <?php } else { ?>
                                        <span><?= strtoupper($row['father_surname']) ?></span>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-4 py-1">
                                        <span class="fw-semibold">First name :</span>
                                        <?php if (isset($_GET['edit_enrollment'])) { ?>
                                        <input  class="form-control" type="text" name="f-fname" id="" value="<?= $row['father_first_name'] ?>">
                                        <?php } else { ?>
                                        <span><?= strtoupper($row['father_first_name']) ?></span>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-4 py-1">
                                        <span class="fw-semibold">Middle name :</span>
                                        <?php if (isset($_GET['edit_enrollment'])) { ?>
                                        <input  class="form-control" type="text" name="f-mname" id="" value="<?= $row['father_middle_name'] ?>">
                                        <?php } else { ?>
                                        <span><?= strtoupper($row['father_middle_name']) ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md py-1">
                                        <span class="fw-semibold">Educational attainment :</span>
                                        <?php if (isset($_GET['edit_enrollment'])) { ?>
                                        <input  class="form-control" type="text" name="f-highest-education" id="" value="<?= $row['father_education'] ?>">
                                        <?php } else { ?>
                                        <span><?= $row['father_education'] ?></span>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md py-1">
                                        <span class="fw-semibold">Employment :</span>
                                        <?php if (isset($_GET['edit_enrollment'])) { ?>
                                        <input  class="form-control" type="text" name="f-employment-status" id="" value="<?= $row['father_employment'] ?>">
                                        <?php } else { ?>
                                        <span><?= $row['father_employment'] ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 py-1">
                                        <span class="fw-semibold">Contact number :</span>
                                        <?php if (isset($_GET['edit_enrollment'])) { ?>
                                        <input  class="form-control" type="text" name="f-contact-number" id="" value="<?= $row['father_contact_number'] ?>">
                                        <?php } else { ?>
                                        <span><?= $row['father_contact_number'] ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="py-2 px-2 border-top border-bottom">
                                <h6 class="m-0">Guardian</h6>
                            </div>
                            <div class="py-2 px-2">
                                <div class="row">
                                    <div class="col-md-4 py-1">
                                        <span class="fw-semibold">Surname :</span>
                                        <?php if (isset($_GET['edit_enrollment'])) { ?>
                                        <input  class="form-control" type="text" name="g-surname" id="" value="<?= $row['guardian_surname'] ?>">
                                        <?php } else { ?>
                                        <span><?= strtoupper($row['guardian_surname']) ?></span>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-4 py-1">
                                        <span class="fw-semibold">First name :</span>
                                        <?php if (isset($_GET['edit_enrollment'])) { ?>
                                        <input  class="form-control" type="text" name="g-fname" id="" value="<?= $row['guardian_first_name'] ?>">
                                        <?php } else { ?>
                                        <span><?= strtoupper($row['guardian_first_name']) ?></span>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-4 py-1">
                                        <span class="fw-semibold">Middle name :</span>
                                        <?php if (isset($_GET['edit_enrollment'])) { ?>
                                        <input  class="form-control" type="text" name="g-mname" id="" value="<?= $row['guardian_middle_name'] ?>">
                                        <?php } else { ?>
                                        <span><?= strtoupper($row['guardian_middle_name']) ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md py-1">
                                        <span class="fw-semibold">Educational attainment :</span>
                                        <?php if (isset($_GET['edit_enrollment'])) { ?>
                                        <input  class="form-control" type="text" name="g-highest-education" id="" value="<?= $row['guardian_education'] ?>">
                                        <?php } else { ?>
                                            <span><?= $row['guardian_education'] ?></span>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md py-1">
                                        <span class="fw-semibold">Employment :</span>
                                        <?php if (isset($_GET['edit_enrollment'])) { ?>
                                        <input  class="form-control" type="text" name="g-employment-status" id="" value="<?= $row['guardian_employment'] ?>">
                                        <?php } else { ?>
                                        <span><?= $row['guardian_employment'] ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 py-1">
                                        <span class="fw-semibold">Contact number :</span>
                                        <?php if (isset($_GET['edit_enrollment'])) { ?>
                                        <input  class="form-control" type="text" name="g-contact-number" id="" value="<?= $row['guardian_contact_number'] ?>">
                                        <?php } else { ?>
                                        <span><?= $row['guardian_contact_number'] ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="border-top"></div>
                            <div class="py-2 px-2">
                                <div class="row">
                                    <div class="col-md-4">
                                        <span class="d-block mb-2">Is the family member beneficiary of 4p's?</span>
                                        <div class="form-check mb-3">
                                            <input type="radio" class="form-check-input" id="yes_beneficiary" name="is-beneficiary" value="1" <?= $row['is_beneficiary'] == 1 ? 'checked' : '' ?> required>
                                            <label class="form-check-label" for="yes_beneficiary">Yes</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input type="radio" class="form-check-input" id="no_beneficiary" name="is-beneficiary" value="0" <?= $row['is_beneficiary'] == 0 ? 'checked' : '' ?> required>
                                            <label class="form-check-label" for="no_beneficiary">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php } ?>
                            <?php
                            if (isset($_GET['edit_enrollment'])) { ?>
                            <div class="d-flex align-items-center border-top p-2">
                                <input type="hidden" name="curr-lrn" id="" value="<?= $row['lrn'] ?>">
                                <input type="hidden" name="student_id" id="" value="<?= $row['student_id'] ?>">
                                <span class="fw-semibold ms-auto">Confirm changes? </span>
                                <a class="btn btn-danger ms-3" href="../sabanges/student_informations.php?id=<?= $result[0]['student_id'] ?>">Cancel</a>
                                <input class="btn btn-primary ms-1" type="submit" name="update" value="Submit">
                            </div>
                            <?php } ?>
                        </div>
                    </div>

                </form>
                <div class="container border col-md-4" id="history-section">
                    <div class="row">
                        <div class="d-flex align-items-center justify-content-between py-3 px-3 border-bottom">
                            <h5>Enrolled History</h5>
                            <?php include $_SERVER['DOCUMENT_ROOT'].'/sabanges/partials/add_enrollment_history_modal.php'; ?>
                            <button style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#enrollment-modal">
                                Add
                            </button>
                        </div>
                        <?php foreach($result2 as $row2){ ?>
                        <div class="w-100 py-2 px-3 border-bottom">
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="fw-semibold">School year :</span>
                                <span><?= $row2['from_sy'] . " - " . $row2['to_sy'] ?></span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="fw-semibold">Grade level :</span>
                                <span><?= $row2['grade_level'] ?></span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="fw-semibold">Section :</span>
                                <span><?= $row2['section'] ?></span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="fw-semibold">School :</span>
                                <span><?= $row2['school'] ?></span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="fw-semibold">Status :</span>
                                <?php if ($row2['status'] == "Active") {
                                ?>
                                <span class="fw-medium text-primary"><?= $row2['status'] ?></span>
                                <?php } elseif ($row2['status'] == "Completed"){
                                    ?>
                                <span class="fw-medium text-success"><?= $row2['status'] ?></span>
                                <?php } else {
                                    ?>
                                <span class="fw-medium text-danger"><?= $row2['status'] ?></span>
                                <?php
                                } ?>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <?php include './partials/add_grades_modal.php'; ?>
            
            <div class="border mt-3 row" id="grades-section">
                <div class="d-flex align-items-center justify-content-between py-3 px-3">
                    <h5>Grades</h5>               
                </div>
                <div class="row grades-section" id="<?= $result2[0]['student_lrn'] ?>">
                    <input type="text" name="grade-lvl" value="<?= $result2[0]['student_lrn'] ?>" id="">
                </div>
            <div>
        <?php
        } else {
            echo '<p>Student id not found. Redirect <a href="javascript:history.back()">here</a>.</p>';
        }
    }

    public function addGradesTable($grade_level, $lrn){
        $subjects = $this->subjectIndex($grade_level);
        $student = $this->gradeSection($grade_level, $lrn);
        $grades = $this->gradesSubmitted($grade_level, $lrn);
    
        ?>
        <div class="modal-header">
            <h5 class="modal-title" id="">Grade learner</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body ">
            <div class="d-flex flex-column">
                <?php if (count($student) > 0) {
                foreach ($student as $row) { ?>
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-check-label fw-bold" for="surname">Surname</label>
                        <input class="form-control name w-100" type="text" name="name" value="<?= strtoupper($row['surname']) ?>" id="surname" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-check-label fw-bold" for="first-name">First name</label>
                        <input class="form-control name w-100" type="text" name="name" value="<?= strtoupper($row['first_name']) ?>" id="first-name" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-check-label fw-bold" for="middle-name">Middle name</label>
                        <input class="form-control name w-100" type="text" name="name" value="<?= strtoupper($row['middle_name']) ?>" id="middle-name" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-check-label fw-bold" for="current-grade-lvl">LRN</label>
                        <input class="form-control grade-level-grades" type="text" name="lrn" value="<?= $row['student_lrn'] ?>" id="current-grade-level" readonly>
                        <input class="form-control grade-level-id" type="hidden" name="id" value="<?= $row['enrollment_id'] ?>" id="current-id" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-check-label fw-bold" for="current-grade-lvl">Grade level</label>
                        <input class="form-control grade-level-grades" type="text" name="grade-level" value="<?= $row['grade_level'] ?>" id="current-grade-level" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-check-label fw-bold" for="section">Section</label>
                        <input class="form-control section-grades" type="text" name="section" value="<?= $row['section'] ?>" id="section" readonly>
                    </div>
                    <?php }} else { ?>
                    <div class="col-md-4">
                        <label class="form-check-label fw-bold" for="current-grade-lvl">Grade level</label>
                        <input class="form-control grade-level-grades" type="text" name="" value="Not enrolled" id="current-grade-level" readonly>
                    </div>
                    <div>
                        <label class="form-check-label fw-bold" for="section">Section</label>
                        <input class="form-control section-grades" type="text" name="section" value="Not enrolled" id="section" readonly>
                    </div>
                    <?php } ?>
                </div>

            </div>

            <table class="table border table-hover mt-2">
                <thead class="border-bottom">
                    <tr>
                        <th>Subject</th>
                        <th>1st quarter</th>
                        <th>2nd quarter</th>
                        <th>3rd quarter</th>
                        <th>4th quarter</th>
                        <th>Final</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <?php if (count($grades) > 0) { ?>
                <tbody>
                    <?php foreach ($grades as $row) { ?>
                    <tr>
                        <td>
                            <input class="form-control" type="hidden" name="subjects[]" id="" value="<?= $row['subject'] ?>" readonly>
                            <input style="background:white" class="form-control" type="text" name="subjects-display" id="" value="<?= $row['subject'] ?>" disabled>
                        </td>
                        <td>
                            <input class="form-control first-quarter" type="<?= $row['first_quarter'] != 'N/A' ? 'text' : "hidden" ?>" name="first-quarter[]" id="" value="<?= $row['first_quarter'] ?>">
                            <input class="form-control" type="<?= $row['first_quarter'] != 'N/A' ? 'hidden' : "text" ?>" name="first-quarter-display" id=""  value="<?= $row['first_quarter'] == 1 ? '' : 'N/A' ?>" <?= $row['first_quarter'] == 1 ? : 'disabled' ?>>
                        </td>
                        <td>
                            <input class="form-control second-quarter" type="<?= $row['second_quarter']!= 'N/A' ? 'text' : "hidden" ?>" name="second-quarter[]" id="" value="<?= $row['second_quarter'] ?>">
                            <input class="form-control" type="<?= $row['second_quarter'] != 'N/A' ? 'hidden' : "text" ?>" name="second-quarter-display" id="" value="<?= $row['second_quarter'] ?>" <?= $row['second_quarter'] == 1 ? : 'disabled' ?>>
                        </td>
                        <td>
                            <input class="form-control third-quarter" type="<?= $row['third_quarter'] != 'N/A' ? 'text' : "hidden" ?>" name="third-quarter[]" id="" value="<?= $row['third_quarter'] ?>">
                            <input class="form-control" type="<?= $row['third_quarter'] != 'N/A' ? 'hidden' : "text" ?>" name="third-quarter-display" id="" value="<?= $row['third_quarter'] ?>" <?= $row['third_quarter'] == 1 ? : 'disabled' ?>>
                        </td>
                        <td>
                            <input class="form-control fourth-quarter" type="<?= $row['fourth_quarter'] != 'N/A' ? 'text' : "hidden" ?>" name="fourth-quarter[]" id="" value="<?= $row['fourth_quarter'] ?>">
                            <input class="form-control" type="<?= $row['fourth_quarter'] != 'N/A' ? 'hidden' : "text" ?>" name="fourth-quarter-display" id="" value="<?= $row['fourth_quarter'] ?>" <?= $row['fourth_quarter'] == 1 ? : 'disabled' ?>>
                        </td>
                        <td>
                            <input type="text" name="" id="" class="form-control final-grade" disabled>
                        </td>
                        <td>
                            <input type="text" name="" id="" class="form-control remarks" disabled>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <button type="button" class="btn btn-primary review-grades">Review</button>
                        </td>
                        <td>
                            <input type="text" class="form-control total-final-grades" disabled>
                        </td>
                        <td>
                            <input type="hidden" name="total-remarks" id="" class="form-control total-remarks">
                            <input type="text" name="" id="" class="form-control total-remarks-display" disabled>
                        </td>
                    </tr>
                </tfoot>
                <?php } else { ?>
                <tbody>
                    <?php foreach ($subjects as $row) { ?>
                    <tr class=<?= $row['id'] ?>>
                        <td>
                            <input class="form-control" type="hidden" name="subjects[]" id="" value="<?= $row['subject'] ?>" readonly>
                            <input style="background:white" class="form-control" type="text" name="subjects-display" id="" value="<?= $row['subject'] ?>" disabled>
                        </td>
                        <td>
                            <input class="form-control first-quarter" type="<?= $row['quarter_1'] == 1 ? 'text' : "hidden" ?>" name="first-quarter[]" id="" value="<?= $row['quarter_1'] == 1 ? '' : 'N/A' ?>">
                            <input class="form-control" type="<?= $row['quarter_1'] == 1 ? 'hidden' : "text" ?>" name="first-quarter-display" id=""  value="<?= $row['quarter_1'] == 1 ? '' : 'N/A' ?>" <?= $row['quarter_1'] == 1 ? : 'disabled' ?>>
                        </td>
                        <td>
                            <input class="form-control second-quarter" type="<?= $row['quarter_2'] == 1 ? 'text' : "hidden" ?>" name="second-quarter[]" id="" value="<?= $row['quarter_2'] == 1 ? '' : 'N/A' ?>">
                            <input class="form-control" type="<?= $row['quarter_2'] == 1 ? 'hidden' : "text" ?>" name="second-quarter-display" id="" value="<?= $row['quarter_2'] == 1 ? '' : 'N/A' ?>" <?= $row['quarter_2'] == 1 ? : 'disabled' ?>>
                        </td>
                        <td>
                            <input class="form-control third-quarter" type="<?= $row['quarter_3'] == 1 ? 'text' : "hidden" ?>" name="third-quarter[]" id="" value="<?= $row['quarter_3'] == 1 ? '' : 'N/A' ?>">
                            <input class="form-control" type="<?= $row['quarter_3'] == 1 ? 'hidden' : "text" ?>" name="third-quarter-display" id="" value="<?= $row['quarter_3'] == 1 ? '' : 'N/A' ?>" <?= $row['quarter_3'] == 1 ? : 'disabled' ?>>
                        </td>
                        <td>
                            <input class="form-control fourth-quarter" type="<?= $row['quarter_4'] == 1 ? 'text' : "hidden" ?>" name="fourth-quarter[]" id="" value="<?= $row['quarter_4'] == 1 ? '' : 'N/A' ?>">
                            <input class="form-control" type="<?= $row['quarter_4'] == 1 ? 'hidden' : "text" ?>" name="fourth-quarter-display" id="" value="<?= $row['quarter_4'] == 1 ? '' : 'N/A' ?>" <?= $row['quarter_4'] == 1 ? : 'disabled' ?>>
                        </td>
                        <td>
                            <input type="text" name="" id="" class="form-control final-grade" disabled>
                        </td>
                        <td>
                            <input type="text" name="" id="" class="form-control remarks" disabled>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <button type="button" class="btn btn-primary review-grades">Review</button>
                        </td>
                        <td>
                            <input type="text" class="form-control total-final-grades" disabled>
                        </td>
                        <td>
                            <input type="hidden" name="total-remarks" id="" class="form-control total-remarks">
                            <input type="text" name="" id="" class="form-control total-remarks-display" disabled>
                        </td>
                    </tr>
                </tfoot>
                <?php } ?>
            </table>
            <div id="emailHelp" class="form-text ps-3" >* Valid inputs are above 65 and below 100.</div>
                <div id="emailHelp" class="form-text ps-3" >* Input 'INC' if incomplete grade.</div>
                <div id="emailHelp" class="form-text ps-3 mb-3" >* Please avoid letter inputs.</div>
            </div>
        <div class="modal-footer">
        <?php if (count($grades) > 0) { ?>
            <button class="btn btn-primary" type="submit" name="update-grade" value="submit">Submit</button>
        <?php } else { ?>
            <button class="btn btn-primary" type="submit" name="submit-grade" value="submit">Submit</button>
        <?php } ?>
        </div>
        <?php
        if (count($subjects) <= 0) {
            echo "<p class='p-2'>Add subject at <a href='../sabanges/operations.php'>operations</a> tab.</p>";
        }
        else{
        ?>
        
        <?php
        }
    }

    public function initGradeLevelsOptions($lrn, $grade_lvl){
        $results = $this->getGradeLevelsOptions($lrn, $grade_lvl);
        foreach ($results as $row) {
        ?>
        <option value="1">Grade 1</option>
        <?php
        }
    }

    // public function viewStudentForm($edit_id){
    //     $results = $this->studentForm($edit_id);
    //     return $results;
    // }
}