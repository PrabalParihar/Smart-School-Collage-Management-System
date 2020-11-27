<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mailsms extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library('smsgateway');
        $this->load->library('mailsmsconf');
        $this->load->model("classteacher_model");
        $this->mailer;
    }

    public function index() {

        $this->session->set_userdata('top_menu', 'Communicate');
        $this->session->set_userdata('sub_menu', 'mailsms/index');
        $data['title'] = 'Add Mailsms';
        $listMessage = $this->messages_model->get();
        $data['listMessage'] = $listMessage;

        $this->load->view('layout/header');
        $this->load->view('admin/mailsms/index', $data);
        $this->load->view('layout/footer');
    }

    public function search() {
        $keyword = $this->input->post('keyword');
        $category = $this->input->post('category');
        $result = array();
        if ($keyword != "" and $category != "") {
            if ($category == "student") {
                $result = $this->student_model->searchNameLike($keyword);
            } elseif ($category == "parent") {

                $result = $this->student_model->searchGuardianNameLike($keyword);
            } elseif ($category == "staff") {
                $result = $this->staff_model->searchNameLike($keyword);
            } else {
                
            }
        }
        echo json_encode($result);
    }

    public function compose() {
        if (!$this->rbac->hasPrivilege('email_sms', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Communicate');
        $this->session->set_userdata('sub_menu', 'mailsms/compose');
        $data['title'] = 'Add Mailsms';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();
        $carray = array();
        //  if(($userdata["role_id"] == 2) && ($userdata["class_teacher"] == "yes")){
        // $data["classlist"] =   $this->customlib->getClassbyteacher($userdata["id"]);


        if (!empty($data["classlist"])) {
            foreach ($data["classlist"] as $ckey => $cvalue) {

                $carray[] = $cvalue["id"];
            }
        }
        // } 
        $data['roles'] = $this->role_model->get();

        $this->load->view('layout/header');
        $this->load->view('admin/mailsms/compose', $data);
        $this->load->view('layout/footer');
    }

    function edit($id) {
        $data['title'] = 'Add Vehicle';
        $data['id'] = $id;
        $editvehicle = $this->vehicle_model->get($id);

        $data['editvehicle'] = $editvehicle;
        $listVehicle = $this->vehicle_model->get();
        $data['listVehicle'] = $listVehicle;
        $this->form_validation->set_rules('vehicle_no', 'Vehicle No', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('layout/header');
            $this->load->view('admin/mailsms/edit', $data);
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
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Transport updated successfully</div>');
            redirect('admin/mailsms/index');
        }
    }

    function delete($id) {
        $data['title'] = 'Fees Master List';
        $this->vehicle_model->remove($id);
        redirect('admin/mailsms/index');
    }

    public function send_individual() {

        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $this->form_validation->set_rules('individual_title', 'Title', 'required');
        $this->form_validation->set_rules('individual_message', 'Message', 'required');
        $this->form_validation->set_rules('user_list', 'Recipient', 'required');
        $this->form_validation->set_rules('individual_send_by[]', 'Send Through', 'required');
        if ($this->form_validation->run()) {
            $userlisting = json_decode($this->input->post('user_list'));
            $user_array = array();
            foreach ($userlisting as $userlisting_key => $userlisting_value) {
                $array = array(
                    'category' => $userlisting_value[0]->category,
                    'user_id' => $userlisting_value[0]->record_id,
                    'email' => $userlisting_value[0]->email,
                    'mobileno' => $userlisting_value[0]->mobileno,
                );
                $user_array[] = $array;
            }

            $sms_mail = $this->input->post('individual_send_by[]');
            $send_mail = in_array('mail', $sms_mail) ? 1 : 0;
            $send_sms = in_array('sms', $sms_mail) ? 1 : 0;
            $message = $this->input->post('individual_message');
            $message_title = $this->input->post('individual_title');
            $data = array(
                'is_individual' => 1,
                'title' => $message_title,
                'message' => $message,
                'send_mail' => $send_mail,
                'send_sms' => $send_sms,
                'user_list' => json_encode($user_array)
            );

            $this->messages_model->add($data);
            if (!empty($user_array)) {
                if ($send_mail) {
                    if (!empty($this->mail_config)) {
                        foreach ($user_array as $user_mail_key => $user_mail_value) {
                            if ($user_mail_value['email'] != "") {
                                $this->mailer->send_mail($user_mail_value['email'], $message_title, $message);
                            }
                        }
                    }
                }
                if ($send_sms) {
                    foreach ($user_array as $user_mail_key => $user_mail_value) {
                        if ($user_mail_value['mobileno'] != "") {

                            $this->smsgateway->sendSMS($user_mail_value['mobileno'], strip_tags($message));
                        }
                    }
                }
            }
            echo json_encode(array('status' => 0, 'msg' => "Message sent successfully"));
        } else {

            $data = array(
                'individual_title' => form_error('individual_title'),
                'individual_message' => form_error('individual_message'),
                'individual_send_by[]' => form_error('individual_send_by[]'),
                'user_list' => form_error('user_list')
            );

            echo json_encode(array('status' => 1, 'msg' => $data));
        }
    }

    public function send_group() {

        $this->form_validation->set_error_delimiters('<li>', '</li>');

        $this->form_validation->set_rules('group_title', 'Title', 'required');
        $this->form_validation->set_rules('group_message', 'Message', 'required');
        $this->form_validation->set_rules('user[]', 'Recipient', 'required');
        $this->form_validation->set_rules('group_send_by[]', 'Send Through', 'required');
        if ($this->form_validation->run()) {
            $user_array = array();


            $sms_mail = $this->input->post('group_send_by[]');
            $send_mail = in_array('mail', $sms_mail) ? 1 : 0;
            $send_sms = in_array('sms', $sms_mail) ? 1 : 0;
            $message = $this->input->post('group_message');
            $message_title = $this->input->post('group_title');
            $data = array(
                'is_group' => 1,
                'title' => $message_title,
                'message' => $message,
                'send_mail' => $send_mail,
                'send_sms' => $send_sms,
                'group_list' => json_encode(array())
            );
            $this->messages_model->add($data);



            $userlisting = $this->input->post('user[]');
            foreach ($userlisting as $users_key => $users_value) {
                if ($users_value == "student") {
                    $student_array = $this->student_model->get();
                    if (!empty($student_array)) {
                        foreach ($student_array as $student_key => $student_value) {

                            $array = array(
                                'user_id' => $student_value['id'],
                                'email' => $student_value['email'],
                                'mobileno' => $student_value['mobileno'],
                            );
                            $user_array[] = $array;
                        }
                    }
                } else if ($users_value == "parent") {
                    $parent_array = $this->student_model->get();
                    if (!empty($parent_array)) {
                        foreach ($parent_array as $parent_key => $parent_value) {
                            $array = array(
                                'user_id' => $parent_value['id'],
                                'email' => $parent_value['guardian_email'],
                                'mobileno' => $parent_value['guardian_phone'],
                            );
                            $user_array[] = $array;
                        }
                    }
                } else if (is_numeric($users_value)) {


                    $staff = $this->staff_model->getEmployeeByRoleID($users_value);
                    if (!empty($staff)) {
                        foreach ($staff as $staff_key => $staff_value) {
                            $array = array(
                                'user_id' => $staff_value['id'],
                                'email' => $staff_value['email'],
                                'mobileno' => $staff_value['contact_no'],
                            );
                            $user_array[] = $array;
                        }
                    }
                }
            }


            if (!empty($user_array)) {
                if ($send_mail) {
                    if (!empty($this->mail_config)) {
                        foreach ($user_array as $user_mail_key => $user_mail_value) {
                            if ($user_mail_value['email'] != "") {
                                $this->mailer->send_mail($user_mail_value['email'], $message_title, $message);
                            }
                        }
                    }
                }
                if ($send_sms) {
                    foreach ($user_array as $user_mail_key => $user_mail_value) {
                        if ($user_mail_value['mobileno'] != "") {
                            $this->smsgateway->sendSMS($user_mail_value['mobileno'], strip_tags($message));
                        }
                    }
                }
            }


            echo json_encode(array('status' => 0, 'msg' => "Message sent successfully"));
        } else {

            $data = array(
                'group_title' => form_error('group_title'),
                'group_message' => form_error('group_message'),
                'group_send_by[]' => form_error('group_send_by[]'),
                'user[]' => form_error('user[]')
            );

            echo json_encode(array('status' => 1, 'msg' => $data));
        }
    }

    public function send_class() {

        $this->form_validation->set_error_delimiters('<li>', '</li>');

        $this->form_validation->set_rules('class_title', 'Title', 'required');
        $this->form_validation->set_rules('class_message', 'Message', 'required');
        $this->form_validation->set_rules('class_id', 'Class', 'required');
        $this->form_validation->set_rules('user[]', 'Recipient', 'required');
        $this->form_validation->set_rules('class_send_by[]', 'Send Through', 'required');
        if ($this->form_validation->run()) {

            $sms_mail = $this->input->post('class_send_by[]');
            $send_mail = in_array('mail', $sms_mail) ? 1 : 0;
            $send_sms = in_array('sms', $sms_mail) ? 1 : 0;
            $message = $this->input->post('class_message');
            $message_title = $this->input->post('class_title');
            $section = $this->input->post('user[]');
            $class_id = $this->input->post('class_id');

            $user_array = array();
            foreach ($section as $section_key => $section_value) {

                $userlisting = $this->student_model->searchByClassSection($class_id, $section_value);
                //  print_r($userlisting);
                if (!empty($userlisting)) {
                    foreach ($userlisting as $userlisting_key => $userlisting_value) {

                        $array = array(
                            'user_id' => $userlisting_value['id'],
                            'email' => $userlisting_value['email'],
                            'mobileno' => $userlisting_value['mobileno'],
                        );
                        $user_array[] = $array;
                    }
                }
            }

            $data = array(
                'is_class' => 1,
                'title' => $message_title,
                'message' => $message,
                'send_mail' => $send_mail,
                'send_sms' => $send_sms,
                'user_list' => json_encode($user_array)
            );
            $this->messages_model->add($data);
            if (!empty($user_array)) {
                if ($send_mail) {
                    if (!empty($this->mail_config)) {
                        foreach ($user_array as $user_mail_key => $user_mail_value) {
                            if ($user_mail_value['email'] != "") {
                                $this->mailer->send_mail($user_mail_value['email'], $message_title, $message);
                            }
                        }
                    }
                }
                if ($send_sms) {
                    foreach ($user_array as $user_mail_key => $user_mail_value) {
                        if ($user_mail_value['mobileno'] != "") {

                            $this->smsgateway->sendSMS($user_mail_value['mobileno'], strip_tags($message));
                        }
                    }
                }
            }


            echo json_encode(array('status' => 0, 'msg' => "Message sent successfully"));
        } else {

            $data = array(
                'class_title' => form_error('class_title'),
                'class_message' => form_error('class_message'),
                'class_id' => form_error('class_id'),
                'class_send_by[]' => form_error('class_send_by[]'),
                'user[]' => form_error('user[]')
            );

            echo json_encode(array('status' => 1, 'msg' => $data));
        }
    }

}

?>