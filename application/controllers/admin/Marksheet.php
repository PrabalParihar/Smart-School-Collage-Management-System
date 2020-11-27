<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Marksheet extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        if (!$this->rbac->hasPrivilege('design_marksheet', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'Examinations/marksheet');
        $data['title'] = 'Add Library';

        $this->data['certificateList'] = $this->marksheet_model->get();

        $this->form_validation->set_rules('template', $this->lang->line('template'), 'trim|required|xss_clean');
        
        $this->form_validation->set_rules('left_logo', $this->lang->line('left') . " " . $this->lang->line('logo'), 'callback_handle_upload[left_logo]');
        $this->form_validation->set_rules('right_logo', $this->lang->line('right') . " " . $this->lang->line('logo'), 'callback_handle_upload[right_logo]');
        $this->form_validation->set_rules('background_img', $this->lang->line('background') . " " . $this->lang->line('image'), 'callback_handle_upload[background_img]');
        $this->form_validation->set_rules('left_sign', $this->lang->line('sign'), 'callback_handle_upload[sign]');
        $this->form_validation->set_rules('middle_sign', $this->lang->line('sign'), 'callback_handle_upload[sign]');
        $this->form_validation->set_rules('right_sign', $this->lang->line('sign'), 'callback_handle_upload[sign]');

        if ($this->form_validation->run() == true) {

            if (isset($_POST['is_name'])) {
                $is_name = 1;
            } else {
                $is_name = 0;
            }
            if (isset($_POST['is_father_name'])) {
                $is_father_name = 1;
            } else {
                $is_father_name = 0;
            }
            if (isset($_POST['is_mother_name'])) {
                $is_mother_name = 1;
            } else {
                $is_mother_name = 0;
            }

            if (isset($_POST['is_admission_no'])) {
                $is_admission_no = 1;
            } else {
                $is_admission_no = 0;
            }
            if (isset($_POST['exam_session'])) {
                $exam_session = 1;
            } else {
                $exam_session = 0;
            }
            if (isset($_POST['is_roll_no'])) {
                $is_roll_no = 1;
            } else {
                $is_roll_no = 0;
            }
            if (isset($_POST['is_address'])) {
                $is_address = 1;
            } else {
                $is_address = 0;
            }
            if (isset($_POST['is_gender'])) {
                $is_gender = 1;
            } else {
                $is_gender = 0;
            }

            if (isset($_POST['is_photo'])) {
                $is_photo = 1;
            } else {
                $is_photo = 0;
            }
            if (isset($_POST['is_division'])) {
                $is_division = 1;
            } else {
                $is_division = 0;
            }

            if (isset($_POST['is_class'])) {
                $is_class = 1;
            } else {
                $is_class = 0;
            }

            if (isset($_POST['is_section'])) {
                $is_section = 1;
            } else {
                $is_section = 0;
            }

            $insert_data = array(
                'template'        => $this->input->post('template'),
                'heading'         => $this->input->post('heading'),
                'title'           => $this->input->post('title'),
                'exam_name'       => $this->input->post('exam_name'),
                'school_name'     => $this->input->post('school_name'),
                'exam_center'     => $this->input->post('exam_center'),
                'date'            => $this->input->post('date'),
                'is_name'         => $is_name,
                'is_father_name'  => $is_father_name,
                'is_mother_name'  => $is_mother_name,
                'is_admission_no' => $is_admission_no,
                'is_roll_no'      => $is_roll_no,
                'is_photo'        => $is_photo,
                'is_class'        => $is_class,
                'is_section'      => $is_section,
                'is_division'     => $is_division,
                'content'         => $this->input->post('content'),
                'content_footer'  => $this->input->post('content_footer'),

                'exam_session'    => $exam_session,
                'left_logo'       => "",
                'right_logo'      => "",
                'left_sign'       => "",
                'right_sign'      => "",
                'middle_sign'     => "",
                'background_img'  => "",
            );

            if (isset($_FILES["left_logo"]) && !empty($_FILES["left_logo"]['name'])) {
                $time     = md5($_FILES["left_logo"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["left_logo"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["left_logo"]["tmp_name"], "./uploads/marksheet/" . $img_name);
                $insert_data['left_logo'] = $img_name;

            }
            if (isset($_FILES["right_logo"]) && !empty($_FILES["right_logo"]['name'])) {
                $time     = md5($_FILES["right_logo"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["right_logo"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["right_logo"]["tmp_name"], "./uploads/marksheet/" . $img_name);
                $insert_data['right_logo'] = $img_name;

            }
            if (isset($_FILES["left_sign"]) && !empty($_FILES["left_sign"]['name'])) {
                $time     = md5($_FILES["left_sign"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["left_sign"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["left_sign"]["tmp_name"], "./uploads/marksheet/" . $img_name);
                $insert_data['left_sign'] = $img_name;

            }if (isset($_FILES["middle_sign"]) && !empty($_FILES["middle_sign"]['name'])) {
                $time     = md5($_FILES["middle_sign"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["middle_sign"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["middle_sign"]["tmp_name"], "./uploads/marksheet/" . $img_name);
                $insert_data['middle_sign'] = $img_name;

            }if (isset($_FILES["right_sign"]) && !empty($_FILES["right_sign"]['name'])) {
                $time     = md5($_FILES["right_sign"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["right_sign"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["right_sign"]["tmp_name"], "./uploads/marksheet/" . $img_name);
                $insert_data['right_sign'] = $img_name;

            }
            if (isset($_FILES["background_img"]) && !empty($_FILES["background_img"]['name'])) {
                $time     = md5($_FILES["background_img"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["background_img"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["background_img"]["tmp_name"], "./uploads/marksheet/" . $img_name);
                $insert_data['background_img'] = $img_name;

            }

            $this->marksheet_model->add($insert_data);

            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/marksheet/index');
        }

        $this->load->view('layout/header');
        $this->load->view('admin/marksheet/createmarksheet', $this->data);
        $this->load->view('layout/footer');
    }

    public function handle_upload($str, $var)
    {

        $image_validate = $this->config->item('image_validate');

        if (isset($_FILES[$var]) && !empty($_FILES[$var]['name'])) {

            $file_type         = $_FILES[$var]['type'];
            $file_size         = $_FILES[$var]["size"];
            $file_name         = $_FILES[$var]["name"];
            $allowed_extension = $image_validate['allowed_extension'];
            $ext               = pathinfo($file_name, PATHINFO_EXTENSION);
            $allowed_mime_type = $image_validate['allowed_mime_type'];
            if ($files = @getimagesize($_FILES[$var]['tmp_name'])) {

                if (!in_array($files['mime'], $allowed_mime_type)) {
                    $this->form_validation->set_message('handle_upload', $this->lang->line('file_type_not_allowed'));
                    return false;
                }

                if (!in_array($ext, $allowed_extension) || !in_array($file_type, $allowed_mime_type)) {
                    $this->form_validation->set_message('handle_upload', $this->lang->line('extension_not_allowed'));
                    return false;
                }
                if ($file_size > $image_validate['upload_size']) {
                    $this->form_validation->set_message('handle_upload', $this->lang->line('file_size_shoud_be_less_than') . number_format($image_validate['upload_size'] / 1048576, 2) . " MB");
                    return false;
                }

            } else {
                $this->form_validation->set_message('handle_upload', $this->lang->line('file_type_not_allowed') . " " . $this->lang->line('or') . " " . $this->lang->line('extension_not_allowed'));
                return false;
            }

            return true;
        }
        return true;

    }

    public function edit($id)
    {
        if (!$this->rbac->hasPrivilege('design_marksheet', 'can_edit')) {
            access_denied();
        }

        $data['title'] = 'Add Library';
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'Examinations/marksheet');

        $this->data['certificateList'] = $this->marksheet_model->get();

        $marksheet = $this->marksheet_model->get($id);

        $this->data['marksheet'] = $marksheet;

        $this->form_validation->set_rules('template', 'template', 'trim|required|xss_clean');
      
        $this->form_validation->set_rules('left_logo', 'left_logo', 'callback_handle_upload[left_logo]');
        $this->form_validation->set_rules('right_logo', 'right_logo', 'callback_handle_upload[right_logo]');
        $this->form_validation->set_rules('background_img', 'background_img', 'callback_handle_upload[background_img]');
       $this->form_validation->set_rules('left_sign', $this->lang->line('sign'), 'callback_handle_upload[sign]');
        $this->form_validation->set_rules('middle_sign', $this->lang->line('sign'), 'callback_handle_upload[sign]');
        $this->form_validation->set_rules('right_sign', $this->lang->line('sign'), 'callback_handle_upload[sign]');

        if ($this->form_validation->run() == true) {

            if (isset($_POST['is_name'])) {
                $is_name = 1;
            } else {
                $is_name = 0;
            }
            if (isset($_POST['is_father_name'])) {
                $is_father_name = 1;
            } else {
                $is_father_name = 0;
            }
            if (isset($_POST['is_mother_name'])) {
                $is_mother_name = 1;
            } else {
                $is_mother_name = 0;
            }

            if (isset($_POST['is_admission_no'])) {
                $is_admission_no = 1;
            } else {
                $is_admission_no = 0;
            }
            if (isset($_POST['exam_session'])) {
                $exam_session = 1;
            } else {
                $exam_session = 0;
            }
            if (isset($_POST['is_roll_no'])) {
                $is_roll_no = 1;
            } else {
                $is_roll_no = 0;
            }
            if (isset($_POST['is_address'])) {
                $is_address = 1;
            } else {
                $is_address = 0;
            }
            if (isset($_POST['is_gender'])) {
                $is_gender = 1;
            } else {
                $is_gender = 0;
            }

            if (isset($_POST['is_photo'])) {
                $is_photo = 1;
            } else {
                $is_photo = 0;
            }

            if (isset($_POST['is_division'])) {
                $is_division = 1;
            } else {
                $is_division = 0;
            }

            if (isset($_POST['is_class'])) {
                $is_class = 1;
            } else {
                $is_class = 0;
            }

            if (isset($_POST['is_section'])) {
                $is_section = 1;
            } else {
                $is_section = 0;
            }

            $insert_data = array(
                'id'              => $this->input->post('id'),
                'template'        => $this->input->post('template'),
                'heading'         => $this->input->post('heading'),
                'title'           => $this->input->post('title'),
                'exam_name'       => $this->input->post('exam_name'),
                'school_name'     => $this->input->post('school_name'),
                'exam_center'     => $this->input->post('exam_center'),
                'content'         => $this->input->post('content'),
                'content_footer'  => $this->input->post('content_footer'),
                'date'            => $this->input->post('date'),
                'is_name'         => $is_name,
                'is_father_name'  => $is_father_name,
                'is_mother_name'  => $is_mother_name,
                'is_admission_no' => $is_admission_no,
                'is_roll_no'      => $is_roll_no,
                'is_photo'        => $is_photo,
                'is_class'        => $is_class,
                'is_section'      => $is_section,
                'is_division'     => $is_division,
                'exam_session'    => $exam_session,

            );

            if (isset($_FILES["left_logo"]) && !empty($_FILES["left_logo"]['name'])) {
                $time     = md5($_FILES["left_logo"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["left_logo"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["left_logo"]["tmp_name"], "./uploads/marksheet/" . $img_name);
                $insert_data['left_logo'] = $img_name;

            }
            if (isset($_FILES["right_logo"]) && !empty($_FILES["right_logo"]['name'])) {
                $time     = md5($_FILES["right_logo"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["right_logo"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["right_logo"]["tmp_name"], "./uploads/marksheet/" . $img_name);
                $insert_data['right_logo'] = $img_name;

            }
            if (isset($_FILES["left_sign"]) && !empty($_FILES["left_sign"]['name'])) {
                $time     = md5($_FILES["left_sign"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["left_sign"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["left_sign"]["tmp_name"], "./uploads/marksheet/" . $img_name);
                $insert_data['left_sign'] = $img_name;

            }if (isset($_FILES["middle_sign"]) && !empty($_FILES["middle_sign"]['name'])) {
                $time     = md5($_FILES["middle_sign"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["middle_sign"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["middle_sign"]["tmp_name"], "./uploads/marksheet/" . $img_name);
                $insert_data['middle_sign'] = $img_name;

            }if (isset($_FILES["right_sign"]) && !empty($_FILES["right_sign"]['name'])) {
                $time     = md5($_FILES["right_sign"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["right_sign"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["right_sign"]["tmp_name"], "./uploads/marksheet/" . $img_name);
                $insert_data['right_sign'] = $img_name;

            }
            if (isset($_FILES["background_img"]) && !empty($_FILES["background_img"]['name'])) {
                $time     = md5($_FILES["background_img"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["background_img"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["background_img"]["tmp_name"], "./uploads/marksheet/" . $img_name);
                $insert_data['background_img'] = $img_name;

            }

            $this->marksheet_model->add($insert_data);

            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('update_message') . '</div>');
            redirect('admin/marksheet/index');
        }

        $this->load->view('layout/header');
        $this->load->view('admin/marksheet/editmarksheet', $this->data);
        $this->load->view('layout/footer');
    }

    public function delete($id)
    {
        if (!$this->rbac->hasPrivilege('design_marksheet', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Certificate List';
        $this->marksheet_model->remove($id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('delete_message') . '</div>');
        redirect('admin/marksheet/index');
    }

    public function view()
    {
        $id     = $this->input->post('certificateid');
        $output = '';
        $data   = array();

        $data['marksheet'] = $this->marksheet_model->get($id);
        $page              = $this->load->view('admin/marksheet/_view', $data, true);
        echo json_encode(array('status' => 1, 'page' => $page));
    }

}
