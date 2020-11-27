<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Attendence extends Student_Controller
{

    public function __construct()
    {
        parent::__construct();
    }


   public function getdaysubattendence()
    {
        $date=$this->input->post('date');
        $date=date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date')));

        $attendencetypes = $this->attendencetype_model->get();
        // $date=date('2019-11-11');   
        $timestamp = strtotime($date);
        $day = date('l', $timestamp);

        $student_id            = $this->customlib->getStudentSessionUserID();
        $student               = $this->student_model->get($student_id);
        $student_current_class = $this->customlib->getStudentCurrentClsSection();
        $student_session_id    = $student_current_class->student_session_id;
        $class_id    = $student_current_class->class_id;
        $section_id    = $student_current_class->section_id;
        $result['attendencetypeslist'] = $attendencetypes;
        $result['attendence']=$this->studentsubjectattendence_model->studentAttendanceByDate($class_id, $section_id, $day, $date,$student_session_id);
        $result_page=$this->load->view('user/attendence/_getdaysubattendence', $result,true);
       echo json_encode(array('status' => 1,'result_page'=>$result_page));
       
        
    }
    public function index()
    {
    
        $this->session->set_userdata('top_menu', 'Attendence');
        $this->session->set_userdata('sub_menu', 'book/index');
        $data['title']      = 'Attendence List';
        $result             = array();
        $data['resultList'] = $result;
        $setting_result     = $this->setting_model->get();

        $setting_result = ($setting_result[0]);
        $setting_result['attendence_type'];

        $this->load->view('layout/student/header');
        if ($setting_result['attendence_type']) {

            $this->load->view('user/attendence/attendenceSubject', $data);
        } else {
            $this->load->view('user/attendence/attendenceIndex', $data);

        }

        $this->load->view('layout/student/footer');
    }

    public function getAttendence()
    {
        $year                  = $this->input->get('year');
        $month                 = $this->input->get('month');
        $student_id            = $this->customlib->getStudentSessionUserID();
        $student               = $this->student_model->get($student_id);
        $student_current_class = $this->customlib->getStudentCurrentClsSection();
        $student_session_id    = $student_current_class->student_session_id;
        $result                = array();
        $new_date              = "01-" . $month . "-" . $year;
        $totalDays             = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $first_day_this_month  = date('01-m-Y');
        $fst_day_str           = strtotime(date('d-m-Y', strtotime($new_date)));
        $array                 = array();
        for ($day = 1; $day <= $totalDays; $day++) {
            $date               = date('Y-m-d', $fst_day_str);
            $student_attendence = $this->attendencetype_model->getStudentAttendence($date, $student_session_id);
            if (!empty($student_attendence)) {
                $s           = array();
                $s['date']   = $date;
                $s['badge']  = false;
                $s['footer'] = "Extra information";
                $type        = $student_attendence->type;
                $s['title']  = $type;
                if ($type == 'Present') {
                    $s['classname'] = "grade-4";
                } else if ($type == 'Absent') {
                    $s['classname'] = "grade-1";
                } else if ($type == 'Late') {
                    $s['classname'] = "grade-3";
                } else if ($type == 'Late with excuse') {
                    $s['classname'] = "grade-2";
                } else if ($type == 'Holiday') {
                    $s['classname'] = "grade-5";
                } else if ($type == 'Half Day') {
                    $s['classname'] = "grade-2";
                }
                $array[] = $s;
            }
            $fst_day_str = ($fst_day_str + 86400);
        }
        if (!empty($array)) {
            echo json_encode($array);
        } else {
            echo false;
        }
    }
}