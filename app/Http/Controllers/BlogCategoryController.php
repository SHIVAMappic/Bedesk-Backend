<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogCategoryController extends Controller
{
    public function index() {
        $pageTitle = 'Category ';
        $allCategory = DB::table('blog_category')            
                     ->orderby('id','desc')
                     ->get();
        return view('blog-category.index',compact('allCategory','pageTitle'));
    }

    public function addBlogCategory() {
        $pageTitle = 'Add Category';        
    	return view('blog-category.addCategory',compact('pageTitle'));
    }

    public function addBlogCategorySubmit(Request $request){
        $rules = array(
            'category_name'=>'required'           
        );
        $validation = Validator::make($request->all(), $rules);       


            $data = array(
                'category_name'=>$request->category_name,                
                'add_date'=>date('F j, Y'),
                'update_date'=>date('F j, Y')                
            );

            $insertBlog = DB::table('blog_category')->insert($data);

            if($insertBlog){
                $result=array('status'=>'true','message'=> 'Category added successfull!.');
            }else{
                $result=array('status'=>'false','message'=> 'Something went wrong, Please try again.');
            }     

   

        echo json_encode($result);
    }

    public function editBlogCategory($id){
        $pageTitle = 'Edit Category';
        $categories = DB::table('blog_category')->find($id);
        return view('blog-category.editCategory',compact('categories','pageTitle'));
    }


    public function editBlogCategorySubmit(Request $request){

        $categories = DB::table('blog_category')->find($request->record_id);

        $rules = array(
            'category_name'=>'required'            
        );
        

        $validation = Validator::make($request->all(), $rules);      



        if($validation->passes())  { 
            $user_id = $request->session()->get('log_base');


            $data = array(
                'category_name'=>$request->category_name,             
                'update_date'=>date('F j, Y')                
            );

            $updateCategory = DB::table('blog_category')->where('id',$request->record_id)->update($data);

            if($updateCategory){
                $result=array('status'=>'true','message'=> 'Category updated successfull!.');
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

    public function deleteBlogCategory(Request $request)
    {
        $record_id = $request->record_id;
        $deleteBlogCategory = DB::table('blog_category')->where('id',$record_id)->delete();
        if($deleteBlogCategory){
            $result=array('status'=>'true','message'=> 'Category deleted successfull!.');
        }else{
            $result=array('false'=>'true','message'=> 'Something went wrong, Please try again.');
        }

        echo json_encode($result);

    }



}
