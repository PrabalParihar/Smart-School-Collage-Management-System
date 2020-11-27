<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper" style="min-height: 946px;">
    <div class="row">  
        <div class="col-md-12">
            <section class="content-header" style="padding-right: 0;">
                <h1>
                    <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('student_information'); ?> <small><?php echo $this->lang->line('student1'); ?></small></h1>

            </section>
        </div>

        <div>
            <a id="sidebarCollapse" class="studentsideopen"><i class="fa fa-navicon"></i></a>
            <aside class="studentsidebar">
                <div class="stutop" id="">
                    <!-- Create the tabs -->
                    <div class="studentsidetopfixed">
                        <p class="classtap"><?php echo $student["class"]; ?> <a href="#" data-toggle="control-sidebar" class="studentsideclose"><i class="fa fa-times"></i></a></p>
                        <ul class="nav nav-justified studenttaps">
                            <?php foreach ($class_section as $skey => $svalue) {
                                ?>
                                <li <?php
                                if ($student["section_id"] == $svalue["section_id"]) {
                                    echo "class='active'";
                                }
                                ?> ><a href="#section<?php echo $svalue["section_id"] ?>" data-toggle="tab"><?php print_r($svalue["section"]); ?></a></li>
                                <?php } ?>
                        </ul>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <?php foreach ($class_section as $skey => $snvalue) {
                            ?>
                            <div class="tab-pane <?php
                            if ($student["section_id"] == $snvalue["section_id"]) {
                                echo "active";
                            }
                            ?>" id="section<?php echo $snvalue["section_id"]; ?>">
                                 <?php
                                 foreach ($studentlistbysection as $stkey => $stvalue) {
                                     if ($stvalue['section_id'] == $snvalue["section_id"]) {
                                         ?>
                                        <div class="studentname">
                                            <a class="" href="<?php echo base_url() . "student/view/" . $stvalue["id"] ?>">
                                                <div class="icon"><img src="<?php
                                                    if (!empty($stvalue["image"])) {
                                                        echo base_url() . $stvalue["image"];
                                                    } else {
                                                        echo base_url() . "uploads/student_images/no_image.png";
                                                    }
                                                    ?>" alt="User Image"></div>
                                                <div class="student-tittle"><?php echo $stvalue["firstname"] . " " . $stvalue["lastname"]; ?></div></a>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        <?php } ?>
                        <div class="tab-pane" id="sectionB">
                            <h3 class="control-sidebar-heading">Recent Activity 2</h3>
                        </div>

                        <div class="tab-pane" id="sectionC">
                            <h3 class="control-sidebar-heading">Recent Activity 3</h3>
                        </div>
                        <div class="tab-pane" id="sectionD">
                            <h3 class="control-sidebar-heading">Recent Activity 3</h3>
                        </div> 
                        <!-- /.tab-pane -->
                    </div>
                </div>
            </aside>
        </div>  
        <!-- /.control-sidebar -->
    </div>

    <section class="content">
        <div class="row">

            <div class="col-md-3"> 

                <div class="box box-primary"  <?php
                if ($student["is_active"] == "no") {
                    echo "style='background-color:#f0dddd;'";
                }
                ?>>
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="<?php
                        if (!empty($student['image'])) {
                            echo base_url() . $student['image'];
                        } else {
                            echo base_url() . "uploads/student_images/no_image.png";
                        }
                        ?>" alt="User profile picture">
                        <h3 class="profile-username text-center"><?php echo $student['firstname'] . " " . $student['lastname']; ?></h3>

                        <ul class="list-group list-group-unbordered">
                            <?php
                            if ($student['is_active'] == 'no') {
                                ?>



                                <li class="list-group-item listnoback">
                                    <b><?php echo $this->lang->line('disable')." ".$this->lang->line('reason') ?></b> <span class="pull-right text-aqua"><?php echo $reason_data['reason'] ?></span>
                                </li>
                                <li class="list-group-item listnoback">
                                    <b><?php  echo $this->lang->line('disable')." ".$this->lang->line('note') ?></b> <span class="pull-right text-aqua"><?php echo $student['dis_note'] ?></span>
                                </li>



                            <?php } ?> 
                            
                            <li class="list-group-item listnoback">
                                <b><?php echo $this->lang->line('admission_no'); ?></b> <a class="pull-right text-aqua"><?php echo $student['admission_no']; ?></a>
                            </li>
                        <?php 
                            if ($sch_setting->roll_no) { ?> 
                            <li class="list-group-item listnoback">
                                <b><?php echo $this->lang->line('roll_no'); ?></b> <a class="pull-right text-aqua"><?php echo $student['roll_no']; ?></a>
                            </li>
                            <?php 
                        } ?>
                            <li class="list-group-item listnoback">
                                <b><?php echo $this->lang->line('class'); ?></b> <a class="pull-right text-aqua"><?php echo $student['class'] . " (" . $session . ")"; ?></a>
                            </li>
                            <li class="list-group-item listnoback">
                                <b><?php echo $this->lang->line('section'); ?></b> <a class="pull-right text-aqua"><?php echo $student['section']; ?></a>
                            </li>
                            <?php if ($sch_setting->rte) { ?>
                            <li class="list-group-item listnoback">
                                <b><?php echo $this->lang->line('rte'); ?></b> <a class="pull-right text-aqua"><?php echo $student['rte']; ?></a>
                            </li>
                            <?php } ?>
                            <li class="list-group-item listnoback">
                                <b><?php echo $this->lang->line('gender'); ?></b> <a class="pull-right text-aqua"><?php echo $this->lang->line(strtolower($student['gender'])); ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php
                if (!empty($siblings)) {
                    ?>
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('sibling'); ?></h3>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">
                            <?php
                            foreach ($siblings as $sibling_key => $sibling_value) {
                                ?>
                                <div class="box box-widget widget-user-2">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="siblingview">
                                        <img class="" src="<?php echo base_url() . $sibling_value->image; ?>" alt="User Avatar">
                                        <h4><a href="<?php echo site_url('student/view/' . $sibling_value->id) ?>"><?php echo $sibling_value->firstname . " " . $sibling_value->lastname ?></a></h4>
                                    </div>
                                    <div class="box-footer no-padding">
                                        <ul class="list-group list-group-unbordered">
                                            <li class="list-group-item">


                                                <b><?php echo $this->lang->line('admission_no'); ?></b> <a class="pull-right text-aqua"><?php echo $sibling_value->admission_no; ?></a>
                                            </li>

                                            <li class="list-group-item">
                                                <b><?php echo $this->lang->line('class'); ?></b> <a class="pull-right text-aqua"><?php echo $sibling_value->class; ?></a>
                                            </li> 
                                            <li class="list-group-item">
                                                <b><?php echo $this->lang->line('section'); ?></b> <a class="pull-right text-aqua"><?php echo $sibling_value->section; ?></a>

                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>


                        </div>
                        <!-- /.box-body -->

                    </div>

                    <?php
                }
                ?>
 
            </div>
            <div class="col-md-9">

                <div class="nav-tabs-custom theme-shadow">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true"><?php echo $this->lang->line('profile'); ?></a></li>


                        <?php
                        if ($this->module_lib->hasActive('fees_collection')) {
                            if (($this->rbac->hasPrivilege('collect_fees', 'can_view') ||
                                    $this->rbac->hasPrivilege('search_fees_payment', 'can_view') ||
                                    $this->rbac->hasPrivilege('search_due_fees', 'can_view') ||
                                    $this->rbac->hasPrivilege('fees_statement', 'can_view') ||
                                    $this->rbac->hasPrivilege('balance_fees_report', 'can_view') ||
                                    $this->rbac->hasPrivilege('fees_carry_forward', 'can_view') ||
                                    $this->rbac->hasPrivilege('fees_master', 'can_view') ||
                                    $this->rbac->hasPrivilege('fees_group', 'can_view') ||
                                    $this->rbac->hasPrivilege('fees_type', 'can_view') ||
                                    $this->rbac->hasPrivilege('fees_discount', 'can_view') ||
                                    $this->rbac->hasPrivilege('accountants', 'can_view'))) {
                                ?>
                                <li class=""><a href="#fee" data-toggle="tab" aria-expanded="true"><?php echo $this->lang->line('fees'); ?></a></li>
                                <?php
                            }
                        }


                       
                        ?>              
                        <li class=""><a href="#documents" data-toggle="tab" aria-expanded="true"><?php echo $this->lang->line('documents'); ?></a></li>
                        <?php
                        if ($this->rbac->hasPrivilege('student_timeline', 'can_add')) {
                            ?> 
                            <li class=""><a href="#timelineh" data-toggle="tab" aria-expanded="true"><?php echo $this->lang->line('timeline') ?></a></li>
                        <?php } ?>




                        <?php if ($student["is_active"] == "yes") { ?>
                            <?php
                            if ($this->rbac->hasPrivilege('disable_student', 'can_view')) {
                                ?>
                                <li class="pull-right dropdown">
                                    <a href="#" class="dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                                    <ul class="dropdown-menu">
                                        <li><a style="cursor: pointer;" onclick="send_password()"><?php echo $this->lang->line('send_student_password');?></a></li>
                                        <li><a style="cursor: pointer;" onclick="send_parent_password()"> <?php echo $this->lang->line('send_parent_password'); ?></a></li>
                                    </ul>
                                </li>

                                <li class="pull-right">
                                    <a style="cursor: pointer;" onclick="disable_student('<?php echo $student["id"] ?>')"  class="text-red" data-toggle="tooltip" data-placement="bottom" title="<?php echo "Disable"; ?>">
                                        <i class="fa fa-thumbs-o-down"></i><?php //echo "Disable Student";        ?>
                                    </a>
                                </li>

                                <?php
                            }

//5235
                            if ($this->rbac->hasPrivilege('student_login_credential_report', 'can_view')) {
                                ?> 


                                <li class="pull-right">
                                    <a href="#"  class="schedule_modal text-green" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line('login_details'); ?>"><i class="fa fa-key"></i>
                                        <?php //echo $this->lang->line('login_details');    ?>
                                    </a>
                                </li>
                                <?php
                            }  
                            if ($this->rbac->hasPrivilege('student', 'can_edit')) {
                                ?>

                                <li class="pull-right">
                                    <a href="<?php echo base_url() . "student/edit/" . $student["id"] ?>"  class="" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i>
                                        <?php //echo $this->lang->line('login_details');    ?>
                                    </a>
                                </li>
                                <?php
                            }
                        } else {
                            ?>

                           
                            <li class="pull-right">
                                <a href="#" onclick="enable('<?php echo $student["id"] ?>')"  class="text-green" data-toggle="tooltip" data-placement="left" title="<?php echo "Enable"; ?>">
                                    <i class="fa fa-thumbs-o-up"></i><?php ?>
                                </a>
                            </li>

                        <?php } ?>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="activity">

                            <div class="tshadow mb25 bozero">
                                <div class="table-responsive around10 pt0">
                                    <table class="table table-hover table-striped tmb0">
                                        <tbody> 
                                            <?php if ($sch_setting->admission_date) {  ?>
                                            <tr>
                                                <td class="col-md-4"><?php echo $this->lang->line('admission_date'); ?></td>
                                                <td class="col-md-5">                                          
                                                    <?php
                                                    if (!empty($student['admission_date'])) {
                                                        echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['admission_date']));
                                                    }
                                                    ?></td>
                                            </tr>
                                            <?php } ?>
                                            <tr>
                                                <td><?php echo $this->lang->line('date_of_birth'); ?></td>
                                                <td><?php
                                                    if (!empty($student['admission_date'])) {
                                                        echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['dob']));
                                                    }
                                                    ?></td>
                                            </tr>
                                            <?php if ($sch_setting->category) {  ?>
                                            <tr>
                                                <td><?php echo $this->lang->line('category'); ?></td>
                                                <td>
                                                    <?php
                                                    foreach ($category_list as $value) {
                                                        if ($student['category_id'] == $value['id']) {
                                                            echo $value['category'];
                                                        }
                                                    }
                                                    ?>                                         
                                                </td>
                                            </tr>
                                            <?php } if ($sch_setting->mobile_no) {  ?>
                                            <tr>
                                                <td><?php echo $this->lang->line('mobile_no'); ?></td>
                                                <td><?php echo $student['mobileno']; ?></td>
                                            </tr>
                                            <?php } if ($sch_setting->cast) {  ?>
                                            <tr>
                                                <td><?php echo $this->lang->line('cast'); ?></td>
                                                <td><?php echo $student['cast']; ?></td>
                                            </tr>
                                            <?php } if ($sch_setting->religion) {  ?>
                                            <tr>
                                                <td><?php echo $this->lang->line('religion'); ?></td>
                                                <td><?php echo $student['religion']; ?></td>
                                            </tr>
                                            <?php } if ($sch_setting->student_email) {  ?>
                                            <tr>
                                                <td><?php echo $this->lang->line('email'); ?></td>
                                                <td><?php echo $student['email']; ?></td>
                                            </tr>
                                            <?php } ?>
                                            <?php
                                            $cutom_fields_data = get_custom_table_values($student['id'], 'students');
                                            if (!empty($cutom_fields_data)) {
                                                foreach ($cutom_fields_data as $field_key => $field_value) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $field_value->name; ?></td>
                                                        <td>
                                                            <?php
                                                            if (is_string($field_value->field_value) && is_array(json_decode($field_value->field_value, true)) && (json_last_error() == JSON_ERROR_NONE)) {
                                                                $field_array = json_decode($field_value->field_value);
                                                                echo "<ul class='student_custom_field'>";
                                                                foreach ($field_array as $each_key => $each_value) {
                                                                    echo "<li>" . $each_value . "</li>";
                                                                }
                                                                echo "</ul>";
                                                            } else {
                                                                $display_field = $field_value->field_value;

                                                                if ($field_value->type == "link") {
                                                                    $display_field = "<a href=" . $field_value->field_value . " target='_blank'>" . $field_value->field_value . "</a>";
                                                                }
                                                                echo $display_field;
                                                            }
                                                            ?>
                                                        </td> 
                                                    </tr>

                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div> 
                            </div> 
                            <div class="tshadow mb25 bozero">   
                                <h3 class="pagetitleh2"><?php echo $this->lang->line('address'); ?> <?php echo $this->lang->line('detail'); ?></h3>
                                <div class="table-responsive around10 pt0">  
                                    <table class="table table-hover table-striped tmb0"><tbody>
                                            <?php if ($sch_setting->current_address) { ?>
                                            <tr>
                                                <td class="col-md-4"><?php echo $this->lang->line('current_address'); ?></td>
                                                <td class="col-md-5"><?php echo $student['current_address']; ?></td>
                                            </tr>
                                            <?php } if ($sch_setting->permanent_address) { ?>
                                            <tr>
                                                <td><?php echo $this->lang->line('permanent_address'); ?></td>
                                                <td><?php echo $student['permanent_address']; ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>  
                            <div class="tshadow mb25 bozero">      
                                <h3 class="pagetitleh2"><?php echo $this->lang->line('parent'); ?> / <?php echo $this->lang->line('guardian_details'); ?> </h3>
                                <div class="table-responsive around10 pt10">
                                    <table class="table table-hover table-striped tmb0">
                                        <?php if ($sch_setting->father_name) {  ?>
                                        <tr>
                                            <td  class="col-md-4"><?php echo $this->lang->line('father_name'); ?></td>
                                            <td  class="col-md-5"><?php echo $student['father_name']; ?></td>
                                            <td rowspan="3"><img class="profile-user-img img-responsive img-circle" src="<?php
                                                if (!empty($student["father_pic"])) {
                                                    echo base_url() . $student["father_pic"];
                                                } else {
                                                    echo base_url() . "uploads/student_images/no_image.png";
                                                }
                                                ?>" ></td>
                                        </tr>
                                        <?php } if ($sch_setting->father_phone) {  ?>
                                        <tr>
                                            <td><?php echo $this->lang->line('father_phone'); ?></td>
                                            <td><?php echo $student['father_phone']; ?></td>
                                        </tr>
                                        <?php } if ($sch_setting->father_occupation) { ?>
                                        <tr>
                                            <td><?php echo $this->lang->line('father_occupation'); ?></td>
                                            <td><?php echo $student['father_occupation']; ?></td>
                                        </tr>
                                        <?php } if ($sch_setting->mother_name) {?>
                                        <tr>
                                            <td><?php echo $this->lang->line('mother_name'); ?></td>
                                            <td><?php echo $student['mother_name']; ?></td>
                                            <td rowspan="3"><img class="profile-user-img img-responsive img-circle" src="<?php
                                                if (!empty($student["mother_pic"])) {
                                                    echo base_url() . $student["mother_pic"];
                                                } else {
                                                    echo base_url() . "uploads/student_images/no_image.png";
                                                }
                                                ?>" ></td>
                                        </tr>
                                        <?php } if ($sch_setting->mother_phone) { ?>
                                        <tr>
                                            <td><?php echo $this->lang->line('mother_phone'); ?></td>
                                            <td><?php echo $student['mother_phone']; ?></td>

                                        </tr>
                                        <?php } if ($sch_setting->mother_occupation) { ?>
                                        <tr>
                                            <td><?php echo $this->lang->line('mother_occupation'); ?></td>
                                            <td><?php echo $student['mother_occupation']; ?></td>
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <td><?php echo $this->lang->line('guardian_name'); ?></td>
                                            <td><?php echo $student['guardian_name']; ?></td>
                                            <td rowspan="3"><img class="profile-user-img img-responsive img-circle" src="<?php
                                                if (!empty($student["guardian_pic"])) {
                                                    echo base_url() . $student["guardian_pic"];
                                                } else {
                                                    echo base_url() . "uploads/student_images/no_image.png";
                                                }
                                                ?>" ></td>
                                        </tr>
                                        <?php  if ($sch_setting->guardian_email) { ?>
                                        <tr>
                                            <td><?php echo $this->lang->line('guardian_email'); ?></td>
                                            <td><?php echo $student['guardian_email']; ?></td>
                                        </tr>
                                        <?php } if ($sch_setting->guardian_relation) { ?>
                                        <tr>
                                            <td><?php echo $this->lang->line('guardian_relation'); ?></td>
                                            <td><?php echo $student['guardian_relation']; ?></td>
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <td><?php echo $this->lang->line('guardian_phone'); ?></td>
                                            <td><?php echo $student['guardian_phone']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $this->lang->line('guardian_occupation'); ?></td>
                                            <td><?php echo $student['guardian_occupation']; ?></td>
                                        </tr>
                                        <?php if ($sch_setting->guardian_address) { ?>
                                        <tr>
                                            <td><?php echo $this->lang->line('guardian_address'); ?></td>
                                            <td><?php echo $student['guardian_address']; ?></td>
                                        </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div> 
                            <?php if ($sch_setting->route_list) { ?>
                            <?php
                            if ($this->module_lib->hasActive('transport')) {

                                if ($student['vehroute_id'] != 0) {
                                    ?>
                                    <div class="tshadow mb25  bozero">    
                                        <h3 class="pagetitleh2"><?php echo $this->lang->line('route') . " " . $this->lang->line('details') ?></h3>

                                        <div class="table-responsive around10 pt0">
                                            <table class="table table-hover table-striped tmb0">
                                                <tbody>

                                                    <tr>
                                                        <td  class="col-md-4"><?php echo $this->lang->line('route'); ?></td>
                                                        <td  class="col-md-5"><?php echo $student['route_title']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td  class="col-md-4"><?php echo $this->lang->line('vehicle_no'); ?></td>
                                                        <td  class="col-md-5"><?php echo $student['vehicle_no']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo $this->lang->line('driver_name'); ?></td>
                                                        <td><?php echo $student['driver_name']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo $this->lang->line('driver_contact'); ?></td>
                                                        <td><?php echo $student['driver_contact']; ?></td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div> 

                                    <?php
                                }
                            } }
                            ?>
                            <?php if ($sch_setting->hostel_id) { 
                            if ($this->module_lib->hasActive('hostel')) {

                                if ($student['hostel_room_id'] != 0) {
                                    ?>
                                    <div class="tshadow mb25  bozero">    
                                        <h3 class="pagetitleh2"><?php echo $this->lang->line('hostel') . " " . $this->lang->line('details') ?></h3>

                                        <div class="table-responsive around10 pt0">
                                            <table class="table table-hover table-striped tmb0">
                                                <tbody>

                                                    <tr>
                                                        <td  class="col-md-4"><?php echo $this->lang->line('hostel'); ?></td>
                                                        <td  class="col-md-5"><?php echo $student['hostel_name']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td  class="col-md-4"><?php echo $this->lang->line('room_no'); ?></td>
                                                        <td  class="col-md-5"><?php echo $student['room_no']; ?></td>
                                                    </tr>   
                                                    <tr>
                                                        <td  class="col-md-4"><?php echo $this->lang->line('room_type'); ?></td>
                                                        <td  class="col-md-5"><?php echo $student['room_type']; ?></td>
                                                    </tr>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div> 

                                    <?php
                                }
                            } }
                            ?>


                            <div class="tshadow mb25  bozero">    
                                <h3 class="pagetitleh2"><?php echo $this->lang->line('miscellaneous_details'); ?></h3>
                                <div class="table-responsive around10 pt0">
                                    <table class="table table-hover table-striped tmb0">
                                        <tbody>
                                            <?php if ($sch_setting->is_blood_group) { ?>
                                            <tr>
                                                <td  class="col-md-4"><?php echo $this->lang->line('blood_group'); ?></td>
                                                <td  class="col-md-5"><?php echo $student['blood_group']; ?></td>
                                            </tr>
                                            <?php } if ($sch_setting->is_student_house) { ?>
                                            <tr>
                                                <td  class="col-md-4"><?php echo $this->lang->line('house'); ?></td>
                                                <td  class="col-md-5"><?php echo $student['house_name']; ?></td>
                                            </tr>
                                            <?php } if ($sch_setting->student_height) {  ?>
                                            <tr>
                                                <td  class="col-md-4"><?php echo $this->lang->line('height'); ?></td>
                                                <td  class="col-md-5"><?php echo $student['height']; ?></td>
                                            </tr>
                                            <?php } if ($sch_setting->student_weight) { ?>
                                            <tr>
                                                <td  class="col-md-4"><?php echo $this->lang->line('weight'); ?></td>
                                                <td  class="col-md-5"><?php echo $student['weight']; ?></td>
                                            </tr>
                                            <?php } if ($sch_setting->measurement_date) { ?>
                                            <tr>
                                                <td  class="col-md-4"><?php echo $this->lang->line('measurement_date'); ?></td>
                                                <td  class="col-md-5"><?php
                                                    if (!empty($student['measurement_date'])) {
                                                        echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['measurement_date']));
                                                    }
                                                    ?></td>
                                            </tr>
                                            <?php } if ($sch_setting->previous_school_details) {  ?>
                                            <tr>
                                                <td  class="col-md-4"><?php echo $this->lang->line('previous_school_details'); ?></td>
                                                <td  class="col-md-5"><?php echo $student['previous_school']; ?></td>
                                            </tr>
                                            <?php } if ($sch_setting->national_identification_no) { ?>
                                            <tr>
                                                <td  class="col-md-4"><?php echo $this->lang->line('national_identification_no'); ?></td>
                                                <td  class="col-md-5"><?php echo $student['adhar_no']; ?></td>
                                            </tr>
                                            <?php } if ($sch_setting->local_identification_no) { ?>
                                            <tr>
                                                <td><?php echo $this->lang->line('local_identification_no'); ?></td>
                                                <td><?php echo $student['samagra_id']; ?></td>
                                            </tr>
                                            <?php } if ($sch_setting->bank_account_no) { ?>
                                            <tr>
                                                <td><?php echo $this->lang->line('bank_account_no'); ?></td>
                                                <td><?php echo $student['bank_account_no']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $this->lang->line('bank_name'); ?></td>
                                                <td><?php echo $student['bank_name']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $this->lang->line('ifsc_code'); ?></td>
                                                <td><?php echo $student['ifsc_code']; ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>  
                        </div>
                        <div class="tab-pane" id="fee">
                            <?php
                            if (empty($student_due_fee) && empty($student_discount_fee)) {
                                ?>
                                <div class="alert alert-danger">
                                    <?php echo $this->lang->line('no_record_found'); ?>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="table-responsive">    
                                    <table class="table table-hover table-striped">

                                        <thead>
                                            <tr>
                                                <th><?php echo $this->lang->line('fees_group'); ?></th>
                                                <th><?php echo $this->lang->line('fees_code'); ?></th>
                                                <th class="text text-left"><?php echo $this->lang->line('due_date'); ?></th>
                                                <th class="text text-left"><?php echo $this->lang->line('status'); ?></th>
                                                <th class="text text-right"><?php echo $this->lang->line('amount'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                                <th class="text text-left"><?php echo $this->lang->line('payment_id'); ?></th>
                                                <th class="text text-left"><?php echo $this->lang->line('mode'); ?></th>
                                                <th class="text text-left"><?php echo $this->lang->line('date'); ?></th>
                                                <th class="text text-right" ><?php echo $this->lang->line('discount'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                                <th class="text text-right"><?php echo $this->lang->line('fine'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                                <th class="text text-right"><?php echo $this->lang->line('paid'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                                <th class="text text-right"><?php echo $this->lang->line('balance'); ?></th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $total_amount = 0;
                                            $total_deposite_amount = 0;
                                            $total_fine_amount = 0;
                                            $total_discount_amount = 0;
                                            $total_balance_amount = 0;
                                            $alot_fee_discount = 0;

                                            foreach ($student_due_fee as $key => $fee) {

                                                foreach ($fee->fees as $fee_key => $fee_value) {
                                                    $fee_paid = 0;
                                                    $fee_discount = 0;
                                                    $fee_fine = 0;
                                                    $alot_fee_discount = 0;


                                                    if (!empty($fee_value->amount_detail)) {
                                                        $fee_deposits = json_decode(($fee_value->amount_detail));

                                                        foreach ($fee_deposits as $fee_deposits_key => $fee_deposits_value) {
                                                            $fee_paid = $fee_paid + $fee_deposits_value->amount;
                                                            $fee_discount = $fee_discount + $fee_deposits_value->amount_discount;
                                                            $fee_fine = $fee_fine + $fee_deposits_value->amount_fine;
                                                        }
                                                    }
                                                    $total_amount = $total_amount + $fee_value->amount;
                                                    $total_discount_amount = $total_discount_amount + $fee_discount;
                                                    $total_deposite_amount = $total_deposite_amount + $fee_paid;
                                                    $total_fine_amount = $total_fine_amount + $fee_fine;
                                                    $feetype_balance = $fee_value->amount - ($fee_paid + $fee_discount);
                                                    $total_balance_amount = $total_balance_amount + $feetype_balance;
                                                    ?>
                                                    <?php
                                                    if ($feetype_balance > 0 && strtotime($fee_value->due_date) < strtotime(date('Y-m-d'))) {
                                                        ?>
                                                        <tr class="danger font12">
                                                            <?php
                                                        } else {
                                                            ?>
                                                        <tr class="dark-gray">
                                                            <?php
                                                        }
                                                        ?>


                                                        <td><?php
                                                            echo $fee_value->name;
                                                            ?></td>
                                                        <td><?php echo $fee_value->code; ?></td>
                                                        <td class="text text-left">

                                                            <?php
                                                            if ($fee_value->due_date == "0000-00-00") {
                                                                
                                                            } else {

                                                                echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($fee_value->due_date));
                                                            }
                                                            ?>
                                                        </td>
                                                        <td class="text text-left">
                                                            <?php
                                                            if ($feetype_balance == 0) {
                                                                ?><span class="label label-success"><?php echo $this->lang->line('paid'); ?></span><?php
                                                            } else if (!empty($fee_value->amount_detail)) {
                                                                ?><span class="label label-warning"><?php echo $this->lang->line('partial'); ?></span><?php
                                                            } else {
                                                                ?><span class="label label-danger"><?php echo $this->lang->line('unpaid'); ?></span><?php
                                                                }
                                                                ?>

                                                        </td>
                                                        <td class="text text-right"><?php echo $fee_value->amount; ?></td>

                                                        <td class="text text-left"></td>
                                                        <td class="text text-left"></td>
                                                        <td class="text text-left"></td>


                                                        <td class="text text-right"><?php
                                                            echo (number_format($fee_discount, 2, '.', ''));
                                                            ?></td>
                                                        <td class="text text-right"><?php
                                                            echo (number_format($fee_fine, 2, '.', ''));
                                                            ?></td>
                                                        <td class="text text-right"><?php
                                                            echo (number_format($fee_paid, 2, '.', ''));
                                                            ?></td>
                                                        <td class="text text-right"><?php
                                                            $display_none = "ss-none";
                                                            if ($feetype_balance > 0) {
                                                                $display_none = "";
                                                                echo (number_format($feetype_balance, 2, '.', ''));
                                                            }
                                                            ?>

                                                        </td>




                                                    </tr>

                                                    <?php
                                                    if (!empty($fee_value->amount_detail)) {

                                                        $fee_deposits = json_decode(($fee_value->amount_detail));

                                                        foreach ($fee_deposits as $fee_deposits_key => $fee_deposits_value) {
                                                            ?>
                                                            <tr class="white-td">
                                                                <td class="text-left"></td>
                                                                <td class="text-left"></td>
                                                                <td class="text-left"></td>
                                                                <td class="text-left"></td>
                                                                <td class="text-right"><img src="<?php echo base_url(); ?>backend/images/table-arrow.png" alt="" /></td>
                                                                <td class="text text-left">


                                                                    <a href="#" data-toggle="popover" class="detail_popover" > <?php echo $fee_value->student_fees_deposite_id . "/" . $fee_deposits_value->inv_no; ?></a>
                                                                    <div class="fee_detail_popover" style="display: none">
                                                                        <?php
                                                                        if ($fee_deposits_value->description == "") {
                                                                            ?>
                                                                            <p class="text text-danger"><?php echo $this->lang->line('no_description'); ?></p>
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <p class="text text-info"><?php echo $fee_deposits_value->description; ?></p>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </div>


                                                                </td>
                                                                <td class="text text-left"><?php echo $fee_deposits_value->payment_mode; ?></td>
                                                                <td class="text text-center">

                                                                    <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($fee_deposits_value->date)); ?>
                                                                </td>
                                                                <td class="text text-right"><?php echo (number_format($fee_deposits_value->amount_discount, 2, '.', '')); ?></td>
                                                                <td class="text text-right"><?php echo (number_format($fee_deposits_value->amount_fine, 2, '.', '')); ?></td>
                                                                <td class="text text-right"><?php echo (number_format($fee_deposits_value->amount, 2, '.', '')); ?></td>


                                                                <td></td>



                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <?php
                                            if (!empty($student_discount_fee)) {

                                                foreach ($student_discount_fee as $discount_key => $discount_value) {
                                                    ?>
                                                    <tr class="dark-light">
                                                        <td align="left"> <?php echo $this->lang->line('discount'); ?> </td>
                                                        <td align="left">
                                                            <?php echo $discount_value['code']; ?>
                                                        </td>
                                                        <td align="left"></td>
                                                        <td align="left" class="text text-left">
                                                            <?php
                                                            if ($discount_value['status'] == "applied") {
                                                                ?>
                                                                <a href="#" data-toggle="popover" class="detail_popover" >

                                                                    <?php echo $this->lang->line('discount_of') . " " . $currency_symbol . $discount_value['amount'] . " " . $this->lang->line($discount_value['status']) . " : " . $discount_value['payment_id']; ?>

                                                                </a>
                                                                <div class="fee_detail_popover" style="display: none">
                                                                    <?php
                                                                    if ($discount_value['student_fees_discount_description'] == "") {
                                                                        ?>
                                                                        <p class="text text-danger"><?php echo $this->lang->line('no_description'); ?></p>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <p class="text text-danger"><?php echo $discount_value['student_fees_discount_description'] ?></p>
                                                                        <?php
                                                                    }
                                                                    ?>

                                                                </div>
                                                                <?php
                                                            } else {
                                                                echo '<p class="text text-danger">' . $this->lang->line('discount_of') . " " . $currency_symbol . $discount_value['amount'] . " " . $this->lang->line($discount_value['status']);
                                                            }
                                                            ?>

                                                        </td>
                                                        <td></td>
                                                        <td class="text text-left"></td>
                                                        <td class="text text-left"></td>
                                                        <td class="text text-left"></td>
                                                        <td  class="text text-right">
                                                            <?php
                                                            $alot_fee_discount = $alot_fee_discount;
                                                            ?>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>

                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>

                                            <tr class="box box-solid total-bg">
                                                <td ></td>
                                                <td ></td>
                                                <td ></td>
                                                <td class="text text-right" ><?php echo $this->lang->line('grand_total'); ?></td>
                                                <td class="text text-right"><?php
                                                    echo ($currency_symbol . number_format($total_amount, 2, '.', ''));
                                                    ?></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>


                                                <td class="text text-right"><?php
                                                    echo ($currency_symbol . number_format($total_discount_amount + $alot_fee_discount, 2, '.', ''));
                                                    ?></td>
                                                <td class="text text-right"><?php
                                                    echo ($currency_symbol . number_format($total_fine_amount, 2, '.', ''));
                                                    ?></td>
                                                <td class="text text-right"><?php
                                                    echo ($currency_symbol . number_format($total_deposite_amount, 2, '.', ''));
                                                    ?></td>

                                                <td class="text text-right"><?php
                                                    echo ($currency_symbol . number_format($total_balance_amount - $alot_fee_discount, 2, '.', ''));
                                                    ?></td> 

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>    
                                <?php
                            }
                            ?>

                        </div>                       
                        <div class="tab-pane" id="documents">
                            <div class="timeline-header no-border">
                                <button type="button"  data-student-session-id="<?php echo $student['student_session_id'] ?>" class="btn btn-xs btn-primary pull-right myTransportFeeBtn"> <i class="fa fa-upload"></i>  <?php echo $this->lang->line('upload_documents'); ?></button>

                                <!-- <h2 class="page-header"><?php //echo $this->lang->line('documents');             ?> <?php //echo $this->lang->line('list');             ?></h2> -->
                                <div class="table-responsive" style="clear: both;">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <?php echo $this->lang->line('title'); ?>
                                                </th>
                                                <th>
                                                    <?php echo $this->lang->line('file'); ?> <?php echo $this->lang->line('name'); ?>
                                                </th>
                                                <th class="mailbox-date text-right">
                                                    <?php echo $this->lang->line('action'); ?>
                                                </th>
                                            </tr>
                                        </thead>
                                        <div class="row">                                     
                                            <tbody>
                                                <?php
                                                if (empty($student_doc)) {
                                                    ?>
                                                    <tr>
                                                        <td colspan="5" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?></td>
                                                    </tr>
                                                    <?php
                                                } else {
                                                    foreach ($student_doc as $value) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $value['title']; ?></td>
                                                            <td><?php echo $value['doc']; ?></td>
                                                            <td class="mailbox-date pull-right">
                                                                <a href="<?php echo base_url(); ?>student/download/<?php echo $value['student_id'] . "/" . $value['doc']; ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('download'); ?>">
                                                                    <i class="fa fa-download"></i>
                                                                </a>
                                                                <a href="<?php echo base_url(); ?>student/doc_delete/<?php echo $value['id'] . "/" . $value['student_id']; ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                                    <i class="fa fa-remove"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                    </table>
                                </div>  
                            </div>
                            </table>
                        </div>  

                        <div class="tab-pane" id="timelineh">
                            <div>   <?php if ($this->rbac->hasPrivilege('student_timeline', 'can_add')) { ?>
                                    <input type="button" id="myTimelineButton"  class="btn btn-sm btn-primary pull-right " value="<?php echo $this->lang->line('add') ?>" /> 

                                <?php } ?> 
                            </div>


                            <br/>
                            <div class="timeline-header no-border">
                                <div id="timeline_list">
                                    <?php
                                    if (empty($timeline_list)) {
                                        ?>
                                        <br/>
                                        <div class="alert alert-info"><?php echo $this->lang->line("no_record_found") ?></div>



                                    <?php } else {
                                        ?>

                                        <ul class="timeline timeline-inverse">
                                            <?php
                                            foreach ($timeline_list as $key => $value) {
                                                ?>      
                                                <li class="time-label">
                                                    <span class="bg-blue">    <?php
                                                        echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($value['timeline_date']));
                                                        ?></span>
                                                </li> 
                                                <li>
                                                    <i class="fa fa-list-alt bg-blue"></i>
                                                    <div class="timeline-item">
                                                        <?php if ($this->rbac->hasPrivilege('student_timeline', 'can_delete')) { ?>
                                                            <span class="time"><a class="defaults-c text-right" data-toggle="tooltip" title="" onclick="delete_timeline('<?php echo $value['id']; ?>')" data-original-title="Delete"><i class="fa fa-trash"></i></a></span>
                                                        <?php } ?>
                                                        <?php if (!empty($value["document"])) { ?>
                                                            <span class="time"><a class="defaults-c text-right" style="color:#0084B4"  data-toggle="tooltip" title="" href="<?php echo base_url() . "admin/timeline/download/" . $value["id"] . "/" . $value["document"] ?>" data-original-title="Download"><i class="fa fa-download"></i></a></span>
                                                        <?php } ?>
                                                        <h3 class="timeline-header text-aqua"> <?php echo $value['title']; ?> </h3>
                                                        <div class="timeline-body">
                                                            <?php echo $value['description']; ?> 

                                                        </div>

                                                    </div>
                                                </li>

                                            <?php } ?>    
                                            <li><i class="fa fa-clock-o bg-gray"></i></li>       
                                        <?php } ?>
                                    </ul>
                                </div>


 <!-- <h2 class="page-header"><?php //echo $this->lang->line('documents');               ?> <?php //echo $this->lang->line('list');               ?></h2> -->

                            </div>

                        </div>  

                        <div class="tab-pane" id="exam">

                            <div class="examgroup_result1"> </div>  

                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
<script type="text/javascript">
    $("#myTimelineButton").click(function () {
        $("#reset").click();
        $('.transport_fees_title').html("<b><?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('timeline'); ?></b>");
        $('#myTimelineModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true

        });
    });
    $(".myTransportFeeBtn").click(function () {
        $("span[id$='_error']").html("");
        $('#transport_amount').val("");
        $('#transport_amount_discount').val("0");
        $('#transport_amount_fine').val("0");
        var student_session_id = $(this).data("student-session-id");
        $('.transport_fees_title').html("<b>Upload Document</b>");
        $('#transport_student_session_id').val(student_session_id);
        $('#myTransportFeesModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true

        });
    });



</script>
<div class="modal fade" id="myTimelineModal" role="dialog">
    <div class="modal-dialog modal-sm400">      
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title title transport_fees_title"></h4>
            </div>
            <div class="">
                <div class="">
                   

                    <form  id="timelineform" name="timelineform" method="post"  enctype="multipart/form-data">
                         <div class="modal-body pt0 pb0">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div id='timeline_hide_show' class="row">                                                    
                                <input type="hidden" name="student_id" value="<?php echo $student["id"] ?>" id="student_id">
                                
                                <div class=" col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('title'); ?></label><small class="req"> *</small>
                                        <input id="timeline_title" name="timeline_title" placeholder="" type="text" class="form-control"  />
                                        <span class="text-danger"><?php echo form_error('timeline_title'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('date'); ?></label><small class="req"> *</small>
                                        <input id="timeline_date" value="<?php echo set_value('timeline_date', date($this->customlib->getSchoolDateFormat())); ?>" name="timeline_date" placeholder="" type="text" class="form-control"  />
                                        <span class="text-danger"><?php echo form_error('timeline_date'); ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>
                                        <textarea id="timeline_desc" name="timeline_desc" placeholder=""  class="form-control"></textarea>
                                        <span class="text-danger"><?php echo form_error('description'); ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('attach_document'); ?></label>
                                        <div class=""><input id="timeline_doc_id" name="timeline_doc" placeholder="" type="file"  class="filestyle form-control" data-height="40"  value="<?php echo set_value('timeline_doc'); ?>" />
                                            <span class="text-danger"><?php echo form_error('timeline_doc'); ?></span></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="labeltopmb0"><?php echo $this->lang->line('visible'); ?></label>
                                        <input id="visible_check" checked="checked" name="visible_check" value="yes" placeholder="" type="checkbox"   />

                                    </div>
                                </div>
                              </div>
                            </div>  
                              <div class="modal-footer">
                                <button type="submit"  class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                                <button type="reset" id="reset" style="display: none"  class="btn btn-info pull-right">Reset</button>
                            </div>  
                            
                           
                        </form>
                                     
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myTransportFeesModal" role="dialog">
    <div class="modal-dialog modal-sm400">      
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title title text-center transport_fees_title"></h4>
            </div>
            <div class="">
                <div class="">
                    <div class="">
                        <input  type="hidden" class="form-control" id="transport_student_session_id"  value="0" readonly="readonly"/>
                        <form id="form1" action="<?php echo site_url('student/create_doc') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                            <?php echo $this->customlib->getCSRF(); ?>
                         <div class="modal-body pt0 pb0">   
                            <div id='upload_documents_hide_show'>                                                    
                                <input type="hidden" name="student_id" value="<?php echo $student_doc_id; ?>" id="student_id">
                                <h4><?php echo $this->lang->line('upload_documents1'); ?></h4>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('title'); ?><small class="req" > *</small></label>
                                        <input id="first_title" name="first_title" placeholder="" type="text" class="form-control"  value="<?php echo set_value('first_title'); ?>" />
                                        <span class="text-danger"><?php echo form_error('first_title'); ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('documents'); ?><small class="req" > *</small></label>
                                        <div class=""><input id="first_doc_id" name="first_doc" placeholder="" type="file"  class="filestyle form-control" data-height="40"  value="<?php echo set_value('first_doc'); ?>" />
                                            <span class="text-danger"><?php echo form_error('first_doc'); ?></span></div>
                                    </div>

                                
                            </div>
                         </div>  
                            <div class="modal-footer" style="clear:both">
                                <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php //echo $this->lang->line('cancel'); ?></button> -->
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>

                        </form>
                    </div>                 
                </div>
            </div>
        </div>
    </div>
</div>

<div id="scheduleModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title_logindetail"></h4>
            </div>
            <div class="modal-body_logindetail">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="disable_modal" tabindex="-1" role="dialog" aria-labelledby="evaluation" style="padding-left: 0 !important">
    <div class="modal-dialog " role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="box-title" ><?php echo $this->lang->line('disable') . " " . $this->lang->line('student') ?></h4>
            </div>
            <form role="form" id="disable_form" method="post" enctype="multipart/form-data" action="">

                <div class="modal-body pt0 pb0" >
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 paddlr">
                            <div class="row">

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('reason'); ?></label><small class="req"> *</small>
                                        <input type="hidden" name="student_id" id="disstudent_id" >
                                        <select class="form-control" name="reason">
                                            <option value=""><?php echo $this->lang->line('select') ?></option>
                                            <?php
                                            foreach ($reason as $value) {
                                                ?>
                                                <option value="<?php echo $value['id'] ?>"><?php echo $value['reason'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('note'); ?></label>
                                        <textarea name="note" class="form-control"></textarea>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="box-footer">

                    <div class="pull-right paddA10">
                        <button class="btn btn-info pull-right"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please wait" value=""><?php echo $this->lang->line('save'); ?></button>

                    </div>
            </form>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">



    $(document).ready(function (e) {

        $("#timelineform").on('submit', (function (e) {
            var student_id = $("#student_id").val();

            e.preventDefault();
            $.ajax({
                url: "<?php echo site_url("admin/timeline/add") ?>",
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {

                    if (data.status == "fail") {

                        var message = "";
                        $.each(data.error, function (index, value) {

                            message += value;
                        });
                        errorMsg(message);
                    } else {

                        successMsg(data.message);

                        $.ajax({
                            url: '<?php echo base_url(); ?>admin/timeline/student_timeline/' + student_id,
                            success: function (res) {
                                $('#timeline_list').html(res);

                                $('#myTimelineModal').modal('toggle');
                            },
                            error: function () {
                                alert("Fail")
                            }
                        });
                        window.location.reload(true);
                    }

                },
                error: function (e) {
                    alert("Fail");
                    console.log(e);
                }
            });


        }));
    });

    function delete_timeline(id) {

        var student_id = $("#student_id").val();
        if (confirm('<?php echo $this->lang->line("delete_confirm") ?>')) {

            $.ajax({
                url: '<?php echo base_url(); ?>admin/timeline/delete_timeline/' + id,
                success: function (res) {
                    $.ajax({
                        url: '<?php echo base_url(); ?>admin/timeline/student_timeline/' + student_id,
                        success: function (res) {
                            $('#timeline_list').html(res);

                        },
                        error: function () {
                            alert("Fail")
                        }
                    });

                },
                error: function () {
                    alert("Fail")
                }
            });
        }

    }

    function disable_student(id) {
        if (confirm("Are you sure you want to disable this record.")) {
            $('#disstudent_id').val(id);
            $('#disable_modal').modal('show');
        }
    }

    $("#disable_form").on('submit', (function (e) {
        e.preventDefault();
        var id = $('#disstudent_id').val();
        var $this = $(this).find("button[type=submit]:focus");

        $.ajax({
            url: "<?php echo site_url("student/disable_reason") ?>",
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $this.button('loading');

            },
            success: function (res)
            {

                if (res.status == "fail") {

                    var message = "";
                    $.each(res.error, function (index, value) {

                        message += value;
                    });
                    errorMsg(message);

                } else {

                    successMsg(res.message);

                    window.location.reload(true);
                }
            },
            error: function (xhr) { // if error occured
                alert("Error occured.please try again");
                $this.button('reset');
            },
            complete: function () {
                $this.button('reset');
            }

        });
    }));
    function disable(id) {


        if (confirm("Are you sure you want to disable this record.")) {
            var student_id = '<?php echo $student["id"] ?>';
            $.ajax({
                type: "post",
                url: base_url + "student/getUserLoginDetails",
                data: {'student_id': student_id},
                dataType: "json",
                success: function (response) {

                    var userid = response.id;



                    changeStatus(userid, 'no', 'student');

                }
            });

        } else {
            return false;
        }

    }

    function enable(id, status, role) {
        if (confirm("Are you sure you want to enable this record.")) {
            var student_id = '<?php echo $student["id"] ?>';
          
            $.ajax({
                type: "post",
                url: base_url + "student/getUserLoginDetails",
                data: {'student_id': student_id},
                dataType: "json",
                success: function (response) {
                    
                    var userid = response.id;



                    changeStatus(userid, 'yes', 'student');
                   

                }
            });

             $.ajax({
                type: "post",
                url: base_url + "student/enablestudent/"+student_id,
                data: {'student_id': student_id},
                dataType: "json",
                success: function (data) {
    
                 window.location.reload(true);

                }
            });
            
            
            
        } else {
            return false;
        }

    }

    function changeStatus(rowid, status = 'no', role = 'student') {

         
        var base_url = '<?php echo base_url() ?>';

        $.ajax({
            type: "POST",
            url: base_url + "admin/users/changeStatus",
            data: {'id': rowid, 'status': status, 'role': role},
            dataType: "json",
            success: function (data) {
                successMsg(data.msg);
            }
        });
    }
    $(document).ready(function () {
        $.extend($.fn.dataTable.defaults, {
            searching: false,
            ordering: false,
            paging: false,
            bSort: false,
            info: false
        });
    });

    function send_password() {
        var base_url = '<?php echo base_url() ?>';
        var student_id = '<?php echo $student['id']; ?>';
        var username = '<?php echo $student['username']; ?>';
        var password = '<?php echo $student['password']; ?>';
        var contact_no = '<?php echo $student['mobileno']; ?>';
        var email = '<?php echo $student['email']; ?>';
        //alert(student_id);
        $.ajax({
            type: "post",
            url: base_url + "student/sendpassword",
            data: {student_id: student_id, username: username, password: password, contact_no: contact_no, email: email},
            // dataType: "json",
            success: function (response) {
                successMsg('<?php echo $this->lang->line('message_successfully_sent');?>');
            }
        });

    }

    function send_parent_password() {
        var base_url = '<?php echo base_url() ?>';
        var student_id = '<?php echo $student['id']; ?>';
        var username = '<?php echo $guardian_credential['username']; ?>';
        var password = '<?php echo $guardian_credential['password']; ?>';
        var contact_no = '<?php echo $student['guardian_phone']; ?>';
        var email = '<?php echo $student['guardian_email']; ?>';
        //alert(student_id);
        $.ajax({
            type: "post",
            url: base_url + "student/send_parent_password",
            data: {student_id: student_id, username: username, password: password, contact_no: contact_no, email: email},
            // dataType: "json",
            success: function (response) {
                successMsg('<?php echo $this->lang->line('message_successfully_sent');?>');
            }
        });
    }


    $(document).on('click', '.schedule_modal', function () {
        $('.modal-title_logindetail').html("");
        $('.modal-title_logindetail').html("<?php echo $this->lang->line('login_details'); ?>");
        var base_url = '<?php echo base_url() ?>';
        var student_id = '<?php echo $student["id"] ?>';
        var student_first_name = '<?php echo $student["firstname"] ?>';
        var student_last_name = '<?php echo $student["lastname"] ?>';
        $.ajax({
            type: "post",
            url: base_url + "student/getlogindetail",
            data: {'student_id': student_id},
            dataType: "json",
            success: function (response) {
                var data = "";
                data += '<div class="col-md-12">';
                data += '<div class="table-responsive">';
                data += '<p class="lead text text-center">' + student_first_name + ' ' + student_last_name + '</p>';
                data += '<table class="table table-hover">';
                data += '<thead>';
                data += '<tr>';
                data += '<th>' + "<?php echo $this->lang->line('user_type'); ?>" + '</th>';
                data += '<th class="text text-center">' + "<?php echo $this->lang->line('username'); ?>" + '</th>';
                data += '<th class="text text-center">' + "<?php echo $this->lang->line('password'); ?>" + '</th>';
                data += '</tr>';
                data += '</thead>';
                data += '<tbody>';
                $.each(response, function (i, obj)
                {
                    data += '<tr>';
                    data += '<td><b>' + firstToUpperCase(obj.role) + '</b></td>';
                    data += '<input type=hidden name=userid id=userid value=' + obj.id + '>';
                    data += '<td class="text text-center">' + obj.username + '</td> ';
                    data += '<td class="text text-center">' + obj.password + '</td> ';
                    data += '</tr>';
                });
                data += '</tbody>';
                data += '</table>';
                data += '<b class="lead text text-danger" style="font-size:14px;"> ' + "<?php echo $this->lang->line('login_url'); ?>" + ': ' + base_url + 'site/userlogin</b>';
                data += '</div>  ';
                data += '</div>  ';
                $('.modal-body_logindetail').html(data);
                $("#scheduleModal").modal('show');
            }
        });
    });

    function firstToUpperCase(str) {
        return str.substr(0, 1).toUpperCase() + str.substr(1);
    }

    $(document).ready(function () {
        getExamResult();
        $('.detail_popover').popover({
            placement: 'right',
            title: '',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';

        $("#timeline_date").datepicker({
            format: date_format,
            autoclose: true

        });
    });
    function getExamResult(student_session_id) {
        if (student_session_id != "") {
            $('.examgroup_result').html("");


            $.ajax({
                type: "POST",
                url: baseurl + "admin/examresult/getStudentCurrentResult",
                data: {'student_session_id': 17},
                dataType: "JSON",
                beforeSend: function () {

                },
                success: function (data) {


                    $('.examgroup_result').html(data.result);
                },
                complete: function () {

                }
            });
        }
    }
</script>

<script type="text/javascript">

    $(document).on('change', '#exam_group_id', function () {
        var exam_group_id = $(this).val();
        if (exam_group_id != "") {
            $('#exam_id').html("");

            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "POST",
                url: baseurl + "admin/examgroup/getExamsByExamGroup",
                data: {'exam_group_id': exam_group_id},
                dataType: "JSON",
                beforeSend: function () {
                    $('#exam_id').addClass('dropdownloading');
                },
                success: function (data) {
                    console.log(data);
                    $.each(data.result, function (i, obj)
                    {

                        div_data += "<option value=" + obj.id + ">" + obj.exam + "</option>";
                    });
                    $('#exam_id').append(div_data);
                },
                complete: function () {
                    $('#exam_id').removeClass('dropdownloading');
                }
            });
        }
    });

// this is the id of the form
    $("form#form_examgroup").submit(function (e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);
        var url = form.attr('action');
        var submit_button = $("button[type=submit]");
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'JSON',
            data: form.serialize(), // serializes the form's elements.
            beforeSend: function () {
                submit_button.button('loading');
            },
            success: function (data)
            {

                $('.examgroup_result').html(data.result);
            },
            error: function (xhr) { // if error occured
                alert("Error occured.please try again");
                submit_button.button('reset');
            },
            complete: function () {
                submit_button.button('reset');
            }
        });

 
    });
                        $(document).ready(function (e) {

                                            $("#form1").on('submit', (function (e) {

                                                e.preventDefault();
                                                $.ajax({
                                                    url: "<?php echo site_url("student/create_doc") ?>",
                                                    type: "POST",
                                                    data: new FormData(this),
                                                    dataType: 'json',
                                                    contentType: false,
                                                    cache: false,
                                                    processData: false,
                                                    success: function (res)
                                                    {

                                                        if (res.status == "fail") {

                                                            var message = "";
                                                            $.each(res.error, function (index, value) {

                                                                message += value;
                                                            });
                                                            errorMsg(message);

                                                        } else {

                                                            successMsg(res.message);

                                                            window.location.reload(true);
                                                        }
                                                    }
                                                });

                                            }));

                                        });
</script>