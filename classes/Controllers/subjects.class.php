<?php

namespace Controllers;

include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/subjects.class.php';

class SubjectsController extends \Models\Subjects{
    public function checkValidationSubject($subject, $grade, $quarter1, $quarter2, $quarter3, $quarter4){
        if ($this->initExists($subject, $grade) !== false) {
            header("Location: ../operations.php?operations&error&exists");
            die();
        }
        elseif ($this->validateSpecialChars($subject, $grade) !== false) {
            header("Location: ../operations.php?operations&error&value");
            die();
        }
        else{
            $this->create($subject, $grade, $quarter1, $quarter2, $quarter3, $quarter4);
            header("Location: ../operations.php?operations&submitted");
            die();
        }
    }

    protected function initExists($subject, $grade){
        $result = false;
        if (count($this->subjectExists($subject, $grade)) > 0) {
            $result = true;
        }
        return $result;
        
    }

    protected function validateSpecialChars($subject, $grade){
        $result = false;
        if (!preg_match("/^[a-zA-Z0-9\s]*$/", $subject) || !preg_match("/^[a-zA-Z0-9\s]*$/", $grade)) {
            $result = true;
        }
        return $result;
    }

}