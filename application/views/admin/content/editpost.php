<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="glyphicon glyphicon-th"></i> <?php echo $this->lang->line('manage'); ?></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <!-- Horizontal Form -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $this->lang->line('syllabus_list'); ?></h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form id="form1" action="<?php echo site_url('downloadcontent/edit/' . $id) ?>"  id="employeeform" name="employeeform" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                        <div class="box-body">
                            <?php
                            if (isset($error_message)) {
                                echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                            }
                            ?>  
                            <?php echo $this->customlib->getCSRF(); ?>                          
                            <input type="hidden" name="id" value="<?php echo set_value('id', $editpost['id']); ?>" >
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('
content_title'); ?></label>
                                <input autofocus="" id="content_title" name="content_title" placeholder="content_title" type="text" class="form-control"  value="<?php echo set_value('content_title', $editpost['content_title']); ?>" />
                                <span class="text-danger"><?php echo form_error('content_title'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('content_type'); ?></label>

                                <select  id="content_type" name="content_type" class="form-control" >
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    <?php
                                    foreach ($ght as $type) {
                                        ?>
                                        <option value="<?php echo $type; ?>" <?php if (set_value('content_type', $editpost['content_type']) == $type) echo "selected=selected"; ?>><?php echo $type; ?></option>


                                        <?php
                                        $count++;
                                    }
                                    ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('content_type'); ?></span>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('class'); ?></label>

                                <select  id="class_id" name="class_id" class="form-control" >
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    <?php
                                    foreach ($classlist as $class) {
                                        ?>


                                        <option value="<?php echo $class['id'] ?>" <?php if (set_value('class_id', $editpost['class_id']) == $class['id']) echo "selected=selected"; ?>><?php echo $class['class'] ?></option>



                                        <?php
                                        $count++;
                                    }
                                    ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('upload_date'); ?></label>
                                        <input id="upload_date" name="upload_date" placeholder="upload_date" type="text" class="form-control"  value="<?php echo set_value('upload_date', $editpost['upload_date']); ?>" />
                                        <span class="text-danger"><?php echo form_error('upload_date'); ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputFile"><?php echo $this->lang->line('select_image'); ?></label>
                                        <input type='file' name='file' id="file" size='20' />

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
            <div class="col-md-8">


                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"></h3>
                        <div class="box-tools pull-right">

                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="mailbox-controls">
                            <!-- Check all button -->

                            <div class="pull-right">

                            </div><!-- /.pull-right -->
                        </div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <td>
                                        </td>
                                        <td><?php echo $this->lang->line('hostel_name'); ?>
                                        </td>
                                        <td><?php echo $this->lang->line('type'); ?>
                                        </td>
                                        <td><?php echo $this->lang->line('address'); ?>
                                        </td>
                                        <td><?php echo $this->lang->line('intake'); ?></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($listpost as $data) {
                                        ?>

                                        <tr>
                                            <td></td>
                                            <td class="mailbox-name"> <?php echo $data['content_title'] ?></td>
                                            <td class="mailbox-name"> <?php echo $data['content_type'] ?></td>
                                            <td class="mailbox-name"> <?php echo $data['file_uploaded'] ?></td>
                                            <td class="mailbox-name"> <?php echo $data['upload_date'] ?></td>
                                            <td class="mailbox-date pull-right">
                                                <a data-placement="left" href="<?php echo base_url(); ?>downloadcontent/edit/<?php echo $data['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <a data-placement="left" href="<?php echo base_url(); ?>downloadcontent/delete/<?php echo $data['id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                    <i class="fa fa-remove"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                        $count++;
                                    }
                                    ?>

                                </tbody>
                            </table><!-- /.table -->
                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <div class="mailbox-controls">
                            <!-- Check all button -->

                            <div class="pull-right">

                            </div><!-- /.pull-right -->
                        </div>
                    </div>
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
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
        $('#upload_date').datepicker({
            //   format: "dd-mm-yyyy"
            format: date_format,
            autoclose: true
        });
        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });
    });
</script>
