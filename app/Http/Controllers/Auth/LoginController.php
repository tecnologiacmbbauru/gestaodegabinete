<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Tenant\ManagerTenant;
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
   // protected $redirectTo = RouteServiceProvider::HOME;

   public function authenticate(Request $request, ManagerTenant $manager)
   {   

       $dominio = $request->domain;

       $organizacao = $this->getOrganizacao($dominio);

       if($organizacao != null){//se a organização existir
           $manager->setConnection($organizacao); //tenta setar conexão
           $response = true;
       }else{
           $response = false;
       }

       $credentials = $request->only('user_name', 'password','domain');

       if (Auth::attempt($credentials)) {
           // Authentication passed...
           
           $manager->setConnection($organizacao); //tenta setar conexão
           
           session()->put('dominio', Auth()->user()->domain);
           
           dd(Auth()->user()->domain);
           
           if($credentials['domain']=="system"){
               return redirect()->route('tenant.index');
           }else{
               return redirect()->route('index');
           }
       }else
       {
           return "Login Invalido";
       }
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


    /**
        * Get the login username to be used by the controller.
        *
        * @return string
        */
    public function username()
    {
        return 'user_name';
    }

}
