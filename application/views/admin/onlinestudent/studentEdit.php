
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('student_information'); ?> <small><?php echo $this->lang->line('student1'); ?></small></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary border0">
                    
                    <form action="<?php echo site_url("admin/onlinestudent/edit/" . $id) ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        <div class="border0">

                          <input type="hidden" id="student_id" name="student_id" value="<?php echo set_value('id', $student['id']); ?>" />
                            <div class="bozero">
                                <h3 class="pagetitleh-whitebg"> <?php echo $this->lang->line('edit')." ".$this->lang->line('online')." ".$this->lang->line('admission');?></h3>
                                <div class="around10">
                                    <?php if ($this->session->flashdata('msg')) {?>
                                        <?php echo $this->session->flashdata('msg') ?>
                                    <?php }?>
                                    <?php echo $this->customlib->getCSRF(); ?>

                                    <div class="row">

                                        <?php 

if(!$adm_auto_insert){
    ?>

                                    <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('admission_no'); ?></label> <small class="req"> *</small> 
                                                
                                                <input autofocus="" id="admission_no" name="admission_no" placeholder="" type="text" class="form-control"  value="<?php echo set_value('admission_no'); ?>" />
                                                <span class="text-danger"><?php echo form_error('admission_no'); ?></span>
                                            </div>
                                        </div>
    
    <?php 
}

 ?>
                                       
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('roll_no'); ?></label>
                                                <input id="roll_no" name="roll_no" placeholder="" type="text" class="form-control"  value="<?php echo set_value('roll_no', $student['roll_no']); ?>" />
                                                <span class="text-danger"><?php echo form_error('roll_no'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
                                                <select  id="class_id" name="class_id" class="form-control" >
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    <?php
foreach ($classlist as $class) {
    ?>
   <option value="<?php echo $class['id'] ?>" <?php if ($student['class_id'] == $class['id']) {echo "selected =selected";}
    ?>><?php echo $class['class'] ?></option>
                                                                <?php }?>
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
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('last_name'); ?></label>
                                                <input id="lastname" name="lastname" placeholder="" type="text" class="form-control"  value="<?php echo set_value('lastname', $student['lastname']); ?>" />
                                                <span class="text-danger"><?php echo form_error('lastname'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputFile"> <?php echo $this->lang->line('gender'); ?> &nbsp;&nbsp;</label><small class="req"> *</small>
                                                <select class="form-control" name="gender">
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    <?php
foreach ($genderList as $key => $value) {
    ?>
                                                        <option  value="<?php echo $key; ?>" <?php
if ($student['gender'] == $key) {
        echo "selected";
    }
    ?>><?php echo $value; ?></option>
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
                                                <input id="dob" name="dob" placeholder="" type="text" class="form-control date"  value="<?php echo set_value('dob', $this->customlib->dateformat(($student['dob']))); ?>" readonly="readonly"/>
                                                <span class="text-danger"><?php echo form_error('dob'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('category'); ?></label>
                                                <select  id="category_id" name="category_id" class="form-control" >
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    <?php
foreach ($categorylist as $category) {
    ?>
                                                        <option value="<?php echo $category['id'] ?>" <?php
if ($student['category_id'] == $category['id']) {
        echo "selected =selected";
    }
    ?>><?php echo $category['category']; ?></option>
                                                                <?php

}
?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('category_id'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('cast'); ?></label>
                                                <input id="cast" name="cast" placeholder="" type="text" class="form-control"  value="<?php echo set_value('cast', $student['cast']); ?>" />
                                                <span class="text-danger"><?php echo form_error('cast'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('religion'); ?></label>
                                                <input id="religion" name="religion" placeholder="" type="text" class="form-control"  value="<?php echo set_value('religion', $student['religion']); ?>" />
                                                <span class="text-danger"><?php echo form_error('religion'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('mobile_no'); ?></label>
                                                <input id="mobileno" name="mobileno" placeholder="" type="text" class="form-control"  value="<?php echo set_value('mobileno', $student['mobileno']); ?>" />
                                                <span class="text-danger"><?php echo form_error('mobileno'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('email'); ?></label>
                                                <input id="email" name="email" placeholder="" type="text" class="form-control"  value="<?php echo set_value('email', $student['email']); ?>" />
                                                <span class="text-danger"><?php echo form_error('email'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('admission_date'); ?></label>
                                                <input id="admission_date" name="admission_date" placeholder="" type="text" class="form-control date"  value="<?php echo set_value('admission_date', $this->customlib->dateformat(($student['admission_date']))); ?>" readonly="readonly" />
                                                <span class="text-danger"><?php echo form_error('admission_date'); ?></span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('blood_group'); ?></label>
                                                <?php ?>
                                                <select class="form-control" rows="3" placeholder="" name="blood_group">
                                                    <option value=""><?php echo $this->lang->line('select') ?></option>
                                                    <?php foreach ($bloodgroup as $bgkey => $bgvalue) {
    ?>
                                                        <option value="<?php echo $bgvalue ?>" <?php
if ($bgvalue == $student["blood_group"]) {
        echo "selected";
    }
    ?>><?php echo $bgvalue ?></option>

                                                    <?php }?>
                                                </select>

                                                <span class="text-danger"><?php echo form_error('house'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">

                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('house') ?></label>
                                                <select class="form-control" rows="3" placeholder="" name="house">
                                                    <option value=""><?php echo $this->lang->line('select') ?></option>

                                                    <?php foreach ($houses as $house_key => $house_value) {
    ?>
                                                        <option value="<?php echo $house_value->id; ?>" <?php echo set_select('house', $house_value->id,(set_value('house',$student['school_house_id']) == $house_value->id ) ); ?>><?php echo $house_value->house_name; ?></option>

                                                    <?php }?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('house'); ?></span>
                                            </div>
                                        </div>


                                        <div class="col-md-3 col-xs-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('height'); ?></label>
                                                <?php ?>
                                                <input type="text" value="<?php echo $student["height"] ?>" name="height" class="form-control" value="<?php echo set_value('height', $student['height']); ?>">
                                                <span class="text-danger"><?php echo form_error('height'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-xs-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('weight'); ?></label>
                                                <?php ?>
                                                <input type="text" value="<?php echo $student["weight"] ?>" name="weight" class="form-control" value="<?php echo set_value('weight', $student['weight']); ?>">
                                                <span class="text-danger"><?php echo form_error('height'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-xs-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('measurement_date'); ?></label>
                                                <input id="measure_date" name="measure_date" placeholder="" type="text" class="form-control date"  value="<?php echo set_value('measure_date', $this->customlib->dateformat($student['measurement_date'])); ?>" readonly="readonly"/>
                                             
                                                <span class="text-danger"><?php echo form_error('measure_date'); ?></span>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>



                            <?php
if ($this->module_lib->hasActive('transport')) {
    ?>
                                <div class="bozero">
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

                $st = set_value('vehroute_id', $student['vehroute_id']) == $value->vec_route_id ? true : false;
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
                            <?php }?>
                            <?php
if ($this->module_lib->hasActive('hostel')) {
    ?>
                                <div class="bozero">
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
                            <?php }?>
                            <div class="bozero">
                                <h4 class="pagetitleh2"><?php echo $this->lang->line('parent_guardian_detail'); ?></h4>

                                <div class="around10">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('father_name'); ?></label>
                                                <input id="father_name" name="father_name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('father_name', $student['father_name']); ?>" />
                                                <span class="text-danger"><?php echo form_error('father_name'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('phone'); ?> <?php echo $this->lang->line('no'); ?></label>
                                                <input id="father_phone" name="father_phone" placeholder="" type="text" class="form-control"  value="<?php echo set_value('father_phone', $student['father_phone']); ?>" />
                                                <span class="text-danger"><?php echo form_error('father_phone'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('father_occupation'); ?></label>
                                                <input id="father_occupation" name="father_occupation" placeholder="" type="text" class="form-control"  value="<?php echo set_value('father_occupation', $student['father_occupation']); ?>" />
                                                <span class="text-danger"><?php echo form_error('father_occupation'); ?></span>
                                            </div>
                                        </div>



                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('mother_name'); ?></label>
                                                <input id="mother_name" name="mother_name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('mother_name', $student['mother_name']); ?>" />
                                                <span class="text-danger"><?php echo form_error('mother_name'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('mother_phone'); ?></label>
                                                <input id="mother_phone" name="mother_phone" placeholder="" type="text" class="form-control"  value="<?php echo set_value('mother_phone', $student['mother_phone']); ?>" />
                                                <span class="text-danger"><?php echo form_error('mother_phone'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('mother_occupation'); ?></label>
                                                <input id="mother_occupation" name="mother_occupation" placeholder="" type="text" class="form-control"  value="<?php echo set_value('mother_occupation', $student['mother_occupation']); ?>" />
                                                <span class="text-danger"><?php echo form_error('mother_occupation'); ?></span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label><?php echo $this->lang->line('if_guardian_is'); ?></label><small class="req"> *</small>&nbsp;&nbsp;&nbsp;
                                            <label class="radio-inline">
                                                <input type="radio" name="guardian_is"  <?php
if ($student['guardian_is'] == "father") {
    echo "checked";
}
?> value="father" > <?php echo $this->lang->line('father'); ?>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="guardian_is" <?php
if ($student['guardian_is'] == "mother") {
    echo "checked";
}
?> value="mother"> <?php echo $this->lang->line('mother'); ?>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="guardian_is" <?php
if ($student['guardian_is'] == "other") {
    echo "checked";
}
?> value="other"> <?php echo $this->lang->line('other'); ?>
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
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('guardian_relation'); ?></label>
                                                        <input id="guardian_relation" name="guardian_relation" placeholder="" type="text" class="form-control"  value="<?php echo set_value('guardian_relation', $student['guardian_relation']); ?>" />
                                                        <span class="text-danger"><?php echo form_error('guardian_relation'); ?></span>
                                                    </div>
                                                </div>
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

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('guardian_email'); ?></label>
                                                <input id="guardian_email" name="guardian_email" placeholder="" type="text" class="form-control"  value="<?php echo set_value('guardian_email', $student['guardian_email']); ?>" />
                                                <span class="text-danger"><?php echo form_error('guardian_email'); ?></span>
                                            </div>

                                        </div>

                                        <div class="col-md-6">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('guardian_address'); ?></label>
                                            <textarea id="guardian_address" name="guardian_address" placeholder="" class="form-control" rows="4"><?php echo set_value('guardian_address', $student['guardian_address']); ?></textarea>
                                            <span class="text-danger"><?php echo form_error('guardian_address'); ?></span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="bozero">
                                <h3 class="pagetitleh2"><?php echo $this->lang->line('address_details'); ?></h3>
                                <div class="around10">
                                    <div class="row">
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
                                    </div>
                                </div>
                            </div>
                            <div class="bozero">
                                <h3 class="pagetitleh2"><?php echo $this->lang->line('miscellaneous_details'); ?></h3>
                                <div class="around10">
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
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">
                                                    <?php echo $this->lang->line('national_identification_no'); ?>
                                                </label>
                                                <input id="adhar_no" name="adhar_no" placeholder="" type="text" class="form-control"  value="<?php echo set_value('adhar_no', $student['adhar_no']); ?>" />
                                                <span class="text-danger"><?php echo form_error('adhar_no'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">
                                                    <?php echo $this->lang->line('local_identification_no'); ?>
                                                </label>
                                                <input id="samagra_id" name="samagra_id" placeholder="" type="text" class="form-control"  value="<?php echo set_value('samagra_id', $student['samagra_id']); ?>" />
                                                <span class="text-danger"><?php echo form_error('samagra_id'); ?></span>
                                            </div>
                                        </div>
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
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('previous_school_details'); ?></label>
                                                <textarea class="form-control" rows="3" placeholder="" name="previous_school"><?php echo set_value('previous_school', $student['previous_school']); ?></textarea>
                                                <span class="text-danger"><?php echo form_error('previous_school'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('note'); ?></label>
                                                <textarea class="form-control" rows="3" placeholder="" name="note"><?php echo set_value('note', $student['note']); ?></textarea>
                                                <span class="text-danger"><?php echo form_error('previous_school'); ?></span>
                                            </div>
                                        </div>
                                        
                                     <div class="col-md-12">
                            <div class="form-group">    
                            <div class="pull-right ptt10">
                                <button type="submit" class="btn btn-info" name="save" value="save"><?php echo $this->lang->line('save'); ?></button>
                                <button type="submit" class="btn btn-info" name="save" value="enroll"> <?php echo $this->lang->line('save_and_enroll');?></button>
                                
                            </div>
                          </div>
                        </div>       
                                    </div>
                                </div>
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
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy']) ?>';
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
                data: {'class_id': class_id, 'section_id': section_id, 'current_student_id': current_student_id},
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
                        div_data += "<option value=" + obj.id + ">" + obj.firstname + " " + obj.lastname + "</option>";
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
                    type: "POST",
                    url: base_url + "admin/onlinestudent/getByClass",
                    data: {'class_id': class_id},
                    dataType: "JSON",
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
                            div_data += "<option value=" + obj.id + " " + sel + ">" + obj.section + "</option>";
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