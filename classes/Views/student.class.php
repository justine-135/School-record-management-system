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
                            <form action="/sabanges/includes/student_view.inc.php" method="post" enctype="multipart/form-data">
                                <input type="text" name="id" id="id" value="<?= $row['id'] ?>" hidden>
                                <li><input class="dropdown-item" type="submit" value="Informations" name="informations"></li>
                                <li><a class="dropdown-item" href="#">Subjects</a></li>
                                <li><a class="dropdown-item" href="#">Grades</a></li>
                                <li><a class="dropdown-item" href="#">Delete</a></li>
                            </form>
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
    public function initSingleIndex(){
        ?>
        <main class="container-fluid w-90 border mt-4 p-4 bg-white">
        <h4 class="">Profile</h4>
        <div class="border mt-3">
            <div>
            <div class="d-flex justify-content-between align-items-center pt-3 px-3 border-bottom">
                <h5>Enrolled</h5>
                <form class="input-group mb-3 w-25" action="">
                    <input type="text" class="form-control" placeholder="Enter here" />
                    <button
                    class="btn btn-primary"
                    id="button-addon2"
                    type="submit"
                    >
                    Search
                    </button>
                </form> 
            </div>
            </div>
            <div class="table-responsive">
            </div>
        </div>
        </main>
        <?php
    }
}