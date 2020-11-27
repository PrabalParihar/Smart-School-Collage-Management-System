<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Mailsmsconf
{

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->config->load("mailsms");
        $this->CI->load->library('smsgateway');
        $this->CI->load->library('mailgateway');
        $this->CI->load->model('examresult_model');
        $this->CI->load->model('student_model');
        $this->config_mailsms = $this->CI->config->item('mailsms');
    }

    public function mailsms($send_for, $sender_details, $date = null, $exam_schedule_array = null)
    {

        $send_for = $this->config_mailsms[$send_for];
//=========
        $chk_mail_sms = $this->CI->customlib->sendMailSMS($send_for);

        if (!empty($chk_mail_sms)) {
            if ($send_for == "student_admission") {
                if ($chk_mail_sms['mail'] && $chk_mail_sms['template'] != "") {
                    $this->CI->mailgateway->sentRegisterMail($sender_details['student_id'], $sender_details['email'], $chk_mail_sms['template']);
                }
                if ($chk_mail_sms['sms'] && $chk_mail_sms['template'] != "") {
                    $this->CI->smsgateway->sentRegisterSMS($sender_details['student_id'], $sender_details['contact_no'], $chk_mail_sms['template']);
                }
            } elseif ($send_for == "exam_result") {

                $this->sendResult($chk_mail_sms, $sender_details, $chk_mail_sms['template']);

            } elseif ($send_for == "login_credential") {

                if ($chk_mail_sms['mail'] && $chk_mail_sms['template'] != "") {

                    $this->CI->mailgateway->sendLoginCredential($chk_mail_sms, $sender_details, $chk_mail_sms['template']);

                }
                if ($chk_mail_sms['sms'] && $chk_mail_sms['template'] != "") {
                    $this->CI->smsgateway->sendLoginCredential($chk_mail_sms, $sender_details, $chk_mail_sms['template']);
                }
            } elseif ($send_for == "fee_submission") {
                // $invoice = json_decode($sender_details->invoice);

                
                if ($chk_mail_sms['mail'] && $chk_mail_sms['template'] != "") {
                    $this->CI->mailgateway->sentAddFeeMail($sender_details, $chk_mail_sms['template']);

                }

                if ($chk_mail_sms['sms'] && $chk_mail_sms['template'] != "") {
                   
                    $this->CI->smsgateway->sentAddFeeSMS($sender_details, $chk_mail_sms['template']);
                }

                if ($chk_mail_sms['notification'] && $chk_mail_sms['template'] != "") {
                    $this->CI->smsgateway->sentAddFeeNotification($sender_details, $chk_mail_sms['template']);
                }
            } elseif ($send_for == "absent_attendence") {

                $this->sendAbsentAttendance($chk_mail_sms, $sender_details, $date, $chk_mail_sms['template'], $exam_schedule_array);
            } elseif ($send_for == "fees_reminder") {

                if ($chk_mail_sms['mail'] && $chk_mail_sms['template'] != "") {
                    $this->CI->mailgateway->sentMail($sender_details, $chk_mail_sms['template'], 'Fees Reminder');

                }

                if ($chk_mail_sms['sms'] && $chk_mail_sms['template'] != "") {
                    $this->CI->smsgateway->sendSMS($sender_details->guardian_phone, $chk_mail_sms['template'], $sender_details);
                }

                if ($chk_mail_sms['notification'] && $chk_mail_sms['template'] != "") {
                    $this->CI->smsgateway->sentNotification($sender_details->parent_app_key, $chk_mail_sms['template'], $sender_details);
                }

            } elseif ($send_for == "homework") {


                $this->sendHomework($chk_mail_sms, $sender_details, $chk_mail_sms['template']);
            } else {

            }
        }

        //===============
    }

    public function sendResult($chk_mail_sms, $exam_result, $template)
    {
        if ($chk_mail_sms['mail'] or $chk_mail_sms['sms'] or $chk_mail_sms['notification']) {

            if (!empty($exam_result['exam_result'])) {
                foreach ($exam_result['exam_result'] as $res_key => $res_value) {
                    $detail = array(
                        'student_name'   => $res_value->firstname . "" . $res_value->lastname,
                        'exam_roll_no'   => $res_value->exam_roll_no,
                        'exam'           => $exam_result['exam']->exam,
                        'guardian_phone' => $res_value->guardian_phone,
                        'guardian_email' => $res_value->guardian_email,
                        'parent_app_key' => $res_value->parent_app_key,
                    );

                    if ($chk_mail_sms['mail'] && $detail['guardian_email'] != "") {

                        $this->CI->mailgateway->sentExamResultMail($detail, $template);
                    }
                    if ($chk_mail_sms['sms'] && $detail['guardian_phone'] != "") {
                        $this->CI->smsgateway->sentExamResultSMS($detail, $template);
                    }
                     if ($chk_mail_sms['notification'] && $detail['parent_app_key'] != "") {
                        $this->CI->smsgateway->sentExamResultNotification($detail, $template);
                    }

                }

            }

        }
    }

    public function sendAbsentAttendance($chk_mail_sms, $student_session_array, $date, $template, $subject_attendence)
    {

        if ($chk_mail_sms['mail'] or $chk_mail_sms['sms'] or $chk_mail_sms['notification']) {
            $student_result = $this->getAbsentStudentlist($student_session_array);
            if (!empty($student_result)) {

                foreach ($student_result as $student_result_k => $student_result_v) {
                    $detail = array(
                        'date'                => $date,
                        'parent_app_key'           => $student_result_v->parent_app_key,
                        'firstname'           => $student_result_v->firstname,
                        'lastname'            => $student_result_v->lastname,
                        'mobileno'            => $student_result_v->mobileno,
                        'email'               => $student_result_v->email,
                        'father_name'         => $student_result_v->father_name,
                        'father_phone'        => $student_result_v->father_phone,
                        'father_occupation'   => $student_result_v->father_occupation,
                        'mother_name'         => $student_result_v->mother_name,
                        'mother_phone'        => $student_result_v->mother_phone,
                        'guardian_name'       => $student_result_v->guardian_name,
                        'guardian_phone'      => $student_result_v->guardian_phone,
                        'guardian_occupation' => $student_result_v->guardian_occupation,
                        'guardian_email'      => $student_result_v->guardian_email,
                    );
                    if (isset($subject_attendence) && !empty($subject_attendence)) {
                        $detail['time_from']    = $subject_attendence->time_from;
                        $detail['time_to']      = $subject_attendence->time_to;
                        $detail['subject_name'] = $subject_attendence->name;
                        $detail['subject_code'] = $subject_attendence->code;
                        $detail['subject_type'] = $subject_attendence->type;
                    }
 
                    if ($chk_mail_sms['mail']) {
                        $this->CI->mailgateway->sentAbsentStudentMail($detail, $template);

                    }
                    if ($chk_mail_sms['sms']) {

                        $this->CI->smsgateway->sentAbsentStudentSMS($detail, $template);
                    }
                    if ($chk_mail_sms['notification']) {

                        $this->CI->smsgateway->sentAbsentStudentNotification($detail, $template);
                    }
                }
            }
        }
    }

    public function getAbsentStudentlist($student_session_array)
    {

        $result = $this->CI->student_model->getStudentListBYStudentsessionID($student_session_array);
        if (!empty($result)) {
            return $result;
        }
        return false;
    }

    public function sendHomework($chk_mail_sms, $student_details, $template)
    {
        $student_sms_list          = array();
        $student_email_list        = array();
        $student_notification_list = array();
        if ($chk_mail_sms['mail'] or $chk_mail_sms['sms'] or $chk_mail_sms['notification']) {
            $class_id      = ($student_details['class_id']);
            $section_id    = ($student_details['section_id']);
            $homework_date = $student_details['homework_date'];
            $submit_date   = $student_details['submit_date'];
            $subject       = $student_details['subject'];
            $student_list  = $this->CI->student_model->getStudentByClassSectionID($class_id, $section_id);

            if (!empty($student_list)) {
                foreach ($student_list as $student_key => $student_value) {

                    if ($student_value['app_key'] != "") {
                        $student_notification_list[] = array(
                            'app_key'         => $student_value['app_key'],
                            'class'         => $student_value['class'],
                            'section'       => $student_value['section'],
                            'homework_date' => $homework_date,
                            'submit_date'   => $submit_date,
                            'subject'       => $subject,
                            'admission_no'  => $student_value['admission_no'],
                            'student_name'  => $student_value['firstname'] . " " . $student_value['lastname'],
                        );

                    }

                    if ($student_value['email'] != "") {
                        $student_email_list[$student_value['email']] = array(
                            'class'         => $student_value['class'],
                            'section'       => $student_value['section'],
                            'homework_date' => $homework_date,
                            'submit_date'   => $submit_date,
                            'subject'       => $subject,
                            'admission_no'  => $student_value['admission_no'],
                            'student_name'  => $student_value['firstname'] . " " . $student_value['lastname'],
                        );

                    }
                    if ($student_value['guardian_email'] != "") {
                        $student_email_list[$student_value['guardian_email']] = array(
                            'class'         => $student_value['class'],
                            'section'       => $student_value['section'],
                            'homework_date' => $homework_date,
                            'submit_date'   => $submit_date,
                            'subject'       => $subject,
                            'admission_no'  => $student_value['admission_no'],
                            'student_name'  => $student_value['firstname'] . " " . $student_value['lastname'],
                        );

                    }
                    if ($student_value['mobileno'] != "") {
                        $student_sms_list[$student_value['mobileno']] = array(
                            'class'         => $student_value['class'],
                            'section'       => $student_value['section'],
                            'homework_date' => $homework_date,
                            'submit_date'   => $submit_date,
                            'subject'       => $subject,
                            'admission_no'  => $student_value['admission_no'],
                            'student_name'  => $student_value['firstname'] . " " . $student_value['lastname'],
                        );

                    }
                    if ($student_value['guardian_phone'] != "") {
                        $student_sms_list[$student_value['guardian_phone']] = array(
                            'class'         => $student_value['class'],
                            'section'       => $student_value['section'],
                            'homework_date' => $homework_date,
                            'submit_date'   => $submit_date,
                            'subject'       => $subject,
                            'admission_no'  => $student_value['admission_no'],
                            'student_name'  => $student_value['firstname'] . " " . $student_value['lastname'],
                        );
                    }

                }

                if ($student_email_list) {
                    $this->CI->mailgateway->sentHomeworkStudentMail($student_email_list, $template);

                }

                if ($student_sms_list) {
                    $this->CI->smsgateway->sentHomeworkStudentSMS($student_sms_list, $template);
                }

                 if (!empty($student_notification_list)) {
                    $this->CI->smsgateway->sentHomeworkStudentNotification($student_notification_list, $template);
                }

            }

        }
    }

}
