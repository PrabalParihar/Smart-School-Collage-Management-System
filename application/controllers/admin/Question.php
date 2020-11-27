<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Question extends Admin_Controller
{



    public function read($id)
    {

       if (!$this->rbac->hasPrivilege('question_bank', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu','Online_Examinations');
        $this->session->set_userdata('sub_menu','Online_Examinations/question');
        $question         = $this->question_model->get($id);
        $data['question'] = $question;
      $questionOpt          = $this->customlib->getQuesOption();
        $data['questionOpt']  = $questionOpt;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/question/read', $data);
        $this->load->view('layout/footer', $data);
    }
    public function index()
    {

       if (!$this->rbac->hasPrivilege('question_bank', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu','Online_Examinations');
        $this->session->set_userdata('sub_menu','Online_Examinations/question');
        $questionList         = $this->question_model->get();
        $data['questionList'] = $questionList;
        $subject_result       = $this->subject_model->get();
        $data['subjectlist']  = $subject_result;
        $questionOpt          = $this->customlib->getQuesOption();
        $data['questionOpt']  = $questionOpt;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/question/question', $data);
        $this->load->view('layout/footer', $data);
    }

    public function getQuestionByID()
    {
        $id = $this->input->post('recordid');

        $question_result = $this->question_model->get($id);

        echo json_encode(array('status' => 1, 'result' => $question_result));
    }

    public function add()
    {
       
  if (!$this->rbac->hasPrivilege('question_bank', 'can_add')) {
            access_denied();
        }
        $this->form_validation->set_rules('subject_id', $this->lang->line('subject'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('question', $this->lang->line('question'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('opt_a', $this->lang->line('option_A'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('opt_b', $this->lang->line('option_B'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('opt_c', $this->lang->line('option_C'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('opt_d', $this->lang->line('option_D'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('correct', $this->lang->line('answer'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {

            $msg = array(
                'subject_id' => form_error('subject_id'),
                'question'   => form_error('question'),
                'opt_a'      => form_error('opt_a'),
                'opt_b'      => form_error('opt_b'),
                'opt_c'      => form_error('opt_c'),
                'opt_d'      => form_error('opt_d'),
                'correct'    => form_error('correct'),
            );

            $array = array('status' => 0, 'error' => $msg, 'message' => '');

        } else {

            $insert_data = array(
                'subject_id' => $this->input->post('subject_id'),
                'question'   => $this->input->post('question'),
                'opt_a'      => $this->input->post('opt_a'),
                'opt_b'      => $this->input->post('opt_b'),
                'opt_c'      => $this->input->post('opt_c'),
                'opt_d'      => $this->input->post('opt_d'),
                'opt_e'      => $this->input->post('opt_e'),
                'correct'    => $this->input->post('correct'),
            );

            $id = $this->input->post('recordid');
            if ($id != 0) {
                $insert_data['id'] = $id;
            }

            $this->question_model->add($insert_data);

            $array = array('status' => 1, 'error' => '', 'message' => $this->lang->line('success_message'));

        }

        echo json_encode($array);
    }

    public function getRecord($id)
    {

        $result            = $this->question_model->get_result($id);
        $result['options'] = $this->question_model->get_option($id);
        $result['ans']     = $this->question_model->get_answer($id);
        echo json_encode($result);
        
    }

    public function delete($id)
    {
 if (!$this->rbac->hasPrivilege('question_bank', 'can_delete')) {
            access_denied();
        }
        $this->question_model->remove($id);
        redirect('admin/question', 'refresh');
    }

}
