<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\AppException;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function index(Request $request){
        if(Auth::user())
            return redirect()->route('admin.index');
        return view('admin.login');
    }

    public function loginStore(Request $request) {
        if(Auth::user())
            return redirect(route('admin.index'));
        return Socialite::driver('google')->redirect();
    }
    

    public function callback(Request $request)
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect(route('admin.login'));
        }

        $localUser = User::where('email', '=', $user->email)->where('stat', 1)->first();
        if(!$localUser)
            throw new AppException(AppException::ERR_USER_NOT_FOUND);
        Auth::loginUsingId($localUser->id);
        return redirect(route('admin.index'));
    }
    
}
