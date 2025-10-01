# Tinder Backend (Laravel)

A simple Tinder-like API built with Laravel.  
Supports people data, photo uploads, swipe actions (like/dislike), liked list, and scheduled tasks for popular users.  

---

## 🚀 Features
- People management (name, age, location, photos)
- Upload profile photos
- Swipe functionality (like/dislike)
- Liked people list
- Swagger API docs
- Cron job for popular users

---

## 🛠️ Requirements
- PHP >= 8.1
- Composer
- MySQL (or SQLite for dev)
- Laravel 10

---

## ⚙️ Setup

```bash
# clone repo
git clone https://github.com/purvesh5159/tinder-backend.git
cd tinder-backend

# install dependencies
composer install

# copy environment file
cp .env.example .env

# generate key
php artisan key:generate

# configure .env (DB, APP_URL etc.)
# DB_DATABASE=tinder
# DB_USERNAME=root
# DB_PASSWORD=

# run migrations
php artisan migrate

# create storage symlink (for photos)
php artisan storage:link

Run Server
php artisan serve


Server runs at: http://127.0.0.1:8000

📸 API Endpoints

GET /api/people → list people

POST /api/people → create person

POST /api/users/{id}/photo → upload photo

POST /api/people/{id}/like → like a person

POST /api/people/{id}/dislike → dislike a person

GET /api/people/liked?user_id=1 → liked people list

📖 API Docs (Swagger)

Visit:

http://127.0.0.1:8000/api/documentation

⏰ Scheduler / Cron

Popular users check runs daily. Add to crontab:

* * * * * cd /path/to/tinder-backend && php artisan schedule:run >> /dev/null 2>&1