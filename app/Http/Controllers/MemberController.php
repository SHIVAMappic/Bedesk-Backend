<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Member;

class MemberController extends Controller {

	public function index(){
		$pageTitle = 'Members';
		$members = Member::all();

		$members = Member::orderby('id','desc')->get();

		$members = Member::orderby('id','desc')->take(3)->get();

		$members = Member::orderby('id','desc')->limit(3)->offset(2)->get();

		$members = Member::where('age','<=',21)->get();

		$members = Member
		    ::join('blogs', 'members.id', '=', 'blogs.user_id')
		   // ->join('orders', 'users.id', '=', 'orders.user_id')
		   // ->select('users.id', 'contacts.phone', 'orders.price')		   
		    ->get();   // join 
 






		//$members = Member::where('email','dev@gmail.com')->get();
		//$members = Member::orderby('id','desc')->take(2)->get();

    	foreach($members as $product){
         // echo   $products_id = $product->name;
         // echo '</br>';
    	}

    	return view('members.index',compact('members','pageTitle'));

    	/*$result = User
		    ::join('contacts', 'users.id', '=', 'contacts.user_id')
		    ->join('orders', 'users.id', '=', 'orders.user_id')
		    ->select('users.id', 'contacts.phone', 'orders.price')
		    ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
		    ->get();*/

	}

	public function add(){
		$pageTitle = 'Add Member';
		return view('members.add',compact('pageTitle'));
	}

	public function addSubmit(Request $req){

		$validation = Validator::make($req->all(),[
			'name'=>'required',
			'email'=>'required|email',
			'age'=>'required'
		]);
		if($validation->fails()){			
			$errors = $validation->errors()->all();
            $result=array('status'=>'false','errors'=> $errors);
		}else{

			$member = new Member(['name'=>$req->name,'email'=>$req->email,'age'=>$req->input('age')]);
			$insert_id = $member->save();


			$member = new Member();
			$member->name = $req->name;
			$member->email = $req->email;
			$member->age = $req->input('age');
			$insert_id = $member->save();
			if($insert_id){
				$result = array('status'=>'true','message'=>'Member successfully added!','insert'=>$member->id);
			}
		}		
		
		echo json_encode($result);
	}

	public function updateSubmit(Request $req){
		$member = Member::find($req->id);
		$member->name = $req->name;
		$member->email = $req->email;
		$member->age = $req->input('age');
		$update = $member->save();
		//Member::where('id',$req->record_id)->update(['name'=>$req->name]);
	}

	public function delete(Request $req){
		$member = Member::find($req->id);
		$result = $member->delete();

		$member::destroy([3,4]);  // delete multiple records

	}




}