<?php

namespace Controllers;

include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/grade_levels.class.php';

class GradeLevelsController extends \Models\GradeLevels{
    public function initCreate($grade, $section){
        $this->create($grade, $section);
        header("Location: ../operations_sections.php?operations_sections&submitted");
        die();
    }

    protected function checkValidation($grade, $section){
        if ($this->exists($grade, $section) !== false) {
            header("Location: ../operations_sections.ph?operations_sections&err&exist");
            die();
        }

        else{
            $this->initCreate($grade, $section);
            header("Location: ../operations_sections.ph?operations_sections&submitted");
            die();
        }
    }

    protected function initExists($grade, $section){
        $results = $this->exists($grade, $section);
    }

    public function initDestroy($id){
        $this->destroy($id);
        header("Location: ../operations_sections.php?id=" . $id . "&operations_sections&deleted");
        die();
    }
}