<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Stuattendence_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->current_date    = $this->setting_model->getDateYmd();
    }

    public function get($id = null)
    {
        $this->db->select()->from('student_attendences');
        if ($id != null) {
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('id');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function onlineattendence($data)
    {

        $this->db->where('student_session_id', $data['student_session_id']);
        $this->db->where('date', $data['date']);
        $q = $this->db->get('student_attendences');

        if ($q->num_rows() == 0) {
            $this->db->insert('student_attendences', $data);
            return ($this->db->affected_rows() != 1) ? false : true;
        }
        return false;

    }

    public function add($data)
    {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('student_attendences', $data);
            $message   = UPDATE_RECORD_CONSTANT . " On  student attendences id " . $data['id'];
            $action    = "Update";
            $record_id = $data['id'];
            $this->log($message, $record_id, $action);
            
        } else {
            $this->db->insert('student_attendences', $data);
            $id        = $this->db->insert_id();
            $message   = INSERT_RECORD_CONSTANT . " On  student attendences id " . $id;
            $action    = "Insert";
            $record_id = $id;
            $this->log($message, $record_id, $action);
            
        }
		//echo $this->db->last_query();die;
            //======================Code End==============================

            $this->db->trans_complete(); # Completing transaction
            /*Optional*/

            if ($this->db->trans_status() === false) {
                # Something went wrong.
                $this->db->trans_rollback();
                return false;

            } else {
                //return $return_value;
            }
    }

    public function searchAttendenceClassSection($class_id, $section_id, $date)
    {

        $sql = "select student_sessions.attendence_id,student_sessions.attendence_dt,students.firstname,student_sessions.date,student_sessions.remark,student_sessions.biometric_attendence,students.roll_no,students.admission_no,students.lastname,student_sessions.attendence_type_id,student_sessions.id as student_session_id, attendence_type.type as `att_type`,attendence_type.key_value as `key` from students ,(SELECT student_session.id,student_session.student_id ,IFNULL(student_attendences.date, 'xxx') as date,IFNULL(student_attendences.created_at, 'xxx') as attendence_dt,student_attendences.remark,student_attendences.biometric_attendence, IFNULL(student_attendences.id, 0) as attendence_id,student_attendences.attendence_type_id FROM `student_session` LEFT JOIN student_attendences ON student_attendences.student_session_id=student_session.id  and student_attendences.date=" . $this->db->escape($date) . " where  student_session.session_id=" . $this->db->escape($this->current_session) . " and student_session.class_id=" . $this->db->escape($class_id) . " and student_session.section_id=" . $this->db->escape($section_id) . ") as student_sessions   LEFT JOIN attendence_type ON attendence_type.id=student_sessions.attendence_type_id where student_sessions.student_id = students.id and students.is_active = 'yes' ORDER BY students.id desc";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function searchAttendenceReport($class_id, $section_id, $date)
    {

        $sql = "select student_sessions.attendence_id,students.firstname,student_sessions.date,student_sessions.remark,students.roll_no,students.admission_no,students.lastname,student_sessions.attendence_type_id,student_sessions.id as student_session_id, attendence_type.type as `att_type`,attendence_type.key_value as `key` from students ,(SELECT student_session.id,student_session.student_id ,IFNULL(student_attendences.date, 'xxx') as date,student_attendences.remark, IFNULL(student_attendences.id, 0) as attendence_id,student_attendences.attendence_type_id FROM `student_session` LEFT JOIN student_attendences ON student_attendences.student_session_id=student_session.id  and student_attendences.date=" . $this->db->escape($date) . " where  student_session.session_id=" . $this->db->escape($this->current_session) . " and student_session.class_id=" . $this->db->escape($class_id) . " and student_session.section_id=" . $this->db->escape($section_id) . ") as student_sessions   LEFT JOIN attendence_type ON attendence_type.id=student_sessions.attendence_type_id where student_sessions.student_id=students.id  and students.is_active = 'yes' ";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function searchAttendenceClassSectionPrepare($class_id, $section_id, $date)
    {
        $query = $this->db->query("select student_sessions.attendence_id,student_sessions.remark,students.firstname,students.admission_no,student_sessions.date,students.roll_no,students.lastname,student_sessions.attendence_type_id,student_sessions.id as student_session_id from students ,(SELECT student_session.id,student_session.student_id ,IFNULL(student_attendences.date, 'xxx') as date,student_attendences.remark,IFNULL(student_attendences.id, 0) as attendence_id,student_attendences.attendence_type_id FROM `student_session` RIGHT JOIN student_attendences ON student_attendences.student_session_id=student_session.id  and student_attendences.date=" . $this->db->escape($date) . " where  student_session.session_id=" . $this->db->escape($this->current_session) . " and student_session.class_id=" . $this->db->escape($class_id) . " and student_session.section_id=" . $this->db->escape($section_id) . ") as student_sessions where student_sessions.student_id=students.id ");
        return $query->result_array();
    }

    public function count_attendance_obj($month, $year, $student_id, $attendance_type = 1)
    {

        $query = $this->db->select('count(*) as attendence')->join("student_session", "student_attendences.student_session_id = student_session.id")->where(array('student_attendences.student_session_id' => $student_id, 'month(date)' => $month, 'year(date)' => $year, 'student_attendences.attendence_type_id' => $attendance_type))->get("student_attendences");

        return $query->row()->attendence;

    }

    public function attendanceYearCount()
    {

        $query = $this->db->select("distinct year(date) as year")->get("student_attendences");

        return $query->result_array();
    }

    public function getTodayDayAttendance($total_student){
        
         $query = $this->db->query("SELECT 
            concat(round((sum( case when `attendence_type_id`=1 then 1 else 0 end)*100/".$total_student."),2),'%') as present, concat(round((sum( case when `attendence_type_id`=3 then 1 else 0 end)*100/".$total_student."),2),'%') as late,
            concat(round((sum( case when `attendence_type_id`=4 then 1 else 0 end)*100/".$total_student."),2),'%') as absent,concat(round((sum( case when `attendence_type_id`=6 then 1 else 0 end)*100/".$total_student."),2),'%') as half_day,sum( case when `attendence_type_id`=1 then 1 else 0 end) as total_present,sum( case when `attendence_type_id`=3 then 1 else 0 end) as total_late,sum( case when `attendence_type_id`=4 then 1 else 0 end) as total_absent,sum( case when `attendence_type_id`=6 then 1 else 0 end) as total_half_day FROM `student_attendences` inner join student_session on student_attendences.student_session_id=student_session.id where date_format(date,'%Y-%m-%d')='".date('Y-m-d')."' and student_session.session_id='".$this->current_session."'");
        return $query->row_array();
    }

    public function student_attendences($condition,$date_condition){
          
         $query=$this->db->query("SELECT `classes`.`id` AS `class_id`, `students`.`id`, `classes`.`class`, `sections`.`id` AS `section_id`, `sections`.`section`, `students`.`id`, `students`.`admission_no`, `students`.`roll_no`, `students`.`admission_date`, `students`.`firstname`, `students`.`lastname`, `students`.`image`, `students`.`mobileno`, `students`.`email`, `students`.`state`, `students`.`city`, `students`.`pincode`, `students`.`religion`, `students`.`dob`, `students`.`current_address`,  `students`.`adhar_no`, `students`.`samagra_id`, `students`.`bank_account_no`, `students`.`bank_name`, `students`.`ifsc_code`, `students`.`father_name`, `students`.`guardian_name`, `students`.`guardian_relation`, `students`.`guardian_phone`, `students`.`guardian_address`, `students`.`is_active`, `students`.`created_at`, `students`.`updated_at`, `students`.`gender`, `students`.`rte`, `student_session`.`session_id`,`date` FROM `student_attendences` INNER JOIN `student_session` ON `student_session`.`id` = `student_attendences`.`student_session_id` INNER JOIN `students` ON `student_session`.`student_id` = `students`.`id` JOIN `classes` ON `student_session`.`class_id` = `classes`.`id` JOIN `sections` ON `sections`.`id` = `student_session`.`section_id` LEFT JOIN `categories` ON `students`.`category_id` = `categories`.`id` WHERE `student_session`.`session_id` = '".$this->current_session."' AND `students`.`is_active` = 'yes' ".$condition." group by students.id  ORDER BY `students`.`id`");

        // $this->db->select('classes.id AS `class_id`,students.id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,      students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code ,students.father_name , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.gender,students.rte,student_session.session_id,')->from('student_attendences');
        // $this->db->join('student_session', 'student_session.id = student_attendences.student_session_id','inner');
        // $this->db->join('students', 'student_session.student_id = students.id','inner');        
        // $this->db->join('classes', 'student_session.class_id = classes.id');
        // $this->db->join('sections', 'sections.id = student_session.section_id');
        // $this->db->join('categories', 'students.category_id = categories.id','left');
        // $this->db->where('student_session.session_id', $this->current_session);
        // $this->db->where('students.is_active', 'yes');
        
        // $this->db->group_by('students.id');

        // if ($condition != null) {

        //     $this->db->where($condition);

        // }

        // $this->db->order_by('students.id');
        // $query = $this->db->get();
        return $query->result_array();
    }

    public function checkholidatbydate($date){
        $where['attendence_type_id']='5';
        $where['date']=date('Y-m-d',strtotime($date));
        $query=$this->db->select('count(*) as day ')->where($where)->get('student_attendences')->row_array();
        return $query['day'];

    }
 
    public function biometric_attlog($limit=null,$offset=NULL){
        return $this->db->select('student_attendences.*,CONCAT_WS(students.firstname," ",students.lastname) as name')->from('student_attendences')->join('student_session','student_session.id=student_attendences.student_session_id','left')->join('students','student_session.student_id=students.id','left')->where('biometric_attendence',1)->limit($limit, $offset)->get()->result_array();
    }

    public function biometric_attlogcount(){
        $count=$this->db->select('count(*) as total')->from('student_attendences')->where('biometric_attendence',1)->get()->row_array();
        return $count['total'];
    }

}