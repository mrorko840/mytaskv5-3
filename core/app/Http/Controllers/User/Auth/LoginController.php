<?php

namespace App\Http\Controllers\User\Auth;

use App\Models\UserLogin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $username;

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = $this->findUsername();
        $this->activeTemplate = activeTemplate();
    }

    public function showLoginForm()
    {
        $pageTitle = "Login";
        return view($this->activeTemplate . 'user.auth.login', compact('pageTitle'));
    }

    public function login(Request $request)
    {
        // dd($request->session()->regenerateToken());
        if(!$request->username && !$request->password){
            $cls = 'error';
            $notify = 'Username and Password are Required!';
            return response()->json(['msg'=>$notify, 'cls'=>$cls]);
        }

        if($this->attemptLogin($request)){
            // dd('success');
            $this->validateLogin($request);
            $request->session()->regenerateToken();
            $this->sendLoginResponse($request);
            $this->incrementLoginAttempts($request);

            if(!verifyCaptcha()){
                $cls = 'error';
                $notify = 'Invalid captcha provided';
                return response()->json(['msg'=>$notify, 'cls'=>$cls]);
            }

            $cls = 'success';
            $notify = 'You are Logged In Successfully!';
            return response()->json(['msg'=>$notify, 'cls'=>$cls]);
        }else{
            // dd('error');

            $cls = 'error';
            $notify = 'Username or Password Incorrect!';
            return response()->json(['msg'=>$notify, 'cls'=>$cls]);
        }

        // $this->validateLogin($request);

        // $request->session()->regenerateToken();
        
        // if ($this->hasTooManyLoginAttempts($request)) {
        //     $this->fireLockoutEvent($request);

        //     return $this->sendLockoutResponse($request);
        // }

        // if ($this->attemptLogin($request)) {
        //     return $this->sendLoginResponse($request);
        // }
        
        // $this->incrementLoginAttempts($request);


        // return $this->sendFailedLoginResponse($request);
        
    }

    // public function login(Request $request)
    // {
    //     $this->validateLogin($request);

    //     $request->session()->regenerateToken();

    //     if(!verifyCaptcha()){
    //         // $notify[] = ['error','Invalid captcha provided'];
    //         // return back()->withNotify($notify);

    //         $cls = 'error';
    //         $notify = 'Invalid captcha provided';
    //         return response()->json(['msg'=>$notify, 'cls'=>$cls]);
    //     }

    //     if ($this->hasTooManyLoginAttempts($request)) {
    //         $this->fireLockoutEvent($request);

    //         return $this->sendLockoutResponse($request);
    //     }

    //     if ($this->attemptLogin($request)) {
    //         // dd($this->sendLoginResponse($request));
    //         return $this->sendLoginResponse($request);
    //     }
        
    //     dd($this->incrementLoginAttempts($request));

    //     $this->incrementLoginAttempts($request);


    //     return $this->sendFailedLoginResponse($request);
        
    // }

    public function findUsername()
    {
        $login = request()->input('username');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$fieldType => $login]);
        return $fieldType;
    }

    public function username()
    {
        return $this->username;
    }

    protected function validateLogin(Request $request)
    {

        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);

    }

    public function logout()
    {
        $this->guard()->logout();

        request()->session()->invalidate();

        $notify[] = ['success', 'You have been logged out.'];
        return to_route('user.login')->withNotify($notify);
    }





    public function authenticated(Request $request, $user)
    {
        $user->tv = $user->ts == 1 ? 0 : 1;
        $user->save();
        $ip = getRealIP();
        $exist = UserLogin::where('user_ip',$ip)->first();
        $userLogin = new UserLogin();
        if ($exist) {
            $userLogin->longitude =  $exist->longitude;
            $userLogin->latitude =  $exist->latitude;
            $userLogin->city =  $exist->city;
            $userLogin->country_code = $exist->country_code;
            $userLogin->country =  $exist->country;
        }else{
            $info = json_decode(json_encode(getIpInfo()), true);
            $userLogin->longitude =  @implode(',',$info['long']);
            $userLogin->latitude =  @implode(',',$info['lat']);
            $userLogin->city =  @implode(',',$info['city']);
            $userLogin->country_code = @implode(',',$info['code']);
            $userLogin->country =  @implode(',', $info['country']);
        }

        $userAgent = osBrowser();
        $userLogin->user_id = $user->id;
        $userLogin->user_ip =  $ip;

        $userLogin->browser = @$userAgent['browser'];
        $userLogin->os = @$userAgent['os_platform'];
        $userLogin->save();

        return to_route('user.home');
    }


}
