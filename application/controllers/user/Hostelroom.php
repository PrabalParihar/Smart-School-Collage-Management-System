<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hostelroom extends Student_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $roomtypelist = $this->roomtype_model->get();
        $data['roomtypelist'] = $roomtypelist;
        $hostellist = $this->hostel_model->get();
        $data['hostellist'] = $hostellist;
         $student_id = $this->customlib->getStudentSessionUserID();
        $student = $this->student_model->get($student_id);
        $data['studentList'] = $student;
        $this->session->set_userdata('top_menu', 'Hostel');
        $this->session->set_userdata('sub_menu', 'hostelroom/index');
        $hostelroomlist = $this->hostelroom_model->lists();
        $data['hostelroomlist'] = $hostelroomlist;
        $this->load->view('layout/student/header');
        $this->load->view('user/hostelroom/create', $data);
        $this->load->view('layout/student/footer');
    }

    function create() {
        $roomtypelist = $this->roomtype_model->get();
        $data['roomtypelist'] = $roomtypelist;
        $hostellist = $this->hostel_model->get();
        $data['hostellist'] = $hostellist;
        $data['title'] = 'Add Library';
        $hostelroomlist = $this->hostelroom_model->lists();
        $data['hostelroomlist'] = $hostelroomlist;
        $this->form_validation->set_rules('hostel_id', 'Hostel', 'trim|required|xss_clean');
        $this->form_validation->set_rules('room_type_id', 'Room Type', 'trim|required|xss_clean');
        $this->form_validation->set_rules('room_no', 'Room No', 'trim|required|xss_clean');
        $this->form_validation->set_rules('no_of_bed', 'No of Bed', 'trim|required|xss_clean');
        $this->form_validation->set_rules('cost_per_bed', 'Cost Per Bed', 'trim|required|xss_clean');
        $hostellist = $this->hostel_model->get();
        $data['hostellist'] = $hostellist;
        $roomtypelist = $this->roomtype_model->get();
        $data['roomtypelist'] = $roomtypelist;
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header');
            $this->load->view('admin/hostelroom/create', $data);
            $this->load->view('layout/footer');
        } else {
            $data = array(
                'hostel_id' => $this->input->post('hostel_id'),
                'room_type_id' => $this->input->post('room_type_id'),
                'room_no' => $this->input->post('room_no'),
                'no_of_bed' => $this->input->post('no_of_bed'),
                'cost_per_bed' => $this->input->post('cost_per_bed'),
            );
            $this->hostelroom_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Hostel Room added successfully</div>');
            redirect('admin/hostelroom/index');
        }
    }

    function edit($id) {
        $data['title'] = 'Add Hostel';
        $data['id'] = $id;
        $hostellist = $this->hostel_model->get();
        $data['hostellist'] = $hostellist;
        $roomtypelist = $this->roomtype_model->get();
        $data['roomtypelist'] = $roomtypelist;
        $hostelroom = $this->hostelroom_model->get($id);
        $data['hostelroom'] = $hostelroom;
        $hostelroomlist = $this->hostelroom_model->lists();
        $data['hostelroomlist'] = $hostelroomlist;
        $this->form_validation->set_rules('hostel_id', 'Hostel', 'trim|required|xss_clean');
        $this->form_validation->set_rules('room_type_id', 'Room Type', 'trim|required|xss_clean');
        $this->form_validation->set_rules('room_no', 'Room No', 'trim|required|xss_clean');
        $this->form_validation->set_rules('no_of_bed', 'No of Bed', 'trim|required|xss_clean');
        $this->form_validation->set_rules('cost_per_bed', 'Cost Per Bed', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header');
            $this->load->view('admin/hostelroom/edit', $data);
            $this->load->view('layout/footer');
        } else {
            $data = array(
                'id' => $this->input->post('id'),
                'hostel_id' => $this->input->post('hostel_id'),
                'room_type_id' => $this->input->post('room_type_id'),
                'room_no' => $this->input->post('room_no'),
                'no_of_bed' => $this->input->post('no_of_bed'),
                'cost_per_bed' => $this->input->post('cost_per_bed'),
            );
            $this->hostelroom_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Hostel Room updated successfully</div>');
            redirect('admin/hostelroom/index');
        }
    }

    function delete($id) {
        $data['title'] = 'Fees Master List';
        $this->hostelroom_model->remove($id);
        redirect('admin/hostelroom/index');
    }

}

?>