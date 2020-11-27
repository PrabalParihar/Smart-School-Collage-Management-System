<?php

/**
 * 
 */
class Timeline extends Student_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function add() {

        $this->form_validation->set_rules('timeline_title', 'Title', 'trim|required|xss_clean');

        $title = $this->input->post("timeline_title");

        if ($this->form_validation->run() == FALSE) {

            $msg = array(
                'timeline_title' => form_error('timeline_title'),
            );

            $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
        } else {
            $timeline = array(
                'title' => $this->input->post('timeline_title'),
                'status' => '',
                'date' => date('Y-m-d'),
                'student_id' => $this->input->post('student_id'));

            $id = $this->timeline_model->add($data);

            if (isset($_FILES["timeline_doc"]) && !empty($_FILES['timeline_doc']['name'])) {
                $uploaddir = './uploads/homework/';
                if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
                    die("Error creating folder $uploaddir");
                }
                $fileInfo = pathinfo($_FILES["timeline_doc"]["name"]);
                $document = basename($_FILES['timeline_doc']['name']);

                $img_name = $id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["timeline_doc"]["tmp_name"], $uploaddir . $img_name);
            } else {

                $document = "";
            }

            $upload_data = array('id' => $id, 'document' => $document);
            $this->timeline_model->add($upload_data);
            $msg = "Timeline Added Successfully";
            $array = array('status' => 'success', 'error' => '', 'message' => $msg);
        }
        echo json_encode($array);
    }

}

?>