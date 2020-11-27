<style type="text/css">
    @media print
    {
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
</style>
<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>     <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class="fa fa-newspaper-o"></i> <?php echo $this->lang->line('certificate'); ?></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php
            if ($this->rbac->hasPrivilege('student_id_card', 'can_add')) {
                ?>
                <div class="col-md-4">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('icard'); ?></h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form id="form1" enctype="multipart/form-data" action="<?php echo site_url('admin/studentidcard/create') ?>"  id="certificateform" name="certificateform" method="post" accept-charset="utf-8">
                            <div class="box-body">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>
                                <?php
                                if (isset($error_message)) {
                                    echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                                }
                                ?>
                                <?php //echo $this->customlib->getCSRF(); ?>
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('background_image'); ?></label>
                                    <input id="documents" placeholder="" type="file" class="filestyle form-control" data-height="40"  name="background_image">
                                </div>
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('logo'); ?></label>
                                    <input id="logo_img" placeholder="" type="file" class="filestyle form-control" data-height="40"  name="logo_img">
                                </div>
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('signature'); ?></label>
                                    <input id="sign_image" placeholder="" type="file" class="filestyle form-control" data-height="40"  name="sign_image">
                                    <span class="text-danger"><?php echo form_error('sign_image'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('school_name'); ?></label><small class="req"> *</small>
                                    <input autofocus="" id="school_name" name="school_name" placeholder="" type="text" class="form-control" />
                                    <span class="text-danger"><?php echo form_error('school_name'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('address'); ?> / <?php echo $this->lang->line('phone'); ?> / <?php echo $this->lang->line('email'); ?></label><small class="req"> *</small>
                                    <textarea class="form-control" id="address" name="address" placeholder="" rows="3" placeholder=""></textarea>
                                    <span class="text-danger"><?php echo form_error('address'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('icard'); ?> <?php echo $this->lang->line('title'); ?></label><small class="req"> *</small>
                                    <input id="title" name="title" placeholder="" type="text" class="form-control" />
                                    <span class="text-danger"><?php echo form_error('title'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('header'); ?> <?php echo $this->lang->line('color'); ?></label>
                                    <input id="header_color" name="header_color" placeholder="" type="text" class="form-control my-colorpicker1" />
                                </div>
                                <div class="form-group switch-inline">
                                    <label><?php echo $this->lang->line('admission_no'); ?></label>
                                    <div class="material-switch switchcheck">
                                        <input id="enable_admission_no" name="is_active_admission_no" type="checkbox" class="chk" value="1">
                                        <label for="enable_admission_no" class="label-success"></label>
                                    </div>
                                </div>
                                <div class="form-group switch-inline">
                                    <label><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('name'); ?></label>
                                    <div class="material-switch switchcheck">
                                        <input id="enable_student_name" name="is_active_student_name" type="checkbox" class="chk" value="1">
                                        <label for="enable_student_name" class="label-success"></label>
                                    </div>
                                </div>
                                <div class="form-group switch-inline">
                                    <label><?php echo $this->lang->line('class'); ?></label>
                                    <div class="material-switch switchcheck">
                                        <input id="enable_class" name="is_active_class" type="checkbox" class="chk" value="1">
                                        <label for="enable_class" class="label-success"></label>
                                    </div>
                                </div>
                                <div class="form-group switch-inline">
                                    <label><?php echo $this->lang->line('father_name'); ?></label>
                                    <div class="material-switch switchcheck">
                                        <input id="enable_father_name" name="is_active_father_name" type="checkbox" class="chk" value="1">
                                        <label for="enable_father_name" class="label-success"></label>
                                    </div>
                                </div>
                                <div class="form-group switch-inline">
                                    <label><?php echo $this->lang->line('mother_name'); ?></label>
                                    <div class="material-switch switchcheck">
                                        <input id="enable_mother_name" name="is_active_mother_name" type="checkbox" class="chk" value="1">
                                        <label for="enable_mother_name" class="label-success"></label>
                                    </div>
                                </div>
                                <div class="form-group switch-inline">
                                    <label><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('address'); ?></label>
                                    <div class="material-switch switchcheck">
                                        <input id="enable_address" name="is_active_address" type="checkbox" class="chk" value="1">
                                        <label for="enable_address" class="label-success"></label>
                                    </div>
                                </div>
                                <div class="form-group switch-inline">
                                    <label><?php echo $this->lang->line('phone'); ?></label>
                                    <div class="material-switch switchcheck">
                                        <input id="enable_phone" name="is_active_phone" type="checkbox" class="chk" value="1">
                                        <label for="enable_phone" class="label-success"></label>
                                    </div>
                                </div>
                                <div class="form-group switch-inline">
                                    <label><?php echo $this->lang->line('date_of_birth'); ?></label>
                                    <div class="material-switch switchcheck">
                                        <input id="enable_dob" name="is_active_dob" type="checkbox" class="chk" value="1">
                                        <label for="enable_dob" class="label-success"></label>
                                    </div>
                                </div>
                                <div class="form-group switch-inline">
                                    <label><?php echo $this->lang->line('blood_group'); ?></label>
                                    <div class="material-switch switchcheck">
                                        <input id="enable_blood_group" name="is_active_blood_group" type="checkbox" class="chk" value="1">
                                        <label for="enable_blood_group" class="label-success"></label>
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
            if ($this->rbac->hasPrivilege('student_id_card', 'can_add')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">
                <!-- general form elements -->
                <div class="box box-primary" id="hroom">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('icard'); ?> <?php echo $this->lang->line('list'); ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="mailbox-messages">
                            <div class="download_label"><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('icard'); ?> <?php echo $this->lang->line('list'); ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('icard'); ?> <?php echo $this->lang->line('title'); ?></th>
                                        <!-- <th>Certificate Text</th> -->
                                        <th><?php echo $this->lang->line('background_image'); ?></th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($idcardlist)) {
                                        ?>

                                        <?php
                                    } else {
                                        $count = 1;
                                        foreach ($idcardlist as $idcard) {
                                            ?>
                                            <tr>
                                                <td class="mailbox-name">
                                                    <a style="cursor: pointer;" id="<?php echo $idcard->id ?>" data-toggle="popover" class="detail_popover view_data" ><?php echo $idcard->title; ?></a>
                                                </td>
                                                <td class="mailbox-name">
                                                    <?php if ($idcard->background != '' && !is_null($idcard->background)) { ?>
                                                        <img src="<?php echo base_url('uploads/student_id_card/background/') ?><?php echo $idcard->background ?>" width="40">
                                                    <?php } else { ?>
                                                        <i class="fa fa-picture-o fa-3x" aria-hidden="true"></i>
                                                    <?php } ?>

                                                </td>
                                                <td class="mailbox-date pull-right no-print">
                                                    <a id="<?php echo $idcard->id ?>" class="btn btn-default btn-xs view_data"  data-toggle="tooltip" title="<?php echo $this->lang->line('view'); ?>">
                                                        <i class="fa fa-reorder"></i>
                                                    </a>
                                                    <?php
                                                    if ($this->rbac->hasPrivilege('student_id_card', 'can_edit')) {
                                                        ?>
                                                        <a href="<?php echo base_url(); ?>admin/studentidcard/edit/<?php echo $idcard->id ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <?php
                                                    }
                                                    if ($this->rbac->hasPrivilege('student_id_card', 'can_delete')) {
                                                        ?>
                                                        <a href="<?php echo base_url(); ?>admin/studentidcard/delete/<?php echo $idcard->id ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                            <i class="fa fa-remove"></i>
                                                        </a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        $count++;
                                    }
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
            <div class="col-md-12">
            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('view'); ?> <?php echo $this->lang->line('icard'); ?></h4>
            </div>
            <div class="modal-body" id="certificate_detail">

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#postdate').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        });
        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });
    });
</script>
<script type="text/javascript">
    var base_url = '<?php echo base_url() ?>';
    function printDiv(elem) {
        Popup(jQuery(elem).html());
    }

    function Popup(data)
    {

        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({"position": "absolute", "top": "-1000000px"});
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html>');
        frameDoc.document.write('<head>');
        frameDoc.document.write('<title></title>');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/bootstrap/css/bootstrap.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/font-awesome.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/ionicons.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/AdminLTE.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/skins/_all-skins.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/iCheck/flat/blue.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/morris/morris.css">');


        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/datepicker/datepicker3.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/daterangepicker/daterangepicker-bs3.css">');
        frameDoc.document.write('</head>');
        frameDoc.document.write('<body>');
        frameDoc.document.write(data);
        frameDoc.document.write('</body>');
        frameDoc.document.write('</html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);


        return true;
    }
</script>
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

        $("#header_color").colorpicker();
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.view_data').click(function () {
            var certificateid = $(this).attr("id");
            $.ajax({
                url: "<?php echo base_url('admin/studentidcard/view') ?>",
                method: "post",
                data: {certificateid: certificateid},
                success: function (data) {
                    $('#certificate_detail').html(data);
                    $('#myModal').modal("show");
                }
            });
        });
    });
</script>
<script type="text/javascript">
    function valueChanged()
    {
        if ($('#enable_student_img').is(":checked"))
            $("#enableImageDiv").show();
        // alert("Hii")
        else
            $("#enableImageDiv").hide();
        //alert("Bye")
    }
</script>