<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Mail;
use Hash;
use Session;
class productController extends Controller {
	protected $redirectTo = '/home';
  
	public function addProductAx(Request $request){
		$productname = $request->productname;
		$productdesc = $request->productdesc;
		$single = $request->single;
		$gallery = $request->gallery;
		$regular_price = $request->regular_price;
		$sale_price = $request->sale_price;
		$sku = $request->sku;
		$managestock = $request->managestock;
		$stockstatus = $request->stockstatus;
		$soldind = $request->soldind;
		$weight = $request->weight;
		$length = $request->length;
		$width = $request->width;
		$height = $request->height;
		$shippingclass = $request->shippingclass;
		$notes = $request->notes;
		$menu_order = $request->menu_order;
		$token = $request->_token;
		
		$addProduct = ['title'=>$productname, 'description'=>$productdesc, 'userid'=>1, 'created_at'=>date("Y-m-d", time()), 'updated_at'=>date("Y-m-d", time())];
		$Product = DB::table('products')->insert($addProduct);
		if($Product){
			$productId = DB::getPdo()->lastInsertId();
			if ($request->hasFile('single')) {
				$image = $request->file('single');
				$name = time().'.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/storage/galeryImages/');
				$image->move($destinationPath, $name);
			}
			
			
			
			
			
			
			
			$meta = ['product_id'=>$productId, 'meta_name'=>'regular_price', 'meta_value'=>$regular_price];
			DB::table('product_meta')->insert($meta);
			$result=array('status'=>'true','message'=> 'Product addess successfull.');
		}else{
			$result=array('false'=>'true','message'=> 'Something went wrong, Please try again.');
		}
		echo json_encode($result);
	}
}
