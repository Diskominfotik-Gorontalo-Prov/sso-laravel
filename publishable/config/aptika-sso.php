<?php
$url = env("APTIKA_SSO_APP_URL", "https://sso.gorontaloprov.go.id");

return [

    "client_id" => env("APTIKA_SSO_CLIENT_ID"),
    "client_secret" => env("APTIKA_SSO_CLIENT_SECRET"),
    "authorization_url" => $url . env("APTIKA_SSO_AUTHORIZATION_URL", "/oauth/authorize"),
    "access_token_url" => $url . env("APTIKA_SSO_ACCESS_TOKEN_URL", "/oauth/token"),
    "resource_url" =>  $url . env("APTIKA_SSO_RESOURCE_URL", "/api/v2/me"),
    "redirect_url" => env('APP_URL') . "/callback",
    "logout_url" => $url . env("APTIKA_SSO_LOGOUT_URL", "/logout"),
    "user_identifier" => env("APTIKA_SSO_USER_IDENTIFIER"),
    "scopes" => env("APTIKA_SSO_SCOPES"),

    "logo_url" => $url . env("APTIKA_SSO_LOGO_URL", "images/logo-small.png"),


    "route-login" => env("APTIKA_SSO_ROUTE_LOGIN", 'login'),
    "route-dashboard" => env("APTIKA_SSO_ROUTE_DASHBOARD", 'dashboard'),
    "model" => [
        "user" => "\\App\\Models\\User", // TeRAKAN DI MANA MODEL USER
    ],

    // data resource yang bisa di pakai
    // {
    //     "id": Number,
    //     "id_pegawai": String,
    //     "tipe_user": Number,
    //     "tipe_user_name": String,
    //     "nama": String,
    //     "nip": String|NULL,
    //     "nik": String|NULL,
    //     "email": String,
    //     "unorid": String|NULL,
    //     "unorname": String,
    //     "nomor_telepon": String,
    //     "gambar": String,
    //     "jabatan": String
    // }
    'data_resource' => [
        "id_pegawai" => "id_pegawai",
        "tipe_user" => "tipe_user",
        "tipe_user_name" => "tipe_user_name",
        "name" => "nama",
        "nip" => "nip",
        "nik" => "nik",
        "email" => "email",
        "unorid" => "unorid",
        "unorname" => "unorname",
        "nomor_telepon" => "nomor_telepon",
        "gambar" => "gambar",
        "jabatan" => "jabatan",
        "username" => "email",
    ],
    'data_resource_update' => [
        "name" => "nama",
        "email" => "email",
    ]

];
