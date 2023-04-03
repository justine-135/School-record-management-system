<?php
namespace Views;

include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/student.class.php';

class StudentView extends \Models\Student{
    public function initIndex($query){
        $results = $this->index($query);
        ?>
        <table class="table table-hover mb-0 student-table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">LRN</th>
                    <th scope="col">Student name</th>
                    <th scope="col">Enrolled at</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Grade Level</th>
                    <th scope="col">Section</th>
                    <th scope="col">Adviser</th>
                    <th scope="col">Type</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($results as $row) {
                ?>
                    <tr>
                        <th scope="row"><?= $row['id'] ?></th>
                        <td><?= $row['lrn'] ?></td>
                        <td><?= strtoupper($row['surname']) . ', ' . strtoupper($row['first_name']) . ' ' . strtoupper($row['middle_name'])  ?></td>
                        <td><?= $row['enrolled_at'] ?></td>
                        <td><?= $row['gender'] ?></td>
                        <td><?= $row['grade_level'] ?></td>
                        <td>Rose</td>
                        <td>Daryl</td>
                        <td>Old</td>
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
                                <input class="student-id" type="hidden" name="id" id="id" value="<?= $row['id'] ?>" >
                                <!-- <li><input type="submit" class="dropdown-item information-links" name="information" value="Information"></li> -->
                                <li><a class="dropdown-item" href="../sabanges/student_informations.php?id=<?= $row['id']?>">Informations</a></li>
                                <li><a class="dropdown-item" href="#">Grades</a></li>
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
        // count($result) === 0 ? header("Location: ./student_informations.php?id={$id}&err=not_found") : "";
        ?>
        <h4 class="">Profile</h4>
        <div class="row">
            <div class="border mt-3 col-md-6">
                <div class="row ">
                    <div class="d-flex align-items-center justify-content-between py-3 px-3 border-bottom">
                        <h5>Information</h5>
                        <a href="../sabanges/enrollment.php">
                        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/partials/edit_icon.php'; ?>
                        </a>
                    </div>
                    <div class="d-flex align-items-center justify-content-between border-bottom py-3 px-3">
                        <div class="profile-div">
                            <input class="profile-input" type="file" name="" id="">
                            <img class="profile-round" src="./images/profile.png" alt="">
                        </div>
                        <div class="ms-3 py-1 w-75">
                        <?php foreach($result as $row){ ?>
                            <h3 class="text-end"><?= strtoupper($row['surname']) . ", " . strtoupper($row['first_name']) . " " . strtoupper($row['middle_name']) ?></h3>
                            <span class="d-block text-end"> <?= strtoupper($row['lrn']) ?></span>
                            <span class="d-block text-end">Grade level - <?= $row['grade_level'] ?></span>
                        <?php } ?>
                        </div>
                    </div>
                    <div class="">
                        <?php foreach($result as $row){ ?>
                        <div class="w-100 text-end">
                            <div class="py-2 px-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="fw-bold">LRN :</span>
                                    <span><?= $row['lrn'] ?></span>
                                </div>
                            </div>
                            <div class="py-2 px-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="fw-bold">Surname :</span>
                                    <span><?= strtoupper($row['surname']) ?></span>
                                </div>
                            </div>
                            <div class="py-2 px-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="fw-bold">First name :</span>
                                    <span><?= strtoupper($row['first_name']) ?></span>
                                </div>
                            </div>
                            <div class="py-2 px-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="fw-bold">Middle name :</span>
                                    <span><?= strtoupper($row['middle_name']) ?></span>
                                </div>
                            </div>
                            <div class="py-2 px-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="fw-bold">Gender :</span>
                                    <span><?= strtoupper($row['gender']) ?></span>
                                </div>
                            </div>
                            <div class="py-2 px-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="fw-bold">Birth date :</span>
                                    <div>
                                        <span class="bday"><?= strtoupper($row['birth_date']) ?></span>
                                        <span class="age-calc fw-light">(16)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="py-2 px-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="fw-bold">Mother's name :</span>
                                    <span><?= strtoupper($row['mother_surname']) . ", " . strtoupper($row['mother_first_name']) . " " . strtoupper($row['mother_middle_name']) ?></span>
                                </div>
                            </div>
                            <div class="py-2 px-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="fw-bold">Father's name :</span>
                                    <span><?= strtoupper($row['father_surname']) . ", " . strtoupper($row['father_first_name']) . " " . strtoupper($row['father_middle_name']) ?></span>
                                </div>
                            </div>
                            <div class="py-2 px-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="fw-bold">Guardian's name :</span>
                                    <span><?= strtoupper($row['guardian_surname']) . ", " . strtoupper($row['guardian_first_name']) . " " . strtoupper($row['guardian_middle_name']) ?></span>
                                </div>
                            </div>
                            <div class="py-2 px-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="fw-bold">Current address :</span>
                                    <span class="w-50"><?= $row['house_street'] . ". " . $row['subdivision'] . " " . $row['barangay'] . " " . $row['city'] . ", " . $row['province'] ?></span>
                                </div>
                            </div>
                            <div class="py-2 px-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="fw-bold">Religion :</span>
                                    <span><?= strtoupper($row['religion']) ?></span>
                                </div>
                            </div>
                        </div>
                        
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="border mt-3 col-md-6">
            <?php foreach($result as $row){ ?>
                <div class="row">
                    <div class="d-flex justify-content-between align-items-center py-3 px-3 border-bottom">
                        <h5>Subjects</h5>
                    </div>
                    <div class="d-flex justify-content-between align-items-center py-3 px-3 border-bottom">
                        <h5>Enrolled History</h5>
                    </div>
                    <div class="w-100 py-2 px-3 border-bottom">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="fw-bold">School year :</span>
                            <span><?= $row['from_sy'] . " - " . $row['to_sy'] ?></span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="fw-bold">Grade level :</span>
                            <span><?= $row['grade_level'] ?></span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="fw-bold">School :</span>
                            <span><?= $row['school'] ?></span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="fw-bold">Status :</span>
                            <span class="fw-bold text-success"><?= $row['status'] ?></span>
                        </div>
                    </div>
                    
                </div>
            <?php } ?>
            </div>
        </div>
        <?php
    }
}