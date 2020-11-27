<?php
  
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class User extends Student_Controller
{

    public $school_name;
    public $school_setting;
    public $setting;
    public $payment_method;

    public function __construct()
    {
        parent::__construct();
        $this->payment_method     = $this->paymentsetting_model->getActiveMethod();
        $this->sch_setting_detail = $this->setting_model->getSetting();
    }

    public function unauthorized()
    {
        $data = array();
        $this->load->view('layout/student/header');
        $this->load->view('unauthorized', $data);
        $this->load->view('layout/student/footer');
    }

    public function dashboard()
    {
       
      
        $this->session->set_userdata('top_menu', 'Dashboard');
        $student_id            = $this->customlib->getStudentSessionUserID();
        $student_current_class = $this->customlib->getStudentCurrentClsSection();

        $student = $this->student_model->getStudentByClassSectionID($student_current_class->class_id, $student_current_class->section_id, $student_id);

        $data = array();
        if (!empty($student)) {

            $student_session_id           = $student_current_class->student_session_id;
            $gradeList                    = $this->grade_model->get();
            $student_due_fee              = $this->studentfeemaster_model->getStudentFees($student_session_id);
            $student_discount_fee         = $this->feediscount_model->getStudentFeesDiscount($student_session_id);
            $data['student_discount_fee'] = $student_discount_fee;
            $data['student_due_fee']      = $student_due_fee;
            $timeline                     = $this->timeline_model->getStudentTimeline($student["id"], $status = 'yes');
            $data["timeline_list"]        = $timeline;
            $data['sch_setting']          = $this->sch_setting_detail;
            $data['adm_auto_insert']      = $this->sch_setting_detail->adm_auto_insert;

            $data['examSchedule'] = array();
            $data['exam_result']  = $this->examgroupstudent_model->searchStudentExams($student['student_session_id'], true,true);
           
           $ss=$this->grade_model->getGradeDetails();
       
            $data['exam_grade'] = $this->grade_model->getGradeDetails();
           
            
            $student_doc            = $this->student_model->getstudentdoc($student_id);
            $data['student_doc']    = $student_doc;
            $data['student_doc_id'] = $student_id;
            $category_list          = $this->category_model->get();
            $data['category_list']  = $category_list;
            $data['gradeList']      = $gradeList;
            $data['student']        = $student;

        }
        
        $data['unread_notifications'] = $this->notification_model->getUnreadStudentNotification();
        
        $this->load->view('layout/student/header', $data);
        $this->load->view('user/dashboard', $data);
        $this->load->view('layout/student/footer', $data);
    }
  
    public function changepass()
    {
        $data['title'] = 'Change Password';
        $this->form_validation->set_rules('current_pass', 'Current password', 'trim|required|xss_clean');
        $this->form_validation->set_rules('new_pass', 'New password', 'trim|required|xss_clean|matches[confirm_pass]');
        $this->form_validation->set_rules('confirm_pass', 'Confirm password', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $sessionData            = $this->session->userdata('loggedIn');
            $this->data['id']       = $sessionData['id'];
            $this->data['username'] = $sessionData['username'];
            $this->load->view('layout/student/header', $data);
            $this->load->view('user/change_password', $data);
            $this->load->view('layout/student/footer', $data);
        } else {
            $sessionData = $this->session->userdata('student');
            $data_array  = array(
                'current_pass' => ($this->input->post('current_pass')),
                'new_pass'     => ($this->input->post('new_pass')),
                'user_id'      => $sessionData['id'],
                'user_name'    => $sessionData['username'],
            );
            $newdata = array(
                'id'       => $sessionData['id'],
                'password' => $this->input->post('new_pass'),
            );
            $query1 = $this->user_model->checkOldPass($data_array);
            if ($query1) {
                $query2 = $this->user_model->saveNewPass($newdata);
                if ($query2) {

                    $this->session->set_flashdata('success_msg', 'Password changed successfully');
                    $this->load->view('layout/student/header', $data);
                    $this->load->view('user/change_password', $data);
                    $this->load->view('layout/student/footer', $data);
                }
            } else {

                $this->session->set_flashdata('error_msg', 'Invalid current password');
                $this->load->view('layout/student/header', $data);
                $this->load->view('user/change_password', $data);
                $this->load->view('layout/student/footer', $data);
            }
        }
    }
 
    public function changeusername()
    {
        $sessionData = $this->customlib->getLoggedInUserData();

        $data['title'] = 'Change Username';
        $this->form_validation->set_rules('current_username', 'Current username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('new_username', 'New username', 'trim|required|xss_clean|matches[confirm_username]');
        $this->form_validation->set_rules('confirm_username', 'Confirm username', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {

        } else {
 
            $data_array = array(
                'username'     => $this->input->post('current_username'),
                'new_username' => $this->input->post('new_username'),
                'role'         => $sessionData['role'],
                'user_id'      => $sessionData['id'],
            );
            $newdata = array(
                'id'       => $sessionData['id'],
                'username' => $this->input->post('new_username'),
            );
            $is_valid = $this->user_model->checkOldUsername($data_array);

            if ($is_valid) {
                $is_exists = $this->user_model->checkUserNameExist($data_array);
                if (!$is_exists) {
                    $is_updated = $this->user_model->saveNewUsername($newdata);
                    if ($is_updated) {
                        $this->session->set_flashdata('success_msg', 'Username changed successfully');
                        redirect('user/user/changeusername');
                    }
                } else {
                    $this->session->set_flashdata('error_msg', 'Username Already Exists, Please choose other');
                }
            } else {
                $this->session->set_flashdata('error_msg', 'Invalid current username');
            }
        }
        $this->data['id']       = $sessionData['id'];
        $this->data['username'] = $sessionData['username'];
        $this->load->view('layout/student/header', $data);
        $this->load->view('user/change_username', $data);
        $this->load->view('layout/student/footer', $data);
    }

    public function download($student_id, $doc)
    {
        $this->load->helper('download');
        $filepath = "./uploads/student_documents/$student_id/" . $this->uri->segment(5);
        $data     = file_get_contents($filepath);
        $name     = $this->uri->segment(6);
        force_download($name, $data);
    }

    public function user_language($lang_id)
    {
        $language_name = $this->db->select('languages.language')->from('languages')->where('id', $lang_id)->get()->row_array();
        $student       = $this->session->userdata('student');
        if (!empty($student)) {
            $this->session->unset_userdata('student');
        }
        $language_array      = array('lang_id' => $lang_id, 'language' => $language_name['language']);
        $student['language'] = $language_array;
        $this->session->set_userdata('student', $student);

        $session         = $this->session->userdata('student');
        $id              = $session['student_id'];
        $data['lang_id'] = $lang_id;
        $language_result = $this->language_model->set_studentlang($id, $data);
    }

    public function timeline_download($timeline_id, $doc)
    {
        $this->load->helper('download');
        $filepath = "./uploads/student_timeline/" . $doc;
        $data     = file_get_contents($filepath);
        $name     = $doc;
        force_download($name, $data);
    }

    public function view($id)
    {
        $data['title']           = 'Student Details';
        $student                 = $this->student_model->get($id);
        $student_due_fee         = $this->studentfee_model->getDueFeeBystudent($student['class_id'], $student['section_id'], $id);
        $data['student_due_fee'] = $student_due_fee;
        $transport_fee           = $this->studenttransportfee_model->getTransportFeeByStudent($student['student_session_id']);
        $data['transport_fee']   = $transport_fee;
        $examList                = $this->examschedule_model->getExamByClassandSection($student['class_id'], $student['section_id']);
        $data['examSchedule']    = array();
        if (!empty($examList)) {
            $new_array = array();
            foreach ($examList as $ex_key => $ex_value) {
                $array         = array();
                $x             = array();
                $exam_id       = $ex_value['exam_id'];
                $exam_subjects = $this->examschedule_model->getresultByStudentandExam($exam_id, $student['id']);
                foreach ($exam_subjects as $key => $value) {
                    $exam_array                     = array();
                    $exam_array['exam_schedule_id'] = $value['exam_schedule_id'];
                    $exam_array['exam_id']          = $value['exam_id'];
                    $exam_array['full_marks']       = $value['full_marks'];
                    $exam_array['passing_marks']    = $value['passing_marks'];
                    $exam_array['exam_name']        = $value['name'];
                    $exam_array['exam_type']        = $value['type'];
                    $exam_array['attendence']       = $value['attendence'];
                    $exam_array['get_marks']        = $value['get_marks'];
                    $x[]                            = $exam_array;
                }
                $array['exam_name']   = $ex_value['exam_name'];
                $array['exam_result'] = $x;
                $new_array[]          = $array;
            }
            $data['examSchedule'] = $new_array;
        }
        return $data['student'] = $student;
    }

    public function getfees()
    {

        $id                    = $this->customlib->getStudentSessionUserID();
        $student_current_class = $this->customlib->getStudentCurrentClsSection();

        $this->session->set_userdata('top_menu', 'fees');
        $this->session->set_userdata('sub_menu', 'student/getFees');
        $category                = $this->category_model->get();
        $data['categorylist']    = $category;
        $data['sch_setting']     = $this->sch_setting_detail;
        $data['adm_auto_insert'] = $this->sch_setting_detail->adm_auto_insert;
        $paymentoption           = $this->customlib->checkPaypalDisplay();
        $data['paymentoption']   = $paymentoption;
        $data['payment_method']  = false;
        if (!empty($this->payment_method)) {
            $data['payment_method'] = true;
        }
        $student_id                   = $id;
        $student                      = $this->student_model->getStudentByClassSectionID($student_current_class->class_id, $student_current_class->section_id, $student_id);
        $class_id                     = $student_current_class->class_id;
        $section_id                   = $student_current_class->section_id;
        $data['title']                = 'Student Details';
        $student_due_fee              = $this->studentfeemaster_model->getStudentFees($student_current_class->student_session_id);
        $student_discount_fee         = $this->feediscount_model->getStudentFeesDiscount($student_current_class->student_session_id);
        $data['student_discount_fee'] = $student_discount_fee;
        $data['student_due_fee']      = $student_due_fee;
        $data['student']              = $student;
        $this->load->view('layout/student/header', $data);
        $this->load->view('student/getfees', $data);
        $this->load->view('layout/student/footer', $data);
    }
 
    public function create_doc()
    {

          $this->form_validation->set_rules('first_title', $this->lang->line('title'), 'trim|required|xss_clean');
          $this->form_validation->set_rules('first_doc', $this->lang->line('document'), 'callback_handle_upload');

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
public function handle_upload()
    {

        $image_validate = $this->config->item('file_validate');

        if (isset($_FILES["first_doc"]) && !empty($_FILES['first_doc']['name'])) {

            $file_type         = $_FILES["first_doc"]['type'];
            $file_size         = $_FILES["first_doc"]["size"];
            $file_name         = $_FILES["first_doc"]["name"];
            $allowed_extension = $image_validate['allowed_extension'];
            $ext               = pathinfo($file_name, PATHINFO_EXTENSION);
            $allowed_mime_type = $image_validate['allowed_mime_type'];
            if ($files = @getimagesize($_FILES['first_doc']['tmp_name'])) {

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
        }else{
            $this->form_validation->set_message('handle_upload', "The File Field is required");
                return false;
        }
        return true;
    }
}
