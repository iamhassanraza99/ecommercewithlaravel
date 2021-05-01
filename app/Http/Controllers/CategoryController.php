<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function index()
    {
        $result['Category'] = Category::all();
        return view('admin/category/categories_list',$result);
    }
    // public function new_category()
    // {
    //     return view('admin/category/new');
    // }
    // public function add_category(Request $request)
    // {
    //     $request->validate([
    //         'category_name'=>'required',
    //         'category_slug'=>'required|unique:categories'
    //     ]);
    //     $res = new Category();
    //     $res->category_name = $request->input('category_name');
    //     $res->category_slug = $request->input('category_slug');
    //     $res->save();
    //     $request->session()->flash("cat-msg","Category Added Successfully");
    //     return redirect('admin/category');
    // }

    ## We are using one function for new and update category
    public function manage_category($id='')
    {
        if($id > 0){
            $res = Category::where('id',$id)->get();
            $Arr['category_id'] = $res[0]->id;
            $Arr['category_name'] = $res[0]->category_name;
            $Arr['category_slug'] = $res[0]->category_slug;
            return view('admin/category/categories_manage',$Arr);
        }
        $Arr['category_id'] = 0;
        $Arr['category_name'] = '';
        $Arr['category_slug'] = '';
        return view('admin/category/categories_manage',$Arr);
    }
    public function manage_category_process(Request $request)
    {
        $id = $request->input('category_id');
        $request->validate([
            'category_name'=>'required',
            'category_slug'=>'required|unique:categories,category_slug,'.$id,
        ]);
        
        ## For New Category
        if($id == 0){
            $res = new Category();
            $msg = "Category Added Successfully";
        }
        ## For Update Category
        else{
            $res = Category::find($id);
            $msg = "Category Updated Successfully";
        }
        $res->category_name = $request->input('category_name');
        $res->category_slug = $request->input('category_slug');
        $res->status = 1;
        $res->save();
        $request->session()->flash("cat-msg",$msg);
        return redirect('admin/category');
    }
    function delete_category(Request $request,$id){
        $res = Category::find($id)->delete();
        $request->session()->flash("cat-msg","Category Deleted Successfully");
        return redirect('admin/category');
    }
    function status_category(Request $request,$status,$id){
        $model = Category::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash("cat-msg","Category Status Updated Successfully");
        return redirect('/admin/category');    
    }
}
