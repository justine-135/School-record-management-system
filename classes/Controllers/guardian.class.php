<?php

namespace Controllers;

include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/guardian.class.php';

class GuardianController extends \Models\Guardian{
    public function initCreate($relation, $lrn, $sname, $fname, $mname, $education, $employment, $contact_number, $beneficiary){
        $this->create($relation, $lrn, $sname, $fname, $mname, $education, $employment, $contact_number, $beneficiary);
    }
    public function checkValidation($sname, $fname, $mname, $education, $employment, $contact_number, $beneficiary){
        $result = false;
        if ($this->emptyInputs($sname, $fname, $mname, $education, $employment, $contact_number, $beneficiary) !== false) {
            header("Location: ../enrollment.php?missing_inputs");
        }

        elseif ($this->invalidContactNumber($contact_number) !== false) {
            header("Location: ../enrollment.php?invalid_contact");
        }

        else{
            return $result;
        }
    }

    protected function emptyInputs($sname, $fname, $mname, $education, $employment, $contact_number, $beneficiary){
        $result = false;
        if (empty($sname) || empty($fname) || empty($mname) || empty($education) || empty($education) || empty($employment) || empty($contact_number) || empty($beneficiary)) {
            $result = true;
        }
        return $result;
    }

    protected function invalidContactNumber($contact_number){
        $result = false;
        if (!preg_match("/^[0-9]*$/", $contact_number) || strlen($contact_number) !== 11) {
            $result = true;
        }
        return $result;
    }
}

?>