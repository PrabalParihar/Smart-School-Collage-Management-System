<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Studentfee_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->current_date = $this->setting_model->getDateYmd();
    }

    public function getStudentFeesArray($ids = null, $student_session_id) {
        $query = "SELECT feemasters.id as feemastersid, feemasters.amount as amount,IFNULL(student_fees.id, 'xxx') as invoiceno,IFNULL(student_fees.payment_mode, 'xxx') as payment_mode,IFNULL(student_fees.amount_discount, 'xxx') as discount,IFNULL(student_fees.amount_fine, 'xxx') as fine, IFNULL(student_fees.date, 'xxx') as date,feetype.type ,feecategory.category FROM feemasters LEFT JOIN (select student_fees.id,student_fees.payment_mode,student_fees.feemaster_id,student_fees.amount_fine,student_fees.amount_discount,student_fees.date,student_fees.student_session_id from student_fees , student_session where student_fees.student_session_id=student_session.id and student_session.id=" . $this->db->escape($student_session_id) . ") as student_fees ON student_fees.feemaster_id=feemasters.id LEFT JOIN feetype ON feemasters.feetype_id = feetype.id LEFT JOIN feecategory ON feetype.feecategory_id = feecategory.id where feemasters.id IN (" . $ids . ")";

        $query = $this->db->query($query);
        return $query->result_array();
    }

    public function getCollectBy(){
       // echo "asd";die;
      return $this->db->select('id,name,surname')->from('staff')->get()->result_array(); 
       //echo $this->db->last_query();die;
    }

    public function getTotalCollectionBydate($date) {
        $sql = "SELECT sum(amount) as `amount`, SUM(amount_discount) as `amount_discount` ,SUM(amount_fine) as `amount_fine` FROM `student_fees` where date=" . $this->db->escape($date);
        $query = $this->db->query($sql);
        return $query->row();
    }

    public function getStudentFees($id = null) {
        $this->db->select('feecategory.category,student_fees.id as `invoiceno`,student_fees.date,student_fees.id,student_fees.amount,student_fees.amount_discount,student_fees.amount_fine,student_fees.created_at,feetype.type')->from('student_fees');
        $this->db->join('student_session', 'student_session.id = student_fees.student_session_id');
        $this->db->join('feemasters', 'feemasters.id = student_fees.feemaster_id');
        $this->db->join('feetype', 'feetype.id = feemasters.feetype_id');
        $this->db->join('feecategory', 'feetype.feecategory_id = feecategory.id');
        $this->db->where('student_session.student_id', $id);
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->order_by('student_fees.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getFeeByInvoice($id = null) {
        $this->db->select('feecategory.category,student_fees.date,student_fees.payment_mode,student_fees.id as `student_fee_id`,student_fees.amount,student_fees.amount_discount,student_fees.amount_fine,student_fees.created_at,classes.class,sections.section,feetype.type,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,students.dob ,students.current_address,    students.permanent_address,students.category_id,    students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name, students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.rte')->from('student_fees');
        $this->db->join('student_session', 'student_session.id = student_fees.student_session_id');
        $this->db->join('feemasters', 'feemasters.id = student_fees.feemaster_id');
        $this->db->join('feetype', 'feetype.id = feemasters.feetype_id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('feecategory', 'feetype.feecategory_id = feecategory.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('students', 'students.id = student_session.student_id');
        $this->db->where('student_fees.id', $id);
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->order_by('student_fees.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getTodayStudentFees() {
        $this->db->select('student_fees.date,student_fees.id,student_fees.amount,student_fees.amount_discount,student_fees.amount_fine,student_fees.created_at,classes.class,sections.section,students.firstname,students.lastname,students.admission_no,students.roll_no,students.dob,students.guardian_name,feetype.type')->from('student_fees');
        $this->db->join('student_session', 'student_session.id = student_fees.student_session_id');
        $this->db->join('feemasters', 'feemasters.id = student_fees.feemaster_id');
        $this->db->join('feetype', 'feetype.id = feemasters.feetype_id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('students', 'students.id = student_session.student_id');
        $this->db->where('student_fees.date', $this->current_date);
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->order_by('student_fees.id');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function remove($id, $sub_invoice) {
        $this->db->where('id', $id);
        $q = $this->db->get('student_fees_deposite');
        if ($q->num_rows() > 0) {
            $result = $q->row();
            $a = json_decode($result->amount_detail, true);
            unset($a[$sub_invoice]);
            if (!empty($a)) {
                $data['amount_detail'] = json_encode($a);
                $this->db->where('id', $id);
                $this->db->update('student_fees_deposite', $data);
            } else {
                $this->db->where('id', $id);
                $this->db->delete('student_fees_deposite');
            }
        }
    }


    public function add($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('student_fees', $data);
        } else {
            $this->db->insert('student_fees', $data);
            return $this->db->insert_id();
        }
    }

    public function getDueStudentFees($feegroup_id = null, $fee_groups_feetype_id = null, $class_id = null, $section_id = null) {

        $query = "SELECT IFNULL(student_fees_deposite.id, 0) as student_fees_deposite_id, IFNULL(student_fees_deposite.fee_groups_feetype_id, 0) as fee_groups_feetype_id, IFNULL(student_fees_deposite.amount_detail, 0) as amount_detail, student_fees_master.id as `fee_master_id`,fee_groups_feetype.feetype_id ,fee_groups_feetype.amount,fee_groups_feetype.due_date, `classes`.`id` AS `class_id`, `student_session`.`id` as `student_session_id`, `students`.`id`, `classes`.`class`, `sections`.`id` AS `section_id`, `sections`.`section`, `students`.`id`, `students`.`admission_no`, `students`.`roll_no`, `students`.`admission_date`, `students`.`firstname`, `students`.`lastname`, `students`.`image`, `students`.`mobileno`, `students`.`email`, `students`.`state`, `students`.`city`, `students`.`pincode`, `students`.`religion`, `students`.`dob`, `students`.`current_address`, `students`.`permanent_address`, IFNULL(students.category_id, 0) as `category_id`, IFNULL(categories.category, '') as `category`, `students`.`adhar_no`, `students`.`samagra_id`, `students`.`bank_account_no`, `students`.`bank_name`, `students`.`ifsc_code`, `students`.`guardian_name`, `students`.`guardian_relation`, `students`.`guardian_phone`, `students`.`guardian_address`, `students`.`is_active`, `students`.`created_at`, `students`.`updated_at`, `students`.`father_name`, `students`.`rte`, `students`.`gender` FROM `students` JOIN `student_session` ON `student_session`.`student_id` = `students`.`id` JOIN `classes` ON `student_session`.`class_id` = `classes`.`id` JOIN `sections` ON `sections`.`id` = `student_session`.`section_id` LEFT JOIN `categories` ON `students`.`category_id` = `categories`.`id` INNER JOIN student_fees_master on student_fees_master.student_session_id=student_session.id and student_fees_master.fee_session_group_id=" . $this->db->escape($feegroup_id) . " LEFT JOIN student_fees_deposite on student_fees_deposite.student_fees_master_id=student_fees_master.id and student_fees_deposite.fee_groups_feetype_id=" . $this->db->escape($fee_groups_feetype_id) . "  INNER JOIN fee_groups_feetype on fee_groups_feetype.id = " . $this->db->escape($fee_groups_feetype_id) . " WHERE `student_session`.`session_id` = " . $this->current_session . " AND 
            `students`.`is_active` = 'yes'  AND 
            `student_session`.`class_id` = " . $this->db->escape($class_id) . " AND `student_session`.`section_id` = " . $this->db->escape($section_id) . " ORDER BY `students`.`id`";
        $query = $this->db->query($query);
        return $query->result_array();
    }

    public function getDueFeeBystudent($class_id = null, $section_id = null, $student_id = null) {
        $query = "SELECT feemasters.id as feemastersid, feemasters.amount as amount,IFNULL(student_fees.id, 'xxx') as invoiceno,IFNULL(student_fees.amount_discount, 'xxx') as discount,IFNULL(student_fees.amount_fine, 'xxx') as fine,IFNULL(student_fees.payment_mode, 'xxx') as payment_mode,IFNULL(student_fees.date, 'xxx') as date,feetype.type ,feecategory.category,student_fees.description FROM feemasters LEFT JOIN (select student_fees.id,student_fees.feemaster_id,student_fees.payment_mode,student_fees.amount_fine,student_fees.amount_discount,student_fees.date,student_fees.student_session_id,student_fees.description  from student_fees , student_session where student_fees.student_session_id=student_session.id and student_session.student_id=" . $this->db->escape($student_id) . " and student_session.class_id=" . $this->db->escape($class_id) . " and student_session.section_id=" . $this->db->escape($section_id) . ") as student_fees ON student_fees.feemaster_id=feemasters.id JOIN feetype ON feemasters.feetype_id = feetype.id JOIN feecategory ON feetype.feecategory_id = feecategory.id  where  feemasters.class_id=" . $this->db->escape($class_id) . " and feemasters.session_id=" . $this->db->escape($this->current_session);
        $query = $this->db->query($query);
        return $query->result_array();
    }

    public function getDueFeeBystudentSection($class_id = null, $section_id = null, $student_session_id = null) {
        $query = "SELECT feemasters.id as feemastersid, feemasters.amount as amount,IFNULL(student_fees.id, 'xxx') as invoiceno,IFNULL(student_fees.amount_discount, 'xxx') as discount,IFNULL(student_fees.amount_fine, 'xxx') as fine, IFNULL(student_fees.date, 'xxx') as date,feetype.type ,feecategory.category FROM feemasters LEFT JOIN (select student_fees.id,student_fees.feemaster_id,student_fees.amount_fine,student_fees.amount_discount,student_fees.date,student_fees.student_session_id from student_fees , student_session where student_fees.student_session_id=student_session.id and student_session.id=" . $this->db->escape($student_session_id) . " ) as student_fees ON student_fees.feemaster_id=feemasters.id LEFT JOIN feetype ON feemasters.feetype_id = feetype.id LEFT JOIN feecategory ON feetype.feecategory_id = feecategory.id  where  feemasters.class_id=" . $this->db->escape($class_id) . " and feemasters.session_id=" . $this->db->escape($this->current_session);
        $query = $this->db->query($query);
        return $query->result_array();
    }

    public function getFeesByClass($class_id = null, $section_id = null, $student_id = null) {
        $query = "SELECT feemasters.id as feemastersid, feemasters.amount as amount,IFNULL(student_fees.id, 'xxx') as invoiceno,IFNULL(student_fees.amount_discount, 'xxx') as discount,IFNULL(student_fees.amount_fine, 'xxx') as fine, IFNULL(student_fees.date, 'xxx') as date,feetype.type ,feecategory.category FROM feemasters LEFT JOIN (select student_fees.id,student_fees.feemaster_id,student_fees.amount_fine,student_fees.amount_discount,student_fees.date,student_fees.student_session_id from student_fees , student_session where student_fees.student_session_id=student_session.id and student_session.student_id=" . $this->db->escape($student_id) . " and student_session.class_id=" . $this->db->escape($class_id) . " and student_session.section_id=" . $this->db->escape($section_id) . ") as student_fees ON student_fees.feemaster_id=feemasters.id LEFT JOIN feetype ON feemasters.feetype_id = feetype.id LEFT JOIN feecategory ON feetype.feecategory_id = feecategory.id  where  feemasters.class_id=" . $this->db->escape($class_id) . " and feemasters.session_id=" . $this->db->escape($this->current_session);
        $query = $this->db->query($query);
        return $query->result_array();
    }

    public function getFeeBetweenDate($start_date, $end_date) {

        $this->db->select('student_fees.date,student_fees.id,student_fees.amount,student_fees.amount_discount,student_fees.amount_fine,student_fees.created_at,students.rte,classes.class,sections.section,students.firstname,students.lastname,students.admission_no,students.roll_no,students.dob,students.guardian_name,feetype.type')->from('student_fees');
        $this->db->join('student_session', 'student_session.id = student_fees.student_session_id');
        $this->db->join('feemasters', 'feemasters.id = student_fees.feemaster_id');
        $this->db->join('feetype', 'feetype.id = feemasters.feetype_id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('students', 'students.id = student_session.student_id');
        $this->db->where('student_fees.date >=', $start_date);
        $this->db->where('student_fees.date <=', $end_date);
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->order_by('student_fees.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getStudentTotalFee($class_id, $student_session_id) {
        $query = "SELECT a.totalfee,b.fee_deposit,b.payment_mode  FROM ( SELECT COALESCE(sum(amount),0) as totalfee FROM `feemasters` WHERE session_id =$this->current_session and class_id=" . $this->db->escape($class_id) . ") as a, (select COALESCE(sum(amount),0) as fee_deposit,payment_mode from student_fees WHERE student_session_id =" . $this->db->escape($student_session_id) . ") as b";
        $query = $this->db->query($query);
        return $query->row();
    }

}
