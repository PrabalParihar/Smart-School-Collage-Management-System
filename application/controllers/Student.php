<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
} 

class Student extends Admin_Controller
{

    public $sch_setting_detail = array();

    public function __construct()
    {
        parent::__construct();
        $this->config->load('app-config');
        $this->load->library('smsgateway');
        $this->load->library('mailsmsconf');
        $this->load->library('encoding_lib');
        $this->load->model("classteacher_model");
        $this->load->model("timeline_model");
        $this->blood_group        = $this->config->item('bloodgroup');
        $this->sch_setting_detail = $this->setting_model->getSetting();
        $this->role;
    }

    public function index()
    {

        $data['title']       = 'Student List';
        $student_result      = $this->student_model->get();
        $data['studentlist'] = $student_result;
        $this->load->view('layout/header', $data);
        $this->load->view('student/studentList', $data);
        $this->load->view('layout/footer', $data);
    }

    public function multiclass()
    {
        if (!$this->rbac->hasPrivilege('multi_class_student', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Student Information');
        $this->session->set_userdata('sub_menu', 'student/multiclass');
        $data['title']     = 'student fees';
        $data['title']     = 'student fees';
        $class             = $this->class_model->get();
        $data['classlist'] = $class;

        $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {

        } else {
            $class                   = $this->class_model->get();
            $data['classlist']       = $class;
            $data['student_due_fee'] = array();
            $class_id                = $this->input->post('class_id');
            $section_id              = $this->input->post('section_id');
            $classes                 = $this->classsection_model->allClassSections();

            $data['classes'] = $classes;

            $students         = $this->studentsession_model->searchMultiStudentByClassSection($class_id, $section_id);
            $data['students'] = $students;
        }
        $this->load->view('layout/header', $data);
        $this->load->view('student/multiclass', $data);
        $this->load->view('layout/footer', $data);
    }

    public function studentreport()
    {
        if (!$this->rbac->hasPrivilege('student_report', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/student_information');
        $this->session->set_userdata('subsub_menu', 'Reports/student_information/student_report');

        $data['title']           = 'student fee';
        $data['title']           = 'student fee';
        $genderList              = $this->customlib->getGender();
        $data['genderList']      = $genderList;
        $RTEstatusList           = $this->customlib->getRteStatus();
        $data['RTEstatusList']   = $RTEstatusList;
        $class                   = $this->class_model->get();
        $data['classlist']       = $class;
        $data['sch_setting']     = $this->sch_setting_detail;
        $data['adm_auto_insert'] = $this->sch_setting_detail->adm_auto_insert;
        $userdata                = $this->customlib->getUserData();
        $carray                  = array();

        if (!empty($data["classlist"])) {
            foreach ($data["classlist"] as $ckey => $cvalue) {

                $carray[] = $cvalue["id"];
            }
        }

        $category             = $this->category_model->get();
        $data['categorylist'] = $category;
        if ($this->input->server('REQUEST_METHOD') == "GET") {
            $this->load->view('layout/header', $data);
            $this->load->view('student/studentReport', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
            if ($this->form_validation->run() == false) {
                $this->load->view('layout/header', $data);
                $this->load->view('student/studentReport', $data);
                $this->load->view('layout/footer', $data);
            } else {
                $class       = $this->input->post('class_id');
                $section     = $this->input->post('section_id');
                $category_id = $this->input->post('category_id');
                $gender      = $this->input->post('gender');
                $rte         = $this->input->post('rte');
                $search      = $this->input->post('search');
                if (isset($search)) {
                    if ($search == 'search_filter') {
                        $resultlist         = $this->student_model->searchByClassSectionCategoryGenderRte($class, $section, $category_id, $gender, $rte);
                        $data['resultlist'] = $resultlist;
                    }
                    $data['class_id']    = $class;
                    $data['section_id']  = $section;
                    $data['category_id'] = $category_id;
                    $data['gender']      = $gender;
                    $data['rte_status']  = $rte;
                    $this->load->view('layout/header', $data);
                    $this->load->view('student/studentReport', $data);
                    $this->load->view('layout/footer', $data);
                }
            }
        }
    }

    public function download($student_id, $doc)
    {
        $this->load->helper('download');
        $filepath = "./uploads/student_documents/$student_id/" . $this->uri->segment(4);
        $data     = file_get_contents($filepath);
        $name     = $this->uri->segment(6);
        force_download($name, $data);
    }

    public function view($id)
    {

        if (!$this->rbac->hasPrivilege('student', 'can_view')) {
            access_denied();
        }

        $data['title']         = 'Student Details';
        $student               = $this->student_model->get($id);
        $gradeList             = $this->grade_model->get();
        $studentSession        = $this->student_model->getStudentSession($id);
        $timeline              = $this->timeline_model->getStudentTimeline($id, $status = '');
        $data["timeline_list"] = $timeline;

        $student_session_id = $studentSession["student_session_id"];

        $student_session         = $studentSession["session"];
        $data['sch_setting']     = $this->sch_setting_detail;
        $data['adm_auto_insert'] = $this->sch_setting_detail->adm_auto_insert;
        $current_student_session = $this->student_model->get_studentsession($student['student_session_id']);

        $data["session"]              = $current_student_session["session"];
        $student_due_fee              = $this->studentfeemaster_model->getStudentFees($student['student_session_id']);
        $student_discount_fee         = $this->feediscount_model->getStudentFeesDiscount($student['student_session_id']);
        $data['student_discount_fee'] = $student_discount_fee;
        $data['student_due_fee']      = $student_due_fee;
        $siblings                     = $this->student_model->getMySiblings($student['parent_id'], $student['id']);

        $student_doc            = $this->student_model->getstudentdoc($id);

        $data['student_doc']    = $student_doc;
        $data['student_doc_id'] = $id;
        $category_list          = $this->category_model->get();
        $data['category_list']  = $category_list;
        $data['gradeList']      = $gradeList;
        $data['student']        = $student;
        $data['siblings']       = $siblings;
        $class_section          = $this->student_model->getClassSection($student["class_id"]);
        $data["class_section"]  = $class_section;
        $session                = $this->setting_model->getCurrentSession();

        $studentlistbysection         = $this->student_model->getStudentClassSection($student["class_id"], $session);
        $data["studentlistbysection"] = $studentlistbysection;

        $data['guardian_credential'] = $this->student_model->guardian_credential($student['parent_id']);

        $data['reason'] = $this->disable_reason_model->get();
        if ($student['is_active'] = 'no') {
            $data['reason_data'] = $this->disable_reason_model->get($student['dis_reason']);
        }

        

        $this->load->view('layout/header', $data);
        $this->load->view('student/studentShow', $data);
        $this->load->view('layout/footer', $data);
    }

    public function exportformat()
    {
        $this->load->helper('download');
        $filepath = "./backend/import/import_student_sample_file.csv";
        $data     = file_get_contents($filepath);
        $name     = 'import_student_sample_file.csv';

        force_download($name, $data);
    }

    public function delete($id)
    {
        if (!$this->rbac->hasPrivilege('student', 'can_delete')) {
            access_denied();
        }
        $this->student_model->remove($id);
        $this->session->set_flashdata('msg', '<i class="fa fa-check-square-o" aria-hidden="true"></i> ' . $this->lang->line('delete_message') . '');
        redirect('student/search');
    }

    public function doc_delete($id, $student_id)
    {
        $this->student_model->doc_delete($id);
        $this->session->set_flashdata('msg', '<i class="fa fa-check-square-o" aria-hidden="true"></i> ' . $this->lang->line('delete_message') . '');
        redirect('student/view/' . $student_id);
    }

    public function create()
    {
        if (!$this->rbac->hasPrivilege('student', 'can_add')) {
            access_denied();
        }
       
        $this->session->set_userdata('top_menu', 'Student Information');
        $this->session->set_userdata('sub_menu', 'student/create');
        $genderList                 = $this->customlib->getGender();
        $data['genderList']         = $genderList;
        $data['sch_setting']        = $this->sch_setting_detail;
        $data['title']              = 'Add Student';
        $data['title_list']         = 'Recently Added Student';
        $data['adm_auto_insert']    = $this->sch_setting_detail->adm_auto_insert;
        $data["student_categorize"] = 'class';
        $session                    = $this->setting_model->getCurrentSession();
        $student_result             = $this->student_model->getRecentRecord();
        $data['studentlist']        = $student_result;
        $class                      = $this->class_model->get('', $classteacher = 'yes');
        $data['classlist']          = $class;
        $userdata                   = $this->customlib->getUserData();
        $category                   = $this->category_model->get();
        $data['categorylist']       = $category;
        $houses                     = $this->student_model->gethouselist();
        $data['houses']             = $houses;
        $data["bloodgroup"]         = $this->blood_group;
        $hostelList                 = $this->hostel_model->get();
        $data['hostelList']         = $hostelList;
        $vehroute_result            = $this->vehroute_model->get();
        $data['vehroutelist']       = $vehroute_result;
        $custom_fields              = $this->customfield_model->getByBelong('students');

        foreach ($custom_fields as $custom_fields_key => $custom_fields_value) {
            if ($custom_fields_value['validation']) {
                $custom_fields_id   = $custom_fields_value['id'];
                $custom_fields_name = $custom_fields_value['name'];
                $this->form_validation->set_rules("custom_fields[students][" . $custom_fields_id . "]", $custom_fields_name, 'trim|required');
            }
        }
 
        $this->form_validation->set_rules('firstname', $this->lang->line('first_name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('guardian_is', $this->lang->line('guardian'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('gender', $this->lang->line('gender'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('dob', $this->lang->line('date_of_birth'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');

        // $this->form_validation->set_rules('rte', $this->lang->line('rtl'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('guardian_name', $this->lang->line('guardian_name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('guardian_phone', $this->lang->line('guardian_phone'), 'trim|required|xss_clean');

        if (!$this->sch_setting_detail->adm_auto_insert) {

            $this->form_validation->set_rules('admission_no', $this->lang->line('admission_no'), 'trim|required|xss_clean|is_unique[students.admission_no]');
        }
        $this->form_validation->set_rules('file', $this->lang->line('image'), 'callback_handle_upload');
        $this->form_validation->set_rules(
            'roll_no', $this->lang->line('roll_no'), array('trim',
                array('check_exists', array($this->student_model, 'valid_student_roll')),
            )
        );

        if ($this->form_validation->run() == false) {

            $this->load->view('layout/header', $data);
            $this->load->view('student/studentCreate', $data);
            $this->load->view('layout/footer', $data);
        } else {

            $custom_field_post  = $this->input->post("custom_fields[students]");
            $custom_value_array = array();
            if (!empty($custom_field_post)) {

                foreach ($custom_field_post as $key => $value) {
                    $check_field_type = $this->input->post("custom_fields[students][" . $key . "]");
                    $field_value      = is_array($check_field_type) ? implode(",", $check_field_type) : $check_field_type;
                    $array_custom     = array(
                        'belong_table_id' => 0,
                        'custom_field_id' => $key,
                        'field_value'     => $field_value,
                    );
                    $custom_value_array[] = $array_custom;
                }
            }

            $class_id   = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');

            $fees_discount = $this->input->post('fees_discount');

            $vehroute_id    = $this->input->post('vehroute_id');
            $hostel_room_id = $this->input->post('hostel_room_id');
            if (empty($vehroute_id)) {
                $vehroute_id = 0;
            }
            if (empty($hostel_room_id)) {
                $hostel_room_id = 0;
            }

            $data_insert = array(
                'firstname'           => $this->input->post('firstname'),
                'rte'                 => $this->input->post('rte'),
                'state'               => $this->input->post('state'),
                'city'                => $this->input->post('city'),
                'guardian_is'         => $this->input->post('guardian_is'),
                'pincode'             => $this->input->post('pincode'),
                'cast'                => $this->input->post('cast'),
                'previous_school'     => $this->input->post('previous_school'),
                'dob'                 => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('dob'))),
                'current_address'     => $this->input->post('current_address'),
                'permanent_address'   => $this->input->post('permanent_address'),
                'image'               => 'uploads/student_images/no_image.png',
                'adhar_no'            => $this->input->post('adhar_no'),
                'samagra_id'          => $this->input->post('samagra_id'),
                'bank_account_no'     => $this->input->post('bank_account_no'),
                'bank_name'           => $this->input->post('bank_name'),
                'ifsc_code'           => $this->input->post('ifsc_code'),
                'guardian_occupation' => $this->input->post('guardian_occupation'),
                'guardian_email'      => $this->input->post('guardian_email'),
                'gender'              => $this->input->post('gender'),
                'guardian_name'       => $this->input->post('guardian_name'),
                'guardian_relation'   => $this->input->post('guardian_relation'),
                'guardian_phone'      => $this->input->post('guardian_phone'),
                'guardian_address'    => $this->input->post('guardian_address'),
                'vehroute_id'         => $vehroute_id,
                'hostel_room_id'      => $hostel_room_id,
                'note'                => $this->input->post('note'),
                'is_active'           => 'yes',
            );
            $house            = $this->input->post('house');
            $blood_group      = $this->input->post('blood_group');
            $measurement_date = $this->input->post('measure_date');

            $roll_no           = $this->input->post('roll_no');
            $lastname          = $this->input->post('lastname');
            $category_id       = $this->input->post('category_id');
            $religion          = $this->input->post('religion');
            $mobileno          = $this->input->post('mobileno');
            $email             = $this->input->post('email');
            $admission_date    = $this->input->post('admission_date');
            $height            = $this->input->post('height');
            $weight            = $this->input->post('weight');
            $father_name       = $this->input->post('father_name');
            $father_phone      = $this->input->post('father_phone');
            $father_occupation = $this->input->post('father_occupation');
            $mother_name       = $this->input->post('mother_name');
            $mother_phone      = $this->input->post('mother_phone');
            $mother_occupation = $this->input->post('mother_occupation');

            if (isset($measurement_date)) {
                $data_insert['measurement_date'] = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('measure_date')));
            }

            if (isset($house)) {
                $data_insert['school_house_id'] = $this->input->post('house');
            }
            if (isset($blood_group)) {

                $data_insert['blood_group'] = $this->input->post('blood_group');
            }

            if (isset($roll_no)) {

                $data_insert['roll_no'] = $this->input->post('roll_no');
            }

            if (isset($lastname)) {

                $data_insert['lastname'] = $this->input->post('lastname');
            }

            if (isset($category_id)) {

                $data_insert['category_id'] = $this->input->post('category_id');
            }

            if (isset($religion)) {

                $data_insert['religion'] = $this->input->post('religion');
            }

            if (isset($mobileno)) {

                $data_insert['mobileno'] = $this->input->post('mobileno');
            }

            if (isset($email)) {

                $data_insert['email'] = $this->input->post('email');
            }

            if (isset($admission_date)) {

                $data_insert['admission_date'] = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('admission_date')));
            }

            if (isset($height)) {

                $data_insert['height'] = $this->input->post('height');
            }

            if (isset($weight)) {

                $data_insert['weight'] = $this->input->post('weight');
            }

            if (isset($father_name)) {

                $data_insert['father_name'] = $this->input->post('father_name');
            }

            if (isset($father_phone)) {

                $data_insert['father_phone'] = $this->input->post('father_phone');
            }

            if (isset($father_occupation)) {

                $data_insert['father_occupation'] = $this->input->post('father_occupation');
            }

            if (isset($mother_name)) {

                $data_insert['mother_name'] = $this->input->post('mother_name');
            }

            if (isset($mother_phone)) {

                $data_insert['mother_phone'] = $this->input->post('mother_phone');
            }

            if (isset($mother_occupation)) {

                $data_insert['mother_occupation'] = $this->input->post('mother_occupation');
            }

            $insert                            = true;
            $data_setting                      = array();
            $data_setting['id']                = $this->sch_setting_detail->id;
            $data_setting['adm_auto_insert']   = $this->sch_setting_detail->adm_auto_insert;
            $data_setting['adm_update_status'] = $this->sch_setting_detail->adm_update_status;
            $admission_no                      = 0;

            if ($this->sch_setting_detail->adm_auto_insert) {
                if ($this->sch_setting_detail->adm_update_status) {

                    $admission_no = $this->sch_setting_detail->adm_prefix . $this->sch_setting_detail->adm_start_from;

                    $last_student         = $this->student_model->lastRecord();
                    $last_admission_digit = str_replace($this->sch_setting_detail->adm_prefix, "", $last_student->admission_no);

                    $admission_no         = $this->sch_setting_detail->adm_prefix . sprintf("%0" . $this->sch_setting_detail->adm_no_digit . "d", $last_admission_digit + 1);
                    $data_insert['admission_no'] = $admission_no;
                } else {
                    $admission_no         = $this->sch_setting_detail->adm_prefix . $this->sch_setting_detail->adm_start_from;
                    $data_insert['admission_no'] = $admission_no;
                }

                $admission_no_exists = $this->student_model->check_adm_exists($admission_no);
                if ($admission_no_exists) {
                    $insert = false;
                }
            } else {
                $data_insert['admission_no'] = $this->input->post('admission_no');
            }
            if ($insert) {
                $insert_id = $this->student_model->add($data_insert, $data_setting);
                if (!empty($custom_value_array)) {
                    $this->customfield_model->insertRecord($custom_value_array, $insert_id);
                }
                $data_new = array(
                    'student_id'    => $insert_id,
                    'class_id'      => $class_id,
                    'section_id'    => $section_id,
                    'session_id'    => $session,
                    'fees_discount' => $fees_discount,
                );
                $this->student_model->add_student_session($data_new);
                $user_password      = $this->role->get_random_password($chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false);
                $sibling_id         = $this->input->post('sibling_id');
                $data_student_login = array(
                    'username' => $this->student_login_prefix . $insert_id,
                    'password' => $user_password,
                    'user_id'  => $insert_id,
                    'role'     => 'student',
                );

                $this->user_model->add($data_student_login);

                if ($sibling_id > 0) {
                    $student_sibling = $this->student_model->get($sibling_id);
                    $update_student  = array(
                        'id'        => $insert_id,
                        'parent_id' => $student_sibling['parent_id'],
                    );
                    $student_sibling = $this->student_model->add($update_student);
                } else {
                    $parent_password   = $this->role->get_random_password($chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false);
                    $temp              = $insert_id;
                    $data_parent_login = array(
                        'username' => $this->parent_login_prefix . $insert_id,
                        'password' => $parent_password,
                        'user_id'  => 0,
                        'role'     => 'parent',
                        'childs'   => $temp,
                    );
                    $ins_parent_id  = $this->user_model->add($data_parent_login);
                    $update_student = array(
                        'id'        => $insert_id,
                        'parent_id' => $ins_parent_id,
                    );
                    $this->student_model->add($update_student);
                }

                if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                    $fileInfo = pathinfo($_FILES["file"]["name"]);
                    $img_name = $insert_id . '.' . $fileInfo['extension'];
                    move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/student_images/" . $img_name);
                    $data_img = array('id' => $insert_id, 'image' => 'uploads/student_images/' . $img_name);
                    $this->student_model->add($data_img);
                }

                if (isset($_FILES["father_pic"]) && !empty($_FILES['father_pic']['name'])) {
                    $fileInfo = pathinfo($_FILES["father_pic"]["name"]);
                    $img_name = $insert_id . "father" . '.' . $fileInfo['extension'];
                    move_uploaded_file($_FILES["father_pic"]["tmp_name"], "./uploads/student_images/" . $img_name);
                    $data_img = array('id' => $insert_id, 'father_pic' => 'uploads/student_images/' . $img_name);
                    $this->student_model->add($data_img);
                }
                if (isset($_FILES["mother_pic"]) && !empty($_FILES['mother_pic']['name'])) {
                    $fileInfo = pathinfo($_FILES["mother_pic"]["name"]);
                    $img_name = $insert_id . "mother" . '.' . $fileInfo['extension'];
                    move_uploaded_file($_FILES["mother_pic"]["tmp_name"], "./uploads/student_images/" . $img_name);
                    $data_img = array('id' => $insert_id, 'mother_pic' => 'uploads/student_images/' . $img_name);
                    $this->student_model->add($data_img);
                }

                if (isset($_FILES["guardian_pic"]) && !empty($_FILES['guardian_pic']['name'])) {
                    $fileInfo = pathinfo($_FILES["guardian_pic"]["name"]);
                    $img_name = $insert_id . "guardian" . '.' . $fileInfo['extension'];
                    move_uploaded_file($_FILES["guardian_pic"]["tmp_name"], "./uploads/student_images/" . $img_name);
                    $data_img = array('id' => $insert_id, 'guardian_pic' => 'uploads/student_images/' . $img_name);
                    $this->student_model->add($data_img);
                }

                if (isset($_FILES["first_doc"]) && !empty($_FILES['first_doc']['name'])) {
                    $uploaddir = './uploads/student_documents/' . $insert_id . '/';
                    if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
                        die("Error creating folder $uploaddir");
                    }
                    $fileInfo    = pathinfo($_FILES["first_doc"]["name"]);
                    $first_title = $this->input->post('first_title');
                    $file_name   = $_FILES['first_doc']['name'];
                    $exp         = explode(' ', $file_name);
                    $imp         = implode('_', $exp);
                    $img_name    = $uploaddir . $imp;
                    move_uploaded_file($_FILES["first_doc"]["tmp_name"], $img_name);
                    $data_img = array('student_id' => $insert_id, 'title' => $first_title, 'doc' => $imp);
                    $this->student_model->adddoc($data_img);
                }
                if (isset($_FILES["second_doc"]) && !empty($_FILES['second_doc']['name'])) {
                    $uploaddir = './uploads/student_documents/' . $insert_id . '/';
                    if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
                        die("Error creating folder $uploaddir");
                    }
                    $fileInfo     = pathinfo($_FILES["second_doc"]["name"]);
                    $second_title = $this->input->post('second_title');
                    $file_name    = $_FILES['second_doc']['name'];
                    $exp          = explode(' ', $file_name);
                    $imp          = implode('_', $exp);
                    $img_name     = $uploaddir . $imp;
                    move_uploaded_file($_FILES["second_doc"]["tmp_name"], $img_name);
                    $data_img = array('student_id' => $insert_id, 'title' => $second_title, 'doc' => $imp);
                    $this->student_model->adddoc($data_img);
                }

                if (isset($_FILES["fourth_doc"]) && !empty($_FILES['fourth_doc']['name'])) {
                    $uploaddir = './uploads/student_documents/' . $insert_id . '/';
                    if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
                        die("Error creating folder $uploaddir");
                    }
                    $fileInfo     = pathinfo($_FILES["fourth_doc"]["name"]);
                    $fourth_title = $this->input->post('fourth_title');
                    $file_name    = $_FILES['fourth_doc']['name'];
                    $exp          = explode(' ', $file_name);
                    $imp          = implode('_', $exp);
                    $img_name     = $uploaddir . $imp;
                    move_uploaded_file($_FILES["fourth_doc"]["tmp_name"], $img_name);
                    $data_img = array('student_id' => $insert_id, 'title' => $fourth_title, 'doc' => $imp);
                    $this->student_model->adddoc($data_img);
                }
                if (isset($_FILES["fifth_doc"]) && !empty($_FILES['fifth_doc']['name'])) {
                    $uploaddir = './uploads/student_documents/' . $insert_id . '/';
                    if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
                        die("Error creating folder $uploaddir");
                    }
                    $fileInfo    = pathinfo($_FILES["fifth_doc"]["name"]);
                    $fifth_title = $this->input->post('fifth_title');
                    $file_name   = $_FILES['fifth_doc']['name'];
                    $exp         = explode(' ', $file_name);
                    $imp         = implode('_', $exp);
                    $img_name    = $uploaddir . $imp;

                    move_uploaded_file($_FILES["fifth_doc"]["tmp_name"], $img_name);
                    $data_img = array('student_id' => $insert_id, 'title' => $fifth_title, 'doc' => $imp);
                    $this->student_model->adddoc($data_img);
                }
                $sender_details = array('student_id' => $insert_id, 'contact_no' => $this->input->post('guardian_phone'), 'email' => $this->input->post('guardian_email'));
                $this->mailsmsconf->mailsms('student_admission', $sender_details);

                $student_login_detail = array('id' => $insert_id, 'credential_for' => 'student', 'username' => $this->student_login_prefix . $insert_id, 'password' => $user_password, 'contact_no' => $this->input->post('mobileno'), 'email' => $this->input->post('email'));
                $this->mailsmsconf->mailsms('login_credential', $student_login_detail);

                if ($sibling_id > 0) {

                } else {
                    $parent_login_detail = array('id' => $insert_id, 'credential_for' => 'parent', 'username' => $this->parent_login_prefix . $insert_id, 'password' => $parent_password, 'contact_no' => $this->input->post('guardian_phone'), 'email' => $this->input->post('guardian_email'));
                    $this->mailsmsconf->mailsms('login_credential', $parent_login_detail);
                }

                $this->session->set_flashdata('msg', '<div class="alert alert-success">' . $this->lang->line('success_message') . '</div>');
                redirect('student/create');
            } else {

                $data['error_message'] = $this->lang->line('admission_no') . ' ' . $admission_no . ' ' . $this->lang->line('already_exists');
                $this->load->view('layout/header', $data);
                $this->load->view('student/studentCreate', $data);
                $this->load->view('layout/footer', $data);
            }
        }
    }
  
    public function create_doc()
    {

        $this->form_validation->set_rules('first_title', $this->lang->line('title'), 'trim|required|xss_clean');
          $this->form_validation->set_rules('first_doc', $this->lang->line('document'), 'callback_handle_uploadcreate_doc');

        if ($this->form_validation->run() == false) {
            $msg = array(
                'first_title'              => form_error('first_title'),
                'first_doc'              => form_error('first_doc')              
            );
            $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
        } else {
            $student_id = $this->input->post('student_id');
        if (isset($_FILES["first_doc"]) && !empty($_FILES['first_doc']['name'])) {
            $uploaddir = './uploads/student_documents/' . $student_id . '/';
            if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
                die("Error creating folder $uploaddir");
            }
            
            $fileInfo    = pathinfo($_FILES["first_doc"]["name"]);
            $first_title = $this->input->post('first_title');
            $file_name   = $_FILES['first_doc']['name'];
            $exp         = explode(' ', $file_name);
            $imp         = implode('_', $exp);
            $img_name    = $uploaddir . basename($imp);
            move_uploaded_file($_FILES["first_doc"]["tmp_name"], $img_name);
            $data_img = array('student_id' => $student_id, 'title' => $first_title, 'doc' => $imp);
            $this->student_model->adddoc($data_img);

        }

       $msg   = $this->lang->line('success_message');
            $array = array('status' => 'success', 'error' => '', 'message' => $msg);
        
        }
        echo json_encode($array);


       
    }

public function handle_uploadcreate_doc()
    {

        $image_validate = $this->config->item('file_validate');
      
        if (isset($_FILES["first_doc"]) && !empty($_FILES['first_doc']['name'])) {

            $file_type         = $_FILES["first_doc"]['type'];
            $file_size         = $_FILES["first_doc"]["size"];
            $file_name         = $_FILES["first_doc"]["name"];
            $allowed_extension = $image_validate['allowed_extension'];
            $ext               = pathinfo($file_name, PATHINFO_EXTENSION);
            $allowed_mime_type = $image_validate['allowed_mime_type'];
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mtype = finfo_file($finfo, $_FILES['first_doc']['tmp_name']);
            finfo_close($finfo);


                if (!in_array($mtype, $allowed_mime_type)) {
                    $this->form_validation->set_message('handle_uploadcreate_doc', 'File Type Not Allowed');
                    return false;
                }

                if (!in_array($ext, $allowed_extension) || !in_array($file_type, $allowed_mime_type)) {
                    $this->form_validation->set_message('handle_uploadcreate_doc', 'Extension Not Allowed');
                    return false;
                }
                if ($file_size > $image_validate['upload_size']) {
                    $this->form_validation->set_message('handle_uploadcreate_doc', $this->lang->line('file_size_shoud_be_less_than') . number_format($image_validate['upload_size'] / 1048576, 2) . " MB");
                    return false;
                }
     

            return true;
        }else{
            $this->form_validation->set_message('handle_uploadcreate_doc', "The File Field is required");
                return false;
        }
        return true;
    }

    public function handle_upload()
    {

        $image_validate = $this->config->item('image_validate');

        if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {

            $file_type         = $_FILES["file"]['type'];
            $file_size         = $_FILES["file"]["size"];
            $file_name         = $_FILES["file"]["name"];
            $allowed_extension = $image_validate['allowed_extension'];
            $ext               = pathinfo($file_name, PATHINFO_EXTENSION);
            $allowed_mime_type = $image_validate['allowed_mime_type'];
            if ($files = @getimagesize($_FILES['file']['tmp_name'])) {

                if (!in_array($files['mime'], $allowed_mime_type)) {
                    $this->form_validation->set_message('handle_upload', 'File Type Not Allowed');
                    return false;
                }

                if (!in_array($ext, $allowed_extension) || !in_array($file_type, $allowed_mime_type)) {
                    $this->form_validation->set_message('handle_upload', 'Extension Not Allowed');
                    return false;
                }
                if ($file_size > $image_validate['upload_size']) {
                    $this->form_validation->set_message('handle_upload', $this->lang->line('file_size_shoud_be_less_than') . number_format($image_validate['upload_size'] / 1048576, 2) . " MB");
                    return false;
                }
            } else {
                $this->form_validation->set_message('handle_upload', "File Type / Extension Error Uploading  Image");
                return false;
            }

            return true;
        }
        return true;
    }

    public function handle_father_upload()
    {

        $image_validate = $this->config->item('image_validate');

        if (isset($_FILES["father_pic"]) && !empty($_FILES['father_pic']['name'])) {

            $file_type         = $_FILES["father_pic"]['type'];
            $file_size         = $_FILES["father_pic"]["size"];
            $file_name         = $_FILES["father_pic"]["name"];
            $allowed_extension = $image_validate['allowed_extension'];
            $ext               = pathinfo($file_name, PATHINFO_EXTENSION);
            $allowed_mime_type = $image_validate['allowed_mime_type'];
            if ($files = @getimagesize($_FILES['father_pic']['tmp_name'])) {

                if (!in_array($files['mime'], $allowed_mime_type)) {
                    $this->form_validation->set_message('handle_father_upload', 'File Type Not Allowed');
                    return false;
                }

                if (!in_array($ext, $allowed_extension) || !in_array($file_type, $allowed_mime_type)) {
                    $this->form_validation->set_message('handle_father_upload', 'Extension Not Allowed');
                    return false;
                }
                if ($file_size > $image_validate['upload_size']) {
                    $this->form_validation->set_message('handle_father_upload', $this->lang->line('file_size_shoud_be_less_than') . number_format($image_validate['upload_size'] / 1048576, 2) . " MB");
                    return false;
                }
            } else {
                $this->form_validation->set_message('handle_father_upload', "File Type / Extension Error Uploading  Image");
                return false;
            }

            return true;
        }
        return true;
    }

    public function handle_mother_upload()
    {

        $image_validate = $this->config->item('image_validate');

        if (isset($_FILES["mother_pic"]) && !empty($_FILES['mother_pic']['name'])) {

            $file_type         = $_FILES["mother_pic"]['type'];
            $file_size         = $_FILES["mother_pic"]["size"];
            $file_name         = $_FILES["mother_pic"]["name"];
            $allowed_extension = $image_validate['allowed_extension'];
            $ext               = pathinfo($file_name, PATHINFO_EXTENSION);
            $allowed_mime_type = $image_validate['allowed_mime_type'];
            if ($files = @getimagesize($_FILES['mother_pic']['tmp_name'])) {

                if (!in_array($files['mime'], $allowed_mime_type)) {
                    $this->form_validation->set_message('handle_mother_upload', 'File Type Not Allowed');
                    return false;
                }

                if (!in_array($ext, $allowed_extension) || !in_array($file_type, $allowed_mime_type)) {
                    $this->form_validation->set_message('handle_mother_upload', 'Extension Not Allowed');
                    return false;
                }
                if ($file_size > $image_validate['upload_size']) {
                    $this->form_validation->set_message('handle_mother_upload', $this->lang->line('file_size_shoud_be_less_than') . number_format($image_validate['upload_size'] / 1048576, 2) . " MB");
                    return false;
                }
            } else {
                $this->form_validation->set_message('handle_mother_upload', "File Type / Extension Error Uploading  Image");
                return false;
            }

            return true;
        }
        return true;
    }

    public function handle_guardian_upload()
    {

        $image_validate = $this->config->item('image_validate');

        if (isset($_FILES["guardian_pic"]) && !empty($_FILES['guardian_pic']['name'])) {

            $file_type         = $_FILES["guardian_pic"]['type'];
            $file_size         = $_FILES["guardian_pic"]["size"];
            $file_name         = $_FILES["guardian_pic"]["name"];
            $allowed_extension = $image_validate['allowed_extension'];
            $ext               = pathinfo($file_name, PATHINFO_EXTENSION);
            $allowed_mime_type = $image_validate['allowed_mime_type'];
            if ($files = @getimagesize($_FILES['guardian_pic']['tmp_name'])) {

                if (!in_array($files['mime'], $allowed_mime_type)) {
                    $this->form_validation->set_message('handle_guardian_upload', 'File Type Not Allowed');
                    return false;
                }

                if (!in_array($ext, $allowed_extension) || !in_array($file_type, $allowed_mime_type)) {
                    $this->form_validation->set_message('handle_guardian_upload', 'Extension Not Allowed');
                    return false;
                }
                if ($file_size > $image_validate['upload_size']) {
                    $this->form_validation->set_message('handle_guardian_upload', $this->lang->line('file_size_shoud_be_less_than') . number_format($image_validate['upload_size'] / 1048576, 2) . " MB");
                    return false;
                }
            } else {
                $this->form_validation->set_message('handle_guardian_upload', "File Type / Extension Error Uploading  Image");
                return false;
            }

            return true;
        }
        return true;
    }

    public function sendpassword()
    {

        $student_login_detail = array('id' => $this->input->post('student_id'), 'credential_for' => 'student', 'username' => $this->input->post('username'), 'password' => $this->input->post('password'), 'contact_no' => $this->input->post('contact_no'), 'email' => $this->input->post('email'));

        $msg = $this->mailsmsconf->mailsms('login_credential', $student_login_detail);
    }

    public function send_parent_password()
    {
        $parent_login_detail = array('id' => $this->input->post('student_id'), 'credential_for' => 'parent', 'username' => $this->input->post('username'), 'password' => $this->input->post('password'), 'contact_no' => $this->input->post('contact_no'), 'email' => $this->input->post('email'));

        $msg = $this->mailsmsconf->mailsms('login_credential', $parent_login_detail);
    }

    public function import()
    {
        if (!$this->rbac->hasPrivilege('import_student', 'can_view')) {
            access_denied();
        }
        $data['title']      = 'Import Student';
        $data['title_list'] = 'Recently Added Student';
        $session            = $this->setting_model->getCurrentSession();
        $class              = $this->class_model->get('', $classteacher = 'yes');
        $data['classlist']  = $class;
        $userdata           = $this->customlib->getUserData();

        $category = $this->category_model->get();

        $fields = array('admission_no', 'roll_no', 'firstname', 'lastname', 'gender', 'dob', 'category_id', 'religion', 'cast', 'mobileno', 'email', 'admission_date', 'blood_group', 'school_house_id', 'height', 'weight', 'measurement_date', 'father_name', 'father_phone', 'father_occupation', 'mother_name', 'mother_phone', 'mother_occupation', 'guardian_is', 'guardian_name', 'guardian_relation', 'guardian_email', 'guardian_phone', 'guardian_occupation', 'guardian_address', 'current_address', 'permanent_address', 'bank_account_no', 'bank_name', 'ifsc_code', 'adhar_no', 'samagra_id', 'rte', 'previous_school', 'note');

        $data["fields"]       = $fields;
        $data['categorylist'] = $category;
        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('file', $this->lang->line('image'), 'callback_handle_csv_upload');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('student/import', $data);
            $this->load->view('layout/footer', $data);
        } else {

            $student_categorize = 'class';
            if ($student_categorize == 'class') {
                $section = 0;
            } else if ($student_categorize == 'section') {

                $section = $this->input->post('section_id');
            }
            $class_id   = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');

            $session = $this->setting_model->getCurrentSession();
            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                if ($ext == 'csv') {
                    $file = $_FILES['file']['tmp_name'];
                    $this->load->library('CSVReader');
                    $result = $this->csvreader->parse_file($file);

                    //echo "<pre>";print_r($result);echo "<pre>";die;
                    if (!empty($result)) {
                        $rowcount = 0;
                        for ($i = 1; $i <= count($result); $i++) {

                            $student_data[$i] = array();
                            $n                = 0;
                            foreach ($result[$i] as $key => $value) {

                                $student_data[$i][$fields[$n]] = $this->encoding_lib->toUTF8($result[$i][$key]);

                                $student_data[$i]['is_active'] = 'yes';
                                $n++;
                            }

                            $roll_no                           = $student_data[$i]["roll_no"];
                            $adm_no                            = $student_data[$i]["admission_no"];
                            $mobile_no                         = $student_data[$i]["mobileno"];
                            $email                             = $student_data[$i]["email"];
                            $guardian_phone                    = $student_data[$i]["guardian_phone"];
                            $guardian_email                    = $student_data[$i]["guardian_email"];
                            $data_setting                      = array();
                            $data_setting['id']                = $this->sch_setting_detail->id;
                            $data_setting['adm_auto_insert']   = $this->sch_setting_detail->adm_auto_insert;
                            $data_setting['adm_update_status'] = $this->sch_setting_detail->adm_update_status;
                            if ($this->form_validation->is_unique($adm_no, 'students.admission_no')) {

                                if (!empty($roll_no)) {

                                    if ($this->student_model->check_rollno_exists($roll_no, 0, $class_id, $section)) {

                                        $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">' . $this->lang->line('record_already_exists') . '</div>');

                                        $insert_id = "";
                                    } else {

                                        $insert_id = $this->student_model->add($student_data[$i], $data_setting);

                                    }
                                } else {

                                    $insert_id = $this->student_model->add($student_data[$i], $data_setting);
                                }

                            } else {

                                $insert_id = "";
                            }

                            if (!empty($insert_id)) {
                                $data_new = array(
                                    'student_id' => $insert_id,
                                    'class_id'   => $class_id,
                                    'section_id' => $section_id,
                                    'session_id' => $session,
                                );

                                $this->student_model->add_student_session($data_new);
                                $user_password = $this->role->get_random_password($chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false);
                                $sibling_id    = $this->input->post('sibling_id');

                                $data_student_login = array(
                                    'username' => $this->student_login_prefix . $insert_id,
                                    'password' => $user_password,
                                    'user_id'  => $insert_id,
                                    'role'     => 'student',
                                );

                                $this->user_model->add($data_student_login);
                                $parent_password = $this->role->get_random_password($chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false);

                                $temp              = $insert_id;
                                $data_parent_login = array(
                                    'username' => $this->parent_login_prefix . $insert_id,
                                    'password' => $parent_password,
                                    'user_id'  => $insert_id,
                                    'role'     => 'parent',
                                    'childs'   => $temp,
                                );

                                $ins_id         = $this->user_model->add($data_parent_login);
                                $update_student = array(
                                    'id'        => $insert_id,
                                    'parent_id' => $ins_id,
                                );

                                $this->student_model->add($update_student);
                                $sender_details = array('student_id' => $insert_id, 'contact_no' => $guardian_phone, 'email' => $guardian_email);
                                $this->mailsmsconf->mailsms('student_admission', $sender_details);

                                $student_login_detail = array('id' => $insert_id, 'credential_for' => 'student', 'username' => $this->student_login_prefix . $insert_id, 'password' => $user_password, 'contact_no' => $mobile_no, 'email' => $email);
                                $this->mailsmsconf->mailsms('login_credential', $student_login_detail);

                                $parent_login_detail = array('id' => $insert_id, 'credential_for' => 'parent', 'username' => $this->parent_login_prefix . $insert_id, 'password' => $parent_password, 'contact_no' => $guardian_phone, 'email' => $guardian_email);

                                $this->mailsmsconf->mailsms('login_credential', $parent_login_detail);

                                $data['csvData'] = $result;
                                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">' . $this->lang->line('students_imported_successfully') . '</div>');

                                $rowcount++;
                                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Total ' . count($result) . " records found in CSV file. Total " . $rowcount . ' records imported successfully.</div>');

                            } else {

                                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">' . $this->lang->line('record_already_exists') . '</div>');
                            }
                        }
                    } else {

                        $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">' . $this->lang->line('no_record_found') . '</div>');
                    }
                } else {

                    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">' . $this->lang->line('please_upload_CSV_file_only') . '</div>');
                }
            }

            redirect('student/import');
        }
    }

    public function handle_csv_upload()
    {
        $error = "";
        if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
            $allowedExts = array('csv');
            $mimes       = array('text/csv',
                'text/plain',
                'application/csv',
                'text/comma-separated-values',
                'application/excel',
                'application/vnd.ms-excel',
                'application/vnd.msexcel',
                'text/anytext',
                'application/octet-stream',
                'application/txt');
            $temp      = explode(".", $_FILES["file"]["name"]);
            $extension = end($temp);
            if ($_FILES["file"]["error"] > 0) {
                $error .= "Error opening the file<br />";
            }
            if (!in_array($_FILES['file']['type'], $mimes)) {
                $error .= "Error opening the file<br />";
                $this->form_validation->set_message('handle_csv_upload', $this->lang->line('file_type_not_allowed'));
                return false;
            }
            if (!in_array($extension, $allowedExts)) {
                $error .= "Error opening the file<br />";
                $this->form_validation->set_message('handle_csv_upload', $this->lang->line('extension_not_allowed'));
                return false;
            }
            if ($error == "") {
                return true;
            }
        } else {
            $this->form_validation->set_message('handle_csv_upload', $this->lang->line('please_select_file'));
            return false;
        }
    }

    public function edit($id)
    {
        if (!$this->rbac->hasPrivilege('student', 'can_edit')) {
            access_denied();
        }
        $data['title']   = 'Edit Student';
        $data['id']      = $id;
        $student         = $this->student_model->get($id);
        $genderList      = $this->customlib->getGender();
        $data['student'] = $student;

        $data['adm_auto_insert'] = $this->sch_setting_detail->adm_auto_insert;
        $data['genderList']      = $genderList;
        $session                 = $this->setting_model->getCurrentSession();
        $vehroute_result         = $this->vehroute_model->get();
        $data['vehroutelist']    = $vehroute_result;
        $class                   = $this->class_model->get();
        $setting_result          = $this->setting_model->get();

        $data["student_categorize"] = 'class';
        $data['classlist']          = $class;
        $category                   = $this->category_model->get();
        $data['categorylist']       = $category;
        $hostelList                 = $this->hostel_model->get();
        $data['hostelList']         = $hostelList;
        $houses                     = $this->student_model->gethouselist();
        $data['houses']             = $houses;
        $data["bloodgroup"]         = $this->blood_group;
        $siblings                   = $this->student_model->getMySiblings($student['parent_id'], $student['id']);
        $data['siblings']           = $siblings;
        $data['siblings_counts']    = count($siblings);
        $custom_fields              = $this->customfield_model->getByBelong('students');
        $data['sch_setting']        = $this->sch_setting_detail;

        foreach ($custom_fields as $custom_fields_key => $custom_fields_value) {
            if ($custom_fields_value['validation']) {
                $custom_fields_id   = $custom_fields_value['id'];
                $custom_fields_name = $custom_fields_value['name'];
                $this->form_validation->set_rules("custom_fields[students][" . $custom_fields_id . "]", $custom_fields_name, 'trim|required');
            }
        }

        $this->form_validation->set_rules('firstname', $this->lang->line('first_name'), 'trim|required|xss_clean');

        $this->form_validation->set_rules('guardian_is', $this->lang->line('guardian'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('dob', $this->lang->line('date_of_birth'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');

        $this->form_validation->set_rules('gender', $this->lang->line('gender'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('guardian_name', $this->lang->line('guardian_name'), 'trim|required|xss_clean');
        // $this->form_validation->set_rules('rte', $this->lang->line('rtl'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('guardian_phone', $this->lang->line('guardian_phone'), 'trim|required|xss_clean');
        $this->form_validation->set_rules(
            'roll_no', $this->lang->line('roll_no'), array('trim',
                array('check_exists', array($this->student_model, 'valid_student_roll')),
            )
        );

        if(!$this->sch_setting_detail->adm_auto_insert) {
           
            $this->form_validation->set_rules('admission_no', $this->lang->line('admission_no'), array('required', array('check_admission_no_exists', array($this->student_model, 'valid_student_admission_no'))));
        }

        $this->form_validation->set_rules('file', $this->lang->line('image'), 'callback_handle_upload');
        $this->form_validation->set_rules('father_pic', $this->lang->line('image'), 'callback_handle_father_upload');
        $this->form_validation->set_rules('mother_pic', $this->lang->line('image'), 'callback_handle_mother_upload');
        $this->form_validation->set_rules('guardian_pic', $this->lang->line('image'), 'callback_handle_guardian_upload');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('student/studentEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {

            $custom_field_post  = $this->input->post("custom_fields[students]");
            $custom_value_array = array();
            foreach ($custom_field_post as $key => $value) {
                $check_field_type = $this->input->post("custom_fields[students][" . $key . "]");
                $field_value      = is_array($check_field_type) ? implode(",", $check_field_type) : $check_field_type;
                $array_custom     = array(
                    'belong_table_id' => $id,
                    'custom_field_id' => $key,
                    'field_value'     => $field_value,
                );
                $custom_value_array[] = $array_custom;
            }
            $this->customfield_model->updateRecord($custom_value_array, $id, 'students');

            $student_id      = $this->input->post('student_id');
            $student         = $this->student_model->get($student_id);
            $sibling_id      = $this->input->post('sibling_id');
            $siblings_counts = $this->input->post('siblings_counts');
            $siblings        = $this->student_model->getMySiblings($student['parent_id'], $student_id);
            $total_siblings  = count($siblings);

            $class_id       = $this->input->post('class_id');
            $section_id     = $this->input->post('section_id');
            $hostel_room_id = $this->input->post('hostel_room_id');
            $fees_discount  = $this->input->post('fees_discount');
            $vehroute_id    = $this->input->post('vehroute_id');
            if (empty($vehroute_id)) {
                $vehroute_id = 0;
            }
            if (empty($hostel_room_id)) {
                $hostel_room_id = 0;
            }

            $data = array(
                'id'                  => $id,
                'firstname'           => $this->input->post('firstname'),
                'rte'                 => $this->input->post('rte'),
                'state'               => $this->input->post('state'),
                'city'                => $this->input->post('city'),
                'guardian_is'         => $this->input->post('guardian_is'),
                'pincode'             => $this->input->post('pincode'),
                'cast'                => $this->input->post('cast'),
                'previous_school'     => $this->input->post('previous_school'),
                'dob'                 => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('dob'))),
                'current_address'     => $this->input->post('current_address'),
                'permanent_address'   => $this->input->post('permanent_address'),
                //'image'               => 'uploads/student_images/no_image.png',
                'adhar_no'            => $this->input->post('adhar_no'),
                'samagra_id'          => $this->input->post('samagra_id'),
                'bank_account_no'     => $this->input->post('bank_account_no'),
                'bank_name'           => $this->input->post('bank_name'),
                'ifsc_code'           => $this->input->post('ifsc_code'),
                'guardian_occupation' => $this->input->post('guardian_occupation'),
                'guardian_email'      => $this->input->post('guardian_email'),
                'gender'              => $this->input->post('gender'),
                'guardian_name'       => $this->input->post('guardian_name'),
                'guardian_relation'   => $this->input->post('guardian_relation'),
                'guardian_phone'      => $this->input->post('guardian_phone'),
                'guardian_address'    => $this->input->post('guardian_address'),
                'vehroute_id'         => $vehroute_id,
                'hostel_room_id'      => $hostel_room_id,
                'note'                => $this->input->post('note'),
                'is_active'           => 'yes',
            );

            $house             = $this->input->post('house');
            $blood_group       = $this->input->post('blood_group');
            $measurement_date  = $this->input->post('measure_date');
            $roll_no           = $this->input->post('roll_no');
            $lastname          = $this->input->post('lastname');
            $category_id       = $this->input->post('category_id');
            $religion          = $this->input->post('religion');
            $mobileno          = $this->input->post('mobileno');
            $email             = $this->input->post('email');
            $admission_date    = $this->input->post('admission_date');
            $height            = $this->input->post('height');
            $weight            = $this->input->post('weight');
            $father_name       = $this->input->post('father_name');
            $father_phone      = $this->input->post('father_phone');
            $father_occupation = $this->input->post('father_occupation');
            $mother_name       = $this->input->post('mother_name');
            $mother_phone      = $this->input->post('mother_phone');
            $mother_occupation = $this->input->post('mother_occupation');

            if (isset($measurement_date)) {
                $data['measurement_date'] = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('measure_date')));
            }

            if (isset($house)) {
                $data['school_house_id'] = $this->input->post('house');
            }
            if (isset($blood_group)) {

                $data['blood_group'] = $this->input->post('blood_group');
            }

            if (isset($roll_no)) {

                $data['roll_no'] = $this->input->post('roll_no');
            }

            if (isset($lastname)) {

                $data['lastname'] = $this->input->post('lastname');
            }

            if (isset($category_id)) {

                $data['category_id'] = $this->input->post('category_id');
            }

            if (isset($religion)) {

                $data['religion'] = $this->input->post('religion');
            }

            if (isset($mobileno)) {

                $data['mobileno'] = $this->input->post('mobileno');
            }

            if (isset($email)) {

                $data['email'] = $this->input->post('email');
            }

            if (isset($admission_date)) {

                $data['admission_date'] = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('admission_date')));
            }

            if (isset($height)) {

                $data['height'] = $this->input->post('height');
            }

            if (isset($weight)) {

                $data['weight'] = $this->input->post('weight');
            }

            if (isset($father_name)) {

                $data['father_name'] = $this->input->post('father_name');
            }

            if (isset($father_phone)) {

                $data['father_phone'] = $this->input->post('father_phone');
            }

            if (isset($father_occupation)) {

                $data['father_occupation'] = $this->input->post('father_occupation');
            }

            if (isset($mother_name)) {

                $data['mother_name'] = $this->input->post('mother_name');
            }

            if (isset($mother_phone)) {

                $data['mother_phone'] = $this->input->post('mother_phone');
            }

            if (isset($mother_occupation)) {

                $data['mother_occupation'] = $this->input->post('mother_occupation');
            }

            if (!$this->sch_setting_detail->adm_auto_insert) {

                $data['admission_no'] = $this->input->post('admission_no');
            }
            $this->student_model->add($data);
            $data_new = array(
                'student_id'    => $id,
                'class_id'      => $class_id,
                'section_id'    => $section_id,
                'session_id'    => $session,
                'fees_discount' => $fees_discount,
            );
            $insert_id = $this->student_model->add_student_session($data_new);
            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = $id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/student_images/" . $img_name);
                $data_img = array('id' => $id, 'image' => 'uploads/student_images/' . $img_name);
                $this->student_model->add($data_img);
            }

            if (isset($_FILES["father_pic"]) && !empty($_FILES['father_pic']['name'])) {
                $fileInfo = pathinfo($_FILES["father_pic"]["name"]);
                $img_name = $id . "father" . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["father_pic"]["tmp_name"], "./uploads/student_images/" . $img_name);
                $data_img = array('id' => $id, 'father_pic' => 'uploads/student_images/' . $img_name);
                $this->student_model->add($data_img);
            }

            if (isset($_FILES["mother_pic"]) && !empty($_FILES['mother_pic']['name'])) {
                $fileInfo = pathinfo($_FILES["mother_pic"]["name"]);
                $img_name = $id . "mother" . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["mother_pic"]["tmp_name"], "./uploads/student_images/" . $img_name);
                $data_img = array('id' => $id, 'mother_pic' => 'uploads/student_images/' . $img_name);
                $this->student_model->add($data_img);
            }

            if (isset($_FILES["guardian_pic"]) && !empty($_FILES['guardian_pic']['name'])) {
                $fileInfo = pathinfo($_FILES["guardian_pic"]["name"]);
                $img_name = $id . "guardian" . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["guardian_pic"]["tmp_name"], "./uploads/student_images/" . $img_name);
                $data_img = array('id' => $id, 'guardian_pic' => 'uploads/student_images/' . $img_name);
                $this->student_model->add($data_img);
            }

            if (isset($siblings_counts) && ($total_siblings == $siblings_counts)) {
                //if there is no change in sibling
            } else if (!isset($siblings_counts) && $sibling_id == 0 && $total_siblings > 0) {
                // add for new parent
                $parent_password = $this->role->get_random_password($chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false);

                $data_parent_login = array(
                    'username' => $this->parent_login_prefix . $student_id . "_1",
                    'password' => $parent_password,
                    'user_id'  => "",
                    'role'     => 'parent',
                );

                $update_student = array(
                    'id'        => $student_id,
                    'parent_id' => 0,
                );
                $ins_id = $this->user_model->addNewParent($data_parent_login, $update_student);
            } else if ($sibling_id != 0) {
                //join to student with new parent
                $student_sibling = $this->student_model->get($sibling_id);
                $update_student  = array(
                    'id'        => $student_id,
                    'parent_id' => $student_sibling['parent_id'],
                );
                $student_sibling = $this->student_model->add($update_student);
            } else {

            }

            $this->session->set_flashdata('msg', '<div student="alert alert-success text-left">' . $this->lang->line('update_message') . '</div>');
            redirect('student/search');
        }
    }

    public function bulkdelete()
    {

        $this->session->set_userdata('top_menu', 'Student Information');
        $this->session->set_userdata('sub_menu', 'bulkdelete');
        $class                   = $this->class_model->get();
        $data['classlist']       = $class;
        $data['adm_auto_insert'] = $this->sch_setting_detail->adm_auto_insert;
        $data['sch_setting']     = $this->sch_setting_detail;
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $class   = $this->input->post('class_id');
            $section = $this->input->post('section_id');
            $search  = $this->input->post('search');

            $data['searchby']    = "filter";
            $data['class_id']    = $this->input->post('class_id');
            $data['section_id']  = $this->input->post('section_id');
            $data['search_text'] = $this->input->post('search_text');
            $resultlist          = $this->student_model->searchByClassSection($class, $section);
            $data['resultlist']  = $resultlist;
            $title               = $this->classsection_model->getDetailbyClassSection($data['class_id'], $data['section_id']);
            $data['title']       = 'Student Details for ' . $title['class'] . "(" . $title['section'] . ")";
        }
        $this->load->view('layout/header', $data);
        $this->load->view('student/bulkdelete', $data);
        $this->load->view('layout/footer', $data);
    }

    public function search()
    {
        //echo "<pre>"; print_r($this->session); echo "<pre>";die;
        if (!$this->rbac->hasPrivilege('student', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Student Information');
        $this->session->set_userdata('sub_menu', 'student/search');
        $data['title']           = 'Student Search';
        $data['adm_auto_insert'] = $this->sch_setting_detail->adm_auto_insert;
        $data['sch_setting']     = $this->sch_setting_detail;
        $data['fields']          = $this->customfield_model->get_custom_fields('students', 1);
        $class                   = $this->class_model->get();
        $data['classlist']       = $class;

        $userdata = $this->customlib->getUserData();
        $carray   = array();

        if (!empty($data["classlist"])) {
            foreach ($data["classlist"] as $ckey => $cvalue) {

                $carray[] = $cvalue["id"];
            }
        }
        //echo "<pre>";  print_r($carray); echo "<pre>";die;
        $button = $this->input->post('search');
        if ($this->input->server('REQUEST_METHOD') == "GET") {
            $this->load->view('layout/header', $data);
            $this->load->view('student/studentSearch', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $class       = $this->input->post('class_id');
            $section     = $this->input->post('section_id');
            $search      = $this->input->post('search');
            $search_text = $this->input->post('search_text');
            if (isset($search)) {
                if ($search == 'search_filter') {
                    $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
                    if ($this->form_validation->run() == false) {

                    } else {
                        $data['searchby']    = "filter";
                        $data['class_id']    = $this->input->post('class_id');
                        $data['section_id']  = $this->input->post('section_id');
                        $data['search_text'] = $this->input->post('search_text');
                        $resultlist          = $this->student_model->searchByClassSection($class, $section);
                        $data['resultlist']  = $resultlist;
                        $title               = $this->classsection_model->getDetailbyClassSection($data['class_id'], $data['section_id']);
                        $data['title']       = 'Student Details for ' . $title['class'] . "(" . $title['section'] . ")";
                    }
                } else if ($search == 'search_full') {
                    $data['searchby'] = "text";

                    $data['search_text'] = trim($this->input->post('search_text'));
                    $resultlist          = $this->student_model->searchFullText($search_text, $carray);
                    $data['resultlist']  = $resultlist;
                    $data['title']       = 'Search Details: ' . $data['search_text'];
                }
            }

            $this->load->view('layout/header', $data);
            $this->load->view('student/studentSearch', $data);
            $this->load->view('layout/footer', $data);
        }
    }
 
    public function getByClassAndSection()
    {
        $class      = $this->input->get('class_id');
        $section    = $this->input->get('section_id');
        $resultlist = $this->student_model->searchByClassSection($class, $section);
        echo json_encode($resultlist);
    }

    public function getByClassAndSectionExcludeMe()
    {
        $class      = $this->input->get('class_id');
        $section    = $this->input->get('section_id');
        $student_id = $this->input->get('current_student_id');
        $resultlist = $this->student_model->searchByClassSectionWithoutCurrent($class, $section, $student_id);
        echo json_encode($resultlist);
    }

    public function getStudentRecordByID()
    {
        $student_id = $this->input->get('student_id');
        $resultlist = $this->student_model->get($student_id);
        echo json_encode($resultlist);
    }

    public function uploadimage($id)
    {
        $data['title'] = 'Add Image';
        $data['id']    = $id;
        $this->load->view('layout/header', $data);
        $this->load->view('student/uploadimage', $data);
        $this->load->view('layout/footer', $data);
    }

    public function doupload($id)
    {
        $config = array(
            'upload_path'   => "./uploads/student_images/",
            'allowed_types' => "gif|jpg|png|jpeg|df",
            'overwrite'     => true,
        );
        $config['file_name'] = $id . ".jpg";
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        if ($this->upload->do_upload()) {
            $data        = array('upload_data' => $this->upload->data());
            $upload_data = $this->upload->data();
            $data_record = array('id' => $id, 'image' => $upload_data['file_name']);
            $this->setting_model->add($data_record);

            $this->load->view('upload_success', $data);
        } else {
            $error = array('error' => $this->upload->display_errors());

            $this->load->view('file_view', $error);
        }
    }

    public function getlogindetail()
    {
        if (!$this->rbac->hasPrivilege('student_login_credential_report', 'can_view')) {
            access_denied();
        }
        $student_id   = $this->input->post('student_id');
        $examSchedule = $this->user_model->getStudentLoginDetails($student_id);
        echo json_encode($examSchedule);
    }

    public function getUserLoginDetails()
    {
        $studentid = $this->input->post("student_id");
        $result    = $this->user_model->getUserLoginDetails($studentid);
        echo json_encode($result);
    }

    public function guardianreport()
    {

        if (!$this->rbac->hasPrivilege('guardian_report', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/student_information');
        $this->session->set_userdata('subsub_menu', 'Reports/student_information/guardian_report');
        $data['title']           = 'Student Guardian Report';
        $class                   = $this->class_model->get();
        $data['classlist']       = $class;
        $data['sch_setting']     = $this->sch_setting_detail;
        $data['adm_auto_insert'] = $this->sch_setting_detail->adm_auto_insert;
        $userdata                = $this->customlib->getUserData();
        $carray                  = array();

        if (!empty($data["classlist"])) {
            foreach ($data["classlist"] as $ckey => $cvalue) {

                $carray[] = $cvalue["id"];
            }
        }

        $class_id   = $this->input->post("class_id");
        $section_id = $this->input->post("section_id");

        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {

            $resultlist         = $this->student_model->studentGuardianDetails($carray);
            $data["resultlist"] = "";
        } else {

            $resultlist         = $this->student_model->searchGuardianDetails($class_id, $section_id);
            $data["resultlist"] = $resultlist;
        }

        $this->load->view("layout/header", $data);
        $this->load->view("student/guardianReport", $data);
        $this->load->view("layout/footer", $data);
    }

    public function disablestudentslist()
    {
        if (!$this->rbac->hasPrivilege('disable_student', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Student Information');
        $this->session->set_userdata('sub_menu', 'student/disablestudentslist');
        $class                   = $this->class_model->get();
        $data['classlist']       = $class;
        $result                  = $this->student_model->getdisableStudent();
        $data["resultlist"]      = array();
        $data['adm_auto_insert'] = $this->sch_setting_detail->adm_auto_insert;
        $data['sch_setting']     = $this->sch_setting_detail;
        $userdata                = $this->customlib->getUserData();
        $carray                  = array();
        $reason_list             = array();
        if (!empty($data["classlist"])) {
            foreach ($data["classlist"] as $ckey => $cvalue) {

                $carray[] = $cvalue["id"];
            }
        }

        $button = $this->input->post('search');
        if ($this->input->server('REQUEST_METHOD') == "GET") {

        } else {
            $class       = $this->input->post('class_id');
            $section     = $this->input->post('section_id');
            $search      = $this->input->post('search');
            $search_text = $this->input->post('search_text');
            if (isset($search)) {
                if ($search == 'search_filter') {
                    $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
                    if ($this->form_validation->run() == false) {

                    } else {
                        $data['searchby']   = "filter";
                        $data['class_id']   = $this->input->post('class_id');
                        $data['section_id'] = $this->input->post('section_id');

                        $data['search_text'] = $this->input->post('search_text');
                        $resultlist          = $this->student_model->disablestudentByClassSection($class, $section);
                        $data['resultlist']  = $resultlist;
                        $title               = $this->classsection_model->getDetailbyClassSection($data['class_id'], $data['section_id']);
                        $data['title']       = 'Student Details for ' . $title['class'] . "(" . $title['section'] . ")";
                    }
                } else if ($search == 'search_full') {
                    $data['searchby'] = "text";

                    $data['search_text'] = trim($this->input->post('search_text'));
                    $resultlist          = $this->student_model->disablestudentFullText($search_text);

                    $data['resultlist'] = $resultlist;
                    $data['title']      = 'Search Details: ' . $data['search_text'];
                }
            }
        }

        $disable_reason = $this->disable_reason_model->get();

        foreach ($disable_reason as $key => $value) {
            $id               = $value['id'];
            $reason_list[$id] = $value;
        }

        $data['disable_reason'] = $reason_list;

        $this->load->view("layout/header", $data);
        $this->load->view("student/disablestudents", $data);
        $this->load->view("layout/footer", $data);
    }

    public function disablestudent($id)
    {

        $data = array('is_active' => "no", 'disable_at' => date("Y-m-d"));
        $this->student_model->disableStudent($id, $data);
        redirect("student/view/" . $id);
    }

    public function enablestudent($id)
    {

        $data = array('is_active' => "yes");
        
        $this->student_model->disableStudent($id, $data);
        echo "0";
        //redirect("student/view/" . $id);
    }

    public function savemulticlass()
    {

        $student_id       = '';
        $message          = "";
        $duplicate_record = 0;
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('student_id', $this->lang->line('student_id'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('row_count[]', 'row_count[]', 'trim|required|xss_clean');

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $total_rows = $this->input->post('row_count[]');
            foreach ($total_rows as $key_rowcount => $row_count) {

                $this->form_validation->set_rules('class_id_' . $row_count, $this->lang->line('class'), 'trim|required|xss_clean');

                $this->form_validation->set_rules('section_id_' . $row_count, $this->lang->line('section'), 'trim|required|xss_clean');
            }
        }

        if ($this->form_validation->run() == false) {

            $msg = array(
                'student_id'  => form_error('student_id'),
                'row_count[]' => form_error('row_count[]'),
            );

            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $total_rows = $this->input->post('row_count[]');
                foreach ($total_rows as $key_rowcount => $row_count) {

                    $msg['class_id_' . $row_count]   = form_error('class_id_' . $row_count);
                    $msg['section_id_' . $row_count] = form_error('section_id_' . $row_count);
                }
            }
            if (!empty($msg)) {
                $message = "Something went wrong";
            }

            $array = array('status' => '0', 'error' => $msg, 'message' => $message);
        } else {

            $rowcount            = $this->input->post('row_count[]');
            $class_section_array = array();
            $duplicate_array     = array();
            foreach ($rowcount as $key_rowcount => $value_rowcount) {

                $array = array(
                    'class_id'   => $this->input->post('class_id_' . $value_rowcount),
                    'session_id' => $this->setting_model->getCurrentSession(),
                    'student_id' => $this->input->post('student_id'),
                    'section_id' => $this->input->post('section_id_' . $value_rowcount),
                );

                $class_section_array[] = $array;
                $duplicate_array[]     = $this->input->post('class_id_' . $value_rowcount) . "-" . $this->input->post('section_id_' . $value_rowcount);
            }

            foreach (array_count_values($duplicate_array) as $val => $c) {

                if ($c > 1) {
                    $duplicate_record = 1;
                    break;
                }
            }
            if ($duplicate_record) {

                $array = array('status' => 0, 'error' => '', 'message' => $this->lang->line('duplicate_entry'));
            } else {
                $this->studentsession_model->add($class_section_array, $this->input->post('student_id'));

                $array = array('status' => 1, 'error' => '', 'message' => $this->lang->line('success_message'));
            }
        }
        echo json_encode($array);
    }

    public function disable_reason()
    {

        $student_id = '';
        $this->form_validation->set_rules('reason', $this->lang->line('reason'), 'trim|required|xss_clean');
        //$this->form_validation->set_rules('note', $this->lang->line('note'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {

            $msg = array(
                'reason' => form_error('reason'),
                // 'note'   => form_error('note'),
            );

            $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
        } else {

            $data = array(
                'dis_reason' => $this->input->post('reason'),
                'dis_note'   => $this->input->post('note'),
                'id'         => $this->input->post('student_id'),
                'is_active'  => 'no',
            );

            $this->student_model->add($data);

            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        }
        echo json_encode($array);
    }

    public function ajax_delete()
    {

        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('student[]', $this->lang->line('student'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {

            $msg = array(
                'student[]' => form_error('student[]'),
            );
            $array = array('status' => 0, 'error' => $msg, 'message' => '');
        } else {
            $students = $this->input->post('student');

            foreach ($students as $student_key => $student_value) {

            }

            $this->student_model->bulkdelete($students);

            $array = array('status' => 1, 'error' => '', 'message' => $this->lang->line('delete_message'));
        }
        echo json_encode($array);
    }

}
