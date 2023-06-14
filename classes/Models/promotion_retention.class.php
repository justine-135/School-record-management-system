<?php

namespace Models;

include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Database/dbh.class.php';

class PromotionRetention extends \Dbh{
    protected function index($status, $offset, $total_records_per_page, $query, $level, $section){
        try{
            if (!empty($level) && empty($section)) {
                $sql = "SELECT enrollment_history_table.enrollment_id, students_table.student_id, students_table.lrn, students_table.surname, students_table.first_name, students_table.middle_name, students_table.ext, enrollment_history_table.enrolled_at, enrollment_history_table.grade_level, enrollment_history_table.section, students_table.gender, enrollment_history_table.student_lrn, enrollment_history_table.status, enrollment_history_table.promotion_status, students_table.image
                FROM `students_table`, `enrollment_history_table`
                WHERE students_table.lrn = enrollment_history_table.student_lrn
                AND enrollment_history_table.status = ?
                AND enrollment_history_table.grade_level = ?
                AND enrollment_history_table.promotion_status IS NOT NULL
                ORDER BY `grade_level` ASC, `surname` ASC
                LIMIT $offset, $total_records_per_page
                ";

                $stmt = $this->connection()->prepare($sql);
                $stmt->execute([$status, $level]);        
                $results = $stmt->fetchAll();
            }
            elseif (!empty($level) && !empty($section) && empty($query)) {
                $sql = "SELECT enrollment_history_table.enrollment_id, students_table.student_id, students_table.lrn, students_table.surname, students_table.first_name, students_table.middle_name, students_table.ext, enrollment_history_table.enrolled_at, enrollment_history_table.grade_level, enrollment_history_table.section, students_table.gender, enrollment_history_table.student_lrn, enrollment_history_table.status, enrollment_history_table.promotion_status, students_table.image
                FROM `students_table`, `enrollment_history_table`
                WHERE students_table.lrn = enrollment_history_table.student_lrn
                AND enrollment_history_table.status = ?
                AND enrollment_history_table.grade_level = ?
                AND enrollment_history_table.section = ?
                AND enrollment_history_table.promotion_status IS NOT NULL
                ORDER BY `grade_level` ASC, `surname` ASC
                LIMIT $offset, $total_records_per_page
                ";

                $stmt = $this->connection()->prepare($sql);
                $stmt->execute([$status, $level, $section]);        
                $results = $stmt->fetchAll();
            }
            else{
                $sql = "SELECT enrollment_history_table.enrollment_id, students_table.student_id, students_table.lrn, students_table.surname, students_table.first_name, students_table.middle_name, students_table.ext, enrollment_history_table.enrolled_at, enrollment_history_table.grade_level, enrollment_history_table.section, students_table.gender, enrollment_history_table.student_lrn, enrollment_history_table.status, enrollment_history_table.promotion_status, students_table.image
                FROM `students_table`, `enrollment_history_table`
                WHERE students_table.lrn = enrollment_history_table.student_lrn
                AND enrollment_history_table.status = ?
                AND enrollment_history_table.promotion_status IS NOT NULL
                ORDER BY `grade_level` ASC, `surname` ASC
                LIMIT $offset, $total_records_per_page
                ";
                
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute([$status]);        
                $results = $stmt->fetchAll();
            }
            return $results;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;

    }

    protected function studentCount($status, $level, $section){
        try{
            if (empty($level) && empty($section)) {
                $sql = "SELECT `enrollment_id` FROM `enrollment_history_table` 
                WHERE `status` = ?
                AND `promotion_status` IS NOT NULL";
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute([$status]);
            }
            else if (!empty($level) && empty($section)) {
                $sql = "SELECT `enrollment_id` FROM `enrollment_history_table` 
                WHERE `status` = ?
                AND `grade_level` = ?
                AND promotion_status IS NOT NULL";
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute([$status, $level]);
            }
            else{
                $sql = "SELECT `enrollment_id` FROM `enrollment_history_table` 
                WHERE `status` = ?
                AND `grade_level` = ?
                AND `section` = ?
                AND `promotion_status` IS NOT NULL";
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute([$status, $level, $section]);
            }



            $results = $stmt->fetchAll();
            return $results;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    protected function getRemarks($id, $lrn){
        try {
            $sql = "SELECT `promotion_status` FROM `enrollment_history_table` WHERE `enrollment_id` = ? AND `student_lrn` = ?;";
            $stmt = $this->connection()->prepare($sql);

            $stmt->execute([$id, $lrn]);
    
            $results = $stmt->fetchAll();
    
            return $results;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    protected function promote($id, $lrn, $grade_level){
        try {
            $status = 'Completed';
            $promotion_status = 'Promoted';
            $sql = "UPDATE `enrollment_history_table` SET `status` = ?, `promotion_status` = ? WHERE `enrollment_id` = ? AND `student_lrn` = ? AND `grade_level` = ?;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$status, $promotion_status, $id, $lrn, $grade_level]);
            $results = $stmt->fetchAll();
            $stmt = null;

            $sql = "SELECT * FROM `enrollment_history_table` WHERE `enrollment_id` = ? AND `student_lrn` = ? AND `grade_level` = ?;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$id, $lrn, $grade_level]);
            $history = $stmt->fetchAll();
            $stmt = null;

            $promoted_level = $history[0]['grade_level'] == 'Kindergarten' ? 1 : intval($history[0]['grade_level']) + 1;
            
            $sql = 
            "INSERT INTO `enrollment_history_table` (`student_lrn`, `from_sy`, `to_sy`, `school`, `grade_level`, `status`)
            VALUES (?, ?, ?, ?, ?, ?);";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$lrn, 0000, 0000, 'Sabang Elementary School', $promoted_level, 'Unenrolled']);
            $stmt = null;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    protected function promoteTransfer($id, $lrn, $grade_level){
        try {
            $status = 'Completed';
            $promotion_status = 'Promoted';
            $sql = "UPDATE `enrollment_history_table` SET `status` = ?, `promotion_status` = ?, `transfer` = ? WHERE `enrollment_id` = ? AND `student_lrn` = ? AND `grade_level` = ?;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$status, $promotion_status, '1', $id, $lrn, $grade_level]);
            $results = $stmt->fetchAll();
            $stmt = null;

            // $sql = "SELECT * FROM `enrollment_history_table` WHERE `enrollment_id` = ? AND `student_lrn` = ? AND `grade_level` = ?;";
            // $stmt = $this->connection()->prepare($sql);
            // $stmt->execute([$id, $lrn, $grade_level]);
            // $history = $stmt->fetchAll();
            // $stmt = null;

            // $promoted_level = $history[0]['grade_level'] == 'Kindergarten' ? 1 : intval($history[0]['grade_level']) + 1;
            
            // $sql = 
            // "INSERT INTO `enrollment_history_table` (`student_lrn`, `from_sy`, `to_sy`, `school`, `grade_level`, `status`, `transfer`)
            // VALUES (?, ?, ?, ?, ?, ?, ?);";
            // $stmt = $this->connection()->prepare($sql);
            // $stmt->execute([$lrn, 0000, 0000, 'Sabang Elementary School', $promoted_level, 'Unenrolled', '1']);
    
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    protected function retain($id, $lrn, $grade_level){
        try {            
            $status = 'Retained';
            $promotion_status = 'Retained';
            $sql = "UPDATE `enrollment_history_table` SET `status` = ?, `promotion_status` = ? WHERE `enrollment_id` = ? AND `student_lrn` = ? AND `grade_level` = ?;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$status, $promotion_status, $id, $lrn, $grade_level]);
            $results = $stmt->fetchAll();
            $stmt = null;

            $promoted_level = $grade_level;
            
            $sql = 
            "INSERT INTO `enrollment_history_table` (`student_lrn`, `from_sy`, `to_sy`, `school`, `grade_level`, `status`)
            VALUES (?, ?, ?, ?, ?, ?);";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$lrn, 0000, 0000, 'Sabang Elementary School', $promoted_level, 'Unenrolled']);
    
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    protected function gradesSubmitted($grade_level, $lrn){
        try{
            $sql = "SELECT `subject`, `first_quarter`, `second_quarter`, `third_quarter`, `fourth_quarter` FROM `student_grades_table` WHERE `student_lrn` = ? AND `grade_level` = ?";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$lrn, $grade_level]);
    
            $results = $stmt->fetchAll();
            return $results;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
}