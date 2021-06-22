<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $result['Users'] = User::all();
        return view('admin/users/users_list',$result);
    }

    public function users_detail($id)
    {
        $res = User::where('id',$id)->get();
        // echo "<pre>";
        // print_r($res[0]);
        // die();
        $Arr['Users'] = $res[0];
        return view('admin/users/users_detail',$Arr);

    }
    function status_user(Request $request,$status,$id){
        $model = User::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash("users-msg","User Status Updated Successfully");
        return redirect('/admin/users');    
    }
}