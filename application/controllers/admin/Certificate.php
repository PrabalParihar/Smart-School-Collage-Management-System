<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Certificate extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library('Customlib');
        $this->load->model('certificate_model');
    }

    public function index() {
        if (!$this->rbac->hasPrivilege('student_certificate', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Certificate');
        $this->session->set_userdata('sub_menu', 'admin/certificate');
       
        $custom_fields=$this->customfield_model->get_custom_fields('students'); 
       $this->data['custom_fields'] =$custom_fields;
        $this->data['certificateList'] = $this->certificate_model->certificateList();
        $this->load->view('layout/header');
        $this->load->view('admin/certificate/createcertificate', $this->data);
        $this->load->view('layout/footer');
    }

    public function create() {
        if (!$this->rbac->hasPrivilege('student_certificate', 'can_add')) {
            access_denied();
        }
        
        $data['title'] = 'Add Library';

        if (!empty($_FILES['background_image']['name'])) {
            $config['upload_path'] = 'uploads/certificate/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['background_image']['name'];

            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('background_image')) {
                $uploadData = $this->upload->data();
                $picture = $uploadData['file_name'];
            } else {
                $picture = '';
            }
        } else {
            $picture = '';
        }

        $this->form_validation->set_rules('certificate_name', $this->lang->line('certificate_name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('certificate_text', $this->lang->line('certificate_text'), 'trim|required|xss_clean');
        
        if ($this->form_validation->run() == FALSE) {
           
            $this->data['certificateList'] = $this->certificate_model->certificateList();
            $this->load->view('layout/header');
            $this->load->view('admin/certificate/createcertificate', $this->data);
            $this->load->view('layout/footer');
        } else {
            if ($this->input->post('is_active_student_img') == 1) {
                $enableimg = $this->input->post('is_active_student_img');
                $imgHeight = $this->input->post('image_height');
            } else {
                $enableimg = 0;
                $imgHeight = 0;
            }
            $data = array(
                'certificate_name' => $this->input->post('certificate_name'),
                'certificate_text' => $this->input->post('certificate_text'),
                'left_header' => $this->input->post('left_header'),
                'center_header' => $this->input->post('center_header'),
                'right_header' => $this->input->post('right_header'),
                'left_footer' => $this->input->post('left_footer'),
                'right_footer' => $this->input->post('right_footer'),
                'center_footer' => $this->input->post('center_footer'),
                'created_for' => 2,
                'status' => 1,
                'background_image' => $picture,
                'header_height' => $this->input->post('header_height'),
                'content_height' => $this->input->post('content_height'),
                'footer_height' => $this->input->post('footer_height'),
                'content_width' => $this->input->post('content_width'),
                'enable_student_image' => $enableimg,
                'enable_image_height' => $imgHeight,
            );
            $this->certificate_model->addcertificate($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">'.$this->lang->line('success_message').'</div>');
            redirect('admin/certificate/index');
        }
    }

    function edit($id) {

        if (!$this->rbac->hasPrivilege('student_certificate', 'can_edit')) {
            access_denied();
        }
        $data['title'] = 'Add Hostel';
        $data['id'] = $id;
        $editcertificate = $this->certificate_model->get($id);
        $this->data['editcertificate'] = $editcertificate;
         
        $custom_fields=$this->customfield_model->get_custom_fields('students'); 
       $this->data['custom_fields'] =$custom_fields;
        $this->form_validation->set_rules('certificate_name', $this->lang->line('certificate_name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('certificate_text', $this->lang->line('certificate_text'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->data['certificateList'] = $this->certificate_model->certificateList();
            $this->load->view('layout/header');
            $this->load->view('admin/certificate/studentcertificateedit', $this->data);
            $this->load->view('layout/footer');
        } else {

            if ($this->input->post('is_active_student_img') == 1) {
                $enableimg = $this->input->post('is_active_student_img');
                $imgHeight = $this->input->post('image_height');
            } else {
                $enableimg = 0;
                $imgHeight = 0;
            }
            if (!empty($_FILES['background_image']['name'])) {
              
                $config['upload_path'] = 'uploads/certificate/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['background_image']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('background_image')) {
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                    $data = array(
                        'id' => $this->input->post('id'),
                        'certificate_name' => $this->input->post('certificate_name'),
                        'certificate_text' => $this->input->post('certificate_text'),
                        'left_header' => $this->input->post('left_header'),
                        'center_header' => $this->input->post('center_header'),
                        'right_header' => $this->input->post('right_header'),
                        'left_footer' => $this->input->post('left_footer'),
                        'right_footer' => $this->input->post('right_footer'),
                        'center_footer' => $this->input->post('center_footer'),
                        'created_for' => 2,
                        'status' => 1,
                        'background_image' => $picture,
                        'header_height' => $this->input->post('header_height'),
                        'content_height' => $this->input->post('content_height'),
                        'footer_height' => $this->input->post('footer_height'),
                        'content_width' => $this->input->post('content_width'),
                        'enable_student_image' => $enableimg,
                        'enable_image_height' => $imgHeight,
                    );
                } else {
                    $picture = '';
                    $data = array(
                        'id' => $this->input->post('id'),
                        'certificate_name' => $this->input->post('certificate_name'),
                        'certificate_text' => $this->input->post('certificate_text'),
                        'left_header' => $this->input->post('left_header'),
                        'center_header' => $this->input->post('center_header'),
                        'right_header' => $this->input->post('right_header'),
                        'left_footer' => $this->input->post('left_footer'),
                        'right_footer' => $this->input->post('right_footer'),
                        'center_footer' => $this->input->post('center_footer'),
                        'header_height' => $this->input->post('header_height'),
                        'content_height' => $this->input->post('content_height'),
                        'footer_height' => $this->input->post('footer_height'),
                        'content_width' => $this->input->post('content_width'),
                        'enable_student_image' => $enableimg,
                        'enable_image_height' => $imgHeight,
                    );
                }
            } else {
                $data = array(
                    'id' => $this->input->post('id'),
                    'certificate_name' => $this->input->post('certificate_name'),
                    'certificate_text' => $this->input->post('certificate_text'),
                    'left_header' => $this->input->post('left_header'),
                    'center_header' => $this->input->post('center_header'),
                    'right_header' => $this->input->post('right_header'),
                    'left_footer' => $this->input->post('left_footer'),
                    'right_footer' => $this->input->post('right_footer'),
                    'center_footer' => $this->input->post('center_footer'),
                    'header_height' => $this->input->post('header_height'),
                    'content_height' => $this->input->post('content_height'),
                    'footer_height' => $this->input->post('footer_height'),
                    'content_width' => $this->input->post('content_width'),
                    'enable_student_image' => $enableimg,
                    'enable_image_height' => $imgHeight,
                );
            }
            $this->certificate_model->addcertificate($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">'.$this->lang->line('update_message').'</div>');
			redirect('admin/certificate/index');
            // redirect('admin/certificate/edit/' . $this->input->post('id'));
        }
    }

    function delete($id) {
        if (!$this->rbac->hasPrivilege('student_certificate', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Certificate List';
        $this->certificate_model->remove($id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">'.$this->lang->line('delete_message').'</div>');
        redirect('admin/certificate/index');
    }

    public function view() {
        $id = $this->input->post('certificateid');
        $output = '';
        $data = array();

        $data['certificate'] = $this->certificate_model->certifiatebyid($id);
        $preview = $this->load->view('admin/certificate/preview_certificate', $data, true);
        echo $preview;
    }

    public function view1() {
        
        $id = $this->input->post('certificateid');
        $output = '';
        $certificate = $this->certificate_model->certifiatebyid($id);
        ?>
        <style type="text/css">
            body{ font-family: 'arial';}
            .tc-container{width: 100%;position: relative; text-align: center;}
            .tc-container tr td{vertical-align: bottom;}
        </style>
        <div class="tc-container">
            <img src="<?php echo base_url('uploads/certificate/') ?><?php echo $certificate->background_image; ?>" width="100%" height="100%" />
            <table width="100%" cellspacing="0" cellpadding="0">
                <tr style="position:absolute; margin-left: auto;margin-right: auto;left: 0;right: 0;  width:<?php echo $certificate->content_width; ?>px; top:<?php echo $certificate->enable_image_height; ?>px">
                    <td  valign="top" style="position: absolute;right: 0;">
                        <?php if ($certificate->enable_student_image == 1) { ?>
                            <img src="<?php echo base_url('uploads/certificate/noimage.jpg') ?>" width="100" height="auto">
                        <?php } ?>
                    </td>
                </tr>
                <tr style="position:absolute; margin-left: auto;margin-right: auto;left: 0;right: 0;  width:<?php echo $certificate->content_width; ?>px; top:<?php echo $certificate->header_height; ?>px">
                    <td valign="top" style="width:<?php echo $certificate->content_width; ?>px;font-size: 18px; text-align:left;position:relative;"><?php echo $certificate->left_header; ?></td>
                    <td valign="top" style="width:<?php echo $certificate->content_width; ?>px;font-size: 18px; text-align:center; position:relative; "><?php echo $certificate->center_header; ?></td>
                    <td valign="top" style="width:<?php echo $certificate->content_width; ?>px;font-size: 18px; text-align:right;position:relative;"><?php echo $certificate->right_header; ?></td>
                </tr>
                <tr style="position:absolute;margin-left: auto;margin-right: auto;left: 0;right: 0; width:<?php echo $certificate->content_width; ?>px; display: block; top:<?php echo $certificate->content_height; ?>px;">
                    <td colspan="3" valign="top" align="center"><p style="font-size: 16px;position: relative;text-align:center; margin:0 auto; width: 100%; left:auto; right:0;"><?php echo $certificate->certificate_text; ?></p>
                    </td>
                </tr>
                <tr style="position:absolute; margin-left: auto;margin-right: auto;left: 0;right: 0;  width:<?php echo $certificate->content_width; ?>px; top:<?php echo $certificate->footer_height; ?>px">
                    <td valign="top" style="width:<?php echo $certificate->content_width; ?>px; font-size:18px;text-align:left;"><?php echo $certificate->left_footer; ?></td>
                    <td valign="top" style="width:<?php echo $certificate->content_width; ?>px; font-size:18px;text-align:center;"><?php echo $certificate->center_footer; ?></td>
                    <td valign="top" style="width:<?php echo $certificate->content_width; ?>px;font-size:18px;text-align:right;"><?php echo $certificate->right_footer; ?></td>
                </tr>
            </table>
        </div>
        <?php
    }

}
?>