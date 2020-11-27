<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php
            if ($this->rbac->hasPrivilege('exam_group', 'can_add')) {
                ?>
                <div class="col-md-4">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"> <?php echo $this->lang->line('add')." ".$this->lang->line('exam')." ".$this->lang->line('group'); ?></h3>
                        </div><!-- /.box-header -->
                        <form id="form1" action="<?php echo site_url('admin/examgroup') ?>"  id="examgroupform" name="examgroupform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                            <div class="box-body">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>
                                <?php
                                if (isset($error_message)) {
                                    echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                                }
                                ?>
                                <?php echo $this->customlib->getCSRF(); ?>
                            

                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('name'); ?><small class="req">*</small></label> 
                                    <input id="name" autofocus="" name="name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('name'); ?>" />
                                    <span class="text-danger"><?php echo form_error('name'); ?></span>
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo $this->lang->line('exam')." ".$this->lang->line('type')?></label> <small class="req">*</small>
                                    <select id="name" name="exam_type" placeholder="" type="text" class="form-control">
   <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php 
foreach ($examType as $examType_key => $examType_value) {
 ?>
    <option value="<?php echo $examType_key; ?>"><?php echo $examType_value; ?></option>
 <?php
}

                                         ?>
                                    </select>
                                  
                                    <span class="text-danger"><?php echo form_error('exam_type'); ?></span>
                                </div>

                        

                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>
                                    <textarea class="form-control" id="description" name="description" placeholder="" rows="3"><?php echo set_value('description'); ?></textarea>
                                    <span class="text-danger"></span>
                                </div>
                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>
                        </form>
                    </div>

                </div><!--/.col (right) -->
                <!-- left column -->
            <?php } ?>
            <div class="col-md-<?php
            if ($this->rbac->hasPrivilege('exam_group', 'can_add')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"> <?php echo $this->lang->line('exam')." ".$this->lang->line('group')." ".$this->lang->line('list')?></h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="mailbox-messages table-responsive">
                            <div class="download_label"> <?php echo $this->lang->line('exam')." ".$this->lang->line('group')." ".$this->lang->line('list')?></div>
                            <table class="table table-hover table-striped table-bordered example">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('name'); ?></th>
                                        <th><?php echo $this->lang->line('no')." ".$this->lang->line('of')." ".$this->lang->line('exams'); ?></th>
                                        <th><?php echo $this->lang->line('exam')." ".$this->lang->line('type'); ?></th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (empty($examgrouplist)) {
                                        ?>

                                        <?php
                                    } else {
                                        foreach ($examgrouplist as $examgroup) {

                                            ?>
                                            <tr>
                                                <td class="mailbox-name">
                                                   <a href="#" data-toggle="popover" class="detail_popover"><?php echo $examgroup->name; ?></a>

                                                    <div class="fee_detail_popover" style="display: none">
                                                        <?php
                                                        if ($examgroup->description == "") {
                                                            ?>
                                                            <p class="text text-danger"><?php echo $this->lang->line('no_description'); ?></p>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <p class="text text-info"><?php echo $examgroup->description; ?></p>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                 
                                                </td>
                                                    <td class="mailbox-name">
                                             <?php echo $examgroup->counter; ?>
                                                 
                                                </td>
   <td class="mailbox-name">
                                             <?php echo $examType[$examgroup->exam_type]; ?>
                                                 
                                                </td>
   

                                                <td class="mailbox-date pull-right">
                                                    <?php 
                                              
                                if ($this->rbac->hasPrivilege('exam', 'can_view')) { ?>
                                                <a href="<?php echo base_url(); ?>admin/examgroup/addexam/<?php echo $examgroup->id ?>"
                                                   class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line('add')." ".$this->lang->line('exam')?>">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            <?php } 

                                         
                                                    if ($this->rbac->hasPrivilege('exam_group', 'can_edit')) {
                                                        ?>
                                                        <a data-placement="left" href="<?php echo site_url('admin/examgroup/edit/'.$examgroup->id); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <?php
                                                    }
                                                    if ($this->rbac->hasPrivilege('exam_group', 'can_delete')) {
                                                        ?>
                                                        <a data-placement="left" href="<?php echo site_url('admin/examgroup/delete/'.$examgroup->id); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                            <i class="fa fa-remove"></i>
                                                        </a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>

                                </tbody>
                            </table><!-- /.table -->



                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                </div>
            </div><!--/.col (left) -->

        </div>
       
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">
    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';

 
        $('.detail_popover').popover({
            placement: 'right',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });
    });
</script>