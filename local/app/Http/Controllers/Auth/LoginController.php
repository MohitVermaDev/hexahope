<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\User;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
        
    }
    public function showLoginForm()
    {
        $title = 'Login';

        return view('auth.login', compact('title'));
    }
    public function showadminLoginForm()
    {
        $title = 'Login';

        return view('auth.adminlogin', compact('title'));
    }
    protected function username() {
        return 'memberid';
    }
    public function login(Request $request)
    {
        $ar =[];
        $credentials = $request->only($this->username(), 'password');
        $authSuccess = Auth::attempt($credentials);

        if($authSuccess) {
            if($request->user()->hasRole('admin'))
            {
                $ar[] = 'Username is Not Valid'; 
                Auth::logout();
                return
                response()->json([
                    'error' => $ar
                ]);
            }else
            {
                $request->session()->regenerate();
                return response()->json(['success' => 'ssd']);
            }
        }
        
        $userfound = User::where('memberid',$request->memberid)->first();
        if(empty($userfound))
        {
           $ar[] = 'Username is Not Valid'; 
        }
        elseif(!Hash::check($request->password,$userfound->password)){
            $ar[] = 'Password is Not Valid'; 
        }
        return
            response()->json([
                'error' => $ar
            ]);
    }

    public function adminlogin(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendadminLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
    protected function sendadminLoginResponse(Request $request)
    {
        if($request->user()->hasRole('user'))
        {
            Auth::logout();
        }
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);
        return $this->authenticated($request, $this->guard()->user()) ?: redirect()->intended($this->redirectPath());
    }
    protected function sendLoginResponse(Request $request)
    {
        if($request->user()->hasRole('admin'))
        {
            Auth::logout();
        }
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);
        return $this->authenticated($request, $this->guard()->user()) ?: redirect()->intended($this->redirectPath());
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');
    }
}
