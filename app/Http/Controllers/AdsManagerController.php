<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdsManagerController extends Controller
{
    public function index() {
      	$pageTitle = 'Ads Manager';
        $allAdsManager = DB::table('ads_manager')            
            ->orderby('id','desc')
            ->paginate(5);
        return view('ads-manager.index',compact('allAdsManager','pageTitle'));
    }
   
  

    public function addAdsManager() {
        $pageTitle = 'Add Ads';
        //$allCategories = DB::table('blog_category')->orderby('id','desc')->get();
    	return view('ads-manager.addAds',compact('pageTitle'));
    }

    public function addAdsManagerSubmit(Request $request) {
        $rules = array(
            'title'=>'required',
            'description'=>'required'
        );

        if($request->file('image'))
        {
            $rules1 = array('image' => 'image|mimes:jpeg,png,jpg' );
            $rules = array_merge($rules,$rules1);
        }

        $validation = Validator::make($request->all(), $rules);     

        if($validation->passes())  {

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_name = time().'1_'.$image->getClientOriginalName();
                $destinationPath = public_path('/storage/galeryImages/');
                $image->move($destinationPath,$image_name);
            }
            else {
                 $image_name = '';
            }

            $user_id = $request->session()->get('log_base');
            $data = array(
                'title'=>$request->title,
                'description'=>$request->description,  
                'link'=>$request->link,              
               // 'add_date'=>date('F j, Y h:i:sa'),
               // 'update_date'=>date('F j, Y'),
                'image'=>$image_name,                
                'user_id'=>base64_decode($user_id),                
            );

            $insertAds = DB::table('ads_manager')->insert($data);

            if($insertAds){
                $result=array('status'=>'true','message'=> 'Ads added successfully!.');
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
                $result=array('status'=>'false','message'=> 'Something went wrong, Please try again.','errors'=>array());
            }        

        }
        else{
             $errors = $validation->errors()->all();
             $result=array('status'=>'false','errors'=> $errors);
        }
        echo json_encode($result);    

    }

    public function viewAdsManager($id){
        $pageTitle = 'View Ads';
        $ads = DB::table('ads_manager')->find($id);
        return view('ads-manager.viewAds',compact('ads','pageTitle'));
    }

    public function deleteAds(Request $request)  {
        $record_id = $request->record_id;
        $deleteAds = DB::table('ads_manager')->where('id',$record_id)->delete();
        if($deleteAds){
            $result=array('status'=>'true','message'=> 'Ads  deleted successfull!.');
        }else{
            $result=array('false'=>'true','message'=> 'Something went wrong, Please try again.');
        }
        echo json_encode($result);
    }

    public function blogComment() {
        $pageTitle = 'BLOGS Comment';
        $allComments = DB::table('blog_comment')
            ->join('users', 'users.id', '=', 'blog_comment.user_id')
            ->join('blogs', 'blogs.id', '=', 'blog_comment.blog_id')           
            ->select('comment.*', 'users.name', 'users.email','blogs.word_name')
            ->orderby('id','desc')
            ->get();           
        return view('blog-comment.index',compact('allComments','pageTitle'));
    }

}
