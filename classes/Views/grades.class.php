<?php
namespace Views;

// include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/grades.class.php';

class GradesView extends \Models\Grades{
    public function loadGrades($lrn){
        ?>
        <div class="accordion" id="accordionPanelsStayOpenExample">
            <?php 
            $failed = 0;

            for ($i=1; $i <= 6; $i++)

            { ?>
            <div class="accordion-item  border border-top-0">
                <h2 class="accordion-header" id="panelsStayOpen-<?= $i ?>">
                <button class="accordion-button border-top" type="button" data-bs-toggle="collapse" data-bs-target="#grade-table-<?= $i ?>" aria-expanded="false" aria-controls="panelsStayOpen-<?= $i ?>collapseOne">
                    Grade level - <?= $i  ?>
                </button>
                </h2>
                <div id="grade-table-<?= $i ?>" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-<?= $i ?>">
                    <div class="accordion-body">
                    <?php
                    if ($i == 1) {
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
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $final_avg = 0;
                                $j = 0;
                                foreach ($result as $row) { 
                                    $number_col = 4;
                                    $final = 0;
                                    if (strtoupper($row['first_quarter']) == 'N/A' ) {
                                        $number_col = $number_col - 1;
                                    }
                                    if (strtoupper($row['second_quarter']) == 'N/A') {
                                        $number_col = $number_col - 1;
                                    }
                                    if (strtoupper($row['third_quarter']) == 'N/A' ) {
                                        $number_col = $number_col - 1;
                                    }
                                    if (strtoupper($row['fourth_quarter']) == 'N/A' ) {
                                        $number_col = $number_col - 1;
                                    }
                                    if ($number_col == 0) {
                                        $final = 0;
                                    }
                                    else{
                                        $final = (number_format((float)$row['first_quarter'], 2, '.', '') + number_format((float)$row['second_quarter'], 2, '.', '') + number_format((float)$row['third_quarter'], 2, '.', '') + number_format((float)$row['fourth_quarter'], 2, '.', '')) / $number_col;
                                    }
                                    $final_avg += $final;
                                    $j++;

                                    if ($final < 75) {
                                        $failed++;
                                    }
                                    // $failed = $final < 75 ? $failed++ : 0;
                                ?>
                                <tr>
                                    <td><input class="form-control" type="text" name="" id="" value="<?= $row['subject'] ?>" readonly></td>
                                    <td><input class="form-control" type="text" name="" id="" value="<?= (strtoupper($row['first_quarter']) == 'N/A' ? 'N/A' : (strtoupper($row['first_quarter']) == 'INC' ? 'INC' : number_format((float)$row['first_quarter'], 2, '.', ''))) ?>"  <?= strtoupper($row['first_quarter']) == 'N/A' ? 'disabled' : 'readonly'?>></td>
                                    <td><input class="form-control" type="text" name="" id="" value="<?= (strtoupper($row['second_quarter']) == 'N/A' ? 'N/A' : (strtoupper($row['second_quarter']) == 'INC' ? 'INC' : number_format((float)$row['second_quarter'], 2, '.', ''))) ?>" <?= strtoupper($row['second_quarter']) == 'N/A' ? 'disabled' : 'readonly' ?>></td>
                                    <td><input class="form-control" type="text" name="" id="" value="<?= (strtoupper($row['third_quarter']) == 'N/A' ? 'N/A' : (strtoupper($row['third_quarter']) == 'INC' ? 'INC' : number_format((float)$row['third_quarter'], 2, '.', ''))) ?>" <?= strtoupper($row['third_quarter']) == 'N/A' ? 'disabled' : 'readonly'?>></td>
                                    <td><input class="form-control" type="text" name="" id="" value="<?= (strtoupper($row['fourth_quarter']) == 'N/A' ? 'N/A' : (strtoupper($row['fourth_quarter']) == 'INC' ? 'INC' : number_format((float)$row['fourth_quarter'], 2, '.', ''))) ?>" <?= strtoupper($row['fourth_quarter']) == 'N/A' ? 'disabled' : 'readonly'?>></td>
                                    <td><input class="form-control final-grade-display" type="text" name="" id="" value="<?= number_format((float)$final, 2, '.', '')?>" readonly></td>
                                    <td><input class="form-control" type="text" name="" id="" value="<?= $final > 74 ? 'PASSED' : 'FAILED' ?>" readonly></td>
                                </tr>   
                                <?php }
                                $final_avg = $final_avg / $j;
                                ?>
                            </tbody>
                            <tfoot>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><input class="form-control" type="text" value="<?= number_format((float)$final_avg, 2, '.', '') ?>"></td>
                                <td><input class="form-control" type="text" value="<?= $failed > 0 && $failed <= 2 ? 'CONDITIONALLY PROMOTED' : ($failed >= 3 ? 'RETAINED' : 'PROMOTED') ?>"></td>
                            </tfoot>
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