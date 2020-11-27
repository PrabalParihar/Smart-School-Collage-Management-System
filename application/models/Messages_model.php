<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Messages_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    public function get($id = null) {
        $this->db->select()->from('messages');
        if ($id != null) {
            $this->db->where('messages.id', $id);
        } else {
            $this->db->order_by('messages.created_at', 'desc');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function remove($id) {
		$this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->where('id', $id);
        $this->db->delete('messages');
		$message      = DELETE_RECORD_CONSTANT." On messages id ".$id;
        $action       = "Delete";
        $record_id    = $id;
        $this->log($message, $record_id, $action);
		//======================Code End==============================
        $this->db->trans_complete(); # Completing transaction
        /*Optional*/
        if ($this->db->trans_status() === false) {
            # Something went wrong.
            $this->db->trans_rollback();
            return false;
        } else {
        //return $return_value;
        }
    }

    public function add($data) {
		$this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('messages', $data);
			$message      = UPDATE_RECORD_CONSTANT." On  messages id ".$data['id'];
			$action       = "Update";
			$record_id    = $id = $data['id'];
			$this->log($message, $record_id, $action);
			
        } else {
            $this->db->insert('messages', $data);            
			$insert_id = $this->db->insert_id();
			$message      = INSERT_RECORD_CONSTANT." On messages id ".$insert_id;
			$action       = "Insert";
			$record_id    = $id = $insert_id;
			$this->log($message, $record_id, $action);			
			
        }
		//echo $this->db->last_query();die;
			//======================Code End==============================

			$this->db->trans_complete(); # Completing transaction
			/*Optional*/

			if ($this->db->trans_status() === false) {
				# Something went wrong.
				$this->db->trans_rollback();
				return false;

			} else {
				return $id;
			}
    }


    public function get_classname($id){
        $filter_class=$this->db->select('class')->from('classes')->where('id',$id)->get()->row_array();
        return $this->lang->line('class')." ".$this->lang->line('name')." : ".$filter_class['class'];
    }

    public function get_sectionname($id){
        $filter_section=$this->db->select('section')->from('sections')->where('id',$id)->get()->row_array();
        return $this->lang->line('section')." ".$this->lang->line('name')." : ".$filter_section['section'];
    }

    public function get_categoryname($id){
        $filter_category=$this->db->select('category')->from('categories')->where('id',$id)->get()->row_array();
        return $this->lang->line('category')." ".$this->lang->line('name')." : ".$filter_category['category'];
    }

     public function get_subject_groupname($id){
        $filter_subject_groupname=$this->db->select('name')->from('subject_groups')->where('id',$id)->get()->row_array();
        return $this->lang->line('subject')." ".$this->lang->line('group')." ".$this->lang->line('name')." : ".$filter_subject_groupname['name'];
    }

      public function get_subject_name($id){
        $filter_get_subject_name=$this->db->select('subjects.name')->from('subject_group_subjects')->join('subjects','subject_group_subjects.subject_id=subjects.id','inner')->where('subject_group_subjects.id',$id)->get()->row_array();
        return $this->lang->line('subject')." ".$this->lang->line('name')." : ".$filter_get_subject_name['name'];
    }

    public function get_student_name($id){
          $filter_get_student_name=$this->db->select('CONCAT_WS(" ",firstname,lastname,"(",admission_no,")") as name')->from('students')->where('students.id',$id)->get()->row_array();
        return $this->lang->line('student')." ".$this->lang->line('name')." : ".$filter_get_student_name['name'];
    }

    public function get_staff_name($id){
      
        $filter_get_student_name=$this->db->select('CONCAT_WS(" ",name,surname,"(",employee_id,")") as name')->from('staff')->where('staff.id',$id)->get()->row_array();
        return $this->lang->line('collect')." ".$this->lang->line('by')." : ".$filter_get_student_name['name'];
    }

    public function get_exphead_name($id){
       $filter_get_student_name=$this->db->select('exp_category')->from('expense_head')->where('expense_head.id',$id)->get()->row_array();
        return $this->lang->line('search')." ".$this->lang->line('income_head')." : ".$filter_get_student_name['exp_category']; 
    }
    
    public function get_inchead_name($id){
       $filter_get_student_name=$this->db->select('income_category')->from('income_head')->where('income_head.id',$id)->get()->row_array();
        return $this->lang->line('search')." ".$this->lang->line('expense_head')." : ".$filter_get_student_name['income_category']; 
    }

    public function get_attendance_type($id){

        $filter_get_student_name=$this->db->select('type')->from('attendence_type')->where('attendence_type.id',$id)->get()->row_array();
        return $this->lang->line('attendence')." ".$this->lang->line('type')." : ".$filter_get_student_name['type'];

    }

    public function get_exam_group($id){

        $filter_get_exam_group=$this->db->select('name')->from('exam_groups')->where('exam_groups.id',$id)->get()->row_array();
        return $this->lang->line('exam')." ".$this->lang->line('group')." : ".$filter_get_exam_group['name'];

    }

    public function get_examname($id){

        $filter_get_exam=$this->db->select('exam')->from('exam_group_class_batch_exams')->where('exam_group_class_batch_exams.id',$id)->get()->row_array();

        return $this->lang->line('exam')." : ".$filter_get_exam['exam'];
    }

    public function get_onlineexamname($id){

$filter_get_exam=$this->db->select('exam')->from('onlineexam')->where('onlineexam.id',$id)->get()->row_array();

        return $this->lang->line('exam')." : ".$filter_get_exam['exam'];
    }

     public function get_sessionname($id){

        $filter_get_sessionname=$this->db->select('session')->from('sessions')->where('sessions.id',$id)->get()->row_array();

        return $this->lang->line('session')." : ".$filter_get_sessionname['session'];
    }

    public function get_rolename($id){

        $filter_get_rolename=$this->db->select('name')->from('roles')->where('roles.id',$id)->get()->row_array();

        return $this->lang->line('role')." : ".$filter_get_rolename['name'];
    }

    public function get_designation($id){
        $filter_get_rolename=$this->db->select('designation')->from('staff_designation')->where('staff_designation.id',$id)->get()->row_array();

        return $this->lang->line('designation')." : ".$filter_get_rolename['designation'];
    }

    public function get_route_title($id){
        
         $filter_get_route_title=$this->db->select('route_title')->from('transport_route')->where('transport_route.id',$id)->get()->row_array();

        return $this->lang->line('route_title')." : ".$filter_get_route_title['route_title'];
    }


   

   


}
