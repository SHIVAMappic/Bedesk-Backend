<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Validator;

class registerController extends Controller{

	public function register(Request $request){      
        $rules = [
            'name' => 'required',
            'email'    => 'unique:users|required',
            'password' => 'required',
        ];

        $input = $request->only('name', 'email','password');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }else {
            $name     = $request->name;
            $email    = $request->email;
            $password = md5($request->password);

            $data = array(
                'name'=>$name,
                'email'=>$email,
                'password'=>$password,
                'add_date'=>date('F j, Y'),
                'update_date'=>date('F j, Y')
            );

            $user  = DB::table('users')->insertGetId($data);           

            if($user){

                 $result = array(
                    'user_id'=>$user,
                    'name'=>$name,
                    'email'=>$email,
                    'add_date'=>date('F j, Y'),
                    'update_date'=>date('F j, Y')
                );
                $result2 = array('status' => '200', "message" => "User  successfully registered.",'data'=>$result);
                return response()->json($result2, 200);
            }else{
                return response()->json('Something went wrong', 201);
            }        
        }
    }


    public function login(Request $request){      
        $rules = [           
            'email'    => 'required',
            'password' => 'required',
        ];

        $input = $request->only('email','password');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }else {
            $email    = $request->email;
            $password = md5($request->password);

            $user  = DB::table('users')->where('email','=',$email)->where('password','=',$password)->first();           

            if(!empty($user)){

                  $result = array(
                    'user_id'=>$user->id,
                    'name'=>$user->name,
                    'email'=>$user->email,
                    'add_date'=>date('F j, Y'),
                    'update_date'=>date('F j, Y')
                );
                $result2 = array('status' => '200', "message" => "User  successfully login.",'data'=>$result);
                return response()->json($result2, 200);
            }else{
                return response()->json('Invalid Email and Password', 201);
            }        
        }
    }
     
}
