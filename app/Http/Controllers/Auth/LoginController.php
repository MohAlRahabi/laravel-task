<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
        return view('dashboard.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['username','password']);

        if(!Auth::validate($credentials)) {
            return redirect()->to('login')
                ->withErrors(['username'=>"wrong credentials!!"]);
        }

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        if($user->uuid == $request->uuid || $user->uuid == null) {

            Auth::login($user);

            $this->authenticated($request, $user);
            return redirect()->to(RouteServiceProvider::HOME);
        }
        return redirect()->to('login')
            ->withErrors(['username'=>"You Have Entered From Other Device"]);
    }
}
