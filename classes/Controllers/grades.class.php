<?php

namespace Controllers;

include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/grades.class.php';

class GradesController extends \Models\Grades{
    public function initUpdate($id, $lrn, $grade_level, $section, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter, $remark, $rows, $status, $page_no){
        if ($this->initValidateUser($_SESSION['email'], $_SESSION['username'], $grade_level, $section, ) !== false) {
            header("Location: ../grading.php?grades&error&permission&rows={$rows}&status={$status}&page_no={$page_no}");
            die();
        }
        elseif ($this->emptyInputs($lrn, $grade_level, $section, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter) !== false) {
            header("Location: ../grading.php?grades&error&empty&rows={$rows}&status={$status}&page_no={$page_no}");
            die();
        }
        elseif ($this->numberPeriods($subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter) !== false) {
            header("Location: ../grading.php?grades&error&characters&rows={$rows}&status={$status}&page_no={$page_no}");
            die();
        }
        elseif ($this->minimunMaximumGrades($subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter) !== false) {
            header("Location: ../grading.php?grades&error&value&rows={$rows}&status={$status}&page_no={$page_no}");
            die();
        }
        elseif($this->initGradingPeriod() !== false){
            header("Location: ../grading.php?grades&error&schedule&rows={$rows}&status={$status}&page_no={$page_no}");
            die();
        }
        else{
            $this->update($id, $lrn, $grade_level, $section, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter, $remark);
            header("Location: ../grading.php?grades&submitted&rows={$rows}&page_no={$page_no}&status={$status}");
            die();
        }
    }
    public function initCreate($id, $lrn, $grade_level, $section, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter, $remark, $rows, $status, $page_no){
        if ($this->initValidateUser($_SESSION['email'], $_SESSION['username'], $grade_level, $section, ) !== false) { 
            header("Location: ../grading.php?grades&error&permission&rows={$rows}&status={$status}&page_no={$page_no}");
            die();
        }
        elseif ($this->emptyInputs($lrn, $grade_level, $section, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter) !== false) {
            header("Location: ../grading.php?grades&error&empty&rows={$rows}&status={$status}&page_no={$page_no}");
            die();
        }
        elseif ($this->initGradesExists($lrn, $grade_level, $section, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter) !== false) {
            header("Location: ../grading.php?grades&error&exist&rows={$rows}&status={$status}&page_no={$page_no}");
            die();
        }
        elseif ($this->initStudentEnrolled($lrn, $grade_level) !== false) {
            header("Location: ../grading.php?grades&error&unenrolled&rows={$rows}&status={$status}&page_no={$page_no}");
            die();
        }
        elseif ($this->numberPeriods($subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter) !== false) {
            header("Location: ../grading.php?grades&error&characters&rows={$rows}&status={$status}&page_no={$page_no}");
            die();
        }
        elseif ($this->minimunMaximumGrades($subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter) !== false) {
            header("Location: ../grading.php?grades&error&value&rows={$rows}&status={$status}&page_no={$page_no}");
            die();
        }
        elseif($this->initGradingPeriod() !== false){
            header("Location: ../grading.php?grades&error&schedule&rows={$rows}&status={$status}&page_no={$page_no}");
            die();
        }
        else{
            $this->create($id, $lrn, $grade_level, $section, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter, $remark);
            header("Location: ../grading.php?grades&submitted&rows={$rows}&status={$status}&page_no={$page_no}");
            die();
        }
    }

    protected function initValidateUser($email, $username, $grade_level, $section){
        $result = true;
        if (count($this->validateUser($email, $username, $grade_level, $section)) > 0) {
            $result = false;
        }
        if ($_SESSION['is_superadmin'] == 1) {
            $result = false;
        }
        return $result;
    }

    protected function initGradesExists($lrn, $grade_level, $section, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter){
        $result = false;
        if (count($this->gradesExists($lrn, $grade_level, $section, $subjects)) > 0) {
            $result = true;
        }
        return $result;
    }

    protected function emptyInputs($lrn, $grade_level, $section, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter){
        
        $result = false;
        for ($i=0; $i < count($subjects); $i++) { 
            if (empty($lrn) || empty($grade_level) || empty($subjects[$i])) {
                $result = true;
                break;
            }
        }
        return $result;
    }

    protected function numberPeriods($subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter){
        $result = false;
        for ($i=0; $i < count($subjects); $i++) { 

            if (is_numeric($first_quarter[$i]) || is_numeric($second_quarter[$i]) || is_numeric($third_quarter[$i]) || is_numeric($fourth_quarter[$i])) {
                $result = false;
            }
            else{
                if (strtoupper($first_quarter[$i]) !== 'INC' && strtoupper($first_quarter[$i]) !== 'N/A' ||
                strtoupper($second_quarter[$i]) !== 'INC' && strtoupper($second_quarter[$i]) !== 'N/A' || 
                strtoupper($third_quarter[$i]) !== 'INC' && strtoupper($third_quarter[$i]) !== 'N/A' || 
                strtoupper($fourth_quarter[$i]) !== 'INC' && strtoupper($fourth_quarter[$i]) !== 'N/A') {
                    $result = true;
                    break;
                }
            }
        }
        return $result;
    }

    protected function minimunMaximumGrades($subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter){
        $result = false;
        for ($i=0; $i < count($subjects); $i++) { 
            if ($first_quarter[$i] !== 'N/A' && strtoupper($first_quarter[$i]) !== 'INC') {
                $result = $this->checkGradeValue($first_quarter[$i]);
                if ($result === true) {
                    break;
                }
            }
            if ($second_quarter[$i] !== 'N/A' && strtoupper($second_quarter[$i]) !== 'INC') {
                $result = $this->checkGradeValue($second_quarter[$i]);
                if ($result === true) {
                    break;
                }
            }
            if ($third_quarter[$i] !== 'N/A' && strtoupper($third_quarter[$i]) !== 'INC') {
                $result = $this->checkGradeValue($third_quarter[$i]);
                if ($result === true) {
                    break;
                }
            }
            if ($fourth_quarter[$i] !== 'N/A' && strtoupper($fourth_quarter[$i]) !== 'INC') {
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
        if (intval($quarter_grades) < 60 || intval($quarter_grades) > 100) {
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

    protected function initGradingPeriod(){
        $result = false;

        $schedules = $this->gradingPeriod();

        $presentDate = date('Y-m-d');
        $presentDate = date('Y-m-d', strtotime($presentDate));
        
        foreach ($schedules as $schedule) {
            $start_period = $schedule['from'];
            $end_period = $schedule['to'];

            if (($presentDate >= $start_period) && ($presentDate <= $end_period)){
                $result = false;
                break;
            }else{
                $result = true;
            }
        }
        
        return $result;
    }
}