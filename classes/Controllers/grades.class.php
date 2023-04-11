<?php

namespace Controllers;

include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/grades.class.php';

class GradesController extends \Models\Grades{
    public function initCreate($id, $lrn, $grade_lvl, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter){
        if ($this->initGradesExists($lrn, $grade_lvl, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter) !== false) {
            header("Location: ../student_informations.php?id=" . $id . "&grade_exist#grades-section");
        }
        else{
            $this->create($lrn, $grade_lvl, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter);
            header("Location: ../student_informations.php?id=" . $id . "&added#grades-section");
        }
    }

    protected function initGradesExists($lrn, $grade_lvl, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter){
        $result = false;
        if (count($this->gradesExists($lrn, $grade_lvl, $subjects)) > 0) {
            $result = true;
        }
        return $result;
    }
}