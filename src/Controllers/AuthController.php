<?php

namespace Aptika\SsoGorontalo\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Aptika\SsoGorontalo\Models\SSO;
use Illuminate\Support\Facades\Auth;

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
        return redirect(route(config('aptika-sso.route-dashboard')))->with('success', 'Berhasil Login');
    }
}
