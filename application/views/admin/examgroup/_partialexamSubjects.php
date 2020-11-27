   <div class="row pb10">
        <div class="col-lg-2 col-md-3 col-sm-12">   
            <p class="examinfo"><span><?php echo $this->lang->line('exam'); ?></span><?php echo $examgroupDetail->exam; ?></p>
        </div>
        <div class="col-lg-10 col-md-9 col-sm-12">   
            <p class="examinfo"><span><?php echo $this->lang->line('exam')." ".$this->lang->line('group');?></span><?php echo $examgroupDetail->exam_group_name; ?></p>
        </div> 
    </div>    
  <div class="divider2"></div>
   
<div class="row">
    <div class="col-md-12 pt5">
            <button type="button" name="add" class="btn btn-primary btn-sm add pull-right" autocomplete="off"><span class="fa fa-plus"></span> <?php echo $this->lang->line('add')." ".$this->lang->line('exam')." ".$this->lang->line('subject');?></button>
    </div>
</div>
<form action="<?php echo site_url('admin/examgroup/addexamsubject') ?>" method="POST" class="ssaddSubject ptt10">
    <input type="hidden" name="exam_group_class_batch_exam_id" value="<?php echo $exam_id; ?>">
    <div class="table-responsive">
      <table class="table table-bordered" id="item_table">
        <thead>
            <tr>
                <th class=""><?php echo $this->lang->line('subject'); ?></th>
                <th class=""><?php echo $this->lang->line('date'); ?></th>
                <th class=""><?php echo $this->lang->line('time');?></th>
                <th class=""><?php echo $this->lang->line('duration')?></th>
                <th class=""><?php echo $this->lang->line('credit')." ".$this->lang->line('hours') ?></th>
                <th class=""><?php echo $this->lang->line('room')." ".$this->lang->line('no')?></th>
                <th class=""><?php echo $this->lang->line('marks')." (".$this->lang->line('max').".)";?></th>
                <th class=""><?php echo $this->lang->line('marks')." (".$this->lang->line('min').".)";?></th>
                <?php
        if ($examgroupDetail->exam_group_type == "coll_grade_system") {
            ?>
             <th class="text-center"><?php echo $this->lang->line('action'); ?></th>
            <?php
        }
        ?>
               
            </tr>
        </thead>
        <?php
        if (!empty($exam_subjects)) {
            $count = 1;
            foreach ($exam_subjects as $exam_subject_key => $exam_subject_value) {
                ?>
                <tr>
                    <td>
                        <select class="form-control item_unit" name="subject_<?php echo $count; ?>">
                            <option value=""><?php echo $this->lang->line('select')?></option>

                            <?php
                            if (!empty($batch_subjects)) {
                                foreach ($batch_subjects as $subject_key => $subject_value) {
                                    ?>
                                    <option value="<?php echo $subject_value['id'] ?>" <?php echo set_select('subject_' . $count, $subject_value['id'], ($exam_subject_value->subject_id == $subject_value['id']) ? true : false); ?>><?php echo $subject_value['name']." (".$subject_value['code'].")"; ?></option>

                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <div class="input-group datepicker_init">
                            <input class="form-control" name="date_from_<?php echo $count; ?>" type="text" value="<?php echo $this->customlib->dateyyyymmddToDateTimeformat($exam_subject_value->date_from); ?>">
                            <span class="input-group-addon" id="basic-addon2">
                                <i class="fa fa-calendar">
                                </i>
                            </span>
                            </input>
                        </div>
                    </td>
                    <td >
                        <div class="input-group datepicker_init_time">
            <input type="text" name="time_from<?php echo $count; ?>" class="form-control" value="<?php echo $exam_subject_value->time_from; ?>">
                            <span class="input-group-addon" id="basic-addon2">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </div>
                    </td>

<td>
<input type="text" name="duration<?php echo $count; ?>" class="form-control duration" value="<?php echo $exam_subject_value->duration; ?>" autocomplete="off">
</td>

                    <td>
                        <input class="form-control credit_hours" name="credit_hours_<?php echo $count; ?>" type="text" value="<?php echo $exam_subject_value->credit_hours; ?>"/>
                    </td>
                         <td>
                        <input class="form-control room_no" name="room_no_<?php echo $count; ?>" type="text" value="<?php echo $exam_subject_value->room_no ?>"/>
                    </td>
                    <td>
                        <input class="form-control max_marks" name="max_marks_<?php echo $count; ?>" type="number" value="<?php echo $exam_subject_value->max_marks; ?>"/>
                    </td>
                    <td>
                        <input name="rows[]" type="hidden" value="<?php echo $count; ?>">
                        <input name="prev_row[<?php echo $count; ?>]" type="hidden" value="<?php echo $exam_subject_value->id; ?>">
                        <input class="form-control min_marks" name="min_marks_<?php echo $count; ?>" type="number" value="<?php echo $exam_subject_value->min_marks; ?>"/>

                    </td>
                    
                    <td class="text-center" style="vertical-align: middle; cursor: pointer;">
                        <span class="text text-danger remove glyphicon glyphicon-remove"></span>
                    </td>
        
                   
                </tr>

                <?php
                $count++;
            }
        }
        ?>
    </table>
  </div>  
  <div class="modal-footer"> 
   <div class="row"> 
    <?php 
    if($this->rbac->hasPrivilege('exam_subject','can_edit')){
        ?>
        <button type="submit" class="btn btn-primary pull-right" id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Saving..."><?php echo $this->lang->line('save')?></button>
        <?php
    }
    ?>
    
  </div>  
</div>

</form>
