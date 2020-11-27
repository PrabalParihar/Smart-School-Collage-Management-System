<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Userlog extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/userlog');
        $userlogList = $this->userlog_model->get();

        $data['userlogList'] = $userlogList;
        $data['userlogStaffList'] = $this->userlog_model->getByRoleStaff();

        $data['userlogStudentList'] = $this->userlog_model->getByRole('student');
        $data['userlogParentList'] = $this->userlog_model->getByRole('parent');
        $this->load->view('layout/header', $data);
        $this->load->view('admin/userlog/userlogList', $data);
        $this->load->view('layout/footer', $data);
    }

}

?>