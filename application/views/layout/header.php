<!DOCTYPE html>
<html <?php echo $this->customlib->getRTL(); ?>>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $this->customlib->getAppName(); ?></title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta http-equiv="Cache-control" content="no-cache">
        <meta name="theme-color" content="#424242" />
       <link href="<?php echo base_url(); ?>uploads/school_content/admin_small_logo/<?php $this->setting_model->getAdminsmalllogo();?>" rel="shortcut icon" type="image/x-icon">
        
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/jquery.mCustomScrollbar.min.css">
        <?php
          $this->load->view('layout/theme');
         ?>
       
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/ionicons.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/iCheck/flat/blue.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/morris/morris.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/datepicker/datepicker3.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/colorpicker/bootstrap-colorpicker.css">

        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/daterangepicker/daterangepicker-bs3.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/custom_style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/datepicker/css/bootstrap-datetimepicker.css">
        <!--file dropify-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/dropify.min.css">
        <!--file nprogress-->
        <link href="<?php echo base_url(); ?>backend/dist/css/nprogress.css" rel="stylesheet">

        <!--print table-->
        <link href="<?php echo base_url(); ?>backend/dist/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>backend/dist/datatables/css/buttons.dataTables.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>backend/dist/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <!--print table mobile support-->
        <link href="<?php echo base_url(); ?>backend/dist/datatables/css/responsive.dataTables.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>backend/dist/datatables/css/rowReorder.dataTables.min.css" rel="stylesheet">

        <!--language css-->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/0.8.2/css/flag-icon.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>backend/dist/css/bootstrap-select.min.css">


        <script src="<?php echo base_url(); ?>backend/custom/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>backend/dist/js/moment.min.js"></script>
        <script src="<?php echo base_url(); ?>backend/datepicker/js/bootstrap-datetimepicker.js"></script>
        <script src="<?php echo base_url(); ?>backend/plugins/colorpicker/bootstrap-colorpicker.js"></script>
        <script src="<?php echo base_url(); ?>backend/datepicker/date.js"></script>
        <script src="<?php echo base_url(); ?>backend/dist/js/jquery-ui.min.js"></script>
        <script src="<?php echo base_url(); ?>backend/js/school-custom.js"></script>
        <script src="<?php echo base_url(); ?>backend/js/school-admin-custom.js"></script>
        <script src="<?php echo base_url(); ?>backend/js/sstoast.js"></script>
         
        <!-- fullCalendar -->
        <link rel="stylesheet" href="<?php echo base_url() ?>backend/fullcalendar/dist/fullcalendar.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>backend/fullcalendar/dist/fullcalendar.print.min.css" media="print">
       


        <script type="text/javascript">
            var baseurl = "<?php echo base_url(); ?>";
            var chk_validate="<?php echo $this->config->item('SSLK')?>";

        </script>
     
  <style type="text/css">
        span.flag-icon.flag-icon-us{text-orientation: mixed;}
  </style>
    </head>
    <body class="hold-transition skin-blue fixed sidebar-mini">


 <?php
if ($this->config->item('SSLK') == "") {
    ?>
 <div class="topaleart">
    <div class="slidealert">
    <div class="alert alert-dismissible topaleart-inside">
  <!-- <button type="button" class="close" data-dismiss="alert" aria-label="close">&times;</button> -->
   <p class="palert"><strong>Alert!</strong> You are using unregistered version of Smart School. Please <a  href="#" class="purchasemodal">click here</a> to register your purchase code for Smart School.</p>
</div></div>
</div>
                    <?php
}


?> 
<script>

    function collapseSidebar() {

        if (Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))) {
        sessionStorage.setItem('sidebar-toggle-collapsed', '');
        } else {
        sessionStorage.setItem('sidebar-toggle-collapsed', '1');
        }

        }

    function checksidebar() {
        if (Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))) {
        var body = document.getElementsByTagName('body')[0];
        body.className = body.className + ' sidebar-collapse';
        }
    }

    checksidebar();

</script> 
       <div class="wrapper">

            <header class="main-header" id="alert">
                <a href="<?php echo base_url(); ?>admin/admin/dashboard" class="logo">
                    <span class="logo-mini"><img src="<?php echo base_url(); ?>uploads/school_content/admin_small_logo/<?php $this->setting_model->getAdminsmalllogo();?>" alt="<?php echo $this->customlib->getAppName() ?>" /></span>
                    <span class="logo-lg"><img src="<?php echo base_url(); ?>uploads/school_content/admin_logo/<?php $this->setting_model->getAdminlogo();?>" alt="<?php echo $this->customlib->getAppName() ?>" /></span>
                </a>
                <nav class="navbar navbar-static-top" role="navigation">
                    <a onclick="collapseSidebar()"  class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="col-lg-5 col-md-3 col-sm-2 col-xs-5">
                        <span href="#"  class="sidebar-session">
                            <?php echo $this->setting_model->getCurrentSchoolName(); ?>
                        </span>
                    </div>
                    <div class="col-lg-7 col-md-9 col-sm-10 col-xs-7">
                        <div class="pull-right">
                            <?php if ($this->rbac->hasPrivilege('student', 'can_view')) {?>
                              
                                <form class="navbar-form navbar-left search-form" role="search"  action="<?php echo site_url('admin/admin/search'); ?>" method="POST">
                                    <?php echo $this->customlib->getCSRF(); ?>
                                    <div class="input-group">
                                        <input type="text" value="<?php echo set_value('search_text');?>" name="search_text" class="form-control search-form search-form3" placeholder="<?php echo $this->lang->line('search_by_student_name'); ?>">
                                        <span class="input-group-btn">
                                            <button type="submit" name="search" id="search-btn" style="" class="btn btn-flat topsidesearchbtn"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
 
                                </form>
                            <?php }?>
                            <div class="navbar-custom-menu">
                                <?php if($this->rbac->hasPrivilege('language_switcher','can_view')){
                                    ?>
                                    <div class="langdiv"><select class="languageselectpicker" onchange="set_languages(this.value)"  type="text" id="languageSwitcher" >
                                          
                                           <?php $this->load->view('admin/language/languageSwitcher')?>

                                        </select></div> 
                                    <?php
                                }?>
                                
                                     
                                <ul class="nav navbar-nav headertopmenu">
 <?php
if ($this->module_lib->hasActive('calendar_to_do_list')) {
    if ($this->rbac->hasPrivilege('calendar_to_do_list', 'can_view')) {
        ?>
                                            <li class="cal15"><a data-placement="bottom" data-toggle="tooltip" title="<?php echo $this->lang->line('calendar') ?>" href="<?php echo base_url() ?>admin/calendar/events" ><i class="fa fa-calendar"></i></a>

                                            </li>
                                            <?php
}
}
?>
                                    <?php
if ($this->module_lib->hasActive('calendar_to_do_list')) {
    if ($this->rbac->hasPrivilege('calendar_to_do_list', 'can_view')) {
        ?>
                                            <li class="dropdown" data-placement="bottom" data-toggle="tooltip" title="<?php echo $this->lang->line('task') ?>">
                                                <a href="#"  class="dropdown-toggle todoicon" data-toggle="dropdown">
                                                    <i class="fa fa-check-square-o"></i>
                                                    <?php
$userdata = $this->customlib->getUserData();
        $count    = $this->customlib->countincompleteTask($userdata["id"]);
        if ($count > 0) {
            ?>

                                                        <span class="todo-indicator"><?php echo $count ?></span>
                                                    <?php }?>
                                                </a>
                                                <ul class="dropdown-menu menuboxshadow">

                                                    <li class="todoview plr10 ssnoti"><?php echo $this->lang->line('today_you_have'); ?> <?php echo $count; ?> <?php echo $this->lang->line('pending_task'); ?><a href="<?php echo base_url() ?>admin/calendar/events" class="pull-right pt0"><?php echo $this->lang->line('view'); ?> <?php echo $this->lang->line('all'); ?></a></li>
                                                    <li>
                                                        <ul class="todolist">
                                                            <?php
$tasklist = $this->customlib->getincompleteTask($userdata["id"]);
        foreach ($tasklist as $key => $value) {
            ?>
                                                                <li><div class="checkbox">
                                                                        <label><input type="checkbox" id="newcheck<?php echo $value["id"] ?>" onclick="markc('<?php echo $value["id"] ?>')" name="eventcheck"  value="<?php echo $value["id"]; ?>"><?php echo $value["event_title"] ?></label>
                                                                    </div></li>
                                                            <?php }?>

                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>

                                        
                                            <?php
}
}
                                if ($this->module_lib->hasActive('chat')){
                                    if($this->rbac->hasPrivilege('chat','can_view')){
                                        ?>
                                         <li class="cal15"><a data-placement="bottom" data-toggle="tooltip" title="" href="<?php echo base_url()?>admin/chat" data-original-title="Chat" class="todoicon"><i class="fa fa-whatsapp"></i></a></li> 
                                        <?php
                                    }
                                ?>

                                  
                                <?php }
$file   = "";
$result = $this->customlib->getUserData();

$image = $result["image"];
$role  = $result["user_type"];
$id    = $result["id"];
if (!empty($image)) {

    $file = "uploads/staff_images/" . $image;
} else {

    $file = "uploads/student_images/no_image.png";
}
?>
                                    <li class="dropdown user-menu">
                                        <a class="dropdown-toggle" style="padding: 15px 13px;" data-toggle="dropdown" href="#" aria-expanded="false">
                                            <img src="<?php echo base_url() . $file; ?>" class="topuser-image" alt="User Image">
                                        </a>
                                        <ul class="dropdown-menu dropdown-user menuboxshadow">
                                            <li>
                                                <div class="sstopuser">
                                                    <div class="ssuserleft">
                                                        <a href="<?php echo base_url() . "admin/staff/profile/" . $id ?>"><img src="<?php echo base_url() . $file; ?>" alt="User Image"></a>
                                                    </div>

                                                    <div class="sstopuser-test">
                                                        <h4 style="text-transform: capitalize;"><?php echo $this->customlib->getAdminSessionUserName(); ?></h4>
                                                        <h5><?php echo $role; ?></h5>
                                                     
                                                    </div>

                                                    <div class="divider"></div>
                                                    <div class="sspass">
                                                        <a href="<?php echo base_url() . "admin/staff/profile/" . $id ?>" data-toggle="tooltip" title="" data-original-title="My Profile"><i class="fa fa-user"></i>Profile</a>
                                                        <a class="pl25" href="<?php echo base_url(); ?>admin/admin/changepass" data-toggle="tooltip" title="" data-original-title="Change Password"><i class="fa fa-key"></i><?php echo $this->lang->line('password'); ?></a> <a class="pull-right" href="<?php echo base_url(); ?>site/logout"><i class="fa fa-sign-out fa-fw"></i><?php echo $this->lang->line('logout'); ?></a>
                                                    </div>
                                                </div><!--./sstopuser--></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>

            <?php $this->load->view('layout/sidebar');?>
            <script>
                function defoult(id){
      var defoult=  $('#languageSwitcher').val();
   

        $.ajax({
            type: "POST",
            url: base_url + "admin/language/defoult_language/"+id,
            data: {},
            //dataType: "json",
            success: function (data) {
                successMsg("Status Change Successfully");
              $('#languageSwitcher').html(data);

            }
        });

        window.location.reload('true');
        //alert(id);
    }

    function set_languages(lang_id){
       
        $.ajax({
            type: "POST",
            url: base_url + "admin/language/user_language/"+lang_id,
            data: {},
            //dataType: "json",
            success: function (data) { 
                successMsg("Status Change Successfully");
                 window.location.reload('true');

            }
        });

    }

            </script>