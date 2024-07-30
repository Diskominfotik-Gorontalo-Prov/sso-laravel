<?php
$url = env("APTIKA_SSO_APP_URL", "https://sso.gorontaloprov.go.id"); // !!! url enpoint sso

return [

    "client_id" => env("APTIKA_SSO_CLIENT_ID"), // !!! client id
    "client_secret" => env("APTIKA_SSO_CLIENT_SECRET"), // !!! client secret
    "authorization_url" => $url . env("APTIKA_SSO_AUTHORIZATION_URL", "/oauth/authorize"), // url authorization
    "access_token_url" => $url . env("APTIKA_SSO_ACCESS_TOKEN_URL", "/oauth/token"), // url access token
    "resource_url" =>  $url . env("APTIKA_SSO_RESOURCE_URL", "/api/v2/me"), // url resource
    "redirect_url" => env('APP_URL') . "/callback", // url callback
    "logout_url" => $url . env("APTIKA_SSO_LOGOUT_URL", "/logout"), //url logout
    "user_identifier" => env("APTIKA_SSO_USER_IDENTIFIER"), // user identifier
    "scopes" => env("APTIKA_SSO_SCOPES"), // scopes
    "logo_url" => $url . env("APTIKA_SSO_LOGO_URL", "images/logo-small.png"), // url logo sso


    "route-login" => env("APTIKA_SSO_ROUTE_LOGIN", 'login'), // !!! route name login bila belum login
    "route-dashboard" => env("APTIKA_SSO_ROUTE_DASHBOARD", 'dashboard'), // !!! route name bila berhasil login
    "model" => [
        "user" => "\\App\\Models\\User", // Tempat DI MANA MODEL USER
    ],


    // !!! hasil dari data resource/profil login

    /* 
    {
        "id": Number,
        "id_pegawai": String,
        "tipe_user": Number,
        "tipe_user_name": String,
        "nama": String,
        "nip": String|NULL,
        "nik": String|NULL,
        "email": String,
        "unorid": String|NULL,
        "unorname": String,
        "nomor_telepon": String,
        "gambar": String,
        "jabatan": String
    }
    */

    // !!! resoucrce yang di pakai pertama kali login/ atau user belum terdaftar
    'data_resource' => [
        // "fild_table_user" => 'name_dari_profil_resorce',
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
        "nomor_identitas" => "nip"
    ],

    // !!! resoucrce yang di pakai saat user telah terdaftar
    'data_resource_update' => [
        // "fild_table_user" => 'name_dari_profil_resorce',
        "name" => "nama",
        "email" => "email",
        "username" => "email",
        "id_opd" => "unorid"
    ]

];
