<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#424242" />
        <title><?php echo $this->customlib->getAppName(); ?></title> 
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap.min.css"> 
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/font-awesome.min.css"> 
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/style-main.css"> 
    </head>
    <body style="background: #ededed;">
        <div class="container">
            <div class="row">

                <div class="paddtop20">
                    <div class="col-md-8 col-md-offset-2 text-center">
                        <img src="<?php echo base_url('uploads/school_content/logo/' . $setting[0]['image']); ?>">
                    </div>
                    <div class="col-md-6 col-md-offset-3 mt20">
                        <div class="paymentbg">
                            <div class="invtext">Fees Payment Details</div>
                            <div class="padd2 paddtzero">
                                <table class="table2" width="100%">
                                    <tr>
                                        <th>Description</th>
                                        <th class="text-right">Amount</th>
                                    </tr>
                                    <tr>
                                        <td> <?php
                                            echo $payment_detail->fee_group_name . "<br/><span>" . $payment_detail->code;
                                            ?></span></td>
                                        <td class="text-right"><?php echo $setting[0]['currency_symbol'] . $total; ?></td>
                                    </tr>

                                    <tr class="bordertoplightgray">
                                        <td colspan="2" bgcolor="#fff" class="text-right">Total: <?php echo $setting[0]['currency_symbol'] . $total; ?></td>
                                    </tr>
                                </table>
                                <div class="divider"></div>

                                <form class="paddtlrb" method="POST" action="<?php echo site_url('parent/ccavenue/pay') ?>">
                                    <button type="button" onclick="window.history.go(-1); return false;" name="search"  value="" class="btn btn-info"><i class="fa fa fa-chevron-left"></i> Back</button>    
                                    <button type="submit" name="search" value="" class="btn cfees pull-right"><i class="fa fa fa-money"></i> Pay Now </button>  

                                </form>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </body>
</html>