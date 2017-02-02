# Hướng dẫn cài đặt

1. Cài đặt laravel
2. Chạy lệnh composer require vdhoangson/pen-test hoặc thêm trực tiếp vào file composer.json "vdhoangson/pen-test":"1.0"
3. Chạy lệnh composer update
4. Sửa file config/app.php thêm vào providers PenFramework\Providers\PenFrameworkServiceProvider::class,
5. Sửa file config/auth.php 'model' => App\User::class, thành 'model' => App\PenCMS\Models\Admin\User\User::class,
6. Chạy lệnh php artisan vendor:publish
7. Import file sql trong app/pencms/db

Truy cập đường dẫn yourdomain.com/en/admin
