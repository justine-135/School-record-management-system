<?php

namespace Controllers;

include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/advisory.class.php';

class AdvisoryController extends \Models\Advisory{
    public function initCreate($email, $username, $grade_level, $section){
        $this->create($email, $username, $grade_level, $section);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        die();
    }
    public function initDestroy($id){
        $this->destroy($id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        die();
    }
}