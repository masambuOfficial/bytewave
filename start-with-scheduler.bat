@echo off
echo Starting Laravel with Scheduler...
echo.
echo This will run:
echo 1. Laravel development server on http://localhost:8000
echo 2. Task scheduler (checks every minute for scheduled tasks)
echo.
echo Press Ctrl+C to stop both processes
echo.

start "Laravel Server" cmd /k "cd /d %~dp0 && php artisan serve"
start "Laravel Scheduler" cmd /k "cd /d %~dp0 && :loop && php artisan schedule:run && timeout /t 60 /nobreak > nul && goto loop"

echo.
echo Both processes started in separate windows.
echo Close those windows to stop the services.
pause
