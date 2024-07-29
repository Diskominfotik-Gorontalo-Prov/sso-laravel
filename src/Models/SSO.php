<?php

namespace Aptika\SsoGorontalo\Models;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class SSO extends Model
{

    private function sinkronUserSSO($token)
    {
        $namespacePrefix = '\\' . config('aptika-sso.model.user') . '\\';
        try {
            $client = new Client();
            $headers = [
                'Authorization' => 'Bearer ' . $token
            ];
            $options = [
                'headers' => $headers,
            ];
            $request = $client->request('GET', env("RESOURCE_URL"),  $options);
            $data =  $request->getBody(); // Cetak permintaan HTTP untuk di-debug
            $dataJson = json_decode($data, true);
            $dataUser = $namespacePrefix::where(
                config("aptika-sso.data_resource.email"),
                $dataJson['email']
            )->first();
            if (!$dataUser) {
                $dataUser = $namespacePrefix::create([
                    config("aptika-sso.data_resource.email") => $dataJson['email'],
                    config("aptika-sso.data_resource.nama") => $dataJson['nama'],
                    config("aptika-sso.data_resource.gambar") => $dataJson['gambar'],
                    'email_verified_at' => now(),
                    config("aptika-sso.data_resource.nip") => $dataJson['nip'],
                    config("aptika-sso.data_resource.unorid") => $dataJson['unorid'],
                    config("aptika-sso.data_resource.nomor") => $dataJson['nomor'],
                    'password' => "",
                ]);
            } else {
                $dataUser->update([
                    config("aptika-sso.data_resource.email") => $dataJson['email'],
                    config("aptika-sso.data_resource.name") => $dataJson['nama'],
                    config("aptika-sso.data_resource.gambar") => $dataJson['gambar'],
                    config("aptika-sso.data_resource.nip") => $dataJson['nip'],
                    config("aptika-sso.data_resource.unorid") => $dataJson['unorid'],
                    config("aptika-sso.data_resource.nomor") => $dataJson['nomor'],
                    'password' => "",
                ]);
            }

            Auth::login($dataUser);
            return true;
        } catch (ClientException $e) {
            $response = $e->getResponse();
            // Log error or notify
            return 0;
        }
    }

    public function oauthGetToken($code)
    {
        try {
            $client = new Client();
            $headers = [
                'Content-Type' => 'application/x-www-form-urlencoded'
            ];
            $options = [
                'headers' => $headers,
                'form_params' => [
                    'client_id' => env('CLIENT_ID'),
                    'client_secret' => env('CLIENT_SECRET'),
                    'redirect_uri' => env("REDIRECT_URL"),
                    'code' => $code,
                    'grant_type' => 'authorization_code'
                ]
            ];
            $request = $client->request('POST', env("ACCESS_TOKEN_URL"),  $options);
            $data =  $request->getBody(); // Cetak permintaan HTTP untuk di-debug
            $dataJson = json_decode($data, true);
            $access_token =  $dataJson['access_token'];
            return $this->sinkronUserSSO($access_token);
        } catch (ClientException $e) {
            $response = $e->getResponse();
            // Log error or notify
            return 0;
        }
    }

    public function getCodeSso()
    {
        $state = Str::random(40);
        $query = http_build_query([
            'response_type' => 'code',
            'client_id' => env('CLIENT_ID'),
            'redirect_uri' => env("REDIRECT_URL"),
        ]);
        return redirect(env('AUTHORIZATION_URL') . '?' . $query);
    }
}
