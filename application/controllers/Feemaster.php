<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Feemaster extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'feemaster/index');
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required|xss_clean');
        $this->form_validation->set_rules('feecategory_id', 'Fees Category', 'trim|required|xss_clean');
        $this->form_validation->set_rules('feetype_id', 'Fees Type', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            $data = array(
                'feetype_id' => $this->input->post('feetype_id'),
                'class_id' => $this->input->post('class_id'),
                'amount' => $this->input->post('amount'),
                'description' => $this->input->post('description'),
            );
            $result = $this->feemaster_model->check_Exits_group($data);
            if ($result) {
                $this->feemaster_model->add($data);
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Fees added successfully</div>');
                redirect('feemaster/index');
            } else {
                $data ['error_message'] = 'Fee Master Combination already Exists';
            }
        }
        $data['title'] = 'Add Fees Master';
        $data['title_list'] = 'Fees Master List';
        $feemaster_result = $this->feemaster_model->get();
        $data['feemasterlist'] = $feemaster_result;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $feecategory = $this->feecategory_model->get(Null, 'asc');
        $data['feecategorylist'] = $feecategory;
        $this->load->view('layout/header', $data);
        $this->load->view('feemaster/feemasterList', $data);
        $this->load->view('layout/footer', $data);
    }

    function view($id) {
        $data['title'] = 'Fees Master List';
        $feemaster = $this->feemaster_model->get($id);
        $data['feemaster'] = $feemaster;
        $this->load->view('layout/header', $data);
        $this->load->view('feemaster/feemasterShow', $data);
        $this->load->view('layout/footer', $data);
    }

    function getByFeecategory() {
        $feecategory_id = $this->input->get('feecategory_id');
        $data = $this->feetype_model->getTypeByFeecategory($feecategory_id);
        echo json_encode($data);
    }

    function getStudentCategoryFee() {
        $type = $this->input->post('type');
        $class_id = $this->input->post('class_id');
        $data = $this->feemaster_model->getTypeByFeecategory($type, $class_id);
        if (empty($data)) {
            $status = 'fail';
        } else {
            $status = 'success';
        }
        $array = array('status' => $status, 'data' => $data);
        echo json_encode($array);
    }

    function delete($id) {
        $data['title'] = 'Fees Master List';
        $this->feemaster_model->remove($id);
        redirect('feemaster/index');
    }

    function create() {
        $data['title'] = 'Add Fees Master';
        $this->form_validation->set_rules('feemaster', 'Fees Master', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('feemaster/feemasterCreate', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'feemaster' => $this->input->post('feemaster'),
            );
            $this->feemaster_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Fees added successfully</div>');
            redirect('feemaster/index');
        }
    }

    function edit($id) {
        $data['title'] = 'Edit Fees Master';
        $data['id'] = $id;
        $feemaster = $this->feemaster_model->get($id);
        $data['feemaster'] = $feemaster;
        $data['title_list'] = 'Fees Master List';
        $feecategory = $this->feecategory_model->get(Null, 'asc');
        $data['feecategorylist'] = $feecategory;
        $feemaster_result = $this->feemaster_model->get();
        $data['feemasterlist'] = $feemaster_result;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('amount', 'Monthly Amount', 'trim|required|xss_clean');
        $this->form_validation->set_rules('feecategory_id', 'Fees Category', 'trim|required|xss_clean');
        $this->form_validation->set_rules('feetype_id', 'Fees Type', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('feemaster/feemasterEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id' => $id,
                'feetype_id' => $this->input->post('feetype_id'),
                'class_id' => $this->input->post('class_id'),
                'amount' => $this->input->post('amount'),
                'description' => $this->input->post('description'),
            );
            $this->feemaster_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Fees updated successfully</div>');
            redirect('feemaster/index');
        }
    }

}

?>