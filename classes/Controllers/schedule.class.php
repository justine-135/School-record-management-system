<?php

namespace Controllers;

include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/schedule.class.php';

class ScheduleController extends \Models\Schedule{
    public function initCreate($start, $end){
        $this->create($start, $end);
        header("Location: ../operations_grading.php?operations_grading&submitted");
        die();
    }
    public function initDestroy($id){
        $this->destroy($id);
        header("Location: ../operations_grading.php?id=" . $id . "&operations_grading&deleted");
        die();
    }
}