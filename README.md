# Tinder-like Backend (Laravel)

A simple backend API built with **Laravel** that manages people data:
- Name
- Age
- Pictures
- Location (latitude/longitude)

This is a beginner-friendly project — no authentication is required.

---

## 🚀 Features
- Add new people
- List all people with pagination
- Upload photos for people
- Serve stored photos with public URLs
- Git version control ready

---

## 🛠️ Requirements
- PHP >= 8.1
- Composer
- MySQL / MariaDB
- Git

---

## ⚡ Setup Instructions

### 1. Clone the project
```bash
git clone https://github.com/YOUR_USERNAME/tinder-backend.git
cd tinder-backend
2. Install dependencies
bash
Copy code
composer install
3. Setup environment
Copy the example file:

bash
Copy code
cp .env.example .env
Generate Laravel app key:

bash
Copy code
php artisan key:generate
4. Configure database
Update .env with your MySQL settings:

env
Copy code
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tinder
DB_USERNAME=root
DB_PASSWORD=
Create database in MySQL:

sql
Copy code
CREATE DATABASE tinder;
5. Run migrations
bash
Copy code
php artisan migrate
6. Storage link (for photos)
bash
Copy code
php artisan storage:link
7. Start development server
bash
Copy code
php artisan serve
Server runs at:
👉 http://127.0.0.1:8000

📡 API Endpoints
1. Create person
POST /api/people
Body (JSON):

json
Copy code
{
  "name": "Alice",
  "age": 25,
  "latitude": 28.61,
  "longitude": 77.20
}
2. List people (paginated)
GET /api/people

Example Response:

json
Copy code
{
  "current_page": 1,
  "data": [
    {
      "id": 1,
      "name": "Alice",
      "age": 25,
      "latitude": 28.61,
      "longitude": 77.20,
      "photos": [
        {
          "id": 1,
          "user_id": 1,
          "path": "photos/abcd.jpg",
          "url": "http://127.0.0.1:8000/storage/photos/abcd.jpg"
        }
      ]
    }
  ]
}
3. Upload photo
POST /api/users/{id}/photo
Form-data:

photo: (file upload)

Response:

json
Copy code
{
  "url": "http://127.0.0.1:8000/storage/photos/abcd.jpg",
  "photo": {
    "id": 1,
    "user_id": 1,
    "path": "photos/abcd.jpg"
  }
}
📝 Git Workflow
Initialize (already done in this repo)
bash
Copy code
git init
git remote add origin https://github.com/YOUR_USERNAME/tinder-backend.git
Commit changes
bash
Copy code
git add .
git commit -m "Meaningful commit message"
git push origin main