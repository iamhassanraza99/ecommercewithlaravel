<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\Category;
use Illuminate\Http\Request;

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
            return view('admin/products/product_manage',$Arr);
        }
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
        
        
        return view('admin/products/product_manage',$Arr);
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
            $file = $image->storeAs('/public/media',$image_name);
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
}
