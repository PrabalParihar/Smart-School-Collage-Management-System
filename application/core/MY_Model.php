<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MY_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('user_agent');
    }

    public function log($message=NULL,$record_id= NULL,$action= NULL)
    {
    	$user_id= $this->customlib->getStaffID();

        $ip = $this->input->ip_address();

        if ($this->agent->is_browser()) {
            $agent = $this->agent->browser() . ' ' . $this->agent->version();
        } elseif ($this->agent->is_robot()) {
            $agent = $this->agent->robot();
        } elseif ($this->agent->is_mobile()) {

            $agent = $this->agent->mobile();
        } else {
            $agent = 'Unidentified User Agent';
        }

        $platform = $this->agent->platform(); // Platform info (Windows, Linux, Mac, etc.)

        $insert = array(
            'message'    => $message,
            'user_id'    => $user_id,
            'record_id'    => $record_id,
            'ip_address' => $ip,
            'platform'   => $platform,
            'agent'      => $agent,
            'action'     => $action,
        );

        $this->db->insert('logs', $insert);
    }
}
