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
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $this->lang->line('syllabus_list'); ?></h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                </div><!--/.col (right) -->
                <!-- left column -->
                <div class="col-md-0">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header ptbnull">
                            <h3 class="box-title titlefix"><?php //echo $title_list;      ?></h3>
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
                                            <td><?php echo $this->lang->line('content_title'); ?>
                                            </td>
                                            <td><?php echo $this->lang->line('content_type'); ?>
                                            </td>
                                            <td><?php echo $this->lang->line('file_uploaded'); ?></td>
                                            <td><?php echo $this->lang->line('upload_date'); ?></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        if (empty($contentlist)) {
                                            echo"<div class='alert alert-danger'>No Record Founded</div>";
                                        } else {
                                            foreach ($contentlist as $data) {
                                                ?>
                                                <tr>
                                                    <td></td>
                                                    <td class="mailbox-name"> <?php echo $data['content_title'] ?></td>
                                                    <td class="mailbox-name"> <?php echo $data['content_type'] ?></td>
                                                    <td class="mailbox-name"> <?php echo $data['file_uploaded'] ?></td>
                                                    <td class="mailbox-name"> <?php echo $data['upload_date'] ?></td>
                                                    <td><a class="btn btn-outline-inverse btn-lg" ><?php echo $this->lang->line('download'); ?></a></td>
                                                </tr>
                                                <?php
                                                $count++;
                                            }
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
