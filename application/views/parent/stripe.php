<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#424242" />
        <title>School Management System</title>
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
                                        <th>Decription</th>
                                        <th class="text-right">Amount</th>
                                    </tr>
                                    <tr>
                                        <td> <?php
                                            echo $params['payment_detail']->fee_group_name . "<br/><span>" . $params['payment_detail']->code;
                                            ?></span></td>
                                        <td class="text-right"><?php echo $setting[0]['currency_symbol'] . $params['total']; ?></td>
                                    </tr>

                                    <tr class="bordertoplightgray">
                                        <td colspan="2" bgcolor="#fff" class="text-right">Total: <?php echo $setting[0]['currency_symbol'] . $params['total']; ?></td>
                                    </tr>
                                </table>
                                <div class="divider"></div>

                                <form class="paddtlrb" action="<?php echo site_url('parent/stripe/complete'); ?>" method="POST">
                                    <button type="button" onclick="window.history.go(-1); return false;" name="search"  value="" class="btn btn-info"><i class="fa fa fa-chevron-left"></i> Back</button>  
                                    <script
                                        src="https://checkout.stripe.com/checkout.js" class="stripe-button pull-right"
                                        data-key="<?php echo $params['api_publishable_key']; ?>"
                                        data-amount="<?php echo ($params['total'] * 100); ?>"
                                        data-name="<?php echo $setting[0]['name']; ?>"
                                        data-description="<?php echo 'Payment for ' . $params['payment_detail']->fee_group_name . " - " . $params['payment_detail']->code; ?>"
                                        data-image="<?php echo base_url('uploads/school_content/logo/' . $setting[0]['image']); ?>"
                                        data-locale="auto"
                                        data-zip-code="true"
                                        data-currency="<?php echo $params['invoice']->currency_name; ?>"
                                        >
                                    </script>
                                    <input type="hidden" name="student_fees_master_id" value="<?php echo $params['student_fees_master_id']; ?>">
                                    <input type="hidden" name="fee_groups_feetype_id" value="<?php echo $params['fee_groups_feetype_id']; ?>">
                                    <input type="hidden" name="student_id" value="<?php echo $params['student_id']; ?>">
                                    <input type="hidden" name="total" value="<?php echo $params['total']; ?>">
                                </form>

                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </body>
</html>