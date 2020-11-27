<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Enquiry extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model("enquiry_model");
        $this->config->load("payroll");
        $this->enquiry_status = $this->config->item('enquiry_status');
    }

    public function index() {
        

        if (!$this->rbac->hasPrivilege('admission_enquiry', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'front_office');
        $this->session->set_userdata('sub_menu', 'admin/enquiry');
        $data['class_list'] = $this->class_model->get();
        $data["source_select"] = "";
        $data["status"] = "";

        if (isset($_POST["search"])) {
            $enquiry_date = $this->input->post("enquiry_date");
            $source = $this->input->post("source");
            $status = $this->input->post("status");
            if (!empty($enquiry_date)) {
                $exp = explode(" - ", $enquiry_date);
                $date_from = date("Y-m-d", strtotime($exp[0]));
                $date_to = date("Y-m-d", strtotime($exp[1]));
            } else {
                $date_from = "";
                $date_to = "";
            }

            $data["source_select"] = $source;
            $data["status"] = $status;
            $enquiry_list = $this->enquiry_model->searchEnquiry($source, $status, $date_from, $date_to);
           
        } else {

            $enquiry_list = $this->enquiry_model->getenquiry_list();
        }
       
        foreach ($enquiry_list as $key => $value) {

            $follow_up = $this->enquiry_model->getFollowByEnquiry($value["id"]);

            $enquiry_list[$key]["followupdate"] = $follow_up["date"];
            $enquiry_list[$key]["next_date"] = $follow_up["next_date"];
            $enquiry_list[$key]["response"] = $follow_up["response"];
            $enquiry_list[$key]["note"] = $follow_up["note"];
            $enquiry_list[$key]["followup_by"] = $follow_up["followup_by"];
        }
        $data['enquiry_list'] = $enquiry_list;
        
        $data['enquiry_status'] = $this->enquiry_status;
      
        $data['Reference'] = $this->enquiry_model->get_reference();
        $data['sourcelist'] = $this->enquiry_model->getComplaintSource();

        $this->load->view('layout/header');
        $this->load->view('admin/frontoffice/enquiryview', $data);
        $this->load->view('layout/footer');
    }

    public function add() {
        if (!$this->rbac->hasPrivilege('admission_enquiry', 'can_add')) {
            access_denied();
        }

        $this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('contact', $this->lang->line('phone'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('source', $this->lang->line('source'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('date', $this->lang->line('date'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {

            $msg = array(
                'name' => form_error('name'),
                'contact' => form_error('contact'),
                'source' => form_error('source'),
                'date' => form_error('date'),
            );

            $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
        } else {
            $enquiry = array(
               
                'name' => $this->input->post('name'),
                'contact' => $this->input->post('contact'),
                'address' => $this->input->post('address'),
                'reference' => $this->input->post('reference'),
                'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                'description' => $this->input->post('description'),
                'follow_up_date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('follow_up_date'))),
                'note' => $this->input->post('note'),
                'source' => $this->input->post('source'),
                'email' => $this->input->post('email'),
                'assigned' => $this->input->post('assigned'),
                'class' => $this->input->post('class'),
                'no_of_child' => $this->input->post('no_of_child'),
                'status' => 'active'
            );
            $this->enquiry_model->add($enquiry);
            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        }
        echo json_encode($array);
    }

    public function delete($id) {
        if (!$this->rbac->hasPrivilege('admission_enquiry', 'can_delete')) {
            access_denied();
        }
        if (!empty($id)) {
            $this->enquiry_model->enquiry_delete($id);
            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('delete_message'));
        }
        echo json_encode($array);
        
    }



 public function follow_up($enquiry_id, $status) {
   
         if(!$this->rbac->hasPrivilege('follow_up_admission_enquiry','can_view')){
        access_denied();
        }
        $data['id'] = $enquiry_id;
        $data['enquiry_data'] = $this->enquiry_model->getenquiry_list($enquiry_id, $status);
        $data['next_date']=$this->enquiry_model->next_follow_up_date($enquiry_id);
        $data['enquiry_status'] = $this->enquiry_status ;

        $this->load->view('admin/frontoffice/follow_up_modal', $data);
    }

    function follow_up_insert() {
        if (!$this->rbac->hasPrivilege('follow_up_admission_enquiry', 'can_add')) {
            access_denied();
        }

        $this->form_validation->set_rules('response', $this->lang->line('response'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('date', $this->lang->line('follow_up_date'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('follow_up_date', $this->lang->line('next_follow_up_date'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {

            $msg = array(
                'response' => form_error('response'),
                'follow_up_date' => form_error('follow_up_date'),
                'date' => form_error('date'),
            );

            $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
        } else {
            $admin = $this->customlib->getLoggedInUserData();
            $follow_up = array(
                'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                'next_date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('follow_up_date'))),
                'response' => $this->input->post('response'),
                'note' => $this->input->post('note'),
                'followup_by' => $admin['username'],
                'enquiry_id' => $this->input->post('enquiry_id')
            );
            $this->enquiry_model->add_follow_up($follow_up);

            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        }

        echo json_encode($array);
    }

    function follow_up_list($id) {

        $data['id'] = $id;
        $data['follow_up_list'] = $this->enquiry_model->getfollow_up_list($id);
        $this->load->view('admin/frontoffice/followuplist', $data);
    }

    function details($id,$status) {

        if (!$this->rbac->hasPrivilege('admission_enquiry', 'can_view')) {
            access_denied();
        }

        $data['source'] = $this->enquiry_model->getComplaintSource();
        $data['enquiry_type'] = $this->enquiry_model->get_enquiry_type();
        $data['Reference'] = $this->enquiry_model->get_reference();
        $data['class_list'] = $this->enquiry_model->getclasses();
        $data['enquiry_data'] = $this->enquiry_model->getenquiry_list($id,$status);

        $this->load->view('admin/frontoffice/enquiryeditmodalview', $data);

    }

    function editpost($id) {

        if (!$this->rbac->hasPrivilege('admission_enquiry', 'can_edit')) {
            access_denied();
        }
        
        $this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('contact', $this->lang->line('contact'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('source', $this->lang->line('source'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('date', $this->lang->line('date'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {

            $msg = array(
                'name' => form_error('name'),
                'contact' => form_error('contact'),
                'source' => form_error('source'),
                'date' => form_error('date'),
            );

            $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
        } else {
            $enquiry_update = array(
                'name' => $this->input->post('name'),
                'contact' => $this->input->post('contact'),
                'address' => $this->input->post('address'),
                'reference' => $this->input->post('reference'),
                'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                'description' => $this->input->post('description'),
                'follow_up_date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('follow_up_date'))),
                'note' => $this->input->post('note'),
                'source' => $this->input->post('source'),
                'email' => $this->input->post('email'),
                'assigned' => $this->input->post('assigned'),
                'class' => $this->input->post('class'),
                'no_of_child' => $this->input->post('no_of_child')
            );
            $this->enquiry_model->enquiry_update($id, $enquiry_update);
            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('update_message'));
        }

        echo json_encode($array);
        
    }

    public function follow_up_delete($follow_up_id, $enquiry_id) {
        if (!$this->rbac->hasPrivilege('follow_up_admission_enquiry', 'can_delete')) {
            access_denied();
        }
        $this->enquiry_model->delete_follow_up($follow_up_id);
        $data['id'] = $enquiry_id;
        $data['follow_up_list'] = $this->enquiry_model->getfollow_up_list($enquiry_id);
       
        $this->load->view('admin/frontoffice/followuplist', $data);
    }

    public function check_default($post_string) {
        return $post_string == '' ? FALSE : TRUE;
    }

    public function change_status() {

        $id = $this->input->post("id");
        $status = $this->input->post("status");

        if (!empty($id)) {
            $data = array('id' => $id, 'status' => $status);

            $this->enquiry_model->changeStatus($data);
            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        } else {

            $array = array('status' => 'fail', 'error' => '', 'message' =>$this->lang->line('update_message'));
        }

        echo json_encode($array);
    }

}
