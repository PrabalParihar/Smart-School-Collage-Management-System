<div class="row row-eq">
    <?php
    //print_r($enquiry_data);
    $admin = $this->customlib->getLoggedInUserData();
    // print_r($admin);
    ?>
    <div class="col-lg-8 col-md-8 col-sm-8 paddlr">
        <!-- general form elements -->
        <form id="evaluation_data" method="post" class="ptt10" style="min-height: 500px;">
            <p><?php echo $result['description']; ?></p>
        </form>
    </div>




    <div class="col-lg-4 col-md-4 col-sm-4 col-eq">
        <div class="taskside">
            <?php //print_r($enquiry_data); ?>
            <h4><?php echo $this->lang->line('summary'); ?></h4>
            <div class="box-tools pull-right">
            </div><!-- /.box-tools -->
            <h5 class="pt0 task-info-created">
               
            </h5>

            <hr class="taskseparator" />
            <div class="task-info task-single-inline-wrap task-info-start-date">
                <h5><i class="fa task-info-icon fa-fw fa-lg fa-calendar-plus-o pull-left fa-margin"></i>
                    <span><?php echo $this->lang->line('homework_date'); ?></span>:<?php print_r(date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($result['homework_date']))); ?>                                      
                </h5>
            </div>
            <div class="task-info task-single-inline-wrap task-info-start-date">
                <h5><i class="fa task-info-icon fa-fw fa-lg fa-calendar-plus-o pull-left fa-margin"></i>
                    <span><?php echo $this->lang->line('submission_date'); ?></span>:<?php print_r(date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($result['submit_date']))); ?>                                      
                </h5>
            </div>
              <div class="task-info task-single-inline-wrap task-info-start-date">
                <h5><i class="fa task-info-icon fa-fw fa-lg fa-calendar-plus-o pull-left fa-margin"></i>
                    <span>
                        <?php echo $this->lang->line('evaluation_date'); ?></span>:
                        <?php
                        $evl_date = "";
                        if ($result['evaluation_date'] != "0000-00-00") {
                            echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateYYYYMMDDtoStrtotime($result['evaluation_date']));
                        }
                        ?>
                </h5>
            </div>

            <div class="task-info task-single-inline-wrap ptt10">
                <label><span><?php echo $this->lang->line('created_by'); ?></span>: <?php echo $created_by; ?></label>
                <label><span><?php echo $this->lang->line('evaluated_by'); ?></span>: <?php echo $evaluated_by; ?></label>             
                <label><span><?php echo $this->lang->line("class") ?></span>: <?php echo $result['class']; ?></label>
                <label><span><?php echo $this->lang->line("section") ?></span>: <?php echo $result['section']; ?></label>
                <label><span><?php echo $this->lang->line("subject") ?></span>: <?php echo $result['name']; ?></label>
                <label><span><?php echo $this->lang->line("status") ?></span>: <?php
                   
                        
                        if ($status == 1) {
                            $class = "class= 'label label-success'";
                            $status_label=$this->lang->line('complete');
                        } else {
                            $class = "class= 'label label-danger'";
                            $status_label=$this->lang->line('incomplete');
                        }
                        echo "<font $class >" . $status_label . "</font>";
                   
                    ?></label>
                        <?php if (!empty($result["document"])) { ?>  
                    <label><a href="<?php echo base_url() . "parent/homework/download/" . $result["id"] . "/" . $result["document"] ?>"><?php echo $this->lang->line('download') ?> <i class="fa fa-download"></i></a></label>

<?php }
if(!empty($homeworkdocs)){
 ?>

<?php echo $this->lang->line('uploaded')." ".$this->lang->line('documents'); ?></label><p><a href="<?php echo base_url();?>/parent/homework/assigmnetDownload/<?php echo $homeworkdocs[0]['id']?>/<?php echo $homeworkdocs[0]['docs']?>" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('assignments')." ".$this->lang->line('download'); ?>">                                                    <i class="fa fa-download"></i></a><?php } ?>
            </div> 
        </div>
    </div>  
</div>
<?php

function searchForId($id, $array) {
    foreach ($array as $key => $val) {
        if ($val['student_id'] === $id) {
            return "<label class='label label-success'>" . $val["status"] . "</label>";
        }
    }
   // return "<label class='label label-danger'>Incomplete</label>";
}
?>
<script>
    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
        $('#evaluation_date').datepicker({
            format: date_format,
            autoclose: true
        });



    });

    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
        $('#follow_date_of_call').datepicker({
            format: date_format,
            autoclose: true
        });


        $("#modaltable").DataTable({
            dom: "Bfrtip",
            buttons: [

                {
                    extend: 'copyHtml5',
                    text: '<i class="fa fa-files-o"></i>',
                    titleAttr: 'Copy',
                    title: $('.download_label').html(),
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-file-excel-o"></i>',
                    titleAttr: 'Excel',

                    title: $('.download_label').html(),
                    exportOptions: {
                        columns: ':visible'
                    }
                },

                {
                    extend: 'csvHtml5',
                    text: '<i class="fa fa-file-text-o"></i>',
                    titleAttr: 'CSV',
                    title: $('.download_label').html(),
                    exportOptions: {
                        columns: ':visible'
                    }
                },

                {
                    extend: 'pdfHtml5',
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    titleAttr: 'PDF',
                    title: $('.download_label').html(),
                    exportOptions: {
                        columns: ':visible'

                    }
                },

                {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i>',
                    titleAttr: 'Print',
                    title: $('.download_label').html(),
                    customize: function (win) {
                        $(win.document.body)
                                .css('font-size', '10pt');

                        $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                    },
                    exportOptions: {
                        columns: ':visible'
                    }
                },

                {
                    extend: 'colvis',
                    text: '<i class="fa fa-columns"></i>',
                    titleAttr: 'Columns',
                    title: $('.download_label').html(),
                    postfixButtons: ['colvisRestore']
                },
            ]
        });
    });




</script>