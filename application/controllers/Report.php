<?php
 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->time = strtotime(date('d-m-Y H:i:s'));
     
      $this->payment_mode= $this->customlib->payment_mode();
        $this->search_type=$this->customlib->get_searchtype();
		$this->sch_setting_detail = $this->setting_model->getSetting();
    }

    function pdfStudentFeeRecord() {
        $data = [];
        $class_id = $this->uri->segment(3);
        $section_id = $this->uri->segment(4);
        $student_id = $this->uri->segment(5);
        $student = $this->student_model->get($student_id);
        $setting_result = $this->setting_model->get();
        $data['settinglist'] = $setting_result;
        $data['student'] = $student;
        $student_due_fee = $this->studentfee_model->getDueFeeBystudent($class_id, $section_id, $student_id);
        $data['student_due_fee'] = $student_due_fee;
        $html = $this->load->view('reports/students_detail', $data, true);
        $pdfFilePath = $this->time . ".pdf";
        $this->fontdata = array(
            "opensans" => array(
                'R' => "OpenSans-Regular.ttf",
                'B' => "OpenSans-Bold.ttf",
                'I' => "OpenSans-Italic.ttf",
                'BI' => "OpenSans-BoldItalic.ttf",
            ),
        );
        $this->load->library('m_pdf');
        $this->m_pdf->pdf->WriteHTML($html);
        $this->m_pdf->pdf->Output($pdfFilePath, "D");
    }

    function pdfByInvoiceNo() {
        $data = [];
        $invoice_id = $this->uri->segment(3);
        $setting_result = $this->setting_model->get();
        $data['settinglist'] = $setting_result;
        $student_due_fee = $this->studentfee_model->getFeeByInvoice($invoice_id);
        $data['student_due_fee'] = $student_due_fee;
        $html = $this->load->view('reports/pdfinvoiceno', $data, true);
        $pdfFilePath = $this->time . ".pdf";
        $this->load->library('m_pdf');
        $this->m_pdf->pdf->WriteHTML($html);
        $this->m_pdf->pdf->Output($pdfFilePath, "D");
    }

    function pdfDepositeFeeByStudent($id) {
        $data = [];
        $data['title'] = 'Student Detail';
        $student = $this->student_model->get($id);
        $setting_result = $this->setting_model->get();
        $data['settinglist'] = $setting_result;
        $student_fee_history = $this->studentfee_model->getStudentFees($id);
        $data['student_fee_history'] = $student_fee_history;
        $data['student'] = $student;
        $array = array();
        $feecategory = $this->feecategory_model->get();
        foreach ($feecategory as $key => $value) {
            $dataarray = array();
            $value_id = $value['id'];
            $dataarray[$value_id] = $value['category'];
            $category = $value['category'];
            $datatype = array();
            $data_fee_type = array();
            $feetype = $this->feetype_model->getFeetypeByCategory($value['id']);
            foreach ($feetype as $feekey => $feevalue) {
                $ftype = $feevalue['id'];
                $datatype[$ftype] = $feevalue['type'];
            }
            $data_fee_type[] = $datatype;
            $dataarray[$category] = $datatype;
            $array[] = $dataarray;
        }
        $data['category_array'] = $array;
        $data['feecategory'] = $feecategory;
        $html = $this->load->view('reports/pdfStudentDeposite', $data, true);
        $pdfFilePath = $this->time . ".pdf";
        $this->load->library('m_pdf');
        $this->m_pdf->pdf->WriteHTML($html);
        $this->m_pdf->pdf->Output($pdfFilePath, "D");
    }

    function pdfStudentListByText() {
        $data = [];
        $search_text = $this->uri->segment(3);
        $setting_result = $this->setting_model->get();
        $data['settinglist'] = $setting_result;
        $resultlist = $this->student_model->searchFullText($search_text);
        $data['resultlist'] = $resultlist;
        $html = $this->load->view('reports/pdfStudentListByText', $data, true);
        $pdfFilePath = $this->time . ".pdf";
        $this->load->library('m_pdf');
        $this->m_pdf->pdf->WriteHTML($html);
        $this->m_pdf->pdf->Output($pdfFilePath, "D");
    }

    function marksreport() {
        $setting_result = $this->setting_model->get();
        $data['settinglist'] = $setting_result;
        $exam_id = $this->uri->segment(3);
        $class_id = $this->uri->segment(4);
        $section_id = $this->uri->segment(5);
        $data['exam_id'] = $exam_id;
        $data['class_id'] = $class_id;
        $data['section_id'] = $section_id;
        $exam_arrylist = $this->exam_model->get($exam_id);
        $data['exam_arrylist'] = $exam_arrylist;
        $section = $this->section_model->getClassNameBySection($class_id, $section_id);
        $data['class'] = $section;
        $examSchedule = $this->examschedule_model->getDetailbyClsandSection($class_id, $section_id, $exam_id);
        $studentList = $this->student_model->searchByClassSection($class_id, $section_id);
        $data['examSchedule'] = array();
        if (!empty($examSchedule)) {
            $new_array = array();
            $data['examSchedule']['status'] = "yes";
            foreach ($studentList as $stu_key => $stu_value) {
                $array = array();
                $array['student_id'] = $stu_value['id'];
                $array['roll_no'] = $stu_value['roll_no'];
                $array['firstname'] = $stu_value['firstname'];
                $array['lastname'] = $stu_value['lastname'];
                $array['admission_no'] = $stu_value['admission_no'];
                $array['dob'] = $stu_value['dob'];
                $array['father_name'] = $stu_value['father_name'];
                $x = array();
                foreach ($examSchedule as $ex_key => $ex_value) {
                    $exam_array = array();
                    $exam_array['exam_schedule_id'] = $ex_value['id'];
                    $exam_array['exam_id'] = $ex_value['exam_id'];
                    $exam_array['full_marks'] = $ex_value['full_marks'];
                    $exam_array['passing_marks'] = $ex_value['passing_marks'];
                    $exam_array['exam_name'] = $ex_value['name'];
                    $exam_array['exam_type'] = $ex_value['type'];
                    $student_exam_result = $this->examresult_model->get_result($ex_value['id'], $stu_value['id']);
                    if (empty($student_exam_result)) {
                        $data['examSchedule']['status'] = "no";
                    } else {
                        $exam_array['attendence'] = $student_exam_result->attendence;
                        $exam_array['get_marks'] = $student_exam_result->get_marks;
                    }
                    $x[] = $exam_array;
                }
                $array['exam_array'] = $x;
                $new_array[] = $array;
            }
            $data['examSchedule']['result'] = $new_array;
        } else {
            $s = array('status' => 'no');
            $data['examSchedule'] = $s;
        }
        $html = $this->load->view('reports/marksreport', $data, true);
        $pdfFilePath = $this->time . ".pdf";
        $this->load->library('m_pdf');
        $this->m_pdf->pdf->WriteHTML($html);
        $this->m_pdf->pdf->Output($pdfFilePath, "D");
        $this->load->view('reports/marksreport', $data);
    }

    function pdfStudentListByClassSection() {
        $data = [];
        $class_id = $this->uri->segment(3);
        $section_id = $this->uri->segment(4);
        $setting_result = $this->setting_model->get();
        $section = $this->section_model->getClassNameBySection($class_id, $section_id);
        $data['class'] = $section;
        $data['settinglist'] = $setting_result;
        $resultlist = $this->student_model->searchByClassSection($class_id, $section_id);
        $data['resultlist'] = $resultlist;
        $html = $this->load->view('reports/pdfStudentListByClassSection', $data, true);
        $pdfFilePath = $this->time . ".pdf";
        $this->load->library('m_pdf');
        $this->m_pdf->pdf->WriteHTML($html);
        $this->m_pdf->pdf->Output($pdfFilePath, "D");
    }

    function pdfStudentListDifferentCriteria() {
        $data = [];
        $class_id = $this->input->get('class_id');
        $section_id = $this->input->get('section_id');
        $category_id = $this->input->get('category_id');
        $gender = $this->input->get('gender');
        $rte = $this->input->get('rte');
        $setting_result = $this->setting_model->get();
        $class = $this->class_model->get($class_id);
        $data['class'] = $class;
        if ($section_id != "") {
            $section = $this->section_model->getClassNameBySection($class_id, $section_id);
            $data['section'] = $section;
        }
        if ($gender != "") {
            $data['gender'] = $gender;
        }
        if ($rte != "") {
            $data['rte'] = $rte;
        }
        if ($category_id != "") {
            $category = $this->category_model->get($category_id);
            $data['category'] = $category;
        }
        $data['settinglist'] = $setting_result;
        $resultlist = $this->student_model->searchByClassSectionCategoryGenderRte($class_id, $section_id, $category_id, $gender, $rte);
        $data['resultlist'] = $resultlist;
        $html = $this->load->view('reports/pdfStudentListDifferentCriteria', $data, true);
        $pdfFilePath = $this->time . ".pdf";
        $this->load->library('m_pdf');
        $this->m_pdf->pdf->WriteHTML($html);
        $this->m_pdf->pdf->Output($pdfFilePath, "D");
    }

    function pdfStudentListByClass() {
        $data = [];
        $class_id = $this->uri->segment(3);
        $section_id = "";
        $setting_result = $this->setting_model->get();
        $section = $this->class_model->get($class_id);
        $data['class'] = $section;
        $data['settinglist'] = $setting_result;
        $resultlist = $this->student_model->searchByClassSection($class_id, $section_id);
        $data['resultlist'] = $resultlist;
        $html = $this->load->view('reports/pdfStudentListByClass', $data, true);
        $pdfFilePath = $this->time . ".pdf";
        $this->load->library('m_pdf');
        $this->m_pdf->pdf->WriteHTML($html);
        $this->m_pdf->pdf->Output($pdfFilePath, "D");
    }

    function transactionSearch() {
        $data = [];
        $date_from = $this->input->get('datefrom');
        $date_to = $this->input->get('dateto');
        $setting_result = $this->setting_model->get();
        $data['exp_title'] = 'Transaction From ' . $date_from . " To " . $date_to;
        $date_from = date('Y-m-d', $this->customlib->datetostrtotime($date_from));
        $date_to = date('Y-m-d', $this->customlib->datetostrtotime($date_to));
        $expenseList = $this->expense_model->search("", $date_from, $date_to);
        $feeList = $this->studentfee_model->getFeeBetweenDate($date_from, $date_to);
        $data['expenseList'] = $expenseList;
        $data['feeList'] = $feeList;
        $data['settinglist'] = $setting_result;
        $html = $this->load->view('reports/transactionSearch', $data, true);
        $pdfFilePath = $this->time . ".pdf";
        $this->load->library('m_pdf');
        $this->m_pdf->pdf->WriteHTML($html);
        $this->m_pdf->pdf->Output($pdfFilePath, "D");
    }

    function pdfExamschdule() {
        $data = [];
        $setting_result = $this->setting_model->get();
        $data['settinglist'] = $setting_result;
        $exam_id = $this->uri->segment(3);
        $section_id = $this->uri->segment(4);
        $class_id = $this->uri->segment(5);
        $class = $this->class_model->get($class_id);
        $data['class'] = $class;
        $examSchedule = $this->examschedule_model->getDetailbyClsandSection($class_id, $section_id, $exam_id);
        $section = $this->section_model->getClassNameBySection($class_id, $section_id);
        $data['section'] = $section;
        $data['examSchedule'] = $examSchedule;
        $exam = $this->exam_model->get($exam_id);
        $data['exam'] = $exam;
        $html = $this->load->view('reports/examSchedule', $data, true);
        $pdfFilePath = $this->time . ".pdf";
        $this->load->library('m_pdf');
        $this->m_pdf->pdf->WriteHTML($html);
        $this->m_pdf->pdf->Output($pdfFilePath, "D");
    }
    function get_betweendate($type){

    $this->load->view('reports/betweenDate');

} 

function class_subject(){

        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/student_information');
        $this->session->set_userdata('subsub_menu', 'Reports/student_information/class_subject_report');
        $data['title'] = 'Add Fees Type';
        $data['searchlist']=$this->search_type;     
        $class = $this->class_model->get('', $classteacher = 'yes');
        $data['classlist'] = $class;
        $data['search_type']='';
        $data['class_id']=$class_id  = $this->input->post('class_id');
        $data['section_id']=$section_id = $this->input->post('section_id');
        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
        $data['subjects']=array();
        }else{
        $data['section_list']=$this->section_model->getClassBySection($this->input->post('class_id'));

        $data['resultlist']=$this->subjecttimetable_model->getSubjectByClassandSection($class_id, $section_id);
    
        $subject=array();
        foreach($data['resultlist'] as $value){ 
            $subject[$value->subject_id][]=$value;       
        }  

        $data['subjects']=$subject;
        }
       
        $this->load->view('layout/header', $data);
        $this->load->view('reports/class_subject', $data);
        $this->load->view('layout/footer', $data);

}

function admission_report(){

        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/student_information');
        $this->session->set_userdata('subsub_menu', 'Reports/student_information/admission_report');
        $data['title'] = 'Add Fees Type';
        $data['searchlist']=$this->search_type;
		$data['sch_setting']        = $this->sch_setting_detail;
		$data['adm_auto_insert']    = $this->sch_setting_detail->adm_auto_insert;
        $searchterm='';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        foreach ($data['classlist'] as $key => $value) {
           $carray[]=$value['id'];
        }
        if(isset($_POST['search_type']) && $_POST['search_type']!=''){

        $between_date=$this->customlib->get_betweendate($_POST['search_type']);
         $data['search_type']=$search_type=$_POST['search_type'];
        }else{

        $between_date=$this->customlib->get_betweendate('this_year');
        $data['search_type']=$search_type='';
        }

        $from_date=date('Y-m-d',strtotime($between_date['from_date']));

        $to_date=date('Y-m-d',strtotime($between_date['to_date']));

        $condition=" date_format(admission_date,'%Y-%m-%d') between  '".$from_date."' and '".$to_date."'";
        $data['filter_label']=date($this->customlib->getSchoolDateFormat(),strtotime($from_date))." To ".date($this->customlib->getSchoolDateFormat(),strtotime($to_date));
        $this->form_validation->set_rules('search_type', $this->lang->line('search')." ".$this->lang->line('type'), 'trim|required|xss_clean');
        

        if ($this->form_validation->run() == false) {

            $data['resultlist']=array();
        }else{

            $data['resultlist']=$this->student_model->admission_report($searchterm, $carray ,$condition);
           
        }
        

        $this->load->view('layout/header', $data);
        $this->load->view('reports/admission_report', $data);
        $this->load->view('layout/footer', $data);

}

	function sibling_report(){

        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/student_information');
        $this->session->set_userdata('subsub_menu', 'Reports/student_information/sibling_report');
        $data['title'] = 'Add Fees Type';
        $data['searchlist']=$this->search_type;
		$data['sch_setting']        = $this->sch_setting_detail;
		$data['adm_auto_insert']    = $this->sch_setting_detail->adm_auto_insert;
        $searchterm='';
        $condition=array();
        $class = $this->class_model->get('', $classteacher = 'yes');
        $data['classlist'] = $class;
       
        $data['class_id']=$class_id  = $this->input->post('class_id');
        $data['section_id']=$section_id = $this->input->post('section_id');
        $data['section_list']=$this->section_model->getClassBySection($this->input->post('class_id'));
      

       if(isset($_POST['class_id']) && $_POST['class_id']!=''){
      
        $condition['classes.id']=$_POST['class_id'];

       }

       if(isset($_POST['section_id']) && $_POST['section_id']!=''){
      
        $condition['sections.id']=$_POST['section_id'];

       }

          

        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            $data['resultlist']=array();
        }else{
           $data['sibling_list']=$this->student_model->sibling_reportsearch($searchterm, $carray = null,$condition);

         $sibling_parent=array();

         foreach($data['sibling_list'] as $value){

             $sibling_parent[]=$value['parent_id'];
         }
        
        $data['resultlist']=$this->student_model->sibling_report($searchterm, $carray = null);
      //  echo $this->db->last_query();die;
        //echo "<pre>"; print_r($data['resultlist']); echo "<pre>";die;
        $sibling=array();

        foreach($data['resultlist'] as $value){

           if(in_array($value['parent_id'],$sibling_parent)){

            $sibling[$value['parent_id']][]=$value;

         }

        } 
        $data['resultlist']=$sibling;
        }

        
       
        $this->load->view('layout/header', $data);
        $this->load->view('reports/sibling_report', $data);
        $this->load->view('layout/footer', $data);

}

function onlinefees_report(){

        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/finance'); 
        $this->session->set_userdata('subsub_menu', 'Reports/finance/onlinefees_report'); 
         $data['searchlist'] = $this->customlib->get_searchtype();
        $data['group_by'] = $this->customlib->get_groupby();
      
       
        if(isset($_POST['search_type']) && $_POST['search_type']!=''){

          $dates=$this->customlib->get_betweendate($_POST['search_type']);
          $data['search_type']=$_POST['search_type'];

        }else{

          $dates=$this->customlib->get_betweendate('this_year');
          $data['search_type']=''; 
           
        }

        $collection=array();
        $start_date=date('Y-m-d',strtotime($dates['from_date']));
        $end_date=date('Y-m-d',strtotime($dates['to_date']));
        $this->form_validation->set_rules('search_type', $this->lang->line('search')." ".$this->lang->line('type'), 'trim|required|xss_clean');
         

        if ($this->form_validation->run() == false) {
      
        $data['collectlist']=array();

        }else{

        $data['collectlist']=$this->studentfeemaster_model->getOnlineFeeCollectionReport($start_date,$end_date);
        
        }
       
        $this->load->view('layout/header', $data);
        $this->load->view('reports/onlineFeesReport', $data);
        $this->load->view('layout/footer', $data);

}

public function studentbookissuereport(){

        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/library'); 
        $this->session->set_userdata('subsub_menu', 'Reports/library/book_issue_report'); 
        $data['searchlist'] = $this->customlib->get_searchtype();
         if(isset($_POST['search_type']) && $_POST['search_type']!=''){

          $dates=$this->customlib->get_betweendate($_POST['search_type']);
          $data['search_type']=$_POST['search_type'];

        }else{

          $dates=$this->customlib->get_betweendate('this_year');
          $data['search_type']=''; 
           
        }
        
        if(isset($_POST['members_type']) && $_POST['members_type']!=''){

            $data['member_id']=$_POST['members_type'];

        }else{

            $data['member_id']='';

        }
        
        $data['members']=array(''=>$this->lang->line('all'),'student'=>$this->lang->line('student'),'teacher'=>$this->lang->line('teacher'));
        $start_date=date('Y-m-d',strtotime($dates['from_date']));
        $end_date=date('Y-m-d',strtotime($dates['to_date']));
        $data['label']=date($this->customlib->getSchoolDateFormat(),strtotime($start_date))." ".$this->lang->line('to')." ".date($this->customlib->getSchoolDateFormat(),strtotime($end_date));

        $data['issued_books']=$this->bookissue_model->studentBookIssue_report($start_date,$end_date);
       
        $this->load->view('layout/header', $data);
        $this->load->view('reports/studentBookIssueReport', $data);
        $this->load->view('layout/footer', $data);
}


 

public function bookduereport(){

        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/library'); 
        $this->session->set_userdata('subsub_menu', 'Reports/library/bookduereport'); 
        $data['searchlist'] = $this->customlib->get_searchtype();
        
        if(isset($_POST['search_type']) && $_POST['search_type']!=''){

          $dates=$this->customlib->get_betweendate($_POST['search_type']);
          $data['search_type']=$_POST['search_type'];

        }else{

          $dates=$this->customlib->get_betweendate('this_year');
          $data['search_type']=''; 
           
        }

        if(isset($_POST['members_type']) && $_POST['members_type']!=''){

            $data['member_id']=$_POST['members_type'];

        }else{

            $data['member_id']='';
            
        }
        
        $data['members']=array(''=>$this->lang->line('all'),'student'=>$this->lang->line('student'),'teacher'=>$this->lang->line('teacher'));
        
        $start_date=date('Y-m-d',strtotime($dates['from_date']));
        $end_date=date('Y-m-d',strtotime($dates['to_date']));
        $data['label']=date($this->customlib->getSchoolDateFormat(),strtotime($start_date))." ".$this->lang->line('to')." ".date($this->customlib->getSchoolDateFormat(),strtotime($end_date));
        $data['issued_books'] = $this->bookissue_model->bookduereport($start_date,$end_date);
       
        $this->load->view('layout/header', $data);
        $this->load->view('reports/bookduereport', $data);
        $this->load->view('layout/footer', $data);
}

public function bookinventory(){

        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/library');
        $this->session->set_userdata('subsub_menu', 'Reports/library/bookinventory');

        $data['searchlist'] = $this->customlib->get_searchtype();

        if(isset($_POST['search_type']) && $_POST['search_type']!=''){

          $dates=$this->customlib->get_betweendate($_POST['search_type']);
          $data['search_type']=$_POST['search_type'];

        }else{

          $dates=$this->customlib->get_betweendate('this_year');
          $data['search_type']=''; 
           
        }

        
        $start_date=date('Y-m-d',strtotime($dates['from_date']));
        $end_date=date('Y-m-d',strtotime($dates['to_date']));
        $data['label']=date($this->customlib->getSchoolDateFormat(),strtotime($start_date))." ".$this->lang->line('to')." ".date($this->customlib->getSchoolDateFormat(),strtotime($end_date));
        $listbook = $this->book_model->bookinventory($start_date,$end_date);
   
        $data['listbook'] = $listbook;
        
        $this->load->view('layout/header', $data);
        $this->load->view('reports/bookinventory', $data);
        $this->load->view('layout/footer', $data);
}//

public function feescollectionreport(){

        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/fees_collection');
         $this->session->set_userdata('subsub_menu', '');

        
        $this->load->view('layout/header');
        $this->load->view('reports/feescollectionreport');
        $this->load->view('layout/footer');
}


public function gerenalincomereport(){

        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'reports/bookinventory');

        $data['searchlist'] = $this->customlib->get_searchtype();

        if(isset($_POST['search_type']) && $_POST['search_type']!=''){

          $dates=$this->customlib->get_betweendate($_POST['search_type']);
          $data['search_type']=$_POST['search_type'];

        }else{

          $dates=$this->customlib->get_betweendate('this_year');
          $data['search_type']=''; 
           
        }

        $start_date=date('Y-m-d',strtotime($dates['from_date']));
        $end_date=date('Y-m-d',strtotime($dates['to_date']));
        $data['label']=date($this->customlib->getSchoolDateFormat(),strtotime($start_date))." ".$this->lang->line('to')." ".date($this->customlib->getSchoolDateFormat(),strtotime($end_date));
        $listbook = $this->book_model->bookinventory($start_date,$end_date);
     
        $data['listbook'] = $listbook;
        
        $this->load->view('layout/header', $data);
        $this->load->view('reports/gerenalincomereport', $data);
        $this->load->view('layout/footer', $data);
}

public function studentinformation(){
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/student_information');
         $this->session->set_userdata('subsub_menu', '');

        
        $this->load->view('layout/header');
        $this->load->view('reports/studentinformation');
        $this->load->view('layout/footer');
}

public function attendance(){

        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/attendance');
         $this->session->set_userdata('subsub_menu', '');

        $this->load->view('layout/header');
        $this->load->view('reports/attendance');
        $this->load->view('layout/footer');
}

public function examinations(){
    if (!$this->rbac->hasPrivilege('rank_report', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/examinations');
         $this->session->set_userdata('subsub_menu', '');

        $this->load->view('layout/header');
        $this->load->view('reports/examinations');
        $this->load->view('layout/footer');
}

public function library(){

        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/library');
        $this->session->set_userdata('subsub_menu', '');

        $this->load->view('layout/header');
        $this->load->view('reports/library');
        $this->load->view('layout/footer');

}

public function inventory(){

        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/inventory');
        $this->session->set_userdata('subsub_menu', '');

        $this->load->view('layout/header');
        $this->load->view('reports/inventory');
        $this->load->view('layout/footer');

}


public function onlineexams(){

        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/online_examinations');
        $this->session->set_userdata('subsub_menu', 'Reports/online_examinations/onlineexams');
        $condition="";
        $data['searchlist'] = $this->customlib->get_searchtype();
        $data['date_type'] = $this->customlib->date_type();

        $data['date_typeid']='';
        if(isset($_POST['search_type']) && $_POST['search_type']!=''){

          $dates=$this->customlib->get_betweendate($_POST['search_type']);
          $data['search_type']=$_POST['search_type'];

        }else{

          $dates=$this->customlib->get_betweendate('this_year');
          $data['search_type']=''; 
           
        }

        $start_date=date('Y-m-d',strtotime($dates['from_date']));
        $end_date=date('Y-m-d',strtotime($dates['to_date']));
       
        $data['label']=date($this->customlib->getSchoolDateFormat(),strtotime($start_date))." ".$this->lang->line('to')." ".date($this->customlib->getSchoolDateFormat(),strtotime($end_date));

        if(isset($_POST['date_type']) && $_POST['date_type']!=''){
            
            $data['date_typeid']=$_POST['date_type'];

                if($_POST['date_type']=='exam_from_date'){

                $condition=" date_format(exam_from,'%Y-%m-%d') between '".$start_date."' and '".$end_date."'";

                }elseif($_POST['date_type']=='exam_to_date'){

                $condition=" date_format(exam_to,'%Y-%m-%d') between '".$start_date."' and '".$end_date."'";

                }

        }else{

                $condition=" date_format(created_at,'%Y-%m-%d') between '".$start_date."' and '".$end_date."'"; 

            }

        
        $data['resultlist']=$this->onlineexam_model->onlineexamReport($condition);
     
        $this->load->view('layout/header',$data);
        $this->load->view('reports/onlineexams',$data);
        $this->load->view('layout/footer',$data);

    }

    public function onlineexamsresult(){

        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/examinations');
        $this->session->set_userdata('subsub_menu', 'Reports/examinations/onlineexamsresult');
        $condition="";
        $data['searchlist'] = $this->customlib->get_searchtype();
        $data['date_type'] = $this->customlib->date_type();

        $data['date_typeid']='';
        if(isset($_POST['search_type']) && $_POST['search_type']!=''){

          $dates=$this->customlib->get_betweendate($_POST['search_type']);
          $data['search_type']=$_POST['search_type'];

        }else{

          $dates=$this->customlib->get_betweendate('this_year');
          $data['search_type']=''; 
           
        }

        $start_date=date('Y-m-d',strtotime($dates['from_date']));
        $end_date=date('Y-m-d',strtotime($dates['to_date']));
       
        $data['label']=date($this->customlib->getSchoolDateFormat(),strtotime($start_date))." ".$this->lang->line('to')." ".date($this->customlib->getSchoolDateFormat(),strtotime($end_date));

        if(isset($_POST['date_type']) && $_POST['date_type']!=''){
            
            $data['date_typeid']=$_POST['date_type'];

                if($_POST['date_type']=='exam_from_date'){

                $condition=" date_format(exam_from,'%Y-%m-%d') between '".$start_date."' and '".$end_date."'";

                }elseif($_POST['date_type']=='exam_to_date'){

                $condition=" date_format(exam_to,'%Y-%m-%d') between '".$start_date."' and '".$end_date."'";

                }

        }else{

                $condition=" date_format(created_at,'%Y-%m-%d') between '".$start_date."' and '".$end_date."'"; 

            }

        
        $data['resultlist']=$this->onlineexam_model->onlineexamReport($condition);
       // echo $this->db->last_query();die;
        $this->load->view('layout/header',$data);
        $this->load->view('reports/onlineexamsresult',$data);
        $this->load->view('layout/footer',$data);
    }


    public function onlineexamattend(){

        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/online_examinations');
        $this->session->set_userdata('subsub_menu', 'Reports/online_examinations/onlineexamattend');
        $condition="";

        $data['searchlist'] = $this->customlib->get_searchtype();
        $data['date_type'] = $this->customlib->date_type();

        $data['date_typeid']='';
        if(isset($_POST['search_type']) && $_POST['search_type']!=''){

          $dates=$this->customlib->get_betweendate($_POST['search_type']);
          $data['search_type']=$_POST['search_type'];

        }else{

          $dates=$this->customlib->get_betweendate('this_year');
          $data['search_type']=''; 
           
        }

        $start_date=date('Y-m-d',strtotime($dates['from_date']));
        $end_date=date('Y-m-d',strtotime($dates['to_date']));
       
        $data['label']=date($this->customlib->getSchoolDateFormat(),strtotime($start_date))." ".$this->lang->line('to')." ".date($this->customlib->getSchoolDateFormat(),strtotime($end_date));

        if(isset($_POST['date_type']) && $_POST['date_type']!=''){
            
                $data['date_typeid']=$_POST['date_type'];

                if($_POST['date_type']=='exam_from_date'){

                $condition=" and date_format(onlineexam.exam_from,'%Y-%m-%d') between '".$start_date."' and '".$end_date."'";

                }elseif($_POST['date_type']=='exam_to_date'){

                $condition=" and date_format(onlineexam.exam_to,'%Y-%m-%d') between '".$start_date."' and '".$end_date."'";

                }

        }else{

                $condition=" and  date_format(onlineexam.created_at,'%Y-%m-%d') between '".$start_date."' and '".$end_date."'"; 

            }
     
       $data['resultlist']=$this->onlineexam_model->onlineexamatteptreport($condition); 
    
        $this->load->view('layout/header',$data);
        $this->load->view('reports/onlineexamattend',$data);
        $this->load->view('layout/footer',$data);
    }

 public function onlineexamrank(){
        
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/online_examinations');
        $this->session->set_userdata('subsub_menu', 'Reports/online_examinations/onlineexamrank');
       
        $exam_id=$class_id=$section_id=$condition='';
        $studentrecord=array();
        $getResultByStudent1=array();
      
        $examList         = $this->onlineexam_model->get();
        $data['examList'] = $examList;
        $class             = $this->class_model->get();
        $data['classlist'] = $class;

            if(isset($_POST['class_id']) && $_POST['class_id']!=''){
                $class_id=$_POST['class_id'];
            }

            if(isset($_POST['section_id']) && $_POST['section_id']!=''){
                 $section_id=$_POST['section_id'];
            }

            if(isset($_POST['exam_id']) && $_POST['exam_id']!=''){
                $exam_id=$_POST['exam_id'];
            }

     $data['resultlist']=$this->onlineexamresult_model->getStudentResult($exam_id, $class_id, $section_id);
   
     foreach($data['resultlist'] as $examresult_key => $examresult_value) {

        $studentrecord[$examresult_value['onlineexam_student_id']]=$examresult_value;
        $onlineexam_student_id=$examresult_value['onlineexam_student_id'];
        $examid=$examresult_value['exam_id'];
        $getResultByStudent=$this->onlineexamresult_model->onlineexamrank($onlineexam_student_id,$examid);

     if(!empty($getResultByStudent)){
        $rank_array=array(
            'onlineexam_student_id'=>$getResultByStudent[0]['onlineexam_student_id'],
            'correct_answer'=>$getResultByStudent[0]['correct_answer'],
            'incorrect_answer'=>$getResultByStudent[0]['incorrect_answer'],
            'total_questions'=>$getResultByStudent[0]['total_questions'],
            'percentage'=>(($getResultByStudent[0]['correct_answer']/$getResultByStudent[0]['total_questions'])*100),
        );
        $getResultByStudent1[$onlineexam_student_id]=$rank_array; 
     }
       
$getResultByStudent=array();
     

     }

     

     if(!empty($getResultByStudent1)){
 usort($getResultByStudent1, function($a,$b){return $a['percentage']-$b['percentage'];});
     }
//echo "<pre>"; print_r($getResultByStudent1); echo "<pre>";die;
     $this->form_validation->set_rules('exam_id', $this->lang->line('exam'), 'required');
       

        if ($this->form_validation->run() == FALSE) {

            $data['studentrecord']='';
            $data['final_result']='';

         }else{
            $fdata = array();
            $data['studentrecord']=$studentrecord;

            if(!empty($getResultByStudent1)){

            foreach ($getResultByStudent1 as $key => $value) {

            if($value['onlineexam_student_id']!=''){
            $fdata[]=$value;
            }

            }
            
            }
            
            
            $data['final_result']=$fdata;  

         }
    $this->load->view('layout/header',$data);
    $this->load->view('reports/onlineexamrank',$data);
    $this->load->view('layout/footer',$data);

    }

    public function inventorystock(){
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/inventory');
        $this->session->set_userdata('subsub_menu', 'Reports/inventory/inventorystock');
        $data['stockresult']=$this->itemstock_model->get_currentstock();
     
       $this->load->view('layout/header',$data);
        $this->load->view('reports/inventorystock',$data);
        $this->load->view('layout/footer',$data); 
    }

    public function additem(){

        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/inventory');
        $this->session->set_userdata('subsub_menu', 'Reports/inventory/additem');

        $data['searchlist'] = $this->customlib->get_searchtype();
        $data['date_type'] = $this->customlib->date_type();
        $data['date_typeid']='';

        if(isset($_POST['search_type']) && $_POST['search_type']!=''){

          $dates=$this->customlib->get_betweendate($_POST['search_type']);
          $data['search_type']=$_POST['search_type'];

        }else{

          $dates=$this->customlib->get_betweendate('this_year');
          $data['search_type']=''; 
           
        }

        $start_date=date('Y-m-d',strtotime($dates['from_date']));
        $end_date=date('Y-m-d',strtotime($dates['to_date']));
       
        $data['label']=date($this->customlib->getSchoolDateFormat(),strtotime($start_date))." ".$this->lang->line('to')." ".date($this->customlib->getSchoolDateFormat(),strtotime($end_date));
        $data['itemresult']=$this->itemstock_model->get_ItemByBetweenDate($start_date,$end_date);
      
       $this->load->view('layout/header',$data);
       $this->load->view('reports/additem',$data);
       $this->load->view('layout/footer',$data); 
    }


public function issueinventory(){


        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/inventory');
        $this->session->set_userdata('subsub_menu', 'Reports/inventory/issueinventory');

        $data['searchlist'] = $this->customlib->get_searchtype();
        $data['date_type'] = $this->customlib->date_type();
        $data['date_typeid']='';

        if(isset($_POST['search_type']) && $_POST['search_type']!=''){

          $dates=$this->customlib->get_betweendate($_POST['search_type']);
          $data['search_type']=$_POST['search_type'];

        }else{

          $dates=$this->customlib->get_betweendate('this_year');
          $data['search_type']=''; 
           
        }
 
        $start_date=date('Y-m-d',strtotime($dates['from_date']));
        $end_date=date('Y-m-d',strtotime($dates['to_date']));
       
        $data['label']=date($this->customlib->getSchoolDateFormat(),strtotime($start_date))." ".$this->lang->line('to')." ".date($this->customlib->getSchoolDateFormat(),strtotime($end_date));
        $data['itemissueList']=$this->itemissue_model->get_IssueInventoryReport($start_date,$end_date);
     
   
       $this->load->view('layout/header',$data);
       $this->load->view('reports/issueinventory',$data);
       $this->load->view('layout/footer',$data); 
}

public function finance(){
         $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/finance');
        $this->session->set_userdata('subsub_menu', '');
        $data['stockresult']=$this->itemstock_model->get_currentstock();
      
       $this->load->view('layout/header',$data);
        $this->load->view('reports/finance',$data);
        $this->load->view('layout/footer',$data); 
}

public function income(){
         $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/finance');
        $this->session->set_userdata('subsub_menu', 'Reports/finance/income');
        $data['searchlist'] = $this->customlib->get_searchtype();
        $data['date_type'] = $this->customlib->date_type();
        $data['date_typeid']='';

        if(isset($_POST['search_type']) && $_POST['search_type']!=''){

          $dates=$this->customlib->get_betweendate($_POST['search_type']);
          $data['search_type']=$_POST['search_type'];

        }else{

          $dates=$this->customlib->get_betweendate('this_year');
          $data['search_type']=''; 
           
        }

        $start_date=date('Y-m-d',strtotime($dates['from_date']));
        $end_date=date('Y-m-d',strtotime($dates['to_date']));
       
        $data['label']=date($this->customlib->getSchoolDateFormat(),strtotime($start_date))." ".$this->lang->line('to')." ".date($this->customlib->getSchoolDateFormat(),strtotime($end_date));
        $incomeList = $this->income_model->search("", $start_date, $end_date);

    $data['incomeList'] = $incomeList;
       $this->load->view('layout/header',$data);
        $this->load->view('reports/income',$data);
        $this->load->view('layout/footer',$data); 
}

public function expense(){
         $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/finance');
        $this->session->set_userdata('subsub_menu', 'Reports/finance/expense');
        $data['searchlist'] = $this->customlib->get_searchtype();
        $data['date_type'] = $this->customlib->date_type();
        $data['date_typeid']='';

        if(isset($_POST['search_type']) && $_POST['search_type']!=''){

          $dates=$this->customlib->get_betweendate($_POST['search_type']);
          $data['search_type']=$_POST['search_type'];

        }else{

          $dates=$this->customlib->get_betweendate('this_year');
          $data['search_type']=''; 
           
        }

        $start_date=date('Y-m-d',strtotime($dates['from_date']));
        $end_date=date('Y-m-d',strtotime($dates['to_date']));
       
        $data['label']=date($this->customlib->getSchoolDateFormat(),strtotime($start_date))." ".$this->lang->line('to')." ".date($this->customlib->getSchoolDateFormat(),strtotime($end_date));
        $expenseList = $this->expense_model->search("", $start_date, $end_date);
        
   $data['expenseList'] = $expenseList;
       $this->load->view('layout/header',$data);
        $this->load->view('reports/expense',$data);
        $this->load->view('layout/footer',$data); 
}

public function payroll(){
         $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/finance');
        $this->session->set_userdata('subsub_menu', 'Reports/finance/payroll');
        $data['searchlist'] = $this->customlib->get_searchtype();
        $data['date_type'] = $this->customlib->date_type();
        $data['date_typeid']='';

        if(isset($_POST['search_type']) && $_POST['search_type']!=''){

          $dates=$this->customlib->get_betweendate($_POST['search_type']);
          $data['search_type']=$_POST['search_type'];

        }else{

          $dates=$this->customlib->get_betweendate('this_year');
          $data['search_type']=''; 
           
        }

        $start_date=date('Y-m-d',strtotime($dates['from_date']));
        $end_date=date('Y-m-d',strtotime($dates['to_date']));
       
        $data['label']=date($this->customlib->getSchoolDateFormat(),strtotime($start_date))." ".$this->lang->line('to')." ".date($this->customlib->getSchoolDateFormat(),strtotime($end_date));
        $data['payment_mode']=$this->payment_mode;
        
        $result = $this->payroll_model->getbetweenpayrollReport($start_date, $end_date);
        
       $data['payrollList']=$result;
       $this->load->view('layout/header',$data);
       $this->load->view('reports/payroll',$data);
       $this->load->view('layout/footer',$data); 
}

public function incomegroup(){

        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/finance');
        $this->session->set_userdata('subsub_menu', 'Reports/finance/incomegroup');
        $data['searchlist'] = $this->customlib->get_searchtype();
        $data['date_type'] = $this->customlib->date_type();
        $data['date_typeid']='';

        if(isset($_POST['search_type']) && $_POST['search_type']!=''){

          $dates=$this->customlib->get_betweendate($_POST['search_type']);
          $data['search_type']=$_POST['search_type'];

        }else{

          $dates=$this->customlib->get_betweendate('this_year');
          $data['search_type']=''; 
           
        }
        $data['head_id']=$head_id="";
        if(isset($_POST['head']) && $_POST['head']!=''){
            $data['head_id']=$head_id=$_POST['head'];
        }

        $start_date=date('Y-m-d',strtotime($dates['from_date']));
        $end_date=date('Y-m-d',strtotime($dates['to_date']));
       
        $data['label']=date($this->customlib->getSchoolDateFormat(),strtotime($start_date))." ".$this->lang->line('to')." ".date($this->customlib->getSchoolDateFormat(),strtotime($end_date));
         $incomeList = $this->income_model->searchincomegroup($start_date, $end_date,$head_id);
    
       $data['headlist']=$this->incomehead_model->get();

       $data['incomeList'] = $incomeList;
       $this->load->view('layout/header',$data);
       $this->load->view('reports/incomegroup',$data);
       $this->load->view('layout/footer',$data); 
}
public function expensegroup(){

        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/finance');
        $this->session->set_userdata('subsub_menu', 'Reports/finance/expensegroup');
        $data['searchlist'] = $this->customlib->get_searchtype();
        $data['date_type'] = $this->customlib->date_type();
        $data['date_typeid']='';

        if(isset($_POST['search_type']) && $_POST['search_type']!=''){

          $dates=$this->customlib->get_betweendate($_POST['search_type']);
          $data['search_type']=$_POST['search_type'];

        }else{

          $dates=$this->customlib->get_betweendate('this_year');
          $data['search_type']=''; 
           
        }

         $data['head_id']=$head_id="";
        if(isset($_POST['head']) && $_POST['head']!=''){
            $data['head_id']=$head_id=$_POST['head'];
        }

        $start_date=date('Y-m-d',strtotime($dates['from_date']));
        $end_date=date('Y-m-d',strtotime($dates['to_date']));
       
        $data['label']=date($this->customlib->getSchoolDateFormat(),strtotime($start_date))." ".$this->lang->line('to')." ".date($this->customlib->getSchoolDateFormat(),strtotime($end_date));

        $result = $this->expensehead_model->searchexpensegroup($start_date, $end_date,$head_id);
  
        $data['headlist']=$this->expensehead_model->get();
         
        $data['expenselist']=$result;
        $this->load->view('layout/header',$data);
        $this->load->view('reports/expensegroup',$data);
        $this->load->view('layout/footer',$data); 
}

public function student_profile(){

       
         $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/student_information');
        $this->session->set_userdata('subsub_menu', 'Reports/student_information/student_profile');
        $data['title'] = 'Add Fees Type';
        $data['searchlist']=$this->search_type;
        $data['sch_setting']        = $this->sch_setting_detail;
        $data['adm_auto_insert']    = $this->sch_setting_detail->adm_auto_insert;
        $searchterm='';

        if(isset($_POST['search_type']) && $_POST['search_type']!=''){

        $between_date=$this->customlib->get_betweendate($_POST['search_type']);
         $data['search_type']=$search_type=$_POST['search_type'];
        }else{

        $between_date=$this->customlib->get_betweendate('this_year');
        $data['search_type']=$search_type='';
        }
        $from_date=date('Y-m-d',strtotime($between_date['from_date']));
        $to_date=date('Y-m-d',strtotime($between_date['to_date']));
        $condition=" date_format(admission_date,'%Y-%m-%d') between  '".$from_date."' and '".$to_date."'";
        $data['filter_label']=date($this->customlib->getSchoolDateFormat(),strtotime($from_date))." To ".date($this->customlib->getSchoolDateFormat(),strtotime($to_date));
             
        $data['sch_setting']        = $this->sch_setting_detail;
        $data['adm_auto_insert']    = $this->sch_setting_detail->adm_auto_insert;

        $this->form_validation->set_rules('search_type', $this->lang->line('search')." ".$this->lang->line('type'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $data['resultlist']=array();
        }else{
            $data['resultlist']=$this->student_model->student_profile($condition);
        }

        $this->load->view('layout/header',$data);
        $this->load->view('reports/student_profile',$data);
        $this->load->view('layout/footer',$data); 
}

public function staff_report(){

        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/human_resource');
        $this->session->set_userdata('subsub_menu', 'Reports/human_resource/staff_report');
        $data['title'] = 'Add Fees Type';
        $data['searchlist']=$this->search_type;
        $data['sch_setting']        = $this->sch_setting_detail;
        $data['adm_auto_insert']    = $this->sch_setting_detail->adm_auto_insert;
        $searchterm='';
        $condition="";
        if(isset($_POST['search_type']) && $_POST['search_type']!=''){

        $between_date=$this->customlib->get_betweendate($_POST['search_type']);
        $data['search_type']=$search_type=$_POST['search_type'];

        }else{

        $between_date=$this->customlib->get_betweendate('this_year');
        $data['search_type']=$search_type='';

        }

        $from_date=date('Y-m-d',strtotime($between_date['from_date']));

        $to_date=date('Y-m-d',strtotime($between_date['to_date']));

        $condition.=" and date_format(date_of_joining,'%Y-%m-%d') between  '".$from_date."' and '".$to_date."'";

        $data['filter_label']=date($this->customlib->getSchoolDateFormat(),strtotime($from_date))." To ".date($this->customlib->getSchoolDateFormat(),strtotime($to_date));

        if(isset($_POST['staff_status']) && $_POST['staff_status']!='' ){
            if($_POST['staff_status']=='both'){

                $search_status="1,2";

            }elseif($_POST['staff_status']=='2'){

                 $search_status="0";

            }else{

                $search_status="1";

            }
            $condition.=" and `staff`.`is_active` in (".$search_status.")";
            $data['status_val']=$_POST['staff_status'];
        }else{
            $data['status_val']=1;
        }

        if(isset($_POST['role']) && $_POST['role']!=''){
            $condition.=" and `staff_roles`.`role_id`=".$_POST['role'];
            $data['role_val']=$_POST['role'];
        }

        if(isset($_POST['designation']) && $_POST['designation']!=''){
            $condition.=" and `staff_designation`.`id`=".$_POST['designation'];
            $data['designation_val']=$_POST['designation'];
        }

        $data['resultlist']=$this->staff_model->staff_report($condition);
     
       $leave_type=$this->leavetypes_model->getLeaveType();
       foreach ($leave_type as $key => $leave_value) {
         $data['leave_type'][$leave_value['id']]=$leave_value['type'];
       }
       $data['status']=$this->customlib->staff_status();
       $data['roles']=$this->role_model->get();
       $data['designation']=$this->designation_model->get();
      
       $data['fields'] = $this->customfield_model->get_custom_fields('staff',1);
       $data['sch_setting']        = $this->sch_setting_detail;
       $data['adm_auto_insert']    = $this->sch_setting_detail->adm_auto_insert;
        $this->load->view('layout/header',$data);
        $this->load->view('reports/staff_report',$data);
        $this->load->view('layout/footer',$data); 
}

public function attendancereport(){

        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/attendance');
        $this->session->set_userdata('subsub_menu', 'Reports/attendence/attendancereport');
        $data['searchlist']=$this->search_type;
        $data['sch_setting']        = $this->sch_setting_detail;
        $data['adm_auto_insert']    = $this->sch_setting_detail->adm_auto_insert;
        $class = $this->input->post('class_id');
        $section = $this->input->post('section_id');
        $data['class_id'] = $class;
        $data['section_id'] = $section;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $searchterm='';
        $condition="";
        $date_condition="";

        if(isset($_POST['search_type']) && $_POST['search_type']!=''){

        $between_date=$this->customlib->get_betweendate($_POST['search_type']);
        $data['search_type']=$search_type=$_POST['search_type'];

        }else{

        $between_date=$this->customlib->get_betweendate('this_week');
        $data['search_type']=$search_type='this_week';

        }

        $from_date=date('Y-m-d',strtotime($between_date['from_date']));
        $to_date=date('Y-m-d',strtotime($between_date['to_date']));
        $dates = array();
        $off_date= array();
        $current = strtotime($from_date);
        $last = strtotime($to_date);

        while($current <= $last ) {

        $date=date('Y-m-d', $current);
        $day= date("D", strtotime($date));
        $holiday=$this->stuattendence_model->checkholidatbydate($date);


        if($day=='Sun' || $holiday>0){  
        $off_date[]=$date; 
        }else{
          $dates[] = $date;
        }

        $current = strtotime('+1 day', $current);

        }
 
 
        $data['filter'] = date($this->customlib->getSchoolDateFormat(),strtotime($from_date))." To ".date($this->customlib->getSchoolDateFormat(),strtotime($to_date));
        $data['attendance_type']=$this->attendencetype_model->getstdAttType('2');
       $this->form_validation->set_rules('attendance_type', $this->lang->line('attendence')." ".$this->lang->line('type'), 'trim|required|xss_clean');
       $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {

        $this->load->view('layout/header',$data);
        $this->load->view('reports/stuattendance',$data);
        $this->load->view('layout/footer',$data);

        }else{


        $data['attendance_type_id']=$attendance_type_id=$this->input->post('attendance_type');
        $condition.=" and `student_attendences`.`attendence_type_id`=".$this->input->post('attendance_type');
        foreach ($dates as $key => $value) {
            
        }
        

        if($data['class_id']!=''){
        $condition.=' and class_id='.$data['class_id'];
        }
        $condition.=" and date_format(student_attendences.date,'%Y-%m-%d') between '".$from_date."' and '".$to_date."'";
        if($data['section_id']!=''){
        $condition.=' and section_id='.$data['section_id'];
        }


        $data['student_attendences']=$this->stuattendence_model->student_attendences($condition,$date_condition);
       
$attd=array();
      
       foreach ($data['student_attendences'] as $value) {
           $std_id=$value['id'];
           $attd[$std_id][]=$value;
       }
     

        foreach ($attd as $key=>$att_value) {
           $all_week=1;
            foreach($att_value as $value){

                if(in_array($value['date'],$off_date)){

                }else{
                     if (in_array($value['date'], $dates))
              {
              //echo "Match found";
              }
            else
              {
             $all_week=0;
              }
                }
                 
            
            }
            if($all_week==1){
                $fdata[]=$att_value[0];
            }


                }
        
        $dates=" '".$from_date."' and '".$to_date."'";
        
        $this->load->view('layout/header',$data);
        $this->load->view('reports/stuattendance',$data);
        $this->load->view('layout/footer',$data); 
        }
        
    }
 
    public function biometric_attlog($offset=0){
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/attendance');
        $this->session->set_userdata('subsub_menu', 'Reports/attendence/biometric_attlog');
      $data['sch_setting']        = $this->sch_setting_detail;
        $data['adm_auto_insert']    = $this->sch_setting_detail->adm_auto_insert;
        
        $config['total_rows'] = $this->stuattendence_model->biometric_attlogcount();

        $config['base_url'] = base_url()."report/biometric_attlog";
        $config['per_page'] = 100;
        $config['uri_segment'] = '3';

        $config['full_tag_open'] = '<div class="pagination"><ul>';
        $config['full_tag_close'] = '</ul></div>';

        $config['first_link'] = '« First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last »';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = 'Next →';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '← Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li ><a href="" class="active">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';


        $this->pagination->initialize($config);


        $query = $this->stuattendence_model->biometric_attlog(100,$this->uri->segment(3));

        $data['resultlist'] = $query;
        $this->load->view('layout/header',$data);
        $this->load->view('reports/biometric_attlog',$data);
        $this->load->view('layout/footer',$data); 
    }


    


   

}

 


?>