<style type="text/css">
    .hrexam {
        margin-top: 5px;
        margin-bottom: 5px;
        border: 0;
        border-top: 1px solid #eee;
    }

    input[disabled=disabled], input:disabled {
        cursor: not-allowed;
        pointer-events: none;
        color: #c0c0c0;
        background-color: #ffffff;
    }
    #regiration_form fieldset:not(:first-of-type) {
        display: none;
    }
    .questionclose{right:10px; top:10px;}
    .questionclose:focus, .questionclose:hover{color: #444;}
    .questionlogo img{height: 24px;}
    .inlineblock{display: inline-block;}
</style>
<div class="content-wrapper" style="min-height: 946px;">

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"> <?php echo $this->lang->line('online') . " " . $this->lang->line('exam'); ?></h3>
                        <div class="box-tools pull-right"></div>
                    </div>    
                    <div class="box-body">
                        <?php
                        if (!empty($online_exam_validate)) {
                            $correct_ans = 0;
                            $wrong_ans = 0;
                            $not_attempted = 0;
                            $total_question = 0;
                            if (!empty($question_result)) {
                                $total_question = count($question_result);

                                foreach ($question_result as $result_key => $question_value) {
                                    if ($question_value->select_option != NULL) {

                                        if ($question_value->select_option == $question_value->correct) {
                                            $correct_ans++;
                                        } else {
                                            $wrong_ans++;
                                        }
                                    } else {
                                        $not_attempted++;
                                    }
                                }
                            }
                            ?>
                            <dl class="row">
                                <dt class="col-sm-3 col-xs-4 col-md-2"><?php echo $this->lang->line('exam') ?></dt>
                                <dd class="col-sm-9 col-xs-8 col-md-10"><?php echo $exam->exam; ?></dd>

                                <dt class="col-sm-3 col-xs-4 col-md-2"><?php echo $this->lang->line('total') . " " . $this->lang->line('attempt') ?></dt>
                                <dd class="col-sm-9 col-xs-8 col-md-10"><?php echo $exam->attempt; ?></dd>

                                <dt class="col-sm-3 col-xs-4 col-md-2"><?php echo $this->lang->line('exam') . " " . $this->lang->line('from') ?></dt>
                                <dd class="col-sm-9 col-xs-8 col-md-10"><?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($exam->exam_from)); ?></dd>

                                <dt class="col-sm-3 col-xs-4 col-md-2"><?php echo $this->lang->line('exam') . " " . $this->lang->line('to') ?></dt>
                                <dd class="col-sm-9 col-xs-8 col-md-10"><?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($exam->exam_to)); ?></dd>

                                <dt class="col-sm-3 col-xs-4 col-md-2"><?php echo $this->lang->line('duration') ?></dt>
                                <dd class="col-sm-9 col-xs-8 col-md-10"><?php echo $exam->duration; ?></dd>
                                <dt class="col-sm-3 col-xs-4 col-md-2"><?php echo $this->lang->line('passing') ?>   (%)</dt>
                                <dd class="col-sm-9 col-xs-8 col-md-10"><?php echo $exam->passing_percentage; ?></dd>
                                <dt class="col-sm-3 col-xs-4 col-md-2"><?php echo $this->lang->line('total') . " " . $this->lang->line('questions') ?></dt>
                                <dd class="col-sm-9 col-xs-8 col-md-10"><?php echo $total_question; ?></dd>

                                <?php
                                if ($exam->publish_result) {
                                    ?>
                                    <dt class="col-sm-3 col-xs-4 col-md-2"><?php echo $this->lang->line('correct') . " " . $this->lang->line('answer') ?></dt>
                                    <dd class="col-sm-10"><?php echo $correct_ans; ?></dd>

                                    <dt class="col-sm-3 col-xs-4 col-md-2"><?php echo $this->lang->line('wrong') . " " . $this->lang->line('answer'); ?></dt>
                                    <dd class="col-sm-10"><?php echo $wrong_ans; ?></dd>
                                    <dt class="col-sm-3 col-xs-4 col-md-2"><?php echo $this->lang->line('not') . " " . $this->lang->line('attempted'); ?></dt>
                                    <dd class="col-sm-10"><?php echo $not_attempted; ?></dd>

                                    <dt class="col-sm-3 col-xs-4 col-md-2"><?php echo $this->lang->line('score'); ?> (%)</dt>
                                    <dd class="col-sm-10"><?php echo ($correct_ans * 100) / $total_question; ?></dd>
                                    <?php
                                }
                                ?>
                        
                            </dl>
                            <?php
                            if (!empty($question_result) && ($exam->publish_result) ) {

                                foreach ($question_result as $result_key => $question_value) {
                                    ?>

                                    <div class="row">

                                        <div class="col-xs-12 col-md-12 section-box">

                                            <div>
                                                <p>
                                                    <?php echo readmorelinkUser($question_value->question, "question" . $question_value->id); ?>
                                                </p>                                           
                                                <div class="collapse" id="question<?php echo $question_value->id; ?>">
                                                    <?php echo $question_value->question ?>
                                                </div>

                                                <p><b><?php echo $this->lang->line('subject') ?>:</b>
                                                    <?php echo $question_value->subject_name; ?></p>

                                                <?php
                                                if ($question_value->select_option != NULL) {

                                                    if ($question_value->select_option == $question_value->correct) {
                                                        ?>
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <span class="label label-danger">Not <?php echo $this->lang->line('attempted'); ?></span>
                                                    <?php
                                                }
                                                ?>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="hrexam"></div>


                                    <?php
                                }
                            }
                            ?>
                            <?php
                          
                            if (empty($result_prepare) && !($exam->publish_result)) {
                                ?>
                                <div class="row no-print">
                                    <div class="col-xs-12">

                                        <button type="button" class="btn btn-info questions" data-recordid="<?php echo $exam->id; ?>"  data-loading-text="<i class='fa fa-spinner fa-spin'></i> Please wait..."><i class="fa fa-bullhorn"></i> <?php echo $this->lang->line('start') . " " . $this->lang->line('exam') ?></button>


                                    </div>
                                </div>
                                <?php
                            }
                            ?>

                            <?php
                        } else {
                            ?>
                            <div class="alert alert-info">
                                <?php echo $this->lang->line('exam_meassage_student'); ?>
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal -->
<div class="questionmodal">
    <form id="regiration_form"  action="<?php echo site_url('user/onlineexam/save') ?>" method="post">
        <div id="onlineexample" class="modal fade" role="dialog">
            <div class="modal-dialog modal-dialogfullwidth">
                <!-- Modal content-->
                <div class="modal-content modal-contentfull">
                    <div class="modal-header">
                        <button type="button" class="close questionclose" data-dismiss="modal">&times;</button>
                        <div class="questionlogo"><img src="<?php echo base_url(); ?>uploads/school_content/admin_logo/<?php $this->setting_model->getAdminlogo(); ?>" alt="<?php echo $this->customlib->getAppName() ?>" /></div>
                    </div>
                    <div class="exambgtop">
                        <h3><?php echo $exam->exam; ?></h3>
                        <div class="exambgright">
                            <div id="box_header" class="inlineblock"></div>
                            <button type="button" class="btn btn-info btn-sm save_exam_btn"><?php echo $this->lang->line('submit') ?> </button>
                        </div>
                    </div><!-- ./exambgtop -->
                    <div class="modal-body">
                        <div class="row question_container">

                        </div><!--./row-->
                    </div><!--./modal-body-->


                </div><!--./modal-content-->


            </div><!--./modal-dialog-->
            <div class="quizfooter">
                <input type="button" name="next" class="next qbtn-previous" value="Previous" style="display: none;">
                <input type="button" name="next" class="next qbtn-next" value="Next">
            </div><!-- ./quizfooter -->
        </div><!--./-->

    </form>
</div><!-- questionmodal -->


<div id="saveModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('confirm') . " " . $this->lang->line('save'); ?></h4>
            </div>
            <div class="modal-body">
                <p><?php echo $this->lang->line('are_you_sure_you_want_to_submit_this_exam') ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-ok"><?php echo $this->lang->line('save'); ?></button>

            </div>
        </div>

    </div>
</div>

<script type="text/javascript">

    $('#saveModal').on('click', '.btn-ok', function (e) {
        $("#regiration_form").submit();
    });


    $(document).ready(function () {



        var current = 1, current_step, next_step, steps, elapsed_seconds;
        steps = 0;
        elapsed_seconds = 0;
        var timer2 = "00:00:00";
        $(document).on('click', '.qbtn-next', function () {

            if ($("div.question_list").find("fieldset:visible").next().is(":last-child"))
            {
                $('.qbtn-next').toggle();
            }

            current_step = $("div.question_list").find("fieldset:visible");
            next_step = $("div.question_list").find("fieldset:visible").next();


            next_step.show();
            current_step.hide();


            if ($("div.question_list").find("fieldset:visible").prev().length) {
                $('.qbtn-previous').show();
            }

            if ($("div.question_list").find("fieldset:visible").next().length) {
                $('.qbtn-next').show();
            }

            activeQuestionButton();

        });

        $(document).on('click', '.qbtn-previous', function () {




            if ($("div.question_list").find("fieldset:visible").prev().is(":first-child"))
            {

                $('.qbtn-previous').hide();
            }
            current_step = $("div.question_list").find("fieldset:visible");
            next_step = $("div.question_list").find("fieldset:visible").prev();
            next_step.show();
            current_step.hide();

            if ($("div.question_list").find("fieldset:visible").prev().length) {
                $('.qbtn-previous').show();
            }
            if ($("div.question_list").find("fieldset:visible").next().length) {
                $('.qbtn-next').show();
            }
            activeQuestionButton();
        });


    });
    function activeQuestionButton() {
        var qu = $("div.question_list").find("fieldset:visible").attr('id');
        var qustion_n = qu.split("question_");

        var sss = $("button[data-qustion_no='" + qustion_n[1] + "']");

        sss.addClass("activeqbtn");
        $("button.question_switcher").not(sss).removeClass('activeqbtn');

    }
</script>

<script type="text/javascript">


    $(document).on('click', '.question_switcher', function () {
        var question_no = $(this).data('qustion_no');
        var btn = $(this).addClass("activeqbtn");

        $("button.question_switcher").not(btn).removeClass('activeqbtn');

        var $this = $("div.question_list").find("fieldset#question_" + question_no);
        $("div.question_list").find("fieldset").not($this).hide();
        $this.show();

        if ($("div.question_list").find("fieldset:visible").is(":first-child"))
        {
            $('.qbtn-previous').hide();
        }

        if ($("div.question_list").find("fieldset:visible").is(":last-child"))
        {
            $('.qbtn-next').hide();
        }

        if ($("div.question_list").find("fieldset:visible").prev().length) {
            $('.qbtn-previous').show();
        }

        if ($("div.question_list").find("fieldset:visible").next().length) {
            $('.qbtn-next').show();
        }

    });
    $(document).on('click', '.questions', function () {
        elapsed_seconds = 0;
        var $this = $(this);
        var recordid = $this.data('recordid');
        $('input[name=recordid]').val(recordid);
        $.ajax({
            type: 'POST',
            url: baseurl + "user/onlineexam/getExamForm",
            data: {'recordid': recordid},
            dataType: 'JSON',
            beforeSend: function () {
                $this.button('loading');
                clearInterval(interval);
            },
            success: function (data) {

                if (data.question_status == 0) {

                    $('#box_header').html(data.exam.duration);
                    timer2 = data.exam.duration;
                    timer();
                    $('.question_container').html(data.page);

                    $('#onlineexample').modal({
                        show: true,
                        backdrop: 'static',
                        keyboard: false
                    });


                } else {
                    errorMsg(data.page);
                }


                $this.button('reset');
            },
            error: function (xhr) { // if error occured
                alert("Error occured.please try again");
                $this.button('reset');
            },
            complete: function () {
                $this.button('reset');
            }
        });

    });

</script>



<script type="text/javascript">
    var interval;
    var timer = function () {
        interval = setInterval(function () {
            $('#box_header').text(get_elapsed_time_string());
        }, 1000);
    };


    function get_elapsed_time_string() {
        function pretty_time_string(num) {
            return (num < 10 ? "0" : "") + num;
        }

        timer111 = timer2.split(':');

        var hours = parseInt(timer111[0], 10);
        var minutes = parseInt(timer111[1], 10);
        var seconds = parseInt(timer111[2], 10);
        --seconds;
        minutes = (seconds < 0) ? --minutes : minutes;
        seconds = (seconds < 0) ? 59 : seconds;
        hours = (minutes < 0) ? --hours : hours;
        minutes = (minutes < 0) ? 59 : minutes;

        hours = pretty_time_string(hours);
        minutes = pretty_time_string(minutes);
        seconds = pretty_time_string(seconds);

        if (hours < 0)
            clearInterval(interval);

        if ((seconds <= 0) && (minutes <= 0) && (hours <= 0)) {
            clearInterval(interval);
            $("#regiration_form").submit();
        }

        timer2 = hours + ":" + minutes + ":" + seconds;
        var currentTimeString = hours + ":" + minutes + ":" + seconds;

        return currentTimeString;
    }





    $('.save_exam_btn').click(function () {
        $('#saveModal').modal({
            show: true,
            backdrop: 'static',
            keyboard: false
        })
    });



</script>
<script language="JavaScript">

    window.onload = function () {
        //    $("#onlineexample").on("contextmenu",function(e){
        //    e.preventDefault();
        //  }, false);


        //     $('#onlineexample').bind('cut copy paste', function (e) {
        //      e.preventDefault();
        //  });
        // $("#onlineexample").on("keydown",function(e){

        //    if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {
        //      disabledEvent(e);
        //    }
        //    // "J" key
        //    if (e.ctrlKey && e.shiftKey && e.keyCode == 74) {
        //      disabledEvent(e);
        //    }
        //    // "S" key + macOS
        //    if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
        //      disabledEvent(e);
        //    }
        //    // "U" key
        //    if (e.ctrlKey && e.keyCode == 85) {
        //      disabledEvent(e);
        //    }
        //    // "F12" key
        //    if (event.keyCode == 123) {
        //      disabledEvent(e);
        //    }
        //  }, false);
        //  function disabledEvent(e){
        //    if (e.stopPropagation){
        //      e.stopPropagation();
        //    } else if (window.event){
        //      window.event.cancelBubble = true;
        //    }
        //    e.preventDefault();
        //    return false;
        //  }
    };
</script>