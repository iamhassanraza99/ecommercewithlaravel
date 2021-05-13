<?php

namespace App\Http\Controllers;

use App\Models\size;
use App\Models\color;
use App\Models\product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        
        if($id > 0){
            $res = Product::where('id',$id)->get();
            $Arr['product_id'] = $res[0]->id;
            $Arr['category_id'] = $res[0]->category_id;
            $Arr['product_name'] = $res[0]->product_name;
            $Arr['product_slug'] = $res[0]->product_slug;
            $Arr['product_image'] = $res[0]->image;
            $Arr['product_brand'] = $res[0]->product_brand;
            $Arr['product_model'] = $res[0]->product_model;
            $Arr['short_desc'] = $res[0]->short_desc;
            $Arr['long_desc'] = $res[0]->long_desc;
            $Arr['keywords'] = $res[0]->keywords;
            $Arr['technical_specifications'] = $res[0]->technical_specifications;
            $Arr['uses'] = $res[0]->uses;
            $Arr['warranty'] = $res[0]->warranty;
            $Arr['status'] = $res[0]->status;

            $Arr['productsAttr'] = DB::table('products_attr')->where(['product_id'=>$id])->get();
            // echo "<pre>";
            // print_r($Arr['productsAttr']);
            // die();
            return view('admin/products/product_manage',$Arr);
        }
       
        else{
            $Arr['category_id'] = '';
            $Arr['product_id'] = 0;
            $Arr['product_name'] = '';
            $Arr['product_slug'] = '';
            $Arr['product_image'] = '';
            $Arr['product_brand'] = '';
            $Arr['product_model'] = '';
            $Arr['short_desc'] = '';
            $Arr['long_desc'] = '';
            $Arr['keywords'] = '';
            $Arr['technical_specifications'] = '';
            $Arr['uses'] = '';
            $Arr['warranty'] = '';
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
        // echo "<pre>";
        // print_r($Arr['productsAttr']);
        // die();
        return view('admin/products/product_manage',$Arr);
        }
        
    }

    ## FOR INSERT AND UPDATE PRODUCTS
    public function manage_product_process(Request $request)
    {
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
            $image = $request->file('product_image');
            $ext = $image->extension();
            $image_name = time().'.'.$ext;
            $file = $image->storeAs('/public/media/products',$image_name);
            $res->product_image = $image_name;
        }
        
        $res->category_id = $request->input('category_id');
        $res->product_name = $request->input('product_name');
        $res->product_slug = $request->input('product_slug');
        $res->product_brand = $request->input('product_brand');
        $res->product_model = $request->input('product_model');
        $res->short_desc = $request->input('short_desc');
        $res->long_desc = $request->input('long_desc');
        $res->keywords = $request->input('keywords');
        $res->technical_specifications = $request->input('technical_specifications');
        $res->uses = $request->input('uses');
        $res->warranty = $request->input('warranty');
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
           
            $ProductsAttrArr['product_id'] = $pid; 
            $ProductsAttrArr['sku'] = $skuArr[$key]; 
            $ProductsAttrArr['maximum_retail_price'] = $mrpArr[$key]; 
            $ProductsAttrArr['price'] = $priceArr[$key]; 
            $ProductsAttrArr['size_id'] = $sizeArr[$key]; 
            $ProductsAttrArr['color_id'] = $colorArr[$key]; 
            $ProductsAttrArr['qty'] = $qtyArr[$key]; 

            if($request->hasfile("image_attr.$key")){
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
        $res =DB::table('products_attr')->where(['id'=>$product_attr_id])->delete();
        $request->session()->flash("product-attr-msg","Product Attribute Deleted Successfully");
        return redirect('admin/product/edit/'.$product_id);
    }
}