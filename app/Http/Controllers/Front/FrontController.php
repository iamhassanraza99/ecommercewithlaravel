<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class FrontController extends Controller
{
    public function Login(Request $request){
        // dd($request->post());
        $Arr['Users'] = DB::table('users')->get();
        if(isset($Arr['Users'][0])){
            if($request->post('email') == $Arr['Users'][0]->email && $request->post('password') == $Arr['Users'][0]->password){
                echo "yes";
            }
            else{
                echo "No";
            }
        }
       
        // dd($Arr);
    }
   
    public function index(Request $request)
    {
        $Arr['HomeBanner'] = DB::table('home_banners')
        ->where(['status'=>'1'])
        ->get();
        
        $Arr['Category'] = DB::table('categories')->where(['status'=>'1'])->where(['showOnFrontend'=>'1'])->get();
        
        foreach($Arr['Category'] as $list){
            $Arr['Category_Products'][$list->id] = DB::table('products')
            ->where(['category_id'=>$list->id])
            ->where(['status'=>'1'])
            ->get();
            
            foreach($Arr['Category_Products'][$list->id] as $list1){
                
                $Arr['Product_Attr'][$list1->id] = DB::table('products_attr')
                ->leftjoin('sizes','sizes.id','=','products_attr.size_id')
                ->leftjoin('colors','colors.id','=','products_attr.color_id')
                ->where(['product_id'=>$list1->id])
                ->get();
            }
        }
    //    prix($Arr['Product_Attr']);
        $Arr['Brands'] = DB::table('brands')
        ->where(['status'=>'1'])
        ->where(['showOnFrontend'=>'1'])
        ->get();

        // FEATURED PRODUCT START
        $Arr['Featured_Products'] = DB::table('products')
            ->where(['is_featured'=>'1'])
            ->where(['status'=>'1'])
            ->get();
        
        foreach($Arr['Featured_Products'] as $list1){
                
                $Arr['Featured_Product_Attr'][$list1->id] = DB::table('products_attr')
                ->leftjoin('sizes','sizes.id','=','products_attr.size_id')
                ->leftjoin('colors','colors.id','=','products_attr.color_id')
                ->where(['product_id'=>$list1->id])
                ->get();
        }
        // FEATURED PRODUCT END
        // prix($Arr['Featured_Product_Attr']);
         // TRENDING PRODUCT START
         $Arr['Trending_Products'] = DB::table('products')
         ->where(['is_trending'=>'1'])
         ->where(['status'=>'1'])
         ->get();
         
        foreach($Arr['Trending_Products'] as $list1){
                
                $Arr['Trending_Products_Attr'][$list1->id] = DB::table('products_attr')
                ->leftjoin('sizes','sizes.id','=','products_attr.size_id')
                ->leftjoin('colors','colors.id','=','products_attr.color_id')
                ->where(['product_id'=>$list1->id])
                ->get();
        }
        // TRENDING PRODUCT END

        // DISCOUNTED PRODUCT START
        $Arr['Discounted_Products'] = DB::table('products')
        ->where(['is_discounted'=>'1'])
        ->where(['status'=>'1'])
        ->get();
        
        foreach($Arr['Discounted_Products'] as $list1){
                
                $Arr['Discounted_Products_Attr'][$list1->id] = DB::table('products_attr')
                ->leftjoin('sizes','sizes.id','=','products_attr.size_id')
                ->leftjoin('colors','colors.id','=','products_attr.color_id')
                ->where(['product_id'=>$list1->id])
                ->get();
        }
        // DISCOUNTED PRODUCT END
        // echo "<pre>";
        // print_r($Arr['Discounted_Products']);
        // die();
        return view('front.index',$Arr);
    }

    public function product_detail(Request $request,$product_slug){

        
        $Arr['ProductDetail'] = DB::table('products')
        ->where(['product_slug'=>$product_slug])
        ->where(['status'=>'1'])
        ->get();
        foreach($Arr['ProductDetail'] as $list1){
                
                $Arr['Product_Attr'][$list1->id] = DB::table('products_attr')
                ->leftjoin('sizes','sizes.id','=','products_attr.size_id')
                ->leftjoin('colors','colors.id','=','products_attr.color_id')
                ->where(['product_id'=>$list1->id])
                ->get();
                $Arr['Product_Images'][$list1->id] = DB::table('product_images')
                ->where(['product_id'=>$list1->id])
                ->get();
        }

        // prix($Arr['ProductDetail']);
        $cat_id = $Arr['ProductDetail'][0]->category_id;
        $Arr['Related_Products'] = DB::table('products')
        ->where(['status'=>'1'])
        ->where('product_slug','!=',$product_slug)
        ->where(['category_id'=>$cat_id])
        ->get();
        foreach($Arr['Related_Products'] as $list1){
                
            $Arr['Related_Product_Attr'][$list1->id] = DB::table('products_attr')
            ->leftjoin('sizes','sizes.id','=','products_attr.size_id')
            ->leftjoin('colors','colors.id','=','products_attr.color_id')
            ->where(['product_id'=>$list1->id])
            ->get();
            $Arr['Product_Images'][$list1->id] = DB::table('product_images')
            ->where(['product_id'=>$list1->id])
            ->get();
    }
        // prix($Arr['Related_Product_Attr']);
        return view('front.product_detail',$Arr);
    }
function prix($arr){
    echo "<pre>";
    print_r($arr);
    die();
}
    
}