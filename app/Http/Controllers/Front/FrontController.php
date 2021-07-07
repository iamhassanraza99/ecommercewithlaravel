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
        // prix($Arr['Users']);
        if(isset($Arr['Users'][0])){
            if($request->post('email') == $Arr['Users'][0]->email && $request->post('password') == $Arr['Users'][0]->password){
                $request->session()->put('FRONT_USER_LOGIN',$Arr['Users'][0]->id);
                $request->session()->put('USER_NAME',$Arr['Users'][0]->name);
                return back();
            }
            else{
                echo "No";
            }
        }
       
        // dd($Arr);
    }
    public function logout(Request $request){
        $request->session()->remove('FRONT_USER_LOGIN');
        return back();
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
                
                $Arr['Home_Product_Attr'][$list1->id] = DB::table('products_attr')
                ->leftjoin('sizes','sizes.id','=','products_attr.size_id')
                ->leftjoin('colors','colors.id','=','products_attr.color_id')
                ->where(['product_id'=>$list1->id])
                ->get();
            }
        }
        // prix($Arr['Home_Product_Attr']);
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
        // prix($Arr);
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

        // prix($Arr['Product_Attr']);
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
        return view('front.product_detail',$Arr);
    }
    function add_to_cart(Request $request){
        if($request->session()->has('FRONT_USER_LOGIN')){
            $uid = $request->session()->get('FRONT_USER_LOGIN');
            $user_type = "Registered";
        }
        else{
            $uid = getUserTempId();
            $user_type = "Not-Register";
        }
            $product_id = $request->post('product_id');
            $size = $request->post('size_id');
            $color = $request->post('color_id');
            $product_qty = $request->post('product_qty');
            $product_price = $request->post('product_price');

            $result = DB::table('products_attr')
            ->select('products_attr.id')
            ->leftjoin('sizes','sizes.id','=','products_attr.size_id')
            ->leftjoin('colors','colors.id','=','products_attr.color_id')
            ->where(['product_id'=>$product_id])
            ->where(['sizes.size'=>$size])
            ->where(['colors.color'=>$color])
            ->get();
            
            $product_attr_id = $result[0]->id;

            $checkDatabaseRecord = DB::table('cart')
            ->where(['user'=>$uid])
            ->where(['user_type'=>$user_type])
            ->where(['product_id'=>$product_id])
            ->where(['product_attr_id'=>$product_attr_id])
            ->where(['price'=>$product_price])
            ->get();

            if(isset($checkDatabaseRecord[0])){
                
                $update_id = $checkDatabaseRecord[0]->id;
                DB::table('cart')
                ->where(['id'=>$update_id])
                ->update(['qty'=>$product_qty]);
                $msg = "Updated";
            }
            else{
                $id = DB::table('cart')->insertGetID([
                    'user' => $uid,
                    'user_type' => $user_type,
                    'product_id' => $product_id,
                    'product_attr_id' => $product_attr_id,
                    'qty' => $product_qty,
                    'price' => $product_price,
                    'added_on' => date('Y-m-d h:i:s')
                ]);
                $msg = "Added";
            }

            // To SEND RESPONSE BACK TO ADD-TO-CART-FUNCNTION
            $result = DB::table('cart')
            ->leftjoin('products','products.id','=','cart.product_id')
            ->leftjoin('products_attr','products_attr.id','=','cart.product_attr_id')
            ->leftjoin('sizes','sizes.id','=','products_attr.size_id')
            ->leftjoin('colors','colors.id','=','products_attr.color_id')
            ->where(['user'=>$uid])
            ->where(['user_type'=>$user_type])
            ->select('products.id as pid','products.product_name','products.product_slug','products.product_image','sizes.size','colors.color','products_attr.price','products_attr.id as attr_id', 'cart.qty')
            ->get();
            return response()->json(['msg'=>$msg,'data'=>$result,'totalCartItems'=>count($result)]);
    }

    function cart(Request $request){
        if($request->session()->has('FRONT_USER_LOGIN')){
            $uid = $request->session()->get('FRONT_USER_LOGIN');
            $user_type = "Registered";
        }
        else{
            $uid = getUserTempId();
            $user_type = "Not-Register";
        }
        $Arr['Cart'] = DB::table('cart')
        ->leftjoin('products','products.id','=','cart.product_id')
        ->leftjoin('products_attr','products_attr.id','=','cart.product_attr_id')
        ->leftjoin('sizes','sizes.id','=','products_attr.size_id')
        ->leftjoin('colors','colors.id','=','products_attr.color_id')
        ->where(['user'=>$uid])
        ->where(['user_type'=>$user_type])
        ->select('products.id as pid','products.product_name','products.product_slug','products.product_image','sizes.size','colors.color','products_attr.price','products_attr.id as attr_id', 'cart.qty')
        ->get();
        // prix($Arr['Cart']);
        return view('front.cart',$Arr);
    }
    function removeFromCart(Request $request,$product_attr_id){
        DB::table('cart')->where(['product_attr_id'=>$product_attr_id])->delete();
        $request->session()->flash('cart-msg','Product has been removed!');
        return back();
    }
    
    function category_product(Request $request, $slug){
        
        $Arr['Category'] = DB::table('categories')
        ->where(['status'=>'1'])
        ->where(['category_slug'=>$slug])
        ->where(['showOnFrontend'=>'1'])
        ->get();
        
        foreach($Arr['Category'] as $list){
            $Arr['Products'][$list->id] = DB::table('products')
            ->where(['category_id'=>$list->id])
            ->where(['status'=>'1'])
            ->get();
            
            foreach($Arr['Products'][$list->id] as $list1){
                
                $Arr['Product_Attr'][$list1->id] = DB::table('products_attr')
                ->leftjoin('sizes','sizes.id','=','products_attr.size_id')
                ->leftjoin('colors','colors.id','=','products_attr.color_id')
                ->where(['product_id'=>$list1->id])
                ->get();
            }
        }
        
        $Arr['AllCategories'] = DB::table('categories')
        ->where(['status'=>'1'])
        ->where(['showOnFrontend'=>'1'])
        ->get();

        $Arr['Colors'] = DB::table('colors')
        ->where(['status'=>'1'])
        ->get();
        // prix($Arr['AllCategories']);
        return view('front.categoryproduct',$Arr);
    }
    function ProductOncolorBase(Request $request,$color,$category){
       
        $Arr['Category'] = DB::table('categories')
        ->where(['status'=>'1'])
        ->where(['showOnFrontend'=>'1'])
        ->where(['category_name'=>$category])
        ->get();
        
        $Arr['colors'] = DB::table('colors')
        ->where(['status'=>'1'])
        ->where(['color'=>$color])
        ->get();

        $color_id = $Arr['colors'][0]->id;
        
        foreach($Arr['Category'] as $list){
            $Arr['Category_Products'][$list->id] = DB::table('products')
            ->where(['category_id'=>$list->id])
            ->where(['status'=>'1'])
            ->get();
            
            foreach($Arr['Category_Products'][$list->id] as $list1){
                
                $Arr['Category_Product_Attr'][$list1->id] = DB::table('products_attr')
                ->leftjoin('sizes','sizes.id','=','products_attr.size_id')
                ->leftjoin('colors','colors.id','=','products_attr.color_id')
                ->where(['product_id'=>$list1->id])
                ->where(['color_id'=>$color_id])
                ->get();
            }
        }
        return view('front.categoryproduct',$Arr);
    }
}