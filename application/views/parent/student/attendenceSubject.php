
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
                         <div class="form-group">

                            <label for="exampleInputEmail1"><?php echo $this->lang->line('date'); ?></label>
                            <input id="dob" name="dob" placeholder="" type="text" class="form-control date" value="<?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat(date('Y-m-d'))); ?>" />



                        </div>
                        <div class="attendance_result">

                        </div>

                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var student_id="<?php echo $student['id']?>";
          var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy']) ?>';
        attendance.result($('#dob').val(),student_id);
        $('.date').datepicker({
            format: date_format,
            autoclose: true,

        }).on('changeDate',dateChanged);

function dateChanged(ev) {
    var  date =$('#dob').val();
  attendance.result(date,student_id);

}

    });

    attendance = {
        result: function (date_var,student_id) {

            $.ajax({
                url: baseurl +"parent/parents/getdaysubattendence",
                type: "POST",
                data: {'date':date_var,'student_id':student_id},
                dataType: 'json',

                beforeSend: function () {


                },
                success: function (res)
                {
$('.attendance_result').html(res.result_page);

                },
                error: function (xhr) { // if error occured
                    alert("Error occured.please try again");

                },
                complete: function () {

                }

            });
        }
    }
//function call

</script>