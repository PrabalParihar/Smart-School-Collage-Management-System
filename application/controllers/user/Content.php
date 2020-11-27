<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Content extends Student_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['title'] = 'Upload Content';
        $data['title_list'] = 'Upload Content List';
        $list = $this->content_model->get();
        $data['list'] = $list;
        $ght = $this->customlib->getcontenttype();
        $data['ght'] = $ght;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $this->load->view('layout/student/header');
        $this->load->view('user/content/createcontent', $data);
        $this->load->view('layout/student/footer');
    }

    public function download($file) {
       
        $this->load->helper('download');
        $filepath = "./uploads/school_content/material/" . $this->uri->segment(7);
        $data = file_get_contents($filepath);
        $name = $this->uri->segment(7);
        force_download($name, $data);
    }

    public function assignment() {
        $this->session->set_userdata('top_menu', 'Downloads');
        $this->session->set_userdata('sub_menu', 'content/assignment');
        $student_id = $this->customlib->getStudentSessionUserID();
        $student = $this->student_model->get($student_id);
    
        $data['title_list'] = 'List of Assignment';
        $student_current_class = $this->customlib->getStudentCurrentClsSection();

        $list = $this->content_model->getListByCategoryforUser($student_current_class->class_id, $student_current_class->section_id, "Assignments");
        $data['list'] = $list;
        $this->load->view('layout/student/header');
        $this->load->view('user/content/assignment', $data);
        $this->load->view('layout/student/footer');
    }

    public function studymaterial() {
        $this->session->set_userdata('top_menu', 'Downloads');
        $this->session->set_userdata('sub_menu', 'content/studymaterial');
        $student_id = $this->customlib->getStudentSessionUserID();
        $student = $this->student_model->get($student_id);
      
        $data['title_list'] = 'List of Assignment';
        $student_current_class = $this->customlib->getStudentCurrentClsSection();

        $list = $this->content_model->getListByCategoryforUser($student_current_class->class_id, $student_current_class->section_id, "Study Material");
        $data['list'] = $list;
        $this->load->view('layout/student/header');
        $this->load->view('user/content/studymaterial', $data);
        $this->load->view('layout/student/footer');
    }

    public function syllabus() {
        $this->session->set_userdata('top_menu', 'Downloads');
        $this->session->set_userdata('sub_menu', 'content/syllabus');
        $student_id = $this->customlib->getStudentSessionUserID();
        $student = $this->student_model->get($student_id);   
        $data['title_list'] = 'List of Syllabus';
         $student_current_class = $this->customlib->getStudentCurrentClsSection();

        $list = $this->content_model->getListByCategoryforUser($student_current_class->class_id, $student_current_class->section_id,"Syllabus");
        $data['list'] = $list;
        $this->load->view('layout/student/header');
        $this->load->view('user/content/syllabus', $data);
        $this->load->view('layout/student/footer');
    }

    public function other() {
        $this->session->set_userdata('top_menu', 'Downloads');
        $this->session->set_userdata('sub_menu', 'content/other');
        $student_id = $this->customlib->getStudentSessionUserID();
        $student = $this->student_model->get($student_id);
      
        $data['title_list'] = 'List of Other Download';
        $student_current_class = $this->customlib->getStudentCurrentClsSection();
        $list = $this->content_model->getListByCategoryforUser($student_current_class->class_id, $student_current_class->section_id,"Other Download");
        $data['list'] = $list;
        $this->load->view('layout/student/header');
        $this->load->view('user/content/other', $data);
        $this->load->view('layout/student/footer');
    }

}

?>