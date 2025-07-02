# Inventory System

A modern, responsive inventory management system built with Laravel, Tailwind CSS, Alpine.js, and Laravel Breeze.

## Features

-   Product, Category, Supplier, and Order management (CRUD)
-   Sales and restocking workflows
-   Low stock alerts
-   Dashboard with recent activity logs
-   Activity logging for create/update/delete actions
-   Responsive, mobile-friendly UI with a consistent amber/yellow color scheme
-   Authentication (login/register) powered by Laravel Breeze
-   User profile management

## Tech Stack

-   Laravel (PHP)
-   Laravel Breeze (authentication scaffolding)
-   Tailwind CSS
-   Alpine.js
-   Vite (asset bundler)
-   MySQL (default, can be changed)

## Getting Started

### Prerequisites

-   PHP 8.1+
-   Composer
-   Node.js & npm
-   MySQL

### Installation

1. Create a new MySQL database for the project.
2. Clone the repository:
    ```sh
    git clone https://github.com/rodeldichoso/inventory-system-laravel.git
    cd inventory-system
    ```
3. Install PHP dependencies:
    ```sh
    composer install
    ```
4. Install JS dependencies:
    ```sh
    npm install
    ```
5. Copy the example environment file and set your variables:
    ```sh
    cp .env.example .env
    php artisan key:generate
    ```
6. Configure your MySQL database in `.env`:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```
7. Run migrations and seeders:
    ```sh
    php artisan migrate --seed
    ```
8. Build assets:
    ```sh
    npm run build
    # or for development
    npm run dev
    ```
9. Start the local server:
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

## Customization

-   Update Tailwind config in `tailwind.config.js` for colors and themes.
-   Add custom CSS in `resources/css/app.css` if needed.
-   Extend functionality by adding new controllers, models, or views.

## License

This project is open-sourced under the MIT license.
