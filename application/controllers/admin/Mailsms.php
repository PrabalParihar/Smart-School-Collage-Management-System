<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Mailsms extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->library('smsgateway');
        $this->load->library('mailsmsconf');
        $this->load->model("classteacher_model");
        $this->mailer;
    }

    public function index()
    {
        if (!$this->rbac->hasPrivilege('email_sms_log', 'can_view')) {
            access_denied();

        }

        $this->session->set_userdata('top_menu', 'Communicate');
        $this->session->set_userdata('sub_menu', 'mailsms/index');
        $data['title']       = 'Add Mailsms';
        $listMessage         = $this->messages_model->get();
        $data['listMessage'] = $listMessage;
        $this->load->view('layout/header');
        $this->load->view('admin/mailsms/index', $data);
        $this->load->view('layout/footer');
    }

    public function search()
    {
        $keyword  = $this->input->post('keyword');
        $category = $this->input->post('category');
        $result   = array();
        if ($keyword != "" and $category != "") {
            if ($category == "student") {
                $result = $this->student_model->searchNameLike($keyword);
            } elseif ($category == "student_guardian") {
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

    public function compose()
    {
        if (!$this->rbac->hasPrivilege('email', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Communicate');
        $this->session->set_userdata('sub_menu', 'Communicate/mailsms/compose');
        $data['title']     = 'Add Mailsms';
        $class             = $this->class_model->get();
        $data['classlist'] = $class;
        $userdata          = $this->customlib->getUserData();
        $carray            = array();

        if (!empty($data["classlist"])) {
            foreach ($data["classlist"] as $ckey => $cvalue) {

                $carray[] = $cvalue["id"];
            }
        }
        $date          = date('Y-m-d');
        $birthDaysList = array();
        $birthStudents = $this->student_model->getBirthDayStudents($date, true);
        $birthStaff    = $this->staff_model->getBirthDayStaff($date, 1, true);

        if (!empty($birthStudents)) {
            $array = array();
            foreach ($birthStudents as $student_key => $student_value) {

                $array[] = array('name' => $student_value['firstname'] . " " . $student_value['lastname'], 'email' => $student_value['email']);
            }
            $birthDaysList['students'] = $array;
        }
        if (!empty($birthStaff)) {
            $array = array();
            foreach ($birthStaff as $staff_key => $staff_value) {

                $array[] = array('name' => $staff_value['name'], 'email' => $staff_value['email']);
            }
            $birthDaysList['staff'] = $array;
        }

        $data['roles']         = $this->role_model->get();
        $data['birthDaysList'] = $birthDaysList;

        $this->load->view('layout/header');
        $this->load->view('admin/mailsms/compose', $data);
        $this->load->view('layout/footer');
    }

    public function compose_sms()
    {
        if (!$this->rbac->hasPrivilege('sms', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Communicate');
        $this->session->set_userdata('sub_menu', 'mailsms/compose_sms');
        $data['title']     = 'Add Mailsms';
        $class             = $this->class_model->get();
        $data['classlist'] = $class;
        $userdata          = $this->customlib->getUserData();
        $carray            = array();
        $date              = date('Y-m-d');
        $birthDaysList     = array();
        $birthStudents     = $this->student_model->getBirthDayStudents($date, false, false);
        $birthStaff        = $this->staff_model->getBirthDayStaff($date, 1, false, false);

        if (!empty($birthStudents)) {
            $array = array();
            foreach ($birthStudents as $student_key => $student_value) {

                $array[] = array('name' => $student_value['firstname'] . " " . $student_value['lastname'], 
                    'contact_no' => $student_value['mobileno'],
                    'app_key' => $student_value['app_key'],
            );
            }
            $birthDaysList['students'] = $array;
        }
        if (!empty($birthStaff)) {
            $array = array();
            foreach ($birthStaff as $staff_key => $staff_value) {

                $array[] = array('name' => $staff_value['name'], 'contact_no' => $staff_value['contact_no']);
            }
            $birthDaysList['staff'] = $array;
        }

        if (!empty($data["classlist"])) {
            foreach ($data["classlist"] as $ckey => $cvalue) {

                $carray[] = $cvalue["id"];
            }
        }
        // }
        $data['roles']         = $this->role_model->get();
        $data['birthDaysList'] = $birthDaysList;

        $this->load->view('layout/header');
        $this->load->view('admin/mailsms/compose_sms', $data);
        $this->load->view('layout/footer');
    }

    public function edit($id)
    {
        $data['title'] = 'Add Vehicle';
        $data['id']    = $id;
        $editvehicle   = $this->vehicle_model->get($id);

        $data['editvehicle'] = $editvehicle;
        $listVehicle         = $this->vehicle_model->get();
        $data['listVehicle'] = $listVehicle;
        $this->form_validation->set_rules('vehicle_no', $this->lang->line('vehicle_no'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {

            $this->load->view('layout/header');
            $this->load->view('admin/mailsms/edit', $data);
            $this->load->view('layout/footer');
        } else {
            $manufacture_year = $this->input->post('manufacture_year');
            $data             = array(
                'id'             => $this->input->post('id'),
                'vehicle_no'     => $this->input->post('vehicle_no'),
                'vehicle_model'  => $this->input->post('vehicle_model'),
                'driver_name'    => $this->input->post('driver_name'),
                'driver_licence' => $this->input->post('driver_licence'),
                'driver_contact' => $this->input->post('driver_contact'),
                'note'           => $this->input->post('note'),
            );
            ($manufacture_year != "") ? $data['manufacture_year'] = $manufacture_year : '';
            $this->vehicle_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('update_message') . '</div>');
            redirect('admin/mailsms/index');
        }
    }

    public function delete($id)
    {
        $data['title'] = 'Fees Master List';
        $this->vehicle_model->remove($id);
        redirect('admin/mailsms/index');
    }

    public function send_individual()
    {

        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $this->form_validation->set_rules('individual_title', $this->lang->line('title'), 'required');
        $this->form_validation->set_rules('individual_message', $this->lang->line('message'), 'required');
        $this->form_validation->set_rules('user_list', $this->lang->line('recipient'), 'required');
        $this->form_validation->set_rules('individual_send_by', $this->lang->line('send_through'), 'required');
        if ($this->form_validation->run()) {

            $userlisting = json_decode($this->input->post('user_list'));
            $user_array  = array();
            foreach ($userlisting as $userlisting_key => $userlisting_value) {
                $array = array(
                    'category'      => $userlisting_value[0]->category,
                    'user_id'       => $userlisting_value[0]->record_id,
                    'email'         => $userlisting_value[0]->email,
                    'guardianEmail' => $userlisting_value[0]->guardianEmail,
                    'mobileno'      => $userlisting_value[0]->mobileno,
                );
                $user_array[] = $array;
            }

            $sms_mail = $this->input->post('individual_send_by');
            if ($sms_mail == "sms") {
                $send_sms  = 1;
                $send_mail = 0;
            } else {
                $send_sms  = 0;
                $send_mail = 1;
            }
            $message       = $this->input->post('individual_message');
            $message_title = $this->input->post('individual_title');
            $data          = array(
                'is_individual' => 1,
                'title'         => $message_title,
                'message'       => $message,
                'send_mail'     => $send_mail,
                'send_sms'      => $send_sms,
                'user_list'     => json_encode($user_array),
            );

            $this->messages_model->add($data);
            if (!empty($user_array)) {
                if ($send_mail) {
                    if (!empty($this->mail_config)) {
                        foreach ($user_array as $user_mail_key => $user_mail_value) {

                            if ($user_mail_value['email'] != "") {

                                $this->mailer->send_mail($user_mail_value['email'], $message_title, $message, $_FILES, $user_mail_value['guardianEmail']);
                            }

                        }
                    }
                }
                if ($send_sms) {
                    foreach ($user_array as $user_mail_key => $user_mail_value) {
                        if ($user_mail_value['mobileno'] != "") {

                            $this->smsgateway->sendSMS($user_mail_value['mobileno'], "", ($message));
                        }
                    }
                }
            }
            echo json_encode(array('status' => 0, 'msg' => $this->lang->line('message_sent_successfully')));
        } else {

            $data = array(
                'individual_title'   => form_error('individual_title'),
                'individual_message' => form_error('individual_message'),
                'individual_send_by' => form_error('individual_send_by'),
                'user_list'          => form_error('user_list'),
            );

            echo json_encode(array('status' => 1, 'msg' => $data));
        }
    }

    public function send_birthday()
    {
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $this->form_validation->set_rules('user[]', $this->lang->line('recipient'), 'required');
        $this->form_validation->set_rules('birthday_title', $this->lang->line('title'), 'required');
        $this->form_validation->set_rules('birthday_message', $this->lang->line('message'), 'required');
        $this->form_validation->set_rules('birthday_send_by', $this->lang->line('send_through'), 'required');
        if ($this->form_validation->run()) {
            $user_array = array();

            $sms_mail = $this->input->post('birthday_send_by');
            if ($sms_mail == "sms") {
                $send_sms  = 1;
                $send_mail = 0;
            } else {
                $send_sms  = 0;
                $send_mail = 1;
            }
            $message       = $this->input->post('birthday_message');
            $message_title = $this->input->post('birthday_title');
            $data          = array(
                'is_group'   => 1,
                'title'      => $message_title,
                'message'    => $message,
                'send_mail'  => $send_mail,
                'send_sms'   => $send_sms,
                'group_list' => json_encode(array()),
            );
            // $this->messages_model->add($data);

            $userlisting = $this->input->post('user[]');

            foreach ($userlisting as $users_key => $users_value) {
                $array = array(

                    'email'    => $users_value,
                    'mobileno' => $users_value,

                );
                $user_array[] = $array;
            }

            if (!empty($user_array)) {
                if ($send_mail) {
                    if (!empty($this->mail_config)) {
                        foreach ($user_array as $user_mail_key => $user_mail_value) {
                            if ($user_mail_value['email'] != "") {
                                $this->mailer->send_mail($user_mail_value['email'], $message_title, $message, $_FILES);
                            }
                        }
                    }
                }
                if ($send_sms) {
                    foreach ($user_array as $user_mail_key => $user_mail_value) {
                        if ($user_mail_value['mobileno'] != "") {
                            $this->smsgateway->sendSMS($user_mail_value['mobileno'], "", ($message));
                        }
                    }
                }
            }

            echo json_encode(array('status' => 0, 'msg' => $this->lang->line('message_sent_successfully')));
        } else {

            $data = array(
                'birthday_title'   => form_error('birthday_title'),
                'birthday_message' => form_error('birthday_message'),
                'birthday_send_by' => form_error('birthday_send_by'),
                'user[]'           => form_error('user[]'),
            );

            echo json_encode(array('status' => 1, 'msg' => $data));
        }
    }

    public function send_group()
    {
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $this->form_validation->set_rules('group_title', $this->lang->line('title'), 'required');
        $this->form_validation->set_rules('group_message', $this->lang->line('message'), 'required');
        $this->form_validation->set_rules('user[]', $this->lang->line('message') . " " . $this->lang->line('to'), 'required');
        $this->form_validation->set_rules('group_send_by', $this->lang->line('send_through'), 'required');
        if ($this->form_validation->run()) {
            $user_array = array();

            $sms_mail = $this->input->post('group_send_by');
            if ($sms_mail == "sms") {
                $send_sms  = 1;
                $send_mail = 0;
            } else {
                $send_sms  = 0;
                $send_mail = 1;
            }
            $message       = $this->input->post('group_message');
            $message_title = $this->input->post('group_title');
            $data          = array(
                'is_group'   => 1,
                'title'      => $message_title,
                'message'    => $message,
                'send_mail'  => $send_mail,
                'send_sms'   => $send_sms,
                'group_list' => json_encode(array()),
            );
            $this->messages_model->add($data);

            $userlisting = $this->input->post('user[]');
            foreach ($userlisting as $users_key => $users_value) {
                if ($users_value == "student") {
                    $student_array = $this->student_model->get();
                    if (!empty($student_array)) {
                        foreach ($student_array as $student_key => $student_value) {

                            $array = array(
                                'user_id'  => $student_value['id'],
                                'email'    => $student_value['email'],
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
                                'user_id'  => $parent_value['id'],
                                'email'    => $parent_value['guardian_email'],
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
                                'user_id'  => $staff_value['id'],
                                'email'    => $staff_value['email'],
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
                                $this->mailer->send_mail($user_mail_value['email'], $message_title, $message, $_FILES);
                            }
                        }
                    }
                }
                if ($send_sms) {
                    foreach ($user_array as $user_mail_key => $user_mail_value) {
                        if ($user_mail_value['mobileno'] != "") {
                            $this->smsgateway->sendSMS($user_mail_value['mobileno'], "", ($message));
                        }
                    }
                }
            }

            echo json_encode(array('status' => 0, 'msg' => $this->lang->line('message_sent_successfully')));
        } else {

            $data = array(
                'group_title'   => form_error('group_title'),
                'group_message' => form_error('group_message'),
                'group_send_by' => form_error('group_send_by'),
                'user[]'        => form_error('user[]'),
            );

            echo json_encode(array('status' => 1, 'msg' => $data));
        }
    }
 
    public function send_group_sms()
    {
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $this->form_validation->set_rules('group_title', $this->lang->line('title'), 'required');
        $this->form_validation->set_rules('group_message', $this->lang->line('message'), 'required');
        $this->form_validation->set_rules('user[]', $this->lang->line('message') . " " . $this->lang->line('to'), 'required');
        $this->form_validation->set_rules('group_send_by[]', $this->lang->line('send_through'), 'required');
        if ($this->form_validation->run()) {
            $user_array = array();

            $sms_mail = $this->input->post('group_send_by');

            $message       = $this->input->post('group_message');
            $message_title = $this->input->post('group_title');
            $data          = array(
                'is_group'   => 1,
                'title'      => $message_title,
                'message'    => $message,
                'send_mail'  => 0,
                'send_sms'   => 1,
                'group_list' => json_encode(array()),
            );
            $this->messages_model->add($data);

            $userlisting = $this->input->post('user[]');
            foreach ($userlisting as $users_key => $users_value) {
                if ($users_value == "student") {
                    $student_array = $this->student_model->get();

                    if (!empty($student_array)) {
                        foreach ($student_array as $student_key => $student_value) {

                            $array = array(
                                'user_id'  => $student_value['id'],
                                'email'    => $student_value['email'],
                                'mobileno' => $student_value['mobileno'],
                                'app_key'  => $student_value['app_key'],
                            );
                            $user_array[] = $array;
                        }
                    }
                } else if ($users_value == "parent") {
                    $parent_array = $this->student_model->get();
                    if (!empty($parent_array)) {
                        foreach ($parent_array as $parent_key => $parent_value) {
                            $array = array(
                                'user_id'  => $parent_value['id'],
                                'email'    => $parent_value['guardian_email'],
                                'mobileno' => $parent_value['guardian_phone'],
                                'app_key'  => $parent_value['app_key'],
                            );
                            $user_array[] = $array;
                        }
                    }
                } else if (is_numeric($users_value)) {

                    $staff = $this->staff_model->getEmployeeByRoleID($users_value);
                    if (!empty($staff)) {
                        foreach ($staff as $staff_key => $staff_value) {
                            $array = array(
                                'user_id'  => $staff_value['id'],
                                'email'    => $staff_value['email'],
                                'mobileno' => $staff_value['contact_no'],
                            );
                            $user_array[] = $array;
                        }
                    }
                }
            }

            if (!empty($user_array)) {

                foreach ($user_array as $user_mail_key => $user_mail_value) {
                    if (in_array("sms", $sms_mail)) {
                        if ($user_mail_value['mobileno'] != "") {
                            $this->smsgateway->sendSMS($user_mail_value['mobileno'], "", ($message));
                        }
                    }
                    if (in_array("push", $sms_mail)) {
                        $push_array = array(
                            'title' => $message_title,
                            'body'  => $this->customlib->getLimitChar($message));
                        if ($user_mail_value['app_key'] != "") {
                            $this->pushnotification->send($user_mail_value['app_key'], $push_array, "mail_sms");
                        }
                    }

                }

            }

            echo json_encode(array('status' => 0, 'msg' => $this->lang->line('message_sent_successfully')));
        } else {

            $data = array(
                'group_title'     => form_error('group_title'),
                
                'group_send_by[]' => form_error('group_send_by[]'),
                'group_message'   => form_error('group_message'),
                'user[]'          => form_error('user[]'),
            );

            echo json_encode(array('status' => 1, 'msg' => $data));
        }
    }

    public function send_birthday_sms()
    {
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $this->form_validation->set_rules('user[]', $this->lang->line('recipient'), 'required');
        $this->form_validation->set_rules('birthday_title', $this->lang->line('title'), 'required');
        $this->form_validation->set_rules('birthday_message', $this->lang->line('message'), 'required');
        $this->form_validation->set_rules('birthday_send_by[]', $this->lang->line('send_through'), 'required');
        if ($this->form_validation->run()) {
            $user_array      = array();
            $user_push_array = array();

            $sms_mail = $this->input->post('birthday_send_by');

            $message       = $this->input->post('birthday_message');
            $message_title = $this->input->post('birthday_title');
            $data          = array(
                'is_group'   => 1,
                'title'      => $message_title,
                'message'    => $message,
                'send_mail'  => 0,
                'send_sms'   => 1,
                'group_list' => json_encode(array()),
            );
            // $this->messages_model->add($data);

            $userlisting     = $this->input->post('user[]');
            $userpushlisting = $this->input->post('app-key');

            foreach ($userlisting as $users_key => $users_value) {
                $array = array(
                    'email'    => $users_value,
                    'mobileno' => $users_value,
                );
                $user_array[] = $array;
            }
            foreach ($userpushlisting as $user_push_key => $user_push_value) {
                $array = array(

                    'app-key' => $user_push_value,
                );
                $user_push_array[] = $array;
            }

            if (!empty($user_array)) {

                foreach ($user_array as $user_mail_key => $user_mail_value) {
                    if (in_array("sms", $sms_mail)) {
                        if ($user_mail_value['mobileno'] != "" && $user_mail_value['mobileno'] != 0) {
                            $this->smsgateway->sendSMS($user_mail_value['mobileno'], "", ($message));
                        }
                    }

                }

            }

            if (!empty($user_push_array)) {

                foreach ($user_push_array as $user_push_sms_key => $user_push_sms_value) {
                    if (in_array("push", $sms_mail)) {
                        $push_array = array(
                            'title' => $message_title,
                            'body'  => $this->customlib->getLimitChar($message));
                        if ($user_push_sms_value['app-key'] != "") {
                            $this->pushnotification->send($user_push_sms_value['app-key'], $push_array, "mail_sms");
                        }
                    }

                }

            }

            echo json_encode(array('status' => 0, 'msg' => $this->lang->line('message_sent_successfully')));
        } else {

            $data = array(
                'birthday_title'     => form_error('birthday_title'),
                'birthday_send_by[]' => form_error('birthday_send_by[]'),
                'birthday_message'   => form_error('birthday_message'),
                
                'user[]'             => form_error('user[]'),
            );

            echo json_encode(array('status' => 1, 'msg' => $data));
        }
    }

    public function send_individual_sms()
    {

        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $this->form_validation->set_rules('individual_title', $this->lang->line('title'), 'required');
        $this->form_validation->set_rules('individual_message', $this->lang->line('message'), 'required');
        $this->form_validation->set_rules('user_list', $this->lang->line('recipient'), 'required');
        $this->form_validation->set_rules('individual_send_by[]', $this->lang->line('send_through'), 'required');
        if ($this->form_validation->run()) {

            $userlisting = json_decode($this->input->post('user_list'));
            $user_array  = array();
            foreach ($userlisting as $userlisting_key => $userlisting_value) {
                $array = array(
                    'category'      => $userlisting_value[0]->category,
                    'user_id'       => $userlisting_value[0]->record_id,
                    'email'         => $userlisting_value[0]->email,
                    'guardianEmail' => $userlisting_value[0]->guardianEmail,
                    'mobileno'      => $userlisting_value[0]->mobileno,
                    'app_key'       => $userlisting_value[0]->app_key,
                );
                $user_array[] = $array;
            }

            $sms_mail = $this->input->post('individual_send_by');

            $message       = $this->input->post('individual_message');
            $message_title = $this->input->post('individual_title');
            $data          = array(
                'is_individual' => 1,
                'title'         => $message_title,
                'message'       => $message,
                'send_mail'     => 0,
                'send_sms'      => 1,
                'user_list'     => json_encode($user_array),
            );

            $this->messages_model->add($data);
            if (!empty($user_array)) {

                foreach ($user_array as $user_mail_key => $user_mail_value) {
                    if (in_array("sms", $sms_mail)) {

                        if ($user_mail_value['mobileno'] != "") {

                            $this->smsgateway->sendSMS($user_mail_value['mobileno'], "", ($message));
                        }
                    }
                    if (in_array("push", $sms_mail)) {
                        $push_array = array(
                            'title' => $message_title,
                            'body'  => $this->customlib->getLimitChar($message));
                        if ($user_mail_value['app_key'] != "") {
                            $this->pushnotification->send($user_mail_value['app_key'], $push_array, "mail_sms");
                        }
                    }
                }

            }
            echo json_encode(array('status' => 0, 'msg' => $this->lang->line('message_sent_successfully')));
        } else {

            $data = array(
                'individual_title'     => form_error('individual_title'),
                'individual_send_by[]' => form_error('individual_send_by[]'),
                'individual_message'   => form_error('individual_message'),
                
                'user_list'            => form_error('user_list'),
            );

            echo json_encode(array('status' => 1, 'msg' => $data));
        }
    }

    public function send_class_sms()
    {

        $this->form_validation->set_error_delimiters('<li>', '</li>');

        $this->form_validation->set_rules('class_title', $this->lang->line('title'), 'required');
        $this->form_validation->set_rules('class_message', $this->lang->line('message'), 'required');
        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'required');
        $this->form_validation->set_rules('user[]', $this->lang->line('recipient'), 'required');
        $this->form_validation->set_rules('class_send_by[]', $this->lang->line('send_through'), 'required');
        if ($this->form_validation->run()) {

            $sms_mail = $this->input->post('class_send_by');

            $message       = $this->input->post('class_message');
            $message_title = $this->input->post('class_title');
            $section       = $this->input->post('user[]');
            $class_id      = $this->input->post('class_id');

            $user_array = array();
            foreach ($section as $section_key => $section_value) {
                $userlisting = $this->student_model->searchByClassSection($class_id, $section_value);
                if (!empty($userlisting)) {
                    foreach ($userlisting as $userlisting_key => $userlisting_value) {
                        $array = array(
                            'user_id'  => $userlisting_value['id'],
                            'email'    => $userlisting_value['email'],
                            'mobileno' => $userlisting_value['mobileno'],
                            'app_key'  => $userlisting_value['app_key'],
                        );
                        $user_array[] = $array;
                    }
                }
            }

            $data = array(
                'is_class'  => 1,
                'title'     => $message_title,
                'message'   => $message,
                'send_mail' => 0,
                'send_sms'  => 1,
                'user_list' => json_encode($user_array),
            );
            $this->messages_model->add($data);
            if (!empty($user_array)) {

                foreach ($user_array as $user_mail_key => $user_mail_value) {
                    if (in_array("sms", $sms_mail)) {
                        if ($user_mail_value['mobileno'] != "") {

                            $this->smsgateway->sendSMS($user_mail_value['mobileno'], "", ($message));
                        }
                    }
                    if (in_array("push", $sms_mail)) {
                        $push_array = array(
                            'title' => $message_title,
                            'body'  => $this->customlib->getLimitChar($message));
                        if ($user_mail_value['app_key'] != "") {
                            $this->pushnotification->send($user_mail_value['app_key'], $push_array, "mail_sms");
                        }
                    }
                }

            }

            echo json_encode(array('status' => 0, 'msg' => $this->lang->line('message_sent_successfully')));
        } else {

            $data = array(
                'class_title'     => form_error('class_title'),
                'class_send_by[]' => form_error('class_send_by[]'),
                'class_message'   => form_error('class_message'),
                'class_id'        => form_error('class_id'),
                
                'user[]'          => form_error('user[]'),
            );

            echo json_encode(array('status' => 1, 'msg' => $data));
        }
    }

    public function send_class()
    {

        $this->form_validation->set_error_delimiters('<li>', '</li>');

        $this->form_validation->set_rules('class_title', $this->lang->line('title'), 'required');
        $this->form_validation->set_rules('class_message', $this->lang->line('message'), 'required');
        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'required');
        $this->form_validation->set_rules('user[]', $this->lang->line('recipient'), 'required');
        $this->form_validation->set_rules('class_send_by', $this->lang->line('send_through'), 'required');
        if ($this->form_validation->run()) {

            $sms_mail = $this->input->post('class_send_by');
            if ($sms_mail == "sms") {
                $send_sms  = 1;
                $send_mail = 0;
            } else {
                $send_sms  = 0;
                $send_mail = 1;
            }
            $message       = $this->input->post('class_message');
            $message_title = $this->input->post('class_title');
            $section       = $this->input->post('user[]');
            $class_id      = $this->input->post('class_id');

            $user_array = array();
            foreach ($section as $section_key => $section_value) {
                $userlisting = $this->student_model->searchByClassSection($class_id, $section_value);
                if (!empty($userlisting)) {
                    foreach ($userlisting as $userlisting_key => $userlisting_value) {
                        $array = array(
                            'user_id'  => $userlisting_value['id'],
                            'email'    => $userlisting_value['email'],
                            'mobileno' => $userlisting_value['mobileno'],
                        );
                        $user_array[] = $array;
                    }
                }
            }

            $data = array(
                'is_class'  => 1,
                'title'     => $message_title,
                'message'   => $message,
                'send_mail' => $send_mail,
                'send_sms'  => $send_sms,
                'user_list' => json_encode($user_array),
            );
            $this->messages_model->add($data);
            if (!empty($user_array)) {
                if ($send_mail) {
                    if (!empty($this->mail_config)) {
                        foreach ($user_array as $user_mail_key => $user_mail_value) {
                            if ($user_mail_value['email'] != "") {
                                $this->mailer->send_mail($user_mail_value['email'], $message_title, $message, $_FILES);
                            }
                        }
                    }
                }
                if ($send_sms) {
                    foreach ($user_array as $user_mail_key => $user_mail_value) {
                        if ($user_mail_value['mobileno'] != "") {

                            $this->smsgateway->sendSMS($user_mail_value['mobileno'], "", ($message));
                        }
                    }
                }
            }

            echo json_encode(array('status' => 0, 'msg' => $this->lang->line('message_sent_successfully')));
        } else {

            $data = array(
                'class_title'   => form_error('class_title'),
                'class_message' => form_error('class_message'),
                'class_id'      => form_error('class_id'),
                'class_send_by' => form_error('class_send_by'),
                'user[]'        => form_error('user[]'),
            );

            echo json_encode(array('status' => 1, 'msg' => $data));
        }
    }

    public function test_sms()
    {
        $this->form_validation->set_rules('mobile', $this->lang->line('mobile_number'), 'required');

        if ($this->form_validation->run() == false) {
            $msg = array(

                'mobile' => form_error('mobile'),

            );
            $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
        } else {

            $this->smsgateway->sendSMS($this->input->post('mobile'), ('Smart School SMS Test Successful.'));

            $array = array('status' => 'success', 'error' => '', 'message' => 'Test SMS Sent Successfully. Please check your mobile if you have received.');
        }
        echo json_encode($array);
    }

}
