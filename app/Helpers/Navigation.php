<?php

use Illuminate\Support\Facades\DB;

    function getTopNavCat(){
        $Arr = DB::table('categories')
        ->where(['status'=>'1'])
        ->get();
        $arr=[];
        foreach($Arr as $row){
            $arr[$row->id]['name'] = $row->category_name;
            $arr[$row->id]['parent_id'] = $row->parent_category_id;
            $arr[$row->id]['category_name'] = $row->category_slug;
        }
        // prix($arr);  
        $str=buildTreeView($arr,0);
        return $str;
       
    }
    $html='';
    function buildTreeView($arr,$parent,$level=0,$prelevel= -1){
        global $html;
        foreach($arr as $id=>$data){
        //   prix($arr);
            if($parent==$data['parent_id']){
                if($level>$prelevel){
                    if($html==''){
                        $html.='<ul class="nav navbar-nav">';
                    }else{
                        $html.='<ul class=dropdown-menu>';
                    }
                    
                }
                if($level==$prelevel){
                    $html.='</li>';
                }
                
                // if($data['parent_id']!=0){
                //     $dropdownClass = "caret";
                // }
                // else{
                //     $dropdownClass="";
                // }
                $html.='<li><a href="/category/'.$data['category_name'].'">'.$data['name'].'<span class="caret"></span></a>';
                if($level>$prelevel){
                    $prelevel=$level;
                }
                $level++;
                buildTreeView($arr,$id,$level,$prelevel);
                $level--;
            }
            // prix($data['parent_id']);
        }
        if($level==$prelevel){
            $html.='</li></ul>';
        }
        return $html;
    }
    function getUserTempId(){
        if(session()->has('USER_TEMP_ID') == ''){
            $rand = rand(111111111,999999999);
            session()->put('USER_TEMP_ID',$rand);
            return $rand;
        }
        else{
            return session()->get('USER_TEMP_ID');
        }
    }

    function ShopingCart(){
        if(session()->has('FRONT_USER_LOGIN')){
            $uid = session()->get('FRONT_USER_LOGIN');
            $user_type = "Registered";
        }
        else{
            $uid = getUserTempId();
            $user_type = "Not-Register";
        }
        $Arr = DB::table('cart')
        ->leftjoin('products','products.id','=','cart.product_id')
        ->leftjoin('products_attr','products_attr.id','=','cart.product_attr_id')
        ->leftjoin('sizes','sizes.id','=','products_attr.size_id')
        ->leftjoin('colors','colors.id','=','products_attr.color_id')
        ->where(['user'=>$uid])
        ->where(['user_type'=>$user_type])
        ->select('products.id as pid','products.product_name','products.product_slug','products.product_image','sizes.size','colors.color','products_attr.price','products_attr.id as attr_id', 'cart.qty')
        ->get();
        return $Arr;
    }
    function prix($arr){
        echo "<pre>";
        print_r($arr);
        die();
    }
?>