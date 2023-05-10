<?php

namespace Controllers;

include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/promotion_retention.class.php';

class PromotionRetentionController extends \Models\PromotionRetention{
    public function initPromote($ids, $lrns, $grade_levels){
        if ($this->checkPassingGrades($ids, $lrns, $grade_levels) !== false) {
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

    protected function checkPassingGrades($ids, $lrns, $grade_levels){
        $result = false;

        for ($i=0; $i < count($ids); $i++) { 
            $remarks = $this->getRemarks($ids[$i], $lrns[$i]);
            $promotion = $remarks[0]['promotion_status'];
            // echo $grade_levels[$i];
            if ($promotion == 'Promotion' || $grade_levels[$i] == 'Kindergarten') {
            }
        }

        // $result = false;
        // $passing_grade = 75;
        // $remarks = $this->getRemarks($ids, $lrns);
        // echo '<pre>' , var_dump($validation) , '</pre>';
        // foreach ($validation as $key => $value) {
        //     foreach ($value as $grades) {
        //         foreach ($grades as $grade) {
        //             var_dump($grade);
        //             // if (intval($grade) < $passing_grade) {
        //             //     $result = true;
        //             // }
        //         }
        //     }
        // }
        // return $result;
        // var_dump($remarks);
        die();
    }
}