<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $result['Brands'] = Brand::all();
        return view('admin/attributes/brands/brands_list',$result);
    }

    ## We are using one function for new and update coupons
    public function manage_brand($id='')
    {
        if($id > 0){
            $res = Brand::where('id',$id)->get();
            $Arr['brand_id'] = $res[0]->id;
            $Arr['brand'] = $res[0]->name;
            return view('admin/attributes/brands/brands_manage',$Arr);
        }
        $Arr['brand_id'] = 0;
        $Arr['brand'] = '';
        return view('admin/attributes/brands/brands_manage',$Arr);
    }
    public function manage_brand_process(Request $request)
    {
        
        $id = $request->input('brand_id');
        $request->validate([
            'brand_name'=>'required|unique:brands,name,'.$id,
            
        ]);
        // 'brand_image'=> 'mimes:jpg,jpeg,png',
        ## For New Brand
        if($id == 0){
            $res = new Brand();
            $msg = "Brand Added Successfully";
        }
        ## For Update Brand
        else{
            $res = Brand::find($id);
            $msg = "Brand Updated Successfully";
        }
       
       if($request->hasfile('brand_image')){
        $image = $request->file('brand_image');
        $ext = $image->extension();
        $image_name = time().'.'.$ext;
        $image->storeAs('/public/media/brands',$image_name);
        $res->image = $image_name;
       }
        $res->name = $request->input('brand_name');
        $res->status = 1;
        $res->save();
        $request->session()->flash("brand-msg",$msg);
        // echo "<pre>";
        // print_r($request->post());
        // die();
        return redirect('/admin/attributes/brands');
    }
    function delete_brand(Request $request,$id){
        $res = Brand::find($id)->delete();
        $request->session()->flash("brand-msg","Brand Deleted Successfully");
        return redirect('/admin/attributes/brands');
    }
    function status_brand(Request $request,$status,$id){
        $model = Brand::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash("brand-msg","Brand Status Updated Successfully");
        return redirect('/admin/attributes/brands');    
    }
}
