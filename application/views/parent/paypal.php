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
                                        <td> 

                                            <?php
                                            echo $params['payment_detail']->fee_group_name . "<br/><span>" . $params['payment_detail']->code;
                                            ?></span></td>
                                        <td class="text-right"><?php echo $setting[0]['currency_symbol'] . $params['total']; ?></td>
                                    </tr>
                                    <tr class="bordertoplightgray">
                                        <td colspan="2" class="text-right">Total: <?php echo $setting[0]['currency_symbol'] . $params['total']; ?></td>
                                    </tr>
                                </table>

                                <script src="<?php echo base_url(); ?>backend/custom/jquery.min.js"></script>
                                <div class="divider"></div>
                                <form class="paddtlrb" action="<?php echo site_url('parent/paypal/complete') ?>" method="POST" id="paypalForm">

                                    <input type="text" hidden="" name="student_fees_master_id" value="<?php echo $params['student_fees_master_id']; ?>">
                                    <input type="text" hidden="" name="fee_groups_feetype_id" value="<?php echo $params['fee_groups_feetype_id']; ?>">
                                    <input type="text" hidden="" name="student_id" value="<?php echo $params['student_id']; ?>">
                                    <input type="text" hidden="" name="total" value="<?php echo $params['total']; ?>">

                                    <button type="button" onclick="window.history.go(-1); return false;" name="search"  value="" class="btn btn-info"><i class="fa fa fa-chevron-left"></i> Back</button>    
                                    <button type="button"  class="btn cfees pull-right submit_button"><i class="fa fa fa-money"></i> Pay Now </button> 

                           <!-- <input type="button" value="Pay Now" class="btn cfees pull-right" /> -->
                                </form> 
                            </div></div></div></div>                     


            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $(".submit_button").click(function (e) {
                var url = "<?php echo site_url('parent/paypal/checkout') ?>";

                $.ajax({
                    type: "POST",
                    url: url,
                    data: $("#paypalForm").serialize(),
                    dataType: "Json",
                    success: function (response)
                    {

                        if (response.status == "success") {
                            $('form#paypalForm').submit();
                        } else if (response.status == "fail") {
                            $.each(response.error, function (index, value) {
                                var errorDiv = '.' + index + '_error';
                                $(errorDiv).empty().append(value);
                            });
                        }
                    }
                });

                e.preventDefault();
            });
        });
    </script>

</body>
</html>       