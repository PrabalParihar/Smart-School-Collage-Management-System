<?php
class studentidcard extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library('Customlib');
    }

    public function index() {

        if (!$this->rbac->hasPrivilege('student_id_card', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Certificate');
        $this->session->set_userdata('sub_menu', 'admin/studentidcard');
        $this->data['idcardlist'] = $this->Student_id_card_model->idcardlist();
        $this->load->view('layout/header');
        $this->load->view('admin/certificate/createidcard', $this->data);
        $this->load->view('layout/footer');
    }

    public function create() {

        if (!$this->rbac->hasPrivilege('student_id_card', 'can_add')) {
            access_denied();
        }
        
        $data['title'] = 'Add Library';



        $this->form_validation->set_rules('school_name', $this->lang->line('school_name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('address', $this->lang->line('address_phone_email'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('title', $this->lang->line('id_card_title'), 'trim|required|xss_clean');
        
        if ($this->form_validation->run() == FALSE) {
            
            $this->data['idcardlist'] = $this->Student_id_card_model->idcardlist();
            $this->load->view('layout/header');
            $this->load->view('admin/certificate/createidcard', $this->data);
            $this->load->view('layout/footer');
        } else {
         
            $admission_no = 0;
            $studentname = 0;
            $class = 0;
            $fathername = 0;
            $mothername = 0;
            $address = 0;
            $phone = 0;
            $dob = 0;
            $bloodgroup = 0;

            if ($this->input->post('is_active_admission_no') == 1) {
                $admission_no = $this->input->post('is_active_admission_no');
            }
            if ($this->input->post('is_active_student_name') == 1) {
                $studentname = $this->input->post('is_active_student_name');
            }
            if ($this->input->post('is_active_class') == 1) {
                $class = $this->input->post('is_active_class');
            }
            if ($this->input->post('is_active_father_name') == 1) {
                $fathername = $this->input->post('is_active_father_name');
            }
            if ($this->input->post('is_active_mother_name') == 1) {
                $mothername = $this->input->post('is_active_mother_name');
            }
            if ($this->input->post('is_active_address') == 1) {
                $address = $this->input->post('is_active_address');
            }
            if ($this->input->post('is_active_phone') == 1) {
                $phone = $this->input->post('is_active_phone');
            }
            if ($this->input->post('is_active_dob') == 1) {
                $dob = $this->input->post('is_active_dob');
            }
            if ($this->input->post('is_active_blood_group') == 1) {
                $bloodgroup = $this->input->post('is_active_blood_group');
            }
            $data = array(
                'title' => $this->input->post('title'),
                'school_name' => $this->input->post('school_name'),
                'school_address' => $this->input->post('address'),
                'header_color' => $this->input->post('header_color'),
                'enable_admission_no' => $admission_no,
                'enable_student_name' => $studentname,
                'enable_class' => $class,
                'enable_fathers_name' => $fathername,
                'enable_mothers_name' => $mothername,
                'enable_address' => $address,
                'enable_phone' => $phone,
                'enable_dob' => $dob,
                'enable_blood_group' => $bloodgroup,
                'status' => 1,
            );
            $insert_id = $this->Student_id_card_model->addidcard($data);

            if (!empty($_FILES['background_image']['name'])) {
                $config['upload_path'] = 'uploads/student_id_card/background/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
               
                $file_name = $_FILES['background_image']['name'];

                $config['file_name'] = "background" . $insert_id;
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('background_image')) {
                    $uploadData = $this->upload->data();
                    $background = $uploadData['file_name'];
                } else {
                    $background = '';
                }
            } else {
                $background = '';
            }

            if (!empty($_FILES['logo_img']['name'])) {
                $config['upload_path'] = 'uploads/student_id_card/logo/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                
                $file_name = $_FILES['logo_img']['name'];

                $config['file_name'] = "logo" . $insert_id;
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('logo_img')) {
                    $uploadData = $this->upload->data();
                    $logo_img = $uploadData['file_name'];
                } else {
                    $logo_img = '';
                }
            } else {
                $logo_img = '';
            }

            if (!empty($_FILES['sign_image']['name'])) {
                $config['upload_path'] = 'uploads/student_id_card/signature/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
               
                $file_name = $_FILES['sign_image']['name'];

                $config['file_name'] = "sign" . $insert_id;
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('sign_image')) {
                    $uploadData = $this->upload->data();
                    $sign_image = $uploadData['file_name'];
                } else {
                    $sign_image = '';
                }
            } else {
                $sign_image = '';
            }

            $upload_data = array('id' => $insert_id, 'logo' => $logo_img, 'background' => $background, 'sign_image' => $sign_image);
            $this->Student_id_card_model->addidcard($upload_data);

            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">'.$this->lang->line('success_message').'</div>');
            redirect('admin/studentidcard/index');
        }
    }

    function edit($id) {
        if (!$this->rbac->hasPrivilege('student_id_card', 'can_edit')) {
            access_denied();
        }
       
        $data['title'] = 'Edit ID Card';
        $data['id'] = $id;
        $editidcard = $this->Student_id_card_model->get($id);
        $this->data['editidcard'] = $editidcard;
        $this->form_validation->set_rules('school_name', $this->lang->line('school_name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('address', $this->lang->line('address_phone_email'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('title', $this->lang->line('id_card_title'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->data['idcardlist'] = $this->Student_id_card_model->idcardlist();
            $this->load->view('layout/header');
            $this->load->view('admin/certificate/studentidcardedit', $this->data);
            $this->load->view('layout/footer');
        } else {
            $admission_no = 0;
            $studentname = 0;
            $class = 0;
            $fathername = 0;
            $mothername = 0;
            $address = 0;
            $phone = 0;
            $dob = 0;
            $bloodgroup = 0;

            if ($this->input->post('is_active_admission_no') == 1) {
                $admission_no = $this->input->post('is_active_admission_no');
            }
            if ($this->input->post('is_active_student_name') == 1) {
                $studentname = $this->input->post('is_active_student_name');
            }
            if ($this->input->post('is_active_class') == 1) {
                $class = $this->input->post('is_active_class');
            }
            if ($this->input->post('is_active_father_name') == 1) {
                $fathername = $this->input->post('is_active_father_name');
            }
            if ($this->input->post('is_active_mother_name') == 1) {
                $mothername = $this->input->post('is_active_mother_name');
            }
            if ($this->input->post('is_active_address') == 1) {
                $address = $this->input->post('is_active_address');
            }
            if ($this->input->post('is_active_phone') == 1) {
                $phone = $this->input->post('is_active_phone');
            }
            if ($this->input->post('is_active_dob') == 1) {
                $dob = $this->input->post('is_active_dob');
            }
            if ($this->input->post('is_active_blood_group') == 1) {
                $bloodgroup = $this->input->post('is_active_blood_group');
            }

            if (!empty($_FILES['background_image']['name'])) {
                $config['upload_path'] = 'uploads/student_id_card/background/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                
                $file_name = $_FILES['background_image']['name'];

                $config['file_name'] = "background" . $id;
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('background_image')) {
                    $uploadData = $this->upload->data();
                    $background = $uploadData['file_name'];
                } else {
                    $background = $this->input->post('old_background');
                }
            } else {
                $background = $this->input->post('old_background');
            }

            if (!empty($_FILES['logo_img']['name'])) {
                $config['upload_path'] = 'uploads/student_id_card/logo/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                
                $file_name = $_FILES['logo_img']['name'];

                $config['file_name'] = "logo" . $id;
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('logo_img')) {
                    $uploadData = $this->upload->data();
                    $logo_img = $uploadData['file_name'];
                } else {
                    $logo_img = $this->input->post('old_logo_img');
                }
            } else {
                $logo_img = $this->input->post('old_logo_img');
            }

            if (!empty($_FILES['sign_image']['name'])) {
                $config['upload_path'] = 'uploads/student_id_card/signature/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                
                $file_name = $_FILES['sign_img']['name'];

                $config['file_name'] = "sign" . $id;
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('sign_image')) {
                    $uploadData = $this->upload->data();
                    $sign_image = $uploadData['file_name'];
                } else {
                    $sign_image = $this->input->post('old_sign_image');
                }
            } else {
                $sign_image = $this->input->post('old_sign_image');
            }

            $data = array(
                'id' => $this->input->post('id'),
                'title' => $this->input->post('title'),
                'school_name' => $this->input->post('school_name'),
                'school_address' => $this->input->post('address'),
                'background' => $background,
                'logo' => $logo_img,
                'sign_image' => $sign_image,
                'header_color' => $this->input->post('header_color'),
                'enable_admission_no' => $admission_no,
                'enable_student_name' => $studentname,
                'enable_class' => $class,
                'enable_fathers_name' => $fathername,
                'enable_mothers_name' => $mothername,
                'enable_address' => $address,
                'enable_phone' => $phone,
                'enable_dob' => $dob,
                'enable_blood_group' => $bloodgroup,
                'status' => 1,
            );

            $this->Student_id_card_model->addidcard($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">'.$this->lang->line('update_message').'</div>');
            redirect('admin/studentidcard');
        }
    }

    function delete($id) {
        $data['title'] = 'Certificate List';
        $this->Student_id_card_model->remove($id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">'.$this->lang->line('delete_message').'</div>');
        redirect('admin/studentidcard/index');
    }

    public function view() {
        $id = $this->input->post('certificateid');
        $output = '';
        $idcard = $this->Student_id_card_model->idcardbyid($id);
      //  print_r($idcard);die;
        ?>
        <style type="text/css">
            { margin:0; padding: 0;}

     /*       body{ font-family: 'arial'; margin:0; padding: 0;font-size: 12px; color: #000;}*/
            .tc-container{width: 100%;position: relative; text-align: center;}
            .tcmybg {
                background: top center;
                background-size: contain;
                position: absolute;
                left: 0;
                bottom: 10px;
                width: 200px;
                height: 200px;
                margin-left: auto;
                margin-right: auto;
                right: 0;
            }
            /*begin students id card*/
            .studentmain{background: #efefef;width: 100%; margin-bottom: 30px;}
            .studenttop img{width:30px;vertical-align: top;}
            .studenttop{background: <?php echo $idcard->header_color; ?>;padding:2px;color: #fff;overflow: hidden;
                        position: relative;z-index: 1;}
            .sttext1{font-size: 24px;font-weight: bold;line-height: 30px;}
            .stgray{background: #efefef;padding-top: 5px; padding-bottom: 10px;}
            .staddress{margin-bottom: 0; padding-top: 2px;}
            .stdivider{border-bottom: 2px solid #000;margin-top: 5px; margin-bottom: 5px;}
            .stlist{padding: 0; margin:0; list-style: none;}
            .stlist li{text-align: left;display: inline-block;width: 100%;padding: 0px 5px;}
            .stlist li span{width:65%;float: right;}
            .stimg{
                /*margin-top: 5px;*/
                width: 80px;
                height: auto;
                /*margin: 0 auto;*/
            }
            .stimg img{width: 100%;height: auto;border-radius: 2px;display: block;}
            .staround{padding:3px 10px 3px 0;position: relative;overflow: hidden;}
            .staround2{position: relative; z-index: 9;}
            .stbottom{background: #453278;height: 20px;width: 100%;clear: both;margin-bottom: 5px;}
            /*.stidcard{margin-top: 0px;
                color: #fff;font-size: 16px; line-height: 16px;
                padding: 2px 0 0; position: relative; z-index: 1;
                background: #453277;
                text-transform: uppercase;}*/
            .principal{margin-top: -40px;margin-right:10px; float:right;}
            .stred{color: #000;}
            .spanlr{padding-left: 5px; padding-right: 5px;}
            .cardleft{width: 20%;float: left;}
            .cardright{width: 77%;float: right; }
        </style>
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr> 
                <td valign="top" width="32%" style="padding: 3px;">
                    <table cellpadding="0" cellspacing="0" width="100%" class="tc-container" style="background: #efefef;">
                        <tr>
                            <td valign="top">
                                <img src="<?php echo base_url('uploads/student_id_card/background/') ?><?php echo $idcard->background; ?>" class="tcmybg" style="opacity: .1"/></td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <div class="studenttop">
                                    <div class="sttext1"><img src="<?php echo base_url('uploads/student_id_card/logo/') ?><?php echo $idcard->logo; ?>" width="30" height="30" />
                                        <?php echo $idcard->school_name; ?></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" align="center" style="padding: 1px 0;">
                                <p><?php echo $idcard->school_address; ?></p>
                            <!-- <p>Phone:0761 424242 <span class="spanlr">|</span> E-mail:mountcarmel@gmail.com</p> -->
                            </td>
                        </tr>

                        <tr>
                            <td valign="top" style="color: #fff;font-size: 16px; padding: 2px 0 0; position: relative; z-index: 1;background: <?php echo $idcard->header_color; ?>;text-transform: uppercase;"><?php echo $idcard->title; ?></td>
                        </tr>

                        <tr>
                            <td valign="top">
                                <div class="staround">
                                    <div class="cardleft">
                                        <div class="stimg">
                                            <img src="<?php echo base_url('uploads/student_images/no_image.png') ?>" class="img-responsive" />
                                        </div>
                                    </div><!--./cardleft-->
                                    <div class="cardright">
                                        <ul class="stlist">
                                            <?php
                                            if ($idcard->enable_student_name == 1) {
                                                echo "<li>Student Name<span> S.Tudent Name</span></li>";
                                            }
                                            ?>
                                            <?php
                                            if ($idcard->enable_admission_no == 1) {
                                                echo "<li>Admission Number<span> 123456789</span></li>";
                                            }
                                            ?>
                                            <?php
                                            if ($idcard->enable_class == 1) {
                                                echo "<li>Class<span>Class 6 - A (2018-19)</span></li>";
                                            }
                                            ?>
                                            <?php
                                            if ($idcard->enable_fathers_name == 1) {
                                                echo "<li>Father's Name<span>S.Tudent Name</span></li>";
                                            }
                                            ?>
                                            <?php
                                            if ($idcard->enable_mothers_name == 1) {
                                                echo "<li>Mothers's Name<span>S.Tudent Name</span></li>";
                                            }
                                            ?>
                                            <?php
                                            if ($idcard->enable_address == 1) {
                                                echo "<li>Address<span>D.No.1 Street Name Address Line 2 Address Line 3</span></li>";
                                            }
                                            ?>
                                            <?php
                                            if ($idcard->enable_phone == 1) {
                                                echo "<li>Phone<span>1234567890</span></li>";
                                            }
                                            ?>
                                            <?php
                                            if ($idcard->enable_dob == 1) {
                                                echo "<li>D.O.B<span>25.06.2006</span></li>";
                                            }
                                            ?>
                                            <?php
                                            if ($idcard->enable_blood_group == 1) {
                                                echo "<li class='stred'>Blood Group<span>A+</span></li>";
                                            }
                                            ?>

                                        </ul>
                                    </div><!--./cardright-->
                                </div><!--./staround-->
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" align="right" class="principal"><img src="<?php echo base_url('uploads/student_id_card/signature/') ?><?php echo $idcard->sign_image; ?>" width="66" height="40" /></td>
                        </tr>
                    </table>
                </td>
            </tr>  
        </table>
        <?php
    }

}
?>