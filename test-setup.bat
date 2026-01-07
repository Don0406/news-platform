@echo off
echo === News Platform Setup Test ===
echo.

echo 1. Checking PHP version...
php --version
if errorlevel 1 (
    echo ERROR: PHP not found! Install PHP 8.0+
    pause
    exit /b 1
)

echo.
echo 2. Checking Composer...
composer --version
if errorlevel 1 (
    echo ERROR: Composer not found!
    pause
    exit /b 1
)

echo.
echo 3. Checking Node.js...
node --version
if errorlevel 1 (
    echo ERROR: Node.js not found!
    pause
    exit /b 1
)

echo.
echo 4. Checking npm...
npm --version
if errorlevel 1 (
    echo ERROR: npm not found!
    pause
    exit /b 1
)

echo.
echo === All checks passed! ===
echo.
echo Next steps for teammates:
echo 1. git clone https://github.com/YOUR_USERNAME/news-platform.git
echo 2. cd news-platform
echo 3. composer install
echo 4. npm install
echo 5. copy .env.example .env
echo 6. Edit .env with database settings
echo 7. php artisan key:generate
echo 8. php artisan migrate --seed
echo 9. npm run dev
echo 10. php artisan serve
echo.
echo Visit: http://localhost:8000
pause