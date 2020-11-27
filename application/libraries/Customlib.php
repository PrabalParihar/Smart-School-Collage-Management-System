<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Customlib
{

    public $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->helper('url');
        $this->CI->load->library('session');
        $this->CI->load->library('user_agent');
        $this->CI->load->model('Notification_model', '', true);
        $this->CI->load->model('Setting_model', '', true);
        $this->CI->load->model('Notificationsetting_model', '', true);
    }

    public function getCSRF()
    {
        $csrf_input = "<input type='hidden' ";
        $csrf_input .= "name='" . $this->CI->security->get_csrf_token_name() . "'";
        $csrf_input .= " value='" . $this->CI->security->get_csrf_hash() . "'/>";

        return $csrf_input;
    }

    public function contentAvailabelFor()
    {
        $content_for              = array();
        $role_array               = $this->getStaffRole();
        $role                     = json_decode($role_array);
        $content_for[$role->name] = $this->CI->lang->line('All') . " " . $role->name;
        $content_for['student']   = $this->CI->lang->line('student');
        return $content_for;
    }

    public function getCalltype()
    {
        $call_type             = array();
        $call_type['Incoming'] = $this->CI->lang->line('incoming');
        $call_type['Outgoing'] = $this->CI->lang->line('outgoing');
        return $call_type;
    }

    public function getQuesOption()
    {
        $quesOption          = array();
        $quesOption['opt_a'] = 'A';
        $quesOption['opt_b'] = 'B';
        $quesOption['opt_c'] = 'C';
        $quesOption['opt_d'] = 'D';
        $quesOption['opt_e'] = 'E';
        return $quesOption;
    }

    public function subjectType()
    {
        $subject_type = array();
        // $subject_type['none']      = $this->CI->lang->line('none');
        $subject_type['theory']    = $this->CI->lang->line('theory');
        $subject_type['practical'] = $this->CI->lang->line('practical');
        // $subject_type['both']      = $this->CI->lang->line('both');
        return $subject_type;
    }

    public function getGender()
    {
        $gender           = array();
        $gender['Male']   = $this->CI->lang->line('male');
        $gender['Female'] = $this->CI->lang->line('female');
        return $gender;
    }

    public function getStatus()
    {
        $status             = array();
        $status[""]         = $this->CI->lang->line('select');
        $status['enabled']  = $this->CI->lang->line('enabled');
        $status['disabled'] = $this->CI->lang->line('disabled');
        return $status;
    }

    public function getCurrencyPlace()
    {
        $status = array();

        $status['before_number'] = $this->CI->lang->line('before_number');
        $status['after_number']  = $this->CI->lang->line('after_number');
        return $status;
    }

    public function getDateFormat()
    {
        $dateFormat          = array();
        $dateFormat['d-m-Y'] = 'dd-mm-yyyy';
        $dateFormat['d-M-Y'] = 'dd-mmm-yyyy';
        $dateFormat['d/m/Y'] = 'dd/mm/yyyy';
        $dateFormat['d.m.Y'] = 'dd.mm.yyyy';
        $dateFormat['m-d-Y'] = 'mm-dd-yyyy';
        $dateFormat['m/d/Y'] = 'mm/dd/yyyy';
        $dateFormat['m.d.Y'] = 'mm.dd.yyyy';
        $dateFormat['Y/m/d'] = 'yyyy/mm/dd';
        return $dateFormat;
    }

    public function getCurrency()
    {
        $currency        = array();
        $currency['AED'] = 'AED';
        $currency['AFN'] = 'AFN';
        $currency['ALL'] = 'ALL';
        $currency['AMD'] = 'AMD';
        $currency['ANG'] = 'ANG';
        $currency['AOA'] = 'AOA';
        $currency['ARS'] = 'ARS';
        $currency['AUD'] = 'AUD';
        $currency['AWG'] = 'AWG';
        $currency['AZN'] = 'AZN';
        $currency['BAM'] = 'BAM';
        $currency['BBD'] = 'BAM';
        $currency['BDT'] = 'BDT';
        $currency['BGN'] = 'BGN';
        $currency['BHD'] = 'BHD';
        $currency['BIF'] = 'BIF';
        $currency['BMD'] = 'BMD';
        $currency['BND'] = 'BND';
        $currency['BOB'] = 'BOB';
        $currency['BOV'] = 'BOV';
        $currency['BRL'] = 'BRL';
        $currency['BSD'] = 'BSD';
        $currency['BTN'] = 'BTN';
        $currency['BWP'] = 'BWP';
        $currency['BYN'] = 'BYN';
        $currency['BYR'] = 'BYR';
        $currency['BZD'] = 'BZD';
        $currency['CAD'] = 'CAD';
        $currency['CDF'] = 'CDF';
        $currency['CHE'] = 'CHE';
        $currency['CHF'] = 'CHF';
        $currency['CHW'] = 'CHW';
        $currency['CLF'] = 'CLF';
        $currency['CLP'] = 'CLP';
        $currency['CNY'] = 'CNY';
        $currency['COP'] = 'COP';
        $currency['COU'] = 'COU';
        $currency['CRC'] = 'CRC';
        $currency['CUC'] = 'CUC';
        $currency['CUP'] = 'CUP';
        $currency['CVE'] = 'CVE';
        $currency['CZK'] = 'CZK';
        $currency['DJF'] = 'DJF';
        $currency['DKK'] = 'DKK';
        $currency['DOP'] = 'DOP';
        $currency['DZD'] = 'DZD';
        $currency['EGP'] = 'EGP';
        $currency['ERN'] = 'ERN';
        $currency['ETB'] = 'ETB';
        $currency['EUR'] = 'EUR';
        $currency['FJD'] = 'FJD';
        $currency['FKP'] = 'FKP';
        $currency['GBP'] = 'GBP';
        $currency['GEL'] = 'GEL';
        $currency['GHS'] = 'GHS';
        $currency['GIP'] = 'GIP';
        $currency['GMD'] = 'GMD';
        $currency['GNF'] = 'GNF';
        $currency['GTQ'] = 'GTQ';
        $currency['GYD'] = 'GYD';
        $currency['HKD'] = 'HKD';
        $currency['HNL'] = 'HNL';
        $currency['HRK'] = 'HRK';
        $currency['HTG'] = 'HTG';
        $currency['HUF'] = 'HUF';
        $currency['IDR'] = 'IDR';
        $currency['ILS'] = 'ILS';
        $currency['INR'] = 'INR';
        $currency['IQD'] = 'IQD';
        $currency['IRR'] = 'IRR';
        $currency['ISK'] = 'ISK';
        $currency['JMD'] = 'JMD';
        $currency['JOD'] = 'JOD';
        $currency['JPY'] = 'JPY';
        $currency['KES'] = 'KES';
        $currency['KGS'] = 'KGS';
        $currency['KHR'] = 'KHR';
        $currency['KMF'] = 'KMF';
        $currency['KPW'] = 'KPW';
        $currency['KRW'] = 'KRW';
        $currency['KWD'] = 'KWD';
        $currency['KYD'] = 'KYD';
        $currency['KZT'] = 'KZT';
        $currency['LAK'] = 'LAK';
        $currency['LBP'] = 'LBP';
        $currency['LKR'] = 'LKR';
        $currency['LRD'] = 'LRD';
        $currency['LSL'] = 'LSL';
        $currency['LYD'] = 'LYD';
        $currency['MAD'] = 'MAD';
        $currency['MDL'] = 'MDL';
        $currency['MGA'] = 'MGA';
        $currency['MKD'] = 'MKD';
        $currency['MMK'] = 'MMK';
        $currency['MNT'] = 'MNT';
        $currency['MOP'] = 'MOP';
        $currency['MRO'] = 'MRO';
        $currency['MUR'] = 'MUR';
        $currency['MVR'] = 'MVR';
        $currency['MWK'] = 'MWK';
        $currency['MXN'] = 'MXN';
        $currency['MXV'] = 'MXV';
        $currency['MYR'] = 'MYR';
        $currency['MZN'] = 'MZN';
        $currency['NAD'] = 'NAD';
        $currency['NGN'] = 'NGN';
        $currency['NIO'] = 'NIO';
        $currency['NOK'] = 'NOK';
        $currency['NPR'] = 'NPR';
        $currency['NZD'] = 'NZD';
        $currency['OMR'] = 'OMR';
        $currency['PAB'] = 'PAB';
        $currency['PEN'] = 'PEN';
        $currency['PGK'] = 'PGK';
        $currency['PHP'] = 'PHP';
        $currency['PKR'] = 'PKR';
        $currency['PLN'] = 'PLN';
        $currency['PYG'] = 'PYG';
        $currency['QAR'] = 'QAR';
        $currency['RON'] = 'RON';
        $currency['RSD'] = 'RSD';
        $currency['RUB'] = 'RUB';
        $currency['RWF'] = 'RWF';
        $currency['SAR'] = 'SAR';
        $currency['SBD'] = 'SBD';
        $currency['SCR'] = 'SCR';
        $currency['SDG'] = 'SDG';
        $currency['SEK'] = 'SEK';
        $currency['SGD'] = 'SGD';
        $currency['SHP'] = 'SHP';
        $currency['SLL'] = 'SLL';
        $currency['SOS'] = 'SOS';
        $currency['SRD'] = 'SRD';
        $currency['SSP'] = 'SSP';
        $currency['STD'] = 'STD';
        $currency['SVC'] = 'SVC';
        $currency['SYP'] = 'SYP';
        $currency['SZL'] = 'SZL';
        $currency['THB'] = 'THB';
        $currency['TJS'] = 'TJS';
        $currency['TMT'] = 'TMT';
        $currency['TND'] = 'TND';
        $currency['TOP'] = 'TOP';
        $currency['TRY'] = 'TRY';
        $currency['TTD'] = 'TTD';
        $currency['TWD'] = 'TWD';
        $currency['TZS'] = 'TZS';
        $currency['UAH'] = 'UAH';
        $currency['UGX'] = 'UGX';
        $currency['USD'] = 'USD';
        $currency['USN'] = 'USN';
        $currency['UYI'] = 'UYI';
        $currency['UYU'] = 'UYU';
        $currency['UZS'] = 'UZS';
        $currency['VEF'] = 'VEF';
        $currency['VND'] = 'VND';
        $currency['VUV'] = 'VUV';
        $currency['WST'] = 'WST';
        $currency['XAF'] = 'XAF';
        $currency['XAG'] = 'XAG';
        $currency['XAU'] = 'XAU';
        $currency['XBA'] = 'XBA';
        $currency['XBB'] = 'XBB';
        $currency['XBC'] = 'XBC';
        $currency['XBD'] = 'XBD';
        $currency['XCD'] = 'XCD';
        $currency['XDR'] = 'XDR';
        $currency['XOF'] = 'XOF';
        $currency['XPD'] = 'XPD';
        $currency['XPF'] = 'XPF';
        $currency['XPT'] = 'XPT';
        $currency['XSU'] = 'XSU';
        $currency['XTS'] = 'XTS';
        $currency['XUA'] = 'XUA';
        $currency['XXX'] = 'XXX';
        $currency['YER'] = 'YER';
        $currency['ZAR'] = 'ZAR';
        $currency['ZMW'] = 'ZMW';
        $currency['ZWL'] = 'ZWL';
        return $currency;
    }

    public function getRteStatus()
    {
        $status        = array();
        $status['Yes'] = $this->CI->lang->line('yes');
        $status['No']  = $this->CI->lang->line('no');
        return $status;
    }

    public function getHostaltype()
    {
        $status            = array();
        $status['Girls']   = $this->CI->lang->line('girls');
        $status['Boys']    = $this->CI->lang->line('boys');
        $status['Combine'] = $this->CI->lang->line('combine');
        return $status;
    }

    public function getDaysname()
    {
        $status              = array();
        $status['Monday']    = $this->CI->lang->line('monday');
        $status['Tuesday']   = $this->CI->lang->line('tuesday');
        $status['Wednesday'] = $this->CI->lang->line('wednesday');
        $status['Thursday']  = $this->CI->lang->line('thursday');
        $status['Friday']    = $this->CI->lang->line('friday');
        $status['Saturday']  = $this->CI->lang->line('saturday');
        $status['Sunday']    = $this->CI->lang->line('sunday');
        return $status;
    }

    public function getcontenttype()
    {
        $status                   = array();
        $status['Assignments']    = $this->CI->lang->line('assignments');
        $status['Study_material'] = $this->CI->lang->line('study_material');
        $status['Syllabus']       = $this->CI->lang->line('syllabus');
        $status['Other_download'] = $this->CI->lang->line('other_download');
        return $status;
    }

    public function getPageContentCategory()
    {
        $category             = array();
        $category['standard'] = $this->CI->lang->line('standard');
        $category['events']   = $this->CI->lang->line('events');
        $category['notice']   = $this->CI->lang->line('notice');
        $category['gallery']  = $this->CI->lang->line('gallery');
        return $category;
    }

    public function getSchoolDateFormat($date_only = true, $time = false)
    {

        $setting_result = $this->CI->setting_model->get();

        $time_format = $setting_result[0]['time_format'];

        $hi_format = ' h:i A';
        $Hi_format = ' H:i';

        $admin = $this->CI->session->userdata('admin');
        if ($admin) {
            if ($date_only && !$time) {

                return $admin['date_format'];
            } elseif ($time_format == "24-hour") {

                return $admin['date_format'] . $Hi_format;
            } elseif ($time_format == "12-hour") {

                return $admin['date_format'] . $hi_format;
            }
        } else if ($this->CI->session->userdata('student')) {

            $student = $this->CI->session->userdata('student');
            if ($date_only && !$time) {

                return $student['date_format'];
            } elseif ($time_format == "24-hour") {

                return $student['date_format'] . $Hi_format;
            } elseif ($time_format == "12-hour") {

                return $student['date_format'] . $hi_format;
            }
        }
    }

    public function getTimeZone()
    {
        $admin = $this->CI->session->userdata('admin');
        if ($admin) {
            return $admin['timezone'];
        } else if ($this->CI->session->userdata('student')) {
            $student = $this->CI->session->userdata('student');
            return $student['timezone'];
        }
    }

    public function getSchoolCurrencyFormat()
    {
        $admin = $this->CI->session->userdata('admin');
        if ($admin) {
            return $admin['currency_symbol'];
        } else if ($this->CI->session->userdata('student')) {
            $student = $this->CI->session->userdata('student');
            return $student['currency_symbol'];
        }
    }

    public function getSchoolCurrencyWithPlace($amount = 0)
    {
        $admin = $this->CI->session->userdata('admin');

        $currency_symbol = "";
        if ($admin) {

            $currency_symbol = $admin['currency_symbol'];
            $currency_place  = $admin['currency_place'];
        } else if ($this->CI->session->userdata('student')) {
            $student         = $this->CI->session->userdata('student');
            $currency_symbol = $student['currency_symbol'];
            $currency_place  = $student['currency_place'];
        }
        if ($currency_place == "before_number") {
            $amount = $currency_symbol . $amount;
        } else {
            $amount = $amount . $currency_symbol;
        }
        return $amount;
    }

    public function getLoggedInUserData()
    {
        $admin = $this->CI->session->userdata('admin');
        if ($admin) {
            return $admin;
        } else if ($this->CI->session->userdata('student')) {
            $student = $this->CI->session->userdata('student');
            return $student;
        }
    }

    public function getCurrentTheme()
    {

        $theme = "default";
        $admin = $this->CI->session->userdata('admin');

        if ($admin) {
            if (isset($admin['theme']) && $admin['theme'] != "") {
                $ext   = pathinfo($admin['theme'], PATHINFO_EXTENSION);
                $theme = basename($admin['theme'], "." . $ext);
            }
        } else if ($this->CI->session->userdata('student')) {
            $student = $this->CI->session->userdata('student');

            if (isset($student['theme']) && $student['theme'] != "") {
                $ext   = pathinfo($student['theme'], PATHINFO_EXTENSION);
                $theme = basename($student['theme'], "." . $ext);
            }
        }
        return $theme;
    }

    public function getRTL()
    {
        $rtl   = "";
        $admin = $this->CI->session->userdata('admin');
        if ($admin) {
            if ($admin['is_rtl'] == "disabled") {
                $rtl = "";
            } else {
                $rtl = "dir='rtl' lang='ar'";
            }
        } else if ($this->CI->session->userdata('student')) {
            $student = $this->CI->session->userdata('student');

            if ($student['is_rtl'] == "disabled") {
                $rtl = "";
            } else {
                $rtl = "dir='rtl' lang='ar'";
            }
        }
        return $rtl;
    }

    public function getStudentSessionUserID()
    {
        $student_session = $this->CI->session->all_userdata();
        $session_Array   = $this->CI->session->userdata('student');
        $studentID       = $session_Array['student_id'];
        return $studentID;
    }

    public function getStudentCurrentClsSection()
    {
        $student_session = $this->CI->session->all_userdata();
        $session_Array   = $this->CI->session->userdata('current_class');
        return (object) $session_Array;
    }

    public function getParentSessionUserID()
    {
        $student_session = $this->CI->session->all_userdata();
        $session_Array   = $this->CI->session->userdata('student');
        $Parentid        = $session_Array['student_id'];
        return $Parentid;
    }

    public function getTeacherSessionUserID()
    {
        $student_session = $this->CI->session->all_userdata();
        $session_Array   = $this->CI->session->userdata('student');
        $teacher_id      = $session_Array['teacher_id'];
        return $teacher_id;
    }

    public function getUsersID()
    {
        // users table id of users
        $session_Array = $this->CI->session->userdata('student');
        $user_id       = $session_Array['id'];
        return $user_id;
    }

    public function getStaffID()
    {
        // users table id of users
        $session_Array = $this->CI->session->userdata('admin');
        $staff_id      = $session_Array['id'];
        return $staff_id;
    }

    public function getSessionLanguage()
    {
        $student_session = $this->CI->session->userdata('admin');
        $language        = $student_session['language'];
        $lang_id         = $language['lang_id'];
        return $lang_id;
    }

    public function checkPaypalDisplay()
    {
        $payment_setting = $this->CI->paymentsetting_model->get();
        return $payment_setting;
    }

    public function getStudentunreadNotification()
    {
        $student_id    = $this->CI->customlib->getStudentSessionUserID();
        $notifications = $this->CI->notification_model->countUnreadNotificationStudent($student_id);
        if ($notifications > 0) {
            return $notifications;
        } else {
            return false;
        }
    }

    public function getParentunreadNotification()
    {
        $parent=$this->CI->session->userdata; $parent_id=$parent['student']['id'];
       
        $notifications = $this->CI->notification_model->countUnreadNotificationParent($parent_id);
        if ($notifications > 0) {
            return $notifications;
        } else {
            return false;
        }
    }

    public function getStudentSessionUserName()
    {
        $student_session = $this->CI->session->all_userdata();
        $session_Array   = $this->CI->session->userdata('student');
        $studentUsername = $session_Array['username'];
        return $studentUsername;
    }

    public function getAdminSessionUserName()
    {
        $student_session = $this->CI->session->userdata('admin');
        $username        = $student_session['username'];
        return $username;
    }

    public function getStudentSessionGardianname()
    {
        $student_session = $this->CI->session->all_userdata();
        $session_Array   = $this->CI->session->userdata('student');
        $studentUsername = $session_Array['guardian_name'];
        return $studentUsername;
    }

    public function getUserRole()
    {

        $user = $this->CI->session->userdata('student');
        return $user['role'];
    }

    public function getMonthDropdown()
    {
        $array = array();
        for ($m = 1; $m <= 12; $m++) {
            $month         = date('F', mktime(0, 0, 0, $m, 1, date('Y')));
            $array[$month] = $this->CI->lang->line(strtolower($month));
        }

        return $array;
    }

    public function getDigits()
    {
        $array = array();
        for ($i = 1; $i <= 12; $i++) {

            $array[$i] = $i;
        }
        return $array;
    }

    public function getMonthList()
    {
        $months = array(
            1  => $this->CI->lang->line('january'),
            2  => $this->CI->lang->line('february'),
            3  => $this->CI->lang->line('march'),
            4  => $this->CI->lang->line('april'),
            5  => $this->CI->lang->line('may'),
            6  => $this->CI->lang->line('june'),
            7  => $this->CI->lang->line('july'),
            8  => $this->CI->lang->line('august'),
            9  => $this->CI->lang->line('september'),
            10 => $this->CI->lang->line('october'),
            11 => $this->CI->lang->line('november'),
            12 => $this->CI->lang->line('december'));
        return $months;
    }

    public function getAppName()
    {
        $admin = $this->CI->session->userdata('admin');
        if ($admin) {
            return $admin['sch_name'];
        } else if ($this->CI->session->userdata('student')) {
            $student = $this->CI->session->userdata('student');
            return $student['sch_name'];
        }
    }

    public function getStaffRole()
    {
        $admin = $this->CI->session->userdata('admin');
        $roles = $admin['roles'];
        if ($admin) {
            $role_key = key($roles);
            return json_encode(array('id' => $roles[$role_key], 'name' => $role_key));
        }
    }

    public function getSchoolName()
    {
        $admin = $this->CI->Setting_model->getSetting();
        return $admin->name;
    }

    public function getAppVersion()
    {
        //Build: 200315
        $appVersion = "5.2.0";
        return $appVersion;
    }

    public function datetostrtotime($date)
    {
        $format = $this->getSchoolDateFormat();
        if ($format == 'd-m-Y') {
            list($day, $month, $year) = explode('-', $date);
        }

        if ($format == 'd/m/Y') {
            list($day, $month, $year) = explode('/', $date);
        }

        if ($format == 'd-M-Y') {
            list($day, $month, $year) = explode('-', $date);
        }

        if ($format == 'd.m.Y') {
            list($day, $month, $year) = explode('.', $date);
        }

        if ($format == 'm-d-Y') {
            list($month, $day, $year) = explode('-', $date);
        }

        if ($format == 'm/d/Y') {
            list($month, $day, $year) = explode('/', $date);
        }

        if ($format == 'm.d.Y') {
            list($month, $day, $year) = explode('.', $date);
        }

        if ($format == 'Y/m/d') {
            list($year, $month, $day) = explode('/', $date);
        }

        $date = $year . "-" . $month . "-" . $day;

        return strtotime($date);
    }

    public function dateFormatToYYYYMMDD($date = null)
    {

        if (strtotime($date) == 0) {
            return "";
        }
        $format = $this->getSchoolDateFormat();

        $date_formated = date_parse_from_format($format, $date);
        $year          = $date_formated['year'];
        $month         = str_pad($date_formated['month'], 2, "0", STR_PAD_LEFT);
        $day           = str_pad($date_formated['day'], 2, "0", STR_PAD_LEFT);
        $hour          = $date_formated['hour'];
        $minute        = $date_formated['minute'];
        $second        = $date_formated['second'];
        $date          = $year . "-" . $month . "-" . $day;

        return $date;
    }

    public function dateYYYYMMDDtoStrtotime($date = null)
    {

        if (strtotime($date) == 0) {
            return "";
        }

        $date_formated = date_parse_from_format('Y-m-d', $date);
        $year          = $date_formated['year'];
        $month         = $date_formated['month'];
        $day           = $date_formated['day'];

        $date = $year . "-" . $month . "-" . $day;

        return strtotime($date);
    }

    public function dateformat($date = null)
    {

        if (strtotime($date) == 0) {
            return "";
        }

        $format        = $this->getSchoolDateFormat();
        $date_formated = date_parse_from_format('Y-m-d', $date);
        $year          = $date_formated['year'];
        $month         = str_pad($date_formated['month'], 2, "0", STR_PAD_LEFT);
        $day           = str_pad($date_formated['day'], 2, "0", STR_PAD_LEFT);
        $hour          = str_pad($date_formated['hour'], 2, "0", STR_PAD_LEFT);
        $minute        = str_pad($date_formated['minute'], 2, "0", STR_PAD_LEFT);
        $second        = str_pad($date_formated['second'], 2, "0", STR_PAD_LEFT);

        $format_date = "";
        if ($format == 'd-m-Y') {
            $format_date = $day . "-" . $month . "-" . $year;
        }

        if ($format == 'd/m/Y') {
            $format_date = $day . "/" . $month . "/" . $year;
        }

        if ($format == 'd-M-Y') {
            $format_date = $day . "-" . $month . "-" . $year;
        }

        if ($format == 'd.m.Y') {
            $format_date = $day . "." . $month . "." . $year;
        }

        if ($format == 'm-d-Y') {
            $format_date = $month . "-" . $day . "-" . $year;
        }

        if ($format == 'm/d/Y') {
            $format_date = $month . "/" . $day . "/" . $year;
        }

        if ($format == 'm.d.Y') {
            $format_date = $month . "." . $day . "." . $year;
        }

        if ($format == 'Y/m/d') {
            $format_date = $year . "/" . $month . "/" . $day;
        }

        return $format_date;
    }

    public function dateTimeformat($date)
    {
        $format        = $this->getSchoolDateFormat();
        $date_formated = date_parse_from_format($format . ' H:i:s', $date);
        $year          = $date_formated['year'];
        $month         = $date_formated['month'];
        $day           = $date_formated['day'];
        $hour          = $date_formated['hour'];
        $minute        = $date_formated['minute'];
        $second        = $date_formated['second'];
        $date          = $year . "-" . $month . "-" . $day . " " . $hour . ":" . $minute . ":" . $second;

        return strtotime($date);
    }

    public function dateyyyymmddToDateTimeformat($date)
    {
        $format        = $this->getSchoolDateFormat();
        $date_formated = date_parse_from_format('Y-m-d H:i:s', $date);
        $year          = $date_formated['year'];
        $month         = str_pad($date_formated['month'], 2, "0", STR_PAD_LEFT);
        $day           = str_pad($date_formated['day'], 2, "0", STR_PAD_LEFT);
        $hour          = str_pad($date_formated['hour'], 2, "0", STR_PAD_LEFT);
        $minute        = str_pad($date_formated['minute'], 2, "0", STR_PAD_LEFT);
        $second        = str_pad($date_formated['second'], 2, "0", STR_PAD_LEFT);

        $format_date = "";
        if ($format == 'd-m-Y') {
            $format_date = $day . "-" . $month . "-" . $year . " " . $hour . ":" . $minute . ":" . $second;
        }

        if ($format == 'd/m/Y') {
            $format_date = $day . "/" . $month . "/" . $year . " " . $hour . ":" . $minute . ":" . $second;
        }

        if ($format == 'd-M-Y') {
            $format_date = $day . "-" . $month . "-" . $year . " " . $hour . ":" . $minute . ":" . $second;
        }

        if ($format == 'd.m.Y') {
            $format_date = $day . "." . $month . "." . $year . " " . $hour . ":" . $minute . ":" . $second;
        }

        if ($format == 'm-d-Y') {
            $format_date = $month . "-" . $day . "-" . $year . " " . $hour . ":" . $minute . ":" . $second;
        }

        if ($format == 'm/d/Y') {
            $format_date = $month . "/" . $day . "/" . $year . " " . $hour . ":" . $minute . ":" . $second;
        }

        if ($format == 'm.d.Y') {
            $format_date = $month . "." . $day . "." . $year . " " . $hour . ":" . $minute . ":" . $second;
        }

        if ($format == 'Y/m/d') {
            $format_date = $year . "/" . $month . "/" . $day . " " . $hour . ":" . $minute . ":" . $second;
        }

        return $format_date;
    }

    public function dateyyyymmddTodateformat($date)
    {

        $format = $this->getSchoolDateFormat();

        if ($format == 'd-m-Y') {
            list($month, $day, $year) = explode('-', $date);
        }

        if ($format == 'd/m/Y') {
            list($month, $day, $year) = explode('-', $date);
        }

        if ($format == 'd-M-Y') {
            list($month, $day, $year) = explode('-', $date);
        }

        if ($format == 'd.m.Y') {
            list($month, $day, $year) = explode('-', $date);
        }

        if ($format == 'm-d-Y') {
            list($month, $day, $year) = explode('-', $date);
        }

        if ($format == 'm/d/Y') {
            list($month, $day, $year) = explode('-', $date);
        }

        if ($format == 'm.d.Y') {
            list($month, $day, $year) = explode('-', $date);
        }

        if ($format == 'Y/m/d') {
            list($month, $day, $year) = explode('-', $date);
        }

        $date = $year . "-" . $day . "-" . $month;

        return strtotime($date);
    }

    public function dateFront()
    {
        $admin = $this->CI->Setting_model->getSetting();
        return $admin->date_format;
    }

    public function dateyyyymmddTodateformatFront($date)
    {
        $format = $this->dateFront();

        if ($format == 'd-m-Y') {
            list($month, $day, $year) = explode('-', $date);
        }

        if ($format == 'd/m/Y') {
            list($month, $day, $year) = explode('-', $date);
        }

        if ($format == 'd-M-Y') {
            list($month, $day, $year) = explode('-', $date);
        }

        if ($format == 'd.m.Y') {
            list($month, $day, $year) = explode('-', $date);
        }

        if ($format == 'm-d-Y') {
            list($month, $day, $year) = explode('-', $date);
        }

        if ($format == 'm/d/Y') {
            list($month, $day, $year) = explode('-', $date);
        }

        if ($format == 'm.d.Y') {
            list($month, $day, $year) = explode('-', $date);
        }

        $date = $year . "-" . $day . "-" . $month;

        return strtotime($date);
    }

    public function timezone_list()
    {
        static $timezones = null;

        if ($timezones === null) {
            $timezones = [];
            $offsets   = [];
            $now       = new DateTime('now', new DateTimeZone('UTC'));

            foreach (DateTimeZone::listIdentifiers() as $timezone) {

                $now->setTimezone(new DateTimeZone($timezone));
                $offsets[]            = $offset            = $now->getOffset();
                $timezones[$timezone] = '(' . $this->format_GMT_offset($offset) . ') ' . $this->format_timezone_name($timezone);
            }

            array_multisort($offsets, $timezones);
        }
        return $timezones;
    }

    public function format_GMT_offset($offset)
    {
        $hours   = intval($offset / 3600);
        $minutes = abs(intval($offset % 3600 / 60));
        return 'GMT' . ($offset ? sprintf('%+03d:%02d', $hours, $minutes) : '');
    }

    public function format_timezone_name($name)
    {
        $name = str_replace('/', ', ', $name);
        $name = str_replace('_', ' ', $name);
        $name = str_replace('St ', 'St. ', $name);
        return $name;
    }

    public function getMailMethod()
    {
        $mail_method             = array();
        $mail_method['sendmail'] = 'SendMail';
        $mail_method['smtp']     = 'SMTP';
        return $mail_method;
    }

    public function getNotificationModes()
    {
        $notification                      = array();
        $notification['student_admission'] = $this->CI->lang->line('student_admission');
        $notification['exam_result']       = $this->CI->lang->line('exam_result');
        $notification['fee_submission']    = $this->CI->lang->line('fees_submission');
        $notification['absent_attendence'] = $this->CI->lang->line('absent_student');
        $notification['login_credential']  = $this->CI->lang->line('login_credential');
        return $notification;
    }

    public function sendMailSMS($find)
    {

        $notifications = $this->CI->notificationsetting_model->get();

        if (!empty($notifications)) {
            foreach ($notifications as $note_key => $note_value) {
                if ($note_value->type == $find) {
    return array('mail' => $note_value->is_mail, 'sms' => $note_value->is_sms, 'notification' => $note_value->is_notification, 'template' => $note_value->template);
                }
            }
        }
        return false;
    }

    public function setUserLog($username, $role)
    {
        if ($this->CI->agent->is_browser()) {
            $agent = $this->CI->agent->browser() . ' ' . $this->CI->agent->version();
        } elseif ($this->CI->agent->is_robot()) {
            $agent = $this->CI->agent->robot();
        } elseif ($this->CI->agent->is_mobile()) {
            $agent = $this->CI->agent->mobile();
        } else {
            $agent = 'Unidentified User Agent';
        }

        $data = array(
            'user'       => $username,
            'role'       => $role,
            'ipaddress'  => $this->CI->input->ip_address(),
            'user_agent' => $agent . ", " . $this->CI->agent->platform(),
        );
        $this->CI->userlog_model->add($data);
    }

    public function mediaType()
    {
        $media_type                             = array();
        $media_type['image/jpeg']               = "Image";
        $media_type['video']                    = "Video";
        $media_type['text/plain']               = "Text";
        $media_type['application/zip']          = "Zip";
        $media_type['application/x-rar']        = "Rar";
        $media_type['application/pdf']          = "Pdf";
        $media_type['application/msword']       = "Word";
        $media_type['application/vnd.ms-excel'] = "Excel";
        $media_type['other']                    = "Other";
        return $media_type;
    }

    public function getFormString($str, $start, $end)
    {

        $string  = false;
        $pattern = sprintf(
            '/%s(.+?)%s/ims', preg_quote($start, '/'), preg_quote($end, '/')
        );

        if (preg_match($pattern, $str, $matches)) {
            list(, $match) = $matches;
            $string        = trim($match);
        }
        return $string;
    }

    public function uniqueFileName($prefix = "", $name = "")
    {
        if (!empty($_FILES)) {
            $newFileName = uniqid($prefix, true) . '.' . strtolower(pathinfo($name, PATHINFO_EXTENSION));
            return $newFileName;
        }
        return false;
    }

    public function getUserData()
    {
        $result         = $this->getLoggedInUserData();
        $id             = $result["id"];
        $data           = $this->CI->staff_model->get($id);
        $setting_result = $this->CI->setting_model->get();
        if (!empty($setting_result)) {
            $data["class_teacher"] = $setting_result[0]["class_teacher"];
        } else {
            $data["class_teacher"] = "yes";
        }
        return $data;
    }

    public function countincompleteTask($id)
    {

        $result = $this->CI->calendar_model->countincompleteTask($id);
        return $result;
    }

    public function getincompleteTask($id)
    {

        $result = $this->CI->calendar_model->getincompleteTask($id);
        return $result;
    }

    public function getClassbyteacher($id)
    {

        $getUserassignclass = $this->CI->classteacher_model->getclassbyuser($id);
        $classteacherlist   = $getUserassignclass;
        $class              = array();
        echo "<pre>";
        print_r($classteacherlist);
        echo "<pre>";die;
        foreach ($classteacherlist as $key => $value) {
            $class[] = $value["id"];
        }

        if (!empty($class)) {

            $getSubjectassignclass = $this->CI->classteacher_model->classbysubjectteacher($id, $class);
            echo "<pre>";
            print_r($getSubjectassignclass);
            echo "<pre>";die;
            $subjectteacherlist = $getSubjectassignclass;

            $classlist = array_merge($classteacherlist, $subjectteacherlist);

            $i = 0;
            foreach ($classlist as $key => $value) {

                $data[$i]["id"]    = $value["id"];
                $data[$i]["class"] = $value["class"];

                $i++;
            }
        } else {
            $getSubjectassignclass = $this->CI->classteacher_model->getsubjectbyteacher($id);

            $data = $getSubjectassignclass;
        }

        return $data;
    }

    public function getclassteacher($id)
    {

        $getUserassignclass = $this->CI->classteacher_model->getclassbyuser($id);
        $classteacherlist   = $getUserassignclass;

        return $classteacherlist;
    }

    public function getteachersubjects($id)
    {

        $getUserassignclass = $this->CI->classteacher_model->getsubjectbyteacher($id);
        $classteacherlist   = $getUserassignclass;

        return $classteacherlist;
    }

    public function get_betweendate($search_type)
    {

        if ($search_type == 'today') {

            $today      = strtotime('today 00:00:00');
            $first_date = date('Y-m-d H:i:s', $today);
            $last_date  = date('Y-m-d H:i:s', $today);

        } else if ($search_type == 'this_week') {
            $first_date = date("Y-m-d", strtotime("monday"));
            $last_date  = date("Y-m-d", strtotime("next sunday"));
            if (strtotime($first_date) > strtotime(date('Y-m-d'))) {
                $first_date = date("Y-m-d", strtotime("-1 week monday"));
                $last_date  = date("Y-m-d", strtotime("sunday"));
            }

        } else if ($search_type == 'last_week') {

            $last_week_start = strtotime('-2 week monday 00:00:00');
            $last_week_end   = strtotime('-1 week sunday 23:59:59');
            $first_date      = date('Y-m-d H:i:s', $last_week_start);
            $last_date       = date('Y-m-d H:i:s', $last_week_end);

        } else if ($search_type == 'this_month') {

            $first_date = date('Y-m-01');
            $last_date  = date('Y-m-t 23:59:59.993');

        } else if ($search_type == 'last_month') {
            $first_date = date('Y-m-01', strtotime("-1 month"));
            $last_date  = date('Y-m-t', strtotime("-1 month"));

        } else if ($search_type == 'last_6_month') {

            $month      = date("m", strtotime("-5 month"));
            $first_date = date('Y-' . $month . '-01');
            $firstday   = date('Y-' . 'm' . '-01');
            $last_date  = date('Y-' . 'm' . '-' . date('t', strtotime($firstday)) . ' 23:59:59.993');

        } else if ($search_type == 'last_12_month') {

            $first_date = date('Y-m' . '-01', strtotime("-11 month"));
            $firstday   = date('Y-' . 'm' . '-01');
            $last_date  = date('Y-' . 'm' . '-' . date('t', strtotime($firstday)) . ' 23:59:59.993');

        } else if ($search_type == 'last_3_month') {

            $first_date = date('Y-m' . '-01', strtotime("-2 month"));
            $firstday   = date('Y-' . 'm' . '-01');
            $last_date  = date('Y-' . 'm' . '-' . date('t', strtotime($firstday)) . ' 23:59:59.993');

        } else if ($search_type == 'last_year') {

            $search_year = date('Y', strtotime("-1 year"));
            $first_date  = '01-01-' . $search_year;
            $last_date   = '31-12-' . $search_year;

        } else if ($search_type == 'this_year') {

            $search_year = date('Y');

            $first_date = '01-01-' . $search_year;
            $last_date  = '31-12-' . $search_year;
        } else if ($search_type == 'all time') {
            $search_year = date('Y');
            $first_date  = '01-01-' . $search_year;
            $last_date   = '31-12-' . $search_year;
        } else if ($search_type == 'period') {
            $first_date = date('Y-m-d', strtotime($_POST['date_from']));
            $last_date  = date('Y-m-d', strtotime($_POST['date_to']));
        }

        return $date = array('from_date' => $first_date, 'to_date' => $last_date);
    }

    public function get_searchtype()
    {

        $data = array(
            ''              => $this->CI->lang->line('select'),

            'today'         => $this->CI->lang->line('today'),
            'this_week'     => $this->CI->lang->line('this_week'),
            'last_week'     => $this->CI->lang->line('last_week'),
            'this_month'    => $this->CI->lang->line('this_month'),
            'last_month'    => $this->CI->lang->line('last_month'),
            'last_3_month'  => $this->CI->lang->line('last_3_month'),
            'last_6_month'  => $this->CI->lang->line('last_6_month'),
            'last_12_month' => $this->CI->lang->line('last_12_month'),
            'this_year'     => $this->CI->lang->line('this_year'),
            'last_year'     => $this->CI->lang->line('last_year'),
            'period'        => $this->CI->lang->line('period'),
        );

        return $data;
    }

    public function get_groupby($key = null)
    {
        $data = array(
            ''           => $this->CI->lang->line('select'),
            'class'      => $this->CI->lang->line('class'),
            'collection' => $this->CI->lang->line('collect'),
            'mode'       => $this->CI->lang->line('mode'),
        );
        if ($key != null) {

            return $data[$key];

        } else {

            return $data;

        }

    }

    public function getLanguage()
    {

        $result = $this->CI->setting_model->getLanguage();
        return $result;
    }

    public function date_type()
    {

        $date_type = array(
            ''               => $this->CI->lang->line('all'),
            'exam_from_date' => $this->CI->lang->line('exam_from_date'),
            'exam_to_date'   => $this->CI->lang->line('exam_to_date'),
        );

        return $date_type;
    }

    public function chatDateTimeformat($date)
    {

        $date_formated = date_parse_from_format('d M Y, H:i:s', $date);
        $year          = $date_formated['year'];
        $month         = str_pad($date_formated['month'], 2, "0", STR_PAD_LEFT);
        $day           = str_pad($date_formated['day'], 2, "0", STR_PAD_LEFT);
        $hour          = str_pad($date_formated['hour'], 2, "0", STR_PAD_LEFT);
        $minute        = str_pad($date_formated['minute'], 2, "0", STR_PAD_LEFT);
        $second        = str_pad($date_formated['second'], 2, "0", STR_PAD_LEFT);

        $format_date = $year . "-" . $month . "-" . $day . " " . $hour . ":" . $minute . ":" . $second;
        return $format_date;
    }

    public function payment_mode()
    {

        $mode = array(
            'cash'   => $this->CI->lang->line('cash'),
            'cheque' => $this->CI->lang->line('cheque'),
            'online' => $this->CI->lang->line('transfer_to_bank_account'),
        );

        return $mode;
    }

    public function staff_status()
    {
        $status = array(
            'both' => $this->CI->lang->line('all'),
            '1'    => $this->CI->lang->line('active'),
            '2'    => $this->CI->lang->line('disabled'));
        return $status;
    }

    public function staff_statusmessage($id = null)
    {
        $status = array(
            'both' => $this->CI->lang->line('all'),
            '1'    => $this->CI->lang->line('active'),
            '2'    => $this->CI->lang->line('disabled'));

        if ($id != null) {
            return $status[$id];
        } else {
            return $status;
        }
    }

    public function get_postmessage()
    {

        $filter_record = array();

        if (isset($_POST['class_id']) && $_POST['class_id'] != '') {
            $filter_record['class'] = $this->CI->messages_model->get_classname($_POST['class_id']);
        }

        if (isset($_POST['section_id']) && $_POST['section_id'] != '') {
            $filter_record['section'] = $this->CI->messages_model->get_sectionname($_POST['section_id']);
        }

        if (isset($_POST['category_id']) && $_POST['category_id'] != '') {
            $filter_record['category'] = $this->CI->messages_model->get_categoryname($_POST['category_id']);
        }

        if (isset($_POST['gender']) && $_POST['gender'] != '') {
            $filter_record['gender'] = $this->CI->lang->line('gender') . " : " . $_POST['gender'];
        }

        if (isset($_POST['rte']) && $_POST['rte'] != '') {
            $filter_record['rte'] = $this->CI->lang->line('rte') . " : " . $_POST['rte'];
        }

        if (isset($_POST['month']) && $_POST['month'] != '') {
            $filter_record['month'] = $this->CI->lang->line('month') . " : " . $_POST['month'];
        }

        if (isset($_POST['year']) && $_POST['year'] != '') {
            $filter_record['year'] = $this->CI->lang->line('year') . " : " . $_POST['year'];
        }

        if (isset($_POST['subject_group_id']) && $_POST['subject_group_id'] != '') {
            $filter_record['subject_group_id'] = $this->CI->messages_model->get_subject_groupname($_POST['subject_group_id']);
        }
        // collect_by

        if (isset($_POST['subject_id']) && $_POST['subject_id'] != '') {
            $filter_record['subject_id'] = $this->CI->messages_model->get_subject_name($_POST['subject_id']);
        }

        if (isset($_POST['student_id']) && $_POST['student_id'] != '') {
            $filter_record['student_id'] = $this->CI->messages_model->get_student_name($_POST['student_id']);
        }

        if (isset($_POST['collect_by']) && $_POST['collect_by'] != '') {
            $filter_record['collect_by'] = $this->CI->messages_model->get_staff_name($_POST['collect_by']);
        }

        if (isset($_POST['group']) && $_POST['group'] != '') {
            $filter_record['group'] = $this->CI->lang->line('group') . " " . $this->CI->lang->line('by') . " : " . $this->get_groupby($_POST['group']);

        }

        if (isset($_POST['head']) && $_POST['head'] != '') {

            if ($this->CI->uri->segment(2) == "incomegroup") {

                $filter_record['head'] = $this->CI->messages_model->get_exphead_name($_POST['head']);

            } else {

                $filter_record['head'] = $this->CI->messages_model->get_inchead_name($_POST['head']);

            }

        }

        if (isset($_POST['attendance_type']) && $_POST['attendance_type'] != '') {
            $filter_record['attendance_type'] = $this->CI->messages_model->get_attendance_type($_POST['attendance_type']);

        }

        if (isset($_POST['role']) && $_POST['role'] != '') {

            if ($this->CI->uri->segment(2) == "staff_report") {
                $filter_record['role'] = $this->CI->messages_model->get_rolename($_POST['role']);
            } else {
                $filter_record['role'] = $this->CI->lang->line('role') . " : " . $_POST['role'];
            }

        }

        if (isset($_POST['exam_group_id']) && $_POST['exam_group_id'] != '') {
            $filter_record['exam_group_id'] = $this->CI->messages_model->get_exam_group($_POST['exam_group_id']);

        }

        if ((isset($_POST['exam_id']) && $_POST['exam_id'] != '')) {

            if ($this->CI->uri->segment(2) == "onlineexamrank") {
                $filter_record['exam_id'] = $this->CI->messages_model->get_onlineexamname($_POST['exam_id']);
            } else {
                $filter_record['exam_id'] = $this->CI->messages_model->get_examname($_POST['exam_id']);
            }

        }

        if ((isset($_POST['session_id']) && $_POST['session_id'] != '')) {

            $filter_record['session_id'] = $this->CI->messages_model->get_sessionname($_POST['session_id']);

        }
//staff_statusmessage

        if ((isset($_POST['staff_status']) && $_POST['staff_status'] != '')) {

            $filter_record['staff_status'] = $this->CI->lang->line('status') . " : " . $this->staff_statusmessage($_POST['staff_status']);

        }

        if ((isset($_POST['designation']) && $_POST['designation'] != '')) {

            $filter_record['designation'] = $this->CI->messages_model->get_designation($_POST['designation']);

        }

        if ((isset($_POST['members_type']) && $_POST['members_type'] != '')) {

            $filter_record['members_type'] = $this->CI->lang->line('members') . " " . $this->CI->lang->line('type') . " : " . $this->CI->lang->line($_POST['members_type']);

        }

        if ((isset($_POST['date_type']) && $_POST['date_type'] != '')) {

            $filter_record['date_type'] = $this->CI->lang->line('date') . " " . $this->CI->lang->line('type') . " : " . $this->CI->lang->line($_POST['date_type']);

        }

        if ((isset($_POST['route_title']) && $_POST['route_title'] != '')) {

            //$filter_record['route_title']=$this->CI->messages_model->get_route_title($_POST['route_title']);
            $filter_record['route_title'] = $this->CI->lang->line('route_title') . " : " . $_POST['route_title'];

        }

        if ((isset($_POST['vehicle_no']) && $_POST['vehicle_no'] != '')) {

            $filter_record['vehicle_no'] = $this->CI->lang->line('vehicle_no') . " : " . $_POST['vehicle_no'];

        } //hostel_name
        if ((isset($_POST['hostel_name']) && $_POST['hostel_name'] != '')) {

            $filter_record['hostel_name'] = $this->CI->lang->line('hostel_name') . " : " . $_POST['hostel_name'];

        }
        if (isset($_POST['search_type']) && $_POST['search_type'] != '') {

            if ($_POST['search_type'] == "period") {
                $filter_record['search_type'] = $this->CI->lang->line('search') . " " . $this->CI->lang->line('type') . " : " . date($this->getSchoolDateFormat(), strtotime($_POST['date_from'])) . " " . $this->CI->lang->line('to') . " " . date($this->getSchoolDateFormat(), strtotime($_POST['date_to']));
            } else {
                $between_date                 = $this->get_betweendate($_POST['search_type']);
                $filter_record['search_type'] = $this->CI->lang->line('search') . " " . $this->CI->lang->line('type') . " : " . date($this->getSchoolDateFormat(), strtotime($between_date['from_date'])) . " " . $this->CI->lang->line('to') . " " . date($this->getSchoolDateFormat(), strtotime($between_date['to_date']));
            }

        }

        foreach ($filter_record as $key => $value) {
            echo $value . ", ";
        }

    }

    public function is_biometricAttendence()
    {
        return $this->CI->studentsubjectattendence_model->is_biometricAttendence();
    }

    public function getLimitChar($string, $str_length = 50)
    {

        $string = strip_tags($string);
        if (strlen($string) > $str_length) {

            // truncate string
            $stringCut = substr($string, 0, $str_length);
            $endPoint  = strrpos($stringCut, ' ');

            //if the string doesn't contain any space then it will cut without word basis.
            $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
            $string .= '...';
        }
        return $string;
    }
}
