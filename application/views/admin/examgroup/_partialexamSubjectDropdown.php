<?php
$return_string = "";
if (empty($batch_subjects)) {

} else {
    ?>
<option value=""><?php echo $this->lang->line('select')?></option>

<?php

    if (!empty($batch_subjects)) {
        foreach ($batch_subjects as $subject_key => $subject_value) {
            ?>
          <option value="<?php echo $subject_value['id'] ?>"><?php echo $subject_value['name']." (".$subject_value['code'].")"; ?></option>

          <?php
}
    }

}

?>
