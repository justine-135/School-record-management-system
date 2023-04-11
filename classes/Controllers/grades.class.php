<?php

namespace Controllers;

include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/grades.class.php';

class GradesController extends \Models\Grades{
    public function initCreate($id, $lrn, $grade_lvl, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter){
        if ($this->initGradesExists($lrn, $grade_lvl, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter) !== false) {
            header("Location: ../student_informations.php?id=" . $id . "&err=grade_exist#grades-section");
            die();
        }
        elseif ($this->emptyInputs($lrn, $grade_lvl, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter) !== false) {
            header("Location: ../student_informations.php?id=" . $id . "&err=empty_input#grades-section");
            die();
        }
        else{
            $this->create($lrn, $grade_lvl, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter);
            header("Location: ../student_informations.php?id=" . $id . "&added#grades-section");
            die();
        }
    }

    protected function initGradesExists($lrn, $grade_lvl, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter){
        $result = false;
        if (count($this->gradesExists($lrn, $grade_lvl, $subjects)) > 0) {
            $result = true;
        }
        return $result;
    }

    protected function emptyInputs($lrn, $grade_lvl, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter){
        $result = false;
        for ($i=0; $i < count($subjects); $i++) { 
            if (empty($lrn) || empty($grade_lvl) || empty($subjects[$i]) || empty($first_quarter[$i]) || empty($second_quarter[$i]) || empty($third_quarter[$i]) || empty($fourth_quarter[$i])) {
                $result = true;
                break;
            }
        }
        return $result;
    }
}