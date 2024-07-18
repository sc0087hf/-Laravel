<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        // ログイン成功後のリダイレクト先
        $redirectUrl = '/post';

        // デバッグログ
        Log::debug("ログインに成功しました");

        if ($request->wantsJson()) {
            return new JsonResponse(['two_factor' => false], 200);
        }

        return redirect()->intended($redirectUrl);
    }
}
