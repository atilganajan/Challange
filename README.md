# Albasoft E-Commerce Project

Welcome to the Albasoft E-Commerce project! This is a basic e-commerce application developed using Laravel, PHP v8.2, MySQL for the database, and Laravel Blade templates for the frontend.

## Features

- **Authentication:** Secure user registration and login functionality.
- **Validation:** Input validation to ensure data integrity.
- **Product Listing:** Browse a variety of products available in the store.
- **Filtering:** Easily filter products based on categories.
- **Shopping Basket:** Add and remove products from your shopping basket.

## Prerequisites

- PHP v8.2
- Composer
- MySQL

## Installation

1. Clone this repository: `git clone https://github.com/atilganajan/Challange`
2. Navigate to the project folder: `cd Challange`
3. Install composer dependencies: `composer install`
4. Copy the `.env.example` file to `.env` and configure your database settings.
5. Run database migrations: `php artisan migrate`
6. Run database seeding: `php artisan db:seed --class=DatabaseSeeder`
7. Run the command for image uploading: `php artisan storage:link`
8. Start the development server: `php artisan serve`

## Usage

1. Register or log in to your account.
2. Explore the list of products and use the filtering options.
3. Add products to your basket and manage your selections.
4. Proceed to checkout when you're ready to place an order.

## License

This project is licensed under the [MIT License](LICENSE).
