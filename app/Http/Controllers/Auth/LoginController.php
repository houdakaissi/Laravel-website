<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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
    protected $redirectTo = "/";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    /**
    *  @param \Illuminate\Http\Request  $request
  

  *  @param mixed   $user
   * @return mixed
   */
   protected function authenticated(Request $request,$user){
       if(!$user->active){
           Auth::logout();
           return redirect('/login')->with(['errorLink' => 'veillez activez votre compe
           <a href=" '.route('code.resend',$user->email).' ">
           Renvoyez le lien d\'activation
           </a>
           '])->withEmail($user->email);
       }
       }
   }







 
