Untuk membuat dokumentasi yang baik untuk package custom SSO Anda, Anda harus menyertakan informasi penting tentang cara instalasi, penggunaan, konfigurasi, dan contoh-contoh kode. Dokumentasi ini biasanya diletakkan di file `README.md` di root proyek Anda. Berikut adalah contoh template untuk dokumentasi package Anda:

### README.md

```markdown
# Custom SSO Package

Custom SSO package untuk mengintegrasikan Single Sign-On di aplikasi Laravel.

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
```bash
php artisan vendor:publish --provider="Aptika\SsoGorontalo\Providers\SSOServiceProvider" --tag=config
```

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

- **Login SSO**: `/login/sso`
- **Callback**: `/callback`

### Controller

Controller yang digunakan untuk mengelola SSO adalah `AuthController` yang berada di namespace `Aptika\SsoGorontalo\Controllers`.


```bash
composer dump-autoload
```
### Contoh Penggunaan di Controller

Anda dapat menggunakan controller ini langsung di routes Anda atau memodifikasi sesuai kebutuhan.


## Kontribusi

Jika Anda ingin berkontribusi pada package ini, silakan fork repository ini dan buat pull request.

## Lisensi

Package ini dirilis di bawah lisensi [MIT](LICENSE).

