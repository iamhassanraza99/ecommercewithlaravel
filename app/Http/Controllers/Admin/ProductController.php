<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\Tax;
use App\Models\Admin\size;
use App\Models\Admin\Brand;
use App\Models\Admin\color;
use App\Models\Admin\product;
use App\Models\Admin\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $result['Products'] = Product::all();
        return view('admin/products/product_list',$result);
    }
    
    ## We are using one function for new and update Product
    public function manage_product($id='')
    {
        $Arr['category'] = Category::where(['status'=>'1'])->get();
        $Arr['colors'] = color::where(['status'=>'1'])->get();
        $Arr['sizes'] = size::where(['status'=>'1'])->get();
        $Arr['brands'] = Brand::where(['status'=>'1'])->get();
        // PRODUCT EDIT
        if($id > 0){
            $res = Product::where('id',$id)->get();
            $Arr['product_id'] = $res[0]->id;
            $Arr['category_id'] = $res[0]->category_id;
            $Arr['brand_id'] = $res[0]->brand_id;
            $Arr['product_name'] = $res[0]->product_name;
            $Arr['product_slug'] = $res[0]->product_slug;
            $Arr['product_image'] = $res[0]->product_image;
            // $Arr['product_brand'] = $res[0]->product_brand;
            $Arr['product_model'] = $res[0]->product_model;
            $Arr['short_desc'] = $res[0]->short_desc;
            $Arr['long_desc'] = $res[0]->long_desc;
            $Arr['keywords'] = $res[0]->keywords;
            $Arr['technical_specifications'] = $res[0]->technical_specifications;
            $Arr['uses'] = $res[0]->uses;
            $Arr['warranty'] = $res[0]->warranty;
            $Arr['delivery_time'] = $res[0]->delivery_time;
            $Arr['tax_id'] = $res[0]->tax_id;
            $Arr['is_promo'] = $res[0]->is_promo;
            $Arr['is_featured'] = $res[0]->is_featured;
            $Arr['is_discounted'] = $res[0]->is_discounted;
            $Arr['is_trending'] = $res[0]->is_trending;
            $Arr['status'] = $res[0]->status;

            $Arr['productsAttr'] = DB::table('products_attr')->where(['product_id'=>$id])->get();
            $productsImages = DB::table('product_images')->where(['product_id'=>$id])->get();
            if(!isset($productsImages[0])){
                $Arr['productsImages'][0]['id'] = '';
                $Arr['productsImages'][0]['images'] = '';
            }
            else{
                $Arr['productsImages'] = $productsImages;
            }
            $Arr['Tax'] = Tax::where(['status'=>'1'])->get();
            // echo "<pre>";
            // print_r($Arr['productsAttr']);
            // die();
            return view('admin/products/product_manage',$Arr);
        }
    //    NEW PRODUCT 
        else{
            $Arr['category_id'] = '';
            $Arr['product_id'] = 0;
            $Arr['product_name'] = '';
            $Arr['product_slug'] = '';
            $Arr['product_image'] = '';
            $Arr['brand_id'] = '';
            $Arr['product_model'] = '';
            $Arr['short_desc'] = '';
            $Arr['long_desc'] = '';
            $Arr['keywords'] = '';
            $Arr['technical_specifications'] = '';
            $Arr['uses'] = '';
            $Arr['warranty'] = '';
            $Arr['delivery_time'] = '';
            $Arr['tax_id'] = '';
            $Arr['is_promo'] = '';
            $Arr['is_featured'] = '';
            $Arr['is_discounted'] = '';
            $Arr['is_trending'] = '';
            $Arr['status'] = '';
        
            $Arr['productsAttr'][0]['id'] = '';
            $Arr['productsAttr'][0]['product_id'] = '';
            $Arr['productsAttr'][0]['sku'] = '';
            $Arr['productsAttr'][0]['image'] = '';
            $Arr['productsAttr'][0]['maximum_retail_price'] = '';
            $Arr['productsAttr'][0]['price'] = '';
            $Arr['productsAttr'][0]['qty'] = '';
            $Arr['productsAttr'][0]['size_id'] = '';
            $Arr['productsAttr'][0]['color_id'] = '';

            $Arr['productsImages'][0]['id'] = '';
            $Arr['productsImages'][0]['images'] = '';

            $Arr['Tax'] = Tax::where(['status'=>'1'])->get();

        // echo "<pre>";
        // print_r($Arr);
        // die();
        return view('admin/products/product_manage',$Arr);
        }
        
    }

    ## FOR INSERT AND UPDATE PRODUCTS
    public function manage_product_process(Request $request)
    {
        // echo "<pre>";
        // print_r($request->post());
        // die();
        $id = $request->input('product_id');
        if($id == 0){
            $product_image_validation = "required|mimes:jpg,jpeg,png";
        }
        else{
            $product_image_validation = "mimes:jpg,jpeg,png";
        }
        $request->validate([
            'product_name'=>'required',
            'product_image'=> $product_image_validation,
            'product_slug'=>'required|unique:products,product_slug,'.$id,
            'image_attr.*'=>'required|mimes:jpg,jpeg,png',
        ]);
        
        ## For New Product
        if($id == 0){
            $res = new Product();
            $msg = "Product Added Successfully";
        }
        ## For Update Product
        else{
            $res = Product::find($id);
            $msg = "Product Updated Successfully";
        }

        if($request->hasfile('product_image')){
            if($id > 0){
                $imageArr = DB::table('products')->where(['id'=>$id])->get();
                if(Storage::exists('/public/media/products/'.$imageArr[0]->product_image))
                {
                    Storage::delete('/public/media/products/'.$imageArr[0]->product_image);
                }
            }
            
            $image = $request->file('product_image');
            $ext = $image->extension();
            $image_name = time().'.'.$ext;
            $file = $image->storeAs('/public/media/products',$image_name);
            $res->product_image = $image_name;
        }
        
        $res->category_id = $request->input('category_id');
        $res->product_name = $request->input('product_name');
        $res->product_slug = $request->input('product_slug');
        $res->brand_id = $request->input('brand_id');
        $res->product_model = $request->input('product_model');
        $res->short_desc = $request->input('short_desc');
        $res->long_desc = $request->input('long_desc');
        $res->keywords = $request->input('keywords');
        $res->technical_specifications = $request->input('technical_specifications');
        $res->uses = $request->input('uses');
        $res->warranty = $request->input('warranty');
        $res->delivery_time = $request->input('delivery_time');
        $res->tax_id = $request->input('tax_id');
        $res->is_promo = $request->input('is_promo');
        $res->is_featured = $request->input('is_featured');
        $res->is_discounted = $request->input('is_discounted');
        $res->is_trending = $request->input('is_trending');
        $res->status = 1;
        $res->save();

        // Product Attributes Start
        $pid = $res->id;
        $paidArr = $request->input('paid');
        $skuArr = $request->input('sku');
        $mrpArr = $request->input('maximum_retail_price');
        $priceArr = $request->input('price');
        $sizeArr = $request->input('size');
        $colorArr = $request->input('color');
        $qtyArr = $request->input('qty');
        $imageArr = $request->file('image_attr');

        if($skuArr != NULL)
        {
                // SKU Unique Validation
            foreach($skuArr as $key=>$val){
                $check = DB::table('products_attr')
                ->where('sku',$skuArr[$key])
                ->where('id','!=',$paidArr[$key])->get();
                if(isset($check[0])){
                    $request->session()->flash('sku-error',$skuArr[$key].' SKU already exists');
                    return redirect(request()->headers->get('referer'));
                }
            }
        
            foreach($skuArr as $key=>$val){
                $ProductsAttrArr = []; 
                $ProductsAttrArr['product_id'] = $pid; 
                $ProductsAttrArr['sku'] = $skuArr[$key]; 
                $ProductsAttrArr['maximum_retail_price'] = $mrpArr[$key]; 
                $ProductsAttrArr['price'] = $priceArr[$key]; 
                $ProductsAttrArr['size_id'] = $sizeArr[$key]; 
                $ProductsAttrArr['color_id'] = $colorArr[$key]; 
                $ProductsAttrArr['qty'] = $qtyArr[$key]; 

                if($request->hasfile("image_attr.$key")){
                    if($paidArr[$key]!=''){
                        $imageArray = DB::table('products_attr')->where(['id'=>$paidArr[$key]])->get();
                        if(Storage::exists('/public/media/products/attr/'.$imageArray[0]->image))
                        {
                            Storage::delete('/public/media/products/attr/'.$imageArray[0]->image);
                        }
                    }
                    $ext[$key] = $imageArr[$key]->extension();
                    $image_name[$key] = time().'.'.$ext[$key];
                    $file[$key] = $imageArr[$key]->storeAs('/public/media/products/attr',$image_name[$key]);
                    $ProductsAttrArr['image'] = $image_name[$key];

                }
                else{
                    ## if we are editing/updating product then the image will not be added
                    if($paidArr[$key]==''){
                        $ProductsAttrArr['image'] = "No Image"; 
                    }
                }
            
                if($paidArr[$key]==''){
                    DB::table('products_attr')->insert($ProductsAttrArr);
                }
                else{
                    DB::table('products_attr')->where(['id'=>$paidArr[$key]])->update($ProductsAttrArr);
                }
            }
            // Product Attributes End
            $request->session()->flash("product-msg",$msg);

        }

        // PRODUCT IMAGES START
        $piidArr = $request->input('piid');
        $imagesArr = $request->file('product_images');
        foreach($piidArr as $key=>$val){
            $ProductsImagesrArr['product_id'] = $pid; 
            if($request->hasfile("product_images.$key")){

                if($piidArr[$key] != ''){
                    $imageArr = DB::table('product_images')->where(['id'=>$piidArr[$key]])->get();
                    // dd($imageArr);
                    if(Storage::exists('/public/media/products/'.$imageArr[0]->images))
                    {
                        Storage::delete('/public/media/products/'.$imageArr[0]->images);
                    }
                }
                
                $ext[$key] = $imagesArr[$key]->extension();
                $image_name[$key] = time().'.'.$ext[$key];
                $file[$key] = $imagesArr[$key]->storeAs('/public/media/products',$image_name[$key]);
                $ProductsImagesrArr['images'] = $image_name[$key];

            }
            else{
                ## if we are editing/updating product then the image will not be added
                if($piidArr[$key]==''){
                    $ProductsImagesrArr['images'] = "No Image"; 
                }
            }
           
            if($piidArr[$key]==''){
                DB::table('product_images')->insert($ProductsImagesrArr);
            }
            else{
                DB::table('product_images')->where(['id'=>$piidArr[$key]])->update($ProductsImagesrArr);
            }
        }
        // PRODUCT IMAGES END
        
        return redirect('admin/products');
    }
    function delete_product(Request $request,$id){
        $res = Product::find($id)->delete();
        $request->session()->flash("product-msg","Product Deleted Successfully");
        return redirect('admin/products');
    }
    function status_product(Request $request,$status,$id){
        $model = Product::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash("product-msg","Product Status Updated Successfully");
        return redirect('/admin/products');    
    }
    function product_attr_delete(Request $request,$product_attr_id,$product_id){
        
        $imageArr = DB::table('products_attr')->where(['id'=>$product_attr_id])->get();
        // dd($imageArr);
        if(Storage::exists('/public/media/products/attr/'.$imageArr[0]->image))
        {
            Storage::delete('/public/media/products/attr/'.$imageArr[0]->image);
        }
        $res =DB::table('products_attr')->where(['id'=>$product_attr_id])->delete();
        $request->session()->flash("product-attr-msg","Product Attribute Deleted Successfully");
        return redirect('admin/product/edit/'.$product_id);
    }
    function product_images_delete(Request $request,$product_attr_id,$product_id){
        
        $imageArr = DB::table('product_images')->where(['id'=>$product_attr_id])->get();
        if(Storage::exists('/public/media/products/'.$imageArr[0]->images))
        {
            Storage::delete('/public/media/products/'.$imageArr[0]->images);
        }
        $res =DB::table('product_images')->where(['id'=>$product_attr_id])->delete();
        
        $request->session()->flash("product-image-msg","Product Image Deleted Successfully");
        return redirect('admin/product/edit/'.$product_id);
    }
}