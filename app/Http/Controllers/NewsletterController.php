<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class NewsletterController extends Controller
{
    public function index() {
      	$pageTitle = 'Newsletter';
        $allNewsletter = DB::table('newsletter')            
            ->orderby('id','desc')
            ->paginate(5);
        return view('newsletter.index',compact('allNewsletter','pageTitle'));
    } 

    public function subscribers(){
        $pageTitle = 'Subscribers';
        $allSubscribers = DB::table('word_subscription')            
            ->orderby('id','desc')
            ->paginate(10);
        return view('newsletter.subscribers',compact('allSubscribers','pageTitle'));
    }  
  

    public function addNewsletter() {
        $pageTitle = 'Add Newsletter';        
    	return view('newsletter.addNewsletter',compact('pageTitle'));
    }

    public function addNewsletterSubmit(Request $request) {
        $rules = array(
            'title'=>'required',
            //'content'=>'required'
        );
     
        $validation = Validator::make($request->all(), $rules);     

        if($validation->passes())  {       

            $user_id = $request->session()->get('log_base');
            $data = array(
                'title'=>$request->title,
                'content'=>$request->content,                     
                'user_id'=>base64_decode($user_id),                
            );

            $insertNewsletter = DB::table('newsletter')->insertGetId($data);

                        

            if($insertNewsletter){

                $allSubscribers = DB::table('word_subscription')            
                    ->orderby('id','desc')
                    ->get(); 

                    
                foreach( $allSubscribers as $subscriber){
                 $data = array(
                    'title'      =>  $request->title,
                    'content'   =>   $request->content
                );
                Mail::to($subscriber->email)->send(new SendMail($data));              

            } 
                $result=array('status'=>'true','message'=> 'Newsletter added successfully!.');
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

    public function editAdsManager($id){
        $pageTitle = 'Edit Ads';
        $ads = DB::table('ads_manager')->find($id);        
        return view('ads-manager.editAds',compact('ads','pageTitle'));
    }

    public function editAdsManagerSubmit(Request $request) {
    	$ads = DB::table('ads_manager')->find($request->record_id);

        $rules = array(
            'title'=>'required',
            'description'=>'required'
        );

        if($request->file('image'))  {
            $rules1 = array('image' => 'image|mimes:jpeg,png,jpg' );
            $rules = array_merge($rules,$rules1);
        }      

        $validation = Validator::make($request->all(), $rules);     

        $image_name =$ads->image;       

        if($validation->passes())  { 

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_name = time().'1_'.$image->getClientOriginalName();
                $destinationPath = public_path('/storage/galeryImages/');
                $image->move($destinationPath,$image_name);
            }
            else{
                 $image_name = $ads->image;
            } 

            $user_id = $request->session()->get('log_base');

            $data = array(
                'title'=>$request->title,
                'description'=>$request->description,  
                'link'=>$request->link,              
                'image'=>$image_name,                
                'user_id'=>base64_decode($user_id),
            );          

            $updateAds = DB::table('ads_manager')->where('id',$request->record_id)->update($data);

            if($updateAds){
                $result=array('status'=>'true','message'=> 'Ads updated successfull!.');
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

    public function viewNewsletter($id){
        $pageTitle = 'View Newsletter';
        $newsletter = DB::table('newsletter')->find($id);
        return view('newsletter.viewNewsletter',compact('newsletter','pageTitle'));
    }

    public function deleteNewsletter(Request $request)  {
        $record_id = $request->record_id;
        $deleteNewsletter = DB::table('newsletter')->where('id',$record_id)->delete();
        if($deleteNewsletter){
            $result=array('status'=>'true','message'=> 'Newsletter deleted successfull!.');
        }else{
            $result=array('false'=>'true','message'=> 'Something went wrong, Please try again.');
        }
        echo json_encode($result);
    }
    

}
