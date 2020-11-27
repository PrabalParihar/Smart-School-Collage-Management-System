<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Complaint extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
      
        $this->load->model("complaint_Model");
       
    }

    public function index() {
        if (!$this->rbac->hasPrivilege('complaint', 'can_view')) {
            access_denied();
        }
 
        $this->session->set_userdata('top_menu', 'front_office');
        $this->session->set_userdata('sub_menu', 'admin/complaint');
        $this->form_validation->set_rules('name', $this->lang->line('complaint')." ".$this->lang->line('by'), 'required');
       

        if ($this->form_validation->run() == FALSE) {
            $data['complaint_list'] = $this->complaint_Model->complaint_list();
            $data['complaint_type'] = $this->complaint_Model->getComplaintType();
            $data['complaintsource'] = $this->complaint_Model->getComplaintSource();
            $this->load->view('layout/header');
            $this->load->view('admin/frontoffice/complaintview', $data);
            $this->load->view('layout/footer');
        } else {
            $complaint = array(
                'complaint_type' => $this->input->post('complaint'),
                'source' => $this->input->post('source'),
                'name' => $this->input->post('name'),
                'contact' => $this->input->post('contact'),
                'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                'description' => $this->input->post('description'),
                'action_taken' => $this->input->post('action_taken'),
                'assigned' => $this->input->post('assigned'),
                'note' => $this->input->post('note')
            );

            
            $complaint_id = $this->complaint_Model->add($complaint);
            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = 'id' . $complaint_id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/front_office/complaints/" . $img_name);
                $this->complaint_Model->image_add($complaint_id, $img_name);
            }

            $this->session->set_flashdata('msg', '<div class="alert alert-success">'.$this->lang->line('success_message'). '</div>');
            redirect('admin/complaint');
        }
    }

    function edit($id) {
        if (!$this->rbac->hasPrivilege('complaint', 'can_edit')) {
            access_denied();
        }
        $this->form_validation->set_rules('name', 'Complaint By', 'required');


        if ($this->form_validation->run() == FALSE) {
            $data['complaint_list'] = $this->complaint_Model->complaint_list();
            $data['complaint_data'] = $this->complaint_Model->complaint_list($id);
            $data['complaint_type'] = $this->complaint_Model->getComplaintType();
            $data['complaintsource'] = $this->complaint_Model->getComplaintSource();
            $this->load->view('layout/header');
            $this->load->view('admin/frontoffice/complainteditview', $data);
            $this->load->view('layout/footer');
        } else {
            $complaint = array(
                'complaint_type' => $this->input->post('complaint'),
                'source' => $this->input->post('source'),
                'name' => $this->input->post('name'),
                'contact' => $this->input->post('contact'),
                'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                'description' => $this->input->post('description'),
                'action_taken' => $this->input->post('action_taken'),
                'assigned' => $this->input->post('assigned'),
                'note' => $this->input->post('note')
            );

            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = 'id' . $id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/front_office/complaints/" . $img_name);
                $this->complaint_Model->image_add($id, $img_name);
            }
            $this->complaint_Model->compalaint_update($id, $complaint);
            $this->session->set_flashdata('msg', '<div class="alert alert-success">' . $this->lang->line('update_message') . '</div>');
            redirect('admin/complaint');
        }
    }

    function details($id) {
        if (!$this->rbac->hasPrivilege('complaint', 'can_view')) {
            access_denied();
        }
       
        $data['complaint_data'] = $this->complaint_Model->complaint_list($id);
        $this->load->view('admin/frontoffice/Complaintmodalview', $data);
    }

    public function delete($id) {
        if (!$this->rbac->hasPrivilege('complaint', 'can_delete')) {
            access_denied();
        }
       
        $this->complaint_Model->delete($id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success">'.$this->lang->line('delete_message').'</div>');

        redirect('admin/complaint');
    }

    function download($image) {
        $this->load->helper('download');
        $filepath = "./uploads/front_office/complaints/" . $image;
        $data = file_get_contents($filepath);
        $name = $image;
        force_download($name, $data);
    }

    function imagedelete($id, $image) {
        if (!$this->rbac->hasPrivilege('complaint', 'can_delete')) {
            access_denied();
        }
        $this->complaint_Model->image_delete($id, $image);
        $this->session->set_flashdata('msg', '<div class="alert alert-success">'.$this->lang->line('delete_message').'</div>');
        redirect('admin/complaint');
    }

    public function check_default($post_string) {
        return $post_string == "" ? FALSE : TRUE;
    }

}
