<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>

<div class="content-wrapper" style="min-height: 946px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-money"></i> <?php echo $this->lang->line('fees_collection'); ?> </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <?php $this->load->view('reports/_online_examinations');?>
        <div class="row">
           <div class="col-md-12">
            <div class="box removeboxmius">
             <div class="box-header ptbnull"></div>
            <form id='feesforward' action="<?php echo site_url('admin/onlineexam/report') ?>"  method="post" accept-charset="utf-8">

                        <div class="box-header with-border">

                            <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                            <div class="box-tools pull-right">
                            </div>
                        </div>

                        <div class="box-body">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <?php if ($this->session->flashdata('msg')) {?>
                                        <?php echo $this->session->flashdata('msg') ?>
                                    <?php }?>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('exam') ?><small class="req"> *</small></label>
                                        <select  id="exam_id" name="exam_id" class="form-control"  >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php
foreach ($examList as $exam_key => $exam_value) {
    ?>
                                                <option value="<?php echo $exam_value->id; ?>"<?php if (set_value('exam_id') == $exam_value->id) {
        echo "selected=selected";
    }
    ?>><?php echo $exam_value->exam; ?></option>
                                                <?php
$count++;
}
?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('exam_id'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
                                        <select  id="class_id" name="class_id" class="form-control"  >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php
foreach ($classlist as $class) {
    ?>
                                                <option value="<?php echo $class['id'] ?>"<?php if (set_value('class_id') == $class['id']) {
        echo "selected=selected";
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label><small class="req"> *</small>
                                        <select  id="section_id" name="section_id" class="form-control" >
                                            <option value=""   ><?php echo $this->lang->line('select'); ?></option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                    </div>
                                </div>


                        <div class="col-sm-12">
                          <div class="form-group">
                            <button type="submit" name="action" value ="search" class="btn btn-primary pull-right btn-sm"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php
if (isset($results)) {
    ?>
                        <div class="">
                            <div class="box-header ptbnull"></div>
                            <div class="box-header with-border">
                                <h3 class="box-title titlefix"> <?php echo $this->lang->line('online') . " " . $this->lang->line('exam') . " " . $this->lang->line('report') ?></h3>

                            </div>
                            <div class="box-body">
                                <div class="download_label"><?php ?> <?php echo $this->lang->line('online') . " " . $this->lang->line('exam') . " " . $this->lang->line('report') . "<br>";
    $this->customlib->get_postmessage(); ?></div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th><?php echo $this->lang->line('admission_no'); ?></th>
                                            <th><?php echo $this->lang->line('student_name'); ?></th>
                                            <th><?php echo $this->lang->line('class'); ?></th>

                                            <th><?php echo $this->lang->line('total') . " " . $this->lang->line('attempt'); ?></th>
                                            <th><?php echo $this->lang->line('remaining') . " " . $this->lang->line('attempt'); ?></th>
                                            <th><?php echo $this->lang->line('action') ?></th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
if (empty($results)) {
        ?>

                                            <?php
} else {
        $count = 1;

        foreach ($results as $student_key => $student) {
            //  print_r($student);

            ?>
                                                <tr>
                                                    <td><?php echo $student['admission_no']; ?></td>
                                                    <td>
                                                        <a href="<?php echo base_url(); ?>student/view/<?php echo $student['id']; ?>"><?php echo $student['firstname'] . " " . $student['lastname']; ?></a>
                                                    </td>
                                                    <td><?php echo $student['class'] . "(" . $student['section'] . ")" ?></td>
                                                    <td><?php echo $student['attempt'] ?></td>
                                                    <td><?php echo $student['attempt'] - $student['total_counter']; ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-info btn-xs question-btn-edit" data-toggle="tooltip" id="load" data-recordid="<?php echo $student['onlineexam_student_id']; ?>" data-examid="<?php echo $student['exam_id']; ?>"  data-loading-text="<i class='fa fa-spinner fa-spin'></i>"><i class="fa fa-eye"></i></button>
                                                    </td>
                                                </tr>
                                                <?php
$count++;
        }
    }
    ?>
                                    </tbody>
                                </table>
                              </div>  
                            </div>

                        </div>
                        <?php
}
?>


            </form>
            </div>
           </div>
        </div>
    </section>
</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('exam') ?></h4>
            </div>

            <div class="modal-body">
                <div class="result_exam"></div>
            </div>

        </div>

    </div>
</div>



<script type="text/javascript">


    $(document).ready(function () {

        var class_id = $('#class_id').val();
        var section_id = '<?php echo set_value('section_id', 0) ?>';
        var hostel_id = $('#hostel_id').val();
        var hostel_room_id = '<?php echo set_value('hostel_room_id', 0) ?>';

        getSectionByClass(class_id, section_id);
    });

    $(document).on('change', '#class_id', function (e) {
        $('#section_id').html("");
        var class_id = $(this).val();
        getSectionByClass(class_id, 0);
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



</script>



<script type="text/javascript">

    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy']) ?>';

    });

    $(document).on('click', '.question-btn-edit', function () {
        var $this = $(this);
        var recordid = $this.data('recordid');
        var examid = $this.data('examid');
        $('input[name=recordid]').val(recordid);
        $.ajax({
            type: 'POST',
            url: baseurl + "admin/onlineexam/getstudentresult",
            data: {'recordid': recordid,'examid':examid},
            dataType: 'JSON',
            beforeSend: function () {
                $this.button('loading');
            },
            success: function (data) {
                console.log(data.result);
                if (data.status) {
$('.result_exam').html(data.result);
                    $('#myModal').modal('show');
                }
                $this.button('reset');
            },
            error: function (xhr) { // if error occured
                alert("Error occured.please try again");
                $this.button('reset');
            },
            complete: function () {
                $this.button('reset');
            }
        });

    });

</script>
