@echo off
echo ========================================
echo   MOZU - Jasuke Mozarella
echo   Menjalankan Server...
echo ========================================
echo.

cd "C:\laragon\www\Aplikasi MOZU\mozu"

echo Server akan berjalan di: http://localhost:8000
echo.
echo Akun Admin: admin@mozu.com / password
echo Akun Customer: customer@mozu.com / password
echo.
echo Tekan Ctrl+C untuk stop server
echo.
echo ========================================

php artisan serve

pause

