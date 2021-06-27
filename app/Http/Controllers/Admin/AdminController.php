<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
   
    public function index(Request $request)
    {
        if($request->session()->has('ADMIN_ID')){
            return redirect('admin/dashboard');
        }
        else{
            return view('admin/login');
        }
        return view('admin/login');
    }

    function auth(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');
        // $result = Admin::where(['email'=>$email,'password'=>$password])->get();
        $result = Admin::where(['email'=>$email])->first();
        if($result){
            #FOR ENCRYPTED PASSWORD
            if(Hash::check($password,$result->password)){
                $request->session()->put('ADMIN_ID',$result->id);
                return redirect('admin/dashboard');
            }
            else{
                $request->session()->flash('error','Please enter the valid Password');
                return redirect('admin/login');
            }
            
        }
        else{
                $request->session()->flash('error','Please enter the valid login details');
                return redirect('admin/login');
            }
        
    }
    function dashboard(){
        $Arr['Users'] = DB::table('users')
        ->where(['status'=>'1'])
        ->get();
        $Arr['Total_Users'] = count($Arr['Users']);
        $Arr['Products'] = DB::table('products')
        ->where(['status'=>'1'])
        ->get();
        $Arr['Total_Products'] = count($Arr['Products']);
        
        $Arr['Coupons'] = DB::table('coupons')
        ->where(['status'=>'1'])
        ->get();
        $Arr['Total_Coupons'] = count($Arr['Coupons']);
        
        $Arr['Brands'] = DB::table('brands')
        ->where(['status'=>'1'])
        ->get();
        $Arr['Total_Brands'] = count($Arr['Brands']);
        return view('admin/dashboard',$Arr);
    }
    # To Convert Password into Encrypted form

    // function encpassword(){
    //     $res = Admin::find(1);
    //     $res->password = Hash::make("123");
    //     $res->save();
    // }
}