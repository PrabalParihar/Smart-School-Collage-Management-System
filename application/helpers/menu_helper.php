<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (!function_exists('active_link')) {

    function activate_menu($controller, $action) {
        $CI = get_instance();
        $method = $CI->router->fetch_method();
        $class = $CI->router->fetch_class();
        return ($method == $action && $controller == $class) ? 'active' : '';
    }

    function set_Topmenu($top_menu_name) {
        $CI = get_instance();
        $session_top_menu = $CI->session->userdata('top_menu');
        if ($session_top_menu == $top_menu_name) {
            return 'active';
        }
        return "";
    }

    function set_Submenu($sub_menu_name) {
        $CI = get_instance();
        $session_sub_menu = $CI->session->userdata('sub_menu');
        if ($session_sub_menu == $sub_menu_name) {
            return 'active';
        }
        return "";
    }

     function set_SubSubmenu($sub_menu_name) {
        $CI = get_instance();
        $session_sub_menu = $CI->session->userdata('subsub_menu');
        if ($session_sub_menu == $sub_menu_name) {
            return 'active';
        }
        return "";
    }

}

function access_denied() {
    redirect('admin/unauthorized');
}

function update_config_installed() {
    $CI = & get_instance();
    $config_path = APPPATH . 'config/config.php';
    $CI->load->helper('file');
    @chmod($config_path, FILE_WRITE_MODE);
    $config_file = read_file($config_path);
    $config_file = trim($config_file);
    $config_file = str_replace("\$config['installed'] = false;", "\$config['installed'] = true;", $config_file);
    $config_file = str_replace("\$config['base_url'] = '';", "\$config['base_url'] = '" . site_url() . "';", $config_file);
    if (!$fp = fopen($config_path, FOPEN_WRITE_CREATE_DESTRUCTIVE)) {
        return FALSE;
    }
    flock($fp, LOCK_EX);
    fwrite($fp, $config_file, strlen($config_file));
    flock($fp, LOCK_UN);
    fclose($fp);
    @chmod($config_path, FILE_READ_MODE);
    return TRUE;
}

function update_autoload_installed() {
    $CI = & get_instance();
    $autoload_path = APPPATH . 'config/autoload.php';
    $CI->load->helper('file');
    @chmod($autoload_path, FILE_WRITE_MODE);
    $autoload_file = read_file($autoload_path);
    $autoload_file = trim($autoload_file);
    $autoload_file = str_replace("\$autoload['model'] = array()", "\$autoload['model'] = array('session_model', 'class_model', 'staff_model', 'section_model', 'setting_model', 'classsection_model', 'category_model', 'student_model', 'feemaster_model', 'feecategory_model', 'feetype_model', 'studentfee_model', 'stuattendence_model', 'attendencetype_model', 'studentsession_model', 'language_model', 'admin_model', 'smsconfig_model', 'langpharses_model', 'subject_model', 'teacher_model', 'teachersubject_model', 'exam_model', 'mark_model', 'examschedule_model', 'examresult_model', 'expense_model', 'expensehead_model', 'studenttransportfee_model', 'book_model', 'grade_model', 'timetable_model', 'hostel_model', 'route_model', 'content_model', 'user_model', 'notification_model', 'paymentsetting_model','payroll_model', 'roomtype_model','department_model','designation_model', 'hostelroom_model', 'vehicle_model', 'vehroute_model', 'librarian_model', 'accountant_model','homework_model', 'librarymanagement_model', 'librarymember_model', 'bookissue_model', 'parent_model', 'feegroup_model', 'feegrouptype_model', 'feesessiongroup_model', 'studentfeemaster_model', 'feediscount_model','emailconfig_model','income_model','incomehead_model','itemcategory_model','schoolhouse_model','item_model','messages_model','itemstore_model','itemsupplier_model','notificationsetting_model','itemstock_model','itemissue_model','userlog_model','cms_program_model','cms_menu_model','cms_media_model','cms_page_model','cms_menuitems_model','cms_page_content_model','role_model','calendar_model','userpermission_model','staffroles_model','staffattendancemodel','rolepermission_model','Certificate_model','classteacher_model','Generatecertificate_model','Student_id_card_model','timeline_model','Generateidcard_model','Module_model','subjectgroup_model','studentsubjectgroup_model','subjecttimetable_model','studentsubjectattendence_model','audit_model','Chat_model','apply_leave_model','disable_reason_model','question_model','leavetypes_model')", $autoload_file);
    $autoload_file = str_replace("\$autoload['libraries'] = array('database', 'session', 'form_validation')", "\$autoload['libraries'] = array('database', 'email','session', 'form_validation', 'upload', 'pagination',
   'Customlib', 'Role', 'Smsgateway', 'QDMailer','Adler32','Aes')", $autoload_file);
    if (!$fp = fopen($autoload_path, FOPEN_WRITE_CREATE_DESTRUCTIVE)) {
        return FALSE;
    }
    flock($fp, LOCK_EX);
    fwrite($fp, $autoload_file, strlen($autoload_file));
    flock($fp, LOCK_UN);
    fclose($fp);
    @chmod($config_path, FILE_READ_MODE);
    return TRUE;
}

function delete_dir($dirPath) {
    if (!is_dir($dirPath)) {
        throw new InvalidArgumentException("$dirPath must be a directory");
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            delete_dir($file);
        } else {
            unlink($file);
        }
    }
    if (rmdir($dirPath)) {
        return true;
    }
    return false;
}

function admin_url($url = '') {
    if ($url == '') {
        return site_url() . 'site/login';
    } else {
        return site_url() . 'site/login';
    }
}

?>