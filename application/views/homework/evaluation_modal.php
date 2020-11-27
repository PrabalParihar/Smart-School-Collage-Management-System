<style type="text/css">
    .list-group-item.active, .list-group-item.active:focus, .list-group-item.active:hover {
    z-index: 2;
    color: #444;
    background-color: #fff;
    border-color: #ddd;
}
</style>

<div class="row row-eq">
    <?php
    $admin = $this->customlib->getLoggedInUserData();
    ?>
    <div class="col-lg-8 col-md-8 col-sm-8 paddlr">
        <!-- general form elements -->
        <form id="evaluation_data" method="post" class="ptt10" style="min-height: 500px;">
            <?php if (!empty($report)) { ?>
                <div class="alert alert-info"><?php echo $this->lang->line('homework_already_evaluated'); ?></div>
            <?php } ?>
            <div class="row">

                <div class="dual-list">
                    <div class="test">
                        <label><?php echo $this->lang->line('student_lists'); ?></label>
                        <div class="dualbg">

                            <ul multiple=""  class="list-group" id="slist">
                                <?php
                               // print_r($studentlist);
                               // exit();
                                foreach ($studentlist as $key => $value) {
                                    $active_status = false;
                                    if ($value["homework_evaluation_id"] != 0) {
                                        $active_status = true;
                                    }
                                    ?>

                                    <li class="list-group-item <?php echo ($active_status) ? "active" : "" ?>">
                                        <div class="checkbox">
                                            <label><input type="checkBox" <?php echo ($active_status) ? "checked='checked'" : "" ?>name="student_list[<?php echo $value["id"] ?>]" value="<?php echo $value["homework_evaluation_id"] ?>"><?php echo $value["firstname"]." ".$value["lastname"]." (".$value['admission_no'].")"; ?></label>
                                        </div>


                                    </li>

                                    <?php
                                }
                                ?>

                            </ul>
                        </div>
                    </div>
                </div>



            </div>


            <div class="row">


                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row">   
                        <div class="col-md-3 col-sm-5 col-xs-4">  
                            <div class="form-group">
                                <label class="pt5"><?php echo $this->lang->line('evaluation_date'); ?></label>
                            </div>
                        </div> 
                        <div class="col-md-3 col-sm-4 col-xs-4">      
                            <div class="form-group">  
                                <?php
                                $evl_date = "";
                                if ($result['evaluation_date'] != "0000-00-00") {
                                    $evl_date = date($this->customlib->getSchoolDateFormat(), $this->customlib->dateYYYYMMDDtoStrtotime($result['evaluation_date']));
                                }
                                ?>
                                <input type="text" id="evaluation_date" name="evaluation_date" class="form-control modalddate97" value="<?php echo $evl_date; ?>" readonly="">
                                <input type="hidden" name="homework_id" value="<?php echo $result["id"] ?>">
                                <?php
                                if (!empty($report)) {
                                    foreach ($report as $key => $report_value) {
                                        ?>
                                        <input type="hidden" name="evalid[]" value="<?php echo $report_value["evalid"] ?>">
                                        <?php
                                    }
                                }
                                ?>

                                <span class="text-danger" id="date_error"></span>
                            </div>
                        </div>   
                        <div class="col-md-2 col-sm-3 col-xs-4 pull-right" style="margin-right: -8px;"> 
                            <?php if ($this->rbac->hasPrivilege('homework_evaluation', 'can_add')) { ?> 
                                <div class="form-group">
                                    <input type="submit" name="" class="btn btn-info" value="<?php echo $this->lang->line('save'); ?>" />
                                </div>
                            <?php } ?>
                        </div> 
                    </div>  
                </div>    

            </div><!-- /.row--> 

        </form>
    </div><!--/.col (left) -->
    <div class="col-lg-4 col-md-4 col-sm-4 col-eq">
        <div class="taskside">

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
                <label><span><?php echo $this->lang->line('class') ?></span>: <?php echo $result['class']; ?></label>
                <label><span><?php echo $this->lang->line('section') ?></span>: <?php echo $result['section']; ?></label>
                <label><span><?php echo $this->lang->line('subject') . " " . $this->lang->line('group') ?></span>: <?php echo $result['subject_group']; ?></label>
                <label><span><?php echo $this->lang->line('subject') ?></span>: <?php echo $result['name']; ?></label>
                <?php if (!empty($result["document"])) { ?>
                    <label><a href="<?php echo base_url() . "homework/download/" . $result["id"] . "/" . $result["document"] ?>"><?php echo $this->lang->line('download') ?> <i class="fa fa-download"></i></a></label>
                    <?php
                }
                if ((!empty($report)) && $report[0]['assignments'] != 0) {
                    ?>
                    <label><span><?php echo "Submited Assignment" ?></span>:</label>
                    <a class="btn btn-default btn-xs" onclick="homework_docs(<?php echo $result['id']; ?>);" data-toggle="tooltip"  data-original-title="Assignments">
                        <i class="fa fa-download"></i></a>
                    <?php } ?>
                <label><span><?php echo $this->lang->line('description'); ?></span>: <br/><?php echo $result['description']; ?></label>



            </div> 
        </div>
    </div>  
</div>

<script type="text/javascript">
    $(function () {

        $('body').on('click', '.list-group .list-group-item', function () {
            $(this).removeClass('active');
            $(this).toggleClass('active');
            //  $(this).attr('selected');
            // $('select option[value="' + this.value + '"]').attr("selected", "true");
            //$(this).selected = true;
        });
        $('.list-arrows a').click(function () {
            var $button = $(this), actives = '';
            if ($button.hasClass('move-left')) {
                actives = $('#hlist option.active');
                actives.clone().appendTo('#slist');
                actives.remove();
            } else if ($button.hasClass('move-right')) {

                actives = $('#slist option.active');
                actives.clone().appendTo('#hlist');
                actives.remove();

            }
        });
        $('.dual-list .selector').click(function () {

            var $checkBox = $(this);
            if (!$checkBox.hasClass('selected')) {
                $checkBox.addClass('selected').closest('.test').find('select option:not(.active)').addClass('list-group-item active');

                $checkBox.children('i').removeClass('glyphicon-unchecked').addClass('glyphicon-check');
            } else {
                $checkBox.removeClass('selected').closest('.test').find('select option.active').removeClass('active');

                $checkBox.children('i').removeClass('glyphicon-check').addClass('glyphicon-unchecked');
            }
        });
        $('[name="SearchDualList"]').keyup(function (e) {
            var code = e.keyCode || e.which;
            if (code == '9')
                return;
            if (code == '27')
                $(this).val(null);
            var $rows = $(this).closest('.dual-list').find('.list-group option');
            var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
            $rows.show().filter(function () {
                var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
                return !~text.indexOf(val);
            }).hide();
        });

    });
</script>
<script>
    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
        $('#evaluation_date').datepicker({
            format: date_format,
            autoclose: true
        });

        $("#evaluation_data").on('submit', (function (e) {
            $("#hlist").find('option.active').attr("selected", "selected");

            e.preventDefault();
            $.ajax({
                url: "<?php echo site_url("homework/add_evaluation") ?>",
                type: "POST",
                data: new FormData(this),
                dataType: 'JSON',
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




    function listbox_moveacross(sourceID, destID) {
        var src = document.getElementById(sourceID);
        var dest = document.getElementById(destID);

        for (var count = 0; count < src.options.length; count++) {

            if (src.options[count].selected == true) {
                var option = src.options[count];

                var newOption = document.createElement("option");
                newOption.value = option.value;
                newOption.text = option.text;
                newOption.selected = true;
                try {
                    dest.add(newOption, null); //Standard
                    src.remove(count, null);
                } catch (error) {
                    dest.add(newOption); // IE only
                    src.remove(count);
                }
                count--;
            }
        }
    }


</script>