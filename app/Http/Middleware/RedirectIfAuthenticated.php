<?php
//備考RedirectIfAuthenticated ミドルウェアは会員登録コントローラーやログインコントローラーのコンストラクタで適用されている。
//RegisterController.php
//LoginController.php
//Kernel.php
namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

//備考　ログインしているユーザーをログインページに遷移できないようにする。
class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return redirect('/');
        }

        return $next($request);
    }
}
