<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html lang="en" class="loading">
    <head>
        <meta charset="utf-8">
        <link rel="icon" href="favicon.png">
        <title>Payumoney</title>   
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>


        <?php echo 'Payment for ' . $fee_group_name . " - " . $fee_code; ?>
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>  
                <div class="col-md-8">
                    <form action="<?php echo $action; ?>/_payment" method="post" id="payuForm" name="payuForm">
                        <input type="hidden" name="key" value="<?php echo $mkey ?>" />
                        <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
                        <input type="hidden" name="txnid" value="<?php echo $tid ?>" />
                        <div class="form-group">
                            <label class="control-label">Total Payable Amount</label>
                            <input class="form-control" name="amount" value="<?php echo $amount ?>"  readonly/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Your Name</label>
                            <input class="form-control" name="firstname" id="firstname" value="<?php echo $name ?>" readonly/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Email</label>
                            <input class="form-control" name="email" id="email" value="<?php echo $mailid ?>" readonly/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Phone</label>
                            <input class="form-control" name="phone" value="<?php echo $phoneno ?>" readonly />
                        </div>
                        <div class="form-group">
                            <label class="control-label"> Booking Info</label>
                            <textarea class="form-control" name="productinfo" readonly><?php echo $productinfo ?></textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Address</label>
                            <input class="form-control" name="address1" value="<?php echo $address ?>" readonly/>     
                        </div>
                        <div class="form-group">
                            <input name="surl" value="<?php echo $sucess ?>" size="64" type="hidden" />
                            <input name="furl" value="<?php echo $failure ?>" size="64" type="hidden" />                             
                            <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
                            <input name="curl" value="<?php echo $cancel ?> " type="hidden" />
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" value="Pay Now" class="btn btn-success" /></td>
                        </div>
                    </form>                                  
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>    
    </body>
</html>    
