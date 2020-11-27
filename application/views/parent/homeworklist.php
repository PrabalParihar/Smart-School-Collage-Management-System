<link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script src="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-flask"></i> <?php echo $this->lang->line('homework'); ?>
        </h1>
    </section>   
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"> <?php echo $this->lang->line('homework_list'); ?></h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <div class="download_label"><?php echo $this->lang->line('homework_list'); ?></div>
                        <div >
                            <table class="table table-hover table-striped table-bordered example">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('class') ?></th>
                                        <th><?php echo $this->lang->line('section') ?></th>
                                        <th><?php echo $this->lang->line('subject') ?></th>
                                        <th><?php echo $this->lang->line('homework_date'); ?></th>
                                        <th><?php echo $this->lang->line('submission_date'); ?></th>
                                        <th><?php echo $this->lang->line('evaluation_date'); ?></th>
                                        <th><?php echo $this->lang->line('status'); ?></th>
                                        <th class="text-right"><?php echo $this->lang->line('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $upload_docsButton = 0;
                                    foreach ($homeworklist as $key => $homework) {
                                        if (date('Y-m-d') <= date('Y-m-d', strtotime($homework['submit_date']))) {
                                            $upload_docsButton = 1;
                                        }
                                        ?>
                                        <tr>
                                            <td><?php echo $homework["class"] ?></td>
                                            <td><?php echo $homework["section"] ?></td>
                                            <td><?php echo $homework["subject_name"] ?></td>
                                            <td><?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($homework['homework_date'])); ?></td>
                                            <td><?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($homework['submit_date'])); ?></td>
                                            <td><?php
                                                $evl_date = "";
                                                if ($homework['evaluation_date'] != "0000-00-00") {
                                                    echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateYYYYMMDDtoStrtotime($homework['evaluation_date']));
                                                }
                                                ?></td>
                                            <td>
                                                <?php
                                                $status_class = "class= 'label label-danger'";
                                                $hw=0;
                                                $status_homework = $this->lang->line("incomplete");
                                                if ($homework["homework_evaluation_id"] != 0) {
                                                    $hw=1;
                                                    $status_class = "class= 'label label-success'";
                                                    $status_homework = $this->lang->line("complete");
                                                }
                                                ?>
                                                <label <?php echo $status_class; ?>><?php echo $status_homework; ?></label>

                                            </td>                                                  
                                            <td class="mailbox-date pull-right">
                                                <a onclick="upload_docs('<?php echo $homework['id']; ?>', '<?php echo $upload_docsButton; ?>');" class="btn btn-default btn-xs"    data-toggle="tooltip"  data-original-title="<?php echo $this->lang->line('homework') . " " . $this->lang->line('assignments'); ?>">
                                                    <i class="fa fa-upload"></i></a>
                                                <a class="btn btn-default btn-xs" onclick="evaluation('<?php echo $homework['id']; ?>','<?php echo $hw;?>');" title="" data-target="#evaluation" data-toggle="modal"  data-original-title="Evaluation">
                                                    <i class="fa fa-reorder"></i></a>    
                                            </td>
                                        </tr>
                                    <?php } ?>

                                </tbody>      
                            </table> 

                        </div>           
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<div class="modal fade" id="upload_docs" tabindex="-1" role="dialog" aria-labelledby="evaluation" style="padding-left: 0 !important">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="box-title"><?php echo $this->lang->line('homework'); ?> <?php echo $this->lang->line('assignments'); ?></h4>
            </div>
            <form id="upload" method="post" class="ptt10" enctype="multipart/form-data">
                <div class="modal-body pt0">
                            <div class="row">
                                <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
                                <input type="hidden" id="homework_id"  name="homework_id">
                                <input type="hidden" id="assigment_id" name="assigment_id">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('message'); ?></label>
                                        <textarea type="text" id="assigment_message" name="message" class="form-control "></textarea>
                                    </div> 
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('attach_document'); ?></label>
                                        <input type="file" id="file" name="file" class="form-control filestyle">
                                    </div>
                                </div>
                                <p id="uploaded_docs"></p>
                            </div>

                      
                </div>
                <div class="box-footer">
                    <div class="" id="footer_area">
                        <button type="submit" class="btn btn-info pull-right" id="submit" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please wait"><?php echo $this->lang->line('save'); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="evaluation" tabindex="-1" role="dialog" aria-labelledby="evaluation" style="padding-left: 0 !important">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="box-title"><?php echo $this->lang->line('homework_evaluation'); ?></h4>
            </div>
            <div class="modal-body pt0 pb0" id="evaluation_details">
            </div>
        </div>
    </div>
</div>
<!-- -->
<script type="text/javascript">
    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
        $('#homework_date,#submit_date,#homeworkdate,#submitdate').datepicker({
            format: date_format,
            autoclose: true
        });

        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });

    });

</script>
<script>
    $(function () {

        $("#compose-textarea,#desc-textarea").wysihtml5();
    });
</script>
<script type="text/javascript">

    function upload_docs(id, button,status_homework) {
        $("#footer_area").attr('style', 'display:block');
        if (button == 0) {
            $("#footer_area").attr('style', 'display:none');
        }

        $('#uploaded_docs').html('');
        var student_id = "<?php echo $student_id; ?>";

        $.ajax({
            url: "<?php echo site_url(); ?>parent/homework/get_upload_docs/" + id+"/"+status_homework,
            type: "POST",
            dataType: 'json',
            data: "student_id=" + student_id,

            success: function (res)
            {

                $('#uploaded_docs').html('<div class=""><div class="col-sm-12"><div class="form-group"><label for="pwd"><?php echo $this->lang->line('uploaded') . " " . $this->lang->line('documents'); ?></label><p>' + res.file_name + ' <a href="<?php echo base_url(); ?>/parent/homework/assigmnetDownload/' + id + '/' + res.docs + '" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('assignments') . " " . $this->lang->line('download'); ?>">                                                    <i class="fa fa-download"></i></a></p></div></div></div>');
                $('#assigment_id').val(res.id);
                $('#assigment_message').val(res.message);
            }


        });

        $('#homework_id').val(id);
        $('#upload_docs').modal('show');


    }

    $(document).ready(function (e) {



        $("#upload").on('submit', (function (e) {

            e.preventDefault();
            $.ajax({
                url: "<?php echo site_url("parent/homework/upload_docs") ?>",
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                // cache: false,
                processData: false,
                success: function (res)
                {

                    if (res.status == "fail") {

                        var message = "";
                        $.each(res.error, function (index, value) {

                            message += value;
                        });
                        errorMsg(message);

                    } else {

                        successMsg(res.message);

                        window.location.reload(true);
                    }
                }
            });
        }));

    });

    function getRecord(id) {

        $.ajax({
            url: "<?php echo site_url("homework/getRecord/") ?>" + id,
            type: "POST",
            dataType: 'json',

            success: function (res)
            {

                getSectionByClass(res.class_id, res.section_id);
                getSubjectByClassandSection(res.class_id, res.section_id, res.subject_id);
                $("#homeworkdate").val(new Date(res.homework_date).toString("MM/dd/yyyy"));
                $("#submitdate").val(new Date(res.submit_date).toString("MM/dd/yyyy"));
                $("#desc-textarea").text(res.description);
                $('iframe').contents().find('.wysihtml5-editor').html(res.description);
                $('select[id="classid"] option[value="' + res.class_id + '"]').attr("selected", "selected");
                $("#homeworkid").val(res.id);
                $("#document").val(res.document);
            }
        });

    }


    function getSectionByClass(class_id, section_id) {
        if (class_id != "" && section_id != "") {
            $('#sectionid,#secid').html("");
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';

            $.ajax({
                type: "GET",
                url: base_url + "sections/getByClass",
                data: {'class_id': class_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        var sel = "";
                        if (section_id == obj.section_id) {
                            sel = "selected";
                        }
                        div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
                    });
                    $('#sectionid,#secid').append(div_data);
                }
            });
        }
    }

    function getSubjectByClassandSection(class_id, section_id, subject_id) {
        console.log("rrrr");
        if (class_id != "" && section_id != "" && subject_id != "") {
            $('#subjectid,#subid').html("");
            //  var class_id = $('#class_id').val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "POST",
                url: base_url + "admin/teacher/getSubjctByClassandSection",
                data: {'class_id': class_id, 'section_id': section_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        var sel = "";
                        if (subject_id == obj.subject_id) {
                            sel = "selected";
                        }
                        div_data += "<option value=" + obj.subject_id + " " + sel + ">" + obj.name + " (" + obj.type + ")" + "</option>";
                    });

                    $('#subjectid,#subid').append(div_data);
                }
            });
        }
    }

    function evaluation(id,status) {

        var studentid = '<?php echo $student_id ?>';
        $('#evaluation_details').html("");
        $.ajax({
            url: '<?php echo base_url(); ?>parent/homework/homework_detail/' + id + '/' + studentid+'/'+status,
            success: function (data) {
                $('#evaluation_details').html(data);
                // $.ajax({
                //     url: '<?php echo base_url(); ?>homework/getRecord/' + id,
                //     success: function (data) {
                //         $('#timeline').html(data);
                //     },
                //     error: function () {
                //         alert("Fail")
                //     }
                // });
            },
            error: function () {
                alert("Fail")
            }
        });
    }

    function addhomework() {

        $('iframe').contents().find('.wysihtml5-editor').html("");
    }
</script>