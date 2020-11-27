<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<style type="text/css">
    /*REQUIRED*/
    .carousel-row {
        margin-bottom: 10px;
    }
    .slide-row {
        padding: 0;
        background-color: #ffffff;
        min-height: 150px;
        border: 1px solid #e7e7e7;
        overflow: hidden;
        height: auto;
        position: relative;
    }
    .slide-carousel {
        width: 20%;
        float: left;
        display: inline-block;
    }
    .slide-carousel .carousel-indicators {
        margin-bottom: 0;
        bottom: 0;
        background: rgba(0, 0, 0, .5);
    }
    .slide-carousel .carousel-indicators li {
        border-radius: 0;
        width: 20px;
        height: 6px;
    }
    .slide-carousel .carousel-indicators .active {
        margin: 1px;
    }
    .slide-content {
        position: absolute;
        top: 0;
        left: 20%;
        display: block;
        float: left;
        width: 80%;
        max-height: 76%;
        padding: 1.5% 2% 2% 2%;
        overflow-y: auto;
    }
    .slide-content h4 {
        margin-bottom: 3px;
        margin-top: 0;
    }
    .slide-footer {
        position: absolute;
        bottom: 0;
        left: 20%;
        width: 78%;
        height: 20%;
        margin: 1%;
    }
    /* Scrollbars */
    .slide-content::-webkit-scrollbar {
        width: 5px;
    }
    .slide-content::-webkit-scrollbar-thumb:vertical {
        margin: 5px;
        background-color: #999;
        -webkit-border-radius: 5px;
    }
    .slide-content::-webkit-scrollbar-button:start:decrement,
    .slide-content::-webkit-scrollbar-button:end:increment {
        height: 5px;
        display: block;
    }
</style>

<div class="content-wrapper" style="min-height: 946px;">

    <section class="content-header">
        <h1>
            <i class="fa fa-bus"></i> <?php echo $this->lang->line('transport'); ?></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <?php $this->load->view('reports/_library')?>
        <div class="row">
            <div class="col-md-12">
                <div class="box removeboxmius">
                    <div class="box-header ptbnull"></div>
                      <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>

                     <form role="form" action="<?php echo site_url('report/bookinventory') ?>" method="post" class="">
                        <div class="box-body row">

                            <?php echo $this->customlib->getCSRF(); ?>

                             <div class="col-sm-6 col-md-3" >
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('search') . " " . $this->lang->line('type'); ?></label>
                                    <select class="form-control" name="search_type" onchange="showdate(this.value)">
                                       
                                        <?php foreach ($searchlist as $key => $search) {
                                            ?>
                                            <option value="<?php echo $key ?>" <?php
                                            if ((isset($search_type)) && ($search_type == $key)) {

                                                echo "selected";

                                                }
                                            ?>><?php echo $search ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('search_type'); ?></span>
                                </div>
                            </div>
                               
                            <div id='date_result'>
                                
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                </div>
                            </div>
                       </div>     
                    </form>
              

            <div class="">
              <div class="box-header ptbnull"></div>  
                <div class="box-header ptbnull">
                    <h3 class="box-title titlefix"><i class="fa fa-money"></i> <?php echo $this->lang->line('book')." ".$this->lang->line('inventory')." ".$this->lang->line('report'); ?></h3>
                </div>
                <div class="box-body table-responsive">
                 <div class="download_label"> <?php echo $this->lang->line('book')." ".$this->lang->line('inventory')." ".$this->lang->line('report')."<br>";$this->customlib->get_postmessage(); ?> </div>
                    <table class="table table-striped table-bordered table-hover example">
                       <thead>
                                        <tr>
                                        <th><?php echo $this->lang->line('book_title'); ?></th>
                                        <th><?php echo $this->lang->line('book_no'); ?></th>
                                        <th><?php echo $this->lang->line('isbn_no'); ?></th>
                                        <th><?php echo $this->lang->line('publisher'); ?>
                                        </th>
                                        <th><?php echo $this->lang->line('author'); ?>
                                        </th>
                                        <th><?php echo $this->lang->line('subject'); ?></th>
                                        <th><?php echo $this->lang->line('rack_no'); ?></th>
                                        <th><?php echo $this->lang->line('qty'); ?></th>
                                        <th><?php echo $this->lang->line('available'); ?></th>
                                        <th><?php echo $this->lang->line('issued'); ?></th>
                                        <th><?php echo $this->lang->line('bookprice'); ?></th>
                                        <th><?php echo $this->lang->line('postdate'); ?></th>
                                        <th class="no-print text text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                    </thead>
                           <tbody>
                                      <?php
                                    $count = 1;
                                    if(!empty($listbook)){
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
                                            <td class="mailbox-name"> <?php echo $book['book_no'] ?></td>
                                            <td class="mailbox-name"> <?php echo $book['isbn_no'] ?></td>
                                            <td class="mailbox-name"> <?php echo $book['publish'] ?></td>
                                            <td class="mailbox-name"> <?php echo $book['author'] ?></td>
                                            <td class="mailbox-name"><?php echo $book['subject'] ?></td>
                                            <td class="mailbox-name"><?php echo $book['rack_no'] ?></td>
                                            <td class="mailbox-name"> <?php echo $book['qty'] ?></td>
                                            <td class="mailbox-name"> <?php echo $book['qty']-$book['total_issue']; ?></td>
                                            <td class="mailbox-name"> <?php echo $book['qty']-($book['qty']-$book['total_issue']); ?></td>
                                            <td class="mailbox-name"> <?php echo ($currency_symbol . $book['perunitcost']); ?></td>
                                            <td class="mailbox-name"> <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($book['postdate'])); ?></td>
                                            <td class="mailbox-date no-print text text-right">
                                                <?php if ($this->rbac->hasPrivilege('books', 'can_edit')) { ?> 
                                                    <a href="<?php echo base_url(); ?>admin/book/edit/<?php echo $book['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                <?php }if ($this->rbac->hasPrivilege('books', 'can_delete')) { ?> 
                                                    <a href="<?php echo base_url(); ?>admin/book/delete/<?php echo $book['id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                        <i class="fa fa-remove"></i>
                                                    </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php
                                        $count++;
                                    }}
                                    ?>
                                    </tbody>
                    </table>
                </div>
            </div>
          </div>
         </div> 
        </div>   
</div>  
</section>
</div>
<script>
    <?php 
    if($search_type=='period'){
        ?>

          $(document).ready(function () {
            showdate('period');
          });

        <?php
    }
    ?>
   
    </script>