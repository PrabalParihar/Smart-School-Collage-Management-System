<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-money"></i> <?php echo $this->lang->line('fees_collection'); ?></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>
                    <div class="box-body">

                        <form role="form" action="<?php echo site_url('admin/examresult') ?>" method="post" class="form-horizontal">

                            <?php echo $this->customlib->getCSRF(); ?>

                            <div class="form-group">
                                <div class="col-sm-2 col-lg-2 col-md-12">
                                    <label><?php echo $this->lang->line('class'); ?></label>
                                    <select autofocus="" id="class_id" name="class_id" class="form-control" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($classlist as $class) {
                                            ?>
                                            <option value="<?php echo $class['id'] ?>" <?php
                                            if (set_value('class_id') == $class['id']) {
                                                echo "selected=selected";
                                            }
                                            ?>><?php echo $class['class'] ?></option>
                                                    <?php
                                                }
                                                ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                                </div>

                                <div class="col-sm-2 col-lg-2 col-md-12">


                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label><small class="req"> *</small>
                                    <select  id="section_id" name="section_id" class="form-control" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('section_id'); ?></span>

                                </div>
                                <div class="col-sm-2 col-lg-2 col-md-12">
                                    <label>Session --r</label>
                                    <select  id="session_id" name="session_id" class="form-control" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($sessionlist as $session) {
                                            ?>
                                            <option value="<?php echo $session['id'] ?>" <?php
                                            if (set_value('session_id') == $session['id']) {
                                                echo "selected=selected";
                                            }
                                            ?>><?php echo $session['session'] ?></option>
                                                    <?php
                                                }
                                                ?>
                                    </select>
                                </div>
                                <div class="col-sm-2 col-lg-3 col-md-12">
                                    <label>Student --r</label>
                                    <select  id="student_id" name="student_id" class="form-control" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    </select>
                                </div>
                                <div class="col-sm-2 col-lg-3 col-md-12">
                                    <label>Exam Group--r</label>
                                    <select  id="exam_group_id" name="exam_group_id" class="form-control" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    </select>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" name="search" value="search_filter" class="btn btn-primary pull-right btn-sm checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <form method="post" action="<?php echo site_url('admin/examgroup/entrymarks') ?>" id="assign_form">


                    <?php
                    if (isset($exam_result)) {
                        ?>
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-users"></i> Exam Results --r
                                    </i> </h3>
                                <div class="box-tools pull-right">
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="row">

                                    <div class="col-md-12">

                                        <?php
                                        if (!empty($exam_result)) {

                                            $exams_collection = array();
                                            foreach ($exam_result as $exam_result_key => $exam_result_value) {
                                                ?>
                                                <?php echo $exam_result_value->exam; ?>
                                                <?php
                                                if (!empty($exam_result_value->exam_results)) {
                                                    ?>
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>

                                                                <th class="text-left">Subject --r</th>
                                                                <?php
                                                                if ($exam_group->exam_type != "gpa") {
                                                                    ?>
                                                                    <th class="text-center">Max Marks --r</th>
                                                                    <th class="text-center">Min Marks --r</th>
                                                                    <th class="text-center">Obtain Marks --r</th>
                                                                    <?php
                                                                }
                                                                ?>


                                                                <?php
                                                                if ($exam_group->exam_type == "basic_system") {
                                                                    ?>
                                                                    <th class="text-center">Result --r</th>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <?php
                                                                if ($exam_group->exam_type != "gpa") {
                                                                    ?>
                                                                    <th class="text-center">Percentage --r</th>
                                                                    <?php
                                                                }
                                                                ?>


                                                                <?php
                                                                if ($exam_group->exam_type != "fail_pass") {
                                                                    ?>
                                                                    <th class="text-center">Grade --r</th>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <?php
                                                                if ($exam_group->exam_type == "gpa") {
                                                                    ?>
                                                                    <th class="text-center">Grade Point --r</th>
                                                                    <th class="text-center">Credit Hours --r</th>
                                                                    <th class="text-center">Quality Points --r</th>
                                                                    <?php
                                                                }
                                                                ?>

                                                                <th class="text-center">Note --r</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $result_flag = 1;
                                                            $total_max_marks = 0;
                                                            $total_hours = 0;
                                                            $total_points = 0;
                                                            $total_quality_point = 0;
                                                            $total_get_marks = 0;
                                                            $exam_pass_flag = 1;
                                                            foreach ($exam_result_value->exam_results as $subjects_key => $subjects_value) {
                                                                $result_inner_flag = 1;

                                                                $total_max_marks = $total_max_marks + $subjects_value->max_marks;
                                                                $exams_collection[$exam_result_value->id] = array(
                                                                    'exam_id' => $exam_result_value->id,
                                                                    'exam_name' => $exam_result_value->exam,
                                                                    'exam_get_marks' => "N/A",
                                                                    'exam_max_marks' => "N/A",
                                                                    'exam_quality_points' => 0,
                                                                );
                                                                $total_get_marks = $total_get_marks + $subjects_value->get_marks;
                                                                ?>
                                                                <tr>
                                                                    <td class="text-left"><?php echo $subjects_value->name . "( " . $subjects_value->code . " )"; ?></td>
                                                                    <?php
                                                                    if ($exam_group->exam_type != "gpa") {
                                                                        ?>

                                                                        <td class="text-center"><?php echo $subjects_value->max_marks; ?></td>
                                                                        <td class="text-center"><?php echo $subjects_value->min_marks; ?> </td>

                                                                        <td class="text-center">
                                                                            <?php
                                                                            if ($subjects_value->exam_group_exam_result_id != 0) {

                                                                                if ($subjects_value->attendence != "absent") {
                                                                                    echo $subjects_value->get_marks;
                                                                                } else {
                                                                                    echo "Abs --r";
                                                                                }
                                                                            } else {
                                                                                $result_flag = 0;
                                                                                $result_inner_flag = 0;
                                                                                echo "N/A";
                                                                            }
                                                                            ?>

                                                                        </td>
                                                                        <?php
                                                                        if ($exam_group->exam_type == "basic_system") {
                                                                            ?>
                                                                            <td class="text-center"><?php
                                                                                $result = "pass --r";
                                                                                if ($result_inner_flag == 1) {
                                                                                    $subjects_value->attendence = "present";
                                                                                    if ($subjects_value->attendence != "absent") {
                                                                                        if ($subjects_value->get_marks < $subjects_value->min_marks) {
                                                                                            $result = "fail --r";
                                                                                            $exam_pass_flag = 0;
                                                                                        } else {
                                                                                            $result = "pass --r";
                                                                                        }
                                                                                    }
                                                                                } else {
                                                                                    $result = "N/A";
                                                                                }
                                                                                echo $result;
                                                                                ?>

                                                                            </td>
                                                                            <?php
                                                                        }
                                                                        ?>

                                                                        <td class="text-center">
                                                                            <?php
                                                                            if ($result_inner_flag == 1) {

                                                                                echo number_format((($subjects_value->get_marks * 100) / $subjects_value->max_marks), 2, '.', '');
                                                                            } else {
                                                                                echo "N/A";
                                                                            }
                                                                            ?>

                                                                        </td>
                                                                        <?php
                                                                    }
                                                                    ?>



                                                                    <td class="text-center">
                                                                        <?php
                                                                        if ($result_inner_flag == 1) {
                                                                            $percentage_grade = ($subjects_value->get_marks * 100) / $subjects_value->max_marks;
                                                                            echo findGrade($exam_grades, $percentage_grade);
                                                                        }
                                                                        ?>

                                                                    </td>
                                                                    <?php
                                                                    if ($exam_group->exam_type == "gpa") {
                                                                        ?>
                                                                        <td class="text-center">
                                                                            <?php
                                                                            if ($result_inner_flag == 1) {
                                                                                $percentage_grade = ($subjects_value->get_marks * 100) / $subjects_value->max_marks;
                                                                                $point = findGradePoints($exam_grades, $percentage_grade);
                                                                                $total_points = $total_points + $point;
                                                                                echo $point;
                                                                            }
                                                                            ?>

                                                                        </td>
                                                                        <td class="text-center">
                                                                            <?php
                                                                            if ($result_inner_flag == 1) {
                                                                                $total_hours = $total_hours + $subjects_value->credit_hours;
                                                                                echo ($subjects_value->credit_hours);
                                                                            }
                                                                            ?>

                                                                        </td>
                                                                        <td class="text-center">
                                                                            <?php
                                                                            if ($result_inner_flag == 1) {
                                                                                echo ($subjects_value->credit_hours * $point);
                                                                                $total_quality_point = $total_quality_point + ($subjects_value->credit_hours * $point);
                                                                            }
                                                                            ?>

                                                                        </td>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    <td class="text-center">
                                                                        <?php
                                                                        if ($subjects_value->exam_group_exam_result_id != 0) {
                                                                            echo $subjects_value->note;
                                                                        } else {
                                                                            echo "N/A";
                                                                        }
                                                                        ?>

                                                                    </td>

                                                                </tr>
                                                                <?php
                                                            }
                                                            ?>
                                                            <tr>
                                                                <td></td>
                                                                <?php
                                                                $exams_collection[$exam_result_value->id]['exam_get_marks'] = $total_get_marks;
                                                                $exams_collection[$exam_result_value->id]['exam_max_marks'] = $total_max_marks;
                                                                if ($exam_group->exam_type != "gpa") {
                                                                    ?>
                                                                    <td class="text-center"><?php echo number_format($total_max_marks, 2, '.', ''); ?></td>
                                                                    <td></td>

                                                                    <td class="text-center"><?php echo number_format($total_get_marks, 2, '.', ''); ?></td>



                                                                    <?php
                                                                    if ($exam_group->exam_type == "basic_system") {
                                                                        ?>
                                                                        <td class="text-center">
                                                                            <?php
                                                                            if ($exam_pass_flag == 1) {
                                                                                echo "Pass --r";
                                                                            } else {
                                                                                echo "Fail --r";
                                                                            }
                                                                            ?>
                                                                        </td>
                                                                        <?php
                                                                    }
                                                                    ?>



                                                                    <td class="text-center">
                                                                        <?php
                                                                        if ($result_flag == 1) {

                                                                            echo number_format((($total_get_marks * 100) / $total_max_marks), 2, '.', '');
                                                                        } else {
                                                                            echo "N/A";
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <?php
                                                                }
                                                                ?>

                                                                <td></td>
                                                                <?php
                                                                if ($exam_group->exam_type == "gpa") {
                                                                    ?>
                                                                    <td class="text-center">
                                                                        <?php
//                                                                            if ($result_flag == 1) {
                                                                        //
                    //                                                                                echo $total_points;
                                                                        //                                                                            }
                                                                        //
                    ?>

                                                                    </td>
                                                                    <td class="text-center">
                                                                        <?php
                                                                        if ($result_flag == 1) {
                                                                            echo $total_hours;
                                                                        }
                                                                        ?>

                                                                    </td>
                                                                    <td class="text-center">
                                                                        <?php
                                                                        if ($result_flag == 1) {
                                                                            $exam_qulity_point = number_format($total_quality_point / $total_hours, 2, '.', '');
                                                                            $exams_collection[$exam_result_value->id]['exam_quality_points'] = $exam_qulity_point;
                                                                            echo $total_quality_point . "/" . $total_hours . "=" . $exam_qulity_point;
                                                                        }
                                                                        ?>

                                                                    </td>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <td></td>
                                                            </tr>
                                                            <?php ?>
                                                        </tbody>
                                                    </table>
                                                    <?php
                                                }
                                            }
                                        } else {
                                            ?>
                                            <div class="alert alert-info">
                                                No Record Found --r
                                            </div>
                                            <?php
                                        }
                                        ?>

                                        <?php
                                        if (!empty($exam_connections['exam_connections'])) {
                                            $arrays = array();
                                            //  $examwise_percentage = array();
                                            $count = 1;
                                            if ($exam_group->exam_type == "gpa") {
                                                $total_quality_point = 0;
                                                ?>
                                                <table class="table table-stripped table-hover">
                                                    <thead>
                                                    <th>Quality Points --r</th>
                                                    <?php
                                                    if (!empty($exam_connections['exam_connections'])) {

                                                        foreach ($exam_connections['exam_connections'] as $exam_loop_key => $exam_loop_value) {

                                                            //  $examwise_percentage[$exam_loop_value->exam_group_class_batch_exams_id] = array('score' => 0, 'max_marks' => 0, 'flag' => 1);
                                                            ?>
                                                            <th>

                                                                <?php echo $exam_loop_value->exam; ?>
                                                            </th>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    <th>CGPA</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td></td>
                                                            <?php
                                                            if (!empty($exam_connections['exam_connections'])) {

                                                                foreach ($exam_connections['exam_connections'] as $exam_loop_key => $exam_loop_value) {
                                                                    ?>
                                                                    <td>
                                                                        <?php
                                                                        $ex_quality_point = getExamQualityPoints($exam_result, $exam_loop_value->exam_group_class_batch_exams_id, $exam_grades);
//                                                                print_r($exam_loop_value->exam_group_class_batch_exams_id); 
                                                                        $total_quality_point = $total_quality_point + $ex_quality_point;
                                                                        echo $ex_quality_point;
                                                                        ?>
                                                                    </td>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                            <td>
                                                                <?php
                                                                echo number_format(($total_quality_point / count($exam_connections['exam_connections'])), 2, '.', '');
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                                <?php
                                            } else if ($exam_group->exam_type == "coll_grade_system") {
                                                 $conbine_exam_percentage=0;
                                                ?>
                                                <table class="table table-stripped table-hover">
                                                    <thead>

                                                        <?php
                                                        if (!empty($exam_connections['exam_connections'])) {

                                                            foreach ($exam_connections['exam_connections'] as $exam_loop_key => $exam_loop_value) {

                                                                //  $examwise_percentage[$exam_loop_value->exam_group_class_batch_exams_id] = array('score' => 0, 'max_marks' => 0, 'flag' => 1);
                                                                ?>
                                                            <th>
                                                                <?php echo $exam_loop_value->exam; ?>
                                                            </th>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    <th>Combined --r</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr>

                                                            <?php
                                                            if (!empty($exam_connections['exam_connections'])) {

                                                                foreach ($exam_connections['exam_connections'] as $exam_loop_key => $exam_loop_value) {
                                                                    ?>
                                                                    <td>
                                                                        <?php
                                                                        $exam_details = getExamDetails($exam_result, $exam_loop_value->exam_group_class_batch_exams_id, $exam_grades);
                                                                        echo $exam_details['total_get_marks']."/".$exam_details['total_max_marks'];
                                                                    
                                                                         $combine_percentage = findConnectedExamPercentage($exam_connections['exam_connections'], $exam_loop_value->exam_group_class_batch_exam_id);
                                                                         
                                                                                $conbine_exam_percentage = $conbine_exam_percentage + ((($exam_details['total_get_marks'] * 100) / $exam_details['total_max_marks']) * $combine_percentage) / 100;
                                                                        
//                                                                print_r($exam_loop_value->exam_group_class_batch_exams_id); 
//                                                                        $total_quality_point = $total_quality_point + $ex_quality_point;
//                                                                        echo $ex_quality_point;
                                                                        ?>
                                                                    </td>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                            <td>
                                                                <?php
                                                                   echo number_format($conbine_exam_percentage, 2, '.', '') . "[" . findGrade($exam_grades, $conbine_exam_percentage) . "]";
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                                <?php
                                            } else if ($exam_group->exam_type == "school_grade_system") {
                                                ?>

                                                <table class="table table-stripped table-hover">
                                                    <thead>

                                                        <?php
                                                        if (!empty($exam_connections['exam_connections'])) {

                                                            foreach ($exam_connections['exam_connections'] as $exam_loop_key => $exam_loop_value) {

                                                                $examwise_percentage[$exam_loop_value->exam_group_class_batch_exams_id] = array('score' => 0, 'max_marks' => 0, 'flag' => 1);
                                                                ?>
                                                            <th>

                                                                <?php echo $exam_loop_value->exam; ?>
                                                            </th>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    <th>Combined --r</th>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if (!empty($exam_connections['connect_subjects'])) {

                                                            foreach ($exam_connections['connect_subjects'] as $connect_subject_key => $connect_subject_value) {
                                                                $exam_flag = 1;
                                                                $total_percentage = 0;
                                                                $row_total = 0;
                                                                $conbine_exam_percentage = 0;
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $connect_subject_value->name; ?></td>
                                                                    <?php
                                                                    foreach ($exam_connections['exam_connections'] as $exam_loop_key => $exam_loop_value) {
                                                                        ?>
                                                                        <td>
                                                                            <?php
                                                                            $ass = findExamGroupMarks($exam_result, $exam_loop_value->exam_group_class_batch_exam_id, $connect_subject_value->subject_id);
//                                                                        print_r($ass);

                                                                            if ($ass->exam_group_exam_result_id != 0) {
                                                                                $combine_percentage = findConnectedExamPercentage($exam_connections['exam_connections'], $exam_loop_value->exam_group_class_batch_exam_id);
                                                                                echo $ass->get_marks . "/" . $ass->max_marks;
                                                                                $conbine_exam_percentage = $conbine_exam_percentage + ((($ass->get_marks * 100) / $ass->max_marks) * $combine_percentage) / 100;
                                                                            } else {
                                                                                $exam_flag = 0;
                                                                                echo "N/A";
                                                                            }
                                                                            ?>
                                                                        </td>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    <td>
                                                                        <?php
                                                                        if ($exam_flag == 0) {
                                                                            echo "N/A";
                                                                        } else if ($exam_flag == 1) {
                                                                            echo number_format($conbine_exam_percentage, 2, '.', '') . "[" . findGrade($exam_grades, $conbine_exam_percentage) . "]";
                                                                        } else {
                                                                            
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                            ?>


                                                            <?php
                                                        } else {
                                                            ?>
                                                            <tr>
                                                                <td colspan="4">
                                                                    <?php echo "No Subject Found"; ?>
                                                                </td>

                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>

                                                    </tbody>
                                                </table>

                                                <?php
                                            } else if ($exam_group->exam_type == "basic_system") {
                                                ?>

                                                <table class="table table-stripped table-hover">
                                                    <thead>
  <th>Subjects --r</th>
                                                        <?php
                                                        if (!empty($exam_connections['exam_connections'])) {

                                                            foreach ($exam_connections['exam_connections'] as $exam_loop_key => $exam_loop_value) {

                                                                $examwise_percentage[$exam_loop_value->exam_group_class_batch_exams_id] = array('score' => 0, 'max_marks' => 0, 'flag' => 1);
                                                                ?>
                                                            <th>

                                                                <?php echo $exam_loop_value->exam; ?>
                                                            </th>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    <th>Combined --r</th>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if (!empty($exam_connections['connect_subjects'])) {

                                                            foreach ($exam_connections['connect_subjects'] as $connect_subject_key => $connect_subject_value) {
                                                                $exam_flag = 1;
                                                                $total_percentage = 0;
                                                                $row_total = 0;
                                                                $conbine_exam_percentage = 0;
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $connect_subject_value->name; ?></td>
                                                                    <?php
                                                                    foreach ($exam_connections['exam_connections'] as $exam_loop_key => $exam_loop_value) {
                                                                        ?>
                                                                        <td>
                                                                            <?php
                                                                            $ass = findExamGroupMarks($exam_result, $exam_loop_value->exam_group_class_batch_exam_id, $connect_subject_value->subject_id);
//                                                                        print_r($ass);

                                                                            if ($ass->exam_group_exam_result_id != 0) {
                                                                                $combine_percentage = findConnectedExamPercentage($exam_connections['exam_connections'], $exam_loop_value->exam_group_class_batch_exam_id);
                                                                                echo $ass->get_marks . "/" . $ass->max_marks;
                                                                                $conbine_exam_percentage = $conbine_exam_percentage + ((($ass->get_marks * 100) / $ass->max_marks) * $combine_percentage) / 100;
                                                                            } else {
                                                                                $exam_flag = 0;
                                                                                echo "N/A";
                                                                            }
                                                                            ?>
                                                                        </td>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    <td>
                                                                        <?php
                                                                        if ($exam_flag == 0) {
                                                                            echo "N/A";
                                                                        } else if ($exam_flag == 1) {
                                                                            echo number_format($conbine_exam_percentage, 2, '.', '') . "[" . findGrade($exam_grades, $conbine_exam_percentage) . "]";
                                                                        } else {
                                                                            
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                            ?>


                                                            <?php
                                                        } else {
                                                            ?>
                                                            <tr>
                                                                <td colspan="4">
                                                                    <?php echo "No Subject Found"; ?>
                                                                </td>

                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>

                                                    </tbody>
                                                </table>

                                                <?php
                                            }
                                        }
                                        ?>

                                    </div>



                                </div>

                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </form>
            </div>

        </div>

    </section>
</div>

<?php

function findExamGroupMarks($exam_group_exam_results, $exam_group_class_batch_exam_id, $subject_id) {

    if (!empty($exam_group_exam_results)) {
        foreach ($exam_group_exam_results as $exam_group_exam_key => $exam_group_exam_val) {

            if ($exam_group_exam_val->id == $exam_group_class_batch_exam_id) {
                if (!empty($exam_group_exam_val->exam_results)) {
                    foreach ($exam_group_exam_val->exam_results as $exam_result_key => $exam_result_val) {
                        if ($exam_result_val->subject_id == $subject_id) {
                            return $exam_result_val;
                        }
                    }
                }
            }
        }
    }

    return "-";
}

function findConnectedExamPercentage($exam_connections, $exam_group_class_batch_exam_id) {
//    print_r($exam_connections);

    if (!empty($exam_connections)) {
        foreach ($exam_connections as $exam_connection_key => $exam_connection_value) {
            if ($exam_connection_value->exam_group_class_batch_exams_id == $exam_group_class_batch_exam_id) {
                return $exam_connection_value->exam_weightage;
            }
        }
    }

    return false;
}

function findGrade($exam_grades, $percentage) {

    if (!empty($exam_grades)) {
        foreach ($exam_grades as $exam_grade_key => $exam_grade_value) {

            if ($exam_grade_value->mark_from >= $percentage && $exam_grade_value->mark_upto <= $percentage) {
                return $exam_grade_value->name;
            }
        }
    }

    return "-";
}

function getExamDetails($exam_group_exam_results, $exam_id, $exam_grades) {
   
    if (!empty($exam_group_exam_results)) {
        $total_get_marks = 0;
        $total_max_marks = 0;
        foreach ($exam_group_exam_results as $exam_group_exam_key => $exam_group_exam_val) {

            if ($exam_group_exam_val->id == $exam_id) {
                if (!empty($exam_group_exam_val->exam_results)) {
                    foreach ($exam_group_exam_val->exam_results as $exam_result_key => $exam_result_val) {
                        $total_max_marks = $total_max_marks + $exam_result_val->max_marks;
                        if ($exam_result_val->exam_group_exam_result_id != 0) {
                            $total_get_marks = $total_get_marks + $exam_result_val->get_marks;
                        }
                    }
                }
            }
           
        }

        return array('total_get_marks'=>$total_get_marks,'total_max_marks'=>$total_max_marks);
    }

    return "-";
}

function getExamQualityPoints($exam_group_exam_results, $exam_id, $exam_grades) {

    if (!empty($exam_group_exam_results)) {
        $total_credit_hours = 0;
        $total_point = 0;
        foreach ($exam_group_exam_results as $exam_group_exam_key => $exam_group_exam_val) {

            if ($exam_group_exam_val->id == $exam_id) {
                if (!empty($exam_group_exam_val->exam_results)) {
                    foreach ($exam_group_exam_val->exam_results as $exam_result_key => $exam_result_val) {


                        $percentage_grade = ($exam_result_val->get_marks * 100) / $exam_result_val->max_marks;
                        $point = findGradePoints($exam_grades, $percentage_grade);
                        $total_point = $total_point + ($point * $exam_result_val->credit_hours);
                        $total_credit_hours = $total_credit_hours + $exam_result_val->credit_hours;
                    }
                }
            }
        }
        return number_format($total_point / $total_credit_hours, 2, '.', '');
    }

    return "-";
}

function findGradePoints($exam_grades, $percentage) {

    if (!empty($exam_grades)) {
        foreach ($exam_grades as $exam_grade_key => $exam_grade_value) {

            if ($exam_grade_value->mark_from >= $percentage && $exam_grade_value->mark_upto <= $percentage) {
                return $exam_grade_value->point;
            }
        }
    }

    return "-";
}

function arrange_code($exam_group_class_batch_exams_id, $class_batch_subject_id, $exam_result) {
    if (!empty($exam_result)) {
        foreach ($exam_result as $ex_key => $ex_value) {
            if ($ex_value->id == $exam_group_class_batch_exams_id) {

                foreach ($ex_value->exam_results as $ex_result_key => $ex_result_value) {
                    if ($ex_result_value->class_batch_subject_id == $class_batch_subject_id) {
                        return $ex_result_value;
                    }
                }
            }
        }
    }
}

function findExamPercentage($exams, $find_exam_percentage) {
    if (!empty($exams)) {
        foreach ($exams as $exams_key => $exams_value) {
            if ($exams_value->exam_group_class_batch_exams_id == $find_exam_percentage) {
                return $exams_value->exam_weightage;
            }
        }
    }
    return false;
}
?>


<script type="text/javascript">


    var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy']) ?>';
    var class_id = '<?php echo set_value('class_id') ?>';
    var section_id = '<?php echo set_value('section_id') ?>';
    var student_id = '<?php echo set_value('student_id') ?>';
    var session_id = '<?php echo set_value('session_id') ?>';
    var exam_group_id = '<?php echo set_value('exam_group_id') ?>';
    getSectionByClass(class_id, section_id);
    // getBatchByClass(class_id, section_id);

    // getAttemptStudentByClassBatch(class_id, batch_id, student_id);
    getExamGroupByStudent(student_id, exam_group_id)
    getStudentByClassSectionSession(class_id, section_id, session_id, student_id);
    $(document).on('change', '#class_id', function (e) {
        $('#section_id').html("");
        var class_id = $(this).val();
        getSectionByClass(class_id, 0);
    });

    $(document).on('change', '#session_id', function (e) {

        var class_id = $('#class_id').val();
        var section_id = $('#section_id').val();
        var session_id = $(this).val();
        getStudentByClassSectionSession(class_id, section_id, session_id, 0);
    });

    function getStudentByClassSectionSession(class_id, section_id, session_id, student_id) {
        if (class_id != "" && section_id != "" && session_id != "") {
            $('#student_id').html("");

            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';


            $.ajax({
                type: "POST",
                url: baseurl + "admin/examresult/getStudentByClassBatch",
                data: {'class_id': class_id, "section_id": section_id, "session_id": session_id},
                dataType: "JSON",
                beforeSend: function () {
                    $('#student_id').addClass('dropdownloading');
                },
                success: function (data) {
                    $.each(data.studentList, function (i, obj)
                    {
                        var sel = "";
                        if (student_id == obj.student_id) {
                            sel = "selected";
                        }
                        div_data += "<option value=" + obj.student_id + " " + sel + ">" + obj.firstname + " " + obj.lastname + "</option>";
                    });
                    $('#student_id').append(div_data);
                },
                complete: function () {
                    $('#student_id').removeClass('dropdownloading');
                }
            });
        }
    }

    // $(document).on('change', '#batch_id', function (e) {
    //     $('#section_id').html("");

    //     var class_id = $('#class_id').val();
    //     var batch_id = $(this).val();
    //     getAttemptStudentByClassBatch(class_id, batch_id, 0);
    // });


    $(document).on('change', '#student_id', function (e) {

        var student_id = $(this).val();
        getExamGroupByStudent(student_id, 0);
    });


    function getSectionByClass(class_id, section_id) {

        if (class_id != "") {
            $('#section_id').html("");
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';


            $.ajax({
                type: "GET",
                url: base_url + "sections/getByClass",
                data: {'class_id': class_id},
                dataType: "json",
                beforeSend: function () {
                    $('#section_id').addClass('dropdownloading');
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
                    $('#section_id').append(div_data);
                },
                complete: function () {
                    $('#section_id').removeClass('dropdownloading');
                }
            });
        }
    }





    // function getAttemptStudentByClassBatch(class_id, batch_id,student_id) {

    //     if (class_id != "") {
    //         $('#student_id').html("");

    //         var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';


    //         $.ajax({
    //             type: "POST",
    //             url: baseurl + "admin/examresult/getStudentByClassBatch",
    //             data: {'class_id': class_id, "batch_id": batch_id},
    //             dataType: "JSON",
    //             beforeSend: function () {
    //                 $('#student_id').addClass('dropdownloading');
    //             },
    //             success: function (data) {
    //                 $.each(data.studentList, function (i, obj)
    //                 {
    //                     var sel = "";
    //                     if (student_id == obj.student_id) {
    //                         sel = "selected";
    //                     }
    //                     div_data += "<option value=" + obj.student_id + " " + sel + ">" + obj.firstname + " " + obj.lastname + "</option>";
    //                 });
    //                 $('#student_id').append(div_data);
    //             },
    //             complete: function () {
    //                 $('#student_id').removeClass('dropdownloading');
    //             }
    //         });
    //     }
    // }




    function getExamGroupByStudent(student_id, exam_group_id) {

        if (student_id != "") {
            $('#exam_group_id').html("");

            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "POST",
                url: baseurl + "admin/examresult/getExamGroupByStudent",
                data: {'student_id': student_id},
                dataType: "JSON",
                beforeSend: function () {
                    $('#exam_group_id').addClass('dropdownloading');
                },
                success: function (data) {
                    console.log(data);
                    $.each(data.examgrouplist, function (i, obj)
                    {
                        var sel = "";
                        if (exam_group_id == obj.exam_group_id) {
                            sel = "selected";
                        }
                        div_data += "<option value=" + obj.exam_group_id + " " + sel + ">" + obj.name + "</option>";
                    });
                    $('#exam_group_id').append(div_data);
                },
                complete: function () {
                    $('#exam_group_id').removeClass('dropdownloading');
                }
            });
        }
    }





</script>