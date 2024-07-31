[![Latest Stable Version](http://poser.pugx.org/aptika/sso-gorontalo/v)](https://packagist.org/packages/aptika/sso-gorontalo) [![Total Downloads](http://poser.pugx.org/aptika/sso-gorontalo/downloads)](https://packagist.org/packages/aptika/sso-gorontalo) [![Latest Unstable Version](http://poser.pugx.org/aptika/sso-gorontalo/v/unstable)](https://packagist.org/packages/aptika/sso-gorontalo) [![License](http://poser.pugx.org/aptika/sso-gorontalo/license)](https://packagist.org/packages/aptika/sso-gorontalo) [![PHP Version Require](http://poser.pugx.org/aptika/sso-gorontalo/require/php)](https://packagist.org/packages/aptika/sso-gorontalo)

# Custom SSO-client Package Provinsi Gorontalo

[SSO Gorontalo](https://sso.gorontaloprov.go.id)

Custom SSO package untuk mengintegrasikan Single Sign-On di aplikasi Laravel.
Install the package through [Composer](http://getcomposer.org/).

## Installasi

Untuk menginstall package ini, gunakan Composer:

```sh
composer require aptika/sso-gorontalo
```

## Konfigurasi

1. **Tambahkan Service Provider**:

untuk Laravel < 11
Tambahkan service provider ke dalam array `providers` di file `config/app.php`:

```php
'providers' => [
    // ...
    Aptika\SsoGorontalo\Providers\SSOServiceProvider::class,
],
```

dan untuk laravel >= 11
`bootstrap/providers.php`

```php
return [
    // ...
    Aptika\SsoGorontalo\Providers\SSOServiceProvider::class,
];

```

Jalankan Perintah

```bash
php artisan vendor:publish --provider="Aptika\SsoGorontalo\Providers\SSOServiceProvider" --tag=config
```

2. **Konfigurasi Config**:

Update File `config/aptika-sso.php`

3. **Konfigurasi Environment**:

Pastikan untuk menambahkan variabel-variabel berikut di file `.env` Anda:

```env
APTIKA_SSO_CLIENT_ID=client-id
APTIKA_SSO_CLIENT_SECRET=client-secret
```

```env
APTIKA_SSO_APP_URL=url-sso
```


## Penggajuan APTIKA_SSO_CLIENT_ID dan APTIKA_SSO_CLIENT_SECRET silakan request di aplikasi [Layanan](https://layanan.gorontaloprov.go.id/) 
untuk pengujian development

```env
...

APP_URL="http://localhost:8001"
APTIKA_SSO_CLIENT_ID=10
APTIKA_SSO_CLIENT_SECRET="dCOWTcxFlRdeGnJZ1kRmGq41F25HB7jIFX1iHgde"
APTIKA_SSO_APP_URL="https://dev1.gorontaloprov.go.id"

...

```
### Jalankan aplikasi di server port 8001
```bash
php artisan serve --port=8001
```

### Routes

Package ini menyediakan dua endpoint:

-   **Login SSO**: `/login/sso-gorontalo` name = "aptika.sso.login"
-   **Callback**: `/callback`

4. **Konfigurasi Tombol Frontend**:

### Tombol Login SSO

```html
<a href="{{ route('aptika.sso.login') }}"> Login Dengan SSO</a>
```

### Logo SSO

```html
<img src="{{ config('aptika-sso.logo_url') }}"/>
```

5. **Logout dari aplikasi SSO**
   buat route untuk logout dan buat fungsi berikut saat proses logout

```php

 Auth::logout();
 //  ... tambhkan fungi di bawah ini saat melakukan logout
 return redirect(config('aptika-sso.logout_url') . '?redirect=' . route(config('aptika-sso.route-login')));
```
---

```bash
composer dump-autoload
```

## Kontribusi

Jika Anda ingin berkontribusi pada package ini, silakan fork repository ini dan buat pull request.
