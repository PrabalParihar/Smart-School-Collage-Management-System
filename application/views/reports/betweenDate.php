
<script type="text/javascript"> 
            $('.date').datepicker().trigger('change');</script>
<div class="col-sm-6 col-md-3">
    <div class="form-group">
        <label><?php echo $this->lang->line('date_from'); ?></label>
        <input name="date_from" placeholder="" type="text" class="form-control date" value="<?php echo set_value('date_from', date($this->customlib->getSchoolDateFormat())); ?>"  />
        <span class="text-danger"><?php echo form_error('date_from'); ?></span>
    </div>
</div> 

<div class="col-sm-6 col-md-3">
    <div class="form-group">
        <label><?php echo $this->lang->line('date_to'); ?></label>
        <input  name="date_to" placeholder="" type="text" class="form-control date" value="<?php echo set_value('date_to', date($this->customlib->getSchoolDateFormat())); ?>"  />
        <span class="text-danger"><?php echo form_error('date_to'); ?></span>
    </div>
</div> 
