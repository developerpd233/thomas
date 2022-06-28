<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Corncontroller extends Controller
{
    public function corntest()
    {
        $count = 0;
        $user = DB::table('test')->insert([
            'count' => $count
        ]);
    }

    public function ban()
    {
        $users = DB::table('users')->get();
        foreach ($users as $list) {
            $today = date("y-m-d");
            $expire = $list->ban_date; //from database
            $today_time = strtotime($today);
            $expire_time = strtotime($expire);
            $minus = $expire_time - $today_time;
            if ($minus == 0 && $list->is_active == 'NO') {
                DB::table('users')->where('id', $list->id)->update([
                    'ban' => 'YES',
                ]);
            }
        }
    }

    public function cornpayment()
    {
        $paymentThisMonth = DB::table('payments_details')
            ->where('subscription_fee', 'YES')
            ->whereMonth('end_date', Carbon::now()->month)
            ->get();
        $userIDs = $isActiveByComission = $isNotActiveByComission = array();
        if(isset($paymentThisMonth) && !empty($paymentThisMonth)) {
            foreach ($paymentThisMonth as $payment) {
                array_push($userIDs, $payment->user_id);
            }
        }
        
        //Start: By BTC
        $paymentThisMonth = DB::table('payments_btc')
            ->where('isUsed', 'no')
            ->where('confirmations','>',5)
            ->where('endAt', '>', date('Y-m-d'))
            ->get();
        if(isset($paymentThisMonth) && !empty($paymentThisMonth)){
            foreach ($paymentThisMonth as $payment) {
                if(isset($payment->userId) && !in_array($payment->userId,$userIDs)):
                    array_push($userIDs, $payment->userId);
                endif;
            }
        }
        //End: By BTC
        
        //Start: By Paypal
        $paymentThisMonth = DB::table('payment_paypal')
            ->where('isTokenUsed', 'yes')
            ->whereMonth('startAt', Carbon::now()->month)
            ->get();
        if(isset($paymentThisMonth) && !empty($paymentThisMonth)) {
            foreach ($paymentThisMonth as $payment) {
                if(isset($payment->userId) && !in_array($payment->userId,$userIDs)):
                    array_push($userIDs, $payment->userId);
                    if(empty($payment->payer_id) && empty($payment->token)):
                        array_push($isActiveByComission, $payment->userId);
                    endif;    
                endif;
            }
        }
        
        $paymentThisMonth1 = DB::table('payments')
            ->where('cancel', 0)
            ->whereMonth('startAt', Carbon::now()->month)
            ->where('status','=','APPROVED')
            ->get();
        if(isset($paymentThisMonth1) && !empty($paymentThisMonth1)) {
            foreach ($paymentThisMonth1 as $payment) {
                if(isset($payment->user_id) && !in_array($payment->user_id,$userIDs)):
                    array_push($userIDs, $payment->user_id);
                endif;
            }
        }
        //End: By Paypal

        // userIds has userIds of people who paid so those who did not payed
        array_push($userIDs, 1);
        $otherUsers = DB::table('users')
            ->whereNotIn('id', $userIDs)
            ->get();
        $banDate = new Carbon('first day of third month');
        foreach ($otherUsers as $user) {
            DB::table('users')
                ->where('id', $user->id)
                ->update(['is_active' => 'NO','ban_date'=>NULL]);
        }
        
        //isActiveByComission process
        if(count($isActiveByComission) > 0):
            
            foreach ($isActiveByComission as $user) {
                DB::table('users')
                    ->where('id', $user)
                    ->update(['isActiveByComission' => 'YES']);
            }
            $isNotActiveByComission = array_diff($userIDs, $isActiveByComission);
            if(count($isNotActiveByComission) > 0):
                foreach ($isNotActiveByComission as $user) {
                    DB::table('users')
                        ->where('id', $user)
                        ->update(['isActiveByComission' => 'NO']);
                }
            endif;
            
        endif;
        
            
        
        DB::table('users')->where('is_active', 'YES')->update([
            'ban_date' => $banDate
        ]);
        /// give commission according to active users
        $levels = array();
        $users = DB::table('users')
            ->where('id', '!=', 1)// admin
            ->where('is_active', 'YES')
            ->get()
            ->toArray();
        foreach ($users as $user) {
            // todo: optimize this algorithm
            // for level 1
            $count = 0;
            $levels['level_1'] = array();
            foreach ($users as $item) {
                if ($item->parent_id == $user->id) {
                    array_push($levels['level_1'], $item);
                    $count++;
                }
            }
            // for level 2
            $count2 = 0;
            $levels['level_2'] = array();
            foreach ($levels['level_1'] as $level1) {
                foreach ($users as $item) {
                    if ($item->parent_id == $level1->id) {
                        array_push($levels['level_2'], $item);
                        $count2++;
                    }
                }
            }
            // for level 3
            $count3 = 0;
            $levels['level_3'] = array();
            foreach ($levels['level_2'] as $level2) {
                foreach ($users as $item) {
                    if ($item->parent_id == $level2->id) {
                        array_push($levels['level_3'], $item);
                        $count3++;
                    }
                }
            }
            // for level 4
            $count4 = 0;
            $levels['level_4'] = array();
            foreach ($levels['level_3'] as $level3) {
                foreach ($users as $item) {
                    if ($item->parent_id == $level3->id)
                        $count4++;
                }
            }
            $totalCommission = (($count * 5) + ($count2 * 5) + ($count3 * 5) + ($count4 * 5));

            if ($totalCommission != 0) {
                // commence insertion into  user_commission
                // get opening balance
                $commissions = DB::table('user_commissions')->where('receiver_id', $user->id)->get();

                $openingBalance = (float)0.00;
                foreach ($commissions as $commission) {
                    $openingBalance += $commission->payment;
                }
                DB::table('user_commissions')->insert(
                    [
                        'receiver_id' => $user->id,
                        'payer_id' => 1, // 1 is admin
                        'payment' => $totalCommission,
                        'transaction_type' => 'COMMISSION_FROM_ADMIN',
                        'commission_amount' => $totalCommission,
                        'opening_balance' => $openingBalance,
                        'closing_balance' => $openingBalance + $totalCommission,
                        'created_at' => Carbon::now()->toDateTimeString()
                    ]
                );
            }
        }
    }


}

