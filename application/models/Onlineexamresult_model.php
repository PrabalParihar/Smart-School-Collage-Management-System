<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Onlineexamresult_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    public function add($data_insert)
    {

        $this->db->trans_begin();

        if (!empty($data_insert)) {

            $this->db->insert_batch('onlineexam_student_results', $data_insert);
        }

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    public function getResultByStudent($onlineexam_student_id, $exam_id)
    {

        $query = "SELECT onlineexam_questions.*,subjects.name as subject_name,onlineexam_student_results.id as `onlineexam_student_result_id`,questions.question,questions.opt_a, questions.opt_b,questions.opt_c,questions.opt_d,questions.opt_e,questions.correct,onlineexam_student_results.select_option FROM `onlineexam_questions` left JOIN onlineexam_student_results on onlineexam_student_results.onlineexam_question_id=onlineexam_questions.id and onlineexam_student_results.onlineexam_student_id=" . $this->db->escape($onlineexam_student_id) . " INNER JOIN questions on questions.id=onlineexam_questions.question_id INNER JOIN subjects on subjects.id=questions.subject_id WHERE onlineexam_questions.onlineexam_id=" . $this->db->escape($exam_id);

        $query = $this->db->query($query);

        return $query->result();

    }

    public function getStudentByExam($exam_id, $class_id, $section_id)
    {

        $query = "SELECT student_session.*,onlineexam.id as `exam_id`,onlineexam.exam,onlineexam.attempt,onlineexam_students.id as `onlineexam_student_id`, (select count(*) from onlineexam_attempts WHERE onlineexam_attempts.onlineexam_student_id = onlineexam_students.id ) as `total_counter`,`classes`.`id` AS `class_id`, `student_session`.`id` as `student_session_id`, `students`.`id`, `classes`.`class`, `sections`.`id` AS `section_id`, `sections`.`section`, `students`.`id`, `students`.`admission_no`, `students`.`roll_no`, `students`.`admission_date`, `students`.`firstname`, `students`.`lastname`, `students`.`image`, `students`.`mobileno`, `students`.`email`, `students`.`state`, `students`.`city`, `students`.`pincode`, `students`.`religion`, `students`.`dob`, `students`.`current_address`, `students`.`permanent_address`, IFNULL(students.category_id, 0) as `category_id`, IFNULL(categories.category, '') as `category`, `students`.`adhar_no`, `students`.`samagra_id`, `students`.`bank_account_no`, `students`.`bank_name`, `students`.`ifsc_code`, `students`.`guardian_name`, `students`.`guardian_relation`, `students`.`guardian_phone`, `students`.`guardian_address`, `students`.`is_active`, `students`.`created_at`, `students`.`updated_at`, `students`.`father_name`, `students`.`rte`, `students`.`gender` FROM `student_session` INNER JOIN onlineexam_students on onlineexam_students.student_session_id=student_session.id INNER JOIN students on students.id=student_session.student_id JOIN `classes` ON `student_session`.`class_id` = `classes`.`id` JOIN `sections` ON `sections`.`id` = `student_session`.`section_id` LEFT JOIN `categories` ON `students`.`category_id` = `categories`.`id` INNER JOIN onlineexam on onlineexam_students.onlineexam_id=onlineexam.id WHERE class_id =" . $this->db->escape($class_id) . "  and section_id=" . $this->db->escape($section_id) . " and student_session.session_id=" . $this->db->escape($this->current_session) . " AND onlineexam_students.onlineexam_id =" . $this->db->escape($exam_id);

        $query = $this->db->query($query);

        return $query->result_array();
    }

    public function checkResultPrepare($onlineexam_student_id)
    {
        $this->db->select()->from('onlineexam_student_results');

        $this->db->where('onlineexam_student_id', $onlineexam_student_id);

        $query = $this->db->get();

        return $query->result();

    }


      public function getStudentResult($exam_id, $class_id, $section_id)
    {
        $condition="";
        if($exam_id!=''){
            $condition.="  AND onlineexam_students.onlineexam_id =" . $this->db->escape($exam_id);
        }

        if($class_id!=''){
            $condition.=" and class_id =" . $this->db->escape($class_id);
        }

        if($section_id!=''){
            $condition.=" and section_id=" . $this->db->escape($section_id);
        }

        $query = "SELECT student_session.*,onlineexam.id as `exam_id`,onlineexam.passing_percentage,onlineexam.exam,onlineexam.attempt,onlineexam_students.id as `onlineexam_student_id`, (select count(*) from onlineexam_attempts WHERE onlineexam_attempts.onlineexam_student_id = onlineexam_students.id ) as `total_counter`,`classes`.`id` AS `class_id`, `student_session`.`id` as `student_session_id`, `students`.`id`, `classes`.`class`, `sections`.`id` AS `section_id`, `sections`.`section`, `students`.`id`, `students`.`admission_no`, `students`.`roll_no`, `students`.`admission_date`, `students`.`firstname`, `students`.`lastname`, `students`.`image`, `students`.`mobileno`, `students`.`email`, `students`.`state`, `students`.`city`, `students`.`pincode`, `students`.`religion`, `students`.`dob`, `students`.`current_address`, `students`.`permanent_address`, IFNULL(students.category_id, 0) as `category_id`, IFNULL(categories.category, '') as `category`, `students`.`adhar_no`, `students`.`samagra_id`, `students`.`bank_account_no`, `students`.`bank_name`, `students`.`ifsc_code`, `students`.`guardian_name`, `students`.`guardian_relation`, `students`.`guardian_phone`, `students`.`guardian_address`, `students`.`is_active`, `students`.`created_at`, `students`.`updated_at`, `students`.`father_name`, `students`.`rte`, `students`.`gender` FROM `student_session` INNER JOIN onlineexam_students on onlineexam_students.student_session_id=student_session.id INNER JOIN students on students.id=student_session.student_id JOIN `classes` ON `student_session`.`class_id` = `classes`.`id` JOIN `sections` ON `sections`.`id` = `student_session`.`section_id` LEFT JOIN `categories` ON `students`.`category_id` = `categories`.`id` INNER JOIN onlineexam on onlineexam_students.onlineexam_id=onlineexam.id WHERE  student_session.session_id=" . $this->db->escape($this->current_session) . "".$condition;

        $query = $this->db->query($query);

        return $query->result_array();
    }

public function onlineexamrank($onlineexam_student_id,$exam_id){

      
        // $query="SELECT students.id as stdid,onlineexam_student_results.onlineexam_student_id,CONCAT_WS(' ',students.firstname,students.lastname) as name, SUM(CASE WHEN questions.correct = onlineexam_student_results.select_option THEN 1 ELSE 0 END) AS correct_answer,SUM(CASE WHEN questions.correct != onlineexam_student_results.select_option THEN 1 ELSE 0 END) AS incorrect_answer,COUNT(*) as total_questions FROM `onlineexam_questions`
        // left JOIN onlineexam_student_results on onlineexam_student_results.onlineexam_question_id=onlineexam_questions.id
        // INNER JOIN questions on questions.id=onlineexam_questions.question_id
        // INNER JOIN subjects on subjects.id=questions.subject_id
        // inner join onlineexam on onlineexam.id=onlineexam_questions.onlineexam_id
        // left join students on students.id=onlineexam_student_results.onlineexam_student_id group by onlineexam_student_id";

        $query="SELECT onlineexam_student_results.onlineexam_student_id,SUM(CASE WHEN questions.correct = onlineexam_student_results.select_option THEN 1 ELSE 0 END) AS correct_answer,SUM(CASE WHEN questions.correct != onlineexam_student_results.select_option THEN 1 ELSE 0 END) AS incorrect_answer,COUNT(*) as total_questions FROM `onlineexam_questions` left JOIN onlineexam_student_results on onlineexam_student_results.onlineexam_question_id=onlineexam_questions.id and onlineexam_student_results.onlineexam_student_id=" . $this->db->escape($onlineexam_student_id) . " INNER JOIN questions on questions.id=onlineexam_questions.question_id INNER JOIN subjects on subjects.id=questions.subject_id WHERE onlineexam_questions.onlineexam_id=" . $this->db->escape($exam_id);

        $query = $this->db->query($query);

        return $query->result_array();

    }

}
