<?php

namespace Controllers;

include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/grades.class.php';

class GradesController extends \Models\Grades{
    public function initCreate($id, $lrn, $grade_level, $section, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter){
        session_start();
        if ($this->initValidateUser($_SESSION['email'], $grade_level, $section, )) {
            # code...
        }
        elseif ($this->initGradesExists($lrn, $grade_level, $section, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter) !== false) {
            header("Location: ../student_informations.php?id=" . $id . "&grades&error&exist");
            die();
        }
        elseif ($this->emptyInputs($lrn, $grade_level, $section, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter) !== false) {
            header("Location: ../student_informations.php?id=" . $id . "&grades&error&empty");
            die();
        }
        elseif ($this->initStudentEnrolled($lrn, $grade_level) !== false) {
            header("Location: ../student_informations.php?id=" . $id . "&grades&error&unenrolled");
            die();
        }
        elseif ($this->numberPeriods($subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter) !== false) {
            header("Location: ../student_informations.php?id=" . $id . "&grades&error&characters");
            die();
        }
        elseif ($this->minimunMaximumGrades($subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter) !== false) {
            header("Location: ../student_informations.php?id=" . $id . "&grades&error&value");
            die();
        }
        else{
            $this->create($lrn, $grade_level, $section, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter);
            header("Location: ../student_informations.php?id=" . $id . "&grades&submitted");
            die();
        }
    }

    protected function initValidateUser($email, $grade_level, $section){
        $result = false;
        if (count($this->validateUser($email, $grade_level, $section)) > 0) {
            $result = true;
        }
        var_dump($result);
        die();
    }

    protected function initGradesExists($lrn, $grade_level, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter){
        $result = false;
        if (count($this->gradesExists($lrn, $grade_level, $subjects)) > 0) {
            $result = true;
        }
        return $result;
    }

    protected function emptyInputs($lrn, $grade_level, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter){
        $result = false;
        for ($i=0; $i < count($subjects); $i++) { 
            if (empty($lrn) || empty($grade_level) || empty($subjects[$i]) || empty($first_quarter[$i]) || empty($second_quarter[$i]) || empty($third_quarter[$i]) || empty($fourth_quarter[$i])) {
                $result = true;
                break;
            }
        }
        return $result;
    }

    protected function numberPeriods($subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter){
        $result = true;
        for ($i=0; $i < count($subjects); $i++) { 
            if (is_numeric($first_quarter[$i]) || is_numeric($second_quarter[$i]) || is_numeric($third_quarter[$i]) || is_numeric($fourth_quarter[$i])) {
                var_dump($first_quarter[$i]);
                $result = false;
            }
            else{
                $result = true;
                break;
            }
        }
        return $result;
    }

    protected function minimunMaximumGrades($subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter){
        $result = false;
        for ($i=0; $i < count($subjects); $i++) { 
            if ($first_quarter[$i] !== 'Disabled') {
                $result = $this->checkGradeValue($first_quarter[$i]);
                if ($result === true) {
                    break;
                }
            }
            if ($second_quarter[$i] !== 'Disabled') {
                $result = $this->checkGradeValue($second_quarter[$i]);
                if ($result === true) {
                    break;
                }
            }
            if ($third_quarter[$i] !== 'Disabled') {
                $result = $this->checkGradeValue($third_quarter[$i]);
                if ($result === true) {
                    break;
                }
            }
            if ($fourth_quarter[$i] !== 'Disabled') {
                $result = $this->checkGradeValue($fourth_quarter[$i]);
                if ($result === true) {
                    break;
                }
            }
        }
        return $result;
    }

    protected function checkGradeValue($quarter_grades){
        $result = false;
        if (intval($quarter_grades) < 65 || intval($quarter_grades) > 100) {
            $result = true;
        }
        return $result;
    }

    protected function initStudentEnrolled($lrn, $grade_level){
        $result = false;
        if (count($this->studentEnrolled($lrn, $grade_level)) === 0) {
            $result = true;
        }
        return $result;
    }
}