<footer class="main-footer">
    &copy;  <?php echo date('Y'); ?> 
    <?php echo $this->customlib->getAppName(); ?> <?php echo $this->customlib->getAppVersion(); ?>   
</footer>
<div class="control-sidebar-bg"></div>
</div>
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<link href="<?php echo base_url(); ?>backend/toast-alert/toastr.css" rel="stylesheet"/>
<script src="<?php echo base_url(); ?>backend/toast-alert/toastr.js"></script>

<script src="<?php echo base_url(); ?>backend/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>backend/dist/js/raphael-min.js"></script>
<script src="<?php echo base_url(); ?>backend/plugins/morris/morris.min.js"></script>
<script src="<?php echo base_url(); ?>backend/plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url(); ?>backend/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url(); ?>backend/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?php echo base_url(); ?>backend/plugins/knob/jquery.knob.js"></script>
<script src="<?php echo base_url(); ?>backend/plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url(); ?>backend/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<script src="<?php echo base_url(); ?>backend/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url(); ?>backend/plugins/fastclick/fastclick.min.js"></script>

<!--language js-->
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/js/bootstrap-select.min.js"></script>
<script type="text/javascript">
    $(function(){
      $('.languageselectpicker').selectpicker();
   });
</script>

<script src="<?php echo base_url(); ?>backend/dist/js/app.min.js"></script>
<!--nprogress-->
<script src="<?php echo base_url(); ?>backend/dist/js/nprogress.js"></script>
<!--file dropify-->
<script src="<?php echo base_url(); ?>backend/dist/js/dropify.min.js"></script>
<script src="<?php echo base_url(); ?>backend/dist/js/demo.js"></script>

<!--print table-->
<!--print table-->
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/jquery.dataTables.min-stu.par.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/pdfmake.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/vfs_fonts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/buttons.print.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/buttons.colVis.min.js" ></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/dataTables.responsive.min.js" ></script>

<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/ss.custom.js" ></script>
</body>
</html>

<script type="text/javascript">


    function complete_event(id, status) {

        $.ajax({
            url: "<?php echo site_url("parent/calendar/markcomplete/") ?>" + id,
            type: "POST",
            data: {id: id, active: status},
            dataType: 'json',

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
    }

    function markc(id) {

        $('#newcheck' + id).change(function () {

            if (this.checked) {

                complete_event(id, 'yes');
            } else {

                complete_event(id, 'no');
            }

        });
    }

</script>


<script type="text/javascript">
    $(document).ready(function () {
<?php
if ($this->session->flashdata('success_msg')) {
    ?>
            successMsg("<?php echo $this->session->flashdata('success_msg'); ?>");
    <?php
} else if ($this->session->flashdata('error_msg')) {
    ?>
            errorMsg("<?php echo $this->session->flashdata('error_msg'); ?>");
    <?php
} else if ($this->session->flashdata('warning_msg')) {
    ?>
            infoMsg("<?php echo $this->session->flashdata('warning_msg'); ?>");
    <?php
} else if ($this->session->flashdata('info_msg')) {
    ?>
            warningMsg("<?php echo $this->session->flashdata('info_msg'); ?>");
    <?php
}
?>
    });
</script>