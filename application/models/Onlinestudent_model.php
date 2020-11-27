<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Onlinestudent_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->current_date = $this->setting_model->getDateYmd();
    }

    public function add($data) {

    
            $this->db->insert('online_admissions', $data);
            return $this->db->insert_id();
       
    }

    public function get($id = null,$carray=null) {
        
        $this->db->select('online_admissions.vehroute_id,vehicle_routes.route_id,vehicle_routes.vehicle_id,transport_route.route_title,vehicles.vehicle_no,hostel_rooms.room_no,vehicles.driver_name,vehicles.driver_contact,hostel.id as `hostel_id`,hostel.hostel_name,room_types.id as `room_type_id`,room_types.room_type ,online_admissions.hostel_room_id,class_sections.id as class_section_id,classes.id AS `class_id`,classes.class,sections.id AS `section_id`,sections.section,online_admissions.id,online_admissions.admission_no , online_admissions.roll_no,online_admissions.admission_date,online_admissions.firstname,  online_admissions.lastname,online_admissions.image,    online_admissions.mobileno, online_admissions.email ,online_admissions.state ,   online_admissions.city , online_admissions.pincode , online_admissions.note, online_admissions.religion, online_admissions.cast, school_houses.house_name,   online_admissions.dob ,online_admissions.current_address, online_admissions.previous_school,
            online_admissions.guardian_is,
            online_admissions.permanent_address,IFNULL(online_admissions.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,online_admissions.adhar_no,online_admissions.samagra_id,online_admissions.bank_account_no,online_admissions.bank_name, online_admissions.ifsc_code , online_admissions.guardian_name , online_admissions.father_pic ,online_admissions.height ,online_admissions.weight,online_admissions.measurement_date, online_admissions.mother_pic , online_admissions.guardian_pic , online_admissions.guardian_relation,online_admissions.guardian_phone,online_admissions.guardian_address,online_admissions.is_enroll ,online_admissions.created_at,online_admissions.document ,online_admissions.updated_at,online_admissions.father_name,online_admissions.father_phone,online_admissions.blood_group,online_admissions.school_house_id,online_admissions.father_occupation,online_admissions.mother_name,online_admissions.mother_phone,online_admissions.mother_occupation,online_admissions.guardian_occupation,online_admissions.gender,online_admissions.guardian_is,online_admissions.rte,online_admissions.guardian_email')->from('online_admissions');

        $this->db->join('class_sections', 'class_sections.id = online_admissions.class_section_id', 'left');
        $this->db->join('classes', 'class_sections.class_id = classes.id', 'left');
        $this->db->join('sections', 'sections.id = class_sections.section_id', 'left');
        $this->db->join('hostel_rooms', 'hostel_rooms.id = online_admissions.hostel_room_id', 'left');
        $this->db->join('hostel', 'hostel.id = hostel_rooms.hostel_id', 'left');
        $this->db->join('room_types', 'room_types.id = hostel_rooms.room_type_id', 'left');
        $this->db->join('categories', 'online_admissions.category_id = categories.id', 'left');
        $this->db->join('vehicle_routes', 'vehicle_routes.id = online_admissions.vehroute_id', 'left');
        $this->db->join('transport_route', 'vehicle_routes.route_id = transport_route.id', 'left');
        $this->db->join('vehicles', 'vehicles.id = vehicle_routes.vehicle_id', 'left');
        $this->db->join('school_houses', 'school_houses.id = online_admissions.school_house_id', 'left');

        if($carray!=null){
        $this->db->where_in('classes.id', $carray);
        }

        if ($id != null) {
            $this->db->where('online_admissions.id', $id);
        } else {

            $this->db->order_by('online_admissions.id', 'desc');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function update($data, $action = "save") {

        $record_update_status = true;
        if (isset($data['id'])) {
            $this->db->trans_begin();
            $data_id = $data['id'];
            $class_section_id = $data['class_section_id'];

            if ($action == "enroll") {
			//==========================
                $insert = true;
                $sch_setting_detail = $this->setting_model->getSetting();


                if ($sch_setting_detail->adm_auto_insert) {
                    if ($sch_setting_detail->adm_update_status) {

                        $admission_no = $sch_setting_detail->adm_prefix . $sch_setting_detail->adm_start_from;

                        $last_student = $this->student_model->lastRecord();

                        $last_admission_digit = str_replace($sch_setting_detail->adm_prefix, "", $last_student->admission_no);

                        $admission_no = $sch_setting_detail->adm_prefix . sprintf("%0" . $sch_setting_detail->adm_no_digit . "d", $last_admission_digit + 1);
                        
                        $data['admission_no'] = $admission_no;
                    } else {
                        $admission_no = $sch_setting_detail->adm_prefix . $sch_setting_detail->adm_start_from;
                        $data['admission_no'] = $admission_no;
                    }
                }


                $admission_no_exists = $this->student_model->check_adm_exists($data['admission_no']);
                if ($admission_no_exists) {
                    $insert = false;
                    $record_update_status = false;
                }
 
				//============================
                if ($insert) {
                    $this->db->select('class_sections.*')->from('class_sections');
                    $this->db->where('class_sections.id', $data['class_section_id']);
                    $query = $this->db->get();
                    $classs_section_result = $query->row();
                    unset($data['class_section_id']);
                    unset($data['id']);
                    $this->db->insert('students', $data);
                    $student_id = $this->db->insert_id();
                   
                    $data_new = array(
                        'student_id' => $student_id,
                        'class_id' => $classs_section_result->class_id,
                        'section_id' => $classs_section_result->section_id,
                        'session_id' => $this->current_session,
                    );
                    $this->db->insert('student_session', $data_new);

//===============Start Student ID===========
                    $user_password = $this->role->get_random_password($chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false);

                         $data_student_login = array(
                        'username' => $this->student_login_prefix . $student_id,
                        'password' => $user_password,
                        'user_id' => $student_id,
                        'role' => 'student',
                    );

                    $this->user_model->add($data_student_login);
//===============End Student ID===========
                    //===============Start Parent ID===========

                    $parent_password = $this->role->get_random_password($chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false);
                    $temp = $student_id;
                    $data_parent_login = array(
                        'username' => $this->parent_login_prefix . $student_id,
                        'password' => $parent_password,
                        'user_id' => 0,
                        'role' => 'parent',
                        'childs' => $temp,
                    );
                    $ins_parent_id = $this->user_model->add($data_parent_login);
                    $update_student = array(
                        'id' => $student_id,
                        'parent_id' => $ins_parent_id,
                    );
                    $this->student_model->add($update_student);

//===============End Parent ID===========
                    //============== Update setting modal===============================

                    if ($sch_setting_detail->adm_auto_insert) {
                        if ($sch_setting_detail->adm_update_status == 0) {
                            $data_setting=array();
                            $data_setting['id']=$sch_setting_detail->id;
                            $data_setting['adm_update_status'] = 1;
                            $this->setting_model->add($data_setting);
                        }
                    }

                    //=============================================


                    $data['is_enroll'] = 1;
                    $data['class_section_id'] = $class_section_id;
                }
            }

            $this->db->where('id', $data_id);
            $this->db->update('online_admissions', $data);
			
			$message      = UPDATE_RECORD_CONSTANT." On  online admissions id ".$data_id;
			$action       = "Update";
			$record_id    = $data_id;
			$this->log($message, $record_id, $action);
			
            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
        }
        return $record_update_status;
    }

     public function remove($id) {
		$this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->where('id', $id);
        $this->db->delete('online_admissions');
		$message      = DELETE_RECORD_CONSTANT." On online admissions id ".$id;
        $action       = "Delete";
        $record_id    = $id;
        $this->log($message, $record_id, $action);
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


}
