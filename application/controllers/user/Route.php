<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Route extends Student_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->session->set_userdata('top_menu', 'Transport');
        $this->session->set_userdata('sub_menu', 'route/index');
        $student_id = $this->customlib->getStudentSessionUserID();
        $student = $this->student_model->get($student_id);
        $data['studentList'] = $student;
        $listroute = $this->vehroute_model->listroute();
        $data['listroute'] = $listroute;
        $this->load->view('layout/student/header');
        $this->load->view('user/route/index', $data);
        $this->load->view('layout/student/footer');
    }

    public function getbusdetail() {
        $vehrouteid = $this->input->post('vehrouteid');
        $result = $this->vehroute_model->getVechileDetailByVecRouteID($vehrouteid);
        echo json_encode($result);
    }

}

?>