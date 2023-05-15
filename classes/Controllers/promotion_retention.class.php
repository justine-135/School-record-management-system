<?php

namespace Controllers;

include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/promotion_retention.class.php';

class PromotionRetentionController extends \Models\PromotionRetention{
    public function initPromote($ids, $lrns, $grade_levels){
        $promote = 1;
        if ($this->checkPassingGrades($ids, $lrns, $grade_levels, $promote) !== false) {
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

    public function initPromoteTransfer($ids, $lrns, $grade_levels){
        $promote = 2;
        if ($this->checkPassingGrades($ids, $lrns, $grade_levels, $promote) !== false) {
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

    public function initRetention($ids, $lrns, $grade_levels){
        $promote = 0;
        if ($this->checkPassingGrades($ids, $lrns, $grade_levels, $promote) !== false) {
            // header("Location: ../masterlist.php?promotion&err&grades");
            // die();
        }
    }

    protected function checkPassingGrades($ids, $lrns, $grade_levels, $promote){
        $result = false;

        for ($i=0; $i < count($ids); $i++) { 
            $remarks = $this->getRemarks($ids[$i], $lrns[$i]);
            $promotion = $remarks[0]['promotion_status'];
            if ($promote == 1) {
                if ($promotion == 'Promotion' || $grade_levels[$i] == 'Kindergarten') {
                    $this->promote($ids[$i], $lrns[$i], $grade_levels[$i]);
                }
            }
            elseif ($promote == 0){
                if ($promotion == 'Retention') {
                    $this->retain($ids[$i], $lrns[$i], $grade_levels[$i]);
                }
            }
            elseif ($promote == 2){
                if ($promotion == 'Promotion' || $grade_levels[$i] == 'Kindergarten') {
                    $this->promoteTransfer($ids[$i], $lrns[$i], $grade_levels[$i]);
                }
            }

        }
        die();
    }
}