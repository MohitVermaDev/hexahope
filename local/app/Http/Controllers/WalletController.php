<?php

namespace App\Http\Controllers;

use App\Wallet;
use App\Money;
use App\Mail\BtcOtp;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Role;
use App\AutoPool;
use DB;
use DataTables;
use App\AdminSettings;
use Illuminate\Support\Facades\Hash;
class WalletController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

   public function check_first_balance(Request $request)
   {
       //only for user
        if($request->ajax()){
            $getbalance0 = Auth::User()->wallets[0]->amount;
            $getbalance1 = Auth::User()->wallets[1]->amount;
            $getbalance2 = Auth::User()->wallets[2]->amount;
            $getamount = $request->value;
            $amnt = 0;
            $amnt1 = 0;
            $plan_arr = [1,2,3,4];
            $plan = Auth::User()->plan_id+1;
            if($getamount > Auth::User()->plan_id && in_array($getamount,$plan_arr)){
                for($i=$plan;$i<=$getamount;$i++)
                {
                    if($i == 1){
                        $amnt+=10;
                        $amnt1+=0;
                    }
                    if($i == 2){
                        $amnt1+=0;
                        $amnt+=15;
                    }
                    if($i == 3){
                        $amnt+=50;
                        $amnt1+=0;
                    }
                    if($i == 4){
                        $amnt1+=0;
                        $amnt+=75;
                    }
                }
                if ($amnt1 > 0){
                    if($getbalance1 < $amnt && $getbalance2 < $amnt1){
                        return response()->json(['error'=>'Insufficient Balance']);
                    }
                }else
                {
                    if($getbalance1 < $amnt){
                        if($getbalance0 < $amnt){
                            return response()->json(['error'=>'Insufficient Balance']);
                        }elseif($getbalance0 >= $amnt){
                            return response()->json(['success'=>'Your Balance is Sufficient']);
                        }
                        
                    }
                }
                return response()->json(['success'=>'Your Balance is Sufficient']);
            }
           return response()->json(['error'=>'Insufficient Balance']);
        }
        return redirect('/');
   }
   public function topup_wallet(Request $request)
   {
        //only for admin
         if ($request->ajax()) {
            $data = DB::table('topup_wallet')->where('sent_by',1)->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function($row){
                        return User::where('id',$row->user_id)->first()->name;
                    })
                    ->addColumn('userid', function($row){
                        return User::where('id',$row->user_id)->first()->memberid;
                    })
                    ->rawColumns(['name','userid'])
                    ->make(true);
        }
        $data['title'] = 'TOPUP MEMBER WALLET';
        return view('admin.topupform')->with($data);
   }
   public function topup_wallet_now(Request $request)
   {
       $request->validate([
           'memberid'=>'required',
           'amount'=>'required|numeric',
       ]);

       $getuser = User::where('memberid',$request->memberid)->first();
        if(!empty($getuser))
        {
            DB::table('topup_wallet')->insert([
                'user_id'=>$getuser->id,
                'wallet_id'=>$getuser->wallets[1]->id,
                'amount'=>$request->amount,
                'sent_by'=>Auth::id(),
                'sent_from'=>'1',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ]);
            Wallet::where('id',$getuser->wallets[1]->id)->update(['amount'=>DB::RAW("amount + $request->amount")]);
        }else
        {
            return redirect()->back()->with(['error'=>'Member Id is Invalid']);
        }
        return redirect()->back()->with(['success'=>'Member Topup Successfully']);

   }
   public function activation(Request $request)
   {
        $data = $request->validate([
            "value"  => "required|numeric",
        ]);
        $plan_arr = [1,2,3,4];
        $getbalance0 = Auth::User()->wallets[0]->amount;
          $getbalance1 = Auth::User()->wallets[1]->amount;
            $getbalance2 = Auth::User()->wallets[2]->amount;
            $amnt =0;
            $amnt1 = 0;
            $getamount = $request->value;
            $plan = Auth::User()->plan_id+1;
            if($getamount > Auth::User()->plan_id && in_array($getamount,$plan_arr)){
                for($i=$plan;$i<=$getamount;$i++)
                {
                    if($i == 1){
                        $amnt+=10;
                        $amnt1+=0;
                    }
                    if($i == 2){
                        $amnt1+=0;
                        $amnt+=15;
                    }
                    if($i == 3){
                        $amnt+=50;
                        $amnt1+=0;
                    }
                    if($i == 4){
                        $amnt1+=0;
                        $amnt+=75;
                    }
                }
                if ($amnt1 > 0){
                    if($getbalance1 < $amnt && $getbalance2 < $amnt1){
                        return response()->json(['error'=>'Insufficient Balance']);
                    }
                }else
                {
                    if($getbalance1 < $amnt){
                        if($getbalance0 < $amnt){
                            return response()->json(['error'=>'Insufficient Balance']);
                        }
                    }
                }
            for($i=$plan;$i<=$getamount;$i++)
            {
                $id = Auth::id();
                    if($i == 1){
                        //10
                        self::activate_now(10,0,1,$id);
                        self::fill_uplink_data_from_id(Auth::User()->sponserid,Auth::User()->memberid);
                        $user = User::where('id',Auth::id())->first();
                        $uplin = self::get_uplink_id($user->u_parent,1,1);
                        self::send_payment($id,7,0,$uplin,1);
                        
                        for($iw=4;$iw<=12;$iw++){
                            $uplin2 = self::get_uplink_id($user->u_parent,$iw,1);
                            self::send_payment($id,1,$iw,$uplin2,4);
                        }
                        AdminSettings::where('setting_name','loyality_income')->update(['setting_value'=>DB::RAW('setting_value + 3')]);
                    }
                    elseif($i == 2){
                        //15
                        self::activate_now(15,0,2,$id);
                        $user = User::where('id',Auth::id())->first();
                        $uplin = self::get_uplink_id($user->u_parent,2,1);
                        self::send_payment($id,12,2,$uplin,2);
                        AdminSettings::where('setting_name','loyality_income')->update(['setting_value'=>DB::RAW('setting_value + 3')]);
                    }
                    elseif($i == 3){
                        //50
                        self::activate_now(50,0,3,$id);
                        $user = User::where('id',Auth::id())->first();
                        $uplin = self::get_uplink_id($user->u_parent,3,1);
                        self::send_payment($id,47,3,$uplin,3);
                        AdminSettings::where('setting_name','loyality_income')->update(['setting_value'=>DB::RAW('setting_value + 3')]);
                    }
                    elseif($i == 4){
                        //75
                        self::activate_now(75,0,4,$id);
                        $user = User::where('id',Auth::id())->first();
                        self::addin_autopool(Auth::id());
                        
                    }
                   
            }
            return response()->json(['success'=>'Member Activated Successfully']);
        }
         return response()->json(['error'=>$getamount]);
   }
   public function addin_autopool($id)
   {
       $ttal = gettotalsponsers($id);
       if($ttal >=5 ){
            AutoPool::create([
               'user_id'=>$id,           
            ]);
            $allauto = AutoPool::where('user_id','!=',$id)->orderBy('id','asc')->get();
           if(count($allauto)>0)
           {
               foreach($allauto as $all){
                    if($all->left_id == '')
                    {
                        AutoPool::where('user_id',$all->user_id)->update(['left_id'=>$id]);
                        AutoPool::where('user_id',$id)->update(['parent_id'=>$all->user_id,'position'=>1]);
                        for($i=1;$i<=12;$i++){
                            $finparent = self::get_pool_uplink_id($all->user_id,$i,1);
                            if($finparent != 0)
                            {
                                DB::table('pool_incomes')->insert([
                                    'user_id'=>$id,
                                    'pay_id'=>$finparent,
                                    'pool_amount'=>5,
                                    'level'=>$i,
                                    'status'=>1,
                                    'created_at'=>date('Y-m-d H:i:s'),
                                    'updated_at'=>date('Y-m-d H:i:s')
                                ]);
                                Wallet::where('user_id',$finparent)->where('type',1)->update(['amount'=>DB::RAW("amount + 5")]);
    
                            }
    
                        }
                        return true;
                    }elseif($all->center_id == '')
                    {
                        AutoPool::where('user_id',$all->user_id)->update(['center_id'=>$id]);
                        AutoPool::where('user_id',$id)->update(['parent_id'=>$all->user_id,'position'=>2]);
                        for($i=1;$i<=12;$i++){
                            $finparent = self::get_pool_uplink_id($all->user_id,$i,1);
                            if($finparent != 0)
                            {
                                DB::table('pool_incomes')->insert([
                                    'user_id'=>$id,
                                    'pay_id'=>$finparent,
                                    'pool_amount'=>5,
                                    'level'=>$i,
                                    'status'=>1,
                                    'created_at'=>date('Y-m-d H:i:s'),
                                    'updated_at'=>date('Y-m-d H:i:s')
                                ]);
                                Wallet::where('user_id',$finparent)->where('type',1)->update(['amount'=>DB::RAW("amount + 5")]);
    
                            }
                        }
                        return true;
                    }elseif($all->right_id == '')
                    {
                        AutoPool::where('user_id',$all->user_id)->update(['right_id'=>$id]);
                        AutoPool::where('user_id',$id)->update(['parent_id'=>$all->user_id,'position'=>3]);
                        for($i=1;$i<=12;$i++){
                            $finparent = self::get_pool_uplink_id($all->user_id,$i,1);
                            if($finparent != 0)
                            {
                                DB::table('pool_incomes')->insert([
                                    'user_id'=>$id,
                                    'pay_id'=>$finparent,
                                    'pool_amount'=>5,
                                    'level'=>$i,
                                    'status'=>1,
                                    'created_at'=>date('Y-m-d H:i:s'),
                                    'updated_at'=>date('Y-m-d H:i:s')
                                ]);
                                Wallet::where('user_id',$finparent)->where('type',1)->update(['amount'=>DB::RAW("amount + 5")]);
    
                            }
                        }
                        return true;
                    }
               }
           }
       }
       
       return true;
   }
   public function send_payment($id,$payment, $reason,$payid,$pack)
   {
       $ttal = gettotalsponsers($payid);
       $userpack = User::where('id',$payid)->first();
       if($ttal >= $reason && $pack <= $userpack->plan_id){
           if($reason==0){
               $reason=1;
           }
           Money::create([
               'user_id'=>$id,
               'pay_user_id'=>$payid,
               'amount'=>$payment,
               'reason'=>$reason,
               'status'=>0
           ]);
           Wallet::where('user_id',$payid)->where('type',1)->update(['amount'=>DB::RAW("amount + $payment")]);
       }else if($userpack->plan_id < $pack)
       {
           Money::create([
               'user_id'=>$id,
               'pay_user_id'=>$payid,
               'amount'=>$payment,
               'reason'=>$reason,
               'status'=>3
           ]);
       }else
       {
           Money::create([
               'user_id'=>$id,
               'pay_user_id'=>$payid,
               'amount'=>$payment,
               'reason'=>$reason,
               'status'=>2
           ]);
       }
    return true;
   }
   public function get_pool_uplink_id($mem,$loopi,$newloop)
   {
       if($loopi == $newloop)
       {
            $id = AutoPool::where('user_id',$mem)->first();
            if(!empty($id))
            {
                return $id->user_id;
            }
            else
            {
                return 0;
            }
       }
       else
       {
            $id = AutoPool::where('user_id',$mem)->first();
            if(!empty($id))
            {
                $newloop++;
                return self::get_pool_uplink_id($id->parent_id,$loopi,$newloop);
            }else
            {
                return 0;
            }
       }
       return true;
   }
   public function get_uplink_id($mem,$loopi,$newloop)
   {
       if($loopi == $newloop)
       {
            $id = User::where('memberid',$mem)->first();
            if(!empty($id))
            {
                return $id->id;
            }
            else{

                $admin = Role::where('name','admin')->first()->users()->first();
                return $admin->id;
            }
       }
       else
       {
            $id = User::where('memberid',$mem)->first();
            if(!empty($id))
            {
                $newloop++;
                return self::get_uplink_id($id->u_parent,$loopi,$newloop);
            }else{

                $admin = Role::where('name','admin')->first()->users()->first();
                return $admin->id;
            }
       }
       return true;
   }
      public function activate_now_downline($amount1,$amoun2,$plan,$id)
   {
        User::where('id',$id)->update([
            'id_active'=>1,
            'activation_date'=>date('Y-m-d H:i:s'),
            'plan_id'=>$plan,
        ]);
        DB::table('member_activation')->where('user_id',$id)->update(['status'=>1]);
        DB::table('member_activation')->insert([
            'user_id'=>$id,
            'plan'=>$plan,
            'amount'=>$amount1+$amoun2,
            'activated_by'=>Auth::id(),
            'status'=>0,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            ]);
        Wallet::where('id',Auth::User()->wallets[1]->id)->update(['amount'=>DB::RAW("amount - $amount1")]);
        Wallet::where('id',Auth::User()->wallets[2]->id)->update(['amount'=>DB::RAW("amount - $amoun2")]);
        $textplan = '';
        if($plan==1){
            $textplan = 'Hexa Master';
        }
        elseif($plan==2){
            $textplan = 'Hexa Royal';
        }
        elseif($plan==3){
            $textplan = 'Hexa Diamond';
        }
        elseif($plan==4){
            $textplan = 'Hexa Crown';
        }
        $uher = User::where('id',$id)->first();
        $user['name'] = $uher->name;
       $user['memberid'] = $uher->memberid;
       $user['plan'] = $textplan;
       Mail::send('mails.activation', ['data' => $user], function ($m) use ($uher) {
                $m->to($uher->email)->subject('Congratulations! You Have Successfully Activate New Plan on Your ID');
        });
        return true;
   }
   public function activate_now($amount1,$amoun2,$plan,$id)
   {
       
        User::where('id',$id)->update([
            'id_active'=>1,
            'activation_date'=>date('Y-m-d H:i:s'),
            'plan_id'=>$plan,
        ]);
        DB::table('member_activation')->where('user_id',$id)->update(['status'=>1]);
        DB::table('member_activation')->insert([
            'user_id'=>$id,
            'plan'=>$plan,
            'amount'=>$amount1+$amoun2,
            'activated_by'=>Auth::id(),
            'status'=>0,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            ]);
        $gerbal0 = Auth::User()->wallets[1]->amount;
        if($gerbal0 < $amount1){
            Wallet::where('id',Auth::User()->wallets[0]->id)->update(['amount'=>DB::RAW("amount - $amount1")]);
        }else
        {
             Wallet::where('id',Auth::User()->wallets[1]->id)->update(['amount'=>DB::RAW("amount - $amount1")]);
        }
        Wallet::where('id',Auth::User()->wallets[2]->id)->update(['amount'=>DB::RAW("amount - $amoun2")]);
        $textplan = '';
        if($plan==1){
            $textplan = 'Hexa Master';
        }
        elseif($plan==2){
            $textplan = 'Hexa Royal';
        }
        elseif($plan==3){
            $textplan = 'Hexa Diamond';
        }
        elseif($plan==4){
            $textplan = 'Hexa Crown';
        }
        $uher = User::where('id',$id)->first();
        $user['name'] = $uher->name;
       $user['memberid'] = $uher->memberid;
       $user['plan'] = $textplan;
       Mail::send('mails.activation', ['data' => $user], function ($m) use ($uher) {
                $m->to($uher->email)->subject('Congratulations! You Have Successfully Activate New Plan on Your ID');
        });
        return true;
   }
   public function fill_uplink_data_from_id($sp_id,$mem_id){
  
        $spon = DB::table('users')->where('memberid',$sp_id)->get();
        
        if(count($spon)==0)
        {
            $spon = Role::where('name','admin')->first()->users()->get();
        }
    if($spon[0]->id_active==0){
       return self::fill_uplink_data_from_id($spon[0]->sponserid,$mem_id);
    }
        if($spon[0]->link_left == '')
        {
            $upda = array('link_left'=>$mem_id);
            DB::table('users')
                ->where('memberid', $sp_id)
                ->update($upda);
        
            $updaupid = array('u_parent'=> $sp_id,'u_position'=>1);
            DB::table('users')
                ->where('memberid', $mem_id)
                ->update($updaupid);
            return true;
        }
        elseif($spon[0]->link_center == '')
        {
            $upda = array('link_center'=>$mem_id);
            DB::table('users')
                ->where('memberid', $sp_id)
                ->update($upda);
        
            $updaupid = array('u_parent'=> $sp_id,'u_position'=>2);
            DB::table('users')
                ->where('memberid', $mem_id)
                ->update($updaupid);
            return true;
        }
        elseif($spon[0]->link_right == '')
        {
            $upda = array('link_right'=>$mem_id);
            DB::table('users')
                ->where('memberid', $sp_id)
                ->update($upda);
        
            $updaupid = array('u_parent'=> $sp_id,'u_position'=>3);
            DB::table('users')
                ->where('memberid', $mem_id)
                ->update($updaupid);
            return true;
        }
        else{
            $arrlo[] = $spon[0]->link_left;  
            $arrlo[] = $spon[0]->link_center;  
            $arrlo[] = $spon[0]->link_right;               
                        
            return self::check_lef_right_update($mem_id,$arrlo);               
        }
    }
    public function check_lef_right_update($mem_id,$arrayck)
    {       
        $acs[]='';
        if(count($arrayck)>0)
        {
            foreach($arrayck as $restarray)
            {           
              
                $re=  DB::table('users')->where('memberid',$restarray)->get();
    
                if(count($re)>0) 
                {                     
                    if($re[0]->link_left == '')
                    {                                
                        $upda = array('link_left'=>$mem_id);
                        DB::table('users')->where('memberid',$re[0]->memberid)->update($upda);

                        $updaupid = array('u_parent'=>$re[0]->memberid,'u_position'=>1);
                        DB::table('users')->where('memberid',$mem_id)->update($updaupid);
        
                        return true;
                    }
                    if($re[0]->link_left != ''){
                        
                    $arrayckqw[] = $re[0]->link_left;  
                    }
                    if($re[0]->link_center != ''){
                        
                    $arrayckqw[] = $re[0]->link_center;  
                    }
                    if($re[0]->link_right != ''){
                        
                    $arrayckqw[] = $re[0]->link_right;  
                    }
                      
                    
                }    
            }
            foreach($arrayck as $restarray)
            {           
              
                $re=  DB::table('users')->where('memberid',$restarray)->get();
    
                if(count($re)>0) 
                {                     
                    if($re[0]->link_center == '')
                    {                                
                        $upda = array('link_center'=>$mem_id);
                        DB::table('users')->where('memberid',$re[0]->memberid)->update($upda);

    
                        $updaupid = array('u_parent'=>$re[0]->memberid,'u_position'=>2);
                        DB::table('users')->where('memberid',$mem_id)->update($updaupid);
        
                        return true;
                    }
                     if($re[0]->link_left != ''){
                        
                    $arrayckqw[] = $re[0]->link_left;  
                    }
                    if($re[0]->link_center != ''){
                        
                    $arrayckqw[] = $re[0]->link_center;  
                    }
                    if($re[0]->link_right != ''){
                        
                    $arrayckqw[] = $re[0]->link_right;  
                    }
                      
                    
                }    
            }
            foreach($arrayck as $restarray)
            {           
              
                $re=  DB::table('users')->where('memberid',$restarray)->get();
    
                if(count($re)>0) 
                {          
                    if($re[0]->link_right == '')
                    {                                
                        $upda = array('link_right'=>$mem_id);
                        DB::table('users')->where('memberid',$re[0]->memberid)->update($upda);
    
                        $updaupid = array('u_parent'=>$re[0]->memberid,'u_position'=>3);
                        DB::table('users')->where('memberid',$mem_id)->update($updaupid);
        
                        return true;
                    }
                   if($re[0]->link_left != ''){
                        
                    $arrayckqw[] = $re[0]->link_left;  
                    }
                    if($re[0]->link_center != ''){
                        
                    $arrayckqw[] = $re[0]->link_center;  
                    }
                    if($re[0]->link_right != ''){
                        
                    $arrayckqw[] = $re[0]->link_right;  
                    }
                      
                }    
            }
            
             
            
            return self::check_lef_right_update($mem_id,$arrayckqw); ;   
        }
       
        return true;
          //  return false;
    }
    public function upgrade_level(Request $request)
    {
        if(Auth::User()->plan_id==4)
        {
            echo '<script>
                alert("No new plans available");
                window.location.href="'.url('/home').'"
                </script>';
        }
        $data['title'] = 'Upgrade Level';
        return view('user.upgrade')->with($data);
    }
    public function wallet(Request $request)
    {
        $data['title'] = 'User Wallet';
         if ($request->ajax()) {
            $data = DB::table('wallet_transactions')->where('user_id',Auth::User()->id)->where('reason',1)->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('reason', function($row){
                        return 'Withdrawal';
                    })
                    ->addColumn('status', function($row){
                        if($row->status == 1)
                        {
                            return 'Paid';
                        }elseif($row->status==2){
                             return 'REJECTED';
                        }
                        else{
                             return 'Pending';
                        }
                    })
                    ->rawColumns(['reason','status'])
                    ->make(true);
        }
       
        return view('user.wallet')->with($data);
    }
    public function topupwallet(Request $request)
    {
        $data['title'] = 'Top Up Wallet';
         if ($request->ajax()) {
            $data = DB::table('wallet_transactions')->where('user_id',Auth::User()->id)->where('reason',2)->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('reason', function($row){
                        if($row->reason == 1)
                        {
                            return 'Withdrawal';
                        }else{
                             return 'Transfer';
                        }
                    })
                    ->addColumn('status', function($row){
                        if($row->status == 1)
                        {
                            return 'Paid';
                        }else{
                             return 'Pending';
                        }
                    })
                    ->rawColumns(['reason','status'])
                    ->make(true);
        }
       
        return view('user.topupwallet')->with($data);
    }
    public function fundtransfer(Request $request)
    {
        $data['title'] = 'Fund Transfer';
         if ($request->ajax()) {
            $data1 = DB::table('topup_wallet')->where('sent_by',Auth::User()->id)->orderBy('id','DESC')->get();
            $data2 = DB::table('topup_wallet')->where('user_id',Auth::User()->id)->orderBy('id','DESC')->get();
            $data = array_merge($data1->toArray(),$data2->toArray());
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function($row){
                        if($row->sent_by==Auth::User()->id){
                         $getuser = User::where('id',$row->user_id)->first();   
                        }
                        elseif($row->user_id==Auth::User()->id){
                            $getuser = User::where('id',$row->sent_by)->first();
                        }
                        return $getuser->name;
                    })
                    ->addColumn('memberid', function($row){
                        if($row->sent_by==Auth::User()->id){
                            $getuser = User::where('id',$row->user_id)->first();   
                        }
                        elseif($row->user_id==Auth::User()->id){
                            $getuser = User::where('id',$row->sent_by)->first();
                        }
                        return $getuser->memberid;
                    })
                    ->addColumn('type', function($row){
                        if($row->sent_by==Auth::User()->id){
                            $getuser = 'Sent';   
                        }
                        elseif($row->user_id==Auth::User()->id){
                            $getuser = 'Received';
                        }
                        return $getuser;
                    })
                    ->addColumn('charges', function($row){
                        if($row->sent_by==Auth::User()->id){
                            $charge = $row->amount*$row->charges/100;   
                        }
                        elseif($row->user_id==Auth::User()->id){
                            $charge = '';
                        }
                        
                        return $charge;
                    })
                    ->rawColumns(['name','memberid','type','charges'])
                    ->make(true);
        }
       
        return view('user.fundtrasnfer')->with($data);
    }
    
    public function withdrawbalance(Request $request){
        if($request->ajax()){
            $suc = '';
            if($request->chargeacc ==0){
                $getwithamount = $request->oldamount*5;
            $getbalance = Auth::User()->wallets[0]->amount; 
            }elseif($request->chargeacc==1){
               $getbalance = Auth::User()->wallets[0]->amount;  
               $getwithamount = $request->oldamount*20;
               $getaagg = $request->oldamount*20;
               $getcharges = AdminSettings::where('setting_name','withdraw_charges')->first();
               if(!empty($getcharges)){
                   $gtc = $getcharges->setting_value;
                  $getwithamount += $getwithamount*$gtc/100; 
               }else{
                   
               $getwithamount += $getwithamount*10/100; 
               }
               
               $admincharge = $getaagg*$gtc/100;
               $balance = ($getbalance)-($getaagg+$admincharge);
               $url = 'https://blockchain.info/tobtc?currency=USD&value='.$getaagg;
               $btctotal = file_get_contents($url);
               $suc = '<table><tr><th>Total Amount</th><th>BTC Amount</th><th>Admin Charge ('.$gtc.' %)</th><th>Balance</th></tr><tr><td>'.$getwithamount.'</td><td>'.$btctotal.'</td><td>'.$admincharge.'</td><td>'.$balance.'</td></tr></table>';
               
            }elseif($request->chargeacc==2){
               $getbalance = Auth::User()->wallets[1]->amount;  
               $getwithamount = $request->oldamount*5;
               $getaagg = $request->oldamount*5;
               $getcharges = AdminSettings::where('setting_name','charges_percentage')->first();
               if(!empty($getcharges)){
                   $gtc = $getcharges->setting_value;
                  $getwithamount += $getwithamount*$gtc/100; 
               }else{
                   
               $getwithamount += $getwithamount*10/100; 
               }
               $admincharge = $getaagg*$gtc/100;
               $balance = ($getbalance)-($getaagg+$admincharge);
               $suc = '<table><tr><th>Transfer Amount</th><th>Admin Charge ('.$gtc.' %)</th><th>Balance</th></tr><tr><td>'.$getwithamount.'</td><td>'.$admincharge.'</td><td>'.$balance.'</td></tr></table>';
               
            }
            
            if($getbalance < $getwithamount)
            {
                return response()->json(['error'=>'Insufficient Balance']);
            }elseif($getbalance >= $getwithamount)
            {
                return response()->json(['success'=>$suc]);
            }
        }
        return redirect()->back();
    }
    public function withdrawsucced(Request $request){
        if($request->ajax()){
            $request->validate([
                'oldamount'=>'required|numeric',
                'otp'=>'required',
                ]);
            $otppass= $request->otp;
           if (!Hash::check($otppass, Auth::User()->otp_pass)) {
                return response()->json(['error'=>'INVALID OTP']);
                
            }
           $getbalance = Auth::User()->wallets[0]->amount; 
            $getwithamount = $request->oldamount*20;
            $getwithamount1 = $request->oldamount*20;
            $getcharges = AdminSettings::where('setting_name','withdraw_charges')->first();
            $gtc = $getcharges->setting_value;
            $getwithamount += $getwithamount*$gtc/100; 
            if($getbalance < $getwithamount)
            {
                return response()->json(['error'=>'Insufficient Balance']);
            }elseif($getbalance >= $getwithamount)
            {
               $url = 'https://blockchain.info/tobtc?currency=USD&value='.$getwithamount1;
               $btctotal = file_get_contents($url);
           
            $sd = DB::table('wallet_transactions')->insert([
                'user_id' => Auth::User()->id,
                'wallet_id' => Auth::User()->wallets[0]->id,
                'amount' => $getwithamount1,
                'reason' => 1,
                'status'=>0,
                'btc_amount'=>$btctotal,
                'btc_add'=>Auth::User()->btc_add,
                'withdraw_charges' => $getwithamount1*$gtc/100,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
                ]);
                if($sd)
                {
                    User::where('id',Auth::id())->update(['otp_pass'=>'']);
                    Wallet::where('user_id',Auth::User()->id)->where('type',1)->update(['amount'=>DB::RAW("amount - $getwithamount")]);
                    return response()->json(['success'=>'Withdraw Successfully']);
                }else
                {
                    return response()->json(['error'=>'Something Went Wrong!!']);
                }
            }
            return response()->json(['error'=>'Something Went Wrong!!']);
        }
        return redirect()->back();
    }
    public function transferstart(Request $request){
        if($request->ajax()){
            $request->validate([
                'oldamount'=>'required|numeric',
                ]);
           $getbalance = Auth::User()->wallets[0]->amount; 
            $getwithamount = $request->oldamount*5;
            
            
            
            if($getbalance < $getwithamount)
            {
                return response()->json(['error'=>'Insufficient Balance']);
            }elseif($getbalance >= $getwithamount)
            {
               
           
            $sd = DB::table('wallet_transactions')->insert([
                'user_id' => Auth::User()->id,
                'wallet_id' => Auth::User()->wallets[0]->id,
                'amount' => $getwithamount,
                'reason' => 2,
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
                ]);
                if($sd)
                {
                    
                    Wallet::where('user_id',Auth::User()->id)->where('type',1)->update(['amount'=>DB::RAW("amount - $getwithamount")]);
                    Wallet::where('user_id',Auth::User()->id)->where('type',2)->update(['amount'=>DB::RAW("amount + $getwithamount")]);
                    return response()->json(['success'=>'Transfered Successfully']);
                }else
                {
                    return response()->json(['error'=>'Something Went Wrong!!']);
                }
            }
        }
        return redirect()->back();
    }
    public function check_downline_user(Request $request){
        if($request->ajax()){
        if(Auth::User()->memberid == $request->user_nameid){
            return response()->json(['error'=>'ooh! You Cannot Trasfer to your own wallet']);
        }
           $checkuser = Role::where('name','user')->first()->users()->where('memberid',$request->user_nameid)->first();
           if(!empty($checkuser)){
               return response()->json(['success'=>$checkuser->name.' @ '.$checkuser->memberid]);
           }
            return response()->json(['error'=>'User ID is not Valid']);
        }
        return redirect()->back();
    }
    public function transfertouser(Request $request){
        if($request->ajax()){
            $request->validate([
                'oldamount'=>'required|numeric',
                'otp'=>'required',
                ]);
             if(Auth::User()->memberid == $request->user_nameid){
            return response()->json(['error'=>'ooh! You Cannot Trasfer to your own wallet']);
        }
           $getbalance = Auth::User()->wallets[1]->amount; 
            $getwithamount = $request->oldamount*5;
            $getnewamount = $request->oldamount*5;
             $getcharges = AdminSettings::where('setting_name','charges_percentage')->first();
               if(!empty($getcharges)){
                   $gtc = $getcharges->setting_value;
                  $getwithamount += $getwithamount*$gtc/100; 
               }else{
                   $gtc=0;
               $getwithamount += $getwithamount*10/100; 
               }
             $otppass= $request->otp;
           if (!Hash::check($otppass, Auth::User()->otp_pass)) {
                return response()->json(['error'=>'INVALID OTP']);
                
            }
            $user = $request->user_nameid;
            if($user == '')
            {
                return response()->json(['error'=>'User ID is not Valid']);
            }
            if($getbalance < $getwithamount)
            {
                return response()->json(['error'=>'Insufficient Balance']);
            }elseif($getbalance >= $getwithamount)
            {
               
            $checkuser = Role::where('name','user')->first()->users()->where('memberid',$user)->first();
            if(empty($checkuser)){
                return response()->json(['error'=>'MEMBER-ID IS INVALID!!']);
            }
            $sd = DB::table('topup_wallet')->insert([
                'user_id' => $checkuser->id,
                'wallet_id' => $checkuser->wallets[1]->id,
                'amount' => $getnewamount,
                'sent_by' => Auth::User()->id,
                'sent_from'=>2,
                'charges'=>$gtc,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
                'remarks'=>$request->remarks,
                ]);
                
                if($sd)
                {
                    User::where('id',Auth::id())->update(['otp_pass'=>'']);
                    Wallet::where('user_id',Auth::User()->id)->where('type',2)->update(['amount'=>DB::RAW("amount - $getwithamount")]);
                    Wallet::where('user_id',$checkuser->id)->where('type',2)->update(['amount'=>DB::RAW("amount + $getnewamount")]);
                    return response()->json(['success'=>'Transfered Successfully']);
                }else
                {
                    return response()->json(['error'=>'Something Went Wrong!!']);
                }
            }
        }
        return redirect()->back();
    }
    public function withdawinfo_data(Request $request,$id)
    {
        $data['title'] = 'Wallet Withdraw Requests per user update';
        $request->validate([
            'new_status'=>'required|numeric'
            ]);
        if($request->new_status==2){
           $getmone = DB::table('wallet_transactions')->where('id',$id)->get(); 
           $returnamoint = $getmone[0]->amount;
           Wallet::where('id',$getmone[0]->wallet_id)->update(['amount'=>DB::RAW("amount + $returnamoint")]);
        }
        DB::table('wallet_transactions')->where('id',$id)->update(['status'=>$request->new_status]);
       echo '<script>alert("Status Updated Successfully"); window.location.href="'.url('/royal/wallet_requests').'"</script>';
       
    }
    public function withdawinfo(Request $request)
    {
        $data['title'] = 'Wallet Withdraw Requests per user';
         if ($request->ajax()) {
            $data = DB::table('wallet_transactions')->where('wallet_transactions.reason',1)->where('wallet_transactions.id',$request->id)
            ->join('users','users.id','=','wallet_transactions.user_id')
            ->select(DB::RAW('users.name,users.memberid,wallet_transactions.btc_add,wallet_transactions.amount,wallet_transactions.status,wallet_transactions.btc_amount'))
            ->first();
           if(!empty($data)){
               return response()->json(['data'=>$data]);
           }
           return response()->json(['error'=>'Data Not Found']);
        }
       
        return redirect('/');
    }
    public function wallet_requests(Request $request)
    {
        $data['title'] = 'Wallet Withdraw Requests';
         if ($request->ajax()) {
            $data = DB::table('wallet_transactions')->where('reason',1)->orderBy('id','DESC')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function($row){
                        $getuser = User::where('id',$row->user_id)->first();
                        return $getuser->name;
                    })
                    ->addColumn('memberid', function($row){
                        $getuser = User::where('id',$row->user_id)->first();
                        return $getuser->memberid;
                    })
                    ->addColumn('action', function($row){
                        $btn = '<a class="waves-effect waves-light btn modal-trigger click_withdrow_details" href="#check_withdrow_details" data-id="'.$row->id.'" >View</a>';
                        if($row->status!=0){
                            $btn = '';
                        }
                        return $btn;
                    })
                    ->addColumn('status', function($row){
                         if($row->status == 1)
                        {
                            return 'Paid';
                        }elseif($row->status == 2)
                        {
                            return 'Rejected';
                        }else{
                             return 'Pending';
                        }
                    })
                    ->rawColumns(['name','memberid','status','action'])
                    ->make(true);
        }
       
        return view('admin.withrequest')->with($data);
    }
    public function member_activation(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('member_activation')->where('activated_by',Auth::User()->id)->orderBy('id','DESC')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function($row){
                        $getuser = User::where('id',$row->user_id)->first();
                        return $getuser->name;
                    })
                    ->addColumn('memberid', function($row){
                        $getuser = User::where('id',$row->user_id)->first();
                        return $getuser->memberid;
                    })
                    
                    ->rawColumns(['name','memberid'])
                    ->make(true);
        }
       
        $data['title'] = 'Partner Activation';
        return view('user.activation')->with($data);
    }
    public function activate_downline_user_info(Request $request)
    {
        if($request->ajax()){
            $userid = strtoupper($request->user_nameid);
            if(Auth::User()->memberid == $userid){
                return response()->json(['error'=>'For Self Activation/Upgradation GOTO Dashboard!']);
            }
            
            // $getusers = activae_create_downline_report(Auth::User()->memberid);
            // if(in_array($userid,$getusers)){
                $checkuser = Role::where('name','user')->first()->users()->where('memberid',$userid)->first();
                   if(!empty($checkuser)){
                       return response()->json(['success'=>$checkuser]);
                   }
            // strtoupper(}
           
            return response()->json(['error'=>'Partner ID is Not Valid ']);
        }
        return redirect()->back();
    }
    public function check_my_balance(Request $request)
    {
       //only for user
        if($request->ajax()){
            $getbalance1 = Auth::User()->wallets[1]->amount;
            $getbalance2 = Auth::User()->wallets[2]->amount;
            $getamount = $request->plan;
            $amnt = 0;
            $amnt1 = 0;
            $plan_arr = [1,2,3,4];
            $getuser = User::where('memberid',$request->userid)->first();
            $plan = $getuser->plan_id+1;
            if($getamount > $getuser->plan_id && in_array($getamount,$plan_arr)){
                for($i=$plan;$i<=$getamount;$i++)
                {
                    if($i == 1){
                        $amnt+=10;
                        $amnt1+=0;
                    }
                    if($i == 2){
                        $amnt1+=0;
                        $amnt+=15;
                    }
                    if($i == 3){
                        $amnt+=50;
                        $amnt1+=0;
                    }
                    if($i == 4){
                        $amnt1+=0;
                        $amnt+=75;
                    }
                }
                if ($amnt1 > 0){
                    if($getbalance1 < $amnt && $getbalance2 < $amnt1){
                        return response()->json(['error'=>'Insufficient Balance']);
                    }
                }else
                {
                    if($getbalance1 < $amnt){
                        return response()->json(['error'=>'Insufficient Balance']);
                    }
                }
                return response()->json(['success'=>'Your Balance is Sufficient']);
            }
           return response()->json(['error'=>'Insufficient Balance']);
        }
        return redirect('/');
    }
    public function activate_downline_now(Request $request)
       {
           //only for user
        if($request->ajax()){
            $data = $request->validate([
                "plan"  => "required|numeric",
            ]);
            $plan_arr = [1,2,3,4];
             $userid = strtoupper($request->userid);
                $getamount = $request->plan;
                $getuser = User::where('memberid',$userid)->first();
                $plan = $getuser->plan_id+1;
                if($getamount > $getuser->plan_id && in_array($getamount,$plan_arr)){
                for($i=$plan;$i<=$getamount;$i++)
                {
                    $id = $getuser->id;
                        if($i == 1){
                            //10
                            self::activate_now_downline(10,0,1,$id);
                            self::fill_uplink_data_from_id($getuser->sponserid,$getuser->memberid);
                            $user = User::where('id',$id)->first();
                            $uplin = self::get_uplink_id($user->u_parent,1,1);
                            self::send_payment($id,7,0,$uplin,1);
                             for($iw=4;$iw<=12;$iw++){
                                $uplin = self::get_uplink_id($user->u_parent,$iw,1);
                                self::send_payment($id,1,$iw,$uplin,4);
                            }
                            AdminSettings::where('setting_name','loyality_income')->update(['setting_value'=>DB::RAW('setting_value + 3')]);
                        }
                        if($i == 2){
                            //15
                            self::activate_now_downline(15,0,2,$id);
                            $user = User::where('id',$id)->first();
                            $uplin = self::get_uplink_id($user->u_parent,2,1);
                            self::send_payment($id,12,2,$uplin,2);
                            AdminSettings::where('setting_name','loyality_income')->update(['setting_value'=>DB::RAW('setting_value + 3')]);
                        }
                        if($i == 3){
                            //50
                            self::activate_now_downline(50,0,3,$id);
                            $user = User::where('id',$id)->first();
                            $uplin = self::get_uplink_id($user->u_parent,3,1);
                            self::send_payment($id,47,3,$uplin,3);
                            AdminSettings::where('setting_name','loyality_income')->update(['setting_value'=>DB::RAW('setting_value + 3')]);
                        }
                        if($i == 4){
                            //75
                            self::activate_now_downline(75,0,4,$id);
                            $user = User::where('id',$id)->first();
                            self::addin_autopool($id);
                           
                        }
                }
                return response()->json(['success'=>'Partner Activated Successfully']);
            }
        }
        abort(404);
       }
    public function member_fund_requests(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('fund_requests')->orderBy('id','DESC')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function($row){
                        $getuser = User::where('id',$row->user_id)->first();
                        return $getuser->name;
                    })
                    ->addColumn('memberid', function($row){
                        $getuser = User::where('id',$row->user_id)->first();
                        return $getuser->memberid;
                    })
                    ->addColumn('status', function($row){
                        if($row->transaction_status == 0)
                        {
                            return 'Pending';
                        }else
                        if($row->transaction_status == 1)
                        {
                            return 'Sent';
                        }
                    })
                   ->addColumn('sender_address', function($row){
                        if($row->transaction_status == 0)
                        {
                        return '<a href="#check_fund_details" style="color:green;font-weight:700"  class="click_get_user waves-effect waves-light modal-trigger" data-id="'.$row->id.'">'.$row->sender_address.'</a>';
                        }else
                        {
                            return '<a href="#check_fund_details" style="color:blue;font-weight:700"  class="click_get_user waves-effect waves-light modal-trigger" data-id="'.$row->id.'">'.$row->sender_address.'</a>';
                        }
                    })
                    ->rawColumns(['sender_address','name','status','memberid'])
                    ->make(true);
        }
       
        $data['title'] = 'Fund Requests';
        return view('admin.fundrequests')->with($data);
    }
    public function fundinfo_data(Request $request,$id)
    {
        $data['title'] = 'Wallet Withdraw Requests per user update';
        $request->validate([
            'new_status'=>'required|numeric',
            'admin_remarks'=>'string',
            ]);
        DB::table('fund_requests')->where('id',$id)->update(['transaction_status'=>$request->new_status,'admin_remarks'=>$request->admin_remarks]);
       echo '<script>alert("Status Updated Successfully"); window.location.href="'.url('/royal/member_fund_requests').'"</script>';
       
    }
    public function fundinfo(Request $request)
    {
        $data['title'] = 'Wallet Withdraw Requests per user';
         if ($request->ajax()) {
            $data = DB::table('fund_requests')->where('fund_requests.id',$request->id)
            ->join('users','users.id','=','fund_requests.user_id')
            ->select(DB::RAW('users.name,users.memberid,fund_requests.*'))
            ->first();
           if(!empty($data)){
               return response()->json(['data'=>$data]);
           }
           return response()->json(['error'=>'Data Not Found']);
        }
       
        return redirect('/');
    }
    public function send_fund_requests(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('fund_requests')->where('user_id',Auth::id())->orderBy('transaction_status','ASC')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function($row){
                        $getuser = User::where('id',$row->user_id)->first();
                        return $getuser->name;
                    })
                    ->addColumn('status', function($row){
                        if($row->transaction_status == 0)
                        {
                            return 'Pending';
                        }else
                        if($row->transaction_status == 1)
                        {
                            return 'Sent';
                        }
                    })
                    ->addColumn('transaction_file', function($row){
                        return '<a href="'.url('/images').'/'.$row->transaction_file.'">'.$row->transaction_file.'</a>';
                    })
                    ->rawColumns(['name','status','transaction_file'])
                    ->make(true);
        }
       
        $data['title'] = 'Fund Requests';
        return view('user.requestfund')->with($data);
    }
    public function newsend_fund_requests(Request $request)
    {
       $request->validate([
           'trans_id'=>'required',
           'sender_address'=>'required',
           'transaction_file'=>'required',
           'amount'=>'required',
           'btc'=>'required'
           ]);
        if($request->hasFile('transaction_file'))
            {
                $filenameWithExt = $request->file('transaction_file')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('transaction_file')->getClientOriginalExtension();
                $filenametostore = 'transaction_file'.$filename.'_'.time().'.'.$extension;
                $path = $request->file('transaction_file')->move('images', $filenametostore);
            }
            else
            {
                return back()->with('error','File is Required');
            }
        $sdsd= DB::table('fund_requests')->insert([
            'user_id'=>Auth::id(),
            'sender_address'=>$request->sender_address,
            'transaction_id'=>$request->trans_id,
            'transaction_file'=>$filenametostore,
            'transaction_status'=>0,
            'amount'=>$request->amount,
            'comments'=>$request->comments,
            'btc'=>$request->btc,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            ]);
        if($sdsd){
           
        return redirect()->back()->with(['success'=>'Payment Successfully Sent']);
        }else
        {
            return redirect()->back()->with(['error'=>'Something Went Wrong']);
        }
    }
    
//New Functions with otp
    public function withdrawal(Request $request){
        $data['title'] = 'Withdraw Profits';
        return view('user.withdrawal')->with($data);
    }
    public function send_otp(Request $request)
    {
        if($request->ajax()){
            $digits = 6;
            $otp = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
           if($request->type==1)
           {
               $user['name'] = Auth::User()->name;
               $user['memberid'] = Auth::User()->memberid;
               $user['otp'] = $otp;
               Mail::send('mails.btc', ['data' => $user], function ($m) use ($user) {
                        $m->to(Auth::User()->email)->subject('New OTP for BTC Address is Here!');
                });
           }
           if($request->type==2)
           {
               $user['name'] = Auth::User()->name;
               $user['memberid'] = Auth::User()->memberid;
               $user['otp'] = $otp;
               Mail::send('mails.profits', ['data' => $user], function ($m) use ($user) {
                        $m->to(Auth::User()->email)->subject('New OTP to Withdraw Profits is Here!');
                });
           }
           if($request->type==3)
           {
               $user['name'] = Auth::User()->name;
               $user['memberid'] = Auth::User()->memberid;
               $user['otp'] = $otp;
               Mail::send('mails.fundtrans', ['data' => $user], function ($m) use ($user) {
                        $m->to(Auth::User()->email)->subject('New OTP for Fund Transfer is Here!');
                });
           }
            User::where('id',Auth::id())->update(['otp_pass'=>bcrypt($otp)]);
            return response()->json(['success'=>'OTP is sent to your registered Email ']);
        }
        return redirect('/home');
    }
    public function check_otp(Request $request)
    {
        if($request->ajax()){
            $otppass= $request->otp;
           if (Hash::check($otppass, Auth::User()->otp_pass)) {
                return response()->json(['success'=>'Valid OTP']);
            }
            return response()->json(['error'=>'Invalid OTP']);
        }
        return redirect('/home');
    }
    public function trasnfer_fund(Request $request){
        $data['title'] = 'Transfer Funds';
        return view('user.fundtrasnfertouser')->with($data);
    }
}
