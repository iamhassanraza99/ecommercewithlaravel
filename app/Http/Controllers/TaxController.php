<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function index()
    {
        $result['Tax'] = Tax::all();
        return view('admin/attributes/tax/tax_list',$result);
    }

    ## We are using one function for new and update tax
    public function manage_tax($id='')
    {
        if($id > 0){
            $res = Tax::where('id',$id)->get();
            $Arr['tax_id'] = $res[0]->id;
            $Arr['tax_name'] = $res[0]->tax_name;
            $Arr['tax_value'] = $res[0]->tax_value;

            // $Arr['Tax'] = Tax::where(['status'=>'1'])->get();
            return view('admin/attributes/tax/tax_manage',$Arr);
        }
        $Arr['tax_id'] = 0;
        $Arr['tax_name'] = '';
        $Arr['tax_value'] = '';
        return view('admin/attributes/tax/tax_manage',$Arr);
    }
    public function manage_tax_process(Request $request)
    {
        $id = $request->input('tax_id');
        $request->validate([
            'tax_name'=>'required|unique:taxes,tax_name,'.$id,
        ]);
        
        ## For New Tax
        if($id == 0){
            $res = new Tax();
            $msg = "Tax Added Successfully";
        }
        ## For Update Tax
        else{
            $res = Tax::find($id);
            $msg = "Tax Updated Successfully";
        }
        $res->tax_name = $request->input('tax_name');
        $res->tax_value = $request->input('tax_value');
        $res->status = 1;
        $res->save();
        $request->session()->flash("tax-msg",$msg);
        return redirect('/admin/attributes/tax');
    }
    function delete_tax(Request $request,$id){
        $res = Tax::find($id)->delete();
        $request->session()->flash("tax-msg","Tax Deleted Successfully");
        return redirect('/admin/attributes/tax');
    }
    function status_tax(Request $request,$status,$id){
        $model = Tax::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash("tax-msg","Tax Status Updated Successfully");
        return redirect('/admin/attributes/tax');    
    }
}
