<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ccavenue extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->setting = $this->setting_model->get();
    }

    public function index() {
        $this->session->set_userdata('top_menu', 'Library');
        $this->session->set_userdata('sub_menu', 'book/index');
        $data = $this->session->userdata('params');
        $data['setting'] = $this->setting;

        $this->load->view('student/ccavenue', $data);
    }

    public function pay() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $session_data = $this->session->userdata('params');
            $pay_method = $this->paymentsetting_model->getActiveMethod();
            $data = array(
                'merchant_id' => $pay_method->api_secret_key,
                'working_key' => $pay_method->salt,
                'amount' => $session_data['payment_detail']->amount,
                'order_id' => abs(crc32(uniqid())),
                'url' => base_url('parent/ccavenue/success'),
                'billing_cust_name' => "",
                'billing_cust_address' => "",
                'billing_cust_country' => "",
                'billing_cust_state' => "",
                'billing_city' => "",
                'billing_zip' => "",
                'billing_cust_tel' => "",
                'billing_cust_email' => "",
                'delivery_cust_name' => "",
                'delivery_cust_address' => "",
                'delivery_cust_country' => "",
                'delivery_cust_state' => "",
                'delivery_city' => "",
                'delivery_zip' => "",
                'delivery_cust_tel' => "",
                'delivery_cust_notes' => "",
            );

            $this->load->view('student/ccavenue_pay', $data);
        } else {
            redirect(site_url('user/user/dashboard'));
        }
    }

    public function success() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $AuthDesc = "";
            $MerchantId = "";
            $OrderId = "";
            $Amount = 0;
            $Checksum = 0;
            $veriChecksum = false;
            $pay_method = $this->paymentsetting_model->getActiveMethod();

            $Checksum = $this->input->post('Checksum');
            $MerchantId = $this->input->post('Merchant_Id');
            $OrderId = $this->input->post('Order_Id');
            $Amount = $this->input->post('Amount');
            $AuthDesc = $this->input->post('AuthDesc');
            $workingKey = $pay_method->salt;
            $rcvdString = $MerchantId . '|' . $OrderId . '|' . $Amount . '|' . $AuthDesc . '|' . $workingKey;
            $veriChecksum = $this->adler32->verifyChecksum($this->adler32->genchecksum($rcvdString), $Checksum);


            if ($veriChecksum == TRUE && $AuthDesc === "Y") {
                $nb_order_no = $this->input->post('nb_order_no');
                $params = $this->session->userdata('params');
                $json_array = array(
                    'amount' => $Amount,
                    'date' => date('Y-m-d'),
                    'amount_discount' => 0,
                    'amount_fine' => 0,
                    'description' => "Online fees deposit through CCAvenue. TXN ID: " . $OrderId . ", CCAvenue Ref ID: " . $nb_order_no,
                    'received_by' => '',
                    'payment_mode' => 'CCAvenue',
                );
                $data = array(
                    'student_fees_master_id' => $params['student_fees_master_id'],
                    'fee_groups_feetype_id' => $params['fee_groups_feetype_id'],
                    'amount_detail' => $json_array
                );
                $send_to = $params['guardian_phone'];
                $inserted_id = $this->studentfeemaster_model->fee_deposit($data, $send_to);

                if ($inserted_id) {
                    $invoice_detail = json_decode($inserted_id);
                    redirect(base_url("students/payment/successinvoice/" . $invoice_detail->invoice_id . "/" . $invoice_detail->sub_invoice_id));
                } else {
                    
                }
            } else if ($veriChecksum == TRUE && $AuthDesc === "B") {

                $this->session->set_flashdata('message', 'Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail');
                redirect(site_url('parent/payment/paymentfailed'));
            } else if ($veriChecksum == TRUE && $AuthDesc === "N") {
                $this->session->set_flashdata('message', 'Thank you for shopping with us.However,the transaction has been declined');
                redirect(site_url('students/payment/paymentfailed'));
            } else {
                $this->session->set_flashdata('message', 'Security Error. Illegal access detected');

                redirect(site_url('students/payment/paymentfailed'));
            }
        }
    }

}
