<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Audit_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    function get($limit=null,$offset=NULL){
    	$this->db->select('logs.*, CONCAT_WS("",staff.name,staff.surname," (",staff.employee_id,")") as name')->from('logs');
    	 $this->db->join('staff', 'staff.id = logs.user_id');
        $this->db->order_by('logs.id','desc');
         $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count(){
        $query=$this->db->select('count(*) as total')->get('logs')->row_array();
        return $query['total'];
    }

}