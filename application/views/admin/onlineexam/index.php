<?php
$language      = $this->customlib->getLanguage();
$language_name = $language["short_code"];

?>
<div class="content-wrapper">

    <section class="content">
        <div class="row">

            <div class="col-md-12">
                <div class="box box-primary" id="route">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">  <?php echo $this->lang->line('online') . " " . $this->lang->line('exam') . " " . $this->lang->line('list'); ?></h3>
                        <?php if ($this->rbac->hasPrivilege('online_examination', 'can_add')) {?>
                        <button class="btn btn-primary btn-sm pull-right question-btn" data-recordid="0"><i class="fa fa-plus"></i> <?php echo $this->lang->line('add') . " " . $this->lang->line('exam') ?></button>
                    <?php }?>
                    </div>
                    <div class="box-body">
                        <div class="mailbox-controls">
                            <div class="pull-right">
                            </div>
                        </div>
                        <div class="mailbox-messages">
                            <div class="download_label"><?php ?> <?php echo $this->lang->line('online') . " " . $this->lang->line('exam') . " " . $this->lang->line('list'); ?></div>
                            <div class="table-responsive">
                             <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>

                                        <th><?php echo $this->lang->line('exam'); ?></th>
                                        <th><?php echo $this->lang->line('attempt'); ?></th>
                                        <th><?php echo $this->lang->line('exam') . " " . $this->lang->line('from') ?></th>
                                        <th><?php echo $this->lang->line('exam') . " " . $this->lang->line('to') ?></th>
                                        <th><?php echo $this->lang->line('duration') ?></th>

                                        <th class="text text-center"><?php echo $this->lang->line('exam') . " " . $this->lang->line('publish') ?></th>
                                        <th class="text text-center"><?php echo $this->lang->line('result') . " " . $this->lang->line('publish') ?></th>


                                        <th class="text-right no-print"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
$count = 1;
foreach ($questionList as $subject_key => $subject_value) {
    ?>
                                        <tr>
                                            <td class="mailbox-name"> <?php echo $subject_value->exam; ?></td>
                                            <td class="mailbox-name"> <?php echo $subject_value->attempt; ?></td>
                                            <td class="mailbox-name"> <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($subject_value->exam_from)); ?> </td>

                                            <td class="mailbox-name"> <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($subject_value->exam_to)); ?> </td>

                                            <td class="mailbox-name"> <?php echo $subject_value->duration; ?></td>

                                      <td class="text text-center"><?php echo ($subject_value->is_active == 1) ? "<i class='fa fa-check-square-o'></i>" : "<i class='fa fa-exclamation-circle'></i>"; ?>
                                            <?php if ($subject_value->is_active == 1) {?>
                                                <span style="display:none;"  id=""><?php echo $this->lang->line('yes'); ?>
                                                </span>
                                            <?php }?>
                                      </td>
                                      <td class="text text-center">
                                <?php echo ($subject_value->publish_result == 1) ? "<i class='fa fa-check-square-o'></i><span style='display:none'>Yes</span>" : "<i class='fa fa-exclamation-circle'></i><span style='display:none'>No</span>"; ?></td>

                                            <td class="text-right">
                                                <?php
if ($this->rbac->hasPrivilege('online_assign_view_student', 'can_view')) {
        if (($subject_value->publish_result == 0)) {
            if ((strtotime($subject_value->exam_to) >= strtotime(date('Y-m-d')))) {
                ?>
                                  <a href="<?php echo base_url(); ?>admin/onlineexam/assign/<?php echo $subject_value->id ?>"
                                                   class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line('assign / view'); ?>">
                                                    <i class="fa fa-tag"></i>
                                                </a>
                                            <?php
}
        }

    }
    if ($this->rbac->hasPrivilege('add_questions_in_exam', 'can_view')) {
        ?>
                                                <button type="button" class="btn btn-default btn-xs" data-recordid="<?php echo $subject_value->id; ?>" data-toggle="modal" data-target="#myQuestionModal" title="<?php echo $this->lang->line('add') . " " . $this->lang->line('question') ?>"><i class="fa fa-plus"></i></button>
                                                <?php
}if ($this->rbac->hasPrivilege('online_examination', 'can_edit')) {
        ?>
                                                 <button type="button" class="btn btn-default btn-xs question-btn-edit" data-toggle="tooltip" id="load" data-recordid="<?php echo $subject_value->id; ?>"  ><i class="fa fa-pencil"></i></button>
                                                <?php
}
    if ($this->rbac->hasPrivilege('online_examination', 'can_delete')) {
        ?>
                                                <a data-placement="left" href="<?php echo base_url(); ?>admin/onlineexam/delete/<?php echo $subject_value->id; ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                    <i class="fa fa-remove"></i>
                                                </a>
                                            <?php
}
    ?>




                                            </td>
                                        </tr>
                                        <?php
}
$count++;
?>
                                </tbody>
                            </table>
                         </div>   
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
</div>


<?php

function findOption($questionOpt, $find)
{

    foreach ($questionOpt as $quet_opt_key => $quet_opt_value) {
        if ($quet_opt_key == $find) {
            return $quet_opt_value;
        }
    }
    return false;
}
?>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('exam') ?></h4>
            </div>
            <form action="<?php echo site_url('admin/onlineexam/add'); ?>" method="POST" id="formsubject">
                <div class="modal-body">
                    <input type="hidden" name="recordid" value="0">
                 <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="exam"><?php echo $this->lang->line('exam') . " " . $this->lang->line('title'); ?></label><small class="req"> *</small>
                            <input type="text" class="form-control" id="exam" name="exam">
                            <span class="text text-danger exam_error"></span>
                        </div>
                     </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="exam_from"><?php echo $this->lang->line('exam') . " " . $this->lang->line('from') ?></label><small class="req"> *</small>
                        <input type="text" class="form-control date" id="exam_from" name="exam_from">
                        <span class="text text-danger exam_from_error"></span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="exam_to"><?php echo $this->lang->line('exam') . " " . $this->lang->line('to'); ?></label><small class="req"> *</small>
                        <input type="text" class="form-control date" id="exam_to" name="exam_to">
                        <span class="text text-danger exam_to_error"></span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="duration"><?php echo $this->lang->line('time') . " " . $this->lang->line('duration') ?></label>
                        <input type="text" class="form-control timepicker" id="duration" name="duration">
                        <span class="text text-danger duration_error"></span>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="attempt"><?php echo $this->lang->line('attempt'); ?></label>
                        <input type="number" min="1" class="form-control" id="attempt" name="attempt" value="1">
                        <span class="text text-danger attempt_error"></span>
                    </div>
                </div>
                <div class="col-sm-4">
                      <div class="form-group">
                        <label for="attempt"><?php echo $this->lang->line('passing') . " " . $this->lang->line('percentage') ?></label><small class="req"> *</small>
                        <input type="number" min="1" max="100" class="form-control" id="passing_percentage" name="passing_percentage">
                        <span class="text text-danger passing_percentage_error"></span>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="checkbox">
                                        <label>
<input type="checkbox" class="is_active" name="is_active" value="1">
                                            <?php echo $this->lang->line('publish'); ?>
                                        </label>
                                    </div>
                                       <div class="checkbox">
                                        <label>
<input type="checkbox" class="publish_result" name="publish_result" value="1">
                                           <?php echo $this->lang->line('publish') . " " . $this->lang->line('result'); ?>
                                        </label>
                                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="description"><?php echo $this->lang->line('description'); ?></label><small class="req"> *</small>
                        <textarea class="form-control" id="description" name="description"></textarea>
                        <span class="text text-danger description_error"></span>
                    </div>
                </div>


                  </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Saving..."><?php echo $this->lang->line('save') ?></button>
                </div>
           </div>

        </form>
    </div>
</div>

<div id="myQuestionModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('select') . " " . $this->lang->line('questions') ?></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="modal_exam_id" value="0" id="modal_exam_id">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <label><?php echo $this->lang->line('subject') ?></label>
                            <select class="form-control" name="search_box" id="search_box" style="display: inline-block;">
                                <option value=""><?php echo $this->lang->line('select') ?></option>
                                        <?php
foreach ($subjectlist as $subject_key => $subject_value) {
    ?>
                                    <option value="<?php echo $subject_value['id']; ?>"><?php echo $subject_value['name']; ?></option>
                                    <?php
}
?>

                            </select>
                        </div>
                     </div>
                    <div class="col-md-2 col-sm-6">
                        <label style="display: block; visibility:hidden;">Search</label>
                        <button type="button" class="btn btn-info btn-sm post_search_submit"><?php echo $this->lang->line('search'); ?></button>
                    </div>

                </div><!-- ./row -->
                <div class="search_box_result" style="max-height: 480px;
                     overflow-x: hidden;overflow-y: scroll;">

                </div>
                <div class="search_box_pagination">

                </div>

            </div>

        </div>

    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: false
        })
        $('#myQuestionModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: false
        })
        var date_format = '<?php echo $result    = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy']) ?>';
        var date_format_js = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'MM', 'Y' => 'yyyy']) ?>';
        $('.date').datepicker({
            format: date_format,

             autoclose: true,
                language: '<?php echo $language_name ?>'
        });

        $(function () {
             var dateNow = new Date();
            $('.timepicker').datetimepicker({
                format: 'HH:mm:ss',

             defaultDate:moment(dateNow).hours(0).minutes(0).seconds(0).milliseconds(0)
            });
        });

        $('#myModal').on('hidden.bs.modal', function () {

            $(this).find("input,textarea,select")
                    .val('')
                    .end()
                    .find("input[type=checkbox], input[type=radio]")
                    .prop("checked", "")
                    .end();
        });
        $(document).on('click', '.question-btn', function () {
            var recordid = $(this).data('recordid');
            $('input[name=recordid]').val(recordid);
            $('#myModal').modal('show');

        });

        $('#myQuestionModal').on('show.bs.modal', function (e) {

            //get data-id attribute of the clicked element
            var exam_id = $(e.relatedTarget).data('recordid');
            $('#modal_exam_id').val(exam_id);

            //populate the textbox
            getQuestionByExam(1, exam_id);
        });
      $('#myQuestionModal').on('hidden.bs.modal', function (e) {

            $(this).find("input,textarea,select").val('');
                $('.search_box_result').html("");
                $('.search_box_pagination').html("");

        });


        $(document).on('click', '.question-btn-edit', function () {
            var $this = $(this);
            var recordid = $this.data('recordid');
            $('input[name=recordid]').val(recordid);
            $.ajax({
                type: 'POST',
                url: baseurl + "admin/onlineexam/getOnlineExamByID",
                data: {'recordid': recordid},
                dataType: 'JSON',
                beforeSend: function () {
                    $this.button('loading');
                },
                success: function (data) {
                    console.log(data.result);
                    if (data.status) {
                        var date_exam_from = new Date(data.result.exam_from);
                        var newDate_exam_from = date_exam_from.toString(date_format_js);
                        var date_exam_to = new Date(data.result.exam_to);
                        var newDate_exam_to = date_exam_to.toString(date_format_js);

                        $('#duration').val(data.result.duration);
                        $('#passing_percentage').val(data.result.passing_percentage);
                        $('#exam_to').datepicker("update", newDate_exam_to);
                        $('#exam_from').datepicker("update", newDate_exam_from);
                        $('#exam').val(data.result.exam);
                        $('#attempt').val(data.result.attempt);
                        $('#description').val(data.result.description);
                        var chk_status=(data.result.is_active == 0)?false:true;

                        $('input[name=is_active]').prop('checked',chk_status);

                          var chk_result_status=(data.result.publish_result == 0)?false:true;

                        $('input[name=publish_result]').prop('checked',chk_result_status);

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



    });

    $("form#formsubject").submit(function (e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.
        // $("span[id$='_error']").html("");
        var form = $(this);
        var url = form.attr('action');
        var submit_button = form.find(':submit');
        var post_params = form.serialize();


        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // serializes the form's elements.
            dataType: "JSON", // serializes the form's elements.
            beforeSend: function () {
                $("[class$='_error']").html("");
                submit_button.button('loading');
            },
            success: function (data)
            {

                if (!data.status) {
                    $.each(data.error, function (index, value) {
                        var errorDiv = '.' + index + '_error';
                        $(errorDiv).html(value);
                    });
                } else {
                    location.reload();
                }
            },
            error: function (xhr) { // if error occured
                submit_button.button('reset');
                alert("Error occured.please try again");

            },
            complete: function () {
                submit_button.button('reset');
            }
        });


    });

    function getQuestionByExam(page, exam_id) {
        var search = $("#search_box").val();
        $.ajax({
            type: "POST",
            url: base_url + 'admin/onlineexam/searchQuestionByExamID',
            data: {'page': page, 'exam_id': exam_id, 'search': search}, // serializes the form's elements.
            dataType: "JSON", // serializes the form's elements.
            beforeSend: function () {
                // $("[class$='_error']").html("");
                // submit_button.button('loading');
            },
            success: function (data)
            {

                $('.search_box_result').html(data.content);
                $('.search_box_pagination').html(data.navigation);

            },
            error: function (xhr) { // if error occured
                // submit_button.button('reset');
                alert("Error occured.please try again");

            },
            complete: function () {
                // submit_button.button('reset');
            }
        });

    }

    $(document).on('keyup', '#search_box', function (e) {

        if (e.keyCode == 13) {
            var _exam_id = $('#modal_exam_id').val();
            getQuestionByExam(1, _exam_id);
        }
    });


    /* Pagination Clicks   */
    $(document).on('click', '.search_box_pagination li.activee', function (e) {
        var _exam_id = $('#modal_exam_id').val();
        var page = $(this).attr('p');

        getQuestionByExam(page, _exam_id);
    });

    $(document).on('click', '.post_search_submit', function (e) {

        var _exam_id = $('#modal_exam_id').val();
        getQuestionByExam(1, _exam_id);
    });




    $(document).on('change', '.question_chk', function () {
        var _exam_id = $('#modal_exam_id').val();

        updateCheckbox($(this).val(), _exam_id);

    });

    function updateCheckbox(question_id, exam_id) {
        $.ajax({
            type: 'POST',
            url: base_url + 'admin/onlineexam/questionAdd',
            dataType: 'JSON',
            data: {'question_id': question_id, 'onlineexam_id': exam_id},
            beforeSend: function () {

            },
            success: function (data) {
                if (data.status) {
                    successMsg(data.message);
                }
            },
            error: function (xhr) { // if error occured
                alert("Error occured.please try again");

            },
            complete: function () {

            },

        });
    }

</script>