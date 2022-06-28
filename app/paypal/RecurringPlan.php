<?php

namespace App\paypal;

use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use PayPal\Api\Agreement;
use PayPal\Api\AgreementStateDescriptor;
use PayPal\Api\Currency;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\Patch;
use PayPal\Api\PatchRequest;
use PayPal\Api\Payer;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\Plan;
use PayPal\Common\PayPalModel;

class RecurringPlan extends Paypal
{
    public function MakeRecurringPayment()
    {
        $date = Carbon::now()->addDay(1)->toDateString();
        //create plan
        $createdPlan = $this->MakePlan();

        //get id of created plan
        $createdPlanId = $createdPlan->getId();
        //activate plan
        $this->ActivePlan($createdPlan);
        $getActivatedPlan = Plan::get($createdPlanId, $this->apiContext);
        //create Agreement
        $agreement = $this->CreateAgreement($date, $getActivatedPlan);
        return $agreement->getApprovalLink();
    }

    public function executeRecurringPayment(Request $request)
    {
        //id of plan
        $createdPlan = $this->makePlan();
        $createdPlanId = $createdPlan->getId();
        $planId = $createdPlan->getId();
        $userId = Auth::id();
        $data = DB::table("users")->where("id", $userId)->first();
        if ($data->is_active == "NO") {
            if ($request->has('success') && $request->success == 'true') {
                $token = $request->token;
                $agreement = new Agreement();
                if ($agreement->execute($token, $this->apiContext)) {
                    $updateusers = DB::table("users")->where('id', $userId)->update([
                        'is_active' => 'YES'
                    ]);
                    $insertInTable = DB::table('payments')->insert([
                        'user_id' => Auth::id(),
                        'bank_slip_no' => '',
                        'bank_id' => '',
                        'agreement_id' => $agreement->getId(),
                        'paypal_plan_id' => $planId,
                        'payment_mode' => 'ONLINE',
                        'payment_type' => 'RECURRING',
                        'paid_for' => 'SUBSCRIPTION',
                        'amount_paid' => 59.7,
                        'status' => 'APPROVED',
                        'created_at' => Carbon::now()->toDateTimeString(),
                        'updated_at' => Carbon::now()->toDateString()
                    ]);
                    if ($updateusers && $insertInTable) {
                        echo <<<_HOME
            <a href="/user/dashboard">Return Home</a>
_HOME;

                    } else {
                        echo "something went wrong";
                    }
                } else {
                    echo "payment could not be made";
                };
            }
        } else {
            echo "no need to pay now";
        }
    }

    public function cancelSubscription()
    {
        $getData = DB::table('payments')->where("user_id", Auth::id())->first();
        $agreement_id = $getData->agreement_id;
        $agreement = new Agreement();
        $agreement->setId($agreement_id);
        $agreementStateDescriptor = new AgreementStateDescriptor();
        $agreementStateDescriptor->setNote("Cancel the agreement");
        $cancel = $agreement->cancel($agreementStateDescriptor, $this->apiContext);
        $cancelAgreementDetails = Agreement::get($agreement->getId(), $this->apiContext);
        if ($cancel) {
            $setNull = DB::table('payments')->where('user_id', Auth::id())->update([
                'cancel' => 1
            ]);
            if ($setNull) {
                echo "cancelled successfully";
            } else {
                echo "could not unsubscribed";
            }
        } else {
            echo "could not cancel";
        }
    }

    /**
     * @return Plan
     */
    protected function Plan()
    {
        $plan = new Plan();
        $plan->setName('Dnasbook Monthly Payment')
            ->setDescription('Our monthly fees payment is $59.7(monthly fees $50 and taxes and other fees: $9.7)')
            ->setType('fixed');
        return $plan;
    }

    /**
     * @return PaymentDefinition
     */
    protected function PaymentDefination()
    {
        $paymentDefinition = new PaymentDefinition();
        $paymentDefinition->setName('Monthly Payments')
            ->setType('REGULAR')
            ->setFrequency('Month')
            ->setFrequencyInterval("1")
            ->setCycles("12")
            ->setAmount(new Currency(array('value' => env('RECURRING_PAY'), 'currency' => 'USD')));
        return $paymentDefinition;
    }

    /**
     * @return MerchantPreferences
     */
    protected function MerchantPreferences()
    {
        $merchantPreferences = new MerchantPreferences();
        $baseUrl = URL::to('/');
        $merchantPreferences->setReturnUrl("$baseUrl/subscription/ExecuteRecurringPayment?success=true")
            ->setCancelUrl("$baseUrl/subscription/cancelUrl")
            ->setAutoBillAmount("yes")
            ->setInitialFailAmountAction("CONTINUE")
            ->setMaxFailAttempts("0")
            ->setSetupFee(new Currency(array('value' => env('RECURRING_PAY'), 'currency' => 'USD')));
        return $merchantPreferences;
    }

    /**
     * @param Plan $createdPlan
     */
    protected function ActivePlan(Plan $createdPlan)
    {
        $patch = new Patch();
        $value = new PayPalModel('{
	       "state":"ACTIVE"
	     }');
        $patch->setOp('replace')
            ->setPath('/')
            ->setValue($value);
        $patchRequest = new PatchRequest();
        $patchRequest->addPatch($patch);
        $createdPlan->update($patchRequest, $this->apiContext);
    }

    /**
     * @return Plan
     */
    protected function MakePlan()
    {
        $plan = $this->Plan();
        $paymentDefinition = $this->PaymentDefination();
        $merchantPreferences = $this->MerchantPreferences();
        $plan->setPaymentDefinitions(array($paymentDefinition));
        $plan->setMerchantPreferences($merchantPreferences);
        $createdPlan = $plan->create($this->apiContext);
        return $createdPlan;
    }

    /**
     * @param $date
     * @param Plan $getActivatedPlan
     */
    protected function CreateAgreement($date, Plan $getActivatedPlan)
    {
        $agreement = new Agreement();
        $agreement->setId('I-ATACAMA');
        $agreement->setName('Base Agreement')
            ->setDescription('Basic Agreement')
            ->setStartDate($date . 'T9:45:04Z');
        $plan = new Plan();
        $plan->setId($getActivatedPlan->getId());
        $agreement->setPlan($plan);
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $agreement->setPayer($payer);
        $agreement = $agreement->create($this->apiContext);
        return $agreement;
    }

    public function getAuthToken(){

        $ch = curl_init();
        $clientId = PAYPAL_CLIENT_ID;
        $secret = PAYPAL_CLIENT_SECRET;

        curl_setopt($ch, CURLOPT_URL, PAYPAL_URL."v1/oauth2/token");
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSLVERSION , 6); //NEW ADDITION
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $clientId.":".$secret);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

        $result = curl_exec($ch);

        if(!empty($result)){
            $json = json_decode($result, TRUE);
            define('access_token',$json['access_token']);
        }
        else
        {
            $json['access_token'] = '';
        }

        curl_close($ch);
        //return $json['access_token'];
    }

    protected function makeProduct(){
        $this->getAuthToken();
        $accessToken = access_token;
        $payload = json_encode(
            array(
                "name"=> "Dnasbook Monthly Payment Product",
                "description" => "Our monthly fees payment is ".env('RECURRING_PAY')." (including monthly fees and taxes and other fees.)",
                "type" => "SERVICE",
                "category" => "BUSINESS",
            )
        );
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => PAYPAL_URL."v1/catalogs/products",
            CURLOPT_POST => 1,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "Authorization: Bearer $accessToken"
            ],
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_RETURNTRANSFER => true,
        ]);

        $resp = curl_exec($curl);
        $json = json_decode($resp,true);
        curl_close($curl);

        return $json;
    }

    protected function makeSubscriptionPlan(){
        $product = $this->makeProduct();
        $accessToken = access_token;
        $timestamp = strtotime(date('Y-m-d'));
        $daysRemaining = (int)date('t', $timestamp) - (int)date('j', $timestamp);
        $payload = json_encode(
            array(
                "product_id"=> $product['id'],
                "name"=>"Dnasbook Monthly Payment Plan",
                "description" => "Our monthly fees payment is ".env('RECURRING_PAY')." (including monthly fees and taxes and other fees.)",
                "billing_cycles" => [
                    array(
                        "frequency" => array(
                            "interval_unit" => "DAY",
                            "interval_count" => $daysRemaining
                        ),
                        "tenure_type" => "TRIAL",
                        "sequence"=> 1,
                        "total_cycles"=> 1,
                        "pricing_scheme" => array(
                            "fixed_price" => array(
                                "value" => env('RECURRING_PAY',4),
                                "currency_code" => "USD",
                            ),
                        ),
                    ),
                    array(
                        "frequency" => array(
                            "interval_unit" => "MONTH",
                            "interval_count" => 1
                        ),
                        "tenure_type" => "REGULAR",
                        "sequence"=> 2,
                        "total_cycles"=> 11,
                        "pricing_scheme" => array(
                            "fixed_price" => array(
                                "value" => env('RECURRING_PAY',4),
                                "currency_code" => "USD",
                            ),
                        ),
                    ),
                ],
                "payment_preferences" => array(
                    "auto_bill_outstanding" => TRUE,
                    /*"setup_fee" => array(
                        "value" => "50",
                        "currency_code" => "USD"
                    ),*/
                    //"setup_fee_failure_action" => "CONTINUE",
                    "payment_failure_threshold" => 2,
                )
            )
        );
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => PAYPAL_URL."v1/billing/plans",
            CURLOPT_POST => 1,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "Accept: application/json",
                "Authorization: Bearer " . $accessToken,
                "Prefer: return=representation"
            ],
            CURLOPT_POSTFIELDS => $payload,
        ]);

        $resp = curl_exec($curl);
        $json = json_decode($resp, TRUE);
        curl_close($curl);
        return $json;
    }

    public function makeSubscription(){
        $user = Auth::user();
        $data = DB::table("payments")->where("user_id", $user->id)->orderBy('created_at','desc')->first();
        if(empty($data) || (isset($data) && !empty($data) && $data->cancel == 1)){
            $plan = $this->makeSubscriptionPlan();
            $accessToken = access_token;
            $baseUrl = URL::to('/');

            $payload = json_encode(
                array(
                    "plan_id"=> $plan['id'],
                    //"start_time"=> date("Y-m-d").'T09:45:25Z',
                    "quantity"=> "1",
                    /*"shipping_amount"=>[
                        "currency_code"=> "USD",
                        "value"=> "10.00"
                    ],*/
                    "subscriber"=>[
                        "name"=>[
                            "given_name"=> $user->first_name,
                            "surname"=> $user->last_name
                        ],
                        "email_address"=> $user->email
                    ],
                    "application_context"=> [
                        "brand_name"=> env('APP_NAME','DNAsbook Digital Marketing'),
                        "locale"=> "en-US",
                        //"shipping_preference"=> "SET_PROVIDED_ADDRESS",
                        //"user_action"=> "SUBSCRIBE_NOW",
                        "payment_method"=> [
                            "payer_selected"=> "PAYPAL",
                            "payee_preferred"=> "IMMEDIATE_PAYMENT_REQUIRED"
                        ],
                        "return_url"=> $baseUrl.'/subscription/create-subscription?success=true',
                        "cancel_url"=> $baseUrl."/subscription/cancelUrl"
                    ]
                )
            );

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_URL => PAYPAL_URL."v1/billing/subscriptions",
                CURLOPT_POST => 1,
                CURLOPT_HTTPHEADER => [
                    "Content-Type: application/json",
                    "Accept: application/json",
                    "Authorization: Bearer " . $accessToken,
                    "Prefer: return=representation"
                ],
                CURLOPT_POSTFIELDS => $payload,
            ]);

            $resp = curl_exec($curl);

            $json = json_decode($resp, TRUE);
            curl_close($curl);

            $link = '';

            if(isset($json) && !empty($json)){
                $link = (isset($json['links'][0]['href']) && !empty($json['links'][0]['href'])) ? $json['links'][0]['href'] : $baseUrl;
            }

            return $link;
        }
        else{
            return url('/online-payment/addnew1');
        }

    }

    public function createSubscription(Request $request){
        $this->getAuthToken();
        $userId = Auth::id();
        $accessToken = access_token;
        $subscription_id = $request->subscription_id;
        $token = $request->token;
        $ba_token = $request->ba_token;
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => PAYPAL_URL."v1/billing/subscriptions/$subscription_id",
            CURLOPT_HTTPGET => 1,
            CURLOPT_HTTPHEADER => [
                "Accept: application/json",
                "Authorization: Bearer " . $accessToken,
            ],
        ]);

        $resp = curl_exec($curl);

        $resp = json_decode($resp, TRUE);
        if(isset($resp) && !empty($resp)){
            $status = $startAt = $endAt = '';
            if($resp['status'] == 'ACTIVE'){
                //$data = DB::table("users")->where("id", $userId)->first();
                //if ($data->is_active == "NO") {
                //}
                /*else {
                    return array("success",trans("no need to pay now"));
                }*/
                $status = 'APPROVED';
                $startAt = Carbon::now()->toDateString(); //today
                $endAt = new Carbon('first day of next month');
                $total_cycle = 1;
            }
            else if($resp['status'] == 'APPROVAL_PENDING'){
                $status = 'PENDING';
                $startAt = NULL;
                $endAt = NULL;
                $total_cycle = 0;
            }
            $updateusers = DB::table("users")->where('id', $userId)->update([
                'is_active' => 'YES',
                'ban_date' => NULL,
                'ban' => 'NO'
            ]);

            $insertInTable = DB::table('payments')->insert([
                'user_id' => Auth::id(),
                'bank_slip_no' => '',
                'bank_id' => '',
                'order_id'=> '',
                //'agreement_id' => '',
                'paypal_plan_id' => $resp['plan_id'],
                'billing_token' => $ba_token,
                'subscription_id' => $subscription_id,
                'facilitator_access_token'=>$token,
                'payment_mode' => 'ONLINE',
                'payment_type' => 'RECURRING',
                'paid_for' => 'SUBSCRIPTION',
                'amount_paid' => env('RECURRING_PAY',4),
                'status' => $status,
                'startAt' =>$startAt,
                'endAt' => $endAt,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateString(),
                'total_cycle' => $total_cycle
            ]);
            if ($updateusers && $insertInTable) {
                return array("success",trans("You have subscribe successfully"));

            } else {
                return array("error",trans("something went wrong"));
            }
        }
        else {
            return array("error",trans("payment could not be made"));
        }

    }

    public function cancelSubscriptionFlow()
    {
        $getData = DB::table('payments')->where("user_id", Auth::id())->where('cancel',0)->first();
        $subscription_id = $getData->subscription_id;
        $this->getAuthToken();
        $accessToken = access_token;
        $payload = json_encode(array("reason"=>"Not satisfied with the service"));

        $curl = curl_init();
        curl_setopt_array($curl, [
            //CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => PAYPAL_URL."v1/billing/subscriptions/$subscription_id/cancel",
            CURLOPT_POST => 1,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "Authorization: Bearer " . $accessToken,
            ],
            //CURLOPT_NOBODY => true,
            //CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => $payload,
        ]);

        curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);
        curl_close($curl);
        if ($status == 204) {
            $setNull = DB::table('payments')->where('user_id', Auth::id())->update([
                'cancel' => 1
            ]);
            $updateusers = DB::table("users")->where('id', Auth::id())->update([
                'is_active' => 'YES',
                'ban_date' => Carbon::now()->addMonth(2),
                'ban' => 'NO'
            ]);
            if ($setNull) {
                echo "cancelled successfully";
            }
            else {
                echo "could not unsubscribed";
            }
        }
        else {
            echo "could not cancel";
        }
    }
}
