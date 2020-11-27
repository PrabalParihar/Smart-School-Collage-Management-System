<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Studentsession_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    public function searchStudents($class_id = null, $section_id = null, $key = null)
    {
        $this->db->select('student_session.id,student_session.student_id,classes.class,sections.section,
            students.firstname,students.lastname,students.admission_no,students.roll_no,students.dob,students.guardian_name,
            ')->from('student_session');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('students', 'students.id = student_session.student_id');
        $this->db->where('student_session.class_id', $class_id);
        $this->db->where('student_session.section_id', $section_id);
        $this->db->order_by('student_session.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function searchStudentsBySession($student_session_id = null)
    {
        $this->db->select('students.admission_no,students.roll_no,student_session.session_id, student_session.class_id, student_session.section_id,student_session.id,student_session.student_id,classes.class,sections.section,
            students.firstname,students.lastname,students.admission_no,students.roll_no,students.dob,students.guardian_name,students.father_name')->from('student_session');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('students', 'students.id = student_session.student_id');
        $this->db->where('student_session.id', $student_session_id);
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getStudentClass($id)
    {
        $this->db->select('students.admission_no,students.roll_no,student_session.session_id, student_session.class_id, student_session.section_id,student_session.id,student_session.student_id,classes.class,sections.section,
            students.firstname,students.lastname,students.admission_no,students.roll_no,students.dob,students.guardian_name,
            ')->from('student_session');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('students', 'students.id = student_session.student_id');
        $this->db->where('student_id', $id);
        $this->db->where('session_id', $this->current_session);
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getStudentByStudentId($id)
    {
        $this->db->select()->from('student_session');
        $this->db->where('student_id', $id);
        $this->db->where('session_id', $this->current_session);
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->row_array();
    }

        public function getSessionById($id)
    {
        $this->db->select()->from('student_session');
        $this->db->where('id', $id);   
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->row();
    }

    public function getTotalStudentBySession()
    {
        $query = "SELECT count(*) as `total_student` FROM `student_session` INNER JOIN students on students.id=student_session.student_id where student_session.session_id=" . $this->db->escape($this->current_session) . " and students.is_active = 'yes' ";
        $query = $this->db->query($query);
        return $query->row();
    }

    public function add($insert_array, $student_id)
    {
        $not_delarray = array();
        $this->db->trans_start();
        $this->db->trans_strict(false);
        if (!empty($insert_array)) {
            foreach ($insert_array as $insert_array_key => $insert_array_value) {
                $this->db->where('session_id', $insert_array_value['session_id']);
                $this->db->where('student_id', $insert_array_value['student_id']);
                $this->db->where('class_id', $insert_array_value['class_id']);
                $this->db->where('section_id', $insert_array_value['section_id']);
                $q = $this->db->get('student_session');
                if ($q->num_rows() > 0) {
                    $result         = $q->row();
                    $not_delarray[] = $result->id;
                } else {
                    $this->db->insert('student_session', $insert_array[$insert_array_key]);
                    $not_delarray[] = $this->db->insert_id();
                }

            }
            // $this->db->insert_batch('student_session', $insert_array);
        }
        if (!empty($not_delarray)) {
            $this->db->where('session_id', $this->current_session);
            $this->db->where('student_id', $student_id);
            $this->db->where_not_in('id', $not_delarray);
            $this->db->delete('student_session');
        }

        // print_r($insert_array);
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {

            $this->db->trans_rollback();
            return false;
        } else {

            $this->db->trans_commit();
            return true;
        }
    }

    public function searchMultiStudentByClassSection($class_id = null, $section_id = null)
    {

        $students = $this->student_model->searchByClassSectionWithSession($class_id, $section_id);
        
        if (!empty($students)) {
            foreach ($students as $student_key => $student_value) {

                $this->db->select()->from('student_session');
                $this->db->where('student_id', $student_value['id']);
                $this->db->where('session_id', $this->current_session);
                $this->db->order_by('id');
                $query                                      = $this->db->get();
                $students[$student_key]['student_sessions'] = $query->result();

            }
        }
        return $students;

    }
    public function searchMultiClsSectionByStudent($student_id)
    {
        $this->db->select('student_session.*,classes.class,sections.section')->from('student_session');
        $this->db->where('student_id', $student_id);
        $this->db->where('session_id', $this->current_session);
         $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->result();

    }
       public function searchActiveClassSectionStudent($student_id,$enable_session = null)
    {
     
        $this->db->select('student_session.*,classes.class,sections.section')->from('student_session');
        $this->db->where('student_id', $student_id);
        if($enable_session == null){
        $this->db->where('session_id', $this->current_session);
        }else{
            $this->db->where('session_id', $enable_session);
            
        }
         $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->row();

    }

}
