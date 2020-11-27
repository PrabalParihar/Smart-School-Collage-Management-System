
<?php
$language = $this->customlib->getLanguage();
$language_name = $language["short_code"];
?>
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
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>

            </div>
            <form  class="assign_teacher_form" action="<?php echo base_url(); ?>homework/" method="post" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>
                            <?php echo $this->customlib->getCSRF(); ?>
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-6">
                            <div class="form-group">
                                <label><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
                                <select autofocus="" id="searchclassid" name="class_id" onchange="getSectionByClass(this.value, 0, 'secid')"  class="form-control" >
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    <?php
                                    foreach ($classlist as $class) {
                                        ?>
                                        <option <?php
                                        if ($class_id == $class["id"]) {
                                            echo "selected";
                                        }
                                        ?> value="<?php echo $class['id'] ?>"><?php echo $class['class'] ?></option>
                                            <?php
                                        }
                                        ?>
                                </select>
                                <span class="class_id_error text-danger"><?php echo form_error('class_id'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-6">
                            <div class="form-group">
                                <label><?php echo $this->lang->line('section'); ?></label>
                                <select  id="secid" name="section_id" class="form-control" >
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                </select>
                                <span class="section_id_error text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-6">
                            <div class="form-group">
                                <label><?php echo $this->lang->line('subject') . " " . $this->lang->line('group') ?></label>
                                <select  id="subject_group_id" name="subject_group_id" class="form-control" >
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                </select>
                                <span class="section_id_error text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-6">
                            <div class="form-group">
                                <label><?php echo $this->lang->line('subject'); ?></label>
                                <select  id="subid" name="subject_id" class="form-control" >
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                </select>
                                <span class="section_id_error text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" id="search_filter" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                </div>
            </form>

            <div class="row">
                <div class="col-md-12">
                    <div class="">
                        <div class="box-header ptbnull"></div>
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-users"></i> <?php echo $this->lang->line('homework_list'); ?></h3>
                            <?php if ($this->rbac->hasPrivilege('homework', 'can_add')) { ?>
                                <div class="box-tools pull-right">
                                    <button type="button"class="btn btn-sm btn-primary modal_form" data-method_call="add"><i class="fa fa-plus"></i> <?php echo $this->lang->line('add'); ?></button>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="box-body table-responsive">
                            <div class="download_label"> <?php echo $this->lang->line('homework_list'); ?></div>
                            <div >
                                <table class="table table-hover table-striped table-bordered example">
                                    <thead>
                                        <tr>
                                            <th><?php echo $this->lang->line('class') ?></th>
                                            <th><?php echo $this->lang->line('section') ?></th>
                                            <th><?php echo $this->lang->line('subject') . " " . $this->lang->line('group'); ?></th>
                                            <th><?php echo $this->lang->line('subject') ?></th>
                                            <th><?php echo $this->lang->line('homework_date'); ?></th>
                                            <th><?php echo $this->lang->line('submission_date'); ?></th>
                                            <th><?php echo $this->lang->line('evaluation_date'); ?></th>
                                            <th><?php echo $this->lang->line('created_by'); ?></th>
                                            <th class="text-right"><?php echo $this->lang->line('action') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php 

                                        foreach ($homeworklist as $key => $homework) {
                                            ?>
                                            <tr>
                                                <td><?php echo $homework["class"] ?></td>

                                                <td><?php echo $homework["section"] ?></td>
                                                <td><?php echo $homework['name'] ?></td>
                                                <td><?php echo $homework["subject_name"] ?></td>
                                                <td><?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($homework['homework_date'])); ?></td>
                                                <td><?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($homework['submit_date'])); ?></td>
                                                <td><?php
                                                     
                                                    $evl_date = "";
                                                    if ($homework['evaluation_date'] != "0000-00-00") {
                                                        echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateYYYYMMDDtoStrtotime($homework['evaluation_date']));
                                                    }
                                                    ?></td>
                                                <td><?php
                                                  
                                                        echo $homework["created_by"];
                                                    
                                                    ?></td>
                                                <td class="mailbox-date pull-right">

                                                    <?php if ($this->rbac->hasPrivilege('homework_evaluation', 'can_view')){ ?>
                                                        <a data-placement="left" class="btn btn-default btn-xs" onclick="evaluation(<?php echo $homework['id']; ?>);" title=""  data-toggle="tooltip"  data-original-title="<?php echo $this->lang->line('evaluation'); ?>">
                                                            <i class="fa fa-reorder"></i></a>
                                                        <?php
                                                    }
                                                    if ($homework["assignments"] > 0) {
                                                        ?>
                                                        <a data-placement="left" class="btn btn-default btn-xs" onclick="homework_docs(<?php echo $homework['id']; ?>);" data-toggle="tooltip"  data-original-title="<?php echo $this->lang->line('assignments'); ?>">
                                                            <i class="fa fa-download"></i></a>

                                                    <?php }
                                                    if ($this->rbac->hasPrivilege('homework', 'can_edit')) { ?>

                                                        <a data-placement="left" class="btn btn-default btn-xs modal_form" data-toggle="tooltip"  data-original-title="<?php echo $this->lang->line('edit'); ?>" data-method_call="edit" data-record_id="<?php echo $homework['id']; ?>"><i class="fa fa-pencil"></i></a>

                                                    <?php }
                                                    if ($this->rbac->hasPrivilege('homework', 'can_delete')) { ?>
                                                        <a data-placement="left" href="<?php echo base_url(); ?>homework/delete/<?php echo $homework['id']; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');" data-original-title="<?php echo $this->lang->line('delete'); ?>">
                                                            <i class="fa fa-remove"></i>
                                                        </a>
                                                    <?php } ?>
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="box-title"></h4>
            </div>

            <form id="formadd" method="post" class="ptt10" enctype="multipart/form-data">
                <div class="modal-body pt0 pb0">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <input type="hidden" id="modal_record_id" value="0" name="record_id">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('class') ?></label><small class="req"> *</small>
                                        <select class="form-control modal_class_id" name="modal_class_id" id="modal_class_id">
                                            <option value=""><?php echo $this->lang->line('select') ?></option>
                                            <?php foreach ($classlist as $key => $value) {
                                                ?>
                                                <option value="<?php echo $value["id"] ?>"><?php echo $value["class"] ?></option>

                                            <?php } ?>

                                        </select>
                                        <span id="name_add_error" class="text-danger"></span>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('section') ?></label><small class="req"> *</small>
                                        <select class="form-control modal_section_id" name="modal_section_id" id="modal_section_id" >
                                            <option value=""><?php echo $this->lang->line('select') ?></option>

                                        </select>
                                        <span id="name_add_error" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('subject') . " " . $this->lang->line('group') ?></label><small class="req"> *</small>
                                        <select  id="modal_subject_group_id" name="modal_subject_group_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        </select>
                                        <span class="text-danger"></span>
                                    </div>
                                </div>



                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('subject') ?></label><small class="req"> *</small>
                                        <select class="form-control" name="modal_subject_id" id="modal_subject_id">
                                            <option value=""><?php echo $this->lang->line('select') ?></option>


                                        </select>
                                        <span id="name_add_error" class="text-danger"><?php echo form_error('modal_subject_id'); ?></span>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('homework_date'); ?></label><small class="req"> *</small>
                                        <input type="text"  name="homework_date" class="form-control date" id="homework_date" value="<?php echo set_value('date', date($this->customlib->getSchoolDateFormat())); ?>" readonly="">
                                        <span id="date_add_error" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('submission_date'); ?></label><small class="req"> *</small>
                                        <input type="text" id="submit_date" name="submit_date" class="form-control date" value="<?php echo set_value('follow_up_date', date($this->customlib->getSchoolDateFormat())); ?>" readonly="">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('attach_document'); ?></label>
                                        <input type="file" id="file" name="userfile" class="form-control filestyle">
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="email"><?php echo $this->lang->line('description'); ?></label><small class="req"> *</small>
                                        <textarea name="description" id="compose-textarea" class="form-control" ><?php echo set_value('address'); ?>

                                        </textarea>
                                    </div>
                                </div>






                            </div><!--./row-->

                        </div><!--./col-md-12-->

                    </div><!--./row-->

                </div>
                <div class="box-footer">

                    <div class="pull-right paddA10">
                        <button type="submit" class="btn btn-info pull-right" id="submit" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please wait"><?php echo $this->lang->line('save') ?></button>

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
                <h4 class="box-title"><?php echo $this->lang->line('evaluate_homework'); ?></h4>
            </div>
            <div class="modal-body pt0 pb0" id="evaluation_details">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="homework_docs" tabindex="-1" role="dialog" aria-labelledby="evaluation" style="padding-left: 0 !important">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="box-title"><?php echo $this->lang->line('homework') . " " . $this->lang->line('assignments'); ?></h4>
            </div>
            <div class="modal-body pt0 pb0">
                <div class="row">
                    <div class="col-md-12">
                        <div class="">
                            <div class="box-body table-responsive">
                                <div >
                                    <table class="table table-hover table-striped table-bordered example">
                                        <thead>
                                            <tr>
                                                <th><?php echo $this->lang->line('name') ?></th>
                                                <th><?php echo $this->lang->line('message') ?></th>

                                                <th class="text-right"><?php echo $this->lang->line('action') ?></th>
                                            </tr>
                                            
                                        </thead>
                                        <tbody id="homework_docs_result">
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         
        </div>
    </div>
</div>
<!-- -->
<script type="text/javascript">
    $(document).ready(function () {

        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy']) ?>';
        $('#homework_date,#submit_date,#homeworkdate,#submitdate').datepicker({
            format: date_format,
            autoclose: true,
            language: '<?php echo $language_name ?>'
        });

        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });

    });

    function homework_docs(id) {
        $('#homework_docs').modal('show');
        $.ajax({
            url: '<?php echo base_url(); ?>homework/homework_docs/' + id,
            success: function (data) {
                $('#homework_docs_result').html(data);

            },
            error: function () {
                alert("Fail")
            }
        });
    }

</script>
<script>


    $(function () {

        $("#compose-textarea,#desc-textarea").wysihtml5();
    });
</script>
<script type="text/javascript">

    var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'MM', 'Y' => 'yyyy']) ?>';


    $(document).ready(function (e) {

        getSectionByClass("<?php echo $class_id ?>", "<?php echo $section_id ?>", 'secid');
       
        getSubjectGroup("<?php echo $class_id ?>", "<?php echo $section_id ?>", "<?php echo $subject_group_id ?>", 'subject_group_id')
        getsubjectBySubjectGroup("<?php echo $class_id ?>", "<?php echo $section_id ?>", "<?php echo $subject_group_id ?>", "<?php echo $subject_id ?>", 'subid');

    });

    $(document).ready(function (e) {



        $("#formedit").on('submit', (function (e) {

            e.preventDefault();
            $.ajax({
                url: "<?php echo site_url("homework/edit") ?>",
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
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


    // function getRecord(id) {


    //     var random = Math.random();
    //     $('#classid').val(null).trigger('change');
    //     $.ajax({
    //         url: "<?php echo site_url("homework/getRecord/") ?>" + id + "?r=" + random,
    //         type: "POST",
    //         dataType: 'json',

    //         success: function (res)
    //         {

    //             getSelectClass(res.class_id);
    //             getSectionByClass(res.class_id, res.section_id, 'sectionid');
    //             getSubjectByClassandSection(res.class_id, res.section_id, res.subject_id, 'subjectid');
    //             $("#homeworkdate").val(new Date(res.homework_date).toString(date_format));
    //             $("#submitdate").val(new Date(res.submit_date).toString(date_format));
    //             $("#desc-textarea").text(res.description);
    //             $('iframe').contents().find('.wysihtml5-editor').html(res.description);
    //             // $('select[id="classid"] option[value="' + res.class_id + '"]').attr("selected", true);
    //             $("#homeworkid").val(res.id);
    //             $("#document").val(res.document);
    //         }
    //     });

    // }

    // function getSelectClass(class_id) {
    //     $('#classid').html("");
    //     var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
    //     $.ajax({
    //         type: "POST",
    //         url: base_url + "homework/getClass",
    //         //data: {'class_id': class_id},
    //         dataType: "json",
    //         success: function (data) {
    //             $.each(data, function (i, obj)
    //             {

    //                 var sel = "";
    //                 if (class_id == obj.id) {
    //                     sel = "selected";
    //                 }
    //                 div_data += "<option value=" + obj.id + " " + sel + ">" + obj.class + "</option>";
    //             });
    //             $('#classid').append(div_data);

    //         }});
    // }


    // function getSubjectByClassandSection(class_id, section_id, subject_id, htmlid) {

    //     if (class_id != "" && section_id != "" && subject_id != "") {
    //         $('#' + htmlid).html("");
    //         //  var class_id = $('#class_id').val();
    //         var base_url = '<?php echo base_url() ?>';
    //         var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
    //         $.ajax({
    //             type: "POST",
    //             url: base_url + "admin/teacher/getSubjctByClassandSection",
    //             data: {'class_id': class_id, 'section_id': section_id},
    //             dataType: "json",
    //             success: function (data) {
    //                 $.each(data, function (i, obj)
    //                 {
    //                     var sel = "";
    //                     if (subject_id == obj.subject_id) {
    //                         sel = "selected";
    //                     }
    //                     div_data += "<option value=" + obj.subject_id + " " + sel + ">" + obj.name + " (" + obj.type + ")" + "</option>";
    //                 });

    //                 $('#' + htmlid).append(div_data);
    //             }
    //         });
    //     }
    // }

    // function getSubjectGroupByClassSection(class_id, section_id) {

    //     if (class_id != "" && section_id != "") {
    //         $('#' + htmlid).html("");
    //         var base_url = '<?php echo base_url() ?>';
    //         var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
    //         $.ajax({
    //             type: "POST",
    //             url: base_url + "/subjectgroup/getGroupByClassandSection",
    //             data: {'class_id': class_id, 'section_id': section_id},
    //             dataType: "json",
    //             success: function (data) {
    //                 $.each(data, function (i, obj)
    //                 {

    //                 });


    //             }
    //         });
    //     }
    // }

    function evaluation(id) {
        $('#evaluation').modal('show');
        $('#evaluation_details').html("");
        $.ajax({
            url: '<?php echo base_url(); ?>homework/evaluation/' + id,
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
<script type="text/javascript">

    var save_method; //for save method string
    var update_id; //for save method string
 
    function getSectionByClass(class_id, section_id, select_control) {
        if (class_id != "") {
            $('#' + select_control).html("");
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "sections/getByClass",
                data: {'class_id': class_id},
                dataType: "json",
                beforeSend: function () {
                    $('#' + select_control).addClass('dropdownloading');
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
                    $('#' + select_control).append(div_data);
                },
                complete: function () {
                    $('#' + select_control).removeClass('dropdownloading');
                }
            });
        }
    }


    $(document).ready(function () {
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: false
        });
    });

    $(document).on('click', '.modal_form', function () {
        save_method = $(this).data('method_call');
        $(':input').val('');
        if (save_method == "edit") {
            update_id = $(this).data('record_id');
            $('#myModal').modal('show');
            $('#myModal .box-title').text('<?php echo $this->lang->line('edit_homework'); ?>');
        } else if (save_method == "add") {
            $('#modal_record_id').val(0);
            $('#myModal .box-title').text('<?php echo $this->lang->line('add_homework'); ?>');
            $('#myModal').modal('show');
        } else {

        }

    });
    $(document).on('change', '#modal_section_id', function () {
        var class_id = $('.modal_class_id').val();
        var section_id = $(this).val();
        getSubjectGroup(class_id, section_id, 0, 'modal_subject_group_id');
    });

    $(document).on('change', '#secid', function () {
        var class_id = $('#searchclassid').val();
        var section_id = $(this).val();
        getSubjectGroup(class_id, section_id, 0, 'subject_group_id');
    });


    $(document).on('change', '#modal_subject_group_id', function () {
        var class_id = $('.modal_class_id').val();
        var section_id = $('.modal_section_id').val();
        var subject_group_id = $(this).val();

        getsubjectBySubjectGroup(class_id, section_id, subject_group_id, 0, 'modal_subject_id');

    });
    $(document).on('change', '#subject_group_id', function () {
        var class_id = $('#searchclassid').val();
        var section_id = $('#secid').val();
        var subject_group_id = $(this).val();

        getsubjectBySubjectGroup(class_id, section_id, subject_group_id, 0, 'subid');

    });

    $("#formadd").on('submit', (function (e) {
        e.preventDefault();

        var $this = $(this).find("button[type=submit]:focus");

        $.ajax({
            url: "<?php echo site_url("homework/create") ?>",
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $this.button('loading');

            },
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
            },
            error: function (xhr) { // if error occured
                alert("Error occured.please try again");
                $this.button('reset');
            },
            complete: function () {
                $this.button('reset');
            }

        });
    }));


    $(document).on('change', '.modal_class_id', function () {

        var modal_class_id = $('.modal_class_id').val();
        var modal_section_id = $('.modal_section_id').val();

        getSectionByClass(modal_class_id, 0, 'modal_section_id');
    });

    function getSubjectGroup(class_id, section_id, subjectgroup_id, subject_group_target) {
        if (class_id != "" && section_id != "") {

            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';

            $.ajax({
                type: 'POST',
                url: base_url + 'admin/subjectgroup/getGroupByClassandSection',
                data: {'class_id': class_id, 'section_id': section_id},
                dataType: 'JSON',
                beforeSend: function () {
                    // setting a timeout
                    $('#' + subject_group_target).html("").addClass('dropdownloading');
                },
                success: function (data) {

                    $.each(data, function (i, obj)
                    {
                        var sel = "";
                        if (subjectgroup_id == obj.subject_group_id) {
                            sel = "selected";
                        }
                        div_data += "<option value=" + obj.subject_group_id + " " + sel + ">" + obj.name + "</option>";
                    });
                    $('#' + subject_group_target).append(div_data);
                },
                error: function (xhr) { // if error occured
                    alert("Error occured.please try again");

                },
                complete: function () {
                    $('#' + subject_group_target).removeClass('dropdownloading');
                }
            });
        }

    }

    function getsubjectBySubjectGroup(class_id, section_id, subject_group_id, subject_group_subject_id, subject_target) {
        if (class_id != "" && section_id != "" && subject_group_id != "") {

            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';

            $.ajax({
                type: 'POST',
                url: base_url + 'admin/subjectgroup/getGroupsubjects',
                data: {'subject_group_id': subject_group_id},
                dataType: 'JSON',
                beforeSend: function () {
                    // setting a timeout
                    $('#' + subject_target).html("").addClass('dropdownloading');
                },
                success: function (data) {
                    console.log(data);
                    $.each(data, function (i, obj)
                    {
                        var sel = "";
                        if (subject_group_subject_id == obj.id) {
                            sel = "selected";
                        }
                        div_data += "<option value=" + obj.id + " " + sel + ">" + obj.name + "</option>";
                    });
                    $('#' + subject_target).append(div_data);
                },
                error: function (xhr) { // if error occured
                    alert("Error occured.please try again");

                },
                complete: function () {
                    $('#' + subject_target).removeClass('dropdownloading');
                }
            });
        }
    }


    $('#myModal').on('shown.bs.modal', function () {


        if (save_method == "edit") {
            $.ajax({
                url: base_url + "homework/getRecord",
                type: "POST",
                data: {id: update_id},
                dataType: 'json',

                beforeSend: function () {

                    $('#myModal').addClass('modal_loading');
                },
                success: function (res)
                {
                    console.log(res);
                    $('#modal_record_id').val(res.id);

                    $('#submit_date').val(new Date(res.submit_date).toString(date_format));
                    $('#homework_date').val(new Date(res.homework_date).toString(date_format));
                    $('.modal_class_id').val(res.class_id);
                    $('.wysihtml5-sandbox').contents().find('.wysihtml5-editor').html(res.description);
                    $('.modal_class_id option[value=' + res.class_id + ']').attr('selected', 'selected');
                    getSectionByClass(res.class_id, res.section_id, 'modal_section_id');

                    getSubjectGroup(res.class_id, res.section_id, res.subject_groups_id, 'modal_subject_group_id');
                    getsubjectBySubjectGroup(res.class_id, res.section_id, res.subject_groups_id, res.subject_group_subject_id, 'modal_subject_id');
                    $('#myModal').removeClass('modal_loading');


                },
                error: function (xhr) { // if error occured
                    alert("Error occured.please try again");
                    $('#myModal').removeClass('modal_loading');
                },
                complete: function () {
                    $('#myModal').removeClass('modal_loading');
                }

            });
        }
    })
</script>