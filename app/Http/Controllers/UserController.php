<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Mail;
use Hash;
use Session;
class UserController extends Controller {
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
	 


	/**
	 * Where to redirect users after registration.
	 *
	 * @var string
	 */
	protected $redirectTo = '/home';
	
	protected function validator(array $data) {
		return Validator::make($data, [
			'name' => 'required|string|max:25',
			'email_ID' => 'required|string|email|max:255',
			'password' => 'required|string|min:6|confirmed',
			'phone_num' => 'required|integer',
		]);
	}
  
	public function user_register(Request $request){
		$fullname = $request->fullname;
		$email = $request->email;
		$password = $request->password;
		$phone = $request->phone;
		$token = $request->_token;
		
		$checkUser = DB::table('users')->where('email','=',$email)->first();
		if($checkUser){
			$result=array('status'=>'false','message'=> 'Email address already exists. Please choose another email address.');
		}else{
			$addUser = ['name'=>$fullname, 'email'=>$email, 'password'=>bcrypt($password), 'role'=>3, 'created_at'=>date("Y-m-d h:i:s", time())];
			$insertUser = DB::table('users')->insert($addUser);
			if($insertUser){
				$result=array('status'=>'true','message'=> 'Your registeration is successfull!.');
			}else{
				$result=array('false'=>'true','message'=> 'Something went wrong, Please try again.');
			}
			
		}
		echo json_encode($result);
	}
	public function user_login(Request $request){
		$email = $request->email;
		$password = $request->password;
		$token = $request->_token;

		$checkUser = DB::table('users')->where('email','=',$email)->select('id','password','role')->first();
		if(empty($checkUser)){
			$result=array('status'=>'false','message'=> 'Email Id Not Register');
		}elseif (!Hash::check($password, $checkUser->password)) {
			$result=array('status'=>'false','message'=> 'Wrong Username Or Password');
		}else{
			if($checkUser->role==1){
				$role = 1;
			}else{
				$role = 0;
			}
			$result=array('status'=>'true','role'=>$role,'message'=> 'Login Successfully.');
			session(['log_base' => base64_encode($checkUser->id)]);
		}
		echo json_encode($result);
	}
	public function forgotPass(Request $request){
		$email = $request->email;

		$checkUser = DB::table('users')->where('email','=',$email)->select('id')->first();
		if(empty($checkUser)){
			$result=array('status'=>'false','message'=> 'Email Id Not Register');
		}else{
			$code = md5(time());
			$string = array('id'=>$checkUser->id, 'code'=>$code);
			$url = 'http://localhost/ela/reset-password/?act=' .base64_encode( serialize($string));
			$body = '
				<body style="margin:0;  background:#e5e5e5; width:100%; padding: 50px 0; display:inline-block;">
				<link href="https://fonts.googleapis.com/css?family=Lato:300,400" rel="stylesheet">
				<table style="width:900px; margin: 0 auto; padding:50px 0 0 0; background:#ededed;">
				  <tbody>
					<tr>
					  <td style="text-align:center;"><img src="http://www.elpatiopty.com/image/catalog/el.png"> </td>
					</tr>
				  </tbody>
				</table>
				<table style="width:900px; margin: 0 auto; padding:22px 0 70px 0; background:#ededed;text-align: center;">
				  <tbody>
					  <td style="text-align: center; color: #000; font-size: 16px; border: 1px solid #ddd; width: 900px; display: inline-block; background: #fff; padding: 55px 0;">
					  <h3 style="padding: 0; margin: 0; margin-bottom: 20px; font-size: 14px;">Your OTP is :</h3>
					  <h3 style="padding: 0; margin: 0; margin-bottom: 20px; font-size: 12px;"><a href="'.$url.'">Reset Password</a></h3>
					  <br>
					  </td>
					</tr>
				  </tbody>
				</table>
				</body>';
				$mailArray = array();
				$mailArray['body'] = $body;
				$mailArray['to'] = $email;
				$mailArray['subject'] = 'Forgot Password reset link';
 				Mail::raw([], function($message) use($mailArray){
					$message->subject($mailArray['subject']);
					$message->from('dev@me.com', 'Me.com');
					$message->to($mailArray['to'], 'Developer');
					$message->setBody($mailArray['body'], 'text/html');
				});
			$result=array('status'=>'true','message'=> 'We have sent reset link. Please check inbox.');
 		}
		echo json_encode($result);
	}
	public function resetPass(Request $request){
		$id = $request->id;
		$password = $request->password;
		$token = $request->_token;

		$checkUser = DB::table('users')->where('id','=',$id)->first();
		if(empty($checkUser)){
			$result=array('status'=>'false','message'=> 'User Not Register');
		}else{
			$addUser = ['password'=>bcrypt($password)];
			$insertUser = DB::table('users')->where('id','=',$id)->update($addUser);
			if($insertUser){
				$result=array('status'=>'true','message'=> 'Password updated successfull!.');
			}else{
				$result=array('false'=>'true','message'=> 'Something went wrong, Please try again.');
			}
		}
		echo json_encode($result);
	}
	public function user_logout(Request $request){
		Session::all();
		Session::forget('log_base');
		return redirect('/login');
		/*$result=array('status'=>'true','message'=> 'Logout Successfully.');
		echo json_encode($result);*/
	}
	public function dashboard(Request $request){
		$pageTitle = 'Dasboard';
		$logSESSION = Session::get('log_base');
		$checkUser = DB::table('users')->where('id','=',base64_decode($logSESSION))->first();
		$rootArray = ['name'=> ''];
		if(isset($logSESSION) && $checkUser->role==1){
			if($checkUser){
				$rootArray = ['name'=> $checkUser->name];
			}
		}else{
			Session::all();
			Session::forget('log_base');
		}
		return view('dashboard',$rootArray,compact('pageTitle'));
	}

	public function index() {
		$pageTitle = 'Users';
		$allUsers = DB::table('users')->orderby('id','desc')->get();
		return view('users.index',compact('allUsers','pageTitle'));
	}

	public function addUser() {
        $pageTitle = 'Add User';
    	return view('users.addUser',compact('pageTitle'));
    }

    public function addUserSubmit(Request $request){     

   		$fullname = $request->name;
		$email = $request->email;
		$password = $request->password;
		$phone = $request->phone;
		$token = $request->_token;
		
		$checkUser = DB::table('users')->where('email','=',$email)->first();
		if($checkUser){
			$result=array('status'=>'false','message'=>'Email address already exists. Please choose another email address.');
		}else{
			$addUser = array(
							'name'=>$fullname, 
							'email'=>$email, 
							'password'=>bcrypt($password),
							'role'=>3,
							'add_date'=>date('F j, Y'),
							'update_date'=>date('F j, Y'),
							'created_at'=>date("Y-m-d h:i:s", time())
						);
			$insertUser = DB::table('users')->insert($addUser);
			if($insertUser){
				$result=array('status'=>'true','message'=> 'User created  successfull!.');
			}else{
				$result=array('false'=>'true','message'=> 'Something went wrong, Please try again.');
			}
			
		}
		echo json_encode($result);   

      
    }

    public function editUser($id){
        $pageTitle = 'Edit User';
        $users = DB::table('users')->find($id);
        return view('users.editUser',compact('users','pageTitle'));
    }

    public function editUserSubmit(Request $request){

    	$fullname = $request->name;
		$email = $request->email;
		//$password = $request->password;
		//$phone = $request->phone;
		$token = $request->_token;
		
		$checkUser = DB::table('users')->where('email','=',$email)->first();
		if($checkUser){
			$result=array('status'=>'false','message'=>'Email address already exists. Please choose another email address.');
		}else{
			$data = array(
							'name'=>$fullname, 
							'email'=>$email,						
							'update_date'=>date('F j, Y'),							
						);
			$updateUser = DB::table('users')->where('id',$request->record_id)->update($data);
			if($updateUser){
				$result=array('status'=>'true','message'=> 'User created  successfull!.');
			}else{
				$result=array('false'=>'true','message'=> 'Something went wrong, Please try again.');
			}
			
		}
		echo json_encode($result);       

    }


	public function viewUser($id){
        $pageTitle = 'View User';
        $users = DB::table('users')->find($id);
        return view('users.viewUser',compact('users','pageTitle'));
    }

    public function deleteUser(Request $request)
    {
        $record_id = $request->record_id;
        $deleteUser = DB::table('users')->where('id',$record_id)->delete();
        if($deleteUser){
            $result=array('status'=>'true','message'=> 'User deleted successfull!.');
        }else{
            $result=array('false'=>'true','message'=> 'Something went wrong, Please try again.');
        }

        echo json_encode($result);

    }

}
