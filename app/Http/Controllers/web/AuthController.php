<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Middleware\RoleMiddleware;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function index( ){
        // dd(auth()->user());
        return view('auth.login');

        

    }
    public function login( Request $request){
        
     $validator = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
    //     $hashedPassword = Hash::make($validator['password']);
    //     // dd($hashedPassword);
    //   $user = User::where('email',$validator['email'])->first();
    //   dd($user);

      if (auth()->guard('web')->attempt($validator)) {
        // $user = auth()->guard('web')->user();
        $role = auth()->guard('web')->user()->role->role;
       
        if ($role == 'admin') {
            return redirect('/test')->with('status', 'berhasil');
        }else{
            return redirect('/login');
        }
      

       
      }else{
        return redirect('/login');
    
      }
    
      // Validasi input
    //   $validated = $request->validate([
    //     'email' => 'required|email',
    //     'password' => 'required',
    // ]);

    // try {
    //     // Mencoba otentikasi pengguna dengan guard 'web' untuk rute web
    //     if (Auth::guard('web')->attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
    //         // Debugging
    //         Log::info('User authenticated', [auth()->guard('web')->user()]);
    //         // Jika berhasil, redirect ke route 'test'
    //         return redirect()->route('test')->with('status', 'berhasil');
    //     } else {
    //         // Debugging
    //         Log::info('Invalid credentials');
    //         // Jika gagal, redirect kembali ke route 'login' dengan pesan error
    //         return redirect()->route('login')->withErrors(['email' => 'Invalid credentials.']);
    //     }
    // } catch (\Throwable $th) {
    //     // Menangkap pengecualian dan melakukan sesuatu
    //     Log::error($th);
    //     // Redirect kembali ke route 'login' dengan pesan error
    //     return redirect()->route('login')->withErrors(['login_error' => 'Terjadi kesalahan saat mencoba masuk. Silakan coba lagi.']);
    // }

 

   
    



    }

    public function logout()
    {
    //    dd(RoleMiddleware::user());

 
        auth()->logout();
        return redirect('/login');

        
    }
}
