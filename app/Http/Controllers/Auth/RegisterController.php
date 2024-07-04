<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        Validator::extend('without_spaces', function ($attr, $value) {
            return preg_match('/^\S*$/u', $value);
        });
        return Validator::make(
            $data,
            [
                'nama' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'no_hp' => ['required', 'without_spaces', 'regex:/^(^\+62|62|^08)(\d{3,4}-?){2}\d{3,4}$/', 'unique:users', 'min:9', 'max:20'],
                'status' => 'required',
            ],
            // Custom Error Code
            [
                'nama.required' => 'Nama depan wajib di isi',
                'nama.min' => 'Nama depan terlalu pendek',
                'nama.max' => 'Nama depan terlalu panjang, maksimal 255 karakter',
                'no_hp.required' => 'Nomor Telepon wajib di isi',
                'no_hp.without_spaces' => 'Nomor Telepon terdapat spasi',
                'no_hp.regex' => 'Nomor Telepon tidak sesuai format',
                'no_hp.unique' => 'Nomor Telepon telah digunakan',
                'no_hp.min' => 'Nomor Telepon terlalu Pendek',
                'no_hp.max' => 'Nomor Telepon terlalu Panjang',
                'email.required' => 'Email wajib di isi',
                'email.email' => 'Harus berupa format email',
                'email.unique' => 'Email sudah terdaftar',
                'email.max' => 'Email terlalu panjang, maksimal 45 karakter',
                'password.required' => 'Password wajib di isi',
                'password.min' => 'Password terlalu pendek, minimal 8 karakter',
                'password.confirmed' => 'Password tidak sama',
                'status.required' => 'Status wajib dipilih',
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        Alert::success('Registrasi Berhasil!', 'Anda baru bisa login hingga admin mengaktivasi akun anda, tunggu paling lambat 1x24 jam sampai admin mengaktifkan akunmu')->persistent('Close');
        return User::create([
            'nama' => $data['nama'],
            'no_hp' => $data['no_hp'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'status' => $data['status'],
            'created_at' => now(),
        ]);
    }
}
