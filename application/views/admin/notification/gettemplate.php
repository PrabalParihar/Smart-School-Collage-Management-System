<style type="text/css">
    .lead_template {
   
    font-size: 16px;
    font-weight: 300;
    line-height: 1.4;
    padding: 0px;
    margin-bottom: 5px;
}
.lead_template_variable {
    font-size: 16px;
    font-weight: 300;
    line-height: 1.4;
    padding: 0px;
    margin-bottom: 5px;
}
</style>

 <div class="row">
            <div class="col-md-12">
             <p class="lead_template"><?php echo $this->lang->line($record->type); ?></p>
             <input type="hidden" name="temp_id" value="<?php echo $record->id; ?>">
                <div class="form-group">
                    <label for="form_message"><?php echo $this->lang->line('template'); ?></label>
                    <textarea id="form_message" name="template_message" class="form-control" rows="7"><?php echo $record->template; ?></textarea>
                    <div class="text text-danger template_message_error"></div>
                    <div class="hide_in_read">
                    <p class="lead_template_variable"><?php echo $this->lang->line('you_can_use_variables'); ?></p>
                    
                    <b>
                        <?php echo $record->variables; ?>
                    </b>
</div>
                </div>
            </div>

        </div>