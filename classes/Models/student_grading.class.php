<?php

namespace Models;

include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Database/dbh.class.php';

class StudentGrading extends \Dbh{
    protected function index($status, $offset, $total_records_per_page, $query, $level, $section){
        try{
            if (!empty($query) && empty($level) && empty($section)) {
                $sql = "SELECT enrollment_history_table.enrollment_id, students_table.student_id, students_table.lrn, students_table.surname, students_table.first_name, students_table.middle_name, students_table.ext, enrollment_history_table.enrolled_at, enrollment_history_table.grade_level, enrollment_history_table.section,  students_table.gender, enrollment_history_table.student_lrn, enrollment_history_table.status, enrollment_history_table.promotion_status, students_table.image 
                FROM `students_table`, `enrollment_history_table`
                WHERE ? in (students_table.student_id, students_table.lrn, students_table.surname, students_table.first_name, students_table.middle_name, students_table.ext, enrollment_history_table.enrolled_at, enrollment_history_table.grade_level, enrollment_history_table.section, students_table.gender, enrollment_history_table.student_lrn)
                AND enrollment_history_table.student_lrn = students_table.lrn
                AND (enrollment_history_table.promotion_status IS NULL OR enrollment_history_table.promotion_status = 'Retention')
                AND enrollment_history_table.status <> 'Unenrolled'
                ORDER BY `grade_level` ASC, `surname` ASC
                LIMIT $offset, $total_records_per_page
                ";

                $stmt = $this->connection()->prepare($sql);
                $stmt->execute([$query]);
        
                $results = $stmt->fetchAll();
            }
            elseif (!empty($level) && !empty($section) && !empty($query)) {
                $sql = "SELECT enrollment_history_table.enrollment_id, students_table.student_id, students_table.lrn, students_table.surname, students_table.first_name, students_table.middle_name, students_table.ext, enrollment_history_table.enrolled_at, enrollment_history_table.grade_level, enrollment_history_table.section, students_table.gender, enrollment_history_table.student_lrn, enrollment_history_table.status, enrollment_history_table.promotion_status, students_table.image 
                FROM `students_table`, `enrollment_history_table`
                WHERE ? in (students_table.student_id, students_table.lrn, students_table.surname, students_table.first_name, students_table.middle_name, students_table.ext, enrollment_history_table.enrolled_at, enrollment_history_table.grade_level, enrollment_history_table.section, students_table.gender, enrollment_history_table.student_lrn)
                AND students_table.lrn = enrollment_history_table.student_lrn
                AND enrollment_history_table.grade_level = ?
                AND enrollment_history_table.section = ?
                AND (enrollment_history_table.promotion_status IS NULL OR enrollment_history_table.promotion_status = 'Retention')
                AND enrollment_history_table.status <> 'Unenrolled'

                ORDER BY `grade_level` ASC, `surname` ASC
                LIMIT $offset, $total_records_per_page
                ";

                $stmt = $this->connection()->prepare($sql);
                $stmt->execute([$query, $level, $section]);        
                $results = $stmt->fetchAll();
            }
            elseif (!empty($level) && $section == '') {
                $sql = "SELECT enrollment_history_table.enrollment_id, students_table.student_id, students_table.lrn, students_table.surname, students_table.first_name, students_table.middle_name, students_table.ext, enrollment_history_table.enrolled_at, enrollment_history_table.grade_level, enrollment_history_table.section, students_table.gender, enrollment_history_table.student_lrn, enrollment_history_table.status, enrollment_history_table.promotion_status, students_table.image
                FROM `students_table`, `enrollment_history_table`
                WHERE students_table.lrn = enrollment_history_table.student_lrn
                AND enrollment_history_table.grade_level = ?
                AND (enrollment_history_table.promotion_status IS NULL OR enrollment_history_table.promotion_status = 'Retention')
                AND enrollment_history_table.status <> 'Unenrolled'

                ORDER BY `grade_level` ASC, `surname` ASC
                LIMIT $offset, $total_records_per_page
                ";

                $stmt = $this->connection()->prepare($sql);
                $stmt->execute([$level]);        
                $results = $stmt->fetchAll();
            }
            elseif (!empty($level) && !empty($section) && empty($query)) {
                $sql = "SELECT enrollment_history_table.enrollment_id, students_table.student_id, students_table.lrn, students_table.surname, students_table.first_name, students_table.middle_name, students_table.ext, enrollment_history_table.enrolled_at, enrollment_history_table.grade_level, enrollment_history_table.section, students_table.gender, enrollment_history_table.student_lrn, enrollment_history_table.status, enrollment_history_table.promotion_status, students_table.image
                FROM `students_table`, `enrollment_history_table`
                WHERE students_table.lrn = enrollment_history_table.student_lrn
                AND enrollment_history_table.grade_level = ?
                AND enrollment_history_table.section = ?
                AND (enrollment_history_table.promotion_status IS NULL OR enrollment_history_table.promotion_status = 'Retention')
                AND enrollment_history_table.status <> 'Unenrolled'

                ORDER BY `grade_level` ASC, `surname` ASC
                LIMIT $offset, $total_records_per_page
                ";

                $stmt = $this->connection()->prepare($sql);
                $stmt->execute([$level, $section]);        
                $results = $stmt->fetchAll();
            }
            else{
                $sql = "SELECT enrollment_history_table.enrollment_id, students_table.student_id, students_table.lrn, students_table.surname, students_table.first_name, students_table.middle_name, students_table.ext, enrollment_history_table.enrolled_at, enrollment_history_table.grade_level, enrollment_history_table.section, students_table.gender, enrollment_history_table.student_lrn, enrollment_history_table.status, enrollment_history_table.promotion_status, students_table.image
                FROM `students_table`, `enrollment_history_table`
                WHERE students_table.lrn = enrollment_history_table.student_lrn
                AND (enrollment_history_table.promotion_status IS NULL OR enrollment_history_table.promotion_status = 'Retention')
                -- OR enrollment_history_table.promotion_status IS NULL
                -- OR enrollment_history_table.promotion_status = 'Retained'
                AND enrollment_history_table.status <> 'Unenrolled'

                ORDER BY `grade_level` ASC, `surname` ASC
                LIMIT $offset, $total_records_per_page
                ";
                
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute();        
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
            if (empty($level) || empty($section)) {
                $sql = "SELECT `enrollment_id` FROM `enrollment_history_table` 
                WHERE `status` = ?
                AND (enrollment_history_table.promotion_status IS NULL OR enrollment_history_table.promotion_status = 'Retention')
";
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute([$status]);
            }
            else{
                $sql = "SELECT `enrollment_id` FROM `enrollment_history_table` 
                WHERE `status` = ? AND `grade_level` = ? AND `section` = ?
                AND (enrollment_history_table.promotion_status IS NULL OR enrollment_history_table.promotion_status = 'Retention')
";
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute([$status, $level, $section]);
            }

            if (!empty($level) && empty($section)) {
                $sql = "SELECT `enrollment_id` FROM `enrollment_history_table` 
                WHERE `status` = ? AND `grade_level` = ?
                AND (enrollment_history_table.promotion_status IS NULL OR enrollment_history_table.promotion_status = 'Retention')
";
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute([$status, $level]);
            }

            $results = $stmt->fetchAll();
            return $results;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
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

    protected function gradingPeriod(){
        try {
            $sql = "SELECT `from`, `to` FROM `schedule_table`;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
    
            $results = $stmt->fetchAll();
            return $results;

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } 
    }
}
