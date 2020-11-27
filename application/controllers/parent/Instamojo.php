<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Instamojo extends parent_Controller {
public $api_config = "";
	public function __construct()
	{
		parent::__construct();

	$api_config = $this->paymentsetting_model->getActiveMethod();
		
	}
 

	public function index()
	{
		$instadetails=$this->paymentsetting_model->getActiveMethod();
		$insta_apikey=$instadetails->api_secret_key;
		$insta_authtoken=$instadetails->api_publishable_key;
		
		$params = $this->session->userdata('params');
        $data = array();
        $student_fees_master_id = $params['student_fees_master_id'];
        $fee_groups_feetype_id = $params['fee_groups_feetype_id'];
        $student_id = $params['student_id'];
        $total = $params['total'];

        $data['student_fees_master_id'] = $student_fees_master_id;
        $data['fee_groups_feetype_id'] = $fee_groups_feetype_id;
        $data['student_id'] = $student_id;
        $data['total'] = $total;
        $data['symbol'] = $params['invoice']->symbol;
        $data['currency_name'] = $params['invoice']->currency_name;
        $data['name'] = $params['name'];
        $data['guardian_phone'] = $params['guardian_phone'];
        $amount = $data['total'];
     
		$ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/');// for live https://www.instamojo.com/api/1.1/payment-requests/
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
                    array("X-Api-Key:$insta_apikey",
                          "X-Auth-Token:$insta_authtoken"));
        $payload = Array(
            'purpose' => 'Student Fess',
            'amount' => $amount,
            'phone' => '9999999999',
            'buyer_name' => $data['name'],
            'redirect_url' => base_url().'parent/instamojo/success',
            'send_email' => false,
            'webhook' => base_url().'webhooks/insta_webhook',
            'send_sms' => false,
            'email' => 'foo@example.com',
            'allow_repeated_payments' => false
        );

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $response = curl_exec($ch);
        curl_close($ch); 
        $json = json_decode($response, true);
        $url = $json['payment_request']['longurl']; 

        header( "Location: $url" );
	}

	
public function success()
	{
		
		$params = $this->session->userdata('params');
        $payment_id = $_GET['payment_id'];
        $json_array = array(
            'amount' => $params['total'],
            'date' => date('Y-m-d'),
            'amount_discount' => 0,
            'amount_fine' => 0,
            'description' => "Online fees deposit through Instamojo TXN ID: " . $payment_id,
            'received_by' => '',
            'payment_mode' => 'Instamojo',
        );

        $data = array(
            'student_fees_master_id' => $params['student_fees_master_id'],
            'fee_groups_feetype_id' => $params['fee_groups_feetype_id'],
            'amount_detail' => $json_array
        );
        
        $send_to = $params['guardian_phone'];
        $inserted_id = $this->studentfeemaster_model->fee_deposit($data, $send_to);
        $invoice_detail = json_decode($inserted_id);

        redirect(base_url("parent/payment/successinvoice/" . $invoice_detail->invoice_id . "/" . $invoice_detail->sub_invoice_id));
		
	}

	
}

