<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends Front_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->config('form-builder');
        $this->load->config('app-config');
        $this->load->library(array('mailer', 'form_builder'));
        $this->load->model(array('frontcms_setting_model', 'complaint_Model', 'Visitors_model', 'onlinestudent_model'));
        $this->blood_group = $this->config->item('bloodgroup');
        $this->load->library('Ajax_pagination');
        $this->load->library('module_lib');
        $this->banner_content         = $this->config->item('ci_front_banner_content');
        $this->perPage                = 12;
        $ban_notice_type              = $this->config->item('ci_front_notice_content');
        $this->data['banner_notices'] = $this->cms_program_model->getByCategory($ban_notice_type, array('start' => 0, 'limit' => 5));
    }

    public function show_404()
    {
        $this->load->view('errors/error_message');
    }

    public function index()
    {
        $setting                     = $this->frontcms_setting_model->get();
        $this->data['active_menu']   = 'home';
        $this->data['page_side_bar'] = $setting->is_active_sidebar;
        $home_page                   = $this->config->item('ci_front_home_page_slug');
        $result                      = $this->cms_program_model->getByCategory($this->banner_content);
        $this->data['page']          = $this->cms_page_model->getBySlug($home_page);
        if (!empty($result)) {
            $this->data['banner_images'] = $this->cms_program_model->front_cms_program_photos($result[0]['id']);
        }

        $this->load_theme('home');
    }

    public function page($slug)
    {
        $page = $this->cms_page_model->getBySlug($slug);
        if (!$page) {
            $this->data['page'] = $this->cms_page_model->getBySlug('404-page');
        } else {

            $this->data['page'] = $this->cms_page_model->getBySlug($slug);
        }

        if ($page['is_homepage']) {
            redirect('frontend');
        }
        $this->data['active_menu']       = $slug;
        $this->data['page_side_bar']     = $this->data['page']['sidebar'];
        $this->data['page_content_type'] = "";
        if (!empty($this->data['page']['category_content'])) {
            $content_array = $this->data['page']['category_content'];
            reset($content_array);
            $first_key            = key($content_array);
            $totalRec             = count($this->cms_program_model->getByCategory($content_array[$first_key]));
            $config['target']     = '#postList';
            $config['base_url']   = base_url() . 'welcome/ajaxPaginationData';
            $config['total_rows'] = $totalRec;
            $config['per_page']   = $this->perPage;
            $config['link_func']  = 'searchFilter';
            $this->ajax_pagination->initialize($config);
            //get the posts data
            $this->data['page']['category_content'][$first_key] = $this->cms_program_model->getByCategory($content_array[$first_key], array('limit' => $this->perPage));

            $this->data['page_content_type']                    = $content_array[$first_key];
            //load the view
        }
        $this->data['page_form'] = false;

        if (strpos($page['description'], '[form-builder:') !== false) {
            $this->data['page_form'] = true;
            $start                   = '[form-builder:';
            $end                     = ']';
           
            $form_name = $this->customlib->getFormString($page['description'], $start, $end);
           
            $form = $this->config->item($form_name);

            $this->data['form_name'] = $form_name;
            $this->data['form']      = $form;

            if (!empty($form)) {
                foreach ($form as $form_key => $form_value) {
                    if (isset($form_value['validation'])) {
                        $display_string = ucfirst(preg_replace('/[^A-Za-z0-9\-]/', ' ', $form_value['id']));
                        $this->form_validation->set_rules($form_value['id'], $display_string, $form_value['validation']);
                    }
                }
                if ($this->form_validation->run() == false) {

                } else {
                    $setting = $this->frontcms_setting_model->get();

                    $response_message = $form['email_title']['mail_response'];
                    $record           = $this->input->post();

                    if ($record['form_name'] == 'contact_us') {
                        $email     = $this->input->post('email');
                        $name      = $this->input->post('name');
                        $cont_data = array(
                            'name'    => $name . " (" . $email . ")",
                            'source'  => 'Online',
                            'email'   => $this->input->post('email'),
                            'purpose' => $this->input->post('subject'),
                            'date'    => date('Y-m-d'),
                            'note'    => $this->input->post('description') . " (Sent from online front site)",
                        );
                        $visitor_id = $this->Visitors_model->add($cont_data);
                    }

                    if ($record['form_name'] == 'complain') {
                        $complaint_data = array(
                            'complaint_type' => 'General',
                            'source'         => 'Online',
                            'name'           => $this->input->post('name'),
                            'email'          => $this->input->post('email'),
                            'contact'        => $this->input->post('contact_no'),
                            'date'           => date('Y-m-d'),
                            'description'    => $this->input->post('description'),
                        );
                        $complaint_id = $this->complaint_Model->add($complaint_data);
                    }

                    $email_subject = $record['email_title'];
                    $mail_body     = "";
                    unset($record['email_title']);
                    unset($record['submit']);
                    foreach ($record as $fetch_k_record => $fetch_v_record) {
                        $mail_body .= ucwords($fetch_k_record) . ": " . $fetch_v_record;
                        $mail_body .= "<br/>";
                    }
                    if (!empty($setting) && $setting->contact_us_email != "") {

                        $this->mailer->send_mail($setting->contact_us_email, $email_subject, $mail_body);
                    }

                    $this->session->set_flashdata('msg', $response_message);
                    redirect('page/' . $slug, 'refresh');
                }
            }
        }

        $this->load_theme('pages/page');
    }

    public function ajaxPaginationData()
    {
        $page              = $this->input->post('page');
        $page_content_type = $this->input->post('page_content_type');
        if (!$page) {
            $offset = 0;
        } else {
            $offset = $page;
        }
        $data['page_content_type'] = $page_content_type;
        //total rows count
        $totalRec = count($this->cms_program_model->getByCategory($page_content_type));
        //pagination configuration
        $config['target']     = '#postList';
        $config['base_url']   = base_url() . 'welcome/ajaxPaginationData';
        $config['total_rows'] = $totalRec;
        $config['per_page']   = $this->perPage;
        $config['link_func']  = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        //get the posts data
        $data['category_content'] = $this->cms_program_model->getByCategory($page_content_type, array('start' => $offset, 'limit' => $this->perPage));
        //load the view
        $this->load->view('themes/default/pages/ajax-pagination-data', $data, false);
    }

    public function read($slug)
    {

        $this->data['active_menu'] = 'home';
        $page                      = $this->cms_program_model->getBySlug($slug);

        $this->data['page_side_bar']  = $page['sidebar'];
        $this->data['featured_image'] = $page['feature_image'];
        $this->data['page']           = $page;
        $this->load_theme('pages/read');
    }

    public function getSections()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $class_id = $this->input->post('class_id');
            $data     = $this->section_model->getClassBySectionAll($class_id);
            echo json_encode($data);
        }
    }

    public function admission()
    {

        if($this->module_lib->hasActive('online_admission')){
        $this->data['active_menu'] = 'home';
        $page                      = array('title' => 'Online Admission Form', 'meta_title' => 'online admission form', 'meta_keyword' => 'online admission form', 'meta_description' => 'online admission form');

        $this->data['page_side_bar']  = false;
        $this->data['featured_image'] = false;
        $this->data['page']           = $page;
        ///============
        $this->data['form_admission'] = $this->setting_model->getOnlineAdmissionStatus();

        ///////===
        $genderList               = $this->customlib->getGender();
        $this->data['genderList'] = $genderList;
        $this->data['title']      = 'Add Student';
        $this->data['title_list'] = 'Recently Added Student';

        $data["student_categorize"] = 'class';
        $session                    = $this->setting_model->getCurrentSession();
       
        $class                   = $this->class_model->getAll();
        $this->data['classlist'] = $class;
        $userdata                = $this->customlib->getUserData();

        $category                   = $this->category_model->get();
        $this->data['categorylist'] = $category;
        

        $this->form_validation->set_rules('firstname', $this->lang->line('first_name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('guardian_is', $this->lang->line('guardian'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('gender', $this->lang->line('gender'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('dob', $this->lang->line('date_of_birth'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('guardian_name', $this->lang->line('guardian_name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('guardian_phone', $this->lang->line('guardian_phone'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {

            $this->load_theme('pages/admission');
        } else {
            //==============
            $document_validate = true;
            $image_validate    = $this->config->item('file_validate');

            if (isset($_FILES["document"]) && !empty($_FILES['document']['name'])) {

                $file_type         = $_FILES["document"]['type'];
                $file_size         = $_FILES["document"]["size"];
                $file_name         = $_FILES["document"]["name"];
                $allowed_extension = $image_validate['allowed_extension'];
                $ext               = pathinfo($file_name, PATHINFO_EXTENSION);
                $allowed_mime_type = $image_validate['allowed_mime_type'];
                if ($files = filesize($_FILES['document']['tmp_name'])) {
                  
                    if (!in_array($file_type, $allowed_mime_type)) {
                        $this->data['error_message'] = 'File Type Not Allowed';
                        $document_validate           = false;
                    }

                    if (!in_array($ext, $allowed_extension) || !in_array($file_type, $allowed_mime_type)) {
                        $this->data['error_message'] = 'Extension Not Allowed';
                        $document_validate           = false;
                    }
                    if ($file_size > $image_validate['upload_size']) {
                        $this->data['error_message'] = 'File should be less than' . number_format($image_validate['upload_size'] / 1048576, 2) . " MB";
                        $document_validate           = false;
                    }
                }
            }
            //=====================
            if ($document_validate) {

                $class_id   = $this->input->post('class_id');
                $section_id = $this->input->post('section_id');

                $data = array(
                    'roll_no'             => $this->input->post('roll_no'),                   
                    'firstname'           => $this->input->post('firstname'),
                    'lastname'            => $this->input->post('lastname'),
                    'mobileno'            => $this->input->post('mobileno'),
                    'class_section_id'    => $this->input->post('section_id'),
                    'guardian_is'         => $this->input->post('guardian_is'),
                    'dob'                 => date('Y-m-d', strtotime($this->input->post('dob'))),
                    'current_address'     => $this->input->post('current_address'),
                    'permanent_address'   => $this->input->post('permanent_address'),
                    'father_name'         => $this->input->post('father_name'),
                    'father_phone'        => $this->input->post('father_phone'),
                    'father_occupation'   => $this->input->post('father_occupation'),
                    'mother_name'         => $this->input->post('mother_name'),
                    'mother_phone'        => $this->input->post('mother_phone'),
                    'mother_occupation'   => $this->input->post('mother_occupation'),
                    'guardian_occupation' => $this->input->post('guardian_occupation'),
                    'guardian_email'      => $this->input->post('guardian_email'),
                    'gender'              => $this->input->post('gender'),
                    'guardian_name'       => $this->input->post('guardian_name'),
                    'guardian_relation'   => $this->input->post('guardian_relation'),
                    'guardian_phone'      => $this->input->post('guardian_phone'),
                    'guardian_address'    => $this->input->post('guardian_address'),
                    'admission_date'=>date('Y/m/d'),
                    'measurement_date'=>date('Y/m/d'),
                );
                if (isset($_FILES["document"]) && !empty($_FILES['document']['name'])) {
                    $time     = md5($_FILES["document"]['name'] . microtime());
                    $fileInfo = pathinfo($_FILES["document"]["name"]);
                    $doc_name = $time . '.' . $fileInfo['extension'];
                    move_uploaded_file($_FILES["document"]["tmp_name"], "./uploads/student_documents/online_admission_doc/" . $doc_name);

                    $data['document'] = $doc_name;
                }

                $insert_id = $this->onlinestudent_model->add($data);

                $this->session->set_flashdata('msg', '<div class="alert alert-success">' . $this->lang->line('success_message') . '</div>');

                redirect($_SERVER['HTTP_REFERER'], 'refresh');
            }

            $this->load_theme('pages/admission');
        }

        }
    }

}
