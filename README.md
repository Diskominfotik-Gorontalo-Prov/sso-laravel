[![Latest Stable Version](http://poser.pugx.org/aptika/sso-gorontalo/v)](https://packagist.org/packages/aptika/sso-gorontalo) [![Total Downloads](http://poser.pugx.org/aptika/sso-gorontalo/downloads)](https://packagist.org/packages/aptika/sso-gorontalo) [![Latest Unstable Version](http://poser.pugx.org/aptika/sso-gorontalo/v/unstable)](https://packagist.org/packages/aptika/sso-gorontalo) [![License](http://poser.pugx.org/aptika/sso-gorontalo/license)](https://packagist.org/packages/aptika/sso-gorontalo) [![PHP Version Require](http://poser.pugx.org/aptika/sso-gorontalo/require/php)](https://packagist.org/packages/aptika/sso-gorontalo)


# Custom SSO-client Package Provinsi Gorontalo
[SSO Gorontalo](https://sso.gorontaloprov.go.id)

Custom SSO package untuk mengintegrasikan Single Sign-On di aplikasi Laravel.
Install the package through [Composer](http://getcomposer.org/).
## Instalasi

Untuk menginstal package ini, gunakan Composer:

```sh
composer require aptika/sso-gorontalo
```

## Konfigurasi

1. **Tambahkan Service Provider**:

Tambahkan service provider ke dalam array `providers` di file `config/app.php`:

```php
'providers' => [
    // ...
    Aptika\SsoGorontalo\Providers\SSOServiceProvider::class,
],
```
Jika
Laravel 11
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
Update File `config/aptika-sso.php`

2. **Konfigurasi Environment**:

Pastikan untuk menambahkan variabel-variabel berikut di file `.env` Anda:

```env
APTIKA_SSO_CLIENT_ID=client-id
APTIKA_SSO_CLIENT_SECRET=client-secret
```

```env
APTIKA_SSO_APP_URL=url-sso
```

## Penggunaan

### Routes

Package ini menyediakan dua endpoint:

- **Login SSO**: `/login/sso-gorontalo`
- **Callback**: `/callback`

### Controller

Controller yang digunakan untuk mengelola SSO adalah `AuthController.php` yang berada di namespace `Aptika\SsoGorontalo\Controllers`.


```bash
composer dump-autoload
```


## Kontribusi

Jika Anda ingin berkontribusi pada package ini, silakan fork repository ini dan buat pull request.

