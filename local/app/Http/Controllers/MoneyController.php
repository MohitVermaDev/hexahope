<?php

namespace App\Http\Controllers;
use App\Role;
use App\Money;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\AutoPool;
use DataTables;
use App\Wallet;
class MoneyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['cron_addin_pool','addin_autopool','get_pool_uplink_id']);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Money::where('pay_user_id',Auth::id())->where('status',0)->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function($row){
   
                        $btn = $row->user->name;
  
                         return $btn;
                    })
                    ->addColumn('memberid', function($row){
   
                        $memberid = $row->user->memberid;
  
                         return $memberid;
                    })
                    ->rawColumns(['name','memberid'])
                    ->make(true);
        }
        $data['title'] = 'Total Profits';
        return view('user.incomes')->with($data);
    }
    public function flush_income(Request $request)
    {
        if ($request->ajax()) {
            $data = Money::where('pay_user_id',Auth::id())->whereBetween('status',array(2,3))->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function($row){
   
                        $btn = $row->user->name;
  
                         return $btn;
                    })
                    ->addColumn('memberid', function($row){
   
                        $btn = $row->user->memberid;
  
                         return $btn;
                    })
                    ->rawColumns(['name','memberid'])
                    ->make(true);
        }
        $data['title'] = 'Lost Income';
        return view('user.flush_income')->with($data);
    }
    public function pool(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('pool_incomes')->join('users','users.id','=','pool_incomes.user_id')->where('pay_id',Auth::id())->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);
        }
        $data['title'] = 'Pool Incomes';
        return view('user.pool')->with($data);
    }
    
    public function cron_addin_pool(){
        $allusers = Role::where('name','user')->first()->users()->get();
        if(count($allusers)>0){
            foreach($allusers as $user){
               $checkusrinpool = AutoPool::where('user_id',$user->id)->get();
                if(count($checkusrinpool)==0 && $user->plan_id >= 4){
                    self::addin_autopool($user->id);
                } 
            }
            
        }
        return true;
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
       
   }
   public function check_pool(Request $request)
   {
       $data['title'] = 'Auto Pool Members';
       return view('admin.adminpool')->with($data);
   }
}
