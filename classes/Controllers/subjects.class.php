<?php

namespace Controllers;

include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/subjects.class.php';

class SubjectsController extends \Models\Subjects{
    public function initCreate($subject, $grade){
        $this->create($subject, $grade);
    }

    protected function checkValidation($subject, $grade){
        if ($this->exists($subject, $grade) !== false) {
            header("Location: ../operations.php");
        }

        else{
            $this->initCreate($subject, $grade);
        }
    }

    protected function initExists($subject, $grade){
        $results = $this->exists($subject, $grade);
    }
}