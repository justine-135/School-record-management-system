<?php
namespace Views;

class TeachersView extends \Models\Teachers{
    public function initIndex(){
        $result = $this->index();
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date registered</th>
                    <th>Teacher</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Gender</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $row) { ?>
                <tr>
                    <td><?= $row['account_id'] ?></td>
                    <td><?= $row['added_at'] ?></td>
                    <td>
                        <?= 
                        $row['ext_name'] === "None" ? strtoupper($row['surname']) . ', ' . strtoupper($row['first_name']) . ' ' . strtoupper($row['middle_name']) :
                        strtoupper($row['surname']) . ', ' . strtoupper($row['first_name']) . ' ' . strtoupper($row['middle_name']) . ' ' . strtoupper($row['ext_name'])
                        ?>
                    </td>
                    <td><?= $row['username'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['contact'] ?></td>
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
                                <input class="student-id" type="hidden" name="id" id="id" value="<?= $row['teacher_id'] ?>" >
                                <!-- <li><input type="submit" class="dropdown-item information-links" name="information" value="Information"></li> -->
                                <li><a class="dropdown-item" href="../sabanges/account_informations.php?id=<?= $row['teacher_id']?>">Informations</a></li>
                                <li><a class="dropdown-item" href="../sabanges/account_informations.php?id=<?= $row['teacher_id']?>#grades-section">Grades</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php
    }
}

class TeacherInformationView extends \Models\Teachers{
    public function initSingleIndex($id){
        $result = $this->singleIndex($id);
        ?>
        <h4 class="">Profile</h4>
        <div class="row d-flex flex-column align-items-center">
            <div class="border mt-3 col-md">
                <div class="row ">
                    <div class="d-flex align-items-center justify-content-between py-3 px-3 border-bottom">
                        <h5>Information</h5>
                        <a href="../sabanges/enrollment.php">
                        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/partials/edit_icon.php'; ?>
                        </a>
                    </div>
                    <div class="d-flex align-items-center justify-content-between py-3 px-3">
                    <?php foreach($result as $row){ ?>
                        <div class="profile-div">
                            <img class="rounded-circle" width=200px height=200px src=data:image;base64,<?= $row['image'] ?>>
                        </div>
                        <div class="ms-3 py-1 w-75">
                            <h2 class="text-end"><?= strtoupper($row['surname']) . ", " . strtoupper($row['first_name']) . " " . strtoupper($row['middle_name']) ?></h2>
                            <span class="d-block text-end"></span>
                            <span class="d-block text-end"></span>
                        </div>
                    <?php } ?>
                    </div>
                    <div class="px-0">
                        <?php foreach($result as $row){ ?>
                        <div class="border-top py-2 px-2">
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
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}