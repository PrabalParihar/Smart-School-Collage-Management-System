<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Feetype extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->session->set_userdata('top_menu', 'Expenses');
        $this->session->set_userdata('sub_menu', 'expense/index');
        $data['title'] = 'Add Feetype';
        $data['title_list'] = 'Recent FeeType';

        $this->form_validation->set_rules(
                'code', 'Code', array(
            'required',
            array('check_exists', array($this->feetype_model, 'check_exists'))
                )
        );
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('ss', 'Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
            );
            $this->feetype_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">FeesGroup added successfully</div>');
            redirect('admin/feetype/index');
        }
        $feegroup_result = $this->feetype_model->get();
        $data['feetypeList'] = $feegroup_result;

        $this->load->view('layout/header', $data);
        $this->load->view('admin/feetype/feetypeList', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete($id) {
        $data['title'] = 'Fees Master List';
        $this->feetype_model->remove($id);
        redirect('admin/feetype/index');
    }

    function edit($id) {
        $data['id'] = $id;
        $feegroup = $this->feetype_model->get($id);
        $data['feegroup'] = $feegroup;
        $feegroup_result = $this->feetype_model->get();
        $data['feetypeList'] = $feegroup_result;
        $this->form_validation->set_rules(
                'name', 'Name', array(
            'required',
            array('check_exists', array($this->feetype_model, 'check_exists'))
                )
        );

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/feetype/feegroupEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id' => $id,
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
            );
            $this->feetype_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Feetype updated successfully</div>');
            redirect('admin/feetype/index');
        }
    }

}

?>