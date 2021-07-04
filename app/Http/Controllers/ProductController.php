<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\CurrentStockModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    function AddProduct(Request $request){
        $product_name= $request->input('product_name');
        $product_code= time();
        $product_price=  $request->input('product_price');
        $product_category= $request->input('product_category');
        $product_remarks= $request->input('product_remarks');
        $image= $request->file('product_icon');
        $countProduct = ProductModel::where('product_name', $product_name)->count();
        if($countProduct===0)
        {
             $product_icon= $image->store('public');
             $img_name = explode('/', $product_icon)[1];
             $image_path = 'http://'.$_SERVER['HTTP_HOST'].'/storage/'.$img_name;
             $result=ProductModel::insert([
             "product_name"=>$product_name,
             "product_code"=>$product_code,
             "product_icon"=> $image_path,
             "product_price"=>$product_price,
             "product_category"=>$product_category,
             "product_remarks"=>$product_remarks
        ]);
        $result=CurrentStockModel::insert([
             "product_name"=>$product_name,
             "product_code"=>$product_code,
             "product_icon"=>$product_icon,
             "product_price"=>$product_price,
             "product_qty"=>'0',
             "total_price"=>'0',
             "product_category"=>$product_category,
             "product_remarks"=>$product_remarks
         ]);
        return $result;
        }
        else{
            return "Product name already exists";
        }
       
    }

    function DeleteProduct(Request $request){
        $id= $request->id;
        $products= ProductModel::Where('id',$id)->get();
        Storage::delete($products[0]['product_icon']);
        $result=ProductModel::Where('id', $id)->delete();
        $result=CurrentStockModel::Where('id', $id)->delete();
        return  $result;
    }

    function SelectProduct(){
        $result= ProductModel::all();
        return $result;
    }


    function getProduct(Request $request){
        $id= $request->id;
        $result= ProductModel::Where('id',$id)->first();
        return $result;
    }
	function SelectProductByCategory(Request $request){
        $Category= $request->Category;
        $result= ProductModel::Where('product_category',$Category)->get();
        return $result;
    }

    function UpdateProduct(Request $request){
        $id= $request->input('id');
        $image= $request->file('product_icon');
        $product_name= $request->input('product_name');
        $product_price=  $request->input('product_price');
        $product_category= $request->input('product_category');
        $product_remarks= $request->input('product_remarks');

        $countProduct = ProductModel::where('product_name', $product_name)->where('id', $id)->count();
        $countTotal =   ProductModel::where('product_name', $product_name)->count();

        if($countProduct===1 || $countTotal===0)
        {
            if(empty($image))
            {
                $result= ProductModel::Where('id', $id)->update([
                "product_name"=>$product_name,
                "product_price"=>$product_price,
                "product_category"=>$product_category,
                "product_remarks"=>$product_remarks
                ]); 
                $result= CurrentStockModel::Where('id', $id)->update([
                "product_name"=>$product_name,
                "product_price"=>$product_price,
                "product_category"=>$product_category,
                "product_remarks"=>$product_remarks
                ]);
                if($result==true || $result==false)
				  {	
					return 1;
				  }
            }
            else{
                $products = ProductModel::where('id', $id)->get();
                Storage::delete($products[0]['product_icon']);
                $product_icon = $image->store('public');
                $result = ProductModel::where('id', $id)->update([
                    "product_name"=>$product_name,
                    "product_icon"=>$product_icon,
                    "product_price"=>$product_price,
                    "product_category"=>$product_category,
                    "product_remarks"=>$product_remarks,
                ]);
                $result = CurrentStockModel::where('id', $id)->update([
                    "product_name"=>$product_name,
                    "product_icon"=>$product_icon,
                    "product_price"=>$product_price,
                    "product_category"=>$product_category,
                    "product_remarks"=>$product_remarks,
                ]);
				 if($result==true || $result==false)
				  {	
					return 1;
				  }
            }
        }
        else{
             return "Product name already exists";
        }

      }

}
