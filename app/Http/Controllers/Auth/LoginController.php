<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Common\CommonUtilsController;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Session;
use DB;
use App\User;
use App\UserTimeSpent;
use Auth;
use App\UserSessionTime;
use DateTime;

class LoginController extends Controller {
	/*
		    |--------------------------------------------------------------------------
		    | Login Controller
		    |--------------------------------------------------------------------------
		    |
		    | This controller handles authenticating users for the application and
		    | redirecting them to your home screen. The controller uses a trait
		    | to conveniently provide its functionality to your applications.
		    |
	*/

	use AuthenticatesUsers;

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	protected $redirectTo = '/home';
	protected $user_verified = [
	  'status' => 'boolean',
	];
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('guest')->except('logout');
	}

	public function login(Request $request) {
		$user_verified = User::where('email_ID','=',$request->email_ID)->select('id')->first();
$results = DB::select('SELECT * FROM "User".users where id='.$user_verified['id']);
/* echo $results[0]->status;

		if(boolval($user_verified['status']) === 0) {
			echo 'my0';
		} else {
			echo 'my1';
		}
		echo ' jkkkk'; 
		echo '<pre>';
		print_r($results);
		echo '</pre>';
		exit;*/
		if(isset($user_verified)){
			if($results[0]->status == '')
			{
				$errors = ['notVerified' => trans('auth.failed')];

				return redirect()->back()
					->withInput($request->only($this->username(), 'remember'))
					->withErrors($errors);
			}
		
		}
		else {
			$errors = ['notRegisterd' => trans('auth.failed')];
			return redirect()->back()
			->withInput($request->only($this->username(), 'remember'))
			->withErrors($errors);
		}
		
		$this->validateLogin($request);

		// If the class is using the ThrottlesLogins trait, we can automatically throttle
		// the login attempts for this application. We'll key this by the username and
		// the IP address of the client making these requests into this application.
		if ($this->hasTooManyLoginAttempts($request)) {
			$this->fireLockoutEvent($request);

			return $this->sendLockoutResponse($request);
		}

		if ($this->attemptLogin($request)) {

			$logintime = date("Y-m-d h:i:s", time());
			Session::put('loginTime', $logintime);
			$uid=UserTimeSpent::create([
					'user_id' => Auth::user()->id,
					'login_time'=>$logintime,
				]);
			return $this->sendLoginResponse($request);
		}
		

		// If the login attempt was unsuccessful we will increment the number of attempts
		// to login and redirect the user back to the login form. Of course, when this
		// user surpasses their maximum number of attempts they will get locked out.
		$this->incrementLoginAttempts($request);

		return $this->sendFailedLoginResponse($request);
	}





	protected function credentials(Request $request) {
		return ['email_ID' => $request{$this->username()}, 'password' => $request->password, 'status' => true,'is_active'=>1];
	}

	public function shout(Request $request) {
		$commonUtilsController = new CommonUtilsController();
		$data['email_id'] = $request->email_ID;
		$data['description'] = $request->description;
		$commonUtilsController->sendRawMail($data);
		$response = array(
			'success' => 'Success',
		);
		return json_encode($response);
	}
/**
 * Get the login username to be used by the controller.
 *
 * @return string
 */
	public function username() {
		return 'email_ID';
	}

	public function logout(Request $request) {

		$uid = Auth::user()->id;
		$logoutTime = date("Y-m-d h:i:s", time());
		$loginTime = Session::get('loginTime');
		Session::forget('loginTime');
		$prevUserTime = UserTimeSpent::where('user_id',$uid)
						->where('login_time','=',$loginTime)
						->select('id','spent_time')->first();				
		if($prevUserTime){

			// $sesstime = UserSessionTime::where('usr_time_store_id','=',$prevUserTime->id)
			// 							->select('id','session_paused_time','session_resume_time')
			// 							->OrderBy('id', 'desc')->first();						
			// if($sesstime){
			// 	$existsSessPause = $sesstime->session_paused_time;
			// 	$existsSessResume = $sesstime->session_resume_time;
			// 	if($existsSessResume){
			// 		$date_login = new DateTime($existsSessResume);
			// 		$date_logout = new DateTime($logoutTime);
			// 		$interval = date_diff($date_logout,$date_login);
			// 		$oldSpent_time = $prevUserTime->spent_time;
			// 		$spentTime = $interval->format('%H:%i:%s') ;
			// 		$time = $spentTime;
			// 		$timeArr = array_reverse(explode(":", $time));
			// 		$seconds = 0;
			// 		foreach ($timeArr as $key => $value)
			// 		{
			// 		    if ($key > 2) break;
			// 		    $seconds += pow(60, $key) * $value;
			// 		}
			// 		$user_spent_time = $seconds+ $oldSpent_time;
			// 		UserTimeSpent::where('user_id',Auth::user()->id)
			// 						->where('login_time','=',$loginTime) 
			// 			 			->update(['logout_time' => $logoutTime,'spent_time'=>$user_spent_time]);
			// 	}
			// }else{

				$date_login = new DateTime($loginTime);
				$date_logout = new DateTime($logoutTime);
				$interval = date_diff($date_logout,$date_login);
				$oldSpent_time = $prevUserTime->spent_time;
				$spentTime = $interval->format('%H:%i:%s') ;
				$time = $spentTime;
				$timeArr = array_reverse(explode(":", $time));
				$seconds = 0;
				foreach ($timeArr as $key => $value)
				{
				    if ($key > 2) break;
				    $seconds += pow(60, $key) * $value;
				}
				$user_spent_time = $seconds+ $oldSpent_time;
				UserTimeSpent::where('user_id',Auth::user()->id)
								->where('login_time','=',$loginTime) 
					 			->update(['logout_time' => $logoutTime,'spent_time'=>$user_spent_time]);

			// }							
		}				
		$this->guard()->logout();
		$request->session()->invalidate();
		return redirect('/');
	}

}
	