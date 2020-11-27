<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class approve_leave extends Admin_Controller {

    function __construct() {
        parent::__construct();
          }

    function unauthorized() {
        $data = array();
        $this->load->view('layout/header', $data);
        $this->load->view('unauthorized', $data);
        $this->load->view('layout/footer', $data);
    }
     function index(){

        if (!$this->rbac->hasPrivilege('approve_leave', 'can_view')) {
            access_denied();
        }
         $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'Attendance/approve_leave');
        $class             = $this->class_model->get();
        $data['classlist'] = $class;
    $data['class_id']=$class_id='';
    $data['section_id']=$section_id='';
    $data['results']=array();
    if(isset($_POST['class_id']) &&  $_POST['class_id']!=''){
        $data['class_id']=$class_id=$_POST['class_id'];

    }

    if(isset($_POST['section_id']) &&  $_POST['section_id']!=''){
        $data['section_id']=$section_id=$_POST['section_id'];

    }
    $this->form_validation->set_rules('class_id', $this->lang->line('class'),'trim|required|xss_clean');
    $this->form_validation->set_rules('section_id', $this->lang->line('section'),'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {

        }else{

            $listaudit =$this->apply_leave_model->get(null,$class_id,$section_id);
            $data['results'] = $listaudit;
        }
      

       
        
        
       
        
       
        $this->load->view('layout/header');
        $this->load->view('admin/approve_leave/index', $data);
        $this->load->view('layout/footer');
  }

    public function get_details($id){
        $data=$this->apply_leave_model->get($id,null,null);
        $data['from_date']=date($this->customlib->getSchoolDateFormat(),strtotime($data['from_date']));
        $data['to_date']=date($this->customlib->getSchoolDateFormat(),strtotime($data['to_date']));
        $data['apply_date']=date($this->customlib->getSchoolDateFormat(),strtotime($data['apply_date']));
        echo json_encode($data);
    }

	public function add(){
        
		 $student_id = '';
		 $this->form_validation->set_rules('apply_date', $this->lang->line('apply')." ".$this->lang->line('date'), 'trim|required|xss_clean');
		  $this->form_validation->set_rules('from_date', $this->lang->line('from')." ".$this->lang->line('date'), 'trim|required|xss_clean');
		   $this->form_validation->set_rules('to_date', $this->lang->line('to')." ".$this->lang->line('date'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('student', $this->lang->line('student'),'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {

            $msg = array(
                'apply_date' => form_error('apply_date'),
                'from_date' => form_error('from_date'),
                'to_date' => form_error('to_date'),
                  'student' => form_error('student'),
            );

            $array = array('status' => 'fail', 'error' => $msg, 'message' => '');

        }else{

            $student_session_id=$this->apply_leave_model->get_studentsessionId($_POST['class'],$_POST['section'],$_POST['student']);

        	$data=array(
        		'apply_date'=>date('Y-m-d',strtotime($this->input->post('apply_date'))),
        		'from_date'=>date('Y-m-d',strtotime($this->input->post('from_date'))),
        		'to_date'=>date('Y-m-d',strtotime($this->input->post('to_date'))),
                'student_session_id'=>$student_session_id['id'],
                'reason'=>$this->input->post('message'),
                'request_type'=>'1'
                
        	);
            
            if($this->input->post('leave_id')==''){

                 $leave_id=$this->apply_leave_model->add($data);

            }else{

                $data['id']=$this->input->post('leave_id');               
                $this->apply_leave_model->add($data);

            }
        	
			
             if (isset($_FILES["userfile"]) && !empty($_FILES['userfile']['name'])) {
                $fileInfo = pathinfo($_FILES["userfile"]["name"]);
                $img_name = $leave_id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["userfile"]["tmp_name"], "./uploads/student_leavedocuments/" . $img_name);
                $data = array('id' => $leave_id, 'docs' => $img_name);
                $this->apply_leave_model->add($data);
            }
           
            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        }

        echo json_encode($array);
	}

   public function searchByClassSection($class_id,$student_id){

    $section_id=$_REQUEST['section_id'];
    $resultlist= $this->student_model->searchByClassSection($class_id,$section_id);
    
    $data['resultlist']=$resultlist;
    $data['select_id']=$student_id;
	
    $this->load->view('admin/approve_leave/_student_list',$data);
   }

	public function status($id,$status){    
		if($status==1){
			$data['approve_by']=$this->customlib->getStaffID();
		}else{
			$data['approve_by']=0;
		}
	
		$data['status']=$status;    
		$this->db->where('id', $id);
		$this->db->update('student_applyleave',$data);
 
		redirect('admin/approve_leave');
   }

   public function remove_leave($id){
    
    $this->apply_leave_model->remove_leave($id);
    redirect('admin/approve_leave');
   }

   public function download($doc)
    {

        $this->load->helper('download');
        $filepath = "./uploads/student_leavedocuments/" . $doc;
        $data     = file_get_contents($filepath);
        $name     = $doc;

        force_download($name, $data);
    }

}