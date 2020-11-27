<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Biometric extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('json_output');
        $this->load->model('setting_model');
        $this->load->model('student_model');
        $this->load->model('stuattendence_model');

    }

    public function index()
    {
        $method = $this->input->server('REQUEST_METHOD');
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {

            $attendence_param = file_get_contents('php://input');
            $params           = json_decode(file_get_contents('php://input'), true);
            $settings         = $this->setting_model->getSchoolDetail();
            if ($settings->biometric) {
                $total_devices = array_map('trim', explode(",", $settings->biometric_device));
                if (!empty($params)) {
                    if ($params['serial_number']) {
                        if (in_array($params['serial_number'], $total_devices)) {

                            $student = $this->student_model->findByAdmission($params['user_id']);
                            if ($student) {
                                $insert_record = array(
                                    'date'                  => date('Y-m-d', strtotime($params['t'])),
                                    'student_session_id'    => $student->student_session_id,
                                    'attendence_type_id'    => 1,
                                    'biometric_attendence'  => 1,
                                    'remark'                => '',
                                    'created_at'            => $params['t'],
                                    'biometric_device_data' => $attendence_param,
                                );
                                $insert_result = $this->stuattendence_model->onlineattendence($insert_record);
                                if ($insert_result) {
                                    json_output(200, array('status' => 200, 'message' => 'Record Inserted.'));
                                } else {
                                    json_output(200, array('status' => 200, 'message' => 'Something Wrong.'));
                                }
                            }

                        }
                    }
                }
            }
        }

    }

}
