<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">   
    <section class="content-header">
        <h1>
            <i class="fa fa-bus"></i> <?php echo $this->lang->line('transport'); ?> <small><?php echo $this->lang->line('student_fees1'); ?></small> </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php if ($this->rbac->hasPrivilege('routes', 'can_add') || $this->rbac->hasPrivilege('routes', 'can_edit')) { ?>
                <div class="col-md-4">              
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('edit_route'); ?></h3>
                        </div>
                        <form id="form1" action="<?php echo site_url('admin/route/edit/' . $id) ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
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
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('route_title'); ?></label><small class="req"> *</small>
                                    <input type="hidden" name="id" value="<?php echo set_value('id', $editroute['id']); ?>" >
                                    <input autofocus="" id="route_title" name="route_title" placeholder="" type="text" class="form-control"  value="<?php echo set_value('route_title', $editroute['route_title']); ?>" />
                                    <span class="text-danger"><?php echo form_error('route_title'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('fare'); ?></label>
                                    <input id="fare" name="fare" placeholder="" type="text" class="form-control"  value="<?php echo set_value('fare', $editroute['fare']); ?>" />
                                    <span class="text-danger"><?php echo form_error('fare'); ?></span>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>
                        </form>
                    </div>
                </div>  
            <?php } ?>        
            <div class="col-md-<?php
            if ($this->rbac->hasPrivilege('routes', 'can_add') || $this->rbac->hasPrivilege('routes', 'can_edit')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">
                <div class="box box-primary" id="route">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('route_list'); ?></h3>

                    </div>
                    <div class="box-body">
                        <div class="mailbox-controls">                         
                            <div class="pull-right">
                            </div>
                        </div>
                        <div class="mailbox-messages">
                            <div class="download_label"><?php echo $this->lang->line('route_list'); ?></div>
                          <div class="table-responsive">  
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('route_title'); ?>
                                        </th>

                                        <th><?php echo $this->lang->line('fare'); ?></th>
                                        <th class="text-right no-print"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($listroute)) {
                                        ?>

                                        <?php
                                    } else {
                                        $count = 1;
                                        foreach ($listroute as $data) {
                                            ?>
                                            <tr>
                                                <td class="mailbox-name"> <?php echo $data['route_title'] ?></td>

                                                <td class="mailbox-name"> <?php echo $currency_symbol . $data['fare']; ?></td>
                                                <td class="mailbox-date pull-right no-print">
        <?php if ($this->rbac->hasPrivilege('routes', 'can_edit')) { ?>
                                                        <a data-placement="left" href="<?php echo base_url(); ?>admin/route/edit/<?php echo $data['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
        <?php } if ($this->rbac->hasPrivilege('routes', 'can_delete')) { ?>
                                                        <a data-placement="left" href="<?php echo base_url(); ?>admin/route/delete/<?php echo $data['id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                            <i class="fa fa-remove"></i>
                                                        </a>
                                            <?php } ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        $count++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                          </div>  
                        </div>
                    </div>
                </div>
            </div> 

        </div>
        <div class="row">          
            <div class="col-md-12"> 

            </div>
        </div>  
    </section>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#postdate').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        });
        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });
    });
</script>