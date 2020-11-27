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
     .removeboxmius{    margin-top: -10px;
    box-shadow: none !important;
    border-top: 0 !important;
    position: relative;
    z-index: 1;border: 1px solid #dde4eb;}
</style>

<div class="content-wrapper" style="min-height: 946px;">

    <section class="content-header">
        <h1>
            <i class="fa fa-bus"></i> <?php echo $this->lang->line('transport'); ?></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <?php $this->load->view('reports/_inventory');?>
        <div class="row">
            <div class="col-md-12">
                <div class="box removeboxmius">
                    <!-- <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php //echo $this->lang->line('select_criteria'); ?></h3>
                    </div> -->

                     <form role="form" action="<?php echo site_url('report/additem') ?>" method="post" class="">
                        <div class="box-body">

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
                    <h3 class="box-title titlefix"><i class="fa fa-money"></i> <?php echo $this->lang->line('add')." ".$this->lang->line('item')." ".$this->lang->line('report'); ?></h3>
                </div>
                <div class="box-body">
                 <div class="download_label"> <?php echo $this->lang->line('add')." ".$this->lang->line('item')." ".$this->lang->line('report')."<br>";$this->customlib->get_postmessage(); ?></div>
                     <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                     <tr>
                                        <th><?php echo $this->lang->line('name'); ?></th>
                                        <th><?php echo $this->lang->line('category'); ?></th>
                                        <th><?php echo $this->lang->line('supplier'); ?></th>
                                        <th><?php echo $this->lang->line('store'); ?></th>
                                        <th><?php echo $this->lang->line('quantity'); ?></th>
                                        <th><?php echo $this->lang->line('purchase')." ".$this->lang->line('price'); ?></th>
                                        <th><?php echo $this->lang->line('date'); ?></th>
                                       
                                    </tr>
                                </thead>
                               <tbody>
                               	<?php 
                               	foreach($itemresult as $key=>$value){
                               		?>
                               		<tr>
                               			<td><?php echo $value->name;?></td>
                               			<td><?php echo $value->item_category; ?></td>
                               			<td><?php echo $value->item_supplier; ?></td>
                               			<td><?php echo $value->item_store; ?></td>
                               			<td><?php echo $value->quantity; ?></td>
                               			<td><?php echo $currency_symbol.$value->purchase_price; ?></td>

                               			<td><?php  echo date($this->customlib->getSchoolDateFormat(),strtotime($value->date));?></td>
                               		</tr>
                               		<?php 

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