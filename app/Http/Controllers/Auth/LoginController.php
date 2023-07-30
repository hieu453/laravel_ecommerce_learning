<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
    // protected $redirectTo = RouteServiceProvider::HOME;

    protected function showLoginForm() {
        if (!session()->has('url.intended')) {
            $previousURL = url()->previous();
            session()->put('url.intended', $previousURL);
            
        }
        return view('auth.login');
    }

    protected function authenticated() {
        if (Auth::user()->role_as == '1') {
            return redirect('/admin/dashboard')->with('message', 'Welcome to Dashboard');
        } else {
            // return redirect('/home')->with('status', 'Logged In successfully');
            // return redirect(session('url.intended'));
            $this->showLoginForm();
        }
    }

    public function logout() {
        if (!session()->has('url.intended')) {
            $previousURL = url()->previous();
            session()->put('previous.url', $previousURL);
            
        }
        Auth::logout();
        return redirect()->to(session('previous.url'));
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
