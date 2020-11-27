<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#424242" />
        <title><?php echo $name;?></title>
        <!--favican-->
          <link href="<?php echo base_url(); ?>uploads/school_content/admin_small_logo/<?php $this->setting_model->getAdminsmalllogo();?>" rel="shortcut icon" type="image/x-icon">
        <!-- CSS -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/css/form-elements.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/css/style.css">
        <style type="text/css">
            body{background:linear-gradient(to right,#676767 0,#dadada 100%);}
            .nopadding {border-right: 0px solid #ddd;}
        </style>
    </head>
    <body>
        <!-- Top content -->
        <div class="top-content">
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 nopadding col-md-offset-4">
                           <div class="bgoffsetbg"> 
                            <div class="loginbg">
                                <div class="form-top">
                                  <div class="form-top-left logowidth">   
                                    <img src="<?php echo base_url(); ?>uploads/school_content/admin_logo/<?php $this->setting_model->getAdminlogo();?>" />
                                  </div>  
                                </div>
                                <div class="form-bottom">
                                    <h3 class="font-white bolds"><?php echo $this->lang->line('forgot_password'); ?></h3>
                                    <?php
                                    if (isset($error_message)) {
                                        echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                                    }
                                    ?>
                                    <form class="" action="<?php echo site_url('site/ufpassword') ?>" method="post">
                                        <?php echo $this->customlib->getCSRF(); ?>
                                        <div class="form-group has-feedback">
                                            <label class="sr-only" for="form-username"><?php echo $this->lang->line('username'); ?></label>
                                            <input type="text" name="username" placeholder="<?php echo $this->lang->line('email'); ?>" class="form-username form-control" id="form-username">
                                            <span class="fa fa-envelope form-control-feedback"></span>
                                            <span class="text-danger"><?php echo form_error('username'); ?></span>
                                        </div>
                                        <div class="form-group">


                                            <label class="radio-inline">
                                                <input  name="user[]" type="radio" value="student" <?php echo set_radio('user[]', 'student'); ?>>
                                                Student 
                                            </label>
                                            <label class="radio-inline">
                                                <input  name="user[]" type="radio" value="parent" <?php echo set_radio('user[]', 'parent'); ?>>
                                                Parent
                                            </label>
                                            <!--label class="radio-inline">
                                                <input  name="user[]" type="radio" value="teacher" <?php echo set_radio('user[]', 'teacher'); ?>>
                                                Teacher
                                            </label>
                                            <label class="radio-inline">
                                                <input  name="user[]" type="radio" value="accountant" <?php echo set_radio('user[]', 'accountant'); ?>>
                                                Accountant
                                            </label>
                                            <label class="radio-inline">
                                                <input  name="user[]" type="radio" value="librarian" <?php echo set_radio('user[]', 'librarian'); ?>>
                                                Librarian
                                            </label-->
                                            <span class="text-danger"><?php echo form_error('user[]'); ?></span>

                                        </div>
                                        <button type="submit" class="btn"><?php echo $this->lang->line('submit'); ?></button>
                                    </form>
                                    <a href="<?php echo site_url('site/userlogin') ?>" class="forgot"><i class="fa fa-key"></i> <?php echo $this->lang->line('user_login'); ?></a>
                                </div>
                             </div>   
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Javascript -->
        <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url(); ?>backend/usertemplate/assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery.backstretch.min.js"></script>
    </body>
</html>
<script type="text/javascript">
    $(document).ready(function () {
        // var base_url = '<?php //echo base_url(); ?>';
        // $.backstretch([
        //     base_url + "backend/usertemplate/assets/img/backgrounds/user15.jpg"
        // ], {duration: 3000, fade: 750});
        $('.login-form input[type="text"], .login-form input[type="password"], .login-form textarea').on('focus', function () {
            $(this).removeClass('input-error');
        });
        $('.login-form').on('submit', function (e) {
            $(this).find('input[type="text"], input[type="password"], textarea').each(function () {
                if ($(this).val() == "") {
                    e.preventDefault();
                    $(this).addClass('input-error');
                } else {
                    $(this).removeClass('input-error');
                }
            });
        });
    });
</script>