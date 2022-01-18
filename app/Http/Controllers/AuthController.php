<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Hash;
use Session;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
            //Login Success
            if($user = Auth::user()){
                if ($user->level == 'admin') {
                    return redirect()->intended('admin');
                }elseif ($user->level == 'cs') {
                    return redirect()->intended('user');
                }
            }
            // return redirect()->route('dashboard');
        return view('login');
        
    }
    public function register()
    {
        return view('/register');
    }
    public function profile()
    {
        $userdata = User::all();
        return view('/admin/profile/adduser', compact('userdata'));
    }

    public function login(Request $request)
    {
        $rules = [
            'email'                 => 'required|email',
            'password'              => 'required|string'
            ];$messages = [
            'email.required'        => 'Email wajib diisi',
            'email.email'           => 'Email tidak valid',
            'password.required'     => 'Password wajib diisi',
            'password.string'       => 'Password harus berupa string'
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
            }

            $data = [
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ];
            if (Auth::attempt($data)) {
                $user = Auth::user();
                if ($user->level == 'admin') {
                    return redirect()->intended('admin');
                } elseif ($user->level == 'cs') {
                    return redirect()->intended('user');
                }
                return redirect()->intended('/');
            }

            return back()->with('error', 'Login Tidak Berhasil..!!, Silahkan Coba Lagi');

    }

    public function prosesRegister(Request $request)
    {
        $rules = [
            'name'                  => 'required|min:5|max:30',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|confirmed'
        ];
        $messages = [
            'name.required'         => 'Nama Lengkap wajib',
            'name.min'              => 'Nama lengkap minimal 5 karakter',
            'name.max'              => 'Nama lengkap maksimal 30 karakter',
            'email.required'        => 'Email wajib diisi',
            'email.email'           => 'Email tidak valid',
            'email.unique'          => 'Email sudah terdaftar',
            'password.required'     => 'Password wajib diisi',
            'password.confirmed'    => 'Password tidak sama dengan konfirmasi password'
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
            }
            $user = new User;
            $user->name = ucwords(strtolower($request->name));
            $user->email = strtolower($request->email);
            $user->password = Hash::make($request->password);
            $user->email_verified_at = \Carbon\Carbon::now();
            $user->level = $request->level;
            $simpan = $user->save();

            if($simpan){
                return back()->with('success', 'Register Berhasil');
                return redirect()->route('login');
            } else {
                return back()->with('error', 'Register Tidak Berhasil, Silahkan Coba Lagi');
                return redirect()->route('register');
            }
    }
    public function user($id)
    {
        $user = User::findOrFail($id);
        return view('/admin/profile/user', compact('user'));
    }
    public function logout()
    {
    // $request->session()->flush();
    Auth::logout(); // menghapus session yang aktif
    return redirect()->route('login');
    }
}
