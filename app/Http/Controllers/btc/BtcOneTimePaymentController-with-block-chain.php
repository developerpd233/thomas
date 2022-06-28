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

class BtcOneTimePaymentController extends Controller {
    
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
            DB::table('users')->where('id', $user)->update(['is_active'=>'NO', 'ban_date'=>date('Y-m-d')]);            
        }
        foreach ($tid as $t) {
            DB::table('payments_btc')->where('id', $t)->update(['isUsed'=>'yes']);
        }        
        echo '*OK*';        
    }
    
    
}
