<?php $baseUrl = URL::to('/');
?>
<?php if(env('SITE') == 'ENG'): ?>
                    <div class="col-md-6">
                        <div class="text-center">
                            <a href="/makeOneTimePayment?id=<?php echo e(request()->get('id')); ?>&type=webinar">
                                <button class="btn btn-warning" role="button">Pay Now</button>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-center">
                            <div>
                                <a class="buy-with-crypto"
                                   href="https://commerce.coinbase.com/checkout/e30c1f49-0ed0-4ba0-b121-9ba5a8eed90a">
                                  Pay Btc
                                </a>
                                <script src="https://commerce.coinbase.com/v1/checkout.js?version=201807">
                                </script>
                            </div>
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
                                        url: "https://www.dnasbookdigimarket.com/createbtcchargebybtn",
                                        async:false,
                                        crossDomain: true,
                                        dataType: 'jsonp',
                                        headers: {  'Access-Control-Allow-Origin': '*' },
                                        data: param,
                                        success: function(data){
                                           let btcAccessToken = data.btcAccessToken;
                                           $('#btcPayAddress').val(btcAccessToken); 
                                        }
                                    });
                                }
                        </script>
                    </div>
                <?php endif; ?>
                <br>
                <?php if(env('SITE') == 'ENG'): ?>
                    <div class="form-group" style="padding-top: 30px">
                        <div class="row">
                            <div class="col-lg-6">
                                <h4 class=" text-danger">Copy Your Code from Here To SomeDocument File</h4>
                                <div class="form-group row">
                                    <div class="col-lg-9">
                                        <?php if(isset($_COOKIE['token'])): ?>
                                            <input type="text" class="form-control" name="token" id="password"
                                                   placeholder="Token" value="<?php echo e($_COOKIE['token']); ?>" readonly>
                                        <?php else: ?>
                                            <input type="text" class="form-control" name="token" id="password"
                                                   placeholder="Token" value="NO token yet" readonly>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-lg-3">
                                        <button onclick="copyText()" type="button" data-toggle="tooltip"
                                                data-html="true"
                                                title=""
                                                class="btn btn-default btn-sm"
                                                onclick="myFunction()" data-original-title="copy to clipboard">
                                            <span class="glyphicon glyphicon-paperclip" aria-hidden="true" style="font-size: 2rem"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <h4 class="text-danger">Copy Your Code from Here To SomeDocument File</h4>
                                <div class="form-group row">
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" name="btcPayAddress" id="btcPayAddress"
                                               placeholder="Video Access Token" value="<?php if(session()->has('btcAccessToken')): ?>  <?php echo e(session()->get('btcAccessToken')); ?> <?php endif; ?>" readonly>
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
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script>
    function copyText() {
        var copyText = document.getElementById("password");
        copyText.select();
        document.execCommand("copy");
    }
    function copyTextBTC(){
        var copyText = document.getElementById("btcPayAddress");
        copyText.select();
        document.execCommand("copy");
    }
</script>
<script>
    $(document).ready(function () {
        $(".distributor button").click(function () {
            var baseURL = "<?php echo $baseUrl ?>";
            var getID = "<?php echo e(request()->get('id')); ?>";
            document.cookie = "distributor-distributor-payment=1;path=/";
            window.location = baseURL + "/register/" + getID;
        })
    })
</script>
        