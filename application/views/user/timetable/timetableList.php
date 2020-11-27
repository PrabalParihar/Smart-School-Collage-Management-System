<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-calendar-times-o"></i> <?php echo $this->lang->line('class_timetable'); ?> </h1>
    </section>
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">

                <div class="box box-warning">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"> <?php echo $this->lang->line('class_timetable'); ?></h3>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <div class="box-body">

                        <div class="table-responsive">
                            <div class="download_label"><?php echo $this->lang->line('class_timetable'); ?></div>

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

                                                                <b class="text-green"><?php echo $this->lang->line('subject') ?>: <?php echo $tm_kue->subject_name . " (" . $tm_kue->code . ")"; ?>

                                                                </b><br>

                                                                <strong class="text-green"><?php echo $tm_kue->time_from ?></strong>
                                                                <b class="text text-center">-</b>
                                                                <strong class="text-green"><?php echo $tm_kue->time_to; ?></strong><br>

                                                                <strong class="text-green"><?php echo $this->lang->line('room_no'); ?>: <?php echo $tm_kue->room_no; ?></strong><br>

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
                            }
                            ?>                            
                        </div>                     
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>