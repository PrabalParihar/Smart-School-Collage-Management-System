<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Subjectattendence extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->config->load("mailsms");
        $this->load->library('mailsmsconf');
        $this->config_attendance = $this->config->item('attendence');
        $this->load->model("classteacher_model");
    }

    public function reportbymonthstudent()
    {
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/attendence');
        $this->session->set_userdata('subsub_menu', 'Reports/attendence/reportbymonthstudent');
        $data              = array();
        $class             = $this->class_model->get('', $classteacher = 'yes');
        $data['classlist'] = $class;
        $data['monthlist'] = $this->customlib->getMonthDropdown();

        $data['yearlist'] = $this->studentsubjectattendence_model->attendanceYearCount();
        $data['student_id']="";
        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('student_id', $this->lang->line('student'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('month', $this->lang->line('month'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('year', $this->lang->line('year'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == true) {
            $attendencetypes             = $this->attendencetype_model->get();
            $data['attendencetypeslist'] = $attendencetypes;
            $student_id=$data['student_id']= $this->input->post('student_id');
            $class_id                    = $this->input->post('class_id');
            $section_id                  = $this->input->post('section_id');
            $month                       = $this->input->post('month');
            $year                        = $this->input->post('year');

            $month_number       = date("m", strtotime($month));
            $to_date            = cal_days_in_month(CAL_GREGORIAN, $month_number, $year);
            $attr_result        = array();
            $attendence_array   = array();
            $student_result     = array();
            $data['no_of_days'] = $to_date;
            $date_result        = array();
            $from_date          = 1;

            $resultlist = $this->studentsubjectattendence_model->getStudentMontlyAttendence($class_id, $section_id, $from_date, $to_date, $year, $month_number, $student_id);

            $data['resultlist'] = $resultlist;
        }
        $this->load->view('layout/header', $data);
        $this->load->view('admin/subjectattendence/reportbymonthstudent', $data);
        $this->load->view('layout/footer', $data);
    }
 
    public function reportbymonth()
    {

        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/attendence');
        $this->session->set_userdata('subsub_menu', 'Reports/attendence/reportbymonth');
        $data              = array();
        $class             = $this->class_model->get('', $classteacher = 'yes');
        $data['classlist'] = $class;
        $data['monthlist'] = $this->customlib->getMonthDropdown();
        $data['yearlist']  = $this->studentsubjectattendence_model->attendanceYearCount();
        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('month', $this->lang->line('month'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('year', $this->lang->line('year'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == true) {
            $attendencetypes             = $this->attendencetype_model->get();
            $data['attendencetypeslist'] = $attendencetypes;
            $class_id                    = $this->input->post('class_id');
            $section_id                  = $this->input->post('section_id');
            $month                       = $this->input->post('month');
            $year                        = $this->input->post('year');

            $month_number       = date("m", strtotime($month));
            $to_date            = cal_days_in_month(CAL_GREGORIAN, $month_number, $year);
            $attr_result        = array();
            $attendence_array   = array();
            $student_result     = array();
            $data['no_of_days'] = $to_date;
            $date_result        = array();
            $from_date          = 1;

            $resultlist = $this->studentsubjectattendence_model->getStudentsMontlyAttendence($class_id, $section_id, $from_date, $to_date, $year, $month_number);

            $data['resultlist'] = $resultlist;
        }

        $this->load->view('layout/header', $data);
        $this->load->view('admin/subjectattendence/reportbymonth', $data);
        $this->load->view('layout/footer', $data);

    }

    public function reportbydate()
    {

        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'subjectattendence/reportbydate');
        $data              = array();
        $class             = $this->class_model->get('', $classteacher = 'yes');
        $data['classlist'] = $class;
        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('date', $this->lang->line('date'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == true) {
            $class_id                    = $this->input->post('class_id');
            $section_id                  = $this->input->post('section_id');
            $date                        = $this->input->post('date');
            $day                         = date('l', $this->customlib->datetostrtotime($date));
            $resultlist                  = $this->studentsubjectattendence_model->searchByStudentsAttendanceByDate($class_id, $section_id, $day, date('Y-m-d', $this->customlib->datetostrtotime($date)));
            $attendencetypes             = $this->attendencetype_model->get();
            $data['attendencetypeslist'] = $attendencetypes;
            $data['resultlist']          = $resultlist;
        }
   
        $this->load->view('layout/header', $data);
        $this->load->view('admin/subjectattendence/reportbydate', $data);
        $this->load->view('layout/footer', $data);
    }

    public function index()
    {
     

        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'subjectattendence/index');
        $data['title']      = 'Add Fees Type';
        $data['title_list'] = 'Fees Type List';
        $class              = $this->class_model->get('', $classteacher = 'yes');
        $data['classlist']  = $class;
        $userdata           = $this->customlib->getUserData();
        $carray             = array();

        if (!empty($data["classlist"])) {
            foreach ($data["classlist"] as $ckey => $cvalue) {

                $carray[] = $cvalue["id"];
            }
        }
        $data['class_id']   = "";
        $data['section_id'] = "";
        $data['date']       = "";
        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('date', $this->lang->line('date'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('subject_timetable_id', $this->lang->line('subject'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/subjectattendence/attendenceList', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $class                = $this->input->post('class_id');
            $section              = $this->input->post('section_id');
            $date                 = $this->input->post('date');
            $subject_timetable_id = $this->input->post('subject_timetable_id');

            $data['class_id']             = $class;
            $data['section_id']           = $section;
            $data['subject_timetable_id'] = $subject_timetable_id;
            $data['date']                 = $date;
            $search                       = $this->input->post('search');
            $holiday                      = $this->input->post('holiday');
            if ($search == "saveattendence") {
                $session_ary         = $this->input->post('student_session');
                $absent_student_list = array();
                $insert_student_list = array();
                $update_student_list = array();
                foreach ($session_ary as $key => $value) {
                    $checkForUpdate = $this->input->post('attendance_id' . $value);
                    if ($checkForUpdate != 0) {
                        if (isset($holiday)) {
                            $arr = array(
                                'id'                   => $checkForUpdate,
                                'student_session_id'   => $value,
                                'attendence_type_id'   => 5,
                                'remark'               => $this->input->post("remark" . $value),
                                'subject_timetable_id' => $subject_timetable_id,
                                'date'                 => date('Y-m-d', $this->customlib->datetostrtotime($date)),
                            );
                        } else {
                            $arr = array(
                                'id'                   => $checkForUpdate,
                                'student_session_id'   => $value,
                                'attendence_type_id'   => $this->input->post('attendencetype' . $value),
                                'remark'               => $this->input->post("remark" . $value),
                                'subject_timetable_id' => $subject_timetable_id,
                                'date'                 => date('Y-m-d', $this->customlib->datetostrtotime($date)),
                            );
                        }
                        $update_student_list[] = $arr;
                    } else {
                        if (isset($holiday)) {
                            $arr = array(
                                'student_session_id'   => $value,
                                'attendence_type_id'   => 5,
                                'remark'               => $this->input->post("remark" . $value),
                                'subject_timetable_id' => $subject_timetable_id,
                                'date'                 => date('Y-m-d', $this->customlib->datetostrtotime($date)),
                            );
                        } else {

                            $arr = array(
                                'student_session_id'   => $value,
                                'attendence_type_id'   => $this->input->post('attendencetype' . $value),
                                'remark'               => $this->input->post("remark" . $value),
                                'subject_timetable_id' => $subject_timetable_id,
                                'date'                 => date('Y-m-d', $this->customlib->datetostrtotime($date)),
                            );
                        }
                        $insert_student_list[] = $arr;
                        $absent_config         = $this->config_attendance['absent'];
                        if ($arr['attendence_type_id'] == $absent_config) {
                            $absent_student_list[] = $value;
                        }
                    }
                }
                $this->studentsubjectattendence_model->add($insert_student_list, $update_student_list);
                $absent_config = $this->config_attendance['absent'];
                if (!empty($absent_student_list)) {
                     $timetable=$this->subjecttimetable_model->get($subject_timetable_id);
     
                    $this->mailsmsconf->mailsms('absent_attendence', $absent_student_list, $date,$timetable);
                }

                $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
                redirect('admin/subjectattendence/index');
            }
            $attendencetypes             = $this->attendencetype_model->get();
            $data['attendencetypeslist'] = $attendencetypes;

            $resultlist = $this->studentsubjectattendence_model->searchAttendenceClassSection($class, $section, $subject_timetable_id, date('Y-m-d', $this->customlib->datetostrtotime($date)));

            $data['resultlist'] = $resultlist;

            $this->load->view('layout/header', $data);
            $this->load->view('admin/subjectattendence/attendenceList', $data);
            $this->load->view('layout/footer', $data);
        }
    }

}
