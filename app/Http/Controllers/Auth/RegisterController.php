<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Jrean\UserVerification\Traits\VerifiesUsers;
use Jrean\UserVerification\Facades\UserVerification;
use Illuminate\Auth\Events\Registered;

// Request & Response
use Illuminate\Http\Request;
use App\Http\Requests;

// Facades
use Log;
use Validator;
use Session;
use Auth;
// Models and Repo
use App\Models\User;
use App\Repositories\UserRepository;
use Carbon\Carbon;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    use VerifiesUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Where to reditect if the authenticated user is already verified.
     *
     * @var string
     */
    protected $redirectIfVerified = '/';

    /**
     * Where to redirect after a successful verification token verification.
     *
     * @var string
     */

    protected $redirectAfterVerification = '/login';

    /**
     * Where to redirect after a failling token verification.
     *
     * @var string
     */
    protected $redirectIfVerificationFails = '/email-verification/error';

    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $user)
    {
        $this->middleware('guest');
        $this->user = $user;
        Log::getMonolog()->popHandler();//Remove Old Handlers
        Log::useDailyFiles(config('settings.log.registration'));//Set New Handler
    }

    public function showRegistrationForm(Request $request, $id = null)
    {
		// if user come from admin-certificate filling page
		if (!$request->has('type') && !isset($_COOKIE['admin-certificate'])) {
			//--- If video code wasnt' entered redirect to video code page.
			if(!session()->has("canWatch")){
				return redirect("pages/videos?id=$id")->with('error', ' Sorry! Please, enter your code');
			}
		}
		$data["parentid"] = $id;
		
		if(session()->has("codeid")){
			$code = DB::table("codes")->where(["id" => session()->get("codeid")])->first();	
			$end = Carbon::parse($code->started_at)->addHours(72);
			$data['started_at'] = $code->started_at;
			$data['end_at'] = $end;
			$data['timezone'] = Carbon::now()-> tzName;
		}
		
        return view('auth.register', $data);
    }

    protected function validator(array $data)
    {
        //dd($data);
        return Validator::make($data, [
            'parent_id' => 'required|numeric',
            // 'first_name' => 'required|name|max:50',
            // 'last_name' => 'required|name|max:50',
            'address1' => 'required|address|max:255',
            /*'address2' => 'address|max:255',*/
            /*'city' => 'required|city|max:255',
            'state' => 'required',*/
            'phone' => 'required|phone|max:10',
            'username' => 'required|max:100|unique:users',
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|min:6|confirmed',
            'codes' => 'required',
            'agree' => 'required'
        ], [
            'agree.required' => 'You Should agree with terms of Use and Privacy Policy',
        ]);
    }

    protected function create(array $data)
    {   

        $data['password'] = bcrypt($data['password']);
        $data['admin'] = 'NO';
        Log::info("============ User Registration (START) ============");

        Log::info("====== Registration Form Submitted Data ======");
        Log::info($data);
        Log::info("====== Registration Form Submitted Data ======");

        if ($user = $this->user->create($data)) {

            Log::info("User (User ID: " . $user->id . " - Email: " . $user->email . ") has been registered successfully.");


            DB::table('companies_profiles')->insert([
                'user_id' => $user->id
            ]);


            DB::table('users')->where('id', $user->id)->update(
                [
                    'verified' => 1,
                    'not_now' => 1,
                    'is_active' => 'YES'
                ]
            );
            
              DB::table('register_codes')->insert([
                'codes' => $data['codes']
                ]);
            
            //creditin parent with $25 on each new subcriber through his affiliate link.
            $parent = DB::table('users')
                ->where('id', $user->parent_id)
                ->first();
            //echo'<pre>';
            //print_r($parent->subscriber_commision);die();
            $comission= $parent->subscriber_commision + 25.00 ;
            DB::table('users')->where('id', $user->parent_id)->update(
                [
                    'subscriber_commision' => $comission,
                ]
            );


            Log::info("============ User Registration (END) ============");

            /* Session::flash('danger', trans('login.email_sent')); */

            return $user;
        } else {
            Log::error("User has not been registered.");
            Log::info("============ User Registration (END) ============");
        }
    }


    public function register(Request $request)
    {
          //  dd($request->all());
        if (isset($_POST['g-recaptcha-response'])) {
            $capta = $request->input("g-recaptcha-response");
            $code = $request->input('codes');

        //Check paypal token valid or not //
            $paypal_token = [
                'token' => $code ,
                'is_expired' => 'NO'
            ];
            $token = DB::table('training_video_payment')->where($paypal_token)->first();
    
        //Check video code token valid or not //
            $videocode = [
                'code' => $code,
                'expired' => 0
            ];
            $video_code = DB::table('codes')->where($videocode)->first();
    
            if(!$token && !$video_code)
            {
                return redirect()->route('register', ['post' =>$request->input("parent_id")])
                ->with('danger', 'Invalid Code!');
            }

            //check if code allready used to register or not//
   
            $codee =[
                'codes' => $code,
                'expired' => 1
            ];
             
            $register_code = DB::table('register_codes')->where($codee)->first();
            if($register_code){
                 return redirect()->route('register', ['post' => $request->input("parent_id")])
                ->with('danger', 'Codes is used already!');
            }
        }
        if (!$capta) {
            return redirect()->route('register', ['post' => $request->input("parent_id")])
                ->with('danger', 'Complete captcha');
        }
        
        
    

        $secrect_key = "6Ld0aaoUAAAAAJe3yNib7ahWdBjx8U8NO7armg3d";
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secrect_key) . '&response=' . urlencode($capta);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response, true);
        if ($responseKeys["success"]) {
            $this->validator($request->all())->validate();
            $users = event(new Registered($user = $this->create($request->all())));
            DB::table('users')->where('first_name', $request->first_name)->update([
                'sex' => $request->sex,
            ]);
            Auth::login($user);
            return redirect()->guest("/user/dashboard");
        } else {
            return redirect()->route('register', ['post' => $request->input("parent_id")])
                ->with('danger', 'Could Not Register');
            /*return $this->registered($request, $user)
                ?: redirect($this->redirectPath());*/
        }

        //$this->guard()->login($user);


    }

}
