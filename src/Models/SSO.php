<?php

namespace Aptika\SsoGorontalo\Models;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SSO
{

    private function sinkronUserSSO($token)
    {
        try {
            $client = new Client();
            $headers = [
                'Authorization' => 'Bearer ' . $token
            ];
            $options = [
                'headers' => $headers,
            ];
            $request = $client->request('GET', config('aptika-sso.resource_url'),  $options);
            $data =  $request->getBody(); // Cetak permintaan HTTP untuk di-debug
            $dataJson = json_decode($data, true);
            $dataUser = app(config('aptika-sso.model.user'))->where(
                config("aptika-sso.data_resource.email"),
                $dataJson['email']
            )->first();

            if (!$dataUser) {
                $dataTampungResource = [];
                $configresource = config("aptika-sso.data_resource");
                foreach ($configresource as $key1 => $value1) {
                    $dataTampungResource[$key1] =  $dataJson[$value1];
                }
                $dataTampungResource['email_verified_at'] =  now();
                $dataTampungResource['password'] =  '';
                $dataUser = app(config('aptika-sso.model.user'))->create($dataTampungResource);
            } else {
                $dataTampungResourceUpdate = [];
                $configresource = config("aptika-sso.data_resource_update");
                foreach ($configresource as $key1 => $value1) {
                    $dataTampungResourceUpdate[$key1] =  $dataJson[$value1];
                }
                $dataTampungResourceUpdate['password'] =  '';
                $dataUser->update($dataTampungResourceUpdate);
            }

            if (Auth::guest()) {
                Auth::login($dataUser);
            }
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
                    'client_id' => config('aptika-sso.client_id'),
                    'client_secret' => config('aptika-sso.client_secret'),
                    'redirect_uri' => config('aptika-sso.redirect_url'),
                    'code' => $code,
                    'grant_type' => 'authorization_code'
                ]
            ];
            $request = $client->request('POST', config('aptika-sso.access_token_url'),  $options);
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
            'client_id' => config('aptika-sso.client_id'),
            'redirect_uri' => config('aptika-sso.redirect_url'),
        ]);
        return redirect(config('aptika-sso.authorization_url') . '?' . $query);
    }
}
