
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-object-group"></i> <?php echo $this->lang->line('inventory'); ?>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $this->lang->line('issue_item'); ?></h3>
                        <div class="box-tools pull-right">
                            <?php if($this->rbac->hasPrivilege('issue_item','can_add')){
                                ?>
                                 <a href="<?php echo site_url('admin/issueitem/create') ?>" type="button" class="btn btn-primary btn-sm" ><i class="fa fa-plus"></i> <?php echo $this->lang->line('issue_item'); ?></a>
                                <?php
                            }?>
                           
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="mailbox-messages table-responsive">
                            <div class="download_label"><?php echo $this->lang->line('issue_item'); ?></div>
                            <table class="table table-hover table-striped table-bordered example">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('item'); ?></th>
                                        <th><?php echo $this->lang->line('item_category'); ?></th>
                                        <th><?php echo $this->lang->line('issue') . " - " . $this->lang->line('return'); ?></th>
                                        <th><?php echo $this->lang->line('issue_to'); ?></th>
                                        <th><?php echo $this->lang->line('issued_by'); ?></th>
                                        <th><?php echo $this->lang->line('quantity'); ?></th>
                                        <th><?php echo $this->lang->line('status'); ?></th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                   //echo "<pre>"; print_r($itemissueList); echo "<pre>";die;

                                    if (empty($itemissueList)) {
                                        ?>

                                        <?php
                                    } else {
                                        foreach ($itemissueList as $item) {
                                            ?>
                                            <tr>
                                                <td class="mailbox-name">
                                                    <a href="#" data-toggle="popover" class="detail_popover"><?php echo $item['item_name'] ?></a>

                                                    <div class="fee_detail_popover" style="display: none">
                                                        <?php
                                                        if ($item['note'] == "") {
                                                            ?>
                                                            <p class="text text-danger"><?php echo $this->lang->line('no_description'); ?></p>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <p class="text text-info"><?php echo $item['note']; ?></p>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </td>
                                                <td class="mailbox-name">
                                                    <?php echo $item['item_category']; ?>
                                                </td>


                                                <td class="mailbox-name">
                                                    <?php
                                                    if ($item['return_date'] == "0000-00-00") {
                                                        $return_date = "";
                                                    } else {
                                                        $return_date = date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($item['return_date']));
                                                    }
                                                    echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($item['issue_date'])) . " - " . $return_date;
                                                    ?>
                                                </td>
                                                <td class="mailbox-name">
                                                    <?php echo $item['staff_name'] . " " . $item['surname'] . " (" . $item['employee_id'] . ")";
                                                    ;
                                                    ?>
                                                </td>
                                                <td class="mailbox-name"><?php echo $item['issue_by']; ?></td>
                                                <td class="mailbox-name"><?php echo $item['quantity']; ?></td>
                                                <td class="mailbox-name"><?php
                                                    if ($item['is_returned'] == 1) {
                                                        ?>


                                                        <span class="label label-danger item_remove" data-item="<?php echo $item['id'] ?>" data-category="<?php echo $item['item_category'] ?>" data-item_name="<?php echo $item['item_name'] ?>" data-quantity="<?php echo $item['quantity'] ?>" data-toggle="modal" data-target="#confirm-delete"><?php echo $this->lang->line('click_to_return'); ?></span>

                                                        <?php
                                                    } else {
                                                        ?>

                                                        <span class="label label-success"><?php echo $this->lang->line('returned'); ?></span>

                                                        <?php
                                                    }
                                                    ?></td>

                                                <td class="mailbox-date pull-right">

                                                    <?php if($this->rbac->hasPrivilege('issue_item','can_delete')){
                                                        ?><a data-placement="left" href="<?php echo base_url(); ?>admin/issueitem/delete/<?php echo $item['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                        <i class="fa fa-remove"></i>
                                                    </a>
                                                        <?php
                                                    }?>
                                                    
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
            </div><!--/.col (right) -->
        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

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

<script type="text/javascript">

    $(document).ready(function () {
        $('#confirm-delete').on('show.bs.modal', function (e) {
            $('#item_issue_id').val("");
            $('.debug-url').html('');
            $('#modal_item_quantity,#modal_item,#modal_item_cat').text("");
            var item_issue_id = $(e.relatedTarget).data('item');
            var item_category = $(e.relatedTarget).data('category');
            var quantity = $(e.relatedTarget).data('quantity');
            var item_name = $(e.relatedTarget).data('item_name');
            $('#item_issue_id').val(item_issue_id);
            $('#modal_item_cat').text(item_category);
            $('#modal_item').text(item_name);
            $('#modal_item_quantity').text(quantity);

        });
        $("#confirm-delete").modal({
            backdrop: false,
            show: false

        });
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';


        $('.date').datepicker({
            format: date_format,
            autoclose: true
        });



    });



    var base_url = '<?php echo base_url() ?>';

    $(document).on('change', '#item_category_id', function (e) {
        $('#item_id').html("");
        var item_category_id = $(this).val();
        populateItem(0, item_category_id);
    });


    $(document).on('click', '.btn-ok', function () {
        var $this = $('.btn-ok');
        $this.button('loading');
        var item_issue_id = $('#item_issue_id').val();
        $.ajax(
                {
                    url: "<?php echo site_url('admin/issueitem/returnItem') ?>",
                    type: "POST",
                    data: {'item_issue_id': item_issue_id},
                    dataType: 'Json',
                    success: function (data, textStatus, jqXHR)
                    {
                        if (data.status == "fail") {

                            errorMsg(data.message);
                        } else {
                            successMsg(data.message);
                            //  $("span[data-item='" + item_issue_id + "']").removeClass("label-danger").addClass("label-success").text("Returned");

                            $("#confirm-delete").modal('hide');
                            location.reload();
                        }

                        $this.button('reset');
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        $this.button('reset');
                    }
                });

    });


</script>




<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('confirm_return'); ?></h4>
            </div>

            <div class="modal-body">
                <input type="hidden" id="item_issue_id" name="item_issue_id" value="">
                <p>Are you sure to return this item !</p>

                <ul class="list2">
                    <li><?php echo $this->lang->line('item'); ?><span id="modal_item"></span></li>
                    <li><?php echo $this->lang->line('item_category'); ?><span id="modal_item_cat"></span></li>
                    <li><?php echo $this->lang->line('quantity'); ?><span id="modal_item_quantity"></span></li>
                </ul>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
                <a class="btn cfees btn-ok" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please Wait.."><?php echo $this->lang->line('return'); ?></a>
            </div>
        </div>
    </div>
</div>

