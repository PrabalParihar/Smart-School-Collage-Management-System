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
                            <?php echo $this->lang->line('subject_list'); ?>
                        </h3>
                    </div>                   
                    <div class="box-body">
                        <div class="download_label"><?php echo $this->lang->line('subject_list'); ?></div>
                        <table class="table table-striped table-bordered table-hover example">
                            <thead>
                                <tr>
                                    <th><?php echo $this->lang->line('teacher_name'); ?></th>
                                    <th><?php echo $this->lang->line('subject'); ?></th>
                                    <th class="text-right"><?php echo $this->lang->line('type'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($result_array)) {
                                    ?>
                                    <tr>
                                        <td colspan="12" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?></td>
                                    </tr>
                                    <?php
                                } else {
                                    foreach ($result_array as $key => $value) {
                                        ?>
                                        <tr>
                                            <td><?php echo $value['teacher_name'] ?></td>
                                            <td><?php echo $value['name'] ?></td>
                                            <td class="text-right"><?php echo $value['type'] ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>