<?php
namespace Views;

include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/student.class.php';

class StudentView extends \Models\Student{
    public function initIndex(){
        $results = $this->index();
        ?>
        <table class="table table-hover student-table mb-5">
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
              <th scope="col">Application Type</th>
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
                    <td>4</td>
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
                            <!-- <form action="/sabanges/includes/student_view.inc.php" method="get" enctype="multipart/form-data"> -->
                                <input type="text" name="id" id="id" value="<?= $row['id'] ?>" >
                                <!-- <input type="text" name="view" id="id" value="student_information" >
                                <li><input class="dropdown-item" type="submit" value="Informations" name="informations"></li> -->
                                <li><a class="dropdown-item" href=<?= './student_informations.php?id=' . $row['id'];?>>Informations</a></li>
                                <li><a class="dropdown-item" href="#">Grades</a></li>
                                <li><a class="dropdown-item" href="#">Delete</a></li>
                            <!-- </form> -->
                        </ul>
                    </div>
                    </td>
                </tr>
            <?php 
                }
            ?>
          </tbody>
          <tfoot>
          <th scope="col">#</th>
          <th scope="col">Student name</th>
          <th scope="col">Enrolled at</th>
          <th scope="col">Grade level</th>
          <th scope="col">Section</th>
          <th scope="col">Adviser</th>
          <th scope="col">LRN</th>
          <th scope="col">Application type</th>
          <th scope="col">Action</th>
          </tfoot>
        </table>
        <?php
            
    }
}

class StudentInformationView extends \Models\Student{
    public function initSingleIndex($id){
        $result = $this->singleIndex($id);
        ?>
        <main class="container-fluid w-90 border mt-4 p-4 bg-white">
        <h4 class="">Profile</h4>
        <div class="row">
            <div class="border mt-3 col-md-6">
                <div class="row ">
                    <div class="d-flex align-items-center justify-content-between py-3 px-3 border-bottom">
                        <h5>Information</h5>
                        <a href="">
                        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/partials/edit_icon.php'; ?>
                        </a>
                    </div>
                    <div class="d-flex align-items-center justify-content-between border-bottom py-3 px-3">
                        <div class="profile-div">
                            <input class="profile-input" type="file" name="" id="">
                            <img class="profile-round" src="./images/profile.png" alt="">
                        </div>
                        <div class="ms-3 py-1 w-50">
                            <h3 class="text-end">UPANO, JUSTINE RAY CABANG</h3>
                            <span class="d-block text-end">2919293929192</span>
                            <span class="d-block text-end">Grade 4 - Rose</span>
                        </div>
                    </div>
                    <div class="">
                        <?php foreach($result as $row){ ?>
                        <div class="w-100">
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
                                    <span class="fw-bold">Mother's name :</span>
                                    <span>Justine Upano</span>
                                </div>
                            </div>
                            <div class="py-2 px-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="fw-bold">Father's name :</span>
                                    <span>Justine Upano</span>
                                </div>
                            </div>
                            <div class="py-2 px-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="fw-bold">Guardian's name :</span>
                                    <span>Justine Upano</span>
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
                <div class="row">
                    <div class="d-flex justify-content-between align-items-center py-3 px-3 border-bottom">
                        <h5>Subjects</h5>
                    </div>
                    <div class="d-flex justify-content-between align-items-center py-3 px-3">
                        <h5>Enrolled History</h5>
                    </div>
                </div>
            </div>
        </div>
        </main>
        <?php
    }
}