<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;





class DMSController extends Controller
{
    public function index() {
        $pageTitle = 'Words';
    	

        $allWords = DB::table('words')
            ->join('users', 'users.id', '=', 'words.user_id')           
            ->select('words.*', 'users.name', 'users.email')
            ->orderby('id','desc')
            ->get();
        return view('dms.index',compact('allWords','pageTitle'));
    }

    public function addWord() {
        $pageTitle = 'Add Word';
        $allCategories = DB::table('category')->orderby('id','desc')->get();
    	return view('dms.addWord',compact('allCategories','pageTitle'));
    }

    public function addWordSubmit(Request $request){

        $rules = array(
            'word_name'=>'required',
            'category'=>'required'
        );


        if($request->file('word_image'))
        {
            $rules1 = array('word_image' => 'image|mimes:jpeg,png,jpg' );
            $rules = array_merge($rules,$rules1);
        }

        if($request->file('word_audio'))
        {
            $rules2 = array('word_audio' => 'mimes:mp3,mp4' );
            $rules = array_merge($rules,$rules2);
        }

        if($request->file('word_video'))
        {
            $rules3 = array('word_video' => 'mimes:mp4,3gp' );
            $rules = array_merge($rules,$rules3);
        }

        if($request->file('word_document'))
        {
            $rules4 = array('word_document' => 'mimes:pdf' );
            $rules = array_merge($rules,$rules4);
        }

        $validation = Validator::make($request->all(), $rules);
      

        $word_image_name = '';
        $word_audio_name = '';
        $word_video_name = '';
        $word_document_name = '';

        if($validation->passes())  {     



            if ($request->hasFile('word_image')) {
                $image = $request->file('word_image');
                $word_image_name = time().'1_'.$image->getClientOriginalName();
                $destinationPath = public_path('/storage/galeryImages/');
                $image->move($destinationPath,$word_image_name);
            }
            else{
                 $word_image_name = '';
            }           

            if ($request->hasFile('word_audio')) {
                $image = $request->file('word_audio');
                $word_audio_name = time().'2_'.$image->getClientOriginalName();
                $destinationPath = public_path('/storage/galeryImages/');
                $image->move($destinationPath,$word_audio_name);
            } 
            else{
                 $word_audio_name = '';
            }            

            if ($request->hasFile('word_video')) {
                $image = $request->file('word_video');
                $word_video_name = time().'3_'.$image->getClientOriginalName();
                $destinationPath = public_path('/storage/galeryImages/');
                $image->move($destinationPath,$word_video_name);
            }  
            else{
                 $word_video_name = '';
            }           

            if ($request->hasFile('word_document')) {
                $image = $request->file('word_document');
                $word_document_name = time().'4_'.$image->getClientOriginalName();
                $destinationPath = public_path('/storage/galeryImages/');
                $image->move($destinationPath,$word_document_name);
            }   
            else{
                 $word_document_name = '';
            }   


             $user_id = $request->session()->get('log_base');


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
                'user_id'=>base64_decode($user_id),
                'category_id'=>$request->category,
            );

            $insertWord = DB::table('words')->insert($data);

            if($insertWord){
                $result=array('status'=>'true','message'=> 'Word added successfull!.');
            }else{
                $result=array('status'=>'false','message'=> 'Something went wrong, Please try again.');
            }        

        }
        else{
            $errors = $validation->errors()->all();
             $result=array('status'=>'false','errors'=> $errors);

        }

       

        echo json_encode($result);


    }

    public function editWord($id){
        $pageTitle = 'Edit Word';
        $words = DB::table('words')->find($id);
        $allCategories = DB::table('category')->orderby('id','desc')->get();
        return view('dms.editWord',compact('words','pageTitle','allCategories'));

    }


    public function editWordSubmit(Request $request){

        $words = DB::table('words')->find($request->record_id);

        $rules = array(
            'word_name'=>'required',
            'category'=>'required'
        );


        if($request->file('word_image'))
        {
            $rules1 = array('word_image' => 'image|mimes:jpeg,png,jpg' );
            $rules = array_merge($rules,$rules1);
        }

        if($request->file('word_audio'))
        {
            $rules2 = array('word_audio' => 'mimes:mp3,mp4' );
            $rules = array_merge($rules,$rules2);
        }

        if($request->file('word_video'))
        {
            $rules3 = array('word_video' => 'mimes:mp4,3gp' );
            $rules = array_merge($rules,$rules3);
        }

        if($request->file('word_document'))
        {
            $rules4 = array('word_document' => 'mimes:pdf' );
            $rules = array_merge($rules,$rules4);
        }

        $validation = Validator::make($request->all(), $rules);
      

        $word_image_name =$words->word_image;
        $word_audio_name = $words->word_audio;
        $word_video_name = $words->word_video;
        $word_document_name = $words->word_document;

        if($validation->passes())  {     



            if ($request->hasFile('word_image')) {
                $image = $request->file('word_image');
                $word_image_name = time().'1_'.$image->getClientOriginalName();
                $destinationPath = public_path('/storage/galeryImages/');
                $image->move($destinationPath,$word_image_name);
            }
            else{
                 $word_image_name = $words->word_image;
            }           

            if ($request->hasFile('word_audio')) {
                $image = $request->file('word_audio');
                $word_audio_name = time().'2_'.$image->getClientOriginalName();
                $destinationPath = public_path('/storage/galeryImages/');
                $image->move($destinationPath,$word_audio_name);
            } 
            else{
                 $word_audio_name = $words->word_audio;
            }            

            if ($request->hasFile('word_video')) {
                $image = $request->file('word_video');
                $word_video_name = time().'3_'.$image->getClientOriginalName();
                $destinationPath = public_path('/storage/galeryImages/');
                $image->move($destinationPath,$word_video_name);
            }  
            else{
                 $word_video_name = $words->word_video;
            }           

            if ($request->hasFile('word_document')) {
                $image = $request->file('word_document');
                $word_document_name = time().'4_'.$image->getClientOriginalName();
                $destinationPath = public_path('/storage/galeryImages/');
                $image->move($destinationPath,$word_document_name);
            }   
            else{
                 $word_document_name = $words->word_document;
            }   


             $user_id = $request->session()->get('log_base');


            $data = array(
                'word_name'=>$request->word_name,
                'meaning'=>$request->meaning,
                'synonyms'=>$request->synonyms,
                'antonyms'=>$request->antonyms,                
                'update_date'=>date('F j, Y'),
                'word_image'=>$word_image_name,
                'word_audio'=>$word_audio_name,
                'word_video'=>$word_video_name,
                'word_document'=>$word_document_name,
                'user_id'=>base64_decode($user_id),
                'category_id'=>$request->category,
            );

             $updateWord = DB::table('words')->where('id',$request->record_id)->update($data);

            if($updateWord){
                $result=array('status'=>'true','message'=> 'Word updated successfull!.');
            }else{
                $result=array('status'=>'false','message'=> 'Something went wrong, Please try again.');
            }        

        }
        else{
             $errors = $validation->errors()->all();
             $result=array('status'=>'false','errors'=> $errors);
        }

         echo json_encode($result);      
       

    }

    public function viewWord($id){
        $pageTitle = 'View Word';
        $words = DB::table('words')->find($id);

        return view('dms.viewWord',compact('words','pageTitle'));
    }

    public function deleteWord(Request $request)
    {
        $record_id = $request->record_id;
        $deleteWord = DB::table('words')->where('id',$record_id)->delete();
        if($deleteWord){
            $result=array('status'=>'true','message'=> 'Word deleted successfull!.');
        }else{
            $result=array('false'=>'true','message'=> 'Something went wrong, Please try again.');
        }

        echo json_encode($result);

    }



}
