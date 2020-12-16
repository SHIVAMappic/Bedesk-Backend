<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function index() {
      	$pageTitle = 'BLOGS';
        $allBlogs = DB::table('blogs')
            ->join('users', 'users.id', '=', 'blogs.user_id')
            ->join('blog_category', 'blog_category.id', '=', 'blogs.category_id')           
            ->select('blogs.*', 'users.name', 'users.email','blog_category.category_name')
            ->orderby('id','desc')
            ->paginate(2);
        return view('blogs.index',compact('allBlogs','pageTitle'));
    }
   
   /* public function fetch_data(Request $request) {
        if($request->ajax()) {
            $allBlogs = DB::table('blogs')
                ->join('users', 'users.id', '=', 'blogs.user_id')
                ->join('blog_category', 'blog_category.id', '=', 'blogs.category_id')           
                ->select('blogs.*', 'users.name', 'users.email','blog_category.category_name')
                ->orderby('id','desc')
                ->paginate(2);
            return view('blogs.pagination_data', compact('allBlogs'))->render();
        }
    }*/

    public function addBlog() {
        $pageTitle = 'Add BLOG';
        $allCategories = DB::table('blog_category')->orderby('id','desc')->get();
    	return view('blogs.addBlog',compact('allCategories','pageTitle'));
    }

    public function addBlogSubmit(Request $request) {
        $rules = array(
            'title'=>'required',
            'content'=>'required'
        );

        if($request->file('blog_image'))
        {
            $rules1 = array('blog_image' => 'image|mimes:jpeg,png,jpg' );
            $rules = array_merge($rules,$rules1);
        }

        $validation = Validator::make($request->all(), $rules);     

        if($validation->passes())  {

            if ($request->hasFile('blog_image')) {
                $image = $request->file('blog_image');
                $blog_image_name = time().'1_'.$image->getClientOriginalName();
                $destinationPath = public_path('/storage/galeryImages/');
                $image->move($destinationPath,$blog_image_name);
            }
            else {
                 $blog_image_name = '';
            }

            $user_id = $request->session()->get('log_base');
            $data = array(
                'title'=>$request->title,
                'content'=>$request->content,                
                'add_date'=>date('F j, Y'),
                'update_date'=>date('F j, Y'),
                'blog_image'=>$blog_image_name,                
                'user_id'=>base64_decode($user_id),
                'category_id'=>$request->category,
            );

            $insertBlog = DB::table('blogs')->insert($data);

            if($insertBlog){
                $result=array('status'=>'true','message'=> 'Blog added successfull!.');
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

    public function editBlog($id){
        $pageTitle = 'Edit BLOG';
        $blogs = DB::table('blogs')->find($id);
        $allCategories = DB::table('blog_category')->orderby('id','desc')->get();
        return view('blogs.editBlog',compact('blogs','allCategories','pageTitle'));
    }

    public function editBlogSubmit(Request $request) {
    	$blogs = DB::table('blogs')->find($request->record_id);

        $rules = array(
            'title'=>'required',
            'content'=>'required'
        );

        if($request->file('blog_image'))  {
            $rules1 = array('blog_image' => 'image|mimes:jpeg,png,jpg' );
            $rules = array_merge($rules,$rules1);
        }      

        $validation = Validator::make($request->all(), $rules);     

        $blog_image_name =$blogs->blog_image;       

        if($validation->passes())  { 

            if ($request->hasFile('blog_image')) {
                $image = $request->file('blog_image');
                $blog_image_name = time().'1_'.$image->getClientOriginalName();
                $destinationPath = public_path('/storage/galeryImages/');
                $image->move($destinationPath,$blog_image_name);
            }
            else{
                 $blog_image_name = $blogs->blog_image;
            }        


            $user_id = $request->session()->get('log_base');

            $data = array(
                'title'=>$request->title,
                'content'=>$request->content,           
                'update_date'=>date('F j, Y'),
                'blog_image'=>$blog_image_name,                
                'user_id'=>base64_decode($user_id),
                'category_id'=>$request->category,
            );          

            $updateBlog = DB::table('blogs')->where('id',$request->record_id)->update($data);

            if($updateBlog){
                $result=array('status'=>'true','message'=> 'Blog updated successfull!.');
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

    public function viewBlog($id){
        $pageTitle = 'View BLOG';
        $blogs = DB::table('blogs')->find($id);
        return view('blogs.viewBlog',compact('blogs','pageTitle'));
    }

    public function deleteBlog(Request $request)  {
        $record_id = $request->record_id;
        $deleteBlog = DB::table('blogs')->where('id',$record_id)->delete();
        if($deleteBlog){
            $result=array('status'=>'true','message'=> 'Blog deleted successfull!.');
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
