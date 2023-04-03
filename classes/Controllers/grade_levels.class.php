<?php

namespace Controllers;

include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/grade_levels.class.php';

class GradeLevelsController extends \Models\GradeLevels{
    public function initCreate($grade, $section){
        $this->create($grade, $section);
    }

    protected function checkValidation($grade, $section){
        if ($this->exists($grade, $section) !== false) {
            header("Location: ../operations.php");
        }

        else{
            $this->initCreate($grade, $section);
        }
    }

    protected function initExists($grade, $section){
        $results = $this->exists($grade, $section);
    }
}