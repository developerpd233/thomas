<?php

namespace App\Http\Controllers\paypal;


use App\paypal\Checkout;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PayPal\Api\Payment;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpFoundation\Cookie;

class OneTimePaymentController extends Controller
{
    public function makeOneTimePayment(Request $request)
    {
        if($request->has('id')) {
            $id = $request->get('id');
        } else {
            if (env('SITE') == 'ENG') {
                $id = 2;
            } else {
                $id = 345;
            }
        }
        $type = "direct";
        if($request->has('type'))
            $type = $request->get('type');
        if(!empty($id)) {
            $payment = new Checkout();
            $approved_url = $payment->oneTimePayment($id, $type);
            return redirect($approved_url);
        } else {
            return redirect()->back();
        }
    }

    public function ExecuteOneTimePayment(Request $request)
    {
        
        // if (env('SITE') == 'ENG') {
        //     $id = 2;
        // } else {
        //     $id = 345;
        // }
        $id = $request->get('afid');
        $type = $request->get('wtype');
        $payment = new Checkout();
        $resultArr = $payment->executePayment($request);
        if ($resultArr['result']) {
            unset($resultArr['result']);
            session()->put('token', $resultArr['token']);
            setcookie('token',$resultArr['token'],time()+60*60*72);
            $insertInTable = DB::table('training_video_payment')->insert([
                $resultArr
            ]);
            if ($insertInTable) {
                Session::put('PaymentSuccess', "Successfully Payment occurs");
                if($type == 'direct')
                    return redirect('pages/dnasbook-distributor-payment?id=' . $id);
                else if($type == 'webinar') {
                    if (\App::getLocale() == 'en') {
                        return redirect('pages/webinars-payments?id=' . $id);
                    } else {
                        return redirect('pages/paiements-pour-les-webinars?id=' . $id);
                    }
                }
                
            }
        }
    }

    public function createPaypalChargebyBtn(){
        $formData = Input::all();
        $user = Auth::user();
        $userID = (!empty($user->id)) ? $user->id : "";
        $formData['callback'] = '';

        if(!empty($userID)):
            $secretKey = md5(uniqid(uniqid(uniqid())));
            //$startAt = Carbon::now()->toDateString(); //today
            //$endAt = new Carbon('first day of next month');
            $updVal = array(
                'userId' => $userID,
                'order_id'=>$formData['data']['orderID'],
                'payer_id'=>$formData['data']['payerID'],
                'token'=>$secretKey,
                'isTokenUsed'=>'no',
                'event' => $formData['paypalDetails']['intent'],
                'status' => $formData['paypalDetails']['status'],
                'amount' => env('RECURRING_PAY'),
                'startAt'=>NULL,
                'endAt'=>NULL,
                'create_date' => date('Y-m-d h:i:s'),
                'update_date' => date('Y-m-d h:i:s')
            );

            $insId = DB::table('payment_paypal')->insertGetId($updVal);

            $updVal1 = array("updated_at"=>date('Y-m-d H:i:s'),'is_active'=>'YES','ban'=>'NO','ban_date'=>NULL);
            $res = DB::table('users')->where("id",$userID)->update($updVal1);

            echo $formData['callback'] . '(' . "{ 'inserted' : '$insId', 'PaypalOfflinePayToken' : '$secretKey' }" . ')';
            exit;

        endif;

        //echo $formData['callback'] . '(' . "{ 'inserted' : '', 'btcAccessToken' : '' }" . ')';
        //exit;
    }

    public function checkOneTimePayment(){
        $bThisMonth = DB::table('payment_paypal')
            ->where('endAt', Carbon::now()->toDateString())
            ->where('isTokenUsed', 'yes')
            ->get()->toArray();

        if(isset($bThisMonth) && !empty($bThisMonth)){
            foreach ($bThisMonth as $paypalUser => $val){
                $notUsedToken = DB::table('payment_paypal')
                    ->where(array('endAt'=> null,'startAt'=>null,'isTokenUsed'=>'no','userId'=>$val->userId))->first();
                $banDate = new Carbon('first day of third month');
                if(isset($notUsedToken) && !empty($notUsedToken)){
                    $startAt = new Carbon('first day of this month');
                    $endAt = new Carbon('last day of this month');
                    $updVal = array( "startAt"=>$startAt, "endAt"=>$endAt, "isTokenUsed"=>"yes" );
                    $res = DB::table('payment_paypal')->where("id",$notUsedToken->id)->update($updVal);

                    $updVal1 = array( "is_active"=>"YES", "updated_at"=>date('Y-m-d H:i:s'),'ban'=>'NO' );
                    $res = DB::table('users')->where("id",$notUsedToken)->update($updVal1);
                }
                else{
                    //DB::table('users')->where(array('id' => $val->userId))->update(['updated_at'=>Carbon::now()->toDateString(),'ban_date'=>$banDate,'is_active'=>'NO']);
                }
            }
        }
    }

    public function makeOneTimePaypalPayment(){
        $payment = new Checkout();
        Session::put('url',url()->previous());
        Session::save();
        $approved_url = $payment->oneTimePaypalPayment();
        return redirect($approved_url);
    }


    public function ExecuteOneTimePaypalPayment(Request $request)
    {
        if (env('SITE') == 'ENG') {
            $id = 2;
        } else {
            $id = 345;
        }
        $payment = new Checkout();
        $resultArr = $payment->executePaypalPayment($request);
        //dd($resultArr);
        if ($resultArr['result']) {
            unset($resultArr['result']);
            session()->put('token', $resultArr['token']);
            setcookie('token',$resultArr['token'],time()+60*60*72);
            $user = Auth::user();
            $userID = (!empty($user->id)) ? $user->id : "";
            $formData['callback'] = '';

            if(!empty($userID)):
                $secretKey = md5(uniqid(uniqid(uniqid())));
                //$startAt = Carbon::now()->toDateString(); //today
                //$endAt = new Carbon('first day of next month');
                $updVal = array(
                    'userId' => $userID,
                    //'order_id'=>$resultArr['data']['orderID'],
                    'payer_id'=>$resultArr['PayerId'],
                    'paymentID'=>$resultArr['paymentID'],
                    'token'=>$secretKey,
                    'isTokenUsed'=>'no',
                    //'event' => $formData['paypalDetails']['intent'],
                    //'status' => $formData['paypalDetails']['status'],
                    'amount' => env('RECURRING_PAY'),
                    'startAt'=>NULL,
                    'endAt'=>NULL,
                    'create_date' => date('Y-m-d h:i:s'),
                    'update_date' => date('Y-m-d h:i:s')
                );

                $insId = DB::table('payment_paypal')->insertGetId($updVal);

                $updVal1 = array("updated_at"=>date('Y-m-d H:i:s'),'is_active'=>'YES','ban'=>'NO','ban_date'=>NULL);
                $res = DB::table('users')->where("id",$userID)->update($updVal1);

                //echo $formData['callback'] . '(' . "{ 'inserted' : '$insId', 'PaypalOfflinePayToken' : '$secretKey' }" . ')';
                //exit;

            endif;
            if ($insId) {
                Session::put('PaymentSuccess', "Successfully Payment occurs");
            }

        }
        $url = Session::get('url');
        return redirect($url);
    }
}
