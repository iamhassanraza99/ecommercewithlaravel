<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class FrontController extends Controller
{
   
    public function index(Request $request)
    {
        $Arr['HomeBanner'] = DB::table('home_banners')
        ->where(['status'=>'1'])
        ->get();
        // echo "<pre>";
        // print_r($Arr['HomeBanner']);
        // die();
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
       
        $Arr['Brands'] = DB::table('brands')
        ->where(['status'=>'1'])
        ->where(['showOnFrontend'=>'1'])
        ->get();

        // FEATURED PRODUCT START
        $Arr['Featured_Products'][$list->id] = DB::table('products')
            ->where(['is_featured'=>'1'])
            ->where(['status'=>'1'])
            ->get();
            
        foreach($Arr['Featured_Products'][$list->id] as $list1){
                
                $Arr['Featured_Product_Attr'][$list1->id] = DB::table('products_attr')
                ->leftjoin('sizes','sizes.id','=','products_attr.size_id')
                ->leftjoin('colors','colors.id','=','products_attr.color_id')
                ->where(['product_id'=>$list1->id])
                ->get();
        }
        // FEATURED PRODUCT END

         // TRENDING PRODUCT START
         $Arr['Trending_Products'][$list->id] = DB::table('products')
         ->where(['is_trending'=>'1'])
         ->where(['status'=>'1'])
         ->get();
         
        foreach($Arr['Trending_Products'][$list->id] as $list1){
                
                $Arr['Trending_Products_Attr'][$list1->id] = DB::table('products_attr')
                ->leftjoin('sizes','sizes.id','=','products_attr.size_id')
                ->leftjoin('colors','colors.id','=','products_attr.color_id')
                ->where(['product_id'=>$list1->id])
                ->get();
        }
        // TRENDING PRODUCT END

        // DISCOUNTED PRODUCT START
        $Arr['Discounted_Products'][$list->id] = DB::table('products')
        ->where(['is_discounted'=>'1'])
        ->where(['status'=>'1'])
        ->get();
        
        foreach($Arr['Discounted_Products'][$list->id] as $list1){
                
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

    public function product_detail($category_id,$product_slug){

        
        $Arr['ProductDetail'] = DB::table('products')
        ->where(['product_slug'=>$product_slug])
        ->get();
        $Arr['pid'] = $Arr['ProductDetail'][0]->id;
            foreach($Arr['ProductDetail'] as $list1){
                
                $Arr['Product_Attr'][$list1->id] = DB::table('products_attr')
                ->leftjoin('sizes','sizes.id','=','products_attr.size_id')
                ->leftjoin('colors','colors.id','=','products_attr.color_id')
                ->where(['product_id'=>$list1->id])
                ->get();
            }
        // $cat_id = $Arr['ProductDetail']->category_id;
        $Arr['Category'] = DB::table('categories')
        ->where(['status'=>'1'])
        ->where(['id'=>$category_id])
        ->get();

        // echo "<pre>";
        // print_r($Arr['Category'][0]);
        // print_r($Arr['Product_Attr'][$pid][0]->price);
        // die();
        return view('front.product_detail',$Arr);
    }

    
}