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
                    <th scope="row"><?php echo $row['id'] ?></th>
                    <td><?php echo $row['lrn'] ?></td>
                    <td><?php echo strtoupper($row['surname']) . ', ' . strtoupper($row['first_name']) . ' ' . strtoupper($row['middle_name'])  ?></td>
                    <td><?php echo $row['enrolled_at'] ?></td>
                    <td><?php echo $row['gender'] ?></td>
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
                        <li><a class="dropdown-item" href="#">Informations</a></li>
                        <li><a class="dropdown-item" href="#">Subjects</a></li>
                        <li><a class="dropdown-item" href="#">Grades</a></li>
                        <li><a class="dropdown-item" href="#">Delete</a></li>
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