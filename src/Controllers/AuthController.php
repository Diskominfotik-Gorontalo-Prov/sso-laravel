<?php

namespace Aptika\SsoGorontalo\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Aptika\SsoGorontalo\Models\SSO;

class AuthController extends Controller
{
    public function sso()
    {
        $sso = new SSO();
        return $sso->getCodeSso();
    }

    public function callback(Request $request)
    {
        $request->validate(['code' => 'required']);

        $sso = new SSO();
        $cek = $sso->oauthGetToken($request->code);
        if (!$cek) {
            return redirect(route(config('aptika-sso.route-login')))->with('error', 'Gagal Login');
        }
        return redirect(route(config('aptika-sso.route-dasboard')))->with('success', 'Berhasil Login');
    }
}
