<link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script src="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-bullhorn"></i> <?php echo $this->lang->line('communicate'); ?> <small><?php echo $this->lang->line('student_fee1'); ?></small>
        </h1>
    </section>   
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid1 box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-commenting-o"></i> <?php echo $this->lang->line('notice_board'); ?></h3>
                        <?php if ($this->rbac->hasPrivilege('notice_board', 'can_add')) { ?>
                            <div class="box-tools pull-right">
                                <a href="<?php echo base_url() ?>admin/notification/add" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> <?php echo $this->lang->line('post_new_message'); ?></a>
                            </div>
                        <?php } ?>
                    </div>                 
                    <div class="box-body">
                        <div class="box-group" id="accordion">                          
                            <?php if (empty($notificationlist)) {
                                ?>
                                <div class="alert alert-info"><?php echo $this->lang->line('no_record_found'); ?></div>
                                <?php
                            } else {
                                foreach ($notificationlist as $key => $notification) {
                                    $role_name = $notification["role_name"];
                                    ?>
                                    <div class="panel box box-primary">
                                        <div class="box-header with-border">
                                            <h4 class="box-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $notification['id']; ?>" aria-expanded="false" class="collapsed">
                                                    <?php echo $notification['title']; ?>
                                                </a>
                                            </h4>
                                            <div class="pull-right">
                                                <?php
                                                if (($this->rbac->hasPrivilege('notice_board', 'can_edit')) || ($notification["created_id"] == $user_id)) { ?>
                                                    <a data-placement="left" href="<?php echo base_url() ?>admin/notification/edit/<?php echo $notification['id'] ?>" class="" data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>" data-original-title="<?php echo $this->lang->line('add'); ?>">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    &nbsp; 
                                                        <?php 
                                                        
                                                } if (($this->rbac->hasPrivilege('notice_board', 'can_delete')) || ($notification["created_id"] == $user_id)) { 
                                                    ?>
                                                    <a data-placement="left" href="<?php echo base_url() ?>admin/notification/delete/<?php echo $notification['id'] ?>" class="" data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" data-original-title="<?php echo $this->lang->line('add'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                        <i class="fa fa-remove"></i>
                                                    </a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div id="collapse<?php echo $notification['id']; ?>" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                            <div class="box-body">
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <?php echo $notification['message']; ?>
                                                    </div><!-- /.col -->
                                                    <div class="col-md-3">
                                                        <div class="box box-solid">
                                                            <div class="box-body no-padding">
                                                                <ul class="nav nav-pills nav-stacked">
                                                                    <li><i class="fa fa-calendar-check-o"></i> <?php echo $this->lang->line('publish_date'); ?> : <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($notification['publish_date'])); ?> </li>
                                                                    <li><i class="fa fa-calendar"></i> <?php echo $this->lang->line('notice_date'); ?> : <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($notification['date'])); ?> </li>
                                                                    <li><i class="fa fa-user"></i> <?php echo $this->lang->line('created_by'); ?> : <span data-toggle="popover" class="detail_popover" data-original-title="" title=""><a href="#" style="display: contents;"><?php echo $notification["created_by"]; ?></a></span><div class="fee_detail_popover" style="display: none"><?php echo $notification["createdby_name"]; ?></div> </li>

                                                                </ul>
                                                                <h4 class="text text-primary"> <?php echo $this->lang->line('message_to'); ?></h4>
                                                                <ul class="nav nav-pills nav-stacked">
                                                                    <?php foreach ($role_name as $key => $role_value) {
                                                                        ?>

                                                                        <li>
                                                                            <i class="fa fa-user" aria-hidden="true"></i>
                                                                            <?php echo $role_value['name']; ?>
                                                                        </li>
                                                                    <?php } ?>
                                                                    <?php if ($notification['visible_student'] == "Yes") { ?>
                                                                        <li><i class="fa fa-user" aria-hidden="true"></i> <?php echo $this->lang->line('student'); ?></li>
                                                                    <?php } ?>
                                                                    <?php if ($notification['visible_parent'] == "Yes") { ?>
                                                                        <li>
                                                                            <i class="fa fa-user" aria-hidden="true"></i>
                                                                            <?php echo $this->lang->line('parent'); ?>
                                                                        </li>
                                                                    <?php } ?>
                                                                    <!--li>
                                                                        <i class="fa fa-user" aria-hidden="true"></i>
                                                                    <?php echo $this->lang->line('teacher'); ?> : <?php echo $notification['visible_teacher']; ?>
                                                                    </li-->
                                                                    <?php ?> 
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>                   
                </div>
            </div>           
        </div>
</div>

</section>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
        $('.date').datepicker({
            format: date_format,
            autoclose: true
        });

        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });

        $('.detail_popover').popover({
            placement: 'right',
            title: '',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('li').find('.fee_detail_popover').html();
            }
        });
    });

</script>
<script>
    $(function () {

        $("#compose-textarea").wysihtml5();
    });
</script>