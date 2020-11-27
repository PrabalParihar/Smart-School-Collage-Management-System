<style type="text/css">
    @media print
    {
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
</style>

<div class="content-wrapper" style="min-height: 946px;">  
    <section class="content-header">
        <h1><i class="fa fa-sitemap"></i> <?php echo $this->lang->line('human_resource'); ?></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">   

            <?php if (($this->rbac->hasPrivilege('leave_types', 'can_add'))) { ?>
                <div class="col-md-4">    
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $title; ?></h3>
                        </div> 
                        <form id="form1" action="<?php echo site_url('admin/leavetypes/createLeaveType') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8"  enctype="multipart/form-data">
                            <div class="box-body">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>        
                                <?php echo $this->customlib->getCSRF(); ?>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('name'); ?></label><small class="req"> *</small>
                                    <input autofocus="" id="type"  name="type" placeholder="" type="text" class="form-control"  value="<?php
                                    if (isset($result)) {
                                        echo $result["type"];
                                    }
                                    ?>" />
                                    <span class="text-danger"><?php echo form_error('type'); ?></span>

                                    <input autofocus="" id="type"  name="leavetypeid" placeholder="" type="hidden" class="form-control"  value="<?php
                                    if (isset($result)) {
                                        echo $result["id"];
                                    }
                                    ?>" />
                                </div>
                                <!--div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('active'); ?> <?php echo $this->lang->line('status'); ?></label>
                                <br/>
                                <label class="radio-inline">
                                     <input type="radio" checked value="yes" <?php
                            if ((isset($result)) && ($result["is_active"] == "yes")) {
                                echo "checked";
                            }
                                    ?> name="status"><?php echo $this->lang->line('yes'); ?>
                                 </label>
                                <label class="radio-inline">
                                <input type="radio" value="no" <?php
                            if ((isset($result)) && ($result["is_active"] == "no")) {
                                echo "checked";
                            }
                            ?> name="status"><?php echo $this->lang->line('no'); ?>
                            </label>
                              </div-->

                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>
                        </form>
                    </div>   
                </div>  
<?php } ?>
            <div class="col-md-<?php
if ($this->rbac->hasPrivilege('leave_types', 'can_add')) {
    echo "8";
} else {
    echo "12";
}
?>">              
                <div class="box box-primary" id="tachelist">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('leave_type'); ?> <?php echo $this->lang->line('list'); ?></h3>
                    </div>
                    <div class="box-body">
                        <div class="mailbox-controls">
                        </div>
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label"><?php echo $this->lang->line('leave_type')." ".$this->lang->line('list'); ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>

                                        <th><?php echo $this->lang->line('name'); ?></th>
                                     <!--    <th><?php echo $this->lang->line('active'); ?> <?php echo $this->lang->line('status'); ?></th>
                                        -->   <th class="text-right no-print"><?php echo $this->lang->line('action'); ?>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($leavetype as $value) {
                                        $status = "";

                                        if ($value["is_active"] == "yes") {

                                            $status = "Active";
                                        } else {
                                            $status = "Inactive";
                                        }
                                        ?>
                                        <tr>

                                            <td class="mailbox-name"> <?php echo $value['type'] ?></td>
                                     <!--        <td><?php echo $this->lang->line($value['is_active']) ?></td>
                                            -->       <td class="mailbox-date pull-right no-print">
                                        <?php if ($this->rbac->hasPrivilege('leave_types', 'can_edit')) { ?>
                                                    <a data-placement="left" href="<?php echo base_url(); ?>admin/leavetypes/leaveedit/<?php echo $value['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                        <?php } if ($this->rbac->hasPrivilege('leave_types', 'can_delete')) { ?>
                                                    <a data-placement="left" href="<?php echo base_url(); ?>admin/leavetypes/leavedelete/<?php echo $value['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>')";>
                                                        <i class="fa fa-remove"></i>
                                                    </a>
    <?php } ?>
                                            </td>
                                        </tr>
    <?php
}
$count++;
?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="">
                        <div class="mailbox-controls">
                        </div>
                    </div>
                </div>
            </div> 

        </div>
    </section>
</div>

