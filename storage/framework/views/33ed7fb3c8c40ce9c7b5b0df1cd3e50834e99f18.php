<?php //dd($cancel); ?>


<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('online_payment.title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <style>
        .mx-auto{margin-left: auto;margin-right: auto;}
        #paypal-button-container{width: 250px;text-align: center; margin: 0 auto;}
        .btn-paypal{background:#0070ba !important;color:#fff;}
    </style>
    <div class="container">
        <br>
        <div class="alert alert-info" role="alert">
            <b class="text-danger">Important</b>: <?php echo e(trans('app.new-flash-message')); ?>

        </div>
        <?php if(env('SITE') =='ENG'): ?>
            
                
                
                    

               
            
        <?php endif; ?>
        <?php if(env('SITE')=='ENG'): ?>
            <h3>
                <mark>1. Make recurring payment</mark>
            </h3>

            <div class="text-center" style="padding : 50px 0">
                
                    
                        
                        <br><br>
                            <a class="btn btn-primary" style="color:#fff" href="<?php echo e(url('/subscription/make-subscription')); ?>">Start Subscription</a> <span class="text-bold text-danger display-5" style="font-size: 2rem">(<?php echo e(trans('app.new-Subscription-fee')); ?>)</span>
                <br><br><p class="text-center"><?php echo e(trans('app.cancel_subscription_msg')); ?></p>
                        
                    
            </div>
        <?php endif; ?>
        <br>
        <br>
        
    </div>
    <div class="modal fade" id="modal-id">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="https://dnasbookdigimarket.com/online-payment/cancelrecurring/?profile_id=<?php echo e($profile_id); ?>"
                      method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Reason for Cancellation</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="" class="control-label">Reason</label>
                            <textarea name="reason" id="reason" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Cancel Subscription</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <h3>
        <mark>2. Make your offline payment</mark>
    </h3>
    <form action="<?php echo e(route('offline_pay.add')); ?>" enctype="multipart/form-data" id="manage-faq" method="POST"
          class="form-horizontal">
        <?php echo e(csrf_field()); ?>

        <fieldset>
            
            <div class="form-group container">
                <div class="row">
                    <div class="col-lg-4">
                        <label for="exampleInputEmail1">Name of Subscriber</label>
                    </div>
                    <div class="col-lg-4">
                        <input type="text" name="name_of_subscriber" class="form-control"
                               id="exampleInputEmail1"
                               aria-describedby="emailHelp" value="" placeholder="Name of Subscriber" required>
                    </div>
                </div>
            </div>
            

            
            <div class="form-group container">
                <div class="row">
                    <div class="col-lg-4">
                        <label for="exampleInputEmail1">Country of Subscriber</label>
                    </div>
                    <div class="col-lg-4">
                        <input type="text" name="country" class="form-control" id="exampleInputEmail1"
                               aria-describedby="emailHelp" value="" placeholder="country" required>
                    </div>
                </div>
            </div>
            
            <div class="form-group container">
                <div class="row">
                    <div class="col-lg-4">
                        <label for="exampleInputEmail1">Means of Payment</label>
                    </div>
                    <div class="col-lg-4">
                        <input type="text" name="payment_type" class="form-control" id="exampleInputEmail1"
                               aria-describedby="emailHelp" value="" placeholder="Paymnet's Means" required>
                    </div>
                </div>
            </div>
            
            <div class="form-group container">
                <div class="row">
                    <div class="col-lg-4">
                        <label for="exampleInputEmail1">Payment receipt number</label>
                    </div>
                    <div class="col-lg-4">
                        <input type="text" name="bank_slip_no" class="form-control" id="exampleInputEmail1"
                               aria-describedby="emailHelp" value="" placeholder="Bank slip no" required>
                    </div>
                </div>
            </div>

            <div class="form-group container">
                <div class="row">
                    <div class="col-lg-4">
                        <label for="exampleInputEmail1">Account Number the payment is sent to</label>
                    </div>
                    <div class="col-lg-4">
                        <input type="text" name="account_no" class="form-control" id="exampleInputEmail1"
                               aria-describedby="emailHelp" value="" placeholder="Account No" required>
                    </div>
                </div>
            </div>
            <div class="form-group container">
                <div class="row">
                    <div class="col-lg-4">
                        <label for="exampleInputEmail1">Amount paid</label>
                    </div>
                    <div class="col-lg-4">
                        <input type="number" name="amount_paid" class="form-control" id="exampleInputEmail1"
                               aria-describedby="emailHelp" value="" placeholder="Amount paid" required>
                    </div>
                </div>
            </div>

            <div class="form-group container">
                <div class="row">
                    <div class="col-lg-4">
                        <label for="exampleInputEmail1">Upload Receipt copy</label>
                    </div>
                    <div class="col-lg-4">
                        <input name="receipt_photo" type="file" required>
                    </div>
                </div>
            </div>
        </fieldset>
        <input type="hidden" value="<?php echo e(csrf_token()); ?>" name="_token">
        <button type="submit" class="btn btn-success btn-md" style="margin-left: 45%">Save Changes</button>
    </form>

    <br><br>
    <h3>
        <mark>3. Make your payment by bitcoin & paypal</mark>
    </h3>
    <br><br>
    <div class="row">
        <div class="col-md-6">
            <div class="text-center">
                <a class="buy-with-crypto"
                   href="https://commerce.coinbase.com/checkout/41832089-ddd7-42ad-8e77-5c51fa92539a">
                    Pay Btc
                </a>
                <script src="https://commerce.coinbase.com/v1/checkout.js?version=201807"></script>
            </div>
            <div class="col-lg-12">
                <h4 class="text-danger">Copy Your Code from Here To SomeDocument File</h4>
                <div class="form-group row">
                    <div class="col-lg-9">
                        <?php if(session()->has('btcOfflinePayToken')): ?>
                            <input type="text" class="form-control" name="btcOfflinePayToken" id="btcOfflinePayToken"
                                   placeholder="Video Access Token" value="<?php echo e(session()->get('btcOfflinePayToken')); ?>" readonly>
                        <?php else: ?>
                            <input type="text" class="form-control" name="btcOfflinePayToken" id="btcOfflinePayToken"
                                   placeholder="Video Access Token" value="" readonly>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-3">
                        <button onclick="copyTextBTC()" type="button" data-toggle="tooltip"
                                data-html="true"
                                title=""
                                class="btn btn-default btn-sm"
                                data-original-title="copy to clipboard">
                            <span class="glyphicon glyphicon-paperclip" aria-hidden="true" style="font-size: 2rem"></span>
                        </button>
                    </div>
                </div>
                <div class="distributor">
                    <a href="https://www.dnasbookdigimarket.com/submit-bitcoin-tokens"
                       class="btn btn-primary registerlink"
                       style="color: black;cursor:grab">Next
                    </a>
                </div>
                <br><br><br><br>
            </div>
            <script>
                let event  = "";
                BuyWithCrypto.registerCallback('onSuccess', function(request){
                    event = "payment_detected";
                });
                BuyWithCrypto.registerCallback('onFailure', function(request){
                    event = "charge_failed";
                    test_function(request);
                });
                BuyWithCrypto.registerCallback('onPaymentDetected', function(request){
                    event = "payment_detected";
                    test_function(request);
                });
                function test_function(request){
                    let code = request.code;
                    let buttonId = request.buttonId;
                    let param = {'_token':'<?php echo e(csrf_token()); ?>','event':event,'code':code,'buttonId':buttonId };
                    $.ajax({
                        type: "GET",
                        url: "https://www.dnasbookdigimarket.com/btc-payment-online-af-expire",
                        async:false,
                        crossDomain: true,
                        dataType: 'jsonp',
                        headers: {  'Access-Control-Allow-Origin': '*' },
                        data: param,
                        success: function(data){
                            let btcAccessToken = data.btcAccessToken;
                            $('#btcOfflinePayToken').val(btcAccessToken);
                        }
                    });
                }
                function copyTextBTC(){
                    var copyText = document.getElementById("btcOfflinePayToken");
                    copyText.select();
                    document.execCommand("copy");
                }
                 function copyTextPaypal() {
                    var copyText = document.getElementById("PaypalOfflinePayToken");
                    copyText.select();
                    document.execCommand("copy");
                }
            </script>
        </div>
        <div class="col-md-6">
            <!--<script
                src="https://www.paypal.com/sdk/js?client-id=<?php echo PAYPAL_CLIENT_ID; ?>"> // Required. Replace YOUR_CLIENT_ID with your sandbox client ID.
            </script>-->
            <div id="smart-button-container">
                <div style="text-align: center;">
                    <a href="/makeOneTimePaypalPayment">
                        <span class="btn btn-paypal">Paypal</span>
                    </a>
                </div>
            </div>
            <div class="col-md-12">
                <h4 class="text-danger">Copy Your Code from Here To SomeDocument File</h4>
                <div class="form-group row">
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="PaypalOfflinePayToken" id="PaypalOfflinePayToken" placeholder="Video Access Token" value="<?php echo e($secrete_key ?? ''); ?>" readonly>
                        </div>
                        <div class="col-lg-3">
                            <button onclick="copyTextPaypal()" type="button" data-toggle="tooltip"
                                    data-html="true"
                                    title=""
                                    class="btn btn-default btn-sm"
                                    data-original-title="copy to clipboard">
                                <span class="glyphicon glyphicon-paperclip" aria-hidden="true" style="font-size: 2rem"></span>
                            </button>
                        </div>
                    </div>
                <div class="distributor">
                    <a href="https://www.dnasbookdigimarket.com/submit-bitcoin-tokens" class="btn btn-primary registerlink" style="color: black;cursor:grab">Next</a>
                </div>
                <br><br><br><br>
            </div>
        </div>
    </div>
<br><br><br><br>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>