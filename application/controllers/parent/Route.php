<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Route extends Parent_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = array();
        $this->session->set_userdata('top_menu', 'Transport');
        $this->session->set_userdata('sub_menu', 'route/index');
        $listroute = $this->vehroute_model->listroute();
        $data['listroute'] = $listroute;

        $child = $this->session->userdata('parent_childs');
        $student_array = array();
        foreach ($child as $key => $value) {

            $student = $this->student_model->get($value['student_id']);
            $student_array[] = $student;
        }

        $data['childs'] = $student_array;
        $this->load->view('layout/parent/header');
        $this->load->view('parent/route/index', $data);
        $this->load->view('layout/student/footer');
    }

    public function getbusdetail() {
        $vehrouteid = $this->input->post('vehrouteid');
        $result = $this->vehroute_model->getVechileDetailByVecRouteID($vehrouteid);
        echo json_encode($result);
    }

}

?>