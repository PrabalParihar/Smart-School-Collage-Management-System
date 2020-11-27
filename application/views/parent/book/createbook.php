<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-book"></i> <?php echo $this->lang->line('library_book'); ?></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                         <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"> <?php echo $this->lang->line('library_book'); ?></h3>
                         </div><!-- /.box-header -->
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label"><?php echo $this->lang->line('library_book'); ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('book_title'); ?>
                                        <th><?php echo $this->lang->line('publisher'); ?>
                                        </th>
                                        <th><?php echo $this->lang->line('author'); ?>
                                        </th>
                                        <th><?php echo $this->lang->line('subject'); ?></th>
                                        <th><?php echo $this->lang->line('rack_no'); ?></th>
                                        <th><?php echo $this->lang->line('qty'); ?></th>
                                        <th><?php echo $this->lang->line('bookprice'); ?></th>
                                        <th class="text-right"><?php echo $this->lang->line('postdate'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($listbook)) {
                                        ?>
                                        <tr>
                                            <td colspan="12" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?></td>
                                        </tr>
                                        <?php
                                    } else {
                                        $count = 1;
                                        foreach ($listbook as $book) {
                                            ?>
                                            <tr>
                                                <td class="mailbox-name">
                                                    <a href="#" data-toggle="popover" class="detail_popover"><?php echo $book['book_title'] ?></a>
                                                    <div class="fee_detail_popover" style="display: none">
                                                        <?php
                                                        if ($book['description'] == "") {
                                                            ?>
                                                            <p class="text text-danger"><?php echo $this->lang->line('no_description'); ?></p>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <p class="text text-info"><?php echo $book['description']; ?></p>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </td>
                                                <td class="mailbox-name"> <?php echo $book['publish'] ?></td>
                                                <td class="mailbox-name"> <?php echo $book['author'] ?></td>
                                                <td class="mailbox-name"> <?php echo $book['subject'] ?></td>
                                                <td class="mailbox-name"> <?php echo $book['rack_no'] ?></td>
                                                <td class="mailbox-name"> <?php echo $book['qty'] ?></td>
                                                <td class="mailbox-name"> <?php echo ($currency_symbol . $book['perunitcost']); ?></td>
                                                <td class="mailbox-name text-right"> <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($book['postdate'])); ?></td>
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
                    <div class="box-footer">
                        <div class="mailbox-controls">
                            <div class="pull-right">
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