<div class="content-wrapper">
    <section class="content-header">
        <h1><i class="fa fa-bus"></i> <?php echo $this->lang->line('question'); ?></h1>
    </section>
    <section class="content">
        <div class="row">

            <div class="col-md-12">
                <div class="box box-primary" id="route">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('question') . " " . $this->lang->line('bank'); ?></h3>


                    </div>
                    <div class="box-body">
                        <div class="mailbox-controls">
                            <div class="pull-right">
                            </div>
                        </div>
                        <div class="mailbox-messages">
                            
                            <div class="questiondetail"><b><?php echo $this->lang->line('question'); ?>:</b>
                            <?php
                          

                            echo $question->question;
                             ?></div>   <?php
                            foreach ($questionOpt as $question_opt_key => $question_opt_value) {

                                $select_opt="";
                                if($question->correct == $question_opt_key){
                            $select_opt="active";
                                }
                                ?>
                               
                                <div class="<?php echo $select_opt;?> quesanslist">
                                    <?php echo $this->lang->line('option_' . $question_opt_value)." :&nbsp; ".$question->{$question_opt_key}; ?>
                                    
                                  
                                </div>
                                <?php
                            }

                         
                            ?>


                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
</div>