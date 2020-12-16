<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PopularWordController extends Controller
{
    public function index() {
        $pageTitle = 'Popular Words';   	

        $allWords = DB::table('popular_words')
            ->join('words', 'words.id', '=', 'popular_words.word_id') 
            ->join('category', 'category.id', '=', 'words.category_id')           
            ->select('popular_words.*', 'words.word_name','category.category_name')
            ->orderby('id','desc')
            ->get();
        return view('popularWord.index',compact('allWords','pageTitle'));
    }

    public function getWordBySearchTerm(Request $request){
         $query = $request->get('query');
          if($query != '')
            {
                $data = DB::table('words')
             ->where('word_name', 'like', '%'.$query.'%')            
             ->orderBy('id', 'desc')
             ->get(); 
             $output = '<ul  style="list-style:none;">';

             foreach($data as $value){
                $output .= '<li  data-id="'.$value->id.'"  data-word = "'.$value->word_name.'" onclick="GetWordById(this)">'.$value->word_name.'</li>';
             }  

             $output .= '</ul>';
             //$output .= '<script>function GetWordById(id){alert(id);}</script>';
             return response()->json($output);
            }

    }

    public function addPopularWord() {
        $pageTitle = 'Add Popular Word';        
        $allWords = DB::table('words')->orderby('id','desc')->get();
    	return view('popularWord.addPopularWord',compact('allWords','pageTitle'));
    }

    public function addPopularWordSubmit(Request $request){

        $user_id = $request->session()->get('log_base');
        if(empty($request->word_id)){
            $result=array('status'=>'false','message'=> 'This word not exists.');
            echo json_encode($result);

        } else {
            $data = array(
                'word_id'=>$request->word_id,                
                'add_date'=>date('F j, Y'),
                'update_date'=>date('F j, Y')               
            );

            $insertWord = DB::table('popular_words')->insert($data);

            if($insertWord){
                $result=array('status'=>'true','message'=> 'Word added successfull!.');
            }else{
                $result=array('status'=>'false','message'=> 'Something went wrong, Please try again.');
            }
            echo json_encode($result);
        }
       
    }

    public function editWord($id){
        $pageTitle = 'Edit Word';
         $words = DB::table('words')->find($id);
        return view('dms.editWord',compact('words','pageTitle'));

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

    public function viewPopularWord($id){
        $pageTitle = 'View Popular Word';
        $pwords = DB::table('popular_words')->find($id);
        $words = DB::table('words')->find($pwords->word_id);
         /* $words = DB::table('popular_words')
            ->join('words', 'words.id', '=','popular_words.word_id') 
            ->join('category', 'category.id', '=', 'words.category_id')           
            ->select('words.*','category.category_name')  
            ->where('popular_words.id',$id)         
            ->get();*/
            //echo $words->word_name;

           /* $words = DB::table('words')->select('words.*', 'category.category_name')
                ->join('popular_words', 'popular_words.word_id', '=', 'words.id')
                ->join('category', 'category.id', '=', 'words.category_id')
                ->where('words.id',$id)                
                ->first();*/



           // echo '<pre>';print_r($words);die;

        return view('popularWord.viewPopularWord',compact('words','pageTitle'));
    }

    public function deletePopularWord(Request $request)
    {
        $record_id = $request->record_id;
        $deleteWord = DB::table('popular_words')->where('id',$record_id)->delete();
        if($deleteWord){
            $result=array('status'=>'true','message'=> 'Word deleted successfull!.');
        }else{
            $result=array('false'=>'true','message'=> 'Something went wrong, Please try again.');
        }

        echo json_encode($result);

    }



}
