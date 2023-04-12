<?php
namespace Views;

include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/student.class.php';

class StudentView extends \Models\Student{
    public function initIndex($query){
        $results = $this->index($query);
        ?>
        <table class="table table-hover mb-0 border-top student-table">
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
                    <th scope="col">Student</th>
                    <th scope="col">Enrolled at</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Grade Level</th>
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
                                <div class="form-check">
                                    <input class="form-check-input masterlist-chkbox" type="checkbox" name="chkbox-student[]" value="<?= $row['student_id'] ?>,<?= $row['lrn'] ?>,<?= $row['grade_level'] ?>" id="flexCheckDefault">
                                </div>
                            </div>
                        </td>
                        <td><?= $row['lrn'] ?></td>
                        <td><?= strtoupper($row['surname']) . ', ' . strtoupper($row['first_name']) . ' ' . strtoupper($row['middle_name'])  ?></td>
                        <td><?= $row['enrolled_at'] ?></td>
                        <td><?= $row['gender'] ?></td>
                        <td><?= $row['grade_level'] ?></td>
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
                                    <!-- <li><input type="submit" class="dropdown-item information-links" name="information" value="Information"></li> -->
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

        
        <?php
            
    }
}

class StudentInformationView extends \Models\Student{
    public function initSingleIndex($id){
        $result = $this->singleIndex($id);
        foreach ($result as $row) {
            $result2 = $this->enrollmentHistory($row['lrn']);
        }
        $grade_levels = array();
        foreach ($result2 as $row2) {
            array_push($grade_levels, $row2['grade']);
        }
        // count($result) === 0 ? header("Location: ./student_informations.php?id={$id}&err=not_found") : "";
        ?>
        <h4 class="">Profile</h4>
        <div class="row gap-3">
            <div class="border mt-3 col-md">
                <div class="row ">
                    <div class="d-flex align-items-center justify-content-between py-3 px-3 border-bottom">
                        <h5>Information</h5>
                        <a href="../sabanges/enrollment.php">
                        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/partials/edit_icon.php'; ?>
                        </a>
                    </div>
                    <div class="d-flex align-items-center justify-content-between py-3 px-3">
                        <div class="profile-div">
                            <input class="profile-input" type="file" name="" id="">
                            <img class="profile-round" src="./images/profile.png" alt="">
                        </div>
                        <div class="ms-3 py-1 w-75">
                        <?php foreach($result as $row){ ?>
                            <h2 class="text-end"><?= strtoupper($row['surname']) . ", " . strtoupper($row['first_name']) . " " . strtoupper($row['middle_name']) ?></h2>
                            <span class="d-block text-end"> <?= strtoupper($row['lrn']) ?></span>
                            <span class="d-block text-end">Grade level - <?= $row['grade_level'] ?></span>
                        <?php } ?>
                        </div>
                    </div>
                    <div class="px-0">
                        <?php foreach($result as $row){ ?>
                        <div class="border-top py-2 px-2">
                            <div class="row">
                                <div class="col-md py-1">
                                    <span class="fw-semibold">LRN : </span>
                                    <span><?= $row['lrn'] ?></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 py-1">
                                    <span class="fw-semibold">Surname :</span>
                                    <span><?= strtoupper($row['surname']) ?></span>
                                </div>
                                <div class="col-md-4 py-1">
                                    <span class="fw-semibold">First name :</span>
                                    <span><?= strtoupper($row['first_name']) ?></span>
                                </div>
                                <div class="col-md-4 py-1">
                                    <span class="fw-semibold">Middle name :</span>
                                    <span><?= strtoupper($row['middle_name']) ?></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 py-1">
                                    <span class="fw-semibold">Gender :</span>
                                    <span><?= strtoupper($row['gender']) ?></span>
                                </div>
                                <div class="col-md-4 py-1">
                                    <span class="fw-semibold">Religion :</span>
                                    <span><?= strtoupper($row['religion']) ?></span>
                                </div>
                                <div class="col-md-4 py-1">
                                    <span class="fw-semibold">Birth date :</span>
                                    <span class="bday"><?= strtoupper($row['birth_date']) ?></span>
                                    <span class="age-calc fw-light">(16)</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md py-1">
                                    <span class="fw-semibold">Current address :</span>
                                    <span class="w-50"><?= $row['house_street'] . ". " . $row['subdivision'] . " " . $row['barangay'] . " " . $row['city'] . ", " . $row['province'] ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="py-2 px-2 border-top border-bottom">
                            <h6 class="">Mother</h6>
                        </div>
                        <div class="py-2 px-2">
                            <div class="row">
                                <div class="col-md-4 py-1">
                                    <span class="fw-semibold">Surname :</span>
                                    <span><?= strtoupper($row['mother_surname']) ?></span>
                                </div>
                                <div class="col-md-4 py-1">
                                    <span class="fw-semibold">First name :</span>
                                    <span><?= strtoupper($row['mother_first_name']) ?></span>
                                </div>
                                <div class="col-md-4 py-1">
                                    <span class="fw-semibold">Middle name :</span>
                                    <span><?= strtoupper($row['mother_middle_name']) ?></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md py-1">
                                    <span class="fw-semibold">Educational attainment :</span>
                                    <span><?= $row['mother_education'] ?></span>
                                </div>
                                <div class="col-md py-1">
                                    <span class="fw-semibold">Employment :</span>
                                    <span><?= $row['mother_employment'] ?></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 py-1">
                                    <span class="fw-semibold">Contact number :</span>
                                    <span><?= $row['mother_contact_number'] ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="py-2 px-2 border-top border-bottom">
                            <h6 class="">Father</h6>
                        </div>
                        <div class="py-2 px-2">
                            <div class="row">
                                <div class="col-md-4 py-1">
                                    <span class="fw-semibold">Surname :</span>
                                    <span><?= strtoupper($row['father_surname']) ?></span>
                                </div>
                                <div class="col-md-4 py-1">
                                    <span class="fw-semibold">First name :</span>
                                    <span><?= strtoupper($row['father_first_name']) ?></span>
                                </div>
                                <div class="col-md-4 py-1">
                                    <span class="fw-semibold">Middle name :</span>
                                    <span><?= strtoupper($row['father_middle_name']) ?></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md py-1">
                                    <span class="fw-semibold">Educational attainment :</span>
                                    <span><?= $row['father_education'] ?></span>
                                </div>
                                <div class="col-md py-1">
                                    <span class="fw-semibold">Employment :</span>
                                    <span><?= $row['father_employment'] ?></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 py-1">
                                    <span class="fw-semibold">Contact number :</span>
                                    <span><?= $row['father_contact_number'] ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="py-2 px-2 border-top border-bottom">
                            <h6 class="">Guardian</h6>
                        </div>
                        <div class="py-2 px-2">
                            <div class="row">
                                <div class="col-md-4 py-1">
                                    <span class="fw-semibold">Surname :</span>
                                    <span><?= strtoupper($row['guardian_surname']) ?></span>
                                </div>
                                <div class="col-md-4 py-1">
                                    <span class="fw-semibold">First name :</span>
                                    <span><?= strtoupper($row['guardian_first_name']) ?></span>
                                </div>
                                <div class="col-md-4 py-1">
                                    <span class="fw-semibold">Middle name :</span>
                                    <span><?= strtoupper($row['guardian_middle_name']) ?></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md py-1">
                                    <span class="fw-semibold">Educational attainment :</span>
                                    <span><?= $row['guardian_education'] ?></span>
                                </div>
                                <div class="col-md py-1">
                                    <span class="fw-semibold">Employment :</span>
                                    <span><?= $row['guardian_employment'] ?></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 py-1">
                                    <span class="fw-semibold">Contact number :</span>
                                    <span><?= $row['guardian_contact_number'] ?></span>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="container border mt-3 col-md-4" id="history-section">
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
                            <span><?= $row2['grade'] ?></span>
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
        
        <div class="border mt-3 col-md" id="grades-section">

        <div class="d-flex align-items-center justify-content-between py-3 px-3">
            <h5>Grades</h5>          
            <a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button">
                Grade learner

                <?php include $_SERVER['DOCUMENT_ROOT'].'/sabanges/partials/add_icon.php' ?>

            </a>     
        </div>
        <div class="row grades-section" id="<?= $result2[0]['student_lrn'] ?>">
            <input type="text" name="grade-lvl" value="<?= $result2[0]['lrn'] ?>" id="">
            </div>
        </div>

        <?php
    }

    public function addGradesTable($grade_lvl){
        $result = $this->subjectIndex($grade_lvl);
        ?>
        <thead>
            <tr>
                <th>Subject</th>
                <th>1st quarter</th>
                <th>2nd quarter</th>
                <th>3rd quarter</th>
                <th>4th quarter</th>
                <th>Average</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $row) {?>
            <tr>
                <td><input type="text" name="subjects[]" id="" value="<?= $row['subject'] ?>" ></td>
                <td><input type="text" name="first-quarter[]" id=""></td>
                <td><input type="text" name="second-quarter[]" id=""></td>
                <td><input type="text" name="third-quarter[]" id=""></td>
                <td><input type="text" name="fourth-quarter[]" id=""></td>
                <td><input type="text" name="" id="" disabled></td>
            </tr>
            <?php } ?>
        </tbody>
        <?php
    }

    public function initGradeLevelsOptions($lrn, $grade_lvl){
        $results = $this->getGradeLevelsOptions($lrn, $grade_lvl);
        foreach ($results as $row) {
        ?>
        <option value="1">Grade 1</option>
        <?php
        }
    }
}