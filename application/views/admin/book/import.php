<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-book"></i> <?php echo $this->lang->line('library'); ?> <small><?php echo $this->lang->line('student1'); ?></small></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
<div class="box box-info" style="padding:5px;">
<div class="box-header with-border">
<h3 class="box-title"><?php echo $this->lang->line('import')." ".$this->lang->line('book')?></h3>
                        <div class="pull-right box-tools">                            
                            <a href="<?php echo site_url('admin/book/exportformat') ?>">
                                <button class="btn btn-primary btn-sm"><i class="fa fa-download"></i> <?php echo $this->lang->line('dl_sample_import'); ?></button>
                            </a>
                        </div>
                    </div>
                <div class="box-body">      
                    <?php if($this->session->flashdata('msg')) { ?> <div>  <?php echo $this->session->flashdata('msg') ?> </div> <?php } ?>
                    <br/>           
1. Your CSV data should be in the format below. The first line of your CSV file should be the column headers as in the table example. Also make sure that your file is UTF-8 to avoid unnecessary encoding problems.<br/>
2. If the column you are trying to import is date make sure that is formatted in format Y-m-d (2018-06-06).<br/>

<hr/></div>
                    <div class="box-body table-responsive">
                <table class="table table-striped table-bordered table-hover" id="sampledata">
                    <thead>
                        <tr>
                    <?php foreach ($fields as $key => $value) {

                        if($value == 'book_title'){
                            $value = "book_title";
                        }

                        if($value == 'book_no'){
                            $value = "book_no";
                        }
                        if($value == 'isbn_no'){
                            $value = "isbn_no";
                        }
                        if($value == 'subject'){
                            $value = "subject";
                        }
                        if($value == 'rack_no'){
                            $value = "rack_no";
                        }
                        if($value == 'publish'){
                            $value = "publisher";
                        }
                         if($value == 'author'){
                            $value = "author";
                        }
                         if($value == 'qty'){
                            $value = "qty";
                        }
                        if($value == 'perunitcost'){
                            $value = "bookprice";
                        }
                        if($value == 'postdate'){
                            $value = "postdate";
                        }
                        if($value == 'description'){
                            $value = "description";
                        }
                        if($value == 'available'){
                            $value = "available";
                        }
                        if($value == 'is_active'){
                            $value = "is_active";
                        }
                        $add = "";
                        if(($value == "book_title")   ){
                            $add = "<span class=text-red>*</span>";
                        }
                    ?>    
                   <th><?php echo $add."<span>".$this->lang->line($value)."</span>"; ?></th>
                   <?php } ?>
               </tr>
               </thead>
               <tbody>
                <tr>
                     <?php foreach ($fields as $key => $value) {
                    ?>    
                   <td><?php echo "Sample Data" ?></td>
                   <?php } ?>
               </tr>
               </tbody>

                </table>        
                </div>
                <hr/>
                   <form action="<?php echo site_url('admin/book/import') ?>"  id="employeeform" name="employeeform" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="row">
                               
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputFile"><?php echo $this->lang->line('select_csv_file'); ?></label><small class="req"> *</small>
                                        <div><input class="filestyle form-control" type='file' name='file' id="file" size='20' />
                                            <span class="text-danger"><?php echo form_error('file'); ?></span></div>
                                    </div></div>
                                <div class="col-md-6 pt20">
                                     <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('import')." ".$this->lang->line('book')?></button>
                                </div>     

                            </div>
                        </div>
                       
                         
                    </form>
                    
                <div>



                </div>
            </div>
                </section>
            </div>

           