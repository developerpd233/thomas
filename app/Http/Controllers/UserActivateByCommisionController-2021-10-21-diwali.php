<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserActivateByCommisionController extends Controller
{
    public function activate()
    {
        $users = DB::table('users')->where('is_active','=','NO')->where('subscriber_commision','>=',50.00)->get();
        
        foreach ($users as $list) {
            if ($list->subscriber_commision >= 50.00 && $list->is_active == 'NO') {
                echo "Activating User Id -> $list->id";
                DB::table('users')->where('id', $list->id)->update([
                    'is_active' => 'YES',
                    'subscriber_commision' => ($list->subscriber_commision - 50.00)
                ]);
                $startAt = Carbon::now()->toDateString(); //today
                $endAt = new Carbon('first day of next month');
                $insVal = array(
                    'id'=>NULL,
                    'userId'=>$list->id,
                    'order_id'=>'',
                    'paymentID'=>$list->id,
                    'payer_id'=>'',
                    'token'=>'',
                    'isTokenUsed'=>'yes',
                    'event'=>'Pain by Commision',
                    'startAt'=>$startAt,
                    'endAt'=>$endAt,
                    'amount'=>'50',
                    'status'=>'COMPLETED',
                    'create_date' => date('Y-m-d h:i:s'),
                    'update_date' => date('Y-m-d h:i:s')
                );          
                DB::table('payment_paypal')->insertGetId($insVal);
            }
        }
        $this->moveSubscriptionAmount();
    }

    public function moveSubscriptionAmount()
    {
        $users = DB::table('users')->get();
        foreach ($users as $list) {
            
            $today = date("y-m-d");
            $monthEndDate = Carbon::now()->endOfMonth()->toDateString(); // last day of the month
            $today_time = strtotime($today);
            $expire_time = strtotime($monthEndDate);
            $minus = $expire_time - $today_time;
            $minus = 0;
            
            $remainingCommission = $list->subscriber_commision;
            if ($minus == 0 && $list->is_active == 'YES') {
                
                echo "Removing Subscriber Commision from Users Table";
                /*
                DB::table('users')->where('id', $list->id)->update([
                    'subscriber_commision' => 0.00
                ]);      
                */
                if ($remainingCommission != 0) {
                    // commence insertion into  user_commission
                    // get opening balance
                    $commissions = DB::table('user_commissions')->where('receiver_id', $list->id)->get();
    
                    $openingBalance = (float)0.00;
                    foreach ($commissions as $commission) {
                        $openingBalance += $commission->payment;
                    }
                    echo "Adding Subscriber Commision $remainingCommission to  \"user_commissions\" Table";
                    DB::table('user_commissions')->insert(
                        [
                            'receiver_id' => $list->id,
                            'payer_id' => 1, // 1 is admin
                            'payment' => $remainingCommission,
                            'transaction_type' => 'COMMISSION_FROM_ADMIN',
                            'commission_amount' => $remainingCommission,
                            'opening_balance' => $openingBalance,
                            'closing_balance' => $openingBalance + $remainingCommission,
                            'created_at' => Carbon::now()->toDateTimeString()
                        ]
                    );
                }
            }
        }
    }
    public function saveSubscribersHistory()
    {
        $today = date("y-m-d");
        $monthEndDate = Carbon::now()->endOfMonth()->toDateString(); // last day of the month
        // $monthEndDate = Carbon::now()->toDateString();
        $today_time = strtotime($today);
        $expire_time = strtotime($monthEndDate);
        $minus = $expire_time - $today_time;
       
        if ($minus == 0){
          
            $users = DB::table('users')->get();
           
            foreach ($users as $list) {
                echo "Adding Subscriber History of  \"$list->first_name $list->last_name\" to  \"subscriber_tree_history\" Table <br>";
                DB::table('subscriber_tree_history')->insert(
                    [
                        'id' => $list->id,
                        'parent_id' => $list->parent_id,
                        'first_name' => $list->first_name,
                        'last_name' => $list->last_name,
                        'subscriber_commision' => $list->subscriber_commision,
                        'is_admin' => $list->is_admin,
                        'is_active' => $list->is_active,
                        'created_at' => $list->created_at,
                        'history_saved_at' =>  Carbon::now()->format('Y-m')
                    ]
                );
            }
        }
    }
}