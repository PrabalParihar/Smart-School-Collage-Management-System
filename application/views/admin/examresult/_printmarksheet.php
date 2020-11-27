<style type="text/css">
    @media print {
        .pagebreak { page-break-before: always; } /* page-break-after works, as well */
    }
</style>
<?php
if (empty($marksheet)) {
    ?>
    <div class="alert alter-info">
        <?php echo $this->lang->line('no_record_found'); ?>
    </div>
    <?php
} else {

    if ($marksheet['exam_connection'] == 0) {
        if (!empty($marksheet['students'])) {
            foreach ($marksheet['students'] as $student_key => $student_value) {
                $percentage_total = 0;
// print_r($template);
                //    echo "<pre>";
                // print_r($student_value);
                //                 echo "<pre/>";
                ?>



                <style type="text/css">
                    @page{padding: 0; margin:0;}
                    body{padding: 0; margin:0; font-family: arial; color: #000; font-size: 14px; line-height: normal;}
                    .tableone{}
                    .tableone td{border:1px solid #000; padding: 5px 0}
                    .denifittable th{border-top: 1px solid #999;}
                    .denifittable th,
                    .denifittable td {border-bottom: 1px solid #999;
                                      border-collapse: collapse;border-left: 1px solid #999;}
                    .denifittable tr th {padding: 10px 10px; font-weight: normal;}
                    .denifittable tr td {padding: 10px 10px; font-weight: bold;}
           .tcmybg {
                background:top center;
                background-size: 100% 100%;
                position: absolute;
                top: 0;
                left: 0;
                bottom: 0;
                z-index: 1;
                width: 100%;height: 100%;
            }
            .tablemain{position: relative;z-index: 2}
                </style>
  
                <div style="width: 100%; margin: 0 auto; border:1px solid #000; padding: 10px 5px 5px;position: relative; z-index: 2;">
                     <?php

        if ($template->background_img != "") {
            ?> 
        
            <img src="<?php echo base_url('uploads/marksheet/' . $template->background_img); ?>" class="tcmybg" width="100%" height="100%" />
            <?php
        }
        ?>
                    <table cellpadding="0" cellspacing="0" width="100%"  class="tablemain">
                        <?php
                        if ($template->heading != "" || $template->title != "") {
                            ?>
                            <tr>
                                <td valign="top">
                                    <table cellpadding="0" cellspacing="0" width="100%">

                                        <?php
                                        if ($template->heading != "") {
                                            ?>
                                            <tr>
                                                <td valign="top" style="font-size: 42px; font-weight: bold; text-align: center;"><?php echo $template->heading; ?></td>
                                            </tr>
                                            <?php
                                        }
                                        if ($template->title != "") {
                                            ?>
                                            <tr>
                                                <td valign="top" style="font-size: 20px; font-weight: 900; text-align: center; text-transform: uppercase;"><?php echo $template->title; ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>



                                        <tr><td valign="top" height="5"></td></tr>
                                    </table>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>

                        <tr>
                            <td valign="top">
                                <table cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                           <td width="100" valign="top" align="center" style="padding-left: 20px;">
                                        <?php
                                        if ($template->left_logo) {
                                            ?>
                                                <img src="<?php echo base_url('uploads/marksheet/' . $template->left_logo); ?>" width="100" height="100">
                                            <?php
                                        }
                                        ?>

                                                 </td>


                                        <td valign="top">
                                            <table cellpadding="0" cellspacing="0" width="100%">

                                                <tr>
                                                    <td valign="top" style="font-size: 20px; font-weight: bold; text-align: center; text-transform: uppercase;">
                                                        <?php echo $template->exam_name; ?></td>
                                                </tr>

                                                <tr><td valign="top" height="5"></td></tr>
                                                <?php
                                                if ($template->exam_session) {
                                                    ?>
                                                    <tr>
                                                        <td valign="top" style="font-weight: bold; text-align: center; text-transform: uppercase;">
                                                            <?php echo $exam->session; ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </table>
                                        </td>
<td width="100" valign="top" align="right" style="padding-right: 20px;">
                                        <?php
                                        if ($template->right_logo) {
                                            ?>
                                                <img src="<?php echo base_url('uploads/marksheet/' . $template->right_logo); ?>" width="100" height="100">
                                            <?php
                                        }
                                        ?>

                                            </td>

                                    </tr>
                                </table>
                            </td>
                        </tr>


                        <?php
                        if ($template->is_admission_no || $template->is_roll_no || $template->is_photo) {
                            ?>
                            <tr>
                                <td valign="top">
                                    <table cellpadding="0" cellspacing="0" width="100%" class="">
                                        <tr><td valign="top" height="10"></td></tr>
                                        <tr>
                                            <td valign="top">
                                                <table cellpadding="0" cellspacing="0" width="98%" class="denifittable">

                                                    <tr>

                                                        <?php
                                                        if ($template->is_admission_no) {
                                                            ?>
                                                            <th valign="top" style="text-align: center; text-transform: uppercase;">
                                                                <?php echo $this->lang->line('admission_no') ?>
                                                            </th>
                                                            <?php
                                                        }
                                                        if ($template->is_roll_no) {
                                                            ?>
                                                            <th valign="top" style="text-align: center; text-transform: uppercase; border-right:1px solid #999"><?php echo $this->lang->line('roll_no') ?></th>
                                                            <?php
                                                        }
                                                        ?>



                                                    </tr>

                                                    <tr>
                                                        <?php
                                                        if ($template->is_admission_no) {
                                                            ?>

                                                            <td valign="" style="text-transform: uppercase;text-align: center;"><?php echo $student_value['admission_no']; ?></td>
                                                            <?php
                                                        }
                                                        if ($template->is_roll_no) {
                                                            ?>
                                                            <td valign="" style="text-transform: uppercase;text-align: center;border-right:1px solid #999"><?php echo $student_value['exam_roll_no']; ?></td>
                                                            <?php
                                                        }
                                                        ?>



                                                    </tr>

                                                    <tr>
                                                        <td valign="top" colspan="5" style="text-align: center; text-transform: uppercase; border:0">

                                                            <?php echo $this->lang->line('certificated_that') ?></td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <?php
                                            if ($template->is_photo) {
                                                

                                                
                                                ?>
                                                <td valign="top" align="center"><?php if($student_value['image']!=''){ ?><img src="<?php echo base_url() . $student_value['image']; ?>" width="100" height="100">
                                                <?php } ?>
                                                </td>
                                                <?php
                                            }
                                            ?>

                                        </tr>

                                    </table>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                       
                        <tr>
                            <td valign="top">
                                <table cellpadding="0" cellspacing="0" width="100%" class="">


                                    <?php
                                    if ($template->is_name) {
                                        ?>
                                        <tr>

                                            <td valign="top" style="text-transform: uppercase; padding-bottom: 15px;"><?php echo $this->lang->line('name_prefix'); ?><span style="padding-left: 30px; font-weight: bold;"><?php echo $student_value['firstname'] . " " . $student_value['lastname']; ?></span></td>
                                        </tr>
                                        <?php
                                    }

                                    if ($template->is_father_name) {
                                        ?>
                                        <tr>
                                            <td valign="top" style="text-transform: uppercase; padding-bottom: 15px;"><?php echo $this->lang->line('marksheet_father_name') ?><span style="padding-left: 30px; font-weight: bold;"><?php echo $student_value['father_name']; ?></span></td>
                                        </tr>
                                        <?php
                                    }

                                    if ($template->is_mother_name) {
                                        ?>
                                        <tr>
                                            <td valign="top" style="text-transform: uppercase; padding-bottom: 15px;"><?php echo $this->lang->line('exam_mother_name'); ?><span style="padding-left: 30px; font-weight: bold;"><?php echo $student_value['mother_name']; ?></span></td>
                                        </tr>
                                        <?php
                                    }
                                    if ($template->is_class && $template->is_section) {
                                        ?>
                                        <tr>
                                            <td valign="top" style="text-transform: uppercase; padding-bottom: 15px;"><?php echo $this->lang->line('class'); ?><span style="padding-left: 30px; font-weight: bold;"><?php echo $student_value['class_id'] . " (" . $student_value['section'] . ")"; ?> </span></td>
                                        </tr>
                                        <?php
                                    } elseif ($template->is_class) {
                                        ?>
                                        <tr>
                                            <td valign="top" style="text-transform: uppercase; padding-bottom: 15px;"><?php echo $this->lang->line('class'); ?><span style="padding-left: 30px; font-weight: bold;"><?php echo $student_value['class_id']; ?> </span></td>
                                        </tr>
                                        <?php
                                    } elseif ($template->is_section) {
                                        ?>
                                        <tr>
                                            <td valign="top" style="text-transform: uppercase; padding-bottom: 15px;"><?php echo $this->lang->line('class'); ?><span style="padding-left: 30px; font-weight: bold;"><?php echo $student_value['section']; ?> </span></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>

                                    <?php
                                    if ($template->school_name != "") {
                                        ?>
                                        <tr>
                                            <td valign="top" style="text-transform: uppercase; padding-bottom: 15px;"> <?php echo $this->lang->line('school_name'); ?><span style="padding-left: 30px; font-weight: bold;"><?php echo $template->school_name; ?></span></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
<?php
                                    if ($template->exam_center != "") {
                                        ?>
                                    <tr>
                                        <td valign="top" style="text-transform: uppercase; padding-bottom: 15px;"><?php echo $this->lang->line('exam') . " " . $this->lang->line('center') ?><span style="text-transform: uppercase; padding-top: 15px; font-weight: bold; padding-bottom: 20px; padding-left: 30px;"><?php echo $template->exam_center; ?></span></td>

                                    </tr>
    <?php
                                    }
                                    ?>
                                    <?php
                                    if ($template->content != "") {
                                        ?>
                                        <tr>
                                            <td valign="top" style="text-transform: uppercase; padding-bottom: 15px; line-height: normal;"><?php echo $template->content ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>



                                </table>
                            </td>
                        </tr>
                        <tr>

                            <td valign="top">
                                <?php
                                if (!empty($student_value['exam_result'])) {
                                    ?>
                                    <table cellpadding="0" cellspacing="0" width="100%" class="denifittable" style="text-align: center;">
                                        <thead>
                                            <tr>
                                                <th><?php echo $this->lang->line('subjects') ?></th>
                                                <?php
                                                if ($exam->exam_group_type != "gpa") {
                                                    ?>
                                                    <th valign="middle" rowspan="2"><?php echo $this->lang->line('max') . " " . $this->lang->line('marks') ?></th>
                                                    <th valign="middle" rowspan="2"><?php echo $this->lang->line('min') . " " . $this->lang->line('marks') ?></th>
                                                    <th valign="middle" rowspan="2"><?php echo $this->lang->line('marks') . " " . $this->lang->line('obtained') ?></th>
                                                    <?php
                                                } else if ($exam->exam_group_type == "gpa") {
                                                    ?>
                                                    <th valign="middle" rowspan="2"><?php echo $this->lang->line('grade') . " " . $this->lang->line('point'); ?></th>
                                                    <th valign="middle" rowspan="2"><?php echo $this->lang->line('credit') . " " . $this->lang->line('hours') ?></th>
                                                    <th valign="middle" rowspan="2"><?php echo $this->lang->line('quality') . " " . $this->lang->line('point') ?></th>
                                                    <?php
                                                }

                                                if ($exam->exam_group_type == "school_grade_system" || $exam->exam_group_type == "coll_grade_system") {
                                                    ?>
                                                    <th><?php echo $this->lang->line('grade'); ?></th>
                                                    <?php
                                                }
                                                ?>
                                                <th valign="top" style="text-align: left;border-right:1px solid #999"><?php echo $this->lang->line('remark') ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $total_max_marks = 0;
                                            $total_obtain_marks = 0;
                                            $total_points = 0;
                                            $total_hours = 0;
                                            $total_quality_point = 0;
                                            $result_status = 1;
                                            $absent_status = false;
                                            foreach ($student_value['exam_result'] as $exam_result_key => $exam_result_value) {
                                                $total_max_marks = $total_max_marks + $exam_result_value->max_marks;
                                                $total_obtain_marks = $total_obtain_marks + $exam_result_value->get_marks;
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $exam_result_value->name . "(" . $exam_result_value->code . ")"; ?>
                                                    </td>
                                                    <?php
                                                    if ($exam->exam_group_type != "gpa") {
                                                        ?>
                                                        <td>
                                                            <?php echo $exam_result_value->max_marks; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $exam_result_value->min_marks; ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            echo $exam_result_value->get_marks;
                                                            if ($exam_result_value->attendence == "absent") {
                                                                echo "&nbsp;" . $this->lang->line('exam_absent');
                                                                $absent_status = true;
                                                            }
                                                            if ($exam_result_value->get_marks < $exam_result_value->min_marks) {
                                                                $result_status = 0;
                                                            }
                                                            ?>
                                                        </td>
                                                        <?php
                                                    } else if ($exam->exam_group_type == "gpa") {
                                                        ?>
                                                        <td class="text-center">
                                                            <?php
                                                            $percentage_grade = ($exam_result_value->get_marks * 100) / $exam_result_value->max_marks;
                                                            $point = findGradePoints($exam_grades, $percentage_grade);

                                                            $total_points = $total_points + $point;
                                                            echo $point;
                                                            ?>

                                                        </td>
                                                        <td class="text-center">
                                                            <?php
                                                            $total_hours = $total_hours + $exam_result_value->credit_hours;
                                                            echo ($exam_result_value->credit_hours);
                                                            ?>

                                                        </td>
                                                        <td class="text-center">
                                                            <?php
                                                            echo ($exam_result_value->credit_hours * $point);
                                                            $total_quality_point = $total_quality_point + ($exam_result_value->credit_hours * $point);
                                                            ?>

                                                        </td>
                                                        <?php
                                                    }

                                                    if ($exam->exam_group_type == "school_grade_system" || $exam->exam_group_type == "coll_grade_system") {
                                                        ?>
                                                        <td>

                                                            <?php
                                                            $percentage_grade = ($exam_result_value->get_marks * 100) / $exam_result_value->max_marks;
                                                            echo findGrade($exam_grades, $percentage_grade);
                                                            ?>
                                                        </td>
                                                        <?php
                                                    }
                                                    ?>
                                                    <td valign="top" style="text-align: left;border-right:1px solid #999">
                                                        <?php
                                                        if ($exam->exam_group_type == "basic_system") {
                                                            if ($exam_result_value->get_marks < $exam_result_value->min_marks) {
                                                                $result_status = 0;
                                                                echo "(F) ";
                                                            }
                                                        }
                                                        echo $exam_result_value->note;
                                                        ?>
                                                    </td>

                                                </tr>
                                                <?php
                                            }
                                            ?>


                                            <?php
                                            if ($exam->exam_group_type != "gpa") {
                                                ?>
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <?php echo number_format($total_max_marks, 2, '.', ''); ?>
                                                    </td>
                                                    <td><?php echo $this->lang->line('grand_total') ?></td>
                                                    <td>

                                                        <?php echo number_format($total_obtain_marks, 2, '.', ''); ?>
                                                    </td>
                                                    <td valign="top" style="text-align: left;border-right:1px solid #999">


                                                    </td>
                                                    <?php
                                                    if ($exam->exam_group_type == "school_grade_system" || $exam->exam_group_type == "coll_grade_system") {
                                                        ?>
                                                        <td valign="top" style="text-align: left;border-right:1px solid #999"></td>
                                                        <?php
                                                    }
                                                    ?>

                                                </tr>
                                                <tr>
                                                    <td><?php echo $this->lang->line('percentage') ?></td>
                                                    <td>
                                                        <?php
                                                        echo number_format((($total_obtain_marks * 100) / $total_max_marks), 2, '.', '');

                                                        $percentage_total = (($total_obtain_marks * 100) / $total_max_marks);
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($exam->exam_group_type == "basic_system") {
                                                            ?>
                                                            <?php echo $this->lang->line('result') ?>
                                                            <?php
                                                        }
                                                        ?>

                                                    </td>

                                                    <td>
                                                        <?php
                                                        if ($exam->exam_group_type == "basic_system") {
                                                            if ($result_status == 0) {
                                                                echo $this->lang->line('fail');
                                                            }
                                                            if ($result_status == 1) {
                                                                echo $this->lang->line('pass');
                                                            }
                                                        }
                                                        ?>

                                                    </td>

                                                    <td valign="top" style="text-align: left;border-right:1px solid #999"></td>
                                                    <?php
                                                    if ($exam->exam_group_type == "school_grade_system" || $exam->exam_group_type == "coll_grade_system") {
                                                        ?>
                                                        <td valign="top" style="text-align: left;border-right:1px solid #999"></td>
                                                        <?php
                                                    }
                                                    ?>

                                                </tr>
                                                <?php
                                            } else if ($exam->exam_group_type == "gpa") {
                                                ?>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-center">
                                                        <?php
                                                        echo number_format($total_hours, 2, '.', '');
                                                        ?>

                                                    </td>
                                                    <td class="text-center">
                                                        <?php
                                                        $exam_qulity_point = number_format($total_quality_point / $total_hours, 2, '.', '');

                                                        echo $total_quality_point . "/" . $total_hours . "=" . $exam_qulity_point;
                                                        ?>

                                                    </td>
                                                    <td valign="top" style="text-align: left;border-right:1px solid #999"></td>


                                                    <?php
                                                    if ($exam->exam_group_type == "school_grade_system" || $exam->exam_group_type == "coll_grade_system") {
                                                        ?>
                                                        <td valign="top" style="text-align: left;border-right:1px solid #999"></td>
                                                        <?php
                                                    }
                                                    ?>
                                                </tr>
                                                <?php
                                            }
                                            ?>




                                        </tbody>
                                    </table>

                                    <?php
                                }
                                ?>
                            </td>
                        </tr>

                        <tr><td valign="top" height="30"></td></tr>

                        <?php
                        if ($exam->exam_group_type != "gpa") {
                            ?>
                            <tr>
                                <td valign="top" colspan="5" width="20%" style="font-weight: normal; text-align: left; border-top:0">

                                </td>

                            </tr>
                            <tr>
                                <td valign="top" colspan="5" width="20%" style="font-weight: normal; text-align: left; border-top:0">
                                    Result
                                    <span style="border-left:0;text-align: left;font-weight: bold; padding-left: 30px;">
                                        <?php
                                        if ($result_status == 0 || $absent_status) {
                                            echo $this->lang->line('fail');
                                        } else {

                                            if ($percentage_total > 40) {
                                                echo $this->lang->line('pass');
                                            } else {
                                                echo $this->lang->line('fail');
                                            }
                                        }
                                        ?>

                                    </span>
                                </td>

                            </tr>

                            <?php
                            if ($template->is_division) {
                                ?>
                                <tr>
                                    <td valign="top" colspan="5" width="20%" style="font-weight: normal; text-align: left; border-top:0">
                                        <?php echo $this->lang->line('division'); ?>
                                        <span style="border-left:0;text-align: left;font-weight: bold; padding-left: 30px;">
                                            <?php
                                            if ($percentage_total >= 60) {
                                                echo $this->lang->line('first');
                                            } elseif ($percentage_total >= 50 && $percentage_total < 60) {
                                                echo $this->lang->line('second');
                                            } elseif ($percentage_total >= 0 && $percentage_total < 50) {
                                                echo $this->lang->line('third');
                                            } else {
                                                
                                            }
                                            ?>

                                        </span>
                                    </td>

                                </tr>
                                <?php
                            }
                            ?>


                            <tr>
                                <td valign="top" style="font-weight: bold; padding-left: 30px; padding-top: 10px;"><?php echo $template->date; ?></td>
                            </tr>
                            <?php
                        }
                        ?>

                        <tr><td valign="top" height="30"></td></tr>
                        <?php
                        if ($template->content_footer != "") {
                            ?>
                            <tr>
                                <td valign="top" style="text-transform: uppercase; padding-bottom: 15px; line-height: normal;"><?php echo $template->content_footer ?></td>
                            </tr>
                            <?php
                        }
                        ?>


                        <?php
                        if ($template->left_sign != "" || $template->middle_sign != "" || $template->right_sign != "") {
                            ?>
                            <tr>
                                <td valign="top">
                                    <table cellpadding="0" cellspacing="0" width="100%" class="">
                                        <tr>
                                            <td valign="bottom" style="font-size: 12px;">

                                            </td>
                                            <?php
                                            if ($template->left_sign != "") {
                                                ?>
                                                <td valign="bottom" align="center" style="text-transform: uppercase;">

                                                    <img src="<?php echo base_url('uploads/marksheet/' . $template->left_sign); ?>"  width="100" height="50">

                                                </td>
                                                <?php
                                            }
                                            ?>

                                            <?php
                                            if ($template->middle_sign != "") {
                                                ?>
                                                <td valign="bottom" align="center" style="text-transform: uppercase;">

                                                    <img src="<?php echo base_url('uploads/marksheet/' . $template->middle_sign); ?>" width="100" height="50">

                                                </td>
                                                <?php
                                            }
                                            ?>

                                            <?php
                                            if ($template->right_sign != "") {
                                                ?>
                                                <td valign="bottom" align="center" style="text-transform: uppercase;">

                                                    <img src="<?php echo base_url('uploads/marksheet/' . $template->right_sign); ?>" width="100" height="50">

                                                </td>
                                                <?php
                                            }
                                            ?>



                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>

                        <tr><td valign="top" height="20"></td></tr>
                    </table>
                </div>

                <div class="pagebreak"> </div>
                <?php
            }
        }
    }

    if ($marksheet['exam_connection'] == 1) {

        foreach ($marksheet['students'] as $student_key => $student_value) {

            $percentage_total = 0;
            ?>

            <!doctype html>
            <html lang="en">
                <head>
                    <meta charset="utf-8" />
                    <link rel="icon" type="image/png" href="assets/img/s-favican.png">
                    <meta http-equiv="X-UA-Compatible" content="" />
                    <title>Smart School : School Management System by QDOCS</title>
                    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
                    <meta name="theme-color" content="" />
                    <style type="text/css">
                        *{padding: 0; margin:0;}
                        body{padding: 0; margin:0; font-family: arial; color: #000; font-size: 14px; line-height: normal;}
                        .tableone{}
                        .tableone td{border:1px solid #000; padding: 5px 0}
                        .denifittable th{border-top: 1px solid #999;}
                        .denifittable th,
                        .denifittable td {border-bottom: 1px solid #999;
                                          border-collapse: collapse;border-left: 1px solid #999;}
                        .denifittable tr th {padding: 10px 10px; font-weight: normal;}
                        .denifittable tr td {padding: 10px 10px; font-weight: bold;}

                    </style>
                </head>
                <body>
                    <div style="width: 1000px; margin: 0 auto; border:1px solid #000; padding: 10px 5px 5px">
                        <table cellpadding="0" cellspacing="0" width="100%">
                            <tr><td valign="top">
                                    <table cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td valign="top" style="font-size: 42px; font-weight: bold; text-align: center;"><?php echo $template->heading; ?></td>
                                        </tr>

                                        <tr>
                                            <td valign="top" style="font-size: 20px; font-weight: 900; text-align: center; text-transform: uppercase;"><?php echo $template->title; ?></td>
                                        </tr>
                                        <tr><td valign="top" height="5"></td></tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <table cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td valign="top" align="center"><?php
                                            if ($template->left_logo != "") {
                                                ?><img src="<?php echo base_url('uploads/marksheet/' . $template->left_logo); ?>" width="100" height="100"> <?php } ?></td>
                                            <td valign="top">
                                                <table cellpadding="0" cellspacing="0" width="100%">

                                                    <tr>
                                                        <td valign="top" style="font-size: 20px; font-weight: bold; text-align: center; text-transform: uppercase;">
                                                            <?php echo $template->exam_name; ?></td>
                                                    </tr>
                                                    <tr><td valign="top" height="5"></td></tr>


                                                    <?php
                                                    if ($template->exam_session) {
                                                        ?>
                                                        <tr>
                                                            <td valign="top" style="font-weight: bold; text-align: left; text-transform: uppercase; display: inline-block; margin-top: -10px;">
                                                                <?php echo $exam->session; ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>

                                                </table>
                                            </td>
                                            <td valign="top" align="center"><?php
                                            if ($template->left_logo != "") {
                                                ?><img src="<?php echo base_url('uploads/marksheet/' . $template->left_logo); ?>" width="100" height="100"><?php } ?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <?php
                            if ($template->is_admission_no || $template->is_roll_no || $template->is_photo) {
                                ?>
                                <tr>
                                    <td valign="top">
                                        <table cellpadding="0" cellspacing="0" width="100%" class="">
                                            <tr>
                                                <td valign="top">
                                                    <table cellpadding="0" cellspacing="0" width="98%" class="denifittable">

                                                        <tr>

                                                            <?php
                                                            if ($template->is_admission_no) {
                                                                ?>
                                                                <th valign="top" style="text-align: center; text-transform: uppercase;">
                                                                    <?php echo $this->lang->line('admission_no') ?>
                                                                </th>
                                                                <?php
                                                            }
                                                            if ($template->is_roll_no) {
                                                                ?>
                                                                <th valign="top" style="text-align: center; text-transform: uppercase; border-right:1px solid #999"><?php echo $this->lang->line('roll_no') ?></th>
                                                                <?php
                                                            }
                                                            ?>



                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            if ($template->is_admission_no) {
                                                                ?>

                                                                <td valign="" style="text-transform: uppercase;text-align: center;"><?php echo $student_value['admission_no']; ?></td>
                                                                <?php
                                                            }
                                                            if ($template->is_roll_no) {
                                                                ?>
                                                                <td valign="" style="text-transform: uppercase;text-align: center;border-right:1px solid #999">   <?php echo $student_value['exam_result']['exam_roll_no_' . $exam->id]; ?>
                                                                </td>
                                                                <?php
                                                            }
                                                            ?>



                                                        </tr>

                                                        <tr>
                                                            <td valign="top" colspan="5" style="text-align: center; text-transform: uppercase; border:0">

                                                                <?php echo $this->lang->line('certificated_that') ?></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <?php
                                                if ($template->is_photo) {
                                                    ?>
                                                    <td valign="top" align="center"><?php if($student_value['image']!=''){ ?><img src="<?php echo base_url() . $student_value['image']; ?>" width="120" height="150" style="border: 2px solid #fff;
                                                                                         outline: 1px solid #000000;"><?php } ?>
                                                    </td>
                                                    <?php
                                                }
                                                ?>

                                            </tr>

                                        </table>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>

                            <tr>
                                <td valign="top">
                                    <table cellpadding="0" cellspacing="0" width="100%" class="">


                                        <?php
                                        if ($template->is_name) {
                                            ?>
                                            <tr>

                                                <td valign="top" style="text-transform: uppercase; padding-bottom: 15px;"><?php echo $this->lang->line('name_prefix'); ?><span style="padding-left: 30px; font-weight: bold;"><?php echo $student_value['firstname'] . " " . $student_value['lastname']; ?></span></td>
                                            </tr>
                                            <?php
                                        }

                                        if ($template->is_father_name) {
                                            ?>
                                            <tr>
                                                <td valign="top" style="text-transform: uppercase; padding-bottom: 15px;"><?php echo $this->lang->line('marksheet_father_name') ?><span style="padding-left: 30px; font-weight: bold;"><?php echo $student_value['father_name']; ?></span></td>
                                            </tr>
                                            <?php
                                        }

                                        if ($template->is_mother_name) {
                                            ?>
                                            <tr>
                                                <td valign="top" style="text-transform: uppercase; padding-bottom: 15px;"><?php echo $this->lang->line('exam_mother_name'); ?><span style="padding-left: 30px; font-weight: bold;"><?php echo $student_value['mother_name']; ?></span></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>


                                        <?php
                                        if ($template->school_name != "") {
                                            ?>
                                            <tr>
                                                <td valign="top" style="text-transform: uppercase; padding-bottom: 15px;"> <?php echo $this->lang->line('school_name'); ?><span style="padding-left: 30px; font-weight: bold;"><?php echo $template->school_name; ?></span></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>

                                        <tr>
                                            <td valign="top" style="text-transform: uppercase; padding-top: 15px; padding-bottom: 20px;" ><?php echo $this->lang->line('exam') . " " . $this->lang->line('center') ?><span style="text-transform: uppercase; padding-top: 15px; font-weight: bold; padding-bottom: 20px; padding-left: 30px;"><?php echo $template->exam_center; ?></span></td>

                                        </tr>
                                        <?php
                                        if ($template->content != "") {
                                            ?>
                                            <tr>
                                                <td valign="top" style="text-transform: uppercase; padding-bottom: 15px; line-height: normal;"><?php echo $template->content ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </table>
                                </td>
                            </tr>
                            <?php
                            if (!empty($student_value['exam_result']['exam_result_' . $exam->id])) {
                                ?>

                                <tr>
                                    <td valign="top">


                                        <?php
                                        if (!empty($student_value['exam_result']['exam_result_' . $exam->id])) {
                                            ?>
                                            <table cellpadding="0" cellspacing="0" width="100%" class="denifittable" style="text-align: center;">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo $this->lang->line('subjects') ?></th>
                                                        <?php
                                                        if ($exam->exam_group_type != "gpa") {
                                                            ?>
                                                            <th><?php echo $this->lang->line('max') ?></th>
                                                            <th><?php echo $this->lang->line('min') ?></th>
                                                            <th><?php echo $this->lang->line('marks') . " " . $this->lang->line('obtained') ?></th>
                                                            <?php
                                                        } else if ($exam->exam_group_type == "gpa") {
                                                            ?>
                                                            <th class="text-center"><?php echo $this->lang->line('grade') . " " . $this->lang->line('point') ?></th>
                                                            <th class="text-center"><?php echo $this->lang->line('credit') . " " . $this->lang->line('hours') ?></th>
                                                            <th class="text-center"><?php echo $this->lang->line('quality') . " " . $this->alng->line('point') ?></th>
                                                            <?php
                                                        }

                                                        if ($exam->exam_group_type == "school_grade_system" || $exam->exam_group_type == "coll_grade_system") {
                                                            ?>
                                                            <th><?php echo $this->lang->line('grade') ?>></th>
                                                            <?php
                                                        }
                                                        ?>
                                                        <th valign="top" style="text-align: left;border-right:1px solid #999"><?php echo $this->lang->line('remark') ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $total_max_marks = 0;
                                                    $total_obtain_marks = 0;
                                                    $total_points = 0;
                                                    $total_hours = 0;
                                                    $total_quality_point = 0;
                                                    $result_status = 1;
                                                    $absent_status = false;

                                                    foreach ($student_value['exam_result']['exam_result_' . $exam->id] as $exam_result_key => $exam_result_value) {

                                                        $total_max_marks = $total_max_marks + $exam_result_value->max_marks;
                                                        $total_obtain_marks = $total_obtain_marks + $exam_result_value->get_marks;
                                                        if ($exam_result_value->attendence == "absent") {
                                                            $absent_status = true;
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td>

                                                                <?php echo $exam_result_value->name . "(" . $exam_result_value->code . ")"; ?>
                                                            </td>
                                                            <?php
                                                            if ($exam->exam_group_type != "gpa") {
                                                                ?>
                                                                <td>
                                                                    <?php echo $exam_result_value->max_marks; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $exam_result_value->min_marks; ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    echo $exam_result_value->get_marks;

                                                                    if ($exam_result_value->attendence == "absent") {
                                                                        echo "&nbsp;" . $this->lang->line('exam_absent');
                                                                    }
                                                                    if ($exam_result_value->get_marks < $exam_result_value->min_marks) {

                                                                        $result_status = 0;
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <?php
                                                            } else if ($exam->exam_group_type == "gpa") {
                                                                ?>
                                                                <td class="text-center">
                                                                    <?php
                                                                    $percentage_grade = ($exam_result_value->get_marks * 100) / $exam_result_value->max_marks;
                                                                    $point = findGradePoints($exam_grades, $percentage_grade);
                                                                    $total_points = $total_points + $point;
                                                                    echo $point;
                                                                    ?>

                                                                </td>
                                                                <td class="text-center">
                                                                    <?php
                                                                    $total_hours = $total_hours + $exam_result_value->credit_hours;
                                                                    echo ($exam_result_value->credit_hours);
                                                                    ?>

                                                                </td>
                                                                <td class="text-center">
                                                                    <?php
                                                                    echo ($exam_result_value->credit_hours * $point);
                                                                    $total_quality_point = $total_quality_point + ($exam_result_value->credit_hours * $point);
                                                                    ?>

                                                                </td>
                                                                <?php
                                                            }

                                                            if ($exam->exam_group_type == "school_grade_system" || $exam->exam_group_type == "coll_grade_system") {
                                                                ?>
                                                                <td>

                                                                    <?php
                                                                    $percentage_grade = ($exam_result_value->get_marks * 100) / $exam_result_value->max_marks;
                                                                    echo findGrade($exam_grades, $percentage_grade);
                                                                    ?>
                                                                </td>
                                                                <?php
                                                            }
                                                            ?>

                                                            <td valign="top" style="text-align: left;border-right:1px solid #999">
                                                                <?php
                                                                if ($exam->exam_group_type == "basic_system") {
                                                                    if ($exam_result_value->get_marks < $exam_result_value->min_marks) {
                                                                        $result_status = 0;
                                                                        echo "(F) ";
                                                                    }
                                                                }
                                                                echo $exam_result_value->note;
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>


                                                    <?php
                                                    if ($exam->exam_group_type != "gpa") {
                                                        ?>
                                                        <tr>
                                                            <td></td>
                                                            <td>
                                                                <?php echo number_format($total_max_marks, 2, '.', ''); ?>
                                                            </td>
                                                            <td><?php echo $this->lang->line('grand_total') ?></td>
                                                            <td>
                                                                <?php echo number_format($total_obtain_marks, 2, '.', ''); ?>
                                                            </td>
                                                            <td valign="top" style="text-align: left;border-right:1px solid #999"></td>
                                                            <?php
                                                            if ($exam->exam_group_type == "school_grade_system" || $exam->exam_group_type == "coll_grade_system") {
                                                                ?>
                                                                <td valign="top" style="text-align: left;border-right:1px solid #999"></td>
                                                                <?php
                                                            }
                                                            ?>

                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $this->lang->line('percentage') ?></td>
                                                            <td>
                                                                <?php
                                                                echo number_format((($total_obtain_marks * 100) / $total_max_marks), 2, '.', '');
                                                                $percentage_total = (($total_obtain_marks * 100) / $total_max_marks);
                                                                ?>
                                                            </td>
                                                            <td></td>
                                                            <td>


                                                            </td>
                                                            <td valign="top" style="text-align: left;border-right:1px solid #999"></td>
                                                            <?php
                                                            if ($exam->exam_group_type == "school_grade_system" || $exam->exam_group_type == "coll_grade_system") {
                                                                ?>
                                                                <td valign="top" style="text-align: left;border-right:1px solid #999"></td>
                                                                <?php
                                                            }
                                                            ?>

                                                        </tr>
                                                        <?php
                                                    } else if ($exam->exam_group_type == "gpa") {
                                                        ?>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td class="text-center">
                                                                <?php
                                                                echo number_format($total_hours, 2, '.', '');
                                                                ?>

                                                            </td>
                                                            <td class="text-center">
                                                                <?php
                                                                $exam_qulity_point = number_format($total_quality_point / $total_hours, 2, '.', '');

                                                                echo $total_quality_point . "/" . $total_hours . "=" . $exam_qulity_point;
                                                                ?>

                                                            </td>
                                                            <td></td>

                                                            <?php
                                                        }
                                                        ?>


                                                </tbody>
                                            </table>

                                            <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" height="30"></td></tr>
                                <?php
                                if ($exam->exam_group_type != "gpa") {
                                    ?>
                                    <tr>
                                        <td valign="top" colspan="5" width="20%" style="font-weight: normal; text-align: left; border-top:0">
                                            Result
                                            <span style="border-left:0;text-align: left;font-weight: bold; padding-left: 30px;">
                                                <?php
                                                if ($result_status == 0 || $absent_status) {
                                                    echo $this->lang->line('fail');
                                                } else {

                                                    if ($percentage_total > 40) {
                                                        echo $this->lang->line('pass');
                                                    } else {
                                                        echo $this->lang->line('fail');
                                                    }
                                                }
                                                ?>

                                            </span>
                                        </td>

                                    </tr>

                                    <?php
                                    if ($template->is_division) {
                                        ?>
                                        <tr>
                                            <td valign="top" colspan="5" width="20%" style="font-weight: normal; text-align: left; border-top:0">
                                                Division
                                                <span style="border-left:0;text-align: left;font-weight: bold; padding-left: 30px;">
                                                    <?php
                                                    if ($percentage_total >= 60) {
                                                        echo $this->lang->line('first');
                                                    } elseif ($percentage_total >= 50 && $percentage_total < 60) {
                                                        echo $this->lang->line('second');
                                                    } elseif ($percentage_total >= 0 && $percentage_total < 50) {
                                                        echo $this->lang->line('third');
                                                    } else {
                                                        
                                                    }
                                                    ?>

                                                </span>
                                            </td>

                                        </tr>
                                        <?php
                                    }
                                    ?>

                                    <tr>
                                        <td valign="top" style="font-weight: bold; padding-left: 30px; padding-top: 10px;"><?php echo $template->date; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                <tr><td valign="top" height="30"></td></tr>
                                <tr>
                                    <td valign="top" style="padding-top: 10px;">
                                        <?php
                                        if (!empty($student_value['exam_result'])) {
                                            $consolidate_weightage_marks_total = 0;
                                            $consolidate_marks_exam_total = 0;
                                            $is_consoledate = 1;
                                            $consolidate_exam_status = true;

                                            foreach ($marksheet['exams'] as $each_exam_key => $each_exam_value) {

                                                if (empty($marksheet['students'][$student_key]['exam_result']['exam_result_' . $each_exam_value->id])) {
                                                    $is_consoledate = 0;
                                                }
                                            }
                                            ?>
                                            <table cellpadding="0" cellspacing="0" width="100%" class="denifittable" style="text-align: center; text-transform: uppercase;">
                                                <thead>

                                                    <tr>
                                                        <th> <?php echo $this->lang->line('exam'); ?></th>

                                                        <?php
// print_r($marksheet['exams']);

                                                        foreach ($marksheet['exams'] as $each_exam_key => $each_exam_value) {
                                                            ?>
                                                            <th> <?php echo $each_exam_value->exam; ?></th>
                                                            <?php
                                                        }
                                                        ?>
                                                        <th valign="top" style="text-align: left;border-right:1px solid #999"><?php echo $this->lang->line('consolidate') ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Marks Obtained</td>
                                                        <?php
                                                        foreach ($marksheet['exams'] as $each_exam_key => $each_exam_value) {
                                                            if ($is_consoledate) {
                                                                ?>
                                                                <td>
                                                                    <?php
                                                                    $s = examTotalResult($marksheet['students'][$student_key]['exam_result']['exam_result_' . $each_exam_value->id]);
                                                                    $sss = json_decode($s);

                                                                    if (!$sss->exam_result) {
                                                                        $consolidate_exam_status = false;
                                                                    }

                                                                    $percentage_grade = (($sss->get_marks * 100) / $sss->max_marks);
                                                                    // echo $sss->get_marks . "/" . $sss->max_marks . "[" . findGrade($exam_grades, $percentage_grade) . "]";

                                                                    $consolidate_marks_exam_total = $consolidate_marks_exam_total + $sss->max_marks;
                                                                    $weightage_marks = getWeightageExam($marksheet['exam_connection_list'], $each_exam_value->id, $sss->get_marks);
                                                                    $consolidate_weightage_marks_total = $weightage_marks + $consolidate_weightage_marks_total;
                                                                    echo number_format($weightage_marks, 2, '.', '');
                                                                    if (!$sss->exam_result) {
                                                                        echo "&nbsp;(F) ";
                                                                    }
                                                                    ?>


                                                                </td>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <td>
                                                                    --

                                                                </td>
                                                                <?php
                                                            }
                                                        }

                                                        if ($is_consoledate) {
                                                            ?>
                                                            <td valign="top" style="text-align: left;border-right:1px solid #999">
                                                                <?php
                                                                $percentage_grade_weightage = (($consolidate_weightage_marks_total * 100) / $consolidate_marks_exam_total);
                                                                echo $consolidate_weightage_marks_total . "/" . $consolidate_marks_exam_total . " [" . findGrade($exam_grades, $percentage_grade_weightage) . "]";
                                                                ?>
                                                            </td>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <td>
                                                                --

                                                            </td>
                                                            <?php
                                                        }
                                                        ?>




                                                    </tr>
                                                </tbody>

                                            </table>


                                            <?php
                                            if (!$consolidate_exam_status) {

                                                echo $this->lang->line('result') . " " . $this->lang->line('fail');
                                            } else {

                                                echo $this->lang->line('result') . " " . $this->lang->line('pass');
                                            }
                                            ?>
                                            Division
                                            <span style="border-left:0;text-align: left;font-weight: bold; padding-left: 30px;">
                                                <?php
                                                $consolidate_percentage_total = ($consolidate_weightage_marks_total * 100) / $consolidate_marks_exam_total;
                                                if ($consolidate_percentage_total >= 60) {
                                                    echo $this->lang->line('first');
                                                } elseif ($consolidate_percentage_total >= 50 && $consolidate_percentage_total < 60) {
                                                    echo $this->lang->line('second');
                                                } elseif ($consolidate_percentage_total >= 0 && $consolidate_percentage_total < 50) {
                                                    echo $this->lang->line('third');
                                                } else {
                                                    
                                                }
                                                ?>

                                            </span>

                                            <?php
                                        }
                                        ?>
                                    </td>
                                </tr>

                                <?php
                            }
                            ?>



                            <tr><td valign="top" height="30"></td></tr>
                            <?php
                            if ($template->content_footer != "") {
                                ?>
                                <tr>
                                    <td valign="top" style="text-transform: uppercase; padding-bottom: 15px; line-height: normal;"><?php echo $template->content_footer ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            <tr>
                                <td valign="top">
                                    <table cellpadding="0" cellspacing="0" width="100%" class="">
                                        <tr>
                                            <td valign="bottom" style="font-size: 12px;">

                                            </td>
                                            <td valign="bottom" align="center" style="text-transform: uppercase;">
                                                <?php
                                            if ($template->left_sign != "") {
                                                ?>
                                                <img src="<?php echo base_url('uploads/marksheet/' . $template->left_sign); ?>"  width="100" height="50"><?php } ?>
                                                <p><?php echo $this->lang->line('seal_and_signature_of_the_principal'); ?></p></td>
                                            <td valign="bottom" align="center" style="text-transform: uppercase;">
                                                <?php
                                            if ($template->middle_sign != "") {
                                                ?>
                                                <img src="<?php echo base_url('uploads/marksheet/' . $template->middle_sign); ?>" width="100" height="50">
                                            <?php } ?>
                                                <p><?php echo $this->lang->line('secretary'); ?></p></td>
                                            <td valign="bottom" align="center" style="text-transform: uppercase;">
                                                 <?php
                                            if ($template->right_sign != "") {
                                                ?>
                                                <img src="<?php echo base_url('uploads/marksheet/' . $template->right_sign); ?>" width="100" height="50">
                                            <?php } ?>
                                                <p><?php echo $this->lang->line('secretary'); ?></p></td>


                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr><td valign="top" height="20"></td></tr>
                        </table>
                    </div>
                </body>
            </html>
            <div class="pagebreak"> </div>
            <?php
        }
    } else {
        
    }
}
?>

<?php

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

function findGradePoints($exam_grades, $percentage) {

    if (!empty($exam_grades)) {
        foreach ($exam_grades as $exam_grade_key => $exam_grade_value) {

            if ($exam_grade_value->mark_from >= $percentage && $exam_grade_value->mark_upto <= $percentage) {
                return $exam_grade_value->point;
            }
        }
    }

    return 0;
}

function examTotalResult($array) {
    $return_array = array('max_marks' => 0, 'min_marks' => 0, 'credit_hours' => 0, 'get_marks' => 0, 'exam_result' => true);
    if (!empty($array)) {
        $max_marks = 0;
        $min_marks = 0;
        $credit_hours = 0;
        $get_marks = 0;
        $exam_result = true;
        foreach ($array as $array_key => $array_value) {
            if ($array_value->attendence == "absent") {
                $exam_result = false;
            }
            $max_marks = $max_marks + $array_value->max_marks;
            $min_marks = $min_marks + $array_value->min_marks;
            $credit_hours = $credit_hours + $array_value->credit_hours;
            $get_marks = $get_marks + $array_value->get_marks;
        }
        $return_array = array('max_marks' => $max_marks, 'min_marks' => $min_marks, 'credit_hours' => $credit_hours, 'get_marks' => $get_marks, 'exam_result' => $exam_result);
    }
    return json_encode($return_array);
}

function getWeightageExam($exam_connection_list, $examid, $get_marks) {

    foreach ($exam_connection_list as $exam_connection_key => $exam_connection_value) {
        if ($exam_connection_value->exam_group_class_batch_exams_id == $examid) {
            return ($get_marks * $exam_connection_value->exam_weightage) / 100;
        }
    }
    return "";
}
?>