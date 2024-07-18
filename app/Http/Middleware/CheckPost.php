<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class CheckPost {
    /**
     * Handle an incoming request.
     *
     *  @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    protected $except = [
        'password',
        'password_confirmation',
    ];    


     public function handle(Request $request, Closure $next): Response
     {
        //VerifyCsrfTokenミドルウェアのインスタンスを作成
        $csrfVerifier = app(BaseVerifier::class);

        //VerifyCsrfTokenミドルウェアのhandleメソッドを呼び出し
        $response = $csrfVerifier->handle($request, function ($request) use ($next) {
            return $next($request);
        });
        
        return $response;
     }





}
