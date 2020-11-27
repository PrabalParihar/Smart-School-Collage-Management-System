<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Bookissue_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    public function get($id = null)
    {
        $this->db->select()->from('book_issues');
        if ($id != null) {
            $this->db->where('book_issues.id', $id);
        } else {
            $this->db->order_by('book_issues.id');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($id)
    {
		$this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->where('id', $id);
        $this->db->delete('book_issues');
		$message      = DELETE_RECORD_CONSTANT." On book issues id ".$id;
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

    public function add($data)
    {
		$this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->insert('book_issues', $data);
        $insert_id = $this->db->insert_id();
		$message      = INSERT_RECORD_CONSTANT." On book issues id ".$insert_id;
		$action       = "Insert";
		$record_id    = $insert_id;
		$this->log($message, $record_id, $action);
		//echo $this->db->last_query();die;
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
		return $insert_id;
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    public function getMemberBooks($member_id=null)
    {
        $this->db->select('book_issues.id,book_issues.return_date,book_issues.duereturn_date,book_issues.issue_date,book_issues.is_returned,books.book_title,books.book_no,books.author')->from('book_issues');
        $this->db->join('books', 'books.id = book_issues.book_id', 'left');
        if ($member_id != null) {
            $this->db->where('book_issues.member_id', $member_id);
            $this->db->order_by("book_issues.is_returned", "asc");
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getissueMemberBooks($member_id=null)
    {
        
          $sql = "SELECT libarary_members.id as members_id,libarary_members.library_card_no,`book_issues`.`id`,staff.name as fname,staff.surname as lname, 'admission'=' ' as admission ,libarary_members.member_type,`book_issues`.`return_date`, `book_issues`.`issue_date`, `book_issues`.`is_returned`, `books`.`book_title`, `books`.`book_no`, `books`.`author` FROM `book_issues` LEFT JOIN `books` ON `books`.`id` = `book_issues`.`book_id` left join libarary_members on libarary_members.id=book_issues.member_id left join staff on staff.id=libarary_members.member_id WHERE `book_issues`.`is_returned` = '0' and libarary_members.member_type='teacher' union all SELECT libarary_members.id as members_id, libarary_members.library_card_no, `book_issues`.`id`,students.firstname as fname,students.lastname as lname, students.admission_no as adminssion,libarary_members.member_type, `book_issues`.`return_date`, `book_issues`.`issue_date`, `book_issues`.`is_returned`, `books`.`book_title`, `books`.`book_no`, `books`.`author` FROM `book_issues` LEFT JOIN `books` ON `books`.`id` = `book_issues`.`book_id` left join libarary_members on libarary_members.id=book_issues.member_id left join students on students.id=libarary_members.member_id WHERE `book_issues`.`is_returned` = '0' and libarary_members.member_type='student'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }


     public function getissuereturnMemberBooks($member_id=null)
    {
    $sql = "SELECT libarary_members.id as members_id,libarary_members.library_card_no,`book_issues`.`id`,staff.name as fname,staff.surname as lname, 'admission'=' ' as admission ,libarary_members.member_type,`book_issues`.`return_date`, `book_issues`.`issue_date`, `book_issues`.`is_returned`, `books`.`book_title`, `books`.`book_no`, `books`.`author` FROM `book_issues` LEFT JOIN `books` ON `books`.`id` = `book_issues`.`book_id` left join libarary_members on libarary_members.id=book_issues.member_id left join staff on staff.id=libarary_members.member_id WHERE `book_issues`.`is_returned` = '1' and libarary_members.member_type='teacher' union all SELECT libarary_members.id as members_id, libarary_members.library_card_no, `book_issues`.`id`,students.firstname as fname,students.lastname as lname, students.admission_no as adminssion,libarary_members.member_type, `book_issues`.`return_date`, `book_issues`.`issue_date`, `book_issues`.`is_returned`, `books`.`book_title`, `books`.`book_no`, `books`.`author` FROM `book_issues` LEFT JOIN `books` ON `books`.`id` = `book_issues`.`book_id` left join libarary_members on libarary_members.id=book_issues.member_id left join students on students.id=libarary_members.member_id WHERE `book_issues`.`is_returned` = '1' and libarary_members.member_type='student'";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function update($data)
    {	
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('book_issues', $data);
        }
    }
 
    public function book_issuedByMemberID($member_id)
    {
        $this->db->select('book_issues.return_date,books.book_no,book_issues.issue_date,book_issues.is_returned,books.book_title,books.author,`book_issues`.`duereturn_date`')
            ->from('book_issues')
            ->join('libarary_members', 'libarary_members.id = book_issues.member_id', 'left')
            ->join('books', 'books.id = book_issues.book_id', 'left')
            ->where('libarary_members.id', $member_id)
            ->order_by('book_issues.is_returned', 'asc');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getAvailQuantity($id = null)
    {
        $sql = "SELECT books.*,IFNULL(total_issue, '0') as `total_issue` FROM books LEFT JOIN (SELECT COUNT(*) as `total_issue`, book_id from book_issues  where is_returned= 0 GROUP by book_id ) as `book_count` on books.id=book_count.book_id WHERE books.id=$id";

        $query = $this->db->query($sql);
        return $query->row();
    }

    public function valid_check_exists($str)
    {

        $book_id = $this->input->post('book_id');
            if($book_id  == ""){
                return true;
            }
          
        if ($this->checkAvailQuantity($book_id)) {
            $this->form_validation->set_message('check_exists', 'Book not available');
            return false;
        } else {
            return true;
        }
    }

    public function checkAvailQuantity($id = null)
    {

        $sql = "SELECT books.*,IFNULL(total_issue, '0') as `total_issue` FROM books LEFT JOIN (SELECT COUNT(*) as `total_issue`, book_id from book_issues  where is_returned= 0 GROUP by book_id) as `book_count` on books.id=book_count.book_id WHERE books.id=$id";

        $query     = $this->db->query($sql);
        $result    = $query->row();
        $remaining = ($result->qty - $result->total_issue);

        if ($remaining > 0) {
            return false;
        }
        return true;
    }

    public function studentBookIssue_report($start_date,$end_date)
    {
        $condition="";
            $condition.=" and date_format(book_issues.issue_date,'%Y-%m-%d') between '".$start_date."' and '".$end_date."'";

        if(isset($_POST['members_type']) && $_POST['members_type']!=''){

            $condition.=" and libarary_members.member_type='".$_POST['members_type']."'";

        }

            $sql = "SELECT libarary_members.id as members_id,libarary_members.library_card_no,`book_issues`.`id`,CONCAT_WS(' ',staff.name,staff.surname) as staff_name,CONCAT_WS(' ',students.firstname,students.lastname) as student_name, students.admission_no as admission ,libarary_members.member_type,`book_issues`.`return_date`, `book_issues`.`issue_date`, `book_issues`.`is_returned`, `books`.`book_title`, `books`.`book_no`, `books`.`author` FROM `book_issues` LEFT JOIN `books` ON `books`.`id` = `book_issues`.`book_id` left join libarary_members on libarary_members.id=book_issues.member_id left join staff on staff.id=libarary_members.member_id left join students on (students.id=libarary_members.member_id and libarary_members.member_type='student') WHERE `book_issues`.`is_returned` = '0' ".$condition;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

  

 public function bookduereport($start_date,$end_date){
      $condition=" and date_format(book_issues.duereturn_date,'%Y-%m-%d') between '".$start_date."' and '".$end_date."'";
       if(isset($_POST['members_type']) && $_POST['members_type']!=''){

            $condition.=" and libarary_members.member_type='".$_POST['members_type']."'";

        }
          $sql = "SELECT libarary_members.id as members_id,libarary_members.library_card_no,`book_issues`.`id`,CONCAT_WS(' ',staff.name,students.firstname) as fname,CONCAT_WS(' ',staff.surname,students.lastname) as lname, students.admission_no as admission ,libarary_members.member_type,`book_issues`.`return_date`, `book_issues`.`issue_date`, `book_issues`.`is_returned`, `books`.`book_title`, `books`.`book_no`, `books`.`author`,`book_issues`.duereturn_date FROM `book_issues` LEFT JOIN `books` ON `books`.`id` = `book_issues`.`book_id` left join libarary_members on libarary_members.id=book_issues.member_id left join staff on (staff.id=libarary_members.member_id and libarary_members.member_type='teacher') left join students on (students.id=libarary_members.member_id and libarary_members.member_type='student') WHERE `book_issues`.`is_returned` = '0' ".$condition;
        $query = $this->db->query($sql);
        return $query->result_array();  
    }

    public function dueforreturn($start_date,$end_date){

$condition=" and date_format(book_issues.duereturn_date,'%Y-%m-%d') between '".$start_date."' and '".$end_date."'";

$sql = "SELECT count(*) as total FROM `book_issues` LEFT JOIN `books` ON `books`.`id` = `book_issues`.`book_id` left join libarary_members on libarary_members.id=book_issues.member_id left join staff on staff.id=libarary_members.member_id WHERE `book_issues`.`is_returned` = '0' ".$condition;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function forreturn($start_date,$end_date){
$condition=" and date_format(book_issues.duereturn_date,'%Y-%m-%d') between '".$start_date."' and '".$end_date."'";

$sql = "SELECT count(*) as total FROM `book_issues` LEFT JOIN `books` ON `books`.`id` = `book_issues`.`book_id` left join libarary_members on libarary_members.id=book_issues.member_id left join staff on staff.id=libarary_members.member_id WHERE `book_issues`.`is_returned` = '1' ".$condition;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

}
