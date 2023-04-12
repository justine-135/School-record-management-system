<?php

require '../classes/Controllers/promotion_retention.class.php';

use Controllers\PromotionRetentionController;

function promote($ids, $lrns, $grade_levels){
    $obj = new PromotionRetentionController();
    $obj->initPromote($ids, $lrns, $grade_levels);
}

if (isset($_POST['promote'])) {
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

    promote($ids, $lrns, $grade_levels);
}