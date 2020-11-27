<style type="text/css">
    .panel-group .panel {
        border-radius: 0;
        box-shadow: none;
        border-color: #EEEEEE;
    }

    .panel-default > .panel-heading {
        padding: 0;
        border-radius: 0;
        color: #212121;
        background-color: #FAFAFA;
        border-color: #EEEEEE;
    }

    .panel-title {
        font-size: 14px;
    }

    .panel-title > a {
        display: block;
        padding: 15px;
        text-decoration: none;
    }

    .more-less {
        float: right;line-height: 16px;
        color: #212121;
    }

    .panel-default > .panel-heading + .panel-collapse > .panel-body {
        border-top-color: #EEEEEE;
    }


</style>
<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

   

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php
            if ($this->rbac->hasPrivilege('expense', 'can_add')) {
                ?>
                <div class="col-md-4">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('edit')." ".$this->lang->line('custom')." ".$this->lang->line('fields'); ?></h3>
                        </div><!-- /.box-header -->
                        <form id="form1" action="<?php echo current_url() ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                            <div class="box-body">
                                <input type="hidden" name="id" value="<?php echo set_value('id', $cus_field->id); ?>">
                          
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
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('field_belongs_to');?></label> 
                                    <select autofocus="" id="belong_to" name="belong_to" class="form-control" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($custom_field_table as $custom_field_table_key => $custom_field_table_value) {
                                            ?>
                                            <option value="<?php echo $custom_field_table_key; ?>" <?php echo set_select('belong_to', $custom_field_table_key, (set_value('belong_to', $cus_field->belong_to) == $custom_field_table_key ) ? TRUE : FALSE ); ?>><?php echo $custom_field_table_value; ?></option>

                                            <?php
                                            $count++;
                                        }
                                        ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('belong_to'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php  echo $this->lang->line('field').' ' . $this->lang->line('type')?></label> 
                                    <select autofocus="" id="type" name="type" class="form-control" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($custom_fields_list as $custom_fields_list_key => $custom_fields_list_value) {
                                            ?>
                                            <option value="<?php echo $custom_fields_list_key; ?>" <?php echo set_select('type', $custom_fields_list_key, (set_value('type', $cus_field->type) == $custom_fields_list_key ) ? TRUE : FALSE ); ?>><?php echo $custom_fields_list_value; ?></option>

                                            <?php
                                            $count++;
                                        }
                                        ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('type'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('field').' '.$this->lang->line('name') ?></label> <small class="req">*</small>
                                    <input id="name" name="name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('name', $cus_field->name); ?>" />
                                    <span class="text-danger"><?php echo form_error('name'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('grid_boostrap');?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon">col-md-</span>
                                        <input type="number" max="12" class="form-control" name="column" id="column" value="<?php echo set_value('column', $cus_field->bs_column); ?>" aria-invalid="false">
                                    </div>
                                    <span class="text-danger"><?php echo form_error('column'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('field_values_seprate_by_comma'); ?></label>
                                    <textarea class="form-control" name="field_values"><?php echo set_value('field_values', $cus_field->field_values) ?></textarea>
                                    <span class="text-danger"><?php echo form_error('field_values'); ?></span>
                                </div>
                                <div class="form-group"> <!-- Radio group !-->
                                    <label class="control-label"><?php echo $this->lang->line('validation');?></label>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="content_available" name="validation" value="1" <?php echo set_checkbox('validation', '1', (set_value('validation', $cus_field->validation) == 1) ? TRUE : FALSE); ?>>
                                             <?php echo $this->lang->line('required');?>
                                        </label>
                                    </div>



                                </div>
                                <div class="form-group"> <!-- Radio group !-->
                                    <label class="control-label"><?php echo $this->lang->line('visiblility') ?></label>

                                    <div class="checkbox">

                                        <label>
                                            <input type="checkbox" class="content_available" name="display_tbl" value="1" <?php echo set_checkbox('display_tbl', '1', (set_value('display_tbl', $cus_field->visible_on_table) == 1) ? TRUE : FALSE); ?>>
                                          <?php echo $this->lang->line('on')." ".$this->lang->line('table'); ?>
                                        </label>
                                    </div>


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
            if ($this->rbac->hasPrivilege('expense', 'can_add')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('custom')." ".$this->lang->line('fields')." ".$this->lang->line('list');?></h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div id="fade"></div>
                        <div id="modal">
                            <img id="loader" src="<?php echo base_url() ?>/backend/images/loading_blue.gif" />
                        </div>
                        <?php
                        if (!empty($customfields)) {
                            ?>

                            <div id="accordion" class="panel-group">
                                <?php
                                foreach ($custom_field_table as $custom_field_table_key => $custom_field_table_value) {
                                    ?>

                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $custom_field_table_key ?>"><i class="more-less fa fa-plus"></i><?php echo $custom_field_table_value; ?></a>
                                            </h4>
                                        </div>
                                        <div id="collapse<?php echo $custom_field_table_key ?>" class="panel-collapse collapse">
                                            <div class="panel-body">

 
                                                <?php
                                               $records_fields = isset($customfields[$custom_field_table_key]) ? $customfields[$custom_field_table_key] : array();
                                                if (!empty($records_fields)) {
                                                    ?>
                                                    <ul class="sortable-item ui-sortable list-group" data-record_name="<?php echo $custom_field_table_key; ?>">
                                                        <?php
                                                        foreach ($records_fields as $records_fields_key => $records_fields_value) {
                                                            ?>
                                                            <li id="<?php echo $records_fields_value['id']; ?>" class="list-group-item-sort text-left">
                                                                <span class="sort-action">



                                                                    <a href="<?php echo site_url('admin/customfield/edit/' . $records_fields_value['id']); ?>" class="btn btn-xs" data-toggle="tooltip"
                                                                      data-original-title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a>
                                                                    <a href="<?php echo site_url('admin/customfield/delete/' . $records_fields_value['id']); ?>" class="btn btn-xs" data-toggle="tooltip"
                                                                      data-original-title="<?php echo $this->lang->line('delete'); ?>" data-id="1" id="deleteItem"  data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-remove"></i></a>


                                                                </span> <i class="fa fa-arrows"></i> <?php
                                                                echo ($records_fields_value['name']);
                                                                ?>
                                                            </li>
                                                            <?php
                                                        }
                                                        ?>

                                                        </ol>
                                                        <?php
                                                    }else {
                                                        ?>
                                                        <div class="alert alert-danger">
                                                             <?php echo $this->lang->line('no_record_found')?>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>


                            </div>
                            <?php
                        }
                        ?>


                    </div><!-- /.box-body -->
                </div>
            </div><!--/.col (left) -->

        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->




<script type="text/javascript">
    function toggleIcon(e) {
        $(e.target)
                .prev('.panel-heading')
                .find(".more-less")
                .toggleClass('glyphicon-plus glyphicon-minus');
    }
    $('.panel-group').on('hidden.bs.collapse', toggleIcon);
    $('.panel-group').on('shown.bs.collapse', toggleIcon);


    $('.sortable-item').sortable({
        connectWith: '.sortable-item',
        update: function (event, ui) {
            $(this).closest('div.box-body').addClass("sdfdsfs");
            var record_name = $(this).data('record_name');
            var data = $(this).sortable('toArray');
            // data.push({name: 'wordlist', value: 1});
            $.ajax({
                type: "POST",
                url: base_url + "admin/customfield/updateorder",
                data: {"items": data, "belong_to": record_name},
                dataType: "json",

                beforeSend: function () {
                    $('#fade,#modal').css({'display': 'block'});
                },
                success: function (data) {
                    if (data.status) {
                        successMsg(data.msg);
                    } else {
                        errorMsg(data.msg);
                    }
                    $('#fade,#modal').css({'display': 'none'});
                },
                error: function (xhr) { // if error occured
                    alert("Error occured.please try again");
                    $('#fade,#modal').css({'display': 'none'});
                },
                complete: function () {
                    $('#fade,#modal').css({'display': 'none'});
                }
            });
        }
    });


</script>

