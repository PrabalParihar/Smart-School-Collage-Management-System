<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Teacher extends Parent_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'teacher/index');
        $data['title'] = 'Add Teacher';
		$data['teachers']=$teachers=array();
        $teacher_result = $this->staff_model->getEmployee('Teacher');
        $data['teacherlist'] = $teacher_result;
        $genderList = $this->customlib->getGender();
        $session_id = $this->session->userdata('parent_childs');
      
        $data['user_id']=$session_id['id'];
        $data['role']=$session_id['role'];
        $data['genderList'] = $genderList;

        $user_ratedstafflist=$this->staff_model->get_RatedStaffByUser($session_id['id']);
        $data['user_ratedstafflist']=$user_ratedstafflist;

        $all_rating=$this->staff_model->all_rating();
        

        $data['rate_canview']=0;

        foreach ($all_rating as $value) {
            if($value['total']>=3){
            $r=($value['rate']/$value['total']);

            $data['avg_rate'][$value['staff_id']]=$r;
            $data['rate_canview']=1;
            }else{
            $data['avg_rate'][$value['staff_id']]=0;
            }
            $data['reviews'][$value['staff_id']]=$value['total'];
        }
        
        $this->load->view('layout/parent/header', $data);
        $this->load->view('parent/teacher/teacherList', $data);
        $this->load->view('layout/parent/footer', $data);
    }

    function getSubjctByClassandSection() {
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $data = $this->teachersubject_model->getSubjectByClsandSection($class_id, $section_id);
        echo json_encode($data);
    }

    function assignTeacher() {
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'teacher/assignTeacher');
        $data['title'] = 'Assign Teacher with Class and Subject wise';
        $teacher = $this->teacher_model->get();
        $data['teacherlist'] = $teacher;
        $subject = $this->subject_model->get();
        $data['subjectlist'] = $subject;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/teacher/assignTeacher', $data);
        $this->load->view('layout/footer', $data);
        if ($this->input->server('REQUEST_METHOD') == "POST") {
            $loop = $this->input->post('i');
            $array = array();
            foreach ($loop as $key => $value) {
                $s = array();
                $s['session_id'] = $this->setting_model->getCurrentSession();
                $class_id = $this->input->post('class_id');
                $section_id = $this->input->post('section_id');
                $dt = $this->classsection_model->getDetailbyClassSection($class_id, $section_id);
                $s['class_section_id'] = $dt['id'];
                $s['teacher_id'] = $this->input->post('teacher_id_' . $value);
                $s['subject_id'] = $this->input->post('subject_id_' . $value);
                $row_id = $this->input->post('row_id_' . $value);
                if ($row_id == 0) {
                    $insert_id = $this->teachersubject_model->add($s);
                    $array[] = $insert_id;
                } else {
                    $s['id'] = $row_id;
                    $array[] = $row_id;
                    $this->teachersubject_model->add($s);
                }
            }
            $ids = implode(",", $array);
            $this->teachersubject_model->deleteBatch($ids);
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Updated Successfully!!!</div>');
            redirect('admin/teacher/assignTeacher');
        }
    }

    function getSubjectTeachers() {
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $dt = $this->classsection_model->getDetailbyClassSection($class_id, $section_id);
        $data = $this->teachersubject_model->getDetailByclassAndSection($dt['id']);
        echo json_encode($data);
    }

    function view($id) {
        $data['title'] = 'Teacher List';
        $teacher = $this->teacher_model->get($id);
        $data['teacher'] = $teacher;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/teacher/teacherShow', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete($id) {
        $data['title'] = 'Teacher List';
        $this->teacher_model->remove($id);
        redirect('admin/teacher/index');
    }

    function create() {
        $data['title'] = 'Add teacher';
        $genderList = $this->customlib->getGender();
        $data['genderList'] = $genderList;
        $this->form_validation->set_rules('name', 'Teacher', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required|xss_clean');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required|xss_clean');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|xss_clean');
        $this->form_validation->set_rules('file', 'Image', 'callback_handle_upload');
        if ($this->form_validation->run() == FALSE) {
            $teacher_result = $this->teacher_model->get();
            $data['teacherlist'] = $teacher_result;
            $genderList = $this->customlib->getGender();
            $data['genderList'] = $genderList;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/teacher/teacherCreate', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'sex' => $this->input->post('gender'),
                'dob' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('dob'))),
                'address' => $this->input->post('address'),
                'phone' => $this->input->post('phone'),
                'image' => $this->input->post('file')
            );
            $insert_id = $this->teacher_model->add($data);
            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = $insert_id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/teacher_images/" . $img_name);
                $data_img = array('id' => $insert_id, 'image' => 'uploads/teacher_images/' . $img_name);
                $this->student_model->add($data_img);
            }
            $this->session->set_flashdata('msg', '<div teacher="alert alert-success text-center">Employee details added to Database!!!</div>');
            redirect('admin/teacher/index');
        }
    }

    function handle_upload() {
        if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
            $allowedExts = array('jpg', 'jpeg', 'png');
            $temp = explode(".", $_FILES["file"]["name"]);
            $extension = end($temp);
            if ($_FILES["file"]["error"] > 0) {
                $error .= "Error opening the file<br />";
            }
            if ($_FILES["file"]["type"] != 'image/gif' &&
                    $_FILES["file"]["type"] != 'image/jpeg' &&
                    $_FILES["file"]["type"] != 'image/png') {

                $this->form_validation->set_message('handle_upload', 'File type not allowed');
                return false;
            }
            if (!in_array($extension, $allowedExts)) {
                $this->form_validation->set_message('handle_upload', 'Extension not allowed');
                return false;
            }
            if ($_FILES["file"]["size"] > 102400) {

                $this->form_validation->set_message('handle_upload', 'File size shoud be less than 100 kB');
                return false;
            }
            if ($error == "") {
                return true;
            }
        } else {
            return true;
        }
    }

    function edit($id) {
        $data['title'] = 'Edit Teacher';
        $data['id'] = $id;
        $genderList = $this->customlib->getGender();
        $data['genderList'] = $genderList;
        $teacher = $this->teacher_model->get($id);
        $data['teacher'] = $teacher;
        $this->form_validation->set_rules('name', 'Teacher', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required|xss_clean');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required|xss_clean');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|xss_clean');
        $this->form_validation->set_rules('file', 'Image', 'callback_handle_upload');
        if ($this->form_validation->run() == FALSE) {
            $teacher_result = $this->teacher_model->get();
            $data['teacherlist'] = $teacher_result;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/teacher/teacherEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id' => $id,
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'sex' => $this->input->post('gender'),
                'dob' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('dob'))),
                'address' => $this->input->post('address'),
                'phone' => $this->input->post('phone'),
                'image' => $this->input->post('file')
            );
            $insert_id = $this->teacher_model->add($data);
            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = $id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/teacher_images/" . $img_name);
                $data_img = array('id' => $id, 'image' => 'uploads/teacher_images/' . $img_name);
                $this->student_model->add($data_img);
            }
            $this->session->set_flashdata('msg', '<div teacher="alert alert-success text-center">Employee details added to Database!!!</div>');
            redirect('admin/teacher/index');
        }
    }

    function rating(){
       $this->form_validation->set_rules('comment', 'Comment', 'required');
       $this->form_validation->set_rules('rate', 'Rating', 'required');              
        if ($this->form_validation->run() == FALSE) {
        $msg = array(               
        'comment' => form_error('comment'), 
        'rate' => form_error('rate'), 
        );

        $array = array('status' => 'fail', 'error' => $msg, 'message' => '');

        }else{

           $data['staff_id'] =$this->input->post('staff_id');
           $data['comment'] =$this->input->post('comment');
           $data['rate'] =$this->input->post('rate');
           $data['user_id'] =$this->input->post('user_id');
           $data['role'] =$this->input->post('role');
           $this->teacher_model->rating($data);
           $array = array('status' => 'success', 'error' => '', 'message' => 'Rating Successfully Saved.');
        }

        echo json_encode($array);
    }

}

?>