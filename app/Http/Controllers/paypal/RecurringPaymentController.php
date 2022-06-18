<?php

namespace App\Http\Controllers\paypal;


use App\Http\Controllers\Controller;
use App\paypal\RecurringPlan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rules\In;
use PayPal\Api\Agreement;
use Illuminate\Support\Facades\Input;

class RecurringPaymentController extends Controller
{
    public function makeRecurringPayment()
    {
        $plan = new RecurringPlan();
        $url = $plan->MakeRecurringPayment();
        return redirect($url);
    }

    public function ExecuteRecurringPayment(Request $request)
    {
        $execute = new RecurringPlan();
        $execute->executeRecurringPayment($request);

    }

    public function cancelUrl()
    {
        return redirect('/online-payment/addnew1')->with('danger', "Your payment has been canceled");
    }

    public function cancelSubscription()
    {
        $cancel = new RecurringPlan();
        $cancel->cancelSubscription();
    }

    public function createSubscription(Request $request){
        $plan = new RecurringPlan();
        $resp = $plan->createSubscription($request);
        return redirect('/online-payment/addnew1')->with($resp);
    }

    public function cancelSubscriptionFlow(){
        $cancel = new RecurringPlan();
        $cancel->cancelSubscriptionFlow();
        return redirect('/online-payment/addnew1');
    }

    public function makeSubscription(){
        $paln = new RecurringPlan();
        $url = $paln->makeSubscription();
        return redirect($url);
    }

    public function subscribePendingStatusByCron()
    {
        $bThisMonth = DB::table('payments')
            ->where('created_at', Carbon::now()->toDateTimeString())
            ->where('status', 'PENDING')
            ->where('cancel', '0')
            ->get();
        $paln = new RecurringPlan();
        $paln->getAuthToken();
        $accessToken = access_token;
        if (isset($bThisMonth) && !empty($bThisMonth)):
            foreach ($bThisMonth as $payment) {
                if (isset($payment->subscription_id) && !empty($payment->subscription_id)) {
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => PAYPAL_URL."v1/billing/subscriptions/$payment->subscription_id",
                        CURLOPT_HTTPGET => 1,
                        CURLOPT_HTTPHEADER => [
                            "Content-Type: application/json",
                            "Authorization: Bearer $accessToken",
                        ],
                        CURLOPT_RETURNTRANSFER => true,
                    ]);

                    $resp = curl_exec($curl);
                    $json = json_decode($resp,true);
                    curl_close($curl);
                    if(isset($json) && !empty($json)){
                        if(isset($json['status']) && ($json['status'] == 'ACTIVE')){
                            $startAt = Carbon::now();
                            $endAt = new Carbon('first day of next month');
                            $updVal = array('startAt'=>$startAt,'endAt' => $endAt, 'total_cycle' => 1,'status'=>'APPROVED');
                            DB::table('payments')->where(array('subscription_id' => $payment->subscription_id, 'user_id' => $payment->user_id))->update($updVal);
                            DB::table('users')->where(array('id' => $payment->user_id))->update(['updated_at'=>Carbon::now()->toDateString(),'ban_date'=>NULL]);
                        }
                    }
                }
            }
        endif;
    }

    public function checkSubscriptionStatus(){
        $bThisMonth = DB::table('payments')
            ->where('endAt', Carbon::now()->toDateString())
            ->where('status', 'APPROVED')
            ->where('cancel', '0')
            ->get();
        $paln = new RecurringPlan();
        $paln->getAuthToken();
        $accessToken = access_token;
        if(isset($bThisMonth) && !empty($bThisMonth)):
            foreach ($bThisMonth as $payment) {
                if (isset($payment->subscription_id) && !empty($payment->subscription_id)){
                    $curl = curl_init();
                    $start_time = str_replace(' ', 'T', $payment->created_at) . 'Z';
                    $end_time = str_replace(' ', 'T', Carbon::now()->toDateTimeString()) . 'Z';
                    curl_setopt_array($curl, [
                        CURLOPT_URL => PAYPAL_URL . "v1/billing/subscriptions/$payment->subscription_id/transactions?start_time=$start_time&end_time=$end_time",
                        CURLOPT_HTTPGET => 1,
                        CURLOPT_HTTPHEADER => [
                            "Content-Type: application/json",
                            "Authorization: Bearer $accessToken",
                        ],
                        //CURLOPT_POSTFIELDS => $payload,
                        CURLOPT_RETURNTRANSFER => true,
                    ]);

                    $resp = curl_exec($curl);
                    $json = json_decode($resp, true);
                    $banDate = new Carbon('first day of third month');
                    if (isset($json) && !empty($json)) {
                        if (isset($json['transactions']) && (count($json['transactions']) > ($payment->total_cycle))) {
                            if ($json['transactions'][0]['status'] == 'COMPLETED') {
                                $startAt = new Carbon('first dat of this month');
                                $endAt = new Carbon('first day of next month');
                                $total_cycle = $payment->total_cycle + 1;
                                $updVal = array('startAt'=>$startAt,'endAt' => $endAt, 'total_cycle' => $total_cycle);
                                DB::table('payments')->where(array('subscription_id' => $payment->subscription_id, 'user_id' => $payment->user_id))->update($updVal);
                                DB::table('users')->where(array('id' => $payment->user_id))->update(['updated_at'=>Carbon::now()->toDateString(),'ban_date'=>NULL,'is_active' => 'YES']);
                            }
                            else if ($json['transactions'][0]['status'] == 'APPROVAL_PENDING') {
                                $startAt = Carbon::now();
                                $endAt = Carbon::now()->addDays(5)->toDateString();
                                $updVal = array('startAt'=>$startAt,'endAt' => $endAt);
                                DB::table('payments')->where(array('subscription_id' => $payment->subscription_id, 'user_id' => $payment->user_id))->update($updVal);
                                DB::table('users')->where(array('is_active' => 'YES', 'id' => $payment->user_id))->update(['is_active' => 'NO','updated_at'=>Carbon::now()->toDateString()]);
                            }
                            else if ($json['transactions'][0]['status'] == 'APPROVAL_PENDING' && $json['transactions'][1]['status'] == 'APPROVAL_PENDING') {
                                $updVal = array('cancel'=>1);
                                DB::table('payments')->where(array('subscription_id' => $payment->subscription_id, 'user_id' => $payment->user_id))->update($updVal);
                                //DB::table('users')->where(array('id' => $payment->user_id))->update(['ban' => 'YES','ban_date'=>$banDate,'updated_at'=>Carbon::now()->toDateString()]);
                            }
                        }
                        else if (count($json['transactions']) == 12) {
                            DB::table('payments')->where(array('subscription_id' => $payment->subscription_id, 'user_id' => $payment->user_id))->update(['cancel' => 1,'status'=>'EXPIRED']);
                        }
                        else {
                            DB::table('payments')->where(array('subscription_id' => $payment->subscription_id, 'user_id' => $payment->user_id))->update(['cancel' => 1]);
                            //DB::table('users')->where(array('is_active' => 'YES', 'id' => $payment->user_id))->update(['is_active' => 'NO','updated_at'=>Carbon::now()->toDateString(),'ban_date'=>$banDate]);
                        }
                    }
                }
            }
        endif;
    }

    public function checkSubscriptionCancelStatus()
    {
        $bThisMonth = DB::table('payments')
            //->where('created_at', Carbon::now()->toDateTimeString())
            ->where('status', 'APPROVED')
            ->where('cancel', '0')
            ->get();
        $paln = new RecurringPlan();
        $paln->getAuthToken();
        $accessToken = access_token;
        if (isset($bThisMonth) && !empty($bThisMonth)):
            foreach ($bThisMonth as $payment) {
                if (isset($payment->subscription_id) && !empty($payment->subscription_id)) {
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => PAYPAL_URL . "v1/billing/subscriptions/$payment->subscription_id",
                        CURLOPT_HTTPGET => 1,
                        CURLOPT_HTTPHEADER => [
                            "Content-Type: application/json",
                            "Authorization: Bearer $accessToken",
                        ],
                        CURLOPT_RETURNTRANSFER => true,
                    ]);

                    $resp = curl_exec($curl);
                    $json = json_decode($resp, true);
                    curl_close($curl);
                    if(isset($json) && !empty($json)) {
                        if(isset($json['status']) && (($json['status'] == 'CANCELLED') || ($json['status'] == 'EXPIRED') || ($json['status'] == 'SUSPENDED'))){
                            DB::table('payments')->where(array('subscription_id' => $payment->subscription_id, 'user_id' => $payment->user_id))->update(['cancel' => 1,'status'=>$json['status']]);
                        }
                    }
                }
            }
        endif;
    }
}
