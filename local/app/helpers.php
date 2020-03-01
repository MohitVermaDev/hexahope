<?php 
if(!function_exists('site_name_new'))
{
    function site_name_new()
    {
        $setnae = DB::table('admin_settings')->where('setting_name','web_title')->first();
        return $setnae->setting_value;
    }
}
if(!function_exists('member_using_member_id'))
{
    function member_using_member_id($memid)
    {
        $user = new App\User;
        return $user::where('memberid',$memid)->get();
    }
}
if(!function_exists('getUniqueuid'))
{
    function getUniqueuid()
    {
        $newid = 'HEXA'.str_pad(mt_rand(1,99999999),8,'0',STR_PAD_LEFT);
        $user = new App\User;
        $idcheck = $user::where('memberid',$newid)->get();
        if(count($idcheck)>0)
        {
            return getUniqueuid();
        }
        return $newid;
    }
}
if(!function_exists('gettotalsponsers'))
{
    function gettotalsponsers($id){
        $user = new App\User;
        $spons = $user::where('id',$id)->first();
        $total = $user::where('sponserid',$spons->memberid)->where('id_active',1)->count();
        return $total;
    }
}
if(!function_exists('change_color_of_member_tree'))
{
    function change_color_of_member_tree($mem){
        $user = new App\User;
        $spons = $user::where('memberid',$mem)->first();
       switch($spons->plan_id)
       {
            case "1":
               return 'firstplan';
               break;
            case "2":
               return 'secondplan';
               break;
            case "3":
               return 'thridplan';
               break;
            case "4":
               return 'lastplan';
               break;
            default:
                return "firstplan";
       }
    }
}
if(!function_exists('create_downline_report'))
{
 function create_downline_report($mem_id,$active)
 {
     //income type 1
     $ftarr = [];
     $ftarr1 = [];
if($active != 0){

    $c = DB::table('users')->where("id",$mem_id)->where('id_active',$active)->get(); 
}else{

    $c = DB::table('users')->where("id",$mem_id)->get(); 
}
    if(count($c)>0)
    {
        if($c[0]->link_left != '')
        {
               $ftarr[] = $c[0]->link_left;
               $ftarr1[] = array($c[0]->link_left,1);
        }
        if($c[0]->link_center != '')
        {
               $ftarr[] = $c[0]->link_center;
               $ftarr1[] = array($c[0]->link_center,1);
        }
        if($c[0]->link_right != '')
        {
               $ftarr[] = $c[0]->link_right;
               $ftarr1[] = array($c[0]->link_right,1);
        }
        return final_downline_report($ftarr,$ftarr1,$active,2);
        // return $ftarr;
    }

 }
}

//Downline Report
if(!function_exists('final_downline_report'))
{
 function final_downline_report($ftmem,$ftarr,$active,$level)
 {
     //income type 1
     $rftarr = [];

    if(count($ftmem)>0){
            foreach($ftmem as $memid)
    {

        if($active != 0){

            $c = DB::table('users')->where("memberid",$memid)->where('id_active',$active)->get(); 
        }else{
        
            $c = DB::table('users')->where("memberid",$memid)->get(); 
        }
        if(count($c)>0)
        {
            if($c[0]->link_left != '')
            {
                $rftarr[] = $c[0]->link_left;
                $ftarr[] = array($c[0]->link_left,$level);

            }
            if($c[0]->link_center != '')
            {
                $rftarr[] = $c[0]->link_center;

                $ftarr[] = array($c[0]->link_center,$level);
            }
            if($c[0]->link_right != '')
            {
                $rftarr[] = $c[0]->link_right;

                $ftarr[] = array($c[0]->link_right,$level);
            }
        }
        
    }
    $level++;
return final_downline_report($rftarr,$ftarr,$active,$level);
    }
return $ftarr;
    

 }
}



if(!function_exists('activae_create_downline_report'))
{
 function activae_create_downline_report($mem_id)
 {
     //income type 1
     $ftarr = [];
     $ftarr1 = [];
    $c = DB::table('users')->where("sponserid",$mem_id)->get(); 

    if(count($c)>0)
    {
        foreach($c as $r){
            $ftarr[] = $r->memberid;
            $ftarr1[] = $r->memberid;
        }
        
        
        return activae_final_downline_report($ftarr,$ftarr1);
        // return $ftarr;
    }

 }
}

//Downline Report
if(!function_exists('activae_final_downline_report'))
{
 function activae_final_downline_report($ftmem,$ftarr)
 {
     //income type 1
     $rftarr = [];

    if(count($ftmem)>0){
            foreach($ftmem as $memid)
    {

        $c = DB::table('users')->where("sponserid",$memid)->get(); 
       
        if(count($c)>0)
        {
            foreach($c as $r){
                $rftarr[] = $r->memberid;
                $ftarr[] = $r->memberid;
            }
            
        }
        
    }
return activae_final_downline_report($rftarr,$ftarr);
    }
return $ftarr;
    

 }
}

if(!function_exists('make_pool_report'))
{
 function make_pool_report()
 {
     //income type 1
     $ftarr = [];
     $ftarr1 = [];
    $c = DB::table('auto_pools')->orderBy('id','ASC')->first(); 

    if(!empty($c))
    {
        
        $userarray = [$c->user_id];
        
        $ftarr[0] = [$userarray];
        $ftarr1[] = $c->user_id;
        return final_make_pool_report($ftarr,$ftarr1,1);
        // return $ftarr;
    }

 }
}

//Downline Report
if(!function_exists('final_make_pool_report'))
{
 function final_make_pool_report($ftmem,$ftarr,$count)
 {
     //income type 1
     $rftarr = [];
$userarray = [];
    if(count($ftmem)>0){
    foreach($ftmem as $memid)
    {

        $c = DB::table('auto_pools')->where('user_id',$memid)->orderBy('id','ASC')->first(); 
       
        if(!empty($c))
        {
            
            if($c->left_id !=''){
                $userarray[] = $c->left_id;
                $rftarr[] = $c->left_id;
            }
            if($c->center_id !=''){
                $userarray[] = $c->center_id;
                $rftarr[] = $c->center_id;
            }
            if($c->right_id !=''){
                $userarray[] = $c->right_id;
                $rftarr[] = $c->right_id;
            }
            $ftarr[$count] = $userarray;
        }
        
    }
    $count++;
return final_make_pool_report($rftarr,$ftarr,$count);
    }
return $ftarr;
    

 }
}


?>