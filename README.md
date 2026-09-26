# سرمد (Sarmad)

A Laravel-based e-commerce platform for luxury watches and perfumes, built for the Egyptian market.

## Overview

Sarmad is a full-featured online store offering luxury watches and perfumes, with a fully responsive, RTL-first Arabic interface and a localized checkout experience (including Egyptian payment gateway integration).

## Live Preview
https://sarmad.gt.tc/

## Tech Stack

- **Backend:** Laravel 12
- **Auth:** Laravel Breeze (Blade)
- **Frontend:** Blade templates, custom CSS/JS (`test4.css`, `test4.js`), npm build pipeline
- **Database:** MySQL (via XAMPP in local development)
- **Payments:** [Paymob](https://paymob.com) — Intention API (Starter Business individual account tier)
- **Local dev environment:** XAMPP (Windows)

## Features

### Storefront
- Product catalog for watches and perfumes, organized by category and subcategory
- Product detail pages with a split-screen layout (image gallery + product info)
- Instagram-style image carousel supporting both primary product images and additional product photos
- Full RTL Arabic layout throughout the storefront
- Fully responsive design (navbar, product sliders, cart, checkout) across mobile and desktop

### Checkout & Payments
- Integrated with Paymob's Intention API for secure, inline/on-page payment processing
- Webhook-based payment confirmation with HMAC (SHA512) verification
- Dynamic payment method storage based on transaction `source_data`
- Arabic Privacy Policy and Terms of Service pages

### Admin Panel
- Subcategory management (linked to parent categories)
- Order management with DataTables, including delivery status tracking (Arabic-translated via Laravel Accessors)
- Sidebar badge counts via a Laravel View Composer
- Full CRUD for subcategories and orders

## Project Structure & Conventions

- Main compiled assets: `test4.js`, `test4.css`
- Uploaded images stored under `uploads/images/`
- Admin routes follow the `adminXxx` naming convention
- Page-specific JavaScript is injected via Blade's `@push('scripts')`

## Getting Started

### Prerequisites
- PHP >= 8.2
- Composer
- Node.js & npm
- MySQL (e.g. via XAMPP)

### Installation

```bash
# Clone the repository
git clone <repository-url>
cd sarmad

# Install PHP dependencies
composer install

# Install JS dependencies
npm install

# Copy environment file and configure it
cp .env.example .env
php artisan key:generate
```

Configure your `.env` file with your database credentials and Paymob keys:

```env
DB_DATABASE=sarmad
DB_USERNAME=root
DB_PASSWORD=

PAYMOB_API_KEY=your_paymob_api_key
PAYMOB_IFRAME_ID=your_iframe_id
```

```bash
# Run migrations
php artisan migrate

# Build front-end assets
npm run dev   # or: npm run build

# Serve the application
php artisan serve
```

### Webhook testing (local)
For local Paymob webhook delivery, use a tunneling tool such as [ngrok](https://ngrok.com) to expose your local server, and ensure the webhook route is excluded from CSRF verification.

## Hosting

Recommended for production: paid cPanel-based hosting (e.g. GreenGeeks, HostArmada, ChemiCloud). Avoid free hosting providers, as they are typically incompatible with Laravel's requirements and webhook delivery.

## License

_Add your license here (e.g. MIT, proprietary)._

## Contact

_Add contact or support information here._
