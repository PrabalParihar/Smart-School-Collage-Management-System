<link rel="stylesheet" href="<?php echo base_url(); ?>backend/calender/zabuto_calendar.min.css">
<script type="text/javascript" src="<?php echo base_url(); ?>backend/calender/zabuto_calendar.min.js"></script>
<style>
    .grade-1 {
        background-color: #FA2601;
    }
    .grade-2 {
        background-color: #FA8A00;
    }
    .grade-3 {
        background-color: #FFEB00;
    }
    .grade-4 {
        background-color: #27AB00;
    }
    .grade-5 {
        background-color: #a7a7a7;
    }
</style>

<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('student_information'); ?> <small><?php echo $this->lang->line('student1'); ?></small></h1>
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
                            <?php echo $this->lang->line('attendance'); ?>
                        </h3>
                    </div>                  
                    <div class="box-body">
                        <div id="my-calendar"></div>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>

<!-- initialize the calendar on ready -->
<script type="application/javascript">
    $(document).ready(function () {
    var  base_url = '<?php echo base_url() ?>';
    var student_session_id='<?php echo $student['student_session_id']; ?>';
    $("#my-calendar").zabuto_calendar({
    legend: [
    {type: "block", label: "<?php echo $this->lang->line('absent') ?>", classname: 'grade-1'},
    {type: "block", label: "<?php echo $this->lang->line('present') ?>", classname: 'grade-4'},
    {type: "block", label: "<?php echo $this->lang->line('late') ?>", classname: 'grade-3'},
    {type: "block", label: "<?php echo $this->lang->line('half_day') ?>", classname: 'grade-2'},
    {type: "block", label: "<?php echo $this->lang->line('holiday') ?>", classname: 'grade-5'},
    ],
    ajax: {
    url: base_url+"parent/parents/getAjaxAttendence?grade=1&student_session="+student_session_id,
    }
    });
    });
</script>