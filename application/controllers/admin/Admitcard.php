<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Admitcard extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        if (!$this->rbac->hasPrivilege('design_admit_card', 'can_view')) {
            access_denied();
        }

        $data['title'] = 'Add Library';
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'Examinations/admitcard');
        $this->data['admitcardList'] = $this->admitcard_model->get();

        $this->form_validation->set_rules('template', $this->lang->line('template'), 'trim|required|xss_clean');

        $this->form_validation->set_rules('left_logo', $this->lang->line('left') . " " . $this->lang->line('logo'), 'callback_handle_upload[left_logo]');
        $this->form_validation->set_rules('right_logo', $this->lang->line('right') . " " . $this->lang->line('logo'), 'callback_handle_upload[right_logo]');
        $this->form_validation->set_rules('background_img', $this->lang->line('background') . " " . $this->lang->line('image'), 'callback_handle_upload[background_img]');
        $this->form_validation->set_rules('sign', $this->lang->line('sign'), 'callback_handle_upload[sign]');

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

            if (isset($_POST['is_dob'])) {
                $is_dob = 1;
            } else {
                $is_dob = 0;
            }

            if (isset($_POST['is_admission_no'])) {
                $is_admission_no = 1;
            } else {
                $is_admission_no = 0;
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
                'is_name'         => $is_name,
                'is_father_name'  => $is_father_name,
                'is_mother_name'  => $is_mother_name,
                'is_dob'          => $is_dob,
                'is_admission_no' => $is_admission_no,
                'is_roll_no'      => $is_roll_no,
                'is_address'      => $is_address,
                'is_gender'       => $is_gender,
                'is_photo'        => $is_photo,
                'is_class'        => $is_class,
                'is_section'      => $is_section,
                'content_footer'  => nl2br($this->input->post('content_footer')),
                'left_logo'       => "",
                'right_logo'      => "",
                'sign'            => "",
                'background_img'  => "",
            );

            if (isset($_FILES["left_logo"]) && !empty($_FILES["left_logo"]['name'])) {
                $time     = md5($_FILES["left_logo"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["left_logo"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["left_logo"]["tmp_name"], "./uploads/admit_card/" . $img_name);
                $insert_data['left_logo'] = $img_name;

            }
            if (isset($_FILES["right_logo"]) && !empty($_FILES["right_logo"]['name'])) {
                $time     = md5($_FILES["right_logo"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["right_logo"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["right_logo"]["tmp_name"], "./uploads/admit_card/" . $img_name);
                $insert_data['right_logo'] = $img_name;

            }
            if (isset($_FILES["sign"]) && !empty($_FILES["sign"]['name'])) {
                $time     = md5($_FILES["sign"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["sign"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["sign"]["tmp_name"], "./uploads/admit_card/" . $img_name);
                $insert_data['sign'] = $img_name;

            }
            if (isset($_FILES["background_img"]) && !empty($_FILES["background_img"]['name'])) {
                $time     = md5($_FILES["background_img"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["background_img"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["background_img"]["tmp_name"], "./uploads/admit_card/" . $img_name);
                $insert_data['background_img'] = $img_name;

            }

            $this->admitcard_model->add($insert_data);

            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/admitcard/index');
        }

        $this->load->view('layout/header');
        $this->load->view('admin/admitcard/createadmitcard', $this->data);
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
        //print_r($_POST);die;
        if (!$this->rbac->hasPrivilege('design_admit_card', 'can_view')) {
            access_denied();
        }
        $data['title'] = 'Add Library';
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'Examinations/admitcard');
        $this->data['admitcardList'] = $this->admitcard_model->get();
        $this->data['admitcard']     = $this->admitcard_model->get($id);

        $this->form_validation->set_rules('template', $this->lang->line('template'), 'trim|required|xss_clean');

        $this->form_validation->set_rules('left_logo', $this->lang->line('left') . " " . $this->lang->line('logo'), 'callback_handle_upload[left_logo]');
        $this->form_validation->set_rules('right_logo', $this->lang->line('right') . " " . $this->lang->line('logo'), 'callback_handle_upload[right_logo]');
        $this->form_validation->set_rules('background_img', $this->lang->line('background') . " " . $this->lang->line('image'), 'callback_handle_upload[background_img]');
        $this->form_validation->set_rules('sign', $this->lang->line('sign'), 'callback_handle_upload[sign]');

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

            if (isset($_POST['is_dob'])) {
                $is_dob = 1;
            } else {
                $is_dob = 0;
            }

            if (isset($_POST['is_admission_no'])) {
                $is_admission_no = 1;
            } else {
                $is_admission_no = 0;
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
                'is_name'         => $is_name,
                'is_father_name'  => $is_father_name,
                'is_mother_name'  => $is_mother_name,
                'is_dob'          => $is_dob,
                'is_admission_no' => $is_admission_no,
                'is_roll_no'      => $is_roll_no,
                'is_address'      => $is_address,
                'is_gender'       => $is_gender,
                'is_photo'        => $is_photo,
                'is_class'        => $is_class,
                'is_section'      => $is_section,
                'content_footer'  => htmlentities($this->input->post('content_footer'))
            );
           

            if (isset($_FILES["left_logo"]) && !empty($_FILES["left_logo"]['name']) && $_FILES['left_logo']['error'] == 0) {

                $time     = md5($_FILES["left_logo"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["left_logo"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["left_logo"]["tmp_name"], "./uploads/admit_card/" . $img_name);
                $insert_data['left_logo'] = $img_name;

            }
            if (isset($_FILES["right_logo"]) && !empty($_FILES["right_logo"]['name']) && $_FILES['right_logo']['error'] == 0) {

                $time     = md5($_FILES["right_logo"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["right_logo"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["right_logo"]["tmp_name"], "./uploads/admit_card/" . $img_name);
                $insert_data['right_logo'] = $img_name;

            }
            if (isset($_FILES["sign"]) && !empty($_FILES["sign"]['name']) && $_FILES['sign']['error'] == 0) {

                $time     = md5($_FILES["sign"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["sign"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["sign"]["tmp_name"], "./uploads/admit_card/" . $img_name);
                $insert_data['sign'] = $img_name;

            }
            if (isset($_FILES["background_img"]) && !empty($_FILES["background_img"]['name']) && $_FILES['background_img']['error'] == 0) {

                $time     = md5($_FILES["background_img"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["background_img"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["background_img"]["tmp_name"], "./uploads/admit_card/" . $img_name);
                $insert_data['background_img'] = $img_name;

            }

            $this->admitcard_model->add($insert_data);

            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/admitcard/index');
        }

        $this->load->view('layout/header');
        $this->load->view('admin/admitcard/editadmitcard', $this->data);
        $this->load->view('layout/footer');
    }

    public function delete($id)
    {

        if (!$this->rbac->hasPrivilege('design_admit_card', 'can_delete')) {
            access_denied();
        }

        $data['title'] = 'Certificate List';
        $this->admitcard_model->remove($id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('delete_message') . '</div>');
        redirect('admin/admitcard/index');
    }

    public function view()
    {
        $id                = $this->input->post('certificateid');
        $output            = '';
        $data              = array();
        $data['admitcard'] = $this->admitcard_model->get($id);

        $page = $this->load->view('admin/admitcard/_view', $data, true);

        echo json_encode(array('status' => 1, 'page' => $page));
    }

}
