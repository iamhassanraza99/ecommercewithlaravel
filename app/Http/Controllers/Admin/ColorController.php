<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $result['Colors'] = Color::all();
        return view('admin/attributes/color/color_list',$result);
    }

    ## We are using one function for new and update colors
    public function manage_color($id='')
    {
        if($id > 0){
            $res = Color::where('id',$id)->get();
            $Arr['color_id'] = $res[0]->id;
            $Arr['color'] = $res[0]->color;
            return view('admin/attributes/color/color_manage',$Arr);
        }
        $Arr['color_id'] = 0;
        $Arr['color'] = '';
        return view('admin/attributes/color/color_manage',$Arr);
    }
    public function manage_color_process(Request $request)
    {
        $id = $request->input('color_id');
        $request->validate([
            'color'=>'required|unique:colors,color,'.$id,
        ]);
        
        ## For New Color
        if($id == 0){
            $res = new Color();
            $msg = "Color Added Successfully";
        }
        ## For Update Color
        else{
            $res = Color::find($id);
            $msg = "Color Updated Successfully";
        }
        $res->color = $request->input('color');
        $res->status = 1;
        $res->save();
        $request->session()->flash("color-msg",$msg);
        return redirect('/admin/attributes/color');
    }
    function delete_color(Request $request,$id){
        $res = Color::find($id)->delete();
        $request->session()->flash("color-msg","Color Deleted Successfully");
        return redirect('/admin/attributes/color');
    }
    function status_color(Request $request,$status,$id){
        $model = Color::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash("color-msg","Color Status Updated Successfully");
        return redirect('/admin/attributes/color');    
    }
}
