<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\HomeBanner;
use Illuminate\Http\Request;

class HomeBannerController extends Controller
{
    public function index()
    {
        $result['HomeBanner'] = HomeBanner::all();
        return view('admin/Banner/home_banners',$result);
    }

    ## We are using one function for new and update HomeBanner
    public function manage_home_banners($id='')
    {
        if($id > 0){
            $res = HomeBanner::where('id',$id)->get();
            $Arr['banner_id'] = $res[0]->id;
            $Arr['banner_message'] = $res[0]->message;
            $Arr['banner_title'] = $res[0]->title;
            $Arr['banner_description'] = $res[0]->description;
            $Arr['banner_image'] = $res[0]->image;
            $Arr['btn_text'] = $res[0]->btn_text;
            $Arr['btn_link'] = $res[0]->btn_link;
            return view('admin/banner/home_banners_manage',$Arr);
        }
        $Arr['banner_id'] = 0;
        $Arr['banner_message'] = '';
        $Arr['banner_title'] = '';
        $Arr['banner_description'] = '';
        $Arr['banner_image'] = '';
        $Arr['btn_text'] = '';
        $Arr['btn_link'] = '';
        
        return view('admin/banner/home_banners_manage',$Arr);
    }
    public function manage_home_banners_process(Request $request)
    {
        $id = $request->input('banner_id');

        if($id == 0)
        {
            $condition = "required|mimes:jpg,jpeg,png";
        }
        else{
            $condition = "mimes:jpg,jpeg,png";
        }
        $request->validate([
            'banner_image'=>$condition,
            
        ]);
        ## For New Home Banner
        if($id == 0){
            $res = new HomeBanner();
            $msg = "HomeBanner Added Successfully";
        }
        ## For Update HomeBanner
        else{
            $res = HomeBanner::find($id);
            $msg = "HomeBanner Updated Successfully";
        }
        
        if($id == 0){
            if($request->hasfile('banner_image')){
                if($id > 0){
                    $imageArr = DB::table('home_banners')->where(['id'=>$id])->get();
                    // dd($imageArr);
                    if(Storage::exists('/public/media/banners/'.$imageArr[0]->image))
                    {
                        Storage::delete('/public/media/banners/'.$imageArr[0]->image);
                    }
                }
                
                $image = $request->file('banner_image');
                $ext = $image->extension();
                $image_name = time().'.'.$ext;
                $image->storeAs('/public/media/banners/',$image_name);
                $res->image = $image_name;
               }
        }
       
       
        
        $res->message = $request->input('banner_message');
        $res->title = $request->input('banner_title');
        $res->description = $request->input('banner_description');
        $res->btn_text = $request->input('btn_text');
        $res->btn_link = $request->input('btn_link');

        $res->status = 1;
        $res->save();
        $request->session()->flash("banner-msg",$msg);
      
        return redirect('admin/home_banners');
    }
    function delete_home_banner(Request $request,$id){
        $res = HomeBanner::find($id)->delete();
        $request->session()->flash("banner-msg","HomeBanner Deleted Successfully");
        return redirect('/admin/home_banners');
    }
    function status_home_banner(Request $request,$status,$id){
        $model = HomeBanner::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash("banner-msg","HomeBanner Status Updated Successfully");
        return redirect('/admin/home_banners');    
    }
}
