# Travel Booking Platform - An Online Tour Booking 
<div align="center">

[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com/)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Redis](https://img.shields.io/badge/Redis-DC382D?style=for-the-badge&logo=redis&logoColor=white)](https://redis.io/)
[![Stripe](https://img.shields.io/badge/Stripe-008CFF?style=for-the-badge&logo=stripe&logoColor=white)](https://stripe.com/)
<!-- [![AWS](https://img.shields.io/badge/AWS-232F3E?style=for-the-badge&logo=amazon-aws&logoColor=white)](https://aws.amazon.com/) -->


[![Build Status](https://img.shields.io/github/actions/workflow/status/HoangfLong/travel-booking-web/ci-cd.yml?style=flat-square&logo=github)](https://github.com/HoangfLong/travel-booking-web/actions)
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
[![Version](https://img.shields.io/badge/version-1.0.0-green.svg?style=flat-square)](#)
[![Contributors](https://img.shields.io/github/contributors/HoangfLong/travel-booking-web?style=flat-square)](https://github.com/HoangfLong/travel-booking-web/graphs/contributors)
![First Commit](https://img.shields.io/github/created-at/HoangfLong/travel-booking-web?style=flat-square&label=First%20Commit)
![Last Commit](https://img.shields.io/github/last-commit/HoangfLong/travel-booking-web?style=flat-square)

</div>

The Travel Booking Platform is a comprehensive web application designed to provide online tour booking services. The project is built with a clean architecture, high performance, and scalability in mind, serving both end-users and administrators.

---

## 📋 Table of Contents

- [Travel Booking Platform - An Online Tour Booking](#travel-booking-platform---an-online-tour-booking)
  - [📋 Table of Contents](#-table-of-contents)
  - [✨ Key Features](#-key-features)
  - [🚀 Technologies Used](#-technologies-used)
  - [🏗️ Project Structure](#️-project-structure)
    - [Key Components](#key-components)
    - [Design Patterns](#design-patterns)
  - [📚 API Documentation](#-api-documentation)
    - [Authentication \& User Management](#authentication--user-management)
    - [Tour Management](#tour-management)
    - [Booking \& Payment Management](#booking--payment-management)
    - [Authentication](#authentication)
  - [🚀 Quick Start Guide](#-quick-start-guide)
    - [System Requirements](#system-requirements)
    - [Installation](#installation)
  - [🗺️ Development Roadmap \& Architecture](#️-development-roadmap--architecture)
    - [Current Development](#current-development)
    - [System Architecture](#system-architecture)
    - [Infrastructure Plans](#infrastructure-plans)

---

## ✨ Key Features

* **Tour & User Management:**
    * Full **CRUD** functionality for tours, users.
    * **Soft Delete** (move to trash), **Hard Delete** (permanent removal), and **Restore** (recover from trash)

* **RESTful API:**
    * Provides a **RESTful API** to support potential future integrations with mobile applications or a separate Single Page Application (SPA).
    * API endpoints are secured with **Laravel Sanctum** and **role-based authentication**.

* **Customer-Facing Features:**
    * **Advanced Search & Filtering:** Users can effortlessly search for tours by keywords and filter results by **location** and **price**.
    * **Social Login:** **Laravel Socialite** is integrated for quick registration and login using **Google** and **Facebook** accounts.

* **Admin Dashboard:**
    * An intuitive administration panel to track monthly/yearly revenue.
    * Efficiently manage all users, tours, and bookings.

* **Performance & Code Architecture:**
    * **Redis caching** is used to optimize query performance and reduce server load.
    * Email and other background tasks are handled asynchronously via **Redis queues** to improve user experience.
    * The project adopts the **Repository & Service Pattern** to decouple business logic, making the code highly maintainable and scalable.

---

## 🚀 Technologies Used

| Category | Technology | Description & Rationale |
| :--- | :--- | :--- |
| **Architecture** | **MVC** | A standard architectural pattern that separates logic, presentation, and data. |
| **Backend** | **Laravel 11.x** | A powerful PHP framework known for its elegant syntax and rich ecosystem, which significantly accelerates development. |
| **Frontend** | **Blade, Bootstrap** | Blade is Laravel's native templating engine, combined with Bootstrap for building a responsive and clean UI. |
| **Database** | **MySQL** | A reliable and widely-used relational database management system. |
| **Authentication** | **Laravel Breeze, Socialite, Sanctum** | Provides a complete, secure, and flexible authentication system for both web and API usage. |
| **Tools** | **Redis, Stripe API, Postman** | Redis for caching and queue management. Stripe for payment processing. Postman for API testing. |
| **DevOps** | **Git, Gitflow** | Used for version control and a structured development workflow. |

---

## 🏗️ Project Structure

```
BE/
├── app/                   # Core application code
│   ├── Http/              # HTTP layer (Controllers, Middleware, Requests)
│   ├── Models/            # Eloquent models
│   ├── Services/          # Business logic services
│   ├── Repositories/      # Data access layer
│   ├── Interfaces/        # Repository interfaces
│   ├── Jobs/              # Background jobs and queue processing
│   └── Mail/              # Mail templates and notifications
├── config/                # Configuration files
├── database/            
│   ├── migrations/        # Database migrations
│   ├── factories/         # Model factories for testing
│   └── seeders/           # Database seeders
├── resources/
│   ├── views/             # Blade templates
│   ├── js/                # JavaScript files
│   └── css/               # CSS files
├── routes/              
│   ├── api.php            # API routes
│   └── web.php            # Web routes
├── storage/               # Uploaded files, logs, cache
├── tests/                 # Test files
│   ├── Unit/              # Unit tests
│   └── Feature/           # Feature tests
└── vendor/                # Composer dependencies
```

### Key Components

1. **HTTP Layer (`app/Http/`)**
   - `Controllers/`: Handle HTTP requests and responses
   - `Middleware/`: Request filters and modifications
   - `Requests/`: Form validation and authorization

2. **Business Logic (`app/Services/`)**
   - Implements core business rules
   - Coordinates between controllers and repositories
   - Handles complex operations and transactions

3. **Data Access (`app/Repositories/`)**
   - Implements database operations
   - Follows Repository Pattern for data abstraction
   - Implements caching strategies

4. **Models (`app/Models/`)**
   - Eloquent models with relationships and scopes
   - Handles data attributes and casting
   - Contains model-specific business rules

5. **Jobs (`app/Jobs/`)**
   - Background job processing
   - Asynchronous task handling
   - Email queue management

6. **Mail (`app/Mail/`)**
   - Email templates and formatting
   - Notification management
   - Mailable classes for different types of emails

### Design Patterns

- **Repository Pattern**: Separates data access logic
- **Service Layer**: Encapsulates business logic
- **Factory Pattern**: Used in database seeding and testing
- **Observer Pattern**: For handling model events

## 📚 API Documentation

### Authentication & User Management

```bash
# Authentication
POST   /api/v1/register                # Register new user
POST   /api/v1/login                   # User login
POST   /api/v1/logout                  # User logout (requires auth)
GET    /api/v1/verify-email/{id}/{hash}# Verify email address
POST   /api/v1/email/resend           # Resend verification email

# User Profile (requires auth + user role)
GET    /api/v1/user/profile           # Get user profile
PUT    /api/v1/user/profile           # Update user profile
DELETE /api/v1/user/profile           # Delete user account
```

### Tour Management

```
# Basic CRUD Operations
GET    /api/v1/tours                # List all active tours
POST   /api/v1/tours/create         # Create new tour
GET    /api/v1/tours/{id}           # Get tour details
PUT    /api/v1/tours/{id}           # Update tour
DELETE /api/v1/tours/{id}           # Soft delete tour

# Trash Management
GET    /api/v1/tours/trashed        # List all soft-deleted tours
POST   /api/v1/tours/restore/{id}   # Restore a soft-deleted tour
DELETE /api/v1/tours/force/{id}     # Permanently delete tour

# Additional Operations
GET    /api/v1/tours/all            # List all tours (including soft-deleted)
GET    /api/v1/tours/search         # Search and filter tours
```

Example Response for Trash Items:
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "title": "Mountain Trek Tour",
            "deleted_at": "2025-09-15 10:30:00",
            "can_restore": true
        }
    ],
    "message": "Trashed tours retrieved successfully"
}
```

### Booking & Payment Management

```bash
# User Bookings (requires auth + user role)
GET    /api/v1/user/bookings          # List user's bookings
GET    /api/v1/user/bookings/{id}     # Get booking details

# Admin Booking Management (requires auth + admin role)
GET    /api/v1/admin/bookings         # List all bookings
GET    /api/v1/admin/bookings/{id}    # Get booking details

# Payment Processing (requires auth)
POST   /api/v1/payments/checkout/{tourId} # Initialize payment
POST   /api/v1/payments/success          # Handle successful payment
POST   /api/v1/payments/cancel/{tourId}  # Handle cancelled payment

### Admin Dashboard

```bash
# Admin Analytics (requires auth + admin role)
GET    /api/v1/admin/dashboard        # Get dashboard statistics
GET    /api/v1/admin/users/management # List all users
GET    /api/v1/admin/users/management/{id} # Get user details
```

### Authentication

All API endpoints except `/login` and `/register` require authentication using Bearer token:

```
Authorization: Bearer <your_token_here>
```

## 🚀 Quick Start Guide

### System Requirements
* PHP >= 8.2
* Composer
* Node.js & npm
* MySQL
* Redis

### Installation

1. **Clone the repository:**
    ```bash
    git clone https://github.com/HoangfLong/travel-booking-web.git
    cd travel-booking-web/BE
    ```

2. **Set up development environment:**
    - Install PHP 8.2 or higher
    - Install Composer globally
    - Install Node.js and npm
    - Install and start MySQL server
    - Install and start Redis server

3. **Install dependencies:**
    ```bash
    composer install            # Install PHP dependencies
    npm install                # Install Node.js dependencies
    npm run build             # Build frontend assets
    ```

4. **Configure Environment Variables:**
    ```bash
    cp .env.example .env      # Create .env file
    ```
    Update the following in `.env`:
    ```ini
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password

    QUEUE_CONNECTION=redis

    REDIS_HOST=127.0.0.1
    REDIS_PASSWORD=null
    REDIS_PORT=6379
    
    STRIPE_KEY=your_stripe_public_key
    STRIPE_SECRET=your_stripe_secret_key
    ```

5. **Initialize the Application:**
    ```bash
    php artisan key:generate   # Generate app encryption key
    php artisan storage:link   # Create storage symlink
    php artisan migrate       # Run database migrations
?      # Seed the database with demo data
    ```

6. **Start Services:**
    ```bash
    # In separate terminal windows:
    php artisan serve         # Start development server
    php artisan queue:work redis # Start queue worker
    ```

## 🗺️ Development Roadmap & Architecture

### Current Development

* **Frontend Repository:** The React frontend is being developed separately at [travel-booking-web-fe](https://github.com/HoangfLong/travel-booking-fe)
* **Backend Repository:** This repository serves as the API backend
* **Development Status:** Active development, targeting Q4 2025 for initial release

### System Architecture

`picture here`

### Infrastructure Plans

* **Current Setup:**
  - Local development environment
  - Manual deployments
  - Single server architecture

* **Target AWS Architecture:**
  - **Load Balancing:** AWS Application Load Balancer
  - **Compute:** EC2 Auto Scaling Group
  - **Database:** Amazon RDS Multi-AZ
  - **Caching:** Amazon ElastiCache for Redis
  - **Storage:** Amazon S3 for media files
  - **CDN:** CloudFront for static assets
  - **Monitoring:** CloudWatch + Laravel Telescope