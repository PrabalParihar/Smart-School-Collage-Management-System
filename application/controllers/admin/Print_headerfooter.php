<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Print_headerfooter extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index(){
    	$this->session->set_userdata('top_menu', 'System Settings');
        $this->session->set_userdata('sub_menu', 'admin/print_headerfooter');
        $data['title'] = 'SMS Config List';
        $data['result']=$this->setting_model->get_printheader();
        $this->load->view('layout/header', $data);
        $this->load->view('admin/print_headerfooter/print_headerfooter', $data);
        $this->load->view('layout/footer', $data);
        
    }
    
public function edit(){
    $message="";
        if(isset($_POST['type'])){
            $is_required=$this->setting_model->check_haederimage($_POST['type']);
            $this->form_validation->set_rules('header_image', $this->lang->line('header')." ".$this->lang->line('image'), 'trim|xss_clean|callback_handle_upload['.$is_required.']');
            if($_POST['type']=='staff_payslip'){
                $this->form_validation->set_rules('message', $this->lang->line('message'), 'required|trim|xss_clean');
                $message='message';
            }else{
                $this->form_validation->set_rules('message1', $this->lang->line('message'), 'required|trim|xss_clean');
                $message='message1';
            }
        }
        

        
         
         

        if ($this->form_validation->run() == FALSE) {

        }else{
          
            if (isset($_FILES["header_image"]) && !empty($_FILES['header_image']['name'])) {
                $fileInfo = pathinfo($_FILES["header_image"]["name"]);
                $img_name = 'header_image.' . $fileInfo['extension'];
//print_r($_POST);
                if($_POST['type']=='student_receipt'){
                    
                    $path=$this->setting_model->unlink_receiptheader();
                   
                    $path1="uploads/print_headerfooter/student_receipt/".$path;
                     $url = FCPATH .$path1;
                
                if (file_exists($url)) {   
              unlink($url);    
  
                        }
            move_uploaded_file($_FILES["header_image"]["tmp_name"], "./uploads/print_headerfooter/student_receipt/" . $img_name);
                   
                    
                }else{
                   $path=$this->setting_model->unlink_payslipheader();
                   
                    $path1="uploads/print_headerfooter/staff_payslip/".$path;
                     $url = FCPATH .$path1;
                
                if (file_exists($url)) {   
              unlink($url);    
  
                        }
                    move_uploaded_file($_FILES["header_image"]["tmp_name"], "./uploads/print_headerfooter/staff_payslip/" . $img_name);
                }
              
           $data=array('print_type'=>$_POST['type'],'header_image'=>$img_name,'footer_content'=>$_POST[$message],'created_by'=>$this->customlib->getStaffID());
           $this->setting_model->add_printheader($data);
            }

           $data=array('print_type'=>$_POST['type'],'footer_content'=>$_POST[$message],'created_by'=>$this->customlib->getStaffID());
            $this->setting_model->add_printheader($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">'.$this->lang->line('success_message').'</div>');

        }
        redirect('admin/print_headerfooter');
}


public function handle_upload($str,$is_required)
    {
  //  print_r($_FILES);die;
        $image_validate = $this->config->item('image_validate');

        if (isset($_FILES["header_image"]) && !empty($_FILES['header_image']['name']) && $_FILES["header_image"]["size"] > 0) {

            $file_type         = $_FILES["header_image"]['type'];
            $file_size         = $_FILES["header_image"]["size"];
            $file_name         = $_FILES["header_image"]["name"];
            $allowed_extension = $image_validate['allowed_extension'];
            $ext               = pathinfo($file_name, PATHINFO_EXTENSION);

            $allowed_mime_type = $image_validate['allowed_mime_type'];

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mtype = finfo_file($finfo, $_FILES['header_image']['tmp_name']);
            finfo_close($finfo);

            if (!in_array($mtype, $allowed_mime_type)) {
                $this->form_validation->set_message('handle_upload', 'File Type Not Allowed');
                return false;
            }

            if (!in_array($ext, $allowed_extension) || !in_array($file_type, $allowed_mime_type)) {
                $this->form_validation->set_message('handle_upload', 'Extension Not Allowed');
                return false;
            }

            if ($file_size > $image_validate['upload_size']) {
                $this->form_validation->set_message('handle_upload', $this->lang->line('file_size_shoud_be_less_than') . number_format($image_validate['upload_size'] / 1048576, 2) . " MB");
                return false;
            }

            return true;
        } else {
          if($is_required==0){
             $this->form_validation->set_message('handle_upload', 'Please choose a file to upload.');
            return false;
          }else{
             return true;
          }
           
        }
       

    }
}