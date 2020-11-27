<?php
if ($question_status == 0) {
    if (empty($questions)) {
        ?>
        <div class="alert alter-info"><?php echo $this->lang->line('no_question_found_please_contact_to_administrator'); ?></div>
        <?php
    } else {
        ?>
        <div class="col-md-9 col-sm-9">
            <input type="hidden" name="onlineexam_student_id" value="<?php echo $onlineexam_student_id->id; ?>">
            <div class="question_list">
                <?php
                $counter = 1;
                foreach ($questions as $question_key => $question_value) {
                    ?>
                    <fieldset id="question_<?php echo $counter; ?>">
                        <input type="hidden" name="total_rows[]" value="<?php echo $counter; ?>">
                        <input type="hidden" name="question_id_<?php echo $counter; ?>" value="<?php echo $question_value->id; ?>">
                        <h3 class="mt0">Question:<?php echo $counter; ?></h3>
                        <div class="quizscroll">
                            <?php echo $question_value->question; ?>
                            <div class="radiocontainer">
                                <?php
                                $question_total_option = 1;
                                $question_display = TRUE;
                                foreach ($questionOpt as $question_opt_key => $question_opt_value) {
                                    if ($question_total_option == 5 && $question_value->{$question_opt_key} == "") {
                                        $question_display = FALSE;
                                    }
                                    if ($question_display) {
                                        ?>
                                        <label>
                                            <input type="radio" name="radio<?php echo $counter; ?>" value="<?php echo $question_opt_key; ?>" autocomplete="off"><?php echo $question_value->{$question_opt_key}; ?>
                                        </label>

                                        <?php
                                    }
                                    $question_total_option++;
                                }
                                ?>
                            </div> <!-- ./radiocontainer -->
                        </div><!--./quizscroll-->

                    </fieldset>
                    <?php
                    $counter++;
                }
                ?>
            </div>

        </div><!-- ./col-md-12-->
        <div class="col-md-3 col-sm-3">
            <div class="quizscroll">
                <h3 class="mt0"> <?php echo $this->lang->line('question') . " " . $this->lang->line('map'); ?></h3>

                <?php
                $question_counter = 1;
                foreach ($questions as $question_key => $question_value) {
                    ?>
                    <button type="button" class="btn btn-default question_switcher <?php echo ($question_counter == 1) ? "activeqbtn" : "" ?>" data-qustion_no="<?php echo $question_counter; ?>"><?php echo $question_counter; ?></button>
                    <?php
                    $question_counter++;
                }
                ?>


            </div><!--./quizscroll-->
        </div><!--./col-md-4-->
        <?php
    }
} else {
    ?>
    You have reched total attemps or exam date passed, Please contact to administrator.
    <?php
}
?>
  
