<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
// echo "<pre>";
// print_r($student);
// echo "<pre>";die;
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('student_information'); ?> <small><?php echo $this->lang->line('student1'); ?></small></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="">

                        <div class="pull-right box-tools">
                        </div>
                    </div>
                    <form action="<?php echo site_url("student/edit/" . $id) ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="tshadow mb25 bozero"> 
                                <h3 class="pagetitleh2"> <?php echo $this->lang->line('edit'); ?> <?php echo $this->lang->line('student'); ?></h3>
                                <div class="around10">
                                    <?php if ($this->session->flashdata('msg')) { ?>
                                        <?php echo $this->session->flashdata('msg') ?>
                                    <?php } ?>
                                    <?php echo $this->customlib->getCSRF(); ?>
                                    <input type="hidden" name="student_id" value="<?php echo set_value('id', $student['id']); ?>">
                                    <input type="hidden" name="sibling_name" value="<?php echo set_value('sibling_name', 0); ?>" id="sibling_name_next">
                                    <input type="hidden" name="sibling_id" value="<?php echo set_value('sibling_id', 0); ?>" id="sibling_id">
                                    <div class="row">
									 <?php if (!$adm_auto_insert) {  ?>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('admission_no'); ?></label><small class="req"> *</small>
                                                <input autofocus="" id="admission_no" name="admission_no" placeholder="" type="text" class="form-control"  value="<?php echo set_value('admission_no', $student['admission_no']); ?>" />
                                                <span class="text-danger"><?php echo form_error('admission_no'); ?></span>
                                            </div>
                                        </div>
									 <?php } if ($sch_setting->roll_no) {  ?>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('roll_no'); ?></label>
                                                <input id="roll_no" name="roll_no" placeholder="" type="text" class="form-control"  value="<?php echo set_value('roll_no', $student['roll_no']); ?>" />
                                                <span class="text-danger"><?php echo form_error('roll_no'); ?></span>
                                            </div>
                                        </div>
										<?php } ?>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
                                                <select  id="class_id" name="class_id" class="form-control" >
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    <?php
                                                    foreach ($classlist as $class) {
                                                        ?>
                                                        <option value="<?php echo $class['id'] ?>" <?php
                                                        if ($student['class_id'] == $class['id']) {
                                                            echo "selected =selected";
                                                        }
                                                        ?>><?php echo $class['class'] ?></option>
                                                                <?php
                                                                $count++;
                                                            }
                                                            ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label><small class="req"> *</small>
                                                <select  id="section_id" name="section_id" class="form-control" >
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                            </div>
                                        </div>
                                     
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('first_name'); ?></label><small class="req"> *</small>
                                                <input id="firstname" name="firstname" placeholder="" type="text" class="form-control"  value="<?php echo set_value('firstname', $student['firstname']); ?>" />
                                                <input type="hidden" name="studentid" value="<?php echo $student["id"] ?>">
                                                <span class="text-danger"><?php echo form_error('first_name'); ?></span>
                                            </div>
                                        </div>
										<?php if ($sch_setting->lastname) {  ?>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('last_name'); ?></label>
                                                <input id="lastname" name="lastname" placeholder="" type="text" class="form-control"  value="<?php echo set_value('lastname', $student['lastname']); ?>" />
                                                <span class="text-danger"><?php echo form_error('lastname'); ?></span>
                                            </div>
                                        </div>
										<?php } ?>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputFile"> <?php echo $this->lang->line('gender'); ?> </label><small class="req"> *</small>
                                                <select class="form-control" name="gender">
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    <?php
                                                    foreach ($genderList as $key => $value) {
                                                        ?>
                                                        <option  value="<?php echo $key; ?>" <?php if ($student['gender'] == $key) echo "selected"; ?>><?php echo $value; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('gender'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('date_of_birth'); ?></label><small class="req"> *</small>
                                                <input id="dob" name="dob" placeholder="" type="text" class="form-control date"  value="<?php echo set_value('dob', date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['dob']))); ?>" />
                                                <span class="text-danger"><?php echo form_error('dob'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
										<?php if ($sch_setting->category) {  ?>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('category'); ?></label>
                                                <select  id="category_id" name="category_id" class="form-control" >
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    <?php
                                                    foreach ($categorylist as $category) {
                                                        ?>
                                                        <option value="<?php echo $category['id'] ?>" <?php if ($student['category_id'] == $category['id']) echo "selected =selected" ?>><?php echo $category['category']; ?></option>
                                                        <?php
                                                        $count++;
                                                    }
                                                    ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('category_id'); ?></span>
                                            </div>
                                        </div>
										<?php } if ($sch_setting->religion) {  ?>
										<div class="col-md-2">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('religion'); ?></label>
                                                <input id="religion" name="religion" placeholder="" type="text" class="form-control"  value="<?php echo set_value('religion', $student['religion']); ?>" />
                                                <span class="text-danger"><?php echo form_error('religion'); ?></span>
                                            </div>
                                        </div>
										<?php } if ($sch_setting->cast) {  ?>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('cast'); ?></label>
                                                <input id="cast" name="cast" placeholder="" type="text" class="form-control"  value="<?php echo set_value('cast', $student['cast']); ?>" />
                                                <span class="text-danger"><?php echo form_error('cast'); ?></span>
                                            </div>
                                        </div>
                                        <?php } if ($sch_setting->mobile_no) {  ?>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('mobile_no'); ?></label>
                                                <input id="mobileno" name="mobileno" placeholder="" type="text" class="form-control"  value="<?php echo set_value('mobileno', $student['mobileno']); ?>" />
                                                <span class="text-danger"><?php echo form_error('mobileno'); ?></span>
                                            </div>
                                        </div>
										<?php } if ($sch_setting->student_email) {  ?>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('email'); ?></label>
                                                <input id="email" name="email" placeholder="" type="text" class="form-control"  value="<?php echo set_value('email', $student['email']); ?>" />
                                                <span class="text-danger"><?php echo form_error('email'); ?></span>
                                            </div>
                                        </div>
										<?php } ?>
                                    </div>
                                    <div class="row">
										<?php if ($sch_setting->admission_date) {  ?>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('admission_date'); ?></label>
                                                <input id="admission_date" name="admission_date" placeholder="" type="text" class="form-control date"  value="<?php echo set_value('admission_date', date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['admission_date']))); ?>" readonly="readonly" />
                                                <span class="text-danger"><?php echo form_error('admission_date'); ?></span>
                                            </div>
                                        </div>
										<?php }  if ($sch_setting->student_photo) {  ?>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputFile"><?php echo $this->lang->line('student'). "  " . $this->lang->line('photo'); ?></label>
                                                <input class="filestyle form-control" type='file' name='file' id="file" size='20' />
                                            </div>
                                            <span class="text-danger"><?php echo form_error('file'); ?></span>
                                        </div>
										<?php } if ($sch_setting->is_blood_group) {  ?>
                                        <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('blood_group'); ?></label>
                                                           <?php


                                                            ?>
                                                            <select class="form-control" rows="3" placeholder="" name="blood_group">
                                                                <option value=""><?php echo $this->lang->line('select') ?></option>
                                                                <?php foreach ($bloodgroup as $bgkey => $bgvalue) {
                                                                    ?>
                                                         <option value="<?php echo $bgvalue ?>" <?php if($bgvalue == $student["blood_group"]){ echo "selected"; } ?>><?php echo $bgvalue ?></option>           

                                                               <?php } ?>
                                                            </select>

                                                            <span class="text-danger"><?php echo form_error('house'); ?></span>
                                                        </div>
                                                    </div>
													<?php } if ($sch_setting->is_student_house) { ?>
                                         <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('house') ?></label>
                                                            <select class="form-control" rows="3" placeholder="" name="house">
                                                                <option value=""><?php echo $this->lang->line('select') ?></option>
                                                                <?php foreach ($houses as $hkey => $hvalue) {
                                                                    ?>
                                                         <option value="<?php echo $hvalue["id"] ?>" <?php if($hvalue["id"] == $student["school_house_id"]){ echo "selected" ; } ?> ><?php echo $hvalue["house_name"] ?></option>           

                                                               <?php } ?>
                                                            </select>
                                                            <span class="text-danger"><?php echo form_error('house'); ?></span>
                                                        </div>
                                                    </div>

													<?php } if ($sch_setting->student_height) {  ?>
                                                    <div class="col-md-3 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('height'); ?></label>
                                                           <?php


                                                            ?>
                                                           <input type="text" value="<?php echo $student["height"] ?>" name="height" class="form-control" value="<?php echo set_value('height', $student['height']); ?>">
                                                            <span class="text-danger"><?php echo form_error('height'); ?></span>
                                                        </div>
                                                    </div>
													<?php } if ($sch_setting->student_weight) {  ?>
                                                    <div class="col-md-3 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('weight'); ?></label>
                                                           <?php


                                                            ?>
                                                           <input type="text" value="<?php echo $student["weight"] ?>" name="weight" class="form-control" value="<?php echo set_value('weight', $student['weight']); ?>">
                                                            <span class="text-danger"><?php echo form_error('height'); ?></span>
                                                        </div>
                                                    </div>
													<?php } if ($sch_setting->measurement_date) { ?>
                                                    <div class="col-md-3 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('measurement_date'); ?></label>                       

 <input id="measure_date" name="measure_date" placeholder="" type="text" class="form-control date"  value="<?php echo set_value('measure_date', date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['measurement_date']))); ?>" readonly="readonly"/>
                                                            <span class="text-danger"><?php echo form_error('measure_date'); ?></span>
                                                        </div>
                                                    </div>
													<?php } ?>
                                        <div class="col-md-3 pt25">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <button type="button" class="btn btn-sm btn-primary mysiblings anchorbtn "><i class="fa fa-plus"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('sibling'); ?></button>
                                                </div> 
                                                <div class="col-md-6">
                                                    <div class="pt6">
                                                        <span id="sibling_name" class="label label-success "><?php echo set_value('sibling_name'); ?></span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="row">
                                     
                                    <?php 
                                      echo display_custom_fields('students',$student['id']);
                                     ?>
                                 </div>
                                </div>  
                            </div>   


                            <?php
                            if (!empty($siblings)) {
                                ?>
                                <div class="tshadow mb25 bozero sibling_div relative">  
                                    <h3 class="pagetitleh2"><?php echo $this->lang->line('sibling'); ?></h3>
                                    <div class="box-tools sibbtnposition">
                                        <button type="button" class="btn btn-primary btn-sm remove_sibling"><?php echo $this->lang->line('remove'); ?> <?php echo $this->lang->line('sibling'); ?>
                                        </button>

                                    </div>


                                    <div class="around10">           
                                        <div class="row">
                                            <input type="hidden" name="siblings_counts" class="siblings_counts" value="<?php echo $siblings_counts; ?>">
                                            <?php
                                            if (empty($siblings)) {
                                                
                                            } else {

                                                foreach ($siblings as $sibling_key => $sibling_value) {
                                                
                                                    ?>
                                                    <div class="col-xs-12 col-sm-6 col-md-4 sib_div" id="sib_div_<?php echo $sibling_value->id ?>" data-sibling_id="<?php echo $sibling_value->id ?>">
                                                        <div class="withsiblings">
                                                            <img src="<?php echo base_url() . $sibling_value->image ?>" alt="" class="" /> 
                                                            <div class="withsiblings-content">
                                                                <h5><a href="#"><?php echo $sibling_value->firstname . " " . $sibling_value->lastname ?></a></h5>

                                                                <p>
                                                                    <b><?php echo $this->lang->line('admission_no'); ?></b>:<?php echo $sibling_value->admission_no; ?><br />
                                                                    <b><?php echo $this->lang->line('class'); ?></b>:<?php echo $sibling_value->class; ?><br />
                                                                    <b><?php echo $this->lang->line('section'); ?></b>:<?php echo $sibling_value->section; ?>

                                                                </p>

                                                                <!-- Split button -->

                                                            </div>

                                                        </div>
                                                    </div>

                                                    <?php
                                                }
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </div> 

                                <?php
                            }
                            ?>
				<?php if ($sch_setting->route_list) { ?>
                            <?php 

  if($this->module_lib->hasActive('transport')){
          ?>
                            <div class="tshadow mb25 bozero">  
                                <h3 class="pagetitleh2">
                                    <?php echo $this->lang->line('transport') . " " . $this->lang->line('details'); ?>
                                </h3>

                                <div class="around10">           
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">
                                                    <?php echo $this->lang->line('route_list'); ?>
                                                </label>
                                                <select class="form-control" name="vehroute_id" id="vehroute_id">


                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    <?php
                                                    foreach ($vehroutelist as $vehroute) {
                                                        ?>
                                                        <optgroup label=" <?php echo $vehroute->route_title; ?>">
                                                            <?php
                                                            $vehicles = $vehroute->vehicles;
                                                            if (!empty($vehicles)) {
                                                                foreach ($vehicles as $key => $value) {

                                                                    $st = set_value('vehroute_id', $student['vehroute_id']) == $value->vec_route_id ? TRUE : FALSE;
                                                                    ?>

                                                                    <option value="<?php echo $value->vec_route_id ?>" <?php echo set_select('vehroute_id', $value->vec_route_id, $st); ?> data-fee="<?php echo $vehroute->fare; ?>">
                                                                        <?php echo $value->vehicle_no ?> 
                                                                    </option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </optgroup>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('transport_fees'); ?></span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>  
                        <?php } ?> <?php }?>
						<?php if ($sch_setting->hostel_id) { ?>
                            <?php 

  if($this->module_lib->hasActive('hostel')){
          ?>
                            <div class="tshadow mb25 bozero">  
                                <h3 class="pagetitleh2">
                                    <?php echo $this->lang->line('hostel'); ?></label> <?php echo $this->lang->line('details'); ?></label>
                                </h3>

                                <div class="around10">           
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('hostel'); ?></label>

                                                <select class="form-control" id="hostel_id" name="hostel_id">

                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    <?php
                                                    foreach ($hostelList as $hostel_key => $hostel_value) {
                                                        ?>


                                                        <option value="<?php echo $hostel_value['id'] ?>" <?php
                                                        echo set_value('hostel_id', $student['hostel_id']) == $hostel_value['id'] ? "selected='selected'" : "";
                                                        ?>>
                                                                    <?php echo $hostel_value['hostel_name']; ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('hostel_id'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('room_no'); ?></label>
                                                <select  id="hostel_room_id" name="hostel_room_id" class="form-control" >
                                                    <option value=""   ><?php echo $this->lang->line('select'); ?></option>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('hostel_room_id'); ?></span>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>  
                        <?php } ?>
                        <?php } ?>
                            <div class="tshadow mb25 bozero">    
                                <h4 class="pagetitleh2"><?php echo $this->lang->line('parent_guardian_detail'); ?></h4>

                                <div class="around10">  
                                    <div class="row">
										<?php if ($sch_setting->father_name) {  ?>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('father_name'); ?></label>
                                                <input id="father_name" name="father_name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('father_name', $student['father_name']); ?>" />
                                                <span class="text-danger"><?php echo form_error('father_name'); ?></span>
                                            </div>
                                        </div>
										<?php } if ($sch_setting->father_phone) {  ?>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('phone'); ?> <?php echo $this->lang->line('no'); ?></label>
                                                <input id="father_phone" name="father_phone" placeholder="" type="text" class="form-control"  value="<?php echo set_value('father_phone', $student['father_phone']); ?>" />
                                                <span class="text-danger"><?php echo form_error('father_phone'); ?></span>
                                            </div>
                                        </div>
										<?php } if ($sch_setting->father_occupation) { ?>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('father_occupation'); ?></label>
                                                <input id="father_occupation" name="father_occupation" placeholder="" type="text" class="form-control"  value="<?php echo set_value('father_occupation', $student['father_occupation']); ?>" />
                                                <span class="text-danger"><?php echo form_error('father_occupation'); ?></span>
                                            </div>
                                        </div>
										<?php } if ($sch_setting->father_pic) { ?>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputFile"><?php echo $this->lang->line('father')." ". $this->lang->line('photo'); ?></label>
                                                <div><input class="filestyle form-control" type='file' name='father_pic' id="file" size='20' />
                                                </div>
                                                <span class="text-danger"><?php echo form_error('father_pic'); ?></span></div>
                                        </div>
										<?php } ?>

                                    </div>

                                    <div class="row">
										<?php if ($sch_setting->mother_name) { ?>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('mother_name'); ?></label>
                                                <input id="mother_name" name="mother_name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('mother_name', $student['mother_name']); ?>" />
                                                <span class="text-danger"><?php echo form_error('mother_name'); ?></span>
                                            </div>
                                        </div>
										<?php } if ($sch_setting->mother_phone) { ?>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('mother_phone'); ?></label>
                                                <input id="mother_phone" name="mother_phone" placeholder="" type="text" class="form-control"  value="<?php echo set_value('mother_phone', $student['mother_phone']); ?>" />
                                                <span class="text-danger"><?php echo form_error('mother_phone'); ?></span>
                                            </div>
                                        </div>
										<?php } if ($sch_setting->mother_occupation) { ?>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('mother_occupation'); ?></label>
                                                <input id="mother_occupation" name="mother_occupation" placeholder="" type="text" class="form-control"  value="<?php echo set_value('mother_occupation', $student['mother_occupation']); ?>" />
                                                <span class="text-danger"><?php echo form_error('mother_occupation'); ?></span>
                                            </div>
                                        </div>
										<?php } if ($sch_setting->mother_pic) { ?>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputFile"><?php echo $this->lang->line('mother')." ".$this->lang->line('photo'); ?></label>
                                                <div><input class="filestyle form-control" type='file' name='mother_pic' id="file" size='20' />
                                                </div>
                                                <span class="text-danger"><?php echo form_error('mother_pic'); ?></span></div>
                                        </div>
										<?php } ?>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label><?php echo $this->lang->line('if_guardian_is'); ?></label><small class="req"> *</small>&nbsp;&nbsp;&nbsp;
                                            <label class="radio-inline">
                                                <input type="radio" name="guardian_is"  <?php if ($student['guardian_is'] == "father") echo "checked"; ?> value="father" > <?php echo $this->lang->line('father'); ?>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="guardian_is" <?php if ($student['guardian_is'] == "mother") echo "checked"; ?> value="mother"> <?php echo $this->lang->line('mother'); ?>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="guardian_is" <?php if ($student['guardian_is'] == "other") echo "checked"; ?> value="other"> <?php echo $this->lang->line('other'); ?>
                                            </label>
                                              <span class="text-danger"><?php echo form_error('guardian_is'); ?></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('guardian_name'); ?></label><small class="req"> *</small>
                                                        <input id="guardian_name" name="guardian_name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('guardian_name', $student['guardian_name']); ?>" />
                                                        <span class="text-danger"><?php echo form_error('guardian_name'); ?></span>
                                                    </div>
                                                </div>
												<?php  if ($sch_setting->guardian_relation) { ?>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('guardian_relation'); ?></label>
                                                        <input id="guardian_relation" name="guardian_relation" placeholder="" type="text" class="form-control"  value="<?php echo set_value('guardian_relation', $student['guardian_relation']); ?>" />
                                                        <span class="text-danger"><?php echo form_error('guardian_relation'); ?></span>
                                                    </div>
                                                </div>
												<?php } ?>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('guardian_phone'); ?></label><small class="req"> *</small>
                                                        <input id="guardian_phone" name="guardian_phone" placeholder="" type="text" class="form-control"  value="<?php echo set_value('guardian_phone', $student['guardian_phone']); ?>" />
                                                        <span class="text-danger"><?php echo form_error('guardian_phone'); ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('guardian_occupation'); ?></label>
                                                        <input id="guardian_occupation" name="guardian_occupation" placeholder="" type="text" class="form-control"  value="<?php echo set_value('guardian_occupation', $student['guardian_occupation']); ?>" />
                                                        <span class="text-danger"><?php echo form_error('guardian_occupation'); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										<?php  if ($sch_setting->guardian_email) { ?>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('guardian_email'); ?></label>
                                                <input id="guardian_email" name="guardian_email" placeholder="" type="text" class="form-control"  value="<?php echo set_value('guardian_email', $student['guardian_email']); ?>" />
                                                <span class="text-danger"><?php echo form_error('guardian_email'); ?></span>
                                            </div>
                                          
                                        </div>
										<?php } if ($sch_setting->guardian_pic) { ?>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputFile"><?php echo $this->lang->line('guardian')." ".$this->lang->line('photo'); ?></label>
                                                <div><input class="filestyle form-control" type='file' name='guardian_pic' id="file" size='20' />
                                                </div>
                                                <span class="text-danger"><?php echo form_error('guardian_pic'); ?></span>
											</div>
                                        </div>
										<?php } if ($sch_setting->guardian_address) { ?>
                                        <div class="col-md-6">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('guardian_address'); ?></label>
                                            <textarea id="guardian_address" name="guardian_address" placeholder="" class="form-control" rows="4"><?php echo set_value('guardian_address', $student['guardian_address']); ?></textarea>
                                            <span class="text-danger"><?php echo form_error('guardian_address'); ?></span>
                                        </div>
										<?php } ?>
                                    </div>
                                </div>
                            </div> 
                            <div class="tshadow mb25 bozero">
                                <h3 class="pagetitleh2"><?php echo $this->lang->line('address_details'); ?></h3>
                                <div class="around10">  
                                    <div class="row">
										<?php if ($sch_setting->current_address) { ?>
                                        <div class="col-md-6">
                                            <label>
                                                <input type="checkbox" id="autofill_current_address" onclick="return auto_fill_guardian_address();">
                                                <?php echo $this->lang->line('if_guardian_address_is_current_address'); ?>
                                            </label>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('current_address'); ?></label>
                                                <textarea id="current_address" name="current_address" placeholder=""  class="form-control" ><?php echo set_value('current_address', $student['current_address']); ?></textarea>
                                                <span class="text-danger"><?php echo form_error('current_address'); ?></span>
                                            </div>
                                            <div class="checkbox">
                                            </div>
                                        </div>
										<?php } if ($sch_setting->permanent_address) { ?>
                                        <div class="col-md-6">
                                            <label>
                                                <input type="checkbox" id="autofill_address"onclick="return auto_fill_address();">
                                                <?php echo $this->lang->line('if_permanent_address_is_current_address'); ?>
                                            </label>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('permanent_address'); ?></label>
                                                <textarea id="permanent_address" name="permanent_address" placeholder="" class="form-control"><?php echo set_value('permanent_address', $student['permanent_address']) ?></textarea>
                                                <span class="text-danger"><?php echo form_error('permanent_address', $student['permanent_address']); ?></span>
                                            </div>
                                        </div>
										<?php } ?>
                                    </div>
                                </div>
                            </div>    
                            <div class="tshadow bozero">
                                <h3 class="pagetitleh2"><?php echo $this->lang->line('miscellaneous_details'); ?></h3>
                                <div class="around10">
									<?php if ($sch_setting->bank_account_no) { ?>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('bank_account_no'); ?></label>
                                                <input id="bank_account_no" name="bank_account_no" placeholder="" type="text" class="form-control"  value="<?php echo set_value('bank_account_no', $student['bank_account_no']); ?>" />
                                                <span class="text-danger"><?php echo form_error('bank_account_no'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('bank_name'); ?></label>
                                                <input id="bank_name" name="bank_name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('bank_name', $student['bank_name']); ?>" />
                                                <span class="text-danger"><?php echo form_error('bank_name'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('ifsc_code'); ?></label>
                                                <input id="ifsc_code" name="ifsc_code" placeholder="" type="text" class="form-control"  value="<?php echo set_value('ifsc_code', $student['ifsc_code']); ?>" />
                                                <span class="text-danger"><?php echo form_error('ifsc_code'); ?></span>
                                            </div>
                                        </div>
                                    </div>
									<?php } ?>
                                    <div class="row">
										<?php if ($sch_setting->national_identification_no) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">
                                                    <?php echo $this->lang->line('national_identification_no'); ?>
                                                </label>
                                                <input id="adhar_no" name="adhar_no" placeholder="" type="text" class="form-control"  value="<?php echo set_value('adhar_no', $student['adhar_no']); ?>" />
                                                <span class="text-danger"><?php echo form_error('adhar_no'); ?></span>
                                            </div>
                                        </div>
										<?php } if ($sch_setting->local_identification_no) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">
                                                    <?php echo $this->lang->line('local_identification_no'); ?>
                                                </label>
                                                <input id="samagra_id" name="samagra_id" placeholder="" type="text" class="form-control"  value="<?php echo set_value('samagra_id', $student['samagra_id']); ?>" />
                                                <span class="text-danger"><?php echo form_error('samagra_id'); ?></span>
                                            </div>
                                        </div>
										<?php } if ($sch_setting->rte) { ?>
                                        <div class="col-md-4">
                                            <label><?php echo $this->lang->line('rte'); ?></label>
                                            <div class="radio" style="margin-top: 2px;">
                                                <label><input class="radio-inline" type="radio" name="rte" value="Yes"  <?php
                                                    echo set_value('rte', $student['rte']) == "Yes" ? "checked" : "";
                                                    ?>  ><?php echo $this->lang->line('yes'); ?></label>
                                                <label><input class="radio-inline" type="radio" name="rte" value="No" <?php
                                                    echo set_value('rte', $student['rte']) == "No" ? "checked" : "";
                                                    ?>  ><?php echo $this->lang->line('no'); ?></label>
                                            </div>
                                            <span class="text-danger"><?php echo form_error('rte'); ?></span>
                                        </div>
										<?php } if ($sch_setting->previous_school_details) {  ?>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('previous_school_details'); ?></label>
                                                <textarea class="form-control" rows="3" placeholder="" name="previous_school"><?php echo set_value('previous_school', $student['previous_school']); ?></textarea>
                                                <span class="text-danger"><?php echo form_error('previous_school'); ?></span>
                                            </div>
                                        </div>
										<?php } if ($sch_setting->student_note) {  ?>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('note'); ?></label>
                                                <textarea class="form-control" rows="3" placeholder="" name="note"><?php echo set_value('note', $student['note']); ?></textarea>
                                                <span class="text-danger"><?php echo form_error('previous_school'); ?></span>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        
                                    </div>
                                </div>
                            </div>    
                            <div class="box-footer">

                              <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>
                    </form>
                </div>
            </div>
        </div> 
</div>
</section>
</div>
 
<script type="text/javascript">
    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
        var class_id = $('#class_id').val();
        var section_id = '<?php echo set_value('section_id', $student['section_id']) ?>';
        var hostel_id = $('#hostel_id').val();
        var hostel_room_id = '<?php echo set_value('hostel_room_id', $student['hostel_room_id']) ?>';
        getHostel(hostel_id, hostel_room_id);
        getSectionByClass(class_id, section_id, 'section_id');

        $(document).on('change', '#class_id', function (e) {
            $('#section_id').html("");
            var class_id = $(this).val();
            getSectionByClass(class_id, 0, 'section_id');
        });


        $(document).on('click', '#sibiling_class_id', function () {
            var class_id = $(this).val();
            getSectionByClass(class_id, 0, 'sibiling_section_id');
        });

       

        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });


        $(document).on('change', '#hostel_id', function (e) {
            var hostel_id = $(this).val();
            getHostel(hostel_id, 0);

        });

        $(document).on('change', '#sibiling_section_id', function (e) {
            getStudentsByClassAndSection();
        });

        function getStudentsByClassAndSection() {
            $('#sibiling_student_id').html("");
            var class_id = $('#sibiling_class_id').val();
            var section_id = $('#sibiling_section_id').val();
            var current_student_id = $('.current_student_id').val();
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';

            $.ajax({
                type: "GET",
                url: baseurl + "student/getByClassAndSectionExcludeMe",
                data: {'class_id': class_id, 'section_id': section_id,'current_student_id':current_student_id},
                dataType: "json",
                beforeSend: function () {
                    $('#sibiling_student_id').addClass('dropdownloading');
                },
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        var sel = "";
                        if (section_id == obj.section_id) {
                            sel = "selected=selected";
                        }
                        div_data += "<option value=" + obj.id + ">" + obj.firstname + " " + obj.lastname +" ("+obj.roll_no+") "+ "</option>";
                    });
                    $('#sibiling_student_id').append(div_data);
                },
                complete: function () {
                    $('#sibiling_student_id').removeClass('dropdownloading');
                }
            });

        }





        function getSectionByClass(class_id, section_id, select_control) {
            if (class_id != "") {
                $('#' + select_control).html("");
                var base_url = '<?php echo base_url() ?>';
                var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                $.ajax({
                    type: "GET",
                    url: base_url + "sections/getByClass",
                    data: {'class_id': class_id},
                    dataType: "json",
                    beforeSend: function () {
                        $('#' + select_control).addClass('dropdownloading');
                    },
                    success: function (data) {
                        $.each(data, function (i, obj)
                        {
                            var sel = "";
                            if (section_id == obj.section_id) {
                                sel = "selected";
                            }
                            div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
                        });
                        $('#' + select_control).append(div_data);
                    },
                    complete: function () {
                        $('#' + select_control).removeClass('dropdownloading');
                    }
                });
            }
        }


        function getHostel(hostel_id, hostel_room_id) {
            if (hostel_room_id == "") {
                hostel_room_id = 0;
            }

            if (hostel_id != "") {

                $('#hostel_room_id').html("");


                var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                $.ajax({
                    type: "GET",
                    url: baseurl + "admin/hostelroom/getRoom",
                    data: {'hostel_id': hostel_id},
                    dataType: "json",
                    beforeSend: function () {
                        $('#hostel_room_id').addClass('dropdownloading');
                    },
                    success: function (data) {
                        $.each(data, function (i, obj)
                        {
                            var sel = "";
                            if (hostel_room_id == obj.id) {
                                sel = "selected";
                            }

                            div_data += "<option value=" + obj.id + " " + sel + ">" + obj.room_no + " (" + obj.room_type + ")" + "</option>";

                        });
                        $('#hostel_room_id').append(div_data);
                    },
                    complete: function () {
                        $('#hostel_room_id').removeClass('dropdownloading');
                    }
                });
            }
        }

    });
    function auto_fill_guardian_address() {
        if ($("#autofill_current_address").is(':checked'))
        {
            $('#current_address').val($('#guardian_address').val());
        }
    }
    function auto_fill_address() {
        if ($("#autofill_address").is(':checked'))
        {
            $('#permanent_address').val($('#current_address').val());
        }
    }
    $('input:radio[name="guardian_is"]').change(
            function () {
                if ($(this).is(':checked')) {
                    var value = $(this).val();
                    if (value == "father") {
                        $('#guardian_name').val($('#father_name').val());
                        $('#guardian_phone').val($('#father_phone').val());
                        $('#guardian_occupation').val($('#father_occupation').val());
                        $('#guardian_relation').val("Father")
                    } else if (value == "mother") {
                        $('#guardian_name').val($('#mother_name').val());
                        $('#guardian_phone').val($('#mother_phone').val());
                        $('#guardian_occupation').val($('#mother_occupation').val());
                        $('#guardian_relation').val("Mother")
                    } else {
                        $('#guardian_name').val("");
                        $('#guardian_phone').val("");
                        $('#guardian_occupation').val("");
                        $('#guardian_relation').val("")
                    }
                }
            });

</script>


<div class="modal" id="mySiblingModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title modal_sibling_title"></h4>
            </div>

            <div class="modal-body modal_sibling_body">
                <div class="form-horizontal">
                   
                  
                    <div class="sibling_msg">

                    </div>
                    <input type="hidden" name="current_student_id" class="current_student_id" value="0">
                 <div class="col-lg-12">   
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label"><?php echo $this->lang->line('class'); ?></label>
                        <div class="col-sm-10">
                            <select  id="sibiling_class_id" name="sibiling_class_id" class="form-control"  >
                                <option value=""><?php echo $this->lang->line('select'); ?></option>
                                <?php
                                foreach ($classlist as $class) {
                                    ?>
                                    <option value="<?php echo $class['id'] ?>"<?php if (set_value('sibiling_class_id') == $class['id']) echo "selected=selected" ?>><?php echo $class['class'] ?></option>
                                    <?php
                                    $count++;
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label"><?php echo $this->lang->line('section'); ?></label>
                        <div class="col-sm-10">
                            <select  id="sibiling_section_id" name="sibiling_section_id" class="form-control" >
                                <option value=""   ><?php echo $this->lang->line('select'); ?></option>
                            </select>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label"><?php echo $this->lang->line('student'); ?>
                        </label>

                        <div class="col-sm-10">
                            <select  id="sibiling_student_id" name="sibiling_student_id" class="form-control" >
                                <option value=""   ><?php echo $this->lang->line('select'); ?></option>
                            </select>

                        </div>
                    </div>
                   
                  </div>
                </div>
            </div>
            <div class="modal-footer" style="clear: both;">
                <button type="button" class="btn btn-primary btn-sm add_sibling" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"><i class="fa fa-user"></i> <?php echo $this->lang->line('add'); ?></button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title del_modal_title"></h4>
            </div>
            <div class="modal-hidden">
                <input type="hidden" name="id" value="0" class="hd_input">
            </div>
            <div class="modal-body del_modal_body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary delete_confirm"><?php echo $this->lang->line('confirm'); ?></button>
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#deleteModal').on('shown.bs.modal', function () {
        console.log("srer");
        $(".del_modal_title").html("Delete Confirmation");
        $(".del_modal_body").html("<p>Are you sure you, want to remove sibling ?</p>");
    })

    $(document).on('click', '.remove_sibling', function () {
        $('#deleteModal').modal('show');
    });



    $(document).on('click', '.add_sibling', function () {
        var student_id = $('#sibiling_student_id').val();
        if (student_id.length == '') {


        } else {
            var $this = $(this);

            $.ajax({
                type: "GET",
                url: baseurl + "student/getStudentRecordByID",
                data: {'student_id': student_id},
                dataType: "json",
                beforeSend: function () {
                    $this.button('loading');
                },
                success: function (data) {
                    $('#sibling_name').text("Sibling: " + data.firstname + " " + data.lastname);
                    $('#sibling_name_next').val(data.firstname + " " + data.lastname);
                    $('#sibling_id').val(student_id);
                    $('#father_name').val(data.father_name);
                    $('#father_phone').val(data.father_phone);
                    $('#father_occupation').val(data.father_occupation);
                    $('#mother_name').val(data.mother_name);
                    $('#mother_phone').val(data.mother_phone);
                    $('#mother_occupation').val(data.mother_occupation);
                    $('#guardian_name').val(data.guardian_name);
                    $('#guardian_relation').val(data.guardian_relation);
                    $('#guardian_address').val(data.guardian_address);
                    $('#guardian_phone').val(data.guardian_phone);
                    $('#state').val(data.state);
                    $('#city').val(data.city);
                    $('#pincode').val(data.pincode);
                    $('#current_address').val(data.current_address);
                    $('#permanent_address').val(data.permanent_address);
                    $('#guardian_occupation').val(data.guardian_occupation);
                    $("input[name=guardian_is][value='" + data.guardian_is + "']").prop("checked", true);
                    $('#mySiblingModal').modal('hide');
                },
                complete: function () {
                    $this.button('reset');
                }
            });

        }

    });

    $(document).on('click', '.mysiblings', function () {
        $('#mySiblingModal').modal('show');

    });



    $('#mySiblingModal').on('shown.bs.modal', function () {
        $('.sibling_msg').html("");
        $('.modal_sibling_title').html('<b>' + "<?php echo $this->lang->line('sibling'); ?>" + '</b>');
        $('.current_student_id').val($("input[name='student_id']").val());
        if ($('.siblings_counts').length && $('.siblings_counts').val().length) {
            var msg = "";
            msg += "<div class='alert alert-danger'>";
            msg += "Please remove previous siblings";
            msg += "</div>";
            $('.sibling_msg').html(msg);
        } else {

        }

    });



    $(document).ready(function () {

        $('#mySiblingModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: false
        });

        $('#deleteModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: false
        });

        $(document).on('click', '.delete_confirm', function () {
            $('#deleteModal').modal('hide');
            $('.sibling_div').remove();
        });


    });
</script>



<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/js/savemode.js"></script>