# Zfort – Laravel App

## Requirements

Before running the project, make sure you have:

- **Docker** and **Docker Compose** installed
- **PHP** and **Composer** (optional, if you prefer running composer inside Docker)

---

## How to Run the Project

Clone the repository and navigate into the project directory:

```bash
git clone <your-repo-url>
cd zfort-laravel-app
```

1. Start Docker containers
```
docker-compose up -d --build
```
2. Install PHP dependencies
```
composer install
```
3. Run migrations
```
php artisan migrate
```

## Environment
Copy .env.example:
```
cp .env.example .env
```

Generate app key:
```
php artisan key:generate
```

Add OPENAI_API_KEY to .env file.:
