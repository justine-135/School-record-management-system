<?php
namespace Views;

// include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/grades.class.php';

class GradesView extends \Models\Grades{
    public function loadGrades($lrn){
        ?>
        <div class="accordion" id="accordionPanelsStayOpenExample">
            <?php for ($i=0; $i <= 6; $i++) { ?>
            <div class="accordion-item  border border-top-0">
                <h2 class="accordion-header" id="panelsStayOpen-<?= $i ?>">
                <button class="accordion-button border-top" type="button" data-bs-toggle="collapse" data-bs-target="#grade-table-<?= $i ?>" aria-expanded="false" aria-controls="panelsStayOpen-<?= $i ?>collapseOne">
                    Grade level - <?= $i == 0 ? 'Kindergarten' : $i  ?>
                </button>
                </h2>
                <div id="grade-table-<?= $i ?>" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-<?= $i ?>">
                    <div class="accordion-body">
                    <?php
                    if ($i == 0) {
                        $grade_lvl = "Kindergarten";
                        $result = $this->index($lrn, $grade_lvl);
                    }
                    elseif ($i == 1){
                        $grade_lvl = 1;
                        $result = $this->index($lrn, $grade_lvl);
                    }  
                    elseif ($i == 2){
                        $grade_lvl = 2;
                        $result = $this->index($lrn, $grade_lvl);
                    }  
                    elseif ($i == 3){
                        $grade_lvl = 3;
                        $result = $this->index($lrn, $grade_lvl);
                    }  
                    elseif ($i == 4){
                        $grade_lvl = 4;
                        $result = $this->index($lrn, $grade_lvl);
                    }  
                    elseif ($i == 5){
                        $grade_lvl = 5;
                        $result = $this->index($lrn, $grade_lvl);
                    }  
                    elseif ($i == 6){
                        $grade_lvl = 6;
                        $result = $this->index($lrn, $grade_lvl);
                    }
                    
                    if (count($result) > 0) {
                    ?>
                    <div class="table-responsive">
                        <table class="table table-responsive border">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>1st quarter</th>
                                    <th>2nd quarter</th>
                                    <th>3rd quarter</th>
                                    <th>4th quarter</th>
                                    <th>Final</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($result as $row) { 
                                    $number_col = 4;
                                    $final = 0;
                                    if (strtoupper($row['first_quarter']) == 'N/A' || strtoupper($row['first_quarter']) == 'INC') {
                                        $number_col = $number_col - 1;
                                    }
                                    if (strtoupper($row['second_quarter']) == 'N/A' || strtoupper($row['second_quarter']) == 'INC') {
                                        $number_col = $number_col - 1;
                                    }
                                    if (strtoupper($row['third_quarter']) == 'N/A' || strtoupper($row['third_quarter']) == 'INC') {
                                        $number_col = $number_col - 1;
                                    }
                                    if (strtoupper($row['fourth_quarter']) == 'N/A' || strtoupper($row['fourth_quarter']) == 'INC') {
                                        $number_col = $number_col - 1;
                                    }
                                    if ($number_col == 0) {
                                        $final = 0;
                                    }
                                    else{
                                        $final = (number_format((float)$row['first_quarter'], 2, '.', '') + number_format((float)$row['second_quarter'], 2, '.', '') + number_format((float)$row['third_quarter'], 2, '.', '') + number_format((float)$row['fourth_quarter'], 2, '.', '')) / $number_col;
                                    }
                                ?>
                                <tr>
                                    <td><input class="form-control" type="text" name="" id="" value="<?= $row['subject'] ?>" readonly></td>
                                    <td><input class="form-control" type="text" name="" id="" value="<?= (strtoupper($row['first_quarter']) == 'N/A' ? 'N/A' : (strtoupper($row['first_quarter']) == 'INC' ? 'INC' : number_format((float)$row['first_quarter'], 2, '.', ''))) ?>"  <?= strtoupper($row['first_quarter']) == 'N/A' ? 'disabled' : 'readonly'?>></td>
                                    <td><input class="form-control" type="text" name="" id="" value="<?= (strtoupper($row['second_quarter']) == 'N/A' ? 'N/A' : (strtoupper($row['second_quarter']) == 'INC' ? 'INC' : number_format((float)$row['second_quarter'], 2, '.', ''))) ?>" <?= strtoupper($row['second_quarter']) == 'N/A' ? 'disabled' : 'readonly' ?>></td>
                                    <td><input class="form-control" type="text" name="" id="" value="<?= (strtoupper($row['third_quarter']) == 'N/A' ? 'N/A' : (strtoupper($row['third_quarter']) == 'INC' ? 'INC' : number_format((float)$row['third_quarter'], 2, '.', ''))) ?>" <?= strtoupper($row['third_quarter']) == 'N/A' ? 'disabled' : 'readonly'?>></td>
                                    <td><input class="form-control" type="text" name="" id="" value="<?= (strtoupper($row['fourth_quarter']) == 'N/A' ? 'N/A' : (strtoupper($row['fourth_quarter']) == 'INC' ? 'INC' : number_format((float)$row['fourth_quarter'], 2, '.', ''))) ?>" <?= strtoupper($row['fourth_quarter']) == 'N/A' ? 'disabled' : 'readonly'?>></td>
                                    <td><input class="form-control final-grade-display" type="text" name="" id="" value="<?= number_format((float)$final, 2, '.', '')?>" readonly></td>
                                </tr>   
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                        <?php } else { ?>
                            <p>No grades recorded.</p>
                        <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <?php
    }

}