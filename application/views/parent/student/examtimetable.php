<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('student_information'); ?> <small><?php echo $this->lang->line('student1'); ?></small></h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <?php echo $this->lang->line('exam_timetable'); ?>
                        </h3>
                    </div>
                    <div class="box-body">
                        <h4 class="page-header"><?php echo $exam_name; ?></h4>
                        <?php
                        if (empty($examSchedule)) {
                            ?>
                            <div class="alert alert-danger">
                                No fees Found.
                            </div>
                            <?php
                        } else {
                            ?>
                         <div class="table-responsive">   
                            <div class="download_label"><?php echo $this->lang->line('exam_timetable'); ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('subject'); ?></th>
                                        <th class="text text-center"><?php echo $this->lang->line('date'); ?></th>
                                        <th class="text text-center"><?php echo $this->lang->line('start_time'); ?></th>
                                        <th class="text text-center"><?php echo $this->lang->line('end_time'); ?></th>
                                        <th class="text text-center"><?php echo $this->lang->line('room'); ?></th>
                                        <th class="text text-center"><?php echo $this->lang->line('full_marks'); ?></th>
                                        <th class="text text-right"><?php echo $this->lang->line('passing_marks'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($examSchedule as $key => $exam) {
                                        ?>
                                        <tr>
                                            <td><?php echo $exam['name'] . " (" . substr($exam['type'], 0, 2) . ") "; ?></td>
                                            <td class="text text-center">
                                                <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($exam['date_of_exam'])) ?>
                                            </td>
                                            <td class="text text-center"><?php echo $exam['start_to']; ?></td>
                                            <td class="text text-center"><?php echo $exam['end_from']; ?></td>
                                            <td class="text text-center"><?php echo $exam['room_no']; ?></td>
                                            <td class="text text-center"><?php echo $exam['full_marks']; ?></td>
                                            <td class="text pull-right"><?php echo $exam['passing_marks']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                          </div>  
                            <?php
                        }
                        ?>
                    </div>
                </div>

            </div>
        </div>
</div>
</section>
</div>