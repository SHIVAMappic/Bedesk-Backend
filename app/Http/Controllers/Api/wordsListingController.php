<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;

class wordsListingController extends Controller{



	public function index(Request $request){

        $result = DB::table('words')
            ->join('users', 'users.id', '=', 'words.user_id')  
            ->join('category', 'category.id', '=', 'words.category_id')          
            ->select('words.*', 'users.name', 'users.email','category.category_name')
            ->orderby('id','desc')
            ->get();

        if($result){
            $result2 = array('status' => '200', "message" => "Words  successfully.",'data'=>$result);
        } 

        if (empty($result)){
            return response()->json('data not found', 201);
        } else {
            return response()->json($result2, 200);
        }
    } 


    public function addAnswerWordByUser(Request $request){
         $rules = [
            'word_id' => 'required',
            'user_id'=>'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }else{

            $base64image = $request->base64image;
            $extnimage = $request->extimage;
        
            if(!empty($base64image)&&!empty($extnimage)){
                $encodeImage = "data:image/".$extn.";base64,".$base64."";
                $image_parts = explode(";base64,",$encodeImage);  
                $image_base64 = base64_decode($image_parts[1]);
                $fileshopv=uniqid() .time(). '.png';
                $file = public_path('/storage/galeryImages/').$fileshopv;
                file_put_contents($file, $image_base64);
                $word_image_name = $fileshopv;
            }else{
                $word_image_name = '';
            }

            $base64pdf = $request->base64pdf;
            $extnpdf = $request->extpdf;

            if(!empty($base64pdf)&&!empty($extnpdf)){
                $encodeDocument = "data:application/".$extnpdf.";base64,".$base64pdf."";
                $image_parts1 = explode(";base64,",$encodeDocument);  
                $image_base641 = base64_decode($image_parts1[1]);
                $fileshopvPdf=uniqid() .time(). '.pdf';
                $filePdf = public_path('/storage/galeryImages/').$fileshopvPdf;
                file_put_contents($filePdf, $image_base641);
                $word_document_name = $fileshopvPdf;
            }else{
                $word_document_name = '';
            }


            $base64video = $request->base64video;
            $extnvideo = $request->extvideo;

            if(!empty($base64video)&&!empty($extnvideo)){
                $encodeVideo = "data:video/".$extnvideo.";base64,".$base64video."";
                $image_parts2 = explode(";base64,",$encodeVideo);  
                $image_base642 = base64_decode($image_parts2[1]);
                $fileshopvVideo=uniqid() .time(). '.'.$extnvideo;
                $fileVideo = public_path('/storage/galeryImages/').$fileshopvVideo;
                file_put_contents($fileVideo, $image_base642);
                $word_video_name = $fileshopvVideo;
            }else{
                $word_video_name = '';
            }

            $base64audio = $request->base64audio;
            $extnaudio = $request->extaudio;

            if(!empty($base64audio)&&!empty($extnaudio)){
                $encodeAudio = "data:audio/".$extnaudio.";base64,".$base64audio."";
                $image_parts3 = explode(";base64,",$encodeAudio);  
                $image_base643 = base64_decode($image_parts3[1]);
                $fileshopvAudio=uniqid() .time(). '.'.$extnaudio;
                $fileAudio = public_path('/storage/galeryImages/').$fileshopvAudio;
                file_put_contents($fileAudio, $image_base643);
                $word_audio_name = $fileshopvAudio;
            }else{
                $word_audio_name = '';
            }

            $word_image_name    = $word_image_name;
            $word_audio_name    = $word_audio_name;
            $word_video_name    = $word_video_name;
            $word_document_name =  $word_document_name;

            $data = array(
                'word_id'=>$request->word_id,                
                'meaning'=>$request->meaning,
                'synonyms'=>$request->synonyms,
                'antonyms'=>$request->antonyms,            
                'word_image'=>$word_image_name,               
                'word_audio'=>$word_audio_name,
                'word_video'=>$word_video_name,
                'word_document'=>$word_document_name,
                'user_id'=>$request->user_id,               
            );

            $insertAnswer = DB::table('word_answers')->insertGetId($data);

            if($insertAnswer){
                $result=array('status'=>'200','message'=> 'Word  Answer added successfull!.','answer_id'=>$insertAnswer);
                return response()->json($result, 200);
            }else{
               // $result=array('status'=>'false','message'=> 'Something went wrong, Please try again.');
                 return response()->json('Something went wrong', 201);
            }  
        }  

    }

        public function latestWord(Request $request){

        $result = DB::table('words')
            ->join('users', 'users.id', '=', 'words.user_id')  
            ->join('category', 'category.id', '=', 'words.category_id')          
            ->select('words.*', 'users.name', 'users.email','category.category_name')
            ->orderby('id','desc')
            ->limit(3)
            ->get();

        if($result){
            $result2 = array('status' => '200', "message" => "Words  successfully.",'data'=>$result);
        }    
        
    
        if (empty($result)){
            return response()->json('data not found', 201);
        } else {
            return response()->json($result2, 200);
        }
    } 
    

    public function popularWord(Request $request){

        $result = DB::table('popular_words')
            ->join('words', 'words.id', '=', 'popular_words.word_id')           
            ->select('words.*')           
            ->orderby('id','desc')
            ->get();

        if($result){
            $result2 = array('status' => '200', "message" => "Words  successfully.",'data'=>$result);
        }        
    
        if (empty($result)){
            return response()->json('data not found', 201);
        } else {
            return response()->json($result2, 200);
        }
    } 


     public function addWord(Request $request){      

        $rules = [
            'word_name' => 'required',
            'category_id'=>'required',
            'user_id'=>'required'
        ];

        $base64image = $request->base64image;
        $extnimage = $request->extimage;
        
        if(!empty($base64image)&&!empty($extnimage)&&$extnimage != 'undefined'){
            $encodeImage = "data:image/".$extnimage.";base64,".$base64image."";
            $image_parts = explode(";base64,",$encodeImage);  
            $image_base64 = base64_decode($image_parts[1]);
            $fileshopv=uniqid() .time(). '.png';
            $file = public_path('/storage/galeryImages/').$fileshopv;
            file_put_contents($file, $image_base64);
            $word_image_name = $fileshopv;
        }else{
           $word_image_name = '';
        }

        $base64pdf = $request->base64pdf;
        $extnpdf = $request->extpdf;

        if(!empty($base64pdf)&&!empty($extnpdf)&&$extnpdf != 'undefined'){
            $encodeDocument = "data:application/".$extnpdf.";base64,".$base64pdf."";
            $image_parts1 = explode(";base64,",$encodeDocument);  
            $image_base641 = base64_decode($image_parts1[1]);
            $fileshopvPdf=uniqid() .time(). '.pdf';
            $filePdf = public_path('/storage/galeryImages/').$fileshopvPdf;
            file_put_contents($filePdf, $image_base641);
            $word_document_name = $fileshopvPdf;
        }else{
            $word_document_name = '';
        }

        $base64video = $request->base64video;
        $extnvideo = $request->extvideo;

        if(!empty($base64video)&&!empty($extnvideo)&&$extnvideo != 'undefined'){

            $encodeVideo = "data:video/".$extnvideo.";base64,".$base64video."";
            $image_parts2 = explode(";base64,",$encodeVideo);  
            $image_base642 = base64_decode($image_parts2[1]);
            $fileshopvVideo=uniqid() .time(). '.'.$extnvideo;
            $fileVideo = public_path('/storage/galeryImages/').$fileshopvVideo;
            file_put_contents($fileVideo, $image_base642);
            $word_video_name = $fileshopvVideo;
        }else{
            $word_video_name = '';
        }

        $base64audio = $request->base64audio;
        $extnaudio = $request->extaudio;

        if(!empty($base64audio)&&!empty($extnaudio)&&$extnaudio != 'undefined'){

            $encodeAudio = "data:audio/".$extnaudio.";base64,".$base64audio."";
            $image_parts3 = explode(";base64,",$encodeAudio);  
            $image_base643 = base64_decode($image_parts3[1]);
            $fileshopvAudio=uniqid() .time(). '.'.$extnaudio;
            $fileAudio = public_path('/storage/galeryImages/').$fileshopvAudio;
            file_put_contents($fileAudio, $image_base643);
            $word_audio_name = $fileshopvAudio;
        }else{
            $word_audio_name = '';
        }   


       
     
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }else{
            $word_image_name =  $word_image_name;
            $word_audio_name =   $word_audio_name;
            $word_video_name =   $word_video_name;
            $word_document_name =  $word_document_name;            

            $user_id = $request->user_id;

            $data = array(
                'word_name'=>$request->word_name,
                'meaning'=>$request->meaning,
                'synonyms'=>$request->synonyms,
                'antonyms'=>$request->antonyms,
                'add_date'=>date('F j, Y'),
                'update_date'=>date('F j, Y'),
                'word_image'=>$word_image_name,               
                'word_audio'=>$word_audio_name,
                'word_video'=>$word_video_name,
                'word_document'=>$word_document_name,
                'user_id'=>$request->user_id,
                'category_id'=>$request->category_id,
            );

            $insertWord = DB::table('words')->insertGetId($data);

            if($insertWord){
                $result=array('status'=>'200','message'=> 'Word added successfull!.','word_id'=>$insertWord);
                return response()->json($result, 200);
            }else{
               // $result=array('status'=>'false','message'=> 'Something went wrong, Please try again.');
                return response()->json('Something went wrong', 201);
            }      
        }  

         
    }

    public function addWordComment(Request $request){

        $rules = [
            'word_id' => 'required',
            'user_id'=>'required',
            'comment'=>'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }else{
            $data = array(
                'word_id'=>$request->word_id,
                'user_id'=>$request->user_id,
                'comment'=>$request->comment,
                'add_date'=>date("F j, Y, g:i a",time()),
                'update_date'=>date("F j, Y, g:i a")
            );
            $insertComment = DB::table('word_comment')->insert($data);

            if($insertComment){
                $result=array('status'=>'200','message'=> 'Comment added successfull!.');
                return response()->json($result, 200);
            }else{               
                 return response()->json('Something went wrong', 201);
            } 
        }
    }

    public function allCommentByWordId(Request $request){

        $word_id = $request->get('word_id');

        if(!empty( $word_id)){        

            $result = DB::table('word_comment')
                ->join('words', 'words.id', '=', 'word_comment.word_id')
                ->join('users', 'users.id', '=', 'word_comment.user_id')           
                ->select('word_comment.*','users.name as user_name','users.email as user_email','users.profile_image as user_profile','words.word_name')
                ->where('word_id','=',$word_id)
                ->orderby('id','desc')
                ->get();

            $totalComment = DB::table('word_comment')->where('word_id','=',$word_id)->count();

            if($result){
                $result2 = array('status' => '200', "message" => "Words  successfully.",'data'=>$result,'totalComment'=> $totalComment);
            }     
        
            if (empty($result)){
                return response()->json('data not found', 201);
            } else {
                return response()->json($result2, 200);
            }
        }
    }

    public function wordOfTheDay(Request $request){

        $today_date = date('F j, Y');

        $result = DB::table('words')
            ->join('users', 'users.id', '=', 'words.user_id')  
            ->join('category', 'category.id', '=', 'words.category_id')          
            ->select('words.*', 'users.name', 'users.email','category.category_name')
            ->where('words.add_date','=',$today_date)
            ->where('words.type','=','wordOfTheDay')
            ->orderby('id','desc')
            ->get();

        if(count($result)>0){
            $result2 = array('status' => '200', "message" => "Words  successfully.",'data'=>$result);
        }else{
            $result = DB::table('words')
            ->join('users', 'users.id', '=', 'words.user_id')  
            ->join('category', 'category.id', '=', 'words.category_id')          
            ->select('words.*', 'users.name', 'users.email','category.category_name')            
            ->where('words.type','=','wordOfTheDay')
            ->orderby('id','desc')
            ->limit(1)
            ->get();
            $result2 = array('status' => '200', "message" => "Words  successfully.",'data'=>$result);
        }        
    
        if (empty($result)){
            return response()->json('data not found', 201);
        } else {
            return response()->json($result2, 200);
        }

    }


    public function upvoteDownvoteSystem(Request $request){
        $user_id = $request->user_id;
        $word_id = $request->word_id;
        $action = $request->action;

        $user_exists = DB::table('word_like_system')->where('user_id','=',$user_id)->get();
        $c = [];       

        if(count($user_exists)>0){
            DB::table('word_like_system')->where('user_id','=',$user_id)->update(['action'=>$action]);
        }else{
            $data = array(
                'user_id'=>$user_id,
                'word_id'=>$word_id,
                'action'=>$action,
                'add_date'=>date('F j, Y')
            );
            DB::table('word_like_system')->insert($data);
        }

        $count = DB::table('word_like_system')->where('action','=','upvote')->where('word_id','=', $word_id)->count();
        $data2 = array(
            'total_upvote'=>$count
        );

        $result2 = array('status' => '200', "message" => "Like Dislike System",'data'=>$data2);
        return response()->json($result2, 200);  
    }

    public function totalWordUpvote(Request $request){
        $word_id =  $request->get('word_id');
        $count = DB::table('word_like_system')->where('action','=','upvote')->where('word_id','=', $word_id)->count();

        if(empty($count)){
            $count = 0;
        }
        $data2 = array('total_upvote'=>$count );
        $result2 = array('status' => '200', "message" => "Like Dislike System",'data'=>$data2);
        return response()->json($result2, 200); 
    }

    public function wordSubscription(Request $request){

        $rules = [
            'email' => 'required|unique:word_subscription',           
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }else{
            $email = $request->email;
            if(!empty($email)){
                $data = array(
                    'email'=>$email,
                    'add_date'=>date('F j, Y')
                );
                $insert_id = DB::table('word_subscription')->insertGetId($data);
            }
            if($insert_id){
                $data2 = array('insert_id'=>$insert_id);
                $result2 = array('status' => '200', "message" => "Subscription success",'data'=>$data2);
                return response()->json($result2, 200);
            }else{
                return response()->json('data not found', 201);
            }
        }       
        
    }

    public function wordAllCategory(){

        $result = DB::table('category')            
            ->orderby('id','desc')
            ->get();

        if($result){
            $result2 = array('status' => '200', "message" => "All Words Category.",'data'=>$result);
        }        
    
        if (empty($result)){
            return response()->json('data not found', 201);
        } else {
            return response()->json($result2, 200);
        }
    }
  
}
