<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function createSession(Request $request){
        $request->session()->put('daftar_id');
        echo "Data Berhasil di tambahkan";
    }
    public function showSession(Request $request){
        if ($request->session()->has('daftar_id')) {
            $session = $request->session()->get('daftar_id');
        } else {
            echo "Data Session tidak ada";
        }
        dd($session);
        // return view('/user/listbarang/listbarangkeluar', compact('session'));
        
    }
}
