<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-map-o"></i> <?php echo $this->lang->line('examinations'); ?> <small><?php echo $this->lang->line('student_fee1'); ?></small></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-warning">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('exam_schedule'); ?> </h3>
                        <div class="box-tools pull-right"></div>
                    </div>
                    <div class="box-body table-responsive">
                        <div class="download_label"><?php echo $this->lang->line('exam_schedule'); ?></div>
                        <table class="table table-striped table-bordered table-hover example">
                            <thead>
                                <tr>
                                    <th style="width: 30px">#</th>
                                    <th><?php echo $this->lang->line('exam'); ?></th>
                                    <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($examSchedule)) {
    ?>
                                    <tr>
                                        <td colspan="12" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?></td>
                                    </tr>

                                    <?php
} else {
    $count = 1;
    foreach ($examSchedule as $exam) {

        ?>
                                        <tr>
                                            <td><?php echo $count; ?>.</td>
                                            <td><?php echo $exam->exam; ?></td>
                                            <td class="pull-right">
                                                <a  class="btn btn-primary btn-xs schedule_modal" data-toggle="tooltip" title="" data-examname="<?php echo $exam->exam; ?>" data-examid="<?php echo $exam->exam_group_class_batch_exam_id; ?>" >
                                                    <i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
    $count++;
}
}
?>
                            </tbody></table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">

    var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'MM', 'Y' => 'yyyy']) ?>';
    $(document).on('click', '.schedule_modal', function () {
        $('.modal-title').html("");
        var exam_id = $(this).data('examid');
        var examname = $(this).data('examname');

        $('.modal-title').html(examname);
        var base_url = '<?php echo base_url() ?>';
        $.ajax({
            type: "post",
            url: base_url + "user/examschedule/getexamscheduledetail",
            data: {'exam_id': exam_id},
            dataType: "json",
            success: function (response) {
                $('.modal-body').html(response.result);

                $("#scheduleModal").modal('show');


   var dtable = $('.modal-body').find('table').DataTable();
                
                $('div.dataTables_filter input').attr('placeholder', 'Search...');
                new $.fn.dataTable.Buttons(dtable, {

                    buttons: [

                        {
                            extend: 'copyHtml5',
                            text: '<i class="fa fa-files-o"></i>',
                            titleAttr: 'Copy',
                             title:examname,

                            exportOptions: {
                                columns: ':visible'
                            }
                        },

                        {
                            extend: 'excelHtml5',
                            text: '<i class="fa fa-file-excel-o"></i>',
                            titleAttr: 'Excel',
                             title:examname,
                            exportOptions: {
                                columns: ':visible'
                            }
                        },

                        {
                            extend: 'csvHtml5',
                            text: '<i class="fa fa-file-text-o"></i>',
                            titleAttr: 'CSV',
                             title:examname,
                            exportOptions: {
                                columns: ':visible'
                            }
                        },

                        {
                            extend: 'pdfHtml5',
                            text: '<i class="fa fa-file-pdf-o"></i>',
                            titleAttr: 'PDF',
                             title:examname,
                            exportOptions: {
                                columns: ':visible'
                            }
                        },

                        {
                            extend: 'print',
                            text: '<i class="fa fa-print"></i>',
                            titleAttr: 'Print',
                            title:examname,
                            exportOptions: {
                                columns: ':visible'
                            }
                        },

                        {
                            extend: 'colvis',
                            text: '<i class="fa fa-columns"></i>',
                            titleAttr: 'Columns',
                            postfixButtons: ['colvisRestore']
                        },
                    ]
                });

                dtable.buttons(0, null).container().prependTo(
                        dtable.table().container()
                        );

//===========

            }
        });
    });
</script>

<div id="scheduleModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
            </div>
        </div>
    </div>
</div>