<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('student_information'); ?> <small><?php echo $this->lang->line('student1'); ?></small>        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url() . $student['image'] ?>" alt="User profile picture">
                        <h3 class="profile-username text-center"><?php echo $student['firstname'] . " " . $student['lastname']; ?></h3>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('admission_no'); ?></b> <a class="pull-right"><?php echo $student['admission_no']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('roll_no'); ?></b> <a class="pull-right"><?php echo $student['roll_no']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('class'); ?></b> <a class="pull-right"><?php echo $student['class']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('section'); ?></b> <a class="pull-right"><?php echo $student['section']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('rte'); ?></b> <a class="pull-right"><?php echo $student['rte']; ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <?php echo $this->lang->line('exam_result'); ?>
                        </h3>
                    </div>
                    <div class="box-body">
                        <?php
                        if (empty($examSchedule)) {
                            ?>
                            <div class="alert alert-danger">
                                <?php echo $this->lang->line('no_exam_prepare'); ?>
                            </div>
                            <?php
                        } else {
                            ?>
                            <?php
                            $counter = 1;
                            foreach ($examSchedule as $key => $value) {
                                ?>
                                <div id="<?php echo 'print_view' . $counter ?>">
                                    <button type='button' class="btn btn-default btn-sm pull-right no-print" onclick="printDiv('<?php echo "#print_view" . $counter ?>');"><i class="fa fa-print"></i></button>
                                    <h4 class="page-header"><?php echo $value['exam_name']; ?></h4>
                                    <div class="download_label"><?php echo $this->lang->line('exam_marks_report'); ?></div>
                                    <table class="table table-striped table-bordered table-hover example">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <?php echo $this->lang->line('subject'); ?>
                                                </th>
                                                <th>
                                                    <?php echo $this->lang->line('full_marks'); ?>
                                                </th>
                                                <th>
                                                    <?php echo $this->lang->line('passing_marks'); ?>
                                                </th>
                                                <th>
                                                    <?php echo $this->lang->line('obtain_marks'); ?>
                                                </th>
                                                <th class="text text-right">
                                                    <?php echo $this->lang->line('result'); ?>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $obtain_marks = 0;
                                            $total_marks = 0;
                                            $result = "Pass";
                                            $exam_results_array = $value['exam_result'];
                                            foreach ($exam_results_array as $result_k => $result_v) {
                                                $total_marks = $total_marks + $result_v['full_marks'];
                                                ?>
                                                <tr>
                                                    <td>  <?php
                                                        echo $result_v['exam_name'] . " (" . substr($result_v['exam_type'], 0, 2) . ".) ";
                                                        ?></td>
                                                    <td><?php echo $result_v['full_marks']; ?></td>
                                                    <td><?php echo $result_v['passing_marks']; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($result_v['attendence'] == "pre") {
                                                            echo $get_marks_student = $result_v['get_marks'];
                                                            $passing_marks_student = $result_v['passing_marks'];
                                                            if ($result == "Pass") {
                                                                if ($get_marks_student < $passing_marks_student) {
                                                                    $result = "Fail";
                                                                }
                                                            }
                                                            $obtain_marks = $obtain_marks + $result_v['get_marks'];
                                                        } else {
                                                            $result = "Fail";
                                                            echo ($result_v['attendence']);
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="text text-center">
                                                        <?php
                                                        if ($result_v['attendence'] == "pre") {
                                                            $passing_marks_student = $result_v['passing_marks'];

                                                            if ($get_marks_student < $passing_marks_student) {
                                                                echo "<span class='label pull-right bg-red'>" . $this->lang->line('fail') . "</span>";
                                                            } else {
                                                                echo "<span class='label pull-right bg-green'>" . $this->lang->line('pass') . "</span>";
                                                            }
                                                        } else {
                                                            echo "<span class='label pull-right bg-red'>" . $this->lang->line('fail') . "</span>";
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <div class="row">                                      
                                        <div class="col-sm-4 border-right col-md-offset-4 pull">
                                            <div class="description-block">
                                                <h5 class="description-header"><?php echo $this->lang->line('total_marks'); ?>:
                                                    <span class="description-text"><?php echo $obtain_marks . " /" . $total_marks; ?></span>
                                                </h5>
                                            </div>                                         
                                        </div>                                      
                                        <div class="col-sm-4 pull">
                                            <div class="description-block">
                                                <h5 class="description-header"><?php echo $this->lang->line('result'); ?>:
                                                    <span class="description-text">
                                                        <?php
                                                        if ($result == "Pass") {

                                                            echo "<b class='text text-success'>";
                                                        } else {

                                                            echo "<b class='text text-danger'>";
                                                        }
                                                        echo $result;
                                                        echo "<b/>";
                                                        ?>
                                                    </span>
                                                </h5>
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
            </div>
        </div>
    </section>   
</div>

<script type="text/javascript">
    var base_url = '<?php echo base_url() ?>';
    function printDiv(elem) {
        Popup(jQuery(elem).html());
    }

    function Popup(data) {
        var mywindow = window.open('', 'my div', 'height=400,width=600');
        mywindow.document.write('<html><head><title></title>');
        mywindow.document.write('<link rel="stylesheet" href="' + base_url + 'backend/bootstrap/css/bootstrap.min.css">');
        mywindow.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/font-awesome.min.css">');
        mywindow.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/ionicons.min.css">');
        mywindow.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/AdminLTE.min.css">');
        mywindow.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/skins/_all-skins.min.css">');
        mywindow.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/iCheck/flat/blue.css">');
        mywindow.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/morris/morris.css">');
        mywindow.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">');
        mywindow.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/datepicker/datepicker3.css">');
        mywindow.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/daterangepicker/daterangepicker-bs3.css">');
        mywindow.document.write('<style type="text/css">.test { color:red; } </style></head><body>');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');
        mywindow.document.close();
        mywindow.print();
    }
</script>