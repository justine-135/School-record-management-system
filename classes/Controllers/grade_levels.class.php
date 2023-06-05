<?php

namespace Controllers;

include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/grade_levels.class.php';

class GradeLevelsController extends \Models\GradeLevels{
    public function initCreate($grade, $section){
        if ($this->initExists($grade, $section) !== false) {
            header("Location: ../operations_sections.ph?operations&error&exist");
            die();
        }
        elseif ($this->validateSpecialChars($section) !== false) {
            header("Location: ../operations_subjects.php?operations&error&value");
            die();
        }
        else{
            $this->create($grade, $section);
            header("Location: ../operations_sections.php?operations&submitted");
            die();
        }
    }

    protected function initExists($grade, $section){
        $result = false;
        $exist = $this->singleIndex($grade, $section);

        if (count($exist) > 0) {
            $result = true;
        }
        
        return $result;
    }

    protected function validateSpecialChars($section){
        $result = false;
        if (!preg_match("/^[a-zA-Z0-9\s]*$/", $section)) {
            $result = true;
        }
        return $result;
    }

    public function initDestroy($id){
        $this->destroy($id);
        header("Location: ../operations_sections.php?id=" . $id . "&operations_sections&deleted");
        die();
    }
}