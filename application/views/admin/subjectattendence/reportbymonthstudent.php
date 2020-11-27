<div class="content-wrapper" style="min-height: 946px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-calendar-check-o"></i> <?php echo $this->lang->line('attendance'); ?> <small><?php echo $this->lang->line('by_date1'); ?></small></h1>
    </section>
    <!-- Main content -->
    <section class="content">
         <?php $this->load->view('reports/_attendance');?>
        <div class="row">
            <div class="col-md-12"> 
                <div class="box removeboxmius">
<div class="box-header ptbnull"></div>
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>
                    <form id='form1' action="<?php echo site_url('admin/subjectattendence/reportbymonthstudent') ?>"  method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php
                            if ($this->session->flashdata('msg')) {

                                echo $this->session->flashdata('msg');
                            }
                            ?>

                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
                                        <select autofocus="" id="class_id" name="class_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php
                                            foreach ($classlist as $class) {
                                                ?>
                                                <option value="<?php echo $class['id'] ?>" <?php
                                                if (set_value('class_id') == $class['id']) {
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
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('student'); ?></label><small class="req"> *</small>
                                        <select  id="student_id" name="student_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('student_id'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">

                                            <?php echo $this->lang->line('month')?>
                                        </label><small class="req"> *</small>
                                        <select  id="month" name="month" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php
                                            $lang="january";
                                            foreach ($monthlist as $m_key => $month) {

                                                ?>
                                                <option value="<?php echo $m_key ?>" <?php echo set_select('month', $month, set_value('month')) ?>><?php echo $this->lang->line(strtolower($month)); ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('month'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">

                                            <?php echo $this->lang->line('year')?>
                                        </label>
                                        <select  id="year" name="year" class="form-control" >

                                            <?php

                                            foreach ($yearlist as $y_key => $year) {
                                                ?>
                                                <option value="<?php echo $year["year"] ?>"><?php echo $year["year"]; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('year'); ?></span>
                                    </div>
                                </div>
                            <div class="col-md-12">    
                              <div class="form-group">
                                 <button type="submit" name="search" value="search" class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                              </div>  
                             </div> 
                            </div>
                        </div>
                        
                    </form>
                
                <?php
                if (isset($resultlist)) {
                    ?>
                    <div class="">
                        <div class="box-header ptbnull"></div>
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-users"></i> <?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('list'); ?></h3>
                            <div class="box-tools pull-right">
                            </div>
                        </div>
                        <div class="box-body">
                            <?php
                            if (!empty($resultlist)) {
                                ?>
                                <div class="table-responsive">
                                    <table class="table table-hover table stripped attendance_table">
                                        <thead>
                                            <tr>
                                                <th width="25%"><?php echo $this->lang->line('date')?></th>
                                                <th class=""><?php  echo $this->lang->line('attendance')?></th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($resultlist['students_attendances'])) {
                                                foreach ($resultlist['students_attendances'] as $student_key => $student_value) {
                                                    ?>
                                                    <tr>
                                                        <td><b><?php echo $student_value['date'] . " (" . $student_value['day']. ")";  ?></b></td>
                                                        <td class="">
                                                            <?php
                                                            if (!empty($student_value['subjects'])) {
                                                                $count = 1;
                                                                foreach ($student_value['subjects'] as $subject_loop_key => $subject_loop_value) {
                                                                    
                                                                    
                                                                    ?>
                                                                        <div class="list-group">
                                                                           <b><?php
                                                                              echo $subject_loop_value->name . " (" . $subject_loop_value->code . ")";

                                                                    echo "</b>";
                                                                     echo "<br/>";
                                                                    echo $subject_loop_value->time_from . " - " . $subject_loop_value->time_to;
                                                                    echo "<br/>";
                                                                    if (!empty($student_value['attendances'])) {


                                                                        if ($student_value['attendances']->{"attendence_type_id_" . $count} == "") {
                                                                            ?>
                                                                            <span class="label label-danger">N/A</span>
                                                                            <?php
                                                                        } else {
                                                                            echo getattendencetype($attendencetypeslist, $student_value['attendances']->{"attendence_type_id_" . $count});
                                                                        }
                                                                    }
                                                                           ?>
                                                                        </div>
                                                                        <?php 
                                                                    
                                                                 
                                                                    $count++;
                                                                }
                                                            } else {
                                                                ?>
                                                                <span class="label label-danger">N/A</span>
                                                                <?php
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
        <?php
    } else {
        ?>
                                <div class="alert alert-info"><?php echo $this->lang->line('admited_alert');?></div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                  </div>  
                            <?php
                        }
                        ?>
                </section>
            </div>


<?php

function getAttendance($array, $student_session_id) {
    if (!empty($array)) {
        return $array[$student_session_id];
    }
}

function getattendencetype($attendencetype, $find) {

    foreach ($attendencetype as $attendencetype_key => $attendencetype_value) {
        if ($attendencetype_value['id'] == $find) {
            return $attendencetype_value['key_value'];
        }
    }
    return false;
}
?>


            <script type="text/javascript">

                $(document).ready(function () {

                    var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy']) ?>';
                    $('#date').datepicker({
                        format: date_format,
                        autoclose: true
                    });


                    var section_id_post = "<?php echo set_value('section_id'); ?>";
                    var class_id_post = "<?php echo set_value('class_id'); ?>";
                    var date_post = "<?php echo set_value('date'); ?>";
                    var subject_timetable_id = "<?php echo set_value('subject_timetable_id', 0); ?>";

                    populateSection(section_id_post, class_id_post);

                    function populateSection(section_id_post, class_id_post) {

                        if (section_id_post != "" && class_id_post != "") {

                            $('#section_id').html("");

                            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                            $.ajax({
                                type: "GET",
                                url: baseurl + "sections/getByClass",
                                data: {'class_id': class_id_post},
                                dataType: "json",
                                success: function (data) {
                                    $.each(data, function (i, obj)
                                    {
                                        var select = "";
                                        if (section_id_post == obj.section_id) {
                                            var select = "selected=selected";
                                        }
                                        div_data += "<option value=" + obj.section_id + " " + select + ">" + obj.section + "</option>";
                                    });
                                    $('#section_id').append(div_data);
                                }
                            });
                        }

                    }
                    getStudentsByClassAndSection();
                    function getStudentsByClassAndSection() {

                        $('#student_id').html("");
                        var class_id = $('#class_id').val();
                        var section_id = $('#section_id').val();

                        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                        $.ajax({
                            type: "GET",
                            url: baseurl + "student/getByClassAndSection",
                            data: {'class_id': class_id, 'section_id': section_id},
                            dataType: "json",
                            success: function (data) {
                                $.each(data, function (i, obj)
                                {
                                    var sel = "";
                                    if (section_id == obj.section_id) {
                                        sel = "selected=selected";
                                    }
                                    div_data += "<option value=" + obj.id + ">" + obj.firstname + " " + obj.lastname + "</option>";
                                });
                                $('#student_id').append(div_data);
                                 <?php 
                    if($student_id!=''){
                        ?>
                         $('#student_id').val('<?php echo $student_id; ?>');
                        <?php

                    }
                    ?>
                            }
                        });
                    }



                    $(document).on('change', '#class_id', function (e) {
                        $('#section_id').html("");
                        var class_id = $(this).val();

                        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                        var url = "";
                        $.ajax({
                            type: "GET",
                            url: baseurl + "sections/getByClass",
                            data: {'class_id': class_id},
                            dataType: "json",
                            success: function (data) {
                                $.each(data, function (i, obj)
                                {
                                    div_data += "<option value=" + obj.section_id + ">" + obj.section + "</option>";
                                });
                                $('#section_id').append(div_data);
                            }
                        });
                    });
                    $(document).on('change', '#section_id', function (e) {

                        getStudentsByClassAndSection();

                    });

                });
            </script>
