<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Itemissue_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    public function get($id = null) {
        $sql = "SELECT item_issue.*,item.name as `item_name`,item.item_category_id,item_category.item_category ,staff.employee_id,staff.name as staff_name,staff.surname,roles.name FROM `item_issue` INNER JOIN item on item.id=item_issue.item_id INNER JOIN item_category on item_category.id=item.item_category_id INNER JOIN staff on staff.id=item_issue.issue_to INNER JOIN staff_roles on staff_roles.staff_id =staff.id INNER JOIN roles on roles.id= staff_roles.role_id";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($id) {
		$this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->where('id', $id);
        $this->db->delete('item_issue');
		$message      = DELETE_RECORD_CONSTANT." On item issue id ".$id;
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

    /**
     * This function will take the post data passed from the controller
     * If id is present, then it will do an update
     * else an insert. One function doing both add and edit.
     * @param $data
     */
    public function add($data) {
		$this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('item_issue', $data);
			$message      = UPDATE_RECORD_CONSTANT." On  item issue id ".$data['id'];
			$action       = "Update";
			$record_id    = $data['id'];
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
        } else {
            $this->db->insert('item_issue', $data);
            $insert_id = $this->db->insert_id();
			$message      = INSERT_RECORD_CONSTANT." On item issue id ".$insert_id;
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
    }


      public function get_IssueInventoryReport($start_date,$end_date) {

        $condition=" and date_format(item_issue.issue_date,'%Y-%m-%d') between '".$start_date."' and '".$end_date."'";

        $sql = "SELECT item_issue.*,item.name as `item_name`,item.item_category_id,item_category.item_category ,staff.employee_id,staff.name as staff_name,staff.surname,roles.name FROM `item_issue` INNER JOIN item on item.id=item_issue.item_id INNER JOIN item_category on item_category.id=item.item_category_id INNER JOIN staff on staff.id=item_issue.issue_to INNER JOIN staff_roles on staff_roles.staff_id =staff.id INNER JOIN roles on roles.id= staff_roles.role_id where 1 ".$condition;

        $query = $this->db->query($sql);
        return $query->result_array();

    }

}
