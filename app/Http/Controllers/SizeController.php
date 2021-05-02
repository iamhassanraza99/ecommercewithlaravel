<?php

namespace App\Http\Controllers;

use App\Models\size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $result['Sizes'] = Size::all();
        return view('admin/attributes/size/size_list',$result);
    }

    ## We are using one function for new and update coupons
    public function manage_size($id='')
    {
        if($id > 0){
            $res = Size::where('id',$id)->get();
            $Arr['size_id'] = $res[0]->id;
            $Arr['size'] = $res[0]->size;
            return view('admin/attributes/size/size_manage',$Arr);
        }
        $Arr['size_id'] = 0;
        $Arr['size'] = '';
        return view('admin/attributes/size/size_manage',$Arr);
    }
    public function manage_size_process(Request $request)
    {
        $id = $request->input('size_id');
        $request->validate([
            'size'=>'required|unique:sizes,size,'.$id,
        ]);
        
        ## For New Size
        if($id == 0){
            $res = new Size();
            $msg = "Size Added Successfully";
        }
        ## For Update Size
        else{
            $res = Size::find($id);
            $msg = "Size Updated Successfully";
        }
        $res->size = $request->input('size');
        $res->status = 1;
        $res->save();
        $request->session()->flash("size-msg",$msg);
        return redirect('/admin/attributes/size');
    }
    function delete_size(Request $request,$id){
        $res = Size::find($id)->delete();
        $request->session()->flash("size-msg","Size Deleted Successfully");
        return redirect('/admin/attributes/size');
    }
    function status_size(Request $request,$status,$id){
        $model = Size::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash("size-msg","Size Status Updated Successfully");
        return redirect('/admin/attributes/size');    
    }
}
