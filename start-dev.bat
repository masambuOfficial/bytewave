@echo off
echo Starting BYTEWAVE Development Servers...
echo.
echo This will start:
echo 1. Vite Dev Server (for Tailwind CSS)
echo 2. Laravel Development Server
echo.
echo Access your site at: http://localhost:8000
echo.
start cmd /k "npm run dev"
timeout /t 3 /nobreak >nul
start cmd /k "php artisan serve"
echo.
echo Both servers are starting in separate windows...
echo Press any key to close this window.
pause >nul
