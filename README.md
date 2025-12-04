# AI Actor Profile Extractor

A Laravel application that leverages OpenAI to extract structured actor profiles (Name, Age, Address, Physical attributes) from unstructured natural language descriptions.

## Project Overview

Small Laravel project where users can submit information about an actor. The app
should validate input, process data with OpenAI API, save results in a database, and display
submissions.

### Key Features
- **AI Integration:** Uses OpenAI (GPT-4o-mini) to parse text and infer missing data (e.g., calculating age from birth year).
- **Robust Validation:** Validates both user input and AI response structure.
- **Data Integrity:** Prevents duplicate submissions via Email/Description checks.
- **Responsive UI:** Simple Bootstrap-based interface for submission and viewing results.

---

## 🏗 Architecture & Design Patterns

- **Service Layer (`App\Services`):** Handles interaction with the OpenAI API.
- **Action Classes (`App\Actions`):** Encapsulates single business logic units (e.g., `SubmitActorData`, `ListActors`).
- **DTOs (`App\DTO`):** Ensures strict typing for data transferred between the AI service and the application (no magic arrays).
- **Custom Exceptions:** `IncompleteActorDataException` handles specific business logic errors cleanly.
- **Prompt Engineering:** Logic for building prompts is isolated in a `PromptBuilderService`.

---

## 🛠 Tech Stack

- **Framework:** Laravel 12
- **Database:** MySQL / SQLite
- **AI Provider:** OpenAI API
- **Frontend:** Blade Templates + Bootstrap 5
- **Containerization:** Docker & Docker Compose

---

## ⚙️ Installation & Setup

Follow these steps to get the project running locally.

### 1. Clone the repository
```bash
git clone <your-repo-url>
cd zfort-laravel-app
```

### 2. Environment Configuration
```bash
cp .env.example .env
```

Open .env and add your OpenAI API Key:
```bash
OPENAI_API_KEY=sk-proj-xxxxxxxxxxxxxxxxxxxx
```

### 3. Build and Start Docker
```bash
docker-compose up -d --build
```

### 4. Install Dependencies
# Via Docker (recommended)
```bash
docker-compose exec app composer install
```

# Or locally
```bash
composer install
```

### 5. Application Setup
```bash
# Generate Key
docker-compose exec app php artisan key:generate

# Run Migrations
docker-compose exec app php artisan migrate
```

### 6. Running Tests
```bash
docker-compose exec app php artisan test
```
