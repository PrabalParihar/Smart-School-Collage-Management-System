<?php

/**
 * 
 */
class Homework extends Parent_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library("customlib");
        $this->load->model("homework_model");
        $this->load->model("staff_model");
        $this->load->model("student_model");
    }

    public function student_homework($student_id) {

        $this->session->set_userdata('top_menu', 'Homework');
        $this->session->set_userdata('sub_menu', 'parent/homework/student_homework/' . $student_id);
          $student = $this->student_model->get($student_id);
  

        $class_id = $student["class_id"];
        $section_id = $student["section_id"];
        $student_session_id=$student['student_session_id'];
        // $homeworklist = $this->homework_model->getStudentHomework($class_id, $section_id);

        $homeworklist = $this->homework_model->getStudentHomeworkWithStatus($class_id, $section_id,$student_session_id);
        //echo $this->db->last_query();die;
        $data["homeworklist"] = $homeworklist;
        $data["class_id"] = $class_id;
        $data["section_id"] = $section_id;
        $data["student_id"] = $student_id;
        $data["subject_id"] = "";

        $this->load->view("layout/parent/header");
        $this->load->view("parent/homeworklist", $data);
        $this->load->view("layout/parent/footer");
    }
 
    public function homework_detail($id,$student_id,$homework_status) {

        $data["title"] = "Homework Evaluation";
        $data['status']=$homework_status;
        $userdata = $this->customlib->getLoggedInUserData();

       
        $result = $this->homework_model->getRecord($id);
        $class_id = $result["class_id"];
        $section_id = $result["section_id"];
        $studentlist = $this->homework_model->getStudents($class_id, $section_id);
        $data["studentlist"] = $studentlist;
        $data["result"] = $result;
        $data["created_by"] = "";
        $data["evaluated_by"] = "";
        $report = $this->homework_model->getEvaluationReportForStudent($id, $student_id);
       // echo $this->db->last_query();die;
        //print_r($report);die;
        $data["report"] = $report;
        $create_data = $this->staff_model->get($result["created_by"]);
        $created_by = $create_data["name"];
         $data["created_by"] = $created_by;
    ///  echo "<pre>"; print_r($data["result"]); echo "<pre>";die;
        if (!empty($report)) {
            
            $eval_data = $this->staff_model->get($result["evaluated_by"]);
            
            $evaluated_by = $eval_data["name"];
           
            $data["evaluated_by"] = $evaluated_by;
        }

        $data["homeworkdocs"] = $this->homework_model->get_homeworkDocBystudentId($id,$student_id);
    
        $this->load->view("parent/homework_detail", $data);
    }

    public function download($id, $doc) {
        $this->load->helper('download');
        $name = $this->uri->segment(5);
        $ext = explode(".", $name);
        $filepath = "./uploads/homework/" . $id . "." . $ext[1];
        $data = file_get_contents($filepath);
        force_download($name, $data);
    }

    public function get_upload_docs($homework_id,$homework_status){
        $student_id=$_POST['student_id'];

        $data=$this->homework_model->get_upload_docs($arra=array('homework_id'=>$homework_id,'student_id'=>$student_id));
        echo json_encode($data[0]); 
    }
     public function assigmnetDownload($id, $doc)
    {
        $this->load->helper('download');
        $name     = $this->uri->segment(5);
        $ext      = explode(".", $name);
        $filepath = "./uploads/homework/assignment/" . $doc;
        $data     = file_get_contents($filepath);
        force_download($name, $data);
    }

     public function upload_docs()
    {

        $homework_id         = $_REQUEST['homework_id'];
        $student_id          =$_REQUEST['student_id'];
        $data['homework_id'] = $homework_id;
        $data['student_id']  = $student_id;
        $data['message']     = $_REQUEST['message'];
        // $data['id']=$_POST['assigment_id'];
         $is_required=$this->homework_model->check_assignment($homework_id,$student_id);
          $this->form_validation->set_rules('message', $this->lang->line('message'), 'trim|required|xss_clean');
        
  $this->form_validation->set_rules('file', $this->lang->line('attach_document'), 'trim|xss_clean|callback_handle_upload['.$is_required.']');

        if ($this->form_validation->run() == FALSE) {
          $msg=array(
            'message'=>form_error('message'),
            'file'=>form_error('file'),
          );
          $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
           
        }else{

             if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $time     = md5($_FILES["file"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];           
            $data['docs'] =  $img_name;
            move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/homework/assignment/" . $data['docs']);
           
            $data['file_name']=$_FILES["file"]['name'];
          
            $this->homework_model->upload_docs($data);
        }
        
         $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        }

        echo json_encode($array);
    }

    public function handle_upload($str,$is_required)
    {
     
        $image_validate = $this->config->item('file_validate');

        if (isset($_FILES["file"]) && !empty($_FILES['file']['name']) && $_FILES["file"]["size"] > 0) {

            $file_type         = $_FILES["file"]['type'];
            $file_size         = $_FILES["file"]["size"];
            $file_name         = $_FILES["file"]["name"];
            $allowed_extension = $image_validate['allowed_extension'];
            $ext               = pathinfo($file_name, PATHINFO_EXTENSION);

            $allowed_mime_type = $image_validate['allowed_mime_type'];

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mtype = finfo_file($finfo, $_FILES['file']['tmp_name']);
            finfo_close($finfo);

            if (!in_array($mtype, $allowed_mime_type)) {
                $this->form_validation->set_message('handle_upload', 'File Type Not Allowed');
                return false;
            }

            if (!in_array($ext, $allowed_extension) || !in_array($file_type, $allowed_mime_type)) {
                $this->form_validation->set_message('handle_upload', 'Extension Not Allowed');
                return false;
            }

            if ($file_size > $image_validate['upload_size']) {
                $this->form_validation->set_message('handle_upload', $this->lang->line('file_size_shoud_be_less_than') . number_format($image_validate['upload_size'] / 1048576, 2) . " MB");
                return false;
            }

            return true;
        } else {
          if($is_required==0){
             $this->form_validation->set_message('handle_upload', 'Please choose a file to upload.');
            return false;
          }else{
             return true;
          }
           
        }
       

    }

}

?>