<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;


class blogListingController extends Controller{

	public function index(Request $request){

        $result = DB::table('blogs')
            ->join('users', 'users.id', '=', 'blogs.user_id')
            ->join('blog_category', 'blog_category.id', '=', 'blogs.category_id')            
            ->select('blogs.*', 'users.name', 'users.email','blog_category.category_name')
            ->orderby('id','desc')
            ->get();

        if($result){
            $result2 = array('status' => '200', "message" => "Blogs  successfully.",'data'=>$result);
        } 
    
        if (empty($result)){
            return response()->json('data not found', 201);
        } else {
            return response()->json($result2, 200);
        }
    } 

    public function latestBlog(){
        $result = DB::table('blogs')
            ->join('users', 'users.id', '=', 'blogs.user_id')
            ->join('blog_category', 'blog_category.id', '=', 'blogs.category_id')            
            ->select('blogs.*', 'users.name as user_name', 'users.email as user_email','blog_category.category_name as category_name','blog_category.id as category_id')
            ->orderby('id','desc')
            ->take(3)
            ->get();

        if($result){
            $result2 = array('status' => '200', "message" => "Blogs  successfully.",'data'=>$result);
        } 
    
        if (empty($result)){
            return response()->json('data not found', 201);
        } else {
            return response()->json($result2, 200);
        }

    }

    public function getBlogById(Request $request){

        $query = $request->get('blogid');
        if($query != '')
        {

            $result = DB::table('blogs')
            ->join('users', 'users.id', '=', 'blogs.user_id')
            ->join('blog_category', 'blog_category.id', '=', 'blogs.category_id')            
            ->select('blogs.*', 'users.name', 'users.email','blog_category.category_name')
            ->where('blogs.id','=',$query)
            ->orderby('id','desc')
            ->get();

            if($result){
                $result2 = array('status' => '200', "message" => "Blogs  successfully.",'data'=>$result);
            } 
        
            if (empty($result)){
                return response()->json('data not found', 201);
            } else {
                return response()->json($result2, 200);
            }
        }     

    }

    public function blogAllCategory(Request $request){

        $result = DB::table('blog_category')                    
            ->select('blog_category.*')
            ->orderby('id','desc')
            ->get();

        if($result){
            $result2 = array('status' => '200', "message" => "Category  successfully.",'data'=>$result);
        }        
    
        if (empty($result)){
            return response()->json('data not found', 201);
        } else {
            return response()->json($result2, 200);
        }
    } 


    public function blogByCategory(Request $request){

        $query = $request->get('categoryid');
        if($query != '') {

            $result = DB::table('blogs')
                ->join('users', 'users.id', '=', 'blogs.user_id')
                ->join('blog_category', 'blog_category.id', '=', 'blogs.category_id')            
                ->select('blogs.*', 'users.name', 'users.email','blog_category.category_name')
                ->where('blogs.category_id','=',$query)
                ->orderby('id','desc')
                ->get();

            if($result){
                $result2 = array('status' => '200', "message" => "Blogs  successfully.",'data'=>$result);
            } 
    
            if (empty($result)){
                return response()->json('data not found', 201);
            } else {
                return response()->json($result2, 200);
            }
        }
    }   

    public function addBlogComment(Request $request){
        $rules = [
            'name' => 'required',
            'email'    => 'required',
            'website' => 'required',
            'message'=>'required',
            'blog_id'=>'required'
        ];
       
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }else {
            $name     = $request->name;
            $email    = $request->email;
            $website  = $request->website;
            $message  = $request->message;

            $data = array(
                'name'=>$name,
                'email'=>$email,
                'website'=>$website,
                'message'=>$message,
                'blog_id'=>$request->blog_id,
               	'add_date'=>date("F j, Y, g:i a",time()),
                'update_date'=>date("F j, Y, g:i a")
            );

            $insert  = DB::table('blog_comment')->insertGetId($data);           

            if($insert){
                $result2 = array('status' => '200', "message" => "Comment  successfully submitted.");
                return response()->json($result2, 200);
            }else{
                return response()->json('Something went wrong', 201);
            }        
        }

    }

    public function allCommentByBlogId(Request $request){
    	$blog_id = $request->get('blog_id');

        if(!empty($blog_id)){        

            $result = DB::table('blog_comment')
                ->join('blogs', 'blogs.id', '=', 'blog_comment.blog_id')                         
                ->select('blog_comment.*','blogs.title as blog_title')
                ->where('blog_id','=',$blog_id)
                ->orderby('id','desc')
                ->get();

            $totalComment = DB::table('blog_comment')->where('blog_id','=',$blog_id)->count();

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
  
}
