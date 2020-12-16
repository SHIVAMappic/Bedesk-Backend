<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;





class CategoryController extends Controller
{
    public function index() {
        $pageTitle = 'Category';
    	$allCategories = DB::table('category')->orderby('id','desc')->get();
       // $allCategories = DB::table('words')->where('category_id','desc')->get();
    	return view('category.index',compact('allCategories','pageTitle'));

         /*$allCategories = DB::table('category')
            ->join('words', 'words.category_id', '=', 'category.id')           
            ->select('category.*', 'words.category_id')
            ->orderby('id','desc')
            ->get();

            return view('category.index',compact('allCategories','pageTitle'));*/
    }

    public function addCategory() {
        $pageTitle = 'Add Category';
    	return view('category.addCategory',compact('pageTitle'));
    }

    public function addCategorySubmit(Request $request){        

        $data = array(
            'category_name'=>$request->category_name,           
            'add_date'=>date('F j, Y'),
            'update_date'=>date('F j, Y'),         

        );

        $insertCategory = DB::table('category')->insert($data);

        if($insertCategory){
            $result=array('status'=>'true','message'=> 'Category added successfully!.');
        }else{
            $result=array('false'=>'true','message'=> 'Something went wrong, Please try again.');
        }

        echo json_encode($result);


    }

    public function editCategory($id){
        $pageTitle = 'Edit Category';
         $categories = DB::table('category')->find($id);
        return view('category.editCategory',compact('categories','pageTitle'));

    }


    public function editCategorySubmit(Request $request){

          
         $data = array(
            'category_name'=>$request->category_name,                      
            'update_date'=>date('F j, Y'),  

        );

        $updateCategory = DB::table('category')->where('id',$request->record_id)->update($data);

        if($updateCategory){
            $result=array('status'=>'true','message'=> 'Category updated successfull!.');
        }else{
            $result=array('false'=>'true','message'=> 'Something went wrong, Please try again.');
        }

        echo json_encode($result);

    }

    public function viewCategory($id){
        $pageTitle = 'View Category';
        $categories = DB::table('category')->find($id);
        return view('category.viewCategory',compact('categories','pageTitle'));
    }

    public function deleteCategory(Request $request)
    {
        $record_id = $request->record_id;
        $deleteCategory = DB::table('category')->where('id',$record_id)->delete();
        if($deleteCategory){
            $result=array('status'=>'true','message'=> 'Category deleted successfull!.');
        }else{
            $result=array('false'=>'true','message'=> 'Something went wrong, Please try again.');
        }

        echo json_encode($result);

    }

    public function wordCategory($id){
        $pageTitle = 'Category';
        $allWords = DB::table('words')
            ->join('users', 'users.id', '=', 'words.user_id')                      
            ->select('words.*', 'users.name', 'users.email')
            ->orderby('id','desc')
            ->where('words.category_id','=',$id)
            ->get();
        return view('category.wordCategory',compact('allWords','pageTitle'));
    }



}
