<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Socialite;
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('eveonline')
            ->setScopes(config('eve-sso.scopes'))
            ->redirect();
    }

    public function handleProviderCallback()
    {
        $eve = Socialite::driver('eveonline')->user();
        $sso = Socialite::driver('eveonline')->handleDatabase($eve);

        $user = User::where('eso_id', $sso->character_id)->first();
    
        if ($user == null) {
            $user = User::create([
                'name' => $eve->name, 
                'email' => $eve->email, 
                'password' => null, 
                'eso_id' => $sso->character_id
            ]);
        }
        
        \Auth::login($user, false);

        \EveSSO\Jobs\CharacterPublic::dispatch($sso);

        return redirect($this->redirectTo);
    }
}
