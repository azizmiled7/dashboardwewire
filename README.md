# WeWire - Système de Gestion des Interventions

## 🚀 Lancer le projet (XAMPP)

### ✅ Prérequis
- XAMPP installé dans `C:\xampp`
- Git (pour cloner)

---

## 📦 Installation depuis GitHub (première fois)

```cmd
cd C:\xampp\htdocs
git clone https://github.com/azizmiled7/dashboardwewire.git wewire
cd wewire
copy .env.example .env
```

Puis modifier `.env` :
```
DB_DATABASE=wewire1
DB_USERNAME=root
DB_PASSWORD=
APP_URL=http://localhost:8080
```

Installer les dépendances :
```cmd
composer install
php artisan key:generate
```

---

## ▶️ Lancer le projet (à chaque fois)

### Méthode 1 — Double-clic sur le script
> Exécuter le fichier **`start-wewire.bat`** à la racine du projet

### Méthode 2 — CMD manuellement
```cmd
REM 1. Démarrer MySQL
C:\xampp\mysql\bin\mysqld.exe --console

REM 2. Démarrer Apache (autre terminal)
C:\xampp\apache\bin\httpd.exe

REM 3. Ouvrir dans le navigateur
start http://localhost:8080
```

---

## 🌐 URL du projet
```
http://localhost:8080
```

## 🔑 Compte par défaut
| Email | Mot de passe | Rôle |
|-------|-------------|------|
| admin@wewire.com | password123 | Admin |

---

## 📁 Structure principale
```
app/
  Http/Controllers/
    ChatController.php        ← Chat temps réel
    DashboardController.php   ← Stats dashboard
    InterventionController.php
    MaterielController.php
    UserController.php
  Models/
    User.php / Intervention.php / Materiel.php / Message.php

resources/views/
    dashboardadmin.blade.php  ← Dashboard admin avec graphiques
    dashboardtech.blade.php   ← Dashboard technicien
    affectation.blade.php     ← Affectation interventions
    contact.blade.php         ← Chat temps réel
    create.blade.php          ← Déclarer intervention
```

---

## 🗄️ Base de données
```cmd
C:\xampp\mysql\bin\mysql.exe -u root -e "CREATE DATABASE IF NOT EXISTS wewire1;"
C:\xampp\php\php.exe artisan migrate
C:\xampp\php\php.exe artisan db:seed
```
