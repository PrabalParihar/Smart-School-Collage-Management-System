<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-gears"></i> <?php echo $this->lang->line('system_settings'); ?><small><?php echo $this->lang->line('setting1'); ?></small>        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">ADD</h3>
                    </div>
                    <div class="box-body">
                        <div>
                            <h2>Dear Member</h2>
                            <span>Your payment was successful, thank you for payment.</span><br/>
                            <span>Item Number :
                                <strong><?php echo $item_number; ?></strong>
                            </span><br/>
                            <span>TXN ID :
                                <strong><?php echo $txn_id; ?></strong>
                            </span><br/>
                            <span>Amount Paid :
                                <strong>$<?php echo $payment_amt . ' ' . $currency_code; ?></strong>
                            </span><br/>
                            <span>Payment Status :
                                <strong><?php echo $status; ?></strong>
                            </span><br/>
                        </div>
                    </div>
                    <div class="box-footer">
                    </div>
                </div> 
            </div>
        </div>  
    </section>
</div>