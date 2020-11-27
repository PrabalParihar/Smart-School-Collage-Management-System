<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Generalcall extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model("general_call_model");
        
    }

    public function index() {
        if (!$this->rbac->hasPrivilege('phone_call_log', 'can_view')) {
            access_denied();
        }


        $this->session->set_userdata('top_menu', 'front_office');
        $this->session->set_userdata('sub_menu', 'admin/generalcall');

        $this->form_validation->set_rules('call_type',$this->lang->line('call_type'), 'required');
       
        $this->form_validation->set_rules('contact', $this->lang->line('contact'), 'required');
        $this->form_validation->set_rules('date', $this->lang->line('date'), 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['CallList'] = $this->general_call_model->call_list();
            $this->load->view('layout/header');
            $this->load->view('admin/frontoffice/generalcallview', $data);
            $this->load->view('layout/footer');
        } else { 
            $calls = array(
                'name' => $this->input->post('name'),
                'contact' => $this->input->post('contact'),
                'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                'description' => $this->input->post('description'),
                //'follow_up_date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('follow_up_date'))),
                'call_dureation' => $this->input->post('call_dureation'),
                'note' => $this->input->post('note'),
                'call_type' => $this->input->post('call_type')
            );
            if($_POST['follow_up_date']!=''){
                $calls['follow_up_date']=date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('follow_up_date')));
            }
            
          
            $this->general_call_model->add($calls);
            $this->session->set_flashdata('msg', '<div class="alert alert-success">'.$this->lang->line('success_message').'</div>');
            redirect('admin/generalcall');
        }
    }

    function edit($id) {
        if (!$this->rbac->hasPrivilege('phone_call_log', 'can_edit')) {
            access_denied();
        }
  
        $this->form_validation->set_rules('call_type',$this->lang->line('call_type'), 'required');
        
        $this->form_validation->set_rules('contact', $this->lang->line('contact'), 'required');
        $this->form_validation->set_rules('date', $this->lang->line('date'), 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['CallList'] = $this->general_call_model->call_list();
            $data['Call_data'] = $this->general_call_model->call_list($id);
            $this->load->view('layout/header');
            $this->load->view('admin/frontoffice/generalcalleditview', $data);
            $this->load->view('layout/footer');
        } else {
            $calls_update = array(
                'name' => $this->input->post('name'),
                'contact' => $this->input->post('contact'),
                'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                'description' => $this->input->post('description'),
                'follow_up_date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('follow_up_date'))),
                'call_dureation' => $this->input->post('call_dureation'),
                'note' => $this->input->post('note'),
                'call_type' => $this->input->post('call_type')
            );
           
            $this->general_call_model->call_update($id, $calls_update);
            $this->session->set_flashdata('msg', '<div class="alert alert-success">'.$this->lang->line('success_message').'</div>');
            redirect('admin/generalcall');
        }
    }

    function details($id) {
        if (!$this->rbac->hasPrivilege('phone_call_log', 'can_view')) {
            access_denied();
        }
        
        $data['Call_data'] = $this->general_call_model->call_list($id);
        $this->load->view('admin/frontoffice/Generalmodelview', $data);
    }

    function delete($id) {
        if (!$this->rbac->hasPrivilege('phone_call_log', 'can_delete')) {
            access_denied();
        }
        $this->general_call_model->delete($id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success">'.$this->lang->line('delete_message').'</div>');
        redirect('admin/generalcall');
    }

    public function check_default($post_string) {
        return $post_string == '' ? FALSE : TRUE;
    }

    function test() {

        $perm = $this->rbac->module_permission('student_information');
        if ($perm['is_active'] == '1') {
            echo "gc_disable()";
        }
    }

}
