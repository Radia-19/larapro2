<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserVerification;
use App\Mail\EmailVerify;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class UserAuthController extends Controller
{
    //USER/////////////////////////////////////////////////
    public function showRegister()
    {
        return view('user.auth.register');
    }
    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|alpha_dash|unique:users,username|min:4',
            'email' => 'required|email|unique:users,email',
            'password' =>'required|confirmed'
        ]);

        DB::transaction(function () use($request) {

        $user = User::create([
            'username' => $request->username,
            'email'=> $request->email,
            'password'=> bcrypt($request->password)
        ]);

        //GENERATE TOKEN
        $token = sha1(rand(10000,99999));
        $user->verification()->create([
            'token'=> $token
        ]);
         //SEND EMAIL VERIFY
        try {
            Mail::to($request->email)->send(new EmailVerify($user->id, $token));
         } catch (\Exception $e) {
             return back()->withErrors(['email' => 'Failed to send verification email.']);
         }
        });

         return redirect()->route('user.login.show')->with('success', 'Registered Successfully. Please check your email for verification.');
         //dd('here');
    }


    public function verifyUser($userId,$token)
    {
        $findUser = UserVerification::where('user_id', $userId)->where  ('token', $token)->first();

        if ($findUser) {

            $findUser->delete();
            User::findOrFail($userId)->update([
                'email_verified' => '1'
            ]);

            return redirect()->route('user.login.show')->with('success', 'Email verified successfully!');

        }else{
            return 'Hacker Detected';
        }

    }

    public function showLogin()
    {
        return view('user.auth.login');
    }
    public function login(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt([
            'username' => $request->username,
            'password' => $request->password
            ])){
                return redirect()->route('home')->with('success', 'Login successful.');
        }else{
            return redirect()->back()->with(('error'), 'Invalid credentials.');
        }

    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('user.login.show');
    }
    //ADMIN///////////////////////////////////////////////

    public function showAdminLogin()
    {
        return view('admin.auth.adminLogin');
    }
    public function adminLogin(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt([
            'username' => $request->username,
            'password' => $request->password
            ])){
                return redirect()->route('home')->with('success', 'Admin Login Successful.');
        }else{
            return redirect()->back()->with(('error'), 'Invalid credentials.');
        }

    }
    public function adminLogout(Request $request)
    {
        Auth::logout();
        return redirect()->route('admin.login.show');
    }

    public function showAdminRegister()
    {
        return view('admin.auth.adminRegister');
    }

    public function adminRegister(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|alpha_dash|unique:users,username|min:4',
            'email' => 'required|email|unique:users,email',
            'password' =>'required|confirmed'
        ]);

        DB::transaction(function () use($request) {

        $user = User::create([
            'username' => $request->username,
            'email'=> $request->email,
            'password'=> bcrypt($request->password)
        ]);

        });

         return redirect()->route('admin.login.show')->with('success', 'Registered Successfully. Please check your email for verification.');
         //dd('here');
    }


    //GOOGLE LOGIN////////////////////////////////////////
    public function redirectTogoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $userData = Socialite::driver('google')->user();

        $duplicateUser = User::where('google_id',$userData->getId());

        if(Auth::check()){

            if ($duplicateUser->count() > 0){
                return redirect()->route('home')->with('error','Google Account Already In Use.');
            }
            User::findOrFail(Auth::id())->update([
                'google_login' => '1',
                'google_id' => $userData->getId(),
                'google_avater'=> $userData->getAvatar(),
            ]);
            }else{

            if ($duplicateUser->count() == 1){
                $duplicateUser = $duplicateUser->first();
                Auth::login($duplicateUser);

                return to_route('home');

              }else{
                return to_route('user.login.show')->with('error','No Account Found');
              }
           }
           return redirect()->route('home');

    }

}










        // User::create([
        //     'username' => request('username'),
        //     'email'=> request('email'),
        //     'password'=> bcrypt(request('password'))
        // ])->verification()->create([
        //     'token'=> sha1(rand(10000,99999))
        // ]);

        // UserVerification:;create([
        //     'user_id'=> $user->id,
        //     'token'=> sha1(rand(10000,99999))
        // ]);
        // Mail::to($request->email)->send(new EmailVerify($user->id, $token));
        //return redirect()->route('user.login.show')->with('error','');
        // if ($validated['username'] != $request->username)
        //Auth::login($duplicateUser);
