<option value=""><?php echo $this->lang->line('select')?></option>
<?php 
foreach($resultlist as $value){ ?>
<option value="<?php echo $value['id']; ?>" <?php if($select_id==$value['id']){ echo "selected";} ?>><?php echo $value['firstname']." ".$value['lastname'];?></option>
<?php
}
?>
