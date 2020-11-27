<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Route_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    public function get($id = null) {
        $this->db->select()->from('transport_route');
        if ($id != null) {
            $this->db->where('transport_route.id', $id);
        } else {
            $this->db->order_by('transport_route.id');
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
        $this->db->delete('transport_route');
		$message      = DELETE_RECORD_CONSTANT." On transport route id ".$id;
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
            $this->db->update('transport_route', $data);
			$message      = UPDATE_RECORD_CONSTANT." On  transport route id ".$data['id'];
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
            $this->db->insert('transport_route', $data);
            $insert_id = $this->db->insert_id();
			$message      = INSERT_RECORD_CONSTANT." On transport route id ".$insert_id;
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

    public function listroute() {
        $this->db->select()->from('transport_route');
        $listtransport = $this->db->get();
        return $listtransport->result_array();
    }

    public function listvehicles() {
        $this->db->select()->from('vehicles');
        $listvehicles = $this->db->get();
        return $listvehicles->result_array();
    }

    function studentTransportDetails($carray) {

        $userdata = $this->customlib->getUserData();

        if (($userdata["role_id"] == 2) && ($userdata["class_teacher"] == "yes")) {
            if (!empty($carray)) {

                $this->db->where_in("student_session.class_id", $carray);
            } else {
                $this->db->where_in("student_session.class_id", "");
            }
        }
         $this->db->where('students.is_active','yes');
        $query = $this->db->select('students.firstname,students.id,students.admission_no,students.father_name,students.mother_name, students.father_phone,students.mother_phone,classes.class,sections.section,students.lastname,students.mobileno,transport_route.route_title,transport_route.fare,vehicles.vehicle_no,vehicles.vehicle_model,vehicles.driver_name,vehicles.driver_contact')->join('student_session', 'students.id = student_session.student_id')->join('sections', 'sections.id = student_session.section_id')->join('classes', 'classes.id = student_session.class_id')->join("vehicle_routes", "students.vehroute_id = vehicle_routes.id")->join("vehicles", "vehicle_routes.vehicle_id = vehicles.id")->join("transport_route", "vehicle_routes.route_id = transport_route.id")->where('student_session.session_id',$this->current_session)->get("students");
        // $query = $this->db->select('students.firstname,students.id, students.father_name,students.mother_name, students.father_phone,students.mother_phone, students.admission_no,students.lastname,students.mobileno,transport_route.route_title,transport_route.fare,vehicles.vehicle_no,vehicles.vehicle_model,vehicles.driver_name,vehicles.driver_contact')->join("vehicle_routes", "students.vehroute_id = vehicle_routes.id")->join("vehicles", "vehicle_routes.vehicle_id = vehicles.id")->join("transport_route", "vehicle_routes.route_id = transport_route.id")->where("students.is_active", "yes")->get("students");
      //  echo $this->db->last_query();
       // exit();
        return $query->result_array();
    }

    function searchTransportDetails($section_id, $class_id, $route_title, $vehicle_no) {

        if((!empty($class_id)) && (!empty($section_id))){
           
            $this->db->where('student_session.class_id',$class_id)->where('student_session.section_id',$section_id)->where('student_session.session_id',$this->current_session);
        }


        if(!empty($route_title)){
           
            $this->db->where('transport_route.route_title',$route_title)->where('student_session.session_id',$this->current_session);
        }

        if(!empty($vehicle_no)){
           
            $this->db->where('vehicles.vehicle_no',$vehicle_no)->where('student_session.session_id',$this->current_session);
        }

        $this->db->where('students.is_active','yes');
        $query = $this->db->select('students.firstname,students.id,students.admission_no,students.father_name,students.mother_name, students.father_phone,students.mother_phone,classes.class,sections.section,students.lastname,students.mobileno,transport_route.route_title,transport_route.fare,vehicles.vehicle_no,vehicles.vehicle_model,vehicles.driver_name,vehicles.driver_contact')->join('student_session', 'students.id = student_session.student_id')->join('sections', 'sections.id = student_session.section_id')->join('classes', 'classes.id = student_session.class_id')->join("vehicle_routes", "students.vehroute_id = vehicle_routes.id")->join("vehicles", "vehicle_routes.vehicle_id = vehicles.id")->join("transport_route", "vehicle_routes.route_id = transport_route.id")->get("students");
    

        return $query->result_array();
    }


    public function getClass($student_id)
    {
        $query = $this->db->query("SELECT  classes.class, classes.id  FROM  `classes`  where id in ( SELECT max(class_id) from student_session WHERE student_id = $student_id) ");
        return $query->row_array();
    }

     public function getSection($student_id,$class_id)
    {
        $query = $this->db->query("SELECT  sections.section  FROM  `sections` join student_session on student_session.section_id = sections.id where student_session.class_id = ".$class_id." and student_session.student_id = ".$student_id);
        return $query->row_array();
    }
}


