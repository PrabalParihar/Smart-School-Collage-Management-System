<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Paypal extends CI_Controller {

    public $setting = "";

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
       
        $this->load->library('auth');
        $this->load->library('paypal_payment');
        
        $this->setting = $this->setting_model->get();
    }

    public function index() {
        $this->session->set_userdata('top_menu', 'Library');
        $this->session->set_userdata('sub_menu', 'book/index');
        $data = array();
        $data['params'] = $this->session->userdata('params');
        $data['setting'] = $this->setting;

        $this->load->view('student/paypal', $data);
    }

    function checkout() {

        $this->form_validation->set_rules('student_fees_master_id', 'Feemaster', 'required|trim|xss_clean');
        $this->form_validation->set_rules('fee_groups_feetype_id', 'Fee Type', 'required|trim|xss_clean');
        $this->form_validation->set_rules('student_id', 'Student', 'required|trim|xss_clean');
        $this->form_validation->set_rules('total', 'Amount', 'required|trim|xss_clean');

        if ($this->form_validation->run() == false) {
            $data = array(
                'student_fees_master_id' => form_error('student_fees_master_id'),
                'fee_groups_feetype_id' => form_error('fee_groups_feetype_id'),
                'student_id' => form_error('student_id'),
                'amount' => form_error('amount'),
            );
            $array = array('status' => 'fail', 'error' => $data);
            echo json_encode($array);
        } else {

            $array = array('status' => 'success', 'error' => '');
            echo json_encode($array);
        }
    }

    public function complete() {

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $params = $this->session->userdata('params');

            $data = array();
            $data['student_fees_master_id'] = $this->input->post('student_fees_master_id');
            $data['fee_groups_feetype_id'] = $this->input->post('fee_groups_feetype_id');
            $data['student_id'] = $this->input->post('student_id');
            $data['total'] = $this->input->post('total');
            $data['symbol'] = $params['invoice']->symbol;
            $data['currency_name'] = $params['invoice']->currency_name;
            $data['name'] = $params['name'];
            $data['guardian_phone'] = $params['guardian_phone'];

            $response = $this->paypal_payment->payment($data,"student");
            if ($response->isSuccessful()) {
                
            } elseif ($response->isRedirect()) {
                $response->redirect();
            } else {
                echo $response->getMessage();
            }
        }
    }

    //paypal successpayment
    public function getsuccesspayment() {
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
        $response = $this->paypal_payment->success($data,"student");

        $paypalResponse = $response->getData();
        if ($response->isSuccessful()) {
            $purchaseId = $_GET['PayerID'];

            if (isset($paypalResponse['PAYMENTINFO_0_ACK']) && $paypalResponse['PAYMENTINFO_0_ACK'] === 'Success') {
                if ($purchaseId) {
                    $params = $this->session->userdata('params');
                    $ref_id = $paypalResponse['PAYMENTINFO_0_TRANSACTIONID'];
                    $json_array = array(
                        'amount' => $params['total'],
                        'date' => date('Y-m-d'),
                        'amount_discount' => 0,
                        'amount_fine' => 0,
                        'description' => "Online fees deposit through Paypal Ref ID: " . $ref_id,
                        'received_by' => '',
                        'payment_mode' => 'Paypal',
                    );
                    
                    $data = array(
                        'student_fees_master_id' => $params['student_fees_master_id'],
                        'fee_groups_feetype_id' => $params['fee_groups_feetype_id'],
                        'amount_detail' => $json_array
                    );
                    $send_to = $params['guardian_phone'];
                    $inserted_id = $this->studentfeemaster_model->fee_deposit($data, $send_to);
                    $invoice_detail = json_decode($inserted_id);
                    redirect(base_url("students/payment/successinvoice/" . $invoice_detail->invoice_id . "/" . $invoice_detail->sub_invoice_id));
                }
            }
        } elseif ($response->isRedirect()) {
            $response->redirect();
        } else {
            redirect(base_url("students/payment/paymentfailed"));
        }
    }

}

?>