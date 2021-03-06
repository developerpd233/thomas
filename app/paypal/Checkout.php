<?php

namespace App\paypal;

use App\paypal\Paypal;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

class Checkout extends Paypal
{
    public function oneTimePayment($id, $type)
    {
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $item1 = new Item();
        $item1->setName('Training Video')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setSku("123123") // Similar to `item_number` in Classic API
            ->setPrice(env('ONETIME_PAY'));


        $itemList = new ItemList();
        $itemList->setItems(array($item1));


        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal(env('ONETIME_PAY'));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("This Payment is For Training Video you should watch before Registration")
            ->setInvoiceNumber(uniqid());

        $baseUrl = URL::to('/');
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("$baseUrl/ExecuteOneTimePayment?success=true&afid=".$id."&wtype=".$type)
            ->setCancelUrl("$baseUrl/ExecuteOneTimePayment?success=false&afid=".$id."&wtype=".$type);

        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        $payment->create($this->apiContext);

        $approveUrl = $payment->getApprovalLink();
        return $approveUrl;
    }

    public function executePayment($request)
    {
        $prefex1 = uniqid();
        $prefex = uniqid($prefex1);
        $uniqueToken = md5(uniqid($prefex));
        if ($request->has('success') && $request->success == 'true') {
            $paymentId = $request->paymentId;
            $payment = Payment::get($paymentId, $this->apiContext);

            $execution = new PaymentExecution();
            $execution->setPayerId($request->PayerID);
            $result = $payment->execute($execution, $this->apiContext);
            $resultArr = [
                'result' => $result,
                'PayerId' => $request->PayerID,
                'paymentID' => $request->paymentId,
                'created_at' => $result->create_time,
                'amount' => env('ONETIME_PAY'),
                'token' => $uniqueToken,
                'expiry_time' => time() + 60 * 60 * 72
            ];
            return $resultArr;
        }
    }
     public function oneTimePaypalPayment(){
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $item1 = new Item();
        $item1->setName('Training Video')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setSku("123123") // Similar to `item_number` in Classic API
            ->setPrice(env('RECURRING_PAY'));


        $itemList = new ItemList();
        $itemList->setItems(array($item1));


        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal(env('RECURRING_PAY'));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("This Payment is For Training Video you should watch before Registration")
            ->setInvoiceNumber(uniqid());

        $baseUrl = URL::to('/');
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("$baseUrl/ExecuteOneTimePaypalPayment?success=true")
            ->setCancelUrl("$baseUrl/ExecuteOneTimePaypalPayment?success=false");

        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        $payment->create($this->apiContext);

        $approveUrl = $payment->getApprovalLink();
        return $approveUrl;
    }

    public function executePaypalPayment($request)
    {
        $prefex1 = uniqid();
        $prefex = uniqid($prefex1);
        $uniqueToken = md5(uniqid($prefex));
        if ($request->has('success') && $request->success == 'true') {
            $paymentId = $request->paymentId;
            $payment = Payment::get($paymentId, $this->apiContext);

            $execution = new PaymentExecution();
            $execution->setPayerId($request->PayerID);
            $result = $payment->execute($execution, $this->apiContext);
            $resultArr = [
                'result' => $result,
                'PayerId' => $request->PayerID,
                'paymentID' => $request->paymentId,
                'created_at' => $result->create_time,
                'amount' => env('RECURRING_PAY'),
                'token' => $uniqueToken,
                'expiry_time' => time() + 60 * 60 * 72
            ];
            return $resultArr;
        }
    }
}
