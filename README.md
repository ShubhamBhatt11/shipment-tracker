# 📦 Shipment Tracker

A simple Laravel 12 shipment tracking app that lets users browse shipments, search by tracking number, and view a shipment's status timeline.

## Tech Stack

- PHP 8.2+
- Laravel 12
- MySQL
- Blade + Bootstrap 5

## Main Features

- Shipment list with pagination
- Search by tracking number
- Shipment detail page
- Status timeline with timestamps and locations
- Seeded demo data for local review

## Routes

- `/` — welcome page
- `/shipments` — shipment list
- `/shipments/{shipment}` — shipment details and timeline

## Quick Setup

### Requirements

- PHP 8.2+
- Composer
- MySQL

```bash
git clone <repository-url>
cd shipment-tracker
composer install
```

Create `.env` from `.env.example` and update the database settings if needed.

By default, the project expects a MySQL database named `shipment_tracker`.

Then run:

```bash
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Open:

- `http://127.0.0.1:8000/`
- `http://127.0.0.1:8000/shipments`

## Notes

- The project is not tied to XAMPP or any specific local path.
- If using Apache or Nginx, point the web root to `public/`.
- The seed creates 50 sample shipments with related status logs.
- Node/Vite is available in the project, but it is not required for the current reviewer setup path above.

