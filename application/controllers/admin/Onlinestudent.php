<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Onlinestudent extends Admin_Controller
{

    public $sch_setting_detail = array();
    public function __construct()
    {
        parent::__construct();
        $this->load->library('smsgateway');
        $this->load->library('mailsmsconf');
        $this->load->library('encoding_lib');
        $this->load->model("classteacher_model");
        $this->load->model("timeline_model");
        $this->blood_group        = $this->config->item('bloodgroup');
        $this->sch_setting_detail = $this->setting_model->getSetting();
        $this->role;
    }

    public function index()
    {
         if (!$this->rbac->hasPrivilege('online_admission', 'can_view')) {
            access_denied();
        }
        
        $this->session->set_userdata('top_menu', 'Student Information');
        $this->session->set_userdata('sub_menu', 'onlinestudent');
        $data['title']  = 'Student List';
        $class             = $this->class_model->get();
        $data['classlist'] = $class;
        
        if(!empty($data['classlist'])){
        foreach ($data['classlist'] as $key => $value) {
           $carray[]=$value['id']; 
        }
        }

        $student_result = $this->onlinestudent_model->get(null,$carray);
        $data['studentlist'] = $student_result;

        $this->load->view('layout/header', $data);
        $this->load->view('admin/onlinestudent/studentList', $data);
        $this->load->view('layout/footer', $data);
    }

    public function download($doc)
    {
        $this->load->helper('download');
        $filepath = "./uploads/student_documents/online_admission_doc/" . $doc;
        $data     = file_get_contents($filepath);
        $name     = $this->uri->segment(6);
        force_download($name, $data);
    }

    public function delete($id)
    {
        if (!$this->rbac->hasPrivilege('online_admission', 'can_delete')) {
            access_denied();
        }
        $this->onlinestudent_model->remove($id);

        redirect('admin/onlinestudent');
    }

    public function edit($id)
    {
        if (!$this->rbac->hasPrivilege('online_admission', 'can_edit')) {
            access_denied();
        }
        $data['adm_auto_insert'] = $this->sch_setting_detail->adm_auto_insert;
        $data['title']           = 'Edit Student';
        $data['id']              = $id;
        $student                 = $this->onlinestudent_model->get($id);
        $genderList              = $this->customlib->getGender();
        $data['student']         = $student;
        $data['genderList']      = $genderList;
        $session                 = $this->setting_model->getCurrentSession();
        $vehroute_result         = $this->vehroute_model->get();
        $data['vehroutelist']    = $vehroute_result;
        $class                   = $this->class_model->get();
        $setting_result          = $this->setting_model->get();
		$data["bloodgroup"]         = $this->blood_group;
        $data["student_categorize"] = 'class';
        $data['classlist']          = $class;
        $category                   = $this->category_model->get();
        $data['categorylist']       = $category;
        $hostelList                 = $this->hostel_model->get();
        $data['hostelList']         = $hostelList;
        $houses                     = $this->houselist_model->get();
        $data['houses']             = $houses;

        $this->form_validation->set_rules('firstname', $this->lang->line('first_name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('guardian_is', $this->lang->line('guardian'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('dob', $this->lang->line('date_of_birth'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('gender', $this->lang->line('gender'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('guardian_name', $this->lang->line('guardian_name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('rte', $this->lang->line('rtl'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('guardian_phone', $this->lang->line('guardian_phone'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/onlinestudent/studentEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $student_id     = $this->input->post('student_id');
            $class_id       = $this->input->post('class_id');
            $section_id     = $this->input->post('section_id');
            $hostel_room_id = $this->input->post('hostel_room_id');
            $fees_discount  = $this->input->post('fees_discount');
            $vehroute_id    = $this->input->post('vehroute_id');
            if (empty($vehroute_id)) {
                $vehroute_id = 0;
            }
            if (empty($hostel_room_id)) {
                $hostel_room_id = 0;
            }
            $data = array(
                'id'                  => $student_id,
                'admission_no'        => $this->input->post('admission_no'),
                'roll_no'             => $this->input->post('roll_no'),
                'firstname'           => $this->input->post('firstname'),
                'lastname'            => $this->input->post('lastname'),
                'rte'                 => $this->input->post('rte'),
                'mobileno'            => $this->input->post('mobileno'),
                'email'               => $this->input->post('email'),
                'state'               => $this->input->post('state'),
                'city'                => $this->input->post('city'),
                'previous_school'     => $this->input->post('previous_school'),
                'guardian_is'         => $this->input->post('guardian_is'),
                'pincode'             => $this->input->post('pincode'),
                'measurement_date'    =>  $this->customlib->dateFormatToYYYYMMDD($this->input->post('measure_date')),
                'religion'            => $this->input->post('religion'),
                'dob'                 =>  $this->customlib->dateFormatToYYYYMMDD($this->input->post('dob')),
                'admission_date'      =>  $this->customlib->dateFormatToYYYYMMDD($this->input->post('admission_date')),
                'current_address'     => $this->input->post('current_address'),
                'permanent_address'   => $this->input->post('permanent_address'),
                'category_id'         => $this->input->post('category_id'),
                'adhar_no'            => $this->input->post('adhar_no'),
                'samagra_id'          => $this->input->post('samagra_id'),
                'bank_account_no'     => $this->input->post('bank_account_no'),
                'bank_name'           => $this->input->post('bank_name'),
                'ifsc_code'           => $this->input->post('ifsc_code'),
                'cast'                => $this->input->post('cast'),
                'father_name'         => $this->input->post('father_name'),
                'father_phone'        => $this->input->post('father_phone'),
                'father_occupation'   => $this->input->post('father_occupation'),
                'mother_name'         => $this->input->post('mother_name'),
                'mother_phone'        => $this->input->post('mother_phone'),
                'mother_occupation'   => $this->input->post('mother_occupation'),
                'guardian_occupation' => $this->input->post('guardian_occupation'),
                'guardian_email'      => $this->input->post('guardian_email'),
                'gender'              => $this->input->post('gender'),
                'guardian_name'       => $this->input->post('guardian_name'),
                'guardian_relation'   => $this->input->post('guardian_relation'),
                'guardian_phone'      => $this->input->post('guardian_phone'),
                'guardian_address'    => $this->input->post('guardian_address'),
                'vehroute_id'         => $vehroute_id,
                'hostel_room_id'      => $hostel_room_id,
                'school_house_id'     => $this->input->post('house'),
                'blood_group'         => $this->input->post('blood_group'),
                'height'              => $this->input->post('height'),
                'weight'              => $this->input->post('weight'),
                'note'                => $this->input->post('note'),
                'class_section_id'    => $section_id,
            );
            
            $response = $this->onlinestudent_model->update($data, $this->input->post('save'));
          
            if ($response) {

                $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('update_message') . '</div>');
                redirect('admin/onlinestudent');
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">'.$this->lang->line('please_check_student_admission_no').'</div>');
                redirect($_SERVER['HTTP_REFERER']);
            }

        }
    }

    public function getByClass()
    {
        $class_id = $this->input->post('class_id');
        $data     = $this->section_model->getClassBySection($class_id);
        $this->jsonlib->output(200, $data);
    }

}
