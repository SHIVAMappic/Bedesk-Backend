<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;

class AdsManagerController extends Controller
{
    public function index() {      

        $result = DB::table('ads_manager')            
            ->orderby('id','desc')
            ->get();

        if($result){
            $result2 = array('status' => '200', "message" => "Ads Manager.",'data'=>$result);
        }         
    
        if (empty($result)){
            return response()->json('data not found', 201);
        } else {
            return response()->json($result2, 200);
        }
    } 

}
