@extends('layouts.user_backend.default')
@section('page_title')
    {{ trans('page_title.offline') }}
@endsection
@section('content')

<style>
.section{
    height: 730px !important;
}
</style>
    <div class="panel-body">
        <div class="ibox-content">
            <br>
            <div class="alert alert-info" role="alert">
                <b class="text-danger">Important</b>: {{trans('app.new-flash-message')}}
            </div>
            <br>
            <form action="{{route('offline_pay.add')}}" enctype="multipart/form-data" id="manage-faq" method="POST"
                  class="form-horizontal">
                {{ csrf_field() }}
                <fieldset>
                    {{--//Name of subscriber--}}
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
                    {{--//name of bank--}}

                    {{--Name of country--}}
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
                    {{--//means of payment--}}
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
                    {{--//Account number--}}
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
                <input type="hidden" value="{{csrf_token()}}" name="_token">
                <button type="submit" class="btn btn-success btn-md" style="margin-left: 45%">Save Changes</button>
            </form>            
        </div>
        @if($_SERVER['REMOTE_ADDR'] == "150.129.104.91")
            @if(session()->has('btcOfflinePaymentAddress'))
                <br>
                    <h4 class="text-danger text-center">Copy BTC Pay Address AND Pay ${{ env('RECURRING_PAY') }} Our monthly fees</h4>
                <br>
                <div class="text-center">                
                    <div class="col-lg-6">
                        @if(session()->has('btcOfflinePaymentAddress'))
                            <input type="text" class="form-control" name="btcPayAddress" id="btcPayAddress"
                                   placeholder="BTC pay Address" value="{{session()->get('btcOfflinePaymentAddress')}}" readonly>
                        @else
                            <input type="text" class="form-control" name="btcPayAddress" id="btcPayAddress"
                                   placeholder="BTC pay Address" value="" readonly>
                        @endif
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
            @else
                <br>
                    <h4 class="text-danger text-center">OR Pay By BTC</h4>
                <br>
                <div class="text-center">                
                    <form action="{{route('offline_pay.btcpay')}}" enctype="multipart/form-data" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-md btn-warning" role="button">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pay BTC&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                    </form>
                </div>
            @endif            
        @endif
    </div>   
<script>
    function copyTextBTC(){
        var copyText = document.getElementById("btcPayAddress");
        copyText.select();
        document.execCommand("copy");
    }
</script>                
@endsection
