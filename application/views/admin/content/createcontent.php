<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-download"></i> <?php echo $this->lang->line('download_center'); ?></h1>

    </section>
 
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php
            if ($this->rbac->hasPrivilege('upload_content', 'can_add')) {
                ?>
                <div class="col-md-4">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('upload_content'); ?></h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->

                        <form id="form1" action="<?php echo site_url('admin/content') ?>"  id="employeeform" name="employeeform" method="post"  enctype='multipart/form-data' accept-charset="utf-8">
                            <div class="box-body">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>
                                <?php echo $this->customlib->getCSRF(); ?>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('content_title'); ?></label><small class="req"> *</small>
                                    <input autofocus="" id="content_title" name="content_title" placeholder="" type="text" class="form-control"  value="<?php echo set_value('content_title'); ?>" />
                                    <span class="text-danger"><?php echo form_error('content_title'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('content_type'); ?></label><small class="req"> *</small>

                                    <select  id="content_type" name="content_type" class="form-control" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($ght as $type) {
                                            ?>
                                            <option value="<?php echo $type; ?>" <?php if (set_value('content_type') == $type) echo "selected=selected"; ?>><?php echo $type; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('content_type'); ?></span>
                                </div>
                                <div class="form-group"> <!-- Radio group !-->
                                    <label class="control-label"><?php echo $this->lang->line('available_for'); ?></label><small class="req"> *</small>
                                    <?php
                                    foreach ($content_available as $cont_avail_key => $cont_avail_value) {
                                        ?>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" class="content_available" name="content_available[]" value="<?php echo $cont_avail_key; ?>" <?php echo set_checkbox('content_available[]', $cont_avail_key); ?>>
                                                <?php echo $cont_avail_value; ?>
                                            </label>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <span class="text-danger"><?php echo form_error('content_available[]'); ?></span>

                                </div>      
                                <?php
                                $content_disable = "content_disable";
                                if (set_checkbox('content_available[]', 'student')) {
                                    $content_disable = "";
                                }
                                ?>
                                <div class="upload_content <?php echo $content_disable; ?>">
                                    <div class="checkbox">
                                        <label><input type="checkbox" value="Yes" name="visibility" id="chk" <?php if (set_value('visibility') == "Yes") echo "checked=checked"; ?>/><b><?php echo $this->lang->line('available_for_all_classes'); ?> </b></label>
                                    </div>


                                    <div class="form-group">

                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('class'); ?> </label><small class="req"> *</small>

                                        <select  id="class_id" name="class_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php
                                            foreach ($classlist as $class) {
                                                ?>
                                                <option value="<?php echo $class['id'] ?>" <?php if (set_value('class_id') == $class['id']) echo "selected=selected" ?>>
                                                    <?php echo $class['class'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label><small class="req"> *</small>
                                        <select  id="section_id" name="section_id" class="form-control" >
                                            <option value=""   ><?php echo $this->lang->line('select'); ?></option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('upload_date'); ?></label><small class="req"> *</small>
                                            <input id="upload_date" name="upload_date" placeholder="" type="text" class="form-control date"  value="<?php echo set_value('upload_date', date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat(date('Y-m-d')))); ?>" />
                                            <span class="text-danger"><?php echo form_error('upload_date'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>
                                            <textarea class="form-control" id="description" name="note" placeholder="" rows="3" placeholder="Enter ..."><?php echo set_value('note'); ?></textarea>
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputFile"><?php echo $this->lang->line('content_file'); ?></label><small class="req"> *</small>
                                            <input class="filestyle form-control" data-height="40" type='file' name='file' id="file" size='20' />

                                        </div>
                                        <span class="text-danger"><?php echo form_error('file'); ?></span>
                                    </div>
                                </div>
                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>
                        </form>
                    </div>

                </div><!--/.col (right) -->
                <!-- left column -->
            <?php } ?>
            <div class="col-md-<?php
            if ($this->rbac->hasPrivilege('upload_content', 'can_add')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('content_list'); ?></h3>
                        <div class="box-tools pull-right">

                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="mailbox-controls">
                            <!-- Check all button -->
                            <div class="pull-right">

                            </div><!-- /.pull-right -->
                        </div>
                        <div class="mailbox-messages table-responsive">
                            <div class="download_label"><?php echo $this->lang->line('content_list'); ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('content_title'); ?></th>
                                        <th><?php echo $this->lang->line('type'); ?></th>
                                        <th><?php echo $this->lang->line('date'); ?></th>
                                        <th><?php echo $this->lang->line('available_for'); ?></th>
                                        <th><?php echo $this->lang->line('class'); ?></th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($list as $data) {
                                        ?> 
                                        <tr>
                                            <td class="mailbox-name">
                                                <a href="#" data-toggle="popover" class="detail_popover"><?php echo $data['title'] ?></a>
                                                <div class="fee_detail_popover" style="display: none">
                                                    <?php
                                                    if ($data['note'] == "") {
                                                        ?>
                                                        <p class="text text-danger"><?php echo $this->lang->line('no_description'); ?></p>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <p class="text text-info"><?php echo $data['note']; ?></p>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </td>
                                            <td class="mailbox-name"><?php echo $data['type'] ?></td>
                                            <td class="mailbox-name"><?php  if($data['date']!='0000-00-00'){ echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($data['date'])); }  ?></td>
                                            <td class="mailbox-name">
                                                <ul class="list-unstyled">

                                                    <?php
                                                    $roles = explode(",", $data['role']);
                                                    foreach ($roles as $role_k => $role_v) {
                                                        ?>
                                                        <li><?php echo $role_v; ?></li>
                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                            </td>
                                            <td class="mailbox-name"><?php
                                                if ($data['is_public'] == "Yes") {
                                                    echo "ALL Classes";
                                                } elseif (in_array('student', explode(",", $data['role']))) {

                                                    echo $data['class'] . "(" . $data['section'] . ")";
                                                }
                                                ?></td>
                                            <td class="mailbox-date pull-right">

                                                <a data-placement="left" href="<?php echo base_url(); ?>admin/content/download/<?php echo $data['file'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('download'); ?>">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                                <?php
                                                if ($this->rbac->hasPrivilege('upload_content', 'can_delete')) {
                                                    ?>
                                                    <a data-placement="left" href="<?php echo base_url(); ?>admin/content/delete/<?php echo $data['id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
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
                            </table><!-- /.table -->
                        </div><!-- /.mail-box-messages -->

                    </div><!-- /.box-body -->

                </div>
            </div><!--/.col (left) -->


            <!-- right column -->

        </div>
        <div class="row">
            <!-- left column -->

            <!-- right column -->
            <div class="col-md-12">

                <!-- Horizontal Form -->

                <!-- general form elements disabled -->

            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script type="text/javascript">
    $(document).ready(function () {
      
        
        $("#btnreset").click(function () {

            $("#form1")[0].reset();
        });
        var class_id = $('#class_id').val();
        var section_id = '<?php echo set_value('section_id') ?>';
        getSectionByClass(class_id, section_id);
        $(document).on('change', '#class_id', function (e) {
            $('#section_id').html("");
            var class_id = $(this).val();
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
                        div_data += "<option value=" + obj.id + ">" + obj.section + "</option>";
                    });
                    $('#section_id').append(div_data);
                }
            });
        });
        function getSectionByClass(class_id, section_id) {
            if (class_id != "" && section_id != "") {
                $('#section_id').html("");
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
                            if (section_id == obj.id) {
                                sel = "selected";
                            }
                            div_data += "<option value=" + obj.id + " " + sel + ">" + obj.section + "</option>";
                        });
                        $('#section_id').append(div_data);
                    }
                });
            }
        }



    });
    $(document).ready(function () {

        $(document).on("click", '.content_available', function (e) {
            var avai_value = $(this).val();
            if (avai_value === "student") {
                console.log(avai_value);
                if ($(this).is(":checked")) {

                    $(this).closest("div").parents().find('.upload_content').removeClass("content_disable");

                } else {
                    $(this).closest("div").parents().find('.upload_content').addClass("content_disable");

                }
            }
        });
        $("#chk").click(function () {
            if ($(this).is(":checked")) {
                $("#class_id").prop("disabled", true);
            } else {
                $("#class_id").prop("disabled", false);
            }
        });
        if ($("#chk").is(":checked")) {
            $("#class_id").prop("disabled", true);
        } else {
            $("#class_id").prop("disabled", false);
        }

    });</script>

<script>
    $(document).ready(function () {
        $('.detail_popover').popover({
            placement: 'right',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });
    });
</script>