<?php namespace Listener;

require('Paypal_IPN.php');

use PaypalIPN;

$ipn = new PaypalIPN();

// Use the sandbox endpoint during testing.
$ipn->useSandbox();
//$verified = $ipn->verifyIPN();
$verified = true;
if ($verified) {
    /*
     * Process IPN
     * A list of variables is available here:
     * https://developer.paypal.com/webapps/developer/docs/classic/ipn/integration-guide/IPNandPDTVariables/
     *
	 $payer_email
	 payment_fee
	 payment_date   */
	 //echo "<pre>";
	 print_r($_POST);
	 //echo "</pre>";
	 //file_put_contents("recurringPayment.log" ,$_POST);
}

// Reply with an empty 200 response to indicate to paypal the IPN was received correctly.
//header("HTTP/1.1 200 OK");