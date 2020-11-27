<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Studenttransportfee_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->current_date = $this->setting_model->getDateYmd();
    }

    public function add($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('student_transport_fees', $data);
        } else {
            $this->db->insert('student_transport_fees', $data);
            return $this->db->insert_id();
        }
    }

    public function getTransportFeeByStudent($student_session_id = null) {
        $this->db->select()->from('student_transport_fees');
        $this->db->where('student_session_id', $student_session_id);
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getfeeByID($id = null) {
        $this->db->select('student_transport_fees.id as `payment_id`,student_transport_fees.payment_mode,student_transport_fees.amount,student_transport_fees.amount_fine,student_transport_fees.amount_discount,student_transport_fees.date,  classes.class,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,students.category_id,    students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name, students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.rte')->from('student_transport_fees');
        $this->db->join('student_session', 'student_session.id = student_transport_fees.student_session_id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('students', 'students.id = student_session.student_id');
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('student_transport_fees.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getTransportFeeByIDs($ids) {
        $this->db->select('*');
        $this->db->from('student_transport_fees');
        $this->db->where_in('id', $ids);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            return $query->result_array();
        } else {
            return false;
        }
    }

    public function remove($id) {
        $this->db->where('id', $id);
        $this->db->delete('student_transport_fees');
    }

}
