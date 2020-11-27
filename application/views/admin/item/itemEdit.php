<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <i class="fa fa-object-group"></i> <?php echo $this->lang->line('inventory'); ?></h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php if ($this->rbac->hasPrivilege('item', 'can_add') || $this->rbac->hasPrivilege('item', 'can_edit')) { ?> 
                <div class="col-md-4">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('edit_item'); ?></h3>
                        </div><!-- /.box-header -->
                        <form id="form1" action="<?php echo site_url('admin/item/edit/' . $id) ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" >
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
                                <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('name'); ?></label><small class="req"> *</small>
                                    <input autofocus="" id="name" name="name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('name', $item['name']); ?>" />
                                    <span class="text-danger"><?php echo form_error('name'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('item_category'); ?></label><small class="req"> *</small>

                                    <select  id="item_category_id" name="item_category_id" class="form-control" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($itemcatlist as $item_category) {
                                            ?>
                                            <option value="<?php echo $item_category['id'] ?>"<?php
                                            if (set_value('item_category_id', $item['item_category_id']) == $item_category['id']) {
                                                echo "selected = selected";
                                            }
                                            ?>><?php echo $item_category['item_category'] ?></option>

                                            <?php
                                            $count++;
                                        }
                                        ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('item_category_id'); ?></span>
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('unit'); ?></label><small class="req"> *</small>
                                    <input autofocus="" id="unit" name="unit" placeholder="" type="text" class="form-control"  value="<?php echo set_value('unit', $item['unit']); ?>" />
                                    <span class="text-danger"><?php echo form_error('unit'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>
                                    <textarea class="form-control" id="description" name="description" placeholder="" rows="3" placeholder="Enter ..."><?php echo set_value('description', $item['description']); ?></textarea>
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
            if ($this->rbac->hasPrivilege('item', 'can_add') || $this->rbac->hasPrivilege('item', 'can_edit')) {
                echo "8";
            } else {
                echo "12";
            }
            ?> ">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"> <?php echo $this->lang->line('item_list'); ?></h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="mailbox-messages table-responsive">
                            <div class="download_label"><?php echo $this->lang->line('item_list'); ?></div>
                            <table class="table table-hover table-striped table-bordered example">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('item'); ?></th>                                 
                                        <th><?php echo $this->lang->line('category'); ?>
                                        </th>
                                        <th><?php echo $this->lang->line('unit'); ?>
                                        </th>
                                        <th><?php echo $this->lang->line('available_quantity'); ?>
                                        </th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (empty($itemlist)) {
                                        ?>

                                        <?php
                                    } else {
                                        foreach ($itemlist as $items) {
                                            ?>
                                            <tr>
                                                <td class="mailbox-name">
                                                    <a href="#" data-toggle="popover" class="detail_popover"><?php echo $items['name'] ?></a>

                                                    <div class="fee_detail_popover" style="display: none">
                                                        <?php
                                                        if ($items['description'] == "") {
                                                            ?>
                                                            <p class="text text-danger"><?php echo $this->lang->line('no_description'); ?></p>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <p class="text text-info"><?php echo $items['description']; ?></p>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </td>


                                                <td class="mailbox-name">
                                                    <?php echo $items['item_category']; ?>

                                                </td>
                                                <td class="mailbox-name">
                                                     <?php echo $items['unit']; ?>

                                                </td>
                                                <td class="mailbox-name">
                                                    <?php
                                                    echo $items['added_stock'] - $items['issued'];
                                                    ;
                                                    ?>

                                                </td>




                                                <td class="mailbox-date pull-right">
        <?php if ($this->rbac->hasPrivilege('item', 'can_edit')) { ?> 
                                                        <a data-placement="left" href="<?php echo base_url(); ?>admin/item/edit/<?php echo $items['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
        <?php }if ($this->rbac->hasPrivilege('item', 'can_delete')) { ?>  
                                                        <a data-placement="left" href="<?php echo base_url(); ?>admin/item/delete/<?php echo $items['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
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
                                            <!-- right column -->

                                            </div>
                                            <div class="row">
                                            <!-- left column -->

                                            <!-- right column -->
                                            <div class="col-md-12">

                                            </div><!--/.col (right) -->
                                            </div>   <!-- /.row -->
                                            </section><!-- /.content -->
                                            </div><!-- /.content-wrapper -->

                                            <script type="text/javascript">
                                            $(document).ready(function () {
                                            var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';

                                            $('#date').datepicker({
                                            //  format: "dd-mm-yyyy",
                                            format: date_format,
                                            autoclose: true
                                            });

                                            $("#btnreset").click(function () {
                                            $("#form1")[0].reset();
                                            });

                                            });
                                            </script>
                                            <script>
                                            $(document).ready(function () {
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