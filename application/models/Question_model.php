<?php

class Question_model extends MY_model {

	 public function add($data) {
		$this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('questions', $data);
			$message      = UPDATE_RECORD_CONSTANT." On  questions id ".$data['id'];
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
            $this->db->insert('questions', $data);          
			$id=$this->db->insert_id();
			$message      = INSERT_RECORD_CONSTANT." On  questions id ".$id;
			$action       = "Insert";
			$record_id    = $id;
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
			return $id;
        }
    }

    public function get($id = null) {
        $this->db->select('questions.*,subjects.name')->from('questions');

        $this->db->join('subjects', 'subjects.id = questions.subject_id');
        if ($id != null) {
            $this->db->where('questions.id', $id);
        } else {
            $this->db->order_by('questions.id');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row();
        } else {
            return $query->result();
        }
    }

    public function remove($id){
		$this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->where('id', $id);
        $this->db->delete('questions');
		$message      = DELETE_RECORD_CONSTANT." On questions id ".$id;
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

    public function image_add($id,$image){

        $this->db->where('id', $id);
        $this->db->update('questions', $image);

    }

    public function add_option($data){
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('question_options', $data);
        } else {
            $this->db->insert('question_options', $data);
            return $this->db->insert_id();
        }
    }

    public function add_question_answers($data){
 if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('question_answers', $data);
        } else {
            $this->db->insert('question_answers', $data);
            return $this->db->insert_id();
        }
    }

    public function get_result($id){
        return $this->db->select('*')->from('questions')->join('question_answers','question.id=question_answers.question_id')->get()->row_array();

    }
    public function get_option($id){
        return $this->db->select('id,option')->from('question_options')->where('question_id',$id)->get()->result_array();
    }

    public function get_answer($id){
        return $this->db->select('option_id as answer_id')->from('question_answers')->where('question_id',$id)->get()->row_array();
    }
}