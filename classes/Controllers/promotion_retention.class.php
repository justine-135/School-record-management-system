<?php

namespace Controllers;

include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/promotion_retention.class.php';

class PromotionRetentionController extends \Models\PromotionRetention{
    public function initPromote($ids, $lrns, $grade_levels){
        $promote = 1;
        if (count($this->checkPassingGrades($ids, $lrns, $grade_levels, $promote)) > 0) {
            $results = $this->checkPassingGrades($ids, $lrns, $grade_levels, $promote);
            $url = "Location: ../promotion.php?promotion&submitted";
            // $id_param = 'id[]=';
            // $lrn_param = 'lrn[]=';
            // $remark_param = 'remark[]=';
            // foreach ($results as $result) {
            //     foreach ($result as $key => $value) {
            //         if ($key == 'id') {
            //             $url .= '&id[]=' . $value; 
            //         }
            //         elseif ($key == 'lrn') {
            //             $url .= '&lrn[]=' . $value; 
            //         }
            //         else{
            //             $url .= '&remark[]=' . $value; 
            //         }
            //     }
            // }
            // var_dump($results);
            // die();
            header($url);
            die();
        }
    }

    public function initPromoteTransfer($ids, $lrns, $grade_levels){
        $promote = 2;
        if ($this->checkPassingGrades($ids, $lrns, $grade_levels, $promote) !== false) {
            $results = $this->checkPassingGrades($ids, $lrns, $grade_levels, $promote);
            $url = "Location: ../promotion.php?promotiontransfer&submitted";
            // $id_param = 'id[]=';
            // $lrn_param = 'lrn[]=';
            // $remark_param = 'remark[]=';
            // foreach ($results as $result) {
            //     foreach ($result as $key => $value) {
            //         if ($key == 'id') {
            //             $url .= '&id[]=' . $value; 
            //         }
            //         elseif ($key == 'lrn') {
            //             $url .= '&lrn[]=' . $value; 
            //         }
            //         else{
            //             $url .= '&remark[]=' . $value; 
            //         }
            //     }
            // }
            header($url);
            die();
        }
    }

    public function initRetention($ids, $lrns, $grade_levels){
        $promote = 0;
        if ($this->checkPassingGrades($ids, $lrns, $grade_levels, $promote) !== false) {
            $results = $this->checkPassingGrades($ids, $lrns, $grade_levels, $promote);
            $url = "Location: ../promotion.php?retention&submitted";
            // $id_param = 'id[]=';
            // $lrn_param = 'lrn[]=';
            // $remark_param = 'remark[]=';
            // foreach ($results as $result) {
            //     foreach ($result as $key => $value) {
            //         if ($key == 'id') {
            //             $url .= '&id[]=' . $value; 
            //         }
            //         elseif ($key == 'lrn') {
            //             $url .= '&lrn[]=' . $value; 
            //         }
            //         else{
            //             $url .= '&remark[]=' . $value; 
            //         }
            //     }
            // }
            header($url);
            die();
        }
    }

    protected function checkPassingGrades($ids, $lrns, $grade_levels, $promote){
        $result = false;

        $return_result = array();

        for ($i=0; $i < count($ids); $i++) { 
            $remarks = $this->getRemarks($ids[$i], $lrns[$i]);
            $promotion = $remarks[0]['promotion_status'];
            if ($promote == 1) {
                if ($promotion == 'Promotion' || $promotion === 'Conditional Promotion' || $grade_levels[$i] == 'Kindergarten') {
                    $student = array("id" => $ids[$i], "lrn" => $lrns[$i], "remark" => "Promoted");
                    array_push($return_result, $student);
                    $this->promote($ids[$i], $lrns[$i], $grade_levels[$i]);
                }
            }
            elseif ($promote == 0){
                if ($promotion == 'Retention') {
                    $this->retain($ids[$i], $lrns[$i], $grade_levels[$i]);
                    $student = array("id" => $ids[$i], "lrn" => $lrns[$i], "remark" => "Retained");
                    array_push($return_result, $student);
                }
            }
            elseif ($promote == 2){
                if ($promotion == 'Promotion' || $grade_levels[$i] == 'Kindergarten') {
                    $this->promoteTransfer($ids[$i], $lrns[$i], $grade_levels[$i]);
                    $student = array("id" => $ids[$i], "lrn" => $lrns[$i], "remark" => "Promoted/Transferred");
                    array_push($return_result, $student);
                }
            }


        }
        
        return $return_result;
    }
}