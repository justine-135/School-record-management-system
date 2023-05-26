<?php
namespace Views;

class TeachersView extends \Models\Teachers{
    public function initIndex(){
        $rows = isset($_GET['row']) ? $_GET['row'] : '10';
        $page_no = isset($_GET['page_no']) ? $_GET['page_no'] : '1';
        $status = isset($_GET['status']) ? $_GET['status'] : 'active';
        $query = isset($_GET['query']) ? $_GET['query'] : '';

        $page_no = intval($page_no);

        $total_records_per_page = $rows;

        $offset = ($page_no - 1) * intval($total_records_per_page);
        $previous_page = $page_no - 1;
        $next_page = $page_no + 1;

        $result_count = $this->accountsCount($status);

        $records = count($result_count);
        
        $total_no_page = ceil($records / $total_records_per_page);
        $result = $this->index($offset, $total_records_per_page, $status, $query);

        $this->manageAdvisories(0,0);
        ?>

        <table class="table table-bordered border-top">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date registered</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Gender</th>
                    <th>Role</th>
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
                    <td><?= strtoupper($row['username']) ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['contact'] ?></td>
                    <td><?= $row['gender'] ?></td>
                    <td><?= $row['superadmin'] == 1 ? 'Superadmin' : ($row['admin'] == 1 ? 'Admin' : ($row['teacher'] == 1 ? 'Teacher' : ($row['guidance'] == 1 ? 'Guidance' : ($row['author'] == 1 ? 'Author' : 'None')))) ?></td>
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
                                <li>
                                    <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Permission
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <nav >
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link previous-btn <?= $page_no <= 1 ? 'disabled' : '' ?>" href="?row=<?= isset($_GET['row']) ? $_GET['row'] : 10 ?>&page_no=<?= $previous_page ?>&status=<?= isset($_GET['status']) ? $_GET['status'] : 'active' ?>">Previous</a>
                </li>
                <?php for ($i=0; $i < $total_no_page; $i++) { ?>

                <li class="page-item">
                    <a class="page-link page-number <?= $page_no !== $i + 1 ? '' : 'active'?>" href="?row=<?= isset($_GET['row']) ? $_GET['row'] : 10 ?>&page_no=<?= $i + 1 ?>&status=<?= isset($_GET['status']) ? $_GET['status'] : 'active' ?>"><?= $i + 1?></a>
                </li>
               
                <?php } ?>
                <li class="page-item">
                    <a class="page-link next-btn <?= $page_no >= $total_no_page ? 'disabled' : '' ?>" href="?row=<?= isset($_GET['row']) ? $_GET['row'] : 10 ?>&page_no=<?= $next_page ?>status=<?= isset($_GET['status']) ? $_GET['status'] : 'active' ?>">Next</a>
                </li>
            </ul>
            <span class="fw-semibold">Page <?= $page_no ?> out of <?= $total_no_page ?></span>
        </nav>
        <?php
    }

    public function manageAdvisories($email, $username){
        $advisories = $this->getAdvisories($email, $username);
        ?>
    
        <?php foreach ($advisories as $advisory) { ?>
        <div class="row">
            <div class="col-md">
                <label for="grade-level" class="form-label">Grade level</label>
                <input type="text" class="form-control" id='grade-level' value="<?= $advisory['grade_level'] ?>">
            </div>
            <div class="col-md">
                <label for="section" class="form-label">Section</label>
                <input type="text" class="form-control" id='section' value="<?= $advisory['section'] ?>">
            </div>
        </div>
        <?php } ?>
                
        <?php
    }
}

class TeacherInformationView extends \Models\Teachers{
    public function initSingleIndex($id){
        $result = $this->singleIndex($id);
        $advisories = $this->getAdvisories($result[0]['email'], $result[0]['username']);
        $role = $result[0]['superadmin'] == 1 ? 'superadmin' : ($result[0]['admin'] == 1 ? 'admin' : ($result[0]['teacher'] == 1 ? 'teacher':($result[0]['guidance'] == 1 ? 'guidance' : ($result[0]['author'] == 1 ? 'author' : ''))));
        ?>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <form class="submit-advisory-form" action="./includes/advisory.inc.php" method="post" enctype="multipart/form-data"> 
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body advisories-modal">
                            <input type="hidden" name="email" value="<?= $result[0]['email'] ?>">
                            <input type="hidden" name="username" value="<?= $result[0]['username'] ?>">
                        <div class="row ">
                            <!-- <div class="col-md-4">
                                <div id="emailHelp" class="form-text ps-3">*Add advisory classes to the user. Skip if not applicable.</div>
                            </div> -->
                            <div class="col-md">
                                <div class="d-flex align-items-end justify-content-between w-100">
                                    <div class="w-50">
                                        <label class="form-check-label fw-semibold" for="grade-level">Grade level</label>
                                        <select select class="form-select grade-select" id="grade-level" aria-label="Default select example" name="grade-lvl">
                                            <option value="Kindergarten">Kindergarten</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                        </select>
                                    </div>
                                <div>
                                    <label class="form-check-label fw-semibold" for="section">Section</label>
                                    <select class="form-select section-select" id="section" aria-label="Default select example"></select>
                                </div>
                                <button type="button" class="btn btn-primary add-advisory">Add</button>
                                </div>
                            </div>
                            </div>
                            <div class="row mt-3">
                            <div class="col-md">
                                <h6>List of advisory</h6>
                                <table class="table border advisory-table">
                                <thead>
                                    <tr>
                                    <th>Grade level</th>
                                    <th>Section</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="advisory-table-tbody">
                                    
                                </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="add" class="btn btn-primary submit-advisory">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="row gap-3">
            <div class="col-md">
                <div class="row border ">
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
                            <span class="d-block text-end"><?= $row['admin'] == 1 ? 'Admin' : ($row['superadmin'] == 1 ? 'Superadmin' : ($row['teacher'] == 1 ? 'Teacher' : ($row['guidance'] == 1 ? 'Guidance' : ($row['author'] == 1 ? 'Author' : 'No role')))); ?></span>
                        </div>
                    <?php } ?>
                    </div>
                    <div class="px-0">
                        <div class="py-2 px-2 border-top border-bottom">
                                <h6 class="m-0">Account information</h6>
                            </div>
                        <?php foreach($result as $row){ ?>
                        <div class="py-2 px-2">
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

                <form action="./includes/teachers.inc.php" method="post" enctype="multipart/form-data">

                <div class="row mt-3 border">
                    <div class="py-2 px-2 border-bottom">
                        <h6 class="m-0">Permission</h6>
                    </div>
                    <div class="col-md">
                            <input type="text" name="curr_role" value="<?= $role ?>" hidden>
                            <input type="text" name="id" value="<?= $result[0]['account_id'] ?>" hidden>
                            <div class="row p-3">
                                <div class="col-md">
                                    <div class="form-check">
                                        <input class="form-check-input role-radio-input" type="radio" name="role" id="flexRadioDefault1" value='teacher' <?= $result[0]['teacher'] == 1 ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Teacher
                                        </label>
                                        <div id="emailHelp" class="form-text">View students and informations.</div>
                                        <div id="emailHelp" class="form-text">Upload grades of learners.</div>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-check">
                                        <input class="form-check-input role-radio-input" type="radio" name="role" id="flexRadioDefault2" value='admin' <?= $result[0]['admin'] == 1 ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Admin
                                        </label>
                                        <div id="emailHelp" class="form-text ">Manage user accounts.</div>
                                        <div id="emailHelp" class="form-text ">Assign role and permissions to accounts.</div>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-check">
                                        <input class="form-check-input role-radio-input" type="radio" name="role" id="flexRadioDefault3" value='guidance' <?= $result[0]['guidance'] == 1 ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="flexRadioDefault3">
                                            Guidance
                                        </label>
                                        <div id="emailHelp" class="form-text">Enroll learners.</div>
                                        <div id="emailHelp" class="form-text">Promotes and retain learners.</div>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-check">
                                        <input class="form-check-input role-radio-input" type="radio" name="role" id="flexRadioDefault4" value='author' <?= $result[0]['author'] == 1 ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="flexRadioDefault4">
                                            Author
                                        </label>
                                    <div id="emailHelp" class="form-text ">Manage grades levels, sections, and subjects.</div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="d-flex border-top py-2">
                    <button class="btn btn-primary ms-auto" type="submit" name="submit-permission">Submit</button>
                </div>
                </form>

            </div>
        </div>

            <div class="border col-md-4" id="history-section">
                <div class="row">
                    <div class="d-flex align-items-center justify-content-between py-3 px-3 border-bottom">
                        <h5>Advisories</h5>
                        <a type="button" class="btn btn-primary advisory-link" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <?php include $_SERVER['DOCUMENT_ROOT'].'/sabanges/partials/add_icon.php'; ?>
                            Add
                        </a>
                    </div>
                    <?php foreach($advisories as $advisory){ ?>
                    <form class="px-0" action="./includes/advisory.inc.php" method="post" enctype="multipart/form-data">
                        <div class="w-100 py-2 border-bottom">
                            <div class="d-flex px-2">
                                <div class="d-flex flex-column  justify-content-between">
                                    <span class="fw-semibold">Grade level :</span>
                                    <span><?= $advisory['grade_level'] ?></span>
                                </div>
                                <div class="d-flex flex-column  justify-content-between ms-5">
                                    <span class="fw-semibold">Section :</span>
                                    <span><?= $advisory['section'] ?></span>
                                </div>
                                <input type="hidden" name="id" value='<?= $advisory['id'] ?>'>
                                
                                <button type='submit' name='delete' class="btn btn-danger ms-auto">Delete</button>
                            </div>
                        </div>                        
                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php
    }

    public function initSingleIndexHome(){
        $id = $_SESSION['account_id'];
        $result = $this->singleIndex($id);
        $advisories = $this->getAdvisories($result[0]['email'], $result[0]['username']);
        ?>
    
        <div class="container my-3">
            <div class="row">
                <div class="col-md-3">
                    <img class="rounded" style="object-fit: cover;" width=250px height=300px src=data:image;base64,<?= $result[0]['image'] ?>>
                    <div class="mt-2">
                        <div class="fw-semibold fs-5">
                            <?= ucfirst($result[0]['surname']) . ', ' . ucfirst($result[0]['first_name']) . ' ' . ucfirst($result[0]['middle_name']) ?> <?= $result[0]['ext_name'] == 'None' ? '' : $result[0]['ext_name'] ?>
                        </div>
                        <div>
                            
                        </div>
                    </div>
                </div>
                <main class="col-md">
                    <div class="d-flex align-items-center border p-2">
                        <div class="me-2 text-nowrap">My advisory</div>
                        <?php if (count($advisories) == 0) { ?>
                        <select class="form-select form-select-sm class-select" name="class-form-select" id="">
                            <option value=",">None</option>
                        </select>
                        <?php } else { ?>
                        <select class="form-select form-select-sm class-select" name="class-form-select" id="">
                            <?php foreach ($advisories as $advisory) { 
                                ?>
                                <option value="<?= $advisory['grade_level'] ?>,<?= $advisory['section'] ?>"><?= $advisory['grade_level'] . ' - ' . $advisory['section'] ?></option>
                            <?php } ?>
                        </select>
                        <?php } ?>
                    </div>
                    <div class="student-dashboard mt-2"></div>
                </main>
            </div>
        </div> 
        <?php
    }

    public function initIndexStudentDashboard($grade_level, $section){
        $dashboards = $this->indexDashboard($grade_level, $section);
        $total_student_count = count($dashboards);
        $total_male_count = 0;
        $total_female_count = 0;
        foreach ($dashboards as $dashboard) {
            if ($dashboard['gender'] == 'Male') {
                $total_male_count++;
            }
            else{
                $total_female_count++;
            }
        }
        ?>
        <div class="container border">
            <div class="row gap-0">
                <div class="col-md p-0">
                    <div class="d-flex flex-column align-items-center p-5 text-center">
                        <span class='fw-bold fs-4'>
                        <?= $total_student_count ?>

                        </span>
                        <span class="text-secondary">
                            Total students
                        </span>
                    </div>
                </div>
                <div class="col-md p-0">
                    <div class="d-flex flex-column align-items-center p-5 text-center">
                        <span class='fw-bold fs-4'>
                        <?= $total_male_count ?>

                        </span>
                        <span class="text-secondary">
                            Male students
                        </span>
                    </div>
                </div>
                <div class="col-md p-0">
                    <div class="d-flex flex-column align-items-center p-5 text-center">
                        <span class='fw-bold fs-4'>
                        <?= $total_female_count ?>

                        </span>
                        <span class="text-secondary">
                            Female students
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-0 mt-2">
            <table class="table table-hover border-top table-bordered dashboard-table w-100">
                <thead>
                    <tr>
                        <th>
                            LRN
                        </th>
                        <th>
                            Image
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            Class
                        </th>
                        <th>
                            Gender
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dashboards as $dashboard) { ?>
                    <tr>
                        <td><?= $dashboard['lrn'] ?></td>
                        <td class="d-flex align-items-center justify-content-center border-0"><img class="rounded-circle" style="object-fit: cover;" width=50px height=50px src=data:image;base64,<?= $dashboard['image'] ?>></td>
                        <td><?= ucfirst($dashboard['surname']) . ', ' . ucfirst($dashboard['first_name']) . ' ' . ucfirst($dashboard['middle_name']) ?></td>
                        <td><?= $dashboard['grade_level'] !== 'Kindergarten' ? 'Grade ' . $dashboard['grade_level'] : $dashboard['grade_level'] ?> - <?= $dashboard['section'] ?></td>
                        <td><?= $dashboard['gender'] ?></td>
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
                                    <input class="student-id" type="hidden" name="id" id="id" value="<?= $dashboard['student_id'] ?>" >
                                    <li><a class="dropdown-item" href="../sabanges/student_informations.php?id=<?= $dashboard['student_id']?>">Informations</a></li>
                                    <li><a class="dropdown-item" href="../sabanges/student_informations.php?id=<?= $dashboard['student_id']?>#grades-section">Grades</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        
        <?php
    }
}