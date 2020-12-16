<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;


class subscriptionController extends Controller{

	public function index(Request $request){

        $subscription1 = DB::table('subscription')      
            ->orderby('id','asc')
            ->limit(1)
            ->get();

        $sub11 = array();
        foreach($subscription1 as $sub1){
            $items1 = DB::table('subscription_item')->where('subscription_id',$sub1->id)->get();
            $title = $sub1->title;
            $sub11 = array(
                'title'=>$sub1->title,
                'price'=>$sub1->price,
                'add_date'=>$sub1->add_date,
                'items'=> $items1                  
            );
        }

        $subscription2 = DB::table('subscription')      
            ->orderby('id','desc')
            ->limit(1)
            ->get();

        $sub22 = array();
        foreach($subscription2 as $sub2){
            $items2 = DB::table('subscription_item')->where('subscription_id',$sub2->id)->get();
           
            $sub22 = array(
                'title'=>$sub2->title,
                'subscription1_title'=>$title, 
                'price'=>$sub2->price,
                'add_date'=>$sub2->add_date,
                'items'=> $items2                  
            );
        }

        if($subscription1){
            $result2 = array('status' => '200', "message" => "Subscription  successfully.",'subscription1'=> $sub11,'subscription2'=>$sub22);
        } 	
    
        if (empty($subscription1)){
            return response()->json('data not found', 201);
        } else {
            return response()->json($result2, 200);
        }
    }
}
