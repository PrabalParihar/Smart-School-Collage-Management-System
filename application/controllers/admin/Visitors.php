<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Visitors extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model("Visitors_model");
    }

    function index() {
        if (!$this->rbac->hasPrivilege('visitor_book', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'front_office');
        $this->session->set_userdata('sub_menu', 'admin/visitors');

        $this->form_validation->set_rules('purpose',$this->lang->line('purpose'), 'required');
        $this->form_validation->set_rules('name', $this->lang->line('name'), 'required');
        $this->form_validation->set_rules('date', $this->lang->line('date'), 'required');
       
        if ($this->form_validation->run() == FALSE) {
           
            $data['visitor_list'] = $this->Visitors_model->visitors_list();
            $data['Purpose'] = $this->Visitors_model->getPurpose();
            $this->load->view('layout/header');
            $this->load->view('admin/frontoffice/visitorview', $data);
            $this->load->view('layout/footer');
        } else {
            $visitors = array(
                'purpose' => $this->input->post('purpose'),
                'name' => $this->input->post('name'),
                'contact' => $this->input->post('contact'),
                'id_proof' => $this->input->post('id_proof'),
                'no_of_pepple' => $this->input->post('pepples'),
                'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                'in_time' => $this->input->post('time'),
                'out_time' => $this->input->post('out_time'),
                'note' => $this->input->post('note')
            );
            
            $visitor_id = $this->Visitors_model->add($visitors);
            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = 'id' . $visitor_id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/front_office/visitors/" . $img_name);
                $this->Visitors_model->image_add($visitor_id, $img_name);
            }

            $this->session->set_flashdata('msg', '<div class="alert alert-success">'.$this->lang->line('success_message').'</div>');
            redirect('admin/visitors');
        }
    }

    public function delete($id) {
        if (!$this->rbac->hasPrivilege('visitor_book', 'can_delete')) {
            access_denied();
        }
       
        $this->Visitors_model->delete($id);
    }

    public function edit($id) {
        if (!$this->rbac->hasPrivilege('visitor_book', 'can_edit')) {
            access_denied();
        }
       
        $this->form_validation->set_rules('purpose', $this->lang->line('purpose'), 'required');
        
        $this->form_validation->set_rules('name', $this->lang->line('name'), 'required');
        if ($this->form_validation->run() == FALSE) {
            
            $data['Purpose'] = $this->Visitors_model->getPurpose();
            $data['visitor_list'] = $this->Visitors_model->visitors_list();
            $data['visitor_data'] = $this->Visitors_model->visitors_list($id);
            $this->load->view('layout/header');
            $this->load->view('admin/frontoffice/visitoreditview', $data);
            $this->load->view('layout/footer');
        } else {
           
            $visitors = array(
                'purpose' => $this->input->post('purpose'),
                'name' => $this->input->post('name'),
                'contact' => $this->input->post('contact'),
                'id_proof' => $this->input->post('id_proof'),
                'no_of_pepple' => $this->input->post('pepples'),
                'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                'in_time' => $this->input->post('time'),
                'out_time' => $this->input->post('out_time'),
                'note' => $this->input->post('note')
            );
            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
              
                $img_name = 'id' . $id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/front_office/visitors/" . $img_name);
                $this->Visitors_model->image_update($id, $img_name);
            }
            $this->Visitors_model->update($id, $visitors);
             redirect('admin/visitors');
        }
    }

    public function details($id) {
        if (!$this->rbac->hasPrivilege('visitor_book', 'can_view')) {
            access_denied();
        }
       
        $data['data'] = $this->Visitors_model->visitors_list($id);
        $this->load->view('admin/frontoffice/Visitormodelview', $data);
    }

    public function download($documents) {
        $this->load->helper('download');
        $filepath = "./uploads/front_office/visitors/" . $documents;
        $data = file_get_contents($filepath);
        $name = $documents;
        force_download($name, $data);
    }

    public function imagedelete($id, $image) {
        if (!$this->rbac->hasPrivilege('visitor_book', 'can_delete')) {
            access_denied();
        }
        $this->Visitors_model->image_delete($id, $image);
    }

    public function check_default($post_string) {
        return $post_string == "" ? FALSE : TRUE;
    }

   

}
