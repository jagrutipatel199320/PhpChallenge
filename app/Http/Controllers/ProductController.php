<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Products;

class ProductController extends Controller
{
	// get all Products 
	public function all()
    {
    	$products = Products::join('ProductCategory','ProductCategory.product_id','=','Products.id')
    				->join('Categories','ProductCategory.category_id','=','Categories.id')
    				->select('Products.*','Categories.name as cat_name')->get();
   		 
   		$data =$products->toArray();
   		$responceData=array();
   		
   		foreach ($data as $key => $value) {
   			$responceData[$value['id']][] = $value['cat_name'];
   		}
   		$CategoryData=array();
   		foreach ($data as $key => $value) {
   			
   			$CategoryData[$value['id']]['name'] = $value['name'];
   			$CategoryData[$value['id']]['sku'] = $value['SKU'];
   			$CategoryData[$value['id']]['price'] = $value['price'];
   			$CategoryData[$value['id']]['category']=implode(',', $responceData[$value['id']]);
   		
   		}
   		$dataR=array();
   		foreach ($CategoryData as $key => $value) {
   			# code...
   			array_push($dataR, $value);
   		}
   		
        return response()->json($dataR,200);
    }

	// get Product by id 
    public function getProduct($id)
    {
    	$products = Products::join('ProductCategory','ProductCategory.product_id','=','Products.id')
    				->join('Categories','ProductCategory.category_id','=','Categories.id')
    				->select('Products.*','Categories.name as cat_name')
    				->where('Products.id','=',$id)
    				->get();
   		 
   		$data =$products->toArray();
   		$responceData=array();
   		
   		foreach ($data as $key => $value) {
   			$responceData[$value['id']][] = $value['cat_name'];
   		}
   		$CategoryData=array();
   		foreach ($data as $key => $value) {
   			
   			$CategoryData[$value['id']]['name'] = $value['name'];
   			$CategoryData[$value['id']]['sku'] = $value['SKU'];
   			$CategoryData[$value['id']]['price'] = $value['price'];
   			$CategoryData[$value['id']]['category']=implode(',', $responceData[$value['id']]);
   		
   		}
   		
        return response()->json($CategoryData,200);
    }

    // POST data into database
    public function createProduct(Request $request){
		

       	$product = new Products();
    	$product->name = $request->name;
    	$product->SKU = $request->sku;
    	$product->price = $request->price;
    	$product->save();

    	$msg = array("msg"=>"Successfully Inserted");
        return response()->json($msg,200);
    }
    // delete product by id
    public function deleteProduct($id)
    {

    	 Products::where('Products.id','=',$id)->delete();
   		 
   		
         $msg = array("msg"=>"Successfully Deleted");
        return response()->json($msg,200);

    }

    // get all products by category id
    public function getProductByCategory($id)
    {
    	$products = Products::join('ProductCategory','ProductCategory.product_id','=','Products.id')
    				->join('Categories','ProductCategory.category_id','=','Categories.id')
    				->where('Categories.id','=',$id)
    				->select('Products.*','Categories.name as cat_name')->get();
   		 
   		$data =$products->toArray();
   		$responceData=array();
   		
   		foreach ($data as $key => $value) {
   			$responceData[$value['id']][] = $value['cat_name'];
   		}
   		$CategoryData=array();
   		foreach ($data as $key => $value) {
   			
   			$CategoryData[$value['id']]['name'] = $value['name'];
   			$CategoryData[$value['id']]['sku'] = $value['SKU'];
   			$CategoryData[$value['id']]['price'] = $value['price'];
   			$CategoryData[$value['id']]['category']=implode(',', $responceData[$value['id']]);
   		
   		}
   		
        return response()->json($CategoryData,200);
    }
    
}
