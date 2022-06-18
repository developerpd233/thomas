<?php

namespace App\Http\Controllers\btc;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Cookie;

use CoinbaseCommerce\Webhook;

class BtcOneTimePaymentController extends Controller {
    
    var $apiKey = "09df0b30-2d8d-4cef-ab80-ba55373bb885"; 
    
    function __construct(){
        $this->btc_model = new \App\Btc;
    }
    
    public function makeOneTimePayment() {        
        
        if(session()->has('btcPaymentAddress')):
            $s = session()->get('btcPaymentAddress');
            Session::put('btcPaymentAddress', $s);
        else:
            $resp = $this->btc_model->addTrainingVideoPaymentByBtc();        
            if( count($resp) > 0):   
                Session::put('btcPaymentAddress', $resp['address']);
                Session::put('btcAccessToken', $resp['token']);
               $data['address'] = $resp;
            else:
                $data['address'] = "";
            endif;
        endif;
        
        //new page
        $data['pagename'] = 'Pay BTC';
        return view('regpage.dnasbook-btc-payment', compact('data')); 
        
    }
    
    public function callBackForBtcPayment(){
        
        $formData = Input::all();
        
        if( !empty($formData['invoice_id']) && !empty($formData['confirmations']) ):
            
            $transction_id = (!empty($formData['invoice_id'])) ? $formData['invoice_id'] : ""; 
            $confirmations = (!empty($formData['confirmations'])) ? $formData['confirmations'] : "";
            $address = (!empty($formData['address'])) ? $formData['address'] : "";

            $transaction_hash = (!empty($formData['hash'])) ? $formData['hash'] : "";
            $value_in_usd = (!empty($formData['value'])) ? $formData['value'] : "";
            $secret = (!empty($formData['secret'])) ? $formData['secret'] : "";        
            $height = (!empty($formData['height'])) ? $formData['height'] : "";
            $timestamp = (!empty($formData['timestamp'])) ? $formData['timestamp'] : "";
            $size = (!empty($formData['size'])) ? $formData['size'] : "";

            $resp = $this->btc_model->checkTransctionId($transction_id, $address);

            if($resp[0]['id'] == $transction_id):
                if( $confirmations <= 5 && !empty($transction_id)):    
                    $updVal = array("confirmations"=>$confirmations);                
                    $res = DB::table('training_video_payment')->where("id",$transction_id)->update($updVal);
                    echo $confirmations;
                elseif($confirmations == 6 && !empty($transction_id)):    
                    $updVal = array(
                        "expiry_time"=>time() + 60 * 60 * 72,
                        "is_expired"=>'NO',
                        "confirmations"=>$confirmations,
                        "transaction_hash"=>$transaction_hash,
                        "get_ammount"=>$value_in_usd,
                        "secret"=>$secret,
                        "height"=>$height,
                        "res_timestamp"=>$timestamp,
                        "block_size"=>$size                    
                    );
                    $res = DB::table('training_video_payment')->where("id",$transction_id)->update($updVal);
                    echo "*ok*";
                endif;
            endif;
        else:    
            echo "*failed*";
        endif;
        
    }
        
    public function callBackForOfflineBtcPayment(){
        
        $formData = Input::all();
        
        //https://www.dnasbookdigimarket.com/offcallback?invoice_id=1&secret=a046b686908fefb3789597ad382c4e95&confirmations=6&hash=18A1fNEPyXYWVJzrBA2iRis3FakJZTftf9&value=50&secret=0d5c870d11ab860bc27693eff4170ff0&height=223&timestamp=2021-03-25:10:10:10&size=22556
        
        if( !empty($formData['invoice_id']) && !empty($formData['confirmations']) ):
            
            $transction_id = (!empty($formData['invoice_id'])) ? $formData['invoice_id'] : ""; 
            $confirmations = (!empty($formData['confirmations'])) ? $formData['confirmations'] : "";
            $address = (!empty($formData['address'])) ? $formData['address'] : "";

            $transaction_hash = (!empty($formData['hash'])) ? $formData['hash'] : "";
            $value_in_usd = (!empty($formData['value'])) ? $formData['value'] : "";
            $secret = (!empty($formData['secret'])) ? $formData['secret'] : "";        
            $height = (!empty($formData['height'])) ? $formData['height'] : "";
            $timestamp = (!empty($formData['timestamp'])) ? $formData['timestamp'] : "";
            $size = (!empty($formData['size'])) ? $formData['size'] : "";

            $resp = $this->btc_model->checkOfflineTransctionId($transction_id);

            if($resp[0]['id'] == $transction_id):
                if( $confirmations <= 5 && !empty($transction_id)):    
                    $updVal = array("confirmations"=>$confirmations);                
                    $res = DB::table('payments_btc')->where("id",$transction_id)->update($updVal);
                    echo $confirmations;
                elseif($confirmations == 6 && !empty($transction_id)):  
                    
                    $startAt = new Carbon('first day of next month');                                
                    $endAt = new Carbon('last day of next month');                    
                    $updVal = array(
                        "confirmations"=>$confirmations,
                        "transaction_hash"=>$transaction_hash,
                        "get_ammount"=>$value_in_usd,
                        "secret"=>$secret,
                        "height"=>$height,
                        "res_timestamp"=>$timestamp,
                        "block_size"=>$size,
                        "startAt"=>$startAt,
                        "endAt"=>$endAt
                    );
                    
                    $res = DB::table('payments_btc')->where("id",$transction_id)->update($updVal);
                    echo "*ok*";
                    
                endif;
            endif;
            
        else:    
            echo "*failed*";
        endif;
        
    }
    public function banPaymentByBtcUsers(){               
          
        //Block User By BTC payment
        $bThisMonth = DB::table('payments_btc')
            ->where('endAt', Carbon::now()->toDateString())
            ->where('isUsed', 'no')    
            ->get();
        $userIDb = array();
        $tid = array();
        foreach ($bThisMonth as $payment) {
            array_push($userIDb, $payment->userId);
            array_push($tid, $payment->id);
        } 
        foreach ($userIDb as $user) {
            //DB::table('users')->where('id', $user)->update(['is_active'=>'NO', 'ban_date'=>date('Y-m-d')]);            
            DB::table('users')->where('id', $user)->update(['is_active'=>'NO']);            
        }
        foreach ($tid as $t) {
            DB::table('payments_btc')->where('id', $t)->update(['isUsed'=>'yes']);
        }        
        echo '*OK*';        
    }
    
    /* COINBASE */
    public function createBtcChargeByBtn(){
        
        $formData = Input::all();    
        
        $event = isset($formData['event']) ? $formData['event'] : '';
        $buttonId = isset($formData['buttonId']) ? $formData['buttonId'] : '';
        $code = isset($formData['code']) ? $formData['code'] : '';        
        $arr = array( "buttonId"=>$buttonId, "event"=>$event, "code"=>$code,'status'=>NULL, 'confirmations'=>0, "createdAt"=>date('Y-m-d h:i:s') );
        
        $tvcID = DB::table('training_video_payment_by_coinbase')->insertGetId($arr);  
        $res = "";
        
        if($event == "payment_detected"):
            
            $secretKey = md5(uniqid(uniqid(uniqid())));        
            $updVal = array('cbID'=>0, 'PayerId' => "", 'paymentID' => "", 'amount' => env('ONETIME_PAY'), 'token' => $secretKey, 
                        'created_at' => date('Y-m-d h:i:s'),
                        'expiry_time'=>NULL, 'started_at'=>NULL, 'is_expired'=>'YES',
                        'address'=>$secretKey,'callback'=>$secretKey
            );
            
            $insId = DB::table('training_video_payment')->insertGetId($updVal);
            
            if($insId > 0):
                $updVal = array("vId"=>$insId);                
                DB::table('training_video_payment_by_coinbase')->where("id",$tvcID)->update($updVal);
                Session::put('btcAccessToken', $secretKey);
                $res = $secretKey;
                //$res = array('btcAccessToken'=>$secretKey);                
            endif;
            
        endif;
        
        echo $formData['callback'] . '(' . "{'btcAccessToken' : '$res'}" . ')';
        exit;
       
        
    }
    /* Confirms payments by charges */
    public function showCharge(){
        
        //$qry = "select * from `training_video_payment_by_coinbase` as tv where tv.`event`='payment_detected' AND tv.`vId`='0'";
        $qry = "select * from `training_video_payment_by_coinbase` as tv where tv.`event`='payment_detected' "; 
        $info = DB::select($qry);
        $chargeRes = collect($info)->map(function($x) { return (array) $x;  })->toArray();
        
        foreach($chargeRes as $row):
           
            $ID = (!empty($row['ID'])) ? $row['ID'] : "";
            $code = (!empty($row['code'])) ? $row['code'] : "";
            $vId = (!empty($row['vId'])) ? $row['vId'] : "";  
            
            if(!empty($code)):
                
                $curl = curl_init();
                curl_setopt_array($curl, 
                    array(
                        CURLOPT_URL => "https://api.commerce.coinbase.com/charges/$code",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 30,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "GET",
                            CURLOPT_HTTPHEADER => array(
                                "X-CC-Api-Key: $this->apiKey",
                                "X-CC-Version: 2018-03-22",                        
                            ),
                        )
                );
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
                $response = json_decode($response, TRUE);
                $payments = $response['data']['payments'];
                
                if( !empty($payments) ):
                    
                    $confirmations = (!empty($payments[0]['block']['confirmations'])) ? $payments[0]['block']['confirmations'] : "";
                    $transaction_id = (!empty($payments[0]['transaction_id'])) ? $payments[0]['transaction_id'] : "";
                    $status = (!empty($payments[0]['status'])) ? $payments[0]['status'] : "";
                    $detected_at = (!empty($payments[0]['detected_at'])) ? $payments[0]['detected_at'] : "";                    
                    $hash = (!empty($payments[0]['block']['hash'])) ? $payments[0]['block']['hash'] : "";
                    $height = (!empty($payments[0]['block']['height'])) ? $payments[0]['block']['height'] : "";
                    $get_ammount = (!empty($payments[0]['value']['crypto']['amount'])) ? $payments[0]['value']['crypto']['amount'] : "";
                    
                    if($confirmations == 1):
                        
                        $updVal = array("transaction_id"=>$transaction_id, "status"=>$status, "confirmations"=>$confirmations, );                
                        $responseDB = DB::table('training_video_payment_by_coinbase')->where("id",$ID)->update($updVal);
                        
                        echo $confirmations;
                        
                    elseif($confirmations >= 6):
                        
                        $qry = "select tv.`cbID` from `training_video_payment` as tv where tv.`cbID`='$ID'";
                        $info = DB::select($qry);
                        $cRes = collect($info)->map(function($x) { return (array) $x;  })->toArray();
                        $cbID = (!empty($cRes[0]['cbID'])) ? $cRes[0]['cbID'] : "";  
                        
                        if($cbID == $ID):
                            echo 'Already registered->'.$ID;                        
                        else:  
                            
                            $updVal = array( "transaction_id"=>$transaction_id, "status"=>$status, "confirmations"=>$confirmations );                
                            $responseDB = DB::table('training_video_payment_by_coinbase')->where("id",$ID)->update($updVal);
                            
                            $updVal = [
                                'cbID'=>$ID,
                                'PayerId' => "",'paymentID' => "", 'amount' => env('ONETIME_PAY'), 'created_at' => date('Y-m-d h:i:s'),
                                'expiry_time'=>time() + 60 * 60 * 72, 'started_at'=>NULL, 'is_expired'=>'NO', 'confirmations'=>$confirmations, 'secret'=>NULL, 
                                'transaction_hash'=>$hash, 'get_ammount'=>$get_ammount, 'height'=>$height, 'res_timestamp'=>$detected_at, "block_size"=>$height
                            ];

                            //$insId = DB::table('training_video_payment')->insertGetId($updVal);
                            DB::table('training_video_payment')->where("id",$vId)->update($updVal);
                            echo '*OK*';
                            
                        endif;
                        
                    endif;
                    
                endif;
                
            endif;        
            
        endforeach;
        exit;
    }
    
    //Generate BTC Payment For Offline -> BEFORE EXPIRE
    public function generateBtcPaymentForOffline(){
        
        $formData = Input::all();
        $event = isset($formData['event']) ? $formData['event'] : '';
        $buttonId = isset($formData['buttonId']) ? $formData['buttonId'] : '';
        $code = isset($formData['code']) ? $formData['code'] : '';        
        
        $user = Auth::user();
        $userID = (!empty($user->id)) ? $user->id : "";
        
        if(!empty($userID)):
            
            $secretKey = md5(uniqid(uniqid(uniqid())));
            $updVal = array(
                    'userId' => $userID,
                    'subsctiption_expiry_type'=>'offline',
                    'token'=>$secretKey,
                    'buttonId' => $buttonId,
                    'code' => $code,
                    'event' => $event, 
                    'status' => "",
                    'amount' => env('RECURRING_PAY'),
                    'address' => "",
                    'tindex' => "",
                    "callback"=>"",
                    'secret_b_conformaitons' => $secretKey,
                    'confirmations'=>0,
                    'transaction_hash'=>'',
                    'get_ammount'=>0,
                    'secret'=>'',
                    'height'=>'',
                    'res_timestamp'=>'',
                    'block_size'=>'',
                    'startAt'=>null,
                    'endAt'=>null,
                    'createdAt' => date('Y-m-d h:i:s')                
            );
            
            $insId = DB::table('payments_btc')->insertGetId($updVal);
            
            echo $formData['callback'] . '(' . "{ 'inserted' : '$insId', 'btcAccessToken' : '$secretKey' }" . ')';
            exit;
            
        endif;
        
        echo $formData['callback'] . '(' . "{'inserted' : '', 'btcAccessToken' : '' }" . ')';
        exit;
        
    }
    
    public function submitBitcoinToken(){        
        //new page
        $data['pagename'] = 'Pay BTC';
        return view('regpage.dnasbook-btc-payment', compact('data'));        
    }
    
    public function verifyBitcoinToken(){
        
        $formData = Input::all();
        $videocode = isset($formData['videocode']) ? $formData['videocode'] : '';   
        $success = "Your payment received successfully.";
        $error = "Payment confirmation is pending for your bitcoin transaction. Please keep your token safe and try again after some time.";
        
        $qry = "select * from `payments_btc` as pb where pb.`event`='payment_detected' AND pb.`isUsed`='no' AND pb.`token`='".$videocode."' AND pb.`confirmations`>5 ";
        $info = DB::select($qry);
        $res = collect($info)->map(function($x) { return (array) $x;  })->toArray();
        
        //Response
        if( !empty($res) ):
            
            //isTokenUsed
            if( $res[0]['isTokenUsed'] == 'no' ) :
            
                $subsctiption_expiry_type = (!empty($res[0]['subsctiption_expiry_type'])) ? $res[0]['subsctiption_expiry_type'] : "" ;
                $ID = (!empty($res[0]['id'])) ? $res[0]['id'] : "" ;
                $userId = (!empty($res[0]['userId'])) ? $res[0]['userId'] : "" ;

                $qry = "select `id`, `is_active`, `ban`, `ban_date`, datediff(now(),`updated_at`) as `block_days` from `users` as u where u.`id`='$userId' ";
                $info = DB::select($qry);
                $response = collect($info)->map(function($x) { return (array) $x;  })->toArray();
                
                //user response
                if(!empty($response) ):

                    $is_active = (!empty($response[0]['is_active'])) ? $response[0]['is_active'] : "" ;
                    $ban = (!empty($response[0]['ban'])) ? $response[0]['ban'] : "" ;
                    $ban_date = (!empty($response[0]['ban_date'])) ? $response[0]['ban_date'] : "" ;
                    $blockDays = (!empty($response[0]['block_days'])) ? $response[0]['block_days'] : "" ;

                    if($is_active == "YES"):

                        $startAt = new Carbon('first day of next month');                                
                        $endAt = new Carbon('last day of next month');

                        //update
                        $updVal = array( "startAt"=>$startAt, "endAt"=>$endAt, "isTokenUsed"=>"yes" );
                        $res = DB::table('payments_btc')->where("id",$ID)->update($updVal);

                        //active user
                        $updVal = array( "is_active"=>"YES", "updated_at"=>date('Y-m-d H:i:s') );
                        $res = DB::table('users')->where("id",$userId)->update($updVal);

                    elseif($is_active == "NO" && $blockDays <= 60):

                        $startAt = Carbon::now()->toDateString(); //today
                        $endAt = Carbon::now()->addDays(30); //after 30 days

                        //update
                        $updVal = array( "startAt"=>$startAt, "endAt"=>$endAt, "isTokenUsed"=>"yes" );
                        $res = DB::table('payments_btc')->where("id",$ID)->update($updVal);

                        //active user
                        $updVal = array( "is_active"=>"YES", "updated_at"=>date('Y-m-d H:i:s') );
                        $res = DB::table('users')->where("id",$userId)->update($updVal);

                    elseif($is_active == "NO" && $blockDays >= 60):

                        $startAt = Carbon::now()->toDateString(); //today
                        $endAt = Carbon::now()->addDays(30); //after 30 days

                        //update
                        $updVal = array( "startAt"=>$startAt, "endAt"=>$endAt, "isTokenUsed"=>"yes" );
                        $res = DB::table('payments_btc')->where("id",$ID)->update($updVal);

                        //ban user
                        $updVal = array( "ban"=>"YES", "ban_date"=>date('Y-m-d') );
                        $res = DB::table('users')->where("id",$userId)->update($updVal);       

                        return redirect('ban');  

                    endif;

                    if($res):
                        return redirect('submit-bitcoin-tokens')->with('success', ' '.$success);  
                    else:
                        return redirect('submit-bitcoin-tokens')->with('error', ' Payment confirmation is pending for your bitcoin transaction. Please keep your token safe and try again after some time!');  
                    endif;
                //user response    
                else:
                    return redirect('submit-bitcoin-tokens')->with('error', ' '.$error);  
                endif;
            //isTokenUsed    
            else:
                return redirect('submit-bitcoin-tokens')->with('success', ' Your token has already activated.');  
            endif;    
        //Response   
        else:
            return redirect('submit-bitcoin-tokens')->with('error', ' '.$error);  
        endif;
        
        //new page
        $data['pagename'] = 'Verify Btc Token';
        
        return view('regpage.dnasbook-btc-payment', compact('data'));        
        
    }

    //Generate BTC Payment For Offline -> AFTER EXPIRE
    public function generateBtcPaymentForOfflineAfterExpire(){
        
        $formData = Input::all();
        $event = isset($formData['event']) ? $formData['event'] : '';
        $buttonId = isset($formData['buttonId']) ? $formData['buttonId'] : '';
        $code = isset($formData['code']) ? $formData['code'] : '';        
        
        $user = Auth::user();
        $userID = (!empty($user->id)) ? $user->id : "";
        
        if(!empty($userID)):
            
            $secretKey = md5(uniqid(uniqid(uniqid())));
            
            $updVal = array(
                    'userId' => $userID,
                    'subsctiption_expiry_type'=>'online',
                    'token'=>$secretKey,
                    'isTokenUsed'=>'no',
                    'buttonId' => $buttonId,
                    'code' => $code,
                    'event' => $event, 
                    'status' => "",
                    'amount' => env('RECURRING_PAY'),
                    'address' => "",
                    'tindex' => "",
                    "callback"=>"",
                    'secret_b_conformaitons' => $secretKey,
                    'confirmations'=>0,
                    'transaction_hash'=>'',
                    'get_ammount'=>0,
                    'secret'=>'',
                    'height'=>'',
                    'res_timestamp'=>'',
                    'block_size'=>'',
                    'startAt'=>null,
                    'endAt'=>null,
                    'createdAt' => date('Y-m-d h:i:s')                
            );
            
            $insId = DB::table('payments_btc')->insertGetId($updVal);
            
            echo $formData['callback'] . '(' . "{ 'inserted' : '$insId', 'btcAccessToken' : '$secretKey' }" . ')';
            exit;
            
        endif;
        
        echo $formData['callback'] . '(' . "{ 'inserted' : '', 'btcAccessToken' : '' }" . ')';
        exit;
        
    }
    
    
    /* confirm charges for online/offline payments */
    public function confirmChargeOfOfflineBtcPayment(){
            
        $qry = "select * from `payments_btc` as pb where pb.`event`='payment_detected' AND pb.`isUsed`='no'";
        $info = DB::select($qry);
        $chargeRes = collect($info)->map(function($x) { return (array) $x;  })->toArray();
       
        foreach($chargeRes as $row):
            
            $ID = (!empty($row['id'])) ? $row['id'] : "";
            $code = (!empty($row['code'])) ? $row['code'] : "";
        
            if(!empty($code)):
                
                $curl = curl_init();
                curl_setopt_array($curl, 
                    array(
                        CURLOPT_URL => "https://api.commerce.coinbase.com/charges/$code",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 30,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "GET",
                            CURLOPT_HTTPHEADER => array(
                                "X-CC-Api-Key: $this->apiKey",
                                "X-CC-Version: 2018-03-22",                        
                            ),
                        )
                );
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
                $response = json_decode($response, TRUE);
                
                $payments = $response['data']['payments'];
                $addresses = $response['data']['addresses'];
                
                if( !empty($payments) ):
                    
                    $address = (!empty($addresses['bitcoin'])) ? $addresses['bitcoin'] : "";
                    $confirmations = (!empty($payments[0]['block']['confirmations'])) ? $payments[0]['block']['confirmations'] : "";
                    $transaction_id = (!empty($payments[0]['transaction_id'])) ? $payments[0]['transaction_id'] : "";
                    $status = (!empty($payments[0]['status'])) ? $payments[0]['status'] : "";
                    $detected_at = (!empty($payments[0]['detected_at'])) ? $payments[0]['detected_at'] : "";                    
                    $hash = (!empty($payments[0]['block']['hash'])) ? $payments[0]['block']['hash'] : "";
                    $height = (!empty($payments[0]['block']['height'])) ? $payments[0]['block']['height'] : "";
                    $get_ammount = (!empty($payments[0]['value']['crypto']['amount'])) ? $payments[0]['value']['crypto']['amount'] : "";
                    
                    if($confirmations == 1):
                        
                        $updVal = array("transaction_id"=>$transaction_id, "status"=>$status, "confirmations"=>$confirmations, );                
                        $responseDB = DB::table('payments_btc')->where("id",$ID)->update($updVal);
                        
                        echo $confirmations;
                        
                    elseif($confirmations >= 6):                        
                        
                        $qry = "select * from `payments_btc` as pb where pb.`id`='$ID' AND pb.`startAt` IS NULL AND pb.`endAt` IS NULL ";
                        $info = DB::select($qry);
                        $res = collect($info)->map(function($x) { return (array) $x;  })->toArray();
                        
                        if(!empty($res)):
                            /*
                            $subsctiption_expiry_type = (!empty($res[0]['subsctiption_expiry_type'])) ? $res[0]['subsctiption_expiry_type'] : "" ;
                        
                            if($subsctiption_expiry_type == "offline"):
                                $startAt = new Carbon('first day of next month');                                
                                $endAt = new Carbon('last day of next month');                             
                            else:
                                $startAt = Carbon::now()->toDateString(); //today
                                $endAt = Carbon::now()->addDays(30); //after 30 days
                            endif;        
                            */
                            $updVal = array(
                                "confirmations"=>$confirmations,
                                "transaction_hash"=>$hash,
                                "get_ammount"=>$get_ammount,
                                "secret"=>"",
                                "height"=>$height,
                                "res_timestamp"=>$detected_at,
                                "block_size"=>$height,
                                "startAt"=>null,
                                "endAt"=>null
                            );

                            $res = DB::table('payments_btc')->where("id",$ID)->update($updVal);
                            echo "*ok*";
                        endif;
                        
                    endif;
                    
                endif;
                
            endif;        
            
        endforeach;
            
    }
    /* COINBASE live api end */
    
    /*
    public function btcwebhook(){
       
        $secret = 'b9f30ce9-80b2-41b9-851c-781b0a6c7420';
        $headerName = 'X-Cc-Webhook-Signature';
        $headers = getallheaders();
        $signraturHeader = isset($headers[$headerName]) ? $headers[$headerName] : null;
        
        $payload = trim(file_get_contents('php://input'));
        
        try {
            $event = Webhook::buildEvent($payload, $signraturHeader, $secret);
            http_response_code(200);
            echo sprintf('Successully verified event with id %s and type %s.', $event->id, $event->type);
        } catch (\Exception $exception) {
            http_response_code(400);
            echo 'Error occured. ' . $exception->getMessage();
        }
        
    }
    
    public function btcwebhookWithPost(){
       
        $secret = 'b9f30ce9-80b2-41b9-851c-781b0a6c7420';
        $headerName = 'X-Cc-Webhook-Signature';
        $headers = getallheaders();
        $signraturHeader = isset($headers[$headerName]) ? $headers[$headerName] : null;
        
        $payload = trim(file_get_contents('php://input'));
        
        try {
            $event = Webhook::buildEvent($payload, $signraturHeader, $secret);
            http_response_code(200);
            echo sprintf('Successully verified event with id %s and type %s.', $event->id, $event->type);
        } catch (\Exception $exception) {
            http_response_code(400);
            echo 'Error occured. ' . $exception->getMessage();
        }
        
    }
    
    public function crateCharge(){
        
        $curl = curl_init();
        $postFilds=array(
            'name' => 'Siddharth Rathod',
            'description' => 'Testing for checkout api',
            'pricing_type' => 'fixed_price',
            'local_price' => [
                'amount' => '100.00',
                'currency' => 'USD'
            ],
            'requested_info' => ['Siddharth', 'web91.sidddharth@gmail.com'],
            'metadata' => ['userId'=>10]
        );
        $postFilds=urldecode(http_build_query($postFilds));
        curl_setopt_array($curl, 
            array(
                CURLOPT_URL => "https://api.commerce.coinbase.com/charges",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => $postFilds,
                    CURLOPT_HTTPHEADER => array(
                        "X-CC-Api-Key: $this->apiKey",
                        "X-CC-Version: 2018-03-22",
                        "content-type: multipart/form-data"
                    ),
                )
        );
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $response = json_decode($response, TRUE);

        echo '<pre>';
        print_r($response);
        die;
        
    }
    
    public function listCharge(){
        $curl = curl_init();
        curl_setopt_array($curl, 
            array(
                CURLOPT_URL => "https://api.commerce.coinbase.com/charges",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_HTTPHEADER => array(
                        "X-CC-Api-Key: $this->apiKey",
                        "X-CC-Version: 2018-03-22",                        
                    ),
                )
        );
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $response = json_decode($response, TRUE);

        echo '<pre>';
        print_r($response);
        die;
        
    }
    
    
    public function listEvents(){
        $curl = curl_init();
        curl_setopt_array($curl, 
            array(
                CURLOPT_URL => "https://api.commerce.coinbase.com/events",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        "X-CC-Api-Key: $this->apiKey",
                        "X-CC-Version: 2018-03-22",                        
                    ),
                )
        );
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $response = json_decode($response, TRUE);

        echo '<pre>';
        print_r($response);
        die;
    }
    
    public function showEvents(){
        $curl = curl_init();
        curl_setopt_array($curl, 
            array(
                CURLOPT_URL => "https://api.commerce.coinbase.com/events/bwc-3451b29e21ecb",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        "X-CC-Api-Key: $this->apiKey",
                        "X-CC-Version: 2018-03-22",                        
                    ),
                )
        );
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $response = json_decode($response, TRUE);

        echo '<pre>';
        print_r($response);
        die;
    }
    */
    
}