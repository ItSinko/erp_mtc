<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    public function authenticated()
    {
        if (auth()->user()->divisi->id == 24) {
            return redirect('/ppic/dashboard');
        } else if (auth()->user()->divisi->id == 15) {
            return redirect('/logistik/dashboard');
        } else if (auth()->user()->divisi->id == 23) {
            return redirect('/qc/dashboard');
        } else if (auth()->user()->divisi->id == 26) {
            return redirect('/penjualan/dashboard');
        } elseif (auth()->user()->divisi->id == 13) {
            return redirect('/gbj/dashboard');
        } elseif (auth()->user()->divisi->id == 17) {
            return redirect('/produksi/dashboard');
        }elseif (auth()->user()->divisi->id == 12) {
            return redirect('/gk/dashboard');
        }elseif (auth()->user()->divisi->id == 2) {
            return redirect('/direksi/dashboard');
        }
        return redirect('/home');
    }
}
