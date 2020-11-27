<link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script src="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-envelope"></i> <?php echo $this->lang->line('notice_board'); ?></small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border">                    
                        <div class="box-tools pull-right">
                        </div>
                    </div>                    
                    <div class="box-body">
                        <div class="box-group" id="accordion">                          
                            <?php if (empty($notificationlist)) {
                                ?>
                                <div class="alert alert-info"><?php echo $this->lang->line('no_record_found'); ?></div>
                                <?php
                            } else {
                                foreach ($notificationlist as $key => $notification) {
                                    ?>
                                    <div class="panel box box-primary">
                                        <div class="box-header with-border">
                                            <h4 class="box-title">
                                                <a data-toggle="collapse" class="notification_msg text-aqua" data-msgid="<?php echo $notification['id']; ?>" data-parent="#accordion" href="#collapse<?php echo $notification['id']; ?>" aria-expanded="false" class="collapsed">
                                                    <?php echo $notification['title']; ?>&nbsp;
                                                    <?php
                                                    if ($notification['notification_id'] == "read") {
                                                        ?>
                                                        <img src="<?php echo base_url() ?>/backend/images/read_one.png">
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <img src="<?php echo base_url() ?>backend/images/unread_two.png">
                                                        <?php
                                                    }
                                                    ?>
                                                </a>
                                            </h4>
                                            <div class="pull-right">
                                                <i class="fa fa-calendar"></i> <?php echo $this->lang->line('date'); ?> : <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($notification['date'])) ?>
                                            </div>
                                        </div>
                                        <div id="collapse<?php echo $notification['id']; ?>" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                            <div class="box-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <?php echo $notification['message']; ?>
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

<script>
    $(document).on('click', '.notification_msg', function () {
        var base_url = '<?php echo base_url() ?>';
        var notification_id = $(this).data('msgid');
        $.ajax({
            type: "POST",
            url: base_url + "parent/notification/updatestatus",
            data: {'notification_id': notification_id},
            dataType: "json",
            success: function (data) {
            }
        });
    });
</script>