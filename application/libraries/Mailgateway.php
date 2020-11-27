<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Mailgateway
{

    private $_CI;

    public function __construct()
    {
        $this->_CI = &get_instance();
        $this->_CI->load->model('setting_model');
        $this->_CI->load->model('studentfeemaster_model');
        $this->_CI->load->model('student_model');
        $this->_CI->load->model('teacher_model');
        $this->_CI->load->model('librarian_model');
        $this->_CI->load->model('accountant_model');
        $this->_CI->load->library('mailer');
        $this->_CI->mailer;
        $this->sch_setting = $this->_CI->setting_model->get();
    }

    public function sentMail($sender_details, $template, $subject)
    {
        $msg = $this->getContent($sender_details, $template);

        $send_to = $sender_details->guardian_email;
        if (!empty($this->_CI->mail_config) && $send_to != "") {

            $this->_CI->mailer->send_mail($send_to, $subject, $msg);
        }
    }

    public function sentRegisterMail($id, $send_to, $template)
    {

        if (!empty($this->_CI->mail_config) && $send_to != "") {
            $subject = "Admission Confirm";

            $msg = $this->getStudentRegistrationContent($id, $template);

            $this->_CI->mailer->send_mail($send_to, $subject, $msg);
        }
    }

    public function sendLoginCredential($chk_mail_sms, $sender_details, $template)
    {
        $msg     = $this->getLoginCredentialContent($sender_details['credential_for'], $sender_details, $template);
        $send_to = $sender_details['email'];
        if (!empty($this->_CI->mail_config) && $send_to != "") {
            $subject = "Login Credential";
            $this->_CI->mailer->send_mail($send_to, $subject, $msg);
        }
    }

    public function sentAddFeeMail($detail, $template)
    {
        $send_to = $detail->email;
        $msg     = $this->getAddFeeContent($detail, $template);
        if (!empty($this->_CI->mail_config) && $send_to != "") {
            $subject = "Fees Received";

            $this->_CI->mailer->send_mail($send_to, $subject, $msg);
        }
    }

    public function sentExamResultMail($detail, $template)
    {

        $msg     = $this->getStudentResultContent($detail, $template);     
        $send_to = $detail['guardian_email'];
        if (!empty($this->_CI->mail_config) && $send_to != "") {
            $subject = "Exam Result";           
            $this->_CI->mailer->send_mail($send_to, $subject, $msg);

        }
    }

    public function sentHomeworkStudentMail($detail, $template)
    {

        if (!empty($this->_CI->mail_config)) {
            foreach ($detail as $student_key => $student_value) {
                $send_to =$student_key;
                if ($send_to != "") {
                    $msg     = $this->getHomeworkStudentContent($detail[$student_key], $template);
                    $subject = "HomeWork Notice";                    
                    $this->_CI->mailer->send_mail($send_to, $subject, $msg);
                }

            }
        }  

    }

    public function sentAbsentStudentMail($detail, $template)
    {

        $send_to = $detail['email'];
        $msg     = $this->getAbsentStudentContent($detail, $template);
      
        if (!empty($this->_CI->mail_config) && $send_to != "") {
            $subject = "Absent Notice";
            $this->_CI->mailer->send_mail($send_to, $subject, $msg);
        }
    }

    public function getAddFeeContent($data, $template)
    {
        $currency_symbol      = $this->sch_setting[0]['currency_symbol'];
        $school_name          = $this->sch_setting[0]['name'];
        $invoice_data         = json_decode($data->invoice);
        $data->invoice_id     = $invoice_data->invoice_id;
        $data->sub_invoice_id = $invoice_data->sub_invoice_id;
        $fee                  = $this->_CI->studentfeemaster_model->getFeeByInvoice($data->invoice_id, $data->sub_invoice_id);
        $a                    = json_decode($fee->amount_detail);
        $record               = $a->{$data->sub_invoice_id};
        $fee_amount           = number_format((($record->amount + $record->amount_fine)), 2, '.', ',');
        $data->firstname      = $fee->firstname;
        $data->lastname       = $fee->lastname;
        $data->class          = $fee->class;
        $data->section        = $fee->section;
        $data->fee_amount     = $currency_symbol . $fee_amount;

        foreach ($data as $key => $value) {
            $template = str_replace('{{' . $key . '}}', $value, $template);
        }

        return $template;
    }

    public function getHomeworkStudentContent($student_detail, $template)
    {

        foreach ($student_detail as $key => $value) {
            $template = str_replace('{{' . $key . '}}', $value, $template);
        }
        return $template;

    }

    public function getAbsentStudentContent($student_detail, $template)
    {

        $session_name = $this->_CI->setting_model->getCurrentSessionName();

        $student_detail['current_session_name'] = $session_name;

        foreach ($student_detail as $key => $value) {
            $template = str_replace('{{' . $key . '}}', $value, $template);
        }

        return $template;

    }

    public function getStudentRegistrationContent($id, $template)
    {

        $session_name                    = $this->_CI->setting_model->getCurrentSessionName();
        $student                         = $this->_CI->student_model->get($id);
        $student['current_session_name'] = $session_name;

        foreach ($student as $key => $value) {
            $template = str_replace('{{' . $key . '}}', $value, $template);
        }

        return $template;
    }

    public function getLoginCredentialContent($credential_for, $sender_details, $template)
    {

        if ($credential_for == "student") {
            $student                        = $this->_CI->student_model->get($sender_details['id']);
            $sender_details['url']          = site_url('site/userlogin');
            $sender_details['display_name'] = $student['firstname'] . " " . $student['lastname'];
        } elseif ($credential_for == "parent") {
            $parent                         = $this->_CI->student_model->get($sender_details['id']);
            $sender_details['url']          = site_url('site/userlogin');
            $sender_details['display_name'] = $parent['guardian_name'];

        } elseif ($credential_for == "staff") {
            $staff                          = $this->_CI->staff_model->get($sender_details['id']);
            $sender_details['url']          = site_url('site/login');
            $sender_details['display_name'] = $staff['name'];
        }

        foreach ($sender_details as $key => $value) {
            $template = str_replace('{{' . $key . '}}', $value, $template);
        }

        return $template;
    }

    public function getStudentResultContent($student_result_detail, $template)
    {
       
        foreach ($student_result_detail as $key => $value) {
            $template = str_replace('{{' . $key . '}}', $value, $template);
        }
        return $template;

    }

    public function getContent($sender_details, $template)
    {

        foreach ($sender_details as $key => $value) {
            $template = str_replace('{{' . $key . '}}', $value, $template);
        }

        return $template;
    }

}
