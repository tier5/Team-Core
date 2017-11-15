<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use Validator;
use Hash;
use URL;
use File;
use Illuminate\Support\Facades\Input;
use Session;
use Image;

class ProductController extends Controller
{
    public function productList()
    {
    	$products=Product::get();
/*        echo "<pre>"; print_r($products);echo "</pre>";die;
*/    	return view('product.product', compact('products'));
    }

    public function createProduct()
    {	
    	$data=Input::all();
    	
    	$rules = array(
            'product_name'  => 'required',
            'product_detail'=> 'required'
        );
        $validator = Validator::make(array(
			'product_name'  => $data['product_name'],
			'product_detail'=> $data['product_detail']
            ), $rules);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        } else{
        	//dd(public_path('/images/productImage/'));

        	if (Input::hasfile('product_image')) {

                $image    = Input::file('product_image');
                $ext      = $image->getClientOriginalExtension();
                
                $filename = 'PRODUCT'.rand().'.'.$ext;
                /*$target   = config('global.productPath');*/
                $target   = public_path('/images/productImage/');
                $path     = $target.$filename;  

                Image::make($image->getRealPath())->save($path);
				  
        		$product = new Product;
        		$product->product_name	 = $data['product_name'];
        		$product->product_image	 = $filename;
                $product->product_detail = $data['product_detail'];
        		$product->save();
                
        		$last_insert_id = $product->id;
        		
				Session::flash('message', 'Product create successfull.');
		        
            }else{
               Session::flash('message', 'Product Not Created . Please insert Product Image.'); 

            }
            
            return redirect('addProduct');
            
        }
    }

    
    public function deleteProduct(){

    	$data=Input::all();
    	$product_id=$data['product_id'];
    	$product_res=Product::where('id','=',$product_id)->delete();
    	if($product_res){
    		echo json_encode(array('status' =>1,'massage' => "Product Deleted" ));
    	}else{
			echo json_encode(array('status' =>0,'massage' => "Opps! Please try again." ));
    	}

    }

    public function editProduct($product_name,$product_id){

    	$product=Product::find($product_id);

    	return view('product.editProduct', compact('product'));

    }

    public function updateProduct()
    {	
    	$data=Input::except('_token','submit');
    	
    	$rules = array(
            'product_name'  => 'required',
            'product_detail'=> 'required'
        );
        $validator = Validator::make(array(
			'product_name'  => $data['product_name'],
			'product_detail'=> $data['product_detail']
            ), $rules);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        } else{
        	//dd(public_path('/images/productImage/'));

        	if (Input::hasfile('product_image')) {

                $image    = Input::file('product_image');
                $ext      = $image->getClientOriginalExtension();
                
                $filename = 'PRODUCT'.rand().'.'.$ext;
                /*$target   = config('global.productPath');*/
                $target   = public_path('/images/productImage/');
                $path     = $target.$filename;  

                Image::make($image->getRealPath())->save($path);

            }else{
                
                $filename = $data['old_product_image'];

            }	
            
        	unset($data['old_product_image']);
        	$data['product_image']=$filename;
        	
    		$product_res =Product::where('id','=',$data['id'])->update($data);

    		if($product_res){
    			Session::flash('message', 'Product Updated successfull.'); 
    		} else {
    			Session::flash('message', 'Product Not Updated .Please Try Again.');
    		}     		
				              
            return redirect('editProduct'.'/'.urlencode(str_replace('/', '&#47;',$data['product_name'])).'/'.$data['id']);
        }
    }


}
