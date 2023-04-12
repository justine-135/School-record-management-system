<?php

namespace Controllers;

include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/promotion_retention.class.php';

class PromotionRetentionController extends \Models\PromotionRetention{
    public function initPromote($ids, $lrns, $grade_levels){
        if ($this->checkPassingGrades($lrns, $grade_levels) !== false) {
            // header("Location: ../masterlist.php?promotion&err&grades");
            // die();
        }
        // elseif ($this->checkNullGrades($lrns, $grade_levels) !== false) {
        //     # code...
        // }
        else{
            // header("Location: ../masterlist.php?promotion&submitted");
            // die();
        }
    }

    protected function checkPassingGrades($lrns, $grade_levels){
        $result = false;
        $passing_grade = 75;
        $validation = $this->indexGrades($lrns, $grade_levels);
        // echo '<pre>' , var_dump($validation) , '</pre>';
        foreach ($validation as $key => $value) {
            foreach ($value as $grades) {
                foreach ($grades as $grade) {
                    var_dump($grade);
                    // if (intval($grade) < $passing_grade) {
                    //     $result = true;
                    // }
                }
            }
        }
        return $result;
    }
}