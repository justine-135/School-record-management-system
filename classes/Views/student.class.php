<?php
namespace Views;

include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/student.class.php';

class StudentView extends \Models\Student{
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

        ?>

        <?php if ($view == 'grading') { ?>
        <form class="" action="./includes/grades.inc.php" method="post" enctype="multipart/form-data">
            <div class="modal fade add-grade-form" id="add-grade-modal" aria-hidden="true" aria-labelledby="add-grade-modalLabel" tabindex="-1">
                <div class="modal-dialog modal-fullscreen modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="add-grade-modalLabel">Grade learner</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body grading-modal-body">
                        </div>
                        <div class="modal-footer">
                        <button class="btn btn-primary" type="submit" name="submit-grade" value="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php } ?>

        <table class="table table-hover mb-0 border-top student-table">
            <thead>
                <tr>
                    <th scope="col">     
                        <div class="d-flex">
                            <span class="me-2">#</span>      
                            <?php if ($view == 'promotion') { ?>            
                            <div class="form-check">
                                <input class="form-check-input masterlist-chkbox-all" type="checkbox" value="" id="flexCheckDefault">
                            </div>
                            <?php } ?>
                        </div>
                    </th>
                    <th scope="col">LRN</th>
                    <th scope="col">Student</th>
                    <th scope="col">Enrolled at</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Grade Level</th>
                    <th scope="col">Section</th>
                    <th scope="col">Status</th>
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
                                <?= $row['enrollment_id'] ?>
                                </span>
                                <?php if ($view == 'promotion') { ?>            
                                <div class="form-check">
                                    <input class="form-check-input masterlist-chkbox" type="checkbox" name="chkbox-student[]" value="<?= $row['student_id'] ?>,<?= $row['student_lrn'] ?>,<?= $row['grade_level'] ?>" id="flexCheckDefault">
                                </div>
                                <?php } ?>
                            </div>
                        </td>
                        <td><?= $row['lrn'] ?></td>
                        <td><?= strtoupper($row['surname']) . ', ' . strtoupper($row['first_name']) . ' ' . strtoupper($row['middle_name'])  ?> <?= strtoupper($row['ext']) == 'NONE' ? '' : strtoupper($row['ext']) ?></td>
                        <td><?= $row['enrolled_at'] ?></td>
                        <td><?= $row['gender'] ?></td>
                        <td><?= $row['grade_level'] ?></td>
                        <td><?= $row['section'] ?></td>
                        <td>
                            <p class="<?= $row['status'] === "Active" ? "text-primary" : "text-success"?> text-center fw-semibold">
                                <?= $row['status'] ?>
                            </p>
                        </td>
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
                            Grade learner
                            <?php include $_SERVER['DOCUMENT_ROOT'].'/sabanges/partials/add_icon.php' ?>
                            </a>     
                            <input type="hidden" name="lrn" value="<?= $row['lrn'] ?>" id="">
                            <input type="hidden" name="grade-level" value="<?= $row['grade_level'] ?>" id="">
                            <input type="hidden" name="section" value="<?= $row['section'] ?>" id="">
                            <?php } ?>
                        </td>
                    </tr>
                <?php 
                    }
                ?>
            </tbody>
        </table>
        <nav class="m-2">
            <ul class="pagination">
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
        foreach ($result as $row) {
            $result2 = $this->enrollmentHistory($row['student_lrn']);
        }
        $grade_levels = array();
        foreach ($result2 as $row2) {
            array_push($grade_levels, $row2['grade_level']);
        }
        // count($result) === 0 ? header("Location: ./student_informations.php?id={$id}&err=not_found") : "";
        ?>
        <div class="row gap-3">
            <form class="border col-md" action="./includes/enrollment.inc.php" method="post" enctype="multipart/form-data">
                <div class="row ">
                    <div class="d-flex align-items-center justify-content-between py-3 px-3 border-bottom">
                        <h5>Information</h5>
                        <a class="btn btn-primary" href="../sabanges/student_informations.php?id=<?= $result[0]['student_id'] ?>&edit_enrollment">
                        Edit
                        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/partials/edit_icon.php'; ?>
                        </a>
                    </div>
                    <div class="d-flex align-items-center justify-content-between py-3 px-3">
                        <div>
                        <?php foreach($result as $row){ ?>
                            <img class="rounded-circle" width=200px height=200px src=data:image;base64,<?= $row['image'] ?>>
                        <?php } ?>
                        </div>
                        <div class="ms-3 py-1 w-75">
                        <?php foreach($result as $row){ ?>
                            <h2 class="text-end"><?= strtoupper($row['surname']) . ", " . strtoupper($row['first_name']) . " " . strtoupper($row['middle_name']) . " " ?> <?= strtoupper($row['ext']) == 'NONE' ? '' : strtoupper($row['ext']) ?></h2>
                            <span class="d-block text-end"> <?= strtoupper($row['lrn']) ?></span>
                            <span class="d-block text-end">Grade level - <?= $row['grade_level'] ?></span>
                        <?php } ?>
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
                                    <?php if (isset($_GET['edit_enrollment'])) { ?>
                                    <input  class="form-control " type="text" name="lrn" id="" value="<?= $row['lrn'] ?>">
                                    <?php } else { ?>
                                    <span><?= strtoupper($row['lrn']) ?></span>
                                    <?php } ?>
                                </div>
                                <div class="col-md py-1">
                                    <span class="fw-semibold">Grade level : </span>
                                    <?php if (isset($_GET['edit_enrollment'])) { ?>
                                    <select class="form-select grade-select-enrollment-edit" id="grade-level" aria-label="Default select example" name="grade-lvl">
                                        <option value="Kindergarten" <?= $row['grade_level'] == 'Kindergarten' ? 'selected' : '' ?>>Kindergarten</option>
                                        <option value="1" <?= $row['grade_level'] == '1' ? 'selected' : '' ?>>1</option>
                                        <option value="2" <?= $row['grade_level'] == '2' ? 'selected' : '' ?> >2</option>
                                        <option value="3" <?= $row['grade_level'] == '3' ? 'selected' : '' ?> >3</option>
                                        <option value="4" <?= $row['grade_level'] == '4' ? 'selected' : '' ?> >4</option>
                                        <option value="5" <?= $row['grade_level'] == '5' ? 'selected' : '' ?> >5</option>
                                        <option value="6" <?= $row['grade_level'] == '6' ? 'selected' : '' ?> >6</option>
                                    </select>
                                    <?php } else { ?>
                                    <span><?= strtoupper($row['grade_level']) ?></span>
                                    <?php } ?>
                                </div>
                                <div class="col-md py-1">
                                    <span class="fw-semibold">Section : </span>
                                    <?php if (isset($_GET['edit_enrollment'])) { ?>
                                    <select class="form-select section-select-enrollment-edit" id="section" aria-label="Default select example" name="section">
                                        <option value="None" selected>Choose</option>
                                    </select>                                    
                                    <?php } else { ?>
                                    <span><?= $row['section'] ?></span>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php if (isset($_GET['edit_enrollment'])) { ?>

                            <div class="row py-2 px-2">
                                <div class="col-md-4 py-1">
                                    <span class="fw-semibold">From sy :</span>
                                    <input type="number" class="form-control from-sy-textbox" id="from-sy" placeholder="Enter year" name="from-sy" value="<?= $row['from_sy'] ?>" required>
                                </div>
                                <div class="col-md-4 py-1">
                                    <span class="fw-semibold">To sy :</span>
                                    <input type="number" class="form-control to-sy-textbox" id="to-sy" placeholder="Enter year" name="to-sy" value="<?= $row['to_sy'] ?>" required>
                                </div>
                            </div>
                            <?php } ?>
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
                            <input type="hidden" name="enrollment_id" id="" value="<?= $row['enrollment_id'] ?>">
                            <input type="hidden" name="student_id" id="" value="<?= $row['student_id'] ?>">
                            <input type="hidden" name="curr-grade-level" id="" value="<?= $row['grade_level'] ?>">
                            <input type="hidden" name="curr-section" id="" value="<?= $row['section'] ?>">
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
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#enrollment-modal">
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
    }

    public function addGradesTable($grade_level, $lrn){
        $result = $this->subjectIndex($grade_level);
        $result2 = $this->gradeSection($grade_level, $lrn);
        if (count($result) <= 0) {
            echo "<p class='p-2'>Add subject at <a href='../sabanges/operations.php'>operations</a> tab.</p>";
        }
        else{
        ?>
        <div class="d-flex flex-column">
            <?php if (count($result2) > 0) {
             foreach ($result2 as $row) { ?>
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
                </tr>
            </thead>
            <tbody>

                <?php foreach ($result as $row) {?>
                <tr>
                    <td>
                        <input class="form-control" type="hidden" name="subjects[]" id="" value="<?= $row['subject'] ?>" readonly>
                        <input style="background:white" class="form-control" type="text" name="subjects-display" id="" value="<?= $row['subject'] ?>" disabled>
                    </td>
                    <td>
                        <input class="form-control" type="<?= $row['quarters'] <= 4 ? 'text' : "hidden" ?>" name="first-quarter[]" id="" value=<?= $row['quarters'] <= 4 ? '' : "N/A" ?>>
                        <input class="form-control" type="<?= $row['quarters'] <= 4 ? 'hidden' : "text" ?>" name="first-quarter-display" id="" value=<?= $row['quarters'] <= 4 ? '' : "N/A" ?> <?= $row['quarters'] <= 4 ? '' : 'disabled' ?>>
                    </td>
                    <td>
                        <input class="form-control" type="<?= $row['quarters'] <= 4 && $row['quarters'] >= 2 ? 'text' : "hidden" ?>" name="second-quarter[]" id="" value=<?= $row['quarters'] <= 4 && $row['quarters'] >= 2 ? '' : "N/A" ?>>
                        <input class="form-control" type="<?= $row['quarters'] <= 4 && $row['quarters'] >= 2 ? 'hidden' : "text" ?>" name="second-quarter-display" id="" value=<?= $row['quarters'] <= 4 && $row['quarters'] >= 2 ? '' : "N/A" ?> <?= $row['quarters'] <= 4 && $row['quarters'] >= 2 ? '' : 'disabled' ?>>
                    </td>
                    <td>
                        <input class="form-control" type="<?= $row['quarters'] >= 3 ? 'text' : "hidden" ?>" name="third-quarter[]" id="" value=<?= $row['quarters'] >= 3 ? '' : "N/A" ?> >
                        <input class="form-control" type="<?= $row['quarters'] >= 3 ? 'hidden' : "text" ?>" name="third-quarter-display" id="" value=<?= $row['quarters'] >= 3 ? '' : "N/A" ?> <?= $row['quarters'] >= 3 ? '' : 'disabled' ?>>
                    </td>
                    <td>
                        <input class="form-control" type="<?= $row['quarters'] == 4 ? 'text' : "hidden" ?>" name="fourth-quarter[]" id="" value=<?= $row['quarters'] == 4 ? '' : "N/A" ?>>
                        <input class="form-control" type="<?= $row['quarters'] == 4 ? 'hidden' : "text" ?>" name="fourth-quarter-display" id="" value=<?= $row['quarters'] == 4 ? '' : "N/A" ?> <?= $row['quarters'] == 4 ? '' : 'disabled' ?>>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <div id="emailHelp" class="form-text ps-3" >* Valid inputs are above 65 and below 100.</div>
            <div id="emailHelp" class="form-text ps-3" >* Input 'INC' if incomplete grade.</div>
            <div id="emailHelp" class="form-text ps-3 mb-3" >* Please avoid letter inputs.</div>
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