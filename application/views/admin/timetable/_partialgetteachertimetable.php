<?php
if (!empty($timetable)) {
    ?>
    <table class="table table-stripped">
        <thead>
            <tr>
                <?php
                foreach ($timetable as $tm_key => $tm_value) {
                    ?>
                    <th class="text text-center"><?php echo $tm_key; ?></th>
                    <?php
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                foreach ($timetable as $tm_key => $tm_value) {
                    ?>
                    <td class="text text-center">

                        <?php
                        if (!$timetable[$tm_key]) {
                            ?>
                            <div class="attachment-block clearfix">
                                <b class="text text-center"><?php echo $this->lang->line('not'); ?> <br><?php echo $this->lang->line('scheduled'); ?></b><br>
                            </div>
                            <?php
                        } else {
                            foreach ($timetable[$tm_key] as $tm_k => $tm_kue) {
                                ?>
                                <div class="attachment-block clearfix">
                                    <strong class="text-green"><?php echo $this->lang->line('class') ?>: <?php echo $tm_kue->class . "(" . $tm_kue->section . ")"; ?></strong><br>
                                    <b class="text-green"><?php echo $this->lang->line('subject') ?>: <?php echo $tm_kue->subject_name . " (" . $tm_kue->subject_code . ")"; ?>

                                    </b><br>

                                    <strong class="text-green"><?php echo $tm_kue->time_from ?></strong>
                                    <b class="text text-center">-</b>
                                    <strong class="text-green"><?php echo $tm_kue->time_to; ?></strong><br>

                                    <strong class="text-green"><?php echo $this->lang->line('room_no')?>: <?php echo $tm_kue->room_no; ?></strong><br>

                                </div>
                                <?php
                            }
                        }
                        ?>
                    </td>
                    <?php
                }
                ?>
            </tr>
        </tbody>
    </table>
    <?php
} else {
    ?>
    <div class="alert alert-info">
        <?php echo $this->lang->line('no_record_found'); ?>
    </div>
    <?php
}
?>