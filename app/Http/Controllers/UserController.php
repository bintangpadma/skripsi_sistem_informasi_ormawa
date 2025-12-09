<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB; 
use Carbon\Carbon; 
use App\Models\User; 
use Mail; 
use Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Mail\SendResetPasswordEmail;

class UserController extends Controller
{
    public function index()
    {
        return view('authenticate.login', [
            'page' => 'Halaman Login'
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'email' => 'required|max:255',
                'password' => 'required|max:255',
            ]);

            if (Auth::attempt($validatedData)) {
                $request->session()->regenerate();
                if (!auth()->user()->admin->status) {
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    return redirect()->back()->with('failed', 'Akun admin ini sudah tidak aktif!');
                }
                return redirect()->route('dashboard.index')->with('success', 'Berhasil login akun!');
            }

            return redirect()->back()->with('failed', 'Email atau password tidak ditemukan!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Email atau password tidak ditemukan!');
        }
    }

    public function forgetPassword()
    {
        return view('authenticate.forgot', [
            'page' => 'Halaman Reset Password'
        ]);
    }

    public function storeForgetPassword(Request $request)
    {
        $request->validate([
              'email' => 'required|email|exists:users',
          ]);
  
          $token = Str::random(64);
  
          DB::table('password_resets')->insert([
              'email' => $request->email, 
              'token' => $token, 
              'created_at' => Carbon::now()
            ]);
  
        //   Mail::send('emails.forget-password', ['token' => $token], function($message) use($request){
        //       $message->to($request->email);
        //       $message->subject('Reset Password');
        //   });

          $data = [
                'token' => $token,
                'from_email' => env('MAIL_FROM_ADDRESS'),
                'from_name' => 'Sistem Ormawa',
            ];

            Mail::to($request->email)->send(new SendResetPasswordEmail($data));
  
          return back()->with('success', 'Kami telah mengirimkan email reset password link untuk anda!');
    }

    public function resetPassword($token)
    {
        return view('authenticate.reset', [
            'page' => 'Halaman Ganti Password',
            'token' => $token
        ]);
    }

    public function storeResetPassword(Request $request)
    {
          $request->validate([
              'email' => 'required|email|exists:users',
              'password' => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required'
          ]);
  
          $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email, 
                                'token' => $request->token
                              ])
                              ->first();
  
          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }
  
          $user = User::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);
 
          DB::table('password_resets')->where(['email'=> $request->email])->delete();
  
          return redirect('/login')->with('success', 'Password anda berhasil dirubah!');
    }


    public function delete(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('user.index')->with('success', 'Berhasil logout akun!');
    }
}
