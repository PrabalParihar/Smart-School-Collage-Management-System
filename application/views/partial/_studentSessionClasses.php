<?php 
$current_class=($this->session->userdata('current_class'));
if(!empty($studentclasses)){
foreach ($studentclasses as $student_key => $student_value) {
	?>
<div class="row">
        <div class="col-md-12">
            <div class="well well-sm">
                <div class="row">
                    
                    <div class="col-xs-12 col-md-12 section-box">
                      
                        <div class="row rating-desc">
                            <div class="col-md-12">
                            	  <label class="checkbox-inline">
                                    <input type="checkbox" value="<?php echo $student_value->id;?>" class="clschg" name="clschg" <?php echo ($student_value->class_id ==$current_class['class_id'] && $student_value->section_id ==$current_class['section_id'] ) ? 'checked' :''; ?>><?php echo $student_value->class ." (".$student_value->section.")";?>
                                </label>
                          
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
        
    </div>
	<?php
}
}else{
?>
<div class="alert alert-info">
	No more classes found in your current session
</div>
<?php 	
}

 ?>