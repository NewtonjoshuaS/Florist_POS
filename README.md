Florist & General Shop POS System
=================================

This project is an offline-first Point of Sale (POS) and inventory management system
for a florist shop and a general mini-shop, built with PHP and MySQL.

It contains **two modules in one system**:

- General Shop POS
- Florist POS (flowers, bouquets, vases / vessels)

Each module has its own dashboards and flows, with role-based access control
for **Admin** and **Shopkeeper/Keeper**.

## Requirements

- XAMPP or WAMP (PHP 8+ recommended)
- MySQL / MariaDB
- Modern browser (Chrome, Edge, Firefox)

## Installation (local)

1. Copy the `florist_pos` folder into your web root, for example:
   - `C:/xampp/htdocs/florist_pos` (XAMPP)
2. Create a MySQL database (for example `florist_pos`).
3. Import the SQL schema from `database/schema.sql` (to be generated).
4. Copy `app/config.example.php` to `app/config.php` and adjust:
   - Database name, user, password, host.
5. Open in your browser:
   - `http://localhost/florist_pos/public/`

## Modules and roles (overview)

- **Modules**
  - General Shop POS
  - Florist POS

- **Roles**
  - Admin: full CRUD, configuration, reports and analytics
  - Keeper: daily operations (sales, limited inventory views), restricted reports

## Project structure (planned)

- `public/` – web entry points (landing page, login, dashboards)
- `app/` – core PHP logic (auth, database, models, controllers)
- `templates/` – shared layout (header, sidebar, topbar, footer)
- `assets/` – CSS, JS, images, fonts
- `database/` – SQL schema and migrations

