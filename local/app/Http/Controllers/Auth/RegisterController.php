<?php

namespace App\Http\Controllers\Auth;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Role;
use App\Wallet;
use Auth;
use DB;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'state' => ['required'],
            'country' => ['required'],
           
            'sponserid' => ['required'],
            
            'ph_mobile' => ['required', 'numeric', 'min:10'],

            'email' => ['required', 'string', 'email', 'max:255'],
            'new_passw' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
$user='';
$sponss = strtoupper($data['sponserid']);
        $mem = member_using_member_id($sponss);
        if(count($mem)>0){
            $user = User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => bcrypt($data['new_passw']),
                'memberid'=>getUniqueuid(),
                'sponserid'=> $sponss,

                'mobile'   => $data['ph_mobile'],
                'state'    => $data['state'],
                'country'     => $data['country'],
                
                'fake_password'=> $data['new_passw'],
                'u_position'=> 0,
                
            ]);
             $user
             ->roles()
             ->attach(Role::where('name', 'user')->first());
          
        }
return $user;
         
    }
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        Wallet::create([
            'user_id'=>$user->id,
            'amount'=>0,
            'type'=>1,
        ]);
        Wallet::create([
            'user_id'=>$user->id,
            'amount'=>0,
            'type'=>2,
        ]);
        Wallet::create([
            'user_id'=>$user->id,
            'amount'=>0,
            'type'=>3,
        ]);
        Mail::to($user->email)->send(new OrderShipped($user));
        return $this->registered($request, $user) ?: response()->json($user);
    }
    public function showRegistrationForm()
        {
            $title = 'Register';

            return view('auth.register', compact('title'));
        }
    public function countries(Request $request){
        if($request->ajax()){
            if($request->has('q')){
                $res = $request->q;
                $data = DB::table('countries')->where('name','LIKE',"%$res%")->get(['id','name as text']);
                return response()->json($data);
            }else
            {
                $data = DB::table('countries')->get(['id','name as text']);
                return response()->json($data);
            } 
        }
        return redirect('/');
    }
    public function states(Request $request){
        if($request->ajax()){
            
            $data = DB::table('states')->where('country_id',$request->countryid)->get();
            return response()->json($data);
             
        }
        return redirect('/');
    }
}
