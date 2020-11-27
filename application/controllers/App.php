<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class App extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('setting_model');
        
    }

    public function index()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $setting_result = $this->setting_model->getSetting();

            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'url' => $setting_result->mobile_api_url,
                    'site_url' => site_url(),
                    'app_logo' => $setting_result->app_logo,
                    'app_primary_color_code' => $setting_result->app_primary_color_code,
                    'app_secondary_color_code' => $setting_result->app_secondary_color_code,
                    'lang_code' => $setting_result->language_code,
                )));
        } else {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(405)
                ->set_output(json_encode(array(
                    'error' => "Method Not Allowed",
                )));
        }

    }

}
