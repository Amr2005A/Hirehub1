# HireHub 🚀

A full-featured freelancing platform REST API built with **Laravel 12**, connecting clients with freelancers through project postings, offers, and reviews.

---

## 📋 Table of Contents

- [About the Project](#about-the-project)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
- [API Endpoints](#api-endpoints)
- [Authentication](#authentication)
- [Database Structure](#database-structure)
- [Project Structure](#project-structure)
- [License](#license)

---

## About the Project

HireHub is a RESTful API platform designed to connect **clients** who post projects with **freelancers** who submit offers. The platform supports user profiles, skill tagging, reviews, budget filtering, and email verification — providing the core backbone of a modern freelancing marketplace.

---

## ✨ Features

- 🔐 **Authentication** via Laravel Sanctum (register, login, logout, token-based)
- ✉️ **Email Verification** with resend support
- 👤 **User Profiles** with image upload and availability status
- 📁 **Projects** — create, update, delete, and filter by budget or date
- 💼 **Offers** — freelancers can submit and manage offers on projects
- ⭐ **Reviews** — rate users and projects with a polymorphic review system
- 🏷️ **Tags & Skills** — project tagging and freelancer skill management
- 🌍 **Countries & Cities** — location-aware user profiles
- 📊 **Request Logging** — all API requests are logged via custom middleware
- 🔭 **Laravel Telescope** — built-in debugging and monitoring

---

## 🛠️ Tech Stack

| Layer | Technology |
|---|---|
| Framework | Laravel 12 |
| Auth | Laravel Sanctum |
| PHP | ^8.2 |
| Database | MySQL / SQLite |
| Monitoring | Laravel Telescope |
| Testing | PHPUnit 11 |
| Frontend Build | Vite + Node.js |

---

## 🚀 Getting Started

### Prerequisites

- PHP >= 8.2
- Composer
- Node.js & npm
- MySQL or SQLite

### Installation

1. **Clone the repository**

```bash
git clone https://github.com/Amr2005A/Hirehub1.git
cd Hirehub1
```

2. **Run the setup script** (installs all dependencies, generates key, runs migrations)

```bash
composer run setup
```

Or manually:

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
npm install && npm run build
```

3. **Configure your `.env` file**

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hirehub
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=your-mail-host
MAIL_PORT=587
MAIL_USERNAME=your@email.com
MAIL_PASSWORD=your-password
```

4. **Start the development server**

```bash
composer run dev
```

This will concurrently run the Laravel server, queue listener, Pail log viewer, and Vite.

---

## 📡 API Endpoints

### Public Routes

| Method | Endpoint | Description |
|---|---|---|
| POST | `/api/register` | Register a new user |
| POST | `/api/login` | Login and get access token |
| GET | `/api/logs` | View request logs (paginated) |

### Authenticated Routes (requires `Bearer Token`)

#### User & Profile
| Method | Endpoint | Description |
|---|---|---|
| POST | `/api/logout` | Logout current session |
| GET | `/api/user` | Get authenticated user |
| GET | `/api/userprofile/{id}` | View a user profile |
| POST | `/api/userprofile/image` | Upload profile image |
| PUT | `/api/updateuserprofile` | Update profile *(requires verified email)* |
| GET | `/api/showavaliableusers` | List available freelancers |
| GET | `/api/resent-email` | Resend verification email |

#### Projects
| Method | Endpoint | Description |
|---|---|---|
| GET | `/api/projects` | List all open projects |
| POST | `/api/projects` | Create a project |
| GET | `/api/projects/{id}` | Show a project |
| PUT | `/api/projects/{id}` | Update a project |
| DELETE | `/api/projects/{id}` | Delete a project |
| GET | `/api/budgetfilter/{value}` | Filter projects by budget |
| GET | `/api/thismonthfilter` | Projects posted this month |

#### Offers
| Method | Endpoint | Description |
|---|---|---|
| POST | `/api/offers` | Submit an offer *(requires verified email)* |
| GET | `/api/offers` | List offers |
| GET | `/api/offers/{id}` | Show an offer |
| PUT | `/api/offers/{id}` | Update an offer |
| DELETE | `/api/offers/{id}` | Delete an offer |

#### Reviews
| Method | Endpoint | Description |
|---|---|---|
| POST | `/api/userreview/{id}` | Review a user |
| POST | `/api/projectreview/{id}` | Review a project |

#### Locations
| Method | Endpoint | Description |
|---|---|---|
| GET/POST | `/api/countries` | List or create countries |
| GET/PUT/DELETE | `/api/countries/{id}` | Manage a country |
| GET/POST | `/api/cities` | List or create cities |
| GET/PUT/DELETE | `/api/cities/{id}` | Manage a city |

---

## 🔐 Authentication

HireHub uses **Laravel Sanctum** for token-based API authentication.

**Register:**
```json
POST /api/register
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password",
  "password_confirmation": "password",
  "role_id": 2
}
```

**Login:**
```json
POST /api/login
{
  "email": "john@example.com",
  "password": "password"
}
```

**Response:**
```json
{
  "access_token": "1|abc123...",
  "message": "User logged in successfully"
}
```

Use the token in all subsequent requests:
```
Authorization: Bearer YOUR_TOKEN_HERE
```

> ⚠️ Some actions (creating offers, updating profiles) require **email verification**.

---

## 🗄️ Database Structure

| Table | Description |
|---|---|
| `users` | Core user accounts with roles and city |
| `user_profiles` | Extended profile: bio, image, availability, skills |
| `roles` | User roles (client / freelancer) |
| `projects` | Client-posted projects with budget and status |
| `offers` | Freelancer bids on projects |
| `reviews` | Polymorphic reviews for users and projects |
| `skills` | Skills catalog linked to freelancer profiles |
| `tags` | Tags linked to projects |
| `countries` / `cities` | Location data |
| `request_logs` | Logged API requests via middleware |
| `personal_access_tokens` | Sanctum auth tokens |

---

## 🗂️ Project Structure

```
app/
├── Http/
│   ├── Controllers/      # UserController, ProjectController, OfferController...
│   ├── Middleware/        # LogRequest (request logging)
│   ├── Requests/          # Form Request validation classes
│   └── Resources/         # API Resource transformers
├── Models/                # Eloquent models
├── Policies/              # Authorization policies
└── Providers/             # AppServiceProvider, TelescopeServiceProvider

database/
├── migrations/            # All table migrations
├── seeders/               # Seeders for roles, skills, tags, countries...
└── factories/             # UserFactory

routes/
└── api.php                # All API route definitions
```

---

## 🧪 Running Tests

```bash
composer run test
```

---

## 📜 License

This project is open-source and available under the [MIT License](LICENSE).

---

> Built with ❤️ using Laravel 12
