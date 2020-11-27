<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hostelroom extends Parent_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $roomtypelist = $this->roomtype_model->get();
        $data['roomtypelist'] = $roomtypelist;
        $hostellist = $this->hostel_model->get();
        $data['hostellist'] = $hostellist;
        $this->session->set_userdata('top_menu', 'Hostel');
        $this->session->set_userdata('sub_menu', 'parent/hostelroom');
        $hostelroomlist = $this->hostelroom_model->lists();
        $data['hostelroomlist'] = $hostelroomlist;
        $this->load->view('layout/parent/header');
        $this->load->view('parent/hostelroom/create', $data);
        $this->load->view('layout/parent/footer');
    }

}

?>