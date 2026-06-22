# Nathalie's Bakeshop

A full-stack e-commerce website for a Filipino-Canadian home bakery based in Québec, Canada. Customers can browse the menu, add items to cart, place demo orders, and request custom cakes. An admin dashboard supports day-to-day shop management.

**Live demo:** [nathaliesbakeshop.onrender.com](https://nathaliesbakeshop.onrender.com)

---

## Overview

This project was built as a portfolio piece demonstrating end-to-end web development: from database design and RESTful routing to a responsive storefront and a protected admin area. The brand focuses on Filipino baked goods—empanadas, ube pies, kakanin, and custom celebration cakes.

---

## Features

### Storefront
- Home page with featured products and brand story
- Menu with category filters and search
- Product detail pages with variant selection
- Shopping cart (Pinia) with add-to-cart and buy-now flows
- Demo checkout and order confirmation
- Custom cake inquiry form with image upload
- About and contact pages

### Admin dashboard
- Product and category management (CRUD)
- Order tracking and status updates
- Custom cake inquiry review workflow
- Role-based access (`admin` middleware)

### Engineering
- SQLite for local development, PostgreSQL in production
- Database migrations and seeders with sample catalog
- PHPUnit feature tests (orders, inquiries, admin auth)
- Docker deployment on Render (PHP 8.3)

---

## Tech stack

| Layer | Technologies |
|-------|----------------|
| Backend | PHP 8.3, Laravel 13, Inertia.js |
| Frontend | Vue 3, Tailwind CSS, Pinia, Vite |
| Database | SQLite (local) / PostgreSQL (production) |
| Auth | Laravel Breeze |
| Deployment | Docker, Render |

---

## Getting started

### Requirements
- PHP 8.3+
- Composer
- Node.js 20+
- SQLite (enabled in PHP)

### Installation

```bash
git clone https://github.com/DarivsXP/nathaliesbakeshop.git
cd nathaliesbakeshop

cp .env.example .env
composer install
npm install

php artisan key:generate
php artisan migrate --seed
npm run build
```

### Run locally

```bash
# Terminal 1
php artisan serve

# Terminal 2
npm run dev
```

Visit [http://localhost:8000](http://localhost:8000).

### Demo admin login

| Field | Value |
|-------|--------|
| Email | `admin@nathaliesbakeshop.test` |
| Password | `password` |

Admin panel: `/admin`

### Run tests

```bash
php artisan test
```

---

## Project structure

```
app/Http/Controllers/   # Shop, checkout, admin, and auth controllers
resources/js/Pages/     # Inertia Vue pages (Shop, Admin, Auth)
resources/js/Components/# Reusable UI (ProductCard, Navbar, Footer, etc.)
database/migrations/    # Schema: products, orders, inquiries, categories
database/seeders/       # Sample catalog and admin user
routes/web.php          # Application routes
```

---

## Deployment

The app deploys to [Render](https://render.com) using Docker (PHP 8.3) and a managed PostgreSQL database. Configuration lives in `render.yaml` and `.env.render.example`.

---

## License

MIT
