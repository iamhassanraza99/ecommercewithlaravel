<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $result['Coupon'] = Coupon::all();
        return view('admin/coupon/coupons_list',$result);
    }

    ## We are using one function for new and update coupons
    public function manage_coupon($id='')
    {
        if($id > 0){
            $res = Coupon::where('id',$id)->get();
            $Arr['coupon_id'] = $res[0]->id;
            $Arr['coupon_title'] = $res[0]->coupon_title;
            $Arr['coupon_code'] = $res[0]->coupon_code;
            $Arr['coupon_value'] = $res[0]->coupon_value;
            $Arr['type'] = $res[0]->type;
            $Arr['min_order_amt'] = $res[0]->min_order_amt;
            $Arr['is_one_time'] = $res[0]->is_one_time;
            return view('admin/coupon/coupon_manage',$Arr);
        }
        $Arr['coupon_id'] = 0;
        $Arr['coupon_title'] = '';
        $Arr['coupon_code'] = '';
        $Arr['coupon_value'] = '';
        $Arr['type'] = '';
        $Arr['min_order_amt'] = '';
        $Arr['is_one_time'] = '';
        return view('admin/coupon/coupon_manage',$Arr);
    }
    public function manage_coupon_process(Request $request)
    {
        $id = $request->input('coupon_id');
        $request->validate([
            'coupon_title'=>'required',
            'coupon_code'=>'required|unique:coupons,coupon_code,'.$id,
            'coupon_value'=>'required',
        ]);
        
        ## For New Coupon
        if($id == 0){
            $res = new Coupon();
            $msg = "Coupon Added Successfully";
        }
        ## For Update Coupon
        else{
            $res = Coupon::find($id);
            $msg = "Coupon Updated Successfully";
        }
        $res->coupon_title = $request->input('coupon_title');
        $res->coupon_code = $request->input('coupon_code');
        $res->coupon_value = $request->input('coupon_value');
        $res->type = $request->input('type');
        $res->min_order_amt = $request->input('min_order_amt');
        $res->is_one_time = $request->input('is_one_time');
        $res->status = 1;
        $res->save();
        $request->session()->flash("coupon-msg",$msg);
        return redirect('admin/coupons');
    }
    function delete_coupon(Request $request,$id){
        $res = Coupon::find($id)->delete();
        $request->session()->flash("coupon-msg","Coupon Deleted Successfully");
        return redirect('admin/coupons');
    }
    function status_coupon(Request $request,$status,$id){
        $model = Coupon::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash("coupon-msg","Coupon Status Updated Successfully");
        return redirect('/admin/coupons');    
    }
}
