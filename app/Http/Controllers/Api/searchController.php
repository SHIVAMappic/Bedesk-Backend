<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Validator;

class searchController extends Controller{

	public function wordSearch(Request $request){  

       $query = $request->get('query');
        if($query != '')
        {

            $data = DB::table('words')
             ->where('word_name', 'like', '%'.$query.'%')        
             ->orderBy('id', 'desc')
             ->get(); 

            if($data){          
                $result2 = array('status' => '200', "message" => "Your Search word listing",'data'=>$data);
                return response()->json($result2, 200);
            }else{
                return response()->json('Data Not Found', 201);
            }  
        }             
       
    }
     

    public function GetwordById(Request $request){  

       $id = $request->get('id');
        if($id != '')
        {
            $words = DB::table('words')->find($id);
            $count = DB::table('word_like_system')->where('action','=','upvote')->where('word_id','=',$id)->count();
            $data2 = array(
            'total_upvote'=>$count
             );
          
            if($words){          
                $result2 = array('status' => '200', "message" => "Your Search word listing",'data'=>$words,'total'=>$data2);
                return response()->json($result2, 200);
            }else{
                return response()->json('Data Not Found', 201);
            }  
        }             
       
    }
     
}
