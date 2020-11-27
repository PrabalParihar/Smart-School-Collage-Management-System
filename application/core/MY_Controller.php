<?php

define('THEMES_DIR', 'themes');
define('BASE_URI', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));

class MY_Controller extends CI_Controller
{

    protected $langs = array();

    public function __construct()
    {

        parent::__construct();
        $this->config->load('license');
        $this->load->helper('language');

        $this->load->library('auth');
        $this->load->library('module_lib');
        $this->load->library('pushnotification');
        $this->load->library('jsonlib');
        $this->load->helper(array('directory', 'customfield', 'custom'));
        $this->load->model(array('setting_model', 'customfield_model', 'onlinestudent_model', 'houselist_model', 'onlineexam_model', 'onlineexamquestion_model', 'onlineexamresult_model', 'examstudent_model', 'admitcard_model', 'marksheet_model', 'chatuser_model', 'examgroupstudent_model', 'examgroup_model', 'batchsubject_model'));

        if ($this->session->has_userdata('admin')) {

            $admin    = $this->session->userdata('admin');
            $language = ($admin['language']['language']);

        } else if ($this->session->has_userdata('student')) {

            $student  = $this->session->userdata('student');
            $language = ($student['language']['language']);

        } else {
            $language = "English";
        }
        $this->config->set_item('language', strtotime($language));
        $lang_array = array('form_validation_lang');
        $map        = directory_map(APPPATH . "./language/" . $language . "/app_files");
        foreach ($map as $lang_key => $lang_value) {
            $lang_array[] = 'app_files/' . str_replace(".php", "", $lang_value);
        }

        $this->load->language($lang_array, $language);
    }

}

class Admin_Controller extends MY_Controller
{
    protected $aaaa = false;
    public function __construct()
    {
        parent::__construct();
        $this->auth->is_logged_in();
        $this->check_license();
        $this->load->library('rbac');
        $this->config->load('app-config');
        $this->load->model(array('batchsubject_model', 'examgroup_model', 'examsubject_model', 'examgroupstudent_model', 'feereminder_model'));

        $this->config->load('ci-blog');
        $this->config->load('custom_filed-config');
    }

    public function check_license()
    {
		return true;
        $license = $this->config->item('SSLK');

        if (!empty($license)) {

            $regex = "/^[A-Z0-9]{6}-[A-Z0-9]{6}-[A-Z0-9]{6}-/";

            if (preg_match($regex, $license)) {
                $valid_string = $this->aes->validchk('encrypt', base_url());

                if (strpos($license, $valid_string) !== false) {

                    true; //valid
                } else {
                    $this->update_ss_routine();
                }
            } else {

                $this->update_ss_routine();

            }

        }

    }
    public function update_ss_routine()
    {

        $license       = $this->config->item('SSLK');
        $fname         = APPPATH . 'config/license.php';
        $update_handle = fopen($fname, "r");
        $content       = fread($update_handle, filesize($fname));
        $file_contents = str_replace('$config[\'SSLK\'] = \'' . $license . '\'', '$config[\'SSLK\'] = \'\'', $content);
        $update_handle = fopen($fname, 'w') or die("can't open file");
        if (fwrite($update_handle, $file_contents)) {

        }
        fclose($update_handle);

        $this->config->set_item('SSLK', '');
    }

}

class Student_Controller extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('studentmodule_lib');
        $this->config->load('app-config');
        $this->auth->is_logged_in_user('student');
    }

}

class Public_Controller extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

}

class Parent_Controller extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->auth->is_logged_in_user('parent');
        $this->config->load('app-config');
        $this->load->library('parentmodule_lib');
    }

}

class Front_Controller extends CI_Controller
{

    protected $data           = array();
    protected $school_details = array();
    protected $parent_menu    = '';
    protected $page_title     = '';
    protected $theme_path     = '';
    protected $front_setting  = '';

    public function __construct()
    {

        parent::__construct();

        $this->check_installation();

        if ($this->config->item('installed') == true) {

            $this->db->reconnect();
        }
        $this->load->helper('language');
        $this->school_details = $this->setting_model->getSchoolDetail();

        $this->load->model('frontcms_setting_model');

        $this->front_setting = $this->frontcms_setting_model->get();

        if (!$this->front_setting) {

            redirect('site/userlogin');

        } else {

            if (!$this->front_setting->is_active_front_cms) {

                redirect('site/userlogin');

            }
        }

        $this->theme_path = $this->front_setting->theme;
//================
        $language = ($this->school_details->language);
        $this->load->helper('directory');
        $lang_array = array('form_validation_lang');
        $map        = directory_map(APPPATH . "./language/" . $language . "/app_files");
        foreach ($map as $lang_key => $lang_value) {
            $lang_array[] = 'app_files/' . str_replace(".php", "", $lang_value);
        }

        $this->load->language($lang_array, $language);
//===============

        $this->load->config('ci-blog');
    }

    protected function load_theme($content = null, $layout = true)
    {

        $this->data['main_menus']     = '';
        $this->data['school_setting'] = $this->school_details;
        $this->data['front_setting']  = $this->front_setting;
        $menu_list                    = $this->cms_menu_model->getBySlug('main-menu');

        $footer_menu_list = $this->cms_menu_model->getBySlug('bottom-menu');
        if (count($menu_list) > 0) {
            $this->data['main_menus'] = $this->cms_menuitems_model->getMenus($menu_list['id']);
        }

        if (count($footer_menu_list) > 0) {
            $this->data['footer_menus'] = $this->cms_menuitems_model->getMenus($footer_menu_list['id']);
        }
        $this->data['header'] = $this->load->view('themes/' . $this->theme_path . '/header', $this->data, true);

        $this->data['slider'] = $this->load->view('themes/' . $this->theme_path . '/home_slider', $this->data, true);

        $this->data['footer'] = $this->load->view('themes/' . $this->theme_path . '/footer', $this->data, true);

        $this->base_assets_url = 'backend/' . THEMES_DIR . '/' . $this->theme_path . '/';

        $this->data['base_assets_url'] = BASE_URI . $this->base_assets_url;

        // if ($layout == true) {
        $this->data['content'] = (is_null($content)) ? '' : $this->load->view(THEMES_DIR . '/' . $this->theme_path . '/' . $content, $this->data, true);
        $this->load->view(THEMES_DIR . '/' . $this->theme_path . '/layout', $this->data);
        // } else {
        //     $this->load->view(THEMES_DIR . '/' . $this->config->item('ci_blog_theme') . '/' . $content, $this->data);
        // }
    }

    protected function load_theme_form($content = null, $layout = true)
    {

        $this->data['main_menus']     = '';
        $this->data['school_setting'] = $this->school_details;
        $this->data['front_setting']  = $this->front_setting;
        $menu_list                    = $this->cms_menu_model->getBySlug('main-menu');
        $footer_menu_list             = $this->cms_menu_model->getBySlug('bottom-menu');
        if (count($menu_list > 0)) {
            $this->data['main_menus'] = $this->cms_menuitems_model->getMenus($menu_list['id']);
        }

        if (count($footer_menu_list > 0)) {
            $this->data['footer_menus'] = $this->cms_menuitems_model->getMenus($footer_menu_list['id']);
        }
        $this->data['header'] = $this->load->view('themes/' . $this->theme_path . '/header', $this->data, true);

        $this->data['slider'] = $this->load->view('themes/' . $this->theme_path . '/home_slider', $this->data, true);

        $this->data['footer'] = $this->load->view('themes/' . $this->theme_path . '/footer', $this->data, true);

        $this->base_assets_url = 'backend/' . THEMES_DIR . '/' . $this->theme_path . '/';

        $this->data['base_assets_url'] = BASE_URI . $this->base_assets_url;

        // if ($layout == true) {
        $this->data['content'] = (is_null($content)) ? '' : $this->load->view(THEMES_DIR . '/' . $this->theme_path . '/' . $content, $this->data, true);
        $this->load->view(THEMES_DIR . '/' . $this->theme_path . '/layout', $this->data);
        // } else {
        //     $this->load->view(THEMES_DIR . '/' . $this->config->item('ci_blog_theme') . '/' . $content, $this->data);
        // }
    }

    private function check_installation()
    {

        if ($this->uri->segment(1) !== 'install') {
            $this->load->config('migration');
            if ($this->config->item('installed') == false && $this->config->item('migration_enabled') == false) {
                redirect(base_url() . 'install/start');
            } else {
                if (is_dir(APPPATH . 'controllers/install')) {
                    echo '<h3>Delete the install folder from application/controllers/install</h3>';
                    die;
                }
            }
        }
    }

}
