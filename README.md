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

2. **Konfigurasi Environment**:

   Pastikan untuk menambahkan variabel-variabel berikut di file `.env` Anda:

   ```env
   CLIENT_ID=your-client-id
   CLIENT_SECRET=your-client-secret
   REDIRECT_URL=your-redirect-url
   AUTHORIZATION_URL=your-authorization-url
   ACCESS_TOKEN_URL=your-access-token-url
   RESOURCE_URL=your-resource-url
   ```

## Penggunaan

### Routes

Package ini menyediakan dua endpoint:

- **Login SSO**: `/login/sso`
- **Callback**: `/callback`

### Controller

Controller yang digunakan untuk mengelola SSO adalah `AuthController` yang berada di namespace `Vendor\CustomSSO\Controllers`.

### Contoh Penggunaan di Controller

Anda dapat menggunakan controller ini langsung di routes Anda atau memodifikasi sesuai kebutuhan.

```php
<?php

namespace App\Http\Controllers;

use Vendor\CustomSSO\Controllers\AuthController as BaseAuthController;
use Illuminate\Http\Request;

class AuthController extends BaseAuthController
{
    // Controller Anda sendiri atau extend dari BaseAuthController
}
```

### Menggunakan Routes

Pastikan untuk mendaftarkan route di `routes/web.php` Anda:

```php
Route::get('login/sso', [AuthController::class, 'sso'])->name('login.sso');
Route::get('callback', [AuthController::class, 'callback'])->name('callback.sso');
```

### Sinkronisasi User SSO

Fungsi `sinkronUserSSO` digunakan untuk sinkronisasi data user dari SSO:

```php
<?php

namespace Vendor\CustomSSO;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;

class SSO
{
    public function sinkronUserSSO($token)
    {
        try {
            $client = new Client();
            $headers = [
                'Authorization' => 'Bearer ' . $token
            ];
            $options = [
                'headers' => $headers,
            ];
            $request = $client->request('GET', env("RESOURCE_URL"),  $options);
            $data =  $request->getBody();
            $dataJson = json_decode($data, true);
            $dataUser = User::where('email', $dataJson['email'])->first();
            if (!$dataUser) {
                $dataUser = User::create([
                    'email' => $dataJson['email'],
                    'name' => $dataJson['nama'],
                    'avatar' => $dataJson['gambar'],
                    'email_verified_at' => now(),
                    'nip' => $dataJson['nip'],
                    'unor' => $dataJson['unorid'],
                    'nomor' => $dataJson['nomor'],
                    'password' => "",
                ]);
            } else {
                $dataUser->update([
                    'email' => $dataJson['email'],
                    'name' => $dataJson['nama'],
                    'avatar' => $dataJson['gambar'],
                    'nip' => $dataJson['nip'],
                    'unor' => $dataJson['unorid'],
                    'nomor' => $dataJson['nomor'],
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
            $data =  $request->getBody();
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
```

## Kontribusi

Jika Anda ingin berkontribusi pada package ini, silakan fork repository ini dan buat pull request.

## Lisensi

Package ini dirilis di bawah lisensi [MIT](LICENSE).
```

### Publikasikan ke GitHub dan Packagist

1. **Commit dan Push ke GitHub**:
   ```sh
   git add README.md
   git commit -m "Add README.md for documentation"
   git push origin master
   ```

2. **Daftarkan di Packagist**:
   - Jika Anda belum melakukannya, daftar di [Packagist](https://packagist.org/) dengan menggunakan URL repository GitHub Anda dan ikuti instruksi untuk menyelesaikan pendaftaran.

### Langkah Terakhir: Buat Release

1. **Buat Release di GitHub**:
   - Buka repository GitHub Anda, pergi ke tab "Releases", dan buat release baru untuk versi tertentu (misalnya v1.0.0).

Dengan langkah-langkah di atas, Anda telah berhasil membuat, mendokumentasikan, dan mempublikasikan package SSO custom Anda. Pengguna lain dapat menginstal dan menggunakan package ini dengan mudah berkat dokumentasi yang Anda sediakan.