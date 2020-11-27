<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-money"></i> <?php echo $this->lang->line('fees_collection'); ?></h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php if ($this->rbac->hasPrivilege('fees_master', 'can_add') || $this->rbac->hasPrivilege('fees_master', 'can_edit')) { ?>
                <div class="col-md-4">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('edit_fees_master') . " : " . $this->setting_model->getCurrentSessionName(); ?></h3>
                        </div><!-- /.box-header -->
                        <form id="form1" action="<?php echo site_url("admin/feemaster/edit/" . $feegroup_type->id) ?>"  id="feemasterform" name="feemasterform" method="post" accept-charset="utf-8">
                            <div class="box-body">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>

                                <?php echo $this->customlib->getCSRF(); ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="id" value="<?php echo $feegroup_type->id; ?>">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('fees_group'); ?></label><small class="req"> *</small>

                                            <select autofocus="" id="fee_groups_id" name="fee_groups_id" class="form-control" >
                                                <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                <?php
                                                foreach ($feegroupList as $feegroup) {
                                                    ?>
                                                    <option value="<?php echo $feegroup['id'] ?>"<?php
                                                    if (set_value('fee_groups_id', $feegroup_type->fee_groups_id) == $feegroup['id']) {
                                                        echo "selected =selected";
                                                    }
                                                    ?>><?php echo $feegroup['name'] ?></option>

                                                    <?php
                                                    $count++;
                                                }
                                                ?>
                                            </select>
                                            <span class="text-danger"><?php echo form_error('fee_groups_id'); ?></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('fees_type'); ?></label><small class="req"> *</small>

                                            <select  id="feetype_id" name="feetype_id" class="form-control" >
                                                <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                <?php
                                                foreach ($feetypeList as $feetype) {
                                                    ?>
                                                    <option value="<?php echo $feetype['id'] ?>"<?php
                                                    if (set_value('feetype_id', $feegroup_type->feetype_id) == $feetype['id']) {
                                                        echo "selected =selected";
                                                    }
                                                    ?>><?php echo $feetype['type'] ?></option>

                                                    <?php
                                                    $count++;
                                                }
                                                ?>
                                            </select>
                                            <span class="text-danger"><?php echo form_error('feetype_id'); ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('due_date'); ?></label>
                                            <input id="due_date" name="due_date" placeholder="" type="text" class="form-control date"  value="<?php echo set_value('due_date', date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($feegroup_type->due_date))); ?>" readonly="readonly" />
                                            <span class="text-danger"><?php echo form_error('due_date'); ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo $this->lang->line('amount'); ?></label><small class="req">*</small>
                                            <input id="amount" name="amount" placeholder="" type="text" class="form-control"  value="<?php echo set_value('amount', $feegroup_type->amount); ?>" />
                                            <span class="text-danger"><?php echo form_error('amount'); ?></span>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label for="input-type"><?php echo $this->lang->line('fine')." ".$this->lang->line('type');?></label>
                                                <div id="input-type" class="row">
                                                    <div class="col-sm-4">
                                                        <label class="radio-inline">

                                                            <input name="account_type" class="finetype" id="input-type-student" value="none" type="radio" <?php echo set_radio('account_type', 'none', (set_value('none', $feegroup_type->fine_type) == "none") ? TRUE : FALSE); ?>/><?php echo $this->lang->line('none')?>
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class="radio-inline">
                                                            <input name="account_type" class="finetype" id="input-type-student" value="percentage" type="radio" <?php echo set_radio('account_type', 'percentage', (set_value('percentage', $feegroup_type->fine_type) == "percentage") ? TRUE : FALSE ); ?> /><?php echo $this->lang->line('percentage')?>
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class="radio-inline">
                                                            <input name="account_type" class="finetype" id="input-type-tutor" value="fix" type="radio"  <?php echo set_radio('account_type', 'fix', (set_value('fix', $feegroup_type->fine_type) == "fix") ? TRUE : FALSE); ?> /><?php echo $this->lang->line('fix')." ".$this->lang->line('amount')?>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('percentage')?></label><small class="req"> *</small>
                                                    <input id="fine_percentage" name="fine_percentage" placeholder="" type="text" class="form-control"  value="<?php echo set_value('fine_percentage', $feegroup_type->fine_percentage); ?>" />
                                                    <span class="text-danger"><?php echo form_error('fine_percentage'); ?></span>
                                                </div>    
                                            </div>
                                            <div class="col-md-6">
                                              <div class="form-group">  
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('fine')." ".$this->lang->line('amount')?></label><small class="req"> *</small>
                                                <input id="fine_amount" name="fine_amount" placeholder="" type="text" class="form-control"  value="<?php echo set_value('fine_amount', $feegroup_type->fine_amount); ?>" />
                                                <span class="text-danger"><?php echo form_error('fine_amount'); ?></span>
                                              </div>  
                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </div>

                    
                    
                      <div class="box-footer">

                        <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                    </div>
                    
                    
                    
                    </div><!-- /.box-body -->

                  
                    </form>
                </div>
       <div class="col-md-<?php
        if ($this->rbac->hasPrivilege('fees_master', 'can_add') || $this->rbac->hasPrivilege('fees_master', 'can_edit')) {
            echo "8";
        } else {
            echo "12";
        }
        ?>">
            <!-- Horizontal Form -->
            <div class="box box-primary">
                <div class="box-header ptbnull">
                    <h3 class="box-title titlefix"><?php echo $this->lang->line('fees_master_list') . " : " . $this->setting_model->getCurrentSessionName(); ?></h3>

                </div><!-- /.box-header -->

                <div class="box-body">
                    <div class="download_label"><?php echo $this->lang->line('fees_master_list') . " : " . $this->setting_model->getCurrentSessionName(); ?></div>
                    <div class="mailbox-messages">
                      <div class="table-responsive">  
                        <table class="table table-striped table-bordered table-hover example">
                            <thead>
                                <tr>
                                    <th><?php echo $this->lang->line('fees_group'); ?></th>
                                    <th><?php echo $this->lang->line('fees_code'); ?></th>

                                    <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($feemasterList as $feegroup) {
                                    ?>
                                    <tr>
                                        <td class="mailbox-name">
                                            <a href="#" data-toggle="popover" class="detail_popover"><?php echo $feegroup->group_name; ?></a>


                                        </td>


                                        <td class="mailbox-name">
                                            <ul class="liststyle1">
                                                <?php
                                                foreach ($feegroup->feetypes as $feetype_key => $feetype_value) {
                                                    ?>
                                                    <li> <i class="fa fa-money"></i>  
                                                        <?php echo $feetype_value->code . " " . $currency_symbol . $feetype_value->amount; ?> &nbsp;&nbsp;
                                                        <?php if ($this->rbac->hasPrivilege('fees_master', 'can_edit')) { ?>
                                                            <a data-placement="left" href="<?php echo base_url(); ?>admin/feemaster/edit/<?php echo $feetype_value->id ?>"   data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>&nbsp;
                                                            <?php
                                                        }
                                                        if ($this->rbac->hasPrivilege('fees_master', 'can_delete')) {
                                                            ?>
                                                            <a data-placement="left" href="<?php echo base_url(); ?>admin/feemaster/delete/<?php echo $feetype_value->id ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                                <i class="fa fa-remove"></i>
                                                            </a>
                                                        <?php } ?>

                                                    </li>

                                                    <?php
                                                }
                                                ?>
                                            </ul>
                                        </td>

                                        <td class="mailbox-date pull-right">
                                            <?php if ($this->rbac->hasPrivilege('fees_group_assign', 'can_view')) { ?>
                                                <a href="<?php echo base_url(); ?>admin/feemaster/assign/<?php echo $feegroup->id ?>" 
                                                   class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line('assign / view'); ?>">
                                                    <i class="fa fa-tag"></i>
                                                </a>
                                            <?php } ?>
                                            <?php if ($this->rbac->hasPrivilege('fees_master', 'can_delete')) { ?>
                                                <a href="<?php echo base_url(); ?>admin/feemaster/deletegrp/<?php echo $feegroup->id ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                    <i class="fa fa-remove"></i>
                                                </a>
                                            <?php } ?>

                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>

                            </tbody>
                        </table><!-- /.table -->
                      </div>  
                    </div><!-- /.mail-box-messages -->
                </div><!-- /.box-body -->


                </form>
            </div>

        </div><!--/.col (right) -->
            </div><!--/.col (right) -->
            <!-- left column -->
        <?php } ?>
 
        <!-- left column -->


</div>





<script type="text/javascript">
    $(document).ready(function () {

        var account_type = "<?php echo set_value('account_type', $feegroup_type->fine_type); ?>";
        load_disable(account_type);

       
    });

    $(document).on('change', '.finetype', function () {
        calculatefine();
    });


    $(document).on('keyup', '#amount,#fine_percentage', function () {
        calculatefine();
    });

    function load_disable(account_type) {
        if (account_type === "percentage") {
            $('#fine_amount').prop('readonly', true);
            $('#fine_percentage').prop('readonly', false);
        } else if (account_type === "fix") {
            $('#fine_amount').prop('readonly', false);
            $('#fine_percentage').prop('readonly', true);
        } else {
            $('#fine_amount').prop('readonly', true);
            $('#fine_percentage').prop('readonly', true);
        }
    }


    function calculatefine() {
        var amount = $('#amount').val();
        var fine_percentage = $('#fine_percentage').val();
        var finetype = $('input[name=account_type]:checked', '#form1').val();
        if (finetype === "percentage") {
            fine_amount = ((amount * fine_percentage) / 100).toFixed(2);
            $('#fine_amount').val(fine_amount).prop('readonly', true);
            $('#fine_percentage').prop('readonly', false);
        } else if (finetype === "fix") {
            $('#fine_amount').val("").prop('readonly', false);
            $('#fine_percentage').val("").prop('readonly', true);
        } else {
            $('#fine_amount').val("");
        }
    }

</script>


