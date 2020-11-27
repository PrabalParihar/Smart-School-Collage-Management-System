<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vehicle extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {

        if (!$this->rbac->hasPrivilege('vehicle', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Transport');
        $this->session->set_userdata('sub_menu', 'vehicle/index');
        $data['title'] = 'Add Vehicle';
        $listVehicle = $this->vehicle_model->get();
        $data['listVehicle'] = $listVehicle;
        $this->form_validation->set_rules('vehicle_no', $this->lang->line('vehicle_no'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('layout/header');
            $this->load->view('admin/vehicle/index', $data);
            $this->load->view('layout/footer');
        } else {
            $manufacture_year = $this->input->post('manufacture_year');


            $data = array(
                'vehicle_no' => $this->input->post('vehicle_no'),
                'vehicle_model' => $this->input->post('vehicle_model'),
                'driver_name' => $this->input->post('driver_name'),
                'driver_licence' => $this->input->post('driver_licence'),
                'driver_contact' => $this->input->post('driver_contact'),
                'note' => $this->input->post('note'),
            );

            ($manufacture_year != "") ? $data['manufacture_year'] = $manufacture_year : '';
            $this->vehicle_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">'.$this->lang->line('success_message').'</div>');
            redirect('admin/vehicle/index');
        }
    }

    function edit($id) {

        if (!$this->rbac->hasPrivilege('vehicle', 'can_edit')) {
            access_denied();
        }
        $data['title'] = 'Add Vehicle';
        $data['id'] = $id;
        $editvehicle = $this->vehicle_model->get($id);

        $data['editvehicle'] = $editvehicle;
        $listVehicle = $this->vehicle_model->get();
        $data['listVehicle'] = $listVehicle;
        $this->form_validation->set_rules('vehicle_no', $this->lang->line('vehicle_no'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('layout/header');
            $this->load->view('admin/vehicle/edit', $data);
            $this->load->view('layout/footer');
        } else {
            $manufacture_year = $this->input->post('manufacture_year');
            $data = array(
                'id' => $this->input->post('id'),
                'vehicle_no' => $this->input->post('vehicle_no'),
                'vehicle_model' => $this->input->post('vehicle_model'),
                'driver_name' => $this->input->post('driver_name'),
                'driver_licence' => $this->input->post('driver_licence'),
                'driver_contact' => $this->input->post('driver_contact'),
                'note' => $this->input->post('note'),
            );
            ($manufacture_year != "") ? $data['manufacture_year'] = $manufacture_year : '';
            $this->vehicle_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">'.$this->lang->line('update_message').'</div>');
            redirect('admin/vehicle/index');
        }
    }

    function delete($id) {

        if (!$this->rbac->hasPrivilege('vehicle', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Fees Master List';
        $this->vehicle_model->remove($id);
        redirect('admin/vehicle/index');
    }

}

?>