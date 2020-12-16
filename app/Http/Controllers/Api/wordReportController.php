<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;


class wordReportController extends Controller{

	public function index(Request $request){

        $result = DB::table('word_reports')
            ->join('users', 'users.id', '=', 'words.user_id')  
            ->join('words', 'words.id', '=', 'word_reports.word_id')          
            ->select('words.word_name', 'users.name', 'users.email','word_reports.report')
            ->orderby('id','desc')
            ->get();

        if($result){
            $result2 = array('status' => '200', "message" => "Report  successfully.",'data'=>$result);
        } 	
    
        if (empty($result)){
            return response()->json('data not found', 201);
        } else {
            return response()->json($result2, 200);
        }
    } 

    
    public function addWordReport(Request $request){

        $rules = [
            'user_id' => 'required',
            'word_id'=>'required',
            'report'=>'required',
        ];      

       
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }else{
            $user_id = $request->user_id;

            $data = array(
                'report'=>$request->report,
                'word_id'=>$request->word_id,                
                'add_date'=>date('F j, Y'),
                'update_date'=>date('F j, Y'),                
                'user_id'=>$request->user_id,
                
            );


            $insertWord = DB::table('word_reports')->insertGetId($data);

            if($insertWord){
                $result=array('status'=>'200','message'=> 'Report added successfull!.','report_id'=>$insertWord );
                return response()->json($result, 200);
            }else{
               // $result=array('status'=>'false','message'=> 'Something went wrong, Please try again.');
                 return response()->json('Something went wrong', 201);

            }        

        } 
    }   
  
}
