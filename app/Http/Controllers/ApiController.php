<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ApiController extends Controller
{
    public function login_check(Request $request)
    {
        // dd($request->username);
        if (is_numeric($request->username)) {
            if (Auth::guard('web')->attempt(array('nomer_hp' => $request->username, 'password' => $request->password))) {
                // dd(auth()->user()->status_user);
                // if (Auth::guard('web')->attempt($creds)) {
                if (auth()->user()->is_email_verified == '1' && auth()->user()->status_user == '1') {
                    Alert::success('Berhasil', 'Selamat Datang ' . auth()->user()->nama_vendor);
                    $data['msg'] = "DATA ADA";
                    $data['level'] = Auth::user()->level;
                    $data['username'] = Auth::user()->username;
                    echo json_encode($data);
                    // return redirect()->route('user.home')->with('Berhasil', 'Selamat Datang ' . auth()->user()->nama_vendor);
                } else if (auth()->user()->is_email_verified == '0' && auth()->user()->status_user == '0') {
                    Auth::logout();
                    // Alert::warning('Cek Email Sekarang', 'Mohon Cek Email Anda Sekarang Dan Lakukan Verifikasi');
                    $data['msg'] = "DATA TIDAK ADA";
                    echo json_encode($data);
                    // return redirect()->route('user.login')->with('Cek Email Sekarang', 'Mohon Cek Email Anda Sekarang Dan Lakukan Verifikasi');
                } else if (auth()->user()->status_user == '0') {
                    Auth::logout();
                    $data['msg'] = "DATA TIDAK ADA1";
                    echo json_encode($data);
                }
                // else {
                //     Auth::logout();
                //     Alert::warning('Mohon Di Tunggu', 'Akun Anda Dalam Proses Validasi');
                //     return redirect()->route('user.login')->with('Mohon Di Tunggu', 'Akun Anda Dalam Proses Validasi');
                // }
            } else {
                Alert::error('Gagal', 'Mohon Masukkan Email Atau Username Dan Password Dengan Benar');
                $data['msg'] = "DATA TIDAK ADA2";
                echo json_encode($data);
            }
        } elseif (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
            // dd('b');
            if (Auth::guard('web')->attempt(array('email' => $request->username, 'password' => $request->password))) {
                // if (Auth::guard('web')->attempt($creds)) {
                if (auth()->user()->is_email_verified == 1 && auth()->user()->status_user == 1) {
                    Alert::success('Berhasil', 'Selamat Datang ' . auth()->user()->nama_vendor);
                    return redirect()->route('user.home')->with('Berhasil', 'Selamat Datang ' . auth()->user()->nama_vendor);
                } else if (auth()->user()->is_email_verified == 0 && auth()->user()->status_user == 0) {
                    Auth::logout();
                    Alert::warning('Cek Email Sekarang', 'Mohon Cek Email Anda Sekarang Dan Lakukan Verifikasi');
                    return redirect()->route('user.login')->with('Cek Email Sekarang', 'Mohon Cek Email Anda Sekarang Dan Lakukan Verifikasi');
                } else if (auth()->user()->status_user == 0) {
                    Auth::logout();
                    Alert::warning('Mohon Maaf', 'Akun Anda Tidak Aktif');
                    return redirect()->route('user.login')->with('Mohon Maaf', 'Akun Anda Tidak Aktif');
                } else {
                    Auth::logout();
                    Alert::warning('Mohon Di Tunggu', 'Akun Anda Dalam Proses Validasi');
                    return redirect()->route('user.login')->with('Mohon Di Tunggu', 'Akun Anda Dalam Proses Validasi');
                }
            } else {
                Alert::error('Gagal', 'Mohon Masukkan Email Atau Username Dan Password Dengan Benar');
                return redirect()->route('user.login')->with('Gagal', 'Mohon Masukkan Email Atau Password Dengan Benar');
            }
        } else {
            // dd('c');
            if (Auth::guard('web')->attempt(array('username' => $request->username, 'password' => $request->password))) {
                // if (Auth::guard('web')->attempt($creds)) {
                if (auth()->user()->is_email_verified == 1 && auth()->user()->status_user == 1) {
                    Alert::success('Berhasil', 'Selamat Datang ' . auth()->user()->nama_vendor);
                    return redirect()->route('user.home')->with('Berhasil', 'Selamat Datang ' . auth()->user()->nama_vendor);
                } else if (auth()->user()->is_email_verified == 0 && auth()->user()->status_user == 0) {
                    Auth::logout();
                    Alert::warning('Cek Email Sekarang', 'Mohon Cek Email Anda Sekarang Dan Lakukan Verifikasi');
                    return redirect()->route('user.login')->with('Cek Email Sekarang', 'Mohon Cek Email Anda Sekarang Dan Lakukan Verifikasi');
                } else if (auth()->user()->status_user == 0) {
                    Auth::logout();
                    Alert::warning('Mohon Maaf', 'Akun Anda Tidak Aktif');
                    return redirect()->route('user.login')->with('Mohon Maaf', 'Akun Anda Tidak Aktif');
                } else {
                    Auth::logout();
                    Alert::warning('Mohon Di Tunggu', 'Akun Anda Dalam Proses Validasi');
                    return redirect()->route('user.login')->with('Mohon Di Tunggu', 'Akun Anda Dalam Proses Validasi');
                }
            } else {
                Alert::error('Gagal', 'Mohon Masukkan Email Atau Username Dan Password Dengan Benar');
                return redirect()->route('user.login')->with('Gagal', 'Mohon Masukkan Email Atau Password Dengan Benar');
            }
        }
        // dd($fieldType);
        // $creds = $request->only('email', 'password');
    }
}
