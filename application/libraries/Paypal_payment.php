<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use Omnipay\Omnipay;

require_once(APPPATH . 'third_party/omnipay/vendor/autoload.php');

class Paypal_payment {

    private $_CI;
    public $api_config;
    public $currency;

    function __construct() {
        $this->_CI = & get_instance();
        $this->api_config = $this->_CI->paymentsetting_model->getActiveMethod();
        $this->currency = $this->_CI->setting_model->getCurrency();
    }

    public function payment($data,$pay_mode="parent") {

        $fee_groups_feetype_id = $data['fee_groups_feetype_id'];
        $student_fees_master_id = $data['student_fees_master_id'];
        $name = $data['name'];
        $amount_balance = $data['total'];
        $currency = $data['currency_name'];
        $payment_details = $this->_CI->feegrouptype_model->getFeeGroupByID($fee_groups_feetype_id);
        $gateway = Omnipay::create('PayPal_Express');
        $gateway->setUsername($this->api_config->api_username);
        $gateway->setPassword($this->api_config->api_password);
        $gateway->setSignature($this->api_config->api_signature);
        $gateway->setTestMode(FALSE);

        $params = array(
            
            'student_fees_master_id' => $student_fees_master_id,
            'fee_groups_feetype_id' => $fee_groups_feetype_id,
            'guardian_phone' => $data['guardian_phone'],
            'name' => $name,
            'description' => $payment_details->type . " - " . $payment_details->code,
            'amount' => number_format($amount_balance, 2, '.', ''),
            'currency' => $currency,
        );
        if($pay_mode == "parent"){
             $params['cancelUrl'] = base_url('parent/paypal/getsuccesspayment');
             $params['returnUrl'] = base_url('parent/paypal/getsuccesspayment');
        }else{
             $params['cancelUrl'] = base_url('students/paypal/getsuccesspayment');
             $params['returnUrl'] = base_url('students/paypal/getsuccesspayment');
        }
        $response = $gateway->purchase($params)->send();
        return $response;
    }

    public function success($data,$pay_mode="parent") {

        $fee_groups_feetype_id = $data['fee_groups_feetype_id'];
        $student_fees_master_id = $data['student_fees_master_id'];
        $name = $data['name'];
        $amount_balance = $data['total'];
        $currency = $data['currency_name'];
        $payment_details = $this->_CI->feegrouptype_model->getFeeGroupByID($fee_groups_feetype_id);

        $gateway = Omnipay::create('PayPal_Express');
        $gateway->setUsername($this->api_config->api_username);
        $gateway->setPassword($this->api_config->api_password);
        $gateway->setSignature($this->api_config->api_signature);
        $gateway->setTestMode(FALSE);


        $params = array(
            'student_fees_master_id' => $student_fees_master_id,
            'fee_groups_feetype_id' => $fee_groups_feetype_id,
            'guardian_phone' => $data['guardian_phone'],
            'name' => $name,
            'description' => $payment_details->type . " - " . $payment_details->code,
            'amount' => number_format($amount_balance, 2, '.', ''),
            'currency' => $currency,
        );
        if($pay_mode == "parent"){
             $params['cancelUrl'] = base_url('parent/paypal/getsuccesspayment');
             $params['returnUrl'] = base_url('parent/paypal/getsuccesspayment');
        }else{
             $params['cancelUrl'] = base_url('students/paypal/getsuccesspayment');
             $params['returnUrl'] = base_url('students/paypal/getsuccesspayment');
        }
        $response = $gateway->completePurchase($params)->send();

        return $response;
    }

}

?>