<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Onlineexamquestion_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    public function getByExamID($exam_id, $limit, $start,$where_search)
    {
       
        $this->db->select('questions.*,subjects.name as subject_name, IFNULL(onlineexam_questions.id,0) as `onlineexam_question_id`')->from('questions');

        $this->db->join('subjects', 'subjects.id = questions.subject_id');
        $this->db->join('onlineexam_questions', '(onlineexam_questions.question_id = questions.id AND onlineexam_questions.onlineexam_id='.$this->db->escape($exam_id).')','LEFT');

        if(!empty($where_search)){


        $this->db->where($where_search['and_array']);
        }
        $this->db->order_by('questions.id');
        $this->db->limit($limit, $start);

        $query = $this->db->get();

        return $query->result();

    }

    public function getCountByExamID($exam_id,$where_search)
    {
        $this->db->select('questions.*,subjects.name as subject_name')->from('questions');

        $this->db->join('subjects', 'subjects.id = questions.subject_id');       
 if(!empty($where_search)){
            
     
        $this->db->where($where_search['and_array']);
        }
        $query = $this->db->get();
        return $query->num_rows();

    }

}
