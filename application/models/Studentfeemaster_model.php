<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Studentfeemaster_model extends MY_Model
{

    protected $balance_group;
    protected $balance_type;

    public function __construct()
    {
        parent::__construct();
        $this->load->config('ci-blog');
        $this->balance_group   = $this->config->item('ci_balance_group');
        $this->balance_type    = $this->config->item('ci_balance_type');
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    public function searchAssignFeeByClassSection($class_id = null, $section_id = null, $fee_session_group_id = null, $category = null, $gender = null, $rte = null)
    {
        $sql = "SELECT IFNULL(`student_fees_master`.`id`, '0') as `student_fees_master_id`,`classes`.`id` AS `class_id`,"
        . " `student_session`.`id` as `student_session_id`, `students`.`id`, "
        . "`classes`.`class`, `sections`.`id` AS `section_id`, `sections`.`section`, "
        . "`students`.`id`, `students`.`admission_no`, `students`.`roll_no`,"
        . " `students`.`admission_date`, `students`.`firstname`, `students`.`lastname`,"
        . " `students`.`image`, `students`.`mobileno`, `students`.`email`, `students`.`state`,"
        . " `students`.`city`, `students`.`pincode`, `students`.`religion`, `students`.`dob`, "
        . "`students`.`current_address`, `students`.`permanent_address`,"
        . " IFNULL(students.category_id, 0) as `category_id`,"
        . " IFNULL(categories.category, '') as `category`,"
        . " `students`.`adhar_no`, `students`.`samagra_id`,"
        . " `students`.`bank_account_no`, `students`.`bank_name`, `students`.`ifsc_code`,"
        . " `students`.`guardian_name`, `students`.`guardian_relation`, `students`.`guardian_phone`,"
        . " `students`.`guardian_address`, `students`.`is_active`, `students`.`created_at`,"
        . " `students`.`updated_at`, `students`.`father_name`, `students`.`rte`,"
        . " `students`.`gender` FROM `students` JOIN `student_session` "
        . "ON `student_session`.`student_id` = `students`.`id` JOIN `classes` "
        . "ON `student_session`.`class_id` = `classes`.`id` JOIN `sections` "
        . "ON `sections`.`id` = `student_session`.`section_id` LEFT JOIN `categories` "
        . "ON `students`.`category_id` = `categories`.`id` LEFT JOIN student_fees_master on"
        . " student_fees_master.student_session_id=student_session.id"
        . "  AND student_fees_master.fee_session_group_id=" . $this->db->escape($fee_session_group_id)
        . "WHERE `student_session`.`session_id` =  " . $this->current_session
            . " and `students`.`is_active` =  'yes'";

        if ($class_id != null) {
            $sql .= " AND `student_session`.`class_id` = " . $this->db->escape($class_id);
        }
        if ($section_id != null) {
            $sql .= " AND `student_session`.`section_id` =" . $this->db->escape($section_id);
        }
        if ($category != null) {
            $sql .= " AND `students`.`category_id` =" . $this->db->escape($category);
        }
        if ($gender != null) {
            $sql .= " AND `students`.`gender` =" . $this->db->escape($gender);
        }
        if ($rte != null) {
            $sql .= " AND `students`.`rte` =" . $this->db->escape($rte);
        }
        $sql .= " ORDER BY `students`.`id`";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function add($data) {

        $this->db->where('student_session_id', $data['student_session_id']);
        $this->db->where('fee_session_group_id', $data['fee_session_group_id']);
        $q = $this->db->get('student_fees_master');

        if ($q->num_rows() > 0) {
            return $q->row()->id;
        } else {
            $this->db->insert('student_fees_master', $data);
            return $this->db->insert_id();
        }
    }

    public function addPreviousBal($student_data, $due_date)
    {
        $this->db->trans_start();
        $this->db->trans_strict(false);
        $fee_group_exists = $this->feegroup_model->checkGroupExistsByName($this->balance_group);
        $fee_type_exists  = $this->feetype_model->checkFeetypeByName($this->balance_type);
        $fee_group_id     = 0;
        $fee_type_id      = 0;
        if (!$fee_group_exists) {
            $this->db->insert('fee_groups', array('name' => $this->balance_group, 'is_system' => 1));
            $fee_group_id = $this->db->insert_id();
        } else {
            $fee_group_id = $fee_group_exists->id;
        }

        if (!$fee_type_exists) {
            $this->db->insert('feetype', array('type' => $this->balance_type, 'code' => $this->balance_type, 'is_system' => 1));
            $fee_type_id = $this->db->insert_id();
        } else {
            $fee_type_id = $fee_type_exists->id;
        }
        $to_be_insert = array(
            'session_id'           => $this->current_session,
            'fee_groups_id'        => $fee_group_id,
            'feetype_id'           => $fee_type_id,
            'fee_session_group_id' => 0,
            'due_date'             => $due_date,
        );
        $parentid = $this->feesessiongroup_model->group_exists($to_be_insert['fee_groups_id']);

        $to_be_insert['fee_session_group_id'] = $parentid;

        $session_group_exists = $this->feesessiongroup_model->checkExists($to_be_insert);
        if (!$session_group_exists) {
            $this->db->insert('fee_groups_feetype', $to_be_insert);
        } else {
            $this->db->where('id', $session_group_exists);
            $this->db->update('fee_groups_feetype', $to_be_insert);
        }
        $student_list = array();
        if (isset($student_data) && !empty($student_data)) {

            $total_rec = count($student_data);
            for ($i = 0; $i < $total_rec; $i++) {
                $student_list[]                           = $student_data[$i]['student_session_id'];
                $student_data[$i]['id']                   = 0;
                $student_data[$i]['fee_session_group_id'] = $parentid;
            }
            $check_insert_feemaster = $this->selectInArray($parentid, $student_list);
            if (!empty($check_insert_feemaster)) {
                $insert_new_student = array();
                foreach ($student_data as $student_key => $student_value) {
                    $student_data[$student_key]['id'] = $this->findValueExists($check_insert_feemaster, $student_value['student_session_id']);
                    if ($student_data[$student_key]['id'] == 0) {
                        $insert_new_student[] = $student_data[$student_key];
                        unset($student_data[$student_key]);
                    }
                }

                if (!empty($insert_new_student)) {
                    $this->db->insert_batch('student_fees_master', $insert_new_student);
                }
                $this->db->update_batch('student_fees_master', $student_data, 'id');
            } else {
                $this->db->insert_batch('student_fees_master', $student_data);
            }
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function findValueExists($array, $find)
    {
        $id = 0;
        foreach ($array as $x => $x_value) {
            if ($x_value->student_session_id == $find) {
                return $x_value->id;
            }

        }
        return $id;
    }

    public function selectInArray($fee_session_groups, $student_session_array)
    {

        $this->db->where('fee_session_group_id', $fee_session_groups);
        $this->db->where_in('student_session_id', $student_session_array);
        $q      = $this->db->get('student_fees_master');
        $result = $q->result();
        return $result;
    }

    public function delete($fee_session_groups, $array)
    {
		$this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->where('fee_session_group_id', $fee_session_groups);
        $this->db->where_in('student_session_id', $array);
        $this->db->delete('student_fees_master');
		$message      = DELETE_RECORD_CONSTANT." On  student fees master ".$fee_session_groups;
        $action       = "Delete";
        $record_id    = $fee_session_groups;
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

    public function getBalanceMasterRecord($group_name, $student_session_array)
    {
        $sql = "select * from student_fees_master where student_session_id in $student_session_array and fee_session_group_id=(SELECT id FROM `fee_session_groups` where fee_groups_id=(SELECT id FROM `fee_groups` WHERE name=" . "'" . $group_name . "'" . ") and session_id=$this->current_session)";

        $query  = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function getStudentFees($student_session_id)
    {
        $sql= "SELECT `student_fees_master`.*,fee_groups.name FROM `student_fees_master` INNER JOIN fee_session_groups on student_fees_master.fee_session_group_id=fee_session_groups.id INNER JOIN fee_groups on fee_groups.id=fee_session_groups.fee_groups_id  WHERE `student_session_id` = " . $student_session_id . " ORDER BY `student_fees_master`.`id`";
        $query  = $this->db->query($sql);
        $result = $query->result();
        if (!empty($result)) {
            foreach ($result as $result_key => $result_value) {
               
                $fee_session_group_id   = $result_value->fee_session_group_id;
                $student_fees_master_id = $result_value->id;
                $result_value->fees     = $this->getDueFeeByFeeSessionGroup($fee_session_group_id, $student_fees_master_id);

                if ($result_value->is_system != 0) {
                    $result_value->fees[0]->amount = $result_value->amount;
                }
            }
        }
     
     
        return $result;
    }

    public function getDueFeeByFeeSessionGroup($fee_session_groups_id, $student_fees_master_id)
    {
        $sql = "SELECT student_fees_master.*,fee_groups_feetype.id as `fee_groups_feetype_id`,fee_groups_feetype.amount,fee_groups_feetype.due_date,fee_groups_feetype.fee_groups_id,fee_groups.name,fee_groups_feetype.feetype_id,feetype.code,feetype.type, IFNULL(student_fees_deposite.id,0) as `student_fees_deposite_id`, IFNULL(student_fees_deposite.amount_detail,0) as `amount_detail` FROM `student_fees_master` INNER JOIN fee_session_groups on fee_session_groups.id = student_fees_master.fee_session_group_id INNER JOIN fee_groups_feetype on  fee_groups_feetype.fee_session_group_id = fee_session_groups.id  INNER JOIN fee_groups on fee_groups.id=fee_groups_feetype.fee_groups_id INNER JOIN feetype on feetype.id=fee_groups_feetype.feetype_id LEFT JOIN student_fees_deposite on student_fees_deposite.student_fees_master_id=student_fees_master.id and student_fees_deposite.fee_groups_feetype_id=fee_groups_feetype.id WHERE student_fees_master.fee_session_group_id =" . $fee_session_groups_id . " and student_fees_master.id=" . $student_fees_master_id . " order by fee_groups_feetype.due_date ASC";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getDueFeeByFeeSessionGroupFeetype($fee_session_groups_id, $student_fees_master_id, $fee_groups_feetype_id)
    {

        $sql = "SELECT student_fees_master.id,student_fees_master.is_system,student_fees_master.student_session_id,student_fees_master.fee_session_group_id,student_fees_master.amount as `student_fees_master_amount`,fee_groups_feetype.id as `fee_groups_feetype_id`,students.firstname,students.admission_no,students.lastname,student_session.class_id,classes.class,sections.section,students.guardian_name,students.father_name,student_session.section_id,student_session.student_id,fee_groups_feetype.amount,fee_groups_feetype.due_date,fee_groups_feetype.fee_groups_id,fee_groups.name,fee_groups_feetype.feetype_id,feetype.code,feetype.type, IFNULL(student_fees_deposite.id,0) as `student_fees_deposite_id`, IFNULL(student_fees_deposite.amount_detail,0) as `amount_detail` FROM `student_fees_master` INNER JOIN fee_session_groups on fee_session_groups.id = student_fees_master.fee_session_group_id INNER JOIN fee_groups_feetype on  fee_groups_feetype.fee_session_group_id = fee_session_groups.id  INNER JOIN fee_groups on fee_groups.id=fee_groups_feetype.fee_groups_id INNER JOIN feetype on feetype.id=fee_groups_feetype.feetype_id LEFT JOIN student_fees_deposite on student_fees_deposite.student_fees_master_id=student_fees_master.id and student_fees_deposite.fee_groups_feetype_id=fee_groups_feetype.id INNER JOIN student_session on student_session.id= student_fees_master.student_session_id INNER JOIN classes on classes.id= student_session.class_id INNER JOIN sections on sections.id= student_session.section_id INNER JOIN students on students.id=student_session.student_id  WHERE student_fees_master.fee_session_group_id =" . $fee_session_groups_id . " and student_fees_master.id=" . $student_fees_master_id . " and fee_groups_feetype.id= " . $fee_groups_feetype_id;
   
        $query = $this->db->query($sql);
        return $query->row();
    }
 
    public function fee_deposit($data, $send_to, $student_fees_discount_id =null)
    {
        $this->db->where('student_fees_master_id', $data['student_fees_master_id']);
        $this->db->where('fee_groups_feetype_id', $data['fee_groups_feetype_id']);
        $q = $this->db->get('student_fees_deposite');
        if ($q->num_rows() > 0) {
            $desc = $data['amount_detail']['description'];
            $this->db->trans_start(); // Query will be rolled back
            $row = $q->row();
            $this->db->where('id', $row->id);
            $a                               = json_decode($row->amount_detail, true);
            $inv_no                          = max(array_keys($a)) + 1;
            $data['amount_detail']['inv_no'] = $inv_no;
            $a[$inv_no]                      = $data['amount_detail'];
            $data['amount_detail']           = json_encode($a);
            $this->db->update('student_fees_deposite', $data);

            if ($student_fees_discount_id != null) {
                $this->db->where('id', $student_fees_discount_id);
                $this->db->update('student_fees_discounts', array('status' => 'applied', 'description' => $desc, 'payment_id' => $row->id . "/" . $inv_no));
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();

                return false;
            } else {
                $this->db->trans_commit();
                return json_encode(array('invoice_id' => $row->id, 'sub_invoice_id' => $inv_no));
            }
        } else {

            $this->db->trans_start(); // Query will be rolled back
            $data['amount_detail']['inv_no'] = 1;
            $desc                            = $data['amount_detail']['description'];
            $data['amount_detail']           = json_encode(array('1' => $data['amount_detail']));
            $this->db->insert('student_fees_deposite', $data);
            $inserted_id = $this->db->insert_id();
            if ($student_fees_discount_id != null) {
                $this->db->where('id', $student_fees_discount_id);
                $this->db->update('student_fees_discounts', array('status' => 'applied', 'description' => $desc, 'payment_id' => $inserted_id . "/" . "1"));
            }

            $this->db->trans_complete(); # Completing transaction

            if ($this->db->trans_status() === false) {

                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return json_encode(array('invoice_id' => $inserted_id, 'sub_invoice_id' => 1));
            }
        }
    }

 public function get_feesreceived_by(){
      $result= $this->db->select('CONCAT_WS(" ",staff.name,staff.surname) as name, staff.employee_id,staff.id')->from('staff')->join('staff_roles','staff.id=staff_roles.staff_id')->where('staff.is_active','1')->where_in('staff_roles.role_id',array('1','3','7'))->get()->result_array();
      foreach ($result as $key => $value) {
          $data[$value['id']]=$value['name']." (".$value['employee_id'].")";
      }
      return $data;

 
 }  

 public function getFeeCollectionReport($start_date, $end_date,$received_by=null,$group=null)
    {

        $this->db->select('`student_fees_deposite`.*,students.firstname,students.lastname,student_session.class_id,classes.class,sections.section,student_session.section_id,student_session.student_id,`fee_groups`.`name`, `feetype`.`type`, `feetype`.`code`,student_fees_master.student_session_id')->from('student_fees_deposite');
        $this->db->join('fee_groups_feetype', 'fee_groups_feetype.id = student_fees_deposite.fee_groups_feetype_id');
        $this->db->join('fee_groups', 'fee_groups.id = fee_groups_feetype.fee_groups_id');
        $this->db->join('feetype', 'feetype.id = fee_groups_feetype.feetype_id');
        $this->db->join('student_fees_master', 'student_fees_master.id=student_fees_deposite.student_fees_master_id');
        $this->db->join('student_session', 'student_session.id= student_fees_master.student_session_id');
        $this->db->join('classes', 'classes.id= student_session.class_id');
        $this->db->join('sections', 'sections.id= student_session.section_id');
        $this->db->join('students', 'students.id=student_session.student_id');
        //$this->db->where('student_fees_deposite.id !=',65);
        $this->db->order_by('student_fees_deposite.id');
       
 
        $query        = $this->db->get();
        $result_value = $query->result();
  //echo $this->db->last_query();die;
        $return_array = array();
        if (!empty($result_value)) {
             $st_date = strtotime($start_date);
            $ed_date  = strtotime($end_date);
            foreach ($result_value as $key => $value) {
               if($received_by!=null){

                $return = $this->findObjectByCollectId($value, $st_date, $ed_date,$received_by);
               }else{

                $return = $this->findObjectById($value, $st_date, $ed_date);

               }
          
                if (!empty($return)) {

                    foreach ($return as $r_key => $r_value) {
                      
                        $a['id']                     = $value->id;
                        $a['student_fees_master_id'] = $value->student_fees_master_id;
                        $a['fee_groups_feetype_id']  = $value->fee_groups_feetype_id;
                        $a['firstname']              = $value->firstname;
                        $a['lastname']               = $value->lastname;
                        $a['class_id']               = $value->class_id;
                        $a['class']                  = $value->class;
                        $a['section']                = $value->section;
                        $a['section_id']             = $value->section_id;
                        $a['student_id']             = $value->student_id;
                        $a['name']                   = $value->name;
                        $a['type']                   = $value->type;
                        $a['code']                   = $value->code;
                        $a['student_session_id']     = $value->student_session_id;
                        $a['amount']                 = $r_value->amount;
                        $a['date']                   = $r_value->date;
                        $a['amount_discount']        = $r_value->amount_discount;
                        $a['amount_fine']            = $r_value->amount_fine;
                        $a['description']            = $r_value->description;
                        $a['payment_mode']           = $r_value->payment_mode;
                        $a['inv_no']                 = $r_value->inv_no;
                        $a['received_by']            = $r_value->received_by;
                        if(isset($r_value->received_by)){

                        $a['received_by']            = $r_value->received_by;
                        $a['received_byname']        = $this->staff_model->get_StaffNameById($r_value->received_by);

                        }else{

                       $a['received_by']            = '';
                        $a['received_byname']        = array('name'=>'','employee_id'=>'','id'=>'');
                       }
                       
                        $return_array[]              = $a;
                      
                    }
                }
                
            }
          
        }

        return $return_array;
    }

    public function getFeeBetweenDate($start_date, $end_date)
    {
        $this->db->select('`student_fees_deposite`.*,students.firstname,students.lastname,student_session.class_id,classes.class,sections.section,student_session.section_id,student_session.student_id,`fee_groups`.`name`, `feetype`.`type`, `feetype`.`code`,student_fees_master.student_session_id')->from('student_fees_deposite');
        $this->db->join('fee_groups_feetype', 'fee_groups_feetype.id = student_fees_deposite.fee_groups_feetype_id');

        $this->db->join('fee_groups', 'fee_groups.id = fee_groups_feetype.fee_groups_id');
        $this->db->join('feetype', 'feetype.id = fee_groups_feetype.feetype_id');
        $this->db->join('student_fees_master', 'student_fees_master.id=student_fees_deposite.student_fees_master_id');
        $this->db->join('student_session', 'student_session.id= student_fees_master.student_session_id');
        $this->db->join('classes', 'classes.id= student_session.class_id');

        $this->db->join('sections', 'sections.id= student_session.section_id');
        $this->db->join('students', 'students.id=student_session.student_id');
        $this->db->order_by('student_fees_deposite.id');
        $query        = $this->db->get();
        $result_value = $query->result();
        //echo $this->db->last_query();die;
        $return_array = array();
        if (!empty($result_value)) {
            $st_date = strtotime($start_date);
            $ed_date = strtotime($end_date);
            foreach ($result_value as $key => $value) {
               //  print_r($value);die;
                $return = $this->findObjectById($value, $st_date, $ed_date);

                if (!empty($return)) {

                    foreach ($return as $r_key => $r_value) {
                        $a['id']                     = $value->id;
                        $a['student_fees_master_id'] = $value->student_fees_master_id;
                        $a['fee_groups_feetype_id']  = $value->fee_groups_feetype_id;
                        $a['firstname']              = $value->firstname;
                        $a['lastname']               = $value->lastname;
                        $a['class_id']               = $value->class_id;
                        $a['class']                  = $value->class;
                        $a['section']                = $value->section;
                        $a['section_id']             = $value->section_id;
                        $a['student_id']             = $value->student_id;
                        $a['name']                   = $value->name;
                        $a['type']                   = $value->type;
                        $a['code']                   = $value->code;
                        $a['student_session_id']     = $value->student_session_id;
                        $a['amount']                 = $r_value->amount;
                        $a['date']                   = $r_value->date;
                        $a['amount_discount']        = $r_value->amount_discount;
                        $a['amount_fine']            = $r_value->amount_fine;
                        $a['description']            = $r_value->description;
                        $a['payment_mode']           = $r_value->payment_mode;
                        $a['inv_no']                 = $r_value->inv_no;

                        $return_array[]              = $a;
                    }
                }
            }
        }

        return $return_array;
    }




    public function getDepositAmountBetweenDate($start_date, $end_date)
    {

        $this->db->select('`student_fees_deposite`.*')->from('student_fees_deposite');
        $this->db->order_by('student_fees_deposite.id');
        $query        = $this->db->get();
        $result_value = $query->result();

        $return_array = array();
        if (!empty($result_value)) {
            $st_date = strtotime($start_date);
            $ed_date = strtotime($end_date);
            foreach ($result_value as $key => $value) {
                $return = $this->findObjectById($value, $st_date, $ed_date);

                if (!empty($return)) {
                    foreach ($return as $r_key => $r_value) {
                        $a                    = array();
                        $a['amount']          = $r_value->amount;
                        $a['date']            = $r_value->date;
                        $a['amount_discount'] = $r_value->amount_discount;
                        $a['amount_fine']     = $r_value->amount_fine;
                        $a['description']     = $r_value->description;
                        $a['payment_mode']    = $r_value->payment_mode;
                        $a['inv_no']          = $r_value->inv_no;
                        $return_array[]       = $a;
                    }
                }
            }
        }

        return $return_array;
    }

    public function findObjectAmount($array, $st_date, $ed_date)
    {

        $ar     = json_decode($array->amount_detail);
        $array  = array();
        $amount = 0;
        for ($i = $st_date; $i <= $ed_date; $i += 86400) {
            $find = date('Y-m-d', $i);
            foreach ($ar as $row_key => $row_value) {
                if ($row_value->date == $find) {

                    $array[] = $row_value;
                }
            }
        }
        return $array;
    }

    public function findObjectById($array, $st_date, $ed_date)
    {

        $ar    = json_decode($array->amount_detail);
       
        $array = array();
        for ($i = $st_date; $i <= $ed_date; $i += 86400) {
            $find = date('Y-m-d', $i);
            foreach ($ar as $row_key => $row_value) {
                if($row_value->date == $find) {
                    $array[] = $row_value;
                }
            }
        } 

        return $array;

    }

     public function findObjectByCollectId($array, $st_date, $ed_date,$receivedBy)
    {

        $ar    = json_decode($array->amount_detail);
    
        $array = array();
        for ($i = $st_date; $i <= $ed_date; $i += 86400) {
            $find = date('Y-m-d', $i);
            foreach ($ar as $row_key => $row_value) {
                 if(isset($row_value->received_by)){
                if($row_value->date == $find && $row_value->received_by==$receivedBy) {
                    $array[] = $row_value;
                }
            }
            }
        }

        return $array;

    }


    public function getFeeByInvoice($invoice_id, $sub_invoice_id)
    {
        $this->db->select('`student_fees_deposite`.*,students.firstname,students.lastname,students.admission_no,student_session.class_id,classes.class,sections.section,student_session.section_id,student_session.student_id,`fee_groups`.`name`, `feetype`.`type`, `feetype`.`code`,student_fees_master.student_session_id')->from('student_fees_deposite');
        $this->db->join('fee_groups_feetype', 'fee_groups_feetype.id = student_fees_deposite.fee_groups_feetype_id');

        $this->db->join('fee_groups', 'fee_groups.id = fee_groups_feetype.fee_groups_id');
        $this->db->join('feetype', 'feetype.id = fee_groups_feetype.feetype_id');
        $this->db->join('student_fees_master', 'student_fees_master.id=student_fees_deposite.student_fees_master_id');
        $this->db->join('student_session', 'student_session.id= student_fees_master.student_session_id');
        $this->db->join('classes', 'classes.id= student_session.class_id');

        $this->db->join('sections', 'sections.id= student_session.section_id');
        $this->db->join('students', 'students.id=student_session.student_id');
        $this->db->where('student_fees_deposite.id', $invoice_id);
        $q = $this->db->get();

        if ($q->num_rows() > 0) {
            $result = $q->row();
            $res    = json_decode($result->amount_detail);
            $a      = (array) $res;

            foreach ($a as $key => $value) {
                if ($key == $sub_invoice_id) {

                    return $result;
                }
            }
        }

        return false;
    }

    public function studentDeposit($data)
    {
        $sql = "SELECT fee_groups.is_system,student_fees_master.amount as `student_fees_master_amount`, fee_groups.name as `fee_group_name`,feetype.code as `fee_type_code`,fee_groups_feetype.amount,fee_groups_feetype.fine_percentage,fee_groups_feetype.fine_amount,fee_groups_feetype.due_date,IFNULL(student_fees_deposite.amount_detail,0) as `amount_detail` from student_fees_master
               INNER JOIN fee_session_groups on fee_session_groups.id=student_fees_master.fee_session_group_id
              INNER JOIN fee_groups_feetype on fee_groups_feetype.fee_groups_id=fee_session_groups.fee_groups_id
              INNER JOIN fee_groups on fee_groups_feetype.fee_groups_id=fee_groups.id
              INNER JOIN feetype on fee_groups_feetype.feetype_id=feetype.id
         LEFT JOIN student_fees_deposite on student_fees_deposite.student_fees_master_id=student_fees_master.id and student_fees_deposite.fee_groups_feetype_id=fee_groups_feetype.id WHERE student_fees_master.id =" . $data['student_fees_master_id'] . " and fee_groups_feetype.id =" . $data['fee_groups_feetype_id'];
        $query = $this->db->query($sql);

        return $query->row();
    }

    public function getPreviousStudentFees($student_session_id)
    {
        $sql    = "SELECT `student_fees_master`.*,fee_groups.name FROM `student_fees_master` INNER JOIN fee_session_groups on student_fees_master.fee_session_group_id=fee_session_groups.id INNER JOIN fee_groups on fee_groups.id=fee_session_groups.fee_groups_id  WHERE `student_session_id` = " . $student_session_id . " ORDER BY `student_fees_master`.`id`";
        $query  = $this->db->query($sql);
        $result = $query->result();
        if (!empty($result)) {
            foreach ($result as $result_key => $result_value) {
                $fee_session_group_id   = $result_value->fee_session_group_id;
                $student_fees_master_id = $result_value->id;
                $result_value->fees     = $this->getDueFeeByFeeSessionGroup($fee_session_group_id, $student_fees_master_id);

                if ($result_value->is_system != 0) {
                    $result_value->fees[0]->amount = $result_value->amount;
                }
            }
        }

        return $result;
    }

    public function fee_deposit_collections($data)
    {
        if(!empty($data)){

            
        foreach ($data as $d_key => $d_value) {

            $this->db->where('student_fees_master_id', $data[$d_key]['student_fees_master_id']);
            $this->db->where('fee_groups_feetype_id', $data[$d_key]['fee_groups_feetype_id']);
            $q = $this->db->get('student_fees_deposite');
            if ($q->num_rows() > 0) {
                $desc = $data[$d_key]['amount_detail']['description'];

                $row = $q->row();
                $this->db->where('id', $row->id);
                $a                               = json_decode($row->amount_detail, true);
                $inv_no                          = max(array_keys($a)) + 1;
                $data[$d_key]['amount_detail']['inv_no'] = $inv_no;
                $a[$inv_no]                      = $data[$d_key]['amount_detail'];
                $data[$d_key]['amount_detail']           = json_encode($a);

                $this->db->update('student_fees_deposite', $data[$d_key]);

              

            } else {

                $data[$d_key]['amount_detail']['inv_no'] = 1;
                $desc                                    = $data[$d_key]['amount_detail']['description'];
                $data[$d_key]['amount_detail']           = json_encode(array('1' => $data[$d_key]['amount_detail']));

                $this->db->insert('student_fees_deposite', $data[$d_key]);
                $inserted_id = $this->db->insert_id();

                // return json_encode(array('invoice_id' => $inserted_id, 'sub_invoice_id' => 1));

            }
        }

    }
    }

    public function findOnlineObjectById($array, $st_date, $ed_date)
    {

        $ar    = json_decode($array->amount_detail);
       // echo "</pre>";
       // print_r($ar);
       // echo "<pre>";
        $mode = array('Cheque','Cash','DD');
        $array = array();
        for ($i = $st_date; $i <= $ed_date; $i += 86400) {
            $find = date('Y-m-d', $i);
            foreach ($ar as $row_key => $row_value) {
                if($row_value->date == $find ) {
                    if(!in_array($row_value->payment_mode, $mode, TRUE)){
                        $array[] = $row_value;
                    }
                    
                }
            }
        }
//die;
        return $array;

    }

    public function getOnlineFeeCollectionReport($start_date, $end_date){

         $this->db->select('`student_fees_deposite`.*,students.firstname,students.lastname,student_session.class_id,classes.class,sections.section,student_session.section_id,student_session.student_id,`fee_groups`.`name`, `feetype`.`type`, `feetype`.`code`,student_fees_master.student_session_id')->from('student_fees_deposite');
        $this->db->join('fee_groups_feetype', 'fee_groups_feetype.id = student_fees_deposite.fee_groups_feetype_id');

        $this->db->join('fee_groups', 'fee_groups.id = fee_groups_feetype.fee_groups_id');
        $this->db->join('feetype', 'feetype.id = fee_groups_feetype.feetype_id');
        $this->db->join('student_fees_master', 'student_fees_master.id=student_fees_deposite.student_fees_master_id');
        $this->db->join('student_session', 'student_session.id= student_fees_master.student_session_id');
        $this->db->join('classes', 'classes.id= student_session.class_id');
        $this->db->join('sections', 'sections.id= student_session.section_id');
        $this->db->join('students', 'students.id=student_session.student_id');
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->order_by('student_fees_deposite.id');
//$this->db->limit(0, 80); 

       

        $query        = $this->db->get();
        $result_value = $query->result();
       
        $return_array = array();
        if (!empty($result_value)) {
             $st_date = strtotime($start_date);
            $ed_date  = strtotime($end_date);
            foreach ($result_value as $key => $value) {
             $return = $this->findOnlineObjectById($value, $st_date, $ed_date);                           
                if (!empty($return)) {

                    foreach ($return as $r_key => $r_value) {
                        $a['id']                     = $value->id;
                        $a['student_fees_master_id'] = $value->student_fees_master_id;
                        $a['fee_groups_feetype_id']  = $value->fee_groups_feetype_id;
                        $a['firstname']              = $value->firstname;
                        $a['lastname']               = $value->lastname;
                        $a['class_id']               = $value->class_id;
                        $a['class']                  = $value->class;
                        $a['section']                = $value->section;
                        $a['section_id']             = $value->section_id;
                        $a['student_id']             = $value->student_id;
                        $a['name']                   = $value->name;
                        $a['type']                   = $value->type;
                        $a['code']                   = $value->code;
                        $a['student_session_id']     = $value->student_session_id;
                        $a['amount']                 = $r_value->amount;
                        $a['date']                   = $r_value->date;
                        $a['amount_discount']        = $r_value->amount_discount;
                        $a['amount_fine']            = $r_value->amount_fine;
                        $a['description']            = $r_value->description;
                        $a['payment_mode']           = $r_value->payment_mode;
                        $a['inv_no']                 = $r_value->inv_no;
                        $a['received_by']            = $r_value->received_by;
                        $a['received_byname']        = $this->staff_model->get_StaffNameById($r_value->received_by);
                        $return_array[]              = $a;
                    }
                }
                
            }
          
        }

        return $return_array;
    }

     public function getFeesAwaiting($start_date,$end_date)
    {
       $sql = "SELECT student_fees_master.*,fee_groups_feetype.id as `fee_groups_feetype_id`,fee_groups_feetype.amount,fee_groups_feetype.due_date,fee_groups_feetype.fee_groups_id,fee_groups.name,fee_groups_feetype.feetype_id,feetype.code,feetype.type, IFNULL(student_fees_deposite.id,0) as `student_fees_deposite_id`, IFNULL(student_fees_deposite.amount_detail,0) as `amount_detail` FROM `student_fees_master` inner  join student_session on student_fees_master.student_session_id=student_session.id INNER JOIN fee_session_groups on fee_session_groups.id = student_fees_master.fee_session_group_id INNER JOIN fee_groups_feetype on  fee_groups_feetype.fee_session_group_id = fee_session_groups.id  INNER JOIN fee_groups on fee_groups.id=fee_groups_feetype.fee_groups_id INNER JOIN feetype on feetype.id=fee_groups_feetype.feetype_id LEFT JOIN student_fees_deposite on student_fees_deposite.student_fees_master_id=student_fees_master.id and student_fees_deposite.fee_groups_feetype_id=fee_groups_feetype.id where date_format(fee_groups_feetype.due_date,'%Y-%m-%d') between '".$start_date."' and '".$end_date."'    order by fee_groups_feetype.due_date asc";
//and student_session.session_id='".$this->current_session."'
        $query  = $this->db->query($sql);
        $result = $query->result();

        return $result;
    }

}
