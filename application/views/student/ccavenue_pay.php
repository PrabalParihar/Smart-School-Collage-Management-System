<?php
$checksum = $this->adler32->getchecksum($merchant_id, $amount, $order_id, $url, $working_key);
$merchant_data = 'Merchant_Id=' . $merchant_id . '&Amount=' . $amount . '&Order_Id=' . $order_id . '&Redirect_Url=' . $url . '&billing_cust_name=' . $billing_cust_name . '&billing_cust_address=' . $billing_cust_address . '&billing_cust_country=' . $billing_cust_country . '&billing_cust_state=' . $billing_cust_state . '&billing_cust_city=' . $billing_city . '&billing_zip_code=' . $billing_zip . '&billing_cust_tel=' . $billing_cust_tel . '&billing_cust_email=' . $billing_cust_email . '&delivery_cust_name=' . $delivery_cust_name . '&delivery_cust_address=' . $delivery_cust_address . '&delivery_cust_country=' . $delivery_cust_country . '&delivery_cust_state=' . $delivery_cust_state . '&delivery_cust_city=' . $delivery_city . '&delivery_zip_code=' . $delivery_zip . '&delivery_cust_tel=' . $delivery_cust_tel . '&billing_cust_notes=' . $delivery_cust_notes . '&Checksum=' . $checksum;

$encrypted_data = $this->aes->encrypt($merchant_data, $working_key); // Method for encrypting the data.
?>

<form method="post" name="redirect" action="http://www.ccavenue.com/shopzone/cc_details.jsp"> 
    <?php
    echo "<input type=hidden name=encRequest value=$encrypted_data>";
    echo "<input type=hidden name=Merchant_Id value=$merchant_id>";
    ?>
</form>


<script language='javascript'>document.redirect.submit();</script>

