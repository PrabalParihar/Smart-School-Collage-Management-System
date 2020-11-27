<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Onlineexam extends Student_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = array();
        $this->session->set_userdata('top_menu', 'Onlineexam');
        
        $student_current_class = $this->customlib->getStudentCurrentClsSection();
        $student_session_id = $student_current_class->student_session_id;

        $onlineexam = $this->onlineexam_model->getStudentexam($student_session_id);
        $data['onlineexam'] = $onlineexam;
        $this->load->view('layout/student/header');
        $this->load->view('user/onlineexam/onlineexamlist', $data);
        $this->load->view('layout/student/footer');
    }

    public function view($id) {
        $data = array();
        $this->session->set_userdata('top_menu', 'Onlineexam');

        $student_current_class = $this->customlib->getStudentCurrentClsSection();
        $student_session_id = $student_current_class->student_session_id;
        $online_exam_validate = $this->onlineexam_model->examstudentsID($student_session_id, $id);

        $exam         = $this->onlineexam_model->get($id);
        $data['exam'] = $exam;

      
        if (!empty($online_exam_validate)) {

             $data['question_result'] = $this->onlineexamresult_model->getResultByStudent($online_exam_validate->id,$online_exam_validate->onlineexam_id);
               $data['result_prepare'] = $this->onlineexamresult_model->checkResultPrepare($online_exam_validate->id);


        }
          $data['online_exam_validate'] = $online_exam_validate;

        // $onlineexam = $this->onlineexam_model->get($id, 'publish');
        // $data['exam'] = $onlineexam;
        // $data['online_exam_validate'] = $online_exam_validate;

        $this->load->view('layout/student/header');
        $this->load->view('user/onlineexam/view', $data);
        $this->load->view('layout/student/footer');
    }
    // public function view($id) {
    //     $data = array();
    //     $this->session->set_userdata('top_menu', 'Onlineexam');

    //     $student_current_class = $this->customlib->getStudentCurrentClsSection();
    //     $student_session_id = $student_current_class->student_session_id;
    //     $online_exam_validate = $this->onlineexam_model->examstudentsID($student_session_id, $id);
    // //     print_r($online_exam_validate);

    // // $aaa = $this->onlineexamresult_model->onlineexamrank(25,12);
    // // print_r($aaa);

    // //     exit();
    //     $data['question_result'] = array();
    //     $data['result_prepare'] = array();
    //     if (!empty($online_exam_validate)) {

    //         $data['question_result'] = $this->onlineexamresult_model->getResultByStudent($online_exam_validate->id, $id);
    //         $data['result_prepare'] = $this->onlineexamresult_model->checkResultPrepare($online_exam_validate->id);
    //     }




    //     $onlineexam = $this->onlineexam_model->get($id, 'publish');
    //     $data['exam'] = $onlineexam;
    //     $data['online_exam_validate'] = $online_exam_validate;

    //     $this->load->view('layout/student/header');
    //     $this->load->view('user/onlineexam/view', $data);
    //     $this->load->view('layout/student/footer');
    // }

    public function save() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $total_rows = $this->input->post('total_rows');
            if (!empty($total_rows)) {
                $save_result = array();
                foreach ($total_rows as $row_key => $row_value) {

                    if (isset($_POST['radio' . $row_value])) {
                        $save_result[] = array(
                            'onlineexam_student_id' => $this->input->post('onlineexam_student_id'),
                            'onlineexam_question_id' => $this->input->post('question_id_' . $row_value),
                            'select_option' => $_POST['radio' . $row_value],
                        );
                    }
                }
                $this->onlineexamresult_model->add($save_result);
                redirect('user/onlineexam', 'refresh');
            }
        } else {
            
        }
    }

    public function startexam____($id) {
        $data = array();
        $this->session->set_userdata('top_menu', 'Hostel');
        $this->session->set_userdata('sub_menu', 'hostel/index');
        $questionOpt = $this->customlib->getQuesOption();
        $data['questionOpt'] = $questionOpt;
        $onlineexam_question = $this->onlineexam_model->getExamQuestions($id);
        $data['examquestion'] = $onlineexam_question;
        $this->load->view('layout/student/header');
        $this->load->view('user/onlineexam/startexam', $data);
        $this->load->view('layout/student/footer');
    }

    public function getExamForm() {
        $data = array();
        $question_status = 0;
        $recordid = $this->input->post('recordid');
        $exam = $this->onlineexam_model->get($recordid);

        $data['questions'] = $this->onlineexam_model->getExamQuestions($recordid);
        $student_current_class = $this->customlib->getStudentCurrentClsSection();
        $student_session_id = $student_current_class->student_session_id;
        $onlineexam_student = $this->onlineexam_model->examstudentsID($student_session_id, $exam->id);
        $data['onlineexam_student_id'] = $onlineexam_student;
        $getStudentAttemts = $this->onlineexam_model->getStudentAttemts($onlineexam_student->id);

        $data['question_status'] = 0;

        if (strtotime(date('Y-m-d H:i:s')) >= strtotime(date($exam->exam_to . ' 23:59:59'))) {

            $question_status = 1;
            $data['question_status'] = 1;
        } else if ($exam->attempt > $getStudentAttemts) {
            $this->onlineexam_model->addStudentAttemts(array('onlineexam_student_id' => $onlineexam_student->id));
        } else {
            $question_status = 1;
            $data['question_status'] = 1;
        }

        $questionOpt = $this->customlib->getQuesOption();
        $data['questionOpt'] = $questionOpt;
        $pag_content = $this->load->view('user/onlineexam/_searchQuestionByExamID', $data, true);
        echo json_encode(array('status' => 0, 'exam' => $exam, 'page' => $pag_content, 'question_status' => $question_status));
    }

}
