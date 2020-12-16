<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    public function index() {
      	$pageTitle = 'Subscription';
        $allSubscription = DB::table('subscription')            
            ->orderby('id','desc')
            ->paginate(5);
        return view('subscription.index',compact('allSubscription','pageTitle'));
    }  
  

    public function addSubscription() {
        $pageTitle = 'Add Subscription';       
    	return view('subscription.addSubscription',compact('pageTitle'));
    }

    public function addSubscriptionSubmit(Request $request) {
        $rules = array(
            'title'=>'required',
            'price'=>'required'
        );    

        $validation = Validator::make($request->all(), $rules);     

        if($validation->passes())  {        

            $user_id = $request->session()->get('log_base');
            $data = array(
                'title'=>$request->title,
                'price'=>$request->price,                           
                'user_id'=>base64_decode($user_id),                
            );

            $insertSubscription = DB::table('subscription')->insertGetId($data);

            if($insertSubscription){
                $item = $request->item;              
                
                for($count = 0; $count < count($item); $count++) {
                    $data1 = array(
                        'item' => $item[$count],
                        'subscription_id'  => $insertSubscription
                    );
                    DB::table('subscription_item')->insert($data1);              
                }
                               
                $result=array('status'=>'true','message'=> 'Subscription added successfully!.');
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
                //'update_date'=>date('F j, Y h:i:sa' ),
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

    public function viewSubscription($id){
        $pageTitle = 'View Subscription';
        $subscription = DB::table('subscription')->find($id);
        $items = DB::table('subscription_item')->where('subscription_id',$subscription->id)->get();
        return view('subscription.viewSubscription',compact('subscription','pageTitle','items'));
    }

    public function deleteSubscription(Request $request)  {
        $record_id = $request->record_id;
        $deleteSubscription = DB::table('subscription')->where('id',$record_id)->delete();
        if($deleteSubscription){
            $result=array('status'=>'true','message'=> 'Subscription deleted successfull!.');
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
