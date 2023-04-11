<?php
namespace Views;

// include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/grades.class.php';

class GradesView extends \Models\Grades{
    public function initIndex($lrn){
        ?>
        <div class="border mt-3 col-md">
                <div class="d-flex align-items-center justify-content-between py-3 px-3">
                    <h5>Grades</h5>          
                    <a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Open first modal</a>     
                </div>
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    <?php for ($i=0; $i <= 6; $i++) { ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-<?= $i ?>">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#grade-table-<?= $i ?>" aria-expanded="false" aria-controls="panelsStayOpen-<?= $i ?>collapseOne">
                            Grade level - <?= $i == 0 ? 'Kindergarten' : $i  ?>
                        </button>
                        </h2>
                        <div id="grade-table-<?= $i ?>" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-<?= $i ?>">
                            <div class="accordion-body">
                                <form action=""></form>
                                <table class="table">
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
                                        <?php
                                        if ($i == 0) {
                                            $grade_lvl = "Kindergarten";
                                        }
                                        elseif ($i == 1){
                                            $grade_lvl = 1;
                                        }  
                                        elseif ($i == 2){
                                            $grade_lvl = 2;
                                        }  
                                        elseif ($i == 3){
                                            $grade_lvl = 3;
                                        }  
                                        elseif ($i == 4){
                                            $grade_lvl = 4;
                                        }  
                                        elseif ($i == 5){
                                            $grade_lvl = 5;
                                        }  
                                        elseif ($i == 6){
                                            $grade_lvl = 6;
                                        }  

                                        $result = $this->index($lrn, $grade_lvl)
                                        ?>

                                        <?php foreach ($result as $row) { ?>
                                        <tr>
                                            <td><?= $row['subject'] ?></td>
                                            <td><input type="text" name="" id="" value="<?= $row['first_quarter'] ?>" disabled></td>
                                            <td><input type="text" name="" id="" value="<?= $row['second_quarter'] ?>" disabled></td>
                                            <td><input type="text" name="" id="" value="<?= $row['third_quarter'] ?>" disabled></td>
                                            <td><input type="text" name="" id="" value="<?= $row['fourth_quarter'] ?>" disabled></td>
                                            <td><input type="text" name="" id="" disabled></td>
                                        </tr>   
                                        <?php } ?>
                                    </tbody>
                                </table>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php
    }
}