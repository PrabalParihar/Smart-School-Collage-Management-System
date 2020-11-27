
<style type="text/css">
    .hrexam {
        margin-top: 5px;
        margin-bottom: 5px;
        border: 0;
        border-top: 1px solid #eee;
    }
</style>
<?php
$correct_ans = 0;
$wrong_ans = 0;
$not_attempted = 0;
$total_question = 0;
if (!empty($question_result)) {
   $total_question=count($question_result);

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

;
?>
<dl class="row">
<dt class="col-sm-2"><?php echo $this->lang->line('exam')?></dt>
<dd class="col-sm-10"><?php echo $exam->exam; ?></dd>

<dt class="col-sm-2"><?php echo $this->lang->line('total')." ".$this->lang->line('attempt');?></dt>
<dd class="col-sm-10"><?php echo $exam->attempt; ?></dd>

<dt class="col-sm-2"><?php echo $this->lang->line('exam')." ".$this->lang->line('from');?></dt>
<dd class="col-sm-10"><?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($exam->exam_from)); ?></dd>

<dt class="col-sm-2"><?php echo $this->lang->line('exam')." ".$this->lang->line('to');?></dt>
<dd class="col-sm-10"><?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($exam->exam_to)); ?></dd>

<dt class="col-sm-2"><?php echo $this->lang->line('duration');?></dt>
<dd class="col-sm-10"><?php echo $exam->duration; ?></dd>
<dt class="col-sm-2"><?php echo $this->lang->line('passing')?> (%)</dt>
<dd class="col-sm-10"><?php echo $exam->passing_percentage; ?></dd>
<dt class="col-sm-2"><?php echo $this->lang->line('total')." ".$this->lang->line('question')?></dt>
<dd class="col-sm-10"><?php echo $total_question; ?></dd>

<dt class="col-sm-2"><?php echo $this->lang->line('correct')." ".$this->lang->line('answer')?></dt>
<dd class="col-sm-10"><?php echo $correct_ans; ?></dd>

<dt class="col-sm-2"><?php echo $this->lang->line('wrong')." ".$this->lang->line('answer');?></dt>
<dd class="col-sm-10"><?php echo $wrong_ans; ?></dd>
<dt class="col-sm-2"><?php echo $this->lang->line('not')." ".$this->lang->line('attempted');?></dt>
<dd class="col-sm-10"><?php echo $not_attempted; ?></dd>

<dt class="col-sm-2"><?php echo $this->lang->line('score');?> (%)</dt>
<dd class="col-sm-10"><?php echo ($correct_ans*100)/$total_question; ?></dd>

</dl>
<div class="pupscroll300">
<?php
if (!empty($question_result)) {
    foreach ($question_result as $result_key => $question_value) {
       
        ?>

        <div class="row">

            <div class="col-xs-12 col-md-12 section-box">

                <div>

        <?php echo readmorelink($question_value->question, site_url('admin/question/read/' . $question_value->question_id)); ?>
                    <p>

 
                        <b><?php echo $this->lang->line('subject');?>:</b>
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
                        <span class="label label-danger"><?php echo $this->lang->line('not')." ".$this->lang->line('attempted')?></span>
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
</div>