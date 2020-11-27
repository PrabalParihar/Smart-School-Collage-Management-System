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
       
    </section>
    <!-- Main content -->
    <section class="content">
        <?php $this->load->view('reports/_finance'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="box removeboxmius">
                    <div class="box-header ptbnull"></div>
                      <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>

                    <form role="form" action="<?php echo site_url('report/onlinefees_report') ?>" method="post" class="">
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
                    <h3 class="box-title titlefix"><i class="fa fa-money"></i> <?php  ?> <?php echo $this->lang->line('online')." ".$this->lang->line('fees')." ".$this->lang->line('report'); ?></h3> 
                </div>
                <div class="box-body table-responsive">
                    <div class="download_label"><?php echo $this->lang->line('online')." ".$this->lang->line('fees')." ".$this->lang->line('report')."<br>";$this->customlib->get_postmessage(); ?></div>
                    <table class="table table-striped table-bordered table-hover example">
                       <thead class="header">
                                    <tr>
                                                    <th><?php echo $this->lang->line('payment_id'); ?></th>
                                                    <th><?php echo $this->lang->line('date'); ?></th>
                                                    <th><?php echo $this->lang->line('name'); ?></th>
                                                    <th><?php echo $this->lang->line('class'); ?></th>
                                                    <th><?php echo $this->lang->line('fee_type'); ?></th>
                                                    
                                                    <th><?php echo $this->lang->line('mode'); ?></th>

                                                    <th class="text text-right"><?php echo $this->lang->line('amount'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                                    <th class="text text-right"><?php echo $this->lang->line('discount'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                                    <th class="text text-right"><?php echo $this->lang->line('fine'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                                    <th class="text text-right"><?php echo $this->lang->line('total'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                                </tr>
                                </thead>
                              <tbody>
                                  
                                  <?php
                                 
                                               
                                                $grd_total = 0;
                                                $allamount=0;
                                                $alldiscount=0;
                                                $finetotal=0;
                                                $alltotal=0;
                                                //$amountLabel="";
                                                if (empty($collectlist)) {
                                                    
                                            } else {
                                                $count = 1;

                            foreach ($collectlist as $key => $collect) {

                                        $amount = 0;
                                        $discount = 0;
                                        $fine = 0;
                                        $total = 0;
                                        $amountLabel="";
                                        $discountLabel="";
                                        $fineLabel="";
                                        $TotalLabel="";
                                        
                                      

                                        $amount+=$collect['amount'];
                                        $amountLabel.=number_format($collect['amount'], 2, '.', '')."<br>";
                                        $discount+=$collect['amount_discount'];  
                                        $discountLabel.=number_format($collect['amount_discount'], 2, '.', '')."</br>";
                                        $fine+=$collect['amount_fine'];

                                        $fineLabel.=number_format($collect['amount_fine'], 2, '.', '')."</br>";
                                        $t=$collect['amount']+$collect['amount_fine'];
                                        $TotalLabel.=number_format($t, 2, '.', '')."</br>"; 
                                      

                                        $amountLabeltot=number_format($amount, 2, '.', '');
                                        $discountLabeltot=number_format($discount,2,'.','');
                                        $fineLabeltot=number_format($fine, 2, '.', ''); 
                                        $TotalLabeltot=number_format($t, 2, '.', '');
                                        $total+= ($amount + $fine);
                                        $allamount+=$amount;
                                        $alldiscount+=$discount;
                                        $finetotal+= $fine;
                                        $alltotal+=$total; 
                                         

                                                    ?>
                                                    <tr>
                                                        <td>
                                                        <?php echo $collect['id'] . "/" . $collect['inv_no']; ?>
                                                        </td>
                                                        <td>
                                                        <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($collect['date'])); ?>
                                                        </td>
                                                        <td>
                                                        <?php echo $collect['firstname'] . " " . $collect['lastname']; ?>
                                                        </td>
                                                        <td>
                                                        <?php echo $collect['class'] . " (" . $collect['section'] . ")"; ?>
                                                        </td>
                                                        <td>
                                                        <?php echo $collect['type']; ?>
                                                        </td>
                                                       
                                                        <td>
                                                        <?php echo $collect['payment_mode']; ?>
                                                        </td>
                                                        <td class="text text-right">
                                                        <?php echo $amountLabel; //number_format($amount, 2, '.', ''); ?>
                                                        </td>
                                                        <td class="text text-right">
                                                        <?php echo  $discountLabel;//number_format($discount, 2, '.', ''); ?>
                                                        </td>
                                                        <td class="text text-right">
                                                        <?php echo $fineLabel;//(number_format($fine, 2, '.', '')); ?>
                                                        </td>
                                                        <td class="text text-right">
                                                            <?php
                                                            $t = ($amount +$fine);
                                                            echo $TotalLabel;
                                                            ?>
                                                        </td>
                                                     </tr>
                                                    <?php
                                                    $count++;
                                                    ?>
                                                   
                                                    <?php
                                                }
                                            ?>
                                             <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                               
                                                <td style="font-weight:bold">Total</td>
                                                <td class="text text-right" style="font-weight:bold" ><?php echo number_format($allamount, 2, '.', ''); ?></td>
                                                <td class="text text-right" style="font-weight:bold"><?php echo number_format($alldiscount, 2, '.', ''); ?></td>
                                                <td class="text text-right" style="font-weight:bold"><?php echo number_format($finetotal, 2, '.', ''); ?></td>
                                                <td class="text text-right" style="font-weight:bold"><?php echo number_format($alltotal, 2, '.', ''); ?></td>                                                
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