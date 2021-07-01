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
                $html.='<li><a href="#">'.$data['name'].'<span class="caret"></span></a>';
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
    function prix($arr){
        echo "<pre>";
        print_r($arr);
        die();
    }
?>