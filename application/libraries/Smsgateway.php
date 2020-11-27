<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Smsgateway
{

    private $_CI;
    private $sch_setting;

    public function __construct()
    {
        $this->_CI = &get_instance();
        $this->_CI->load->model('setting_model');
        $this->_CI->load->model('student_model');
        $this->_CI->load->model('teacher_model');
        $this->_CI->load->model('studentfeemaster_model');
        $this->_CI->load->model('librarian_model');
        $this->_CI->load->model('accountant_model');
        $this->_CI->load->model('smsconfig_model');
        $this->sch_setting = $this->_CI->setting_model->get();
    }

    public function sentNotification($send_to, $template = '', $detail)
    {
        $this->_CI->load->library('pushnotification');
        $msg        = $this->getContent($detail, $template);
        $push_array = array(
            'title' => 'Fee Reminder',
            'body'  => $this->_CI->customlib->getLimitChar($msg));
        if ($send_to != "") {
            $this->_CI->pushnotification->send($send_to, $push_array, "mail_sms");
        }

    }

    public function sendSMS($send_to, $template = '', $detail)
    {
        $sms_detail = $this->_CI->smsconfig_model->getActiveSMS();
        if ($template != "") {
            $msg = $this->getContent($detail, $template);

        } else {
            $msg = $detail;
        }

        if (!empty($sms_detail)) {
            if ($sms_detail->type == 'clickatell') {

                $params = array(
                    'apiToken' => $sms_detail->api_id,
                );
                $this->_CI->load->library('clickatell', $params);
                try {
                    $result = $this->_CI->clickatell->sendMessage(['to' => [$send_to], 'content' => $msg]);
                    foreach ($result['messages'] as $message) {

                    }
                    return true;
                } catch (Exception $e) {
                    return true;
                }
            } else if ($sms_detail->type == 'twilio') {

                $params = array(
                    'mode'        => 'sandbox',
                    'account_sid' => $sms_detail->api_id,
                    'auth_token'  => $sms_detail->password,
                    'api_version' => '2010-04-01',
                    'number'      => $sms_detail->contact,
                );

                $this->_CI->load->library('twilio', $params);

                $from     = $sms_detail->contact;
                $to       = $send_to;
                $message  = $msg;
                $response = $this->_CI->twilio->sms($from, $to, $message);
                if ($response->IsError) {
                    return true;
                } else {
                    return true;
                }

            } else if ($sms_detail->type == 'msg_nineone') {
                $params = array(
                    'authkey'  => $sms_detail->authkey,
                    'senderid' => $sms_detail->senderid,
                );
                $this->_CI->load->library('msgnineone', $params);
                $this->_CI->msgnineone->sendSMS($send_to, $msg);
            } else if ($sms_detail->type == 'smscountry') {
                $params = array(
                    'username'  => $sms_detail->username,
                    'sernderid' => $sms_detail->senderid,
                    'password'  => $sms_detail->password,
                );
                $this->_CI->load->library('smscountry', $params);
                $this->_CI->smscountry->sendSMS($send_to, $msg);
            } else if ($sms_detail->type == 'text_local') {
                $to     = $send_to;
                $params = array(
                    'username' => $sms_detail->username,
                    'hash'     => $sms_detail->password,
                );
                $this->_CI->load->library('textlocalsms', $params);
                $this->_CI->textlocalsms->sendSms(array($to), $msg, $sms_detail->senderid);
            } else if ($sms_detail->type == 'custom') {
                $this->_CI->load->library('customsms');
                $from    = $sms_detail->contact;
                $to      = $send_to;
                $message = $msg;
                $this->_CI->customsms->sendSMS($to, $message);
            } else {

            }
        }
        return true;
    }

    public function sentRegisterSMS($id, $send_to, $template)
    {
        $sms_detail = $this->_CI->smsconfig_model->getActiveSMS();
        $msg        = $this->getStudentRegistrationContent($id, $template);
        if (!empty($sms_detail)) {
            if ($sms_detail->type == 'clickatell') {

                $params = array(
                    'apiToken' => $sms_detail->api_id,
                );
                $this->_CI->load->library('clickatell', $params);
                try {
                    $result = $this->_CI->clickatell->sendMessage(['to' => [$send_to], 'content' => $msg]);
                    foreach ($result['messages'] as $message) {

                    }
                    return true;
                } catch (Exception $e) {
                    return true;
                }
            } else if ($sms_detail->type == 'twilio') {

                $params = array(
                    'mode'        => 'sandbox',
                    'account_sid' => $sms_detail->api_id,
                    'auth_token'  => $sms_detail->password,
                    'api_version' => '2010-04-01',
                    'number'      => $sms_detail->contact,
                );

                $this->_CI->load->library('twilio', $params);

                $from     = $sms_detail->contact;
                $to       = $send_to;
                $message  = $msg;
                $response = $this->_CI->twilio->sms($from, $to, $message);

                if ($response->IsError) {
                    return true;
                } else {
                    return true;
                }

            } else if ($sms_detail->type == 'msg_nineone') {
                $params = array(
                    'authkey'  => $sms_detail->authkey,
                    'senderid' => $sms_detail->senderid,
                );
                $this->_CI->load->library('msgnineone', $params);
                $this->_CI->msgnineone->sendSMS($send_to, $msg);
            } else if ($sms_detail->type == 'smscountry') {
                $params = array(
                    'username'  => $sms_detail->username,
                    'sernderid' => $sms_detail->senderid,
                    'password'  => $sms_detail->password,
                );
                $this->_CI->load->library('smscountry', $params);
                $this->_CI->smscountry->sendSMS($send_to, $msg);
            } else if ($sms_detail->type == 'text_local') {
                $to     = $send_to;
                $params = array(
                    'username' => $sms_detail->username,
                    'hash'     => $sms_detail->password,
                );
                $this->_CI->load->library('textlocalsms', $params);
                $this->_CI->textlocalsms->sendSms(array($to), $msg, $sms_detail->senderid);
            } else if ($sms_detail->type == 'custom') {
                $this->_CI->load->library('customsms');
                $from    = $sms_detail->contact;
                $to      = $send_to;
                $message = $msg;
                $this->_CI->customsms->sendSMS($to, $message);
            } else {

            }
        }
        return true;
    }

    public function sentAddFeeSMS($detail, $template)
    {

        // $msg = $this->getAddFeeContent($detail, $template);

        $sms_detail = $this->_CI->smsconfig_model->getActiveSMS();
        $send_to    = $detail->contact_no;
        $msg        = $this->getAddFeeContent($detail, $template);

        if (!empty($sms_detail)) {
            if ($sms_detail->type == 'clickatell') {
                $params = array(
                    'apiToken' => $sms_detail->api_id,
                );
                $this->_CI->load->library('clickatell', $params);
                try {
                    $result = $this->_CI->clickatell->sendMessage(['to' => [$send_to], 'content' => $msg]);
                    foreach ($result['messages'] as $message) {

                    }
                    return true;
                } catch (Exception $e) {
                    return false;
                }
            } else if ($sms_detail->type == 'twilio') {

                $params = array(
                    'mode'        => 'sandbox',
                    'account_sid' => $sms_detail->api_id,
                    'auth_token'  => $sms_detail->password,
                    'api_version' => '2010-04-01',
                    'number'      => $sms_detail->contact,
                );

                $this->_CI->load->library('twilio', $params);

                $from     = $sms_detail->contact;
                $to       = $send_to;
                $message  = $msg;
                $response = $this->_CI->twilio->sms($from, $to, $message);

                if ($response->IsError) {
                    return false;
                } else {
                    return true;
                }

            } else if ($sms_detail->type == 'msg_nineone') {
                $params = array(
                    'authkey'  => $sms_detail->authkey,
                    'senderid' => $sms_detail->senderid,
                );
                $this->_CI->load->library('msgnineone', $params);
                $this->_CI->msgnineone->sendSMS($send_to, $msg);
            } else if ($sms_detail->type == 'smscountry') {
                $params = array(
                    'username'  => $sms_detail->username,
                    'sernderid' => $sms_detail->senderid,
                    'password'  => $sms_detail->password,
                );
                $this->_CI->load->library('smscountry', $params);
                $this->_CI->smscountry->sendSMS($send_to, $msg);
            } else if ($sms_detail->type == 'text_local') {
                $params = array(
                    'username' => $sms_detail->username,
                    'hash'     => $sms_detail->password,
                );
                $this->_CI->load->library('textlocalsms', $params);
                $this->_CI->textlocalsms->sendSms(array($send_to), $msg, $sms_detail->senderid);
            } else if ($sms_detail->type == 'custom') {
                $this->_CI->load->library('customsms');
                $from    = $sms_detail->contact;
                $to      = $send_to;
                $message = $msg;
                $this->_CI->customsms->sendSMS($to, $message);
            } else {

            }
        }
    }

    public function sentAbsentStudentSMS($detail, $template)
    {
        $sms_detail = $this->_CI->smsconfig_model->getActiveSMS();

        if (!empty($sms_detail)) {

            $send_to = $detail['guardian_phone'];
            $msg     = $this->getAbsentStudentContent($detail, $template);

            if ($sms_detail->type == 'clickatell') {
                $params = array(
                    'apiToken' => $sms_detail->api_id,
                );
                $this->_CI->load->library('clickatell', $params);

                try {
                    $result = $this->_CI->clickatell->sendMessage(['to' => [$send_to], 'content' => $msg]);
                    foreach ($result['messages'] as $message) {

                    }
                    return true;
                } catch (Exception $e) {
                    return false;
                }
            } else if ($sms_detail->type == 'twilio') {

                $params = array(
                    'mode'        => 'sandbox',
                    'account_sid' => $sms_detail->api_id,
                    'auth_token'  => $sms_detail->password,
                    'api_version' => '2010-04-01',
                    'number'      => $sms_detail->contact,
                );

                $this->_CI->load->library('twilio', $params);

                $from     = $sms_detail->contact;
                $to       = $send_to;
                $message  = $msg;
                $response = $this->_CI->twilio->sms($from, $to, $message);

                if ($response->IsError) {
                    return false;
                } else {
                    return true;
                }

            } else if ($sms_detail->type == 'msg_nineone') {
                $params = array(
                    'authkey'  => $sms_detail->authkey,
                    'senderid' => $sms_detail->senderid,
                );
                $this->_CI->load->library('msgnineone', $params);
                $this->_CI->msgnineone->sendSMS($send_to, $msg);
            } else if ($sms_detail->type == 'smscountry') {
                $params = array(
                    'username'  => $sms_detail->username,
                    'sernderid' => $sms_detail->senderid,
                    'password'  => $sms_detail->password,
                );
                $this->_CI->load->library('smscountry', $params);
                $this->_CI->smscountry->sendSMS($send_to, $msg);
            } else if ($sms_detail->type == 'text_local') {
                $params = array(
                    'username' => $sms_detail->username,
                    'hash'     => $sms_detail->password,
                );
                $this->_CI->load->library('textlocalsms', $params);
                $this->_CI->textlocalsms->sendSms(array($send_to), $msg, $sms_detail->senderid);
            } else if ($sms_detail->type == 'custom') {
                $this->_CI->load->library('customsms');
                $from    = $sms_detail->contact;
                $to      = $send_to;
                $message = $msg;
                $this->_CI->customsms->sendSMS($to, $message);
            } else {

            }
        }
    }

    public function sentAbsentStudentNotification($detail, $template)
    {

        $msg        = $this->getAbsentStudentContent($detail, $template);
        $push_array = array(
            'title' => 'Absent Student',
            'body'  => $this->_CI->customlib->getLimitChar($msg));
        if ($detail['parent_app_key'] != "") {
            $this->_CI->pushnotification->send($detail['parent_app_key'], $push_array, "mail_sms");
        }

    }

    public function sentExamResultNotification($detail, $template)
    {

        $msg        = $this->getStudentResultContent($detail, $template);
        $push_array = array(
            'title' => 'Exam Result',
            'body'  => $this->_CI->customlib->getLimitChar($msg));
        if ($detail['parent_app_key'] != "") {
            $this->_CI->pushnotification->send($detail['parent_app_key'], $push_array, "mail_sms");
        }

    }

    public function sentExamResultSMS($detail, $template)
    {

        $sms_detail = $this->_CI->smsconfig_model->getActiveSMS();
        $msg        = $this->getStudentResultContent($detail, $template);

        $send_to = $detail['guardian_phone'];

        if (!empty($sms_detail)) {
            if ($sms_detail->type == 'clickatell') {

                $params = array(
                    'apiToken' => $sms_detail->api_id,
                );
                $this->_CI->load->library('clickatell', $params);
                try {
                    $result = $this->_CI->clickatell->sendMessage(['to' => [$send_to], 'content' => $msg]);
                    foreach ($result['messages'] as $message) {

                    }
                    return true;
                } catch (Exception $e) {
                    return true;
                }
            } else if ($sms_detail->type == 'twilio') {

                $params = array(
                    'mode'        => 'sandbox',
                    'account_sid' => $sms_detail->api_id,
                    'auth_token'  => $sms_detail->password,
                    'api_version' => '2010-04-01',
                    'number'      => $sms_detail->contact,
                );

                $this->_CI->load->library('twilio', $params);

                $from     = $sms_detail->contact;
                $to       = $send_to;
                $message  = $msg;
                $response = $this->_CI->twilio->sms($from, $to, $message);

                if ($response->IsError) {
                    return true;
                } else {
                    return true;
                }

            } else if ($sms_detail->type == 'msg_nineone') {
                $params = array(
                    'authkey'  => $sms_detail->authkey,
                    'senderid' => $sms_detail->senderid,
                );
                $this->_CI->load->library('msgnineone', $params);
                $this->_CI->msgnineone->sendSMS($send_to, $msg);
            } else if ($sms_detail->type == 'smscountry') {
                $params = array(
                    'username'  => $sms_detail->username,
                    'sernderid' => $sms_detail->senderid,
                    'password'  => $sms_detail->password,
                );
                $this->_CI->load->library('smscountry', $params);
                $this->_CI->smscountry->sendSMS($send_to, $msg);
            } else if ($sms_detail->type == 'text_local') {
                $to     = $send_to;
                $params = array(
                    'username' => $sms_detail->username,
                    'hash'     => $sms_detail->password,
                );
                $this->_CI->load->library('textlocalsms', $params);
                $this->_CI->textlocalsms->sendSms(array($to), $msg, $sms_detail->senderid);
            } else if ($sms_detail->type == 'custom') {
                $this->_CI->load->library('customsms');
                $from    = $sms_detail->contact;
                $to      = $send_to;
                $message = $msg;
                $this->_CI->customsms->sendSMS($to, $message);
            } else {

            }
        }
        return true;
    }

    public function sendLoginCredential($chk_mail_sms, $sender_details, $template)
    {
        $sms_detail = $this->_CI->smsconfig_model->getActiveSMS();
        $msg        = $this->getLoginCredentialContent($sender_details['credential_for'], $sender_details, $template);

        $send_to = $sender_details['contact_no'];
        if (!empty($sms_detail)) {
            if ($sms_detail->type == 'clickatell') {

                $params = array(
                    'apiToken' => $sms_detail->api_id,
                );
                $this->_CI->load->library('clickatell', $params);
                try {
                    $result = $this->_CI->clickatell->sendMessage(['to' => [$send_to], 'content' => $msg]);
                    foreach ($result['messages'] as $message) {

                    }
                    return true;
                } catch (Exception $e) {
                    return true;
                }
            } else if ($sms_detail->type == 'twilio') {

                $params = array(
                    'mode'        => 'sandbox',
                    'account_sid' => $sms_detail->api_id,
                    'auth_token'  => $sms_detail->password,
                    'api_version' => '2010-04-01',
                    'number'      => $sms_detail->contact,
                );

                $this->_CI->load->library('twilio', $params);

                $from     = $sms_detail->contact;
                $to       = $send_to;
                $message  = $msg;
                $response = $this->_CI->twilio->sms($from, $to, $message);

                if ($response->IsError) {
                    return true;
                } else {
                    return true;
                }

            } else if ($sms_detail->type == 'msg_nineone') {
                $params = array(
                    'authkey'  => $sms_detail->authkey,
                    'senderid' => $sms_detail->senderid,
                );
                $this->_CI->load->library('msgnineone', $params);
                $this->_CI->msgnineone->sendSMS($send_to, $msg);
            } else if ($sms_detail->type == 'smscountry') {
                $params = array(
                    'username'  => $sms_detail->username,
                    'sernderid' => $sms_detail->senderid,
                    'password'  => $sms_detail->password,
                );
                $this->_CI->load->library('smscountry', $params);
                $this->_CI->smscountry->sendSMS($send_to, $msg);
            } else if ($sms_detail->type == 'text_local') {
                $params = array(
                    'username' => $sms_detail->username,
                    'hash'     => $sms_detail->password,
                );
                $this->_CI->load->library('textlocalsms', $params);
                $this->_CI->textlocalsms->sendSms(array($to), $msg, $sms_detail->senderid);
            } else if ($sms_detail->type == 'custom') {
                $this->_CI->load->library('customsms');
                $from    = $sms_detail->contact;
                $to      = $send_to;
                $message = $msg;
                $this->_CI->customsms->sendSMS($to, $message);
            } else {

            }
        }
        return true;
    }

    public function sentHomeworkStudentNotification($detail, $template)
    {
        foreach ($detail as $student_key => $student_value) {
            $msg        = $this->getHomeworkStudentContent($detail[$student_key], $template);
            $push_array = array(
                'title' => 'HomeWork',
                'body'  => $this->_CI->customlib->getLimitChar($msg));
            if ($student_value['app_key'] != "") {
                $this->_CI->pushnotification->send($student_value['app_key'], $push_array, "mail_sms");
            }
        }

    }

    public function sentAddFeeNotification($detail, $template)
    {
        $msg        = $this->getAddFeeContent($detail, $template);
        $push_array = array(
            'title' => 'Fees Notification',
            'body'  => $this->_CI->customlib->getLimitChar($msg));
        if ($detail->parent_app_key != "") {
            $this->_CI->pushnotification->send($detail->parent_app_key, $push_array, "mail_sms");
        }

    }
    public function sentHomeworkStudentSMS($detail, $template)
    {
        $sms_detail = $this->_CI->smsconfig_model->getActiveSMS();
        if (!empty($sms_detail)) {

            foreach ($detail as $student_key => $student_value) {
                $send_to = $student_key;
                if ($send_to != "") {
                    $msg     = $this->getHomeworkStudentContent($detail[$student_key], $template);
                    $subject = "HomeWork Notice";
//=====

                    if ($sms_detail->type == 'clickatell') {
                        $params = array(
                            'apiToken' => $sms_detail->api_id,
                        );
                        $this->_CI->load->library('clickatell', $params);

                        try {
                            $result = $this->_CI->clickatell->sendMessage(['to' => [$send_to], 'content' => $msg]);
                            foreach ($result['messages'] as $message) {

                            }
                            return true;
                        } catch (Exception $e) {
                            return false;
                        }
                    } else if ($sms_detail->type == 'twilio') {

                        $params = array(
                            'mode'        => 'sandbox',
                            'account_sid' => $sms_detail->api_id,
                            'auth_token'  => $sms_detail->password,
                            'api_version' => '2010-04-01',
                            'number'      => $sms_detail->contact,
                        );

                        $this->_CI->load->library('twilio', $params);

                        $from     = $sms_detail->contact;
                        $to       = $send_to;
                        $message  = $msg;
                        $response = $this->_CI->twilio->sms($from, $to, $message);

                        if ($response->IsError) {
                            return false;
                        } else {
                            return true;
                        }

                    } else if ($sms_detail->type == 'msg_nineone') {

                        $params = array(
                            'authkey'  => $sms_detail->authkey,
                            'senderid' => $sms_detail->senderid,
                        );
                        $this->_CI->load->library('msgnineone', $params);
                        $this->_CI->msgnineone->sendSMS($send_to, $msg);
                    } else if ($sms_detail->type == 'smscountry') {
                        $params = array(
                            'username'  => $sms_detail->username,
                            'sernderid' => $sms_detail->senderid,
                            'password'  => $sms_detail->password,
                        );
                        $this->_CI->load->library('smscountry', $params);
                        $this->_CI->smscountry->sendSMS($send_to, $msg);
                    } else if ($sms_detail->type == 'text_local') {
                        $params = array(
                            'username' => $sms_detail->username,
                            'hash'     => $sms_detail->password,
                        );
                        $this->_CI->load->library('textlocalsms', $params);
                        $this->_CI->textlocalsms->sendSms(array($send_to), $msg, $sms_detail->senderid);
                    } else if ($sms_detail->type == 'custom') {
                        $this->_CI->load->library('customsms');
                        $from    = $sms_detail->contact;
                        $to      = $send_to;
                        $message = $msg;
                        $this->_CI->customsms->sendSMS($to, $message);
                    } else {

                    }
                }
            }
        }
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

    public function getAddFeeContent($data, $template)
    {
        // $currency_symbol = $this->sch_setting[0]['currency_symbol'];
        // $school_name = $this->sch_setting[0]['name'];

        // $fee = $this->_CI->studentfeemaster_model->getFeeByInvoice($invoice_id, $sub_invoice_id);
        // $a = json_decode($fee->amount_detail);
        // $record = $a->{$sub_invoice_id};
        // $fee_amount = number_format((($record->amount + $record->amount_fine) - $record->amount_discount), 2, '.', ',');
        // $msg = "Fees received for " . $fee->firstname . " " . $fee->lastname . ". Fees Amount " . $currency_symbol . $fee_amount . "/- Received by " . $school_name;

        // return $msg;
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

    public function getAbsentStudentContent($student_detail, $template)
    {

        $session_name                           = $this->_CI->setting_model->getCurrentSessionName();
        $student_detail['current_session_name'] = $session_name;
        foreach ($student_detail as $key => $value) {
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

    public function getHomeworkStudentContent($student_detail, $template)
    {

        foreach ($student_detail as $key => $value) {
            $template = str_replace('{{' . $key . '}}', $value, $template);
        }
        return $template;

    }

}
