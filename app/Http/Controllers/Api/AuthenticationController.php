<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;


class AuthenticationController extends Controller{

	public function categoriesApi(Request $request){
        $popularCategory = Category::where('deleted', 0)->where('status', 'Active')->where('p_id', 0)->get();
        $result = array();
        foreach ($popularCategory as $key => $val) {
            $result[$key]['id'] = $val->id;
            $result[$key]['name'] = $val->name;
            $result[$key]['slug'] = $val->slug;
           // $result[$key]['image'] = $val->image;
            $result[$key]['description'] = $val->excerpt ? $val->excerpt : '';

            $subCategory = Category::where("p_id", $val->id)->where('deleted', 0)->where("status", "Active")->get();
            $sub_category = array();
            foreach ($subCategory as $key1 => $val1) {
                $sub_category[$key1]['id'] = $val1->id;
                $sub_category[$key1]['name'] = $val1->name;
                $sub_category[$key1]['slug'] = $val1->slug;
               // $sub_category[$key1]['image'] = $val1->image;
                $sub_category[$key1]['description'] = $val1->excerpt ? $val1->excerpt : '';
                $subsubCategory = Category::where("p_id", $val1->id)->where('deleted', 0)->where("status", "Active")->get();

                $subsub_category = array();
                foreach ($subsubCategory as $key2 => $val2) {
                    $subsub_category[$key2]['id'] = $val2->id;
                    $subsub_category[$key2]['name'] = $val2->name;
                    $subsub_category[$key2]['slug'] = $val2->slug;
                    //$subsub_category[$key2]['image'] = $val2->image;
                    $subsub_category[$key2]['description'] = $val2->excerpt ? $val2->excerpt : '';
                }
                $sub_category[$key1]['subsub_category'] = $subsub_category;
            }
            $result[$key]['subCategory'] = $sub_category;
			$result2 = array('status' => '200', "message" => "Category loaded successfully.",'data'=>$result);
        }
        if (empty($result)){
            return response()->json('data not found', 201);
        } else {
            return response()->json($result2, 200);
        }
    } 