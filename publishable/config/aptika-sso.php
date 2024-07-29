<?php

return [
    "route-login" => env("APTIKA_SSO_ROUTE_LOGIN", 'login'),
    "route-dasboard" => env("APTIKA_SSO_ROUTE_DASHBOARD", 'dashboard'),
    "model" => [
        "user" => "App\Models\User",
    ],


    // {
    //     "id": "",
    //     "id_pegawai": "",
    //     "tipe_user": Number,
    //     "tipe_user_name": "",
    //     "nama": "",
    //     "nip": null,
    //     "nik": null,
    //     "email": "",
    //     "unorid": null,
    //     "unorname": "",
    //     "nomor_telepon": "",
    //     "gambar": "url",
    //     "jabatan": ""
    // }
    'data_resource' => [
        "id" => "user_id",
        "id_pegawai" => "id_pegawai",
        "tipe_user" => "tipe_user",
        "tipe_user_name" => "tipe_user_name",
        "nama" => "nama",
        "nip" => "nip",
        "nik" => "nik",
        "email" => "email",
        "unorid" => "unorid",
        "unorname" => "unorname",
        "nomor_telepon" => "nomor_telepon",
        "gambar" => "gambar",
        "jabatan" => "jabatan",
    ]
];
