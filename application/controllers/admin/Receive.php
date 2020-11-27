<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Receive extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
       
        $this->load->model("Dispatch_model");
    }

    public function index() {
        if (!$this->rbac->hasPrivilege('postal_receive', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'front_office');
        $this->session->set_userdata('sub_menu', 'admin/receive');
        $this->form_validation->set_rules('from_title',$this->lang->line('from_title'), 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['ReceiveList'] = $this->Dispatch_model->receive_list();
            $this->load->view('layout/header');
            $this->load->view('admin/frontoffice/receiveview', $data);
            $this->load->view('layout/footer');
        } else {
           
            $dispatch = array(
                'reference_no' => $this->input->post('ref_no'),
                'to_title' => $this->input->post('to_title'),
                'address' => $this->input->post('address'),
                'note' => $this->input->post('note'),
                'from_title' => $this->input->post('from_title'),
                'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                'type' => 'receive'
            );

            $dispatch_id = $this->Dispatch_model->insert('dispatch_receive', $dispatch);
            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = 'id' . $dispatch_id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/front_office/dispatch_receive/" . $img_name);
                $this->Dispatch_model->image_add('receive', $dispatch_id, $img_name);
            }

            $this->session->set_flashdata('msg', '<div class="alert alert-success">'.$this->lang->line('success_message').'</div>');
            redirect('admin/receive');
        }
    }

    function editreceive($id) {
        if (!$this->rbac->hasPrivilege('postal_receive', 'can_view')) {
            access_denied();
        }

        $this->form_validation->set_rules('from_title',$this->lang->line('from_title'), 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['receiveList'] = $this->Dispatch_model->receive_list();
            $data['receiveData'] = $this->Dispatch_model->dis_rec_data($id, 'receive');
            $this->load->view('layout/header');
            $this->load->view('admin/frontoffice/receiveedit', $data);
            $this->load->view('layout/footer');
        } else {
           
            $receive = array(
                'reference_no' => $this->input->post('ref_no'),
                'from_title' => $this->input->post('from_title'),
                'address' => $this->input->post('address'),
                'note' => $this->input->post('note'),
                'to_title' => $this->input->post('to_title'),
                'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                'type' => 'receive'
            );
          

            $this->Dispatch_model->update_dispatch('dispatch_receive', $id, 'receive', $receive);

            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = 'id' . $id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/front_office/dispatch_receive/" . $img_name);
                $this->Dispatch_model->image_update('dispatch', $id, $img_name);
            }
            $this->session->set_flashdata('msg', '<div class="alert alert-success">'.$this->lang->line('success_message').'</div>');
            redirect('admin/receive');
        }
    }

    public function delete($id) {
        if (!$this->rbac->hasPrivilege('postal_receive', 'can_delete')) {
            access_denied();
        }
      
        $this->Dispatch_model->delete($id);
    }

    public function imagedelete($id, $image) {
        if (!$this->rbac->hasPrivilege('postal_receive', 'can_delete')) {
            access_denied();
        }
        $this->Dispatch_model->image_delete($id, $image);
    }

}
