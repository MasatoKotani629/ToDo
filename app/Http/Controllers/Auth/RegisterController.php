<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = '/';

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
        // make メソッドの第一引数は検証するデータ、第二引数がルール定義、第三引数がメッセージ定義、第四引数が項目名定義です
        // メッセージは validation.php で定義するのでからの配列を渡し、第四引数で日本語の項目名を定義しています。
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'gender'   => 'required',
            'age'      => 'required|integer',
            'position'      => 'required|integer',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ] , [], [
            'email' => 'メールアドレス',
            'name' => 'ユーザー名',
            'gender' => 'ユーザー名',
            'age' => '年齢',
            'position'      => 'required|integer',
            'password' => 'パスワード',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    // //備考（ユーザーカラム追加）
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'gender' => $data['gender'],
            'age' => $data['age'],
            'email' => $data['email'],
            'position' => $data['position'],
            'password' => Hash::make($data['password']),
        ]);
    }


}
