<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Systemfield extends Admin_Controller
{
    public $custom_fields_list = array();
    public function __construct()
    {
        parent::__construct();
        $this->load->library('encoding_lib');
        $this->custom_fields_list = $this->config->item('custom_fields');
        $this->custom_field_table = $this->config->item('custom_field_table');
    }

    public function index()
    {
		
        $this->session->set_userdata('top_menu', 'System Settings');
        $this->session->set_userdata('sub_menu', 'System Settings/systemfield');       
        $data['result']         = $this->setting_model->getSetting();
        $this->load->view('layout/header');
        $this->load->view('admin/systemfield/index', $data);
        $this->load->view('layout/footer');
    }

    function changeStatus() {
        
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $role = $this->input->post('role');
		
			$data = array('id' => $id);
			
        if($role == 'is_student_house'){
            if ($status == "yes" ) {
                $data['is_student_house'] = 1;                
            } else {
                $data['is_student_house'] = 0;               
            }
		} else if($role == 'roll_no'){	
			if ($status == "yes" ) {
               $data['roll_no'] = 1;             
            } else {
                $data['roll_no'] = 0;               
            }
		} else if($role == 'lastname'){	
			if ($status == "yes" ) {
               $data['lastname'] = 1;             
            } else {
                $data['lastname'] = 0;               
            }
		} else if($role == 'category'){	
			if ($status == "yes" ) {
               $data['category'] = 1;             
            } else {
                $data['category'] = 0;               
            }
		} else if($role == 'religion'){	
			if ($status == "yes" ) {
               $data['religion'] = 1;             
            } else {
                $data['religion'] = 0;               
            }
		} else if($role == 'cast'){	
			if ($status == "yes" ) {
               $data['cast'] = 1;             
            } else {
                $data['cast'] = 0;               
            }
		} else if($role == 'mobile_no'){	
			if ($status == "yes" ) {
               $data['mobile_no'] = 1;             
            } else {
                $data['mobile_no'] = 0;               
            }
		} else if($role == 'student_email'){	
			if ($status == "yes" ) {
               $data['student_email'] = 1;             
            } else {
                $data['student_email'] = 0;               
            }
		} else if($role == 'admission_date'){	
			if ($status == "yes" ) {
               $data['admission_date'] = 1;             
            } else {
                $data['admission_date'] = 0;               
            }
		} else if($role == 'student_photo'){	
			if ($status == "yes" ) {
               $data['student_photo'] = 1;             
            } else {
                $data['student_photo'] = 0;               
            }
		} else if($role == 'is_blood_group'){	
			if ($status == "yes" ) {
               $data['is_blood_group'] = 1;             
            } else {
                $data['is_blood_group'] = 0;               
            }
		} else if($role == 'student_height'){	
			if ($status == "yes" ) {
               $data['student_height'] = 1;             
            } else {
                $data['student_height'] = 0;               
            }
		} else if($role == 'student_weight'){	
			if ($status == "yes" ) {
               $data['student_weight'] = 1;             
            } else {
                $data['student_weight'] = 0;               
            }
		} else if($role == 'measurement_date'){	
			if ($status == "yes" ) {
               $data['measurement_date'] = 1;             
            } else {
                $data['measurement_date'] = 0;               
            }
		} else if($role == 'father_name'){	
			if ($status == "yes" ) {
               $data['father_name'] = 1;             
            } else {
                $data['father_name'] = 0;               
            }
		} else if($role == 'father_phone'){	
			if ($status == "yes" ) {
               $data['father_phone'] = 1;             
            } else {
                $data['father_phone'] = 0;               
            }
		} else if($role == 'father_occupation'){	
			if ($status == "yes" ) {
               $data['father_occupation'] = 1;             
            } else {
                $data['father_occupation'] = 0;               
            }
		} else if($role == 'father_pic'){	
			if ($status == "yes" ) {
               $data['father_pic'] = 1;             
            } else {
                $data['father_pic'] = 0;               
            }
		} else if($role == 'mother_name'){	
			if ($status == "yes" ) {
               $data['mother_name'] = 1;             
            } else {
                $data['mother_name'] = 0;               
            }
		} else if($role == 'mother_phone'){	
			if ($status == "yes" ) {
               $data['mother_phone'] = 1;             
            } else {
                $data['mother_phone'] = 0;               
            }
		} else if($role == 'mother_occupation'){	
			if ($status == "yes" ) {
               $data['mother_occupation'] = 1;             
            } else {
                $data['mother_occupation'] = 0;               
            }
		} else if($role == 'mother_pic'){	
			if ($status == "yes" ) {
               $data['mother_pic'] = 1;             
            } else {
                $data['mother_pic'] = 0;               
            }
		} else if($role == 'guardian_relation'){	
			if ($status == "yes" ) {
               $data['guardian_relation'] = 1;             
            } else {
                $data['guardian_relation'] = 0;               
            }
		} else if($role == 'guardian_email'){	
			if ($status == "yes" ) {
               $data['guardian_email'] = 1;             
            } else {
                $data['guardian_email'] = 0;               
            }
		} else if($role == 'guardian_pic'){	
			if ($status == "yes" ) {
               $data['guardian_pic'] = 1;             
            } else {
                $data['guardian_pic'] = 0;               
            }
		} else if($role == 'guardian_address'){	
			if ($status == "yes" ) {
               $data['guardian_address'] = 1;             
            } else {
                $data['guardian_address'] = 0;               
            }
		} else if($role == 'current_address'){	
			if ($status == "yes" ) {
               $data['current_address'] = 1;             
            } else {
                $data['current_address'] = 0;               
            }
		} else if($role == 'permanent_address'){	
			if ($status == "yes" ) {
               $data['permanent_address'] = 1;             
            } else {
                $data['permanent_address'] = 0;               
            }
		} else if($role == 'route_list'){	
			if ($status == "yes" ) {
               $data['route_list'] = 1;             
            } else {
                $data['route_list'] = 0;               
            }
		} else if($role == 'hostel_id'){	
			if ($status == "yes" ) {
               $data['hostel_id'] = 1;             
            } else {
                $data['hostel_id'] = 0;               
            }
		} else if($role == 'bank_account_no'){	
			if ($status == "yes" ) {
               $data['bank_account_no'] = 1;             
            } else {
                $data['bank_account_no'] = 0;               
            }
		} else if($role == 'national_identification_no'){	
			if ($status == "yes" ) {
               $data['national_identification_no'] = 1;             
            } else {
                $data['national_identification_no'] = 0;               
            }
		} else if($role == 'local_identification_no'){	
			if ($status == "yes" ) {
               $data['local_identification_no'] = 1;             
            } else {
                $data['local_identification_no'] = 0;               
            }
		} else if($role == 'rte'){	
			if ($status == "yes" ) {
               $data['rte'] = 1;             
            } else {
                $data['rte'] = 0;               
            }
		} else if($role == 'previous_school_details'){	
			if ($status == "yes" ) {
               $data['previous_school_details'] = 1;             
            } else {
                $data['previous_school_details'] = 0;               
            }
		} else if($role == 'student_note'){	
			if ($status == "yes" ) {
               $data['student_note'] = 1;             
            } else {
                $data['student_note'] = 0;               
            }
		} else if($role == 'upload_documents'){	
			if ($status == "yes" ) {
               $data['upload_documents'] = 1;             
            } else {
                $data['upload_documents'] = 0;               
            }
		} else if($role == 'staff_designation'){	
			if ($status == "yes" ) {
               $data['staff_designation'] = 1;             
            } else {
                $data['staff_designation'] = 0;               
            }
		} else if($role == 'staff_department'){	
			if ($status == "yes" ) {
               $data['staff_department'] = 1;             
            } else {
                $data['staff_department'] = 0;               
            }
		} else if($role == 'staff_last_name'){	
			if ($status == "yes" ) {
               $data['staff_last_name'] = 1;             
            } else {
                $data['staff_last_name'] = 0;               
            }
		} else if($role == 'staff_father_name'){	
			if ($status == "yes" ) {
               $data['staff_father_name'] = 1;             
            } else {
                $data['staff_father_name'] = 0;               
            }
		} else if($role == 'staff_mother_name'){	
			if ($status == "yes" ) {
               $data['staff_mother_name'] = 1;             
            } else {
                $data['staff_mother_name'] = 0;               
            }
		} else if($role == 'staff_date_of_joining'){	
			if ($status == "yes" ) {
               $data['staff_date_of_joining'] = 1;             
            } else {
                $data['staff_date_of_joining'] = 0;               
            }
		} else if($role == 'staff_phone'){	
			if ($status == "yes" ) {
               $data['staff_phone'] = 1;             
            } else {
                $data['staff_phone'] = 0;               
            }
		} else if($role == 'staff_emergency_contact'){	
			if ($status == "yes" ) {
               $data['staff_emergency_contact'] = 1;             
            } else {
                $data['staff_emergency_contact'] = 0;               
            }
		} else if($role == 'staff_marital_status'){	
			if ($status == "yes" ) {
               $data['staff_marital_status'] = 1;             
            } else {
                $data['staff_marital_status'] = 0;               
            }
		} else if($role == 'staff_photo'){	
			if ($status == "yes" ) {
               $data['staff_photo'] = 1;             
            } else {
                $data['staff_photo'] = 0;               
            }
		} else if($role == 'staff_current_address'){	
			if ($status == "yes" ) {
               $data['staff_current_address'] = 1;             
            } else {
                $data['staff_current_address'] = 0;               
            }
		} else if($role == 'staff_permanent_address'){	
			if ($status == "yes" ) {
               $data['staff_permanent_address'] = 1;             
            } else {
                $data['staff_permanent_address'] = 0;               
            }
		} else if($role == 'staff_qualification'){	
			if ($status == "yes" ) {
               $data['staff_qualification'] = 1;             
            } else {
                $data['staff_qualification'] = 0;               
            }
		} else if($role == 'staff_work_experience'){	
			if ($status == "yes" ) {
               $data['staff_work_experience'] = 1;             
            } else {
                $data['staff_work_experience'] = 0;               
            }
		} else if($role == 'staff_note'){	
			if ($status == "yes" ) {
               $data['staff_note'] = 1;             
            } else {
                $data['staff_note'] = 0;               
            }
		} else if($role == 'staff_epf_no'){	
			if ($status == "yes" ) {
               $data['staff_epf_no'] = 1;             
            } else {
                $data['staff_epf_no'] = 0;               
            }
		} else if($role == 'staff_basic_salary'){	
			if ($status == "yes" ) {
               $data['staff_basic_salary'] = 1;             
            } else {
                $data['staff_basic_salary'] = 0;               
            }
		} else if($role == 'staff_contract_type'){	
			if ($status == "yes" ) {
               $data['staff_contract_type'] = 1;             
            } else {
                $data['staff_contract_type'] = 0;               
            }
		} else if($role == 'staff_work_shift'){	
			if ($status == "yes" ) {
               $data['staff_work_shift'] = 1;             
            } else {
                $data['staff_work_shift'] = 0;               
            }
		} else if($role == 'staff_work_location'){	
			if ($status == "yes" ) {
               $data['staff_work_location'] = 1;             
            } else {
                $data['staff_work_location'] = 0;               
            }
		} else if($role == 'staff_leaves'){	
			if ($status == "yes" ) {
               $data['staff_leaves'] = 1;             
            } else {
                $data['staff_leaves'] = 0;               
            }
		} else if($role == 'staff_account_details'){	
			if ($status == "yes" ) {
               $data['staff_account_details'] = 1;             
            } else {
                $data['staff_account_details'] = 0;               
            }
		} else if($role == 'staff_social_media'){	
			if ($status == "yes" ) {
               $data['staff_social_media'] = 1;             
            } else {
                $data['staff_social_media'] = 0;               
            }
		} else if($role == 'staff_upload_documents'){	
			if ($status == "yes" ) {
               $data['staff_upload_documents'] = 1;             
            } else {
                $data['staff_upload_documents'] = 0;               
            }
		}	
        $this->setting_model->add($data);
      
    }
}
