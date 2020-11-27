<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class visitors_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->current_session_name = $this->setting_model->getCurrentSessionName();
        $this->start_month = $this->setting_model->getStartMonth();
    }

    function add($data) {
		$this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->insert('visitors_book', $data);
        $query = $this->db->insert_id();
		$message      = INSERT_RECORD_CONSTANT." On  visitors  id ".$query;
        $action       = "Insert";
        $record_id    = $query;
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
    }

    public function getPurpose() {
        $this->db->select('*');
        $this->db->from('visitors_purpose');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function visitors_list($id = null) {
        $this->db->select()->from('visitors_book');
        if ($id != null) {
            $this->db->where('visitors_book.id', $id);
        } else {
            $this->db->order_by('visitors_book.id', 'desc');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function delete($id) {
		$this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->where('id', $id);
        $this->db->delete('visitors_book');
		$message      = DELETE_RECORD_CONSTANT." On  visitors  id ".$id;
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
        $this->session->set_flashdata('msg', '<div class="alert alert-success">'.$this->lang->line('delete_message').'</div>');
        redirect('admin/visitors');
    }

    public function update($id, $data) {
		$this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->where('id', $id);
        $this->db->update('visitors_book', $data);
        
		$message      = UPDATE_RECORD_CONSTANT." On  visitors id ".$id;
        $action       = "Update";
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
		$this->session->set_flashdata('msg', '<div class="alert alert-success">'.$this->lang->line('update_message').'</div>');
        redirect('admin/visitors');
    }

    public function image_add($visitor_id, $image) {
        $array = array('id' => $visitor_id);
        $this->db->set('image', $image);
        $this->db->where($array);
        $this->db->update('visitors_book');
        $this->session->set_flashdata('msg', '<div class="alert alert-success">'.$this->lang->line('success_message').'</div>');
        redirect('admin/visitors');
    }

    public function image_update($visitor_id, $image) {
        $array = array('id' => $visitor_id);
        $this->db->set('image', $image);
        $this->db->where($array);
        $this->db->update('visitors_book');
        $this->session->set_flashdata('msg', '<div class="alert alert-success">'.$this->lang->line('success_message').'</div>');
       
    }

    public function image_delete($id, $img_name) {
        $file = "./uploads/front_office/visitors/" . $img_name;
        unlink($file);
        $this->db->where('id', $id);
        $this->db->delete('visitors_book');
        $controller_name = $this->uri->segment(2);
        $this->session->set_flashdata('msg', '<div class="alert alert-success"> ' . ucfirst($controller_name) . ''.$this->lang->line('success_message').'</div>');
        redirect('admin/' . $controller_name);
    }

}
