<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("classteacher_model");
		$this->sch_setting_detail = $this->setting_model->getSetting();
    }

    function index() {
       
        $this->session->set_userdata('top_menu', 'System Settings');
        $this->session->set_userdata('sub_menu', 'users/index');
        $studentList = $this->student_model->getStudents();
        $staffList = $this->staff_model->getAll();
        $parentList = $this->parent_model->getParentList();

        $data['studentList'] = $studentList;
        $data['parentList'] = $parentList;
        $data['staffList'] = $staffList;

        $this->load->view('layout/header', $data);
        $this->load->view('admin/users/userList', $data);
        $this->load->view('layout/footer', $data);
    }

    function changeStatus() {
        
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $role = $this->input->post('role');
        $data = array('id' => $id, 'is_active' => $status);
        if ($role != "staff") {
            $result = $this->user_model->changeStatus($data);
        } else {
            if ($status == "yes") {
                $data['is_active'] = 1;
            } else {
                $data['is_active'] = 0;
            }
           
            $result = $this->staff_model->update($data);
        }

        if ($result) {
            $response = array('status' => 1, 'msg' => 'Status change successfully');
            echo json_encode($response);
        }
    }

    function admissionreport() {
        if (!$this->rbac->hasPrivilege('student_history', 'can_view')) {
            access_denied();
        }
   
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/student_information');
        $this->session->set_userdata('subsub_menu', 'Reports/student_information/student_history');
        $data['title'] = 'Admission Report';
 
        
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();
		$data['sch_setting']        = $this->sch_setting_detail;
		$data['adm_auto_insert']    = $this->sch_setting_detail->adm_auto_insert;
        $carray = array();
      
        if (!empty($data["classlist"])) {
            foreach ($data["classlist"] as $ckey => $cvalue) {

                $carray[] = $cvalue["id"];
            }
        }

      

        $class_id = $this->input->post("class_id");
        $year = $this->input->post("year");

        $admission_year = $this->student_model->admissionYear();

        $data["admission_year"] = $admission_year;
        if ((empty($class_id)) && (empty($year))) {

            $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');

            if ($this->form_validation->run() == FALSE) {

               
                $data["resultlist"] = "";
            }
        } else {


            $resultlist = $this->student_model->searchAdmissionDetails($class_id, $year);
            $data["resultlist"] = $resultlist;

           // echo $this->db->last_query();die;
        }
        if (!empty($resultlist)) {
            foreach ($resultlist as $key => $value) {

                $id = $value["sid"];
                $sessionlist[] = $this->student_model->studentSessionDetails($id);
            }
            $data["sessionlist"] = $sessionlist;
        }
        $this->load->view("layout/header", $data);
        $this->load->view("admin/users/admissionReport", $data);
        $this->load->view("layout/footer", $data);
    }

    function logindetailreport() {
        if (!$this->rbac->hasPrivilege('student_login_credential_report', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/student_information');
        $this->session->set_userdata('subsub_menu', 'Reports/student_information/student_login_credential');
        $class = $this->class_model->get();
        $data['classlist'] = $class;

        $studentdata = $this->student_model->get();
		$data['sch_setting']        = $this->sch_setting_detail;
		$data['adm_auto_insert']    = $this->sch_setting_detail->adm_auto_insert;
        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            $data["resultlist"] ="";
        }else{
if (isset($_POST["search"])) {

            $class_id = $this->input->post("class_id");
            $section_id = $this->input->post("section_id");

            $studentdata = $this->student_model->searchByClassSection($class_id, $section_id);
        }

        foreach ($studentdata as $key => $value) {
            $resultlist = $this->user_model->getUserLoginDetails($value["id"]);
            $parentlist = $this->user_model->getParentLoginDetails($value["id"]);
            if ($resultlist["role"] == "student") {
                $studentdata[$key]["student_username"] = $resultlist["username"];
                $studentdata[$key]["student_password"] = $resultlist["password"];
                $studentdata[$key]["parent_username"] = $parentlist["username"];
                $studentdata[$key]["parent_password"] = $parentlist["password"];
            }
        }


        $data["resultlist"] = $studentdata;
        }

        

        $this->load->view("layout/header");
        $this->load->view("admin/users/logindetailreport", $data);
        $this->load->view("layout/footer");
    }

}

?>