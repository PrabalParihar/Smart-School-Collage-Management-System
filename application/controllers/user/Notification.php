<?php
 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notification extends Student_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->session->set_userdata('top_menu', 'notification');
        $data['title'] = 'Notifications';
        $student_id = $this->customlib->getStudentSessionUserID();
        $student = $this->student_model->get($student_id);
      
        $notifications = $this->notification_model->getNotificationForStudent($student_id);
        $data['notificationlist'] = $notifications;
        $this->load->view('layout/student/header', $data);
        $this->load->view('user/notification/notificationList', $data);
        $this->load->view('layout/student/footer', $data);
    }

    function updatestatus() {
        $notification_id = $this->input->post('notification_id');
        $student_id = $this->customlib->getStudentSessionUserID();
        $data = $this->notification_model->updateStatus($notification_id, $student_id);
        $array = array('status' => "success", 'data' => $data);
        echo json_encode($array);
    } 

    function read(){
        $array           = array('status' => "fail", 'msg' => $this->lang->line('somthing_wrong'));
        $notification_id = $this->input->post('notice');
        if ($notification_id != "") {
            $student_id = $this->customlib->getStudentSessionUserID();
            $data    = $this->notification_model->updateStatusforStudent($notification_id, $student_id);
            $array   = array('status' => "success", 'data' => $data, 'msg' => $this->lang->line('update_message'));
        }

        echo json_encode($array);
    }

}

?>