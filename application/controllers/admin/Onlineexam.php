<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Onlineexam extends Admin_Controller
{
  public $sch_setting_detail = array();
    public function __construct()
    {
        parent::__construct();
        $this->config->load('app-config');
        
        $this->sch_setting_detail = $this->setting_model->getSetting();
       
    }

    public function index()
    {
         if (!$this->rbac->hasPrivilege('online_examination', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu','Online_Examinations');
        $this->session->set_userdata('sub_menu','Online_Examinations/Onlineexam');
        $questionList         = $this->onlineexam_model->get();
        $data['questionList'] = $questionList;
        $subject_result       = $this->subject_model->get();
        $data['subjectlist']  = $subject_result;
        $questionOpt          = $this->customlib->getQuesOption();
        $data['questionOpt']  = $questionOpt;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/onlineexam/index', $data);
        $this->load->view('layout/footer', $data);
    }
  
    public function assign($id)
    {
        if (!$this->rbac->hasPrivilege('online_assign_view_student', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Online_Examinations');
        $this->session->set_userdata('sub_menu', 'Online_Examinations/Onlineexam');
        $data['id']         = $id;
        $data['title']      = 'student fees';
        $class              = $this->class_model->get();
        $data['classlist']  = $class;
        $onlineexam         = $this->onlineexam_model->get($id);
        $data['onlineexam'] = $onlineexam;
        $data['sch_setting']     = $this->sch_setting_detail;
        //echo "<pre>";print_r($data['sch_setting']);echo "<pre>";die;
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $data['class_id']   = $this->input->post('class_id');
            $data['section_id'] = $this->input->post('section_id');

            $data['onlineexam_id'] = $this->input->post('onlineexam_id');

            $resultlist = $this->onlineexam_model->searchOnlineExamStudents($data['class_id'], $data['section_id'], $data['onlineexam_id']);

            $data['resultlist'] = $resultlist;
        }
 
        $this->load->view('layout/header', $data);
        $this->load->view('admin/onlineexam/assign', $data);
        $this->load->view('layout/footer', $data);
    }

    public function addstudent()
    {
        $this->form_validation->set_rules('onlineexam_id', $this->lang->line('exam')." ".$this->lang->line('id'), 'required|trim|xss_clean');

        if ($this->form_validation->run() == false) {
            $data = array(
                'onlineexam_id' => form_error('onlineexam_id'),
            );
            $array = array('status' => 'fail', 'error' => $data);
            echo json_encode($array);
        } else {

            $array_insert  = array();
            $array_delete  = array();
            $class_id      = $this->input->post('post_class_id');
            $section_id    = $this->input->post('post_section_id');
            $onlineexam_id = $this->input->post('onlineexam_id');
            $resultlist    = $this->onlineexam_model->searchOnlineExamStudents($class_id, $section_id, $onlineexam_id);
            $all_students  = array();
            if (!empty($resultlist)) {

                foreach ($resultlist as $each_student_key => $each_student_value) {
                    if ($each_student_value['onlineexam_student_session_id'] != 0) {
                        $all_students[] = $each_student_value['onlineexam_student_session_id'];
                    }

                }
            }

            $students_id = $this->input->post('students_id');
            $students    = array();
            if (!isset($students_id)) {
                $students_id = array();
            }
            if (!empty($all_students)) {
                $array_delete = array_diff($all_students, $students_id);

            }
            if (!empty($students_id)) {
                $student_session_array = array();
                foreach ($students_id as $student_key => $student_value) {
                    $student_session_array[] = $student_value;
                }

                $student_array = array_diff($student_session_array, $all_students);
                if (!empty($student_array)) {
                    foreach ($student_array as $insert_key => $insert_value) {
                        $array_insert[] = array(
                            'onlineexam_id'      => $onlineexam_id,
                            'student_session_id' => $insert_value,
                        );
                    }
                }
            }

            $this->onlineexam_model->addStudents($array_insert, $array_delete, $onlineexam_id);

            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
            echo json_encode($array);
        }
    }

    public function getOnlineExamByID()
    {
        $id = $this->input->post('recordid');

        $question_result = $this->onlineexam_model->get($id);

        echo json_encode(array('status' => 1, 'result' => $question_result));
    }

    public function searchQuestionByExamID()
    {
        $data           = array();
        $pag_content    = '';
        $pag_navigation = '';
        $page           = $this->input->post('page');
        $exam_id        = $this->input->post('exam_id');
        if (isset($page)) {
            $max      = 100;
            $cur_page = $page;
            $page -= 1;
            $per_page     = $max ? $max : 40;
            $previous_btn = true;
            $next_btn     = true;
            $first_btn    = true;
            $last_btn     = true;
            $start        = $page * $per_page;
            $where_search = array();

            /* Check if there is a string inputted on the search box */
            if (!empty($_POST['search'])) {
                $search = $this->input->post('search');

                $and_array = array('subjects.id' => $search);

                $where_search['and_array'] = $and_array;
            }
            $data['questionList'] = $this->onlineexamquestion_model->getByExamID($exam_id, $per_page, $start, $where_search);

            $count = $this->onlineexamquestion_model->getCountByExamID($exam_id, $where_search);

            /* Check if our query returns anything. */
            if ($count) {
                $pag_content = $this->load->view('admin/onlineexam/_searchQuestionByExamID', $data, true);
                /* If the query returns nothing, we throw an error message */
            }
 
            $no_of_paginations = ceil($count / $per_page);

            if ($cur_page >= 7) {
                $start_loop = $cur_page - 3;
                if ($no_of_paginations > $cur_page + 3) {
                    $end_loop = $cur_page + 3;
                } else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
                    $start_loop = $no_of_paginations - 6;
                    $end_loop   = $no_of_paginations;
                } else {
                    $end_loop = $no_of_paginations;
                }
            } else {
                $start_loop = 1;
                if ($no_of_paginations > 7) {
                    $end_loop = 7;
                } else {
                    $end_loop = $no_of_paginations;
                }

            }

            $pag_navigation .= "<ul class='pagination'>";

            if ($first_btn && $cur_page > 1) {
                $pag_navigation .= "<li p='1' class='activee'><a href='#'>".$this->lang->line('first')."</a></li>";
            } else if ($first_btn) {

                $pag_navigation .= "<li p='1' class='disabled'><a href='#'>".$this->lang->line('first')."</a></li>";
            }

            if ($previous_btn && $cur_page > 1) {
                $pre = $cur_page - 1;
                $pag_navigation .= "<li p='$pre' class='activee'><a href='#'>".$this->lang->line('previous')."</a></li>";
            } else if ($previous_btn) {

                $pag_navigation .= "<li  class='disabled'><a href='#'>".$this->lang->line('previous')."</a></li>";
            }
            for ($i = $start_loop; $i <= $end_loop; $i++) {

                if ($cur_page == $i) {

                    $pag_navigation .= "<li p='$i' class='active'><a href='#'>{$i}</a></li>";
                } else {

                    $pag_navigation .= "<li p='$i'  class='activee'><a href='#'>{$i}</a></li>";
                }

            }

            if ($next_btn && $cur_page < $no_of_paginations) {
                $nex = $cur_page + 1;

                $pag_navigation .= "<li p='$nex' class='activee'><a href='#'>".$this->lang->line('next')."</a></li>";
            } else if ($next_btn) {
                $pag_navigation .= "<li class='disabled'><a href='#'>".$this->lang->line('next')."</a></li>";
            }

            if ($last_btn && $cur_page < $no_of_paginations) {
                $pag_navigation .= "<li p='$no_of_paginations'  class='activee'><a href='#'>".$this->lang->line('last')."</a></li>";
            } else if ($last_btn) {
                $pag_navigation .= "<li p='$no_of_paginations' class='disabled'><a href='#'>".$this->lang->line('last')."</a></li>";
            }

            $pag_navigation = $pag_navigation . "</ul>";
        }

        $response = array(
            'content'    => $pag_content,
            'navigation' => $pag_navigation,
        );

        echo json_encode($response);

       
    }

    public function add()
    {

        $this->form_validation->set_rules('exam', $this->lang->line('exam'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('attempt', $this->lang->line('attempt'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('exam_from', $this->lang->line('exam')." ".$this->lang->line('from'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('exam_to', $this->lang->line('exam')." ".$this->lang->line('to'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('duration', $this->lang->line('duration'), 'trim|required|xss_clean');

        $this->form_validation->set_rules('description', $this->lang->line('description'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('passing_percentage', $this->lang->line('percentage'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {

            $msg = array(
                'exam'               => form_error('exam'),
                'attempt'            => form_error('attempt'),
                'exam_from'          => form_error('exam_from'),
                'duration'           => form_error('duration'),

                'exam_to'            => form_error('exam_to'),
                'description'        => form_error('description'),
                'passing_percentage' => form_error('passing_percentage'),
            );

            $array = array('status' => 0, 'error' => $msg, 'message' => '');
        } else {
            $is_active      = 0;
            $publish_result = 0;
            if (isset($_POST['is_active'])) {
                $is_active = 1;
            }
            if (isset($_POST['publish_result'])) {
                $publish_result = 1;
            }
            $insert_data = array(
                'exam'               => $this->input->post('exam'),
                'attempt'            => $this->input->post('attempt'),
                'exam_from'          => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('exam_from'))),
                'exam_to'            => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('exam_to'))),
                'duration'           => $this->input->post('duration'),

                'description'        => $this->input->post('description'),
                'session_id'         => $this->setting_model->getCurrentSession(),
                'is_active'          => $is_active,
                'publish_result'     => $publish_result,
                'passing_percentage' => $this->input->post('passing_percentage'),
            );
            $id = $this->input->post('recordid');
            if ($id != 0) {
                $insert_data['id'] = $id;
            }

            $this->onlineexam_model->add($insert_data);

            $array = array('status' => 1, 'error' => '', 'message' => $this->lang->line('success_message'));
        }

        echo json_encode($array);
    }

    public function getRecord($id)
    {

        $result            = $this->onlineexam_model->get_result($id);
        $result['options'] = $this->onlineexam_model->get_option($id);
        $result['ans']     = $this->onlineexam_model->get_answer($id);
        echo json_encode($result);
    }

    public function delete($id)
    {

        $this->onlineexam_model->remove($id);
        redirect('admin/onlineexam', 'refresh');
    }

    public function questionAdd()
    {

        $this->form_validation->set_rules('question_id', $this->lang->line('exam'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('onlineexam_id', $this->lang->line('attempt'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {

            $msg = array(
                'question_id'   => form_error('question_id'),
                'onlineexam_id' => form_error('onlineexam_id'),

            );

            $array = array('status' => 0, 'error' => $msg, 'message' => '');
        } else {
            $insert_data = array(
                'question_id'   => $this->input->post('question_id'),
                'onlineexam_id' => $this->input->post('onlineexam_id'),
            );
            $this->onlineexam_model->insertExamQuestion($insert_data);
            $array = array('status' => 1, 'error' => '', 'message' => $this->lang->line('success_message'));
        }

        echo json_encode($array);
    }

    public function report()
    {

        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/online_examinations');
        $this->session->set_userdata('subsub_menu', 'Reports/online_examinations/online_exam_report');

        $examList         = $this->onlineexam_model->get();
        $data['examList'] = $examList;
        $class             = $this->class_model->get();
        $data['classlist'] = $class;
        $this->form_validation->set_rules('exam_id', $this->lang->line('exam'), 'trim|required|xss_clean');
         $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {

            $this->load->view('layout/header', $data);
            $this->load->view('admin/onlineexam/report', $data);
            $this->load->view('layout/footer', $data);
            
        } else {

            if ($this->input->server('REQUEST_METHOD') == "POST") {

                $exam_id    = $this->input->post('exam_id');
                $class_id   = $this->input->post('class_id');
                $section_id = $this->input->post('section_id');
                $results    = $this->onlineexamresult_model->getStudentByExam($exam_id, $class_id, $section_id);
                $data['results'] = $results;
                

            }

            $this->load->view('layout/header', $data);
            $this->load->view('admin/onlineexam/report', $data);
            $this->load->view('layout/footer', $data);
        }
    }

    public function getstudentresult()
    {
        $onlineexam_student_id = $this->input->post('recordid');
        $examid = $this->input->post('examid');
        $exam         = $this->onlineexam_model->get($examid);
        $data['exam'] = $exam;
        $data['question_result'] = $this->onlineexamresult_model->getResultByStudent($onlineexam_student_id,$examid);
      
          $query='';
         $question_result = $this->load->view('admin/onlineexam/_getstudentresult', $data, true);
        
        echo json_encode(array('status' => 1, 'result' => $question_result,'query'=>$query));
    }



}
