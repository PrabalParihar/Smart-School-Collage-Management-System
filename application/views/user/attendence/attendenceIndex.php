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

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-calendar-check-o"></i> <?php echo $this->lang->line('attendance'); ?></small>        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                    </div>
                    <div class="box-body">
                        <div id="my-calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="application/javascript">
    $(document).ready(function () {
    var  base_url = '<?php echo base_url() ?>';
    $("#my-calendar").zabuto_calendar({
    legend: [
    {type: "block", label: "<?php echo $this->lang->line('absent') ?>", classname: 'grade-1'},
    {type: "block", label: "<?php echo $this->lang->line('present') ?>", classname: 'grade-4'},
    {type: "block", label: "<?php echo $this->lang->line('late') ?>", classname: 'grade-3'},
    {type: "block", label: "<?php echo $this->lang->line('half_day') ?>", classname: 'grade-2'},
    {type: "block", label: "<?php echo $this->lang->line('holiday') ?>", classname: 'grade-5'},
    ],
    ajax: {
    url: base_url+"user/attendence/getAttendence?grade=1",
    }
    });
    });
</script>