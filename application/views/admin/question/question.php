<div class="content-wrapper">
    <section class="content-header">
        <h1><i class="fa fa-bus"></i> <?php echo $this->lang->line('question'); ?></h1>
    </section>
    <section class="content">
        <div class="row">

            <div class="col-md-12">
                <div class="box box-primary" id="route">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('question')." ".$this->lang->line('bank');?></h3>
                        <?php 
                        if($this->rbac->hasPrivilege('question_bank','can_add')){
?> 
 <button class="btn btn-primary btn-sm pull-right question-btn" data-recordid="0"><i class="fa fa-plus"></i> <?php echo $this->lang->line('add')." ".$this->lang->line('question');?></button>
<?php
                        }
                        ?>
                       
                    </div>
                    <div class="box-body">
                        <div class="mailbox-controls">
                            <div class="pull-right">
                            </div>
                        </div>
                        <div class="mailbox-messages table-responsive">

 <div class="download_label"><?php echo $this->lang->line('question')." ".$this->lang->line('bank');?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('subject')?></th>
                                        <th><?php echo $this->lang->line('question')?></th>
                                        <th><?php echo $this->lang->line('answer')?></th>

                                        <th class="text-right no-print"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($questionList as $subject_key => $subject_value) {
                                        ?>
                                        <tr>
                                            <td class="mailbox-name"> <?php echo $subject_value->name; ?></td>
                                            <td class="mailbox-name"> <?php echo readmorelink($subject_value->question); ?></td>
                                            <td class="mailbox-name"> <?php echo findOption($questionOpt,$subject_value->correct); ?></td>
                                            <td class="text-right" width="100">
                                                <?php if($this->rbac->hasPrivilege('question_bank','can_edit')){ ?>
                                                <button type="button" data-placement="left" class="btn btn-default btn-xs question-btn-edit" data-toggle="tooltip" id="load" data-recordid="<?php echo $subject_value->id; ?>" title="<?php echo $this->lang->line('edit'); ?>" ><i class="fa fa-pencil"></i></button>
                                            <?php } 
                                            if($this->rbac->hasPrivilege('question_bank','can_delete')){
                                                ?>
                                                <a data-placement="left" href="<?php echo base_url(); ?>admin/question/delete/<?php echo $subject_value->id; ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                    <i class="fa fa-remove"></i>
                                                </a>
                                            <?php } ?>
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

    </section>
</div>


<?php 
function findOption($questionOpt,$find){
    
foreach ($questionOpt as $quet_opt_key => $quet_opt_value) {
 if($quet_opt_key == $find){
    return $quet_opt_value;
 }
}
return false;
}


 ?>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('question')?></h4>
            </div>
            <form action="<?php echo site_url('admin/question/add'); ?>" method="POST" id="formsubject">
                <div class="modal-body">
                    <input type="hidden" name="recordid" value="0">
                    <div class="form-group">
                        <label for="subject_id"><?php echo $this->lang->line('subject')?></label><small class="req"> *</small>

                        <select class="form-control" name="subject_id">
                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                            <?php
                            foreach ($subjectlist as $subject_key => $subject_value) {
                                ?>
                                <option value="<?php echo $subject_value['id']; ?>"><?php echo $subject_value['name']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <span class="text text-danger subject_id_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="question"><?php echo $this->lang->line('question')?></label><small class="req"> *</small>
                        <textarea class="form-control" id="question" name="question"></textarea>
                        <span class="text text-danger question_error"></span>
                    </div>
                    <?php
                    foreach ($questionOpt as $question_opt_key => $question_opt_value) {
                        ?>
                        <div class="form-group">
                            <label for="<?php echo $question_opt_key; ?>"><?php echo $this->lang->line('option_'.$question_opt_value);?><?php if($question_opt_value!='E'){ ?><small class="req"> *</small><?php } ?></label>
                            <input type="text" class="form-control" name="<?php echo $question_opt_key; ?>" id="<?php echo $question_opt_key; ?>">
                            <span class="text text-danger <?php echo $question_opt_key; ?>_error"></span>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <label for="subject_id"><?php echo $this->lang->line('answer')?></label><small class="req"> *</small>

                        <select class="form-control" name="correct">
                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                            <?php
                                    foreach ($questionOpt as $question_opt_key => $question_opt_value) {
                                ?>
                                <option value="<?php echo $question_opt_key; ?>"><?php echo $question_opt_value; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <span class="text text-danger correct_error"></span>
                    </div>
                  
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Saving..."><?php echo $this->lang->line('save')?></button>
                </div>
        </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: false
        })

        $('#myModal').on('hidden.bs.modal', function () {

            $(this)
                    .find("input,textarea,select")
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

        $(document).on('click', '.question-btn-edit', function () {
            var $this = $(this);
            var recordid = $this.data('recordid');
            $('input[name=recordid]').val(recordid);
            $.ajax({
                type: 'POST',
                url: baseurl + "admin/question/getQuestionByID",
                data: {'recordid': recordid},
                dataType: 'JSON',
                beforeSend: function () {
                    $this.button('loading');
                },
                success: function (data) {
                    console.log(data.result);
                    if (data.status) {
                        $('select[name=subject_id]').val(data.result.subject_id);
                        $('select[name=correct]').val(data.result.correct);
                        $('#question').val(data.result.question);
                        $('#opt_a').val(data.result.opt_a);
                        $('#opt_b').val(data.result.opt_b);
                        $('#opt_c').val(data.result.opt_c);
                        $('#opt_d').val(data.result.opt_d);
                        $('#opt_e').val(data.result.opt_e);
                  
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

</script>