<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Controllers/promotion_retention.class.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Views/promotion_retention.class.php';

use Views\PromotionRetentionView;
use Controllers\PromotionRetentionController;

function promote($ids, $lrns, $grade_levels){
    $obj = new PromotionRetentionController();
    $obj->initPromote($ids, $lrns, $grade_levels);
}

function promoteTransfer($ids, $lrns, $grade_levels){
    $obj = new PromotionRetentionController();
    $obj->initPromoteTransfer($ids, $lrns, $grade_levels);
}

function retention($ids, $lrns, $grade_levels){
    $obj = new PromotionRetentionController();
    $obj->initRetention($ids, $lrns, $grade_levels);
}

function index($view){
    $obj = new PromotionRetentionView();
    $obj->initIndex($view);
}

if (isset($view)) {
    if ($view == 'promotion') {
        index($view);
    }
}

if (isset($_POST['promote'])) {
    $select_promotion = $_POST['select-promotion'];    
    $chkbox_students = $_POST['chkbox-student'];
    $ids = array();
    $lrns = array();
    $grade_levels = array();

    foreach ($chkbox_students as $key => $obj) {
        $data = explode(",",$obj);
        array_push($ids, $data[0]);
        array_push($lrns, $data[1]);
        array_push($grade_levels, $data[2]);
    }

    switch ($select_promotion) {
        case '1':
            promote($ids, $lrns, $grade_levels);
            break;
        
        case '2':
            promoteTransfer($ids, $lrns, $grade_levels);
            break;
        
        case '3':
            retention($ids, $lrns, $grade_levels);
            break;
        
        default:
            header("Location: ../promotion_retention.php?promotion&err&promotionselect");
            break;
    }
}