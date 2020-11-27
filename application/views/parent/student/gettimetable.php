<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('student_information'); ?><small><?php echo $this->lang->line('student1'); ?></small>        </h1>
    </section>    
    <section class="content">
        <div class="row">
            <div class="col-md-3">            
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url() . $student['image'] ?>" alt="User profile picture">
                        <h3 class="profile-username text-center"><?php echo $student['firstname'] . " " . $student['lastname']; ?></h3>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('admission_no'); ?></b> <a class="pull-right text-aqua"><?php echo $student['admission_no']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('roll_no'); ?></b> <a class="pull-right text-aqua"><?php echo $student['roll_no']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('class'); ?></b> <a class="pull-right text-aqua"><?php echo $student['class']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('section'); ?></b> <a class="pull-right text-aqua"><?php echo $student['section']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('rte'); ?></b> <a class="pull-right text-aqua"><?php echo $student['rte']; ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">
                            <?php echo $this->lang->line('class_timetable'); ?>
                        </h3>
                    </div>
                    <div class="box-body">
                       <?php
                            if (!empty($timetable)) {
                                ?>
                             <div class="table-responsive">   
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

                                                                <strong class="text-green"><?php echo $this->lang->line('room_no');?>: <?php echo $tm_kue->room_no; ?></strong><br>

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