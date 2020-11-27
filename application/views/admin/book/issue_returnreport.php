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
        <h1>
            <i class="fa fa-book"></i> <?php echo $this->lang->line('library'); ?></h1>
    </section>
    <!-- Main content -->
    <section class="content">
         <?php $this->load->view('reports/_library');?>
        <div class="row">       

            <div class="col-md-12">              
                <div class="box removeboxmius">
                    <div class="box-header ptbnull"></div>
                      <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('book')." ".$this->lang->line('issue_return')." ".$this->lang->line('report'); ?></h3>
                        <div class="box-tools pull-right">
 
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="mailbox-controls">
                        </div>
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label"><?php echo $this->lang->line('book')." ".$this->lang->line('issue_return')." ".$this->lang->line('report'); ?></div>
                              <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>

                                        <th><?php echo $this->lang->line('book_title'); ?></th>
                                        <th><?php echo $this->lang->line('book_no'); ?></th>
                                        <th><?php echo $this->lang->line('issue_date'); ?></th>
                                        <th><?php echo $this->lang->line('return_date'); ?></th>
                                        
                                         <th><?php echo $this->lang->line('member_id'); ?></th>
                                        <th><?php echo $this->lang->line('library_card_no'); ?></th>
                                        <th><?php echo $this->lang->line('admission_no'); ?></th>
                                       <th><?php echo $this->lang->line('issue')." ".$this->lang->line('by'); ?></th>
                                        <th><?php echo $this->lang->line('member_type'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
if (empty($issued_books)) {
    ?>
                                   <?php
} else {
    $count = 1;
    foreach ($issued_books as $book) {
        ?>
                                           <tr >
                                                <td class="mailbox-name">
                                                    <?php echo $book['book_title'] ?>
                                                </td>
                                                <td class="mailbox-name">
                                                    <?php echo $book['book_no'] ?>
                                                </td>
                                                <td class="mailbox-name">
                                                    <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($book['issue_date'])) ?></td>
                                                    <?php ?>
                                                <td class="mailbox-name">
                                                    <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($book['return_date'])) ?></td>
                                                <td >
                                                    
                                                    <?php echo $book['members_id'];?>
                                                </td>
                                                <td><?php echo $book['library_card_no'];?></td>
                                                 <td><?php if($book['admission']!=0){ echo $book['admission']; }?></td>
                                                 <td >
                                                    <?php echo ucwords($book['fname'])." ".ucwords($book['lname']);?>

                                                </td>
                                                 <td >
                                                    <?php echo ucwords($book['member_type']);?>

                                                </td>
                                            </tr>
                                            <?php
$count++;
    }
}
?>

                                </tbody>
                            </table><!-- /.table -->
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </section>
</div>



