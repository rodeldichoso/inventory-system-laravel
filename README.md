# Inventory System

**This project is for learning and demonstration purposes only. Not intended for production use.**

Inventory management system built with Laravel, Tailwind CSS, Alpine.js, and Laravel Breeze.

## Features

-   Product, Category, Supplier, and Order management (CRUD)
-   Role-based access control (admin/staff) using Spatie Laravel Permission
    -   Admins can manage (create, edit, delete) categories, suppliers, and products
    -   Staff can view categories and suppliers, add suppliers, create products, restock products, and manage orders (except delete)
-   Sales and restocking workflows
-   Low stock alerts
-   Dashboard with recent activity logs
-   Activity logging for create/update/delete actions
-   Authentication (login/register) powered by Laravel Breeze
-   User profile management

## Tech Stack

-   Laravel (PHP)
-   Laravel Breeze (authentication scaffolding)
-   Spatie Laravel Permission (role/permission management)
-   Tailwind CSS
-   Vite (asset bundler)
-   MySQL (default, can be changed)

## Getting Started

### Prerequisites

-   PHP 8.1+
-   Composer
-   Node.js & npm
-   MySQL

### Installation

1.  Create a new MySQL database for the project.
2.  Clone the repository:
    ```sh
    git clone https://github.com/rodeldichoso/inventory-system-laravel.git
    cd inventory-system
    ```
3.  Install PHP dependencies:
    ```sh
    composer install
    ```
4.  Install JS dependencies:
    ```sh
    npm install
    ```
5.  Copy the example environment file and set your variables:
    ```sh
    cp .env.example .env
    php artisan key:generate
    ```
6.  Configure your MySQL database in `.env`:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```
7.  Run migrations and seeders:
    ```sh
    php artisan migrate --seed
    ```
8.  Build assets:
    ```sh
    npm run build
    # or for development
    npm run dev
    ```
9.  Start the local server:
    ```sh
    php artisan serve
    ```

Visit [http://localhost:8000](http://localhost:8000) in your browser.

## Usage

-   Log in with the default admin account:
    -   **Email:** admin@example.com
    -   **Password:** password123
-   Or register a new user.
-   Manage products, categories, suppliers, and orders from the dashboard.
-   View recent activity logs and low stock alerts.
-   Role-based access:
    -   **Admins:** Full management of products, categories, suppliers, and orders
    -   **Staff:** Can add/view products and suppliers, restock products, manage orders (except delete), but cannot edit/delete products, categories, or suppliers

## Customization

-   Update Tailwind config in `tailwind.config.js` for colors and themes.
-   Add custom CSS in `resources/css/app.css` if needed.
-   Extend functionality by adding new controllers, models, or views.

## License

This project is open-sourced under the MIT license. Please note: This software is provided as-is for educational and development purposes, and may contain bugs or unfinished features.

## About the Author

Hi! I'm a passionate web developer who really loves to code and solve problems. This project is part of my learning journey and showcases my Laravel skills.

-   GitHub: [rodeldichoso](https://github.com/rodeldichoso)
