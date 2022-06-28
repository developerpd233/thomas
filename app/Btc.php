<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Session;
use DB;
use Cookie;
use Request;

class Btc extends Model {
    
    public function __construct(){        
    }
    
    public function checkTransctionId($tid){        
        $qry = 'select `id` from `training_video_payment` where id='.$tid;
        $info = DB::select($qry);
        $info = collect($info)->map(function($x) { return (array) $x;  })->toArray();
        return $info;
    }
    
    public function checkOfflineTransctionId($tid){        
        $qry = 'select `id` from `payments_btc` where id='.$tid;
        $info = DB::select($qry);
        $info = collect($info)->map(function($x) { return (array) $x;  })->toArray();
        return $info;
    }
    
    public function addTrainingVideoPaymentByBtc(){
        
        $options = array(
            CURLOPT_RETURNTRANSFER => true,   // return web page
            CURLOPT_HEADER         => false,  // don't return headers
            CURLOPT_FOLLOWLOCATION => true,   // follow redirects
            CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
            CURLOPT_ENCODING       => "",     // handle compressed
            CURLOPT_USERAGENT      => "test", // name of client
            CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
            CURLOPT_TIMEOUT        => 120,    // time-out on response
        ); 
        $xpub = "xpub6CLxzBCxF4zwfcr9h8hdTyvqXzDjuhqcKR64zUY9fUx5Xcr118KU3QPbfVz8ZKULMQt4haTPzmaW9dWAQkKHdiWSWwu9vDY6RwDuky5THfA";
        $secretKey = md5(uniqid(uniqid(uniqid())));
        
        $updVal = [
                'PayerId' => "",
                'paymentID' => "",
                'amount' => env('ONETIME_PAY'),
                'token' => $secretKey,
                'created_at' => date('Y-m-d h:i:s'),
                'expiry_time'=>NULL,
                'started_at'=>NULL,
                'is_expired'=>'YES'            
        ];
        
        $insId = DB::table('training_video_payment')->insertGetId($updVal);
        $resp = $this->checkTransctionId($insId);
        
        if(count($resp) > 0):
            
            $userID = (!empty($resp[0]['id'])) ? $resp[0]['id'] : "";
            $cback = 'https://'.$_SERVER['HTTP_HOST'].'/btccallback?invoice_id='.$userID.'&secret='.$secretKey;
            $callback = urlencode($cback);
            
            $key = "d5889563-9173-4d45-8451-6a0c8747c224";
            $gap_limit = 300;

            $url = "https://api.blockchain.info/v2/receive?xpub=$xpub&callback=$callback&key=$key&gap_limit=$gap_limit";
            $ch = curl_init($url);
            curl_setopt_array($ch, $options);
            $response  = curl_exec($ch);
            curl_close($ch);

            $res = json_decode($response);
            
            $address = (!empty($res->address)) ? $res->address : "";
            $index = (!empty($res->index)) ? $res->index : "";
            $callback = (!empty($res->callback)) ? $res->callback : "";
            
            $updVal = array("address"=>$address,"tindex"=>$index,'callback'=>$callback);                
            $responseDB = DB::table('training_video_payment')->where("id",$userID)->update($updVal);
            
            if($responseDB):
                $array = array("address"=>$address, "token"=>$secretKey);
                return $array;                
            else:
                $array = array();
                return $array;
            endif;
        
        else:
            $array = array();
            return $array;            
        endif;
        
    }
    
    
    public function generateAddressForBtcPayment($userId){
        
        $options = array(
            CURLOPT_RETURNTRANSFER => true,   // return web page
            CURLOPT_HEADER         => false,  // don't return headers
            CURLOPT_FOLLOWLOCATION => true,   // follow redirects
            CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
            CURLOPT_ENCODING       => "",     // handle compressed
            CURLOPT_USERAGENT      => "test", // name of client
            CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
            CURLOPT_TIMEOUT        => 120,    // time-out on response
        ); 
        $xpub = "xpub6CLxzBCxF4zwfcr9h8hdTyvqXzDjuhqcKR64zUY9fUx5Xcr118KU3QPbfVz8ZKULMQt4haTPzmaW9dWAQkKHdiWSWwu9vDY6RwDuky5THfA";
        $secretKey = md5(uniqid(uniqid(uniqid())));

        $updVal = [
                'userId' => $userId,
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
        ];
        
        $insId = DB::table('payments_btc')->insertGetId($updVal);
        $resp = $this->checkOfflineTransctionId($insId);

        if(count($resp) > 0):

            $invoiceID = (!empty($resp[0]['id'])) ? $resp[0]['id'] : "";
            $cback = 'https://'.$_SERVER['HTTP_HOST'].'/offcallback?invoice_id='.$invoiceID.'&secret='.$secretKey;
            $callback = urlencode($cback);

            $key = "d5889563-9173-4d45-8451-6a0c8747c224";
            $gap_limit = 300;

            $url = "https://api.blockchain.info/v2/receive?xpub=$xpub&callback=$callback&key=$key&gap_limit=$gap_limit";
            $ch = curl_init($url);
            curl_setopt_array($ch, $options);
            $response  = curl_exec($ch);
            curl_close($ch);

            $res = json_decode($response);

            $address = (!empty($res->address)) ? $res->address : "";
            $index = (!empty($res->index)) ? $res->index : "";
            $callback = (!empty($res->callback)) ? $res->callback : "";

            $updVal = array("address"=>$address,"tindex"=>$index,'callback'=>$callback);                
            $responseDB = DB::table('payments_btc')->where("id",$invoiceID)->update($updVal);

            if($responseDB):
                $array = array("address"=>$address, "token"=>$secretKey);
                return $array;                
            else:
                $array = array();
                return $array;
            endif;

        else:
            $array = array();
            return $array;            
        endif;
        
    }
    
    
}
