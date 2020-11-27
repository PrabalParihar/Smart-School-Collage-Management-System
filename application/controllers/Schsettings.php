<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Schsettings extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('upload');
    }

    public function index_old()
    {
        if (!$this->rbac->hasPrivilege('general_setting', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'System Settings');
        $this->session->set_userdata('sub_menu', 'schsettings/index');
        $data['title']         = 'Setting List';
        $setting_result        = $this->setting_model->get();
        $data['settinglist']   = $setting_result;
        $timezoneList          = $this->customlib->timezone_list();
        $currencyPlace         = $this->customlib->getCurrencyPlace();
        $data['title']         = 'School Setting';
        $session_result        = $this->session_model->get();
        $language_result       = $this->language_model->get();
        $data['sessionlist']   = $session_result;
        $month_list            = $this->customlib->getMonthList();
        $data['languagelist']  = $language_result;
        $data['timezoneList']  = $timezoneList;
        $data['currencyPlace'] = $currencyPlace;
        $data['monthList']     = $month_list;
        $dateFormat            = $this->customlib->getDateFormat();
        $currency              = $this->customlib->getCurrency();
        $digit                 = $this->customlib->getDigits();

        $data['dateFormatList'] = $dateFormat;
        $data['currencyList']   = $currency;
        $data['digitList']      = $digit;

        $this->load->view('layout/header', $data);
        $this->load->view('setting/settingList_old', $data);
        $this->load->view('layout/footer', $data);
    }
    public function index()
    {
        if (!$this->rbac->hasPrivilege('general_setting', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'System Settings');
        $this->session->set_userdata('sub_menu', 'schsettings/index');
        $data['title']          = 'Setting List';
        $setting_result         = $this->setting_model->get();
        $data['settinglist']    = $setting_result;
        $timezoneList           = $this->customlib->timezone_list();
        $data['title']          = 'School Setting';
        $session_result         = $this->session_model->get();
        $language_result        = $this->language_model->get();
        $data['sessionlist']    = $session_result;
        $month_list             = $this->customlib->getMonthList();
        $data['languagelist']   = $language_result;
        $data['timezoneList']   = $timezoneList;
        $data['monthList']      = $month_list;
        $dateFormat             = $this->customlib->getDateFormat();
        $currency               = $this->customlib->getCurrency();
        $data['dateFormatList'] = $dateFormat;
        $data['currencyList']   = $currency;
        $digit                  = $this->customlib->getDigits();
        $data['digitList']      = $digit;
        $currencyPlace          = $this->customlib->getCurrencyPlace();
        $data['currencyPlace']  = $currencyPlace;
        $data['result']         = $this->setting_model->getSetting();
        $this->load->view('layout/header', $data);
        $this->load->view('setting/settingList', $data);
        $this->load->view('layout/footer', $data);
    }

    public function ajax_editlogo()
    {
        $this->form_validation->set_rules('id', $this->lang->line('id'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('file', $this->lang->line('image'), 'callback_handle_upload');
        if ($this->form_validation->run() == false) {
            $data = array(
                'file' => form_error('file'),
            );
            $array = array('success' => false, 'error' => $data);
            echo json_encode($array);
        } else {
            $id = $this->input->post('id');

            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = $id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/school_content/logo/" . $img_name);
            }
            $data_record = array('id' => $id, 'image' => $img_name);
            $this->setting_model->add($data_record);
            $array = array('success' => true, 'error' => '', 'message' => $this->lang->line('success_message'));
            echo json_encode($array);
        }
    }
    
 public function ajax_editadmin_smalllogo()
    {

        $this->form_validation->set_rules('id', $this->lang->line('id'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('file', $this->lang->line('image'), 'callback_handle_upload');
        if ($this->form_validation->run() == false) {
            $data = array(
                'file' => form_error('file'),
            );
            $array = array('success' => false, 'error' => $data);
            echo json_encode($array);
        } else {
            $id = $this->input->post('id');

            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = $id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/school_content/admin_small_logo/" . $img_name);
            }
            $data_record = array('id' => $id, 'admin_small_logo' => $img_name);
            $this->setting_model->add($data_record);
            $array = array('success' => true, 'error' => '', 'message' => $this->lang->line('success_message'));
            echo json_encode($array);
        }
    }

    public function ajax_editadmin_adminlogo(){

        $this->form_validation->set_rules('id', $this->lang->line('id'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('file', $this->lang->line('image'), 'callback_handle_upload');
        if ($this->form_validation->run() == false) {
            $data = array(
                'file' => form_error('file'),
            );
            $array = array('success' => false, 'error' => $data);
            echo json_encode($array);
        } else {
            $id = $this->input->post('id');

            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = $id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/school_content/admin_logo/" . $img_name);
            }
            $data_record = array('id' => $id, 'admin_logo' => $img_name);
            $this->setting_model->add($data_record);
            $array = array('success' => true, 'error' => '', 'message' => $this->lang->line('success_message'));
            echo json_encode($array);
        } 
    }
    public function editLogo($id)
    {
        $data['title']       = 'School Logo';
        $setting_result      = $this->setting_model->get();
        $data['settinglist'] = $setting_result;
        $data['id']          = $id;
        $this->form_validation->set_rules('file', $this->lang->line('image'), 'callback_handle_upload');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('setting/editLogo', $data);
            $this->load->view('layout/footer', $data);
        } else {
            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = $id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/school_content/logo/" . $img_name);
            }
            $data_record = array('id' => $id, 'image' => $img_name);
            $this->setting_model->add($data_record);
            $this->session->set_flashdata('msg', '<div class="alert alert-left">' . $this->lang->line('update_message') . '</div>');
            redirect('schsettings/index');
        }
    }

    public function handle_upload()
    {
        if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
            $allowedExts = array('jpg', 'jpeg', 'png');
            $temp        = explode(".", $_FILES["file"]["name"]);
            $extension   = end($temp);
            if ($_FILES["file"]["error"] > 0) {
                $error .= "Error opening the file<br />";
            }
            if ($_FILES["file"]["type"] != 'image/gif' &&
                $_FILES["file"]["type"] != 'image/jpeg' &&
                $_FILES["file"]["type"] != 'image/png') {
                $this->form_validation->set_message('handle_upload', $this->lang->line('file_type_not_allowed'));
                return false;
            }
            if (!in_array($extension, $allowedExts)) {
                $this->form_validation->set_message('handle_upload', $this->lang->line('extension_not_allowed'));
                return false;
            }
            if ($_FILES["file"]["size"] > 102400) {
                $this->form_validation->set_message('handle_upload', $this->lang->line('file_size_shoud_be_less_than'));
                return false;
            }
            return true;
        } else {
            $this->form_validation->set_message('handle_upload', $this->lang->line('logo_file_is_required'));
            return false;
        }
    }

    public function view($id)
    {
        $data['title']   = 'Setting List';
        $setting         = $this->setting_model->get($id);
        $data['setting'] = $setting;
        $this->load->view('layout/header', $data);
        $this->load->view('setting/settingShow', $data);
        $this->load->view('layout/footer', $data);
    }

    public function getSchsetting()
    {

        $data = $this->setting_model->getSetting();
        echo json_encode($data);
    }

    public function ajax_schedit()
    {

        if (!$this->rbac->hasPrivilege('general_setting', 'can_edit')) {
            access_denied();
        }
        $auto_staff_id = false;
        $this->form_validation->set_rules('sch_session_id', $this->lang->line('session'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('fee_due_days', $this->lang->line('fees_due_days'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('sch_name', $this->lang->line('school_name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('sch_phone', $this->lang->line('phone'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('sch_start_month', $this->lang->line('start_month'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('sch_address', $this->lang->line('address'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('sch_email', $this->lang->line('email'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('sch_lang_id', $this->lang->line('language'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('sch_currency_symbol', $this->lang->line('currency_symbol'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('sch_timezone', $this->lang->line('timezone'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('sch_currency', $this->lang->line('currency'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('currency_place', $this->lang->line('currency_place'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('sch_date_format', $this->lang->line('date_format'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('sch_is_rtl', $this->lang->line('rtl'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('theme', $this->lang->line('theme'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('attendence_type', $this->lang->line('attendance')." ".$this->lang->line('type'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('online_admission', $this->lang->line('online') . " " . $this->lang->line('admission'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('is_duplicate_fees_invoice', $this->lang->line('duplicate')." ".$this->lang->line('fees')." ".$this->lang->line('invoice'), 'trim|required|xss_clean');

        

        if ($this->input->post('adm_auto_insert')) {
            $this->form_validation->set_rules('adm_prefix', $this->lang->line('admission_no_prefix'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('adm_start_from', $this->lang->line('admission_start_from'), 'trim|integer|required|xss_clean');
            $this->form_validation->set_rules('adm_no_digit', $this->lang->line('admission_no_digit'), 'trim|integer|required|xss_clean|callback_check_admission_digit');
        }
        if ($this->input->post('staffid_auto_insert')) {

            $this->form_validation->set_rules('staffid_prefix', $this->lang->line('staff_id_prefix'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('staffid_start_from', $this->lang->line('staff_id_start_from'), 'trim|integer|required|xss_clean');
            $this->form_validation->set_rules('staffid_no_digit', $this->lang->line('staff_id_digit'), 'trim|integer|required|xss_clean|callback_check_staff_id_digit');
        }

        if ($this->form_validation->run() == false) {
            $data = array(
                'is_student_house'          => form_error('is_student_house'),
             
                'sch_session_id'            => form_error('sch_session_id'),
                'sch_name'                  => form_error('sch_name'),
                'sch_phone'                 => form_error('sch_phone'),
                'sch_start_month'           => form_error('sch_start_month'),
                'sch_address'               => form_error('sch_address'),
                'sch_email'                 => form_error('sch_email'),
                'sch_lang_id'               => form_error('sch_lang_id'),
                'sch_currency_symbol'       => form_error('sch_currency_symbol'),
                'sch_timezone'              => form_error('sch_timezone'),
                'sch_currency'              => form_error('sch_currency'),
                'currency_place'            => form_error('currency_place'),
                'sch_date_format'           => form_error('sch_date_format'),
                'sch_is_rtl'                => form_error('sch_is_rtl'),
                'theme'                     => form_error('theme'),
                'adm_start_from'            => form_error('adm_start_from'),
                'biometric_device'          => form_error('biometric_device'),
                'biometric'                 => form_error('biometric'),
                'adm_prefix'                => form_error('adm_prefix'),
                'adm_no_digit'              => form_error('adm_no_digit'),
                'staffid_start_from'        => form_error('staffid_start_from'),
                'staffid_prefix'            => form_error('staffid_prefix'),
                'staffid_no_digit'          => form_error('staffid_no_digit'),
                'online_admission'          => form_error('online_admission'),
                'is_duplicate_fees_invoice' => form_error('is_duplicate_fees_invoice'),
                'attendence_type'           => form_error('attendence_type'),
                'fee_due_days'              => form_error('fee_due_days'),
            );
            $array = array('status' => 'fail', 'error' => $data);
            echo json_encode($array);
        } else {
            $setting_result = $this->setting_model->getSetting();
 
            $data = array(
                'id'                        => $this->input->post('sch_id'),
                'attendence_type'           => $this->input->post('attendence_type'),
                'session_id'                => $this->input->post('sch_session_id'),
                'name'                      => $this->input->post('sch_name'),
                'phone'                     => $this->input->post('sch_phone'),
                'dise_code'                 => $this->input->post('sch_dise_code'),
                'start_month'               => $this->input->post('sch_start_month'),
                'address'                   => $this->input->post('sch_address'),
                'email'                     => $this->input->post('sch_email'),
                'lang_id'                   => $this->input->post('sch_lang_id'),
                'timezone'                  => $this->input->post('sch_timezone'),
                'date_format'               => $this->input->post('sch_date_format'),
                'is_rtl'                    => $this->input->post('sch_is_rtl'),
                'currency'                  => $this->input->post('sch_currency'),
                'currency_symbol'           => $this->input->post('sch_currency_symbol'),
                'currency_place'            => $this->input->post('currency_place'),
                'fee_due_days'              => $this->input->post('fee_due_days'),
                'theme'                     => $this->input->post('theme'),
                'adm_start_from'            => $this->input->post('adm_start_from'),
                'adm_prefix'                => $this->input->post('adm_prefix'),
                'adm_no_digit'              => $this->input->post('adm_no_digit'),
                'adm_auto_insert'           => $this->input->post('adm_auto_insert'),
                'staffid_start_from'        => $this->input->post('staffid_start_from'),
                'staffid_prefix'            => $this->input->post('staffid_prefix'),
                'staffid_no_digit'          => $this->input->post('staffid_no_digit'),
                'online_admission'          => $this->input->post('online_admission'),
                'staffid_auto_insert'       => $this->input->post('staffid_auto_insert'),
                'class_teacher'             => $this->input->post('class_teacher'),
               
                'biometric_device'            => $this->input->post('biometric_device'),
                'biometric'            => $this->input->post('biometric'),
                'is_duplicate_fees_invoice' => $this->input->post('is_duplicate_fees_invoice'),
                 'app_primary_color_code'    => $this->input->post('app_primary_color_code'),
                'app_secondary_color_code'  => $this->input->post('app_secondary_color_code'),
                'mobile_api_url'            => $this->input->post('mobile_api_url')
            );
            $session_result=$this->session_model->get($this->input->post('sch_session_id'));
          // echo "<pre>"; print_r($session_result); echo "<pre>";die;
            $session=array(
                'session_id' => $session_result['id'],
                'session' => $session_result['session'],
            );
            $this->session->set_userdata('session_array',$session);
          
            $data['adm_update_status']     = 1;
            $data['staffid_update_status'] = 1;
            if ($this->input->post('adm_auto_insert')) {
                if ($setting_result->adm_prefix != $this->input->post('adm_prefix') ||
                    $setting_result->adm_start_from != $this->input->post('adm_start_from') ||
                    $setting_result->adm_no_digit != $this->input->post('adm_no_digit')
                ) {
                    $data['adm_update_status'] = 0;
                }
            }

            if ($this->input->post('staffid_auto_insert')) {
                if ($setting_result->staffid_prefix != $this->input->post('staffid_prefix') ||
                    $setting_result->staffid_start_from != $this->input->post('staffid_start_from') ||
                    $setting_result->staffid_no_digit != $this->input->post('staffid_no_digit')
                ) {
                    $data['staffid_update_status'] = 0;
                }
            }

            $data['adm_update_status'];

            $this->setting_model->add($data);
            $this->load->helper('lang');
            $this->session->userdata['admin']['date_format']     = $this->input->post('sch_date_format');
            $this->session->userdata['admin']['currency_symbol'] = $this->input->post('sch_currency_symbol');
            $this->session->userdata['admin']['is_rtl']          = $this->input->post('sch_is_rtl');
            $this->session->userdata['admin']['timezone']        = $this->input->post('sch_timezone');
            $this->session->userdata['admin']['theme']           = $this->input->post('theme');
            $this->session->userdata['admin']['currency_place']  = $this->input->post('currency_place');
            set_language($this->input->post('sch_lang_id'));
            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
            echo json_encode($array);
        }
    }


  function ajax_applogo() {
        $this->form_validation->set_rules('id', 'ID', 'trim|required|xss_clean');
        $this->form_validation->set_rules('file', 'Image', 'callback_handle_upload');
    
        if ($this->form_validation->run() == false) {
            $data = array(
                'file' => form_error('file')
            );
            $array = array('success' => false, 'error' => $data);
            echo json_encode($array);
        } else {

            $id = $this->input->post('id');
         
             if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = $id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/school_content/logo/app_logo/" . $img_name);
            }
                
            $data_record = array('id' => $id, 'app_logo' => $img_name);
          
            $this->setting_model->add($data_record);
            $array = array('success' => true, 'error' => '', 'message' => 'Record Updated Successfully');
            echo json_encode($array);
        }
    }

    public function check_admission_digit()
    {
        $adm_start_from = $this->input->post('adm_start_from');
        $adm_no_digit   = $this->input->post('adm_no_digit');
        if ($adm_no_digit != "") {

            if (strlen($adm_start_from) == $adm_no_digit) {

                return true;
            }
            $this->form_validation->set_message('check_admission_digit', 'Admission no must be ' . $adm_no_digit . ' digit long');
            return false;
        }
        return true;
    }

    public function check_staff_id_digit()
    {
        $adm_start_from   = $this->input->post('staffid_start_from');
        $staffid_no_digit = $this->input->post('staffid_no_digit');
        if ($staffid_no_digit != "") {

            if (strlen($adm_start_from) == $staffid_no_digit) {

                return true;
            }
            $this->form_validation->set_message('check_staff_id_digit', $this->lang->line('staff_id_start_from_must_be') . ' ' . strlen($adm_start_from) . ' ' . $this->lang->line('digit_long'));
            return false;
        }
        return true;
    }

}
