<?php

namespace Controllers;

include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/subjects.class.php';

class SubjectsController extends \Models\Subjects{
    public function checkValidationSubject($subject, $grade, $quarter){
        if ($this->initExists($subject, $grade) !== false) {
            header("Location: ../operations.php");
            die();
        }
        elseif ($this->validateSpecialChars($subject, $grade) !== false) {
            echo "special chards";
            die();
        }
        else{
            $this->create($subject, $grade, $quarter);
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