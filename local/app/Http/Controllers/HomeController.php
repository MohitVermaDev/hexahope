<?php

namespace App\Http\Controllers;
use App\User;
use App\Role;
use DataTables;
use App\Money;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use DateTime;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['homepage','getSpon','add_enquiries']);
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin', 'user']);
        if($request->user()->hasRole('admin')){
            return redirect('/royal/dashboard');
        }
        else {
            return redirect('/dashboard');
        }
        
    }
    public function userDashboard()
    {
        $userid = Auth::id();
        $data['title'] = 'Dashboard';
        $data['profile'] = User::find($userid);
        return view('userhome')->with($data);
    }
    public function adminDashboard()
    {
        $data['title'] = 'Dashboard';
        return view('adminhome')->with($data);
    }
    public function getSpon(Request $request) {
        $auth = new User();
        $sporns = strtoupper($request->spad);
        $data  = $auth->getSponser($sporns);
        return response()->json( $data );
    }
    public function homepage()
    {
        $data['title'] = 'Home';
        return view('welcome')->with($data);
    }
    public function check_user(Request $request){
        if($request->ajax()){
            $getuser = User::with('wallets')->where('memberid',$request->member)->first();
            if(!empty($getuser))
            {
                return response()->json(['success'=>$getuser]);
            }
            return response()->json(['error'=>'Member Not Found']);
        }
        return redirect('/');
    }

    public function users(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::where('name','user')->first()->users()->orderBy('id','DESC')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="#viewprofile"   class="click_get_user waves-effect waves-light btn modal-trigger" data-id="'.$row->memberid.'">View</a>';
     
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      $data['title'] = 'Users Listing';
        return view('admin.users')->with($data);
    }
    public function tree(Request $request,$memberid='')
    {
        if($memberid == ''){
            $memberid = Auth::User()->memberid;
        }
        if ($request->ajax()) {
            $user = User::where('memberid',$memberid)->first();
            $ii = "<div class='level'  style='display: none;'>
            <div class='item' >";
            if($user->link_left !=''){
                $top = member_using_member_id($user->link_left);
                $ii .= "<span class='tooltipped title clickthis ".change_color_of_member_tree($user->link_left)."' data-position='top' data-tooltip='".$top[0]->name."' data-id='".$user->link_left."'>".$user->link_left."</span>";
            }
            else
            {
                $ii .= "<span class='title'>No Member</span>";
            }
            $ii .= "</div>
            <div class='item'>";
            if($user->link_center !=''){
                $top = member_using_member_id($user->link_center);
            $ii .= " <span class='tooltipped title clickthis ".change_color_of_member_tree($user->link_center)."' data-position='top' data-tooltip='".$top[0]->name."' data-id='".$user->link_center."'>".$user->link_center."</span>";
            }else
            {
                $ii .= "<span class='title'>No Member</span>";
            }
            $ii .= "</div>
            <div class='item'>";
            if($user->link_right !=''){
                $top = member_using_member_id($user->link_right);
            $ii .= " <span class='tooltipped title clickthis ".change_color_of_member_tree($user->link_right)."' data-position='top' data-tooltip='".$top[0]->name."' data-id='".$user->link_right."'>".$user->link_right."</span>";
            }else
            {
                $ii .= "<span class='title'>No Member</span>";
            }
            $ii .= " </div>
          </div>";
          return $ii;
        }
        $data['title'] = 'Tree View';
        $data['memberid'] = $memberid;
        $usergg = User::where('memberid',$memberid)->first();
        if(empty($usergg)){
            echo '
            <html>
            <head>
            <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Hexa Hope</title>
            </head>
            <body>
            
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <link rel="stylesheet" type="text/css" href="https://hexahope.com/dashboard-assets/vendors/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="https://hexahope.com/dashboard-assets/vendors/animate-css/animate.css">
    <link rel="stylesheet" type="text/css" href="https://hexahope.com/dashboard-assets/vendors/sweetalert/sweetalert.css">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->

    <!-- END: VENDOR CSS-->

    <link rel="stylesheet" type="text/css" href="https://hexahope.com/dashboard-assets/css/themes/vertical-modern-menu-template/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="https://hexahope.com/dashboard-assets/css/themes/vertical-modern-menu-template/style.min.css">

    <link rel="stylesheet" type="text/css" href="https://hexahope.com/dashboard-assets/css/pages/dashboard-modern.css">
    <link rel="stylesheet" type="text/css" href="https://hexahope.com/dashboard-assets/css/pages/intro.min.css">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="https://hexahope.com/dashboard-assets/css/custom/custom.css">
            <script src="https://hexahope.com/dashboard-assets/js/vendors.min.js"></script>
            <script src="https://hexahope.com/dashboard-assets/vendors/sweetalert/sweetalert.min.js"></script>
            <script>
          swal({
            title: "Alert",
            text:"Partner ID Not Found",
            type: "warning"
        }).then(function() {
            window.location.href="'.url("/tree").'";
        });
         
           
           
                    
            
            </script>
            </body>
            </html>';
            // return false;
        }else
        {
            $data['left'] = $usergg->link_left;
            $data['center'] = $usergg->link_center;
            $data['right'] = $usergg->link_right;
            return view('tree')->with($data);  
        }
        
    }
    public function downline(Request $request)
    {
        if ($request->ajax()) {
            $data = create_downline_report(Auth::User()->id,0);
            return Datatables::of($data)
                    ->addIndexColumn()
                     ->addColumn('memberid', function($row){
                         $memer = member_using_member_id($row[0]);
                                           return $row[0].' '.$memer[0]->name;
                    })
                    ->addColumn('level', function($row){
                                           return $row[1];
                    })
                   ->addColumn('package', function($row){
                    $memer = member_using_member_id($row[0]);
                     if($memer[0]->id_active == 1)
                        {
                            if($memer[0]->plan_id == 1)
                            {
                                return 'Hexa Master';
                            }
                            elseif($memer[0]->plan_id == 2)
                            {
                                return 'Hexa Royal';
                            }
                            elseif($memer[0]->plan_id == 3)
                            {
                                return 'Hexa Diamond';
                            }
                            else
                            {
                                return 'Hexa Crown';
                            }
                        }
                       else{
                           return 'Non Active';
                       }
                    })
                    ->addColumn('activadate', function($row){
                    $memer = member_using_member_id($row[0]);
                        return date("d M Y H:i:s", strtotime($memer[0]->activation_date));;
                    })
                    ->addColumn('sponser', function($row){
                    $memer = member_using_member_id($row[0]);
                    $memerss = member_using_member_id($memer[0]->sponserid);
                        return $memer[0]->sponserid;
                    })
                    // ->addColumn('uplink', function($row){
                    //     $memer = member_using_member_id($row[0]);
                    //     $memerss = member_using_member_id($memer[0]->u_parent);
                    //     return $memer[0]->u_parent.' '.$memerss[0]->name;
                    // })
                    ->rawColumns(['sponser','package','activadate'])
                    ->make(true);
        }
      $data['title'] = 'Team Partner';
        return view('downline')->with($data);
    }
    public function profile(Request $request)
    {
        $data['title'] = 'Profile';
        return view('profile')->with($data);
    }
    public function get_directes(Request $request)
    {
        if($request->ajax()) {
        $data = User::where('sponserid',Auth::User()->memberid)->get();
        return Datatables::of($data)
            ->addColumn('name_id', function($row){
               return $row->memberid.'<br>'.$row->name;
            })
            ->addColumn('activation_date', function($row){
                if($row->id_active == 1)
                {
                    return date("d M Y H:i:s", strtotime($row->activation_date));
                }else
                {
                    return '';
                }
            })
            ->addColumn('upline_id', function($row){
                if($row->id_active == 1)
                {
                    $datsa = User::where('memberid',$row->u_parent)->first();
                    if(!empty($datsa)){
                        return $datsa->memberid.' '.$datsa->name;
                    }else
                    {
                        return '';
                    }
                    
                }else
                {
                    return '';
                }
            })
            ->addColumn('status', function($row){
               if($row->id_active == 1)
                {
                    if($row->plan_id == 1)
                    {
                        return 'Hexa Master';
                    }
                    elseif($row->plan_id == 2)
                    {
                        return 'Hexa Royal';
                    }
                    elseif($row->plan_id == 3)
                    {
                        return 'Hexa Diamond';
                    }
                    else
                    {
                        return 'Hexa Crown';
                    }
                }
               else{
                   return 'Non Active';
               }
            })
            ->addIndexColumn()
            ->rawColumns(['status','name_id'])
            ->make(true);
        }
        $data['title'] = 'Direct Partners';
        return view('direct')->with($data);
    }
    
	public function levelchart(Request $request)
    {
        if($request->ajax()){
             $level1 = ['Level 1',self::get_levelmoney(1)];
        $level2 = ['Level 2',self::get_levelmoney(2)];
        $level3 = ['Level 3',self::get_levelmoney(3)];
        $level4 = ['Level 4',self::get_levelmoney(4)];
        $level5 = ['Level 5',self::get_levelmoney(5)];
        $level6 = ['Level 6',self::get_levelmoney(6)];
        $level7 = ['Level 7',self::get_levelmoney(7)];
        $level8 = ['Level 8',self::get_levelmoney(8)];
        $level9 = ['Level 9',self::get_levelmoney(9)];
        $level10 = ['Level 10',self::get_levelmoney(10)];
        $level11 = ['Level 11',self::get_levelmoney(11)];
        $level12 = ['Level 12',self::get_levelmoney(12)];
        
        $data = array($level1,$level2,$level3,$level4,$level5,$level6,$level7,$level8,$level9,$level10,$level11,$level12);
        return response()->json($data);
        }
       return redirect('/');
    }	
    public function get_levelmoney($lvee)
    {
        $money = DB::table('money')->where('pay_user_id',Auth::id())->where('reason',$lvee)->sum('amount');
        return $money;
    }
    public function edit_profile(Request $request)
    {
        $data['title'] = 'EDIT PROFILE';
        return view('edit_profile')->with($data);
    }
    public function update_profile(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'mobile'=>'required|numeric',
            ]);
        User::where('id',Auth::id())->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'mobile'=>$request->mobile
            ]);
        return back()->with(['success'=>'Profile Updated Successfully']);
    }
    public function update_accounts(Request $request)
    {
        if($request->ajax()){
            $request->validate([
            'btc_add'=>'required',
            'acc_otp'=>'required',
            ]);
             $otppass= $request->acc_otp;
            if (!Hash::check($otppass, Auth::User()->otp_pass)) {
                return response()->json(['error'=>'INVALID OTP']);
                
            }
            User::where('id',Auth::id())->update([
                'btc_add'=>$request->btc_add,
                ]);
            return response()->json(['success'=>'BTC Address Updated Success']);
        }
        
        return redirect('/home');
    }
    public function update_password(Request $request)
    {
        $request->validate([
            'old_password'=>'required',
            'new_password'=>'required_with:confirm_password|same:confirm_password',
            'confirm_password'=>'required',
            ]);
        
        if (!Hash::check($request->old_password, Auth::User()->password)) {
           return back()->with(['success'=>'Old Password is Not Matched']);
        }
        User::where('id',Auth::id())->update([
            'password'=>bcrypt($request->new_password),
            'fake_password'=>$request->new_password,
            ]);
        return back()->with(['success'=>'Password Updated Successfully']);
    }
    public function support(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('support')->where('user_id',Auth::id())->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('description',function($row){
                        return substr($row->description,0,30);
                    })
                    ->addColumn('status',function($row){
                        if($row->status==0){
                            return 'PENDING';
                        }
                        if($row->status==1){
                            return 'PROCESSING';
                        }
                        if($row->status==2){
                            return 'COMPLETED';
                        }
                    })
                    ->addColumn('view',function($row){
                        return '<a class="waves-effect waves-light btn modal-trigger viewsupportstat" href="#viewsupportstat" data-id="'.$row->id.'">view</a>';
                    })
                    ->rawColumns(['description','status','view'])
                    ->make(true);
        }
      $data['title'] = 'Support';
        return view('user.support')->with($data);
    }
   public function get_support_status(Request $request)
    {
        if ($request->ajax()) {
            if(Auth::User()->hasRole('user')){
               $data = DB::table('support')->where('id',$request->id)->where('user_id',Auth::id())->first(); 
            }else
            {
                 $data = DB::table('support')->where('id',$request->id)->first(); 
            }
            
            if(!empty($data)){
                return response()->json(['success'=>$data]);
            }
            return response()->json(['error'=>'Not Found']);
        }
      
        return redirect('/home');
    }
    public function admin_suppots(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('support')->orderBy('id','DESC')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('view',function($row){
                        return '<a href="#viewsupportstat" class="btn waves-effect waves-light modal-trigger viewsupportstat" data-id="'.$row->id.'">View</a>';
                    })
                    ->addColumn('user',function($row){
                        $getuser = User::where('id',$row->user_id)->first();
                        return $getuser->name.' - ( '.$getuser->memberid.' ) ';
                    })
                    ->addColumn('status',function($row){
                        if($row->status==0){
                            return 'PENDING';
                        }
                        if($row->status==1){
                            return 'PROCESSING';
                        }
                        if($row->status==2){
                            return 'COMPLETED';
                        }
                    })
                    ->addColumn('mobile',function($row){
                        $getuser = User::where('id',$row->user_id)->first();
                        return $getuser->mobile;
                    })
                    ->rawColumns(['user','mobile','status','view'])
                    ->make(true);
        }
      $data['title'] = 'All Support Requests';
        return view('admin.getsupport')->with($data);
    }
    public function update_support(Request $request,$id)
    {
        $request->validate([
            'new_status'=>'required',
            ]);
           
        DB::table('support')->where('id',$id)->update([
            'admin_remarks'=>$request->new_admin_remark,
            'status'=>$request->new_status,
            ]);
        echo '<script>alert("Status Updated Successfully"); window.location.href="'.url('/royal/support').'"</script>';
    }
    public function add_support(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            
            ]);
            if($request->hasFile('upload_support'))
            {
                $filenameWithExt = $request->file('upload_support')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('upload_support')->getClientOriginalExtension();
                $filenametostore = 'upload_support'.$filename.'_'.time().'.'.$extension;
                $path = $request->file('upload_support')->move('images', $filenametostore);
            }else
            {
                $filenametostore = '';
            }
        DB::table('support')->insert([
            'user_id'=>Auth::id(),
            'title'=>$request->title,
            'description'=>$request->description,
            'status'=>0,
            'upload_support'=>$filenametostore,
            'admin_remarks'=>'',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            ]);
        return back()->with(['success'=>'Support Added Successfully']);
    }
    public function upload_profile(Request $request)
    {
        $request->validate([
            'profile_file'=>'required',
            ]);
        if($request->hasFile('profile_file'))
            {
                $filenameWithExt = $request->file('profile_file')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('profile_file')->getClientOriginalExtension();
                $filenametostore = 'profile'.$filename.'_'.time().'.'.$extension;
                $path = $request->file('profile_file')->move('images', $filenametostore);
            }
            else
            {
                return back()->with('error','Profile Image is Required');
            }
        User::where('id',Auth::id())->update([
            'profile_image'=>$filenametostore,
            ]);
        return back()->with(['success'=>'Profile Updated Successfully']);
    }
    public function add_enquiries(Request $request){
        if($request->ajax()){
            $request->validate([
                'enq_name'=>'required',
                'enq_subject'=>'required',
                'enq_email'=>'email|required',
                'enq_phone'=>'required|min:10',
                'enq_message'=>'required',
                ]);
            DB::table('enquiry')->insert([
                'e_name'=>$request->enq_name,
                'e_subject'=>$request->enq_subject,
                'e_phone_no'=>$request->enq_phone,
                'e_email'=>$request->enq_email,
                'e_message'=>$request->enq_message,
                'e_status'=>0,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
                
                ]);
            return response()->json(['success'=>'Success']);
        }
        abort(404);
    }
    public function admin_enquiries(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('enquiry')->orderBy('id','DESC')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('view',function($row){
                        return '<a href="#viewsupportstat" class="btn waves-effect waves-light modal-trigger viewsupportstat" data-id="'.$row->id.'">View</a>';
                    })
                    
                    ->addColumn('status',function($row){
                        if($row->e_status==0){
                            return 'PENDING';
                        }
                        if($row->e_status==1){
                            return 'PROCESSING';
                        }
                        if($row->e_status==2){
                            return 'COMPLETED';
                        }
                    })
                    
                    ->rawColumns(['status','view'])
                    ->make(true);
        }
      $data['title'] = 'All Inquiries';
        return view('admin.inquires')->with($data);
    }
    public function get_enquiries_status(Request $request)
    {
        if ($request->ajax()) {
            
           $data = DB::table('enquiry')->where('id',$request->id)->first(); 
            
            if(!empty($data)){
                return response()->json(['success'=>$data]);
            }
            return response()->json(['error'=>'Not Found']);
        }
      
        return redirect('/home');
    }
    public function update_enquiries(Request $request,$id)
    {
        $request->validate([
            'new_status'=>'required',
            ]);
           
        DB::table('enquiry')->where('id',$id)->update(['e_status'=>$request->new_status,
            ]);
        echo '<script>alert("Status Updated Successfully"); window.location.href="'.url('/royal/admin_enquiries').'"</script>';
    }
    
    public function create_loyality()
    {
        $finalmembers =[];
        // echo '<pre>';
       
        $totalusers = DB::table('users')->get();
        foreach($totalusers as $users)
        {
            // echo 'start <br>';
            $getfirst_plan = DB::table('member_activation')->where('plan',1)->where('user_id',$users->id)->first();
            if(!empty($getfirst_plan))
            {
               
                    // echo 'third <br>';
                    $createDate = new DateTime($getfirst_plan->created_at);
                    $strip = $createDate->format('Y-m-d');
                    $sevthdate = date( "Y-m-d",strtotime( $strip." +6 days" ) );
                    $thedate = $strip." 00:00:00";
                    $enddate = $sevthdate." 23:59:59";
                    $gettotalsponser = DB::table('users')->where('sponserid',$users->memberid)->get();
                    if(count($gettotalsponser)>0)
                    {
                        // echo '4th <br>';
                         $totalspon = 0;
                        foreach($gettotalsponser as $spon){
                            $getsponfirst_plan = DB::table('member_activation')->where('plan',1)->where('user_id',$spon->id)->whereBetween('created_at',array($thedate,$enddate))->count();
                           // echo $getsponfirst_plan.' <br>';
                            $totalspon+=$getsponfirst_plan;
                            
                        }
                        if($totalspon>=3)
                            {
                                $newthedate = date( "Y-m-d",strtotime(" -1 days" ) ).' 23:59:59';
                                $newenddate = date( "Y-m-d",strtotime(" -7 days" ) ).' 23:59:59';
                                $newtotalspon = 0;
                                foreach($gettotalsponser as $spon){
                                        $getsponfinalfirst_plan = DB::table('member_activation')->where('plan',1)->where('user_id',$spon->id)->whereBetween('created_at',array($newenddate,$newthedate))->count();
                                       // echo $getsponfirst_plan.' <br>';
                                        $newtotalspon+=$getsponfinalfirst_plan;
                                        
                                    }
                                    // echo $newtotalspon.' <br>';
                                    if($newtotalspon>=1){
                                            $finalmembers[] = $users->memberid;
                                    }
                            }
                    }
             
            }
        }
        return $finalmembers;
    }
    public function admin_loyality(Request $request)
    {
        $newthedate = date( "Y-m-d",strtotime(" -1 days" ) ).' 00:00:00';
        $newenddate = date( "Y-m-d",strtotime(" -7 days" ) ).' 23:59:59';
        $data['title'] = 'Loyality Income';
        $data['members'] = self::create_loyality();
        $data['plan_1'] = DB::table('member_activation')->where('plan',1)->whereBetween('created_at',array($newenddate,$newthedate))->count();
        $data['plan_2'] = DB::table('member_activation')->where('plan',2)->whereBetween('created_at',array($newenddate,$newthedate))->count();
        $data['plan_3'] = DB::table('member_activation')->where('plan',3)->whereBetween('created_at',array($newenddate,$newthedate))->count();
        $data['plan_4'] = DB::table('member_activation')->where('plan',4)->whereBetween('created_at',array($newenddate,$newthedate))->count();
        $data['total_loyal'] = DB::table('loyality_income')->get();
        return view('admin.loyality')->with($data);
    }
    function send_loyality(Request $request)
    {
        $loyaluser = self::create_loyality();
        if(count($loyaluser)>0)
        {
            foreach($loyaluser as $user)
            {
                $amount = $request->tt_amount;
                $usreid = DB::table('users')->where('memberid',$user)->first();
                
                if(!empty($usreid)){
                    
                    // $auto_pools = DB::table('auto_pools')->where('user_id',$usreid->id)->first();
                   
                         $insarra = [
                    'user_id'=>$usreid->id,
                    'pool_id'=>0,
                    'amount'=>$amount,
                    'status'=>0,
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s'),
                    ];
                    $ii = DB::table('loyality_income')->insert($insarra);
                    DB::table('wallets')->where('user_id',$usreid->id)->where('type',1)->update(['amount'=>DB::RAW("amount + $amount")]);
                    //type 1 by sunil
                    
                   
                    
                }
               
            }
        }
        return redirect()->back()->with(['success'=>'Loyality Generated Successfully']);
    }
    function myloyality(Request $request)
    {
        $data['title'] = 'Loyality Income';
       $data['total_loyal'] = DB::table('loyality_income')->where('user_id',Auth::User()->id)->get();
       return view('user.loyality')->with($data);
    }
    public function all_income(Request $request)
    {
        
        if ($request->ajax()) {
            $datearr = [];
            $member_activation = DB::table('member_activation')->where('user_id',Auth::id())->where('plan',1)->first();
            if(!empty($member_activation)){
                $date1=date_create(date('Y-m-d'));
                $date2=date_create(date('Y-m-d',strtotime($member_activation->created_at)));
                $diff=date_diff($date1,$date2);
                $difdate =  $diff->days;
                for($i=0;$i<=$difdate;$i++)
                {
                    $date = date('Y-m-d', strtotime(" -$i days", strtotime(date('Y-m-d'))));
                    $date1 = $date.' 00:00:00';
                    $date2 = $date.' 23:59:59';
                    $money = Money::where('pay_user_id',Auth::id())->whereBetween('created_at',array($date1,$date2))->where('status',0)->sum('amount');
                    $fintot = $money;
                    if($fintot!=0){
                        $action = '<a class="get_current_ledger modal-trigger" href="#income_ledger_report" data-id="'.$date.'"><i class="material-icons dp48">remove_red_eye</i></a>';
                        $datearr[] = ['total'=>intval($money).' Cr','date'=>date("d M Y", strtotime($date)),'income_type'=>'Level Income','action'=>$action];
                    }
                    $pool_incomes = DB::table('pool_incomes')->where('pay_id',Auth::id())->whereBetween('created_at',array($date1,$date2))->sum('pool_amount');
                    $fintot = $pool_incomes;
                    if($fintot!=0){
                        $action = '<a class="pool_current_ledger modal-trigger" href="#income_ledger_report" data-id="'.$date.'"><i class="material-icons dp48">remove_red_eye</i></a>';
                        $datearr[] = ['total'=>intval($pool_incomes).' Cr','date'=>date("d M Y", strtotime($date)),'income_type'=>'Pool Income','action'=>$action];
                    }
                    $loyal_incomes = DB::table('loyality_income')->where('user_id',Auth::id())->whereBetween('created_at',array($date1,$date2))->sum('amount');
                    if($loyal_incomes!=0){
                        $action = '<a class="loyal_current_ledger modal-trigger" href="#income_ledger_report" data-id="'.$date.'"><i class="material-icons dp48">remove_red_eye</i></a>';
                        $datearr[] = ['total'=>intval($loyal_incomes).' Cr','date'=>date("d M Y", strtotime($date)),'income_type'=>'Loyality Income','action'=>$action];
                    }
                    $withdraw = DB::table('wallet_transactions')->where('user_id',Auth::id())->where('reason',1)->whereBetween('created_at',array($date1,$date2))->sum('amount');
                    if($withdraw!=0){
                        $action = '<a class="with_current_ledger modal-trigger" href="#income_ledger_report" data-id="'.$date.'"><i class="material-icons dp48">remove_red_eye</i></a>';
                        $datearr[] = ['total'=>intval($withdraw).' Dr','date'=>date("d M Y", strtotime($date)),'income_type'=>'Withdrawal','action'=>$action];
                    }
                    $topup_wallet = DB::table('wallet_transactions')->where('user_id',Auth::id())->where('reason',2)->whereBetween('created_at',array($date1,$date2))->sum('amount');
                    if($topup_wallet!=0){
                        $action = '<a class="topup_current_ledger modal-trigger" href="#income_ledger_report" data-id="'.$date.'"><i class="material-icons dp48">remove_red_eye</i></a>';
                        $datearr[] = ['total'=>intval($topup_wallet).' Dr','date'=>date("d M Y", strtotime($date)),'income_type'=>'TopUp Wallet','action'=>$action];
                    }
                }
                
            }
            return Datatables::of($datearr)
                    ->addIndexColumn()
                    ->make(true);
        }
        $data['title'] = 'Income Report';
        return view('user.incomeledger')->with($data);
    }
    
    
    public function income_ledger(Request $request,$gettitl){
        if ($request->ajax()) {
            $datearr = [];
            $member_activation = DB::table('member_activation')->where('user_id',Auth::id())->where('plan',1)->first();
            if(!empty($member_activation)){
                $date1=date_create(date('Y-m-d'));
                $date2=date_create(date('Y-m-d',strtotime($member_activation->created_at)));
                $diff=date_diff($date1,$date2);
                $difdate =  $diff->days;
                for($i=0;$i<=$difdate;$i++)
                {
                    $date = date('Y-m-d', strtotime(" -$i days", strtotime(date('Y-m-d'))));
                    $date1 = $date.' 00:00:00';
                    $date2 = $date.' 23:59:59';
                    if($gettitl=='level'){
                        $money = Money::where('pay_user_id',Auth::id())->whereBetween('created_at',array($date1,$date2))->where('status',0)->sum('amount');
                        $fintot = $money;
                        if($fintot!=0){
                            $action = '<a class="get_current_ledger modal-trigger" href="#income_ledger_report" data-id="'.$date.'"><i class="material-icons dp48">remove_red_eye</i></a>';
                            $datearr[] = ['total'=>intval($money).' Cr','date'=>date("d M Y", strtotime($date)),'action'=>$action];
                        }
                    }elseif($gettitl=='pool'){
                        $pool_incomes = DB::table('pool_incomes')->where('pay_id',Auth::id())->whereBetween('created_at',array($date1,$date2))->sum('pool_amount');
                        $fintot = $pool_incomes;
                        if($fintot!=0){
                            $action = '<a class="pool_current_ledger modal-trigger" href="#income_ledger_report" data-id="'.$date.'"><i class="material-icons dp48">remove_red_eye</i></a>';
                            $datearr[] = ['total'=>intval($pool_incomes).' Cr','date'=>date("d M Y", strtotime($date)),'action'=>$action];
                        }
                    }elseif($gettitl=='loyality'){
                        $loyal_incomes = DB::table('loyality_income')->where('user_id',Auth::id())->whereBetween('created_at',array($date1,$date2))->sum('amount');
                        if($loyal_incomes!=0){
                            $action = '<a class="loyal_current_ledger modal-trigger" href="#income_ledger_report" data-id="'.$date.'"><i class="material-icons dp48">remove_red_eye</i></a>';
                            $datearr[] = ['total'=>intval($loyal_incomes).' Cr','date'=>date("d M Y", strtotime($date)),'income_type'=>'Loyality Income','action'=>$action];
                        }
                    
                    }elseif($gettitl=='with_trans'){
                        $withdraw = DB::table('wallet_transactions')->where('user_id',Auth::id())->where('reason',1)->whereBetween('created_at',array($date1,$date2))->get();
                        if(count($withdraw)>0){
                            $totalwith = 0;
                            $totalcharges = 0;
                            foreach($withdraw as $with){
                                $totalwith += $with->amount;
                                $totalcharges += $with->withdraw_charges;
                            }
                            $action = '<a class="with_current_ledger modal-trigger" href="#income_ledger_report" data-id="'.$date.'"><i class="material-icons dp48">remove_red_eye</i></a>';
                            $datearr[] = ['total'=>intval($totalwith).' Dr','date'=>date("d M Y", strtotime($date)),'income_type'=>'Withdrawal','charges'=>$totalcharges,'action'=>$action];
                        }
                        $topup_wallet = DB::table('wallet_transactions')->where('user_id',Auth::id())->where('reason',2)->whereBetween('created_at',array($date1,$date2))->sum('amount');
                        if($topup_wallet!=0){
                            $action = '<a class="topup_current_ledger modal-trigger" href="#income_ledger_report" data-id="'.$date.'"><i class="material-icons dp48">remove_red_eye</i></a>';
                            $datearr[] = ['total'=>intval($topup_wallet).' Dr','date'=>date("d M Y", strtotime($date)),'income_type'=>'TopUp Wallet','charges'=>0,'action'=>$action];
                        }
                    }
                }
                
            }
            return Datatables::of($datearr)
                    ->addIndexColumn()
                    ->make(true);
        }else
        {
            abort();
        }
    }
    
    public function income_ledger_report(Request $request,$gettype)
    {
        if($request->ajax())
        {
            $date1 = $request->date.' 00:00:00';
            $date2 = $request->date.' 23:59:59';
            $tabledata = '';
            if($gettype=='level'){
            $money = Money::where('pay_user_id',Auth::id())->whereBetween('created_at',array($date1,$date2))->where('status',0)->orderBy('reason','ASC')->get();
            $tabledata = '<h6 style="text-align:center;margin-bottom:0px;    margin-top: 0;    font-size: 20px;">Level Income Report <br> <span style="text-align:center;font-size:13px;">Dated: '.date("d-m-Y", strtotime($request->date)).'</span></h6><br><table>
                            <tr style="
    border-top: 1px solid #6b6f82;
">
                                <th>Sr</th>
                                <th style="    min-width: 76px;">Wallet</th>
                                <th style="text-align: center">Level</th>
                                <th style="text-align: center">Partner</th>
                            </tr>';
                            $i=1;
                           if(count($money)>0){ 
                               foreach($money as $mon){
                                   $getpartern = User::where('id',$mon->user_id)->first();
                                $tabledata .=  '<tr> 
                                                    <td style="">'.$i.'</td>
                                                   
                                                    <td style="">'.intval($mon->amount).' Cr </td>
                                                    <td style="text-align: center">'.$mon->reason.'</td>
                                                     <td  style="text-align: center">'.$getpartern->memberid.'</td>
                                                </tr>';
                                                $i++;
                               }
                           }
                           
                      $tabledata .= '</table>';
            }
            if($gettype=='pool'){
            $pool_incomes = DB::table('pool_incomes')->where('pay_id',Auth::id())->whereBetween('created_at',array($date1,$date2))->orderBy('level','ASC')->get();
            $tabledata = '<h6 style="text-align:center;margin-bottom:0px;    margin-top: 0;    font-size: 20px;">Pool Income Report <br> <span style="text-align:center;font-size:13px;">Dated: '.date("d-m-Y", strtotime($request->date)).'</span></h6><br><table>
                            <tr style="
    border-top: 1px solid #6b6f82;
">
                                <th>Sr</th>
                                <th style="    min-width: 80px;">Wallet</th>
                                <th style="text-align: center">Level</th>
                                <th style="text-align: center">Partner</th>
                            </tr>';
                            $i=1;
                           if(count($pool_incomes)>0){ 
                               foreach($pool_incomes as $mon){
                                   $getpartern = User::where('id',$mon->user_id)->first();
                                $tabledata .=  '<tr>
                                                    <td style="">'.$i.'</td>
                                                    
                                                    <td  style="">'.$mon->pool_amount.' Cr </td>
                                                    <td style="text-align: center">'.$mon->level.'</td>
                                                    <td style="text-align: center">'.$getpartern->memberid.'</td>
                                                </tr>';
                                                $i++;
                               }
                           }
                           
                      $tabledata .= '</table>';
            }
            if($gettype=='loyality'){
            $loyal_incomes = DB::table('loyality_income')->where('user_id',Auth::id())->whereBetween('created_at',array($date1,$date2))->get();
            $tabledata = '<h6 style="text-align:center;margin-bottom:0px;    margin-top: 0;    font-size: 20px;">Loyality Income Report <br> <span style="text-align:center;font-size:13px;">Dated: '.date("d-m-Y", strtotime($request->date)).'</span></h6><br><table>
                            <tr style="
    border-top: 1px solid #6b6f82;
">
                                <th>Sr</th>
                                <th style="    min-width: 80px;">Wallet</th>
                            </tr>';
                            $i=1;
                           if(count($loyal_incomes)>0){ 
                               foreach($loyal_incomes as $mon){
                                   $getpartern = User::where('id',$mon->user_id)->first();
                                $tabledata .=  '<tr>
                                                    <td style="">'.$i.'</td>
                                                    <td  style="">'.$mon->amount.' Cr </td>
                                                </tr>';
                                                $i++;
                               }
                           }
                           
                      $tabledata .= '</table>';
            }
            if($gettype=='withdraw'){
            $withdraw = DB::table('wallet_transactions')->where('user_id',Auth::id())->where('reason',1)->whereBetween('created_at',array($date1,$date2))->get();
            $tabledata = '<h6 style="text-align:center;margin-bottom:0px;    margin-top: 0;    font-size: 20px;">Withdrawal Report <br> <span style="text-align:center;font-size:13px;">Dated: '.date("d-m-Y", strtotime($request->date)).'</span></h6><br><table>
                            <tr style="
    border-top: 1px solid #6b6f82;
">
                                <th>Sr</th>
                                <th  style="    min-width: 80px;">Wallet</th>
                                <th  style="    min-width: 80px;">Charges</th>
                                <th>BTC Address</th>
                            </tr>';
                            $i=1;
                           if(count($withdraw)>0){ 
                               foreach($withdraw as $mon){
                                $tabledata .=  '<tr>
                                                    <td style="">'.$i.'</td>
                                                    <td style="color:red;"> -'.$mon->amount.'</td>
                                                    <td style="color:red;"> -'.$mon->withdraw_charges.'</td>
                                                    <td  style="">'.$mon->btc_add.'</td>
                                                </tr>';
                                                $i++;
                               }
                           }
                           
                      $tabledata .= '</table>';
            }
            if($gettype=='transfer'){
            $withdraw = DB::table('wallet_transactions')->where('user_id',Auth::id())->where('reason',2)->whereBetween('created_at',array($date1,$date2))->get();
            $tabledata = '<h6 style="text-align:center;margin-bottom:0px;    margin-top: 0;    font-size: 20px;">Withdrawal Report <br> <span style="text-align:center;font-size:13px;">Dated: '.date("d-m-Y", strtotime($request->date)).'</span></h6><br><table>
                            <tr style="
    border-top: 1px solid #6b6f82;
">
                                <th >Sr</th>
                                <th style="    min-width: 80px;">Wallet</th>
                                <th style="text-align: center">Source</th>
                            </tr>';
                            $i=1;
                           if(count($withdraw)>0){ 
                               foreach($withdraw as $mon){
                                $tabledata .=  '<tr>
                                                    <td style="">'.$i.'</td>
                                                    <td style="color:red;"> -'.$mon->amount.'</td>
                                                    <td style="text-align: center">TopUp Wallet</td>
                                                </tr>';
                                                $i++;
                               }
                           }
                           
                      $tabledata .= '</table>';
            }
            echo $tabledata;
        }else
        {
            abort(404);
        }
    }
    public function income_report_search(Request $request)
    {
        $datearr = [];
                $date1=date_create($request->from_date);
                $date2=date_create($request->to_date);
                $diff=date_diff($date1,$date2);
                $difdate =  $diff->days;
                for($i=0;$i<=$difdate;$i++)
                {
                    $newdate = $request->to_date;
                    if($request->from_date > $request->to_date)
                    {
                        $newdate = $request->from_date;
                    }
                    $date = date('Y-m-d', strtotime(" -$i days", strtotime($newdate)));
                    $date1 = $date.' 00:00:00';
                    $date2 = $date.' 23:59:59';
                    if($request->data_type=='level' || $request->data_type == 'all'){
                        $money = Money::where('pay_user_id',Auth::id())->whereBetween('created_at',array($date1,$date2))->where('status',0)->sum('amount');
                        $fintot = $money;
                        if($fintot!=0){
                            $action = '<a class="get_current_ledger modal-trigger" href="#income_ledger_report" data-id="'.$date.'"><i class="material-icons dp48">remove_red_eye</i></a>';
                            $datearr[] = ['total'=>'<span style="color:green"> +'.intval($money).'</span>','date'=>$date,'income_type'=>'Level Income','action'=>$action];
                        }
                    }if($request->data_type=='pool' || $request->data_type == 'all'){
                        $pool_incomes = DB::table('pool_incomes')->where('pay_id',Auth::id())->whereBetween('created_at',array($date1,$date2))->sum('pool_amount');
                        $fintot = $pool_incomes;
                        if($fintot!=0){
                            $action = '<a class="pool_current_ledger modal-trigger" href="#income_ledger_report" data-id="'.$date.'"><i class="material-icons dp48">remove_red_eye</i></a>';
                            $datearr[] = ['total'=>'<span style="color:green"> +'.intval($pool_incomes).'</span>','date'=>$date,'income_type'=>'Pool Income','action'=>$action];
                        }
                    }if($request->data_type=='level' || $request->data_type == 'loyality'){
                        $loyal_incomes = DB::table('loyality_income')->where('user_id',Auth::id())->whereBetween('created_at',array($date1,$date2))->sum('amount');
                        if($loyal_incomes!=0){
                            $action = '<a class="loyal_current_ledger modal-trigger" href="#income_ledger_report" data-id="'.$date.'"><i class="material-icons dp48">remove_red_eye</i></a>';
                            $datearr[] = ['total'=>'<span style="color:green"> +'.intval($loyal_incomes).'</span>','date'=>$date,'income_type'=>'Loyality Income','action'=>$action];
                        }
                    
                    }if($request->data_type=='with_trans' || $request->data_type == 'all'){
                        $withdraw = DB::table('wallet_transactions')->where('user_id',Auth::id())->where('reason',1)->whereBetween('created_at',array($date1,$date2))->get();
                        if(count($withdraw)>0){
                            $totalwith = 0;
                            $totalcharges = 0;
                            foreach($withdraw as $with){
                                $totalwith += $with->amount;
                                $totalcharges += $with->withdraw_charges;
                            }
                            $action = '<a class="with_current_ledger modal-trigger" href="#income_ledger_report" data-id="'.$date.'"><i class="material-icons dp48">remove_red_eye</i></a>';
                            $datearr[] = ['total'=>'<span style="color:red"> -'.intval($totalwith+$totalcharges).'</span>','date'=>$date,'income_type'=>'Withdrawal in BTC','charges'=>$totalcharges,'action'=>$action];
                        }
                        $topup_wallet = DB::table('wallet_transactions')->where('user_id',Auth::id())->where('reason',2)->whereBetween('created_at',array($date1,$date2))->sum('amount');
                        if($topup_wallet!=0){
                            $action = '<a class="topup_current_ledger modal-trigger" href="#income_ledger_report" data-id="'.$date.'"><i class="material-icons dp48">remove_red_eye</i></a>';
                            $datearr[] = ['total'=>'<span style="color:red"> -'.intval($topup_wallet).'</span>','date'=>$date,'income_type'=>'TopUp Wallet Ac','charges'=>0,'action'=>$action];
                        }
                    }
                }
                $data['title'] = 'Income Filter Search';
                $data['data11'] = $datearr;
                return view('user.income_search_report')->with($data);
                // echo '<pre>';
                // print_r($datearr);
    }

    public function all_topup(Request $request)
    {
        $data['title'] = 'Topup Wallet';
        return view('user.topupledger')->with($data);
    }
}



















