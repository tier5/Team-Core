<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Shop;
use Validator;
use Hash;
use URL;
use File;
use Illuminate\Support\Facades\Input;
use Session;
use Image;

class ShopController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function shopList()
    {
    	$shops=Shop::get();
    	return view('shop.shop', compact('shops'));
    }

    /**
     * @param $product_list
     * @return array
     */
    public function formatProductArray($product_list){
        $products=array();
        foreach ($product_list as $key => $product) {
            $products[$product->id]=$product->product_name;
        }
        return $products;
        
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addShop()
    {
    	$product_list=Product::get();
        $products=$this->formatProductArray($product_list);
    	return view('shop.addShop', compact('products'));
    }

    /**
     * @return $this
     */
    public function createShop()
    {   
        $data=Input::all();
        
        $rules = array(
            'shop_name'  => 'required',
            'shop_address'=> 'required',
            'shop_detail'=> 'required',
            'products[]'=> 'required'
        );
        $validator = Validator::make(array(
            'shop_name'  => $data['shop_name'],
            'shop_address'=> $data['shop_address'],
            'shop_detail'=> $data['shop_detail'],
            'products[]'=> $data['products'],
            ), $rules);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        } else{
            //dd(public_path('/images/productImage/'));
            $products=$data['products'];
            if (Input::hasfile('shop_images')) {

                $image    = Input::file('shop_images');
                $ext      = $image->getClientOriginalExtension();
                
                $filename = 'SHOP'.rand().'.'.$ext;
                /*$target   = config('global.productPath');*/
                $target   = public_path('/images/shopImage/');
                $path     = $target.$filename;  

                Image::make($image->getRealPath())->save($path);
                  
                $shop = new Shop;
                $shop->shop_name   = $data['shop_name'];
                $shop->shop_images   = $filename;
                $shop->shop_address   = $data['shop_address'];
                $shop->shop_detail   = $data['shop_detail'];
                $shop->save();
                
                $last_insert_id = $shop->id;

                /********* insert value into pivot table **************/
                $productshop = Shop::find($last_insert_id);
                foreach ($products as $key => $product) {
                    $productshop->product()->attach($product, array('price'=>0,'status'=>'0'));
                }

                /********* inserted into pivot table **************/
                echo json_encode(array('status' =>1,'massage' => "Shop create successfull." ));
                
            }else{
                echo json_encode(array('status' =>0,'massage' => "Shop Not Created . Please insert Shop Image." ));
            }               
        }
    }

    /**
     *
     */
    public function deleteShop(){

        $data=Input::all();
        $shop_id=$data['shop_id'];
        $shop_res=Shop::where('id','=',$shop_id)->delete();
        if($shop_res){
            echo json_encode(array('status' =>1,'massage' => "Shop Deleted" ));
        }else{
            echo json_encode(array('status' =>0,'massage' => "Opps! Please try again." ));
        }

    }


    /**
     * @param $shop_name
     * @param $shop_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editShop($shop_name,$shop_id)
    {   
        $product_list=Product::get();
        $products=$this->formatProductArray($product_list);
        $shop=Shop::find($shop_id);

        $shopProductsList=$shop->product()->get();
        $formatedShopProductsList=$this->formatProductArray($shopProductsList);
        $shopProducts=array_keys($formatedShopProductsList);
        $products=array_diff($products ,$formatedShopProductsList);

       return view('shop.editShop', compact('products','shop'));
    }


    /**
     * @return $this
     */
    public function updateShop()
    {   
        $data=Input::except('_token','submit');
        
        $rules = array(
            'shop_name'  => 'required',
            'shop_address'=> 'required',
            'shop_detail'=> 'required',
/*            'products'=> 'required'
*/        );
        $validator = Validator::make(array(
            'shop_name'  => $data['shop_name'],
            'shop_address'=> $data['shop_address'],
            'shop_detail'=> $data['shop_detail'],
/*            'products'=> $data['products'],
*/            ), $rules);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        } else{
            //dd(public_path('/images/productImage/'));
/*            $products=$data['products'];
*/            unset($data['products']);
            if (Input::hasfile('shop_images')) {

                $image    = Input::file('shop_images');
                $ext      = $image->getClientOriginalExtension();
                
                $filename = 'SHOP'.rand().'.'.$ext;
                /*$target   = config('global.productPath');*/
                $target   = public_path('/images/shopImage/');
                $path     = $target.$filename;  

                Image::make($image->getRealPath())->save($path);

            } else{
                
                $filename = $data['old_shop_images'];

            } 

                unset($data['old_shop_images']);
                $data['shop_images']=$filename;
                $shop_res =Shop::where('id','=',$data['id'])->update($data);

            if($shop_res){
                echo json_encode(array('status' =>1,'massage' => "Shop Updated successfull." ));
            } else {
                echo json_encode(array('status' =>0,'massage' => "Shop Not Updated .Please Try Again." ));
            }           
        }
    }


    /**
     * @param $shop_name
     * @param $shop_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ShopProducts($shop_name,$shop_id)
    {   

        /*all product */
        $product_list=Product::get();
        $products=$this->formatProductArray($product_list);

        /* shop product details */
        $shop=Shop::find($shop_id);
        $shopProductsList=$shop->product()->get();

        /* add product dropdown list */
        $formatedShopProductsList=$this->formatProductArray($shopProductsList);
        $products=array_diff($products ,$formatedShopProductsList);

        /***** shop detail********/ 
        $shop=Shop::find($shop_id);

      /*  echo "<pre>";
        print_r($shopProductsList);
        print_r($products);die;*/

       return view('shop.shopProducts', compact('products','shopProductsList','shop'));

    }


    /**
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function addShopProducts()
    {   
        $data=Input::all();
        $rules = array(
            'products[]'=> 'required'
        );
        $validator = Validator::make(array(
            'products[]'=> $data['products'],
            ), $rules);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        } else{
            //dd(public_path('/images/productImage/'));
            $products=$data['products'];
        
            $shop_id = $data['id'];

            /********* insert value into pivot table **************/
            $productshop = Shop::find($shop_id);

            foreach ($products as $key => $product) {
                $productshop->product()->attach($product, array('price'=>0,'status'=>'0'));
            }
            /********* inserted into pivot table **************/
            Session::flash('message', 'Product added successfull.');

            return redirect()->back();
        }
    }


    /**
     *
     */
    public function shopProductPrice()
    {   
        $data=Input::all();
        //print_r($data);die;
            
        $shop_id = $data['shop_id'];
        $product_id =$data['product_id'];
        $price=$data['price'];
        /********* update value into pivot table **************/
        $productshop = Shop::find($shop_id);
        $productshop->product()->syncWithoutDetaching([$product_id => [ 'price'=>$price,'status'=>'1'] ], false);
        /*****************/
        if($productshop){
            echo json_encode(array('status' =>1,'massage' => "Price Updated" ));
        }else{
            echo json_encode(array('status' =>0,'massage' => "Opps! Please try again." ));
        }
    }

    /**
     *
     */
    public function detachProduct()
    {   
        $data=Input::all();
        //print_r($data);die;
            
        $shop_id = $data['shop_id'];
        $product_id =$data['product_id'];

        /********* detach product from pivot table **************/
        $productshop = Shop::find($shop_id);
        $productshop->product()->detach($product_id);


        /**********************/

        /*********** attach this product to add product list ************/
            $product =$this->formatProductArray(Product::where('id','=',$product_id)->get());

        //***************************//
        if($productshop){
            echo json_encode(array('status' =>1,'massage' => "Product removed from this shop",'data' => $product ));
        }else{
            echo json_encode(array('status' =>0,'massage' => "Opps! Please try again." ));
        }
    }



}
