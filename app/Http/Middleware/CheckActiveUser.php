<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\DB;
use Session;
use Auth;

class CheckActiveUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if (!$request->ajax()) {
            
            // find the number of days between two given dates 
            function dateDiffInDays($date1, $date2)  
            { 
                // Calculating the difference in timestamps 
                $diff = strtotime($date2) - strtotime($date1); 
                  
                // 1 day = 24 hours 
                // 24 * 60 * 60 = 86400 seconds 
                return abs(round($diff / 86400)); 
            } 

            //  for user goal
            if ($user->is_active == 'NO' and (!in_array($request->route()->uri, ['user/{username}/goal']))) {
                // check month of non-payment
                $isPaymentActive = DB::table('payments')
                    ->where(array('user_id'=> $user->id,'cancel'=>0))
                    ->first();
                    
                $messageAlert = "";
				if($isPaymentActive){
					$SubscriptionCreatedDate = $isPaymentActive->created_at;
					$dt = new \DateTime($SubscriptionCreatedDate);
					$subscribeDate = (string)$dt->format('d-m-Y');
					
                    $todaysDate = date('d-m-Y');
					$daysDiff = dateDiffInDays($subscribeDate, $todaysDate);
					
					if($daysDiff > 90){
					    $messageAlert = "3";
					}else if($daysDiff > 60){
					    $messageAlert = "2";
					}else if($daysDiff > 30){
					    $messageAlert = "1";
					}
				}
                
                // if user has filled up user goals show
                if ($request->route()->uri == 'user/{username}') {
                    // if user goals is filled up then show active
                    $userGoal = DB::table('user_goals')
                        ->where('user_id', $user->id)
                        ->first();

                    if ($userGoal) {
                        return redirect('/active')->with('blockAlert',$messageAlert);
                        //return redirect('/active');
                    } else {
                        return $next($request);
                    }
                }
                return redirect('/active')->with('blockAlert',$messageAlert);
            }
        }
        return $next($request);
    }
}
