<?php

namespace Controllers;

use DateTime;

include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/enrollment_history.class.php';

class EnrollmentHistoryController extends \Models\EnrollmentHistory{
    public function checkValidationHistory($id, $lrn, $from_sy, $to_sy, $old_grade_lvl, $grade_lvl, $status){
        if ($this->emptyInputs($lrn, $from_sy, $to_sy, $grade_lvl, $status) !== false) {
            header("Location: ../student_informations.php?id=" . $id . "&history&error&empty");
            die();
        }
        elseif ($this->initEnrollmentHistoryExists($lrn, $from_sy, $to_sy, $grade_lvl, $status) !== false) {
            header("Location: ../student_informations.php?id=" . $id . "&history&error&exist");
            die();
        }
        elseif ($this->invalidSchoolYear($from_sy, $to_sy) !== false) {
            header("Location: ../student_informations.php?id=" . $id . "&history&error&sy");
            die();
        }
        elseif ($this->invalidGradeLevel($old_grade_lvl, $grade_lvl) !== false) {
            header("Location: ../student_informations.php?id=" . $id . "&history&error&level");
            die();
        }
        else{
            $this->create($lrn, $from_sy, $to_sy, $grade_lvl, $status);
            header("Location: ../student_informations.php?id=" . $id . "&history&submitted");
            die();
        }
    }

    protected function initEnrollmentHistoryExists($lrn, $from_sy, $to_sy, $grade_lvl, $status){
        $result = false;
        $exists = $this->enrollmentHistoryExists($lrn, $from_sy, $to_sy, $grade_lvl, $status);
        if (count($exists) > 0) {
            $result = true;
        }
        return $result;
    }

    protected function emptyInputs($lrn, $from_sy, $to_sy, $grade_lvl, $status){
        $result = false;
        if (empty($lrn) || empty($from_sy) || empty($to_sy) || empty($grade_lvl) || empty($status)) {
            $result = true;
        }
        return $result;
    }

    protected function invalidSchoolYear($from_sy, $to_sy){
        $result = false;
        if ($from_sy > $to_sy) {
            $result = true;
        }
        return $result;
    }

    protected function invalidGradeLevel($old_grade_lvl, $grade_lvl){
        $result = false;
        if ($old_grade_lvl == "Kindergarten") {
            $result = true;
        }
        else{
            if (intval($grade_lvl) > intval($old_grade_lvl)) {
                $result = true;
            }
        }
        return $result;
    }
}