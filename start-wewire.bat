@echo off
title WeWire - Lancement du projet
color 0A

echo ============================================
echo      LANCEMENT DU PROJET WEWIRE
echo ============================================
echo.

REM ---- Verifier si MySQL tourne deja ----
echo [1/3] Demarrage de MySQL...
C:\xampp\mysql\bin\mysql.exe -u root -e "SELECT 1;" >nul 2>&1
IF %ERRORLEVEL% NEQ 0 (
    START "MySQL" /MIN C:\xampp\mysql\bin\mysqld.exe --console
    timeout /t 4 /nobreak >nul
    echo      MySQL demarre OK
) ELSE (
    echo      MySQL deja actif
)

REM ---- Creer la base si elle n'existe pas ----
C:\xampp\mysql\bin\mysql.exe -u root -e "CREATE DATABASE IF NOT EXISTS wewire1 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;" >nul 2>&1

REM ---- Verifier si Apache tourne deja ----
echo [2/3] Demarrage d'Apache...
netstat -ano | findstr ":8080" >nul 2>&1
IF %ERRORLEVEL% NEQ 0 (
    START "Apache" /MIN C:\xampp\apache\bin\httpd.exe
    timeout /t 3 /nobreak >nul
    echo      Apache demarre OK
) ELSE (
    echo      Apache deja actif sur port 8080
)

REM ---- Migrations ----
echo [3/3] Verification des migrations...
C:\xampp\php\php.exe artisan migrate --force >nul 2>&1
echo      Migrations OK

echo.
echo ============================================
echo  PROJET PRET !
echo  Ouvre : http://localhost:8080
echo  Login : admin@wewire.com
echo  Pass  : password123
echo ============================================
echo.

REM ---- Ouvrir le navigateur ----
timeout /t 2 /nobreak >nul
start http://localhost:8080/login

echo Appuie sur une touche pour fermer...
pause >nul
